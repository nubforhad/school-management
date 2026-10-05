<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AccountTransactionController extends Controller
{
    /**
     * Transaction Ledger
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $transactions = AccountTransaction::with([
            'account',
            'creator',
        ]) 
            ->where('branch_id', $user->branch_id)

            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('description', 'like', "%{$search}%")
                        ->orWhere('transfer_reference', 'like', "%{$search}%")
                        ->orWhere('reference_type', 'like', "%{$search}%");
                });
            })

            ->when($request->filled('account_id'), function ($query) use ($request) {
                $query->where('account_id', $request->account_id);
            })

            ->when($request->filled('transaction_type'), function ($query) use ($request) {
                $query->where('transaction_type', $request->transaction_type);
            })

            ->when($request->filled('direction'), function ($query) use ($request) {
                $query->where('direction', $request->direction);
            })

            ->when($request->filled('from_date'), function ($query) use ($request) {
                $query->whereDate(
                    'transaction_date',
                    '>=',
                    $request->from_date
                );
            })

            ->when($request->filled('to_date'), function ($query) use ($request) {
                $query->whereDate(
                    'transaction_date',
                    '<=',
                    $request->to_date
                );
            })

            ->latest('transaction_date')
            ->latest('id')
            ->paginate(20)
            ->withQueryString();

        $accounts = Account::where('branch_id', $user->branch_id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Summary
        |--------------------------------------------------------------------------
        */

        $summaryQuery = AccountTransaction::where('branch_id', $user->branch_id);

        $totalIncome = (clone $summaryQuery)
            ->where('transaction_type', 'income')
            ->where('direction', 'credit')
            ->sum('amount');

        $totalExpense = (clone $summaryQuery)
            ->where('transaction_type', 'expense')
            ->where('direction', 'debit')
            ->sum('amount');

        $totalTransferIn = (clone $summaryQuery)
            ->where('transaction_type', 'transfer')
            ->where('direction', 'credit')
            ->sum('amount');

        $totalTransferOut = (clone $summaryQuery)
            ->where('transaction_type', 'transfer')
            ->where('direction', 'debit')
            ->sum('amount');

        return view('admin.account-transactions.index', compact(
            'transactions',
            'accounts',
            'totalIncome',
            'totalExpense',
            'totalTransferIn',
            'totalTransferOut'
        ));
    }

    /**
     * Create transaction
     */
    public function create()
    {
        $user = auth()->user();

        $accounts = Account::where('branch_id', $user->branch_id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.account-transactions.create',
            compact('accounts')
        );
    }


    public function createTransfer()
    {
        $user = auth()->user();

        $accounts = Account::where('branch_id', $user->branch_id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.account-transactions.transfer',
            compact('accounts')
        );
    }

    /**
     * Store Income / Expense
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'account_id' => [
                'required',
                'integer',
                'exists:accounts,id',
            ],

            'transaction_date' => [
                'required',
                'date',
            ],

            'transaction_type' => [
                'required',
                'in:income,expense',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Verify Account belongs to current Company + Branch
        |--------------------------------------------------------------------------
        */

        $account = Account::where('id', $validated['account_id']) 
            ->where('branch_id', $user->branch_id)
            ->where('is_active', true)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Direction
        |--------------------------------------------------------------------------
        */

        $direction = $validated['transaction_type'] === 'income'
            ? 'credit'
            : 'debit';

        AccountTransaction::create([ 
            'branch_id' => $user->branch_id,
            'account_id' => $account->id,
            'transaction_date' => $validated['transaction_date'],
            'transaction_type' => $validated['transaction_type'],
            'direction' => $direction,
            'amount' => $validated['amount'],
            'description' => $validated['description'] ?? null,
            'created_by' => $user->id,
        ]);

        return redirect()
            ->route('account-transactions.index')
            ->with('success', 'Transaction created successfully.');
    }

    /**
     * Show transaction
     */
    public function show(AccountTransaction $accountTransaction)
    {
        $user = auth()->user();

        abort_unless( 
            $accountTransaction->branch_id == $user->branch_id,
            403
        );

        $accountTransaction->load([
            'account',
            'creator',
        ]);

        return view(
            'admin.account-transactions.show',
            compact('accountTransaction')
        );
    }

    /**
     * Delete transaction
     */
    public function destroy(AccountTransaction $accountTransaction)
    {
        $user = auth()->user();

        abort_unless( 
            $accountTransaction->branch_id == $user->branch_id,
            403
        );

        /*
        |--------------------------------------------------------------------------
        | Prevent deleting referenced transactions
        |--------------------------------------------------------------------------
        */

        if ($accountTransaction->reference_type) {
            return redirect()
                ->route('account-transactions.index')
                ->with(
                    'error',
                    'This transaction is linked with another module and cannot be deleted here.'
                );
        }

        $accountTransaction->delete();

        return redirect()
            ->route('account-transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }

    /**
     * Account Ledger
     */
    public function accountLedger(Account $account, Request $request)
    {
        $user = auth()->user();

        abort_unless( 
            $account->branch_id == $user->branch_id,
            403
        );

        $transactions = AccountTransaction::where(
            'account_id',
            $account->id
        ) 
            ->where('branch_id', $user->branch_id)
            ->when($request->filled('from_date'), function ($query) use ($request) {
                $query->whereDate(
                    'transaction_date',
                    '>=',
                    $request->from_date
                );
            })
            ->when($request->filled('to_date'), function ($query) use ($request) {
                $query->whereDate(
                    'transaction_date',
                    '<=',
                    $request->to_date
                );
            })
            ->orderBy('transaction_date')
            ->orderBy('id')
            ->get();

        $totalCredit = $transactions
            ->where('direction', 'credit')
            ->sum('amount');

        $totalDebit = $transactions
            ->where('direction', 'debit')
            ->sum('amount');

        $currentBalance =
            (float) $account->opening_balance
            + (float) $totalCredit
            - (float) $totalDebit;

        return view(
            'admin.accounts.ledger',
            compact(
                'account',
                'transactions',
                'totalCredit',
                'totalDebit',
                'currentBalance'
            )
        );
    }

    /**
     * Transfer money between accounts
     */
    public function transfer(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'from_account_id' => [
                'required',
                'integer',
                'different:to_account_id',
            ],

            'to_account_id' => [
                'required',
                'integer',
                'different:from_account_id',
            ],

            'transaction_date' => [
                'required',
                'date',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        $fromAccount = Account::where('id', $validated['from_account_id']) 
            ->where('branch_id', $user->branch_id)
            ->where('is_active', true)
            ->firstOrFail();

        $toAccount = Account::where('id', $validated['to_account_id']) 
            ->where('branch_id', $user->branch_id)
            ->where('is_active', true)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Check source account balance
        |--------------------------------------------------------------------------
        */

        $credit = AccountTransaction::where('account_id', $fromAccount->id) 
            ->where('branch_id', $user->branch_id)
            ->where('direction', 'credit')
            ->sum('amount');

        $debit = AccountTransaction::where('account_id', $fromAccount->id) 
            ->where('branch_id', $user->branch_id)
            ->where('direction', 'debit')
            ->sum('amount');

        $currentBalance =
            (float) $fromAccount->opening_balance
            + (float) $credit
            - (float) $debit;

        if ($currentBalance < (float) $validated['amount']) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Insufficient balance in the source account.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Transfer Reference
        |--------------------------------------------------------------------------
        */

        $transferReference =
            'TRF-' .
            now()->format('YmdHis') .
            '-' .
            strtoupper(Str::random(5));

        DB::transaction(function () use (
            $validated,
            $user,
            $fromAccount,
            $toAccount,
            $transferReference
        ) {
            /*
            |--------------------------------------------------------------------------
            | Source Account - Debit
            |--------------------------------------------------------------------------
            */

            AccountTransaction::create([ 
                'branch_id' => $user->branch_id,
                'account_id' => $fromAccount->id,
                'transaction_date' => $validated['transaction_date'],
                'transaction_type' => 'transfer',
                'direction' => 'debit',
                'amount' => $validated['amount'],
                'transfer_reference' => $transferReference,
                'description' => $validated['description'] ?? null,
                'created_by' => $user->id,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Destination Account - Credit
            |--------------------------------------------------------------------------
            */

            AccountTransaction::create([ 
                'branch_id' => $user->branch_id,
                'account_id' => $toAccount->id,
                'transaction_date' => $validated['transaction_date'],
                'transaction_type' => 'transfer',
                'direction' => 'credit',
                'amount' => $validated['amount'],
                'transfer_reference' => $transferReference,
                'description' => $validated['description'] ?? null,
                'created_by' => $user->id,
            ]);
        });

        return redirect()
            ->route('account-transactions.index')
            ->with(
                'success',
                'Account transfer completed successfully.'
            );
    }
}