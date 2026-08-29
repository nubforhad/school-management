<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamMark;
use App\Models\ExamSchedule;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamMarkController extends Controller
{
    /**
     * Marks Entry Page
     */
    public function index(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        if (!$branchId) {
            abort(403, 'Your account is not assigned to any branch.');
        }

        $exams = Exam::where('branch_id', $branchId)
            ->latest()
            ->get();

        $classes = SchoolClass::where('branch_id', $branchId)
            ->orderBy('name')
            ->get();

        $sections = collect();
        $subjects = collect();
        $students = collect();
        $schedule = null;
        $marks = collect();

        /*
        |--------------------------------------------------------------------------
        | Load Schedule
        |--------------------------------------------------------------------------
        */

        if ($request->filled('exam_id') && $request->filled('class_id') && $request->filled('section_id') && $request->filled('subject_id')) {

            $schedule = ExamSchedule::where('branch_id', $branchId)
                ->where('exam_id', $request->exam_id)
                ->where('school_class_id', $request->class_id)
                ->where('section_id', $request->section_id)
                ->where('subject_id', $request->subject_id)
                ->first();

            if ($schedule) {

                $students = Student::where('branch_id', $branchId)
                    ->whereHas('enrollments', function ($query) use ($request) {

                        $query->where('school_class_id', $request->class_id)
                            ->where('section_id', $request->section_id)
                            ->where('status', 'active');

                    })
                    ->orderBy('name')
                    ->get();

                $marks = ExamMark::where(
                    'exam_schedule_id',
                    $schedule->id
                )
                    ->whereIn(
                        'student_id',
                        $students->pluck('id')
                    )
                    ->get()
                    ->keyBy('student_id');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Sections
        |--------------------------------------------------------------------------
        */

        if ($request->filled('class_id')) {

            $sections = Section::where(
                'school_class_id',
                $request->class_id
            )
                ->where('branch_id', $branchId)
                ->orderBy('name')
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | Subjects
        |--------------------------------------------------------------------------
        */

        if ($request->filled('class_id')) {

            $subjects = Subject::where('branch_id', $branchId)
                ->whereHas('classSubjects', function ($query) use ($request) {

                    $query->where(
                        'school_class_id',
                        $request->class_id
                    );
                })
                ->orderBy('name')
                ->get();
        }

        return view(
            'admin.exam-marks.index',
            compact(
                'exams',
                'classes',
                'sections',
                'subjects',
                'students',
                'schedule',
                'marks'
            )
        );
    }


    /**
     * Store Marks
     */
    public function store(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        if (!$branchId) {
            abort(403, 'Your account is not assigned to any branch.');
        }

        $validated = $request->validate([

            'exam_schedule_id' => [
                'required',
                'exists:exam_schedules,id',
            ],

            'marks' => [
                'required',
                'array',
            ],

            'marks.*.student_id' => [
                'required',
                'exists:students,id',
            ],

            'marks.*.written_marks' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'marks.*.mcq_marks' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'marks.*.practical_marks' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'marks.*.remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $schedule = ExamSchedule::where('id', $validated['exam_schedule_id'])
            ->where('branch_id', $branchId)
            ->firstOrFail();

        DB::transaction(function () use (
            $validated,
            $schedule,
            $branchId
        ) {

            foreach ($validated['marks'] as $markData) {

                /*
                |--------------------------------------------------------------------------
                | Get Student
                |--------------------------------------------------------------------------
                */

                $student = Student::where('id', $markData['student_id'])
                    ->where('branch_id', $branchId)
                    ->first();

                if (!$student) {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Marks
                |--------------------------------------------------------------------------
                */

                $written = (float) (
                    $markData['written_marks'] ?? 0
                );

                $mcq = (float) (
                    $markData['mcq_marks'] ?? 0
                );

                $practical = (float) (
                    $markData['practical_marks'] ?? 0
                );

                $total = $written + $mcq + $practical;

                /*
                |--------------------------------------------------------------------------
                | Full Marks
                |--------------------------------------------------------------------------
                */

                $writtenFull = (float) (
                    $schedule->written_marks ?? 0
                );

                $mcqFull = (float) (
                    $schedule->mcq_marks ?? 0
                );

                $practicalFull = (float) (
                    $schedule->practical_marks ?? 0
                );

                $fullMarks =
                    $writtenFull +
                    $mcqFull +
                    $practicalFull;

                /*
                |--------------------------------------------------------------------------
                | Percentage
                |--------------------------------------------------------------------------
                */

                $percentage = $fullMarks > 0
                    ? ($total / $fullMarks) * 100
                    : 0;

                /*
                |--------------------------------------------------------------------------
                | Grade
                |--------------------------------------------------------------------------
                */

                [$grade, $gradePoint] =
                    $this->calculateGrade($percentage);

                /*
                |--------------------------------------------------------------------------
                | Result Status
                |--------------------------------------------------------------------------
                */

                $resultStatus =
                    $percentage >= 33
                        ? 'pass'
                        : 'fail';

                /*
                |--------------------------------------------------------------------------
                | Save / Update
                |--------------------------------------------------------------------------
                */

                ExamMark::updateOrCreate(

                    [
                        'exam_schedule_id' =>
                            $schedule->id,

                        'student_id' =>
                            $student->id,
                    ],

                    [

                        'branch_id' =>
                            $branchId,

                        'academic_session_id' =>
                            $schedule->academic_session_id,

                        'exam_id' =>
                            $schedule->exam_id,

                        'school_class_id' =>
                            $schedule->school_class_id,

                        'section_id' =>
                            $schedule->section_id,

                        'subject_id' =>
                            $schedule->subject_id,

                        'written_marks' =>
                            $written,

                        'mcq_marks' =>
                            $mcq,

                        'practical_marks' =>
                            $practical,

                        'total_marks' =>
                            $total,

                        'percentage' =>
                            round($percentage, 2),

                        'grade' =>
                            $grade,

                        'grade_point' =>
                            $gradePoint,

                        'result_status' =>
                            $resultStatus,

                        'remarks' =>
                            $markData['remarks'] ?? null,
                    ]
                );
            }
        });

        return redirect()
            ->route('admin.exam-marks.index', [
                'exam_id' =>
                    $schedule->exam_id,

                'class_id' =>
                    $schedule->school_class_id,

                'section_id' =>
                    $schedule->section_id,

                'subject_id' =>
                    $schedule->subject_id,
            ])
            ->with(
                'success',
                'Exam marks saved successfully.'
            );
    }


    /**
     * Grade Calculation
     */
    private function calculateGrade(float $percentage): array
    {
        if ($percentage >= 80) {
            return ['A+', 5.00];
        }

        if ($percentage >= 70) {
            return ['A', 4.00];
        }

        if ($percentage >= 60) {
            return ['A-', 3.50];
        }

        if ($percentage >= 50) {
            return ['B', 3.00];
        }

        if ($percentage >= 40) {
            return ['C', 2.00];
        }

        if ($percentage >= 33) {
            return ['D', 1.00];
        }

        return ['F', 0.00];
    }
}