@extends('admin.layouts.app')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

     <!-- Header  -->

    <div class="mb-4 sm:mb-6">

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-3">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Fee Types
                </h1>

                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Manage fee types for your branch
                </p>

            </div>

            <a href="{{ route('admin.fee-types.create') }}"
               class="w-full sm:w-auto
                      inline-flex items-center justify-center gap-2
                      px-4 py-2.5 rounded-lg
                      bg-blue-600 text-white
                      text-sm font-medium
                      hover:bg-blue-700 transition">

                <i class="bi bi-plus-lg"></i>

                Add Fee Type

            </a>

        </div>

    </div>


    {{-- =========================================================
        Success Message
    ========================================================== --}}

    @if(session('success'))

        <div class="mb-4 sm:mb-6
                    flex items-center gap-3
                    rounded-lg
                    border border-green-200
                    bg-green-50
                    px-4 py-3
                    text-sm text-green-700">

            <i class="bi bi-check-circle-fill"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- ==========  Error Message ====================================== --}}

    @if($errors->any())

        <div class="mb-4 sm:mb-6
                    rounded-lg
                    border border-red-200
                    bg-red-50
                    px-4 py-3
                    text-sm text-red-700">

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


    {{-- =========================================================
        Fee Type Table
    ========================================================== --}}

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        {{-- Table Header --}}
        <div class="p-3 sm:p-5 border-b border-slate-200">

            <div class="flex flex-col sm:flex-row
                        sm:items-center sm:justify-between gap-2">

                <div>

                    <h2 class="text-base sm:text-lg
                               font-semibold text-slate-800">

                        Fee Type List

                    </h2>

                    <p class="text-xs sm:text-sm text-slate-500 mt-1">

                        Available fee types in your branch

                    </p>

                </div>


                <div class="text-xs sm:text-sm text-slate-500">

                    Total:
                    <span class="font-semibold text-slate-700">
                        {{ $feeTypes->count() }}
                    </span>

                </div>

            </div>

        </div>


        {{-- Table --}}

        <div class="overflow-x-auto">

            <table class="w-full text-xs sm:text-sm min-w-[800px]">

                <thead class="bg-slate-50
                              border-b border-slate-200">

                    <tr>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            #
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Fee Type
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Code
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Branch
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Description
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-right
                                   font-semibold text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($feeTypes as $feeType)

                        <tr class="hover:bg-slate-50 transition">


                            {{-- Serial --}}

                            <td class="px-3 sm:px-4 py-3
                                       text-slate-500">

                                {{ $loop->iteration }}

                            </td>


                            {{-- Name --}}

                            <td class="px-3 sm:px-4 py-3">

                                <div class="flex items-center gap-3">

                                    <div class="w-9 h-9 rounded-lg
                                                bg-blue-50
                                                flex items-center
                                                justify-center
                                                flex-shrink-0">

                                        <i class="bi bi-receipt
                                                  text-blue-600"></i>

                                    </div>

                                    <div>

                                        <div class="font-semibold
                                                    text-slate-800">

                                            {{ $feeType->name }}

                                        </div>

                                        <div class="text-xs text-slate-400">

                                            Fee Type

                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- Code --}}

                            <td class="px-3 sm:px-4 py-3">

                                @if($feeType->code)

                                    <span class="inline-flex
                                                 px-2.5 py-1
                                                 rounded-md
                                                 bg-slate-100
                                                 text-slate-700
                                                 border border-slate-200
                                                 text-xs font-medium">

                                        {{ $feeType->code }}

                                    </span>

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Branch --}}

                            <td class="px-3 sm:px-4 py-3">

                                <span class="text-slate-700">

                                    {{ $feeType->branch->name ?? 'N/A' }}

                                </span>

                            </td>


                            {{-- Description --}}

                            <td class="px-3 sm:px-4 py-3
                                       text-slate-500
                                       max-w-xs">

                                @if($feeType->description)

                                    {{ \Illuminate\Support\Str::limit(
                                        $feeType->description,
                                        60
                                    ) }}

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}

                            <td class="px-3 sm:px-4 py-3">

                                @if($feeType->status)

                                    <span class="inline-flex
                                                 items-center gap-1.5
                                                 px-2.5 py-1
                                                 rounded-full
                                                 bg-green-50
                                                 text-green-700
                                                 border border-green-200">

                                        <span class="w-1.5 h-1.5
                                                     rounded-full
                                                     bg-green-500">
                                        </span>

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex
                                                 items-center gap-1.5
                                                 px-2.5 py-1
                                                 rounded-full
                                                 bg-red-50
                                                 text-red-700
                                                 border border-red-200">

                                        <span class="w-1.5 h-1.5
                                                     rounded-full
                                                     bg-red-500">
                                        </span>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Action --}}

                            <td class="px-3 sm:px-4 py-3">

                                <div class="flex items-center
                                            justify-end gap-2">


                                    {{-- Edit --}}

                                    <a href="{{ route(
                                        'admin.fee-types.edit',
                                        $feeType->id
                                    ) }}"
                                    class="inline-flex
                                           items-center justify-center
                                           w-9 h-9
                                           rounded-lg
                                           bg-blue-50
                                           text-blue-600
                                           hover:bg-blue-100
                                           transition"
                                    title="Edit">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>


                                    {{-- Toggle --}}

                                    <form method="POST"
                                          action="{{ route(
                                              'admin.fee-types.toggle-status',
                                              $feeType->id
                                          ) }}">

                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                                class="inline-flex
                                                       items-center
                                                       justify-center
                                                       w-9 h-9
                                                       rounded-lg
                                                       {{ $feeType->status
                                                            ? 'bg-yellow-50 text-yellow-600 hover:bg-yellow-100'
                                                            : 'bg-green-50 text-green-600 hover:bg-green-100'
                                                       }}
                                                       transition"
                                                title="{{ $feeType->status ? 'Deactivate' : 'Activate' }}">

                                            <i class="bi
                                                {{ $feeType->status
                                                    ? 'bi-toggle-on'
                                                    : 'bi-toggle-off'
                                                }}">
                                            </i>

                                        </button>

                                    </form>


                                    {{-- Delete --}}

                                    <form method="POST"
                                          action="{{ route(
                                              'admin.fee-types.destroy',
                                              $feeType->id
                                          ) }}"
                                          onsubmit="return confirm(
                                              'Are you sure you want to delete this fee type?'
                                          )">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="inline-flex
                                                       items-center
                                                       justify-center
                                                       w-9 h-9
                                                       rounded-lg
                                                       bg-red-50
                                                       text-red-600
                                                       hover:bg-red-100
                                                       transition"
                                                title="Delete">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="px-4 py-12 text-center">

                                <div class="flex flex-col
                                            items-center">

                                    <div class="w-16 h-16
                                                rounded-full
                                                bg-blue-50
                                                flex items-center
                                                justify-center mb-4">

                                        <i class="bi bi-receipt
                                                  text-3xl
                                                  text-blue-600"></i>

                                    </div>

                                    <h3 class="text-sm sm:text-base
                                               font-semibold
                                               text-slate-700">

                                        No Fee Types Found

                                    </h3>

                                    <p class="text-xs sm:text-sm
                                              text-slate-500 mt-1">

                                        Create your first fee type
                                        for this branch.

                                    </p>

                                    <a href="{{ route(
                                        'admin.fee-types.create'
                                    ) }}"
                                    class="mt-4
                                           inline-flex
                                           items-center gap-2
                                           px-4 py-2.5
                                           rounded-lg
                                           bg-blue-600
                                           text-white
                                           text-sm
                                           font-medium
                                           hover:bg-blue-700
                                           transition">

                                        <i class="bi bi-plus-lg"></i>

                                        Add Fee Type

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection