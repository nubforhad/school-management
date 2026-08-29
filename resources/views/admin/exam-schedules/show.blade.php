@extends('admin.layouts.app')

@section('title', 'Exam Schedule Details')

@section('page-title', 'Exam Schedule Details')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="mb-6 print:hidden">

        <div class="flex flex-col lg:flex-row
                    lg:items-center
                    lg:justify-between gap-4">

            <div>

                <div class="flex items-center gap-2 mb-2">

                    <a href="{{ route(
                        'admin.exams.schedules.index',
                        $exam
                    ) }}"
                       class="text-slate-400
                              hover:text-blue-600
                              transition">

                        <i class="bi bi-arrow-left"></i>

                    </a>

                    <span class="text-xs text-slate-400">
                        Exam Schedule
                    </span>

                </div>

                <h1 class="text-xl sm:text-2xl
                           font-bold text-slate-800">

                    Schedule Details

                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">

                    View complete examination schedule information

                </p>

            </div>


            <div class="flex flex-col sm:flex-row gap-2">

                {{-- Back --}}

                <a href="{{ route(
                    'admin.exams.schedules.index',
                    $exam
                ) }}"
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
                          hover:bg-slate-50
                          transition">

                    <i class="bi bi-arrow-left"></i>

                    Back

                </a>


                {{-- Edit --}}

                <a href="{{ route(
                    'admin.exams.schedules.edit',
                    [$exam, $schedule]
                ) }}"
                   class="inline-flex
                          items-center
                          justify-center
                          gap-2
                          rounded-lg
                          bg-blue-600
                          px-4 py-2.5
                          text-sm
                          font-semibold
                          text-white
                          hover:bg-blue-700
                          transition">

                    <i class="bi bi-pencil"></i>

                    Edit

                </a>


                {{-- Print --}}

                <button type="button"
                        onclick="window.print()"
                        class="inline-flex
                               items-center
                               justify-center
                               gap-2
                               rounded-lg
                               border border-slate-300
                               bg-white
                               px-4 py-2.5
                               text-sm
                               font-semibold
                               text-slate-700
                               hover:bg-slate-50
                               transition">

                    <i class="bi bi-printer"></i>

                    Print

                </button>

            </div>

        </div>

    </div>


    {{-- =========================================================
        PRINT AREA
    ========================================================== --}}

    <div id="print-area">


        {{-- =====================================================
            PRINT HEADER
        ====================================================== --}}

        <div class="hidden print:block mb-8">

            <div class="text-center">

                <h1 class="text-2xl font-bold text-slate-800">

                    School Management System

                </h1>

                <h2 class="text-lg font-semibold
                           text-slate-700 mt-1">

                    Examination Schedule

                </h2>

                <p class="text-sm text-slate-500 mt-1">

                    {{ $exam->name ?? 'Examination' }}

                </p>

            </div>

            <div class="border-b
                        border-slate-300
                        mt-5">
            </div>

        </div>


        {{-- =====================================================
            EXAM INFORMATION
        ====================================================== --}}

        <div class="bg-white
                    rounded-xl
                    border border-slate-200
                    shadow-sm mb-5">

            <div class="border-b
                        border-slate-200
                        bg-slate-50
                        px-4 sm:px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10
                                items-center justify-center
                                rounded-lg
                                bg-blue-50
                                text-blue-600">

                        <i class="bi bi-file-earmark-text"></i>

                    </div>

                    <div>

                        <h2 class="font-semibold
                                   text-slate-800">

                            Examination Information

                        </h2>

                        <p class="text-xs
                                  text-slate-500 mt-0.5">

                            Basic examination information

                        </p>

                    </div>

                </div>

            </div>


            <div class="p-4 sm:p-5">

                <div class="grid grid-cols-1
                            sm:grid-cols-2
                            lg:grid-cols-3 gap-4">


                    {{-- Exam --}}

                    <div class="rounded-lg
                                border border-blue-100
                                bg-blue-50
                                p-4">

                        <p class="text-xs
                                  font-medium
                                  text-blue-600">

                            Examination

                        </p>

                        <p class="mt-1
                                  text-sm
                                  font-semibold
                                  text-blue-900">

                            {{ $exam->name ?? 'N/A' }}

                        </p>

                    </div>


                    {{-- Branch --}}

                    <div class="rounded-lg
                                border border-slate-200
                                bg-slate-50
                                p-4">

                        <p class="text-xs
                                  font-medium
                                  text-slate-500">

                            Branch

                        </p>

                        <p class="mt-1
                                  text-sm
                                  font-semibold
                                  text-slate-800">

                            {{ $exam->branch->name ?? 'N/A' }}

                        </p>

                    </div>


                    {{-- Academic Session --}}

                    <div class="rounded-lg
                                border border-slate-200
                                bg-slate-50
                                p-4">

                        <p class="text-xs
                                  font-medium
                                  text-slate-500">

                            Academic Session

                        </p>

                        <p class="mt-1
                                  text-sm
                                  font-semibold
                                  text-slate-800">

                            {{ $exam->academicSession->name ?? 'N/A' }}

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            SUBJECT INFORMATION
        ====================================================== --}}

        <div class="bg-white
                    rounded-xl
                    border border-slate-200
                    shadow-sm mb-5">

            <div class="border-b
                        border-slate-200
                        px-4 sm:px-5 py-4">

                <h2 class="font-semibold text-slate-800">

                    Subject & Schedule

                </h2>

                <p class="text-xs
                          text-slate-500 mt-1">

                    Examination schedule details

                </p>

            </div>


            <div class="p-4 sm:p-5">

                <div class="grid grid-cols-1
                            sm:grid-cols-2
                            lg:grid-cols-4 gap-4">


                    {{-- Subject --}}

                    <div>

                        <p class="text-xs
                                  font-medium
                                  text-slate-500">

                            Subject

                        </p>

                        <p class="mt-1
                                  text-base
                                  font-semibold
                                  text-slate-800">

                            {{ $schedule->subject->name ?? 'N/A' }}

                        </p>

                        @if($schedule->subject?->code)

                            <p class="text-xs
                                      text-slate-400 mt-0.5">

                                Code:
                                {{ $schedule->subject->code }}

                            </p>

                        @endif

                    </div>


                    {{-- Exam Date --}}

                    <div>

                        <p class="text-xs
                                  font-medium
                                  text-slate-500">

                            Exam Date

                        </p>

                        <p class="mt-1
                                  text-base
                                  font-semibold
                                  text-slate-800">

                            @if($schedule->exam_date)

                                {{ \Carbon\Carbon::parse(
                                    $schedule->exam_date
                                )->format('d M Y') }}

                            @else

                                N/A

                            @endif

                        </p>

                    </div>


                    {{-- Time --}}

                    <div>

                        <p class="text-xs
                                  font-medium
                                  text-slate-500">

                            Examination Time

                        </p>

                        <p class="mt-1
                                  text-base
                                  font-semibold
                                  text-slate-800">

                            @if($schedule->start_time)

                                {{ \Carbon\Carbon::parse(
                                    $schedule->start_time
                                )->format('h:i A') }}

                                @if($schedule->end_time)

                                    -
                                    {{ \Carbon\Carbon::parse(
                                        $schedule->end_time
                                    )->format('h:i A') }}

                                @endif

                            @else

                                Not Set

                            @endif

                        </p>

                    </div>


                    {{-- Room --}}

                    <div>

                        <p class="text-xs
                                  font-medium
                                  text-slate-500">

                            Room

                        </p>

                        <p class="mt-1
                                  text-base
                                  font-semibold
                                  text-slate-800">

                            {{ $schedule->room ?? 'Not Assigned' }}

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            MARKS
        ====================================================== --}}

        <div class="bg-white
                    rounded-xl
                    border border-slate-200
                    shadow-sm mb-5">

            <div class="border-b
                        border-slate-200
                        px-4 sm:px-5 py-4">

                <h2 class="font-semibold text-slate-800">

                    Marks Configuration

                </h2>

            </div>


            <div class="grid grid-cols-1
                        sm:grid-cols-2">

                {{-- Full Marks --}}

                <div class="p-5
                            border-b
                            sm:border-b-0
                            sm:border-r
                            border-slate-200">

                    <p class="text-xs
                              text-slate-500">

                        Full Marks

                    </p>

                    <p class="mt-1
                              text-2xl
                              font-bold
                              text-blue-600">

                        {{ number_format(
                            $schedule->full_marks ?? 0,
                            2
                        ) }}

                    </p>

                </div>


                {{-- Pass Marks --}}

                <div class="p-5">

                    <p class="text-xs
                              text-slate-500">

                        Pass Marks

                    </p>

                    <p class="mt-1
                              text-2xl
                              font-bold
                              text-green-600">

                        {{ number_format(
                            $schedule->pass_marks ?? 0,
                            2
                        ) }}

                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            INSTRUCTIONS
        ====================================================== --}}

        @if($schedule->instructions)

            <div class="bg-white
                        rounded-xl
                        border border-slate-200
                        shadow-sm mb-5">

                <div class="border-b
                            border-slate-200
                            px-4 sm:px-5 py-4">

                    <h2 class="font-semibold
                               text-slate-800">

                        Instructions

                    </h2>

                </div>

                <div class="p-4 sm:p-5">

                    <p class="text-sm
                              leading-6
                              text-slate-600
                              whitespace-pre-line">

                        {{ $schedule->instructions }}

                    </p>

                </div>

            </div>

        @endif


        {{-- =====================================================
            CREATED / UPDATED
        ====================================================== --}}

        <div class="bg-white
                    rounded-xl
                    border border-slate-200
                    shadow-sm">

            <div class="p-4 sm:p-5">

                <div class="grid grid-cols-1
                            sm:grid-cols-2 gap-4">

                    <div>

                        <p class="text-xs text-slate-500">
                            Created At
                        </p>

                        <p class="mt-1
                                  text-sm
                                  font-medium
                                  text-slate-700">

                            {{ $schedule->created_at
                                ? $schedule->created_at
                                    ->format('d M Y h:i A')
                                : 'N/A' }}

                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-slate-500">
                            Last Updated
                        </p>

                        <p class="mt-1
                                  text-sm
                                  font-medium
                                  text-slate-700">

                            {{ $schedule->updated_at
                                ? $schedule->updated_at
                                    ->format('d M Y h:i A')
                                : 'N/A' }}

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            PRINT FOOTER
        ====================================================== --}}

        <div class="hidden print:flex
                    items-center
                    justify-between
                    mt-8 pt-4
                    border-t border-slate-300
                    text-xs text-slate-500">

            <span>
                Generated on
                {{ now()->format('d M Y h:i A') }}
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

    #print-area > div {
        break-inside: avoid;
        page-break-inside: avoid;
    }

    @page {
        size: A4 portrait;
        margin: 12mm;
    }

}

</style>

@endsection