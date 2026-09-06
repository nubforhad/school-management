<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicSession;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ExamScheduleController extends Controller
{
    /**
     * Display exam schedules.
     */
    public function index(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $schedules = ExamSchedule::with([
            'exam',
            'academicSession',
            'schoolClass',
            'section',
            'subject',
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

            ->when($request->filled('exam_date'), function ($query) use ($request) {
                $query->whereDate(
                    'exam_date',
                    $request->exam_date
                );
            })

            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where(
                    'status',
                    $request->status
                );
            })

            ->orderBy('exam_date')
            ->orderBy('start_time')
            ->paginate(15)
            ->withQueryString();

        $exams = Exam::where('branch_id', $branchId)
            ->orderByDesc('id')
            ->get();

        $academicSessions = AcademicSession::orderByDesc('id')
            ->get();

        $schoolClasses = SchoolClass::orderBy('name')
            ->get();

        return view('admin.exam-schedules.index', compact(
            'schedules',
            'exams',
            'academicSessions',
            'schoolClasses'
        ));
    }


    /**
     * Show create form.
     */
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

        return view('admin.exam-schedules.create', compact(
            'exams',
            'academicSessions',
            'schoolClasses',
            'sections',
            'subjects'
        ));
    }


    /**
     * Store exam schedule.
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

            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],

            'exam_date' => [
                'required',
                'date',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

            'room' => [
                'nullable',
                'string',
                'max:100',
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

            'instructions' => [
                'nullable',
                'string',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['branch_id'] = $branchId;
        $validated['status'] = $request->boolean('status');

        ExamSchedule::create($validated);

        return redirect()
            ->route('admin.exam-schedules.index')
            ->with('success', 'Exam schedule created successfully.');
    }


    /**
     * Display schedule.
     */
    public function show(ExamSchedule $examSchedule)
    {
        $this->checkBranch($examSchedule);

        $examSchedule->load([
            'exam',
            'academicSession',
            'schoolClass',
            'section',
            'subject',
        ]);

        return view(
            'admin.exam-schedules.show',
            compact('examSchedule')
        );
    }


    /**
     * Show edit form.
     */
    public function edit(ExamSchedule $examSchedule)
    {
        $this->checkBranch($examSchedule);

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

        return view('admin.exam-schedules.edit', compact(
            'examSchedule',
            'exams',
            'academicSessions',
            'schoolClasses',
            'sections',
            'subjects'
        ));
    }


    /**
     * Update schedule.
     */
    public function update(
        Request $request,
        ExamSchedule $examSchedule
    ) {
        $this->checkBranch($examSchedule);

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

            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],

            'exam_date' => [
                'required',
                'date',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

            'room' => [
                'nullable',
                'string',
                'max:100',
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

            'instructions' => [
                'nullable',
                'string',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['status'] = $request->boolean('status');

        $examSchedule->update($validated);

        return redirect()
            ->route('admin.exam-schedules.index')
            ->with('success', 'Exam schedule updated successfully.');
    }


    /**
     * Delete schedule.
     */
    public function destroy(ExamSchedule $examSchedule)
    {
        $this->checkBranch($examSchedule);

        $examSchedule->delete();

        return redirect()
            ->route('admin.exam-schedules.index')
            ->with('success', 'Exam schedule deleted successfully.');
    }


    /**
     * Check branch access.
     */
    private function checkBranch(ExamSchedule $examSchedule): void
    {
        abort_if(
            $examSchedule->branch_id !== Auth::user()->branch_id,
            403
        );
    }
}