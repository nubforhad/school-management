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

        <div class="rounded-xl border border-green-200 bg-green-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <i class="bi bi-check-circle-fill text-green-600"></i>

                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- Error Message --}}
    @if(session('error'))

        <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <i class="bi bi-exclamation-circle-fill text-red-600"></i>

                <p class="text-sm font-medium text-red-800">
                    {{ session('error') }}
                </p>

            </div>

        </div>

    @endif


    {{-- Filters --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="bi bi-funnel"></i>
                </div>

                <div>
                    <h2 class="text-sm font-semibold text-slate-800">
                        Filter Applications
                    </h2>

                    <p class="mt-0.5 text-xs text-slate-500">
                        Search and filter leave applications.
                    </p>
                </div>

            </div>

        </div>


        <form method="GET" action="{{ route('admin.leave-applications.index') }}"
              class="p-5">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5">

                {{-- Search --}}
                <div class="lg:col-span-2">

                    <label for="search"
                           class="mb-1.5 block text-sm font-medium text-slate-700">

                        Search

                    </label>

                    <div class="relative">

                        <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Name or Employee ID..."
                            class="w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>

                </div>


                {{-- Leave Type --}}
                <div>

                    <label for="leave_type_id"
                           class="mb-1.5 block text-sm font-medium text-slate-700">

                        Leave Type

                    </label>

                    <select
                        id="leave_type_id"
                        name="leave_type_id"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        <option value="">
                            All Leave Types
                        </option>

                        @foreach($leaveTypes as $leaveType)

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

                    <label for="status"
                           class="mb-1.5 block text-sm font-medium text-slate-700">

                        Status

                    </label>

                    <select
                        id="status"
                        name="status"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        <option value="">
                            All Status
                        </option>

                        <option value="pending"
                            {{ request('status') === 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="approved"
                            {{ request('status') === 'approved' ? 'selected' : '' }}>
                            Approved
                        </option>

                        <option value="rejected"
                            {{ request('status') === 'rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>

                        <option value="cancelled"
                            {{ request('status') === 'cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>

                    </select>

                </div>


                {{-- From Date --}}
                <div>

                    <label for="from_date"
                           class="mb-1.5 block text-sm font-medium text-slate-700">

                        From Date

                    </label>

                    <input
                        type="date"
                        id="from_date"
                        name="from_date"
                        value="{{ request('from_date') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                </div>


                {{-- To Date --}}
                <div>

                    <label for="to_date"
                           class="mb-1.5 block text-sm font-medium text-slate-700">

                        To Date

                    </label>

                    <input
                        type="date"
                        id="to_date"
                        name="to_date"
                        value="{{ request('to_date') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                </div>

            </div>


            {{-- Filter Buttons --}}
            <div class="mt-5 flex flex-col gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">

                <a href="{{ route('admin.leave-applications.index') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

                    <i class="bi bi-arrow-clockwise"></i>
                    Reset

                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                    <i class="bi bi-search"></i>
                    Apply Filter

                </button>

            </div>

        </form>

    </div>


    {{-- Applications Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        {{-- Table Header --}}
        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <i class="bi bi-calendar-check"></i>
                    </div>

                    <div>
                        <h2 class="text-sm font-semibold text-slate-800">
                            Applications
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-500">
                            Total:
                            <span class="font-semibold text-slate-700">
                                {{ $applications->total() }}
                            </span>
                        </p>
                    </div>

                </div>

            </div>

        </div>


        {{-- Responsive Table --}}
        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            #
                        </th>

                        <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Teacher / Staff
                        </th>

                        <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Leave Type
                        </th>

                        <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Leave Period
                        </th>

                        <th class="whitespace-nowrap px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Days
                        </th>

                        <th class="whitespace-nowrap px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                        <th class="whitespace-nowrap px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100 bg-white">

                    @forelse($applications as $application)

                        <tr class="transition hover:bg-slate-50">

                            {{-- Serial --}}
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">

                                {{ $applications->firstItem() + $loop->index }}

                            </td>


                            {{-- Teacher / Staff --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-50 text-sm font-semibold text-blue-600">

                                        {{ strtoupper(substr($application->teacherStaff?->name ?? 'N', 0, 1)) }}

                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-semibold text-slate-800">

                                            {{ $application->teacherStaff?->name ?? 'N/A' }}

                                        </p>

                                        @if($application->teacherStaff?->employee_id)

                                            <p class="mt-0.5 text-xs text-slate-500">

                                                ID: {{ $application->teacherStaff->employee_id }}

                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Leave Type --}}
                            <td class="whitespace-nowrap px-5 py-4">

                                <div>

                                    <p class="text-sm font-medium text-slate-700">

                                        {{ $application->leaveType?->name ?? 'N/A' }}

                                    </p>

                                </div>

                            </td>


                            {{-- Leave Period --}}
                            <td class="whitespace-nowrap px-5 py-4">

                                <div class="text-sm text-slate-700">

                                    <div class="flex items-center gap-2">

                                        <i class="bi bi-calendar-event text-slate-400"></i>

                                        <span>
                                            {{ optional($application->start_date)->format('d M Y') }}
                                        </span>

                                    </div>

                                    <div class="mt-1 flex items-center gap-2 text-xs text-slate-500">

                                        <i class="bi bi-arrow-down"></i>

                                        <span>
                                            {{ optional($application->end_date)->format('d M Y') }}
                                        </span>

                                    </div>

                                </div>

                            </td>


                            {{-- Days --}}
                            <td class="whitespace-nowrap px-5 py-4 text-center">

                                <span class="inline-flex items-center rounded-lg bg-slate-100 px-2.5 py-1 text-sm font-semibold text-slate-700">

                                    {{ rtrim(rtrim(number_format($application->total_days, 2), '0'), '.') }}

                                    {{ $application->total_days == 1 ? 'Day' : 'Days' }}

                                </span>

                            </td>


                            {{-- Status --}}
                            <td class="whitespace-nowrap px-5 py-4 text-center">

                                @if($application->status === 'pending')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                        Pending

                                    </span>

                                @elseif($application->status === 'approved')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                        Approved

                                    </span>

                                @elseif($application->status === 'rejected')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                        Rejected

                                    </span>

                                @elseif($application->status === 'cancelled')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">

                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-500"></span>

                                        Cancelled

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">

                                        {{ ucfirst($application->status) }}

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="whitespace-nowrap px-5 py-4">

                                <div class="flex items-center justify-end gap-1.5">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('admin.leave-applications.show', $application) }}"
                                        title="View"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600">

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    {{-- Edit --}}
                                    @if($application->status === 'pending')

                                        <a
                                            href="{{ route('admin.leave-applications.edit', $application) }}"
                                            title="Edit"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:border-amber-200 hover:bg-amber-50 hover:text-amber-600">

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                    @endif


                                    {{-- Approve --}}
                                    @if($application->status === 'pending')

                                        <form
                                            method="POST"
                                            action="{{ route('admin.leave-applications.approve', $application) }}"
                                            class="inline"
                                            onsubmit="return confirm('Are you sure you want to approve this leave application?');">

                                            @csrf

                                            <button
                                                type="submit"
                                                title="Approve"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-green-200 bg-green-50 text-green-600 transition hover:bg-green-100">

                                                <i class="bi bi-check-lg"></i>

                                            </button>

                                        </form>


                                        {{-- Reject --}}
                                        <button
                                            type="button"
                                            title="Reject"
                                            onclick="openRejectModal('{{ $application->id }}')"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-200 bg-red-50 text-red-600 transition hover:bg-red-100">

                                            <i class="bi bi-x-lg"></i>

                                        </button>

                                    @endif


                                    {{-- Delete --}}
                                    @if($application->status === 'pending')

                                        <form
                                            method="POST"
                                            action="{{ route('admin.leave-applications.destroy', $application) }}"
                                            class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this leave application?');">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Delete"
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

                            <td colspan="7" class="px-5 py-12 text-center">

                                <div class="flex flex-col items-center justify-center">

                                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">

                                        <i class="bi bi-calendar-x text-2xl"></i>

                                    </div>

                                    <h3 class="mt-4 text-sm font-semibold text-slate-700">

                                        No leave applications found

                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">

                                        Try changing your filters or create a new leave application.

                                    </p>

                                    <a
                                        href="{{ route('admin.leave-applications.create') }}"
                                        class="mt-4 inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">

                                        <i class="bi bi-plus-lg"></i>
                                        Apply Leave

                                    </a>

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


{{-- Reject Modal --}}
<div
    id="rejectModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 px-4">

    <div class="w-full max-w-md overflow-hidden rounded-xl bg-white shadow-xl">

        {{-- Modal Header --}}
        <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-600">

                    <i class="bi bi-x-circle"></i>

                </div>

                <div>

                    <h3 class="text-sm font-semibold text-slate-800">
                        Reject Leave Application
                    </h3>

                    <p class="text-xs text-slate-500">
                        Add a reason if required.
                    </p>

                </div>

            </div>

            <button
                type="button"
                onclick="closeRejectModal()"
                class="text-slate-400 transition hover:text-slate-600">

                <i class="bi bi-x-lg"></i>

            </button>

        </div>


        {{-- Modal Body --}}
        <form
            id="rejectForm"
            method="POST"
            class="p-5">

            @csrf

            <div>

                <label for="reject_remarks"
                       class="mb-1.5 block text-sm font-medium text-slate-700">

                    Remarks

                    <span class="text-xs font-normal text-slate-400">
                        (Optional)
                    </span>

                </label>

                <textarea
                    id="reject_remarks"
                    name="remarks"
                    rows="4"
                    placeholder="Enter rejection reason..."
                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-red-500 focus:ring-2 focus:ring-red-100"></textarea>

            </div>


            <div class="mt-5 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <button
                    type="button"
                    onclick="closeRejectModal()"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

                    <i class="bi bi-x-lg"></i>
                    Cancel

                </button>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700">

                    <i class="bi bi-x-circle"></i>
                    Reject Application

                </button>

            </div>

        </form>

    </div>

</div>


<script>

    function openRejectModal(applicationId) {

        const modal = document.getElementById('rejectModal');
        const form = document.getElementById('rejectForm');

        form.action =
            "{{ url('/admin/leave-applications') }}/"
            + applicationId
            + "/reject";

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.getElementById('reject_remarks').focus();
    }


    function closeRejectModal() {

        const modal = document.getElementById('rejectModal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        document.getElementById('reject_remarks').value = '';
    }


    document.getElementById('rejectModal').addEventListener('click', function (event) {

        if (event.target === this) {
            closeRejectModal();
        }

    });

</script>

@endsection