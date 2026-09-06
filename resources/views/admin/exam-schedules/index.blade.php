@extends('admin.layouts.app')

@section('title', 'Exam Schedules')

@section('page-title', 'Exam Schedules')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                    <a href="{{ route('admin.exams.index') }}"
                       class="hover:text-blue-600 transition">
                        Exams
                    </a>

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5l7 7-7 7"/>
                    </svg>

                    <span class="text-slate-700">
                        Exam Schedules
                    </span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                    Exam Schedules
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Manage examination dates, subjects, rooms and timings.
                </p>
            </div>

            <a href="{{ route('admin.exam-schedules.create') }}"
               class="inline-flex items-center justify-center gap-2
                      px-4 py-2.5 rounded-lg
                      bg-blue-600 hover:bg-blue-700
                      text-white text-sm font-semibold
                      shadow-sm transition">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 4v16m8-8H4"/>
                </svg>

                Add Schedule
            </a>

        </div>
    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))
        <div class="mb-5 flex items-start gap-3
                    rounded-lg border border-green-200
                    bg-green-50 px-4 py-3">

            <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5 13l4 4L19 7"/>
            </svg>

            <div class="text-sm text-green-700">
                {{ session('success') }}
            </div>
        </div>
    @endif


    {{-- =========================================================
        ERROR MESSAGE
    ========================================================== --}}
    @if(session('error'))
        <div class="mb-5 flex items-start gap-3
                    rounded-lg border border-red-200
                    bg-red-50 px-4 py-3">

            <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>

            <div class="text-sm text-red-700">
                {{ session('error') }}
            </div>
        </div>
    @endif


    {{-- =========================================================
        FILTER CARD
    ========================================================== --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm mb-6">

        <div class="px-4 sm:px-5 py-4 border-b border-slate-200 bg-slate-50 rounded-t-xl">

            <div class="flex items-center gap-2">

                <div class="w-8 h-8 rounded-lg bg-blue-50
                            flex items-center justify-center">

                    <svg class="w-4 h-4 text-blue-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 12.414V19a1 1 0 01-.553.894l-4 2A1 1 0 018 21v-8.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>

                </div>

                <h2 class="font-semibold text-slate-800">
                    Filter Schedules
                </h2>

            </div>
        </div>


        <form method="GET"
              action="{{ route('admin.exam-schedules.index') }}"
              class="p-4 sm:p-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

                {{-- Exam --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Exam
                    </label>

                    <select name="exam_id"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm">

                        <option value="">All Exams</option>

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
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Academic Session
                    </label>

                    <select name="academic_session_id"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm">

                        <option value="">All Sessions</option>

                        @foreach($academicSessions as $session)
                            <option value="{{ $session->id }}"
                                {{ request('academic_session_id') == $session->id ? 'selected' : '' }}>
                                {{ $session->name ?? $session->title ?? $session->year ?? 'Session '.$session->id }}
                            </option>
                        @endforeach

                    </select>
                </div>


                {{-- Class --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Class
                    </label>

                    <select name="school_class_id"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm">

                        <option value="">All Classes</option>

                        @foreach($schoolClasses as $class)
                            <option value="{{ $class->id }}"
                                {{ request('school_class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach

                    </select>
                </div>


                {{-- Exam Date --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Exam Date
                    </label>

                    <input type="date"
                           name="exam_date"
                           value="{{ request('exam_date') }}"
                           class="w-full rounded-lg border-slate-300
                                  focus:border-blue-500 focus:ring-blue-500
                                  text-sm">
                </div>


                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Status
                    </label>

                    <select name="status"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm">

                        <option value="">All Status</option>

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
            <div class="flex flex-wrap items-center gap-2 mt-4">

                <button type="submit"
                        class="inline-flex items-center gap-2
                               px-4 py-2 rounded-lg
                               bg-blue-600 hover:bg-blue-700
                               text-white text-sm font-medium
                               transition">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 12.414V19a1 1 0 01-.553.894l-4 2A1 1 0 018 21v-8.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>

                    Filter
                </button>


                <a href="{{ route('admin.exam-schedules.index') }}"
                   class="inline-flex items-center gap-2
                          px-4 py-2 rounded-lg
                          border border-slate-300
                          bg-white hover:bg-slate-50
                          text-slate-700 text-sm font-medium
                          transition">

                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- =========================================================
        DESKTOP TABLE
    ========================================================== --}}
    <div class="hidden lg:block bg-white border border-slate-200
                rounded-xl shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-slate-200 bg-slate-50">

            <div class="flex items-center justify-between">

                <div>
                    <h2 class="font-semibold text-slate-800">
                        Schedule List
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        {{ $schedules->total() }} schedule(s) found
                    </p>
                </div>

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-5 py-3 text-left font-semibold text-slate-600">
                            #
                        </th>

                        <th class="px-5 py-3 text-left font-semibold text-slate-600">
                            Exam
                        </th>

                        <th class="px-5 py-3 text-left font-semibold text-slate-600">
                            Class / Section
                        </th>

                        <th class="px-5 py-3 text-left font-semibold text-slate-600">
                            Subject
                        </th>

                        <th class="px-5 py-3 text-left font-semibold text-slate-600">
                            Date
                        </th>

                        <th class="px-5 py-3 text-left font-semibold text-slate-600">
                            Time
                        </th>

                        <th class="px-5 py-3 text-left font-semibold text-slate-600">
                            Room
                        </th>

                        <th class="px-5 py-3 text-center font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="px-5 py-3 text-right font-semibold text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($schedules as $index => $schedule)

                        <tr class="hover:bg-slate-50 transition">

                            {{-- Number --}}
                            <td class="px-5 py-4 text-slate-500">
                                {{ $schedules->firstItem() + $index }}
                            </td>


                            {{-- Exam --}}
                            <td class="px-5 py-4">

                                <div class="font-semibold text-slate-800">
                                    {{ $schedule->exam?->name ?? 'N/A' }}
                                </div>

                                @if($schedule->exam?->code)
                                    <div class="text-xs text-slate-500 mt-0.5">
                                        {{ $schedule->exam->code }}
                                    </div>
                                @endif

                            </td>


                            {{-- Class / Section --}}
                            <td class="px-5 py-4">

                                <div class="font-medium text-slate-700">
                                    {{ $schedule->schoolClass?->name ?? 'N/A' }}
                                </div>

                                @if($schedule->section)
                                    <div class="text-xs text-slate-500 mt-0.5">
                                        Section: {{ $schedule->section->name }}
                                    </div>
                                @endif

                            </td>


                            {{-- Subject --}}
                            <td class="px-5 py-4">

                                <div class="font-medium text-slate-700">
                                    {{ $schedule->subject?->name ?? 'N/A' }}
                                </div>

                            </td>


                            {{-- Date --}}
                            <td class="px-5 py-4">

                                <div class="font-medium text-slate-700">
                                    {{ $schedule->exam_date?->format('d M Y') }}
                                </div>

                            </td>


                            {{-- Time --}}
                            <td class="px-5 py-4">

                                <div class="text-slate-700 whitespace-nowrap">

                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}

                                    <span class="text-slate-400 mx-1">
                                        -
                                    </span>

                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}

                                </div>

                            </td>


                            {{-- Room --}}
                            <td class="px-5 py-4">

                                @if($schedule->room)
                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-md
                                                 bg-slate-100 text-slate-700
                                                 text-xs font-medium">

                                        {{ $schedule->room }}

                                    </span>
                                @else
                                    <span class="text-slate-400">
                                        —
                                    </span>
                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-5 py-4 text-center">

                                @if($schedule->status)

                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-full
                                                 bg-green-50 text-green-700
                                                 border border-green-200
                                                 text-xs font-semibold">

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-full
                                                 bg-red-50 text-red-700
                                                 border border-red-200
                                                 text-xs font-semibold">

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-end gap-1.5">

                                    {{-- View --}}
                                    <a href="{{ route('admin.exam-schedules.show', $schedule) }}"
                                       title="View"
                                       class="inline-flex items-center justify-center
                                              w-9 h-9 rounded-lg
                                              bg-blue-50 text-blue-600
                                              hover:bg-blue-100
                                              transition">

                                        <svg class="w-4 h-4"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>

                                    </a>


                                    {{-- Edit --}}
                                    <a href="{{ route('admin.exam-schedules.edit', $schedule) }}"
                                       title="Edit"
                                       class="inline-flex items-center justify-center
                                              w-9 h-9 rounded-lg
                                              bg-amber-50 text-amber-600
                                              hover:bg-amber-100
                                              transition">

                                        <svg class="w-4 h-4"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">
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
                                    <form action="{{ route('admin.exam-schedules.destroy', $schedule) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this exam schedule?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                title="Delete"
                                                class="inline-flex items-center justify-center
                                                       w-9 h-9 rounded-lg
                                                       bg-red-50 text-red-600
                                                       hover:bg-red-100
                                                       transition">

                                            <svg class="w-4 h-4"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9"
                                class="px-5 py-12 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-14 h-14 rounded-full
                                                bg-slate-100
                                                flex items-center justify-center mb-3">

                                        <svg class="w-7 h-7 text-slate-400"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>

                                    </div>

                                    <h3 class="text-sm font-semibold text-slate-700">
                                        No exam schedules found
                                    </h3>

                                    <p class="text-xs text-slate-500 mt-1">
                                        Create your first exam schedule.
                                    </p>

                                    <a href="{{ route('admin.exam-schedules.create') }}"
                                       class="mt-4 inline-flex items-center gap-2
                                              px-4 py-2 rounded-lg
                                              bg-blue-600 hover:bg-blue-700
                                              text-white text-sm font-medium">

                                        Add Schedule

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($schedules->hasPages())

            <div class="px-5 py-4 border-t border-slate-200">
                {{ $schedules->links() }}
            </div>

        @endif

    </div>


    {{-- =========================================================
        MOBILE / TABLET CARDS
    ========================================================== --}}
    <div class="lg:hidden space-y-4">

        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm px-4 py-4">

            <div class="flex items-center justify-between">

                <div>
                    <h2 class="font-semibold text-slate-800">
                        Schedule List
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        {{ $schedules->total() }} schedule(s) found
                    </p>
                </div>

                <div class="w-9 h-9 rounded-lg bg-blue-50
                            flex items-center justify-center">

                    <svg class="w-5 h-5 text-blue-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M8 7V3m8 4V3m-9 4h10m-9 4h10m-9 4h10m-9 4h10"/>
                    </svg>

                </div>

            </div>

        </div>


        @forelse($schedules as $index => $schedule)

            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm overflow-hidden">

                {{-- Card Header --}}
                <div class="px-4 py-4 bg-slate-50
                            border-b border-slate-200">

                    <div class="flex items-start justify-between gap-3">

                        <div class="min-w-0">

                            <div class="text-xs text-slate-500 mb-1">
                                Schedule #{{ $schedules->firstItem() + $index }}
                            </div>

                            <h3 class="font-bold text-slate-800 truncate">
                                {{ $schedule->exam?->name ?? 'N/A' }}
                            </h3>

                            @if($schedule->exam?->code)
                                <div class="text-xs text-slate-500 mt-1">
                                    {{ $schedule->exam->code }}
                                </div>
                            @endif

                        </div>


                        @if($schedule->status)

                            <span class="flex-shrink-0 inline-flex
                                         px-2.5 py-1 rounded-full
                                         bg-green-50 text-green-700
                                         border border-green-200
                                         text-xs font-semibold">

                                Active

                            </span>

                        @else

                            <span class="flex-shrink-0 inline-flex
                                         px-2.5 py-1 rounded-full
                                         bg-red-50 text-red-700
                                         border border-red-200
                                         text-xs font-semibold">

                                Inactive

                            </span>

                        @endif

                    </div>

                </div>


                {{-- Card Body --}}
                <div class="px-4 py-4 space-y-3">

                    {{-- Class --}}
                    <div class="flex items-start justify-between gap-4">

                        <span class="text-xs text-slate-500">
                            Class
                        </span>

                        <div class="text-right">

                            <div class="text-sm font-medium text-slate-700">
                                {{ $schedule->schoolClass?->name ?? 'N/A' }}
                            </div>

                            @if($schedule->section)
                                <div class="text-xs text-slate-500 mt-0.5">
                                    Section: {{ $schedule->section->name }}
                                </div>
                            @endif

                        </div>

                    </div>


                    {{-- Subject --}}
                    <div class="flex items-start justify-between gap-4">

                        <span class="text-xs text-slate-500">
                            Subject
                        </span>

                        <span class="text-sm font-medium text-slate-700 text-right">
                            {{ $schedule->subject?->name ?? 'N/A' }}
                        </span>

                    </div>


                    {{-- Date --}}
                    <div class="flex items-center justify-between gap-4">

                        <span class="text-xs text-slate-500">
                            Exam Date
                        </span>

                        <span class="text-sm font-medium text-slate-700">
                            {{ $schedule->exam_date?->format('d M Y') }}
                        </span>

                    </div>


                    {{-- Time --}}
                    <div class="flex items-center justify-between gap-4">

                        <span class="text-xs text-slate-500">
                            Time
                        </span>

                        <span class="text-sm font-medium text-slate-700 text-right">
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}
                            -
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}
                        </span>

                    </div>


                    {{-- Room --}}
                    <div class="flex items-center justify-between gap-4">

                        <span class="text-xs text-slate-500">
                            Room
                        </span>

                        <span class="text-sm font-medium text-slate-700">
                            {{ $schedule->room ?: '—' }}
                        </span>

                    </div>


                    {{-- Marks --}}
                    <div class="flex items-center justify-between gap-4">

                        <span class="text-xs text-slate-500">
                            Marks
                        </span>

                        <span class="text-sm font-medium text-slate-700">
                            {{ rtrim(rtrim(number_format((float) $schedule->full_marks, 2), '0'), '.') }}

                            @if($schedule->pass_marks !== null)
                                <span class="text-xs text-slate-400">
                                    / Pass
                                    {{ rtrim(rtrim(number_format((float) $schedule->pass_marks, 2), '0'), '.') }}
                                </span>
                            @endif
                        </span>

                    </div>

                </div>


                {{-- Card Actions --}}
                <div class="px-4 py-3 border-t border-slate-200
                            flex items-center justify-end gap-2">

                    <a href="{{ route('admin.exam-schedules.show', $schedule) }}"
                       class="inline-flex items-center gap-1.5
                              px-3 py-2 rounded-lg
                              bg-blue-50 text-blue-600
                              hover:bg-blue-100
                              text-xs font-semibold transition">

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>

                        View
                    </a>


                    <a href="{{ route('admin.exam-schedules.edit', $schedule) }}"
                       class="inline-flex items-center gap-1.5
                              px-3 py-2 rounded-lg
                              bg-amber-50 text-amber-600
                              hover:bg-amber-100
                              text-xs font-semibold transition">

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>

                        Edit
                    </a>


                    <form action="{{ route('admin.exam-schedules.destroy', $schedule) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this exam schedule?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="inline-flex items-center gap-1.5
                                       px-3 py-2 rounded-lg
                                       bg-red-50 text-red-600
                                       hover:bg-red-100
                                       text-xs font-semibold transition">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>

                            Delete
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm px-5 py-12 text-center">

                <div class="w-14 h-14 rounded-full bg-slate-100
                            flex items-center justify-center mx-auto mb-3">

                    <svg class="w-7 h-7 text-slate-400"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M8 7V3m8 4V3m-9 4h10m-9 4h10m-9 4h10m-9 4h10"/>
                    </svg>

                </div>

                <h3 class="text-sm font-semibold text-slate-700">
                    No exam schedules found
                </h3>

                <p class="text-xs text-slate-500 mt-1">
                    Create your first exam schedule.
                </p>

                <a href="{{ route('admin.exam-schedules.create') }}"
                   class="mt-4 inline-flex items-center gap-2
                          px-4 py-2 rounded-lg
                          bg-blue-600 hover:bg-blue-700
                          text-white text-sm font-medium">

                    Add Schedule

                </a>

            </div>

        @endforelse


        {{-- Mobile Pagination --}}
        @if($schedules->hasPages())

            <div class="bg-white border border-slate-200
                        rounded-xl shadow-sm px-4 py-4">

                {{ $schedules->links() }}

            </div>

        @endif

    </div>

</div>

@endsection