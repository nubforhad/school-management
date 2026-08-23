@extends('admin.layouts.app')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        Header
    ========================================================== --}}

    <div class="mb-4 sm:mb-6">

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-3">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Edit Attendance
                </h1>

                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Correct student attendance information
                </p>

            </div>

            <a href="{{ route('admin.attendance.student-history', [
                'student_id' => $attendance->student_id
            ]) }}"
               class="w-full sm:w-auto
                      inline-flex items-center justify-center gap-2
                      px-4 py-2.5 rounded-lg
                      bg-slate-100 text-slate-700
                      text-sm font-medium
                      hover:bg-slate-200 transition">

                <i class="bi bi-arrow-left"></i>

                Back to History

            </a>

        </div>

    </div>


    {{-- =========================================================
        Errors
    ========================================================== --}}

    @if($errors->any())

        <div class="mb-4 sm:mb-5
                    rounded-lg
                    bg-red-50
                    border border-red-200
                    px-3 sm:px-4 py-3
                    text-sm text-red-700">

            <ul class="list-disc list-inside space-y-1">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        Student Information
    ========================================================== --}}

    <div class="bg-white rounded-xl shadow-sm
                border border-slate-200
                p-4 sm:p-5 mb-4 sm:mb-6">

        <div class="flex flex-col sm:flex-row
                    sm:items-center gap-4">

            <div class="w-14 h-14 rounded-full
                        bg-blue-50
                        flex items-center justify-center
                        flex-shrink-0">

                <i class="bi bi-person
                          text-2xl text-blue-600"></i>

            </div>

            <div>

                <h2 class="text-lg sm:text-xl
                           font-bold text-slate-800">

                    {{ $attendance->student->name ?? 'N/A' }}

                </h2>

                <div class="flex flex-wrap
                            gap-x-4 gap-y-1
                            mt-1
                            text-xs sm:text-sm
                            text-slate-500">

                    @if($attendance->student->student_id ?? null)

                        <span>
                            Student ID:
                            {{ $attendance->student->student_id }}
                        </span>

                    @endif

                    <span>
                        Attendance ID:
                        #{{ $attendance->id }}
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        Edit Form
    ========================================================== --}}

    <div class="bg-white rounded-xl shadow-sm
                border border-slate-200 overflow-hidden">

        <div class="p-4 sm:p-5
                    border-b border-slate-200">

            <h2 class="text-base sm:text-lg
                       font-semibold text-slate-800">

                Attendance Information

            </h2>

            <p class="text-xs sm:text-sm text-slate-500 mt-1">

                Update the attendance information below.

            </p>

        </div>


        <form method="POST"
              action="{{ route('admin.attendance.update', $attendance->id) }}">

            @csrf

            @method('PUT')


            <div class="p-4 sm:p-6">

                <div class="grid grid-cols-1
                            sm:grid-cols-2
                            lg:grid-cols-3
                            gap-4 sm:gap-5">


                    {{-- =================================================
                        Branch
                    ================================================== --}}

                    <div>

                        <label class="block text-xs sm:text-sm
                                      font-medium text-slate-700 mb-1">

                            Branch
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="branch_id"
                                required
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100
                                       outline-none">

                            <option value="">
                                Select Branch
                            </option>

                            @foreach($branches as $branch)

                                <option value="{{ $branch->id }}"
                                    {{ old(
                                        'branch_id',
                                        $attendance->branch_id
                                    ) == $branch->id ? 'selected' : '' }}>

                                    {{ $branch->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- =================================================
                        Academic Session
                    ================================================== --}}

                    <div>

                        <label class="block text-xs sm:text-sm
                                      font-medium text-slate-700 mb-1">

                            Academic Session
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="academic_session_id"
                                required
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100
                                       outline-none">

                            <option value="">
                                Select Session
                            </option>

                            @foreach($academicSessions as $session)

                                <option value="{{ $session->id }}"
                                    {{ old(
                                        'academic_session_id',
                                        $attendance->academic_session_id
                                    ) == $session->id ? 'selected' : '' }}>

                                    {{ $session->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- =================================================
                        Class
                    ================================================== --}}

                    <div>

                        <label class="block text-xs sm:text-sm
                                      font-medium text-slate-700 mb-1">

                            Class
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="school_class_id"
                                required
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100
                                       outline-none">

                            <option value="">
                                Select Class
                            </option>

                            @foreach($schoolClasses as $class)

                                <option value="{{ $class->id }}"
                                    {{ old(
                                        'school_class_id',
                                        $attendance->school_class_id
                                    ) == $class->id ? 'selected' : '' }}>

                                    {{ $class->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- =================================================
                        Section
                    ================================================== --}}

                    <div>

                        <label class="block text-xs sm:text-sm
                                      font-medium text-slate-700 mb-1">

                            Section
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="section_id"
                                required
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100
                                       outline-none">

                            <option value="">
                                Select Section
                            </option>

                            @foreach($sections as $section)

                                <option value="{{ $section->id }}"
                                    {{ old(
                                        'section_id',
                                        $attendance->section_id
                                    ) == $section->id ? 'selected' : '' }}>

                                    {{ $section->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- =================================================
                        Date
                    ================================================== --}}

                    <div>

                        <label class="block text-xs sm:text-sm
                                      font-medium text-slate-700 mb-1">

                            Attendance Date
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="date"
                               name="date"
                               required
                               value="{{ old(
                                   'date',
                                   optional($attendance->date)->format('Y-m-d')
                               ) }}"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white
                                      px-3 py-2.5
                                      text-sm
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100
                                      outline-none">

                    </div>


                    {{-- =================================================
                        Status
                    ================================================== --}}

                    <div>

                        <label class="block text-xs sm:text-sm
                                      font-medium text-slate-700 mb-1">

                            Status
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="status"
                                required
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100
                                       outline-none">

                            <option value="present"
                                {{ old(
                                    'status',
                                    $attendance->status
                                ) === 'present' ? 'selected' : '' }}>

                                Present

                            </option>

                            <option value="absent"
                                {{ old(
                                    'status',
                                    $attendance->status
                                ) === 'absent' ? 'selected' : '' }}>

                                Absent

                            </option>

                            <option value="late"
                                {{ old(
                                    'status',
                                    $attendance->status
                                ) === 'late' ? 'selected' : '' }}>

                                Late

                            </option>

                            <option value="leave"
                                {{ old(
                                    'status',
                                    $attendance->status
                                ) === 'leave' ? 'selected' : '' }}>

                                Leave

                            </option>

                        </select>

                    </div>


                    {{-- =================================================
                        In Time
                    ================================================== --}}

                    <div>

                        <label class="block text-xs sm:text-sm
                                      font-medium text-slate-700 mb-1">

                            In Time

                        </label>

                        <input type="time"
                               name="in_time"
                               value="{{ old(
                                   'in_time',
                                   $attendance->in_time
                               ) }}"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white
                                      px-3 py-2.5
                                      text-sm
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100
                                      outline-none">

                    </div>


                    {{-- =================================================
                        Out Time
                    ================================================== --}}

                    <div>

                        <label class="block text-xs sm:text-sm
                                      font-medium text-slate-700 mb-1">

                            Out Time

                        </label>

                        <input type="time"
                               name="out_time"
                               value="{{ old(
                                   'out_time',
                                   $attendance->out_time
                               ) }}"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white
                                      px-3 py-2.5
                                      text-sm
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100
                                      outline-none">

                    </div>


                    {{-- =================================================
                        Remarks
                    ================================================== --}}

                    <div class="sm:col-span-2 lg:col-span-3">

                        <label class="block text-xs sm:text-sm
                                      font-medium text-slate-700 mb-1">

                            Remarks

                        </label>

                        <textarea name="remarks"
                                  rows="3"
                                  maxlength="500"
                                  placeholder="Enter remarks..."
                                  class="w-full rounded-lg
                                         border border-slate-300
                                         bg-white
                                         px-3 py-2.5
                                         text-sm
                                         resize-none
                                         focus:border-blue-500
                                         focus:ring-2
                                         focus:ring-blue-100
                                         outline-none">{{ old(
                                             'remarks',
                                             $attendance->remarks
                                         ) }}</textarea>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                Footer
            ========================================================== --}}

            <div class="px-4 sm:px-6 py-4
                        border-t border-slate-200
                        bg-slate-50
                        flex flex-col sm:flex-row
                        sm:justify-end
                        gap-2.5">

                <a href="{{ route(
                    'admin.attendance.student-history',
                    ['student_id' => $attendance->student_id]
                ) }}"
                   class="w-full sm:w-auto
                          inline-flex items-center
                          justify-center gap-2
                          px-5 py-2.5 rounded-lg
                          bg-white
                          border border-slate-300
                          text-slate-700
                          text-sm font-medium
                          hover:bg-slate-100 transition">

                    Cancel

                </a>


                <button type="submit"
                        class="w-full sm:w-auto
                               inline-flex items-center
                               justify-center gap-2
                               px-6 py-2.5 rounded-lg
                               bg-blue-600
                               text-white
                               text-sm font-medium
                               hover:bg-blue-700 transition">

                    <i class="bi bi-check2-circle"></i>

                    Update Attendance

                </button>

            </div>

        </form>

    </div>

</div>

@endsection