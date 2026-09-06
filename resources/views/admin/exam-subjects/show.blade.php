@extends('admin.layouts.app')

@section('title', 'View Exam Subject')

@section('page-title', 'View Exam Subject')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="mb-6">

        <div class="flex flex-col lg:flex-row lg:items-center
                    lg:justify-between gap-4">

            <div>

                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-xl bg-blue-50
                                flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6 text-blue-600"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 6.253v13m0-13C10.832 5.477
                                     9.246 5 7.5 5S4.168 5.477 3 6.253v13
                                     C4.168 18.477 5.754 18 7.5 18
                                     s3.332.477 4.5 1.253m0-13
                                     C13.168 5.477 14.754 5 16.5 5
                                     c1.746 0 3.332.477 4.5 1.253v13
                                     C19.832 18.477 18.246 18 16.5 18
                                     c-1.746 0-3.332.477-4.5 1.253"/>

                        </svg>

                    </div>

                    <div>

                        <h1 class="text-2xl font-bold text-slate-800">
                            {{ $examSubject->subject?->name ?? 'Exam Subject' }}
                        </h1>

                        <p class="text-sm text-slate-500 mt-1">

                            {{ $examSubject->exam?->name ?? 'N/A' }}

                            <span class="mx-1">•</span>

                            {{ $examSubject->schoolClass?->name ?? 'N/A' }}

                            @if($examSubject->section)
                                <span class="mx-1">•</span>
                                {{ $examSubject->section->name }}
                            @endif

                        </p>

                    </div>

                </div>

            </div>


            {{-- Header Actions --}}
            <div class="flex flex-wrap gap-2">

                <a href="{{ route(
                        'admin.exam-subjects.edit',
                        $examSubject
                    ) }}"
                   class="inline-flex items-center justify-center gap-2
                          px-4 py-2.5 bg-amber-50 hover:bg-amber-100
                          text-amber-600 rounded-lg text-sm font-semibold
                          transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
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


                <a href="{{ route('admin.exam-subjects.index') }}"
                   class="inline-flex items-center justify-center gap-2
                          px-4 py-2.5 bg-slate-100 hover:bg-slate-200
                          text-slate-700 rounded-lg text-sm font-semibold
                          transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>

                    </svg>

                    Back

                </a>

            </div>

        </div>

    </div>


    {{-- =========================================================
        BREADCRUMB
    ========================================================== --}}
    <div class="mb-6">

        <nav class="flex items-center flex-wrap
                    text-sm text-slate-500 gap-2">

            <a href="{{ route('admin.exams.index') }}"
               class="hover:text-blue-600 transition">

                Exams

            </a>

            <span>/</span>

            <a href="{{ route('admin.exam-subjects.index') }}"
               class="hover:text-blue-600 transition">

                Exam Subjects

            </a>

            <span>/</span>

            <span class="text-slate-700 font-medium">
                View
            </span>

        </nav>

    </div>


    {{-- =========================================================
        STATUS BANNER
    ========================================================== --}}
    @if($examSubject->status)

        <div class="mb-6 rounded-xl border border-green-200
                    bg-green-50 px-4 py-4">

            <div class="flex items-center gap-3">

                <div class="w-9 h-9 rounded-full bg-green-100
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 text-green-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7"/>

                    </svg>

                </div>

                <div>

                    <h3 class="text-sm font-semibold text-green-800">
                        Active Exam Subject
                    </h3>

                    <p class="text-xs text-green-700 mt-0.5">
                        This subject is available for marks entry and result processing.
                    </p>

                </div>

            </div>

        </div>

    @else

        <div class="mb-6 rounded-xl border border-red-200
                    bg-red-50 px-4 py-4">

            <div class="flex items-center gap-3">

                <div class="w-9 h-9 rounded-full bg-red-100
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 text-red-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>

                    </svg>

                </div>

                <div>

                    <h3 class="text-sm font-semibold text-red-800">
                        Inactive Exam Subject
                    </h3>

                    <p class="text-xs text-red-700 mt-0.5">
                        This subject is currently inactive.
                    </p>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        MAIN INFORMATION
    ========================================================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


        {{-- =====================================================
            LEFT / MAIN DETAILS
        ====================================================== --}}
        <div class="lg:col-span-2 space-y-6">


            {{-- Examination Information --}}
            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm overflow-hidden">

                <div class="px-5 py-4 bg-slate-50
                            border-b border-slate-200">

                    <h2 class="font-semibold text-slate-800">
                        Examination Information
                    </h2>

                    <p class="text-xs text-slate-500 mt-1">
                        Examination and academic session details.
                    </p>

                </div>


                <div class="p-5">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        {{-- Exam --}}
                        <div>

                            <div class="text-xs font-medium
                                        text-slate-500 uppercase tracking-wide">
                                Exam
                            </div>

                            <div class="mt-1.5 text-sm font-semibold
                                        text-slate-800">

                                {{ $examSubject->exam?->name ?? 'N/A' }}

                            </div>

                        </div>


                        {{-- Exam Code --}}
                        <div>

                            <div class="text-xs font-medium
                                        text-slate-500 uppercase tracking-wide">
                                Exam Code
                            </div>

                            <div class="mt-1.5 text-sm font-semibold
                                        text-slate-800">

                                {{ $examSubject->exam?->code ?? '-' }}

                            </div>

                        </div>


                        {{-- Academic Session --}}
                        <div>

                            <div class="text-xs font-medium
                                        text-slate-500 uppercase tracking-wide">
                                Academic Session
                            </div>

                            <div class="mt-1.5 text-sm font-semibold
                                        text-slate-800">

                                {{ $examSubject->academicSession?->name ?? 'N/A' }}

                            </div>

                        </div>


                        {{-- Status --}}
                        <div>

                            <div class="text-xs font-medium
                                        text-slate-500 uppercase tracking-wide">
                                Status
                            </div>

                            <div class="mt-1.5">

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

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Class & Subject Information --}}
            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm overflow-hidden">

                <div class="px-5 py-4 bg-slate-50
                            border-b border-slate-200">

                    <h2 class="font-semibold text-slate-800">
                        Class & Subject Information
                    </h2>

                    <p class="text-xs text-slate-500 mt-1">
                        Class, section and subject assignment details.
                    </p>

                </div>


                <div class="p-5">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        {{-- Class --}}
                        <div>

                            <div class="text-xs font-medium
                                        text-slate-500 uppercase tracking-wide">
                                Class
                            </div>

                            <div class="mt-1.5 text-sm font-semibold
                                        text-slate-800">

                                {{ $examSubject->schoolClass?->name ?? 'N/A' }}

                            </div>

                        </div>


                        {{-- Section --}}
                        <div>

                            <div class="text-xs font-medium
                                        text-slate-500 uppercase tracking-wide">
                                Section
                            </div>

                            <div class="mt-1.5 text-sm font-semibold
                                        text-slate-800">

                                {{ $examSubject->section?->name ?? 'All Sections' }}

                            </div>

                        </div>


                        {{-- Subject --}}
                        <div class="sm:col-span-2">

                            <div class="text-xs font-medium
                                        text-slate-500 uppercase tracking-wide">
                                Subject
                            </div>

                            <div class="mt-2 flex items-center gap-3">

                                <div class="w-10 h-10 rounded-lg bg-blue-50
                                            flex items-center justify-center">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5 text-blue-600"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M12 6.253v13m0-13C10.832 5.477
                                                 9.246 5 7.5 5S4.168 5.477
                                                 3 6.253v13C4.168 18.477
                                                 5.754 18 7.5 18s3.332.477
                                                 4.5 1.253m0-13C13.168 5.477
                                                 14.754 5 16.5 5c1.746 0
                                                 3.332.477 4.5 1.253v13
                                                 C19.832 18.477 18.246 18
                                                 16.5 18c-1.746 0-3.332.477
                                                 -4.5 1.253"/>

                                    </svg>

                                </div>

                                <div>

                                    <div class="text-base font-semibold
                                                text-slate-800">

                                        {{ $examSubject->subject?->name ?? 'N/A' }}

                                    </div>

                                    @if($examSubject->subject?->code)

                                        <div class="text-xs text-slate-500 mt-0.5">

                                            Code:
                                            {{ $examSubject->subject->code }}

                                        </div>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Marks Information --}}
            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm overflow-hidden">

                <div class="px-5 py-4 bg-slate-50
                            border-b border-slate-200">

                    <h2 class="font-semibold text-slate-800">
                        Marks Information
                    </h2>

                    <p class="text-xs text-slate-500 mt-1">
                        Full marks and passing marks for this subject.
                    </p>

                </div>


                <div class="p-5">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- Full Marks --}}
                        <div class="rounded-xl border border-blue-100
                                    bg-blue-50 p-5">

                            <div class="text-sm text-blue-700">
                                Full Marks
                            </div>

                            <div class="mt-2 text-3xl font-bold text-blue-800">

                                {{ number_format($examSubject->full_marks, 0) }}

                            </div>

                        </div>


                        {{-- Pass Marks --}}
                        <div class="rounded-xl border border-green-100
                                    bg-green-50 p-5">

                            <div class="text-sm text-green-700">
                                Pass Marks
                            </div>

                            <div class="mt-2 text-3xl font-bold text-green-800">

                                @if($examSubject->pass_marks !== null)

                                    {{ number_format($examSubject->pass_marks, 0) }}

                                @else

                                    -

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Record Information --}}
            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm overflow-hidden">

                <div class="px-5 py-4 bg-slate-50
                            border-b border-slate-200">

                    <h2 class="font-semibold text-slate-800">
                        Record Information
                    </h2>

                </div>


                <div class="p-5">

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                        <div>

                            <div class="text-xs text-slate-500">
                                Assignment ID
                            </div>

                            <div class="mt-1 text-sm font-semibold
                                        text-slate-800">

                                #{{ $examSubject->id }}

                            </div>

                        </div>


                        <div>

                            <div class="text-xs text-slate-500">
                                Created At
                            </div>

                            <div class="mt-1 text-sm font-semibold
                                        text-slate-800">

                                {{ $examSubject->created_at?->format('d M Y, h:i A') }}

                            </div>

                        </div>


                        <div>

                            <div class="text-xs text-slate-500">
                                Updated At
                            </div>

                            <div class="mt-1 text-sm font-semibold
                                        text-slate-800">

                                {{ $examSubject->updated_at?->format('d M Y, h:i A') }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            RIGHT SIDEBAR
        ====================================================== --}}
        <div class="space-y-6">


            {{-- Assignment Summary --}}
            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm overflow-hidden">

                <div class="px-5 py-4 bg-slate-50
                            border-b border-slate-200">

                    <h2 class="font-semibold text-slate-800">
                        Assignment Summary
                    </h2>

                </div>


                <div class="p-5 space-y-4">

                    <div>

                        <div class="text-xs text-slate-500">
                            Examination
                        </div>

                        <div class="mt-1 text-sm font-semibold
                                    text-slate-800">

                            {{ $examSubject->exam?->name ?? 'N/A' }}

                        </div>

                    </div>


                    <div class="border-t border-slate-100 pt-4">

                        <div class="text-xs text-slate-500">
                            Class
                        </div>

                        <div class="mt-1 text-sm font-semibold
                                    text-slate-800">

                            {{ $examSubject->schoolClass?->name ?? 'N/A' }}

                        </div>

                    </div>


                    <div class="border-t border-slate-100 pt-4">

                        <div class="text-xs text-slate-500">
                            Section
                        </div>

                        <div class="mt-1 text-sm font-semibold
                                    text-slate-800">

                            {{ $examSubject->section?->name ?? 'All Sections' }}

                        </div>

                    </div>


                    <div class="border-t border-slate-100 pt-4">

                        <div class="text-xs text-slate-500">
                            Subject
                        </div>

                        <div class="mt-1 text-sm font-semibold
                                    text-slate-800">

                            {{ $examSubject->subject?->name ?? 'N/A' }}

                        </div>

                    </div>

                </div>

            </div>


            {{-- Quick Actions --}}
            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm overflow-hidden">

                <div class="px-5 py-4 bg-slate-50
                            border-b border-slate-200">

                    <h2 class="font-semibold text-slate-800">
                        Quick Actions
                    </h2>

                </div>


                <div class="p-4 space-y-2">

                    <a href="{{ route(
                            'admin.exam-subjects.edit',
                            $examSubject
                        ) }}"
                       class="flex items-center gap-3 w-full
                              px-4 py-3 rounded-lg
                              bg-amber-50 hover:bg-amber-100
                              text-amber-700 transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
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

                        <span class="text-sm font-semibold">
                            Edit Assignment
                        </span>

                    </a>


                    <a href="{{ route('admin.exam-subjects.create') }}"
                       class="flex items-center gap-3 w-full
                              px-4 py-3 rounded-lg
                              bg-blue-50 hover:bg-blue-100
                              text-blue-700 transition">

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

                        <span class="text-sm font-semibold">
                            Assign Another Subject
                        </span>

                    </a>


                    <a href="{{ route('admin.exam-subjects.index') }}"
                       class="flex items-center gap-3 w-full
                              px-4 py-3 rounded-lg
                              bg-slate-50 hover:bg-slate-100
                              text-slate-700 transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>

                        </svg>

                        <span class="text-sm font-semibold">
                            All Exam Subjects
                        </span>

                    </a>

                </div>

            </div>


            {{-- Danger Zone --}}
            <div class="bg-white border border-red-200
                        rounded-xl shadow-sm overflow-hidden">

                <div class="px-5 py-4 bg-red-50
                            border-b border-red-200">

                    <h2 class="font-semibold text-red-800">
                        Danger Zone
                    </h2>

                </div>


                <div class="p-5">

                    <p class="text-xs text-slate-500 leading-5 mb-4">

                        Deleting this assignment will permanently remove
                        it from the examination.

                    </p>


                    <form method="POST"
                          action="{{ route(
                              'admin.exam-subjects.destroy',
                              $examSubject
                          ) }}"
                          onsubmit="return confirm(
                              'Are you sure you want to permanently delete this exam subject?'
                          )">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="w-full inline-flex items-center
                                       justify-center gap-2 px-4 py-2.5
                                       rounded-lg bg-red-600
                                       hover:bg-red-700 text-white
                                       text-sm font-semibold transition">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
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

                            Delete Assignment

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection