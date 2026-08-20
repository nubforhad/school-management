<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\AcademicSession;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;

class AttendanceController extends Controller
{
    /**
     * Attendance index / daily attendance page
     */
     public function index(Request $request)
{
    // Branches 
    $branches = Branch::orderBy('name')->get();
    /*
    |--------------------------------------------------------------------------
    | Academic Sessions
    |--------------------------------------------------------------------------
    */
    $academicSessions = AcademicSession::orderByDesc('id')->get();

    // Default Collections    
    $classes = collect();
    $sections = collect();
    $students = collect();


    /*
    |--------------------------------------------------------------------------
    | Classes - Branch Wise
    |--------------------------------------------------------------------------
    */

    if ($request->filled('branch_id')) {

        $classes = SchoolClass::where(
                'branch_id',
                $request->branch_id
            )
            ->orderBy('name')
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Sections - Branch + Class Wise
    |--------------------------------------------------------------------------
    */

    if (
        $request->filled('branch_id') &&
        $request->filled('school_class_id')
    ) {

        $sections = Section::where(
                'branch_id',
                $request->branch_id
            )
            ->where(
                'class_id',
                $request->school_class_id
            )
            ->orderBy('name')
            ->get();
    }


    /*
    |--------------------------------------------------------------------------
    | Students - Branch + Session + Class + Section Wise
    |--------------------------------------------------------------------------
    */

    if (
        $request->filled('branch_id') &&
        $request->filled('academic_session_id') &&
        $request->filled('school_class_id') &&
        $request->filled('section_id')
    ) {

        $students = StudentEnrollment::with('student')
            ->where(
                'branch_id',
                $request->branch_id
            )
            ->where(
                'academic_session_id',
                $request->academic_session_id
            )
            ->where(
                'class_id',
                $request->school_class_id
            )
            ->where(
                'section_id',
                $request->section_id
            )
            ->where(
                'status',
                'active'
            )
            ->get()
            ->pluck('student');
    }

    return view(  'admin.attendance.index', compact(
            'branches',
            'academicSessions',
            'classes',
            'sections',
            'students'
        )
    );
}

    /**
     * Save daily attendance
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],

            'school_class_id' => [
                'required',
                'exists:classes,id',  
            ],

            'section_id' => [
                'required',
                'exists:sections,id',
            ],

            'date' => [
                'required',
                'date',
            ],

            'attendance' => [
                'required',
                'array',
            ],

            'attendance.*.student_id' => [
                'required',
                'exists:students,id',
            ],

            'attendance.*.status' => [
                'required',
                'in:present,absent,late,leave',
            ],

            'attendance.*.in_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'attendance.*.out_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'attendance.*.remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        DB::transaction(function () use ($validated) {

            foreach ($validated['attendance'] as $item) {

                Attendance::updateOrCreate(
                    [
                        'student_id' => $item['student_id'],
                        'date' => $validated['date'],
                    ],
                    [
                        'branch_id' => $validated['branch_id'],
                        'academic_session_id' =>
                            $validated['academic_session_id'],
                        'school_class_id' =>
                            $validated['school_class_id'],
                        'section_id' =>
                            $validated['section_id'],

                        'status' => $item['status'],

                        'in_time' =>
                            $item['in_time'] ?? null,

                        'out_time' =>
                            $item['out_time'] ?? null,

                        'remarks' =>
                            $item['remarks'] ?? null,
                    ]
                );
            }
        });

            return redirect()
       ->route('admin.attendance.index', [
           'branch_id' => $validated['branch_id'],
           'academic_session_id' => $validated['academic_session_id'],
           'school_class_id' => $validated['school_class_id'],
           'section_id' => $validated['section_id'],
           'date' => $validated['date'],
       ])
       ->with('success', 'Attendance saved successfully.');
    }







    public function report(Request $request)
    {
        $query = Attendance::with([
            'employee.branch',
        ]);

        // Date filter
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        // Date range
        if ($request->filled('from_date')) {
            $query->whereDate('date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('date', '<=', $request->to_date);
        }

        // Branch filter
        if ($request->filled('branch_id')) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->where('branch_id', $request->branch_id);
            });
        }

        // Employee filter
        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        $attendances = $query
            ->latest('date')
            ->latest('in_time')
            ->get();

        // Summary
        $total = $attendances->count();

        $present = $attendances->where('status', 'Present')->count();

        $absent = $attendances->where('status', 'Absent')->count();

        $late = $attendances->where('status', 'Late')->count();

        $branches = Branch::orderBy('name')->get();

        $employees = Employee::orderBy('name')->get();

        return view('admin.attendance.report', compact(
            'attendances',
            'branches',
            'employees',
            'total',
            'present',
            'absent',
            'late'
        ));
    }







}