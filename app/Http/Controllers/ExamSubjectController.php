<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicSession;
use App\Models\Exam;
use App\Models\ExamSubject;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ExamSubjectController extends Controller
{
    public function index(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $examSubjects = ExamSubject::with([
            'exam',
            'academicSession',
            'schoolClass',
            'section',
            'subject',
        ])
            ->where('branch_id', $branchId)

            ->when(
                $request->filled('exam_id'),
                fn ($query) =>
                    $query->where('exam_id', $request->exam_id)
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

            ->when(
                $request->filled('status'),
                fn ($query) =>
                    $query->where('status', $request->status)
            )

            ->latest()
            ->paginate(15)
            ->withQueryString();

        $exams = Exam::where('branch_id', $branchId)
            ->orderByDesc('id')
            ->get();

        $academicSessions = AcademicSession::orderByDesc('id')
            ->get();

        $schoolClasses = SchoolClass::orderBy('name')
            ->get();

        return view(
            'admin.exam-subjects.index',
            compact(
                'examSubjects',
                'exams',
                'academicSessions',
                'schoolClasses'
            )
        );
    }

    public function create()
    {
        $branchId = Auth::user()->branch_id;

        $exams = Exam::where('branch_id', $branchId)
            ->where('status', true)
            ->orderByDesc('id')
            ->get();

        $academicSessions = AcademicSession::orderByDesc('id')
            ->get();

        $schoolClasses = SchoolClass::orderBy('name')
            ->get();

        $sections = Section::orderBy('name')
            ->get();

        $subjects = Subject::orderBy('name')
            ->get();

        return view(
            'admin.exam-subjects.create',
            compact(
                'exams',
                'academicSessions',
                'schoolClasses',
                'sections',
                'subjects'
            )
        );
    }

    public function store(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $validated = $request->validate([
            'exam_id' => [
                'required',
                Rule::exists('exams', 'id')
                    ->where(function ($query) use ($branchId) {
                        $query->where('branch_id', $branchId);
                    }),
            ],

            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],

            'school_class_id' => [
                'required',
                'exists:school_classes,id',
            ],

            'section_id' => [
                'nullable',
                'exists:sections,id',
            ],

            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],

            'full_marks' => [
                'required',
                'numeric',
                'min:0',
            ],

            'pass_marks' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:full_marks',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['branch_id'] = $branchId;
        $validated['status'] = $request->boolean('status');

        $exists = ExamSubject::where('branch_id', $branchId)
            ->where('exam_id', $validated['exam_id'])
            ->where(
                'school_class_id',
                $validated['school_class_id']
            )
            ->where(
                'subject_id',
                $validated['subject_id']
            )
            ->when(
                isset($validated['section_id']),
                fn ($query) =>
                    $query->where(
                        'section_id',
                        $validated['section_id']
                    )
            )
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'subject_id' =>
                        'This subject is already assigned to this exam and class.',
                ]);
        }

        ExamSubject::create($validated);

        return redirect()
            ->route('admin.exam-subjects.index')
            ->with(
                'success',
                'Exam subject assigned successfully.'
            );
    }

    public function show(ExamSubject $examSubject)
    {
        $this->checkBranch($examSubject);

        $examSubject->load([
            'exam',
            'academicSession',
            'schoolClass',
            'section',
            'subject',
        ]);

        return view(
            'admin.exam-subjects.show',
            compact('examSubject')
        );
    }

    public function edit(ExamSubject $examSubject)
    {
        $this->checkBranch($examSubject);

        $branchId = Auth::user()->branch_id;

        $exams = Exam::where('branch_id', $branchId)
            ->where('status', true)
            ->orderByDesc('id')
            ->get();

        $academicSessions = AcademicSession::orderByDesc('id')
            ->get();

        $schoolClasses = SchoolClass::orderBy('name')
            ->get();

        $sections = Section::orderBy('name')
            ->get();

        $subjects = Subject::orderBy('name')
            ->get();

        return view(
            'admin.exam-subjects.edit',
            compact(
                'examSubject',
                'exams',
                'academicSessions',
                'schoolClasses',
                'sections',
                'subjects'
            )
        );
    }

    public function update(
        Request $request,
        ExamSubject $examSubject
    ) {
        $this->checkBranch($examSubject);

        $branchId = Auth::user()->branch_id;

        $validated = $request->validate([
            'exam_id' => [
                'required',
                Rule::exists('exams', 'id')
                    ->where(function ($query) use ($branchId) {
                        $query->where('branch_id', $branchId);
                    }),
            ],

            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],

            'school_class_id' => [
                'required',
                'exists:school_classes,id',
            ],

            'section_id' => [
                'nullable',
                'exists:sections,id',
            ],

            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],

            'full_marks' => [
                'required',
                'numeric',
                'min:0',
            ],

            'pass_marks' => [
                'nullable',
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

        $exists = ExamSubject::where('branch_id', $branchId)
            ->where('id', '!=', $examSubject->id)
            ->where('exam_id', $validated['exam_id'])
            ->where(
                'school_class_id',
                $validated['school_class_id']
            )
            ->where(
                'subject_id',
                $validated['subject_id']
            )
            ->when(
                isset($validated['section_id']),
                fn ($query) =>
                    $query->where(
                        'section_id',
                        $validated['section_id']
                    )
            )
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'subject_id' =>
                        'This subject is already assigned to this exam and class.',
                ]);
        }

        $examSubject->update($validated);

        return redirect()
            ->route('admin.exam-subjects.index')
            ->with(
                'success',
                'Exam subject updated successfully.'
            );
    }

    public function destroy(ExamSubject $examSubject)
    {
        $this->checkBranch($examSubject);

        $examSubject->delete();

        return redirect()
            ->route('admin.exam-subjects.index')
            ->with(
                'success',
                'Exam subject deleted successfully.'
            );
    }

    private function checkBranch(
        ExamSubject $examSubject
    ): void {
        abort_if(
            $examSubject->branch_id !== Auth::user()->branch_id,
            403
        );
    }
}