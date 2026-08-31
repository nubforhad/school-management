@extends('admin.layouts.app')

@section('title', 'Teacher Assignment')

@section('page-title', 'Teacher Assignment')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Page Header --}}
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                Teacher Assignment
            </h1>

            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Assign teachers to classes, sections and subjects
            </p>
        </div>

        <a href="{{ route('admin.teacher-assignment.create') }}"
           class="inline-flex items-center justify-center gap-2
                  rounded-lg bg-blue-600
                  px-4 py-2.5
                  text-sm font-semibold text-white
                  hover:bg-blue-700 transition">

            <i class="bi bi-plus-lg"></i>

            Add Assignment
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="mb-5 rounded-lg border border-green-200
                    bg-green-50 px-4 py-3">

            <div class="flex items-center gap-3">

                <div class="flex h-8 w-8 items-center justify-center
                            rounded-full bg-green-100 text-green-600">

                    <i class="bi bi-check-circle"></i>

                </div>

                <p class="text-sm font-medium text-green-700">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- Filters --}}
    <div class="mb-5 bg-white rounded-xl border border-slate-200 shadow-sm">

        <div class="px-4 sm:px-6 py-4 bg-slate-50 border-b border-slate-200">

            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center
                            rounded-lg bg-blue-50 text-blue-600">

                    <i class="bi bi-funnel"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Filter Assignments
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Search teacher assignments
                    </p>

                </div>

            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.teacher-assignment.index') }}"
              class="p-4 sm:p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">


                {{-- Teacher --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Teacher / Staff

                    </label>

                    <select name="teacher_staff_id"
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white px-3 py-2.5
                                   text-sm text-slate-700
                                   outline-none
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100">

                        <option value="">
                            All Teachers
                        </option>

                        @foreach($teachers as $teacher)

                            <option value="{{ $teacher->id }}"
                                {{ request('teacher_staff_id') == $teacher->id ? 'selected' : '' }}>

                                {{ $teacher->name }}

                                @if($teacher->employee_id)
                                    ({{ $teacher->employee_id }})
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Academic Session --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Academic Session

                    </label>

                    <select name="academic_session_id"
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white px-3 py-2.5
                                   text-sm text-slate-700
                                   outline-none
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100">

                        <option value="">
                            All Sessions
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

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Class

                    </label>

                    <select name="school_class_id"
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white px-3 py-2.5
                                   text-sm text-slate-700
                                   outline-none
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100">

                        <option value="">
                            All Classes
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

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Section

                    </label>

                    <select name="section_id"
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white px-3 py-2.5
                                   text-sm text-slate-700
                                   outline-none
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100">

                        <option value="">
                            All Sections
                        </option>

                        @foreach($sections as $section)

                            <option value="{{ $section->id }}"
                                {{ request('section_id') == $section->id ? 'selected' : '' }}>

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

                    </label>

                    <select name="subject_id"
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white px-3 py-2.5
                                   text-sm text-slate-700
                                   outline-none
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100">

                        <option value="">
                            All Subjects
                        </option>

                        @foreach($subjects as $subject)

                            <option value="{{ $subject->id }}"
                                {{ request('subject_id') == $subject->id ? 'selected' : '' }}>

                                {{ $subject->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Buttons --}}
                <div class="flex items-end gap-2">

                    <button type="submit"
                            class="inline-flex items-center justify-center
                                   gap-2 rounded-lg
                                   bg-blue-600
                                   px-4 py-2.5
                                   text-sm font-semibold text-white
                                   hover:bg-blue-700 transition">

                        <i class="bi bi-search"></i>

                        Search

                    </button>


                    <a href="{{ route('admin.teacher-assignment.index') }}"
                       class="inline-flex items-center justify-center
                              gap-2 rounded-lg
                              border border-slate-300
                              bg-white
                              px-4 py-2.5
                              text-sm font-medium text-slate-600
                              hover:bg-slate-100 transition">

                        <i class="bi bi-arrow-counterclockwise"></i>

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- Assignment Table --}}
    <div class="bg-white rounded-xl border border-slate-200
                shadow-sm overflow-hidden">

        {{-- Table Header --}}
        <div class="px-4 sm:px-6 py-4 bg-slate-50
                    border-b border-slate-200">

            <div class="flex flex-col sm:flex-row
                        sm:items-center sm:justify-between gap-2">

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Teacher Assignments
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Total {{ $teacherAssignments->total() }} assignments
                    </p>

                </div>

            </div>

        </div>


        {{-- Responsive Table --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600 whitespace-nowrap">
                            #
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Teacher / Staff
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Academic Session
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Class
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Section
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Subject
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Class Teacher
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Status
                        </th>

                        <th class="px-4 py-3 text-right
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($teacherAssignments as $assignment)

                        <tr class="hover:bg-slate-50 transition">

                            {{-- # --}}
                            <td class="px-4 py-3 text-slate-500">

                                {{ $loop->iteration + (($teacherAssignments->currentPage() - 1) * $teacherAssignments->perPage()) }}

                            </td>


                            {{-- Teacher --}}
                            <td class="px-4 py-3">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0
                                                items-center justify-center
                                                rounded-full
                                                bg-blue-50
                                                text-blue-600">

                                        <i class="bi bi-person"></i>

                                    </div>

                                    <div>

                                        <p class="font-medium text-slate-800">

                                            {{ $assignment->teacherStaff->name ?? '—' }}

                                        </p>

                                        @if($assignment->teacherStaff?->employee_id)

                                            <p class="text-xs text-slate-400">

                                                {{ $assignment->teacherStaff->employee_id }}

                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Academic Session --}}
                            <td class="px-4 py-3 text-slate-600">

                                {{ $assignment->academicSession->name ?? '—' }}

                            </td>


                            {{-- Class --}}
                            <td class="px-4 py-3 text-slate-600">

                                {{ $assignment->schoolClass->name ?? '—' }}

                            </td>


                            {{-- Section --}}
                            <td class="px-4 py-3 text-slate-600">

                                {{ $assignment->section->name ?? '—' }}

                            </td>


                            {{-- Subject --}}
                            <td class="px-4 py-3">

                                <span class="inline-flex items-center
                                             rounded-md
                                             bg-blue-50
                                             px-2.5 py-1
                                             text-xs font-medium
                                             text-blue-700">

                                    {{ $assignment->subject->name ?? '—' }}

                                </span>

                            </td>


                            {{-- Class Teacher --}}
                            <td class="px-4 py-3">

                                @if($assignment->is_class_teacher)

                                    <span class="inline-flex items-center gap-1
                                                 rounded-full
                                                 bg-green-50
                                                 px-2.5 py-1
                                                 text-xs font-medium
                                                 text-green-700">

                                        <i class="bi bi-check-circle"></i>

                                        Yes

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1
                                                 rounded-full
                                                 bg-slate-100
                                                 px-2.5 py-1
                                                 text-xs font-medium
                                                 text-slate-500">

                                        No

                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-4 py-3">

                                @if($assignment->status)

                                    <span class="inline-flex items-center
                                                 rounded-full
                                                 bg-green-50
                                                 px-2.5 py-1
                                                 text-xs font-medium
                                                 text-green-700">

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center
                                                 rounded-full
                                                 bg-red-50
                                                 px-2.5 py-1
                                                 text-xs font-medium
                                                 text-red-700">

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-4 py-3">

                                <div class="flex items-center
                                            justify-end gap-2">


                                    {{-- Edit --}}
                                    <a href="{{ route('admin.teacher-assignment.edit', $assignment->id) }}"
                                       class="inline-flex items-center justify-center
                                              h-9 w-9 rounded-lg
                                              bg-blue-50
                                              text-blue-600
                                              hover:bg-blue-100 transition"
                                       title="Edit">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>


                                    {{-- Delete --}}
                                    <form action="{{ route('admin.teacher-assignment.destroy', $assignment->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this assignment?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="inline-flex items-center justify-center
                                                       h-9 w-9 rounded-lg
                                                       bg-red-50
                                                       text-red-600
                                                       hover:bg-red-100 transition"
                                                title="Delete">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9"
                                class="px-4 py-12 text-center">

                                <div class="flex flex-col
                                            items-center justify-center">

                                    <div class="flex h-14 w-14
                                                items-center justify-center
                                                rounded-full
                                                bg-slate-100
                                                text-slate-400">

                                        <i class="bi bi-person-workspace text-2xl"></i>

                                    </div>

                                    <h3 class="mt-3
                                               text-sm font-semibold
                                               text-slate-700">

                                        No Teacher Assignments Found

                                    </h3>

                                    <p class="mt-1 text-xs text-slate-500">

                                        Create an assignment to assign a teacher
                                        to a class, section and subject.

                                    </p>

                                    <a href="{{ route('admin.teacher-assignment.create') }}"
                                       class="mt-4 inline-flex items-center
                                              gap-2 rounded-lg
                                              bg-blue-600 px-4 py-2
                                              text-sm font-medium text-white
                                              hover:bg-blue-700 transition">

                                        <i class="bi bi-plus-lg"></i>

                                        Add Assignment

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($teacherAssignments->hasPages())

            <div class="px-4 sm:px-6 py-4
                        border-t border-slate-200">

                {{ $teacherAssignments->links() }}

            </div>

        @endif

    </div>

</div>

@endsection 
