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

public function edit(Attendance $attendance)
{
    $attendance->load([
        'student',
        'branch',
        'academicSession',
        'schoolClass',
        'section',
    ]);

    $branches = Branch::orderBy('name')->get();

    $academicSessions = AcademicSession::orderByDesc('id')->get();

    $schoolClasses = SchoolClass::orderBy('name')->get();

    $sections = Section::orderBy('name')->get();

    return view('admin.attendance.edit', compact(
        'attendance',
        'branches',
        'academicSessions',
        'schoolClasses',
        'sections'
    ));
}

public function update(Request $request, Attendance $attendance)
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

        'status' => [
            'required',
            'in:present,absent,late,leave',
        ],

        'in_time' => [
            'nullable',
            'date_format:H:i',
        ],

        'out_time' => [
            'nullable',
            'date_format:H:i',
        ],

        'remarks' => [
            'nullable',
            'string',
            'max:1000',
        ],
    ]);


    /*
    |--------------------------------------------------------------------------
    | Duplicate Attendance Check
    |--------------------------------------------------------------------------
    */

    $duplicate = Attendance::where('student_id', $attendance->student_id)
        ->where('branch_id', $validated['branch_id'])
        ->where(
            'academic_session_id',
            $validated['academic_session_id']
        )
        ->where(
            'school_class_id',
            $validated['school_class_id']
        )
        ->where(
            'section_id',
            $validated['section_id']
        )
        ->whereDate('date', $validated['date'])
        ->where('id', '!=', $attendance->id)
        ->exists();


    if ($duplicate) {

        return back()
            ->withInput()
            ->withErrors([
                'date' =>
                    'Attendance already exists for this student on the selected date.',
            ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Update Attendance
    |--------------------------------------------------------------------------
    */

    $attendance->update([
        'branch_id' => $validated['branch_id'],

        'academic_session_id' =>
            $validated['academic_session_id'],

        'school_class_id' =>
            $validated['school_class_id'],

        'section_id' =>
            $validated['section_id'],

        'date' =>
            $validated['date'],

        'status' =>
            $validated['status'],

        'in_time' =>
            $validated['in_time'] ?? null,

        'out_time' =>
            $validated['out_time'] ?? null,

        'remarks' =>
            $validated['remarks'] ?? null,
    ]);


    return redirect()
        ->route('admin.attendance.student-history', [
            'student_id' => $attendance->student_id,
        ])
        ->with(
            'success',
            'Attendance updated successfully.'
        );
}

 public function report(Request $request)
{
    $query = Attendance::with([
        'student.branch',
        'academicSession',
        'schoolClass',
        'section',
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
        $query->where('branch_id', $request->branch_id);
    }

    // Student filter
    if ($request->filled('student_id')) {
        $query->where('student_id', $request->student_id);
    }

    // Attendance records
    $attendances = $query
        ->latest('date')
        ->latest('in_time')
        ->get();

    // Summary
    $total = $attendances->count();

    $present = $attendances
        ->where('status', 'Present')
        ->count();

    $absent = $attendances
        ->where('status', 'Absent')
        ->count();

    $late = $attendances
        ->where('status', 'Late')
        ->count();

    // Branches
    $branches = Branch::orderBy('name')->get();

    // Students
    $students = Student::orderBy('name')->get();

    return view('admin.attendance.report', compact(
        'attendances',
        'branches',
        'students',
        'total',
        'present',
        'absent',
        'late'
    ));
}



public function analytics(Request $request)
{
    $query = Attendance::with([
        'student.branch',
        'student.schoolClass',
        'student.section',
    ]);

    // Branch
    if ($request->filled('branch_id')) {
        $query->where('branch_id', $request->branch_id);
    }

    // Academic Session
    if ($request->filled('academic_session_id')) {
        $query->where(
            'academic_session_id',
            $request->academic_session_id
        );
    }

    // Class
    if ($request->filled('school_class_id')) {
        $query->where(
            'school_class_id',
            $request->school_class_id
        );
    }

    // Section
    if ($request->filled('section_id')) {
        $query->where(
            'section_id',
            $request->section_id
        );
    }

    // Date range
    if ($request->filled('from_date')) {
        $query->whereDate(
            'date',
            '>=',
            $request->from_date
        );
    }

    if ($request->filled('to_date')) {
        $query->whereDate(
            'date',
            '<=',
            $request->to_date
        );
    }

    $attendances = $query
        ->orderBy('student_id')
        ->orderBy('date')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Student Analytics
    |--------------------------------------------------------------------------
    */

    $studentAnalytics = $attendances
        ->groupBy('student_id')
        ->map(function ($records) {

            $totalDays = $records->count();

            $present = $records
                ->where('status', 'Present')
                ->count();

            $absent = $records
                ->where('status', 'Absent')
                ->count();

            $late = $records
                ->where('status', 'Late')
                ->count();

            $percentage = $totalDays > 0
                ? round(($present / $totalDays) * 100, 2)
                : 0;

            return [
                'student' => $records->first()->student,

                'total_days' => $totalDays,

                'present' => $present,

                'absent' => $absent,

                'late' => $late,

                'percentage' => $percentage,
            ];
        })
        ->values();


    /*
    |--------------------------------------------------------------------------
    | Overall Analytics
    |--------------------------------------------------------------------------
    */

    $totalStudents = $studentAnalytics->count();

    $totalAttendanceDays = $attendances->count();

    $totalPresent = $attendances
        ->where('status', 'Present')
        ->count();

    $totalAbsent = $attendances
        ->where('status', 'Absent')
        ->count();

    $totalLate = $attendances
        ->where('status', 'Late')
        ->count();

    $averagePercentage = $totalAttendanceDays > 0
        ? round(
            ($totalPresent / $totalAttendanceDays) * 100,
            2
        )
        : 0;


    /*
    |--------------------------------------------------------------------------
    | Performance Groups
    |--------------------------------------------------------------------------
    */

    $above90 = $studentAnalytics
        ->where('percentage', '>=', 90)
        ->count();

    $between75And89 = $studentAnalytics
        ->filter(function ($student) {
            return $student['percentage'] >= 75
                && $student['percentage'] < 90;
        })
        ->count();

    $below75 = $studentAnalytics
        ->where('percentage', '<', 75)
        ->count();


    $branches = Branch::orderBy('name')->get();

    $academicSessions = AcademicSession::orderByDesc('id')->get();

    $schoolClasses = SchoolClass::orderBy('name')->get();

    $sections = Section::orderBy('name')->get();


    return view(
        'admin.attendance.analytics',
        compact(
            'studentAnalytics',
            'totalStudents',
            'totalAttendanceDays',
            'totalPresent',
            'totalAbsent',
            'totalLate',
            'averagePercentage',
            'above90',
            'between75And89',
            'below75',
            'branches',
            'academicSessions',
            'schoolClasses',
            'sections'
        )
    );
}


public function studentHistory(Request $request)
{
    $students = Student::orderBy('name')->get();

    $branches = Branch::orderBy('name')->get();

    $academicSessions = AcademicSession::orderByDesc('id')->get();

    $schoolClasses = SchoolClass::orderBy('name')->get();

    $sections = Section::orderBy('name')->get();

    $attendances = collect();

    $selectedStudent = null;

    $totalDays = 0;
    $present = 0;
    $absent = 0;
    $late = 0;
    $leave = 0;
    $attendancePercentage = 0;

    /*
    |--------------------------------------------------------------------------
    | Student History
    |--------------------------------------------------------------------------
    */

    if ($request->filled('student_id')) {

        $selectedStudent = Student::with('branch')
            ->find($request->student_id);

        if ($selectedStudent) {

            $query = Attendance::with([
                'student',
                'branch',
                'academicSession',
                'schoolClass',
                'section',
            ])
            ->where('student_id', $selectedStudent->id);


            /*
            |--------------------------------------------------------------------------
            | Branch Filter
            |--------------------------------------------------------------------------
            */

            if ($request->filled('branch_id')) {
                $query->where('branch_id', $request->branch_id);
            }


            /*
            |--------------------------------------------------------------------------
            | Academic Session
            |--------------------------------------------------------------------------
            */

            if ($request->filled('academic_session_id')) {
                $query->where(
                    'academic_session_id',
                    $request->academic_session_id
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Class
            |--------------------------------------------------------------------------
            */

            if ($request->filled('school_class_id')) {
                $query->where(
                    'school_class_id',
                    $request->school_class_id
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Section
            |--------------------------------------------------------------------------
            */

            if ($request->filled('section_id')) {
                $query->where(
                    'section_id',
                    $request->section_id
                );
            }


            /*
            |--------------------------------------------------------------------------
            | From Date
            |--------------------------------------------------------------------------
            */

            if ($request->filled('from_date')) {

                $query->whereDate(
                    'date',
                    '>=',
                    $request->from_date
                );

            }


            /*
            |--------------------------------------------------------------------------
            | To Date
            |--------------------------------------------------------------------------
            */

            if ($request->filled('to_date')) {

                $query->whereDate(
                    'date',
                    '<=',
                    $request->to_date
                );

            }


            $attendances = $query
                ->latest('date')
                ->latest('in_time')
                ->get();


            /*
            |--------------------------------------------------------------------------
            | Summary
            |--------------------------------------------------------------------------
            */

            $totalDays = $attendances->count();

            $present = $attendances
                ->where('status', 'present')
                ->count();

            $absent = $attendances
                ->where('status', 'absent')
                ->count();

            $late = $attendances
                ->where('status', 'late')
                ->count();

            $leave = $attendances
                ->where('status', 'leave')
                ->count();


            /*
            |--------------------------------------------------------------------------
            | Attendance Percentage
            |--------------------------------------------------------------------------
            */

            if ($totalDays > 0) {

                $attendancePercentage = round(
                    (($present + $late) / $totalDays) * 100,
                    2
                );

            }
        }
    }


    return view(
        'admin.attendance.student-history',
        compact(
            'students',
            'branches',
            'academicSessions',
            'schoolClasses',
            'sections',
            'attendances',
            'selectedStudent',
            'totalDays',
            'present',
            'absent',
            'late',
            'leave',
            'attendancePercentage'
        )
    );
}



public function monthlyReport(Request $request)
{
    $branches = Branch::orderBy('name')->get();

    $academicSessions = AcademicSession::orderByDesc('id')->get();

    $schoolClasses = SchoolClass::orderBy('name')->get();

    $sections = Section::orderBy('name')->get();


    /*
    |--------------------------------------------------------------------------
    | Default Month
    |--------------------------------------------------------------------------
    */

    $month = $request->input(
        'month',
        now()->format('Y-m')
    );


    /*
    |--------------------------------------------------------------------------
    | Students
    |--------------------------------------------------------------------------
    */

    $students = collect();

    $summary = [
        'total_students' => 0,
        'working_days' => 0,
        'present' => 0,
        'absent' => 0,
        'late' => 0,
        'leave' => 0,
        'average_percentage' => 0,
    ];


    $studentAnalytics = collect();


    /*
    |--------------------------------------------------------------------------
    | Load Report Only When Filters Are Selected
    |--------------------------------------------------------------------------
    */

    if (
        $request->filled('branch_id') ||
        $request->filled('academic_session_id') ||
        $request->filled('school_class_id') ||
        $request->filled('section_id')
    ) {

        $attendanceQuery = Attendance::with([
            'student.branch',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Branch
        |--------------------------------------------------------------------------
        */

        if ($request->filled('branch_id')) {

            $attendanceQuery->where(
                'branch_id',
                $request->branch_id
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Academic Session
        |--------------------------------------------------------------------------
        */

        if ($request->filled('academic_session_id')) {

            $attendanceQuery->where(
                'academic_session_id',
                $request->academic_session_id
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Class
        |--------------------------------------------------------------------------
        */

        if ($request->filled('school_class_id')) {

            $attendanceQuery->where(
                'school_class_id',
                $request->school_class_id
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Section
        |--------------------------------------------------------------------------
        */

        if ($request->filled('section_id')) {

            $attendanceQuery->where(
                'section_id',
                $request->section_id
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Month Filter
        |--------------------------------------------------------------------------
        */

        try {

            $startDate = \Carbon\Carbon::createFromFormat(
                'Y-m',
                $month
            )->startOfMonth();

            $endDate = \Carbon\Carbon::createFromFormat(
                'Y-m',
                $month
            )->endOfMonth();

        } catch (\Exception $e) {

            $startDate = now()->startOfMonth();

            $endDate = now()->endOfMonth();

            $month = now()->format('Y-m');
        }


        $attendanceQuery
            ->whereBetween('date', [
                $startDate->format('Y-m-d'),
                $endDate->format('Y-m-d'),
            ]);


        $attendances = $attendanceQuery
            ->orderBy('date')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Group By Student
        |--------------------------------------------------------------------------
        */

        $grouped = $attendances->groupBy('student_id');


        /*
        |--------------------------------------------------------------------------
        | Student Analytics
        |--------------------------------------------------------------------------
        */

        foreach ($grouped as $studentId => $records) {

            $student = $records->first()->student;


            $present = $records
                ->where('status', 'present')
                ->count();


            $absent = $records
                ->where('status', 'absent')
                ->count();


            $late = $records
                ->where('status', 'late')
                ->count();


            $leave = $records
                ->where('status', 'leave')
                ->count();


            $totalDays = $records->count();


            $attendanceDays =
                $present + $late;


            $percentage = $totalDays > 0
                ? round(
                    ($attendanceDays / $totalDays) * 100,
                    2
                )
                : 0;


            /*
            |--------------------------------------------------------------------------
            | Daily Status Map
            |--------------------------------------------------------------------------
            */

            $daily = [];

            foreach ($records as $record) {

                $day = \Carbon\Carbon::parse(
                    $record->date
                )->day;

                $daily[$day] = $record->status;
            }


            $studentAnalytics->push([

                'student' => $student,

                'student_id' => $studentId,

                'present' => $present,

                'absent' => $absent,

                'late' => $late,

                'leave' => $leave,

                'total_days' => $totalDays,

                'percentage' => $percentage,

                'daily' => $daily,

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Summary
        |--------------------------------------------------------------------------
        */

        $summary['total_students'] =
            $studentAnalytics->count();


        $summary['working_days'] =
            $attendances
                ->groupBy(
                    fn ($attendance) =>
                        \Carbon\Carbon::parse(
                            $attendance->date
                        )->format('Y-m-d')
                )
                ->count();


        $summary['present'] =
            $attendances
                ->where('status', 'present')
                ->count();


        $summary['absent'] =
            $attendances
                ->where('status', 'absent')
                ->count();


        $summary['late'] =
            $attendances
                ->where('status', 'late')
                ->count();


        $summary['leave'] =
            $attendances
                ->where('status', 'leave')
                ->count();


        $summary['average_percentage'] =
            $studentAnalytics->count() > 0
                ? round(
                    $studentAnalytics->avg(
                        'percentage'
                    ),
                    2
                )
                : 0;
    }


    return view(
        'admin.attendance.monthly-report',
        compact(
            'branches',
            'academicSessions',
            'schoolClasses',
            'sections',
            'month',
            'studentAnalytics',
            'summary'
        )
    );
}




}