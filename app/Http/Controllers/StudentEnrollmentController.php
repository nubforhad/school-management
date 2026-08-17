<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Branch;
use App\Models\Section;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentEnrollment;
use Illuminate\Http\Request;

class StudentEnrollmentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Enrollment History
    |--------------------------------------------------------------------------
    */

    public function index(Student $student)
    {
        $student->load([
            'branch',
        ]);

        $enrollments = StudentEnrollment::with([
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ])
            ->where('student_id', $student->id)
            ->latest()
            ->get();

        return view(
            'admin.students.enrollments.index',
            compact(
                'student',
                'enrollments'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Create New Enrollment
    |--------------------------------------------------------------------------
    */

    public function create(Student $student)
    {
        /*
        | Current active enrollment
        */

        $currentEnrollment = StudentEnrollment::with([
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ])
            ->where('student_id', $student->id)
            ->where('status', 'active')
            ->latest()
            ->first();


        /*
        | Branch
        */

        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();


        /*
        | Academic Sessions
        */

        $academicSessions = AcademicSession::where('status', true)
            ->orderByDesc('id')
            ->get();


        /*
        | Classes
        */

        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->get();


        /*
        | Sections
        */

        $sections = Section::where('status', true)
            ->orderBy('name')
            ->get();


        return view(
            'admin.students.enrollments.create',
            compact(
                'student',
                'currentEnrollment',
                'branches',
                'academicSessions',
                'classes',
                'sections'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store New Enrollment
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        Student $student
    ) {

        $validated = $request->validate([

            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],

            'class_id' => [
                'required',
                'exists:classes,id',
            ],

            'section_id' => [
                'nullable',
                'exists:sections,id',
            ],

            'roll_no' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'admission_date' => [
                'nullable',
                'date',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Current Active Enrollment
        |--------------------------------------------------------------------------
        */

        $currentEnrollment = StudentEnrollment::where(
            'student_id',
            $student->id
        )
            ->where('status', 'active')
            ->latest()
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Same Enrollment Check
        |--------------------------------------------------------------------------
        */

        $alreadyExists = StudentEnrollment::where(
            'student_id',
            $student->id
        )
            ->where(
                'academic_session_id',
                $validated['academic_session_id']
            )
            ->where(
                'branch_id',
                $validated['branch_id']
            )
            ->where(
                'class_id',
                $validated['class_id']
            )
            ->exists();

        if ($alreadyExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'class_id' =>
                        'This student is already enrolled in this class for the selected academic session.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Section Validation
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['section_id'])) {

            $sectionValid = Section::where(
                'id',
                $validated['section_id']
            )
                ->where(
                    'branch_id',
                    $validated['branch_id']
                )
                ->where(
                    'class_id',
                    $validated['class_id']
                )
                ->exists();

            if (!$sectionValid) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'section_id' =>
                            'Selected section does not belong to this branch/class.'
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Previous Enrollment Complete
        |--------------------------------------------------------------------------
        */

        if ($currentEnrollment) {

            $currentEnrollment->update([
                'status' => 'completed',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Create New Enrollment
        |--------------------------------------------------------------------------
        */

        StudentEnrollment::create([

            'branch_id' =>
                $validated['branch_id'],

            'student_id' =>
                $student->id,

            'academic_session_id' =>
                $validated['academic_session_id'],

            'class_id' =>
                $validated['class_id'],

            'section_id' =>
                $validated['section_id'] ?? null,

            'roll_no' =>
                $validated['roll_no'] ?? null,

            'admission_date' =>
                $validated['admission_date'] ?? now()->toDateString(),

            'status' =>
                'active',

            'remarks' =>
                $validated['remarks'] ?? null,
        ]);


        return redirect()
            ->route(
                'admin.students.enrollments.index',
                $student
            )
            ->with(
                'success',
                'Student enrolled/promoted successfully.'
            );
    }
}