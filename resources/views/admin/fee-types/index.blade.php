@extends('admin.layouts.app')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        Header
    ========================================================== --}}

    <div class="mb-4 sm:mb-6">

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-3">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Fee Types
                </h1>

                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Manage fee categories used for student fee collection
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
                    flex items-center gap-2
                    rounded-lg border border-green-200
                    bg-green-50 px-4 py-3
                    text-sm text-green-700">

            <i class="bi bi-check-circle-fill"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- =========================================================
        Fee Types Table
    ========================================================== --}}

    <div class="bg-white rounded-xl shadow-sm
                border border-slate-200 overflow-hidden">

        <div class="p-3 sm:p-5
                    border-b border-slate-200">

            <div class="flex items-center gap-2">

                <div class="w-8 h-8 rounded-lg
                            bg-blue-50
                            flex items-center justify-center">

                    <i class="bi bi-wallet2 text-blue-600"></i>

                </div>

                <div>

                    <h2 class="text-base sm:text-lg
                               font-semibold text-slate-800">

                        Fee Type List

                    </h2>

                    <p class="text-xs sm:text-sm text-slate-500 mt-1">

                        Available fee categories

                    </p>

                </div>

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-xs sm:text-sm
                          min-w-[750px]">

                <thead class="bg-slate-50
                              border-b border-slate-200">

                    <tr>

                        <th class="px-3 sm:px-4 py-3 text-left">
                            #
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left">
                            Fee Type
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left">
                            Code
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left">
                            Description
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left">
                            Status
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($feeTypes as $feeType)

                        <tr class="hover:bg-slate-50 transition">

                            {{-- Serial --}}

                            <td class="px-3 sm:px-4 py-3">

                                {{ $loop->iteration }}

                            </td>


                            {{-- Name --}}

                            <td class="px-3 sm:px-4 py-3">

                                <div class="font-semibold text-slate-700">

                                    {{ $feeType->name }}

                                </div>

                            </td>


                            {{-- Code --}}

                            <td class="px-3 sm:px-4 py-3">

                                @if($feeType->code)

                                    <span class="inline-flex
                                                 px-2.5 py-1
                                                 rounded-md
                                                 bg-slate-100
                                                 text-slate-700">

                                        {{ $feeType->code }}

                                    </span>

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Description --}}

                            <td class="px-3 sm:px-4 py-3
                                       text-slate-500">

                                {{ $feeType->description ?: '—' }}

                            </td>


                            {{-- Status --}}

                            <td class="px-3 sm:px-4 py-3">

                                @if($feeType->status)

                                    <span class="inline-flex
                                                 px-2.5 py-1
                                                 rounded-full
                                                 bg-green-50
                                                 text-green-700
                                                 border border-green-200">

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex
                                                 px-2.5 py-1
                                                 rounded-full
                                                 bg-red-50
                                                 text-red-700
                                                 border border-red-200">

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Action --}}

                            <td class="px-3 sm:px-4 py-3">

                                <div class="flex items-center gap-2">

                                    {{-- Edit --}}

                                    <a href="{{ route(
                                        'admin.fee-types.edit',
                                        $feeType->id
                                    ) }}"
                                    class="inline-flex items-center
                                           justify-center gap-1.5
                                           px-3 py-2 rounded-lg
                                           bg-blue-50 text-blue-600
                                           hover:bg-blue-100 transition">

                                        <i class="bi bi-pencil-square"></i>

                                        Edit

                                    </a>


                                    {{-- Status --}}

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
                                                       gap-1.5
                                                       px-3 py-2
                                                       rounded-lg
                                                       bg-slate-100
                                                       text-slate-700
                                                       hover:bg-slate-200
                                                       transition">

                                            <i class="bi bi-toggle-on"></i>

                                            Status

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

                            <td colspan="6"
                                class="px-4 py-12 text-center">

                                <div class="flex flex-col
                                            items-center">

                                    <div class="w-14 h-14
                                                rounded-full
                                                bg-slate-100
                                                flex items-center
                                                justify-center mb-3">

                                        <i class="bi bi-wallet2
                                                  text-2xl
                                                  text-slate-400"></i>

                                    </div>

                                    <h3 class="text-sm font-semibold
                                               text-slate-700">

                                        No Fee Types Found

                                    </h3>

                                    <p class="text-xs sm:text-sm
                                              text-slate-500 mt-1">

                                        Create your first fee type
                                        to start fee management.

                                    </p>

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