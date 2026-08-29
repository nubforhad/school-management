@extends('admin.layouts.app')

@section('title', 'Exam Schedule')

@section('page-title', 'Exam Schedule')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="mb-5 sm:mb-6">

        <div class="flex flex-col lg:flex-row
                    lg:items-center lg:justify-between gap-4">

            <div>
                <div class="flex items-center gap-2 mb-1">

                    <a href="{{ route('admin.exams.index') }}"
                       class="text-slate-400 hover:text-blue-600 transition">

                        <i class="bi bi-arrow-left"></i>

                    </a>

                    <span class="text-slate-300">/</span>

                    <span class="text-xs sm:text-sm text-slate-500">
                        Exam
                    </span>

                    <span class="text-slate-300">/</span>

                    <span class="text-xs sm:text-sm text-slate-600">
                        Schedule
                    </span>

                </div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Exam Schedule
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    Manage subjects, dates and timings for this examination
                </p>
            </div>


            {{-- Add Schedule --}}

            <div class="flex flex-col sm:flex-row gap-2">

                <a href="{{ route('admin.exams.index') }}"
                   class="inline-flex items-center justify-center gap-2
                          rounded-lg
                          border border-slate-300
                          bg-white
                          px-4 py-2.5
                          text-sm font-medium
                          text-slate-700
                          hover:bg-slate-50
                          transition">

                    <i class="bi bi-arrow-left"></i>

                    Back to Exams

                </a>


                <a href="{{ route('admin.exams.schedules.create', $exam) }}"
                   class="inline-flex items-center justify-center gap-2
                          rounded-lg
                          bg-blue-600
                          px-4 py-2.5
                          text-sm font-semibold
                          text-white
                          hover:bg-blue-700
                          transition">

                    <i class="bi bi-plus-lg"></i>

                    Add Schedule

                </a>

            </div>

        </div>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="mb-5 rounded-lg
                    border border-green-200
                    bg-green-50
                    px-4 py-3">

            <div class="flex items-start gap-3">

                <div class="flex h-8 w-8 shrink-0
                            items-center justify-center
                            rounded-full
                            bg-green-100
                            text-green-600">

                    <i class="bi bi-check-lg"></i>

                </div>

                <div>
                    <p class="text-sm font-semibold text-green-800">
                        Success
                    </p>

                    <p class="mt-0.5 text-sm text-green-700">
                        {{ session('success') }}
                    </p>
                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        EXAM INFORMATION
    ========================================================== --}}

    <div class="bg-white
                rounded-xl
                border border-slate-200
                shadow-sm
                mb-5">

        <div class="border-b border-slate-200
                    bg-slate-50
                    px-4 sm:px-5 py-4">

            <div class="flex items-center gap-2">

                <div class="flex h-9 w-9
                            items-center justify-center
                            rounded-lg
                            bg-blue-50
                            text-blue-600">

                    <i class="bi bi-file-earmark-text"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Examination Information
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Current examination details
                    </p>

                </div>

            </div>

        </div>


        <div class="p-4 sm:p-5">

            <div class="grid grid-cols-1
                        sm:grid-cols-2
                        lg:grid-cols-4 gap-4">


                {{-- Exam Name --}}

                <div class="rounded-lg
                            border border-slate-200
                            bg-slate-50
                            p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Examination
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $exam->name ?? 'N/A' }}
                    </p>

                </div>


                {{-- Branch --}}

                <div class="rounded-lg
                            border border-slate-200
                            bg-slate-50
                            p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Branch
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">

                        {{ $exam->branch->name ?? 'N/A' }}

                    </p>

                </div>


                {{-- Academic Session --}}

                <div class="rounded-lg
                            border border-slate-200
                            bg-slate-50
                            p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Academic Session
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">

                        {{ $exam->academicSession->name ?? 'N/A' }}

                    </p>

                </div>


                {{-- Total Subjects --}}

                <div class="rounded-lg
                            border border-slate-200
                            bg-slate-50
                            p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Total Subjects
                    </p>

                    <p class="mt-1 text-sm font-semibold text-blue-600">

                        {{ $schedules->count() }}

                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        SCHEDULE TABLE
    ========================================================== --}}

    <div class="bg-white
                rounded-xl
                border border-slate-200
                shadow-sm
                overflow-hidden">

        {{-- Table Header --}}

        <div class="p-4 sm:p-5
                    border-b border-slate-200">

            <div class="flex flex-col
                        sm:flex-row
                        sm:items-center
                        sm:justify-between gap-2">

                <div>

                    <h2 class="text-base sm:text-lg
                               font-semibold text-slate-800">

                        Examination Schedule

                    </h2>

                    <p class="text-xs sm:text-sm
                              text-slate-500 mt-1">

                        Subject-wise examination schedule

                    </p>

                </div>


                <div class="inline-flex items-center
                            gap-2
                            self-start
                            sm:self-auto
                            rounded-lg
                            bg-slate-50
                            border border-slate-200
                            px-3 py-2">

                    <i class="bi bi-calendar3 text-slate-500"></i>

                    <span class="text-xs sm:text-sm
                                 text-slate-600">

                        {{ $schedules->count() }} Subjects

                    </span>

                </div>

            </div>

        </div>


        {{-- =====================================================
            DESKTOP TABLE
        ====================================================== --}}

        <div class="hidden md:block overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50
                              border-b border-slate-200">

                    <tr>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            #
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Subject
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Exam Date
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Time
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Room
                        </th>

                        <th class="px-4 py-3 text-right
                                   font-semibold text-slate-600">
                            Marks
                        </th>

                        <th class="px-4 py-3 text-right
                                   font-semibold text-slate-600">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($schedules as $schedule)

                        <tr class="hover:bg-slate-50 transition">


                            {{-- Number --}}

                            <td class="px-4 py-4 text-slate-500">

                                {{ $loop->iteration }}

                            </td>


                            {{-- Subject --}}

                            <td class="px-4 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10
                                                shrink-0
                                                items-center justify-center
                                                rounded-lg
                                                bg-blue-50
                                                text-blue-600">

                                        <i class="bi bi-book"></i>

                                    </div>

                                    <div>

                                        <p class="font-semibold
                                                  text-slate-800">

                                            {{ $schedule->subject->name ?? 'N/A' }}

                                        </p>

                                        @if($schedule->subject?->code)

                                            <p class="text-xs text-slate-400 mt-0.5">

                                                Code:
                                                {{ $schedule->subject->code }}

                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Date --}}

                            <td class="px-4 py-4">

                                <div class="flex items-center gap-2">

                                    <i class="bi bi-calendar-event
                                              text-blue-500"></i>

                                    <span class="font-medium
                                                 text-slate-700">

                                        {{ $schedule->exam_date
                                            ? $schedule->exam_date->format('d M Y')
                                            : 'N/A'
                                        }}

                                    </span>

                                </div>

                            </td>


                            {{-- Time --}}

                            <td class="px-4 py-4">

                                @if($schedule->start_time || $schedule->end_time)

                                    <div class="flex items-center gap-2">

                                        <i class="bi bi-clock
                                                  text-slate-400"></i>

                                        <span class="text-slate-700">

                                            {{ $schedule->start_time
                                                ? \Carbon\Carbon::parse($schedule->start_time)->format('h:i A')
                                                : '--'
                                            }}

                                            -

                                            {{ $schedule->end_time
                                                ? \Carbon\Carbon::parse($schedule->end_time)->format('h:i A')
                                                : '--'
                                            }}

                                        </span>

                                    </div>

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Room --}}

                            <td class="px-4 py-4">

                                @if($schedule->room)

                                    <div class="flex items-center gap-2">

                                        <i class="bi bi-door-open
                                                  text-slate-400"></i>

                                        <span class="text-slate-700">

                                            {{ $schedule->room }}

                                        </span>

                                    </div>

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Marks --}}

                            <td class="px-4 py-4 text-right">

                                <div>

                                    <span class="font-semibold
                                                 text-slate-800">

                                        {{ number_format($schedule->full_marks, 2) }}

                                    </span>

                                    <span class="text-xs text-slate-400">

                                        / {{ number_format($schedule->pass_marks, 2) }}

                                    </span>

                                </div>

                                <p class="text-[11px] text-slate-400">
                                    Full / Pass
                                </p>

                            </td>


                            {{-- Actions --}}

                            <td class="px-4 py-4">

                                <div class="flex items-center
                                            justify-end gap-2">

                                    {{-- Edit --}}

                                    <a href="{{ route(
                                        'admin.exams.schedules.edit',
                                        [$exam, $schedule]
                                    ) }}"
                                       class="inline-flex
                                              h-9 w-9
                                              items-center justify-center
                                              rounded-lg
                                              border border-blue-200
                                              bg-blue-50
                                              text-blue-600
                                              hover:bg-blue-100
                                              transition"
                                       title="Edit">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>


                                    {{-- Delete --}}

                                    <form method="POST"
                                          action="{{ route(
                                              'admin.exams.schedules.destroy',
                                              [$exam, $schedule]
                                          ) }}"
                                          onsubmit="return confirm(
                                              'Are you sure you want to delete this schedule?'
                                          )">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit"
                                                class="inline-flex
                                                       h-9 w-9
                                                       items-center
                                                       justify-center
                                                       rounded-lg
                                                       border border-red-200
                                                       bg-red-50
                                                       text-red-600
                                                       hover:bg-red-100
                                                       transition"
                                                title="Delete">

                                            <i class="bi bi-trash3"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="px-4 py-16 text-center">

                                <div class="flex flex-col
                                            items-center">

                                    <div class="flex h-16 w-16
                                                items-center justify-center
                                                rounded-full
                                                bg-blue-50
                                                text-blue-600">

                                        <i class="bi bi-calendar-x
                                                  text-3xl"></i>

                                    </div>

                                    <h3 class="mt-4
                                               text-base
                                               font-semibold
                                               text-slate-700">

                                        No Exam Schedule Found

                                    </h3>

                                    <p class="mt-1
                                              text-sm
                                              text-slate-500">

                                        No subjects have been added
                                        to this examination yet.

                                    </p>

                                    <a href="{{ route(
                                        'admin.exams.schedules.create',
                                        $exam
                                    ) }}"
                                       class="mt-5
                                              inline-flex
                                              items-center
                                              gap-2
                                              rounded-lg
                                              bg-blue-600
                                              px-4 py-2.5
                                              text-sm font-semibold
                                              text-white
                                              hover:bg-blue-700
                                              transition">

                                        <i class="bi bi-plus-lg"></i>

                                        Add First Schedule

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>


                {{-- Footer --}}

                @if($schedules->count() > 0)

                    <tfoot>

                        <tr class="bg-slate-50
                                   border-t-2 border-slate-200">

                            <td colspan="5"
                                class="px-4 py-4 text-right
                                       font-semibold
                                       text-slate-700">

                                Total Subjects

                            </td>

                            <td colspan="2"
                                class="px-4 py-4">

                                <span class="font-bold
                                             text-blue-600">

                                    {{ $schedules->count() }}

                                </span>

                            </td>

                        </tr>

                    </tfoot>

                @endif

            </table>

        </div>


        {{-- =====================================================
            MOBILE CARDS
        ====================================================== --}}

        <div class="md:hidden divide-y divide-slate-100">

            @forelse($schedules as $schedule)

                <div class="p-4">

                    {{-- Top --}}

                    <div class="flex items-start
                                justify-between gap-3">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10
                                        shrink-0
                                        items-center justify-center
                                        rounded-lg
                                        bg-blue-50
                                        text-blue-600">

                                <i class="bi bi-book"></i>

                            </div>

                            <div>

                                <p class="font-semibold
                                          text-slate-800">

                                    {{ $schedule->subject->name ?? 'N/A' }}

                                </p>

                                @if($schedule->subject?->code)

                                    <p class="text-xs text-slate-400">

                                        {{ $schedule->subject->code }}

                                    </p>

                                @endif

                            </div>

                        </div>


                        <span class="text-xs
                                     font-medium
                                     text-slate-400">

                            #{{ $loop->iteration }}

                        </span>

                    </div>


                    {{-- Details --}}

                    <div class="mt-4 grid grid-cols-2 gap-3">


                        {{-- Date --}}

                        <div class="rounded-lg
                                    bg-slate-50
                                    border border-slate-200
                                    p-3">

                            <p class="text-[11px]
                                      font-medium
                                      uppercase
                                      tracking-wide
                                      text-slate-400">

                                Exam Date

                            </p>

                            <p class="mt-1 text-sm
                                      font-semibold
                                      text-slate-700">

                                {{ $schedule->exam_date
                                    ? $schedule->exam_date->format('d M Y')
                                    : 'N/A'
                                }}

                            </p>

                        </div>


                        {{-- Room --}}

                        <div class="rounded-lg
                                    bg-slate-50
                                    border border-slate-200
                                    p-3">

                            <p class="text-[11px]
                                      font-medium
                                      uppercase
                                      tracking-wide
                                      text-slate-400">

                                Room

                            </p>

                            <p class="mt-1 text-sm
                                      font-semibold
                                      text-slate-700">

                                {{ $schedule->room ?: '—' }}

                            </p>

                        </div>


                        {{-- Time --}}

                        <div class="rounded-lg
                                    bg-slate-50
                                    border border-slate-200
                                    p-3">

                            <p class="text-[11px]
                                      font-medium
                                      uppercase
                                      tracking-wide
                                      text-slate-400">

                                Time

                            </p>

                            <p class="mt-1 text-sm
                                      font-semibold
                                      text-slate-700">

                                @if($schedule->start_time)

                                    {{ \Carbon\Carbon::parse(
                                        $schedule->start_time
                                    )->format('h:i A') }}

                                @else

                                    —

                                @endif

                                @if($schedule->end_time)

                                    -
                                    {{ \Carbon\Carbon::parse(
                                        $schedule->end_time
                                    )->format('h:i A') }}

                                @endif

                            </p>

                        </div>


                        {{-- Marks --}}

                        <div class="rounded-lg
                                    bg-slate-50
                                    border border-slate-200
                                    p-3">

                            <p class="text-[11px]
                                      font-medium
                                      uppercase
                                      tracking-wide
                                      text-slate-400">

                                Marks

                            </p>

                            <p class="mt-1 text-sm
                                      font-semibold
                                      text-slate-700">

                                {{ number_format(
                                    $schedule->full_marks,
                                    2
                                ) }}

                                <span class="text-xs text-slate-400">

                                    / {{ number_format(
                                        $schedule->pass_marks,
                                        2
                                    ) }}

                                </span>

                            </p>

                        </div>

                    </div>


                    {{-- Instructions --}}

                    @if($schedule->instructions)

                        <div class="mt-3
                                    rounded-lg
                                    border border-blue-100
                                    bg-blue-50
                                    p-3">

                            <p class="text-xs
                                      font-semibold
                                      text-blue-700">

                                Instructions

                            </p>

                            <p class="mt-1 text-xs
                                      leading-5
                                      text-blue-600">

                                {{ $schedule->instructions }}

                            </p>

                        </div>

                    @endif


                    {{-- Actions --}}

                    <div class="flex items-center
                                gap-2 mt-4">


                        <a href="{{ route(
                            'admin.exams.schedules.edit',
                            [$exam, $schedule]
                        ) }}"
                           class="flex-1
                                  inline-flex
                                  items-center
                                  justify-center
                                  gap-2
                                  rounded-lg
                                  border border-blue-200
                                  bg-blue-50
                                  px-3 py-2.5
                                  text-sm
                                  font-medium
                                  text-blue-600
                                  hover:bg-blue-100
                                  transition">

                            <i class="bi bi-pencil-square"></i>

                            Edit

                        </a>


                        <form method="POST"
                              action="{{ route(
                                  'admin.exams.schedules.destroy',
                                  [$exam, $schedule]
                              ) }}"
                              class="flex-1"
                              onsubmit="return confirm(
                                  'Are you sure you want to delete this schedule?'
                              )">

                            @csrf

                            @method('DELETE')

                            <button type="submit"
                                    class="w-full
                                           inline-flex
                                           items-center
                                           justify-center
                                           gap-2
                                           rounded-lg
                                           border border-red-200
                                           bg-red-50
                                           px-3 py-2.5
                                           text-sm
                                           font-medium
                                           text-red-600
                                           hover:bg-red-100
                                           transition">

                                <i class="bi bi-trash3"></i>

                                Delete

                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="px-4 py-16 text-center">

                    <div class="flex flex-col
                                items-center">

                        <div class="flex h-16 w-16
                                    items-center justify-center
                                    rounded-full
                                    bg-blue-50
                                    text-blue-600">

                            <i class="bi bi-calendar-x
                                      text-3xl"></i>

                        </div>

                        <h3 class="mt-4
                                   text-base
                                   font-semibold
                                   text-slate-700">

                            No Exam Schedule Found

                        </h3>

                        <p class="mt-1
                                  text-sm
                                  text-slate-500">

                            No subjects have been added
                            to this examination yet.

                        </p>

                        <a href="{{ route(
                            'admin.exams.schedules.create',
                            $exam
                        ) }}"
                           class="mt-5
                                  inline-flex
                                  items-center
                                  gap-2
                                  rounded-lg
                                  bg-blue-600
                                  px-4 py-2.5
                                  text-sm font-semibold
                                  text-white
                                  hover:bg-blue-700
                                  transition">

                            <i class="bi bi-plus-lg"></i>

                            Add Schedule

                        </a>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection