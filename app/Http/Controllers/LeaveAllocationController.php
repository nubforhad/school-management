<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LeaveAllocation;
use App\Models\LeaveType;
use App\Models\TeacherStaff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeaveAllocationController extends Controller
{
    /**
     * Display a listing of leave allocations.
     */
   public function index(Request $request)
{
    $branchId = auth()->user()->branch_id;

    $leaveAllocations = LeaveAllocation::with([
            'teacherStaff',
            'leaveType',
        ])
        ->where('branch_id', $branchId)

        ->when($request->teacher_staff_id, function ($query) use ($request) {
            $query->where(
                'teacher_staff_id',
                $request->teacher_staff_id
            );
        })

        ->when($request->leave_type_id, function ($query) use ($request) {
            $query->where(
                'leave_type_id',
                $request->leave_type_id
            );
        })

        ->when($request->year, function ($query) use ($request) {
            $query->where('year', $request->year);
        })

        ->latest()
        ->paginate(15)
        ->withQueryString();

    $teachers = TeacherStaff::where('branch_id', $branchId)
        ->orderBy('name')
        ->get();

    $leaveTypes = LeaveType::where('branch_id', $branchId)
        ->where('status', true)
        ->orderBy('name')
        ->get();

    return view(
        'admin.leave-allocations.index',
        compact(
            'leaveAllocations',
            'teachers',
            'leaveTypes'
        )
    );
}


    /**
     * Show the form for creating a new leave allocation.
     */
    public function create()
    {
        $branchId = auth()->user()->branch_id;

        $teacherStaff = TeacherStaff::where('branch_id', $branchId)
            ->orderBy('name')
            ->get();

        $leaveTypes = LeaveType::where('branch_id', $branchId)
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.leave-allocations.create',
            compact(
                'teacherStaff',
                'leaveTypes'
            )
        );
    }


    /**
     * Store a newly created leave allocation.
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

            'year' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],

            'allocated_days' => [
                'required',
                'numeric',
                'min:0',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Duplicate Allocation Check
        |--------------------------------------------------------------------------
        */

        $exists = LeaveAllocation::where([
            'branch_id' => $branchId,
            'teacher_staff_id' => $validated['teacher_staff_id'],
            'leave_type_id' => $validated['leave_type_id'],
            'year' => $validated['year'],
        ])->exists();


        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'teacher_staff_id' =>
                        'Leave allocation already exists for this employee, leave type and year.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Create Allocation
        |--------------------------------------------------------------------------
        */

        LeaveAllocation::create([

            'branch_id' =>
                $branchId,

            'teacher_staff_id' =>
                $validated['teacher_staff_id'],

            'leave_type_id' =>
                $validated['leave_type_id'],

            'year' =>
                $validated['year'],

            'allocated_days' =>
                $validated['allocated_days'],

            'used_days' =>
                0,

            'remarks' =>
                $validated['remarks'] ?? null,
        ]);


        return redirect()
            ->route('admin.leave-allocations.index')
            ->with(
                'success',
                'Leave allocation created successfully.'
            );
    }


    /**
     * Show the form for editing the specified allocation.
     */
    public function edit(LeaveAllocation $leaveAllocation)
    {
        $branchId = auth()->user()->branch_id;

        /*
        |--------------------------------------------------------------------------
        | Branch Security
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $leaveAllocation->branch_id == $branchId,
            403
        );


        $teachers = TeacherStaff::where('branch_id', $branchId)
            ->orderBy('name')
            ->get();

        $leaveTypes = LeaveType::where('branch_id', $branchId)
            ->where('status', true)
            ->orderBy('name')
            ->get();


        return view(
            'admin.leave-allocations.edit',
            compact(
                'leaveAllocation',
                'teachers',
                'leaveTypes'
            )
        );
    }


    /**
     * Update the specified leave allocation.
     */
    public function update(
        Request $request,
        LeaveAllocation $leaveAllocation
    ) {
        $branchId = auth()->user()->branch_id;


        /*
        |--------------------------------------------------------------------------
        | Branch Security
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $leaveAllocation->branch_id == $branchId,
            403
        );


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

            'year' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],

            'allocated_days' => [
                'required',
                'numeric',
                'min:0',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Used Days Protection
        |--------------------------------------------------------------------------
        |
        | Allocated days cannot be less than already used days.
        |
        */

        if (
            $validated['allocated_days']
            < $leaveAllocation->used_days
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'allocated_days' =>
                        'Allocated days cannot be less than used days (' .
                        $leaveAllocation->used_days .
                        ').',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Duplicate Check
        |--------------------------------------------------------------------------
        */

        $exists = LeaveAllocation::where([
            'branch_id' => $branchId,
            'teacher_staff_id' =>
                $validated['teacher_staff_id'],
            'leave_type_id' =>
                $validated['leave_type_id'],
            'year' =>
                $validated['year'],
        ])
        ->where('id', '!=', $leaveAllocation->id)
        ->exists();


        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'teacher_staff_id' =>
                        'Leave allocation already exists for this employee, leave type and year.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $leaveAllocation->update([

            'teacher_staff_id' =>
                $validated['teacher_staff_id'],

            'leave_type_id' =>
                $validated['leave_type_id'],

            'year' =>
                $validated['year'],

            'allocated_days' =>
                $validated['allocated_days'],

            'remarks' =>
                $validated['remarks'] ?? null,
        ]);


        return redirect()
            ->route('admin.leave-allocations.index')
            ->with(
                'success',
                'Leave allocation updated successfully.'
            );
    }


    /**
     * Remove the specified leave allocation.
     */
    public function destroy(
        LeaveAllocation $leaveAllocation
    ) {
        $branchId = auth()->user()->branch_id;


        /*
        |--------------------------------------------------------------------------
        | Branch Security
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $leaveAllocation->branch_id == $branchId,
            403
        );


        /*
        |--------------------------------------------------------------------------
        | Prevent Delete If Leave Already Used
        |--------------------------------------------------------------------------
        */

        if ($leaveAllocation->used_days > 0) {
            return back()->withErrors([
                'delete' =>
                    'This leave allocation cannot be deleted because leave days have already been used.',
            ]);
        }


        $leaveAllocation->delete();


        return redirect()
            ->route('admin.leave-allocations.index')
            ->with(
                'success',
                'Leave allocation deleted successfully.'
            );
    }
}
