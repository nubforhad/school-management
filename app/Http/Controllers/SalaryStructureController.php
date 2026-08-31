<?php

namespace App\Http\Controllers;

use App\Models\SalaryStructure;
use App\Models\TeacherStaff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SalaryStructureController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $branchId = auth()->user()->branch_id;

        $salaryStructures = SalaryStructure::with([
                'teacherStaff',
                'teacherStaff.department',
                'teacherStaff.designation',
            ])
            ->where('branch_id', $branchId)
            ->latest()
            ->paginate(15);

        return view(
            'admin.salary-structures.index',
            compact('salaryStructures')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $branchId = auth()->user()->branch_id;

        $teachers = TeacherStaff::where('branch_id', $branchId)
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.salary-structures.create',
            compact('teachers')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        $validated = $request->validate([

            'teacher_staff_id' => [
                'required',
                Rule::exists('teacher_staff', 'id')
                    ->where('branch_id', $branchId),
            ],

            'basic_salary' => [
                'required',
                'numeric',
                'min:0',
            ],

            'house_rent' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'medical_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'transport_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'special_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'other_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'provident_fund' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'tax' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'other_deduction' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'remarks' => [
                'nullable',
                'string',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Duplicate Salary Structure Check
        |--------------------------------------------------------------------------
        */

        $exists = SalaryStructure::where([
            'branch_id' => $branchId,
            'teacher_staff_id' => $validated['teacher_staff_id'],
        ])->exists();

        if ($exists) {

            return back()
                ->withInput()
                ->withErrors([
                    'teacher_staff_id' =>
                        'A salary structure already exists for this teacher/staff member.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Default Values
        |--------------------------------------------------------------------------
        */

        $validated['branch_id'] = $branchId;

        $validated['house_rent'] =
            $validated['house_rent'] ?? 0;

        $validated['medical_allowance'] =
            $validated['medical_allowance'] ?? 0;

        $validated['transport_allowance'] =
            $validated['transport_allowance'] ?? 0;

        $validated['special_allowance'] =
            $validated['special_allowance'] ?? 0;

        $validated['other_allowance'] =
            $validated['other_allowance'] ?? 0;

        $validated['provident_fund'] =
            $validated['provident_fund'] ?? 0;

        $validated['tax'] =
            $validated['tax'] ?? 0;

        $validated['other_deduction'] =
            $validated['other_deduction'] ?? 0;

        $validated['status'] =
            $request->boolean('status');


        SalaryStructure::create($validated);


        return redirect()
            ->route('admin.salary-structures.index')
            ->with(
                'success',
                'Salary structure created successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(SalaryStructure $salaryStructure)
    {
        $branchId = auth()->user()->branch_id;

        /*
        | Prevent access to another branch's salary structure
        */

        abort_unless(
            $salaryStructure->branch_id == $branchId,
            403
        );


        $teachers = TeacherStaff::where('branch_id', $branchId)
            ->where('status', true)
            ->orderBy('name')
            ->get();


        return view(
            'admin.salary-structures.edit',
            compact(
                'salaryStructure',
                'teachers'
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
        SalaryStructure $salaryStructure
    ) {

        $branchId = auth()->user()->branch_id;


        /*
        |--------------------------------------------------------------------------
        | Branch Security
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $salaryStructure->branch_id == $branchId,
            403
        );


        $validated = $request->validate([

            'teacher_staff_id' => [
                'required',

                Rule::exists('teacher_staff', 'id')
                    ->where('branch_id', $branchId),
            ],

            'basic_salary' => [
                'required',
                'numeric',
                'min:0',
            ],

            'house_rent' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'medical_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'transport_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'special_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'other_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'provident_fund' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'tax' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'other_deduction' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'remarks' => [
                'nullable',
                'string',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Duplicate Check
        |--------------------------------------------------------------------------
        */

        $exists = SalaryStructure::where(
                'branch_id',
                $branchId
            )
            ->where(
                'teacher_staff_id',
                $validated['teacher_staff_id']
            )
            ->where(
                'id',
                '!=',
                $salaryStructure->id
            )
            ->exists();


        if ($exists) {

            return back()
                ->withInput()
                ->withErrors([
                    'teacher_staff_id' =>
                        'A salary structure already exists for this teacher/staff member.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Default Values
        |--------------------------------------------------------------------------
        */

        $validated['branch_id'] = $branchId;

        $validated['house_rent'] =
            $validated['house_rent'] ?? 0;

        $validated['medical_allowance'] =
            $validated['medical_allowance'] ?? 0;

        $validated['transport_allowance'] =
            $validated['transport_allowance'] ?? 0;

        $validated['special_allowance'] =
            $validated['special_allowance'] ?? 0;

        $validated['other_allowance'] =
            $validated['other_allowance'] ?? 0;

        $validated['provident_fund'] =
            $validated['provident_fund'] ?? 0;

        $validated['tax'] =
            $validated['tax'] ?? 0;

        $validated['other_deduction'] =
            $validated['other_deduction'] ?? 0;

        $validated['status'] =
            $request->boolean('status');


        $salaryStructure->update($validated);


        return redirect()
            ->route('admin.salary-structures.index')
            ->with(
                'success',
                'Salary structure updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    */

    public function destroy(SalaryStructure $salaryStructure)
    {
        $branchId = auth()->user()->branch_id;


        /*
        | Prevent deleting another branch's data
        */

        abort_unless(
            $salaryStructure->branch_id == $branchId,
            403
        );


        $salaryStructure->delete();


        return redirect()
            ->route('admin.salary-structures.index')
            ->with(
                'success',
                'Salary structure deleted successfully.'
            );
    }
}