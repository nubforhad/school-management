@extends('admin.layouts.app')

@section('title', 'Salary Structures')

@section('page-title', 'Salary Structures')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">
 
{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

    <div>
        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
            Salary Structures
        </h1>

        <p class="mt-1 text-xs sm:text-sm text-slate-500">
            Manage teacher and staff salary structures
        </p>
    </div>

    <a href="{{ route('admin.salary-structures.create') }}"
       class="inline-flex items-center justify-center gap-2
              rounded-lg bg-blue-600 px-4 py-2.5
              text-sm font-semibold text-white
              hover:bg-blue-700 transition">

        <i class="bi bi-plus-lg"></i>

        Add Salary Structure

    </a>

</div>


{{-- Success Message --}}
@if(session('success'))

    <div class="mb-5 flex items-center gap-3
                rounded-lg border border-green-200
                bg-green-50 px-4 py-3">

        <div class="flex h-8 w-8 shrink-0 items-center justify-center
                    rounded-full bg-green-100 text-green-600">

            <i class="bi bi-check-circle"></i>

        </div>

        <p class="text-sm font-medium text-green-700">
            {{ session('success') }}
        </p>

    </div>

@endif


{{-- Statistics --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    {{-- Total --}}
    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-xs font-medium text-slate-500">
                    Total Structures
                </p>

                <p class="mt-1 text-2xl font-bold text-slate-800">
                    {{ $salaryStructures->total() }}
                </p>
            </div>

            <div class="flex h-10 w-10 items-center justify-center
                        rounded-lg bg-blue-50 text-blue-600">

                <i class="bi bi-wallet2 text-lg"></i>

            </div>

        </div>

    </div>


    {{-- Active --}}
    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-xs font-medium text-slate-500">
                    Active
                </p>

                <p class="mt-1 text-2xl font-bold text-green-600">
                    {{ $salaryStructures->where('status', true)->count() }}
                </p>
            </div>

            <div class="flex h-10 w-10 items-center justify-center
                        rounded-lg bg-green-50 text-green-600">

                <i class="bi bi-check-circle text-lg"></i>

            </div>

        </div>

    </div>


    {{-- Inactive --}}
    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-xs font-medium text-slate-500">
                    Inactive
                </p>

                <p class="mt-1 text-2xl font-bold text-red-600">
                    {{ $salaryStructures->where('status', false)->count() }}
                </p>
            </div>

            <div class="flex h-10 w-10 items-center justify-center
                        rounded-lg bg-red-50 text-red-600">

                <i class="bi bi-x-circle text-lg"></i>

            </div>

        </div>

    </div>


    {{-- Current Page --}}
    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-xs font-medium text-slate-500">
                    Showing
                </p>

                <p class="mt-1 text-2xl font-bold text-slate-800">
                    {{ $salaryStructures->count() }}
                </p>
            </div>

            <div class="flex h-10 w-10 items-center justify-center
                        rounded-lg bg-slate-100 text-slate-600">

                <i class="bi bi-list-ul text-lg"></i>

            </div>

        </div>

    </div>

</div>


{{-- Table Card --}}
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

    {{-- Table Header --}}
    <div class="px-4 sm:px-6 py-4 border-b border-slate-200 bg-slate-50">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div>

                <h2 class="font-semibold text-slate-800">
                    Salary Structure List
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Teacher and staff salary details
                </p>

            </div>

        </div>

    </div>


    {{-- Responsive Table --}}
    <div class="overflow-x-auto">

        <table class="w-full min-w-[1100px] text-sm">

            <thead class="bg-slate-50 border-b border-slate-200">

                <tr>

                    <th class="px-4 py-3 text-left font-semibold text-slate-600">
                        #
                    </th>

                    <th class="px-4 py-3 text-left font-semibold text-slate-600">
                        Teacher / Staff
                    </th>

                    <th class="px-4 py-3 text-left font-semibold text-slate-600">
                        Department
                    </th>

                    <th class="px-4 py-3 text-left font-semibold text-slate-600">
                        Designation
                    </th>

                    <th class="px-4 py-3 text-right font-semibold text-slate-600">
                        Basic
                    </th>

                    <th class="px-4 py-3 text-right font-semibold text-slate-600">
                        Gross
                    </th>

                    <th class="px-4 py-3 text-right font-semibold text-slate-600">
                        Deduction
                    </th>

                    <th class="px-4 py-3 text-right font-semibold text-slate-600">
                        Net Salary
                    </th>

                    <th class="px-4 py-3 text-center font-semibold text-slate-600">
                        Status
                    </th>

                    <th class="px-4 py-3 text-center font-semibold text-slate-600">
                        Action
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-slate-100">

                @forelse($salaryStructures as $salary)

                    <tr class="hover:bg-slate-50 transition">

                        {{-- Serial --}}
                        <td class="px-4 py-3 text-slate-500">

                            {{ $salaryStructures->firstItem() + $loop->index }}

                        </td>


                        {{-- Teacher --}}
                        <td class="px-4 py-3">

                            <div class="flex items-center gap-3">

                                @if($salary->teacherStaff?->photo)

                                    <img
                                        src="{{ asset('storage/' . $salary->teacherStaff->photo) }}"
                                        alt="{{ $salary->teacherStaff->name }}"
                                        class="h-9 w-9 rounded-full object-cover border border-slate-200"
                                    >

                                @else

                                    <div class="flex h-9 w-9 shrink-0
                                                items-center justify-center
                                                rounded-full bg-blue-50
                                                text-blue-600">

                                        <i class="bi bi-person"></i>

                                    </div>

                                @endif


                                <div>

                                    <p class="font-medium text-slate-800">

                                        {{ $salary->teacherStaff?->name ?? 'N/A' }}

                                    </p>

                                    @if($salary->teacherStaff?->employee_id)

                                        <p class="text-xs text-slate-400">

                                            {{ $salary->teacherStaff->employee_id }}

                                        </p>

                                    @endif

                                </div>

                            </div>

                        </td>


                        {{-- Department --}}
                        <td class="px-4 py-3 text-slate-600">

                            {{ $salary->teacherStaff?->department?->name ?? 'N/A' }}

                        </td>


                        {{-- Designation --}}
                        <td class="px-4 py-3 text-slate-600">

                            {{ $salary->teacherStaff?->designation?->name ?? 'N/A' }}

                        </td>


                        {{-- Basic --}}
                        <td class="px-4 py-3 text-right font-medium text-slate-700">

                            ৳{{ number_format((float) $salary->basic_salary, 2) }}

                        </td>


                        {{-- Gross --}}
                        <td class="px-4 py-3 text-right font-medium text-blue-600">

                            ৳{{ number_format((float) $salary->gross_salary, 2) }}

                        </td>


                        {{-- Deduction --}}
                        <td class="px-4 py-3 text-right font-medium text-red-600">

                            ৳{{ number_format((float) $salary->total_deduction, 2) }}

                        </td>


                        {{-- Net --}}
                        <td class="px-4 py-3 text-right font-semibold text-green-600">

                            ৳{{ number_format((float) $salary->net_salary, 2) }}

                        </td>


                        {{-- Status --}}
                        <td class="px-4 py-3 text-center">

                            @if($salary->status)

                                <span class="inline-flex items-center gap-1
                                             rounded-full bg-green-50
                                             px-2.5 py-1 text-xs
                                             font-medium text-green-700">

                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                    Active

                                </span>

                            @else

                                <span class="inline-flex items-center gap-1
                                             rounded-full bg-red-50
                                             px-2.5 py-1 text-xs
                                             font-medium text-red-700">

                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                    Inactive

                                </span>

                            @endif

                        </td>


                        {{-- Actions --}}
                        <td class="px-4 py-3">

                            <div class="flex items-center justify-center gap-2">

                                {{-- Edit --}}
                                <a href="{{ route('admin.salary-structures.edit', $salary->id) }}"
                                   title="Edit"
                                   class="inline-flex h-9 w-9 items-center justify-center
                                          rounded-lg bg-blue-50 text-blue-600
                                          hover:bg-blue-100 transition">

                                    <i class="bi bi-pencil-square"></i>

                                </a>


                                {{-- Delete --}}
                                <form action="{{ route('admin.salary-structures.destroy', $salary->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this salary structure?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            title="Delete"
                                            class="inline-flex h-9 w-9 items-center justify-center
                                                   rounded-lg bg-red-50 text-red-600
                                                   hover:bg-red-100 transition">

                                        <i class="bi bi-trash3"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="10" class="px-6 py-12 text-center">

                            <div class="flex flex-col items-center justify-center">

                                <div class="flex h-14 w-14 items-center justify-center
                                            rounded-full bg-slate-100 text-slate-400">

                                    <i class="bi bi-wallet2 text-2xl"></i>

                                </div>

                                <h3 class="mt-3 text-sm font-semibold text-slate-700">
                                    No Salary Structures Found
                                </h3>

                                <p class="mt-1 text-xs text-slate-500">
                                    Add a salary structure for a teacher or staff member.
                                </p>

                                <a href="{{ route('admin.salary-structures.create') }}"
                                   class="mt-4 inline-flex items-center gap-2
                                          rounded-lg bg-blue-600 px-4 py-2
                                          text-xs font-semibold text-white
                                          hover:bg-blue-700 transition">

                                    <i class="bi bi-plus-lg"></i>

                                    Add Salary Structure

                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    @if($salaryStructures->hasPages())

        <div class="px-4 sm:px-6 py-4 border-t border-slate-200 bg-white">

            {{ $salaryStructures->links() }}

        </div>

    @endif

</div> 

</div>

@endsection
