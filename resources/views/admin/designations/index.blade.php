@extends('admin.layouts.app')

@section('title', 'Designations')
@section('page-title', 'Designations')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Header --}}
    <div class="mb-6">

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-4">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Designations
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    Manage teacher and staff designations
                </p>

            </div>


            <a href="{{ route('admin.designations.create') }}"
               class="inline-flex items-center justify-center gap-2
                      rounded-lg bg-blue-600 px-4 py-2.5
                      text-sm font-semibold text-white
                      hover:bg-blue-700 transition">

                <i class="bi bi-plus-lg"></i>

                Add Designation

            </a>

        </div>

    </div>


    {{-- Success --}}
    @if(session('success'))

        <div class="mb-5 rounded-lg border border-green-200
                    bg-green-50 px-4 py-3">

            <div class="flex items-center gap-3">

                <div class="flex h-8 w-8 items-center justify-center
                            rounded-full bg-green-100 text-green-600">

                    <i class="bi bi-check-lg"></i>

                </div>

                <div>

                    <p class="text-sm font-semibold text-green-800">
                        Success
                    </p>

                    <p class="text-sm text-green-700">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        </div>

    @endif


    {{-- Table --}}
    <div class="bg-white rounded-xl border border-slate-200
                shadow-sm overflow-hidden">

        {{-- Table Header --}}
        <div class="px-4 sm:px-5 py-4 border-b border-slate-200">

            <h2 class="font-semibold text-slate-800">
                Designation List
            </h2>

            <p class="mt-1 text-xs text-slate-500">
                All designations available in your branch
            </p>

        </div>


        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            #
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Designation
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Code
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Branch
                        </th>

                        <th class="px-4 py-3 text-center
                                   font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="px-4 py-3 text-right
                                   font-semibold text-slate-600">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($designations as $designation)

                        <tr class="hover:bg-slate-50 transition">


                            {{-- Number --}}
                            <td class="px-4 py-4 text-slate-500">

                                {{ $designations->firstItem() + $loop->index }}

                            </td>


                            {{-- Designation --}}
                            <td class="px-4 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0
                                                items-center justify-center
                                                rounded-lg bg-blue-50
                                                text-blue-600">

                                        <i class="bi bi-person-badge"></i>

                                    </div>


                                    <div>

                                        <p class="font-semibold text-slate-800">

                                            {{ $designation->name }}

                                        </p>


                                        @if($designation->description)

                                            <p class="text-xs text-slate-400
                                                      mt-0.5 max-w-xs truncate">

                                                {{ $designation->description }}

                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Code --}}
                            <td class="px-4 py-4">

                                @if($designation->code)

                                    <span class="inline-flex items-center
                                                 rounded-md bg-slate-100
                                                 px-2 py-1 text-xs
                                                 font-medium text-slate-600">

                                        {{ $designation->code }}

                                    </span>

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Branch --}}
                            <td class="px-4 py-4 text-slate-700">

                                {{ $designation->branch->name ?? 'N/A' }}

                            </td>


                            {{-- Status --}}
                            <td class="px-4 py-4 text-center">

                                @if($designation->status)

                                    <span class="inline-flex items-center gap-1.5
                                                 rounded-full bg-green-50
                                                 px-2.5 py-1 text-xs
                                                 font-medium text-green-700">

                                        <span class="h-1.5 w-1.5 rounded-full
                                                     bg-green-500"></span>

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5
                                                 rounded-full bg-red-50
                                                 px-2.5 py-1 text-xs
                                                 font-medium text-red-700">

                                        <span class="h-1.5 w-1.5 rounded-full
                                                     bg-red-500"></span>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-4 py-4">

                                <div class="flex items-center
                                            justify-end gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route(
                                        'admin.designations.edit',
                                        $designation
                                    ) }}"
                                       title="Edit"
                                       class="inline-flex h-9 w-9
                                              items-center justify-center
                                              rounded-lg border
                                              border-blue-200
                                              bg-blue-50
                                              text-blue-600
                                              hover:bg-blue-100 transition">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>


                                    {{-- Delete --}}
                                    <form method="POST"
                                          action="{{ route(
                                              'admin.designations.destroy',
                                              $designation
                                          ) }}"
                                          onsubmit="return confirm(
                                              'Are you sure you want to delete this designation?'
                                          )">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                title="Delete"
                                                class="inline-flex h-9 w-9
                                                       items-center justify-center
                                                       rounded-lg border
                                                       border-red-200
                                                       bg-red-50
                                                       text-red-600
                                                       hover:bg-red-100 transition">

                                            <i class="bi bi-trash3"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="6"
                                class="px-4 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="flex h-16 w-16
                                                items-center justify-center
                                                rounded-full bg-blue-50
                                                text-blue-600">

                                        <i class="bi bi-person-badge text-3xl"></i>

                                    </div>


                                    <h3 class="mt-4 text-base
                                               font-semibold text-slate-700">

                                        No Designations Found

                                    </h3>


                                    <p class="mt-1 text-sm text-slate-500">

                                        Create your first designation.

                                    </p>


                                    <a href="{{ route(
                                        'admin.designations.create'
                                    ) }}"
                                       class="mt-5 inline-flex items-center
                                              gap-2 rounded-lg bg-blue-600
                                              px-4 py-2.5 text-sm
                                              font-semibold text-white
                                              hover:bg-blue-700 transition">

                                        <i class="bi bi-plus-lg"></i>

                                        Add Designation

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($designations->hasPages())

            <div class="px-4 py-4 border-t border-slate-200">

                {{ $designations->links() }}

            </div>

        @endif

    </div>

</div>

@endsection 
