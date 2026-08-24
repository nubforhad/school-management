<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Receipt - {{ $payment->receipt_no }}
    </title>

    @vite(['resources/css/app.css'])

    <style>

        @media print {

            body {
                background: white !important;
            }

            .no-print {
                display: none !important;
            }

            .receipt-wrapper {
                margin: 0 !important;
                padding: 0 !important;
            }

            .receipt {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }

        }

    </style>

</head>


<body class="bg-slate-100">


<div class="receipt-wrapper max-w-3xl
            mx-auto
            px-4
            py-6
            sm:py-10">


    {{-- Actions --}}

    <div class="no-print
                flex flex-col
                sm:flex-row
                sm:justify-between
                gap-3
                mb-5">

        <a href="{{ route('admin.fee-collection.index') }}"
           class="inline-flex
                  items-center
                  justify-center
                  gap-2
                  rounded-lg
                  border border-slate-300
                  bg-white
                  px-4 py-2.5
                  text-sm
                  font-medium
                  text-slate-700
                  hover:bg-slate-50">

            ← Back

        </a>


        <button onclick="window.print()"
                class="inline-flex
                       items-center
                       justify-center
                       gap-2
                       rounded-lg
                       bg-blue-600
                       px-5 py-2.5
                       text-sm
                       font-semibold
                       text-white
                       hover:bg-blue-700">

            🖨 Print Receipt

        </button>

    </div>



    {{-- Receipt --}}

    <div class="receipt
                rounded-xl
                border
                border-slate-200
                bg-white
                shadow-sm
                overflow-hidden">


        {{-- Header --}}

        <div class="border-b
                    border-slate-200
                    px-6 py-6
                    text-center">


            <div class="flex
                        h-14 w-14
                        mx-auto
                        items-center
                        justify-center
                        rounded-xl
                        bg-blue-600
                        text-white
                        text-2xl">

                🏫

            </div>


            <h1 class="mt-3
                       text-xl
                       sm:text-2xl
                       font-bold
                       text-slate-800">

                {{ $payment->branch->name ?? 'School Management System' }}

            </h1>


            <p class="mt-1
                      text-sm
                      text-slate-500">

                Fee Payment Receipt

            </p>


            <div class="mt-4
                        inline-flex
                        rounded-lg
                        bg-slate-100
                        px-4 py-2">

                <span class="text-xs
                             font-medium
                             text-slate-500">

                    Receipt No:

                </span>

                <span class="ml-2
                             text-xs
                             font-bold
                             text-slate-800">

                    {{ $payment->receipt_no }}

                </span>

            </div>

        </div>



        {{-- Student Information --}}

        <div class="p-6">

            <h2 class="mb-4
                       text-sm
                       font-bold
                       uppercase
                       tracking-wide
                       text-slate-500">

                Student Information

            </h2>


            <div class="grid
                        grid-cols-1
                        sm:grid-cols-2
                        gap-x-8
                        gap-y-4">


                <div>

                    <p class="text-xs
                              text-slate-400">

                        Student Name

                    </p>

                    <p class="mt-1
                              font-semibold
                              text-slate-800">

                        {{ $payment->student->name ?? 'N/A' }}

                    </p>

                </div>


                <div>

                    <p class="text-xs
                              text-slate-400">

                        Student ID

                    </p>

                    <p class="mt-1
                              font-semibold
                              text-slate-800">

                        {{ $payment->student->student_id
                            ?? $payment->student_id }}

                    </p>

                </div>


                <div>

                    <p class="text-xs
                              text-slate-400">

                        Fee Type

                    </p>

                    <p class="mt-1
                              font-semibold
                              text-slate-800">

                        {{ $payment->feeType->name ?? 'N/A' }}

                    </p>

                </div>


                <div>

                    <p class="text-xs
                              text-slate-400">

                        Payment Date

                    </p>

                    <p class="mt-1
                              font-semibold
                              text-slate-800">

                        {{ $payment->payment_date?->format('d M Y') }}

                    </p>

                </div>

            </div>

        </div>



        {{-- Payment Details --}}

        <div class="border-t
                    border-slate-200
                    p-6">


            <h2 class="mb-4
                       text-sm
                       font-bold
                       uppercase
                       tracking-wide
                       text-slate-500">

                Payment Details

            </h2>


            <div class="overflow-hidden
                        rounded-lg
                        border border-slate-200">


                <div class="flex
                            items-center
                            justify-between
                            border-b
                            border-slate-200
                            px-4 py-3">

                    <span class="text-sm
                                 text-slate-500">

                        Payment Method

                    </span>

                    <span class="text-sm
                                 font-semibold
                                 capitalize
                                 text-slate-800">

                        {{ str_replace(
                            '_',
                            ' ',
                            $payment->payment_method
                        ) }}

                    </span>

                </div>


                <div class="flex
                            items-center
                            justify-between
                            bg-green-50
                            px-4 py-4">

                    <span class="text-sm
                                 font-semibold
                                 text-green-700">

                        Amount Paid

                    </span>

                    <span class="text-xl
                                 font-bold
                                 text-green-700">

                        ৳ {{ number_format(
                            $payment->amount,
                            2
                        ) }}

                    </span>

                </div>

            </div>

        </div>



        {{-- Remarks --}}

        @if($payment->remarks)

            <div class="border-t
                        border-slate-200
                        px-6 py-5">

                <p class="text-xs
                          font-medium
                          text-slate-400">

                    Remarks

                </p>

                <p class="mt-1
                          text-sm
                          text-slate-700">

                    {{ $payment->remarks }}

                </p>

            </div>

        @endif



        {{-- Footer --}}

        <div class="border-t
                    border-slate-200
                    bg-slate-50
                    px-6 py-5">


            <div class="flex
                        flex-col
                        sm:flex-row
                        sm:items-end
                        sm:justify-between
                        gap-5">


                <div>

                    <p class="text-xs
                              text-slate-400">

                        Collected By

                    </p>

                    <p class="mt-1
                              text-sm
                              font-semibold
                              text-slate-700">

                        {{ $payment->collectedBy->name ?? 'Administrator' }}

                    </p>

                </div>


                <div class="text-left sm:text-right">

                    <p class="text-xs
                              text-slate-400">

                        Generated At

                    </p>

                    <p class="mt-1
                              text-sm
                              font-semibold
                              text-slate-700">

                        {{ $payment->created_at?->format('d M Y, h:i A') }}

                    </p>

                </div>

            </div>


            <div class="mt-6
                        border-t
                        border-dashed
                        border-slate-300
                        pt-4
                        text-center">

                <p class="text-xs
                          text-slate-400">

                    Thank you for your payment.

                </p>

                <p class="mt-1
                          text-[10px]
                          text-slate-400">

                    This is a computer generated receipt.

                </p>

            </div>

        </div>


    </div>

</div>


</body>

</html>