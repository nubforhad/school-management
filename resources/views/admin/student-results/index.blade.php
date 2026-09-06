@extends('admin.layouts.app')

@section('title', 'Student Result')

@section('page-title', 'Student Result')

@section('content')

<div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="mb-6">

        <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">

            <span>Result</span>

            <span>/</span>

            <span class="text-slate-700">
                Student Result
            </span>

        </div>

        <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
            Student Result
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Search and view individual student's examination result.
        </p>

    </div>


    {{-- =========================================================
        SEARCH FORM
    ========================================================== --}}
    <div class="bg-white border border-slate-200
                rounded-xl shadow-sm mb-6">

        <div class="px-5 py-4 border-b border-slate-200
                    bg-slate-50 rounded-t-xl">

            <h2 class="text-lg font-semibold text-slate-800">
                Search Student Result
            </h2>

        </div>

        <form method="GET"
              action="{{ route('admin.student-results.index') }}"
              class="p-5">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Exam --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1">

                        Examination

                    </label>

                    <select name="exam_id"
                            required
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500
                                   focus:ring-blue-500">

                        <option value="">
                            Select Examination
                        </option>

                        @foreach($exams as $exam)

                            <option value="{{ $exam->id }}"
                                @selected(request('exam_id') == $exam->id)>

                                {{ $exam->name }}

                                @if($exam->code)
                                    ({{ $exam->code }})
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Class --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1">

                        Class

                    </label>

                    <select name="class_id"
                            id="class_id"
                            required
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500
                                   focus:ring-blue-500">

                        <option value="">
                            Select Class
                        </option>

                        @foreach($classes as $class)

                            <option value="{{ $class->id }}"
                                @selected(request('class_id') == $class->id)>

                                {{ $class->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Section --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1">

                        Section

                    </label>

                    <select name="section_id"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500
                                   focus:ring-blue-500">

                        <option value="">
                            All Sections
                        </option>

                        @foreach($sections as $section)

                            <option value="{{ $section->id }}"
                                @selected(request('section_id') == $section->id)>

                                {{ $section->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Student --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1">

                        Student

                    </label>

                    <select name="student_id"
                            id="student_id"
                            required
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500
                                   focus:ring-blue-500">

                        <option value="">
                            Select Student
                        </option>

                        @foreach($students as $student)

                            <option value="{{ $student->id }}"
                                @selected(request('student_id') == $student->id)>

                                {{ $student->name ?? $student->student_name }}

                                @if($student->student_id)
                                    - {{ $student->student_id }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            {{-- Buttons --}}
            <div class="flex flex-wrap gap-2 mt-5">

                <button type="submit"
                        class="inline-flex items-center gap-2
                               px-5 py-2.5
                               bg-blue-600 hover:bg-blue-700
                               text-white text-sm font-medium
                               rounded-lg transition">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"/>

                    </svg>

                    View Result

                </button>


                <a href="{{ route('admin.student-results.index') }}"
                   class="inline-flex items-center gap-2
                          px-5 py-2.5
                          bg-slate-100 hover:bg-slate-200
                          text-slate-700 text-sm font-medium
                          rounded-lg transition">

                    Reset

                </a>

            </div>

        </form>

    </div>


    {{-- =========================================================
        RESULT
    ========================================================== --}}
    @if($result && $selectedStudent && $selectedExam)

        {{-- Student Header --}}
        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm mb-6">

            <div class="p-5">

                <div class="flex flex-col md:flex-row
                            md:items-center md:justify-between gap-4">

                    <div>

                        <h2 class="text-xl font-bold text-slate-800">

                            {{ $selectedStudent->name
                                ?? $selectedStudent->student_name }}

                        </h2>

                        <p class="text-sm text-slate-500 mt-1">

                            Examination:
                            <span class="font-medium text-slate-700">
                                {{ $selectedExam->name }}
                            </span>

                        </p>

                    </div>


                    @if($result['status'] === 'Pass')

                        <span class="inline-flex items-center
                                     px-4 py-2 rounded-full
                                     bg-green-100 text-green-700
                                     text-sm font-bold">

                            PASS

                        </span>

                    @else

                        <span class="inline-flex items-center
                                     px-4 py-2 rounded-full
                                     bg-red-100 text-red-700
                                     text-sm font-bold">

                            FAIL

                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- Summary Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-6">

            {{-- Total Marks --}}
            <div class="bg-white border border-slate-200
                        rounded-xl p-5 shadow-sm">

                <p class="text-xs font-medium text-slate-500 uppercase">
                    Total Marks
                </p>

                <p class="text-2xl font-bold text-slate-800 mt-2">

                    {{ number_format($result['total_marks'], 2) }}

                </p>

                <p class="text-xs text-slate-500 mt-1">

                    /
                    {{ number_format($result['total_full_marks'], 2) }}

                </p>

            </div>


            {{-- Percentage --}}
            <div class="bg-white border border-slate-200
                        rounded-xl p-5 shadow-sm">

                <p class="text-xs font-medium text-slate-500 uppercase">
                    Percentage
                </p>

                <p class="text-2xl font-bold text-blue-600 mt-2">

                    {{ number_format($result['percentage'], 2) }}%

                </p>

            </div>


            {{-- Grade --}}
            <div class="bg-white border border-slate-200
                        rounded-xl p-5 shadow-sm">

                <p class="text-xs font-medium text-slate-500 uppercase">
                    Grade
                </p>

                <p class="text-2xl font-bold text-slate-800 mt-2">

                    {{ $result['grade'] }}

                </p>

            </div>


            {{-- Grade Point --}}
            <div class="bg-white border border-slate-200
                        rounded-xl p-5 shadow-sm">

                <p class="text-xs font-medium text-slate-500 uppercase">
                    Grade Point
                </p>

                <p class="text-2xl font-bold text-slate-800 mt-2">

                    {{ number_format($result['grade_point'], 2) }}

                </p>

            </div>


            {{-- Subjects --}}
            <div class="bg-white border border-slate-200
                        rounded-xl p-5 shadow-sm">

                <p class="text-xs font-medium text-slate-500 uppercase">
                    Subjects
                </p>

                <p class="text-2xl font-bold text-slate-800 mt-2">

                    {{ $result['total_subjects'] }}

                </p>

                <p class="text-xs text-slate-500 mt-1">

                    {{ $result['passed_subjects'] }} Passed /
                    {{ $result['failed_subjects'] }} Failed

                </p>

            </div>

        </div>


        {{-- =====================================================
            MARKS TABLE
        ====================================================== --}}
        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-200
                        bg-slate-50">

                <h2 class="text-lg font-semibold text-slate-800">
                    Subject-wise Result
                </h2>

            </div>


            {{-- Desktop --}}
            <div class="hidden md:block overflow-x-auto">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                #
                            </th>

                            <th class="px-5 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                Subject
                            </th>

                            <th class="px-5 py-3 text-center text-xs
                                       font-semibold text-slate-500 uppercase">
                                Full Marks
                            </th>

                            <th class="px-5 py-3 text-center text-xs
                                       font-semibold text-slate-500 uppercase">
                                Pass Marks
                            </th>

                            <th class="px-5 py-3 text-center text-xs
                                       font-semibold text-slate-500 uppercase">
                                Obtained
                            </th>

                            <th class="px-5 py-3 text-center text-xs
                                       font-semibold text-slate-500 uppercase">
                                Percentage
                            </th>

                            <th class="px-5 py-3 text-center text-xs
                                       font-semibold text-slate-500 uppercase">
                                Grade
                            </th>

                            <th class="px-5 py-3 text-center text-xs
                                       font-semibold text-slate-500 uppercase">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody class="bg-white divide-y divide-slate-100">

                        @forelse($result['marks'] as $index => $mark)

                            @php

                                $obtained = $mark->marks !== null
                                    ? (float) $mark->marks
                                    : 0;

                                $full = (float) ($mark->full_marks ?? 0);

                                $pass = $mark->pass_marks !== null
                                    ? (float) $mark->pass_marks
                                    : null;

                                $subjectPercentage = $full > 0
                                    ? ($obtained / $full) * 100
                                    : 0;

                                $subjectPassed = $pass !== null
                                    ? $obtained >= $pass
                                    : $subjectPercentage >= 33;

                            @endphp

                            <tr class="hover:bg-slate-50">

                                <td class="px-5 py-4 text-sm text-slate-600">
                                    {{ $index + 1 }}
                                </td>

                                <td class="px-5 py-4">

                                    <p class="text-sm font-semibold text-slate-800">

                                        {{ $mark->subject?->name ?? 'N/A' }}

                                    </p>

                                </td>

                                <td class="px-5 py-4 text-center
                                           text-sm text-slate-700">

                                    {{ number_format($full, 2) }}

                                </td>

                                <td class="px-5 py-4 text-center
                                           text-sm text-slate-700">

                                    {{ $pass !== null
                                        ? number_format($pass, 2)
                                        : '-' }}

                                </td>

                                <td class="px-5 py-4 text-center">

                                    <span class="font-semibold text-slate-800">

                                        {{ number_format($obtained, 2) }}

                                    </span>

                                </td>

                                <td class="px-5 py-4 text-center
                                           text-sm text-slate-700">

                                    {{ number_format($subjectPercentage, 2) }}%

                                </td>

                                <td class="px-5 py-4 text-center">

                                    <span class="inline-flex px-2.5 py-1
                                                 rounded-full
                                                 bg-blue-50 text-blue-700
                                                 text-xs font-bold">

                                        {{ $mark->grade ?? '-' }}

                                    </span>

                                </td>

                                <td class="px-5 py-4 text-center">

                                    @if($subjectPassed)

                                        <span class="inline-flex px-2.5 py-1
                                                     rounded-full
                                                     bg-green-100 text-green-700
                                                     text-xs font-semibold">

                                            Passed

                                        </span>

                                    @else

                                        <span class="inline-flex px-2.5 py-1
                                                     rounded-full
                                                     bg-red-100 text-red-700
                                                     text-xs font-semibold">

                                            Failed

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8"
                                    class="px-5 py-10 text-center
                                           text-sm text-slate-500">

                                    No marks found for this student.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =================================================
                MOBILE CARDS
            ================================================== --}}
            <div class="md:hidden divide-y divide-slate-200">

                @forelse($result['marks'] as $index => $mark)

                    @php

                        $obtained = $mark->marks !== null
                            ? (float) $mark->marks
                            : 0;

                        $full = (float) ($mark->full_marks ?? 0);

                        $pass = $mark->pass_marks !== null
                            ? (float) $mark->pass_marks
                            : null;

                        $subjectPercentage = $full > 0
                            ? ($obtained / $full) * 100
                            : 0;

                        $subjectPassed = $pass !== null
                            ? $obtained >= $pass
                            : $subjectPercentage >= 33;

                    @endphp

                    <div class="p-4">

                        <div class="flex items-start
                                    justify-between gap-3">

                            <div>

                                <p class="text-xs text-slate-400">
                                    #{{ $index + 1 }}
                                </p>

                                <h3 class="font-semibold text-slate-800 mt-1">

                                    {{ $mark->subject?->name ?? 'N/A' }}

                                </h3>

                            </div>


                            @if($subjectPassed)

                                <span class="px-2.5 py-1 rounded-full
                                             bg-green-100 text-green-700
                                             text-xs font-semibold">
                                    Passed
                                </span>

                            @else

                                <span class="px-2.5 py-1 rounded-full
                                             bg-red-100 text-red-700
                                             text-xs font-semibold">
                                    Failed
                                </span>

                            @endif

                        </div>


                        <div class="grid grid-cols-2 gap-3 mt-4">

                            <div class="bg-slate-50 rounded-lg p-3">

                                <p class="text-xs text-slate-500">
                                    Obtained
                                </p>

                                <p class="font-bold text-slate-800 mt-1">

                                    {{ number_format($obtained, 2) }}
                                    /
                                    {{ number_format($full, 2) }}

                                </p>

                            </div>


                            <div class="bg-slate-50 rounded-lg p-3">

                                <p class="text-xs text-slate-500">
                                    Percentage
                                </p>

                                <p class="font-bold text-slate-800 mt-1">

                                    {{ number_format($subjectPercentage, 2) }}%

                                </p>

                            </div>


                            <div class="bg-slate-50 rounded-lg p-3">

                                <p class="text-xs text-slate-500">
                                    Pass Marks
                                </p>

                                <p class="font-bold text-slate-800 mt-1">

                                    {{ $pass !== null
                                        ? number_format($pass, 2)
                                        : '-' }}

                                </p>

                            </div>


                            <div class="bg-slate-50 rounded-lg p-3">

                                <p class="text-xs text-slate-500">
                                    Grade
                                </p>

                                <p class="font-bold text-blue-600 mt-1">

                                    {{ $mark->grade ?? '-' }}

                                </p>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="p-8 text-center text-sm text-slate-500">
                        No marks found.
                    </div>

                @endforelse

            </div>

        </div>


        {{-- Print --}}
        <div class="flex justify-end mt-5">

            <button type="button"
                    onclick="window.print()"
                    class="inline-flex items-center gap-2
                           px-5 py-2.5
                           bg-slate-800 hover:bg-slate-900
                           text-white text-sm font-medium
                           rounded-lg transition">

                Print Result

            </button>

        </div>

    @endif

</div>

@endsection