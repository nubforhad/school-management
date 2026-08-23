<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SectionController extends Controller
{
  public function index(Request $request)
    {
        $sections = Section::with([
                'branch',
                'schoolClass',
            ])
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->where('branch_id', $request->branch_id);
            })
            ->when($request->filled('class_id'), function ($query) use ($request) {
                $query->where('class_id', $request->class_id);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.academic.sections.index',
            compact(
                'sections',
                'branches',
                'classes'
            )
        );
    }

    public function create()
    {
        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->get();

        return view(
            'admin.academic.sections.create',
            compact('branches', 'classes')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => ['required', 'exists:branches,id'],
            'class_id' => ['required', 'exists:classes,id'],

            'name' => [
                'required',
                'string',
                'max:100',

                Rule::unique('sections', 'name')
                    ->where(fn ($query) =>
                        $query
                            ->where('branch_id', $request->branch_id)
                            ->where('class_id', $request->class_id)
                    ),
            ],

            'capacity' => [
                'nullable', 
                'min:1',
            ],
          

            'status' => ['nullable', 'boolean'],
        ]);

        $validated['status'] = $request->boolean('status');

        Section::create($validated);

        return redirect()
            ->route('admin.academic.sections.index')
            ->with('success', 'Section created successfully.');
    }

    public function show(Section $section)
    {
        $section->load([
            'branch',
            'schoolClass',
        ]);

        return view(
            'admin.academic.sections.show',
            compact('section')
        );
    }

    public function edit(Section $section)
    {
        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->get();

        return view(
            'admin.academic.sections.edit',
            compact(
                'section',
                'branches',
                'classes'
            )
        );
    }

    public function update(
        Request $request,
        Section $section
    ) {
        $validated = $request->validate([
            'branch_id' => ['required', 'exists:branches,id'],
            'class_id' => ['required', 'exists:classes,id'],

            'name' => [
                'required',
                'string',
                'max:100',

                Rule::unique('sections', 'name')
                    ->where(fn ($query) =>
                        $query
                            ->where('branch_id', $request->branch_id)
                            ->where('class_id', $request->class_id)
                    )
                    ->ignore($section->id),
            ],

            'capacity' => [
                'nullable', 
                'min:1',
            ],

            'status' => ['nullable', 'boolean'],
        ]);

        $validated['status'] = $request->boolean('status');

        $section->update($validated);

        return redirect()
            ->route('admin.academic.sections.index')
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()
            ->route('admin.academic.sections.index')
            ->with('success', 'Section deleted successfully.');
    }
}