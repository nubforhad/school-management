@extends('admin.layouts.app')

@section('title', 'Class Subject Details')
@section('page-title', 'Class Subject Details')

@section('content')

<div class="w-full space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <a
                href="{{ route('admin.academic.class-subjects.index') }}"
                class="text-sm font-medium text-blue-600 hover:text-blue-700">

                ← Back to Class Subjects

            </a>

            <h1 class="mt-3 text-2xl font-bold text-slate-900 sm:text-3xl">
                Class Subject Details
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                View complete assignment information.
            </p>

        </div>


        <a
            href="{{ route('admin.academic.class-subjects.edit', $classSubject) }}"
            class="inline-flex items-center justify-center rounded-xl
                   bg-blue-600 px-5 py-2.5 text-sm font-semibold
                   text-white hover:bg-blue-700">

            Edit Assignment

        </a>

    </div>


    {{-- Main --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


        {{-- Main Information --}}
        <div class="lg:col-span-2">

            <div class="overflow-hidden rounded-2xl border border-slate-200
                        bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-slate-50
                            px-5 py-5 sm:px-6 lg:px-8">

                    <h2 class="font-semibold text-slate-900">
                        Assignment Information
                    </h2>

                </div>


                <div class="grid grid-cols-1 gap-6 p-5 sm:grid-cols-2
                            sm:p-6 lg:p-8">


                    {{-- Branch --}}
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Branch
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $classSubject->branch->name ?? '—' }}
                        </p>

                    </div>


                    {{-- Class --}}
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Class
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $classSubject->schoolClass->name ?? '—' }}
                        </p>

                    </div>


                    {{-- Subject --}}
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Subject
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $classSubject->subject->name ?? '—' }}
                        </p>

                        @if($classSubject->subject?->name_bn)

                            <p class="mt-1 text-sm text-slate-500">
                                {{ $classSubject->subject->name_bn }}
                            </p>

                        @endif

                    </div>


                    {{-- Code --}}
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Subject Code
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $classSubject->subject->code ?? '—' }}
                        </p>

                    </div>


                    {{-- Type --}}
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Subject Type
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">

                            @php

                                $type = $classSubject->subject->type ?? null;

                                $typeLabel = match($type) {
                                    'theory' => 'Theory',
                                    'practical' => 'Practical',
                                    'both' => 'Theory + Practical',
                                    default => '—',
                                };

                            @endphp

                            {{ $typeLabel }}

                        </p>

                    </div>


                    {{-- Full Marks --}}
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Full Marks
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $classSubject->subject->full_marks ?? '—' }}
                        </p>

                    </div>


                    {{-- Pass Marks --}}
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Pass Marks
                        </p>

                        <p class="mt-2 text-lg font-semibold text-red-600">
                            {{ $classSubject->subject->pass_marks ?? '—' }}
                        </p>

                    </div>


                    {{-- Sort --}}
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Sort Order
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $classSubject->sort_order }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- Status Card --}}
        <div class="space-y-6">


            <div class="rounded-2xl border border-slate-200
                        bg-white p-6 shadow-sm">

                <h2 class="font-semibold text-slate-900">
                    Assignment Status
                </h2>


                <div class="mt-5">

                    @if($classSubject->status)

                        <div class="rounded-xl border border-green-200
                                    bg-green-50 p-4">

                            <p class="text-sm font-bold text-green-700">
                                Active
                            </p>

                            <p class="mt-1 text-xs text-green-600">
                                This subject assignment is currently active.
                            </p>

                        </div>

                    @else

                        <div class="rounded-xl border border-red-200
                                    bg-red-50 p-4">

                            <p class="text-sm font-bold text-red-700">
                                Inactive
                            </p>

                            <p class="mt-1 text-xs text-red-600">
                                This subject assignment is currently inactive.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- Optional --}}
            <div class="rounded-2xl border border-slate-200
                        bg-white p-6 shadow-sm">

                <h2 class="font-semibold text-slate-900">
                    Subject Category
                </h2>


                <div class="mt-5">

                    @if($classSubject->is_optional)

                        <div class="rounded-xl border border-amber-200
                                    bg-amber-50 p-4">

                            <p class="text-sm font-bold text-amber-700">
                                Optional Subject
                            </p>

                            <p class="mt-1 text-xs text-amber-600">
                                Students may take this subject as an optional subject.
                            </p>

                        </div>

                    @else

                        <div class="rounded-xl border border-blue-200
                                    bg-blue-50 p-4">

                            <p class="text-sm font-bold text-blue-700">
                                Compulsory Subject
                            </p>

                            <p class="mt-1 text-xs text-blue-600">
                                This subject is mandatory for the class.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- Delete --}}
            <div class="rounded-2xl border border-red-200
                        bg-white p-6 shadow-sm">

                <h2 class="font-semibold text-slate-900">
                    Danger Zone
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Delete this class-subject assignment.
                </p>

                <form
                    action="{{ route('admin.academic.class-subjects.destroy', $classSubject) }}"
                    method="POST"
                    class="mt-4"
                    onsubmit="return confirm('Are you sure you want to delete this assignment?')">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-red-600 px-5 py-2.5
                               text-sm font-semibold text-white
                               hover:bg-red-700">

                        Delete Assignment

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection