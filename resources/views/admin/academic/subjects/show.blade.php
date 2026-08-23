@extends('admin.layouts.app')

@section('title', 'Subject Details')
@section('page-title', 'Subject Details')

@section('content')

<div class="w-full space-y-6">


    {{-- Header --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <a
                href="{{ route('admin.academic.subjects.index') }}"
                class="text-sm font-medium text-blue-600 hover:text-blue-700">

                ← Back to Subjects

            </a>

            <div class="mt-3 flex flex-wrap items-center gap-3">

                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">
                    {{ $subject->name }}
                </h1>

                @if($subject->status)

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

            @if($subject->name_bn)

                <p class="mt-1 text-sm text-slate-500">
                    {{ $subject->name_bn }}
                </p>

            @endif

        </div>


        <a
            href="{{ route('admin.academic.subjects.edit', $subject) }}"
            class="inline-flex items-center justify-center rounded-xl
                   bg-blue-600 px-5 py-2.5 text-sm font-semibold
                   text-white hover:bg-blue-700">

            Edit Subject

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
                        Subject Information
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Basic information about this subject.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-6 p-5 sm:grid-cols-2
                            sm:p-6 lg:p-8">


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Subject Name
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $subject->name }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Bangla Name
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $subject->name_bn ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Branch
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $subject->branch->name ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Subject Code
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $subject->code ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Subject Type
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ ucfirst($subject->type) }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Full Marks
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $subject->full_marks }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Pass Marks
                        </p>

                        <p class="mt-2 text-lg font-semibold text-red-600">
                            {{ $subject->pass_marks }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Created
                        </p>

                        <p class="mt-2 text-sm font-medium text-slate-700">
                            {{ $subject->created_at?->format('d M Y, h:i A') ?? '—' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- Classes --}}
        <div>

            <div class="overflow-hidden rounded-2xl border border-slate-200
                        bg-white shadow-sm">

                <div class="border-b border-slate-200 px-5 py-5">

                    <h2 class="font-semibold text-slate-900">
                        Assigned Classes
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Classes using this subject.
                    </p>

                </div>


                <div class="p-5">

                    @forelse($subject->classSubjects as $classSubject)

                        <div class="mb-3 rounded-xl border border-slate-200
                                    bg-slate-50 p-4 last:mb-0">

                            <p class="font-semibold text-slate-800">

                                {{ $classSubject->schoolClass->name ?? 'Unknown Class' }}

                            </p>

                            @if($classSubject->is_optional)

                                <span class="mt-2 inline-block rounded-full
                                             bg-amber-100 px-2.5 py-1 text-[11px]
                                             font-semibold text-amber-700">

                                    Optional

                                </span>

                            @else

                                <span class="mt-2 inline-block rounded-full
                                             bg-blue-100 px-2.5 py-1 text-[11px]
                                             font-semibold text-blue-700">

                                    Compulsory

                                </span>

                            @endif

                        </div>

                    @empty

                        <div class="rounded-xl bg-slate-50 p-6 text-center">

                            <div class="text-3xl">
                                📚
                            </div>

                            <p class="mt-2 text-sm font-medium text-slate-600">
                                No class assigned yet.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

@endsection