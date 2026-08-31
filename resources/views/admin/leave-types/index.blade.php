@extends('admin.layouts.app')

@section('title', 'Leave Types')

@section('page-title', 'Leave Types')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Page Header --}}
    <div class="mb-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Leave Types
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    Manage leave types for teachers and staff
                </p>
            </div>

            <a href="{{ route('admin.leave-types.create') }}"
               class="inline-flex items-center justify-center gap-2
                      rounded-lg bg-blue-600 px-4 py-2.5
                      text-sm font-semibold text-white
                      hover:bg-blue-700 transition">

                <i class="bi bi-plus-lg"></i>
                Add Leave Type

            </a>

        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3">

            <div class="flex items-center gap-3">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center
                            rounded-full bg-green-100 text-green-600">

                    <i class="bi bi-check-circle"></i>

                </div>

                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3">

            <div class="flex items-start gap-3">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center
                            rounded-full bg-red-100 text-red-600">

                    <i class="bi bi-exclamation-triangle"></i>

                </div>

                <div>

                    <p class="text-sm font-semibold text-red-800">
                        Please fix the following errors
                    </p>

                    <ul class="mt-1 list-disc list-inside text-xs text-red-700 space-y-1">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- Filters --}}
    <div class="bg-white rounded-xl border border-slate-200
                shadow-sm mb-5 overflow-hidden">

        <div class="px-4 sm:px-6 py-4 border-b border-slate-200 bg-slate-50">

            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center
                            rounded-lg bg-blue-50 text-blue-600">

                    <i class="bi bi-funnel"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Filter Leave Types
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Search by leave name, code or status
                    </p>

                </div>

            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.leave-types.index') }}">

            <div class="p-4 sm:p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    {{-- Search --}}
                    <div class="md:col-span-2">

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Search
                        </label>

                        <div class="relative">

                            <i class="bi bi-search absolute left-3 top-1/2
                                      -translate-y-1/2 text-slate-400"></i>

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Search leave name or code..."

                                   class="w-full rounded-lg border border-slate-300
                                          bg-white pl-10 pr-3 py-2.5
                                          text-sm text-slate-700
                                          outline-none
                                          focus:border-blue-500
                                          focus:ring-2 focus:ring-blue-100">

                        </div>

                    </div>


                    {{-- Status --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Status
                        </label>

                        <select name="status"
                                class="w-full rounded-lg border border-slate-300
                                       bg-white px-3 py-2.5 text-sm text-slate-700
                                       outline-none focus:border-blue-500
                                       focus:ring-2 focus:ring-blue-100">

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

                </div>


                {{-- Filter Buttons --}}
                <div class="mt-4 flex flex-col sm:flex-row
                            items-stretch sm:items-center
                            justify-end gap-2">

                    <a href="{{ route('admin.leave-types.index') }}"
                       class="inline-flex items-center justify-center gap-2
                              rounded-lg border border-slate-300 bg-white
                              px-4 py-2.5 text-sm font-medium
                              text-slate-600 hover:bg-slate-100 transition">

                        <i class="bi bi-arrow-counterclockwise"></i>
                        Reset

                    </a>

                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2
                                   rounded-lg bg-blue-600 px-4 py-2.5
                                   text-sm font-semibold text-white
                                   hover:bg-blue-700 transition">

                        <i class="bi bi-search"></i>
                        Apply Filter

                    </button>

                </div>

            </div>

        </form>

    </div>


    {{-- Summary --}}
    @php
        $total = $leaveTypes->total();
        $active = $leaveTypes->where('status', true)->count();
        $inactive = $leaveTypes->where('status', false)->count();
    @endphp


    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 mb-5">

        {{-- Total --}}
        <div class="bg-white rounded-xl border border-slate-200
                    shadow-sm p-4">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium text-slate-500">
                        Total Leave Types
                    </p>

                    <p class="mt-1 text-xl font-bold text-slate-800">
                        {{ $total }}
                    </p>

                </div>

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-blue-50 text-blue-600">

                    <i class="bi bi-calendar2-week"></i>

                </div>

            </div>

        </div>


        {{-- Active --}}
        <div class="bg-white rounded-xl border border-slate-200
                    shadow-sm p-4">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium text-slate-500">
                        Active
                    </p>

                    <p class="mt-1 text-xl font-bold text-green-600">
                        {{ $active }}
                    </p>

                </div>

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-green-50 text-green-600">

                    <i class="bi bi-check-circle"></i>

                </div>

            </div>

        </div>


        {{-- Inactive --}}
        <div class="bg-white rounded-xl border border-slate-200
                    shadow-sm p-4">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium text-slate-500">
                        Inactive
                    </p>

                    <p class="mt-1 text-xl font-bold text-red-600">
                        {{ $inactive }}
                    </p>

                </div>

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-red-50 text-red-600">

                    <i class="bi bi-x-circle"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- Leave Type List --}}
    <div class="bg-white rounded-xl border border-slate-200
                shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="px-4 sm:px-6 py-4 border-b border-slate-200 bg-slate-50">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-blue-50 text-blue-600">

                    <i class="bi bi-calendar-check"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Leave Type List
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        All configured leave types
                    </p>

                </div>

            </div>

        </div>


        @if($leaveTypes->count())

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-4 sm:px-6 py-3 text-left
                                       text-xs font-semibold text-slate-500
                                       uppercase tracking-wider">
                                Leave Type
                            </th>

                            <th class="px-4 sm:px-6 py-3 text-left
                                       text-xs font-semibold text-slate-500
                                       uppercase tracking-wider">
                                Code
                            </th>

                            <th class="px-4 sm:px-6 py-3 text-center
                                       text-xs font-semibold text-slate-500
                                       uppercase tracking-wider">
                                Days / Year
                            </th>

                            <th class="px-4 sm:px-6 py-3 text-center
                                       text-xs font-semibold text-slate-500
                                       uppercase tracking-wider">
                                Status
                            </th>

                            <th class="px-4 sm:px-6 py-3 text-right
                                       text-xs font-semibold text-slate-500
                                       uppercase tracking-wider">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @foreach($leaveTypes as $leaveType)

                            <tr class="hover:bg-slate-50 transition">

                                {{-- Name --}}
                                <td class="px-4 sm:px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-9 w-9 shrink-0
                                                    items-center justify-center
                                                    rounded-full bg-blue-50
                                                    text-blue-600">

                                            <i class="bi bi-calendar2-event"></i>

                                        </div>

                                        <div>

                                            <p class="text-sm font-semibold text-slate-800">
                                                {{ $leaveType->name }}
                                            </p>

                                            @if($leaveType->description)

                                                <p class="text-xs text-slate-500 max-w-md truncate">
                                                    {{ $leaveType->description }}
                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Code --}}
                                <td class="px-4 sm:px-6 py-4">

                                    @if($leaveType->code)

                                        <span class="inline-flex items-center rounded-md
                                                     bg-slate-100 px-2.5 py-1
                                                     text-xs font-semibold text-slate-600">

                                            {{ $leaveType->code }}

                                        </span>

                                    @else

                                        <span class="text-xs text-slate-400">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Days --}}
                                <td class="px-4 sm:px-6 py-4 text-center">

                                    <span class="text-sm font-semibold text-slate-700">
                                        {{ number_format($leaveType->days_per_year, 2) }}
                                    </span>

                                    <span class="text-xs text-slate-400">
                                        days
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td class="px-4 sm:px-6 py-4 text-center">

                                    @if($leaveType->status)

                                        <span class="inline-flex items-center gap-1
                                                     rounded-full bg-green-50
                                                     px-2.5 py-1 text-xs
                                                     font-semibold text-green-700">

                                            <i class="bi bi-check-circle"></i>
                                            Active

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1
                                                     rounded-full bg-red-50
                                                     px-2.5 py-1 text-xs
                                                     font-semibold text-red-700">

                                            <i class="bi bi-x-circle"></i>
                                            Inactive

                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="px-4 sm:px-6 py-4">

                                    <div class="flex items-center justify-end gap-1.5">

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.leave-types.edit', $leaveType) }}"
                                           title="Edit"
                                           class="inline-flex h-9 w-9 items-center
                                                  justify-center rounded-lg
                                                  bg-amber-50 text-amber-600
                                                  hover:bg-amber-100 transition">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ route('admin.leave-types.destroy', $leaveType) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this leave type?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    title="Delete"
                                                    class="inline-flex h-9 w-9
                                                           items-center justify-center
                                                           rounded-lg bg-red-50
                                                           text-red-600
                                                           hover:bg-red-100 transition">

                                                <i class="bi bi-trash"></i>

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
            @if($leaveTypes->hasPages())

                <div class="px-4 sm:px-6 py-4 border-t border-slate-200">

                    {{ $leaveTypes->links() }}

                </div>

            @endif

        @else

            {{-- Empty State --}}
            <div class="px-4 sm:px-6 py-12 text-center">

                <div class="mx-auto flex h-14 w-14 items-center justify-center
                            rounded-full bg-slate-100 text-slate-400">

                    <i class="bi bi-calendar2-x text-2xl"></i>

                </div>

                <h3 class="mt-4 text-sm font-semibold text-slate-800">
                    No leave types found
                </h3>

                <p class="mt-1 text-xs text-slate-500">
                    Create a leave type to see it here.
                </p>

                <a href="{{ route('admin.leave-types.create') }}"
                   class="mt-4 inline-flex items-center gap-2
                          rounded-lg bg-blue-600 px-4 py-2.5
                          text-sm font-semibold text-white
                          hover:bg-blue-700 transition">

                    <i class="bi bi-plus-lg"></i>
                    Add Leave Type

                </a>

            </div>

        @endif

    </div>

</div>

@endsection