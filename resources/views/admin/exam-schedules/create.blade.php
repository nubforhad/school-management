@extends('admin.layouts.app')

@section('title', 'Add Exam Schedule')

@section('page-title', 'Add Exam Schedule')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="mb-6">

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

            <a href="{{ route('admin.exam-schedules.index') }}"
               class="hover:text-blue-600 transition">
                Exam Schedules
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
                Add Schedule
            </span>

        </div>

        <div class="flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-4">

            <div>

                <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                    Add Exam Schedule
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Create a new examination schedule for a class and subject.
                </p>

            </div>

            <a href="{{ route('admin.exam-schedules.index') }}"
               class="inline-flex items-center justify-center gap-2
                      px-4 py-2.5 rounded-lg
                      border border-slate-300
                      bg-white hover:bg-slate-50
                      text-slate-700 text-sm font-semibold
                      transition">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>

                Back to Schedules

            </a>

        </div>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="mb-6 rounded-xl border border-red-200
                    bg-red-50 p-4">

            <div class="flex items-start gap-3">

                <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 8v4m0 4h.01M10.29 3.86l-8.1 14A2 2 0 003.92 21h16.16a2 2 0 001.73-3.14l-8.1-14a2 2 0 00-3.42 0z"/>

                </svg>

                <div>

                    <h3 class="text-sm font-semibold text-red-700">
                        Please fix the following errors:
                    </h3>

                    <ul class="mt-2 text-sm text-red-600 list-disc pl-5 space-y-1">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        FORM
    ========================================================== --}}
    <form method="POST"
          action="{{ route('admin.exam-schedules.store') }}">

        @csrf


        {{-- =====================================================
            BASIC INFORMATION
        ====================================================== --}}
        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm overflow-hidden mb-6">

            <div class="px-5 py-4 bg-slate-50
                        border-b border-slate-200">

                <div class="flex items-center gap-3">

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

                    <div>

                        <h2 class="font-semibold text-slate-800">
                            Basic Information
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Select exam, session, class, section and subject.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    {{-- Exam --}}
                    <div>

                        <label for="exam_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Exam
                            <span class="text-red-500">*</span>

                        </label>

                        <select id="exam_id"
                                name="exam_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                Select Exam
                            </option>

                            @foreach($exams as $exam)

                                <option value="{{ $exam->id }}"
                                    {{ old('exam_id') == $exam->id ? 'selected' : '' }}>

                                    {{ $exam->name }}

                                    @if($exam->code)
                                        ({{ $exam->code }})
                                    @endif

                                </option>

                            @endforeach

                        </select>

                        @error('exam_id')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Academic Session --}}
                    <div>

                        <label for="academic_session_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Academic Session
                            <span class="text-red-500">*</span>

                        </label>

                        <select id="academic_session_id"
                                name="academic_session_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                Select Academic Session
                            </option>

                            @foreach($academicSessions as $session)

                                <option value="{{ $session->id }}"
                                    {{ old('academic_session_id') == $session->id ? 'selected' : '' }}>

                                    {{ $session->name
                                        ?? $session->title
                                        ?? $session->year
                                        ?? 'Session '.$session->id }}

                                </option>

                            @endforeach

                        </select>

                        @error('academic_session_id')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Class --}}
                    <div>

                        <label for="school_class_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Class
                            <span class="text-red-500">*</span>

                        </label>

                        <select id="school_class_id"
                                name="school_class_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                Select Class
                            </option>

                            @foreach($schoolClasses as $class)

                                <option value="{{ $class->id }}"
                                    {{ old('school_class_id') == $class->id ? 'selected' : '' }}>

                                    {{ $class->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('school_class_id')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Section --}}
                    <div>

                        <label for="section_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Section

                        </label>

                        <select id="section_id"
                                name="section_id"
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                All Sections / No Section
                            </option>

                            @foreach($sections as $section)

                                <option value="{{ $section->id }}"
                                    {{ old('section_id') == $section->id ? 'selected' : '' }}>

                                    {{ $section->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('section_id')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Subject --}}
                    <div class="md:col-span-2">

                        <label for="subject_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Subject
                            <span class="text-red-500">*</span>

                        </label>

                        <select id="subject_id"
                                name="subject_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                Select Subject
                            </option>

                            @foreach($subjects as $subject)

                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id') == $subject->id ? 'selected' : '' }}>

                                    {{ $subject->name }}

                                    @if(isset($subject->code) && $subject->code)
                                        ({{ $subject->code }})
                                    @endif

                                </option>

                            @endforeach

                        </select>

                        @error('subject_id')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            DATE & TIME
        ====================================================== --}}
        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm overflow-hidden mb-6">

            <div class="px-5 py-4 bg-slate-50
                        border-b border-slate-200">

                <div class="flex items-center gap-3">

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

                    <div>

                        <h2 class="font-semibold text-slate-800">
                            Date & Time
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Set examination date and duration.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">


                    {{-- Exam Date --}}
                    <div>

                        <label for="exam_date"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Exam Date
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="date"
                               id="exam_date"
                               name="exam_date"
                               value="{{ old('exam_date') }}"
                               required
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500
                                      focus:ring-blue-500 text-sm">

                        @error('exam_date')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Start Time --}}
                    <div>

                        <label for="start_time"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Start Time
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="time"
                               id="start_time"
                               name="start_time"
                               value="{{ old('start_time') }}"
                               required
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500
                                      focus:ring-blue-500 text-sm">

                        @error('start_time')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- End Time --}}
                    <div>

                        <label for="end_time"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            End Time
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="time"
                               id="end_time"
                               name="end_time"
                               value="{{ old('end_time') }}"
                               required
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500
                                      focus:ring-blue-500 text-sm">

                        @error('end_time')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            MARKS & ROOM
        ====================================================== --}}
        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm overflow-hidden mb-6">

            <div class="px-5 py-4 bg-slate-50
                        border-b border-slate-200">

                <div class="flex items-center gap-3">

                    <div class="w-9 h-9 rounded-lg bg-blue-50
                                flex items-center justify-center">

                        <svg class="w-5 h-5 text-blue-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 7h6m-6 4h6m-6 4h4M5 5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="font-semibold text-slate-800">
                            Marks & Room
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Set examination marks and room information.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">


                    {{-- Room --}}
                    <div>

                        <label for="room"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Room

                        </label>

                        <input type="text"
                               id="room"
                               name="room"
                               value="{{ old('room') }}"
                               placeholder="e.g. Room 101"
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500
                                      focus:ring-blue-500 text-sm">

                        @error('room')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Full Marks --}}
                    <div>

                        <label for="full_marks"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Full Marks
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="number"
                               id="full_marks"
                               name="full_marks"
                               value="{{ old('full_marks', 100) }}"
                               min="0"
                               step="0.01"
                               required
                               placeholder="100"
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500
                                      focus:ring-blue-500 text-sm">

                        @error('full_marks')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Pass Marks --}}
                    <div>

                        <label for="pass_marks"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Pass Marks

                        </label>

                        <input type="number"
                               id="pass_marks"
                               name="pass_marks"
                               value="{{ old('pass_marks') }}"
                               min="0"
                               step="0.01"
                               placeholder="e.g. 40"
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500
                                      focus:ring-blue-500 text-sm">

                        @error('pass_marks')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            INSTRUCTIONS & STATUS
        ====================================================== --}}
        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm overflow-hidden mb-6">

            <div class="px-5 py-4 bg-slate-50
                        border-b border-slate-200">

                <div class="flex items-center gap-3">

                    <div class="w-9 h-9 rounded-lg bg-blue-50
                                flex items-center justify-center">

                        <svg class="w-5 h-5 text-blue-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M8 10h8M8 14h5m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="font-semibold text-slate-800">
                            Additional Information
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Add instructions and set schedule status.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5">

                <div class="space-y-5">


                    {{-- Instructions --}}
                    <div>

                        <label for="instructions"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Instructions

                        </label>

                        <textarea id="instructions"
                                  name="instructions"
                                  rows="4"
                                  placeholder="Enter any instructions for this examination..."
                                  class="w-full rounded-lg border-slate-300
                                         focus:border-blue-500
                                         focus:ring-blue-500 text-sm">{{ old('instructions') }}</textarea>

                        @error('instructions')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div class="flex items-center justify-between
                                gap-4 rounded-lg border border-slate-200
                                bg-slate-50 px-4 py-4">

                        <div>

                            <h3 class="text-sm font-semibold text-slate-800">
                                Schedule Status
                            </h3>

                            <p class="text-xs text-slate-500 mt-1">
                                Active schedules will be visible in the schedule list.
                            </p>

                        </div>


                        <label class="relative inline-flex items-center
                                      cursor-pointer flex-shrink-0">

                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   class="sr-only peer"
                                   {{ old('status', true) ? 'checked' : '' }}>

                            <div class="w-11 h-6 bg-slate-300
                                        peer-focus:outline-none
                                        peer-focus:ring-4
                                        peer-focus:ring-blue-100
                                        rounded-full peer
                                        peer-checked:bg-blue-600
                                        after:content-['']
                                        after:absolute
                                        after:top-[2px]
                                        after:left-[2px]
                                        after:bg-white
                                        after:border-slate-300
                                        after:border
                                        after:rounded-full
                                        after:h-5
                                        after:w-5
                                        after:transition-all
                                        peer-checked:after:translate-x-full
                                        peer-checked:after:border-white">
                            </div>

                        </label>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            INFO BOX
        ====================================================== --}}
        <div class="mb-6 rounded-xl border border-blue-200
                    bg-blue-50 p-4">

            <div class="flex items-start gap-3">

                <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M12 22a10 10 0 110-20 10 10 0 010 20z"/>

                </svg>

                <div class="text-sm text-blue-700">

                    <p class="font-semibold mb-1">
                        Schedule Information
                    </p>

                    <p>
                        Make sure the selected exam, class, section and subject
                        are correct before saving the schedule.
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            FORM ACTIONS
        ====================================================== --}}
        <div class="flex flex-col-reverse sm:flex-row
                    sm:items-center sm:justify-end gap-3">

            <a href="{{ route('admin.exam-schedules.index') }}"
               class="inline-flex items-center justify-center
                      px-5 py-2.5 rounded-lg
                      border border-slate-300
                      bg-white hover:bg-slate-50
                      text-slate-700 text-sm font-semibold
                      transition">

                Cancel

            </a>


            <button type="submit"
                    class="inline-flex items-center justify-center gap-2
                           px-5 py-2.5 rounded-lg
                           bg-blue-600 hover:bg-blue-700
                           text-white text-sm font-semibold
                           shadow-sm transition">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7"/>

                </svg>

                Create Schedule

            </button>

        </div>

    </form>

</div>

@endsection