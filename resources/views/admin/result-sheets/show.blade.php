@extends('admin.layouts.app')

@section('title', 'Result Sheet')

@section('page-title', 'Result Sheet')

@section('content')

<div class="max-w-5xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        SEARCH
    ========================================================== --}}
    @if(!$result)

        <div class="mb-6">

            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <span>Result</span>
                <span>/</span>
                <span class="text-slate-700">Result Sheet</span>
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                Result Sheet
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Select examination and student to generate result sheet.
            </p>

        </div>


        @if(session('error'))

            <div class="mb-5 p-4 rounded-lg
                        bg-red-50 border border-red-200
                        text-sm text-red-700">

                {{ session('error') }}

            </div>

        @endif


        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm">

            <div class="px-5 py-4 border-b border-slate-200
                        bg-slate-50 rounded-t-xl">

                <h2 class="font-semibold text-slate-800">
                    Generate Result Sheet
                </h2>

            </div>


            <form method="GET"
                  action="{{ route('admin.result-sheets.show') }}"
                  class="p-5">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Exam --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1">

                            Examination

                        </label>

                        <select name="exam_id"
                                required
                                class="w-full rounded-lg
                                       border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500">

                            <option value="">
                                Select Examination
                            </option>

                            @foreach($exams as $exam)

                                <option value="{{ $exam->id }}">

                                    {{ $exam->name }}

                                    @if($exam->code)
                                        ({{ $exam->code }})
                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Student ID --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1">

                            Student ID

                        </label>

                        <input type="number"
                               name="student_id"
                               required
                               placeholder="Enter Student ID"
                               class="w-full rounded-lg
                                      border-slate-300
                                      focus:border-blue-500
                                      focus:ring-blue-500">

                    </div>

                </div>


                <div class="mt-5">

                    <button type="submit"
                            class="inline-flex items-center gap-2
                                   px-5 py-2.5
                                   bg-blue-600 hover:bg-blue-700
                                   text-white text-sm font-medium
                                   rounded-lg transition">

                        Generate Result Sheet

                    </button>

                </div>

            </form>

        </div>

    @endif


    {{-- =========================================================
        RESULT SHEET
    ========================================================== --}}
    @if($result)

        <div class="flex justify-between items-center mb-5 no-print">

            <a href="{{ route('admin.result-sheets.show') }}"
               class="inline-flex items-center gap-2
                      px-4 py-2.5
                      bg-slate-100 hover:bg-slate-200
                      text-slate-700 text-sm font-medium
                      rounded-lg">

                ← Back

            </a>


            <button type="button"
                    onclick="window.print()"
                    class="inline-flex items-center gap-2
                           px-4 py-2.5
                           bg-slate-800 hover:bg-slate-900
                           text-white text-sm font-medium
                           rounded-lg">

                Print Result

            </button>

        </div>


        {{-- =====================================================
            OFFICIAL RESULT
        ====================================================== --}}
        <div id="result-sheet"
             class="bg-white border border-slate-300
                    shadow-sm">


            {{-- =================================================
                SCHOOL HEADER
            ================================================== --}}
            <div class="text-center px-5 py-6
                        border-b border-slate-300">

                <h1 class="text-2xl sm:text-3xl
                           font-bold text-slate-900">

                    SCHOOL RESULT SHEET

                </h1>

                <p class="text-lg font-semibold text-slate-700 mt-2">

                    {{ $result['exam']->name }}

                </p>

                @if($result['academic_session'])

                    <p class="text-sm text-slate-500 mt-1">

                        Academic Session:
                        {{ $result['academic_session']->name }}

                    </p>

                @endif

            </div>


            {{-- =================================================
                STUDENT INFORMATION
            ================================================== --}}
            <div class="p-5">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4
                            border border-slate-300">

                    <div class="p-3 border-b sm:border-b-0
                                sm:border-r border-slate-300">

                        <p class="text-xs text-slate-500">
                            Student Name
                        </p>

                        <p class="font-semibold text-slate-800 mt-1">

                            {{ $result['student']?->name
                                ?? $result['student']?->student_name
                                ?? 'N/A' }}

                        </p>

                    </div>


                    <div class="p-3">

                        <p class="text-xs text-slate-500">
                            Student ID
                        </p>

                        <p class="font-semibold text-slate-800 mt-1">

                            {{ $result['student']?->student_id
                                ?? $result['student']?->id
                                ?? 'N/A' }}

                        </p>

                    </div>


                    <div class="p-3 border-t
                                sm:border-r border-slate-300">

                        <p class="text-xs text-slate-500">
                            Class
                        </p>

                        <p class="font-semibold text-slate-800 mt-1">

                            {{ $result['school_class']?->name ?? 'N/A' }}

                        </p>

                    </div>


                    <div class="p-3 border-t border-slate-300">

                        <p class="text-xs text-slate-500">
                            Section
                        </p>

                        <p class="font-semibold text-slate-800 mt-1">

                            {{ $result['section']?->name
                                ?? 'All Sections' }}

                        </p>

                    </div>

                </div>

            </div>


            {{-- =================================================
                SUBJECT MARKS
            ================================================== --}}
            <div class="px-5 pb-5">

                <div class="overflow-x-auto">

                    <table class="w-full border-collapse
                                  border border-slate-300">

                        <thead>

                            <tr class="bg-slate-100">

                                <th class="border border-slate-300
                                           px-3 py-3 text-center
                                           text-xs font-bold">

                                    #

                                </th>

                                <th class="border border-slate-300
                                           px-3 py-3 text-left
                                           text-xs font-bold">

                                    Subject

                                </th>

                                <th class="border border-slate-300
                                           px-3 py-3 text-center
                                           text-xs font-bold">

                                    Full Marks

                                </th>

                                <th class="border border-slate-300
                                           px-3 py-3 text-center
                                           text-xs font-bold">

                                    Pass Marks

                                </th>

                                <th class="border border-slate-300
                                           px-3 py-3 text-center
                                           text-xs font-bold">

                                    Obtained

                                </th>

                                <th class="border border-slate-300
                                           px-3 py-3 text-center
                                           text-xs font-bold">

                                    Grade

                                </th>

                                <th class="border border-slate-300
                                           px-3 py-3 text-center
                                           text-xs font-bold">

                                    Result

                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($result['marks'] as $index => $mark)

                                @php

                                    $obtained = $mark->marks !== null
                                        ? (float) $mark->marks
                                        : 0;

                                    $fullMarks = (float) (
                                        $mark->full_marks ?? 0
                                    );

                                    $passMarks = $mark->pass_marks !== null
                                        ? (float) $mark->pass_marks
                                        : null;

                                    $percentage = $fullMarks > 0
                                        ? ($obtained / $fullMarks) * 100
                                        : 0;

                                    $passed = $passMarks !== null
                                        ? $obtained >= $passMarks
                                        : $percentage >= 33;

                                @endphp

                                <tr>

                                    <td class="border border-slate-300
                                               px-3 py-3 text-center
                                               text-sm">

                                        {{ $index + 1 }}

                                    </td>


                                    <td class="border border-slate-300
                                               px-3 py-3 text-sm
                                               font-medium">

                                        {{ $mark->subject?->name ?? 'N/A' }}

                                    </td>


                                    <td class="border border-slate-300
                                               px-3 py-3 text-center
                                               text-sm">

                                        {{ number_format($fullMarks, 2) }}

                                    </td>


                                    <td class="border border-slate-300
                                               px-3 py-3 text-center
                                               text-sm">

                                        {{ $passMarks !== null
                                            ? number_format($passMarks, 2)
                                            : '-' }}

                                    </td>


                                    <td class="border border-slate-300
                                               px-3 py-3 text-center
                                               text-sm font-bold">

                                        {{ number_format($obtained, 2) }}

                                    </td>


                                    <td class="border border-slate-300
                                               px-3 py-3 text-center
                                               text-sm font-bold">

                                        {{ $mark->grade ?? '-' }}

                                    </td>


                                    <td class="border border-slate-300
                                               px-3 py-3 text-center">

                                        @if($passed)

                                            <span class="font-semibold
                                                         text-slate-800">
                                                Pass
                                            </span>

                                        @else

                                            <span class="font-semibold
                                                         text-slate-800">
                                                Fail
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- =================================================
                RESULT SUMMARY
            ================================================== --}}
            <div class="px-5 pb-5">

                <div class="grid grid-cols-2 sm:grid-cols-4
                            border border-slate-300">

                    <div class="p-4 text-center
                                border-r border-slate-300">

                        <p class="text-xs text-slate-500">
                            Total Marks
                        </p>

                        <p class="text-lg font-bold mt-1">

                            {{ number_format(
                                $result['total_marks'],
                                2
                            ) }}

                            /

                            {{ number_format(
                                $result['total_full_marks'],
                                2
                            ) }}

                        </p>

                    </div>


                    <div class="p-4 text-center
                                border-r border-slate-300">

                        <p class="text-xs text-slate-500">
                            Percentage
                        </p>

                        <p class="text-lg font-bold mt-1">

                            {{ number_format(
                                $result['percentage'],
                                2
                            ) }}%

                        </p>

                    </div>


                    <div class="p-4 text-center
                                border-r border-slate-300">

                        <p class="text-xs text-slate-500">
                            Grade / GPA
                        </p>

                        <p class="text-lg font-bold mt-1">

                            {{ $result['grade'] }}

                            /

                            {{ number_format(
                                $result['grade_point'],
                                2
                            ) }}

                        </p>

                    </div>


                    <div class="p-4 text-center">

                        <p class="text-xs text-slate-500">
                            Position
                        </p>

                        <p class="text-lg font-bold mt-1">

                            {{ $result['position'] ?? '-' }}

                        </p>

                    </div>

                </div>

            </div>


            {{-- =================================================
                FINAL RESULT
            ================================================== --}}
            <div class="px-5 pb-6">

                <div class="border border-slate-300
                            p-4 text-center">

                    <p class="text-sm font-medium text-slate-500">
                        Final Result
                    </p>

                    <p class="text-2xl font-bold mt-1">

                        {{ strtoupper($result['status']) }}

                    </p>

                    <p class="text-sm text-slate-500 mt-2">

                        Passed Subjects:
                        {{ $result['passed_subjects'] }}

                        &nbsp; | &nbsp;

                        Failed Subjects:
                        {{ $result['failed_subjects'] }}

                    </p>

                </div>

            </div>


            {{-- =================================================
                SIGNATURE
            ================================================== --}}
            <div class="px-5 py-10">

                <div class="grid grid-cols-1 sm:grid-cols-3
                            gap-10 text-center">

                    <div>

                        <div class="border-t border-slate-400
                                    pt-2 mt-8">

                            <p class="text-sm font-medium">
                                Class Teacher
                            </p>

                        </div>

                    </div>


                    <div>

                        <div class="border-t border-slate-400
                                    pt-2 mt-8">

                            <p class="text-sm font-medium">
                                Exam Controller
                            </p>

                        </div>

                    </div>


                    <div>

                        <div class="border-t border-slate-400
                                    pt-2 mt-8">

                            <p class="text-sm font-medium">
                                Head Teacher
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                FOOTER
            ================================================== --}}
            <div class="border-t border-slate-300
                        px-5 py-3 text-center">

                <p class="text-xs text-slate-500">

                    This is a computer generated result sheet.

                </p>

            </div>

        </div>

    @endif

</div>


{{-- =============================================================
    PRINT CSS
============================================================= --}}
<style>

@media print {

    body {
        background: white !important;
    }

    .no-print,
    aside,
    nav,
    header {
        display: none !important;
    }

    #result-sheet {
        border: 1px solid #000 !important;
        box-shadow: none !important;
        max-width: none !important;
    }

    @page {
        size: A4 portrait;
        margin: 10mm;
    }

}

</style>

@endsection