@extends('admin.layouts.app')

@section('title', 'Section Details')
@section('page-title', 'Section Details')

@section('content')

<div class="w-full space-y-6">


    {{-- Header --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <a
                href="{{ route('admin.academic.sections.index') }}"
                class="text-sm font-medium text-blue-600">

                ← Back to Sections

            </a>

            <div class="mt-3 flex flex-wrap items-center gap-3">

                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">
                    {{ $section->name }}
                </h1>

                @if($section->status)

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
                Section details and academic information.
            </p>

        </div>


        <a
            href="{{ route('admin.academic.sections.edit', $section) }}"
            class="inline-flex items-center justify-center rounded-xl
                   bg-blue-600 px-5 py-2.5 text-sm font-semibold
                   text-white hover:bg-blue-700">

            Edit Section

        </a>

    </div>


    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">


        {{-- Details --}}
        <div class="xl:col-span-2">

            <div class="overflow-hidden rounded-2xl border border-slate-200
                        bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-slate-50
                            px-5 py-5 sm:px-6 lg:px-8">

                    <h2 class="font-semibold text-slate-900">
                        Section Information
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Basic information about this section.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-6 p-5 sm:grid-cols-2
                            sm:p-6 lg:p-8">


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Section Name
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $section->name }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Section Code
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $section->code ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Branch
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $section->branch->name ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Class
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $section->schoolClass->name ?? $section->class->name ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Sort Order
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $section->sort_order ?? 0 }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Created
                        </p>

                        <p class="mt-2 text-sm font-medium text-slate-700">
                            {{ $section->created_at?->format('d M Y, h:i A') ?? '—' }}
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
                            Section
                        </p>

                        <p class="mt-1 text-xl font-bold text-blue-900">
                            {{ $section->name }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-purple-50 p-4">

                        <p class="text-xs font-medium text-purple-600">
                            Class
                        </p>

                        <p class="mt-1 font-semibold text-purple-900">
                            {{ $section->schoolClass->name ?? $section->class->name ?? '—' }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-slate-50 p-4">

                        <p class="text-xs font-medium text-slate-500">
                            Branch
                        </p>

                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $section->branch->name ?? '—' }}
                        </p>

                    </div>

                </div>

            </div>  

        </div>

    </div>

</div>

@endsection