@extends('admin.layouts.app')

@section('title', 'Leave Applications')

@section('content')

<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Leave Applications
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage teacher and staff leave applications.
            </p>
        </div>

        <a href="{{ route('admin.leave-applications.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
            <i class="bi bi-plus-lg"></i>
            Apply Leave
        </a>
    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="flex items-center gap-3 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif


    {{-- Error Message --}}
    @if(session('error'))
        <div class="flex items-center gap-3 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif


    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <div class="font-semibold mb-1">
                Please fix the following errors:
            </div>

            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- Filter Card --}}
    <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">
            <div class="flex items-center gap-2">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="bi bi-funnel"></i>
                </div>

                <div>
                    <h2 class="text-sm font-semibold text-slate-800">
                        Filter Applications
                    </h2>

                    <p class="text-xs text-slate-500">
                        Search and filter leave applications.
                    </p>
                </div>
            </div>
        </div>


        <form method="GET"
              action="{{ route('admin.leave-applications.index') }}"
              class="p-5">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

                {{-- Search --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Search
                    </label>

                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                            <i class="bi bi-search"></i>
                        </span>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Name / ID..."
                            class="w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >
                    </div>
                </div>


                {{-- Leave Type --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Leave Type
                    </label>

                    <select
                        name="leave_type_id"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        <option value="">All Leave Types</option>

                        @foreach($leaveTypes ?? [] as $leaveType)
                            <option
                                value="{{ $leaveType->id }}"
                                {{ request('leave_type_id') == $leaveType->id ? 'selected' : '' }}>
                                {{ $leaveType->name }}
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
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        <option value="">All Status</option>

                        <option value="pending"
                            {{ request('status') == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="approved"
                            {{ request('status') == 'approved' ? 'selected' : '' }}>
                            Approved
                        </option>

                        <option value="rejected"
                            {{ request('status') == 'rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>

                    </select>
                </div>


                {{-- From Date --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        From Date
                    </label>

                    <input
                        type="date"
                        name="from_date"
                        value="{{ request('from_date') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>


                {{-- To Date --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        To Date
                    </label>

                    <input
                        type="date"
                        name="to_date"
                        value="{{ request('to_date') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>

            </div>


            {{-- Filter Buttons --}}
            <div class="mt-5 flex flex-wrap items-center gap-2">

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

                    <i class="bi bi-search"></i>
                    Filter
                </button>


                <a
                    href="{{ route('admin.leave-applications.index') }}"
                    class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </a>

            </div>

        </form>
    </div>


    {{-- Applications Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        {{-- Table Header --}}
        <div class="flex flex-col gap-3 border-b border-slate-200 bg-slate-50 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-sm font-semibold text-slate-800">
                    Leave Applications
                </h2>

                <p class="mt-0.5 text-xs text-slate-500">
                    Total:
                    <span class="font-semibold text-slate-700">
                        {{ $applications->total() }}
                    </span>
                </p>
            </div>

        </div>


        {{-- Responsive Table --}}
        <div class="overflow-x-auto">

            <table class="min-w-[1100px] w-full text-left">

                <thead class="border-b border-slate-200 bg-white">
                    <tr>

                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            #
                        </th>

                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Employee
                        </th>

                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Leave Type
                        </th>

                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Leave Period
                        </th>

                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Days
                        </th>

                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Applied On
                        </th>

                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Status
                        </th>

                        <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Actions
                        </th>

                    </tr>
                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($applications as $application)

                        <tr class="transition hover:bg-slate-50">

                            {{-- Serial --}}
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">
                                {{ $applications->firstItem() + $loop->index }}
                            </td>


                            {{-- Employee --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-50 text-sm font-bold text-blue-600">
                                        {{ strtoupper(substr($application->teacherStaff->name ?? 'N', 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="font-semibold text-slate-800">
                                            {{ $application->teacherStaff->name ?? 'N/A' }}
                                        </div>

                                        @if(isset($application->teacherStaff->employee_id))
                                            <div class="text-xs text-slate-500">
                                                ID: {{ $application->teacherStaff->employee_id }}
                                            </div>
                                        @endif
                                    </div>

                                </div>

                            </td>


                            {{-- Leave Type --}}
                            <td class="px-5 py-4">

                                <span class="font-medium text-slate-700">
                                    {{ $application->leaveType->name ?? 'N/A' }}
                                </span>

                            </td>


                            {{-- Leave Period --}}
                            <td class="whitespace-nowrap px-5 py-4">

                                <div class="text-sm font-medium text-slate-700">
                                    {{ optional($application->start_date)->format('d M Y') }}
                                </div>

                                <div class="mt-0.5 text-xs text-slate-500">
                                    to
                                    {{ optional($application->end_date)->format('d M Y') }}
                                </div>

                            </td>


                            {{-- Days --}}
                            <td class="whitespace-nowrap px-5 py-4">

                                <span class="inline-flex items-center rounded-md bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                    {{ $application->days ?? 0 }}
                                    {{ ($application->days ?? 0) == 1 ? 'Day' : 'Days' }}
                                </span>

                            </td>


                            {{-- Applied On --}}
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                {{ optional($application->created_at)->format('d M Y') }}
                            </td>


                            {{-- Status --}}
                            <td class="px-5 py-4">

                                @if($application->status === 'approved')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                        Approved
                                    </span>

                                @elseif($application->status === 'rejected')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                        Rejected
                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                        Pending
                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-end gap-1.5">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('admin.leave-applications.show', $application->id) }}"
                                        title="View"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600">

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    {{-- Edit --}}
                                    @if($application->status === 'pending')

                                        <a
                                            href="{{ route('admin.leave-applications.edit', $application->id) }}"
                                            title="Edit"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:border-amber-200 hover:bg-amber-50 hover:text-amber-600">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                    @endif


                                    {{-- Approve --}}
                                    @if($application->status === 'pending')

                                        <form
                                            method="POST"
                                            action="{{ route('admin.leave-applications.approve', $application->id) }}"
                                            class="inline">

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                title="Approve"
                                                onclick="return confirm('Are you sure you want to approve this leave application?')"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-green-200 bg-green-50 text-green-600 transition hover:bg-green-100 hover:text-green-700">

                                                <i class="bi bi-check-lg"></i>

                                            </button>

                                        </form>


                                        {{-- Reject --}}
                                        <form
                                            method="POST"
                                            action="{{ route('admin.leave-applications.reject', $application->id) }}"
                                            class="inline">

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                title="Reject"
                                                onclick="return confirm('Are you sure you want to reject this leave application?')"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-200 bg-red-50 text-red-600 transition hover:bg-red-100 hover:text-red-700">

                                                <i class="bi bi-x-lg"></i>

                                            </button>

                                        </form>

                                    @endif


                                    {{-- Delete --}}
                                    @if($application->status === 'pending')

                                        <form
                                            method="POST"
                                            action="{{ route('admin.leave-applications.destroy', $application->id) }}"
                                            class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this leave application?')"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600">

                                                <i class="bi bi-trash3"></i>

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="px-5 py-14 text-center">

                                <div class="mx-auto flex max-w-sm flex-col items-center">

                                    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-2xl text-slate-400">
                                        <i class="bi bi-calendar-x"></i>
                                    </div>

                                    <h3 class="text-sm font-semibold text-slate-800">
                                        No Leave Applications Found
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        There are no leave applications matching your filters.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($applications->hasPages())

            <div class="border-t border-slate-200 px-5 py-4">

                {{ $applications->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
