<?php

namespace App\Http\Controllers;

use App\Models\FeePayment;
use App\Models\FeeType;
use App\Models\Student;
use Illuminate\Http\Request;

class FeeReportController extends Controller
{
    /**
     * Fee Collection Report
     */
    public function collection(Request $request)
    {
        $user = auth()->user();

        if (!$user || !$user->branch_id) {
            abort(403, 'Your account is not assigned to any branch.');
        }

        $branchId = $user->branch_id;

        /*
        |--------------------------------------------------------------------------
        | Payment Query
        |--------------------------------------------------------------------------
        */

        $query = FeePayment::with([
            'student',
            'feeType',
            'branch',
            'collector',
        ])
        ->where('branch_id', $branchId);

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
            ->latest('payment_date')
            ->latest('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Summary
        |--------------------------------------------------------------------------
        */

        $totalCollection = $payments->sum('amount');

        $totalTransactions = $payments->count();

        $cashCollection = $payments
            ->where('payment_method', 'cash')
            ->sum('amount');

        $bankCollection = $payments
            ->where('payment_method', 'bank')
            ->sum('amount');

        $mobileBankingCollection = $payments
            ->where('payment_method', 'mobile_banking')
            ->sum('amount');

        $otherCollection = $payments
            ->where('payment_method', 'other')
            ->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | Filter Options
        |--------------------------------------------------------------------------
        */

        $students = Student::where(
            'branch_id',
            $branchId
        )
        ->orderBy('name')
        ->get();

        $feeTypes = FeeType::where(
            'branch_id',
            $branchId
        )
        ->orderBy('name')
        ->get();

        /*
        |--------------------------------------------------------------------------
        | Branch
        |--------------------------------------------------------------------------
        */

        $branch = $user->branch;

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.fee-reports.collection',
            compact(
                'payments',
                'students',
                'feeTypes',
                'branch',
                'totalCollection',
                'totalTransactions',
                'cashCollection',
                'bankCollection',
                'mobileBankingCollection',
                'otherCollection'
            )
        );
    }

    /**
 * Fee Collection Report
 */
public function report(Request $request)
{
    $branchId = auth()->user()->branch_id;

    if (!$branchId) {
        abort(403, 'Your account is not assigned to any branch.');
    }

    $query = FeePayment::with([
        'student',
        'feeType',
        'branch',
        'collector',
        'studentFeeAssignment',
    ])->where('branch_id', $branchId);

    /*
    |--------------------------------------------------------------------------
    | Date Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('from_date')) {
        $query->whereDate('payment_date', '>=', $request->from_date);
    }

    if ($request->filled('to_date')) {
        $query->whereDate('payment_date', '<=', $request->to_date);
    }

    /*
    |--------------------------------------------------------------------------
    | Student Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('student_id')) {
        $query->where('student_id', $request->student_id);
    }

    /*
    |--------------------------------------------------------------------------
    | Fee Type Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('fee_type_id')) {
        $query->where('fee_type_id', $request->fee_type_id);
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

    $payments = $query
        ->latest('payment_date')
        ->latest('id')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Filter Data
    |--------------------------------------------------------------------------
    */

    $students = \App\Models\Student::where(
        'branch_id',
        $branchId
    )
        ->orderBy('name')
        ->get();

    $feeTypes = \App\Models\FeeType::where(
        'branch_id',
        $branchId
    )
        ->orderBy('name')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Summary
    |--------------------------------------------------------------------------
    */

    $totalCollected = $payments->sum('amount');

    $totalTransactions = $payments->count();

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

    return view(
        'admin.fee-collection.report',
        compact(
            'payments',
            'students',
            'feeTypes',
            'totalCollected',
            'totalTransactions',
            'cashTotal',
            'bankTotal',
            'mobileBankingTotal',
            'otherTotal'
        )
    );
}


}