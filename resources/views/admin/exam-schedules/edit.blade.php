@extends('admin.layouts.app')

@section('title', 'Edit Exam Schedule')

@section('page-title', 'Edit Exam Schedule')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="mb-6">

        <div class="flex flex-col sm:flex-row
                    sm:items-center
                    sm:justify-between gap-4">

            <div>

                <div class="flex items-center gap-2 mb-2">

                    <a href="{{ route(
                        'admin.exams.schedules.index',
                        $exam
                    ) }}"
                       class="text-slate-400 hover:text-blue-600 transition">

                        <i class="bi bi-arrow-left"></i>

                    </a>

                    <span class="text-xs text-slate-400">
                        Exam Schedule
                    </span>

                </div>

                <h1 class="text-xl sm:text-2xl
                           font-bold text-slate-800">

                    Edit Exam Schedule

                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">

                    Update examination subject, date, time and marks

                </p>

            </div>

        </div>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="mb-5 rounded-xl
                    border border-red-200
                    bg-red-50
                    p-4">

            <div class="flex items-start gap-3">

                <div class="flex h-8 w-8 shrink-0
                            items-center justify-center
                            rounded-full
                            bg-red-100
                            text-red-600">

                    <i class="bi bi-exclamation-triangle"></i>

                </div>

                <div>

                    <p class="text-sm font-semibold text-red-800">
                        Please fix the following errors
                    </p>

                    <ul class="mt-2 space-y-1
                               text-xs sm:text-sm
                               text-red-700">

                        @foreach($errors->all() as $error)

                            <li>
                                • {{ $error }}
                            </li>

                        @endforeach

                    </ul>

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
                shadow-sm mb-5">

        <div class="border-b border-slate-200
                    bg-slate-50
                    px-4 sm:px-5 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10
                            items-center justify-center
                            rounded-lg
                            bg-blue-50
                            text-blue-600">

                    <i class="bi bi-file-earmark-text"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Examination
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        This schedule belongs to the following examination
                    </p>

                </div>

            </div>

        </div>


        <div class="p-4 sm:p-5">

            <div class="grid grid-cols-1
                        sm:grid-cols-3 gap-4">

                {{-- Exam --}}

                <div class="rounded-lg
                            border border-blue-100
                            bg-blue-50
                            p-4">

                    <p class="text-xs font-medium text-blue-600">
                        Examination
                    </p>

                    <p class="mt-1 text-sm
                              font-semibold text-blue-900">

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

                    <p class="mt-1 text-sm
                              font-semibold text-slate-800">

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

                    <p class="mt-1 text-sm
                              font-semibold text-slate-800">

                        {{ $exam->academicSession->name ?? 'N/A' }}

                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        EDIT FORM
    ========================================================== --}}

    <form method="POST"
          action="{{ route(
              'admin.exams.schedules.update',
              [$exam, $schedule]
          ) }}">

        @csrf

        @method('PUT')


        <div class="bg-white
                    rounded-xl
                    border border-slate-200
                    shadow-sm
                    overflow-hidden">


            {{-- =================================================
                FORM HEADER
            ================================================== --}}

            <div class="border-b border-slate-200
                        px-4 sm:px-5 py-4">

                <h2 class="font-semibold text-slate-800">

                    Schedule Details

                </h2>

                <p class="mt-1 text-xs text-slate-500">

                    Update the schedule information below.

                </p>

            </div>


            <div class="p-4 sm:p-5">


                {{-- =================================================
                    SUBJECT
                ================================================== --}}

                <div class="mb-6">

                    <label for="subject_id"
                           class="block text-sm
                                  font-medium
                                  text-slate-700 mb-1.5">

                        Subject

                        <span class="text-red-500">*</span>

                    </label>


                    <select name="subject_id"
                            id="subject_id"
                            required
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
                            Select Subject
                        </option>

                        @foreach($subjects as $subject)

                            <option value="{{ $subject->id }}"
                                {{ old(
                                    'subject_id',
                                    $schedule->subject_id
                                ) == $subject->id
                                    ? 'selected'
                                    : '' }}>

                                {{ $subject->name }}

                                @if($subject->code)

                                    — {{ $subject->code }}

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


                {{-- =================================================
                    DATE + TIME + ROOM
                ================================================== --}}

                <div class="grid grid-cols-1
                            sm:grid-cols-2
                            lg:grid-cols-4 gap-4">


                    {{-- Exam Date --}}

                    <div>

                        <label for="exam_date"
                               class="block text-sm
                                      font-medium
                                      text-slate-700 mb-1.5">

                            Exam Date

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="date"
                               name="exam_date"
                               id="exam_date"
                               value="{{ old(
                                   'exam_date',
                                   optional($schedule->exam_date)
                                       ? \Carbon\Carbon::parse(
                                           $schedule->exam_date
                                       )->format('Y-m-d')
                                       : ''
                               ) }}"
                               required
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white
                                      px-3 py-2.5
                                      text-sm text-slate-800
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100">

                        @error('exam_date')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Start Time --}}

                    <div>

                        <label for="start_time"
                               class="block text-sm
                                      font-medium
                                      text-slate-700 mb-1.5">

                            Start Time

                        </label>

                        <input type="time"
                               name="start_time"
                               id="start_time"
                               value="{{ old(
                                   'start_time',
                                   $schedule->start_time
                                       ? \Carbon\Carbon::parse(
                                           $schedule->start_time
                                       )->format('H:i')
                                       : ''
                               ) }}"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white
                                      px-3 py-2.5
                                      text-sm text-slate-800
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100">

                        @error('start_time')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- End Time --}}

                    <div>

                        <label for="end_time"
                               class="block text-sm
                                      font-medium
                                      text-slate-700 mb-1.5">

                            End Time

                        </label>

                        <input type="time"
                               name="end_time"
                               id="end_time"
                               value="{{ old(
                                   'end_time',
                                   $schedule->end_time
                                       ? \Carbon\Carbon::parse(
                                           $schedule->end_time
                                       )->format('H:i')
                                       : ''
                               ) }}"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white
                                      px-3 py-2.5
                                      text-sm text-slate-800
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100">

                        @error('end_time')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Room --}}

                    <div>

                        <label for="room"
                               class="block text-sm
                                      font-medium
                                      text-slate-700 mb-1.5">

                            Room

                        </label>

                        <input type="text"
                               name="room"
                               id="room"
                               value="{{ old(
                                   'room',
                                   $schedule->room
                               ) }}"
                               placeholder="e.g. Room 101"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white
                                      px-3 py-2.5
                                      text-sm text-slate-800
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100">

                        @error('room')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>


                {{-- =================================================
                    MARKS CONFIGURATION
                ================================================== --}}

                <div class="mt-6">

                    <div class="mb-3">

                        <h3 class="text-sm
                                   font-semibold
                                   text-slate-800">

                            Marks Configuration

                        </h3>

                        <p class="text-xs text-slate-500 mt-1">

                            Update full marks and passing marks.

                        </p>

                    </div>


                    <div class="grid grid-cols-1
                                sm:grid-cols-2 gap-4">


                        {{-- Full Marks --}}

                        <div>

                            <label for="full_marks"
                                   class="block text-sm
                                          font-medium
                                          text-slate-700 mb-1.5">

                                Full Marks

                                <span class="text-red-500">*</span>

                            </label>

                            <input type="number"
                                   name="full_marks"
                                   id="full_marks"
                                   value="{{ old(
                                       'full_marks',
                                       $schedule->full_marks
                                   ) }}"
                                   min="0"
                                   step="0.01"
                                   required
                                   class="w-full rounded-lg
                                          border border-slate-300
                                          bg-white
                                          px-3 py-2.5
                                          text-sm text-slate-800
                                          outline-none
                                          focus:border-blue-500
                                          focus:ring-2
                                          focus:ring-blue-100">

                            @error('full_marks')

                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Pass Marks --}}

                        <div>

                            <label for="pass_marks"
                                   class="block text-sm
                                          font-medium
                                          text-slate-700 mb-1.5">

                                Pass Marks

                                <span class="text-red-500">*</span>

                            </label>

                            <input type="number"
                                   name="pass_marks"
                                   id="pass_marks"
                                   value="{{ old(
                                       'pass_marks',
                                       $schedule->pass_marks
                                   ) }}"
                                   min="0"
                                   step="0.01"
                                   required
                                   class="w-full rounded-lg
                                          border border-slate-300
                                          bg-white
                                          px-3 py-2.5
                                          text-sm text-slate-800
                                          outline-none
                                          focus:border-blue-500
                                          focus:ring-2
                                          focus:ring-blue-100">

                            @error('pass_marks')

                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    INSTRUCTIONS
                ================================================== --}}

                <div class="mt-6">

                    <label for="instructions"
                           class="block text-sm
                                  font-medium
                                  text-slate-700 mb-1.5">

                        Instructions

                    </label>

                    <textarea name="instructions"
                              id="instructions"
                              rows="4"
                              placeholder="Enter any special instructions..."
                              class="w-full rounded-lg
                                     border border-slate-300
                                     bg-white
                                     px-3 py-2.5
                                     text-sm text-slate-800
                                     outline-none
                                     resize-none
                                     focus:border-blue-500
                                     focus:ring-2
                                     focus:ring-blue-100">{{ old(
                                         'instructions',
                                         $schedule->instructions
                                     ) }}</textarea>

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

            <div class="border-t border-slate-200
                        bg-slate-50
                        px-4 sm:px-5 py-4">

                <div class="flex flex-col-reverse
                            sm:flex-row
                            sm:items-center
                            sm:justify-between gap-3">


                    {{-- Cancel --}}

                    <a href="{{ route(
                        'admin.exams.schedules.index',
                        $exam
                    ) }}"
                       class="inline-flex
                              items-center
                              justify-center
                              gap-2
                              rounded-lg
                              border border-slate-300
                              bg-white
                              px-5 py-2.5
                              text-sm
                              font-medium
                              text-slate-700
                              hover:bg-slate-50
                              transition">

                        <i class="bi bi-x-lg"></i>

                        Cancel

                    </a>


                    <div class="flex flex-col
                                sm:flex-row gap-2">


                        {{-- Delete --}}

                        <button type="button"
                                onclick="confirmDelete()"
                                class="inline-flex
                                       items-center
                                       justify-center
                                       gap-2
                                       rounded-lg
                                       border border-red-200
                                       bg-red-50
                                       px-5 py-2.5
                                       text-sm
                                       font-semibold
                                       text-red-600
                                       hover:bg-red-100
                                       transition">

                            <i class="bi bi-trash"></i>

                            Delete

                        </button>


                        {{-- Update --}}

                        <button type="submit"
                                class="inline-flex
                                       items-center
                                       justify-center
                                       gap-2
                                       rounded-lg
                                       bg-blue-600
                                       px-5 py-2.5
                                       text-sm
                                       font-semibold
                                       text-white
                                       hover:bg-blue-700
                                       transition">

                            <i class="bi bi-check-lg"></i>

                            Update Schedule

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>


    {{-- =========================================================
        DELETE FORM
    ========================================================== --}}

    <form id="delete-schedule-form"
          method="POST"
          action="{{ route(
              'admin.exams.schedules.destroy',
              [$exam, $schedule]
          ) }}"
          class="hidden">

        @csrf

        @method('DELETE')

    </form>

</div>


{{-- =============================================================
    DELETE CONFIRMATION
============================================================= --}}

<script>

function confirmDelete() {

    if (
        confirm(
            'Are you sure you want to delete this exam schedule?'
        )
    ) {

        document
            .getElementById('delete-schedule-form')
            .submit();

    }

}

</script>

@endsection