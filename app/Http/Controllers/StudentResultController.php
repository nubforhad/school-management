<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicSession;
use App\Models\Exam;
use App\Models\ExamMark;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentResultController extends Controller
{
    /**
     * Student Result List
     */
    public function index(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $academicSessions = AcademicSession::orderByDesc('id')->get();

        $exams = Exam::where('branch_id', $branchId)
            ->orderByDesc('id')
            ->get();

        $classes = SchoolClass::orderBy('name')->get();

        $sections = Section::orderBy('name')->get();

        $students = collect();

        $selectedExam = null;
        $selectedStudent = null;

        $result = null;

        /*
        |--------------------------------------------------------------------------
        | Search Result
        |--------------------------------------------------------------------------
        */
        if (
            $request->filled('exam_id') &&
            $request->filled('student_id')
        ) {

            $selectedExam = Exam::where('branch_id', $branchId)
                ->findOrFail($request->exam_id);

            $selectedStudent = Student::findOrFail(
                $request->student_id
            );

            /*
            |--------------------------------------------------------------------------
            | Get Student Marks
            |--------------------------------------------------------------------------
            */
            $marks = ExamMark::with([
                'subject',
                'schoolClass',
                'section',
                'examSubject',
            ])
                ->where('branch_id', $branchId)
                ->where('exam_id', $selectedExam->id)
                ->where('student_id', $selectedStudent->id)
                ->where('status', true)
                ->orderBy('subject_id')
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Calculate Result
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

                $full = (float) ($mark->full_marks ?? 0);

                $pass = $mark->pass_marks !== null
                    ? (float) $mark->pass_marks
                    : null;

                $totalMarks += $obtained;
                $totalFullMarks += $full;

                if ($pass !== null) {

                    if ($obtained >= $pass) {
                        $passedSubjects++;
                    } else {
                        $failedSubjects++;
                    }

                } else {

                    $percentage = $full > 0
                        ? ($obtained / $full) * 100
                        : 0;

                    if ($percentage >= 33) {
                        $passedSubjects++;
                    } else {
                        $failedSubjects++;
                    }
                }
            }

            $percentage = $totalFullMarks > 0
                ? ($totalMarks / $totalFullMarks) * 100
                : 0;

            /*
            |--------------------------------------------------------------------------
            | Overall Grade
            |--------------------------------------------------------------------------
            */
            [$grade, $gradePoint] = $this->calculateGrade($percentage);

            /*
            |--------------------------------------------------------------------------
            | Overall Result
            |--------------------------------------------------------------------------
            */
            $overallStatus = $failedSubjects > 0
                ? 'Fail'
                : 'Pass';

            $result = [
                'marks' => $marks,
                'total_marks' => $totalMarks,
                'total_full_marks' => $totalFullMarks,
                'percentage' => $percentage,
                'grade' => $grade,
                'grade_point' => $gradePoint,
                'passed_subjects' => $passedSubjects,
                'failed_subjects' => $failedSubjects,
                'total_subjects' => $marks->count(),
                'status' => $overallStatus,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Student Search Dropdown
        |--------------------------------------------------------------------------
        */
        if ($request->filled('class_id')) {

            $studentsQuery = Student::query();

            /*
            |--------------------------------------------------------------------------
            | If Student table has class_id
            |--------------------------------------------------------------------------
            */
            $studentsQuery->where(
                'class_id',
                $request->class_id
            );

            if ($request->filled('section_id')) {

                $studentsQuery->where(
                    'section_id',
                    $request->section_id
                );
            }

            $students = $studentsQuery
                ->orderBy('name')
                ->get();
        }

        return view(
            'admin.student-results.index',
            compact(
                'academicSessions',
                'exams',
                'classes',
                'sections',
                'students',
                'selectedExam',
                'selectedStudent',
                'result'
            )
        );
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