@extends('admin.layouts.app')

@section('title', 'Edit Class Routine')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Edit Class Routine
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Update class routine information
            </p>
        </div>

        <a href="{{ route('admin.class-routines.index') }}"
           class="inline-flex items-center justify-center px-4 py-2 rounded-lg
                  bg-slate-100 text-slate-700 hover:bg-slate-200
                  text-sm font-medium">
            ← Back to Routine List
        </a>

    </div>


    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

            <div class="font-semibold text-red-700 mb-2">
                Please fix the following errors:
            </div>

            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif


    {{-- Form --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">

        <form action="{{ route('admin.class-routines.update', $classRoutine) }}"
              method="POST">

            @csrf
            @method('PUT')


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                    {{-- Branch --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Branch <span class="text-red-500">*</span>
                        </label>

                        <select name="branch_id"
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500">

                            <option value="">Select Branch</option>

                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}"
                                    {{ old('branch_id', $classRoutine->branch_id) == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('branch_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Academic Session --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Academic Session <span class="text-red-500">*</span>
                        </label>

                        <select name="academic_session_id"
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500">

                            <option value="">Select Academic Session</option>

                            @foreach ($academicSessions as $session)
                                <option value="{{ $session->id }}"
                                    {{ old('academic_session_id', $classRoutine->academic_session_id) == $session->id ? 'selected' : '' }}>
                                    {{ $session->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('academic_session_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Class --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Class <span class="text-red-500">*</span>
                        </label>

                        <select name="school_class_id"
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500">

                            <option value="">Select Class</option>

                            @foreach ($schoolClasses as $class)
                                <option value="{{ $class->id }}"
                                    {{ old('school_class_id', $classRoutine->school_class_id) == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('school_class_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Section --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Section <span class="text-red-500">*</span>
                        </label>

                        <select name="section_id"
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500">

                            <option value="">Select Section</option>

                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}"
                                    {{ old('section_id', $classRoutine->section_id) == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('section_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Subject --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Subject <span class="text-red-500">*</span>
                        </label>

                        <select name="subject_id"
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500">

                            <option value="">Select Subject</option>

                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id', $classRoutine->subject_id) == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('subject_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Teacher --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Teacher <span class="text-red-500">*</span>
                        </label>

                        <select name="teacher_id"
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500">

                            <option value="">Select Teacher</option>

                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ old('teacher_id', $classRoutine->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('teacher_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Day --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Day <span class="text-red-500">*</span>
                        </label>

                        <select name="day"
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500">

                            <option value="">Select Day</option>

                            @php
                                $days = [
                                    'Saturday',
                                    'Sunday',
                                    'Monday',
                                    'Tuesday',
                                    'Wednesday',
                                    'Thursday',
                                    'Friday',
                                ];
                            @endphp

                            @foreach ($days as $day)
                                <option value="{{ $day }}"
                                    {{ old('day', $classRoutine->day) == $day ? 'selected' : '' }}>
                                    {{ $day }}
                                </option>
                            @endforeach

                        </select>

                        @error('day')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Room --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Room / Classroom
                        </label>

                        <input type="text"
                               name="room"
                               value="{{ old('room', $classRoutine->room) }}"
                               placeholder="Example: Room 101"
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500 focus:ring-blue-500">

                        @error('room')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Start Time --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Start Time <span class="text-red-500">*</span>
                        </label>

                        <input type="time"
                               name="start_time"
                               value="{{ old('start_time', \Carbon\Carbon::parse($classRoutine->start_time)->format('H:i')) }}"
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500 focus:ring-blue-500">

                        @error('start_time')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- End Time --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            End Time <span class="text-red-500">*</span>
                        </label>

                        <input type="time"
                               name="end_time"
                               value="{{ old('end_time', \Carbon\Carbon::parse($classRoutine->end_time)->format('H:i')) }}"
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500 focus:ring-blue-500">

                        @error('end_time')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Status --}}
                    <div class="md:col-span-2">

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Status
                        </label>

                        <label class="inline-flex items-center cursor-pointer">

                            <input type="hidden" name="status" value="0">

                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   class="w-4 h-4 rounded border-slate-300
                                          text-blue-600 focus:ring-blue-500"
                                   {{ old('status', $classRoutine->status) ? 'checked' : '' }}>

                            <span class="ml-2 text-sm text-slate-700">
                                Active
                            </span>

                        </label>

                    </div>

                </div>

            </div>


            {{-- Footer --}}
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200
                        rounded-b-2xl flex flex-col sm:flex-row
                        justify-end gap-3">

                <a href="{{ route('admin.class-routines.index') }}"
                   class="px-5 py-2.5 rounded-lg border border-slate-300
                          bg-white text-slate-700 hover:bg-slate-100
                          text-sm font-medium text-center">
                    Cancel
                </a>

                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-blue-600
                               text-white hover:bg-blue-700
                               text-sm font-medium">
                    Update Routine
                </button>

            </div>

        </form>

    </div>

</div>

@endsection