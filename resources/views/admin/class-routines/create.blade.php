@extends('admin.layouts.app')

@section('title', 'Create Class Routine')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Create Class Routine
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Add a new class timetable entry.
            </p>
        </div>

        <a href="{{ route('admin.class-routines.index') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5
                  bg-slate-100 hover:bg-slate-200
                  text-slate-700 rounded-lg
                  text-sm font-medium">
            ← Back
        </a>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="bg-red-50 border border-red-200
                    text-red-700 px-4 py-3 rounded-lg">

            <ul class="list-disc ml-5 text-sm space-y-1">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- Form --}}
    <form action="{{ route('admin.class-routines.store') }}"
          method="POST">

        @csrf


        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm overflow-hidden">

            {{-- Section Header --}}
            <div class="px-6 py-5 border-b border-slate-200">

                <h2 class="text-lg font-bold text-slate-800">
                    Routine Information
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Select the class, subject, teacher and schedule.
                </p>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2
                            lg:grid-cols-3 gap-5">


                    {{-- Branch --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1">
                            Branch <span class="text-red-500">*</span>
                        </label>

                        <select name="branch_id"
                                id="branch_id"
                                required
                                class="w-full rounded-lg
                                       border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500">

                            <option value="">
                                Select Branch
                            </option>

                            @foreach($branches as $branch)

                                <option value="{{ $branch->id }}"
                                    {{ old('branch_id') == $branch->id ? 'selected' : '' }}>

                                    {{ $branch->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('branch_id')
                            <p class="text-xs text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Academic Session --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1">
                            Academic Session
                            <span class="text-red-500">*</span>
                        </label>

                        <select name="academic_session_id"
                                id="academic_session_id"
                                required
                                class="w-full rounded-lg
                                       border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500">

                            <option value="">
                                Select Academic Session
                            </option>

                            @foreach($academicSessions as $session)

                                <option value="{{ $session->id }}"
                                    {{ old('academic_session_id') == $session->id ? 'selected' : '' }}>

                                    {{ $session->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('academic_session_id')
                            <p class="text-xs text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Class --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1">
                            Class <span class="text-red-500">*</span>
                        </label>

                        <select name="school_class_id"
                                id="school_class_id"
                                required
                                class="w-full rounded-lg
                                       border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500">

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
                            <p class="text-xs text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Section --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1">
                            Section <span class="text-red-500">*</span>
                        </label>

                        <select name="section_id"
                                id="section_id"
                                required
                                class="w-full rounded-lg
                                       border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500">

                            <option value="">
                                Select Section
                            </option>

                            @foreach($sections as $section)

                                <option value="{{ $section->id }}"
                                    {{ old('section_id') == $section->id ? 'selected' : '' }}>

                                    {{ $section->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('section_id')
                            <p class="text-xs text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Subject --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1">
                            Subject <span class="text-red-500">*</span>
                        </label>

                        <select name="subject_id"
                                id="subject_id"
                                required
                                class="w-full rounded-lg
                                       border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500">

                            <option value="">
                                Select Subject
                            </option>

                            @foreach($subjects as $subject)

                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id') == $subject->id ? 'selected' : '' }}>

                                    {{ $subject->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('subject_id')
                            <p class="text-xs text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Teacher --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1">
                            Teacher <span class="text-red-500">*</span>
                        </label>

                        <select name="teacher_id"
                                id="teacher_id"
                                required
                                class="w-full rounded-lg
                                       border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500">

                            <option value="">
                                Select Teacher
                            </option>

                            @foreach($teachers as $teacher)

                                <option value="{{ $teacher->id }}"
                                    {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>

                                    {{ $teacher->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('teacher_id')
                            <p class="text-xs text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Day --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1">
                            Day <span class="text-red-500">*</span>
                        </label>

                        <select name="day"
                                id="day"
                                required
                                class="w-full rounded-lg
                                       border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500">

                            <option value="">
                                Select Day
                            </option>

                            @foreach([
                                'Saturday',
                                'Sunday',
                                'Monday',
                                'Tuesday',
                                'Wednesday',
                                'Thursday',
                                'Friday'
                            ] as $day)

                                <option value="{{ $day }}"
                                    {{ old('day') == $day ? 'selected' : '' }}>

                                    {{ $day }}

                                </option>

                            @endforeach

                        </select>

                        @error('day')
                            <p class="text-xs text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Start Time --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1">
                            Start Time
                            <span class="text-red-500">*</span>
                        </label>

                        <input type="time"
                               name="start_time"
                               value="{{ old('start_time') }}"
                               required
                               class="w-full rounded-lg
                                      border-slate-300
                                      focus:border-blue-500
                                      focus:ring-blue-500">

                        @error('start_time')
                            <p class="text-xs text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- End Time --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1">
                            End Time
                            <span class="text-red-500">*</span>
                        </label>

                        <input type="time"
                               name="end_time"
                               value="{{ old('end_time') }}"
                               required
                               class="w-full rounded-lg
                                      border-slate-300
                                      focus:border-blue-500
                                      focus:ring-blue-500">

                        @error('end_time')
                            <p class="text-xs text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Room --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1">
                            Room / Classroom
                        </label>

                        <input type="text"
                               name="room"
                               value="{{ old('room') }}"
                               placeholder="e.g. Room 101"
                               class="w-full rounded-lg
                                      border-slate-300
                                      focus:border-blue-500
                                      focus:ring-blue-500">

                        @error('room')
                            <p class="text-xs text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-2">
                            Status
                        </label>

                        <label class="inline-flex items-center gap-3
                                      cursor-pointer">

                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   {{ old('status', true) ? 'checked' : '' }}
                                   class="rounded border-slate-300
                                          text-blue-600
                                          focus:ring-blue-500">

                            <span class="text-sm text-slate-700">
                                Active
                            </span>

                        </label>

                    </div>

                </div>

            </div>


            {{-- Footer --}}
            <div class="px-6 py-4 bg-slate-50
                        border-t border-slate-200
                        flex flex-col sm:flex-row
                        justify-end gap-3">

                <a href="{{ route('admin.class-routines.index') }}"
                   class="px-5 py-2.5
                          bg-white border border-slate-300
                          hover:bg-slate-100
                          text-slate-700
                          rounded-lg text-sm font-medium
                          text-center">
                    Cancel
                </a>

                <button type="submit"
                        class="px-5 py-2.5
                               bg-blue-600 hover:bg-blue-700
                               text-white
                               rounded-lg text-sm font-medium">
                    Save Routine
                </button>

            </div>

        </div>

    </form>

</div>

@endsection