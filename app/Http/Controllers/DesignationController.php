<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::with('branch')
            ->where('branch_id', auth()->user()->branch_id)
            ->latest()
            ->paginate(15);

        return view('admin.designations.index', compact('designations'));
    }

    public function create()
    {
        $branches = Branch::orderBy('name')->get();

        return view('admin.designations.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        Designation::create($validated);

        return redirect()
            ->route('admin.designations.index')
            ->with('success', 'Designation created successfully.');
    }

    public function edit(Designation $designation)
    {
        abort_if(
            $designation->branch_id != auth()->user()->branch_id,
            403
        );

        $branches = Branch::orderBy('name')->get();

        return view(
            'admin.designations.edit',
            compact('designation', 'branches')
        );
    }

    public function update(Request $request, Designation $designation)
    {
        abort_if(
            $designation->branch_id != auth()->user()->branch_id,
            403
        );

        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $designation->update($validated);

        return redirect()
            ->route('admin.designations.index')
            ->with('success', 'Designation updated successfully.');
    }

    public function destroy(Designation $designation)
    {
        abort_if(
            $designation->branch_id != auth()->user()->branch_id,
            403
        );

        $designation->delete();

        return redirect()
            ->route('admin.designations.index')
            ->with('success', 'Designation deleted successfully.');
    }
}