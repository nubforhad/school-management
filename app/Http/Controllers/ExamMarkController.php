<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicSession;
use App\Models\Exam;
use App\Models\ExamMark;
use App\Models\ExamSubject;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ExamMarkController extends Controller
{
    /**
     * Display marks list.
     */
    public function index(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $examMarks = ExamMark::with([
            'exam',
            'academicSession',
            'schoolClass',
            'section',
            'student',
            'subject',
            'examSubject',
        ])
            ->where('branch_id', $branchId)

            ->when($request->filled('exam_id'), function ($query) use ($request) {
                $query->where('exam_id', $request->exam_id);
            })

            ->when($request->filled('academic_session_id'), function ($query) use ($request) {
                $query->where(
                    'academic_session_id',
                    $request->academic_session_id
                );
            })

            ->when($request->filled('school_class_id'), function ($query) use ($request) {
                $query->where(
                    'school_class_id',
                    $request->school_class_id
                );
            })

            ->when($request->filled('section_id'), function ($query) use ($request) {
                $query->where(
                    'section_id',
                    $request->section_id
                );
            })

            ->when($request->filled('subject_id'), function ($query) use ($request) {
                $query->where(
                    'subject_id',
                    $request->subject_id
                );
            })

            ->when($request->filled('student_id'), function ($query) use ($request) {
                $query->where(
                    'student_id',
                    $request->student_id
                );
            })

            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where(
                    'status',
                    $request->status
                );
            })

            ->latest()
            ->paginate(20)
            ->withQueryString();

        $exams = Exam::where('branch_id', $branchId)
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

        $students = Student::orderBy('id', 'desc')
            ->get();

        return view(
            'admin.exam-marks.index',
            compact(
                'examMarks',
                'exams',
                'academicSessions',
                'schoolClasses',
                'sections',
                'subjects',
                'students'
            )
        );
    }

    /**
     * Show form for entering marks.
     */
    public function create(Request $request)
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

        $students = Student::orderBy('id', 'desc')
            ->get();

        $examSubjects = ExamSubject::with([
            'exam',
            'schoolClass',
            'section',
            'subject',
        ])
            ->where('branch_id', $branchId)
            ->where('status', true)
            ->latest()
            ->get();

        return view(
            'admin.exam-marks.create',
            compact(
                'exams',
                'academicSessions',
                'schoolClasses',
                'sections',
                'subjects',
                'students',
                'examSubjects'
            )
        );
    }

    /**
     * Store marks.
     */
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
                'exists:classes,id',
            ],

            'section_id' => [
                'nullable',
                'exists:sections,id',
            ],

            'student_id' => [
                'required',
                'exists:students,id',
            ],

            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],

            'exam_subject_id' => [
                'nullable',
                Rule::exists('exam_subjects', 'id')
                    ->where(function ($query) use ($branchId) {
                        $query->where('branch_id', $branchId);
                    }),
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

            'obtained_marks' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:full_marks',
            ],

            'grade' => [
                'nullable',
                'string',
                'max:20',
            ],

            'grade_point' => [
                'nullable',
                'numeric',
                'min:0',
                'max:10',
            ],

            'remarks' => [
                'nullable',
                'string',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Prevent duplicate marks
        |--------------------------------------------------------------------------
        */

        $exists = ExamMark::where('branch_id', $branchId)
            ->where('exam_id', $validated['exam_id'])
            ->where('student_id', $validated['student_id'])
            ->where('subject_id', $validated['subject_id'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'Marks already exist for this student, exam and subject.',
                ]);
        }

        $validated['branch_id'] = $branchId;

        $validated['status'] = $request->boolean('status');

        ExamMark::create($validated);

        return redirect()
            ->route('admin.exam-marks.index')
            ->with(
                'success',
                'Exam marks entered successfully.'
            );
    }

    /**
     * Display a specific mark.
     */
    public function show(ExamMark $examMark)
    {
        $this->checkBranch($examMark);

        $examMark->load([
            'exam',
            'academicSession',
            'schoolClass',
            'section',
            'student',
            'subject',
            'examSubject',
        ]);

        return view(
            'admin.exam-marks.show',
            compact('examMark')
        );
    }

    /**
     * Show edit form.
     */
    public function edit(ExamMark $examMark)
    {
        $this->checkBranch($examMark);

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

        $students = Student::orderBy('id', 'desc')
            ->get();

        $examSubjects = ExamSubject::with([
            'exam',
            'schoolClass',
            'section',
            'subject',
        ])
            ->where('branch_id', $branchId)
            ->where('status', true)
            ->latest()
            ->get();

        return view(
            'admin.exam-marks.edit',
            compact(
                'examMark',
                'exams',
                'academicSessions',
                'schoolClasses',
                'sections',
                'subjects',
                'students',
                'examSubjects'
            )
        );
    }

    /**
     * Update marks.
     */
    public function update(
        Request $request,
        ExamMark $examMark
    ) {
        $this->checkBranch($examMark);

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
                'exists:classes,id',
            ],

            'section_id' => [
                'nullable',
                'exists:sections,id',
            ],

            'student_id' => [
                'required',
                'exists:students,id',
            ],

            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],

            'exam_subject_id' => [
                'nullable',
                Rule::exists('exam_subjects', 'id')
                    ->where(function ($query) use ($branchId) {
                        $query->where('branch_id', $branchId);
                    }),
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

            'obtained_marks' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:full_marks',
            ],

            'grade' => [
                'nullable',
                'string',
                'max:20',
            ],

            'grade_point' => [
                'nullable',
                'numeric',
                'min:0',
                'max:10',
            ],

            'remarks' => [
                'nullable',
                'string',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Prevent duplicate marks on another record
        |--------------------------------------------------------------------------
        */

        $exists = ExamMark::where('branch_id', $branchId)
            ->where('id', '!=', $examMark->id)
            ->where('exam_id', $validated['exam_id'])
            ->where('student_id', $validated['student_id'])
            ->where('subject_id', $validated['subject_id'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'Marks already exist for this student, exam and subject.',
                ]);
        }

        $validated['status'] = $request->boolean('status');

        $examMark->update($validated);

        return redirect()
            ->route('admin.exam-marks.index')
            ->with(
                'success',
                'Exam marks updated successfully.'
            );
    }

    /**
     * Delete marks.
     */
    public function destroy(ExamMark $examMark)
    {
        $this->checkBranch($examMark);

        $examMark->delete();

        return redirect()
            ->route('admin.exam-marks.index')
            ->with(
                'success',
                'Exam marks deleted successfully.'
            );
    }

    /**
     * Branch security check.
     */
    private function checkBranch(
        ExamMark $examMark
    ): void {
        abort_if(
            $examMark->branch_id !== Auth::user()->branch_id,
            403
        );
    }
}