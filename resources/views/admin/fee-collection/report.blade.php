@extends('admin.layouts.app')

@section('title', 'Fee Collection Report')
@section('page-title', 'Fee Collection Report')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="mb-5 sm:mb-6">

        <div class="flex flex-col lg:flex-row
                    lg:items-center lg:justify-between gap-3">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Fee Collection Report
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    View and analyze collected student fees
                </p>

            </div>


            <div class="flex flex-col sm:flex-row gap-2">

                <a href="{{ route('admin.fee-collection.index') }}"
                   class="inline-flex items-center justify-center gap-2
                          rounded-lg border border-slate-300
                          bg-white px-4 py-2.5
                          text-sm font-medium text-slate-700
                          hover:bg-slate-50 transition">

                    <i class="bi bi-arrow-left"></i>

                    Back

                </a>


                <button type="button"
                        onclick="window.print()"
                        class="inline-flex items-center justify-center gap-2
                               rounded-lg bg-blue-600
                               px-4 py-2.5
                               text-sm font-semibold text-white
                               hover:bg-blue-700 transition">

                    <i class="bi bi-printer"></i>

                    Print Report

                </button>

            </div>

        </div>

    </div>


    {{-- =========================================================
        FILTER
    ========================================================== --}}

    <div class="bg-white rounded-xl
                border border-slate-200
                shadow-sm mb-5
                print:hidden">

        <div class="border-b border-slate-200
                    bg-slate-50
                    px-4 sm:px-5 py-4">

            <div class="flex items-center gap-2">

                <div class="flex h-9 w-9
                            items-center justify-center
                            rounded-lg
                            bg-blue-50
                            text-blue-600">

                    <i class="bi bi-funnel"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Report Filters
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Filter fee collections by date, student or payment method
                    </p>

                </div>

            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.fee-collection.report') }}">

            <div class="p-4 sm:p-5">

                <div class="grid grid-cols-1
                            sm:grid-cols-2
                            lg:grid-cols-5 gap-4">


                    {{-- From Date --}}

                    <div>

                        <label for="from_date"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            From Date

                        </label>

                        <input type="date"
                               name="from_date"
                               id="from_date"
                               value="{{ request('from_date') }}"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white
                                      px-3 py-2.5
                                      text-sm text-slate-800
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100">

                    </div>


                    {{-- To Date --}}

                    <div>

                        <label for="to_date"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            To Date

                        </label>

                        <input type="date"
                               name="to_date"
                               id="to_date"
                               value="{{ request('to_date') }}"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white
                                      px-3 py-2.5
                                      text-sm text-slate-800
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100">

                    </div>


                    {{-- Student --}}

                    <div>

                        <label for="student_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Student

                        </label>

                        <select name="student_id"
                                id="student_id"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm text-slate-800
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100">

                            <option value="">
                                All Students
                            </option>

                            @foreach($students as $student)

                                <option value="{{ $student->id }}"
                                    {{ request('student_id') == $student->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $student->name }}

                                    @if($student->student_id)
                                        — {{ $student->student_id }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Fee Type --}}

                    <div>

                        <label for="fee_type_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Fee Type

                        </label>

                        <select name="fee_type_id"
                                id="fee_type_id"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm text-slate-800
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100">

                            <option value="">
                                All Fee Types
                            </option>

                            @foreach($feeTypes as $feeType)

                                <option value="{{ $feeType->id }}"
                                    {{ request('fee_type_id') == $feeType->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $feeType->name }}

                                    @if($feeType->code)
                                        — {{ $feeType->code }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Payment Method --}}

                    <div>

                        <label for="payment_method"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Payment Method

                        </label>

                        <select name="payment_method"
                                id="payment_method"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm text-slate-800
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100">

                            <option value="">
                                All Methods
                            </option>

                            <option value="cash"
                                {{ request('payment_method') === 'cash'
                                    ? 'selected'
                                    : '' }}>

                                Cash

                            </option>

                            <option value="bank"
                                {{ request('payment_method') === 'bank'
                                    ? 'selected'
                                    : '' }}>

                                Bank

                            </option>

                            <option value="mobile_banking"
                                {{ request('payment_method') === 'mobile_banking'
                                    ? 'selected'
                                    : '' }}>

                                Mobile Banking

                            </option>

                            <option value="other"
                                {{ request('payment_method') === 'other'
                                    ? 'selected'
                                    : '' }}>

                                Other

                            </option>

                        </select>

                    </div>

                </div>


                {{-- Filter Buttons --}}

                <div class="flex flex-col sm:flex-row
                            gap-2 mt-5">

                    <button type="submit"
                            class="inline-flex items-center
                                   justify-center gap-2
                                   rounded-lg
                                   bg-blue-600
                                   px-5 py-2.5
                                   text-sm font-semibold
                                   text-white
                                   hover:bg-blue-700
                                   transition">

                        <i class="bi bi-search"></i>

                        Generate Report

                    </button>


                    <a href="{{ route('admin.fee-collection.report') }}"
                       class="inline-flex items-center
                              justify-center gap-2
                              rounded-lg
                              border border-slate-300
                              bg-white
                              px-5 py-2.5
                              text-sm font-medium
                              text-slate-700
                              hover:bg-slate-50
                              transition">

                        <i class="bi bi-arrow-counterclockwise"></i>

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- =========================================================
        PRINT AREA
    ========================================================== --}}

    <div id="print-area">


        {{-- Report Header for Print --}}

        <div class="hidden print:block mb-5">

            <div class="text-center">

                <h1 class="text-2xl font-bold text-slate-800">
                    School Management System
                </h1>

                <h2 class="text-lg font-semibold text-slate-700 mt-1">
                    Fee Collection Report
                </h2>

                @if(request('from_date') || request('to_date'))

                    <p class="text-sm text-slate-500 mt-1">

                        Period:

                        {{ request('from_date')
                            ? \Carbon\Carbon::parse(request('from_date'))->format('d M Y')
                            : 'Beginning'
                        }}

                        -

                        {{ request('to_date')
                            ? \Carbon\Carbon::parse(request('to_date'))->format('d M Y')
                            : 'Today'
                        }}

                    </p>

                @endif

            </div>

            <div class="border-b border-slate-300 mt-4"></div>

        </div>


        {{-- =====================================================
            SUMMARY CARDS
        ====================================================== --}}

        <div class="grid grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-4 gap-4 mb-5">


            {{-- Total Collection --}}

            <div class="rounded-xl
                        border border-blue-200
                        bg-blue-50
                        p-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11
                                items-center justify-center
                                rounded-xl
                                bg-white
                                text-blue-600">

                        <i class="bi bi-cash-stack text-xl"></i>

                    </div>

                    <div>

                        <p class="text-xs text-blue-600">
                            Total Collection
                        </p>

                        <p class="mt-1 text-xl font-bold text-blue-800">

                            ৳ {{ number_format($totalCollected, 2) }}

                        </p>

                    </div>

                </div>

            </div>


            {{-- Transactions --}}

            <div class="rounded-xl
                        border border-slate-200
                        bg-slate-50
                        p-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11
                                items-center justify-center
                                rounded-xl
                                bg-white
                                text-slate-600">

                        <i class="bi bi-receipt text-xl"></i>

                    </div>

                    <div>

                        <p class="text-xs text-slate-500">
                            Transactions
                        </p>

                        <p class="mt-1 text-xl font-bold text-slate-800">

                            {{ number_format($totalTransactions) }}

                        </p>

                    </div>

                </div>

            </div>


            {{-- Cash --}}

            <div class="rounded-xl
                        border border-green-200
                        bg-green-50
                        p-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11
                                items-center justify-center
                                rounded-xl
                                bg-white
                                text-green-600">

                        <i class="bi bi-wallet2 text-xl"></i>

                    </div>

                    <div>

                        <p class="text-xs text-green-600">
                            Cash
                        </p>

                        <p class="mt-1 text-xl font-bold text-green-700">

                            ৳ {{ number_format($cashTotal, 2) }}

                        </p>

                    </div>

                </div>

            </div>


            {{-- Bank / Mobile --}}

            <div class="rounded-xl
                        border border-purple-200
                        bg-purple-50
                        p-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11
                                items-center justify-center
                                rounded-xl
                                bg-white
                                text-purple-600">

                        <i class="bi bi-bank text-xl"></i>

                    </div>

                    <div>

                        <p class="text-xs text-purple-600">
                            Bank + Mobile
                        </p>

                        <p class="mt-1 text-xl font-bold text-purple-700">

                            ৳ {{ number_format(
                                $bankTotal + $mobileBankingTotal,
                                2
                            ) }}

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            PAYMENT METHOD SUMMARY
        ====================================================== --}}

        <div class="bg-white rounded-xl
                    border border-slate-200
                    shadow-sm mb-5">

            <div class="border-b border-slate-200
                        px-4 sm:px-5 py-4">

                <h2 class="font-semibold text-slate-800">

                    Payment Method Summary

                </h2>

            </div>


            <div class="grid grid-cols-2
                        sm:grid-cols-4">

                {{-- Cash --}}

                <div class="p-4 sm:p-5
                            border-b sm:border-b-0
                            sm:border-r
                            border-slate-200">

                    <p class="text-xs text-slate-500">
                        Cash
                    </p>

                    <p class="mt-1 text-lg font-bold text-slate-800">

                        ৳ {{ number_format($cashTotal, 2) }}

                    </p>

                </div>


                {{-- Bank --}}

                <div class="p-4 sm:p-5
                            border-b sm:border-b-0
                            sm:border-r
                            border-slate-200">

                    <p class="text-xs text-slate-500">
                        Bank
                    </p>

                    <p class="mt-1 text-lg font-bold text-slate-800">

                        ৳ {{ number_format($bankTotal, 2) }}

                    </p>

                </div>


                {{-- Mobile Banking --}}

                <div class="p-4 sm:p-5
                            border-b sm:border-b-0
                            sm:border-r
                            border-slate-200">

                    <p class="text-xs text-slate-500">
                        Mobile Banking
                    </p>

                    <p class="mt-1 text-lg font-bold text-slate-800">

                        ৳ {{ number_format($mobileBankingTotal, 2) }}

                    </p>

                </div>


                {{-- Other --}}

                <div class="p-4 sm:p-5">

                    <p class="text-xs text-slate-500">
                        Other
                    </p>

                    <p class="mt-1 text-lg font-bold text-slate-800">

                        ৳ {{ number_format($otherTotal, 2) }}

                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            PAYMENT TABLE
        ====================================================== --}}

        <div class="bg-white rounded-xl
                    border border-slate-200
                    shadow-sm overflow-hidden">

            <div class="p-4 sm:p-5
                        border-b border-slate-200">

                <div class="flex flex-col sm:flex-row
                            sm:items-center
                            sm:justify-between gap-2">

                    <div>

                        <h2 class="text-base sm:text-lg
                                   font-semibold text-slate-800">

                            Payment Transactions

                        </h2>

                        <p class="text-xs sm:text-sm
                                  text-slate-500 mt-1">

                            Complete fee collection transaction history

                        </p>

                    </div>


                    <div class="text-xs sm:text-sm text-slate-500">

                        Transactions:

                        <span class="font-semibold text-slate-700">

                            {{ $payments->count() }}

                        </span>

                    </div>

                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full min-w-[1050px]
                              text-xs sm:text-sm">

                    <thead class="bg-slate-50
                                  border-b border-slate-200">

                        <tr>

                            <th class="px-4 py-3 text-left
                                       font-semibold text-slate-600">
                                #
                            </th>

                            <th class="px-4 py-3 text-left
                                       font-semibold text-slate-600">
                                Date
                            </th>

                            <th class="px-4 py-3 text-left
                                       font-semibold text-slate-600">
                                Student
                            </th>

                            <th class="px-4 py-3 text-left
                                       font-semibold text-slate-600">
                                Fee Type
                            </th>

                            <th class="px-4 py-3 text-left
                                       font-semibold text-slate-600">
                                Payment Method
                            </th>

                            <th class="px-4 py-3 text-left
                                       font-semibold text-slate-600">
                                Reference
                            </th>

                            <th class="px-4 py-3 text-left
                                       font-semibold text-slate-600">
                                Collected By
                            </th>

                            <th class="px-4 py-3 text-right
                                       font-semibold text-slate-600">
                                Amount
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse($payments as $payment)

                            <tr class="hover:bg-slate-50 transition">


                                {{-- # --}}

                                <td class="px-4 py-3 text-slate-500">

                                    {{ $loop->iteration }}

                                </td>


                                {{-- Date --}}

                                <td class="px-4 py-3">

                                    <span class="font-medium text-slate-700">

                                        {{ \Carbon\Carbon::parse(
                                            $payment->payment_date
                                        )->format('d M Y') }}

                                    </span>

                                </td>


                                {{-- Student --}}

                                <td class="px-4 py-3">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-9 w-9
                                                    shrink-0
                                                    items-center justify-center
                                                    rounded-full
                                                    bg-blue-50
                                                    text-blue-600
                                                    font-semibold">

                                            {{
                                                strtoupper(
                                                    substr(
                                                        $payment->student->name ?? 'S',
                                                        0,
                                                        1
                                                    )
                                                )
                                            }}

                                        </div>

                                        <div>

                                            <p class="font-semibold text-slate-800">

                                                {{ $payment->student->name ?? 'N/A' }}

                                            </p>

                                            <p class="text-xs text-slate-400">

                                                ID:

                                                {{ $payment->student->student_id
                                                    ?? $payment->student_id }}

                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Fee Type --}}

                                <td class="px-4 py-3">

                                    <p class="font-medium text-slate-700">

                                        {{ $payment->feeType->name ?? 'N/A' }}

                                    </p>

                                    @if($payment->feeType?->code)

                                        <p class="text-xs text-slate-400">

                                            {{ $payment->feeType->code }}

                                        </p>

                                    @endif

                                </td>


                                {{-- Payment Method --}}

                                <td class="px-4 py-3">

                                    @php

                                        $methodClasses = [

                                            'cash' =>
                                                'bg-green-50 text-green-700 border-green-200',

                                            'bank' =>
                                                'bg-blue-50 text-blue-700 border-blue-200',

                                            'mobile_banking' =>
                                                'bg-purple-50 text-purple-700 border-purple-200',

                                            'other' =>
                                                'bg-slate-50 text-slate-700 border-slate-200',

                                        ];

                                        $methodLabels = [

                                            'cash' => 'Cash',

                                            'bank' => 'Bank',

                                            'mobile_banking' => 'Mobile Banking',

                                            'other' => 'Other',

                                        ];

                                    @endphp


                                    <span class="inline-flex
                                                 items-center
                                                 rounded-full
                                                 border
                                                 px-2.5 py-1
                                                 text-xs font-medium
                                                 {{ $methodClasses[$payment->payment_method]
                                                     ?? 'bg-slate-50 text-slate-700 border-slate-200'
                                                 }}">

                                        {{ $methodLabels[$payment->payment_method]
                                            ?? ucfirst($payment->payment_method) }}

                                    </span>

                                </td>


                                {{-- Reference --}}

                                <td class="px-4 py-3">

                                    @if($payment->reference_no)

                                        <span class="text-slate-600">

                                            {{ $payment->reference_no }}

                                        </span>

                                    @else

                                        <span class="text-slate-400">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Collector --}}

                                <td class="px-4 py-3">

                                    {{ $payment->collector->name ?? 'N/A' }}

                                </td>


                                {{-- Amount --}}

                                <td class="px-4 py-3 text-right">

                                    <span class="font-bold text-green-600">

                                        ৳ {{ number_format(
                                            $payment->amount,
                                            2
                                        ) }}

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8"
                                    class="px-4 py-14 text-center">

                                    <div class="flex flex-col
                                                items-center">

                                        <div class="flex h-16 w-16
                                                    items-center justify-center
                                                    rounded-full
                                                    bg-blue-50
                                                    text-blue-600">

                                            <i class="bi bi-receipt
                                                      text-3xl"></i>

                                        </div>

                                        <h3 class="mt-4
                                                   text-sm sm:text-base
                                                   font-semibold
                                                   text-slate-700">

                                            No Payment Transactions Found

                                        </h3>

                                        <p class="mt-1
                                                  text-xs sm:text-sm
                                                  text-slate-500">

                                            No fee payments match the selected filters.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>


                    {{-- Total --}}

                    @if($payments->count() > 0)

                        <tfoot>

                            <tr class="bg-slate-50
                                       border-t-2 border-slate-200">

                                <td colspan="7"
                                    class="px-4 py-4 text-right
                                           font-bold text-slate-700">

                                    Total Collection

                                </td>

                                <td class="px-4 py-4 text-right">

                                    <span class="text-lg font-bold
                                                 text-green-600">

                                        ৳ {{ number_format(
                                            $totalCollected,
                                            2
                                        ) }}

                                    </span>

                                </td>

                            </tr>

                        </tfoot>

                    @endif

                </table>

            </div>

        </div>


        {{-- =====================================================
            PRINT FOOTER
        ====================================================== --}}

        <div class="hidden print:flex
                    items-center justify-between
                    mt-8 pt-4
                    border-t border-slate-300
                    text-xs text-slate-500">

            <span>
                Generated on {{ now()->format('d M Y h:i A') }}
            </span>

            <span>
                School Management System
            </span>

        </div>

    </div>

</div>


{{-- =============================================================
    PRINT CSS
============================================================= --}}

<style>

@media print {

    body {
        background: #ffffff !important;
    }
    body * {
        visibility: hidden;
    }
    #print-area,
    #print-area * {
        visibility: visible;
    }
    #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        margin: 0;
        padding: 0;
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
    }
    #print-area .bg-white {
        background: #ffffff !important;
    }
    #print-area table {
        width: 100%;
    }
    #print-area tr {
        page-break-inside: avoid;
    }
    @page {

        size: A4 landscape;

        margin: 10mm;

    }

}

</style>

@endsection