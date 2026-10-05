@extends('admin.layouts.app')

@section('title', 'Account Details')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <div class="flex flex-wrap items-center gap-2">

                <h1 class="text-2xl font-bold text-slate-800">
                    {{ $account->name }}
                </h1>

                @if($account->is_active)

                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                        Active
                    </span>

                @else

                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                        Inactive
                    </span>

                @endif

            </div>

            <p class="mt-1 text-sm text-slate-500">
                Account / Cash & Bank details
            </p>

        </div>


        <div class="flex flex-wrap gap-2">

            <a
                href="{{ route('accounts.index') }}"
                class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50"
            >
                ← Back
            </a>

            <a
                href="{{ route('accounts.ledger', $account) }}"
                class="inline-flex items-center justify-center rounded-lg bg-slate-800 px-4 py-2.5 text-sm font-semibold text-white hover:bg-slate-900"
            >
                View Ledger
            </a>

            <a
                href="{{ route('accounts.edit', $account) }}"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-700"
            >
                Edit
            </a>

        </div>

    </div>


    {{-- Balance Summary --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        {{-- Opening Balance --}}
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <p class="text-sm font-medium text-slate-500">
                Opening Balance
            </p>

            <p class="mt-2 text-2xl font-bold text-slate-800">
                ৳ {{ number_format($account->opening_balance, 2) }}
            </p>

        </div>


        {{-- Total Credit --}}
        <div class="rounded-xl border border-green-200 bg-green-50 p-5">

            <p class="text-sm font-medium text-green-700">
                Total Credit
            </p>

            <p class="mt-2 text-2xl font-bold text-green-800">
                + ৳ {{ number_format($totalCredit, 2) }}
            </p>

            <p class="mt-1 text-xs text-green-600">
                Money received / added
            </p>

        </div>


        {{-- Total Debit --}}
        <div class="rounded-xl border border-red-200 bg-red-50 p-5">

            <p class="text-sm font-medium text-red-700">
                Total Debit
            </p>

            <p class="mt-2 text-2xl font-bold text-red-800">
                - ৳ {{ number_format($totalDebit, 2) }}
            </p>

            <p class="mt-1 text-xs text-red-600">
                Money paid / deducted
            </p>

        </div>


        {{-- Current Balance --}}
        <div class="rounded-xl border border-blue-200 bg-blue-50 p-5">

            <p class="text-sm font-medium text-blue-700">
                Current Balance
            </p>

            <p class="mt-2 text-2xl font-bold text-blue-800">
                ৳ {{ number_format($currentBalance, 2) }}
            </p>

            <p class="mt-1 text-xs text-blue-600">
                Available account balance
            </p>

        </div>

    </div>


    {{-- Account Details --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- Main Details --}}
        <div class="lg:col-span-2 rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">

                <h2 class="text-base font-bold text-slate-800">
                    Account Information
                </h2>

            </div>


            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-5 sm:grid-cols-2">

                {{-- Account Name --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Account Name
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $account->name }}
                    </p>

                </div>


                {{-- Account Type --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Account Type
                    </p>

                    <p class="mt-1 text-sm font-semibold capitalize text-slate-700">
                        {{ str_replace('_', ' ', $account->type) }}
                    </p>

                </div>


                {{-- Branch --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Branch
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">
                        {{ $account->branch->name ?? 'N/A' }}
                    </p>

                </div>


                {{-- Account Number --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Account Number
                    </p>

                    <p class="mt-1 break-all text-sm text-slate-700">
                        {{ $account->account_number ?: '—' }}
                    </p>

                </div>


                {{-- Bank / Provider --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Bank / Provider
                    </p>

                    <p class="mt-1 text-sm text-slate-700">
                        {{ $account->bank_name ?: '—' }}
                    </p>

                </div>


                {{-- Opening Balance Date --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Opening Balance Date
                    </p>

                    <p class="mt-1 text-sm text-slate-700">
                        {{ $account->opening_balance_date?->format('d M Y') ?? '—' }}
                    </p>

                </div>


                {{-- Created --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Created
                    </p>

                    <p class="mt-1 text-sm text-slate-700">
                        {{ $account->created_at?->format('d M Y h:i A') }}
                    </p>

                </div>


                {{-- Updated --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Last Updated
                    </p>

                    <p class="mt-1 text-sm text-slate-700">
                        {{ $account->updated_at?->format('d M Y h:i A') }}
                    </p>

                </div>


                {{-- Description --}}
                <div class="sm:col-span-2">

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Description
                    </p>

                    <div class="mt-2 rounded-lg bg-slate-50 p-4">

                        <p class="whitespace-pre-line text-sm leading-6 text-slate-700">
                            {{ $account->description ?: 'No description provided.' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- Quick Actions --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">

                <h2 class="text-base font-bold text-slate-800">
                    Quick Actions
                </h2>

            </div>


            <div class="space-y-3 p-5">

                <a
                    href="{{ route('accounts.ledger', $account) }}"
                    class="flex items-center justify-between rounded-lg border border-blue-200 bg-blue-50 px-4 py-3 text-sm font-semibold text-blue-700 transition hover:bg-blue-100"
                >
                    <span>Account Ledger</span>
                    <span>→</span>
                </a>


                <a
                    href="{{ route('account-transactions.create') }}"
                    class="flex items-center justify-between rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700 transition hover:bg-green-100"
                >
                    <span>Add Transaction</span>
                    <span>+</span>
                </a>


                <a
                    href="{{ route('account-transactions.transfer.create') }}"
                    class="flex items-center justify-between rounded-lg border border-purple-200 bg-purple-50 px-4 py-3 text-sm font-semibold text-purple-700 transition hover:bg-purple-100"
                >
                    <span>Transfer Money</span>
                    <span>→</span>
                </a>


                <a
                    href="{{ route('accounts.edit', $account) }}"
                    class="flex items-center justify-between rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                >
                    <span>Edit Account</span>
                    <span>✎</span>
                </a>

            </div>

        </div>

    </div>


    {{-- Balance Formula --}}
    <div class="rounded-xl border border-blue-200 bg-blue-50 p-5">

        <h2 class="text-sm font-bold text-blue-800">
            Current Balance Calculation
        </h2>

        <div class="mt-4 grid grid-cols-1 gap-3 text-sm sm:grid-cols-4">

            <div class="rounded-lg bg-white p-3">

                <p class="text-xs text-slate-500">
                    Opening Balance
                </p>

                <p class="mt-1 font-bold text-slate-800">
                    ৳ {{ number_format($account->opening_balance, 2) }}
                </p>

            </div>


            <div class="rounded-lg bg-white p-3">

                <p class="text-xs text-slate-500">
                    + Credit
                </p>

                <p class="mt-1 font-bold text-green-600">
                    ৳ {{ number_format($totalCredit, 2) }}
                </p>

            </div>


            <div class="rounded-lg bg-white p-3">

                <p class="text-xs text-slate-500">
                    - Debit
                </p>

                <p class="mt-1 font-bold text-red-600">
                    ৳ {{ number_format($totalDebit, 2) }}
                </p>

            </div>


            <div class="rounded-lg bg-white p-3">

                <p class="text-xs text-slate-500">
                    = Current Balance
                </p>

                <p class="mt-1 font-bold text-blue-700">
                    ৳ {{ number_format($currentBalance, 2) }}
                </p>

            </div>

        </div>

    </div>


    {{-- Delete --}}
    <div class="flex justify-end">

        <form
            method="POST"
            action="{{ route('accounts.destroy', $account) }}"
            onsubmit="return confirm('Are you sure you want to delete this account?')"
        >

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="rounded-lg border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100"
            >
                Delete Account
            </button>

        </form>

    </div>

</div>

@endsection