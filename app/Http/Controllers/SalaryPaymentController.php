<?php

namespace App\Http\Controllers;

use App\Models\SalaryPayment;
use App\Models\SalaryStructure;
use App\Models\TeacherStaff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SalaryPaymentController extends Controller
{
    /**
     * Display salary payments.
     */
    public function index(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        $salaryPayments = SalaryPayment::with([
                'teacherStaff',
                'salaryStructure'
            ])
            ->where('branch_id', $branchId)

            ->when($request->filled('salary_month'), function ($query) use ($request) {
                $query->where(
                    'salary_month',
                    $request->salary_month
                );
            })

            ->when($request->filled('salary_year'), function ($query) use ($request) {
                $query->where(
                    'salary_year',
                    $request->salary_year
                );
            })

            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where(
                    'status',
                    $request->status
                );
            })

            ->when($request->filled('teacher_staff_id'), function ($query) use ($request) {
                $query->where(
                    'teacher_staff_id',
                    $request->teacher_staff_id
                );
            })

            ->latest()
            ->paginate(15)
            ->withQueryString();

        $teachers = TeacherStaff::where('branch_id', $branchId)
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.salary-payments.index',
            compact(
                'salaryPayments',
                'teachers'
            )
        );
    }


    /**
     * Show create form.
     */
    public function create()
    {
        $branchId = auth()->user()->branch_id;

        $teachers = TeacherStaff::where('branch_id', $branchId)
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.salary-payments.create',
            compact('teachers')
        );
    }

 
/**
 * Store salary payment.
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

        'salary_month' => [
            'required',
            'integer',
            'between:1,12',
        ],

        'salary_year' => [
            'required',
            'integer',
            'min:2000',
            'max:2100',
        ],

        'paid_amount' => [
            'required',
            'numeric',
            'min:0',
        ],

        'payment_date' => [
            'nullable',
            'date',
        ],

        'payment_method' => [
            'nullable',
            'string',
            'max:50',
        ],

        'status' => [
            'nullable',
            Rule::in([
                'Pending',
                'Paid',
                'Partial',
                'Cancelled',
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
    | Get Active Salary Structure
    |--------------------------------------------------------------------------
    */

    $salaryStructure = SalaryStructure::where(
            'teacher_staff_id',
            $validated['teacher_staff_id']
        )
        ->where('branch_id', $branchId)
        ->where('status', true)
        ->latest()
        ->first();


    if (!$salaryStructure) {

        return back()
            ->withInput()
            ->withErrors([
                'teacher_staff_id' =>
                    'No active salary structure found for this teacher/staff.',
            ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Salary Calculation
    |--------------------------------------------------------------------------
    */

    $basicSalary =
        (float) $salaryStructure->basic_salary;

    $grossSalary =
        (float) $salaryStructure->basic_salary
        + (float) $salaryStructure->house_rent
        + (float) $salaryStructure->medical_allowance
        + (float) $salaryStructure->transport_allowance
        + (float) $salaryStructure->special_allowance
        + (float) $salaryStructure->other_allowance;

    $totalDeduction =
        (float) $salaryStructure->provident_fund
        + (float) $salaryStructure->tax
        + (float) $salaryStructure->other_deduction;

    $netSalary =
        $grossSalary - $totalDeduction;


    /*
    |--------------------------------------------------------------------------
    | Get Existing Salary Payment
    |--------------------------------------------------------------------------
    |
    | Same employee + same month + same year
    |
    */

    $existingPayment = SalaryPayment::where([
        'branch_id' => $branchId,
        'teacher_staff_id' => $validated['teacher_staff_id'],
        'salary_month' => $validated['salary_month'],
        'salary_year' => $validated['salary_year'],
    ])->first();


    /*
    |--------------------------------------------------------------------------
    | Already Fully Paid Check
    |--------------------------------------------------------------------------
    */

    if ($existingPayment) {

        $alreadyPaid = (float) $existingPayment->paid_amount;

        $remainingAmount = $netSalary - $alreadyPaid;

        /*
        | Fully Paid
        */

        if ($alreadyPaid >= $netSalary) {

            return back()
                ->withInput()
                ->withErrors([
                    'teacher_staff_id' =>
                        'Salary for the selected month is already fully paid.',
                ]);
        }


        /*
        | Cancelled payment protection
        */

        if ($existingPayment->status === 'Cancelled') {

            return back()
                ->withInput()
                ->withErrors([
                    'teacher_staff_id' =>
                        'This salary payment is cancelled. Please manage the existing payment first.',
                ]);
        }
    } else {

        $alreadyPaid = 0;
        $remainingAmount = $netSalary;
    }


    /*
    |--------------------------------------------------------------------------
    | New Paid Amount
    |--------------------------------------------------------------------------
    */

    $paidAmount =
        (float) $validated['paid_amount'];


    /*
    |--------------------------------------------------------------------------
    | Prevent Over Payment
    |--------------------------------------------------------------------------
    */

    if ($paidAmount > $remainingAmount) {

        return back()
            ->withInput()
            ->withErrors([
                'paid_amount' =>
                    'Paid amount cannot be greater than remaining salary amount. Remaining amount is ৳'
                    . number_format($remainingAmount, 2),
            ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Total Paid After This Payment
    |--------------------------------------------------------------------------
    */

    $totalPaid =
        $alreadyPaid + $paidAmount;


    /*
    |--------------------------------------------------------------------------
    | Auto Status
    |--------------------------------------------------------------------------
    */

    if ($totalPaid <= 0) {

        $status = 'Pending';

    } elseif ($totalPaid < $netSalary) {

        $status = 'Partial';

    } else {

        $status = 'Paid';
    }


    /*
    |--------------------------------------------------------------------------
    | Create First Payment
    |--------------------------------------------------------------------------
    */

    if (!$existingPayment) {

        SalaryPayment::create([

            'branch_id' =>
                $branchId,

            'teacher_staff_id' =>
                $validated['teacher_staff_id'],

            'salary_structure_id' =>
                $salaryStructure->id,

            'salary_month' =>
                $validated['salary_month'],

            'salary_year' =>
                $validated['salary_year'],

            'basic_salary' =>
                $basicSalary,

            'gross_salary' =>
                $grossSalary,

            'total_deduction' =>
                $totalDeduction,

            'net_salary' =>
                $netSalary,

            'paid_amount' =>
                $paidAmount,

            'payment_date' =>
                $validated['payment_date'] ?? null,

            'payment_method' =>
                $validated['payment_method'] ?? null,

            'status' =>
                $status,

            'remarks' =>
                $validated['remarks'] ?? null,
        ]);

    } else {

        /*
        |--------------------------------------------------------------------------
        | Add Payment To Existing Salary
        |--------------------------------------------------------------------------
        */

        $existingPayment->update([

            'paid_amount' =>
                $totalPaid,

            'payment_date' =>
                $validated['payment_date'] ?? $existingPayment->payment_date,

            'payment_method' =>
                $validated['payment_method'] ?? $existingPayment->payment_method,

            'status' =>
                $status,

            'remarks' =>
                $validated['remarks'] ?? $existingPayment->remarks,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Success Message
    |--------------------------------------------------------------------------
    */

    if ($status === 'Paid') {

        $message =
            'Salary fully paid successfully. Total paid: ৳'
            . number_format($totalPaid, 2);

    } elseif ($status === 'Partial') {

        $remaining =
            $netSalary - $totalPaid;

        $message =
            'Salary payment added successfully. Remaining: ৳'
            . number_format($remaining, 2);

    } else {

        $message =
            'Salary payment created successfully.';
    }


    return redirect()
        ->route('admin.salary-payments.index')
        ->with('success', $message);
} 


    /**
     * Show salary payment.
     */
    public function show(SalaryPayment $salaryPayment)
    {
        $this->checkBranch($salaryPayment);

        $salaryPayment->load([
            'teacherStaff',
            'salaryStructure',
            'branch'
        ]);

        return view(
            'admin.salary-payments.show',
            compact('salaryPayment')
        );
    }


    /**
     * Edit salary payment.
     */
    public function edit(SalaryPayment $salaryPayment)
    {
        $this->checkBranch($salaryPayment);

        $teachers = TeacherStaff::where(
                'branch_id',
                auth()->user()->branch_id
            )
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.salary-payments.edit',
            compact(
                'salaryPayment',
                'teachers'
            )
        );
    }


    /**
     * Update salary payment.
     */
    public function update(
        Request $request,
        SalaryPayment $salaryPayment
    ) {
        $this->checkBranch($salaryPayment);

        $branchId = auth()->user()->branch_id;

        $validated = $request->validate([

            'paid_amount' => [
                'required',
                'numeric',
                'min:0',
                'max:' . $salaryPayment->net_salary,
            ],

            'payment_date' => [
                'nullable',
                'date',
            ],

            'payment_method' => [
                'nullable',
                'string',
                'max:50',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        $paidAmount =
            (float) $validated['paid_amount'];

        $netSalary =
            (float) $salaryPayment->net_salary;


        if ($paidAmount <= 0) {

            $status = 'Pending';

        } elseif ($paidAmount < $netSalary) {

            $status = 'Partial';

        } else {

            $status = 'Paid';
        }


        $salaryPayment->update([

            'paid_amount' =>
                $paidAmount,

            'payment_date' =>
                $validated['payment_date'] ?? null,

            'payment_method' =>
                $validated['payment_method'] ?? null,

            'status' =>
                $status,

            'remarks' =>
                $validated['remarks'] ?? null,
        ]);


        return redirect()
            ->route('admin.salary-payments.index')
            ->with(
                'success',
                'Salary payment updated successfully.'
            );
    }


    /**
     * Delete salary payment.
     */
    public function destroy(SalaryPayment $salaryPayment)
    {
        $this->checkBranch($salaryPayment);

        $salaryPayment->delete();

        return redirect()
            ->route('admin.salary-payments.index')
            ->with(
                'success',
                'Salary payment deleted successfully.'
            );
    }


    /**
     * Branch protection.
     */
    private function checkBranch(
        SalaryPayment $salaryPayment
    ) {
        abort_unless(
            $salaryPayment->branch_id ===
            auth()->user()->branch_id,
            403
        );
    }



public function salaryStructure($teacherStaffId)
{
    $branchId = auth()->user()->branch_id;

    $salaryStructure = SalaryStructure::where('branch_id', $branchId)
        ->where('teacher_staff_id', $teacherStaffId)
        ->where('status', true)
        ->latest()
        ->first();

    if (!$salaryStructure) {
        return response()->json([
            'success' => false,
            'message' => 'No active salary structure found.'
        ]);
    }

    return response()->json([
        'success' => true,
        'salary_structure' => [
            'basic_salary'       => $salaryStructure->basic_salary,
            'house_rent'         => $salaryStructure->house_rent,
            'medical_allowance'  => $salaryStructure->medical_allowance,
            'transport_allowance'=> $salaryStructure->transport_allowance,
            'special_allowance'  => $salaryStructure->special_allowance,
            'other_allowance'    => $salaryStructure->other_allowance,
            'provident_fund'     => $salaryStructure->provident_fund,
            'tax'                => $salaryStructure->tax,
            'other_deduction'    => $salaryStructure->other_deduction,
            'gross_salary'       => $salaryStructure->gross_salary,
            'total_deduction'   => $salaryStructure->total_deduction,
            'net_salary'        => $salaryStructure->net_salary,
        ]
    ]);
}





}