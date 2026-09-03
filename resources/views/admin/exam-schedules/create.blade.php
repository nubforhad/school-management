@extends('admin.layouts.app')

@section('title', 'Add Exam Schedule')

@section('page-title', 'Add Exam Schedule')

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
                        Examinations
                    </a>

                    <i class="bi bi-chevron-right text-xs"></i>

                    <a href="{{ route('admin.exams.schedules.index', $exam) }}"
                       class="hover:text-blue-600 transition">
                        Exam Schedule
                    </a>

                    <i class="bi bi-chevron-right text-xs"></i>

                    <span class="text-slate-700">
                        Add
                    </span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                    Add Exam Schedule
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Add subject-wise examination schedule.
                </p>
            </div>

            <div>
                <a href="{{ route('admin.exams.schedules.index', $exam) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5
                          bg-white border border-slate-200
                          text-slate-700 text-sm font-medium
                          rounded-lg hover:bg-slate-50 transition">

                    <i class="bi bi-arrow-left"></i>

                    Back to Schedule
                </a>
            </div>

        </div>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if ($errors->any())

        <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">

            <div class="flex items-start gap-3">

                <div class="w-8 h-8 rounded-lg bg-red-100
                            flex items-center justify-center
                            text-red-600 flex-shrink-0">

                    <i class="bi bi-exclamation-triangle"></i>

                </div>

                <div>
                    <h3 class="font-semibold text-red-800 text-sm">
                        Please fix the following errors:
                    </h3>

                    <ul class="mt-2 list-disc list-inside text-sm text-red-700 space-y-1">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>
                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        EXAMINATION INFORMATION
    ========================================================== --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm mb-6">

        <div class="px-5 py-4 border-b border-slate-200">

            <div class="flex items-center gap-3">

                <div class="w-9 h-9 rounded-lg bg-blue-50
                            flex items-center justify-center
                            text-blue-600">

                    <i class="bi bi-info-circle"></i>

                </div>

                <div>
                    <h2 class="font-semibold text-slate-800">
                        Examination Information
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Selected examination details
                    </p>
                </div>

            </div>

        </div>


        <div class="p-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

                {{-- Examination --}}
                <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">

                    <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1">
                        <i class="bi bi-journal-text"></i>
                        Examination
                    </div>

                    <div class="font-semibold text-slate-800">
                        {{ $exam->name ?? 'N/A' }}
                    </div>

                </div>


                {{-- Branch --}}
                <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">

                    <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1">
                        <i class="bi bi-building"></i>
                        Branch
                    </div>

                    <div class="font-semibold text-slate-800">
                        {{ $exam->branch?->name ?? 'N/A' }}
                    </div>

                </div>


                {{-- Academic Session --}}
                <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">

                    <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1">
                        <i class="bi bi-calendar3"></i>
                        Academic Session
                    </div>

                    <div class="font-semibold text-slate-800">
                        {{ $exam->academicSession?->name ?? 'N/A' }}
                    </div>

                </div>


                {{-- Class --}}
                <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">

                    <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1">
                        <i class="bi bi-mortarboard"></i>
                        Class
                    </div>

                    <div class="font-semibold text-slate-800">
                        {{ $exam->schoolClass?->name ?? 'N/A' }}
                    </div>

                </div>


                {{-- Section --}}
                <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">

                    <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1">
                        <i class="bi bi-people"></i>
                        Section
                    </div>

                    <div class="font-semibold text-slate-800">
                        {{ $exam->section?->name ?? 'N/A' }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        FORM
    ========================================================== --}}
    <form method="POST"
          action="{{ route('admin.exams.schedules.store', $exam) }}">

        @csrf


        <div class="bg-white border border-slate-200 rounded-xl shadow-sm">

            {{-- FORM HEADER --}}
            <div class="px-5 py-4 border-b border-slate-200">

                <div class="flex items-center gap-3">

                    <div class="w-9 h-9 rounded-lg bg-blue-50
                                flex items-center justify-center
                                text-blue-600">

                        <i class="bi bi-calendar-plus"></i>

                    </div>

                    <div>

                        <h2 class="font-semibold text-slate-800">
                            Schedule Details
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Enter subject and examination schedule information.
                        </p>

                    </div>

                </div>

            </div>


            {{-- FORM BODY --}}
            <div class="p-5 space-y-6">


                {{-- =================================================
                    SUBJECT
                ================================================== --}}
                <div>

                    <label for="subject_id"
                           class="block text-sm font-medium text-slate-700 mb-2">

                        Subject
                        <span class="text-red-500">*</span>

                    </label>

                    <select
                        name="subject_id"
                        id="subject_id"
                        required
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-700
                               focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 outline-none transition">

                        <option value="">
                            Select Subject
                        </option>

                        @forelse($subjects as $subject)

                            <option value="{{ $subject->id }}"
                                {{ old('subject_id') == $subject->id ? 'selected' : '' }}>

                                {{ $subject->name }}

                                @if($subject->code)
                                    — {{ $subject->code }}
                                @endif

                            </option>

                        @empty

                            <option value="" disabled>
                                No subjects found for this class
                            </option>

                        @endforelse

                    </select>

                    @if($subjects->isEmpty())

                        <p class="mt-2 text-xs text-red-600">
                            <i class="bi bi-exclamation-circle"></i>
                            No subjects are assigned to this class.
                        </p>

                    @else

                        <p class="mt-2 text-xs text-slate-500">
                            Select the subject for this examination schedule.
                        </p>

                    @endif

                    @error('subject_id')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- =================================================
                    DATE / TIME
                ================================================== --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    {{-- Exam Date --}}
                    <div>

                        <label for="exam_date"
                               class="block text-sm font-medium text-slate-700 mb-2">

                            Exam Date
                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="date"
                            name="exam_date"
                            id="exam_date"
                            value="{{ old('exam_date') }}"
                            required
                            class="w-full rounded-lg border border-slate-300
                                   px-3 py-2.5 text-sm text-slate-700
                                   focus:border-blue-500 focus:ring-2
                                   focus:ring-blue-100 outline-none transition">

                        @error('exam_date')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Start Time --}}
                    <div>

                        <label for="start_time"
                               class="block text-sm font-medium text-slate-700 mb-2">

                            Start Time

                        </label>

                        <input
                            type="time"
                            name="start_time"
                            id="start_time"
                            value="{{ old('start_time') }}"
                            class="w-full rounded-lg border border-slate-300
                                   px-3 py-2.5 text-sm text-slate-700
                                   focus:border-blue-500 focus:ring-2
                                   focus:ring-blue-100 outline-none transition">

                        @error('start_time')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- End Time --}}
                    <div>

                        <label for="end_time"
                               class="block text-sm font-medium text-slate-700 mb-2">

                            End Time

                        </label>

                        <input
                            type="time"
                            name="end_time"
                            id="end_time"
                            value="{{ old('end_time') }}"
                            class="w-full rounded-lg border border-slate-300
                                   px-3 py-2.5 text-sm text-slate-700
                                   focus:border-blue-500 focus:ring-2
                                   focus:ring-blue-100 outline-none transition">

                        @error('end_time')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- =================================================
                    ROOM
                ================================================== --}}
                <div>

                    <label for="room"
                           class="block text-sm font-medium text-slate-700 mb-2">

                        Room

                    </label>

                    <input
                        type="text"
                        name="room"
                        id="room"
                        value="{{ old('room') }}"
                        placeholder="e.g. Room 101"
                        class="w-full rounded-lg border border-slate-300
                               px-3 py-2.5 text-sm text-slate-700
                               focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 outline-none transition">

                    @error('room')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- =================================================
                    MARKS
                ================================================== --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Full Marks --}}
                    <div>

                        <label for="full_marks"
                               class="block text-sm font-medium text-slate-700 mb-2">

                            Full Marks
                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="number"
                            name="full_marks"
                            id="full_marks"
                            value="{{ old('full_marks', 100) }}"
                            min="0"
                            step="0.01"
                            required
                            class="w-full rounded-lg border border-slate-300
                                   px-3 py-2.5 text-sm text-slate-700
                                   focus:border-blue-500 focus:ring-2
                                   focus:ring-blue-100 outline-none transition">

                        @error('full_marks')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Pass Marks --}}
                    <div>

                        <label for="pass_marks"
                               class="block text-sm font-medium text-slate-700 mb-2">

                            Pass Marks
                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="number"
                            name="pass_marks"
                            id="pass_marks"
                            value="{{ old('pass_marks', 33) }}"
                            min="0"
                            step="0.01"
                            required
                            class="w-full rounded-lg border border-slate-300
                                   px-3 py-2.5 text-sm text-slate-700
                                   focus:border-blue-500 focus:ring-2
                                   focus:ring-blue-100 outline-none transition">

                        @error('pass_marks')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- =================================================
                    INSTRUCTIONS
                ================================================== --}}
                <div>

                    <label for="instructions"
                           class="block text-sm font-medium text-slate-700 mb-2">

                        Instructions

                    </label>

                    <textarea
                        name="instructions"
                        id="instructions"
                        rows="4"
                        placeholder="Enter any examination instructions..."
                        class="w-full rounded-lg border border-slate-300
                               px-3 py-2.5 text-sm text-slate-700
                               focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 outline-none transition">{{ old('instructions') }}</textarea>

                    @error('instructions')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- =================================================
                FORM FOOTER
            ================================================== --}}
            <div class="px-5 py-4 bg-slate-50 border-t border-slate-200
                        flex flex-col-reverse sm:flex-row
                        sm:justify-end gap-3">

                <a href="{{ route('admin.exams.schedules.index', $exam) }}"
                   class="inline-flex items-center justify-center gap-2
                          px-5 py-2.5 rounded-lg
                          bg-white border border-slate-300
                          text-slate-700 text-sm font-medium
                          hover:bg-slate-50 transition">

                    <i class="bi bi-x-lg"></i>

                    Cancel

                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2
                           px-5 py-2.5 rounded-lg
                           bg-blue-600 text-white text-sm font-medium
                           hover:bg-blue-700 transition
                           shadow-sm">

                    <i class="bi bi-check2-circle"></i>

                    Save Schedule

                </button>

            </div>

        </div>

    </form>

</div>

@endsection