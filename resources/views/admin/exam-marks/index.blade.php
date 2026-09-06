@extends('admin.layouts.app')

@section('title', 'Exam Marks')

@section('page-title', 'Exam Marks')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                Exam Marks
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage student examination marks, grades and results.
            </p>
        </div>

        <a href="{{ route('admin.exam-marks.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5
                  bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold
                  rounded-lg shadow-sm transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>

            Enter Marks
        </a>

    </div>


    {{-- =========================================================
        BREADCRUMB
    ========================================================== --}}
    <div class="mb-5">

        <nav class="flex items-center gap-2 text-sm text-slate-500">

            <a href="{{ route('dashboard') }}"
               class="hover:text-blue-600 transition">
                Dashboard
            </a>

            <span>/</span>

            <span class="text-slate-700 font-medium">
                Exam Marks
            </span>

        </nav>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))

        <div class="mb-5 flex items-start gap-3 p-4
                    bg-green-50 border border-green-200
                    text-green-700 rounded-xl">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5 mt-0.5 flex-shrink-0"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5 13l4 4L19 7"/>
            </svg>

            <div class="text-sm font-medium">
                {{ session('success') }}
            </div>

        </div>

    @endif


    {{-- =========================================================
        ERROR MESSAGE
    ========================================================== --}}
    @if($errors->any())

        <div class="mb-5 p-4
                    bg-red-50 border border-red-200
                    text-red-700 rounded-xl">

            <div class="font-semibold text-sm mb-2">
                Please fix the following errors:
            </div>

            <ul class="list-disc list-inside text-sm space-y-1">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        FILTER CARD
    ========================================================== --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm mb-6">

        <div class="px-4 sm:px-5 py-4 border-b border-slate-200">

            <div class="flex items-center gap-2">

                <div class="w-9 h-9 rounded-lg bg-blue-50
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 text-blue-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707L15 12v6l-6 3v-9L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>

                </div>

                <div>
                    <h2 class="font-semibold text-slate-800">
                        Filter Marks
                    </h2>

                    <p class="text-xs text-slate-500">
                        Search marks by examination, class, student or subject.
                    </p>
                </div>

            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.exam-marks.index') }}"
              class="p-4 sm:p-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-7 gap-4">


                {{-- Exam --}}
                <div>

                    <label for="exam_id"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Exam
                    </label>

                    <select id="exam_id"
                            name="exam_id"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm">

                        <option value="">
                            All Exams
                        </option>

                        @foreach($exams as $exam)

                            <option value="{{ $exam->id }}"
                                {{ request('exam_id') == $exam->id ? 'selected' : '' }}>

                                {{ $exam->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Academic Session --}}
                <div>

                    <label for="academic_session_id"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Academic Session
                    </label>

                    <select id="academic_session_id"
                            name="academic_session_id"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm">

                        <option value="">
                            All Sessions
                        </option>

                        @foreach($academicSessions as $session)

                            <option value="{{ $session->id }}"
                                {{ request('academic_session_id') == $session->id ? 'selected' : '' }}>

                                {{ $session->name ?? ('Session #' . $session->id) }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Class --}}
                <div>

                    <label for="school_class_id"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Class
                    </label>

                    <select id="school_class_id"
                            name="school_class_id"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm">

                        <option value="">
                            All Classes
                        </option>

                        @foreach($schoolClasses as $class)

                            <option value="{{ $class->id }}"
                                {{ request('school_class_id') == $class->id ? 'selected' : '' }}>

                                {{ $class->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Section --}}
                <div>

                    <label for="section_id"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Section
                    </label>

                    <select id="section_id"
                            name="section_id"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm">

                        <option value="">
                            All Sections
                        </option>

                        @foreach($sections as $section)

                            <option value="{{ $section->id }}"
                                {{ request('section_id') == $section->id ? 'selected' : '' }}>

                                {{ $section->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Subject --}}
                <div>

                    <label for="subject_id"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Subject
                    </label>

                    <select id="subject_id"
                            name="subject_id"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm">

                        <option value="">
                            All Subjects
                        </option>

                        @foreach($subjects as $subject)

                            <option value="{{ $subject->id }}"
                                {{ request('subject_id') == $subject->id ? 'selected' : '' }}>

                                {{ $subject->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Student --}}
                <div>

                    <label for="student_id"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Student
                    </label>

                    <select id="student_id"
                            name="student_id"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm">

                        <option value="">
                            All Students
                        </option>

                        @foreach($students as $student)

                            <option value="{{ $student->id }}"
                                {{ request('student_id') == $student->id ? 'selected' : '' }}>

                                {{ $student->name ?? ('Student #' . $student->id) }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Status --}}
                <div>

                    <label for="status"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Status
                    </label>

                    <select id="status"
                            name="status"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm">

                        <option value="">
                            All Status
                        </option>

                        <option value="1"
                            {{ request('status') === '1' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ request('status') === '0' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>

            </div>


            {{-- Filter Buttons --}}
            <div class="flex flex-wrap items-center gap-3 mt-5">

                <button type="submit"
                        class="inline-flex items-center gap-2
                               px-4 py-2.5 rounded-lg
                               bg-blue-600 hover:bg-blue-700
                               text-white text-sm font-semibold
                               transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>

                    Filter
                </button>


                <a href="{{ route('admin.exam-marks.index') }}"
                   class="inline-flex items-center gap-2
                          px-4 py-2.5 rounded-lg
                          bg-slate-100 hover:bg-slate-200
                          text-slate-700 text-sm font-semibold
                          transition">

                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- =========================================================
        DESKTOP TABLE
    ========================================================== --}}
    <div class="hidden md:block bg-white border border-slate-200
                rounded-xl shadow-sm overflow-hidden">

        {{-- Table Header --}}
        <div class="px-5 py-4 border-b border-slate-200
                    flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-2">

            <div>

                <h2 class="font-semibold text-slate-800">
                    Marks List
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    {{ $examMarks->total() }} record(s) found
                </p>

            </div>

            <div class="text-sm text-slate-500">

                Showing
                <span class="font-semibold text-slate-700">
                    {{ $examMarks->firstItem() ?? 0 }}
                </span>

                -
                <span class="font-semibold text-slate-700">
                    {{ $examMarks->lastItem() ?? 0 }}
                </span>

                of

                <span class="font-semibold text-slate-700">
                    {{ $examMarks->total() }}
                </span>

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-5 py-3 text-left text-xs font-semibold
                                   text-slate-600 uppercase tracking-wider">
                            #
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold
                                   text-slate-600 uppercase tracking-wider">
                            Student
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold
                                   text-slate-600 uppercase tracking-wider">
                            Exam
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold
                                   text-slate-600 uppercase tracking-wider">
                            Class / Section
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold
                                   text-slate-600 uppercase tracking-wider">
                            Subject
                        </th>

                        <th class="px-5 py-3 text-center text-xs font-semibold
                                   text-slate-600 uppercase tracking-wider">
                            Marks
                        </th>

                        <th class="px-5 py-3 text-center text-xs font-semibold
                                   text-slate-600 uppercase tracking-wider">
                            Grade
                        </th>

                        <th class="px-5 py-3 text-center text-xs font-semibold
                                   text-slate-600 uppercase tracking-wider">
                            Result
                        </th>

                        <th class="px-5 py-3 text-center text-xs font-semibold
                                   text-slate-600 uppercase tracking-wider">
                            Status
                        </th>

                        <th class="px-5 py-3 text-right text-xs font-semibold
                                   text-slate-600 uppercase tracking-wider">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="bg-white divide-y divide-slate-200">

                    @forelse($examMarks as $index => $examMark)

                        @php
                            $obtained = $examMark->obtained_marks;
                            $fullMarks = $examMark->full_marks;
                            $passMarks = $examMark->pass_marks;

                            $isPassed = $obtained !== null
                                && ($passMarks === null || $obtained >= $passMarks);
                        @endphp

                        <tr class="hover:bg-slate-50 transition">

                            {{-- # --}}
                            <td class="px-5 py-4 text-sm text-slate-500">
                                {{ $examMarks->firstItem() + $index }}
                            </td>


                            {{-- Student --}}
                            <td class="px-5 py-4">

                                <div class="font-semibold text-slate-800 text-sm">

                                    {{ $examMark->student?->name
                                        ?? $examMark->student?->student_name
                                        ?? 'N/A' }}

                                </div>

                                @if($examMark->student?->student_id)
                                    <div class="text-xs text-slate-500 mt-0.5">
                                        ID: {{ $examMark->student->student_id }}
                                    </div>
                                @endif

                            </td>


                            {{-- Exam --}}
                            <td class="px-5 py-4">

                                <div class="text-sm font-medium text-slate-800">
                                    {{ $examMark->exam?->name ?? 'N/A' }}
                                </div>

                                @if($examMark->academicSession)
                                    <div class="text-xs text-slate-500 mt-0.5">
                                        {{ $examMark->academicSession->name ?? 'Session #' . $examMark->academic_session_id }}
                                    </div>
                                @endif

                            </td>


                            {{-- Class / Section --}}
                            <td class="px-5 py-4">

                                <div class="text-sm text-slate-700">

                                    {{ $examMark->schoolClass?->name ?? 'N/A' }}

                                    @if($examMark->section)
                                        <span class="text-slate-400">/</span>
                                        {{ $examMark->section->name }}
                                    @endif

                                </div>

                            </td>


                            {{-- Subject --}}
                            <td class="px-5 py-4">

                                <span class="inline-flex items-center
                                             px-2.5 py-1 rounded-md
                                             bg-blue-50 text-blue-700
                                             text-xs font-semibold">

                                    {{ $examMark->subject?->name ?? 'N/A' }}

                                </span>

                            </td>


                            {{-- Marks --}}
                            <td class="px-5 py-4 text-center">

                                @if($obtained !== null)

                                    <div class="font-bold text-slate-800">
                                        {{ number_format((float) $obtained, 2) }}
                                    </div>

                                    <div class="text-xs text-slate-500">
                                        / {{ number_format((float) $fullMarks, 2) }}
                                    </div>

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Grade --}}
                            <td class="px-5 py-4 text-center">

                                @if($examMark->grade)

                                    <span class="inline-flex items-center
                                                 justify-center min-w-[42px]
                                                 px-2.5 py-1 rounded-lg
                                                 bg-slate-100 text-slate-700
                                                 text-sm font-bold">

                                        {{ $examMark->grade }}

                                    </span>

                                    @if($examMark->grade_point !== null)

                                        <div class="text-xs text-slate-500 mt-1">
                                            GP:
                                            {{ number_format((float) $examMark->grade_point, 2) }}
                                        </div>

                                    @endif

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Result --}}
                            <td class="px-5 py-4 text-center">

                                @if($obtained === null)

                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-full
                                                 bg-slate-100 text-slate-600
                                                 text-xs font-semibold">
                                        Pending
                                    </span>

                                @elseif($isPassed)

                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-full
                                                 bg-green-50 text-green-700
                                                 text-xs font-semibold">
                                        Passed
                                    </span>

                                @else

                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-full
                                                 bg-red-50 text-red-700
                                                 text-xs font-semibold">
                                        Failed
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-5 py-4 text-center">

                                @if($examMark->status)

                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-full
                                                 bg-green-50 text-green-700
                                                 text-xs font-semibold">

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-full
                                                 bg-red-50 text-red-700
                                                 text-xs font-semibold">

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- View --}}
                                    <a href="{{ route('admin.exam-marks.show', $examMark) }}"
                                       title="View"
                                       class="inline-flex items-center justify-center
                                              w-9 h-9 rounded-lg
                                              bg-blue-50 text-blue-600
                                              hover:bg-blue-100 transition">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-4 h-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>

                                        </svg>

                                    </a>


                                    {{-- Edit --}}
                                    <a href="{{ route('admin.exam-marks.edit', $examMark) }}"
                                       title="Edit"
                                       class="inline-flex items-center justify-center
                                              w-9 h-9 rounded-lg
                                              bg-amber-50 text-amber-600
                                              hover:bg-amber-100 transition">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-4 h-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>

                                        </svg>

                                    </a>


                                    {{-- Delete --}}
                                    <form method="POST"
                                          action="{{ route('admin.exam-marks.destroy', $examMark) }}"
                                          onsubmit="return confirm('Are you sure you want to delete these marks?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                title="Delete"
                                                class="inline-flex items-center justify-center
                                                       w-9 h-9 rounded-lg
                                                       bg-red-50 text-red-600
                                                       hover:bg-red-100 transition">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="w-4 h-4"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h12"/>

                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="10"
                                class="px-5 py-12 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-14 h-14 rounded-full
                                                bg-slate-100
                                                flex items-center justify-center
                                                mb-3">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-7 h-7 text-slate-400"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                                        </svg>

                                    </div>

                                    <h3 class="font-semibold text-slate-700">
                                        No marks found
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        No examination marks match your current filters.
                                    </p>

                                    <a href="{{ route('admin.exam-marks.create') }}"
                                       class="mt-4 inline-flex items-center gap-2
                                              px-4 py-2 rounded-lg
                                              bg-blue-600 hover:bg-blue-700
                                              text-white text-sm font-semibold">

                                        Enter Marks

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($examMarks->hasPages())

            <div class="px-5 py-4 border-t border-slate-200">

                {{ $examMarks->links() }}

            </div>

        @endif

    </div>


    {{-- =========================================================
        MOBILE CARDS
    ========================================================== --}}
    <div class="md:hidden space-y-4">

        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm px-4 py-4">

            <div class="flex items-center justify-between">

                <div>
                    <h2 class="font-semibold text-slate-800">
                        Marks List
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        {{ $examMarks->total() }} record(s)
                    </p>
                </div>

            </div>

        </div>


        @forelse($examMarks as $examMark)

            @php
                $obtained = $examMark->obtained_marks;
                $fullMarks = $examMark->full_marks;
                $passMarks = $examMark->pass_marks;

                $isPassed = $obtained !== null
                    && ($passMarks === null || $obtained >= $passMarks);
            @endphp

            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm overflow-hidden">

                {{-- Card Header --}}
                <div class="px-4 py-4 bg-slate-50
                            border-b border-slate-200">

                    <div class="flex items-start justify-between gap-3">

                        <div class="min-w-0">

                            <h3 class="font-bold text-slate-800 truncate">

                                {{ $examMark->student?->name
                                    ?? $examMark->student?->student_name
                                    ?? 'N/A' }}

                            </h3>

                            <p class="text-xs text-slate-500 mt-1">

                                {{ $examMark->exam?->name ?? 'N/A' }}

                            </p>

                        </div>


                        @if($examMark->status)

                            <span class="flex-shrink-0 inline-flex
                                         px-2.5 py-1 rounded-full
                                         bg-green-50 text-green-700
                                         text-xs font-semibold">

                                Active

                            </span>

                        @else

                            <span class="flex-shrink-0 inline-flex
                                         px-2.5 py-1 rounded-full
                                         bg-red-50 text-red-700
                                         text-xs font-semibold">

                                Inactive

                            </span>

                        @endif

                    </div>

                </div>


                {{-- Card Body --}}
                <div class="p-4 space-y-4">

                    <div class="grid grid-cols-2 gap-3">

                        <div class="p-3 rounded-lg bg-slate-50">

                            <div class="text-xs text-slate-500 mb-1">
                                Class
                            </div>

                            <div class="text-sm font-semibold text-slate-700">

                                {{ $examMark->schoolClass?->name ?? 'N/A' }}

                                @if($examMark->section)
                                    / {{ $examMark->section->name }}
                                @endif

                            </div>

                        </div>


                        <div class="p-3 rounded-lg bg-blue-50">

                            <div class="text-xs text-blue-600 mb-1">
                                Subject
                            </div>

                            <div class="text-sm font-semibold text-blue-700">

                                {{ $examMark->subject?->name ?? 'N/A' }}

                            </div>

                        </div>

                    </div>


                    {{-- Marks --}}
                    <div class="grid grid-cols-3 gap-3">

                        <div class="text-center p-3 rounded-lg bg-slate-50">

                            <div class="text-xs text-slate-500 mb-1">
                                Obtained
                            </div>

                            <div class="text-lg font-bold text-slate-800">

                                {{ $obtained !== null
                                    ? number_format((float) $obtained, 2)
                                    : '—' }}

                            </div>

                        </div>


                        <div class="text-center p-3 rounded-lg bg-slate-50">

                            <div class="text-xs text-slate-500 mb-1">
                                Full Marks
                            </div>

                            <div class="text-lg font-bold text-slate-800">

                                {{ number_format((float) $fullMarks, 2) }}

                            </div>

                        </div>


                        <div class="text-center p-3 rounded-lg bg-slate-50">

                            <div class="text-xs text-slate-500 mb-1">
                                Grade
                            </div>

                            <div class="text-lg font-bold text-slate-800">

                                {{ $examMark->grade ?? '—' }}

                            </div>

                        </div>

                    </div>


                    {{-- Result --}}
                    <div class="flex items-center justify-between
                                p-3 rounded-lg border border-slate-200">

                        <span class="text-sm text-slate-600">
                            Result
                        </span>

                        @if($obtained === null)

                            <span class="inline-flex px-2.5 py-1 rounded-full
                                         bg-slate-100 text-slate-600
                                         text-xs font-semibold">
                                Pending
                            </span>

                        @elseif($isPassed)

                            <span class="inline-flex px-2.5 py-1 rounded-full
                                         bg-green-50 text-green-700
                                         text-xs font-semibold">
                                Passed
                            </span>

                        @else

                            <span class="inline-flex px-2.5 py-1 rounded-full
                                         bg-red-50 text-red-700
                                         text-xs font-semibold">
                                Failed
                            </span>

                        @endif

                    </div>


                    {{-- Actions --}}
                    <div class="flex items-center gap-2 pt-1">

                        <a href="{{ route('admin.exam-marks.show', $examMark) }}"
                           class="flex-1 inline-flex items-center justify-center
                                  gap-2 px-3 py-2.5 rounded-lg
                                  bg-blue-50 text-blue-600
                                  hover:bg-blue-100
                                  text-sm font-semibold transition">

                            View

                        </a>


                        <a href="{{ route('admin.exam-marks.edit', $examMark) }}"
                           class="flex-1 inline-flex items-center justify-center
                                  gap-2 px-3 py-2.5 rounded-lg
                                  bg-amber-50 text-amber-600
                                  hover:bg-amber-100
                                  text-sm font-semibold transition">

                            Edit

                        </a>


                        <form method="POST"
                              action="{{ route('admin.exam-marks.destroy', $examMark) }}"
                              onsubmit="return confirm('Are you sure you want to delete these marks?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="inline-flex items-center justify-center
                                           w-11 h-11 rounded-lg
                                           bg-red-50 text-red-600
                                           hover:bg-red-100
                                           transition">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-4 h-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h12"/>

                                </svg>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm p-8 text-center">

                <div class="w-14 h-14 rounded-full bg-slate-100
                            flex items-center justify-center mx-auto mb-3">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-7 h-7 text-slate-400"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                    </svg>

                </div>

                <h3 class="font-semibold text-slate-700">
                    No marks found
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Start entering examination marks.
                </p>

                <a href="{{ route('admin.exam-marks.create') }}"
                   class="inline-flex mt-4 px-4 py-2
                          bg-blue-600 hover:bg-blue-700
                          text-white text-sm font-semibold rounded-lg">

                    Enter Marks

                </a>

            </div>

        @endforelse


        {{-- Mobile Pagination --}}
        @if($examMarks->hasPages())

            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm p-4">

                {{ $examMarks->links() }}

            </div>

        @endif

    </div>

</div>

@endsection