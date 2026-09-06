<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamMark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultSheetController extends Controller
{
    /**
     * Show Result Sheet
     */
    public function show(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $exams = Exam::where('branch_id', $branchId)
            ->orderByDesc('id')
            ->get();

        $result = null;

        $selectedExam = null;

        if (
            $request->filled('exam_id') &&
            $request->filled('student_id')
        ) {

            /*
            |--------------------------------------------------------------------------
            | Exam
            |--------------------------------------------------------------------------
            */
            $selectedExam = Exam::where('branch_id', $branchId)
                ->findOrFail($request->exam_id);


            /*
            |--------------------------------------------------------------------------
            | Student Marks
            |--------------------------------------------------------------------------
            */
            $marks = ExamMark::with([
                'student',
                'subject',
                'schoolClass',
                'section',
                'academicSession',
            ])
                ->where('branch_id', $branchId)
                ->where('exam_id', $selectedExam->id)
                ->where('student_id', $request->student_id)
                ->where('status', true)
                ->orderBy('subject_id')
                ->get();


            if ($marks->isEmpty()) {
                return redirect()
                    ->route('admin.result-sheets.show')
                    ->with('error', 'No marks found for this student.');
            }


            /*
            |--------------------------------------------------------------------------
            | Student
            |--------------------------------------------------------------------------
            */
            $student = $marks->first()->student;


            /*
            |--------------------------------------------------------------------------
            | Calculate Total
            |--------------------------------------------------------------------------
            */
            $totalMarks = 0;
            $totalFullMarks = 0;

            $passedSubjects = 0;
            $failedSubjects = 0;

            foreach ($marks as $mark) {

                $obtained = $mark->marks !== null
                    ? (float) $mark->marks
                    : 0;

                $fullMarks = (float) (
                    $mark->full_marks ?? 0
                );

                $passMarks = $mark->pass_marks !== null
                    ? (float) $mark->pass_marks
                    : null;

                $totalMarks += $obtained;
                $totalFullMarks += $fullMarks;


                /*
                |--------------------------------------------------------------------------
                | Pass / Fail
                |--------------------------------------------------------------------------
                */
                if ($passMarks !== null) {

                    if ($obtained >= $passMarks) {
                        $passedSubjects++;
                    } else {
                        $failedSubjects++;
                    }

                } else {

                    $percentage = $fullMarks > 0
                        ? ($obtained / $fullMarks) * 100
                        : 0;

                    if ($percentage >= 33) {
                        $passedSubjects++;
                    } else {
                        $failedSubjects++;
                    }
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Percentage
            |--------------------------------------------------------------------------
            */
            $percentage = $totalFullMarks > 0
                ? ($totalMarks / $totalFullMarks) * 100
                : 0;


            /*
            |--------------------------------------------------------------------------
            | Overall Grade
            |--------------------------------------------------------------------------
            */
            [$grade, $gradePoint] =
                $this->calculateGrade($percentage);


            /*
            |--------------------------------------------------------------------------
            | Overall Result
            |--------------------------------------------------------------------------
            */
            $status = $failedSubjects > 0
                ? 'Fail'
                : 'Pass';


            /*
            |--------------------------------------------------------------------------
            | Position
            |--------------------------------------------------------------------------
            */
            $position = $this->calculatePosition(
                $branchId,
                $selectedExam->id,
                $marks->first()->school_class_id,
                $marks->first()->section_id,
                $student->id,
                $totalMarks
            );


            $result = [
                'student' => $student,

                'marks' => $marks,

                'exam' => $selectedExam,

                'academic_session' =>
                    $marks->first()->academicSession,

                'school_class' =>
                    $marks->first()->schoolClass,

                'section' =>
                    $marks->first()->section,

                'total_marks' => $totalMarks,

                'total_full_marks' => $totalFullMarks,

                'percentage' => $percentage,

                'grade' => $grade,

                'grade_point' => $gradePoint,

                'passed_subjects' => $passedSubjects,

                'failed_subjects' => $failedSubjects,

                'total_subjects' => $marks->count(),

                'status' => $status,

                'position' => $position,
            ];
        }


        return view(
            'admin.result-sheets.show',
            compact(
                'exams',
                'result'
            )
        );
    }


    /**
     * Calculate Position
     */
    private function calculatePosition(
        $branchId,
        $examId,
        $classId,
        $sectionId,
        $studentId,
        $studentTotal
    ) {
        $query = ExamMark::query()
            ->where('branch_id', $branchId)
            ->where('exam_id', $examId)
            ->where('school_class_id', $classId)
            ->where('status', true);

        if ($sectionId) {
            $query->where('section_id', $sectionId);
        }


        $studentTotals = $query
            ->selectRaw(
                'student_id, SUM(COALESCE(marks, 0)) as total_marks'
            )
            ->groupBy('student_id')
            ->orderByDesc('total_marks')
            ->get();


        $position = 1;

        foreach ($studentTotals as $item) {

            if (
                (int) $item->student_id ===
                (int) $studentId
            ) {
                return $position;
            }

            $position++;
        }


        return null;
    }


    /**
     * Calculate Grade
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