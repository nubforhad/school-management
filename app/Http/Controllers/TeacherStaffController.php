<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\TeacherStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherStaffController extends Controller
{
    public function index()
    {
        $teacherStaff = TeacherStaff::with([
                'branch',
                'department',
                'designation'
            ])
            ->where('branch_id', auth()->user()->branch_id)
            ->latest()
            ->paginate(15);

        return view('admin.teacher-staff.index', compact('teacherStaff')
        );
    }


    public function create()
    {
        $branches = Branch::orderBy('name')->get();

        $departments = Department::where(
            'branch_id',
            auth()->user()->branch_id
        )
        ->where('status', true)
        ->orderBy('name')
        ->get();

        $designations = Designation::where(
            'branch_id',
            auth()->user()->branch_id
        )
        ->where('status', true)
        ->orderBy('name')
        ->get();

        return view(
            'admin.teacher-staff.create',
            compact(
                'branches',
                'departments',
                'designations'
            )
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',

            'department_id' => [
                'nullable',
                'exists:departments,id'
            ],

            'designation_id' => [
                'nullable',
                'exists:designations,id'
            ],

            'employee_id' => [
                'required',
                'string',
                'max:100',
                'unique:teacher_staff,employee_id'
            ],

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'gender' => [
                'nullable',
                'in:Male,Female,Other'
            ],

            'date_of_birth' => [
                'nullable',
                'date'
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30'
            ],

            'email' => [
                'nullable',
                'email',
                'max:255'
            ],

            'address' => [
                'nullable',
                'string'
            ],

            'joining_date' => [
                'nullable',
                'date'
            ],

            'basic_salary' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'employment_type' => [
                'required',
                'in:Permanent,Temporary,Contractual,Part Time'
            ],

            'status' => [
                'nullable',
                'boolean'
            ],

            'remarks' => [
                'nullable',
                'string'
            ],
        ]);


        if ($request->hasFile('photo')) {

            $validated['photo'] = $request
                ->file('photo')
                ->store('teacher-staff', 'public');
        }


        $validated['status'] = $request->boolean('status');


        TeacherStaff::create($validated);


        return redirect()
            ->route('admin.teacher-staff.index')
            ->with(
                'success',
                'Teacher/Staff created successfully.'
            );
    }


    public function edit(TeacherStaff $teacherStaff)
    {
        abort_if(
            $teacherStaff->branch_id != auth()->user()->branch_id,
            403
        );


        $branches = Branch::orderBy('name')->get();

        $departments = Department::where(
            'branch_id',
            auth()->user()->branch_id
        )
        ->where('status', true)
        ->orderBy('name')
        ->get();

        $designations = Designation::where(
            'branch_id',
            auth()->user()->branch_id
        )
        ->where('status', true)
        ->orderBy('name')
        ->get();


        return view(
            'admin.teacher-staff.edit',
            compact(
                'teacherStaff',
                'branches',
                'departments',
                'designations'
            )
        );
    }


    public function update(
        Request $request,
        TeacherStaff $teacherStaff
    ) {
        abort_if(
            $teacherStaff->branch_id != auth()->user()->branch_id,
            403
        );


        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',

            'department_id' => [
                'nullable',
                'exists:departments,id'
            ],

            'designation_id' => [
                'nullable',
                'exists:designations,id'
            ],

            'employee_id' => [
                'required',
                'string',
                'max:100',
                'unique:teacher_staff,employee_id,' .
                $teacherStaff->id
            ],

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'gender' => [
                'nullable',
                'in:Male,Female,Other'
            ],

            'date_of_birth' => [
                'nullable',
                'date'
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30'
            ],

            'email' => [
                'nullable',
                'email',
                'max:255'
            ],

            'address' => [
                'nullable',
                'string'
            ],

            'joining_date' => [
                'nullable',
                'date'
            ],

            'basic_salary' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'employment_type' => [
                'required',
                'in:Permanent,Temporary,Contractual,Part Time'
            ],

            'status' => [
                'nullable',
                'boolean'
            ],

            'remarks' => [
                'nullable',
                'string'
            ],
        ]);


        if ($request->hasFile('photo')) {

            if ($teacherStaff->photo) {

                Storage::disk('public')
                    ->delete($teacherStaff->photo);
            }


            $validated['photo'] = $request
                ->file('photo')
                ->store('teacher-staff', 'public');
        }


        $validated['status'] = $request->boolean('status');


        $teacherStaff->update($validated);


        return redirect()
            ->route('admin.teacher-staff.index')
            ->with(
                'success',
                'Teacher/Staff updated successfully.'
            );
    }


    public function show(TeacherStaff $teacherStaff)
    {
        $teacherStaff->load([
            'branch',
            'department',
            'designation',
        ]);

        return view('admin.teacher-staff.show', compact('teacherStaff'));
    }


    public function destroy(TeacherStaff $teacherStaff)
    {
        abort_if(
            $teacherStaff->branch_id != auth()->user()->branch_id,
            403
        );


        if ($teacherStaff->photo) {

            Storage::disk('public')
                ->delete($teacherStaff->photo);
        }


        $teacherStaff->delete();


        return redirect()
            ->route('admin.teacher-staff.index')
            ->with(
                'success',
                'Teacher/Staff deleted successfully.'
            );
    }
}