@extends('admin.layouts.app')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Header --}}
    <div class="mb-4 sm:mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
            Daily Attendance
        </h1>

        <p class="text-xs sm:text-sm text-slate-500 mt-1">
            Take and manage student attendance
        </p>
    </div> 


    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-4 sm:mb-5 rounded-lg bg-green-50 border border-green-200
                    px-3 sm:px-4 py-2.5 sm:py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif


    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="mb-4 sm:mb-5 rounded-lg bg-red-50 border border-red-200
                    px-3 sm:px-4 py-2.5 sm:py-3 text-red-700">

            <ul class="list-disc list-inside text-xs sm:text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif


    {{-- Filter --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-3 sm:p-5 mb-4 sm:mb-6">

        <form method="GET"
              action="{{ route('admin.attendance.index') }}">

            <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">

                {{-- Branch --}}
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1">
                        Branch
                    </label>

                    <select name="branch_id"
                            onchange="this.form.submit()"
                            class="w-full rounded-lg border border-slate-300
                                   px-3 py-2 sm:py-2.5 text-sm"
                            required>

                        <option value="">
                            Select Branch
                        </option>

                        @foreach($branches as $branch)

                            <option value="{{ $branch->id }}"
                                {{ request('branch_id') == $branch->id ? 'selected' : '' }}>

                                {{ $branch->name }}

                            </option>

                        @endforeach

                    </select>
                </div>


                {{-- Academic Session --}}
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1">
                        Academic Session
                    </label>

                    <select name="academic_session_id"
                            onchange="this.form.submit()"
                            class="w-full rounded-lg border border-slate-300
                                   px-3 py-2 sm:py-2.5 text-sm"
                            required>

                        <option value="">
                            Select Session
                        </option>
                        @foreach($academicSessions as $session)
                            <option value="{{ $session->id }}"
                                {{ request('academic_session_id') == $session->id ? 'selected' : '' }}>
                                {{ $session->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- Class --}}
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1"> Class </label>

                    <select name="school_class_id"
                            onchange="this.form.submit()"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2 sm:py-2.5 text-sm" required>
                        <option value="">
                            Select Class
                        </option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}"
                                {{ request('school_class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- Section --}}
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1">
                        Section
                    </label>

                    <select name="section_id"
                            class="w-full rounded-lg border border-slate-300
                                   px-3 py-2 sm:py-2.5 text-sm"
                            required>

                        <option value="">
                            Select Section
                        </option>

                        @foreach($sections as $section)

                            <option value="{{ $section->id }}"
                                {{ request('section_id') == $section->id ? 'selected' : '' }}>

                                {{ $section->name }}

                            </option>

                        @endforeach

                    </select>
                </div>


                {{-- Date --}}
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1">
                        Date
                    </label>

                    <input type="date"
                           name="date"
                           value="{{ request('date', now()->format('Y-m-d')) }}"
                           class="w-full rounded-lg border border-slate-300
                                  px-3 py-2 sm:py-2.5 text-sm"
                           required>
                </div>

            </div>


            <div class="flex flex-col xs:flex-row flex-wrap gap-2.5 sm:gap-3 mt-4 sm:mt-5">

                <button type="submit"
                        class="w-full xs:w-auto px-5 py-2.5 rounded-lg bg-blue-600
                               text-sm text-white font-medium hover:bg-blue-700 text-center">

                    Load Students

                </button>

                <a href="{{ route('admin.attendance.index') }}"
                   class="w-full xs:w-auto px-5 py-2.5 rounded-lg bg-slate-100
                          text-sm text-slate-700 font-medium hover:bg-slate-200 text-center">

                    Reset

                </a>

            </div>

        </form>

    </div>


    {{-- Student Attendance --}}
    @if($students->count())

        <form method="POST"
              action="{{ route('admin.attendance.store') }}">

            @csrf

            <input type="hidden"
                   name="branch_id"
                   value="{{ request('branch_id') }}">

            <input type="hidden"
                   name="academic_session_id"
                   value="{{ request('academic_session_id') }}">

            <input type="hidden"
                   name="school_class_id"
                   value="{{ request('school_class_id') }}">

            <input type="hidden"
                   name="section_id"
                   value="{{ request('section_id') }}">

            <input type="hidden"
                   name="date"
                   value="{{ request('date', now()->format('Y-m-d')) }}">


            <div class="bg-white rounded-xl shadow-sm
                        border border-slate-200 overflow-hidden">

                {{-- Table Header --}}
                <div class="p-3 sm:p-5 border-b border-slate-200
                            flex flex-col sm:flex-row
                            sm:items-center sm:justify-between gap-3">

                    <div>
                        <h2 class="text-base sm:text-lg font-semibold text-slate-800">
                            Student Attendance
                        </h2>

                        <p class="text-xs sm:text-sm text-slate-500">
                            {{ $students->count() }} students
                        </p>
                    </div>


                    <button type="button"
                            onclick="markAllPresent()"
                            class="w-full sm:w-auto px-4 py-2 rounded-lg
                                   bg-green-600 text-sm text-white
                                   hover:bg-green-700">

                        Mark All Present

                    </button>

                </div>


                {{-- Table --}}
                <div class="overflow-x-auto -mx-px">

                    <table class="w-full text-xs sm:text-sm min-w-[720px]">

                        <thead class="bg-slate-50">

                            <tr>

                                <th class="px-2 sm:px-4 py-2.5 sm:py-3 text-left whitespace-nowrap">
                                    #
                                </th>

                                <th class="px-2 sm:px-4 py-2.5 sm:py-3 text-left whitespace-nowrap">
                                    Student
                                </th>

                                <th class="px-2 sm:px-4 py-2.5 sm:py-3 text-left whitespace-nowrap">
                                    Status
                                </th>

                                <th class="px-2 sm:px-4 py-2.5 sm:py-3 text-left whitespace-nowrap">
                                    In Time
                                </th>

                                <th class="px-2 sm:px-4 py-2.5 sm:py-3 text-left whitespace-nowrap">
                                    Out Time
                                </th>

                                <th class="px-2 sm:px-4 py-2.5 sm:py-3 text-left whitespace-nowrap">
                                    Remarks
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">
                            @foreach($students as $index => $student)
                                <tr>
                                    <td class="px-2 sm:px-4 py-2.5 sm:py-3">{{ $index + 1 }}</td>
                                    <td class="px-2 sm:px-4 py-2.5 sm:py-3">
                                        <div class="font-medium text-slate-800">
                                            {{ $student->name }}
                                        </div>
                                        <div class="text-xs text-slate-500">
                                            ID: {{ $student->student_id ?? $student->id }}
                                        </div>
                                    </td>
                                    {{-- Status --}}
                                    <td class="px-2 sm:px-4 py-2.5 sm:py-3">
                                        <input type="hidden"
                                               name="attendance[{{ $index }}][student_id]"
                                               value="{{ $student->id }}">
                                        <select name="attendance[{{ $index }}][status]"    class="attendance-status w-28 sm:w-32 rounded-lg  border border-slate-300  px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm">
                                            <option value="present">  Present  </option>
                                            <option value="absent">  Absent </option>
                                            <option value="late">  Late </option>
                                            <option value="leave">  Leave  </option>
                                        </select>
                                    </td>
                                    {{-- In --}}
                                    <td class="px-2 sm:px-4 py-2.5 sm:py-3">
                                        <input type="time"  name="attendance[{{ $index }}][in_time]"
                                               class="w-28 sm:w-32 rounded-lg border border-slate-300 px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm">
                                    </td>
                                    {{-- Out --}}
                                    <td class="px-2 sm:px-4 py-2.5 sm:py-3">
                                        <input type="time" name="attendance[{{ $index }}][out_time]" class="w-28 sm:w-32 rounded-lg border border-slate-300 px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm">
                                    </td>
                                    {{-- Remarks --}}
                                    <td class="px-2 sm:px-4 py-2.5 sm:py-3">
                                        <input type="text"
                                               name="attendance[{{ $index }}][remarks]"
                                               placeholder="Remarks"
                                               class="w-36 sm:w-48 rounded-lg border
                                                      border-slate-300 px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm">

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Submit --}}
                <div class="p-3 sm:p-5 border-t border-slate-200
                            flex justify-stretch sm:justify-end">

                    <button type="submit"
                            class="w-full sm:w-auto px-6 py-2.5 rounded-lg
                                   bg-blue-600 text-sm text-white
                                   font-medium hover:bg-blue-700">

                        Save Attendance

                    </button>

                </div>

            </div>

        </form>

    @elseif(
        request()->filled('branch_id') &&
        request()->filled('academic_session_id') &&
        request()->filled('school_class_id') &&
        request()->filled('section_id')
    )

        <div class="bg-yellow-50 border border-yellow-200
                    text-yellow-700 rounded-xl p-4 sm:p-5 text-sm">

            No active students found for this class and section.

        </div>

    @endif

</div>


<script>

function markAllPresent()
{
    document.querySelectorAll('.attendance-status')
        .forEach(function(select) {

            select.value = 'present';

        });
}

</script>

@endsection