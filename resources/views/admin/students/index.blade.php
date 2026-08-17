@extends('admin.layouts.app')

@section('title', 'Students')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Students
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage branch-wise students, admission and academic information.
            </p>
        </div>

        <a
            href="{{ route('admin.students.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl
                   bg-blue-600 px-5 py-3 text-sm font-semibold text-white
                   shadow-sm transition hover:bg-blue-700"
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4"
                />
            </svg>

            Add Student
        </a>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))

        <div
            class="flex items-start gap-3 rounded-xl border border-emerald-200
                   bg-emerald-50 px-4 py-4 text-emerald-800"
        >

            <svg
                class="mt-0.5 h-5 w-5 shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 13l4 4L19 7"
                />
            </svg>

            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- =========================================================
        VALIDATION / ERROR MESSAGE
    ========================================================== --}}
    @if($errors->any())

        <div
            class="rounded-xl border border-red-200
                   bg-red-50 px-4 py-4 text-red-700"
        >

            <p class="mb-2 font-semibold">
                Please fix the following errors:
            </p>

            <ul class="list-disc space-y-1 pl-5 text-sm">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        FILTER CARD
    ========================================================== --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-5 py-4">

            <div class="flex items-center gap-2">

                <svg
                    class="h-5 w-5 text-slate-500"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414V19l-4 2v-7.293L3.293 7.293A1 1 0 013 6.586V4z"
                    />
                </svg>

                <h2 class="font-semibold text-slate-800">
                    Filter Students
                </h2>

            </div>

        </div>


        <form
            method="GET"
            action="{{ route('admin.students.index') }}"
            class="p-5"
        >

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">


                {{-- Search --}}
                <div class="xl:col-span-2">

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Search
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Name, ID, admission no, roll..."
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-4 py-2.5 text-sm text-slate-800
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                </div>


                {{-- Branch --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Branch
                    </label>

                    <select
                        name="branch_id"
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-800
                               outline-none focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            All Branches
                        </option>

                        @foreach($branches as $branch)

                            <option
                                value="{{ $branch->id }}"
                                @selected(request('branch_id') == $branch->id)
                            >
                                {{ $branch->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Academic Session --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Session
                    </label>

                    <select
                        name="academic_session_id"
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-800
                               outline-none focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            All Sessions
                        </option>

                        @foreach($academicSessions as $session)

                            <option
                                value="{{ $session->id }}"
                                @selected(request('academic_session_id') == $session->id)
                            >
                                {{ $session->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Class --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Class
                    </label>

                    <select
                        name="class_id"
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-800
                               outline-none focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            All Classes
                        </option>

                        @foreach($classes as $class)

                            <option
                                value="{{ $class->id }}"
                                @selected(request('class_id') == $class->id)
                            >
                                {{ $class->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Section --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Section
                    </label>

                    <select
                        name="section_id"
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-800
                               outline-none focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            All Sections
                        </option>

                        @foreach($sections as $section)

                            <option
                                value="{{ $section->id }}"
                                @selected(request('section_id') == $section->id)
                            >
                                {{ $section->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Status --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-800
                               outline-none focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            All Status
                        </option>

                        <option
                            value="1"
                            @selected(request('status') === '1')
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            @selected(request('status') === '0')
                        >
                            Inactive
                        </option>

                    </select>

                </div>

            </div>


            {{-- Filter Buttons --}}
            <div class="mt-5 flex flex-col gap-2 sm:flex-row">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl bg-blue-600 px-5 py-2.5
                           text-sm font-semibold text-white
                           transition hover:bg-blue-700"
                >

                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                        />
                    </svg>

                    Apply Filter

                </button>


                <a
                    href="{{ route('admin.students.index') }}"
                    class="inline-flex items-center justify-center
                           rounded-xl border border-slate-300
                           bg-white px-5 py-2.5 text-sm font-semibold
                           text-slate-700 transition hover:bg-slate-50"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- =========================================================
        SUMMARY
    ========================================================== --}}
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <p class="text-sm text-slate-500">
                Total Students
            </p>

            <h3 class="mt-2 text-2xl font-bold text-slate-800">
                {{ $students->total() }}
            </h3>

        </div>


        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <p class="text-sm text-slate-500">
                Current Page
            </p>

            <h3 class="mt-2 text-2xl font-bold text-slate-800">
                {{ $students->count() }}
            </h3>

        </div>


        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <p class="text-sm text-slate-500">
                Page
            </p>

            <h3 class="mt-2 text-2xl font-bold text-slate-800">
                {{ $students->currentPage() }}
                <span class="text-sm font-normal text-slate-400">
                    / {{ $students->lastPage() }}
                </span>
            </h3>

        </div>


        <div class="hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm lg:block">

            <p class="text-sm text-slate-500">
                Per Page
            </p>

            <h3 class="mt-2 text-2xl font-bold text-slate-800">
                {{ $students->perPage() }}
            </h3>

        </div>

    </div>


    {{-- =========================================================
        DESKTOP TABLE
    ========================================================== --}}
    <div class="hidden overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:block">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Student
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Student ID
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Branch
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Class
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Section
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Roll
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                        <th class="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100 bg-white">

                    @forelse($students as $student)

                        <tr class="transition hover:bg-slate-50">

                            {{-- Student --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    @if($student->photo)

                                        <img
                                            src="{{ asset('storage/' . $student->photo) }}"
                                            alt="{{ $student->name }}"
                                            class="h-11 w-11 rounded-full object-cover ring-2 ring-slate-100"
                                        >

                                    @else

                                        <div
                                            class="flex h-11 w-11 items-center justify-center
                                                   rounded-full bg-blue-100
                                                   text-sm font-bold text-blue-700"
                                        >
                                            {{ strtoupper(substr($student->name, 0, 1)) }}
                                        </div>

                                    @endif


                                    <div class="min-w-0">

                                        <p class="truncate font-semibold text-slate-800">
                                            {{ $student->name }}
                                        </p>

                                        @if($student->name_bn)

                                            <p class="truncate text-xs text-slate-500">
                                                {{ $student->name_bn }}
                                            </p>

                                        @endif

                                        <p class="text-xs text-slate-400">
                                            Admission: {{ $student->admission_no }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Student ID --}}
                            <td class="px-5 py-4">

                                <span class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                    {{ $student->student_id }}
                                </span>

                            </td>


                            {{-- Branch --}}
                            <td class="px-5 py-4 text-sm text-slate-600">

                                {{ $student->branch?->name ?? '—' }}

                            </td>


                            {{-- Class --}}
                            <td class="px-5 py-4 text-sm font-medium text-slate-700">

                                {{ $student->schoolClass?->name ?? '—' }}

                            </td>


                            {{-- Section --}}
                            <td class="px-5 py-4 text-sm text-slate-600">

                                {{ $student->section?->name ?? '—' }}

                            </td>


                            {{-- Roll --}}
                            <td class="px-5 py-4 text-sm font-semibold text-slate-700">

                                {{ $student->roll_no ?? '—' }}

                            </td>


                            {{-- Status --}}
                            <td class="px-5 py-4">

                                @if($student->status)

                                    <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        Active
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-5 py-4">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('admin.students.show', $student) }}"
                                        title="View"
                                        class="inline-flex h-9 w-9 items-center justify-center
                                               rounded-lg border border-slate-200
                                               text-slate-600 transition
                                               hover:bg-slate-100"
                                    >
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                            />
                                        </svg>
                                    </a>
 

                                    <a  href="{{ route('admin.students.id-card', $student) }}"
                                        title="Student ID Card"
                                        class="inline-flex h-9 w-9 items-center justify-center
                                            rounded-lg border border-purple-200
                                            text-purple-600 transition
                                            hover:bg-purple-50"
                                    >
                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <rect
                                                x="3"
                                                y="5"
                                                width="18"
                                                height="14"
                                                rx="2"
                                                stroke-width="2"
                                            />

                                            <circle
                                                cx="8"
                                                cy="10"
                                                r="2"
                                                stroke-width="2"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5.5 15c.7-1.5 1.7-2.2 2.5-2.2s1.8.7 2.5 2.2M13 9h5M13 13h5"
                                            />
                                        </svg>
                                    </a>


                                    <a
                                        href="{{ route('admin.students.edit', $student) }}"
                                        title="Edit"
                                        class="inline-flex h-9 w-9 items-center justify-center
                                               rounded-lg border border-blue-200
                                               text-blue-600 transition
                                               hover:bg-blue-50"
                                    >
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                            />
                                        </svg>
                                    </a>

                                    


                                    <form
                                        method="POST"
                                        action="{{ route('admin.students.destroy', $student) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this student?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete"
                                            class="inline-flex h-9 w-9 items-center justify-center
                                                   rounded-lg border border-red-200
                                                   text-red-600 transition
                                                   hover:bg-red-50"
                                        >

                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                />
                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="px-5 py-16 text-center"
                            >

                                <div class="flex flex-col items-center">

                                    <div
                                        class="flex h-14 w-14 items-center justify-center
                                               rounded-full bg-slate-100"
                                    >

                                        <svg
                                            class="h-7 w-7 text-slate-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                            />
                                        </svg>

                                    </div>

                                    <h3 class="mt-4 font-semibold text-slate-700">
                                        No students found
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Try changing your filters or add a new student.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================================================
        MOBILE / TABLET CARDS
    ========================================================== --}}
    <div class="space-y-4 lg:hidden">

        @forelse($students as $student)

            <div
                class="rounded-2xl border border-slate-200
                       bg-white p-4 shadow-sm"
            >

                <div class="flex items-start gap-3">

                    @if($student->photo)

                        <img
                            src="{{ asset('storage/' . $student->photo) }}"
                            alt="{{ $student->name }}"
                            class="h-12 w-12 shrink-0 rounded-full object-cover"
                        >

                    @else

                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center
                                   rounded-full bg-blue-100
                                   font-bold text-blue-700"
                        >
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>

                    @endif


                    <div class="min-w-0 flex-1">

                        <div class="flex items-start justify-between gap-3">

                            <div>

                                <h3 class="font-semibold text-slate-800">
                                    {{ $student->name }}
                                </h3>

                                @if($student->name_bn)

                                    <p class="text-xs text-slate-500">
                                        {{ $student->name_bn }}
                                    </p>

                                @endif

                            </div>


                            @if($student->status)

                                <span class="shrink-0 rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                    Active
                                </span>

                            @else

                                <span class="shrink-0 rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                                    Inactive
                                </span>

                            @endif

                        </div>


                        <p class="mt-1 text-xs text-slate-400">
                            ID: {{ $student->student_id }}
                        </p>

                    </div>

                </div>


                <div class="mt-4 grid grid-cols-2 gap-3 border-t border-slate-100 pt-4">

                    <div>

                        <p class="text-xs text-slate-400">
                            Branch
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-700">
                            {{ $student->branch?->name ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-slate-400">
                            Admission No
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-700">
                            {{ $student->admission_no }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-slate-400">
                            Class
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-700">
                            {{ $student->schoolClass?->name ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-slate-400">
                            Section
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-700">
                            {{ $student->section?->name ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-slate-400">
                            Roll
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-700">
                            {{ $student->roll_no ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-slate-400">
                            Session
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-700">
                            {{ $student->academicSession?->name ?? '—' }}
                        </p>

                    </div>

                </div>


                {{-- Mobile Actions --}}
                <div class="mt-4 flex gap-2 border-t border-slate-100 pt-4">

                    <a
                        href="{{ route('admin.students.show', $student) }}"
                        class="flex flex-1 items-center justify-center
                               rounded-xl border border-slate-200
                               px-3 py-2.5 text-sm font-semibold
                               text-slate-700 hover:bg-slate-50"
                    >
                        View
                    </a>


                    <a
                        href="{{ route('admin.students.edit', $student) }}"
                        class="flex flex-1 items-center justify-center
                               rounded-xl bg-blue-600
                               px-3 py-2.5 text-sm font-semibold
                               text-white hover:bg-blue-700"
                    >
                        Edit
                    </a>


                    <form
                        method="POST"
                        action="{{ route('admin.students.destroy', $student) }}"
                        class="flex-1"
                        onsubmit="return confirm('Are you sure you want to delete this student?');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full rounded-xl border border-red-200
                                   px-3 py-2.5 text-sm font-semibold
                                   text-red-600 hover:bg-red-50"
                        >
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div
                class="rounded-2xl border border-slate-200
                       bg-white px-5 py-16 text-center shadow-sm"
            >

                <div
                    class="mx-auto flex h-14 w-14 items-center justify-center
                           rounded-full bg-slate-100"
                >

                    <svg
                        class="h-7 w-7 text-slate-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                        />
                    </svg>

                </div>

                <h3 class="mt-4 font-semibold text-slate-700">
                    No students found
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    No student matches the selected filters.
                </p>

            </div>

        @endforelse

    </div>


    {{-- =========================================================
        PAGINATION
    ========================================================== --}}
    @if($students->hasPages())

        <div class="rounded-2xl border border-slate-200 bg-white px-4 py-4 shadow-sm">

            {{ $students->links() }}

        </div>

    @endif

</div>

@endsection