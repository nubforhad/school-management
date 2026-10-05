<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $accounts = Account::with([ 'branch'])
            ->where('branch_id', $user->branch_id)
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('account_number', 'like', "%{$search}%")
                        ->orWhere('bank_name', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('type'), function ($query) use ($request) {
                $query->where('type', $request->type);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('is_active', $request->status);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.accounts.index', compact('accounts'));
    }

    public function create()
    {
        $user = auth()->user();
        $branches = Branch::where('company_id', $user->company_id)
            ->where('id', $user->branch_id)
            ->get();

        return view('admin.accounts.create', compact(
            'companies',
            'branches'
        ));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([ 
            'branch_id' => [
                'required',
                'integer',
                Rule::exists('branches', 'id')
                    ->where(fn ($query) => $query
                        ->where('company_id', $user->company_id)
                        ->where('id', $user->branch_id)),
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'type' => [
                'required',
                Rule::in([
                    'cash',
                    'bank',
                    'mobile_banking',
                ]),
            ],

            'account_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            'bank_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'opening_balance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'opening_balance_date' => [
                'nullable',
                'date',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['branch_id'] = $user->branch_id;
        $validated['is_active'] = $request->boolean('is_active');

        Account::create($validated);

        return redirect()
            ->route('accounts.index')
            ->with('success', 'Account created successfully.');
    }

    public function show(Account $account)
    {
        $user = auth()->user();

        abort_unless(
            $account->branch_id == $user->branch_id,
            403
        );

        return view('admin.accounts.show', compact('account'));
    }

    public function edit(Account $account)
    {
        $user = auth()->user();

        abort_unless(
            $account->branch_id == $user->branch_id,
            403
        ); 
        $branches = Branch::where('company_id', $user->company_id)
            ->where('id', $user->branch_id)
            ->get();

        return view('admin.accounts.edit', compact(
            'account', 
            'branches'
        ));
    }

    public function update(Request $request, Account $account)
    {
        $user = auth()->user();

        abort_unless(
            
            $account->branch_id == $user->branch_id,
            403
        );

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'type' => [
                'required',
                Rule::in([
                    'cash',
                    'bank',
                    'mobile_banking',
                ]),
            ],

            'account_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            'bank_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'opening_balance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'opening_balance_date' => [
                'nullable',
                'date',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);
 
        $validated['branch_id'] = $account->branch_id;
        $validated['is_active'] = $request->boolean('is_active');

        $account->update($validated);

        return redirect()
            ->route('accounts.index')
            ->with('success', 'Account updated successfully.');
    }

    public function destroy(Account $account)
    {
        $user = auth()->user();

        abort_unless(
            $account->branch_id == $user->branch_id,
            403
        );

        $account->delete();

        return redirect()
            ->route('accounts.index')
            ->with('success', 'Account deleted successfully.');
    }
}