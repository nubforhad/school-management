<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        /*
        |--------------------------------------------------------------------------
        | Date Filter
        |--------------------------------------------------------------------------
        */

        $dateFrom = $request->date_from;
        $dateTo   = $request->date_to;

        /*
        |--------------------------------------------------------------------------
        | Default Date
        |--------------------------------------------------------------------------
        */

        if (!$dateFrom && !$dateTo) {
            $dateFrom = now()->startOfMonth()->toDateString();
            $dateTo   = now()->toDateString();
        }

        /*
        |--------------------------------------------------------------------------
        | Finance Summary
        |--------------------------------------------------------------------------
        |
        | এখানে Fee Payment, Salary এবং Expense-এর actual
        | table/model বসানো হবে।
        |
        */

        $totalIncome = 0;
        $totalExpense = 0;

        $feeIncome = 0;
        $salaryExpense = 0;
        $otherExpense = 0;

        $netBalance = $totalIncome - $totalExpense;

        return view('admin.finance.index', compact(
            'dateFrom',
            'dateTo',
            'totalIncome',
            'totalExpense',
            'netBalance',
            'feeIncome',
            'salaryExpense',
            'otherExpense'
        ));
    }
}