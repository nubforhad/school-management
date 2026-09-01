<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\LeaveAllocation;
use App\Models\LeaveApplication;
use App\Models\LeaveType;
use App\Models\TeacherStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LeaveApplicationController extends Controller
{
    /**
     * Display leave applications.
     */

    public function index(Request $request)
{
    $branchId = auth()->user()->branch_id;

    $query = LeaveApplication::with([
        'teacherStaff',
        'leaveType',
        'academicSession',
    ])
    ->where('branch_id', $branchId);


    if ($request->filled('search')) {
        $search = $request->search;

        $query->whereHas('teacherStaff', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('employee_id', 'like', "%{$search}%");
        });
    }

    if ($request->filled('leave_type_id')) {
        $query->where('leave_type_id', $request->leave_type_id);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('from_date')) {
        $query->whereDate('start_date', '>=', $request->from_date);
    }

    if ($request->filled('to_date')) {
        $query->whereDate('end_date', '<=', $request->to_date);
    }

    $applications = $query
        ->latest()
        ->paginate(15);

    // $leaveTypes = LeaveType::orderBy('name')->get();
    $leaveTypes = LeaveType::where('branch_id', $branchId)
    ->orderBy('name')
    ->get();

    return view('admin.leave-applications.index', compact(
        'applications',
        'leaveTypes'
    ));
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


        $leaveTypes = LeaveType::where(
                'branch_id',
                $branchId
            )
            ->where('status', true)
            ->orderBy('name')
            ->get();


        $academicSessions = AcademicSession::where(
                'branch_id',
                $branchId
            )
            ->orderByDesc('id')
            ->get();


        return view(
            'admin.leave-applications.create',
            compact(
                'teacherStaff',
                'leaveTypes',
                'academicSessions'
            )
        );
    }


    /**
     * Store leave application.
     */
    public function store(Request $request)
    {
        $branchId = auth()->user()->branch_id;


        $validated = $request->validate([

            'teacher_staff_id' => [
                'required',

                Rule::exists('teacher_staff', 'id')
                    ->where('branch_id', $branchId),
            ],

            'leave_type_id' => [
                'required',

                Rule::exists('leave_types', 'id')
                    ->where('branch_id', $branchId),
            ],

            'academic_session_id' => [
                'required',

                Rule::exists('academic_sessions', 'id')
                    ->where('branch_id', $branchId),
            ],

            'start_date' => [
                'required',
                'date',
            ],

            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],

            'reason' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Calculate Total Days
        |--------------------------------------------------------------------------
        */

        $startDate = \Carbon\Carbon::parse(
            $validated['start_date']
        );

        $endDate = \Carbon\Carbon::parse(
            $validated['end_date']
        );


        $totalDays = $startDate->diffInDays(
            $endDate
        ) + 1;


        /*
        |--------------------------------------------------------------------------
        | Check Leave Allocation
        |--------------------------------------------------------------------------
        */

        $allocation = LeaveAllocation::where(
                'branch_id',
                $branchId
            )
            ->where(
                'teacher_staff_id',
                $validated['teacher_staff_id']
            )
            ->where(
                'leave_type_id',
                $validated['leave_type_id']
            )
            ->where(
                'academic_session_id',
                $validated['academic_session_id']
            )
            ->where(
                'year',
                $startDate->year
            )
            ->first();


        if (!$allocation) {

            return back()
                ->withInput()
                ->withErrors([
                    'leave_type_id' =>
                        'No leave allocation found for this employee, leave type and academic session.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Calculate Remaining Days
        |--------------------------------------------------------------------------
        */

        $remainingDays =
            $allocation->allocated_days
            - $allocation->used_days;


        if ($totalDays > $remainingDays) {

            return back()
                ->withInput()
                ->withErrors([
                    'end_date' =>
                        "Insufficient leave balance. Available leave: {$remainingDays} days.",
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Create Application
        |--------------------------------------------------------------------------
        */

        LeaveApplication::create([

            'branch_id' =>
                $branchId,

            'teacher_staff_id' =>
                $validated['teacher_staff_id'],

            'leave_type_id' =>
                $validated['leave_type_id'],

            'academic_session_id' =>
                $validated['academic_session_id'],

            'start_date' =>
                $validated['start_date'],

            'end_date' =>
                $validated['end_date'],

            'total_days' =>
                $totalDays,

            'reason' =>
                $validated['reason'] ?? null,

            'status' =>
                'pending',
        ]);


        return redirect()
            ->route('admin.leave-applications.index')
            ->with(
                'success',
                'Leave application submitted successfully.'
            );
    }


    /**
     * Display application.
     */
    public function show(LeaveApplication $leaveApplication)
    {
        $this->authorizeBranch($leaveApplication);

        $leaveApplication->load([
            'teacherStaff',
            'leaveType',
            'academicSession',
            'approvedBy',
        ]);

        return view(
            'admin.leave-applications.show',
            compact('leaveApplication')
        );
    }


    /**
     * Show edit form.
     */
    public function edit(LeaveApplication $leaveApplication)
    {
        $this->authorizeBranch($leaveApplication);

        $branchId = auth()->user()->branch_id;


        $teacherStaff = TeacherStaff::where(
                'branch_id',
                $branchId
            )
            ->orderBy('name')
            ->get();


        $leaveTypes = LeaveType::where(
                'branch_id',
                $branchId
            )
            ->where('status', true)
            ->orderBy('name')
            ->get();


        $academicSessions = AcademicSession::where(
                'branch_id',
                $branchId
            )
            ->orderByDesc('id')
            ->get();


        return view(
            'admin.leave-applications.edit',
            compact(
                'leaveApplication',
                'teacherStaff',
                'leaveTypes',
                'academicSessions'
            )
        );
    }


    /**
     * Update application.
     */
    public function update(
        Request $request,
        LeaveApplication $leaveApplication
    ) {
        $this->authorizeBranch($leaveApplication);

        $branchId = auth()->user()->branch_id;


        $validated = $request->validate([

            'teacher_staff_id' => [
                'required',

                Rule::exists('teacher_staff', 'id')
                    ->where('branch_id', $branchId),
            ],

            'leave_type_id' => [
                'required',

                Rule::exists('leave_types', 'id')
                    ->where('branch_id', $branchId),
            ],

            'academic_session_id' => [
                'required',

                Rule::exists('academic_sessions', 'id')
                    ->where('branch_id', $branchId),
            ],

            'start_date' => [
                'required',
                'date',
            ],

            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],

            'reason' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);


        $startDate = \Carbon\Carbon::parse(
            $validated['start_date']
        );

        $endDate = \Carbon\Carbon::parse(
            $validated['end_date']
        );


        $totalDays = $startDate->diffInDays(
            $endDate
        ) + 1;


        $leaveApplication->update([

            'teacher_staff_id' =>
                $validated['teacher_staff_id'],

            'leave_type_id' =>
                $validated['leave_type_id'],

            'academic_session_id' =>
                $validated['academic_session_id'],

            'start_date' =>
                $validated['start_date'],

            'end_date' =>
                $validated['end_date'],

            'total_days' =>
                $totalDays,

            'reason' =>
                $validated['reason'] ?? null,
        ]);


        return redirect()
            ->route('admin.leave-applications.index')
            ->with(
                'success',
                'Leave application updated successfully.'
            );
    }


    /**
     * Delete application.
     */
    public function destroy(LeaveApplication $leaveApplication)
    {
        $this->authorizeBranch($leaveApplication);

        $leaveApplication->delete();

        return redirect()
            ->route('admin.leave-applications.index')
            ->with(
                'success',
                'Leave application deleted successfully.'
            );
    }


    /**
     * Approve application.
     */
    public function approve(LeaveApplication $leaveApplication)
    {
        $this->authorizeBranch($leaveApplication);


        if ($leaveApplication->status !== 'pending') {

            return back()->with(
                'error',
                'Only pending applications can be approved.'
            );
        }


        DB::transaction(function () use ($leaveApplication) {

            $allocation = LeaveAllocation::where(
                    'branch_id',
                    $leaveApplication->branch_id
                )
                ->where(
                    'teacher_staff_id',
                    $leaveApplication->teacher_staff_id
                )
                ->where(
                    'leave_type_id',
                    $leaveApplication->leave_type_id
                )
                ->where(
                    'academic_session_id',
                    $leaveApplication->academic_session_id
                )
                ->where(
                    'year',
                    $leaveApplication->start_date->year
                )
                ->lockForUpdate()
                ->first();


            if (!$allocation) {

                abort(
                    422,
                    'Leave allocation not found.'
                );
            }


            $remainingDays =
                $allocation->allocated_days
                - $allocation->used_days;


            if (
                $leaveApplication->total_days
                > $remainingDays
            ) {

                abort(
                    422,
                    'Insufficient leave balance.'
                );
            }


            $allocation->increment(
                'used_days',
                $leaveApplication->total_days
            );


            $leaveApplication->update([

                'status' =>
                    'approved',

                'approved_by' =>
                    auth()->id(),

                'approved_at' =>
                    now(),
            ]);
        });


        return back()->with(
            'success',
            'Leave application approved successfully.'
        );
    }


    /**
     * Reject application.
     */
    public function reject(
        Request $request,
        LeaveApplication $leaveApplication
    ) {
        $this->authorizeBranch($leaveApplication);


        if ($leaveApplication->status !== 'pending') {

            return back()->with(
                'error',
                'Only pending applications can be rejected.'
            );
        }


        $validated = $request->validate([
            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        $leaveApplication->update([

            'status' =>
                'rejected',

            'remarks' =>
                $validated['remarks'] ?? null,
        ]);


        return back()->with(
            'success',
            'Leave application rejected.'
        );
    }


    /**
     * Branch security.
     */
    private function authorizeBranch(
        LeaveApplication $leaveApplication
    ): void {

        abort_unless(
            $leaveApplication->branch_id
                === auth()->user()->branch_id,
            403
        );
    }
}