@extends('admin.layouts.app')

@section('title', 'Exam Marks Entry')
@section('page-title', 'Exam Marks Entry')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">
 
{{-- HEADER --}}
<div class="mb-5 sm:mb-6">
    <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
        Exam Marks Entry
    </h1>

    <p class="mt-1 text-xs sm:text-sm text-slate-500">
        Enter and manage student examination marks
    </p>
</div>


{{-- SUCCESS --}}
@if(session('success'))
    <div class="mb-5 flex items-center gap-3 rounded-lg
                border border-green-200 bg-green-50
                px-4 py-3 text-sm text-green-700">

        <i class="bi bi-check-circle-fill"></i>

        <span>{{ session('success') }}</span>
    </div>
@endif


{{-- ERROR --}}
@if(session('error'))
    <div class="mb-5 flex items-center gap-3 rounded-lg
                border border-red-200 bg-red-50
                px-4 py-3 text-sm text-red-700">

        <i class="bi bi-exclamation-circle-fill"></i>

        <span>{{ session('error') }}</span>
    </div>
@endif


@if($errors->any())
    <div class="mb-5 rounded-lg border border-red-200
                bg-red-50 px-4 py-3 text-sm text-red-700">

        <p class="font-semibold mb-1">
            Please fix the following errors:
        </p>

        <ul class="list-disc pl-5 space-y-1">

            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>
@endif


{{-- =========================================================
    FILTER
========================================================== --}}

<div class="rounded-xl border border-slate-200
            bg-white shadow-sm overflow-hidden mb-5">

    <div class="border-b border-slate-200
                bg-slate-50 px-4 sm:px-5 py-4">

        <h2 class="font-semibold text-slate-800">
            Select Examination
        </h2>

        <p class="mt-1 text-xs text-slate-500">
            Select exam, class, section and subject to enter marks.
        </p>

    </div>


    <form method="GET"
          action="{{ route('admin.exam-marks.index') }}">

        <div class="p-4 sm:p-5">

            <div class="grid grid-cols-1
                        sm:grid-cols-2
                        lg:grid-cols-4 gap-4">

                {{-- Exam --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Exam
                        <span class="text-red-500">*</span>

                    </label>

                    <select name="exam_id"
                            required
                            class="w-full rounded-lg border
                                   border-slate-300 bg-white
                                   px-3 py-2.5 text-sm
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100">

                        <option value="">
                            Select Exam
                        </option>

                        @foreach($exams as $exam)

                            <option value="{{ $exam->id }}"
                                {{ request('exam_id') == $exam->id
                                    ? 'selected'
                                    : '' }}>

                                {{ $exam->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Class --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Class
                        <span class="text-red-500">*</span>

                    </label>

                    <select name="class_id"
                            required
                            onchange="this.form.submit()"
                            class="w-full rounded-lg border
                                   border-slate-300 bg-white
                                   px-3 py-2.5 text-sm
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100">

                        <option value="">
                            Select Class
                        </option>

                        @foreach($classes as $class)

                            <option value="{{ $class->id }}"
                                {{ request('class_id') == $class->id
                                    ? 'selected'
                                    : '' }}>

                                {{ $class->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Section --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Section
                        <span class="text-red-500">*</span>

                    </label>

                    <select name="section_id"
                            required
                            class="w-full rounded-lg border
                                   border-slate-300 bg-white
                                   px-3 py-2.5 text-sm
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100">

                        <option value="">
                            Select Section
                        </option>

                        @foreach($sections as $section)

                            <option value="{{ $section->id }}"
                                {{ request('section_id') == $section->id
                                    ? 'selected'
                                    : '' }}>

                                {{ $section->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Subject --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Subject
                        <span class="text-red-500">*</span>

                    </label>

                    <select name="subject_id"
                            required
                            class="w-full rounded-lg border
                                   border-slate-300 bg-white
                                   px-3 py-2.5 text-sm
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100">

                        <option value="">
                            Select Subject
                        </option>

                        @foreach($subjects as $subject)

                            <option value="{{ $subject->id }}"
                                {{ request('subject_id') == $subject->id
                                    ? 'selected'
                                    : '' }}>

                                {{ $subject->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            <div class="mt-5 flex justify-end">

                <button type="submit"
                        class="inline-flex items-center
                               justify-center gap-2
                               rounded-lg bg-blue-600
                               px-5 py-2.5
                               text-sm font-semibold
                               text-white
                               hover:bg-blue-700
                               transition">

                    <i class="bi bi-search"></i>

                    Load Students

                </button>

            </div>

        </div>

    </form>

</div>


{{-- =========================================================
    MARKS INFORMATION
========================================================== --}}

@if($schedule)

    <div class="grid grid-cols-2
                sm:grid-cols-4 gap-3 mb-5">

        {{-- Written --}}
        <div class="rounded-xl border border-blue-200
                    bg-blue-50 p-4">

            <p class="text-xs text-blue-600">
                Written Marks
            </p>

            <p class="mt-1 text-lg font-bold text-blue-800">

                {{ number_format($schedule->written_marks ?? 0, 2) }}

            </p>

        </div>


        {{-- MCQ --}}
        <div class="rounded-xl border border-purple-200
                    bg-purple-50 p-4">

            <p class="text-xs text-purple-600">
                MCQ Marks
            </p>

            <p class="mt-1 text-lg font-bold text-purple-800">

                {{ number_format($schedule->mcq_marks ?? 0, 2) }}

            </p>

        </div>


        {{-- Practical --}}
        <div class="rounded-xl border border-amber-200
                    bg-amber-50 p-4">

            <p class="text-xs text-amber-600">
                Practical Marks
            </p>

            <p class="mt-1 text-lg font-bold text-amber-800">

                {{ number_format($schedule->practical_marks ?? 0, 2) }}

            </p>

        </div>


        {{-- Total --}}
        <div class="rounded-xl border border-green-200
                    bg-green-50 p-4">

            <p class="text-xs text-green-600">
                Full Marks
            </p>

            <p class="mt-1 text-lg font-bold text-green-800">

                {{
                    number_format(
                        ($schedule->written_marks ?? 0)
                        + ($schedule->mcq_marks ?? 0)
                        + ($schedule->practical_marks ?? 0),
                        2
                    )
                }}

            </p>

        </div>

    </div>


    {{-- =====================================================
        STUDENT MARKS FORM
    ====================================================== --}}

    <div class="rounded-xl border border-slate-200
                bg-white shadow-sm overflow-hidden">

        <div class="border-b border-slate-200
                    px-4 sm:px-5 py-4">

            <div class="flex flex-col sm:flex-row
                        sm:items-center
                        sm:justify-between gap-2">

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Student Marks
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">

                        {{ $students->count() }}
                        students found

                    </p>

                </div>

            </div>

        </div>


        @if($students->count())

            <form method="POST"
                  action="{{ route('admin.exam-marks.store') }}">

                @csrf

                <input type="hidden"
                       name="exam_schedule_id"
                       value="{{ $schedule->id }}">


                <div class="overflow-x-auto">

                    <table class="w-full min-w-[1100px]
                                  text-xs sm:text-sm">

                        <thead class="bg-slate-50
                                      border-b border-slate-200">

                            <tr>

                                <th class="px-4 py-3 text-left
                                           font-semibold
                                           text-slate-600">
                                    #
                                </th>

                                <th class="px-4 py-3 text-left
                                           font-semibold
                                           text-slate-600">
                                    Student
                                </th>

                                <th class="px-4 py-3 text-left
                                           font-semibold
                                           text-slate-600">
                                    Student ID
                                </th>

                                <th class="px-4 py-3 text-center
                                           font-semibold
                                           text-slate-600">
                                    Written
                                </th>

                                <th class="px-4 py-3 text-center
                                           font-semibold
                                           text-slate-600">
                                    MCQ
                                </th>

                                <th class="px-4 py-3 text-center
                                           font-semibold
                                           text-slate-600">
                                    Practical
                                </th>

                                <th class="px-4 py-3 text-center
                                           font-semibold
                                           text-slate-600">
                                    Total
                                </th>

                                <th class="px-4 py-3 text-center
                                           font-semibold
                                           text-slate-600">
                                    Grade
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @foreach($students as $student)

                                @php

                                    $existingMark =
                                        $marks->get($student->id);

                                @endphp

                                <tr class="hover:bg-slate-50">

                                    {{-- # --}}
                                    <td class="px-4 py-3
                                               text-slate-500">

                                        {{ $loop->iteration }}

                                    </td>


                                    {{-- Student --}}
                                    <td class="px-4 py-3">

                                        <div class="flex items-center
                                                    gap-3">

                                            <div class="flex h-9 w-9
                                                        shrink-0
                                                        items-center
                                                        justify-center
                                                        rounded-full
                                                        bg-blue-50
                                                        text-blue-600
                                                        font-semibold">

                                                {{
                                                    strtoupper(
                                                        substr(
                                                            $student->name,
                                                            0,
                                                            1
                                                        )
                                                    )
                                                }}

                                            </div>

                                            <span class="font-semibold
                                                         text-slate-800">

                                                {{ $student->name }}

                                            </span>

                                        </div>

                                    </td>


                                    {{-- Student ID --}}
                                    <td class="px-4 py-3
                                               text-slate-500">

                                        {{ $student->student_id }}

                                    </td>


                                    {{-- Written --}}
                                    <td class="px-4 py-3">

                                        <input type="number"
                                               name="marks[{{ $loop->index }}][written_marks]"
                                               value="{{ old(
                                                   'marks.' . $loop->index . '.written_marks',
                                                   $existingMark?->written_marks
                                               ) }}"
                                               min="0"
                                               max="{{ $schedule->written_marks ?? 0 }}"
                                               step="0.01"
                                               class="mark-input w-24 rounded-lg
                                                      border border-slate-300
                                                      px-3 py-2
                                                      text-center text-sm
                                                      focus:border-blue-500
                                                      focus:ring-2
                                                      focus:ring-blue-100">

                                    </td>


                                    {{-- MCQ --}}
                                    <td class="px-4 py-3">

                                        <input type="number"
                                               name="marks[{{ $loop->index }}][mcq_marks]"
                                               value="{{ old(
                                                   'marks.' . $loop->index . '.mcq_marks',
                                                   $existingMark?->mcq_marks
                                               ) }}"
                                               min="0"
                                               max="{{ $schedule->mcq_marks ?? 0 }}"
                                               step="0.01"
                                               class="mark-input w-24 rounded-lg
                                                      border border-slate-300
                                                      px-3 py-2
                                                      text-center text-sm
                                                      focus:border-blue-500
                                                      focus:ring-2
                                                      focus:ring-blue-100">

                                    </td>


                                    {{-- Practical --}}
                                    <td class="px-4 py-3">

                                        <input type="number"
                                               name="marks[{{ $loop->index }}][practical_marks]"
                                               value="{{ old(
                                                   'marks.' . $loop->index . '.practical_marks',
                                                   $existingMark?->practical_marks
                                               ) }}"
                                               min="0"
                                               max="{{ $schedule->practical_marks ?? 0 }}"
                                               step="0.01"
                                               class="mark-input w-24 rounded-lg
                                                      border border-slate-300
                                                      px-3 py-2
                                                      text-center text-sm
                                                      focus:border-blue-500
                                                      focus:ring-2
                                                      focus:ring-blue-100">

                                    </td>


                                    {{-- Total --}}
                                    <td class="px-4 py-3 text-center">

                                        <span class="student-total
                                                     font-semibold
                                                     text-slate-700">

                                            {{ $existingMark?->total_marks ?? 0 }}

                                        </span>

                                    </td>


                                    {{-- Grade --}}
                                    <td class="px-4 py-3 text-center">

                                        <span class="student-grade
                                                     font-semibold
                                                     text-blue-600">

                                            {{ $existingMark?->grade ?? '—' }}

                                        </span>

                                    </td>


                                    <input type="hidden"
                                           name="marks[{{ $loop->index }}][student_id]"
                                           value="{{ $student->id }}">

                                    <input type="hidden"
                                           name="marks[{{ $loop->index }}][remarks]"
                                           value="{{ $existingMark?->remarks }}">

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- FOOTER --}}

                <div class="flex flex-col sm:flex-row
                            sm:items-center
                            sm:justify-between
                            gap-3
                            border-t border-slate-200
                            bg-slate-50
                            px-4 sm:px-5 py-4">

                    <p class="text-xs text-slate-500">

                        Enter marks within the maximum allowed marks.

                    </p>

                    <button type="submit"
                            class="inline-flex items-center
                                   justify-center gap-2
                                   rounded-lg bg-blue-600
                                   px-5 py-2.5
                                   text-sm font-semibold
                                   text-white
                                   hover:bg-blue-700
                                   transition">

                        <i class="bi bi-save"></i>

                        Save Marks

                    </button>

                </div>

            </form>

        @else

            <div class="px-4 py-14 text-center">

                <div class="flex h-16 w-16 mx-auto
                            items-center justify-center
                            rounded-full bg-blue-50
                            text-blue-600">

                    <i class="bi bi-people text-3xl"></i>

                </div>

                <h3 class="mt-4 font-semibold
                           text-slate-700">

                    No Students Found

                </h3>

                <p class="mt-1 text-sm text-slate-500">

                    No active students are enrolled
                    in this class and section.

                </p>

            </div>

        @endif

    </div>

@else

    {{-- EMPTY STATE --}}

    <div class="rounded-xl border border-slate-200
                bg-white shadow-sm p-10 text-center">

        <div class="flex h-16 w-16 mx-auto
                    items-center justify-center
                    rounded-full bg-blue-50
                    text-blue-600">

            <i class="bi bi-pencil-square text-3xl"></i>

        </div>

        <h3 class="mt-4 font-semibold text-slate-700">

            Select Examination Details

        </h3>

        <p class="mt-1 text-sm text-slate-500">

            Select an exam, class, section and subject
            to load students.

        </p>

    </div>

@endif 

</div>

@endsection
