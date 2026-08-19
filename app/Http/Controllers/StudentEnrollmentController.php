<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Branch;
use App\Models\Section;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentEnrollmentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    | Student Enrollment History
    |--------------------------------------------------------------------------
    */

    public function index(Student $student)
    {
        $student->load([
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ]);


        $enrollments = StudentEnrollment::with([
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ])
            ->where('student_id', $student->id)
            ->latest('enrollment_date')
            ->latest('id')
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
    | CREATE
    |--------------------------------------------------------------------------
    | New Enrollment / Promotion
    |--------------------------------------------------------------------------
    */

    public function create(Student $student)
    {
        $student->load([
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Current Active Enrollment
        |--------------------------------------------------------------------------
        */

        $currentEnrollment = StudentEnrollment::with([
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ])
            ->where('student_id', $student->id)
            ->where('status', 'active')
            ->latest('id')
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Branches
        |--------------------------------------------------------------------------
        */

        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Academic Sessions
        |--------------------------------------------------------------------------
        */

        $academicSessions = AcademicSession::where('status', true)
            ->orderByDesc('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Classes
        |--------------------------------------------------------------------------
        */

        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Sections
        |--------------------------------------------------------------------------
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
    | STORE
    |--------------------------------------------------------------------------
    | Create New Enrollment
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        Student $student
    ) {

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

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

            'enrollment_date' => [
                'required',
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
        | Validate Branch
        |--------------------------------------------------------------------------
        */

        $branchExists = Branch::where(
            'id',
            $validated['branch_id']
        )
            ->where('status', true)
            ->exists();


        if (!$branchExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'branch_id' =>
                        'Selected branch is not active.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Validate Class Belongs To Branch
        |--------------------------------------------------------------------------
        */

        $classValid = SchoolClass::where(
            'id',
            $validated['class_id']
        )
            ->where(
                'branch_id',
                $validated['branch_id']
            )
            ->where(
                'status',
                true
            )
            ->exists();


        if (!$classValid) {

            return back()
                ->withInput()
                ->withErrors([
                    'class_id' =>
                        'Selected class does not belong to the selected branch.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Validate Section
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
                ->where(
                    'status',
                    true
                )
                ->exists();


            if (!$sectionValid) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'section_id' =>
                            'Selected section does not belong to the selected branch/class.'
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Current Active Enrollment
        |--------------------------------------------------------------------------
        */

        $currentEnrollment = StudentEnrollment::where(
            'student_id',
            $student->id
        )
            ->where(
                'status',
                'active'
            )
            ->latest('id')
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
        | Duplicate Roll Check
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['roll_no'])) {

            $rollExists = StudentEnrollment::where(
                'branch_id',
                $validated['branch_id']
            )
                ->where(
                    'academic_session_id',
                    $validated['academic_session_id']
                )
                ->where(
                    'class_id',
                    $validated['class_id']
                )
                ->where(
                    'roll_no',
                    $validated['roll_no']
                )
                ->where(
                    'status',
                    'active'
                )
                ->when(
                    !empty($validated['section_id']),
                    function ($query) use ($validated) {

                        $query->where(
                            'section_id',
                            $validated['section_id']
                        );

                    }
                )
                ->exists();


            if ($rollExists) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'roll_no' =>
                            'This roll number is already assigned to another active student in the selected class/section.'
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Save Everything In Transaction
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $student,
            $currentEnrollment,
            $validated
        ) {

            /*
            | Previous Enrollment
            */

            if ($currentEnrollment) {

                $status =
                    $currentEnrollment->branch_id !=
                    $validated['branch_id']

                        ? 'transferred'

                        : 'completed';


                $currentEnrollment->update([
                    'status' => $status,
                ]);
            }


            /*
            | Create New Enrollment
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

                'enrollment_date' =>
                    $validated['enrollment_date'],

                'status' =>
                    'active',

                'remarks' =>
                    $validated['remarks'] ?? null,

            ]);


            /*
            | Update Student Current Academic Placement
            */

            $student->update([

                'branch_id' =>
                    $validated['branch_id'],

                'academic_session_id' =>
                    $validated['academic_session_id'],

                'class_id' =>
                    $validated['class_id'],

                'section_id' =>
                    $validated['section_id'] ?? null,

                'roll_no' =>
                    $validated['roll_no'] ?? null,

            ]);
        });


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


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        Student $student,
        StudentEnrollment $enrollment
    ) {

        $this->validateEnrollmentStudent(
            $student,
            $enrollment
        );


        $enrollment->load([
            'student',
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ]);


        return view(
            'admin.students.enrollments.show',
            compact(
                'student',
                'enrollment'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(
        Student $student,
        StudentEnrollment $enrollment
    ) {

        $this->validateEnrollmentStudent(
            $student,
            $enrollment
        );


        $student->load([
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ]);


        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();


        $academicSessions = AcademicSession::where('status', true)
            ->orderByDesc('id')
            ->get();


        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->orderBy('name')
            ->get();


        $sections = Section::where('status', true)
            ->orderBy('name')
            ->get();


        return view(
            'admin.students.enrollments.edit',
            compact(
                'student',
                'enrollment',
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
        Student $student,
        StudentEnrollment $enrollment
    ) {

        $this->validateEnrollmentStudent(
            $student,
            $enrollment
        );


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

            'enrollment_date' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                'in:active,completed,transferred,inactive',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Class Branch Validation
        |--------------------------------------------------------------------------
        */

        $classValid = SchoolClass::where(
            'id',
            $validated['class_id']
        )
            ->where(
                'branch_id',
                $validated['branch_id']
            )
            ->where(
                'status',
                true
            )
            ->exists();


        if (!$classValid) {

            return back()
                ->withInput()
                ->withErrors([
                    'class_id' =>
                        'Selected class does not belong to the selected branch.'
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
                ->where(
                    'status',
                    true
                )
                ->exists();


            if (!$sectionValid) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'section_id' =>
                            'Selected section does not belong to the selected branch/class.'
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Duplicate Enrollment
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
            ->where(
                'id',
                '!=',
                $enrollment->id
            )
            ->exists();


        if ($alreadyExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'class_id' =>
                        'Another enrollment already exists for this student in the selected session, branch and class.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $student,
            $enrollment,
            $validated
        ) {

            $enrollment->update([

                'branch_id' =>
                    $validated['branch_id'],

                'academic_session_id' =>
                    $validated['academic_session_id'],

                'class_id' =>
                    $validated['class_id'],

                'section_id' =>
                    $validated['section_id'] ?? null,

                'roll_no' =>
                    $validated['roll_no'] ?? null,

                'enrollment_date' =>
                    $validated['enrollment_date'],

                'status' =>
                    $validated['status'],

                'remarks' =>
                    $validated['remarks'] ?? null,

            ]);


            /*
            |--------------------------------------------------------------------------
            | If this is active enrollment,
            | update student's current placement
            |--------------------------------------------------------------------------
            */

            if ($validated['status'] === 'active') {

                $student->update([

                    'branch_id' =>
                        $validated['branch_id'],

                    'academic_session_id' =>
                        $validated['academic_session_id'],

                    'class_id' =>
                        $validated['class_id'],

                    'section_id' =>
                        $validated['section_id'] ?? null,

                    'roll_no' =>
                        $validated['roll_no'] ?? null,

                ]);
            }
        });


        return redirect()
            ->route(
                'admin.students.enrollments.index',
                $student
            )
            ->with(
                'success',
                'Enrollment updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Student $student,
        StudentEnrollment $enrollment
    ) {

        $this->validateEnrollmentStudent(
            $student,
            $enrollment
        );


        /*
        |--------------------------------------------------------------------------
        | Do not delete active enrollment directly
        |--------------------------------------------------------------------------
        */

        if ($enrollment->status === 'active') {

            return back()
                ->withErrors([
                    'enrollment' =>
                        'Active enrollment cannot be deleted. Please change its status first.'
                ]);
        }


        $enrollment->delete();


        return redirect()
            ->route(
                'admin.students.enrollments.index',
                $student
            )
            ->with(
                'success',
                'Enrollment deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DYNAMIC SECTIONS
    |--------------------------------------------------------------------------
    */

    public function sections(Request $request)
    {
        $request->validate([

            'branch_id' => [
                'required',
                'exists:branches,id',
            ],
            'class_id' => [
                'required',
                'exists:classes,id',
            ],
        ]);
        $sections = Section::where(
            'branch_id',
            $request->branch_id
        )
            ->where(
                'class_id',
                $request->class_id
            )
            ->where(
                'status',
                true
            )
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);
        return response()->json(
            $sections
        );
    }

    // Validate Enrollment Belongs To Student
    private function validateEnrollmentStudent(
        Student $student,
        StudentEnrollment $enrollment
    ): void {
        abort_if(
            $enrollment->student_id != $student->id,
            404
        );
    }
    // Bulk enrollment function 
    public function bulkCreate()
    {
        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();
        $academicSessions = AcademicSession::where('status', true)
            ->orderByDesc('id')
            ->get();
        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->get();
        $sections = Section::where('status', true)
            ->orderBy('name')
            ->get();
        return view('admin.students.enrollments.bulk-create',compact(
                'branches',
                'academicSessions',
                'classes',
                'sections'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Get Students For Bulk Enrollment
    |--------------------------------------------------------------------------
    */

    public function bulkStudents(Request $request)
    {
        $request->validate([
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
        ]);

        $students = Student::with([
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ])
            ->where('branch_id', $request->branch_id)
            ->where('academic_session_id', $request->academic_session_id)
            ->where('class_id', $request->class_id)
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return response()->json([
            'students' => $students,
        ]);
    }


    /*
        |--------------------------------------------------------------------------
        | Store Bulk Enrollment
        |--------------------------------------------------------------------------
        */

        public function bulkStore(Request $request)
        {
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

                'enrollment_date' => [
                    'required',
                    'date',
                ],

                'students' => [
                    'required',
                    'array',
                    'min:1',
                ],

                'students.*' => [
                    'required',
                    'exists:students,id',
                ],

                'roll_nos' => [
                    'nullable',
                    'array',
                ],

                'roll_nos.*' => [
                    'nullable',
                    'integer',
                    'min:1',
                ],

                'remarks' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ]);

            //  Process Each Student
        

            foreach ($validated['students'] as $studentId) {

                $student = Student::findOrFail($studentId);


                /*
                |--------------------------------------------------------------------------
                | Validate Student Branch
                |--------------------------------------------------------------------------
                */

                if ($student->branch_id != $validated['branch_id']) {
                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | Check Existing Enrollment
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
                    continue;
                }


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
                | Complete Previous Enrollment
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
                        $validated['roll_nos'][$student->id] ?? null,

                    'admission_date' =>
                        $validated['enrollment_date'],

                    'status' =>
                        'active',

                    'remarks' =>
                        $validated['remarks'] ?? null,
                ]);
            }


            return redirect()
                ->route('admin.students.enrollments.bulk.create')
                ->with(
                    'success',
                    'Selected students enrolled successfully.'
                );
        }








}