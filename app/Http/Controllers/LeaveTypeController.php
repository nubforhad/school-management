<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeaveTypeController extends Controller
{
    public function index(Request $request)
    {
        $branchId = auth()->user()->branch_id;
        $leaveTypes = LeaveType::where('branch_id', $branchId)
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                });
            })
            ->when(
                $request->status !== null && $request->status !== '',
                function ($query) use ($request) {
                    $query->where('status', $request->status);
                }
            )->latest()->paginate(10)->withQueryString();
        return view('admin.leave-types.index', compact('leaveTypes'));
    }

    public function create()
    {
        return view('admin.leave-types.create');
    }
    public function store(Request $request)
    {
        $branchId = auth()->user()->branch_id;
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('leave_types', 'name')
                    ->where('branch_id', $branchId),
            ],

            'code' => [
                'nullable',
                'string',
                'max:50',
            ],

            'days_per_year' => [
                'required',
                'integer',
                'min:0',
                'max:365',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);
        LeaveType::create([
            'branch_id' => $branchId,
            'name' => $validated['name'],
            'code' => $validated['code'] ?? null,
            'days_per_year' => $validated['days_per_year'],
            'description' => $validated['description'] ?? null,
            'status' => $request->boolean('status'),
        ]);
        return redirect()->route('admin.leave-types.index')->with('success', 'Leave type created successfully.');
    }

    public function edit(LeaveType $leaveType)
    {
        abort_if(
            $leaveType->branch_id !== auth()->user()->branch_id,
            403
        );
        return view('admin.leave-types.edit', compact('leaveType'));
    }

    public function update(Request $request, LeaveType $leaveType)
    {
        abort_if(
            $leaveType->branch_id !== auth()->user()->branch_id,
            403
        );

        $branchId = auth()->user()->branch_id;

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('leave_types', 'name')
                    ->where('branch_id', $branchId)
                    ->ignore($leaveType->id),
            ],
            'code' => [
                'nullable',
                'string',
                'max:50',
            ],

            'days_per_year' => [
                'required',
                'integer',
                'min:0',
                'max:365',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $leaveType->update([
            'name' => $validated['name'],
            'code' => $validated['code'] ?? null,
            'days_per_year' => $validated['days_per_year'],
            'description' => $validated['description'] ?? null,
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('admin.leave-types.index')
            ->with('success', 'Leave type updated successfully.');
    }

    public function destroy(LeaveType $leaveType)
    {
        abort_if(
            $leaveType->branch_id !== auth()->user()->branch_id,
            403
        );
        $leaveType->delete();
        return redirect()->route('admin.leave-types.index')->with('success', 'Leave type deleted successfully.');
    }
}