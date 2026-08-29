<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Branch;
use App\Models\Exam;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ExamSchedule;

class ExamController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $user = auth()->user();

        $exams = Exam::with([
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ])
        ->when(
            $user->branch_id,
            fn ($query) =>
                $query->where(
                    'branch_id',
                    $user->branch_id
                )
        )
        ->when(
            $request->filled('search'),
            function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                });
            }
        )
        ->when(
            $request->filled('academic_session_id'),
            fn ($query) =>
                $query->where(
                    'academic_session_id',
                    $request->academic_session_id
                )
        )
        ->when(
            $request->filled('school_class_id'),
            fn ($query) =>
                $query->where(
                    'school_class_id',
                    $request->school_class_id
                )
        )
        ->latest()
        ->paginate(15)
        ->withQueryString();

        $academicSessions = AcademicSession::orderBy(
            'name'
        )->get();

        $classes = SchoolClass::orderBy(
            'name'
        )->get();

        return view(
            'admin.exams.index',
            compact(
                'exams',
                'academicSessions',
                'classes'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $user = auth()->user();

        $branches = Branch::query()
            ->when(
                $user->branch_id,
                fn ($query) =>
                    $query->where(
                        'id',
                        $user->branch_id
                    )
            )
            ->orderBy('name')
            ->get();

        $academicSessions = AcademicSession::orderBy(
            'name'
        )->get();

        $classes = SchoolClass::orderBy(
            'name'
        )->get();

        $sections = Section::orderBy(
            'name'
        )->get();

        return view(
            'admin.exams.create',
            compact(
                'branches',
                'academicSessions',
                'classes',
                'sections'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],

            'school_class_id' => [
                'required',
                'exists:classes,id',
            ],

            'section_id' => [
                'nullable',
                'exists:sections,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'code' => [
                'nullable',
                'string',
                'max:100',
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'published',
                    'completed',
                ]),
            ],
        ]);

        if ($user->branch_id) {
            $validated['branch_id'] = $user->branch_id;
        }

        Exam::create($validated);

        return redirect()
            ->route('admin.exams.index')
            ->with(
                'success',
                'Exam created successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Exam $exam)
    {
        $this->authorizeBranch($exam);

        $exam->load([
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ]);

        return view(
            'admin.exams.show',
            compact('exam')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Exam $exam)
    {
        $this->authorizeBranch($exam);

        $user = auth()->user();

        $branches = Branch::query()
            ->when(
                $user->branch_id,
                fn ($query) =>
                    $query->where(
                        'id',
                        $user->branch_id
                    )
            )
            ->orderBy('name')
            ->get();

        $academicSessions = AcademicSession::orderBy(
            'name'
        )->get();

        $classes = SchoolClass::orderBy(
            'name'
        )->get();

        $sections = Section::orderBy(
            'name'
        )->get();

        return view(
            'admin.exams.edit',
            compact(
                'exam',
                'branches',
                'academicSessions',
                'classes',
                'sections'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Exam $exam
    ) {
        $this->authorizeBranch($exam);

        $user = auth()->user();

        $validated = $request->validate([
            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],

            'school_class_id' => [
                'required',
                'exists:classes,id',
            ],

            'section_id' => [
                'nullable',
                'exists:sections,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'code' => [
                'nullable',
                'string',
                'max:100',
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'published',
                    'completed',
                ]),
            ],
        ]);

        if ($user->branch_id) {
            $validated['branch_id'] = $user->branch_id;
        }

        $exam->update($validated);

        return redirect()
            ->route('admin.exams.index')
            ->with(
                'success',
                'Exam updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(Exam $exam)
    {
        $this->authorizeBranch($exam);

        $exam->delete();

        return redirect()
            ->route('admin.exams.index')
            ->with(
                'success',
                'Exam deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | BRANCH ACCESS
    |--------------------------------------------------------------------------
    */

    private function authorizeBranch(Exam $exam): void
    {
        $user = auth()->user();

        if (
            $user->branch_id &&
            $exam->branch_id != $user->branch_id
        ) {
            abort(403);
        }
    }
}