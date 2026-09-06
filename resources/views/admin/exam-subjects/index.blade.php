@extends('admin.layouts.app')

@section('title', 'Exam Subjects')

@section('page-title', 'Exam Subjects')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="mb-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    Exam Subjects
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Manage subjects assigned to different examinations.
                </p>
            </div>

            <a href="{{ route('admin.exam-subjects.create') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2.5
                      bg-blue-600 hover:bg-blue-700 text-white
                      rounded-lg text-sm font-semibold shadow-sm transition">

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

                Assign Subject
            </a>

        </div>

    </div>


    {{-- =========================================================
        BREADCRUMB
    ========================================================== --}}
    <div class="mb-6">

        <nav class="flex items-center text-sm text-slate-500 gap-2">

            <a href="{{ route('admin.exams.index') }}"
               class="hover:text-blue-600 transition">
                Exams
            </a>

            <span>/</span>

            <span class="text-slate-700 font-medium">
                Exam Subjects
            </span>

        </nav>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))

        <div class="mb-5 rounded-lg border border-green-200 bg-green-50
                    px-4 py-3 text-sm text-green-700">

            <div class="flex items-start gap-3">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 mt-0.5 shrink-0"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7"/>

                </svg>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        </div>

    @endif


    {{-- =========================================================
        ERROR MESSAGE
    ========================================================== --}}
    @if($errors->any())

        <div class="mb-5 rounded-lg border border-red-200 bg-red-50
                    px-4 py-3 text-sm text-red-700">

            <div class="font-semibold mb-1">
                Please fix the following errors:
            </div>

            <ul class="list-disc pl-5 space-y-1">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        FILTER CARD
    ========================================================== --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm mb-6">

        <div class="px-5 py-4 border-b border-slate-200 bg-slate-50 rounded-t-xl">

            <div class="flex items-center gap-2">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-slate-600"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 11.414V19l-6 3v-10.586L3.293 6.707A1 1 0 013 6V4z"/>

                </svg>

                <h2 class="font-semibold text-slate-700">
                    Filter Exam Subjects
                </h2>

            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.exam-subjects.index') }}"
              class="p-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Exam --}}
                <div>

                    <label for="exam_id"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Exam
                    </label>

                    <select name="exam_id"
                            id="exam_id"
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

                                @if($exam->code)
                                    ({{ $exam->code }})
                                @endif

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

                    <select name="academic_session_id"
                            id="academic_session_id"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm">

                        <option value="">
                            All Sessions
                        </option>

                        @foreach($academicSessions as $session)

                            <option value="{{ $session->id }}"
                                {{ request('academic_session_id') == $session->id ? 'selected' : '' }}>

                                {{ $session->name }}

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

                    <select name="school_class_id"
                            id="school_class_id"
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


                {{-- Status --}}
                <div>

                    <label for="status"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Status
                    </label>

                    <select name="status"
                            id="status"
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
            <div class="flex flex-wrap items-center gap-2 mt-5">

                <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2
                               bg-blue-600 hover:bg-blue-700 text-white
                               rounded-lg text-sm font-semibold transition">

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


                <a href="{{ route('admin.exam-subjects.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2
                          bg-slate-100 hover:bg-slate-200
                          text-slate-700 rounded-lg
                          text-sm font-semibold transition">

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

        <div class="px-5 py-4 border-b border-slate-200
                    flex items-center justify-between bg-slate-50">

            <div>

                <h2 class="font-semibold text-slate-800">
                    Assigned Subjects
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Total:
                    {{ $examSubjects->total() }}
                </p>

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
                            Exam
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold
                                   text-slate-600 uppercase tracking-wider">
                            Academic Session
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
                            Status
                        </th>

                        <th class="px-5 py-3 text-right text-xs font-semibold
                                   text-slate-600 uppercase tracking-wider">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="bg-white divide-y divide-slate-200">

                    @forelse($examSubjects as $index => $examSubject)

                        <tr class="hover:bg-slate-50 transition">

                            {{-- # --}}
                            <td class="px-5 py-4 text-sm text-slate-600">

                                {{ $examSubjects->firstItem() + $index }}

                            </td>


                            {{-- Exam --}}
                            <td class="px-5 py-4">

                                <div class="font-semibold text-slate-800">

                                    {{ $examSubject->exam?->name ?? 'N/A' }}

                                </div>

                                @if($examSubject->exam?->code)

                                    <div class="text-xs text-slate-500 mt-0.5">

                                        Code:
                                        {{ $examSubject->exam->code }}

                                    </div>

                                @endif

                            </td>


                            {{-- Session --}}
                            <td class="px-5 py-4 text-sm text-slate-700">

                                {{ $examSubject->academicSession?->name ?? 'N/A' }}

                            </td>


                            {{-- Class --}}
                            <td class="px-5 py-4">

                                <div class="text-sm font-medium text-slate-800">

                                    {{ $examSubject->schoolClass?->name ?? 'N/A' }}

                                </div>

                                <div class="text-xs text-slate-500 mt-0.5">

                                    {{ $examSubject->section?->name ?? 'All Sections' }}

                                </div>

                            </td>


                            {{-- Subject --}}
                            <td class="px-5 py-4">

                                <div class="text-sm font-semibold text-slate-800">

                                    {{ $examSubject->subject?->name ?? 'N/A' }}

                                </div>

                            </td>


                            {{-- Marks --}}
                            <td class="px-5 py-4 text-center">

                                <div class="text-sm font-semibold text-slate-800">

                                    {{ number_format($examSubject->full_marks, 0) }}

                                </div>

                                <div class="text-xs text-slate-500">

                                    Pass:
                                    {{ $examSubject->pass_marks !== null
                                        ? number_format($examSubject->pass_marks, 0)
                                        : '-' }}

                                </div>

                            </td>


                            {{-- Status --}}
                            <td class="px-5 py-4 text-center">

                                @if($examSubject->status)

                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-green-100 text-green-700">

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-red-100 text-red-700">

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- View --}}
                                    <a href="{{ route(
                                            'admin.exam-subjects.show',
                                            $examSubject
                                        ) }}"
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
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5
                                                     c4.478 0 8.268 2.943 9.542 7
                                                     -1.274 4.057-5.064 7-9.542 7
                                                     -4.477 0-8.268-2.943-9.542-7z"/>

                                        </svg>

                                    </a>


                                    {{-- Edit --}}
                                    <a href="{{ route(
                                            'admin.exam-subjects.edit',
                                            $examSubject
                                        ) }}"
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
                                                  d="M11 5H6a2 2 0 00-2 2v11
                                                     a2 2 0 002 2h11a2 2 0 002-2v-5"/>

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M18.5 2.5a2.121 2.121 0 013 3L12 15
                                                     l-4 1 1-4 9.5-9.5z"/>

                                        </svg>

                                    </a>


                                    {{-- Delete --}}
                                    <form method="POST"
                                          action="{{ route(
                                              'admin.exam-subjects.destroy',
                                              $examSubject
                                          ) }}"
                                          onsubmit="return confirm(
                                              'Are you sure you want to delete this exam subject?'
                                          )">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                title="Delete"
                                                class="inline-flex items-center
                                                       justify-center w-9 h-9
                                                       rounded-lg
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
                                                      d="M19 7l-.867 12.142
                                                         A2 2 0 0116.138 21H7.862
                                                         a2 2 0 01-1.995-1.858L5 7
                                                         m5 4v6m4-6v6m1-10V4
                                                         a1 1 0 00-1-1h-4
                                                         a1 1 0 00-1 1v3
                                                         M4 7h16"/>

                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="px-5 py-12 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-14 h-14 rounded-full
                                                bg-slate-100 flex items-center
                                                justify-center mb-3">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-7 h-7 text-slate-400"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M9 12h6m-6 4h6m2 5H7
                                                     a2 2 0 01-2-2V5
                                                     a2 2 0 012-2h5.586
                                                     a1 1 0 01.707.293l5.414 5.414
                                                     A1 1 0 0119 9.414V19
                                                     a2 2 0 01-2 2z"/>

                                        </svg>

                                    </div>

                                    <h3 class="text-sm font-semibold text-slate-700">

                                        No exam subjects found

                                    </h3>

                                    <p class="text-xs text-slate-500 mt-1">

                                        Assign a subject to an examination to get started.

                                    </p>

                                    <a href="{{ route('admin.exam-subjects.create') }}"
                                       class="mt-4 inline-flex items-center gap-2
                                              px-4 py-2 bg-blue-600
                                              hover:bg-blue-700 text-white
                                              rounded-lg text-sm font-semibold">

                                        Assign Subject

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($examSubjects->hasPages())

            <div class="px-5 py-4 border-t border-slate-200">

                {{ $examSubjects->links() }}

            </div>

        @endif

    </div>


    {{-- =========================================================
        MOBILE CARDS
    ========================================================== --}}
    <div class="md:hidden space-y-4">

        @forelse($examSubjects as $index => $examSubject)

            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm overflow-hidden">

                {{-- Card Header --}}
                <div class="px-4 py-4 bg-slate-50
                            border-b border-slate-200">

                    <div class="flex items-start justify-between gap-3">

                        <div class="min-w-0">

                            <h3 class="font-semibold text-slate-800 truncate">

                                {{ $examSubject->subject?->name ?? 'N/A' }}

                            </h3>

                            <p class="text-xs text-slate-500 mt-1">

                                {{ $examSubject->exam?->name ?? 'N/A' }}

                            </p>

                        </div>


                        @if($examSubject->status)

                            <span class="shrink-0 inline-flex items-center
                                         px-2.5 py-1 rounded-full
                                         text-xs font-semibold
                                         bg-green-100 text-green-700">

                                Active

                            </span>

                        @else

                            <span class="shrink-0 inline-flex items-center
                                         px-2.5 py-1 rounded-full
                                         text-xs font-semibold
                                         bg-red-100 text-red-700">

                                Inactive

                            </span>

                        @endif

                    </div>

                </div>


                {{-- Card Body --}}
                <div class="p-4 space-y-3">

                    <div class="grid grid-cols-2 gap-3">

                        <div class="rounded-lg bg-slate-50 p-3">

                            <div class="text-xs text-slate-500">
                                Academic Session
                            </div>

                            <div class="text-sm font-semibold text-slate-800 mt-1">

                                {{ $examSubject->academicSession?->name ?? 'N/A' }}

                            </div>

                        </div>


                        <div class="rounded-lg bg-slate-50 p-3">

                            <div class="text-xs text-slate-500">
                                Class
                            </div>

                            <div class="text-sm font-semibold text-slate-800 mt-1">

                                {{ $examSubject->schoolClass?->name ?? 'N/A' }}

                            </div>

                        </div>

                    </div>


                    <div class="flex items-center justify-between
                                py-2 border-b border-slate-100">

                        <span class="text-sm text-slate-500">
                            Section
                        </span>

                        <span class="text-sm font-medium text-slate-800">

                            {{ $examSubject->section?->name ?? 'All Sections' }}

                        </span>

                    </div>


                    <div class="flex items-center justify-between
                                py-2 border-b border-slate-100">

                        <span class="text-sm text-slate-500">
                            Full Marks
                        </span>

                        <span class="text-sm font-semibold text-slate-800">

                            {{ number_format($examSubject->full_marks, 0) }}

                        </span>

                    </div>


                    <div class="flex items-center justify-between
                                py-2">

                        <span class="text-sm text-slate-500">
                            Pass Marks
                        </span>

                        <span class="text-sm font-semibold text-slate-800">

                            {{ $examSubject->pass_marks !== null
                                ? number_format($examSubject->pass_marks, 0)
                                : '-' }}

                        </span>

                    </div>

                </div>


                {{-- Card Actions --}}
                <div class="px-4 py-3 bg-slate-50
                            border-t border-slate-200">

                    <div class="grid grid-cols-3 gap-2">

                        <a href="{{ route(
                                'admin.exam-subjects.show',
                                $examSubject
                            ) }}"
                           class="inline-flex items-center justify-center
                                  gap-1.5 px-3 py-2 rounded-lg
                                  bg-blue-50 text-blue-600
                                  hover:bg-blue-100 text-xs
                                  font-semibold transition">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0
                                         3 3 0 016 0z"/>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5
                                         12 5c4.478 0 8.268 2.943
                                         9.542 7-1.274 4.057-5.064 7
                                         -9.542 7-4.477 0-8.268-2.943
                                         -9.542-7z"/>

                            </svg>

                            View

                        </a>


                        <a href="{{ route(
                                'admin.exam-subjects.edit',
                                $examSubject
                            ) }}"
                           class="inline-flex items-center justify-center
                                  gap-1.5 px-3 py-2 rounded-lg
                                  bg-amber-50 text-amber-600
                                  hover:bg-amber-100 text-xs
                                  font-semibold transition">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11
                                         a2 2 0 002 2h11a2 2 0 002-2v-5"/>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M18.5 2.5a2.121 2.121 0 013 3L12 15
                                         l-4 1 1-4 9.5-9.5z"/>

                            </svg>

                            Edit

                        </a>


                        <form method="POST"
                              action="{{ route(
                                  'admin.exam-subjects.destroy',
                                  $examSubject
                              ) }}"
                              onsubmit="return confirm(
                                  'Are you sure you want to delete this exam subject?'
                              )">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="w-full inline-flex items-center
                                           justify-center gap-1.5 px-3 py-2
                                           rounded-lg bg-red-50 text-red-600
                                           hover:bg-red-100 text-xs
                                           font-semibold transition">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-4 h-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M19 7l-.867 12.142
                                             A2 2 0 0116.138 21H7.862
                                             a2 2 0 01-1.995-1.858L5 7
                                             m5 4v6m4-6v6m1-10V4
                                             a1 1 0 00-1-1h-4
                                             a1 1 0 00-1 1v3
                                             M4 7h16"/>

                                </svg>

                                Delete

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm p-8 text-center">

                <div class="w-14 h-14 mx-auto rounded-full
                            bg-slate-100 flex items-center
                            justify-center mb-3">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-7 h-7 text-slate-400"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7
                                 a2 2 0 01-2-2V5
                                 a2 2 0 012-2h5.586
                                 a1 1 0 01.707.293l5.414 5.414
                                 A1 1 0 0119 9.414V19
                                 a2 2 0 01-2 2z"/>

                    </svg>

                </div>

                <h3 class="text-sm font-semibold text-slate-700">
                    No exam subjects found
                </h3>

                <p class="text-xs text-slate-500 mt-1">
                    Start by assigning a subject to an exam.
                </p>

                <a href="{{ route('admin.exam-subjects.create') }}"
                   class="mt-4 inline-flex items-center
                          justify-center px-4 py-2
                          bg-blue-600 hover:bg-blue-700
                          text-white rounded-lg
                          text-sm font-semibold">

                    Assign Subject

                </a>

            </div>

        @endforelse


        {{-- Mobile Pagination --}}
        @if($examSubjects->hasPages())

            <div class="pt-2">

                {{ $examSubjects->links() }}

            </div>

        @endif

    </div>

</div>

@endsection