@extends('admin.layouts.app')

@section('title', 'Payment History')
@section('page-title', 'Payment History')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Header --}}
    <div class="mb-5 sm:mb-6">

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-3">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Payment History
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    View all fee payments collected from your branch
                </p>

            </div>

        </div>

    </div>


    {{-- Success --}}
    @if(session('success'))

        <div class="mb-4 flex items-center gap-3
                    rounded-lg border border-green-200
                    bg-green-50 px-4 py-3
                    text-sm text-green-700">

            <i class="bi bi-check-circle-fill"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- Error --}}
    @if(session('error'))

        <div class="mb-4 flex items-center gap-3
                    rounded-lg border border-red-200
                    bg-red-50 px-4 py-3
                    text-sm text-red-700">

            <i class="bi bi-exclamation-circle-fill"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- Summary --}}
    @php

        $totalCollected = $payments->sum('amount');

        $totalPayments = $payments->count();

    @endphp


    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">

        {{-- Total Payments --}}
        <div class="rounded-xl border border-slate-200
                    bg-white p-5 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="flex h-11 w-11
                            items-center justify-center
                            rounded-xl
                            bg-blue-50 text-blue-600">

                    <i class="bi bi-receipt text-xl"></i>

                </div>

                <div>

                    <p class="text-xs text-slate-500">
                        Total Payments
                    </p>

                    <h2 class="mt-1 text-xl font-bold text-slate-800">
                        {{ $totalPayments }}
                    </h2>

                </div>

            </div>

        </div>


        {{-- Total Collected --}}
        <div class="rounded-xl border border-slate-200
                    bg-white p-5 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="flex h-11 w-11
                            items-center justify-center
                            rounded-xl
                            bg-green-50 text-green-600">

                    <i class="bi bi-cash-stack text-xl"></i>

                </div>

                <div>

                    <p class="text-xs text-slate-500">
                        Total Collected
                    </p>

                    <h2 class="mt-1 text-xl font-bold text-green-600">
                        ৳ {{ number_format($totalCollected, 2) }}
                    </h2>

                </div>

            </div>

        </div>

    </div>


    {{-- Table --}}
    <div class="bg-white rounded-xl
                shadow-sm border border-slate-200
                overflow-hidden">

        {{-- Table Header --}}
        <div class="p-4 sm:p-5 border-b border-slate-200">

            <div class="flex flex-col sm:flex-row
                        sm:items-center sm:justify-between gap-2">

                <div>

                    <h2 class="text-base sm:text-lg
                               font-semibold text-slate-800">

                        Payment List

                    </h2>

                    <p class="text-xs sm:text-sm text-slate-500 mt-1">

                        Recently collected fee payments

                    </p>

                </div>

                <div class="text-xs sm:text-sm text-slate-500">

                    Total:

                    <span class="font-semibold text-slate-700">
                        {{ $payments->count() }}
                    </span>

                </div>

            </div>

        </div>


        {{-- Responsive Table --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1100px]
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
                            Student
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Fee Type
                        </th>

                        <th class="px-4 py-3 text-right
                                   font-semibold text-slate-600">
                            Amount
                        </th>

                        <th class="px-4 py-3 text-center
                                   font-semibold text-slate-600">
                            Method
                        </th>

                        <th class="px-4 py-3 text-center
                                   font-semibold text-slate-600">
                            Payment Date
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Collected By
                        </th>

                        <th class="px-4 py-3 text-right
                                   font-semibold text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($payments as $payment)

                        <tr class="hover:bg-slate-50 transition">

                            {{-- Serial --}}
                            <td class="px-4 py-3 text-slate-500">

                                {{ $loop->iteration }}

                            </td>


                            {{-- Student --}}
                            <td class="px-4 py-3">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0
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
                                            {{
                                                $payment->student->student_id
                                                ?? $payment->student_id
                                            }}

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


                            {{-- Amount --}}
                            <td class="px-4 py-3 text-right">

                                <span class="font-bold text-green-600">

                                    ৳ {{ number_format(
                                        $payment->amount,
                                        2
                                    ) }}

                                </span>

                            </td>


                            {{-- Method --}}
                            <td class="px-4 py-3 text-center">

                                @php

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
                                             bg-slate-100
                                             border border-slate-200
                                             px-2.5 py-1
                                             text-xs font-medium
                                             text-slate-700">

                                    {{
                                        $methodLabels[
                                            $payment->payment_method
                                        ] ?? ucfirst(
                                            $payment->payment_method
                                        )
                                    }}

                                </span>

                            </td>


                            {{-- Date --}}
                            <td class="px-4 py-3 text-center">
                                <span class="text-slate-700">
                                    {{ $payment->payment_date  ? $payment->payment_date  ->format('d M Y') : 'N/A'  }}
                                </span>
                            </td>
                            {{-- Collector --}}
                            <td class="px-4 py-3">
                                {{ $payment->collector->name ?? 'N/A' }}
                            </td>
                            {{-- Action --}}
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route(
                                    'admin.fee-payment-history.show',
                                    $payment->id
                                ) }}"
                                class="inline-flex items-center gap-2   rounded-lg  bg-blue-50
                                       px-3 py-2
                                       text-xs font-semibold
                                       text-blue-600
                                       hover:bg-blue-100
                                       transition">
                                    <i class="bi bi-eye"></i>
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty

                        <tr>
                            <td colspan="8" class="px-4 py-14 text-center">
                                <div class="flex flex-col  items-center">
                                    <div class="flex h-16 w-16   items-center justify-center  rounded-full  bg-blue-50  text-blue-600">
                                        <i class="bi bi-receipt  text-3xl"></i>
                                    </div>
                                    <h3 class="mt-4
                                               text-sm sm:text-base
                                               font-semibold
                                               text-slate-700">
                                        No Payment History Found
                                    </h3>

                                    <p class="mt-1   text-xs sm:text-sm
                                              text-slate-500">

                                        No fee payment has been collected
                                        yet.

                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection