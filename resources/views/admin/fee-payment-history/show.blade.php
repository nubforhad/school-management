@extends('admin.layouts.app')

@section('title', 'Payment Details')
@section('page-title', 'Payment Details')

@section('content')

<div class="max-w-5xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="mb-5 sm:mb-6">

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-3">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Payment Details
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    View collected fee payment details
                </p>

            </div>


            <div class="flex items-center gap-2">

                {{-- Back --}}
                <a href="{{ route('admin.fee-payment-history.index') }}"
                   class="inline-flex items-center justify-center gap-2
                          rounded-lg border border-slate-300
                          bg-white px-4 py-2.5
                          text-sm font-medium text-slate-700
                          hover:bg-slate-50 transition">

                    <i class="bi bi-arrow-left"></i>

                    Back

                </a>


                {{-- Print --}}
                <button type="button"
                        onclick="window.print()"
                        class="inline-flex items-center justify-center gap-2
                               rounded-lg
                               bg-blue-600
                               px-4 py-2.5
                               text-sm font-semibold
                               text-white
                               hover:bg-blue-700
                               transition">

                    <i class="bi bi-printer"></i>

                    Print Receipt

                </button>

            </div>

        </div>

    </div>


    {{-- =========================================================
        RECEIPT / PAYMENT CARD
    ========================================================== --}}

    <div id="print-area"
         class="bg-white rounded-xl
                border border-slate-200
                shadow-sm overflow-hidden">


        {{-- =====================================================
            SCHOOL HEADER
        ====================================================== --}}

        <div class="border-b border-slate-200
                    px-5 sm:px-8 py-6">

            <div class="flex flex-col sm:flex-row
                        sm:items-center
                        sm:justify-between gap-4">


                {{-- School --}}
                <div class="flex items-center gap-4">

                    <div class="flex h-14 w-14
                                shrink-0
                                items-center justify-center
                                rounded-xl
                                bg-blue-600
                                text-white">

                        <i class="bi bi-mortarboard-fill text-2xl"></i>

                    </div>


                    <div>

                        <h2 class="text-xl font-bold text-slate-800">

                            School Management System

                        </h2>

                        <p class="mt-1 text-sm text-slate-500">

                            {{ $feePayment->branch->name ?? 'Branch' }}

                        </p>

                    </div>

                </div>


                {{-- Receipt --}}
                <div class="sm:text-right">

                    <p class="text-xs uppercase
                              tracking-wider
                              text-slate-400">

                        Payment Receipt

                    </p>

                    <p class="mt-1 text-lg font-bold
                              text-slate-800">

                        #{{ str_pad(
                            $feePayment->id,
                            6,
                            '0',
                            STR_PAD_LEFT
                        ) }}

                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            PAYMENT STATUS
        ====================================================== --}}

        <div class="px-5 sm:px-8 pt-6">

            <div class="flex items-center justify-between
                        rounded-lg
                        border border-green-200
                        bg-green-50
                        px-4 py-3">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9
                                items-center justify-center
                                rounded-full
                                bg-green-100
                                text-green-600">

                        <i class="bi bi-check-lg"></i>

                    </div>

                    <div>

                        <p class="text-xs text-green-600">
                            Payment Status
                        </p>

                        <p class="font-semibold text-green-700">
                            Payment Received
                        </p>

                    </div>

                </div>


                <div class="text-right">

                    <p class="text-xs text-green-600">
                        Paid Amount
                    </p>

                    <p class="text-lg font-bold text-green-700">

                        ৳ {{ number_format(
                            $feePayment->amount,
                            2
                        ) }}

                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            STUDENT INFORMATION
        ====================================================== --}}

        <div class="px-5 sm:px-8 py-6">

            <h3 class="mb-4 text-base font-semibold
                       text-slate-800">

                Student Information

            </h3>


            <div class="grid grid-cols-1
                        sm:grid-cols-2
                        lg:grid-cols-4 gap-4">


                {{-- Student --}}
                <div class="rounded-lg
                            border border-slate-200
                            bg-slate-50
                            p-4">

                    <p class="text-xs uppercase
                              tracking-wide
                              text-slate-400">

                        Student

                    </p>

                    <p class="mt-1 font-semibold
                              text-slate-800">

                        {{ $feePayment->student->name ?? 'N/A' }}

                    </p>

                </div>


                {{-- Student ID --}}
                <div class="rounded-lg
                            border border-slate-200
                            bg-slate-50
                            p-4">

                    <p class="text-xs uppercase
                              tracking-wide
                              text-slate-400">

                        Student ID

                    </p>

                    <p class="mt-1 font-semibold
                              text-slate-800">

                        {{
                            $feePayment->student->student_id
                            ?? $feePayment->student_id
                            ?? 'N/A'
                        }}

                    </p>

                </div>


                {{-- Fee Type --}}
                <div class="rounded-lg
                            border border-slate-200
                            bg-slate-50
                            p-4">

                    <p class="text-xs uppercase
                              tracking-wide
                              text-slate-400">

                        Fee Type

                    </p>

                    <p class="mt-1 font-semibold
                              text-slate-800">

                        {{ $feePayment->feeType->name ?? 'N/A' }}

                    </p>

                    @if($feePayment->feeType?->code)

                        <p class="mt-0.5 text-xs text-slate-400">

                            {{ $feePayment->feeType->code }}

                        </p>

                    @endif

                </div>


                {{-- Branch --}}
                <div class="rounded-lg
                            border border-slate-200
                            bg-slate-50
                            p-4">

                    <p class="text-xs uppercase
                              tracking-wide
                              text-slate-400">

                        Branch

                    </p>

                    <p class="mt-1 font-semibold
                              text-slate-800">

                        {{ $feePayment->branch->name ?? 'N/A' }}

                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            PAYMENT INFORMATION
        ====================================================== --}}

        <div class="border-t border-slate-200
                    px-5 sm:px-8 py-6">

            <h3 class="mb-4 text-base font-semibold
                       text-slate-800">

                Payment Information

            </h3>


            <div class="overflow-hidden
                        rounded-lg
                        border border-slate-200">

                <div class="divide-y divide-slate-200">


                    {{-- Payment Amount --}}
                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-2
                                px-4 py-3">

                        <span class="text-sm text-slate-500">
                            Payment Amount
                        </span>

                        <span class="text-base font-bold
                                     text-green-600">

                            ৳ {{ number_format(
                                $feePayment->amount,
                                2
                            ) }}

                        </span>

                    </div>


                    {{-- Payment Date --}}
                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-2
                                px-4 py-3">

                        <span class="text-sm text-slate-500">
                            Payment Date
                        </span>

                        <span class="text-sm font-medium
                                     text-slate-800">

                            {{
                                $feePayment->payment_date
                                    ? $feePayment->payment_date
                                        ->format('d M Y')
                                    : 'N/A'
                            }}

                        </span>

                    </div>


                    {{-- Payment Method --}}
                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-2
                                px-4 py-3">

                        <span class="text-sm text-slate-500">
                            Payment Method
                        </span>

                        <span class="inline-flex
                                     w-fit
                                     items-center
                                     rounded-full
                                     bg-blue-50
                                     border border-blue-200
                                     px-3 py-1
                                     text-xs font-semibold
                                     text-blue-700">

                            @php

                                $methodLabels = [
                                    'cash' => 'Cash',
                                    'bank' => 'Bank',
                                    'mobile_banking' => 'Mobile Banking',
                                    'other' => 'Other',
                                ];

                            @endphp

                            {{
                                $methodLabels[
                                    $feePayment->payment_method
                                ] ?? ucfirst(
                                    $feePayment->payment_method
                                )
                            }}

                        </span>

                    </div>


                    {{-- Reference --}}
                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-2
                                px-4 py-3">

                        <span class="text-sm text-slate-500">
                            Reference No.
                        </span>

                        <span class="text-sm font-medium
                                     text-slate-800">

                            {{ $feePayment->reference_no ?? 'N/A' }}

                        </span>

                    </div>


                    {{-- Collected By --}}
                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-2
                                px-4 py-3">

                        <span class="text-sm text-slate-500">
                            Collected By
                        </span>

                        <span class="text-sm font-medium
                                     text-slate-800">

                            {{ $feePayment->collector->name ?? 'N/A' }}

                        </span>

                    </div>


                    {{-- Payment ID --}}
                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-2
                                px-4 py-3">

                        <span class="text-sm text-slate-500">
                            Payment ID
                        </span>

                        <span class="text-sm font-mono
                                     font-medium
                                     text-slate-700">

                            #{{ $feePayment->id }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            REMARKS
        ====================================================== --}}

        @if($feePayment->remarks)

            <div class="border-t border-slate-200
                        px-5 sm:px-8 py-6">

                <h3 class="mb-3 text-base font-semibold
                           text-slate-800">

                    Remarks

                </h3>

                <div class="rounded-lg
                            border border-slate-200
                            bg-slate-50
                            px-4 py-3">

                    <p class="text-sm text-slate-600">

                        {{ $feePayment->remarks }}

                    </p>

                </div>

            </div>

        @endif


        {{-- =====================================================
            FOOTER
        ====================================================== --}}

        <div class="border-t border-slate-200
                    bg-slate-50
                    px-5 sm:px-8 py-5">

            <div class="flex flex-col
                        sm:flex-row
                        sm:items-center
                        sm:justify-between gap-3">

                <div>

                    <p class="text-xs text-slate-400">

                        Thank you for your payment.

                    </p>

                    <p class="mt-1 text-xs text-slate-400">

                        This is a computer generated receipt.

                    </p>

                </div>


                <div class="text-left sm:text-right">

                    <p class="text-xs text-slate-400">
                        Generated on
                    </p>

                    <p class="text-sm font-medium
                              text-slate-700">

                        {{ now()->format('d M Y, h:i A') }}

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
    PRINT CSS
============================================================== --}}

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
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
    }

    @page {
        size: A4;
        margin: 15mm;
    }

}

</style>

@endsection