@extends('admin.layouts.app')

@section('title', 'Class Details')
@section('page-title', 'Class Details')

@section('content')

<div class="w-full space-y-6">


    {{-- Header --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <a
                href="{{ route('admin.academic.classes.index') }}"
                class="text-sm font-medium text-blue-600">

                ← Back to Classes

            </a>

            <div class="mt-3 flex flex-wrap items-center gap-3">

                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">
                    {{ $class->name }}
                </h1>


                @if($class->status)

                    <span class="rounded-full bg-green-100 px-3 py-1
                                 text-xs font-semibold text-green-700">

                        Active

                    </span>

                @else

                    <span class="rounded-full bg-red-100 px-3 py-1
                                 text-xs font-semibold text-red-700">

                        Inactive

                    </span>

                @endif

            </div>

            <p class="mt-1 text-sm text-slate-500">
                Class details and branch information.
            </p>

        </div>


        <a
            href="{{ route('admin.academic.classes.edit', $class) }}"

            class="inline-flex items-center justify-center gap-2
                   rounded-xl bg-blue-600 px-5 py-2.5
                   text-sm font-semibold text-white
                   hover:bg-blue-700">

            ✏️
            Edit Class

        </a>

    </div>


    {{-- Main --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">


        {{-- Information --}}
        <div class="xl:col-span-2">

            <div class="overflow-hidden rounded-2xl border border-slate-200
                        bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-slate-50
                            px-5 py-5 sm:px-6 lg:px-8">

                    <h2 class="font-semibold text-slate-900">
                        Class Information
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Basic information about this class.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-6 p-5 sm:grid-cols-2
                            sm:p-6 lg:p-8">


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Class Name
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $class->name }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Class Code
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $class->code ?? 'Not specified' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Branch
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $class->branch->name }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Sort Order
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $class->sort_order }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Status
                        </p>

                        <div class="mt-2">

                            @if($class->status)

                                <span class="rounded-full bg-green-100 px-3 py-1.5
                                             text-xs font-semibold text-green-700">

                                    ● Active

                                </span>

                            @else

                                <span class="rounded-full bg-red-100 px-3 py-1.5
                                             text-xs font-semibold text-red-700">

                                    ● Inactive

                                </span>

                            @endif

                        </div>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Created
                        </p>

                        <p class="mt-2 text-sm font-medium text-slate-700">
                            {{ $class->created_at?->format('d M Y, h:i A') ?? '—' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- Summary --}}
        <div>

            <div class="overflow-hidden rounded-2xl border border-slate-200
                        bg-white shadow-sm">

                <div class="border-b border-slate-200 px-5 py-5">

                    <h2 class="font-semibold text-slate-900">
                        Quick Summary
                    </h2>

                </div>


                <div class="space-y-4 p-5">


                    <div class="rounded-xl bg-blue-50 p-4">

                        <p class="text-xs font-medium text-blue-600">
                            Class
                        </p>

                        <p class="mt-1 text-xl font-bold text-blue-900">
                            {{ $class->name }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-slate-50 p-4">

                        <p class="text-xs font-medium text-slate-500">
                            Branch
                        </p>

                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $class->branch->name }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-slate-50 p-4">

                        <p class="text-xs font-medium text-slate-500">
                            Sections
                        </p>

                        <p class="mt-1 text-2xl font-bold text-slate-900">
                            {{ $class->sections->count() }}
                        </p>

                    </div>


                    <a
                        href="{{ route('admin.academic.classes.edit', $class) }}"

                        class="flex w-full items-center justify-center
                               rounded-xl bg-blue-600 px-4 py-3
                               text-sm font-semibold text-white
                               hover:bg-blue-700">

                        Edit Class

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection