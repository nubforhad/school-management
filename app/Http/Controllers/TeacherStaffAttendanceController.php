<?php

namespace App\Http\Controllers;

use App\Models\TeacherStaff;
use App\Models\TeacherStaffAttendance;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherStaffAttendanceController extends Controller
{
    /**
     * Display attendance records.
     */
    public function index(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        $query = TeacherStaffAttendance::with([
            'teacherStaff',
        ])
            ->where('branch_id', $branchId);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas('teacherStaff', function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('employee_id', 'like', "%{$search}%");

            });
        }

        /*
        |--------------------------------------------------------------------------
        | Teacher / Staff Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('teacher_staff_id')) {

            $query->where(
                'teacher_staff_id',
                $request->teacher_staff_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Date Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date')) {

            $query->whereDate(
                'date',
                $request->date
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

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $attendances = $query
            ->latest('date')
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Teacher / Staff List
        |--------------------------------------------------------------------------
        */

        $teacherStaff = TeacherStaff::where(
            'branch_id',
            $branchId
        )
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Summary
        |--------------------------------------------------------------------------
        */

        $summaryQuery = TeacherStaffAttendance::where(
            'branch_id',
            $branchId
        );

        if ($request->filled('date')) {

            $summaryQuery->whereDate(
                'date',
                $request->date
            );

        } elseif ($request->filled('from_date') || $request->filled('to_date')) {

            if ($request->filled('from_date')) {

                $summaryQuery->whereDate(
                    'date',
                    '>=',
                    $request->from_date
                );
            }

            if ($request->filled('to_date')) {

                $summaryQuery->whereDate(
                    'date',
                    '<=',
                    $request->to_date
                );
            }

        } else {

            $summaryQuery->whereDate(
                'date',
                now()->toDateString()
            );
        }

        $summary = [
            'total' => (clone $summaryQuery)->count(),

            'present' => (clone $summaryQuery)
                ->where('status', 'present')
                ->count(),

            'late' => (clone $summaryQuery)
                ->where('status', 'late')
                ->count(),

            'absent' => (clone $summaryQuery)
                ->where('status', 'absent')
                ->count(),

            'leave' => (clone $summaryQuery)
                ->where('status', 'leave')
                ->count(),
        ];

        return view(
            'admin.teacher-staff-attendance.index',
            compact(
                'attendances',
                'teacherStaff',
                'summary'
            )
        );
    }


    /**
     * Show create form.
     */
    public function create()
    {
        $branchId = auth()->user()->branch_id;

        $teacherStaff = TeacherStaff::where(
            'branch_id',
            $branchId
        )
            ->orderBy('name')
            ->get();

        return view(
            'admin.teacher-staff-attendance.create',
            compact('teacherStaff')
        );
    }


    /**
     * Store attendance.
     */
    public function store(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        $validated = $request->validate([

            'teacher_staff_id' => [
                'required',

                Rule::exists(
                    'teacher_staff',
                    'id'
                )->where(
                    'branch_id',
                    $branchId
                ),
            ],

            'date' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                Rule::in([
                    'present',
                    'late',
                    'absent',
                    'leave',
                ]),
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
        | Duplicate Check
        |--------------------------------------------------------------------------
        */

        $exists = TeacherStaffAttendance::where(
            'branch_id',
            $branchId
        )
            ->where(
                'teacher_staff_id',
                $validated['teacher_staff_id']
            )
            ->whereDate(
                'date',
                $validated['date']
            )
            ->exists();

        if ($exists) {

            return back()
                ->withInput()
                ->withErrors([
                    'teacher_staff_id' =>
                        'Attendance for this employee has already been recorded for this date.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Automatically Clear Time for Absent / Leave
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $validated['status'],
                ['absent', 'leave']
            )
        ) {

            $validated['in_time'] = null;
            $validated['out_time'] = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Create Attendance
        |--------------------------------------------------------------------------
        */

        TeacherStaffAttendance::create([

            'branch_id' =>
                $branchId,

            'teacher_staff_id' =>
                $validated['teacher_staff_id'],

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
            ->route(
                'admin.teacher-staff-attendance.index'
            )
            ->with(
                'success',
                'Attendance recorded successfully.'
            );
    }


    /**
     * Display attendance.
     */
    public function show(
        TeacherStaffAttendance $teacherStaffAttendance
    ) {
        $this->authorizeBranch(
            $teacherStaffAttendance
        );

        $teacherStaffAttendance->load([
            'teacherStaff',
            'branch',
        ]);

        return view(
            'admin.teacher-staff-attendance.show',
            compact('teacherStaffAttendance')
        );
    }


    /**
     * Show edit form.
     */
    public function edit(
        TeacherStaffAttendance $teacherStaffAttendance
    ) {
        $this->authorizeBranch(
            $teacherStaffAttendance
        );

        $branchId = auth()->user()->branch_id;

        $teacherStaff = TeacherStaff::where(
            'branch_id',
            $branchId
        )
            ->orderBy('name')
            ->get();

        return view(
            'admin.teacher-staff-attendance.edit',
            compact(
                'teacherStaffAttendance',
                'teacherStaff'
            )
        );
    }


    /**
     * Update attendance.
     */
    public function update(
        Request $request,
        TeacherStaffAttendance $teacherStaffAttendance
    ) {
        $this->authorizeBranch(
            $teacherStaffAttendance
        );

        $branchId = auth()->user()->branch_id;

        $validated = $request->validate([

            'teacher_staff_id' => [
                'required',

                Rule::exists(
                    'teacher_staff',
                    'id'
                )->where(
                    'branch_id',
                    $branchId
                ),
            ],

            'date' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                Rule::in([
                    'present',
                    'late',
                    'absent',
                    'leave',
                ]),
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
        | Duplicate Check
        |--------------------------------------------------------------------------
        */

        $exists = TeacherStaffAttendance::where(
            'branch_id',
            $branchId
        )
            ->where(
                'teacher_staff_id',
                $validated['teacher_staff_id']
            )
            ->whereDate(
                'date',
                $validated['date']
            )
            ->where(
                'id',
                '!=',
                $teacherStaffAttendance->id
            )
            ->exists();

        if ($exists) {

            return back()
                ->withInput()
                ->withErrors([
                    'teacher_staff_id' =>
                        'Attendance for this employee already exists for this date.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Automatically Clear Time
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $validated['status'],
                ['absent', 'leave']
            )
        ) {

            $validated['in_time'] = null;
            $validated['out_time'] = null;
        }

        $teacherStaffAttendance->update([

            'teacher_staff_id' =>
                $validated['teacher_staff_id'],

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
            ->route(
                'admin.teacher-staff-attendance.index'
            )
            ->with(
                'success',
                'Attendance updated successfully.'
            );
    }


    /**
     * Delete attendance.
     */
    public function destroy(
        TeacherStaffAttendance $teacherStaffAttendance
    ) {
        $this->authorizeBranch(
            $teacherStaffAttendance
        );

        $teacherStaffAttendance->delete();

        return redirect()
            ->route(
                'admin.teacher-staff-attendance.index'
            )
            ->with(
                'success',
                'Attendance deleted successfully.'
            );
    }


    /**
     * Branch security.
     */
    private function authorizeBranch(
        TeacherStaffAttendance $attendance
    ): void {

        abort_unless(
            $attendance->branch_id
                === auth()->user()->branch_id,
            403
        );
    }


        public function report(Request $request)
        {
            @dd($request);
            $branchId = auth()->user()->branch_id;

            $query = TeacherStaffAttendance::with([
                'teacherStaff',
                'branch',
            ]);

            // Branch security
            if ($branchId) {
                $query->where('branch_id', $branchId);
            }

            // Branch filter
            if ($request->filled('branch_id')) {
                $query->where('branch_id', $request->branch_id);
            }

            // Date
            if ($request->filled('date')) {
                $query->whereDate('date', $request->date);
            }

            // From Date
            if ($request->filled('from_date')) {
                $query->whereDate('date', '>=', $request->from_date);
            }

            // To Date
            if ($request->filled('to_date')) {
                $query->whereDate('date', '<=', $request->to_date);
            }

            // Teacher / Staff
            if ($request->filled('teacher_staff_id')) {
                $query->where(
                    'teacher_staff_id',
                    $request->teacher_staff_id
                );
            }

            // Status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            /*
            |--------------------------------------------------------------------------
            | Summary
            |--------------------------------------------------------------------------
            */

            $totalAttendance = (clone $query)->count();
            $presentCount = (clone $query)->where('status', 'present')->count();
            $lateCount = (clone $query)->where('status', 'late')->count();
            $absentCount = (clone $query)->where('status', 'absent')->count();
            $leaveCount = (clone $query)->where('status', 'leave')->count();

            /* Records */

            $attendances = $query
                ->latest('date')
                ->latest('id')
                ->paginate(20)
                ->withQueryString();

            /*
            |--------------------------------------------------------------------------
            | Filter Data
            |--------------------------------------------------------------------------
            */

            $branches = Branch::orderBy('name')->get();

            $teacherStaff = TeacherStaff::where(
                'branch_id',
                $branchId
            )
            ->orderBy('name')
            ->get();

            return view(  'admin.teacher-staff-attendance.report', compact(
                    'attendances',
                    'branches',
                    'teacherStaff',
                    'totalAttendance',
                    'presentCount',
                    'lateCount',
                    'absentCount',
                    'leaveCount'
                )
            );
        }













}