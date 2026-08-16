<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\ClassSubject;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClassSubjectController extends Controller
{
    public function index()
    {
        $classSubjects = ClassSubject::with([
                'branch',
                'schoolClass',
                'subject',
            ])
            ->latest()
            ->paginate(20);

        return view(
            'admin.academic.class-subjects.index',
            compact('classSubjects')
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

        $subjects = Subject::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.academic.class-subjects.create',
            compact(
                'branches',
                'classes',
                'subjects'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => ['required', 'exists:branches,id'],
            'class_id' => ['required', 'exists:classes,id'],
            'subject_id' => ['required', 'exists:subjects,id'],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_optional' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        $exists = ClassSubject::where('branch_id', $request->branch_id)
            ->where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'subject_id' =>
                        'This subject is already assigned to this class.'
                ]);
        }

        $validated['sort_order'] =
            $validated['sort_order'] ?? 0;

        $validated['is_optional'] =
            $request->boolean('is_optional');

        $validated['status'] =
            $request->boolean('status');

        ClassSubject::create($validated);

        return redirect()
            ->route('admin.academic.class-subjects.index')
            ->with(
                'success',
                'Subject assigned to class successfully.'
            );
    }

    public function edit(ClassSubject $classSubject)
    {
        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->get();

        $subjects = Subject::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.academic.class-subjects.edit',
            compact(
                'classSubject',
                'branches',
                'classes',
                'subjects'
            )
        );
    }

    public function update(
        Request $request,
        ClassSubject $classSubject
    ) {
        $validated = $request->validate([
            'branch_id' => ['required', 'exists:branches,id'],
            'class_id' => ['required', 'exists:classes,id'],
            'subject_id' => ['required', 'exists:subjects,id'],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_optional' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        $exists = ClassSubject::where('branch_id', $request->branch_id)
            ->where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->where('id', '!=', $classSubject->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'subject_id' =>
                        'This subject is already assigned to this class.'
                ]);
        }

        $validated['sort_order'] =
            $validated['sort_order'] ?? 0;

        $validated['is_optional'] =
            $request->boolean('is_optional');

        $validated['status'] =
            $request->boolean('status');

        $classSubject->update($validated);

        return redirect()
            ->route('admin.academic.class-subjects.index')
            ->with(
                'success',
                'Class subject updated successfully.'
            );
    }

    public function destroy(ClassSubject $classSubject)
    {
        $classSubject->delete();

        return redirect()
            ->route('admin.academic.class-subjects.index')
            ->with(
                'success',
                'Class subject deleted successfully.'
            );
    }
}