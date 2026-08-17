<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Branch;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentEnrollment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentEnrollmentController extends Controller
{
    /**
     * Enrollment List
     */
    public function index(Request $request)
    {
        $enrollments = StudentEnrollment::with([
            'student',
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ])
        ->when($request->filled('branch_id'), function ($query) use ($request) {
            $query->where('branch_id', $request->branch_id);
        })
        ->when($request->filled('academic_session_id'), function ($query) use ($request) {
            $query->where(
                'academic_session_id',
                $request->academic_session_id
            );
        })
        ->when($request->filled('class_id'), function ($query) use ($request) {
            $query->where('class_id', $request->class_id);
        })
        ->when($request->filled('section_id'), function ($query) use ($request) {
            $query->where('section_id', $request->section_id);
        })
        ->when($request->filled('status'), function ($query) use ($request) {
            $query->where('status', $request->status);
        })
        ->latest()
        ->paginate(20)
        ->withQueryString();

        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        $academicSessions = AcademicSession::where('status', true)
            ->orderByDesc('id')
            ->get();

        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->get();

        return view(
            'admin.students.enrollments.index',
            compact(
                'enrollments',
                'branches',
                'academicSessions',
                'classes'
            )
        );
    }


    /**
     * Create Enrollment
     */
    public function create()
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

        $students = Student::where('status', true)
            ->orderBy('name')
            ->get();

        $sections = Section::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.students.enrollments.create',
            compact(
                'branches',
                'academicSessions',
                'classes',
                'sections',
                'students'
            )
        );
    }


    /**
     * Store Enrollment
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'student_id' => [
                'required',
                'exists:students,id',
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
                'required',
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

            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                    'completed',
                    'transferred',
                ]),
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Check Student Belongs To Branch
        |--------------------------------------------------------------------------
        */

        $studentBelongsToBranch = Student::where('id', $request->student_id)
            ->where('branch_id', $request->branch_id)
            ->exists();

        if (! $studentBelongsToBranch) {

            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'Selected student does not belong to the selected branch.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Check Class Belongs To Branch
        |--------------------------------------------------------------------------
        */

        $classBelongsToBranch = SchoolClass::where('id', $request->class_id)
            ->where('branch_id', $request->branch_id)
            ->exists();

        if (! $classBelongsToBranch) {

            return back()
                ->withInput()
                ->withErrors([
                    'class_id' =>
                        'Selected class does not belong to the selected branch.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Check Section Belongs To Branch / Class
        |--------------------------------------------------------------------------
        */

        $sectionBelongsToClass = Section::where('id', $request->section_id)
            ->where('branch_id', $request->branch_id)
            ->where('class_id', $request->class_id)
            ->exists();

        if (! $sectionBelongsToClass) {

            return back()
                ->withInput()
                ->withErrors([
                    'section_id' =>
                        'Selected section does not belong to the selected class.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Duplicate Enrollment Check
        |--------------------------------------------------------------------------
        */

        $exists = StudentEnrollment::where(
                'student_id',
                $request->student_id
            )
            ->where(
                'academic_session_id',
                $request->academic_session_id
            )
            ->exists();

        if ($exists) {

            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'This student is already enrolled in this academic session.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Roll Number Duplicate Check
        |--------------------------------------------------------------------------
        */

        if ($request->filled('roll_no')) {

            $rollExists = StudentEnrollment::where(
                    'branch_id',
                    $request->branch_id
                )
                ->where(
                    'academic_session_id',
                    $request->academic_session_id
                )
                ->where(
                    'class_id',
                    $request->class_id
                )
                ->where(
                    'section_id',
                    $request->section_id
                )
                ->where(
                    'roll_no',
                    $request->roll_no
                )
                ->where('status', 'active')
                ->exists();

            if ($rollExists) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'roll_no' =>
                            'This roll number is already assigned in this class and section.',
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Create Enrollment
        |--------------------------------------------------------------------------
        */

        StudentEnrollment::create($validated);


        return redirect()
            ->route('admin.students.enrollments.index')
            ->with(
                'success',
                'Student enrolled successfully.'
            );
    }


    /**
     * Show Enrollment
     */
    public function show(StudentEnrollment $enrollment)
    {
        $enrollment->load([
            'student',
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ]);

        return view(
            'admin.students.enrollments.show',
            compact('enrollment')
        );
    }


    /**
     * Edit Enrollment
     */
    public function edit(StudentEnrollment $enrollment)
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

        $students = Student::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.students.enrollments.edit',
            compact(
                'enrollment',
                'branches',
                'academicSessions',
                'classes',
                'sections',
                'students'
            )
        );
    }


    /**
     * Update Enrollment
     */
    public function update(
        Request $request,
        StudentEnrollment $enrollment
    ) {
        $validated = $request->validate([

            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'student_id' => [
                'required',
                'exists:students,id',
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
                'required',
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

            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                    'completed',
                    'transferred',
                ]),
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Branch Validation
        |--------------------------------------------------------------------------
        */

        $studentBelongsToBranch = Student::where('id', $request->student_id)
            ->where('branch_id', $request->branch_id)
            ->exists();

        if (! $studentBelongsToBranch) {

            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'Selected student does not belong to the selected branch.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Class Validation
        |--------------------------------------------------------------------------
        */

        $classBelongsToBranch = SchoolClass::where('id', $request->class_id)
            ->where('branch_id', $request->branch_id)
            ->exists();

        if (! $classBelongsToBranch) {

            return back()
                ->withInput()
                ->withErrors([
                    'class_id' =>
                        'Selected class does not belong to the selected branch.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Section Validation
        |--------------------------------------------------------------------------
        */

        $sectionBelongsToClass = Section::where('id', $request->section_id)
            ->where('branch_id', $request->branch_id)
            ->where('class_id', $request->class_id)
            ->exists();

        if (! $sectionBelongsToClass) {

            return back()
                ->withInput()
                ->withErrors([
                    'section_id' =>
                        'Selected section does not belong to the selected class.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Duplicate Enrollment
        |--------------------------------------------------------------------------
        */

        $exists = StudentEnrollment::where(
                'student_id',
                $request->student_id
            )
            ->where(
                'academic_session_id',
                $request->academic_session_id
            )
            ->where(
                'id',
                '!=',
                $enrollment->id
            )
            ->exists();

        if ($exists) {

            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'This student is already enrolled in this academic session.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Roll Duplicate
        |--------------------------------------------------------------------------
        */

        if ($request->filled('roll_no')) {

            $rollExists = StudentEnrollment::where(
                    'branch_id',
                    $request->branch_id
                )
                ->where(
                    'academic_session_id',
                    $request->academic_session_id
                )
                ->where(
                    'class_id',
                    $request->class_id
                )
                ->where(
                    'section_id',
                    $request->section_id
                )
                ->where(
                    'roll_no',
                    $request->roll_no
                )
                ->where('status', 'active')
                ->where(
                    'id',
                    '!=',
                    $enrollment->id
                )
                ->exists();

            if ($rollExists) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'roll_no' =>
                            'This roll number is already assigned in this class and section.',
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $enrollment->update($validated);


        return redirect()
            ->route('admin.students.enrollments.index')
            ->with(
                'success',
                'Student enrollment updated successfully.'
            );
    }


    /**
     * Delete Enrollment
     */
    public function destroy(StudentEnrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()
            ->route('admin.students.enrollments.index')
            ->with(
                'success',
                'Student enrollment deleted successfully.'
            );
    }
}