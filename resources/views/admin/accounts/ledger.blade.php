@extends('admin.layouts.app')

@section('title', 'Account Ledger')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                {{ $account->name }} - Ledger
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Complete transaction history and account balance
            </p>
        </div>

        <div class="flex flex-wrap gap-2">

            <a
                href="{{ route('accounts.show', $account) }}"
                class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50"
            >
                ← Account
            </a>

            <button
                type="button"
                onclick="window.print()"
                class="inline-flex items-center justify-center rounded-lg bg-slate-800 px-4 py-2.5 text-sm font-semibold text-white hover:bg-slate-900"
            >
                Print
            </button>

        </div>

    </div>


    {{-- Account Information --}}
    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Account --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Account
                </p>

                <p class="mt-1 text-sm font-bold text-slate-800">
                    {{ $account->name }}
                </p>

            </div>


            {{-- Account Type --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Type
                </p>

                <p class="mt-1 text-sm font-semibold capitalize text-slate-700">
                    {{ str_replace('_', ' ', $account->type) }}
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


            {{-- Bank --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Bank / Provider
                </p>

                <p class="mt-1 text-sm text-slate-700">
                    {{ $account->bank_name ?: '—' }}
                </p>

            </div>

        </div>

    </div>


    {{-- Date Filter --}}
    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

        <form
            method="GET"
            action="{{ route('accounts.ledger', $account) }}"
            class="grid grid-cols-1 gap-4 md:grid-cols-3"
        >

            {{-- From --}}
            <div>

                <label class="mb-1 block text-sm font-medium text-slate-700">
                    From Date
                </label>

                <input
                    type="date"
                    name="from_date"
                    value="{{ request('from_date') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- To --}}
            <div>

                <label class="mb-1 block text-sm font-medium text-slate-700">
                    To Date
                </label>

                <input
                    type="date"
                    name="to_date"
                    value="{{ request('to_date') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- Buttons --}}
            <div class="flex items-end gap-2">

                <button
                    type="submit"
                    class="flex-1 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-700"
                >
                    Filter
                </button>

                <a
                    href="{{ route('accounts.ledger', $account) }}"
                    class="rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- Balance Summary --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        {{-- Opening --}}
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <p class="text-sm font-medium text-slate-500">
                Opening Balance
            </p>

            <p class="mt-2 text-2xl font-bold text-slate-800">
                ৳ {{ number_format($account->opening_balance, 2) }}
            </p>

        </div>


        {{-- Credit --}}
        <div class="rounded-xl border border-green-200 bg-green-50 p-5">

            <p class="text-sm font-medium text-green-700">
                Total Credit
            </p>

            <p class="mt-2 text-2xl font-bold text-green-800">
                + ৳ {{ number_format($totalCredit, 2) }}
            </p>

        </div>


        {{-- Debit --}}
        <div class="rounded-xl border border-red-200 bg-red-50 p-5">

            <p class="text-sm font-medium text-red-700">
                Total Debit
            </p>

            <p class="mt-2 text-2xl font-bold text-red-800">
                - ৳ {{ number_format($totalDebit, 2) }}
            </p>

        </div>


        {{-- Current --}}
        <div class="rounded-xl border border-blue-200 bg-blue-50 p-5">

            <p class="text-sm font-medium text-blue-700">
                Current Balance
            </p>

            <p class="mt-2 text-2xl font-bold text-blue-800">
                ৳ {{ number_format($currentBalance, 2) }}
            </p>

        </div>

    </div>


    {{-- Ledger Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-4">

            <h2 class="text-base font-bold text-slate-800">
                Transaction Ledger
            </h2>

        </div>


        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                            Date
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                            Type
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                            Description
                        </th>

                        <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">
                            Credit
                        </th>

                        <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">
                            Debit
                        </th>

                        <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">
                            Balance
                        </th>

                        <th class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    {{-- Opening Balance Row --}}
                    <tr class="bg-blue-50">

                        <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-700">
                            {{ $account->opening_balance_date?->format('d M Y') ?? 'Opening' }}
                        </td>

                        <td class="px-5 py-4">

                            <span class="rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                Opening
                            </span>

                        </td>

                        <td class="px-5 py-4 text-sm font-medium text-slate-700">
                            Opening Balance
                        </td>

                        <td class="px-5 py-4 text-right text-sm font-semibold text-green-600">
                            ৳ {{ number_format($account->opening_balance, 2) }}
                        </td>

                        <td class="px-5 py-4 text-right text-sm text-slate-400">
                            —
                        </td>

                        <td class="px-5 py-4 text-right text-sm font-bold text-blue-700">
                            ৳ {{ number_format($account->opening_balance, 2) }}
                        </td>

                        <td class="px-5 py-4 text-center text-sm text-slate-400">
                            —
                        </td>

                    </tr>


                    @php
                        $runningBalance = (float) $account->opening_balance;
                    @endphp


                    @forelse($transactions as $transaction)

                        @php
                            if ($transaction->direction === 'credit') {
                                $runningBalance += (float) $transaction->amount;
                            } else {
                                $runningBalance -= (float) $transaction->amount;
                            }
                        @endphp


                        <tr class="transition hover:bg-slate-50">

                            {{-- Date --}}
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-700">
                                {{ $transaction->transaction_date?->format('d M Y') }}
                            </td>


                            {{-- Type --}}
                            <td class="px-5 py-4">

                                @if($transaction->transaction_type === 'income')

                                    <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                                        Income
                                    </span>

                                @elseif($transaction->transaction_type === 'expense')

                                    <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                                        Expense
                                    </span>

                                @else

                                    <span class="rounded-full bg-purple-100 px-2.5 py-1 text-xs font-semibold text-purple-700">
                                        Transfer
                                    </span>

                                @endif

                            </td>


                            {{-- Description --}}
                            <td class="max-w-sm px-5 py-4">

                                <div class="text-sm text-slate-700">
                                    {{ $transaction->description ?: '—' }}
                                </div>

                                @if($transaction->transfer_reference)

                                    <div class="mt-1 text-xs text-slate-400">
                                        {{ $transaction->transfer_reference }}
                                    </div>

                                @endif

                            </td>


                            {{-- Credit --}}
                            <td class="whitespace-nowrap px-5 py-4 text-right text-sm font-semibold text-green-600">

                                @if($transaction->direction === 'credit')
                                    + ৳ {{ number_format($transaction->amount, 2) }}
                                @else
                                    —
                                @endif

                            </td>


                            {{-- Debit --}}
                            <td class="whitespace-nowrap px-5 py-4 text-right text-sm font-semibold text-red-600">

                                @if($transaction->direction === 'debit')
                                    - ৳ {{ number_format($transaction->amount, 2) }}
                                @else
                                    —
                                @endif

                            </td>


                            {{-- Running Balance --}}
                            <td class="whitespace-nowrap px-5 py-4 text-right text-sm font-bold text-slate-800">

                                ৳ {{ number_format($runningBalance, 2) }}

                            </td>


                            {{-- Action --}}
                            <td class="px-5 py-4 text-center">

                                <a
                                    href="{{ route('account-transactions.show', $transaction) }}"
                                    class="inline-flex rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50"
                                >
                                    View
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="px-5 py-12 text-center">

                                <p class="text-sm font-medium text-slate-500">
                                    No transactions found.
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    This account has no transaction activity yet.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>


                {{-- Footer --}}
                <tfoot class="border-t-2 border-slate-200 bg-slate-50">

                    <tr>

                        <td colspan="3" class="px-5 py-4 text-right text-sm font-bold text-slate-700">
                            Total
                        </td>

                        <td class="px-5 py-4 text-right text-sm font-bold text-green-700">
                            ৳ {{ number_format($totalCredit, 2) }}
                        </td>

                        <td class="px-5 py-4 text-right text-sm font-bold text-red-700">
                            ৳ {{ number_format($totalDebit, 2) }}
                        </td>

                        <td class="px-5 py-4 text-right text-sm font-bold text-blue-700">
                            ৳ {{ number_format($currentBalance, 2) }}
                        </td>

                        <td></td>

                    </tr>

                </tfoot>

            </table>

        </div>

    </div>


    {{-- Mobile Ledger --}}
    <div class="space-y-4 lg:hidden">

        @php
            $mobileRunningBalance = (float) $account->opening_balance;
        @endphp

        @forelse($transactions as $transaction)

            @php
                if ($transaction->direction === 'credit') {
                    $mobileRunningBalance += (float) $transaction->amount;
                } else {
                    $mobileRunningBalance -= (float) $transaction->amount;
                }
            @endphp

            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-start justify-between gap-3">

                    <div>

                        <p class="text-sm font-bold text-slate-800">
                            {{ $transaction->transaction_date?->format('d M Y') }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            {{ $transaction->description ?: 'No description' }}
                        </p>

                    </div>


                    @if($transaction->transaction_type === 'income')

                        <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                            Income
                        </span>

                    @elseif($transaction->transaction_type === 'expense')

                        <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                            Expense
                        </span>

                    @else

                        <span class="rounded-full bg-purple-100 px-2.5 py-1 text-xs font-semibold text-purple-700">
                            Transfer
                        </span>

                    @endif

                </div>


                <div class="mt-4 grid grid-cols-2 gap-3">

                    <div class="rounded-lg bg-green-50 p-3">

                        <p class="text-xs text-green-600">
                            Credit
                        </p>

                        <p class="mt-1 text-sm font-bold text-green-700">

                            @if($transaction->direction === 'credit')
                                ৳ {{ number_format($transaction->amount, 2) }}
                            @else
                                —
                            @endif

                        </p>

                    </div>


                    <div class="rounded-lg bg-red-50 p-3">

                        <p class="text-xs text-red-600">
                            Debit
                        </p>

                        <p class="mt-1 text-sm font-bold text-red-700">

                            @if($transaction->direction === 'debit')
                                ৳ {{ number_format($transaction->amount, 2) }}
                            @else
                                —
                            @endif

                        </p>

                    </div>

                </div>


                <div class="mt-3 flex items-center justify-between border-t border-slate-100 pt-3">

                    <span class="text-xs font-medium text-slate-500">
                        Running Balance
                    </span>

                    <span class="text-sm font-bold text-slate-800">
                        ৳ {{ number_format($mobileRunningBalance, 2) }}
                    </span>

                </div>


                <div class="mt-3">

                    <a
                        href="{{ route('account-transactions.show', $transaction) }}"
                        class="block rounded-lg border border-slate-200 px-3 py-2 text-center text-xs font-semibold text-slate-700 hover:bg-slate-50"
                    >
                        View Transaction
                    </a>

                </div>

            </div>

        @empty

            <div class="rounded-xl border border-slate-200 bg-white p-8 text-center shadow-sm">

                <p class="text-sm font-medium text-slate-500">
                    No transactions found.
                </p>

            </div>

        @endforelse

    </div>

</div>


{{-- Print CSS --}}
<style>

    @media print {

        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            background: white !important;
        }

        aside,
        nav,
        header,
        footer,
        .no-print {
            display: none !important;
        }

        button,
        a {
            display: none !important;
        }

        .shadow-sm,
        .shadow {
            box-shadow: none !important;
        }

    }

</style>

@endsection