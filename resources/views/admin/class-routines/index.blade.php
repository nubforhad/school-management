@extends('admin.layouts.app')

@section('title', 'Class Routine')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Class Routine
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Manage class schedules and timetables.
            </p>
        </div>

        <a href="{{ route('admin.class-routines.create') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5
                  bg-blue-600 hover:bg-blue-700
                  text-white rounded-lg
                  text-sm font-medium">
            + Add Routine
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="bg-green-50 border border-green-200
                    text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>

    @endif


    {{-- Error Message --}}
    @if($errors->any())

        <div class="bg-red-50 border border-red-200
                    text-red-700 px-4 py-3 rounded-lg">

            <ul class="list-disc ml-5 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    {{-- Filters --}}
    <div class="bg-white border border-slate-200
                rounded-xl shadow-sm">

        <form method="GET"
              action="{{ route('admin.class-routines.index') }}"
              class="p-5">

            <div class="grid grid-cols-1 md:grid-cols-2
                        lg:grid-cols-4 gap-4">

                {{-- Search --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1">
                        Search
                    </label>

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Subject, teacher, room..."
                           class="w-full rounded-lg
                                  border-slate-300
                                  focus:border-blue-500
                                  focus:ring-blue-500">

                </div>


                {{-- Branch --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1">
                        Branch
                    </label>

                    <select name="branch_id"
                            class="w-full rounded-lg
                                   border-slate-300
                                   focus:border-blue-500
                                   focus:ring-blue-500">

                        <option value="">
                            All Branches
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

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1">
                        Academic Session
                    </label>

                    <select name="academic_session_id"
                            class="w-full rounded-lg
                                   border-slate-300
                                   focus:border-blue-500
                                   focus:ring-blue-500">

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
                                  text-slate-700 mb-1">
                        Class
                    </label>

                    <select name="school_class_id"
                            class="w-full rounded-lg
                                   border-slate-300
                                   focus:border-blue-500
                                   focus:ring-blue-500">

                        <option value="">
                            All Classes
                        </option>

                        @foreach($schoolClasses as $class)

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
                                  text-slate-700 mb-1">
                        Section
                    </label>

                    <select name="section_id"
                            class="w-full rounded-lg
                                   border-slate-300
                                   focus:border-blue-500
                                   focus:ring-blue-500">

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


                {{-- Day --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1">
                        Day
                    </label>

                    <select name="day"
                            class="w-full rounded-lg
                                   border-slate-300
                                   focus:border-blue-500
                                   focus:ring-blue-500">

                        <option value="">
                            All Days
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
                                {{ request('day') == $day ? 'selected' : '' }}>

                                {{ $day }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Status --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1">
                        Status
                    </label>

                    <select name="status"
                            class="w-full rounded-lg
                                   border-slate-300
                                   focus:border-blue-500
                                   focus:ring-blue-500">

                        <option value="">
                            All Status
                        </option>

                        <option value="1"
                            {{ request('status') === '1' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ request('status') === '0' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>


                {{-- Buttons --}}
                <div class="flex items-end gap-2">

                    <button type="submit"
                            class="px-4 py-2.5
                                   bg-blue-600 hover:bg-blue-700
                                   text-white rounded-lg
                                   text-sm font-medium">
                        Search
                    </button>

                    <a href="{{ route('admin.class-routines.index') }}"
                       class="px-4 py-2.5
                              bg-slate-100 hover:bg-slate-200
                              text-slate-700 rounded-lg
                              text-sm font-medium">
                        Reset
                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- Routine Table --}}
    <div class="bg-white border border-slate-200
                rounded-xl shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-200">

            <div class="flex items-center justify-between">

                <div>
                    <h2 class="text-lg font-bold text-slate-800">
                        Routine List
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        {{ $routines->total() }} routine(s) found.
                    </p>
                </div>

            </div>

        </div>


        @if($routines->count())

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-6 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                #
                            </th>

                            <th class="px-6 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                Class / Section
                            </th>

                            <th class="px-6 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                Subject
                            </th>

                            <th class="px-6 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                Teacher
                            </th>

                            <th class="px-6 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                Day
                            </th>

                            <th class="px-6 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                Time
                            </th>

                            <th class="px-6 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                Room
                            </th>

                            <th class="px-6 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                Status
                            </th>

                            <th class="px-6 py-3 text-right text-xs
                                       font-semibold text-slate-500 uppercase">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @foreach($routines as $index => $routine)

                            <tr class="hover:bg-slate-50">

                                {{-- # --}}
                                <td class="px-6 py-4 text-sm text-slate-500">

                                    {{ $routines->firstItem() + $index }}

                                </td>


                                {{-- Class --}}
                                <td class="px-6 py-4">

                                    <p class="text-sm font-semibold
                                              text-slate-800">

                                        {{ $routine->schoolClass->name ?? '—' }}

                                    </p>

                                    <p class="text-xs text-slate-500 mt-1">

                                        Section:
                                        {{ $routine->section->name ?? '—' }}

                                    </p>

                                    <p class="text-xs text-slate-400 mt-1">

                                        {{ $routine->branch->name ?? '—' }}

                                    </p>

                                </td>


                                {{-- Subject --}}
                                <td class="px-6 py-4">

                                    <span class="text-sm font-medium
                                                 text-slate-700">

                                        {{ $routine->subject->name ?? '—' }}

                                    </span>

                                </td>


                                {{-- Teacher --}}
                                <td class="px-6 py-4">

                                    <span class="text-sm text-slate-700">

                                        {{ $routine->teacher->name ?? '—' }}

                                    </span>

                                </td>


                                {{-- Day --}}
                                <td class="px-6 py-4">

                                    <span class="inline-flex
                                                 px-2.5 py-1
                                                 rounded-full
                                                 bg-blue-50 text-blue-700
                                                 text-xs font-semibold">
                                        {{ $routine->day }}
                                    </span>
                                </td>
                                {{-- Time --}}
                                <td class="px-6 py-4">

                                    <div class="text-sm font-medium
                                                text-slate-700">
                                        {{ \Carbon\Carbon::parse($routine->start_time)->format('h:i A') }}
                                    </div>
                                    <div class="text-xs text-slate-400">
                                        to
                                        {{ \Carbon\Carbon::parse($routine->end_time)->format('h:i A') }}
                                    </div>
                                </td>


                                {{-- Room --}}
                                <td class="px-6 py-4">
                                    <span class="text-sm text-slate-600">
                                        {{ $routine->room ?: '—' }}
                                    </span>
                                </td>
                                {{-- Status --}}
                                <td class="px-6 py-4">

                                    @if($routine->status)

                                        <span class="inline-flex
                                                     px-2.5 py-1
                                                     rounded-full
                                                     bg-green-50 text-green-700
                                                     text-xs font-semibold">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex
                                                     px-2.5 py-1
                                                     rounded-full
                                                     bg-red-50 text-red-700
                                                     text-xs font-semibold">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                {{-- Actions --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center
                                                justify-end gap-2">

                                        {{-- View --}}
                                        <a href="{{ route('admin.class-routines.show', $classRoutine = $routine) }}"
                                           class="px-3 py-1.5
                                                  rounded-lg
                                                  bg-blue-50
                                                  text-blue-700
                                                  hover:bg-blue-100
                                                  text-xs font-medium">
                                            View
                                        </a>
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.class-routines.edit', $routine) }}"
                                           class="px-3 py-1.5
                                                  rounded-lg
                                                  bg-amber-50
                                                  text-amber-700
                                                  hover:bg-amber-100
                                                  text-xs font-medium">
                                            Edit
                                        </a>
                                        {{-- Delete --}}
                                        <form action="{{ route('admin.class-routines.destroy', $routine) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this routine?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1.5
                                                           rounded-lg
                                                           bg-red-50
                                                           text-red-700
                                                           hover:bg-red-100
                                                           text-xs font-medium">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $routines->links() }}
            </div>
        @else

            {{-- Empty --}}
            <div class="px-6 py-12 text-center">

                <div class="mx-auto w-14 h-14 rounded-full bg-slate-100
                            flex items-center justify-center">
                    <span class="text-2xl">
                        📅
                    </span>
                </div>
                <h3 class="mt-4 text-sm font-semibold text-slate-700">
                    No routine found
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Create a class routine to see it here.
                </p>

                <a href="{{ route('admin.class-routines.create') }}"
                   class="inline-flex mt-4
                          px-4 py-2
                          bg-blue-600 hover:bg-blue-700
                          text-white rounded-lg
                          text-sm font-medium">
                    + Add Routine
                </a>
            </div>
        @endif
    </div>
</div>

@endsection