@extends('admin.layouts.app')

@section('title', 'Class Result')

@section('page-title', 'Class Result')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="mb-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                    Class Result
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    View complete class-wise examination results and student positions.
                </p>
            </div>

            <div class="flex flex-wrap gap-2">

                @if(request()->filled('exam_id') && request()->filled('class_id'))

                    <button
                        type="button"
                        onclick="window.print()"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2.5
                               rounded-lg bg-slate-800 text-white text-sm font-semibold
                               hover:bg-slate-700 transition"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H9v4a2 2 0 002 2zm0-14h6a2 2 0 002 2v2H7V5a2 2 0 002-2z" />
                        </svg>

                        Print Result
                    </button>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================================================
        FILTER CARD
    ========================================================== --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm mb-6">

        <div class="px-5 py-4 border-b border-slate-200 bg-slate-50 rounded-t-xl">

            <div class="flex items-center gap-2">

                <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 text-blue-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414A1 1 0 0014 14.414V19l-4 2v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />

                    </svg>

                </div>

                <div>
                    <h2 class="text-base font-semibold text-slate-800">
                        Result Filters
                    </h2>

                    <p class="text-xs text-slate-500">
                        Select examination and class to view result
                    </p>
                </div>

            </div>

        </div>


        <form
            method="GET"
            action="{{ route('admin.class-results.index') }}"
            class="p-5"
        >

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Exam --}}
                <div>

                    <label
                        for="exam_id"
                        class="block text-sm font-medium text-slate-700 mb-1.5"
                    >
                        Examination
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="exam_id"
                        id="exam_id"
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-700
                               focus:border-blue-500 focus:ring-blue-500"
                    >

                        <option value="">
                            Select Examination
                        </option>

                        @foreach($exams as $exam)

                            <option
                                value="{{ $exam->id }}"
                                {{ request('exam_id') == $exam->id ? 'selected' : '' }}
                            >
                                {{ $exam->name }}
                                @if($exam->code)
                                    ({{ $exam->code }})
                                @endif
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Academic Session --}}
                <div>

                    <label
                        for="academic_session_id"
                        class="block text-sm font-medium text-slate-700 mb-1.5"
                    >
                        Academic Session
                    </label>

                    <select
                        name="academic_session_id"
                        id="academic_session_id"
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-700
                               focus:border-blue-500 focus:ring-blue-500"
                    >

                        <option value="">
                            All Sessions
                        </option>

                        @foreach($academicSessions as $session)

                            <option
                                value="{{ $session->id }}"
                                {{ request('academic_session_id') == $session->id ? 'selected' : '' }}
                            >
                                {{ $session->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Class --}}
                <div>

                    <label
                        for="class_id"
                        class="block text-sm font-medium text-slate-700 mb-1.5"
                    >
                        Class
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="class_id"
                        id="class_id"
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-700
                               focus:border-blue-500 focus:ring-blue-500"
                    >

                        <option value="">
                            Select Class
                        </option>

                        @foreach($classes as $class)

                            <option
                                value="{{ $class->id }}"
                                {{ request('class_id') == $class->id ? 'selected' : '' }}
                            >
                                {{ $class->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Section --}}
                <div>

                    <label
                        for="section_id"
                        class="block text-sm font-medium text-slate-700 mb-1.5"
                    >
                        Section
                    </label>

                    <select
                        name="section_id"
                        id="section_id"
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-700
                               focus:border-blue-500 focus:ring-blue-500"
                    >

                        <option value="">
                            All Sections
                        </option>

                        @foreach($sections as $section)

                            <option
                                value="{{ $section->id }}"
                                {{ request('section_id') == $section->id ? 'selected' : '' }}
                            >
                                {{ $section->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            {{-- Buttons --}}
            <div class="mt-5 flex flex-wrap items-center gap-2">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2
                           px-5 py-2.5 rounded-lg
                           bg-blue-600 text-white text-sm font-semibold
                           hover:bg-blue-700 transition"
                >

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-4.35-4.35m2.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />

                    </svg>

                    View Result

                </button>


                <a
                    href="{{ route('admin.class-results.index') }}"
                    class="inline-flex items-center justify-center gap-2
                           px-5 py-2.5 rounded-lg
                           bg-slate-100 text-slate-700 text-sm font-semibold
                           border border-slate-200
                           hover:bg-slate-200 transition"
                >

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />

                    </svg>

                    Reset

                </a>

            </div>

        </form>

    </div>


    {{-- =========================================================
        RESULT SECTION
    ========================================================== --}}

    @if(request()->filled('exam_id') && request()->filled('class_id'))

        {{-- =====================================================
            PRINT HEADER
        ====================================================== --}}
        <div class="hidden print:block mb-6">

            <div class="text-center">

                <h1 class="text-2xl font-bold text-slate-900">
                    CLASS RESULT
                </h1>

                @php
                    $selectedExam = $exams->firstWhere('id', request('exam_id'));
                    $selectedClass = $classes->firstWhere('id', request('class_id'));
                    $selectedSection = $sections->firstWhere('id', request('section_id'));
                @endphp

                @if($selectedExam)

                    <p class="text-lg font-semibold mt-1">
                        {{ $selectedExam->name }}
                    </p>

                @endif

                <p class="text-sm mt-1">

                    @if($selectedClass)
                        Class: {{ $selectedClass->name }}
                    @endif

                    @if($selectedSection)
                        | Section: {{ $selectedSection->name }}
                    @endif

                </p>

            </div>

        </div>


        {{-- =====================================================
            SUMMARY CARDS
        ====================================================== --}}
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4 mb-6">

            {{-- Total Students --}}
            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs sm:text-sm text-slate-500">
                            Total Students
                        </p>

                        <p class="text-xl sm:text-2xl font-bold text-slate-800 mt-1">
                            {{ $results->count() }}
                        </p>

                    </div>

                    <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 text-blue-600"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-10a4 4 0 11-8 0 4 4 0 018 0zm6 4a4 4 0 10-8 0" />

                        </svg>

                    </div>

                </div>

            </div>


            {{-- Passed --}}
            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs sm:text-sm text-slate-500">
                            Passed
                        </p>

                        <p class="text-xl sm:text-2xl font-bold text-green-600 mt-1">
                            {{ $results->where('status', 'Passed')->count() }}
                        </p>

                    </div>

                    <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 text-green-600"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 13l4 4L19 7" />

                        </svg>

                    </div>

                </div>

            </div>


            {{-- Failed --}}
            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs sm:text-sm text-slate-500">
                            Failed
                        </p>

                        <p class="text-xl sm:text-2xl font-bold text-red-600 mt-1">
                            {{ $results->where('status', 'Failed')->count() }}
                        </p>

                    </div>

                    <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 text-red-600"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12" />

                        </svg>

                    </div>

                </div>

            </div>


            {{-- Pass Rate --}}
            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs sm:text-sm text-slate-500">
                            Pass Rate
                        </p>

                        <p class="text-xl sm:text-2xl font-bold text-emerald-600 mt-1">

                            @php
                                $totalStudents = $results->count();
                                $passedStudents = $results->where('status', 'Passed')->count();
                                $passRate = $totalStudents > 0
                                    ? ($passedStudents / $totalStudents) * 100
                                    : 0;
                            @endphp

                            {{ number_format($passRate, 2) }}%

                        </p>

                    </div>

                    <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 text-emerald-600"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 19V6l12-3v13M9 19a3 3 0 11-6 0 3 3 0 016 0zm12-3a3 3 0 11-6 0 3 3 0 016 0z" />

                        </svg>

                    </div>

                </div>

            </div>


            {{-- Top Student --}}
            <div class="col-span-2 lg:col-span-1 bg-white border border-slate-200 rounded-xl p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div class="min-w-0">

                        <p class="text-xs sm:text-sm text-slate-500">
                            Top Student
                        </p>

                        @if($results->count())

                            @php
                                $topStudent = $results->first();
                            @endphp

                            <p class="text-sm sm:text-base font-bold text-slate-800 mt-1 truncate">
                                {{ $topStudent->student_name ?? $topStudent->student->name ?? $topStudent->student->student_name ?? 'N/A' }}
                            </p>

                        @else

                            <p class="text-sm font-semibold text-slate-400 mt-1">
                                No Result
                            </p>

                        @endif

                    </div>

                    <div class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center flex-shrink-0">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 text-yellow-600"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 16l3-8 4 5 4-5 3 8H5z" />

                        </svg>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            RESULT TABLE
        ====================================================== --}}
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-200 bg-slate-50">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

                    <div>

                        <h2 class="text-lg font-semibold text-slate-800">
                            Student Results
                        </h2>

                        <p class="text-xs sm:text-sm text-slate-500 mt-1">
                            Student-wise marks, percentage, grade and position.
                        </p>

                    </div>

                    @if($results->count())

                        <span class="inline-flex items-center px-3 py-1.5 rounded-full
                                     bg-blue-50 text-blue-700 text-xs font-semibold">

                            {{ $results->count() }} Students

                        </span>

                    @endif

                </div>

            </div>


            @if($results->count())

                {{-- =================================================
                    DESKTOP TABLE
                ================================================== --}}
                <div class="hidden md:block overflow-x-auto">

                    <table class="min-w-full divide-y divide-slate-200">

                        <thead class="bg-slate-50">

                            <tr>

                                <th class="px-4 py-3 text-left text-xs font-semibold
                                           text-slate-600 uppercase tracking-wider">
                                    Position
                                </th>

                                <th class="px-4 py-3 text-left text-xs font-semibold
                                           text-slate-600 uppercase tracking-wider">
                                    Student
                                </th>

                                <th class="px-4 py-3 text-left text-xs font-semibold
                                           text-slate-600 uppercase tracking-wider">
                                    Student ID
                                </th>

                                <th class="px-4 py-3 text-center text-xs font-semibold
                                           text-slate-600 uppercase tracking-wider">
                                    Subjects
                                </th>

                                <th class="px-4 py-3 text-right text-xs font-semibold
                                           text-slate-600 uppercase tracking-wider">
                                    Total Marks
                                </th>

                                <th class="px-4 py-3 text-right text-xs font-semibold
                                           text-slate-600 uppercase tracking-wider">
                                    Percentage
                                </th>

                                <th class="px-4 py-3 text-center text-xs font-semibold
                                           text-slate-600 uppercase tracking-wider">
                                    Grade
                                </th>

                                <th class="px-4 py-3 text-center text-xs font-semibold
                                           text-slate-600 uppercase tracking-wider">
                                    GPA
                                </th>

                                <th class="px-4 py-3 text-center text-xs font-semibold
                                           text-slate-600 uppercase tracking-wider">
                                    Result
                                </th>

                            </tr>

                        </thead>


                        <tbody class="bg-white divide-y divide-slate-100">

                            @foreach($results as $result)

                                <tr class="hover:bg-slate-50 transition">

                                    {{-- Position --}}
                                    <td class="px-4 py-3 whitespace-nowrap">

                                        @if(($result->position ?? 0) == 1)

                                            <span class="inline-flex items-center justify-center
                                                         min-w-9 h-9 rounded-full
                                                         bg-yellow-50 text-yellow-700
                                                         font-bold text-sm border border-yellow-200">
                                                1
                                            </span>

                                        @elseif(($result->position ?? 0) == 2)

                                            <span class="inline-flex items-center justify-center
                                                         min-w-9 h-9 rounded-full
                                                         bg-slate-100 text-slate-700
                                                         font-bold text-sm border border-slate-200">
                                                2
                                            </span>

                                        @elseif(($result->position ?? 0) == 3)

                                            <span class="inline-flex items-center justify-center
                                                         min-w-9 h-9 rounded-full
                                                         bg-orange-50 text-orange-700
                                                         font-bold text-sm border border-orange-200">
                                                3
                                            </span>

                                        @else

                                            <span class="text-sm font-semibold text-slate-700">
                                                {{ $result->position ?? '-' }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Student --}}
                                    <td class="px-4 py-3 whitespace-nowrap">

                                        <div class="flex items-center gap-3">

                                            <div class="w-9 h-9 rounded-full bg-blue-50
                                                        flex items-center justify-center
                                                        text-blue-600 font-bold text-sm">

                                                {{ strtoupper(substr(
                                                    $result->student_name
                                                        ?? $result->student->name
                                                        ?? $result->student->student_name
                                                        ?? 'S',
                                                    0,
                                                    1
                                                )) }}

                                            </div>

                                            <div>

                                                <p class="text-sm font-semibold text-slate-800">

                                                    {{ $result->student_name
                                                        ?? $result->student->name
                                                        ?? $result->student->student_name
                                                        ?? 'N/A' }}

                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Student ID --}}
                                    <td class="px-4 py-3 whitespace-nowrap">

                                        <span class="text-sm text-slate-600">

                                            {{ $result->student_id
                                                ?? $result->student->student_id
                                                ?? $result->student->id
                                                ?? '-' }}

                                        </span>

                                    </td>


                                    {{-- Subjects --}}
                                    <td class="px-4 py-3 text-center whitespace-nowrap">

                                        <span class="inline-flex items-center px-2.5 py-1
                                                     rounded-full bg-slate-100 text-slate-700
                                                     text-xs font-semibold">

                                            {{ $result->total_subjects ?? $result->subjects_count ?? 0 }}

                                        </span>

                                    </td>


                                    {{-- Total --}}
                                    <td class="px-4 py-3 text-right whitespace-nowrap">

                                        <span class="text-sm font-bold text-slate-800">

                                            {{ number_format((float)($result->total_marks ?? 0), 2) }}

                                        </span>

                                        <span class="text-xs text-slate-400">

                                            /
                                            {{ number_format((float)($result->total_full_marks ?? $result->full_marks ?? 0), 2) }}

                                        </span>

                                    </td>


                                    {{-- Percentage --}}
                                    <td class="px-4 py-3 text-right whitespace-nowrap">

                                        <span class="text-sm font-semibold text-slate-700">

                                            {{ number_format((float)($result->percentage ?? 0), 2) }}%

                                        </span>

                                    </td>


                                    {{-- Grade --}}
                                    <td class="px-4 py-3 text-center whitespace-nowrap">

                                        <span class="inline-flex items-center px-2.5 py-1
                                                     rounded-md bg-blue-50 text-blue-700
                                                     text-xs font-bold">

                                            {{ $result->grade ?? '-' }}

                                        </span>

                                    </td>


                                    {{-- GPA --}}
                                    <td class="px-4 py-3 text-center whitespace-nowrap">

                                        <span class="text-sm font-semibold text-slate-700">

                                            {{ number_format((float)($result->grade_point ?? $result->gpa ?? 0), 2) }}

                                        </span>

                                    </td>


                                    {{-- Result --}}
                                    <td class="px-4 py-3 text-center whitespace-nowrap">

                                        @if(($result->status ?? '') === 'Passed')

                                            <span class="inline-flex items-center px-2.5 py-1
                                                         rounded-full bg-green-50 text-green-700
                                                         text-xs font-semibold">

                                                Passed

                                            </span>

                                        @else

                                            <span class="inline-flex items-center px-2.5 py-1
                                                         rounded-full bg-red-50 text-red-700
                                                         text-xs font-semibold">

                                                Failed

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                    MOBILE CARDS
                ================================================== --}}
                <div class="md:hidden divide-y divide-slate-100">

                    @foreach($results as $result)

                        <div class="p-4">

                            <div class="flex items-start justify-between gap-3">

                                <div class="flex items-center gap-3 min-w-0">

                                    <div class="w-10 h-10 rounded-full bg-blue-50
                                                flex items-center justify-center
                                                text-blue-600 font-bold flex-shrink-0">

                                        {{ strtoupper(substr(
                                            $result->student_name
                                                ?? $result->student->name
                                                ?? $result->student->student_name
                                                ?? 'S',
                                            0,
                                            1
                                        )) }}

                                    </div>


                                    <div class="min-w-0">

                                        <p class="font-semibold text-slate-800 truncate">

                                            {{ $result->student_name
                                                ?? $result->student->name
                                                ?? $result->student->student_name
                                                ?? 'N/A' }}

                                        </p>

                                        <p class="text-xs text-slate-500 mt-0.5">

                                            ID:
                                            {{ $result->student_id
                                                ?? $result->student->student_id
                                                ?? $result->student->id
                                                ?? '-' }}

                                        </p>

                                    </div>

                                </div>


                                <div class="text-right flex-shrink-0">

                                    <p class="text-xs text-slate-500">
                                        Position
                                    </p>

                                    <p class="text-lg font-bold text-blue-600">

                                        #{{ $result->position ?? '-' }}

                                    </p>

                                </div>

                            </div>


                            <div class="grid grid-cols-2 gap-3 mt-4">

                                {{-- Total --}}
                                <div class="bg-slate-50 rounded-lg p-3">

                                    <p class="text-xs text-slate-500">
                                        Total Marks
                                    </p>

                                    <p class="text-sm font-bold text-slate-800 mt-1">

                                        {{ number_format((float)($result->total_marks ?? 0), 2) }}

                                        <span class="text-xs text-slate-400">

                                            /
                                            {{ number_format((float)($result->total_full_marks ?? $result->full_marks ?? 0), 2) }}

                                        </span>

                                    </p>

                                </div>


                                {{-- Percentage --}}
                                <div class="bg-slate-50 rounded-lg p-3">

                                    <p class="text-xs text-slate-500">
                                        Percentage
                                    </p>

                                    <p class="text-sm font-bold text-slate-800 mt-1">

                                        {{ number_format((float)($result->percentage ?? 0), 2) }}%

                                    </p>

                                </div>


                                {{-- Grade --}}
                                <div class="bg-slate-50 rounded-lg p-3">

                                    <p class="text-xs text-slate-500">
                                        Grade
                                    </p>

                                    <p class="text-sm font-bold text-blue-600 mt-1">

                                        {{ $result->grade ?? '-' }}

                                    </p>

                                </div>


                                {{-- GPA --}}
                                <div class="bg-slate-50 rounded-lg p-3">

                                    <p class="text-xs text-slate-500">
                                        GPA
                                    </p>

                                    <p class="text-sm font-bold text-slate-800 mt-1">

                                        {{ number_format((float)($result->grade_point ?? $result->gpa ?? 0), 2) }}

                                    </p>

                                </div>

                            </div>


                            <div class="flex items-center justify-between mt-4">

                                <div>

                                    <p class="text-xs text-slate-500">
                                        Subjects
                                    </p>

                                    <p class="text-sm font-semibold text-slate-700">

                                        {{ $result->total_subjects ?? $result->subjects_count ?? 0 }}

                                    </p>

                                </div>


                                <div>

                                    @if(($result->status ?? '') === 'Passed')

                                        <span class="inline-flex items-center px-3 py-1.5
                                                     rounded-full bg-green-50 text-green-700
                                                     text-xs font-semibold">

                                            Passed

                                        </span>

                                    @else

                                        <span class="inline-flex items-center px-3 py-1.5
                                                     rounded-full bg-red-50 text-red-700
                                                     text-xs font-semibold">

                                            Failed

                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>


            @else

                {{-- =================================================
                    NO RESULT
                ================================================== --}}
                <div class="py-16 px-5 text-center">

                    <div class="w-16 h-16 mx-auto rounded-full bg-slate-100
                                flex items-center justify-center mb-4">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-8 h-8 text-slate-400"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                        </svg>

                    </div>

                    <h3 class="text-lg font-semibold text-slate-700">
                        No Result Found
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        No marks have been entered for the selected examination and class.
                    </p>

                </div>

            @endif

        </div>


    @else

        {{-- =====================================================
            INITIAL STATE
        ====================================================== --}}
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm">

            <div class="py-16 px-5 text-center">

                <div class="w-16 h-16 mx-auto rounded-full bg-blue-50
                            flex items-center justify-center mb-4">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-8 h-8 text-blue-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                    </svg>

                </div>

                <h3 class="text-lg font-semibold text-slate-800">
                    Select Examination & Class
                </h3>

                <p class="text-sm text-slate-500 mt-1 max-w-md mx-auto">
                    Select an examination and class from the filters above
                    to view the complete class result.
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

        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            background: white !important;
        }

        body * {
            visibility: hidden;
        }

        .print\:block,
        .print\:block * {
            visibility: visible;
        }

        .bg-white,
        .border,
        .shadow-sm {
            box-shadow: none !important;
        }

        table {
            width: 100% !important;
        }

        .md\:block {
            display: block !important;
        }

        .md\:hidden {
            display: none !important;
        }

        button,
        a {
            display: none !important;
        }

    }

</style>

@endsection