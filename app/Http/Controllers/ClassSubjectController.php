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
    /**
     * Display class subjects.
     */
    public function index(Request $request)
    {
        $classSubjects = ClassSubject::with([
                'branch',
                'schoolClass',
                'subject',
            ])
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->where('branch_id', $request->branch_id);
            })
            ->when($request->filled('class_id'), function ($query) use ($request) {
                $query->where('class_id', $request->class_id);
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.academic.class-subjects.index',
            compact(
                'classSubjects',
                'branches',
                'classes'
            )
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

        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->orderBy('name')
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


    /**
     * Store class subject.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'class_id' => [
                'required',
                'exists:classes,id',
            ],

            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_optional' => [
                'nullable',
                'boolean',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Check Class belongs to selected Branch
        |--------------------------------------------------------------------------
        */

        $classExists = SchoolClass::where('id', $request->class_id)
            ->where('branch_id', $request->branch_id)
            ->exists();

        if (!$classExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'class_id' =>
                        'Selected class does not belong to the selected branch.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Check Subject belongs to selected Branch
        |--------------------------------------------------------------------------
        */

        $subjectExists = Subject::where('id', $request->subject_id)
            ->where('branch_id', $request->branch_id)
            ->exists();

        if (!$subjectExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'subject_id' =>
                        'Selected subject does not belong to the selected branch.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Assignment
        |--------------------------------------------------------------------------
        */

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


    /**
     * Display class subject details.
     */
    public function show(ClassSubject $classSubject)
    {
        $classSubject->load([
            'branch',
            'schoolClass',
            'subject',
        ]);

        return view(
            'admin.academic.class-subjects.show',
            compact('classSubject')
        );
    }


    /**
     * Show edit form.
     */
    public function edit(ClassSubject $classSubject)
    {
        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->orderBy('name')
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


    /**
     * Update class subject.
     */
    public function update(
        Request $request,
        ClassSubject $classSubject
    ) {
        $validated = $request->validate([
            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'class_id' => [
                'required',
                'exists:classes,id',
            ],

            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_optional' => [
                'nullable',
                'boolean',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Check Class belongs to selected Branch
        |--------------------------------------------------------------------------
        */

        $classExists = SchoolClass::where('id', $request->class_id)
            ->where('branch_id', $request->branch_id)
            ->exists();

        if (!$classExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'class_id' =>
                        'Selected class does not belong to the selected branch.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Check Subject belongs to selected Branch
        |--------------------------------------------------------------------------
        */

        $subjectExists = Subject::where('id', $request->subject_id)
            ->where('branch_id', $request->branch_id)
            ->exists();

        if (!$subjectExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'subject_id' =>
                        'Selected subject does not belong to the selected branch.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Assignment
        |--------------------------------------------------------------------------
        */

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


    /**
     * Delete class subject.
     */
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