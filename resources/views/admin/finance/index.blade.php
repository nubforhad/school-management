@extends('admin.layouts.app')

@section('title', ' Finance ')

@section('content')
<div class="p-4 sm:p-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                Finance Dashboard
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Income, expense and balance overview
            </p>
        </div>

    </div>


    {{-- Date Filter --}}
    <div class="bg-white border border-slate-200 rounded-xl p-4 mb-6">

        <form method="GET"
              action="{{ route('admin.finance.index') }}"
              class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            {{-- From Date --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    From Date
                </label>

                <input
                    type="date"
                    name="date_from"
                    value="{{ $dateFrom }}"
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                >
            </div>

            {{-- To Date --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    To Date
                </label>

                <input
                    type="date"
                    name="date_to"
                    value="{{ $dateTo }}"
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                >
            </div>

            {{-- Search --}}
            <div class="flex items-end">
                <button
                    type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition"
                >
                    <i class="bi bi-search"></i>
                    Filter
                </button>
            </div>

            {{-- Reset --}}
            <div class="flex items-end">
                <a
                    href="{{ route('admin.finance.index') }}"
                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 transition"
                >
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </a>
            </div>

        </form>

    </div>


    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

        {{-- Total Income --}}
        <div class="bg-white border border-slate-200 rounded-xl p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Total Income
                    </p>

                    <h2 class="text-2xl font-bold text-green-600 mt-2">
                        ৳ {{ number_format($totalIncome, 2) }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center">
                    <i class="bi bi-arrow-down-left text-xl text-green-600"></i>
                </div>

            </div>

        </div>


        {{-- Total Expense --}}
        <div class="bg-white border border-slate-200 rounded-xl p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Total Expense
                    </p>

                    <h2 class="text-2xl font-bold text-red-600 mt-2">
                        ৳ {{ number_format($totalExpense, 2) }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center">
                    <i class="bi bi-arrow-up-right text-xl text-red-600"></i>
                </div>

            </div>

        </div>


        {{-- Net Balance --}}
        <div class="bg-white border border-slate-200 rounded-xl p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Net Balance
                    </p>

                    <h2 class="text-2xl font-bold
                        {{ $netBalance >= 0 ? 'text-blue-600' : 'text-red-600' }}
                        mt-2">

                        ৳ {{ number_format($netBalance, 2) }}

                    </h2>
                </div>

                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
                    <i class="bi bi-wallet2 text-xl text-blue-600"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- Income / Expense Breakdown --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Income --}}
        <div class="bg-white border border-slate-200 rounded-xl">

            <div class="px-5 py-4 border-b border-slate-200">
                <h3 class="font-semibold text-slate-800">
                    Income Summary
                </h3>
            </div>

            <div class="p-5">

                <div class="flex items-center justify-between py-3 border-b border-slate-100">
                    <span class="text-slate-600">
                        Fee Collection
                    </span>

                    <span class="font-semibold text-green-600">
                        ৳ {{ number_format($feeIncome, 2) }}
                    </span>
                </div>

                <div class="flex items-center justify-between py-3">
                    <span class="font-medium text-slate-800">
                        Total Income
                    </span>

                    <span class="font-bold text-green-600">
                        ৳ {{ number_format($totalIncome, 2) }}
                    </span>
                </div>

            </div>

        </div>


        {{-- Expense --}}
        <div class="bg-white border border-slate-200 rounded-xl">

            <div class="px-5 py-4 border-b border-slate-200">
                <h3 class="font-semibold text-slate-800">
                    Expense Summary
                </h3>
            </div>

            <div class="p-5">

                <div class="flex items-center justify-between py-3 border-b border-slate-100">
                    <span class="text-slate-600">
                        Salary
                    </span>

                    <span class="font-semibold text-red-600">
                        ৳ {{ number_format($salaryExpense, 2) }}
                    </span>
                </div>

                <div class="flex items-center justify-between py-3 border-b border-slate-100">
                    <span class="text-slate-600">
                        Other Expense
                    </span>

                    <span class="font-semibold text-red-600">
                        ৳ {{ number_format($otherExpense, 2) }}
                    </span>
                </div>

                <div class="flex items-center justify-between py-3">
                    <span class="font-medium text-slate-800">
                        Total Expense
                    </span>

                    <span class="font-bold text-red-600">
                        ৳ {{ number_format($totalExpense, 2) }}
                    </span>
                </div>

            </div>

        </div>

    </div>


    {{-- Net Balance --}}
    <div class="mt-6 bg-white border border-slate-200 rounded-xl p-5">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div>
                <h3 class="font-semibold text-slate-800">
                    Financial Position
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $dateFrom }} to {{ $dateTo }}
                </p>
            </div>

            <div class="text-left sm:text-right">

                <p class="text-sm text-slate-500">
                    Net Balance
                </p>

                <p class="text-2xl font-bold
                    {{ $netBalance >= 0 ? 'text-green-600' : 'text-red-600' }}">

                    ৳ {{ number_format($netBalance, 2) }}

                </p>

            </div>

        </div>

    </div>

</div>
@endsection