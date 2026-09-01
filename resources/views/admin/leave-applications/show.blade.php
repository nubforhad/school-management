@extends('admin.layouts.app')

@section('title', 'Leave Application Details')

@section('content')

<div class="space-y-6">

{{-- Page Header --}}
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>

        <div class="flex items-center gap-3">

            <h1 class="text-2xl font-bold text-slate-800">
                Leave Application
            </h1>

            @if($leaveApplication->status === 'approved')

                <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                    <i class="bi bi-check-circle"></i>
                    Approved
                </span>

            @elseif($leaveApplication->status === 'rejected')

                <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                    <i class="bi bi-x-circle"></i>
                    Rejected
                </span>

            @elseif($leaveApplication->status === 'cancelled')

                <span class="inline-flex items-center gap-1 rounded-full bg-slate-200 px-3 py-1 text-xs font-semibold text-slate-700">
                    <i class="bi bi-slash-circle"></i>
                    Cancelled
                </span>

            @else

                <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                    <i class="bi bi-clock"></i>
                    Pending
                </span>

            @endif

        </div>

        <p class="mt-1 text-sm text-slate-500">
            View complete leave application information.
        </p>

    </div>


    <div class="flex flex-col gap-2 sm:flex-row">

        @if($leaveApplication->status === 'pending')

            <a href="{{ route('admin.leave-applications.edit', $leaveApplication) }}"
               class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                <i class="bi bi-pencil-square"></i>
                Edit

            </a>

        @endif

        <a href="{{ route('admin.leave-applications.index') }}"
           class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">

            <i class="bi bi-arrow-left"></i>
            Back

        </a>

    </div>

</div>


{{-- Main Information --}}
<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

    {{-- Employee Card --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="bi bi-person-badge text-lg"></i>
                </div>

                <div>

                    <h2 class="text-sm font-semibold text-slate-800">
                        Employee
                    </h2>

                    <p class="text-xs text-slate-500">
                        Teacher / Staff information
                    </p>

                </div>

            </div>

        </div>


        <div class="space-y-4 p-5">

            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Name
                </p>

                <p class="mt-1 text-sm font-semibold text-slate-800">
                    {{ $leaveApplication->teacherStaff?->name ?? 'N/A' }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Employee ID
                </p>

                <p class="mt-1 text-sm text-slate-700">
                    {{ $leaveApplication->teacherStaff?->employee_id ?? 'N/A' }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Leave Type
                </p>

                <p class="mt-1 text-sm font-semibold text-slate-800">
                    {{ $leaveApplication->leaveType?->name ?? 'N/A' }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Academic Session
                </p>

                <p class="mt-1 text-sm text-slate-700">
                    {{ $leaveApplication->academicSession?->name ?? 'N/A' }}
                </p>

            </div>

        </div>

    </div>


    {{-- Leave Period --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="bi bi-calendar3 text-lg"></i>
                </div>

                <div>

                    <h2 class="text-sm font-semibold text-slate-800">
                        Leave Period
                    </h2>

                    <p class="text-xs text-slate-500">
                        Leave date information
                    </p>

                </div>

            </div>

        </div>


        <div class="space-y-4 p-5">

            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Start Date
                </p>

                <p class="mt-1 text-sm font-semibold text-slate-800">
                    {{ $leaveApplication->start_date?->format('d M Y') ?? 'N/A' }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    End Date
                </p>

                <p class="mt-1 text-sm font-semibold text-slate-800">
                    {{ $leaveApplication->end_date?->format('d M Y') ?? 'N/A' }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Total Days
                </p>

                <p class="mt-1 text-2xl font-bold text-blue-600">
                    {{ rtrim(rtrim(number_format((float) $leaveApplication->total_days, 2), '0'), '.') }}
                </p>

            </div>

        </div>

    </div>


    {{-- Approval Information --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="bi bi-shield-check text-lg"></i>
                </div>

                <div>

                    <h2 class="text-sm font-semibold text-slate-800">
                        Approval Information
                    </h2>

                    <p class="text-xs text-slate-500">
                        Application status details
                    </p>

                </div>

            </div>

        </div>


        <div class="space-y-4 p-5">
            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Status
                </p>
                <div class="mt-2">
                    @if($leaveApplication->status === 'approved')
                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1.5 text-xs font-semibold text-green-700">
                            <i class="bi bi-check-circle-fill"></i>
                            Approved
                        </span>
                    @elseif($leaveApplication->status === 'rejected')
                        <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700">
                            <i class="bi bi-x-circle-fill"></i>
                            Rejected
                        </span>
                    @elseif($leaveApplication->status === 'cancelled')
                        <span class="inline-flex items-center gap-1 rounded-full bg-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-700">
                            <i class="bi bi-slash-circle-fill"></i>
                            Cancelled
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-3 py-1.5 text-xs font-semibold text-yellow-700">
                            <i class="bi bi-clock-fill"></i>
                            Pending
                        </span>
                    @endif
                </div>
            </div>
            @if($leaveApplication->approvedBy)
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Approved By
                    </p>
                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $leaveApplication->approvedBy->name }}
                    </p>
                </div>
            @endif
            @if($leaveApplication->approved_at)
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Approved At
                    </p>
                    <p class="mt-1 text-sm text-slate-700">
                        {{ $leaveApplication->approved_at->format('d M Y, h:i A') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>


{{-- Reason --}}
<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                <i class="bi bi-chat-left-text text-lg"></i>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-slate-800">
                    Leave Details
                </h2>
                <p class="text-xs text-slate-500">
                    Reason and additional remarks
                </p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-6 p-5 md:grid-cols-2">
        <div>
            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                Reason
            </p>
            <div class="mt-2 rounded-lg border border-slate-200 bg-slate-50 p-4 text-sm leading-6 text-slate-700">
                {{ $leaveApplication->reason ?: 'No reason provided.' }}
            </div>
        </div>
        <div>
            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                Remarks
            </p>
            <div class="mt-2 rounded-lg border border-slate-200 bg-slate-50 p-4 text-sm leading-6 text-slate-700">
                {{ $leaveApplication->remarks ?: 'No remarks.' }}
            </div>
        </div>
    </div>
</div>


{{-- Pending Actions --}}
@if($leaveApplication->status === 'pending')
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">
            <h2 class="text-sm font-semibold text-slate-800">
                Application Actions
            </h2>
            <p class="mt-1 text-xs text-slate-500">
                Approve or reject this pending leave application.
            </p>
        </div>
        <div class="flex flex-col gap-3 p-5 sm:flex-row">
            {{-- Approve --}}
            <form method="POST"   action="{{ route('admin.leave-applications.approve', $leaveApplication) }}"   class="flex-1">
                @csrf
                <button type="submit"
                        onclick="return confirm('Are you sure you want to approve this leave application?')"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-green-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-green-700">
                    <i class="bi bi-check-circle"></i>
                    Approve Application
                </button>
            </form>
            {{-- Reject --}}
            <form method="POST"
                  action="{{ route('admin.leave-applications.reject', $leaveApplication) }}"
                  class="flex-1">
                @csrf
                <button type="submit"
                        onclick="return confirm('Are you sure you want to reject this leave application?')"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700">
                    <i class="bi bi-x-circle"></i>
                    Reject Application
                </button>
            </form>
        </div>
    </div>
@endif


    {{-- Created Information --}}
    <div class="rounded-lg border border-slate-200 bg-slate-50 px-5 py-4">
        <div class="grid grid-cols-1 gap-4 text-sm sm:grid-cols-2">
            <div>
                <span class="text-slate-500">
                    Created:
                </span>
                <span class="font-medium text-slate-700">
                    {{ $leaveApplication->created_at?->format('d M Y, h:i A') ?? 'N/A' }}
                </span>
            </div>
            <div class="sm:text-right">
                <span class="text-slate-500">
                    Last Updated:
                </span>
                <span class="font-medium text-slate-700">
                    {{ $leaveApplication->updated_at?->format('d M Y, h:i A') ?? 'N/A' }}
                </span>
            </div>
        </div>
    </div>

</div>

@endsection
