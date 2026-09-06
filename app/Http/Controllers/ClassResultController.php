<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicSession;
use App\Models\Exam;
use App\Models\ExamMark;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassResultController extends Controller
{
    /**
     * Class Result
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

        $results = collect();

        $selectedExam = null;
        $selectedClass = null;
        $selectedSection = null;

        if (
            $request->filled('exam_id') &&
            $request->filled('class_id')
        ) {

            /*
            |--------------------------------------------------------------------------
            | Selected Exam
            |--------------------------------------------------------------------------
            */
            $selectedExam = Exam::where('branch_id', $branchId)
                ->findOrFail($request->exam_id);

            /*
            |--------------------------------------------------------------------------
            | Selected Class
            |--------------------------------------------------------------------------
            */
            $selectedClass = SchoolClass::findOrFail(
                $request->class_id
            );

            /*
            |--------------------------------------------------------------------------
            | Selected Section
            |--------------------------------------------------------------------------
            */
            if ($request->filled('section_id')) {

                $selectedSection = Section::find(
                    $request->section_id
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Get Marks
            |--------------------------------------------------------------------------
            */
            $marksQuery = ExamMark::with([
                'student',
                'subject',
                'section',
            ])
                ->where('branch_id', $branchId)
                ->where('exam_id', $selectedExam->id)
                ->where('school_class_id', $selectedClass->id)
                ->where('status', true);

            if ($request->filled('section_id')) {

                $marksQuery->where(
                    'section_id',
                    $request->section_id
                );
            }

            $allMarks = $marksQuery
                ->orderBy('student_id')
                ->get();


            /*
            |--------------------------------------------------------------------------
            | Group Student-wise
            |--------------------------------------------------------------------------
            */
            $studentGroups = $allMarks->groupBy('student_id');


            foreach ($studentGroups as $studentId => $studentMarks) {

                $student = $studentMarks->first()->student;

                $totalMarks = 0;
                $totalFullMarks = 0;

                $passedSubjects = 0;
                $failedSubjects = 0;

                foreach ($studentMarks as $mark) {

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
                    | Subject Pass / Fail
                    |--------------------------------------------------------------------------
                    */
                    if ($passMarks !== null) {

                        if ($obtained >= $passMarks) {
                            $passedSubjects++;
                        } else {
                            $failedSubjects++;
                        }

                    } else {

                        $subjectPercentage = $fullMarks > 0
                            ? ($obtained / $fullMarks) * 100
                            : 0;

                        if ($subjectPercentage >= 33) {
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
                | Grade
                |--------------------------------------------------------------------------
                */
                [$grade, $gradePoint] =
                    $this->calculateGrade($percentage);


                /*
                |--------------------------------------------------------------------------
                | Overall Status
                |--------------------------------------------------------------------------
                */
                $status = $failedSubjects > 0
                    ? 'Fail'
                    : 'Pass';


                $results->push([
                    'student_id' => $studentId,
                    'student' => $student,
                    'section' => $studentMarks->first()->section,
                    'total_marks' => $totalMarks,
                    'total_full_marks' => $totalFullMarks,
                    'percentage' => $percentage,
                    'grade' => $grade,
                    'grade_point' => $gradePoint,
                    'total_subjects' => $studentMarks->count(),
                    'passed_subjects' => $passedSubjects,
                    'failed_subjects' => $failedSubjects,
                    'status' => $status,
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Sort by Total Marks
            |--------------------------------------------------------------------------
            */
            $results = $results
                ->sortByDesc('total_marks')
                ->values();


            /*
            |--------------------------------------------------------------------------
            | Position
            |--------------------------------------------------------------------------
            */
            $position = 0;
            $lastMarks = null;
            $sameRankCount = 0;

            foreach ($results as $index => $result) {
                if ($lastMarks === null) {
                    $position = 1;
                    $sameRankCount = 1;

                } elseif (
                    $result['total_marks'] == $lastMarks
                ) {
                    $sameRankCount++;
                } else {

                    $position += $sameRankCount;
                    $sameRankCount = 1;
                }

                $results[$index]['position'] = $position;

                $lastMarks = $result['total_marks'];
            }
        }


        return view(
            'admin.class-results.index',
            compact(
                'academicSessions',
                'exams',
                'classes',
                'sections',
                'results',
                'selectedExam',
                'selectedClass',
                'selectedSection'
            )
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