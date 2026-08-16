@extends('admin.layouts.app')

@section('title', 'Session Details')
@section('page-title', 'Session Details')

@section('content')

<div class="w-full space-y-6">


    {{-- Header --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <a
                href="{{ route('admin.academic.sessions.index') }}"
                class="inline-flex items-center gap-1 text-sm font-medium text-blue-600 hover:text-blue-700">

                ← Back to Sessions

            </a>

            <div class="mt-3 flex flex-wrap items-center gap-3">

                <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">

                    {{ $session->name }}

                </h1>


                @if($session->is_current)

                    <span
                        class="rounded-full bg-blue-100 px-3 py-1
                               text-xs font-semibold text-blue-700">

                        Current Session

                    </span>

                @endif


                @if($session->status)

                    <span
                        class="rounded-full bg-green-100 px-3 py-1
                               text-xs font-semibold text-green-700">

                        Active

                    </span>

                @else

                    <span
                        class="rounded-full bg-red-100 px-3 py-1
                               text-xs font-semibold text-red-700">

                        Inactive

                    </span>

                @endif

            </div>

            <p class="mt-1 text-sm text-slate-500">

                Academic session details and branch information.

            </p>

        </div>


        <div class="flex flex-col gap-2 sm:flex-row">

            <a
                href="{{ route('admin.academic.sessions.edit', $session) }}"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl bg-blue-600 px-5 py-2.5
                       text-sm font-semibold text-white
                       hover:bg-blue-700">

                ✏️
                Edit Session

            </a>

        </div>

    </div>


    {{-- Main Information --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">


        {{-- Main Card --}}
        <div class="xl:col-span-2">

            <div class="overflow-hidden rounded-2xl border border-slate-200
                        bg-white shadow-sm">


                <div class="border-b border-slate-200 bg-slate-50/70
                            px-5 py-5 sm:px-6 lg:px-8">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center
                                   rounded-lg bg-blue-100 text-xl">

                            📅

                        </div>

                        <div>

                            <h2 class="text-base font-semibold text-slate-900">
                                Session Information
                            </h2>

                            <p class="text-sm text-slate-500">
                                Basic academic session information.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-5 sm:p-6 lg:p-8">

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">


                        {{-- Session --}}
                        <div>

                            <p class="text-xs font-semibold uppercase
                                      tracking-wider text-slate-400">

                                Session Name

                            </p>

                            <p class="mt-2 text-lg font-semibold text-slate-900">

                                {{ $session->name }}

                            </p>

                        </div>


                        {{-- Branch --}}
                        <div>

                            <p class="text-xs font-semibold uppercase
                                      tracking-wider text-slate-400">

                                Branch

                            </p>

                            <p class="mt-2 text-lg font-semibold text-slate-900">

                                {{ $session->branch->name }}

                            </p>

                            @if($session->branch->code)

                                <p class="mt-1 text-xs text-slate-500">

                                    Code:
                                    {{ $session->branch->code }}

                                </p>

                            @endif

                        </div>


                        {{-- Start Date --}}
                        <div>

                            <p class="text-xs font-semibold uppercase
                                      tracking-wider text-slate-400">

                                Start Date

                            </p>

                            <p class="mt-2 text-base font-medium text-slate-800">

                                {{ $session->start_date?->format('d F Y') ?? 'Not specified' }}

                            </p>

                        </div>


                        {{-- End Date --}}
                        <div>

                            <p class="text-xs font-semibold uppercase
                                      tracking-wider text-slate-400">

                                End Date

                            </p>

                            <p class="mt-2 text-base font-medium text-slate-800">

                                {{ $session->end_date?->format('d F Y') ?? 'Not specified' }}

                            </p>

                        </div>


                        {{-- Current --}}
                        <div>

                            <p class="text-xs font-semibold uppercase
                                      tracking-wider text-slate-400">

                                Current Session

                            </p>

                            <div class="mt-2">

                                @if($session->is_current)

                                    <span
                                        class="inline-flex rounded-full bg-blue-100
                                               px-3 py-1.5 text-xs font-semibold
                                               text-blue-700">

                                        ✓ Yes, Current

                                    </span>

                                @else

                                    <span
                                        class="inline-flex rounded-full bg-slate-100
                                               px-3 py-1.5 text-xs font-semibold
                                               text-slate-600">

                                        No

                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- Status --}}
                        <div>

                            <p class="text-xs font-semibold uppercase
                                      tracking-wider text-slate-400">

                                Status

                            </p>

                            <div class="mt-2">

                                @if($session->status)

                                    <span
                                        class="inline-flex rounded-full bg-green-100
                                               px-3 py-1.5 text-xs font-semibold
                                               text-green-700">

                                        ● Active

                                    </span>

                                @else

                                    <span
                                        class="inline-flex rounded-full bg-red-100
                                               px-3 py-1.5 text-xs font-semibold
                                               text-red-700">

                                        ● Inactive

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Summary Card --}}
        <div>

            <div class="overflow-hidden rounded-2xl border border-slate-200
                        bg-white shadow-sm">

                <div class="border-b border-slate-200 px-5 py-5">

                    <h2 class="font-semibold text-slate-900">
                        Quick Summary
                    </h2>

                </div>


                <div class="space-y-5 p-5">


                    <div class="rounded-xl bg-blue-50 p-4">

                        <p class="text-xs font-medium text-blue-600">
                            Academic Session
                        </p>

                        <p class="mt-1 text-xl font-bold text-blue-900">
                            {{ $session->name }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-slate-50 p-4">

                        <p class="text-xs font-medium text-slate-500">
                            Branch
                        </p>

                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $session->branch->name }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-slate-50 p-4">

                        <p class="text-xs font-medium text-slate-500">
                            Duration
                        </p>

                        <p class="mt-1 font-semibold text-slate-900">

                            @if($session->start_date && $session->end_date)

                                {{ $session->start_date->format('d M Y') }}
                                —
                                {{ $session->end_date->format('d M Y') }}

                            @else

                                Not specified

                            @endif

                        </p>

                    </div>


                    <a
                        href="{{ route('admin.academic.sessions.edit', $session) }}"

                        class="flex w-full items-center justify-center
                               rounded-xl bg-blue-600 px-4 py-3
                               text-sm font-semibold text-white
                               hover:bg-blue-700">

                        Edit Session

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection