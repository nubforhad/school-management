@extends('admin.layouts.app')

@section('title', 'Exams')

@section('page-title', 'Exam Management')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="mb-5 sm:mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">

            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Exam Management
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    Manage academic examinations for your school
                </p>
            </div>

            <div>
                <a href="{{ route('admin.exams.create') }}"
                   class="inline-flex items-center justify-center gap-2
                          rounded-lg bg-blue-600
                          px-4 py-2.5
                          text-sm font-semibold text-white
                          hover:bg-blue-700 transition">

                    <i class="bi bi-plus-lg"></i>

                    Create Exam
                </a>
            </div>

        </div>
    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="mb-5 rounded-lg border border-green-200
                    bg-green-50 px-4 py-3 text-sm text-green-700">

            <div class="flex items-center gap-2">

                <i class="bi bi-check-circle-fill"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        </div>

    @endif


    {{-- =========================================================
        ERROR MESSAGE
    ========================================================== --}}

    @if(session('error'))

        <div class="mb-5 rounded-lg border border-red-200
                    bg-red-50 px-4 py-3 text-sm text-red-700">

            <div class="flex items-center gap-2">

                <i class="bi bi-exclamation-circle-fill"></i>

                <span>
                    {{ session('error') }}
                </span>

            </div>

        </div>

    @endif


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="mb-5 rounded-lg border border-red-200
                    bg-red-50 px-4 py-3 text-sm text-red-700">

            <div class="font-semibold mb-1">
                Please fix the following errors:
            </div>

            <ul class="list-disc list-inside space-y-1">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        FILTER CARD
    ========================================================== --}}

    <div class="bg-white rounded-xl
                border border-slate-200
                shadow-sm mb-5">

        <div class="border-b border-slate-200
                    bg-slate-50
                    px-4 sm:px-5 py-4">

            <div class="flex items-center gap-2">

                <div class="flex h-9 w-9
                            items-center justify-center
                            rounded-lg
                            bg-blue-50
                            text-blue-600">

                    <i class="bi bi-funnel"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Search & Filter
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Find exams by name, session or class
                    </p>

                </div>

            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.exams.index') }}">

            <div class="p-4 sm:p-5">

                <div class="grid grid-cols-1
                            sm:grid-cols-2
                            lg:grid-cols-4
                            gap-4">

                    {{-- Search --}}

                    <div>

                        <label for="search"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Search

                        </label>

                        <div class="relative">

                            <i class="bi bi-search
                                      absolute left-3 top-1/2
                                      -translate-y-1/2
                                      text-slate-400"></i>

                            <input type="text"
                                   name="search"
                                   id="search"
                                   value="{{ request('search') }}"
                                   placeholder="Exam name or code..."
                                   class="w-full rounded-lg
                                          border border-slate-300
                                          bg-white
                                          pl-9 pr-3 py-2.5
                                          text-sm text-slate-800
                                          outline-none
                                          focus:border-blue-500
                                          focus:ring-2
                                          focus:ring-blue-100">

                        </div>

                    </div>


                    {{-- Academic Session --}}

                    <div>

                        <label for="academic_session_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Academic Session

                        </label>

                        <select name="academic_session_id"
                                id="academic_session_id"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm text-slate-800
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100">

                            <option value="">
                                All Sessions
                            </option>

                            @foreach($academicSessions as $session)

                                <option value="{{ $session->id }}"
                                    {{ request('academic_session_id') == $session->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $session->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Class --}}

                    <div>

                        <label for="school_class_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Class

                        </label>

                        <select name="school_class_id"
                                id="school_class_id"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm text-slate-800
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100">

                            <option value="">
                                All Classes
                            </option>

                            @foreach($classes as $class)

                                <option value="{{ $class->id }}"
                                    {{ request('school_class_id') == $class->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $class->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Buttons --}}

                    <div class="flex items-end gap-2">

                        <button type="submit"
                                class="inline-flex items-center
                                       justify-center gap-2
                                       rounded-lg
                                       bg-blue-600
                                       px-4 py-2.5
                                       text-sm font-semibold
                                       text-white
                                       hover:bg-blue-700
                                       transition">

                            <i class="bi bi-search"></i>

                            Search

                        </button>


                        <a href="{{ route('admin.exams.index') }}"
                           class="inline-flex items-center
                                  justify-center gap-2
                                  rounded-lg
                                  border border-slate-300
                                  bg-white
                                  px-4 py-2.5
                                  text-sm font-medium
                                  text-slate-700
                                  hover:bg-slate-50
                                  transition">

                            <i class="bi bi-arrow-counterclockwise"></i>

                            Reset

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>


    {{-- =========================================================
        EXAM TABLE
    ========================================================== --}}

    <div class="bg-white rounded-xl
                border border-slate-200
                shadow-sm overflow-hidden">


        {{-- Table Header --}}

        <div class="p-4 sm:p-5
                    border-b border-slate-200">

            <div class="flex flex-col sm:flex-row
                        sm:items-center
                        sm:justify-between gap-2">

                <div>

                    <h2 class="text-base sm:text-lg
                               font-semibold text-slate-800">

                        Exam List

                    </h2>

                    <p class="text-xs sm:text-sm
                              text-slate-500 mt-1">

                        All examinations

                    </p>

                </div>


                <div class="text-xs sm:text-sm text-slate-500">

                    Total:

                    <span class="font-semibold text-slate-700">

                        {{ $exams->total() }}

                    </span>

                </div>

            </div>

        </div>


        {{-- =====================================================
            TABLE
        ====================================================== --}}

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1050px]
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

                            Exam

                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">

                            Session

                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">

                            Class

                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">

                            Section

                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">

                            Date

                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">

                            Status

                        </th>

                        <th class="px-4 py-3 text-right
                                   font-semibold text-slate-600">

                            Actions

                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($exams as $exam)

                        <tr class="hover:bg-slate-50 transition">


                            {{-- Number --}}

                            <td class="px-4 py-3 text-slate-500">

                                {{ $exams->firstItem() + $loop->index }}

                            </td>


                            {{-- Exam --}}

                            <td class="px-4 py-3">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10
                                                shrink-0
                                                items-center justify-center
                                                rounded-lg
                                                bg-blue-50
                                                text-blue-600">

                                        <i class="bi bi-journal-text"></i>

                                    </div>

                                    <div>

                                        <p class="font-semibold
                                                  text-slate-800">

                                            {{ $exam->name }}

                                        </p>

                                        @if($exam->code)

                                            <p class="text-xs
                                                      text-slate-400">

                                                Code:
                                                {{ $exam->code }}

                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Session --}}

                            <td class="px-4 py-3">

                                <span class="font-medium
                                             text-slate-700">

                                    {{ $exam->academicSession->name ?? 'N/A' }}

                                </span>

                            </td>


                            {{-- Class --}}

                            <td class="px-4 py-3">

                                <span class="font-medium
                                             text-slate-700">

                                    {{ $exam->schoolClass->name ?? 'N/A' }}

                                </span>

                            </td>


                            {{-- Section --}}

                            <td class="px-4 py-3">

                                @if($exam->section)

                                    {{ $exam->section->name }}

                                @else

                                    <span class="text-slate-400">
                                        All Sections
                                    </span>

                                @endif

                            </td>


                            {{-- Date --}}

                            <td class="px-4 py-3">

                                @if($exam->start_date || $exam->end_date)

                                    <div class="text-slate-700">

                                        @if($exam->start_date)

                                            {{ $exam->start_date->format('d M Y') }}

                                        @endif

                                        @if($exam->end_date)

                                            <span class="text-slate-400">
                                                -
                                            </span>

                                            {{ $exam->end_date->format('d M Y') }}

                                        @endif

                                    </div>

                                @else

                                    <span class="text-slate-400">
                                        Not set
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}

                            <td class="px-4 py-3">

                                @php

                                    $statusClasses = [
                                        'draft' =>
                                            'bg-slate-50 text-slate-700 border-slate-200',

                                        'published' =>
                                            'bg-green-50 text-green-700 border-green-200',

                                        'completed' =>
                                            'bg-blue-50 text-blue-700 border-blue-200',
                                    ];

                                    $statusLabels = [
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'completed' => 'Completed',
                                    ];

                                @endphp


                                <span class="inline-flex
                                             items-center
                                             rounded-full
                                             border
                                             px-2.5 py-1
                                             text-xs font-medium
                                             {{ $statusClasses[$exam->status]
                                                ?? 'bg-slate-50 text-slate-700 border-slate-200' }}">

                                    {{ $statusLabels[$exam->status]
                                       ?? ucfirst($exam->status) }}

                                </span>

                            </td>


                            {{-- Actions --}}

                            <td class="px-4 py-3">

                                <div class="flex items-center
                                            justify-end gap-1.5">


                                    {{-- View --}}

                                    <a href="{{ route('admin.exams.show', $exam) }}"
                                       title="View"
                                       class="inline-flex h-9 w-9
                                              items-center justify-center
                                              rounded-lg
                                              border border-slate-200
                                              bg-white
                                              text-slate-600
                                              hover:bg-slate-50
                                              hover:text-blue-600
                                              transition">

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    {{-- Edit --}}

                                    <a href="{{ route('admin.exams.edit', $exam) }}"
                                       title="Edit"
                                       class="inline-flex h-9 w-9
                                              items-center justify-center
                                              rounded-lg
                                              border border-slate-200
                                              bg-white
                                              text-slate-600
                                              hover:bg-blue-50
                                              hover:text-blue-600
                                              transition">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    {{-- Delete --}}

                                    <form method="POST"
                                          action="{{ route('admin.exams.destroy', $exam) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this exam?');">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit"
                                                title="Delete"
                                                class="inline-flex h-9 w-9
                                                       items-center justify-center
                                                       rounded-lg
                                                       border border-red-200
                                                       bg-white
                                                       text-red-600
                                                       hover:bg-red-50
                                                       transition">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="px-4 py-14 text-center">

                                <div class="flex flex-col
                                            items-center">

                                    <div class="flex h-16 w-16
                                                items-center justify-center
                                                rounded-full
                                                bg-blue-50
                                                text-blue-600">

                                        <i class="bi bi-journal-x
                                                  text-3xl"></i>

                                    </div>


                                    <h3 class="mt-4
                                               text-sm sm:text-base
                                               font-semibold
                                               text-slate-700">

                                        No Exams Found

                                    </h3>


                                    <p class="mt-1
                                              text-xs sm:text-sm
                                              text-slate-500">

                                        No examinations match your
                                        current filters.

                                    </p>


                                    <a href="{{ route('admin.exams.create') }}"
                                       class="mt-4 inline-flex
                                              items-center gap-2
                                              rounded-lg
                                              bg-blue-600
                                              px-4 py-2
                                              text-sm font-semibold
                                              text-white
                                              hover:bg-blue-700
                                              transition">

                                        <i class="bi bi-plus-lg"></i>

                                        Create First Exam

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =====================================================
            PAGINATION
        ====================================================== --}}

        @if($exams->hasPages())

            <div class="border-t border-slate-200
                        px-4 sm:px-5 py-4">

                {{ $exams->links() }}

            </div>

        @endif

    </div>

</div>

@endsection