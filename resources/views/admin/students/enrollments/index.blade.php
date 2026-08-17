@extends('admin.layouts.app')

@section('title', 'Student Enrollments')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Student Enrollments
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage branch-wise student academic enrollments.
            </p>
        </div>

        <a
            href="{{ route('admin.students.enrollments.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl
                   bg-blue-600 px-4 py-2.5 text-sm font-semibold
                   text-white shadow-sm transition hover:bg-blue-700"
        >
            <svg
                class="h-5 w-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4"
                />
            </svg>

            New Enrollment
        </a>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))

        <div
            class="flex items-center gap-3 rounded-xl border border-emerald-200
                   bg-emerald-50 px-4 py-3 text-sm text-emerald-700"
        >
            <svg
                class="h-5 w-5 shrink-0"
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

            <span>{{ session('success') }}</span>
        </div>

    @endif


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 p-4">

            <div class="flex gap-3">

                <svg
                    class="mt-0.5 h-5 w-5 shrink-0 text-red-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v4m0 4h.01M10.29 3.86l-7.4 12.8A2 2 0 004.63 20h14.74a2 2 0 001.74-3.34l-7.4-12.8a2 2 0 00-3.42 0z"
                    />
                </svg>

                <div>

                    <p class="font-semibold text-red-700">
                        Please check the following:
                    </p>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-600">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        FILTER
    ========================================================== --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-4">

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
                        d="M3 4h18M6 12h12M10 20h4"
                    />
                </svg>

                <h2 class="font-semibold text-slate-800">
                    Filter Enrollments
                </h2>

            </div>

        </div>


        <form
            method="GET"
            action="{{ route('admin.students.enrollments.index') }}"
            class="p-5"
        >

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">

                {{-- Branch --}}
                <div>

                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Branch
                    </label>

                    <select
                        name="branch_id"
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-700
                               outline-none transition
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
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

                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Academic Session
                    </label>

                    <select
                        name="academic_session_id"
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-700
                               outline-none transition
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
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

                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Class
                    </label>

                    <select
                        name="class_id"
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-700
                               outline-none transition
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
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

                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Section
                    </label>

                    <select
                        name="section_id"
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-700
                               outline-none transition
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            All Sections
                        </option>

                        @foreach(\App\Models\Section::where('status', true)->orderBy('name')->get() as $section)

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

                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-700
                               outline-none transition
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            All Status
                        </option>

                        <option
                            value="active"
                            @selected(request('status') === 'active')
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            @selected(request('status') === 'inactive')
                        >
                            Inactive
                        </option>

                        <option
                            value="completed"
                            @selected(request('status') === 'completed')
                        >
                            Completed
                        </option>

                        <option
                            value="transferred"
                            @selected(request('status') === 'transferred')
                        >
                            Transferred
                        </option>

                    </select>

                </div>

            </div>


            {{-- Filter Buttons --}}
            <div class="mt-4 flex flex-wrap gap-2">

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-xl
                           bg-slate-800 px-4 py-2.5 text-sm font-semibold
                           text-white transition hover:bg-slate-900"
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
                            d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>

                    Apply Filter
                </button>


                <a
                    href="{{ route('admin.students.enrollments.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl
                           border border-slate-200 bg-white
                           px-4 py-2.5 text-sm font-semibold
                           text-slate-600 transition hover:bg-slate-50"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- =========================================================
        DESKTOP TABLE
    ========================================================== --}}
    <div class="hidden overflow-hidden rounded-2xl border border-slate-200
                bg-white shadow-sm lg:block">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-5 py-3 text-left text-xs font-semibold
                                   uppercase tracking-wider text-slate-500">
                            Student
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold
                                   uppercase tracking-wider text-slate-500">
                            Branch
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold
                                   uppercase tracking-wider text-slate-500">
                            Session
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold
                                   uppercase tracking-wider text-slate-500">
                            Class
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold
                                   uppercase tracking-wider text-slate-500">
                            Section
                        </th>

                        <th class="px-5 py-3 text-center text-xs font-semibold
                                   uppercase tracking-wider text-slate-500">
                            Roll
                        </th>

                        <th class="px-5 py-3 text-center text-xs font-semibold
                                   uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                        <th class="px-5 py-3 text-right text-xs font-semibold
                                   uppercase tracking-wider text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100 bg-white">

                    @forelse($enrollments as $enrollment)

                        <tr class="transition hover:bg-slate-50">

                            {{-- Student --}}
                            <td class="whitespace-nowrap px-5 py-4">

                                <div class="flex items-center gap-3">

                                    @if($enrollment->student?->photo)

                                        <img
                                            src="{{ asset('storage/' . $enrollment->student->photo) }}"
                                            alt="{{ $enrollment->student->name }}"
                                            class="h-10 w-10 rounded-full object-cover"
                                        >

                                    @else

                                        <div
                                            class="flex h-10 w-10 items-center justify-center
                                                   rounded-full bg-blue-100
                                                   font-semibold text-blue-700"
                                        >
                                            {{ strtoupper(substr($enrollment->student?->name ?? 'S', 0, 1)) }}
                                        </div>

                                    @endif

                                    <div>

                                        <p class="font-semibold text-slate-800">
                                            {{ $enrollment->student?->name ?? 'N/A' }}
                                        </p>

                                        @if($enrollment->student?->student_id)

                                            <p class="text-xs text-slate-500">
                                                ID: {{ $enrollment->student->student_id }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Branch --}}
                            <td class="px-5 py-4 text-sm text-slate-600">

                                {{ $enrollment->branch?->name ?? 'N/A' }}

                            </td>


                            {{-- Session --}}
                            <td class="px-5 py-4 text-sm text-slate-600">

                                {{ $enrollment->academicSession?->name ?? 'N/A' }}

                            </td>


                            {{-- Class --}}
                            <td class="px-5 py-4 text-sm font-medium text-slate-700">

                                {{ $enrollment->schoolClass?->name ?? 'N/A' }}

                            </td>


                            {{-- Section --}}
                            <td class="px-5 py-4 text-sm text-slate-600">

                                {{ $enrollment->section?->name ?? 'N/A' }}

                            </td>


                            {{-- Roll --}}
                            <td class="px-5 py-4 text-center text-sm font-semibold text-slate-700">

                                {{ $enrollment->roll_no ?? '-' }}

                            </td>


                            {{-- Status --}}
                            <td class="px-5 py-4 text-center">

                                @php
                                    $statusClasses = [
                                        'active' =>
                                            'bg-emerald-50 text-emerald-700 border-emerald-200',

                                        'inactive' =>
                                            'bg-slate-50 text-slate-600 border-slate-200',

                                        'completed' =>
                                            'bg-blue-50 text-blue-700 border-blue-200',

                                        'transferred' =>
                                            'bg-amber-50 text-amber-700 border-amber-200',
                                    ];
                                @endphp

                                <span
                                    class="inline-flex rounded-full border px-2.5 py-1
                                           text-xs font-semibold
                                           {{ $statusClasses[$enrollment->status] ?? 'bg-slate-50 text-slate-600 border-slate-200' }}"
                                >
                                    {{ ucfirst($enrollment->status) }}
                                </span>

                            </td>


                            {{-- Actions --}}
                            <td class="px-5 py-4">

                                <div class="flex justify-end gap-2">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('admin.students.enrollments.show', $enrollment) }}"
                                        title="View"
                                        class="inline-flex h-9 w-9 items-center justify-center
                                               rounded-lg border border-slate-200
                                               text-slate-600 transition
                                               hover:bg-slate-100"
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


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('admin.students.enrollments.edit', $enrollment) }}"
                                        title="Edit"
                                        class="inline-flex h-9 w-9 items-center justify-center
                                               rounded-lg border border-blue-200
                                               text-blue-600 transition
                                               hover:bg-blue-50"
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
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 8.5-8.5z"
                                            />
                                        </svg>
                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('admin.students.enrollments.destroy', $enrollment) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this enrollment?');"
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
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10"
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
                                class="px-5 py-14 text-center"
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
                                                d="M12 6v12m6-6H6"
                                            />
                                        </svg>
                                    </div>

                                    <h3 class="mt-4 font-semibold text-slate-700">
                                        No enrollments found
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Create a new student enrollment to get started.
                                    </p>

                                    <a
                                        href="{{ route('admin.students.enrollments.create') }}"
                                        class="mt-4 rounded-xl bg-blue-600
                                               px-4 py-2.5 text-sm font-semibold
                                               text-white hover:bg-blue-700"
                                    >
                                        New Enrollment
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($enrollments->hasPages())

            <div class="border-t border-slate-100 px-5 py-4">
                {{ $enrollments->links() }}
            </div>

        @endif

    </div>


    {{-- =========================================================
        MOBILE CARDS
    ========================================================== --}}
    <div class="space-y-4 lg:hidden">

        @forelse($enrollments as $enrollment)

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                {{-- Header --}}
                <div class="flex items-start justify-between gap-3">

                    <div class="flex items-center gap-3">

                        @if($enrollment->student?->photo)

                            <img
                                src="{{ asset('storage/' . $enrollment->student->photo) }}"
                                alt="{{ $enrollment->student->name }}"
                                class="h-11 w-11 rounded-full object-cover"
                            >

                        @else

                            <div
                                class="flex h-11 w-11 shrink-0 items-center
                                       justify-center rounded-full bg-blue-100
                                       font-semibold text-blue-700"
                            >
                                {{ strtoupper(substr($enrollment->student?->name ?? 'S', 0, 1)) }}
                            </div>

                        @endif


                        <div>

                            <h3 class="font-semibold text-slate-800">
                                {{ $enrollment->student?->name ?? 'N/A' }}
                            </h3>

                            <p class="text-xs text-slate-500">
                                {{ $enrollment->branch?->name ?? 'N/A' }}
                            </p>

                        </div>

                    </div>


                    @php
                        $mobileStatusClasses = [
                            'active' =>
                                'bg-emerald-50 text-emerald-700 border-emerald-200',

                            'inactive' =>
                                'bg-slate-50 text-slate-600 border-slate-200',

                            'completed' =>
                                'bg-blue-50 text-blue-700 border-blue-200',

                            'transferred' =>
                                'bg-amber-50 text-amber-700 border-amber-200',
                        ];
                    @endphp

                    <span
                        class="rounded-full border px-2.5 py-1
                               text-xs font-semibold
                               {{ $mobileStatusClasses[$enrollment->status] ?? 'bg-slate-50 text-slate-600 border-slate-200' }}"
                    >
                        {{ ucfirst($enrollment->status) }}
                    </span>

                </div>


                {{-- Information --}}
                <div class="mt-4 grid grid-cols-2 gap-3">

                    <div class="rounded-xl bg-slate-50 p-3">

                        <p class="text-xs text-slate-500">
                            Session
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-700">
                            {{ $enrollment->academicSession?->name ?? 'N/A' }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-slate-50 p-3">

                        <p class="text-xs text-slate-500">
                            Class
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-700">
                            {{ $enrollment->schoolClass?->name ?? 'N/A' }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-slate-50 p-3">

                        <p class="text-xs text-slate-500">
                            Section
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-700">
                            {{ $enrollment->section?->name ?? 'N/A' }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-slate-50 p-3">

                        <p class="text-xs text-slate-500">
                            Roll
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-700">
                            {{ $enrollment->roll_no ?? '-' }}
                        </p>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="mt-4 flex gap-2 border-t border-slate-100 pt-4">

                    <a
                        href="{{ route('admin.students.enrollments.show', $enrollment) }}"
                        class="flex flex-1 items-center justify-center
                               rounded-xl border border-slate-200
                               px-3 py-2.5 text-sm font-semibold
                               text-slate-700 transition hover:bg-slate-50"
                    >
                        View
                    </a>


                    <a
                        href="{{ route('admin.students.enrollments.edit', $enrollment) }}"
                        class="flex flex-1 items-center justify-center
                               rounded-xl bg-blue-600
                               px-3 py-2.5 text-sm font-semibold
                               text-white transition hover:bg-blue-700"
                    >
                        Edit
                    </a>


                    <form
                        action="{{ route('admin.students.enrollments.destroy', $enrollment) }}"
                        method="POST"
                        class="flex-1"
                        onsubmit="return confirm('Are you sure you want to delete this enrollment?');"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full rounded-xl border border-red-200
                                   px-3 py-2.5 text-sm font-semibold
                                   text-red-600 transition hover:bg-red-50"
                        >
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="rounded-2xl border border-slate-200 bg-white p-10 text-center">

                <h3 class="font-semibold text-slate-700">
                    No enrollments found
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    No student enrollment matches your current filters.
                </p>

            </div>

        @endforelse


        {{-- Mobile Pagination --}}
        @if($enrollments->hasPages())

            <div>
                {{ $enrollments->links() }}
            </div>

        @endif

    </div>

</div>

@endsection