@extends('admin.layouts.app')

@section('title', 'Edit Exam Subject')

@section('page-title', 'Edit Exam Subject')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="mb-6">

        <div class="flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-4">

            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    Edit Exam Subject
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Update the assigned subject and marks information.
                </p>
            </div>

            <div class="flex flex-wrap gap-2">

                <a href="{{ route('admin.exam-subjects.show', $examSubject) }}"
                   class="inline-flex items-center justify-center gap-2
                          px-4 py-2.5 bg-blue-50 hover:bg-blue-100
                          text-blue-600 rounded-lg text-sm font-semibold
                          transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
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
                Edit
            </span>

        </nav>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="mb-6 rounded-xl border border-red-200
                    bg-red-50 px-4 py-4">

            <div class="flex items-start gap-3">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-red-600 mt-0.5 shrink-0"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13
                             A2 2 0 004.52 20h14.96a2 2 0 001.73-3.14l-7.5-13
                             a2 2 0 00-3.42 0z"/>

                </svg>

                <div>

                    <h3 class="text-sm font-semibold text-red-800">
                        Please fix the following errors:
                    </h3>

                    <ul class="mt-2 list-disc pl-5
                               text-sm text-red-700 space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        FORM CARD
    ========================================================== --}}
    <div class="bg-white border border-slate-200
                rounded-xl shadow-sm overflow-hidden">

        {{-- Card Header --}}
        <div class="px-5 py-4 sm:px-6
                    border-b border-slate-200 bg-slate-50">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg bg-amber-50
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 text-amber-600"
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

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Update Subject Assignment
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Modify examination, class, subject and marks details.
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            FORM
        ====================================================== --}}
        <form method="POST"
              action="{{ route(
                  'admin.exam-subjects.update',
                  $examSubject
              ) }}">

            @csrf
            @method('PUT')


            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- =================================================
                        EXAM
                    ================================================== --}}
                    <div>

                        <label for="exam_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Exam
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="exam_id"
                                id="exam_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                Select Exam
                            </option>

                            @foreach($exams as $exam)

                                <option value="{{ $exam->id }}"
                                    {{ old(
                                        'exam_id',
                                        $examSubject->exam_id
                                    ) == $exam->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $exam->name }}

                                    @if($exam->code)
                                        — {{ $exam->code }}
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


                    {{-- =================================================
                        ACADEMIC SESSION
                    ================================================== --}}
                    <div>

                        <label for="academic_session_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Academic Session
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="academic_session_id"
                                id="academic_session_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                Select Academic Session
                            </option>

                            @foreach($academicSessions as $session)

                                <option value="{{ $session->id }}"
                                    {{ old(
                                        'academic_session_id',
                                        $examSubject->academic_session_id
                                    ) == $session->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $session->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('academic_session_id')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        CLASS
                    ================================================== --}}
                    <div>

                        <label for="school_class_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Class
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="school_class_id"
                                id="school_class_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                Select Class
                            </option>

                            @foreach($schoolClasses as $class)

                                <option value="{{ $class->id }}"
                                    {{ old(
                                        'school_class_id',
                                        $examSubject->school_class_id
                                    ) == $class->id
                                        ? 'selected'
                                        : '' }}>

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


                    {{-- =================================================
                        SECTION
                    ================================================== --}}
                    <div>

                        <label for="section_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Section

                        </label>

                        <select name="section_id"
                                id="section_id"
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                All Sections
                            </option>

                            @foreach($sections as $section)

                                <option value="{{ $section->id }}"
                                    {{ old(
                                        'section_id',
                                        $examSubject->section_id
                                    ) == $section->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $section->name }}

                                </option>

                            @endforeach

                        </select>

                        <p class="mt-1 text-xs text-slate-500">
                            Leave blank if the subject applies to all
                            sections of the selected class.
                        </p>

                        @error('section_id')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        SUBJECT
                    ================================================== --}}
                    <div class="md:col-span-2">

                        <label for="subject_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Subject
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="subject_id"
                                id="subject_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                Select Subject
                            </option>

                            @foreach($subjects as $subject)

                                <option value="{{ $subject->id }}"
                                    {{ old(
                                        'subject_id',
                                        $examSubject->subject_id
                                    ) == $subject->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $subject->name }}

                                    @if(isset($subject->code) && $subject->code)
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
                        FULL MARKS
                    ================================================== --}}
                    <div>

                        <label for="full_marks"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Full Marks
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="number"
                               name="full_marks"
                               id="full_marks"
                               value="{{ old(
                                   'full_marks',
                                   $examSubject->full_marks
                               ) }}"
                               min="0"
                               step="0.01"
                               required
                               placeholder="e.g. 100"
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500
                                      focus:ring-blue-500 text-sm">

                        @error('full_marks')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        PASS MARKS
                    ================================================== --}}
                    <div>

                        <label for="pass_marks"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Pass Marks

                        </label>

                        <input type="number"
                               name="pass_marks"
                               id="pass_marks"
                               value="{{ old(
                                   'pass_marks',
                                   $examSubject->pass_marks
                               ) }}"
                               min="0"
                               step="0.01"
                               placeholder="e.g. 33"
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500
                                      focus:ring-blue-500 text-sm">

                        @error('pass_marks')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        STATUS
                    ================================================== --}}
                    <div class="md:col-span-2">

                        <div class="rounded-lg border border-slate-200
                                    bg-slate-50 p-4">

                            <label class="flex items-center gap-3 cursor-pointer">

                                <input type="checkbox"
                                       name="status"
                                       value="1"
                                       {{ old(
                                           'status',
                                           $examSubject->status
                                       )
                                           ? 'checked'
                                           : '' }}
                                       class="rounded border-slate-300
                                              text-blue-600
                                              focus:ring-blue-500">

                                <div>

                                    <div class="text-sm font-semibold
                                                text-slate-700">

                                        Active

                                    </div>

                                    <div class="text-xs text-slate-500">

                                        Active subjects can be used for
                                        marks entry and result processing.

                                    </div>

                                </div>

                            </label>

                        </div>

                        @error('status')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>


                {{-- =================================================
                    CURRENT INFORMATION
                ================================================== --}}
                <div class="mt-6 rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                        <div>

                            <div class="text-xs text-slate-500">
                                Assignment ID
                            </div>

                            <div class="text-sm font-semibold
                                        text-slate-800 mt-1">

                                #{{ $examSubject->id }}

                            </div>

                        </div>


                        <div>

                            <div class="text-xs text-slate-500">
                                Created
                            </div>

                            <div class="text-sm font-semibold
                                        text-slate-800 mt-1">

                                {{ $examSubject->created_at?->format('d M Y, h:i A') }}

                            </div>

                        </div>


                        <div>

                            <div class="text-xs text-slate-500">
                                Last Updated
                            </div>

                            <div class="text-sm font-semibold
                                        text-slate-800 mt-1">

                                {{ $examSubject->updated_at?->format('d M Y, h:i A') }}

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    INFORMATION BOX
                ================================================== --}}
                <div class="mt-5 rounded-lg border border-blue-200
                            bg-blue-50 px-4 py-4">

                    <div class="flex items-start gap-3">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 text-blue-600 mt-0.5 shrink-0"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01
                                     M12 20a8 8 0 100-16 8 8 0 000 16z"/>

                        </svg>

                        <div>

                            <h3 class="text-sm font-semibold text-blue-800">
                                Important
                            </h3>

                            <p class="text-xs text-blue-700 mt-1 leading-5">

                                Make sure the selected subject is correct
                                for the selected examination and class.
                                Duplicate assignments for the same exam,
                                class, section and subject are not allowed.

                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                FOOTER ACTIONS
            ====================================================== --}}
            <div class="px-5 sm:px-6 py-4 bg-slate-50
                        border-t border-slate-200
                        flex flex-col-reverse sm:flex-row
                        sm:items-center sm:justify-between gap-3">

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
                            class="w-full sm:w-auto inline-flex
                                   items-center justify-center gap-2
                                   px-5 py-2.5 rounded-lg
                                   bg-red-50 hover:bg-red-100
                                   text-red-600 text-sm font-semibold
                                   transition">

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

                        Delete

                    </button>

                </form>


                {{-- Right Actions --}}
                <div class="flex flex-col sm:flex-row gap-3">

                    <a href="{{ route(
                            'admin.exam-subjects.index'
                        ) }}"
                       class="inline-flex items-center justify-center
                              px-5 py-2.5 rounded-lg
                              bg-white border border-slate-300
                              text-slate-700 hover:bg-slate-100
                              text-sm font-semibold transition">

                        Cancel

                    </a>


                    <button type="submit"
                            form=""
                            onclick="document.getElementById(
                                'exam-subject-update-form'
                            ).submit();"
                            class="inline-flex items-center justify-center
                                   gap-2 px-5 py-2.5 rounded-lg
                                   bg-blue-600 hover:bg-blue-700
                                   text-white text-sm font-semibold
                                   shadow-sm transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 13l4 4L19 7"/>

                        </svg>

                        Update Subject

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection