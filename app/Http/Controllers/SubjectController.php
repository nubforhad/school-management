<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    /**
     * Display subjects.
     */
    public function index(Request $request)
    {
        $subjects = Subject::with('branch')
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->where('branch_id', $request->branch_id);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.academic.subjects.index',
            compact('subjects', 'branches')
        );
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.academic.subjects.create',
            compact('branches')
        );
    }

    /**
     * Store subject.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'name' => [
                'required',
                'string',
                'max:150',

                Rule::unique('subjects', 'name')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'branch_id',
                            $request->branch_id
                        );
                    }),
            ],

            'name_bn' => [
                'nullable',
                'string',
                'max:150',
            ],

            'code' => [
                'nullable',
                'string',
                'max:50',
            ],

            'type' => [
                'required',
                Rule::in([
                    'theory',
                    'practical',
                    'both',
                ]),
            ],

            'full_marks' => [
                'required',
                'numeric',
                'min:1',
            ],

            'pass_marks' => [
                'required',
                'numeric',
                'min:0',
                'lte:full_marks',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['status'] = $request->boolean('status');

        Subject::create($validated);

        return redirect()
            ->route('admin.academic.subjects.index')
            ->with(
                'success',
                'Subject created successfully.'
            );
    }

    /**
     * Display subject details.
     */
    public function show(Subject $subject)
    {
        $subject->load([
            'branch',
            'classSubjects.schoolClass',
        ]);

        return view(
            'admin.academic.subjects.show',
            compact('subject')
        );
    }

    /**
     * Show edit form.
     */
    public function edit(Subject $subject)
    {
        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.academic.subjects.edit',
            compact(
                'subject',
                'branches'
            )
        );
    }

    /**
     * Update subject.
     */
    public function update(
        Request $request,
        Subject $subject
    ) {
        $validated = $request->validate([
            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'name' => [
                'required',
                'string',
                'max:150',

                Rule::unique('subjects', 'name')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'branch_id',
                            $request->branch_id
                        );
                    })
                    ->ignore($subject->id),
            ],

            'name_bn' => [
                'nullable',
                'string',
                'max:150',
            ],

            'code' => [
                'nullable',
                'string',
                'max:50',
            ],

            'type' => [
                'required',
                Rule::in([
                    'theory',
                    'practical',
                    'both',
                ]),
            ],

            'full_marks' => [
                'required',
                'numeric',
                'min:1',
            ],

            'pass_marks' => [
                'required',
                'numeric',
                'min:0',
                'lte:full_marks',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['status'] = $request->boolean('status');

        $subject->update($validated);

        return redirect()
            ->route('admin.academic.subjects.index')
            ->with(
                'success',
                'Subject updated successfully.'
            );
    }

    /**
     * Delete subject.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()
            ->route('admin.academic.subjects.index')
            ->with(
                'success',
                'Subject deleted successfully.'
            );
    }
}