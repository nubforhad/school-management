<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SchoolClassController extends Controller
{
    public function index(Request $request)
    {
        $classes = SchoolClass::with('branch')
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->where('branch_id', $request->branch_id);
            })
            ->orderBy('numeric_order')
            ->paginate(15)
            ->withQueryString();

        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.academic.classes.index',
            compact('classes', 'branches')
        );
    }

    public function create()
    {
        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.academic.classes.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => ['required', 'exists:branches,id'],

            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('classes', 'name')
                    ->where(fn ($query) =>
                        $query->where('branch_id', $request->branch_id)
                    ),
            ],

            'numeric_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['numeric_order'] = $validated['numeric_order'] ?? 0;
        $validated['status'] = $request->boolean('status');

        SchoolClass::create($validated);

        return redirect()
            ->route('admin.academic.classes.index')
            ->with('success', 'Class created successfully.');
    }

    public function show(SchoolClass $class)
    {
        $class->load([
            'branch',
            'sections',
        ]);

        return view(
            'admin.academic.classes.show',
            compact('class')
        );
    }

    public function edit(SchoolClass $class)
    {
        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.academic.classes.edit',
            compact('class', 'branches')
        );
    }

    public function update(
        Request $request,
        SchoolClass $class
    ) {
        $validated = $request->validate([
            'branch_id' => ['required', 'exists:branches,id'],

            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('classes', 'name')
                    ->where(fn ($query) =>
                        $query->where('branch_id', $request->branch_id)
                    )
                    ->ignore($class->id),
            ],

            'numeric_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['numeric_order'] = $validated['numeric_order'] ?? 0;
        $validated['status'] = $request->boolean('status');

        $class->update($validated);

        return redirect()
            ->route('admin.academic.classes.index')
            ->with('success', 'Class updated successfully.');
    }

    public function destroy(SchoolClass $class)
    {
        $class->delete();

        return redirect()
            ->route('admin.academic.classes.index')
            ->with('success', 'Class deleted successfully.');
    }
}