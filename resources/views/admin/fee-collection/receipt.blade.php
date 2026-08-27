<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Receipt #{{ str_pad($feePayment->id, 6, '0', STR_PAD_LEFT) }}
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="min-h-screen bg-slate-100">


<div class="max-w-3xl mx-auto px-4 py-6 sm:py-10">


    {{-- =========================================================
        ACTION BUTTONS
    ========================================================== --}}

    <div class="mb-5 flex flex-col
                sm:flex-row
                sm:items-center
                sm:justify-between gap-3
                print:hidden">

        <a href="{{ route(
            'admin.fee-payment-history.index'
        ) }}"
        class="inline-flex items-center
               justify-center gap-2
               rounded-lg
               border border-slate-300
               bg-white
               px-4 py-2.5
               text-sm font-medium
               text-slate-700
               hover:bg-slate-50">

            <i class="bi bi-arrow-left"></i>

            Payment History

        </a>


        <button type="button"
                onclick="window.print()"
                class="inline-flex items-center
                       justify-center gap-2
                       rounded-lg
                       bg-blue-600
                       px-4 py-2.5
                       text-sm font-semibold
                       text-white
                       hover:bg-blue-700">

            <i class="bi bi-printer"></i>

            Print Receipt

        </button>

    </div>


    {{-- =========================================================
        RECEIPT
    ========================================================== --}}

    <div id="receipt"
         class="bg-white
                border border-slate-200
                rounded-xl
                shadow-sm
                overflow-hidden">


        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="px-6 sm:px-8 py-7
                    border-b border-slate-200">

            <div class="flex flex-col
                        sm:flex-row
                        sm:items-start
                        sm:justify-between gap-5">


                {{-- School --}}
                <div class="flex items-center gap-4">

                    <div class="flex h-14 w-14
                                shrink-0
                                items-center
                                justify-center
                                rounded-xl
                                bg-blue-600
                                text-white">

                        <i class="bi bi-mortarboard-fill
                                  text-2xl"></i>

                    </div>


                    <div>

                        <h1 class="text-xl sm:text-2xl
                                   font-bold
                                   text-slate-800">

                            School Management System

                        </h1>

                        <p class="mt-1 text-sm
                                  text-slate-500">

                            {{ $feePayment->branch->name ?? 'Branch' }}

                        </p>

                    </div>

                </div>


                {{-- Receipt --}}
                <div class="sm:text-right">

                    <p class="text-xs uppercase
                              tracking-widest
                              text-slate-400">

                        Fee Payment Receipt

                    </p>

                    <p class="mt-1 text-xl
                              font-bold
                              text-slate-800">

                        #{{ str_pad(
                            $feePayment->id,
                            6,
                            '0',
                            STR_PAD_LEFT
                        ) }}

                    </p>

                    <p class="mt-1 text-xs
                              text-slate-500">

                        {{ $feePayment->payment_date
                            ? $feePayment->payment_date
                                ->format('d M Y')
                            : 'N/A'
                        }}

                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            PAYMENT SUCCESS
        ====================================================== --}}

        <div class="px-6 sm:px-8 pt-6">

            <div class="rounded-xl
                        border border-green-200
                        bg-green-50
                        p-4">

                <div class="flex items-center
                            justify-between gap-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10
                                    items-center
                                    justify-center
                                    rounded-full
                                    bg-green-100
                                    text-green-600">

                            <i class="bi bi-check-lg
                                      text-lg"></i>

                        </div>

                        <div>

                            <p class="text-xs
                                      text-green-600">

                                Payment Status

                            </p>

                            <p class="font-semibold
                                      text-green-700">

                                Payment Received

                            </p>

                        </div>

                    </div>


                    <div class="text-right">

                        <p class="text-xs
                                  text-green-600">

                            Current Payment

                        </p>

                        <p class="text-xl
                                  font-bold
                                  text-green-700">

                            ৳ {{ number_format(
                                $currentPayment,
                                2
                            ) }}

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            STUDENT INFORMATION
        ====================================================== --}}

        <div class="px-6 sm:px-8 py-6">

            <h2 class="mb-4 text-base
                       font-semibold
                       text-slate-800">

                Student Information

            </h2>


            <div class="grid grid-cols-1
                        sm:grid-cols-2 gap-4">


                <div>

                    <p class="text-xs uppercase
                              tracking-wide
                              text-slate-400">

                        Student Name

                    </p>

                    <p class="mt-1 font-semibold
                              text-slate-800">

                        {{ $feePayment->student->name ?? 'N/A' }}

                    </p>

                </div>


                <div>

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


                <div>

                    <p class="text-xs uppercase
                              tracking-wide
                              text-slate-400">

                        Fee Type

                    </p>

                    <p class="mt-1 font-semibold
                              text-slate-800">

                        {{ $feePayment->feeType->name ?? 'N/A' }}

                    </p>

                </div>


                <div>

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
            PAYMENT SUMMARY
        ====================================================== --}}

        <div class="border-t border-slate-200
                    px-6 sm:px-8 py-6">

            <h2 class="mb-4 text-base
                       font-semibold
                       text-slate-800">

                Payment Summary

            </h2>


            <div class="overflow-hidden
                        rounded-xl
                        border border-slate-200">

                <div class="divide-y
                            divide-slate-200">


                    {{-- Assigned --}}
                    <div class="flex items-center
                                justify-between
                                gap-4 px-4 py-3">

                        <span class="text-sm
                                     text-slate-500">

                            Assigned Amount

                        </span>

                        <span class="font-semibold
                                     text-slate-800">

                            ৳ {{ number_format(
                                $assignedAmount,
                                2
                            ) }}

                        </span>

                    </div>


                    {{-- Previous Paid --}}
                    <div class="flex items-center
                                justify-between
                                gap-4 px-4 py-3">

                        <span class="text-sm
                                     text-slate-500">

                            Previous Paid

                        </span>

                        <span class="font-semibold
                                     text-slate-700">

                            ৳ {{ number_format(
                                $previousPaid,
                                2
                            ) }}

                        </span>

                    </div>


                    {{-- Current Payment --}}
                    <div class="flex items-center
                                justify-between
                                gap-4 px-4 py-3
                                bg-green-50">

                        <span class="text-sm
                                     font-medium
                                     text-green-700">

                            Current Payment

                        </span>

                        <span class="text-lg
                                     font-bold
                                     text-green-700">

                            ৳ {{ number_format(
                                $currentPayment,
                                2
                            ) }}

                        </span>

                    </div>


                    {{-- Total Paid --}}
                    <div class="flex items-center
                                justify-between
                                gap-4 px-4 py-3">

                        <span class="text-sm
                                     text-slate-500">

                            Total Paid

                        </span>

                        <span class="font-semibold
                                     text-slate-800">

                            ৳ {{ number_format(
                                $totalPaid,
                                2
                            ) }}

                        </span>

                    </div>


                    {{-- Remaining --}}
                    <div class="flex items-center
                                justify-between
                                gap-4 px-4 py-3
                                bg-red-50">

                        <span class="text-sm
                                     font-medium
                                     text-red-700">

                            Remaining Due

                        </span>

                        <span class="text-lg
                                     font-bold
                                     text-red-700">

                            ৳ {{ number_format(
                                $remainingDue,
                                2
                            ) }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            PAYMENT DETAILS
        ====================================================== --}}

        <div class="border-t border-slate-200
                    px-6 sm:px-8 py-6">

            <h2 class="mb-4 text-base
                       font-semibold
                       text-slate-800">

                Payment Details

            </h2>


            <div class="grid grid-cols-1
                        sm:grid-cols-2 gap-4">


                {{-- Method --}}
                <div>

                    <p class="text-xs uppercase
                              tracking-wide
                              text-slate-400">

                        Payment Method

                    </p>

                    @php

                        $methodLabels = [
                            'cash' => 'Cash',
                            'bank' => 'Bank',
                            'mobile_banking' => 'Mobile Banking',
                            'other' => 'Other',
                        ];

                    @endphp

                    <p class="mt-1 font-semibold
                              text-slate-800">

                        {{
                            $methodLabels[
                                $feePayment->payment_method
                            ] ?? ucfirst(
                                $feePayment->payment_method
                            )
                        }}

                    </p>

                </div>


                {{-- Date --}}
                <div>

                    <p class="text-xs uppercase
                              tracking-wide
                              text-slate-400">

                        Payment Date

                    </p>

                    <p class="mt-1 font-semibold
                              text-slate-800">

                        {{
                            $feePayment->payment_date
                                ? $feePayment->payment_date
                                    ->format('d M Y')
                                : 'N/A'
                        }}

                    </p>

                </div>


                {{-- Reference --}}
                <div>

                    <p class="text-xs uppercase
                              tracking-wide
                              text-slate-400">

                        Reference No.

                    </p>

                    <p class="mt-1 font-semibold
                              text-slate-800">

                        {{ $feePayment->reference_no ?? 'N/A' }}

                    </p>

                </div>


                {{-- Collected By --}}
                <div>

                    <p class="text-xs uppercase
                              tracking-wide
                              text-slate-400">

                        Collected By

                    </p>

                    <p class="mt-1 font-semibold
                              text-slate-800">

                        {{ $feePayment->collector->name ?? 'N/A' }}

                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            REMARKS
        ====================================================== --}}

        @if($feePayment->remarks)

            <div class="border-t border-slate-200
                        px-6 sm:px-8 py-6">

                <h2 class="mb-3 text-base
                           font-semibold
                           text-slate-800">

                    Remarks

                </h2>

                <div class="rounded-lg
                            bg-slate-50
                            border border-slate-200
                            px-4 py-3">

                    <p class="text-sm
                              text-slate-600">

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
                    px-6 sm:px-8 py-6">

            <div class="text-center">

                <p class="text-sm font-medium
                          text-slate-700">

                    Thank you for your payment.

                </p>

                <p class="mt-1 text-xs
                          text-slate-400">

                    This is a computer generated receipt.

                </p>

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

    #receipt,
    #receipt * {
        visibility: visible;
    }

    #receipt {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        margin: 0;
        border: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    @page {
        size: A4;
        margin: 12mm;
    }

}

</style>


</body>

</html>