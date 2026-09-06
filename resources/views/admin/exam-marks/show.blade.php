@extends('admin.layouts.app')

@section('title', 'View Exam Mark')

@section('page-title', 'View Exam Mark')

@section('content')

<div class="max-w-6xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="{{ route('admin.exam-marks.index') }}"
                   class="hover:text-blue-600">
                    Exam Marks
                </a>

                <span>/</span>

                <span>View</span>
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                Exam Mark Details
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                View student examination mark information.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">

            <a href="{{ route('admin.exam-marks.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5
                      bg-slate-100 hover:bg-slate-200
                      text-slate-700 text-sm font-medium
                      rounded-lg transition">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>

                Back
            </a>

            <a href="{{ route('admin.exam-marks.edit', $examMark) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5
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
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>

                Edit
            </a>

        </div>

    </div>


    {{-- =========================================================
        STATUS BANNER
    ========================================================== --}}
    @php
        $marks = $examMark->marks !== null
            ? (float) $examMark->marks
            : null;

        $fullMarks = (float) ($examMark->full_marks ?? 0);

        $passMarks = $examMark->pass_marks !== null
            ? (float) $examMark->pass_marks
            : null;

        $percentage = ($marks !== null && $fullMarks > 0)
            ? (($marks / $fullMarks) * 100)
            : null;

        $isPassed = false;

        if ($marks !== null) {
            if ($passMarks !== null) {
                $isPassed = $marks >= $passMarks;
            } elseif ($fullMarks > 0) {
                $isPassed = $percentage >= 33;
            }
        }
    @endphp


    <div class="mb-6">

        @if($examMark->status)

            <div class="flex items-center gap-3 p-4
                        bg-green-50 border border-green-200
                        rounded-xl">

                <div class="w-10 h-10 rounded-full
                            bg-green-100 flex items-center justify-center">

                    <svg class="w-5 h-5 text-green-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>

                </div>

                <div>
                    <p class="font-semibold text-green-800">
                        Mark Record Active
                    </p>

                    <p class="text-sm text-green-700">
                        This examination mark record is currently active.
                    </p>
                </div>

            </div>

        @else

            <div class="flex items-center gap-3 p-4
                        bg-red-50 border border-red-200
                        rounded-xl">

                <div class="w-10 h-10 rounded-full
                            bg-red-100 flex items-center justify-center">

                    <svg class="w-5 h-5 text-red-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>

                </div>

                <div>
                    <p class="font-semibold text-red-800">
                        Mark Record Inactive
                    </p>

                    <p class="text-sm text-red-700">
                        This examination mark record is currently inactive.
                    </p>
                </div>

            </div>

        @endif

    </div>


    {{-- =========================================================
        EXAMINATION INFORMATION
    ========================================================== --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm mb-6">

        <div class="px-5 py-4 border-b border-slate-200 bg-slate-50 rounded-t-xl">

            <h2 class="text-lg font-semibold text-slate-800">
                Examination Information
            </h2>

        </div>

        <div class="p-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                {{-- Exam --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Examination
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $examMark->exam?->name ?? 'N/A' }}
                    </p>

                    @if($examMark->exam?->code)
                        <p class="text-xs text-slate-500 mt-0.5">
                            Code: {{ $examMark->exam->code }}
                        </p>
                    @endif
                </div>


                {{-- Academic Session --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Academic Session
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $examMark->academicSession?->name ?? 'N/A' }}
                    </p>
                </div>


                {{-- Class --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Class
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $examMark->schoolClass?->name ?? 'N/A' }}
                    </p>
                </div>


                {{-- Section --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Section
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $examMark->section?->name ?? 'All Sections' }}
                    </p>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        STUDENT INFORMATION
    ========================================================== --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm mb-6">

        <div class="px-5 py-4 border-b border-slate-200 bg-slate-50 rounded-t-xl">

            <h2 class="text-lg font-semibold text-slate-800">
                Student Information
            </h2>

        </div>

        <div class="p-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                {{-- Student Name --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Student Name
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $examMark->student?->name
                            ?? $examMark->student?->student_name
                            ?? 'N/A' }}
                    </p>
                </div>


                {{-- Student ID --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Student ID
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $examMark->student?->student_id
                            ?? $examMark->student?->id
                            ?? 'N/A' }}
                    </p>
                </div>


                {{-- Roll --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Roll No
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $examMark->student?->roll_no ?? 'N/A' }}
                    </p>
                </div>


                {{-- Subject --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Subject
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $examMark->subject?->name ?? 'N/A' }}
                    </p>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        MARKS SUMMARY
    ========================================================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        {{-- Obtained Marks --}}
        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm p-6">

            <p class="text-sm font-medium text-slate-500">
                Obtained Marks
            </p>

            <div class="flex items-end gap-2 mt-3">

                <span class="text-4xl font-bold text-slate-800">
                    {{ $marks !== null ? number_format($marks, 2) : '-' }}
                </span>

                <span class="text-sm text-slate-500 mb-1">
                    / {{ number_format($fullMarks, 2) }}
                </span>

            </div>

            @if($percentage !== null)
                <p class="text-sm text-slate-500 mt-2">
                    {{ number_format($percentage, 2) }}%
                </p>
            @endif

        </div>


        {{-- Pass Marks --}}
        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm p-6">

            <p class="text-sm font-medium text-slate-500">
                Pass Marks
            </p>

            <div class="mt-3">

                <span class="text-4xl font-bold text-slate-800">
                    {{ $passMarks !== null
                        ? number_format($passMarks, 2)
                        : '-' }}
                </span>

            </div>

            <p class="text-sm text-slate-500 mt-2">
                Required minimum marks
            </p>

        </div>


        {{-- Result --}}
        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm p-6">

            <p class="text-sm font-medium text-slate-500">
                Result Status
            </p>

            <div class="mt-3">

                @if($marks === null)

                    <span class="inline-flex items-center px-3 py-1.5
                                 rounded-full text-sm font-semibold
                                 bg-slate-100 text-slate-700">
                        Not Published
                    </span>

                @elseif($isPassed)

                    <span class="inline-flex items-center px-3 py-1.5
                                 rounded-full text-sm font-semibold
                                 bg-green-100 text-green-700">

                        <svg class="w-4 h-4 mr-1.5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 13l4 4L19 7"/>
                        </svg>

                        Passed
                    </span>

                @else

                    <span class="inline-flex items-center px-3 py-1.5
                                 rounded-full text-sm font-semibold
                                 bg-red-100 text-red-700">

                        <svg class="w-4 h-4 mr-1.5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>

                        Failed
                    </span>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================================================
        GRADE INFORMATION
    ========================================================== --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm mb-6">

        <div class="px-5 py-4 border-b border-slate-200 bg-slate-50 rounded-t-xl">

            <h2 class="text-lg font-semibold text-slate-800">
                Grade Information
            </h2>

        </div>

        <div class="p-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                {{-- Percentage --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Percentage
                    </p>

                    <p class="mt-1 text-xl font-bold text-blue-600">
                        {{ $percentage !== null
                            ? number_format($percentage, 2) . '%'
                            : '-' }}
                    </p>
                </div>


                {{-- Grade --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Grade
                    </p>

                    <p class="mt-1 text-xl font-bold text-slate-800">
                        {{ $examMark->grade ?? '-' }}
                    </p>
                </div>


                {{-- Grade Point --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Grade Point
                    </p>

                    <p class="mt-1 text-xl font-bold text-slate-800">
                        {{ $examMark->grade_point !== null
                            ? number_format((float) $examMark->grade_point, 2)
                            : '-' }}
                    </p>
                </div>


                {{-- Status --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Record Status
                    </p>

                    <div class="mt-2">

                        @if($examMark->status)

                            <span class="inline-flex px-3 py-1
                                         rounded-full text-xs font-semibold
                                         bg-green-100 text-green-700">
                                Active
                            </span>

                        @else

                            <span class="inline-flex px-3 py-1
                                         rounded-full text-xs font-semibold
                                         bg-red-100 text-red-700">
                                Inactive
                            </span>

                        @endif

                    </div>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        REMARKS
    ========================================================== --}}
    @if($examMark->remarks)

        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm mb-6">

            <div class="px-5 py-4 border-b border-slate-200
                        bg-slate-50 rounded-t-xl">

                <h2 class="text-lg font-semibold text-slate-800">
                    Remarks
                </h2>

            </div>

            <div class="p-5">

                <div class="bg-slate-50 border border-slate-200
                            rounded-lg p-4">

                    <p class="text-sm text-slate-700 whitespace-pre-line">
                        {{ $examMark->remarks }}
                    </p>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        RECORD INFORMATION
    ========================================================== --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm mb-6">

        <div class="px-5 py-4 border-b border-slate-200 bg-slate-50 rounded-t-xl">

            <h2 class="text-lg font-semibold text-slate-800">
                Record Information
            </h2>

        </div>

        <div class="p-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Record ID
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        #{{ $examMark->id }}
                    </p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Created At
                    </p>
                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $examMark->created_at?->format('d M Y, h:i A') ?? 'N/A' }}
                    </p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Last Updated
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $examMark->updated_at?->format('d M Y, h:i A') ?? 'N/A' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- =========================================================
        ACTIONS
    ========================================================== --}}
    <div class="flex flex-col sm:flex-row
                sm:items-center sm:justify-between gap-3">

        <a href="{{ route('admin.exam-marks.index') }}"
           class="inline-flex justify-center items-center gap-2
                  px-5 py-2.5
                  bg-slate-100 hover:bg-slate-200
                  text-slate-700 text-sm font-medium
                  rounded-lg transition">

            Back to Marks List

        </a>
        <div class="flex flex-col sm:flex-row gap-2">

            <a href="{{ route('admin.exam-marks.edit', $examMark) }}"
               class="inline-flex justify-center items-center gap-2
                      px-5 py-2.5
                      bg-blue-600 hover:bg-blue-700
                      text-white text-sm font-medium
                      rounded-lg transition">
                Edit Mark
            </a>
            <form method="POST"
                  action="{{ route('admin.exam-marks.destroy', $examMark) }}"
                  onsubmit="return confirm('Are you sure you want to delete this mark record?');">

                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full inline-flex justify-center items-center gap-2
                               px-5 py-2.5
                               bg-red-600 hover:bg-red-700
                               text-white text-sm font-medium
                               rounded-lg transition">

                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

@endsection