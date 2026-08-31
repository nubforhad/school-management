@extends('admin.layouts.app')

@section('title', 'Edit Teacher Assignment')

@section('page-title', 'Edit Teacher Assignment')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">
 
{{-- Page Header --}}
<div class="mb-6">

    <a href="{{ route('admin.teacher-assignment.index') }}"
       class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-blue-600 transition">

        <i class="bi bi-arrow-left"></i>

        Back to Teacher Assignments

    </a>

    <div class="mt-4">

        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
            Edit Teacher Assignment
        </h1>

        <p class="mt-1 text-xs sm:text-sm text-slate-500">
            Update teacher assignment information
        </p>

    </div>

</div>


{{-- Validation Errors --}}
@if($errors->any())

    <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3">

        <div class="flex items-start gap-3">

            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">

                <i class="bi bi-exclamation-triangle"></i>

            </div>

            <div>

                <p class="text-sm font-semibold text-red-800">
                    Please fix the following errors
                </p>

                <ul class="mt-1 list-disc list-inside text-xs text-red-700 space-y-1">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>

@endif


{{-- Form Card --}}
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

    <form action="{{ route('admin.teacher-assignment.update', $teacherAssignment->id) }}"
          method="POST">

        @csrf

        @method('PUT')


        {{-- Assignment Information --}}
        <div class="px-4 sm:px-6 py-4 border-b border-slate-200 bg-slate-50">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">

                    <i class="bi bi-person-workspace"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Assignment Information
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Update teacher, class, section and subject assignment
                    </p>

                </div>

            </div>

        </div>


        <div class="p-4 sm:p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">


                {{-- Teacher --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">

                        Teacher / Staff
                        <span class="text-red-500">*</span>

                    </label>

                    <select name="teacher_staff_id"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('teacher_staff_id') border-red-400 @enderror">

                        <option value="">
                            Select Teacher / Staff
                        </option>

                        @foreach($teachers as $teacher)

                            <option value="{{ $teacher->id }}"
                                {{ old('teacher_staff_id', $teacherAssignment->teacher_staff_id) == $teacher->id ? 'selected' : '' }}>

                                {{ $teacher->name }}

                                @if($teacher->employee_id)
                                    — {{ $teacher->employee_id }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('teacher_staff_id')

                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Academic Session --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">

                        Academic Session
                        <span class="text-red-500">*</span>

                    </label>

                    <select name="academic_session_id"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('academic_session_id') border-red-400 @enderror">

                        <option value="">
                            Select Academic Session
                        </option>

                        @foreach($academicSessions as $session)

                            <option value="{{ $session->id }}"
                                {{ old('academic_session_id', $teacherAssignment->academic_session_id) == $session->id ? 'selected' : '' }}>

                                {{ $session->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('academic_session_id')

                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Class --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">

                        Class
                        <span class="text-red-500">*</span>

                    </label>

                    <select name="school_class_id"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('school_class_id') border-red-400 @enderror">

                        <option value="">
                            Select Class
                        </option>

                        @foreach($classes as $class)

                            <option value="{{ $class->id }}"
                                {{ old('school_class_id', $teacherAssignment->school_class_id) == $class->id ? 'selected' : '' }}>

                                {{ $class->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('school_class_id')

                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Section --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">

                        Section
                        <span class="text-red-500">*</span>

                    </label>

                    <select name="section_id"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('section_id') border-red-400 @enderror">

                        <option value="">
                            Select Section
                        </option>

                        @foreach($sections as $section)

                            <option value="{{ $section->id }}"
                                {{ old('section_id', $teacherAssignment->section_id) == $section->id ? 'selected' : '' }}>

                                {{ $section->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('section_id')

                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Subject --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">

                        Subject
                        <span class="text-red-500">*</span>

                    </label>

                    <select name="subject_id"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('subject_id') border-red-400 @enderror">

                        <option value="">
                            Select Subject
                        </option>

                        @foreach($subjects as $subject)

                            <option value="{{ $subject->id }}"
                                {{ old('subject_id', $teacherAssignment->subject_id) == $subject->id ? 'selected' : '' }}>

                                {{ $subject->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('subject_id')

                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Class Teacher --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Class Teacher
                    </label>

                    <label class="flex items-center gap-3 h-[42px] cursor-pointer">

                        <input type="checkbox"
                               name="is_class_teacher"
                               value="1"
                               {{ old('is_class_teacher', $teacherAssignment->is_class_teacher) ? 'checked' : '' }}
                               class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">

                        <span class="text-sm text-slate-600">
                            Assign as Class Teacher
                        </span>

                    </label>

                </div>


                {{-- Status --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Status
                    </label>

                    <label class="flex items-center gap-3 h-[42px] cursor-pointer">

                        <input type="checkbox"
                               name="status"
                               value="1"
                               {{ old('status', $teacherAssignment->status) ? 'checked' : '' }}
                               class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">

                        <span class="text-sm text-slate-600">
                            Active
                        </span>

                    </label>

                </div>


                {{-- Current Assignment Info --}}
                <div class="lg:col-span-3">

                    <div class="rounded-lg border border-blue-100 bg-blue-50 px-4 py-3">

                        <div class="flex items-start gap-3">

                            <i class="bi bi-info-circle text-blue-600 mt-0.5"></i>

                            <div>

                                <p class="text-sm font-medium text-blue-800">
                                    Assignment Information
                                </p>

                                <p class="mt-1 text-xs text-blue-700">
                                    Update the assignment carefully. A class and section
                                    can have only one class teacher for the same academic session.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


            </div>

        </div>


        {{-- Form Footer --}}
        <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3 px-4 sm:px-6 py-4 border-t border-slate-200 bg-slate-50">

            <a href="{{ route('admin.teacher-assignment.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 transition">

                Cancel

            </a>

            <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700 transition">

                <i class="bi bi-check2-circle"></i>

                Update Assignment

            </button>

        </div>

    </form>

</div> 
</div>

@endsection
