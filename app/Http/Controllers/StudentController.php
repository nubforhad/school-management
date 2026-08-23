<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Branch;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Student List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $students = Student::with([
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
            ->when($request->filled('search'), function ($query) use ($request) {

                $search = $request->search;

                $query->where(function ($q) use ($search) {

                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('name_bn', 'like', "%{$search}%")
                        ->orWhere('student_id', 'like', "%{$search}%")
                        ->orWhere('admission_no', 'like', "%{$search}%")
                        ->orWhere('roll_no', 'like', "%{$search}%")
                        ->orWhere('guardian_phone', 'like', "%{$search}%");

                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();


        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        $academicSessions = AcademicSession::orderByDesc('id')
            ->get();

        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->get();

        $sections = Section::where('status', true)
            ->orderBy('name')
            ->get();


        return view(
            'admin.students.index',
            compact(
                'students',
                'branches',
                'academicSessions',
                'classes',
                'sections'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        $academicSessions = AcademicSession::orderByDesc('id')
            ->get();

        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->get();

        $sections = Section::where('status', true)
            ->orderBy('name')
            ->get();


        return view(
            'admin.students.create',
            compact(
                'branches',
                'academicSessions',
                'classes',
                'sections'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
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

            'admission_no' => [
                'required',
                'string',
                'max:50',

                Rule::unique('students', 'admission_no')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'branch_id',
                            $request->branch_id
                        );
                    }),
            ],

            'student_id' => [
                'required',
                'string',
                'max:50',
                'unique:students,student_id',
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'name_bn' => [
                'nullable',
                'string',
                'max:150',
            ],

            'father_name' => [
                'nullable',
                'string',
                'max:150',
            ],

            'father_name_bn' => [
                'nullable',
                'string',
                'max:150',
            ],

            'mother_name' => [
                'nullable',
                'string',
                'max:150',
            ],

            'mother_name_bn' => [
                'nullable',
                'string',
                'max:150',
            ],

            'birth_reg_no' => [
                'nullable',
                'string',
                'max:30',
            ],

            'gender' => [
                'nullable',
                Rule::in([
                    'male',
                    'female',
                    'other',
                ]),
            ],

            'date_of_birth' => [
                'nullable',
                'date',
            ],

            'blood_group' => [
                'nullable',
                'string',
                'max:10',
            ],

            'religion' => [
                'nullable',
                'string',
                'max:50',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
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
                'string',
                'max:50',
            ],

            'guardian_name' => [
                'nullable',
                'string',
                'max:150',
            ],

            'guardian_phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'guardian_email' => [
                'nullable',
                'email',
                'max:150',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'admission_date' => [
                'nullable',
                'date',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            $validated['photo'] = $request
                ->file('photo')
                ->store('students', 'public');
        }


        $validated['status'] = $request->boolean('status');


        Student::create($validated);


        return redirect()
            ->route('admin.students.index')
            ->with(
                'success',
                'Student admitted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

    public function show(Student $student)
    {
        $student->load([
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ]);


        return view(
            'admin.students.show',
            compact('student')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(Student $student)
    {
        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        $academicSessions = AcademicSession::orderByDesc('id')
            ->get();

        $classes = SchoolClass::where('status', true)
            ->orderBy('numeric_order')
            ->get();

        $sections = Section::where('status', true)
            ->orderBy('name')
            ->get();


        return view(
            'admin.students.edit',
            compact(
                'student',
                'branches',
                'academicSessions',
                'classes',
                'sections'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
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

            'admission_no' => [
                'required',
                'string',
                'max:50',

                Rule::unique('students', 'admission_no')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'branch_id',
                            $request->branch_id
                        );
                    })
                    ->ignore($student->id),
            ],

            'student_id' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'student_id')
                    ->ignore($student->id),
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'name_bn' => [
                'nullable',
                'string',
                'max:150',
            ],

            'father_name' => [
                'nullable',
                'string',
                'max:150',
            ],

            'father_name_bn' => [
                'nullable',
                'string',
                'max:150',
            ],

            'mother_name' => [
                'nullable',
                'string',
                'max:150',
            ],

            'mother_name_bn' => [
                'nullable',
                'string',
                'max:150',
            ],

            'birth_reg_no' => [
                'nullable',
                'string',
                'max:30',
            ],

            'gender' => [
                'nullable',
                Rule::in([
                    'male',
                    'female',
                    'other',
                ]),
            ],

            'date_of_birth' => [
                'nullable',
                'date',
            ],

            'blood_group' => [
                'nullable',
                'string',
                'max:10',
            ],

            'religion' => [
                'nullable',
                'string',
                'max:50',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
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
                'string',
                'max:50',
            ],

            'guardian_name' => [
                'nullable',
                'string',
                'max:150',
            ],

            'guardian_phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'guardian_email' => [
                'nullable',
                'email',
                'max:150',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'admission_date' => [
                'nullable',
                'date',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | New Photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            if (
                $student->photo &&
                Storage::disk('public')->exists($student->photo)
            ) {
                Storage::disk('public')->delete(
                    $student->photo
                );
            }


            $validated['photo'] = $request
                ->file('photo')
                ->store('students', 'public');
        }


        $validated['status'] = $request->boolean('status');


        $student->update($validated);


        return redirect()
            ->route('admin.students.index')
            ->with(
                'success',
                'Student updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(Student $student)
    {
        if (
            $student->photo &&
            Storage::disk('public')->exists($student->photo)
        ) {
            Storage::disk('public')->delete(
                $student->photo
            );
        }


        $student->delete();


        return redirect()
            ->route('admin.students.index')
            ->with(
                'success',
                'Student deleted successfully.'
            );
    }




    public function idCard(Student $student)
    {
        $student->load([
            'branch',
            'academicSession',
            'schoolClass',
            'section',
        ]);

        return view(
            'admin.students.id-card',
            compact('student')
        );
    }




















}