<?php

namespace App\Http\Controllers;

use App\Models\FeePayment;
use App\Models\StudentFee;
use App\Models\Student;
use App\Models\FeeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeePaymentController extends Controller
{
    /**
     * Fee Collection List - Current Branch
     */
    public function index()
    {
        $branchId = auth()->user()->branch_id;

        if (!$branchId) {
            abort(403, 'Your account is not assigned to any branch.');
        }

        $assignments = StudentFee::with([
            'student',
            'feeType',
        ])
            ->where('branch_id', $branchId)
            ->latest()
            ->get();

        $assignments->each(function ($assignment) {

            $paidAmount = FeePayment::where(
                'student_fee_assignment_id',
                $assignment->id
            )->sum('amount');

            $assignment->paid_amount = $paidAmount;

            $assignment->due_amount = max(
                0,
                $assignment->amount - $paidAmount
            );

            if ($assignment->due_amount <= 0) {

                $assignment->payment_status = 'paid';

            } elseif ($paidAmount > 0) {

                $assignment->payment_status = 'partial';

            } else {

                $assignment->payment_status = 'unpaid';
            }
        });

        return view(
            'admin.fee-collection.index',
            compact('assignments')
        );
    }


    /**
     * Show Collection Form
     */
    public function create(StudentFee $studentFeeAssignment)
    {
        $this->authorizeBranch($studentFeeAssignment);

        $studentFeeAssignment->load([
            'student',
            'feeType',
            'branch',
        ]);

        $paidAmount = FeePayment::where(
            'student_fee_assignment_id',
            $studentFeeAssignment->id
        )->sum('amount');

        $dueAmount = max(
            0,
            $studentFeeAssignment->amount - $paidAmount
        );

        if ($dueAmount <= 0) {

            return redirect()
                ->route('admin.fee-collection.index')
                ->with(
                    'error',
                    'This fee has already been fully paid.'
                );
        }

        return view(
            'admin.fee-collection.create',
            compact(
                'studentFeeAssignment',
                'paidAmount',
                'dueAmount'
            )
        );
    }


    /**
     * Store Payment
     */
    public function store(
        Request $request,
        StudentFee $studentFeeAssignment
    ) {
        $this->authorizeBranch($studentFeeAssignment);

        /*
        |--------------------------------------------------------------------------
        | Current Paid Amount
        |--------------------------------------------------------------------------
        */

        $paidAmount = FeePayment::where('student_fee_assignment_id',  $studentFeeAssignment->id)->sum('amount');
        $dueAmount = max( 0, $studentFeeAssignment->amount - $paidAmount
        );

        if ($dueAmount <= 0) {

            return back()->withInput()->with('error', 'This fee has already been fully paid.');
        }

        $validated = $request->validate([

            'amount' => [
                'required',
                'numeric',
                'min:0.01',
                'max:' . $dueAmount,
            ],

            'payment_date' => [
                'required',
                'date',
            ],

            'payment_method' => [
                'required',
                'in:cash,bank,mobile_banking,other',
            ],

            'reference_no' => [
                'nullable',
                'string',
                'max:100',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Create Payment
        |--------------------------------------------------------------------------
        */

        $payment = DB::transaction(function () use (
            $validated,
            $studentFeeAssignment
        ) {

            return FeePayment::create([

                'branch_id' => $studentFeeAssignment->branch_id,

                'student_fee_assignment_id' =>
                    $studentFeeAssignment->id,

                'student_id' =>
                    $studentFeeAssignment->student_id,

                'fee_type_id' =>
                    $studentFeeAssignment->fee_type_id,

                'amount' =>
                    $validated['amount'],

                'payment_date' =>
                    $validated['payment_date'],

                'payment_method' =>
                    $validated['payment_method'],

                'reference_no' =>
                    $validated['reference_no'] ?? null,

                'remarks' =>
                    $validated['remarks'] ?? null,

                'collected_by' =>
                    auth()->id(),
            ]);
        });


        /*
        |--------------------------------------------------------------------------
        | Redirect To Receipt
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'admin.fee-collection.index',
                $payment->id
            )
            ->with(
                'success',
                'Fee payment collected successfully.'
            );
    }


    

    /**
     * Branch Security For Student Fee
     */
    private function authorizeBranch(
        StudentFee $studentFeeAssignment
    ): void {

        $user = auth()->user();

        if (
            !$user ||
            !$user->branch_id ||
            $studentFeeAssignment->branch_id != $user->branch_id
        ) {
            abort(403, 'Unauthorized access.');
        }
    }


    /**
     * Branch Security For Payment
     */
    private function authorizePaymentBranch(
        FeePayment $payment
    ): void {

        $user = auth()->user();

        if (
            !$user ||
            !$user->branch_id ||
            $payment->branch_id != $user->branch_id
        ) {
            abort(403, 'Unauthorized access.');
        }
    }


    /**
 * Payment Details
 */
public function show(FeePayment $feePayment)
{
    $branchId = auth()->user()->branch_id;

    if (!$branchId) {
        abort(403, 'Your account is not assigned to any branch.');
    }

    if ($feePayment->branch_id != $branchId) {
        abort(403, 'Unauthorized access.');
    }

    $feePayment->load([
        'student',
        'feeType',
        'branch',
        'collector',
        'studentFeeAssignment',
    ]);

    return view(
        'admin.fee-payment-history.show',
        compact('feePayment')
    );
}

/**
 * Payment Receipt
 */
public function receipt(FeePayment $feePayment)
{
    $branchId = auth()->user()->branch_id;

    if (!$branchId) {
        abort(
            403,
            'Your account is not assigned to any branch.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Branch Security
    |--------------------------------------------------------------------------
    */

    if ($feePayment->branch_id != $branchId) {
        abort(403, 'Unauthorized access.');
    }

    /*
    |--------------------------------------------------------------------------
    | Load Relations
    |--------------------------------------------------------------------------
    */

    $feePayment->load([
        'student',
        'feeType',
        'branch',
        'collector',
        'studentFeeAssignment',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Assignment
    |--------------------------------------------------------------------------
    */

    $assignment = $feePayment->studentFeeAssignment;

    /*
    |--------------------------------------------------------------------------
    | Previous Payments
    |--------------------------------------------------------------------------
    */

    $previousPaid = FeePayment::where(
        'student_fee_assignment_id',
        $feePayment->student_fee_assignment_id
    )
        ->where(
            'id',
            '<',
            $feePayment->id
        )
        ->sum('amount');

    /*
    |--------------------------------------------------------------------------
    | Assigned Amount
    |--------------------------------------------------------------------------
    */

    $assignedAmount = $assignment
        ? $assignment->payable_amount
        : 0;

    /*
    |--------------------------------------------------------------------------
    | Current Payment
    |--------------------------------------------------------------------------
    */

    $currentPayment = $feePayment->amount;

    /*
    |--------------------------------------------------------------------------
    | Total Paid After This Payment
    |--------------------------------------------------------------------------
    */

    $totalPaid = $previousPaid + $currentPayment;

    /*
    |--------------------------------------------------------------------------
    | Remaining Due
    |--------------------------------------------------------------------------
    */

    $remainingDue = max(
        0,
        $assignedAmount - $totalPaid
    );

    return view(
        'admin.fee-collection.receipt',
        compact(
            'feePayment',
            'assignment',
            'assignedAmount',
            'previousPaid',
            'currentPayment',
            'totalPaid',
            'remainingDue'
        )
    );
}

/**
 * Fee Payment History
 */
public function history()
{
    $branchId = auth()->user()->branch_id;

    if (!$branchId) {
        abort(403, 'Your account is not assigned to any branch.');
    }

    $payments = FeePayment::with([
        'student',
        'feeType',
        'branch',
        'collector',
        'studentFeeAssignment',
    ])
        ->where('branch_id', $branchId)
        ->latest('payment_date')
        ->latest('id')
        ->get();

    return view(
        'admin.fee-payment-history.index',
        compact('payments')
    );
}



 public function report(Request $request)
{
    $user = auth()->user();

    $query = FeePayment::with([
        'student',
        'feeType',
        'branch',
        'collector',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Branch Wise Access
    |--------------------------------------------------------------------------
    */

    if ($user->branch_id) {
        $query->where('branch_id', $user->branch_id);
    }

    /*
    |--------------------------------------------------------------------------
    | Date Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('from_date')) {
        $query->whereDate(
            'payment_date',
            '>=',
            $request->from_date
        );
    }

    if ($request->filled('to_date')) {
        $query->whereDate(
            'payment_date',
            '<=',
            $request->to_date
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Student Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('student_id')) {
        $query->where(
            'student_id',
            $request->student_id
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Fee Type Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('fee_type_id')) {
        $query->where(
            'fee_type_id',
            $request->fee_type_id
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Payment Method Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('payment_method')) {
        $query->where(
            'payment_method',
            $request->payment_method
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Get Payments
    |--------------------------------------------------------------------------
    */

    $payments = $query
        ->orderBy('payment_date', 'desc')
        ->orderBy('id', 'desc')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Total Transactions
    |--------------------------------------------------------------------------
    */

    $totalTransactions = $payments->count();

    /*
    |--------------------------------------------------------------------------
    | Total Collection
    |--------------------------------------------------------------------------
    */

    $totalCollected = $payments->sum('amount');

    /*
    |--------------------------------------------------------------------------
    | Payment Method Totals
    |--------------------------------------------------------------------------
    */

    $cashTotal = $payments
        ->where('payment_method', 'cash')
        ->sum('amount');

    $bankTotal = $payments
        ->where('payment_method', 'bank')
        ->sum('amount');

    $mobileBankingTotal = $payments
        ->where('payment_method', 'mobile_banking')
        ->sum('amount');

    $otherTotal = $payments
        ->where('payment_method', 'other')
        ->sum('amount');

    /*
    |--------------------------------------------------------------------------
    | Students
    |--------------------------------------------------------------------------
    */

    $students = Student::query()
        ->when($user->branch_id, function ($q) use ($user) {
            $q->where('branch_id', $user->branch_id);
        })
        ->orderBy('name')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Fee Types
    |--------------------------------------------------------------------------
    */

    $feeTypes = FeeType::orderBy('name')->get();

    /*
    |--------------------------------------------------------------------------
    | Return Report
    |--------------------------------------------------------------------------
    */

    return view('admin.fee-collection.report', compact(
        'payments',
        'students',
        'feeTypes',
        'totalTransactions',
        'totalCollected',
        'cashTotal',
        'bankTotal',
        'mobileBankingTotal',
        'otherTotal'
    ));
}



public function dueReport(Request $request)
{
    $user = auth()->user();

    $studentsQuery = Student::query();

    // Branch-wise access
    if ($user->branch_id) {
        $studentsQuery->where('branch_id', $user->branch_id);
    }

    // Student filter
    if ($request->filled('student_id')) {
        $studentsQuery->where('id', $request->student_id);
    }

    // Class filter
    if ($request->filled('school_class_id')) {
        $studentsQuery->where('school_class_id', $request->school_class_id);
    }

    // Section filter
    if ($request->filled('section_id')) {
        $studentsQuery->where('section_id', $request->section_id);
    }

    $students = $studentsQuery
        ->with([
            'branch',
            'schoolClass',
            'section',
        ])
        ->orderBy('name')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Fee Types
    |--------------------------------------------------------------------------
    */

    $feeTypes = FeeType::query()
        ->orderBy('name')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Calculate Student Due
    |--------------------------------------------------------------------------
    */

    $studentDue = collect();

    foreach ($students as $student) {

        $paymentsQuery = FeePayment::where(
            'student_id',
            $student->id
        );

        // Date filter
        if ($request->filled('from_date')) {
            $paymentsQuery->whereDate(
                'payment_date',
                '>=',
                $request->from_date
            );
        }

        if ($request->filled('to_date')) {
            $paymentsQuery->whereDate(
                'payment_date',
                '<=',
                $request->to_date
            );
        }

        // Fee Type filter
        if ($request->filled('fee_type_id')) {
            $paymentsQuery->where(
                'fee_type_id',
                $request->fee_type_id
            );
        }

        $paidAmount = $paymentsQuery->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | Total Fee
        |--------------------------------------------------------------------------
        |
        | এখানে তোমার actual fee assignment table অনুযায়ী
        | total fee calculation বসবে।
        |
        */

        $totalFee = 0;

        $dueAmount = $totalFee - $paidAmount;

        if ($dueAmount < 0) {
            $dueAmount = 0;
        }

        $studentDue->push([
            'student'       => $student,
            'total_fee'     => $totalFee,
            'paid_amount'   => $paidAmount,
            'due_amount'    => $dueAmount,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Summary
    |--------------------------------------------------------------------------
    */

    $totalStudents = $studentDue->count();

    $totalFee = $studentDue->sum('total_fee');

    $totalPaid = $studentDue->sum('paid_amount');

    $totalDue = $studentDue->sum('due_amount');

    /*
    |--------------------------------------------------------------------------
    | Classes
    |--------------------------------------------------------------------------
    */

    $classes = SchoolClass::query()
        ->orderBy('name')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Sections
    |--------------------------------------------------------------------------
    */

    $sections = Section::query()
        ->orderBy('name')
        ->get();

    return view(
        'admin.fee-collection.due-report',
        compact(
            'studentDue',
            'students',
            'feeTypes',
            'classes',
            'sections',
            'totalStudents',
            'totalFee',
            'totalPaid',
            'totalDue'
        )
    );
}










}