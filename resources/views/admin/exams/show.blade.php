@extends('admin.layouts.app')

@section('title', 'View Exam')

@section('page-title', 'View Exam')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- ========= HEADER ========================== --}}
    <div class="mb-6">

        <div class="flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-4">

            <div>

                <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">

                    <a href="{{ route('admin.exams.index') }}"
                       class="hover:text-blue-600 transition">
                        Exams
                    </a>

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5l7 7-7 7"/>

                    </svg>

                    <span class="text-slate-600">
                        View Exam
                    </span>

                </div>

                <h1 class="text-2xl font-bold text-slate-800">
                    {{ $exam->name }}
                </h1>

                @if($exam->code)

                    <p class="mt-1 text-sm text-slate-500">
                        Exam Code:
                        <span class="font-medium text-slate-700">
                            {{ $exam->code }}
                        </span>
                    </p>

                @endif

            </div>


            {{-- Header Actions --}}
            <div class="flex flex-wrap items-center gap-2">

                <a href="{{ route('admin.exams.index') }}"
                   class="inline-flex items-center justify-center gap-2
                          px-4 py-2.5 rounded-lg
                          border border-slate-300
                          bg-white hover:bg-slate-50
                          text-slate-700 text-sm font-semibold
                          transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
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


                <a href="{{ route('admin.exams.edit', $exam) }}"
                   class="inline-flex items-center justify-center gap-2
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
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>

                    </svg>

                    Edit Exam

                </a>

            </div>

        </div>

    </div>


    {{-- =========================================================
        MAIN GRID
    ========================================================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


        {{-- =====================================================
            EXAM INFORMATION
        ====================================================== --}}
        <div class="lg:col-span-2">

            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm overflow-hidden">


                {{-- Card Header --}}
                <div class="px-5 py-4 border-b border-slate-200
                            bg-slate-50">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-lg
                                    bg-blue-50
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
                                         3.332.477 4.5 1.253v13C19.832
                                         18.477 18.246 18 16.5 18
                                         c-1.746 0-3.332.477-4.5
                                         1.253"/>

                            </svg>

                        </div>

                        <div>

                            <h2 class="text-base font-semibold
                                       text-slate-800">
                                Exam Information
                            </h2>

                            <p class="text-xs text-slate-500 mt-0.5">
                                Details of this examination.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Information --}}
                <div class="p-5">


                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6">


                        {{-- Exam Name --}}
                        <div>

                            <p class="text-xs font-medium
                                      uppercase tracking-wide
                                      text-slate-400">

                                Exam Name

                            </p>

                            <p class="mt-1 text-sm font-semibold
                                      text-slate-800">

                                {{ $exam->name }}

                            </p>

                        </div>


                        {{-- Exam Code --}}
                        <div>

                            <p class="text-xs font-medium
                                      uppercase tracking-wide
                                      text-slate-400">

                                Exam Code

                            </p>

                            <p class="mt-1 text-sm font-semibold
                                      text-slate-800">

                                {{ $exam->code ?: '-' }}

                            </p>

                        </div>


                        {{-- Academic Session --}}
                        <div>

                            <p class="text-xs font-medium
                                      uppercase tracking-wide
                                      text-slate-400">

                                Academic Session

                            </p>

                            <p class="mt-1 text-sm font-semibold
                                      text-slate-800">

                                {{ $exam->academicSession->name
                                    ?? $exam->academicSession->title
                                    ?? '-' }}

                            </p>

                        </div>


                        {{-- Start Date --}}
                        <div>

                            <p class="text-xs font-medium
                                      uppercase tracking-wide
                                      text-slate-400">

                                Start Date

                            </p>

                            <p class="mt-1 text-sm font-semibold
                                      text-slate-800">

                                @if($exam->start_date)

                                    {{ $exam->start_date->format('d M Y') }}

                                @else

                                    -

                                @endif

                            </p>

                        </div>


                        {{-- End Date --}}
                        <div>

                            <p class="text-xs font-medium
                                      uppercase tracking-wide
                                      text-slate-400">

                                End Date

                            </p>

                            <p class="mt-1 text-sm font-semibold
                                      text-slate-800">

                                @if($exam->end_date)

                                    {{ $exam->end_date->format('d M Y') }}

                                @else

                                    -

                                @endif

                            </p>

                        </div>


                        {{-- Status --}}
                        <div>

                            <p class="text-xs font-medium
                                      uppercase tracking-wide
                                      text-slate-400">

                                Status

                            </p>

                            <div class="mt-1">

                                @if($exam->status)

                                    <span class="inline-flex items-center gap-1.5
                                                 px-2.5 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-green-50 text-green-700
                                                 border border-green-200">

                                        <span class="w-1.5 h-1.5
                                                     rounded-full
                                                     bg-green-500"></span>

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5
                                                 px-2.5 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-red-50 text-red-700
                                                 border border-red-200">

                                        <span class="w-1.5 h-1.5
                                                     rounded-full
                                                     bg-red-500"></span>

                                        Inactive

                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- Created --}}
                        <div>

                            <p class="text-xs font-medium
                                      uppercase tracking-wide
                                      text-slate-400">

                                Created At

                            </p>

                            <p class="mt-1 text-sm font-semibold
                                      text-slate-800">

                                {{ optional($exam->created_at)->format('d M Y, h:i A') }}

                            </p>

                        </div>


                        {{-- Updated --}}
                        <div>

                            <p class="text-xs font-medium
                                      uppercase tracking-wide
                                      text-slate-400">

                                Last Updated

                            </p>

                            <p class="mt-1 text-sm font-semibold
                                      text-slate-800">

                                {{ optional($exam->updated_at)->format('d M Y, h:i A') }}

                            </p>

                        </div>

                    </div>


                    {{-- Description --}}
                    @if($exam->description)

                        <div class="mt-8 pt-6
                                    border-t border-slate-200">

                            <p class="text-xs font-medium
                                      uppercase tracking-wide
                                      text-slate-400">

                                Description

                            </p>

                            <div class="mt-2 text-sm leading-6
                                        text-slate-600 whitespace-pre-line">

                                {{ $exam->description }}

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
            RIGHT SIDEBAR
        ====================================================== --}}
        <div class="lg:col-span-1">


            {{-- Quick Actions --}}
            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm overflow-hidden">


                <div class="px-5 py-4 border-b border-slate-200
                            bg-slate-50">

                    <h2 class="text-base font-semibold text-slate-800">
                        Quick Actions
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Manage this examination.
                    </p>

                </div>


                <div class="p-4 space-y-2">


                    {{-- Schedule --}}
                    <a href="#"
                       class="flex items-center gap-3 p-3 rounded-lg
                              bg-blue-50 hover:bg-blue-100
                              text-blue-700 transition">

                        <div class="w-9 h-9 rounded-lg bg-white
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5 text-blue-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                            </svg>

                        </div>

                        <div>

                            <p class="text-sm font-semibold">
                                Exam Schedule
                            </p>

                            <p class="text-xs text-blue-600">
                                Manage exam routine
                            </p>

                        </div>

                    </a>


                    {{-- Subjects --}}
                    <a href="#"
                       class="flex items-center gap-3 p-3 rounded-lg
                              bg-slate-50 hover:bg-slate-100
                              text-slate-700 transition">

                        <div class="w-9 h-9 rounded-lg bg-white
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5 text-slate-600"
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
                                         3.332.477 4.5 1.253v13C19.832
                                         18.477 18.246 18 16.5 18
                                         c-1.746 0-3.332.477-4.5
                                         1.253"/>

                            </svg>

                        </div>

                        <div>

                            <p class="text-sm font-semibold">
                                Exam Subjects
                            </p>

                            <p class="text-xs text-slate-500">
                                Manage subjects
                            </p>

                        </div>

                    </a>


                    {{-- Marks --}}
                    <a href="#"
                       class="flex items-center gap-3 p-3 rounded-lg
                              bg-slate-50 hover:bg-slate-100
                              text-slate-700 transition">

                        <div class="w-9 h-9 rounded-lg bg-white
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5 text-slate-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z"/>

                            </svg>

                        </div>

                        <div>

                            <p class="text-sm font-semibold">
                                Exam Marks
                            </p>

                            <p class="text-xs text-slate-500">
                                Enter student marks
                            </p>

                        </div>

                    </a>


                    {{-- Result --}}
                    <a href="#"
                       class="flex items-center gap-3 p-3 rounded-lg
                              bg-slate-50 hover:bg-slate-100
                              text-slate-700 transition">

                        <div class="w-9 h-9 rounded-lg bg-white
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5 text-slate-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z"/>

                            </svg>

                        </div>

                        <div>

                            <p class="text-sm font-semibold">
                                Result
                            </p>

                            <p class="text-xs text-slate-500">
                                View examination results
                            </p>

                        </div>

                    </a>

                </div>

            </div>


            {{-- Danger Zone --}}
            <div class="mt-6 bg-white border border-red-200
                        rounded-xl shadow-sm overflow-hidden">

                <div class="px-5 py-4 border-b border-red-100
                            bg-red-50">

                    <h2 class="text-sm font-semibold text-red-700">
                        Danger Zone
                    </h2>

                </div>


                <div class="p-5">

                    <p class="text-xs text-slate-500 leading-5 mb-4">

                        Deleting this exam may also remove related
                        examination records depending on your database
                        relationships.

                    </p>


                    <form method="POST"
                          action="{{ route('admin.exams.destroy', $exam) }}"
                          onsubmit="return confirm('Are you sure you want to delete this exam? This action cannot be undone.');">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="w-full inline-flex items-center
                                       justify-center gap-2
                                       px-4 py-2.5 rounded-lg
                                       bg-red-600 hover:bg-red-700
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
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v-3a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"/>

                            </svg>

                            Delete Exam

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection 
