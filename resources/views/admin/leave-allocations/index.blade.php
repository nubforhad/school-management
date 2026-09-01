@extends('admin.layouts.app')

@section('title', 'Leave Allocations')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Leave Allocations
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Manage teacher and staff leave allocations.
            </p>
        </div>

        <a href="{{ route('admin.leave-allocations.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5
                  bg-blue-600 hover:bg-blue-700 text-white
                  rounded-lg text-sm font-medium transition">

            <i class="bi bi-plus-lg"></i>
            Allocate Leave

        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="flex items-center gap-3 p-4
                    bg-green-50 border border-green-200
                    text-green-700 rounded-lg">

            <i class="bi bi-check-circle-fill"></i>

            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- Table Card --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b border-slate-200
                    flex items-center justify-between">

            <div>
                <h2 class="text-base font-semibold text-slate-800">
                    Allocation List
                </h2>

                <p class="text-xs text-slate-500 mt-1">
                    Total: {{ $leaveAllocations->total() }}
                </p>
            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            #
                        </th>

                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Teacher / Staff
                        </th>

                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Leave Type
                        </th>

                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Academic Session
                        </th>

                        <th class="px-6 py-3 text-center font-semibold text-slate-600">
                            Allocated
                        </th>

                        <th class="px-6 py-3 text-center font-semibold text-slate-600">
                            Used
                        </th>

                        <th class="px-6 py-3 text-center font-semibold text-slate-600">
                            Remaining
                        </th>

                        <th class="px-6 py-3 text-center font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="px-6 py-3 text-right font-semibold text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($leaveAllocations as $allocation)

                        @php
                            $remaining =
                                $allocation->allocated_days -
                                $allocation->used_days;
                        @endphp

                        <tr class="hover:bg-slate-50 transition">

                            {{-- Number --}}
                            <td class="px-6 py-4 text-slate-500">
                                {{ $leaveAllocations->firstItem() + $loop->index }}
                            </td>


                            {{-- Teacher / Staff --}}
                            <td class="px-6 py-4">

                                <div class="font-medium text-slate-800">
                                    {{ $allocation->teacherStaff->name ?? 'N/A' }}
                                </div>

                                @if($allocation->teacherStaff?->employee_id)

                                    <div class="text-xs text-slate-500 mt-0.5">
                                        ID:
                                        {{ $allocation->teacherStaff->employee_id }}
                                    </div>

                                @endif

                            </td>


                            {{-- Leave Type --}}
                            <td class="px-6 py-4">

                                <span class="inline-flex items-center
                                             px-2.5 py-1 rounded-md
                                             bg-blue-50 text-blue-700
                                             text-xs font-medium">

                                    {{ $allocation->leaveType->name ?? 'N/A' }}

                                </span>

                            </td>


                            {{-- Academic Session --}}
                            <td class="px-6 py-4 text-slate-600">

                                {{ $allocation->academicSession->name ?? 'N/A' }}

                            </td>


                            {{-- Allocated --}}
                            <td class="px-6 py-4 text-center">

                                <span class="font-semibold text-slate-800">
                                    {{ $allocation->allocated_days }}
                                </span>

                            </td>


                            {{-- Used --}}
                            <td class="px-6 py-4 text-center">

                                <span class="font-semibold text-orange-600">
                                    {{ $allocation->used_days }}
                                </span>

                            </td>


                            {{-- Remaining --}}
                            <td class="px-6 py-4 text-center">

                                <span class="inline-flex items-center
                                    px-2.5 py-1 rounded-md
                                    {{ $remaining > 0
                                        ? 'bg-green-50 text-green-700'
                                        : 'bg-red-50 text-red-700' }}
                                    text-xs font-semibold">

                                    {{ $remaining }}

                                </span>

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4 text-center">

                                @if($allocation->status)

                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-full
                                                 bg-green-50 text-green-700
                                                 text-xs font-medium">

                                        <span class="w-1.5 h-1.5 mr-1.5
                                                     rounded-full bg-green-500"></span>

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-full
                                                 bg-red-50 text-red-700
                                                 text-xs font-medium">

                                        <span class="w-1.5 h-1.5 mr-1.5
                                                     rounded-full bg-red-500"></span>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route('leave-allocations.edit', $allocation) }}"
                                       class="inline-flex items-center justify-center
                                              w-9 h-9 rounded-lg
                                              bg-blue-50 text-blue-600
                                              hover:bg-blue-100 transition"
                                       title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    {{-- Delete --}}
                                    <form action="{{ route('leave-allocations.destroy', $allocation) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this leave allocation?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="inline-flex items-center justify-center
                                                       w-9 h-9 rounded-lg
                                                       bg-red-50 text-red-600
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
                                class="px-6 py-12 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-12 h-12 rounded-full
                                                bg-slate-100 flex items-center
                                                justify-center mb-3">

                                        <i class="bi bi-calendar-x
                                                  text-xl text-slate-400"></i>

                                    </div>

                                    <h3 class="text-sm font-semibold text-slate-700">
                                        No Leave Allocations Found
                                    </h3>

                                    <p class="text-xs text-slate-500 mt-1">
                                        Start by allocating leave to a teacher or staff member.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($leaveAllocations->hasPages())

            <div class="px-6 py-4 border-t border-slate-200">
                {{ $leaveAllocations->links() }}
            </div>

        @endif

    </div>

</div>

@endsection
