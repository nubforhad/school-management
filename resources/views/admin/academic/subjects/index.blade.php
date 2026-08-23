@extends('admin.layouts.app')

@section('title', 'Subjects')
@section('page-title', 'Subjects')

@section('content')

<div class="w-full space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Subjects
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage academic subjects branch-wise.
            </p>
        </div>

        <a
            href="{{ route('admin.academic.subjects.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl
                   bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white
                   shadow-sm transition hover:bg-blue-700">

            <span class="text-lg">+</span>
            Add Subject

        </a>

    </div>


    {{-- Success --}}
    @if(session('success'))

        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3">

            <p class="text-sm font-medium text-green-700">
                {{ session('success') }}
            </p>

        </div>

    @endif


    {{-- Errors --}}
    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3">

            <ul class="list-disc space-y-1 pl-5 text-sm text-red-700">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- Filter --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

        <form
            method="GET"
            action="{{ route('admin.academic.subjects.index') }}"
            class="flex flex-col gap-3 sm:flex-row">

            <div class="flex-1">

                <label class="mb-1.5 block text-xs font-semibold text-slate-600">
                    Branch
                </label>

                <select
                    name="branch_id"
                    class="w-full rounded-xl border border-slate-300 bg-white
                           px-4 py-2.5 text-sm text-slate-700
                           focus:border-blue-500 focus:outline-none
                           focus:ring-4 focus:ring-blue-500/10">

                    <option value="">
                        All Branches
                    </option>

                    @foreach($branches as $branch)

                        <option
                            value="{{ $branch->id }}"
                            {{ request('branch_id') == $branch->id ? 'selected' : '' }}>

                            {{ $branch->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            <div class="flex items-end gap-2">

                <button
                    type="submit"
                    class="rounded-xl bg-slate-800 px-5 py-2.5
                           text-sm font-semibold text-white
                           hover:bg-slate-900">

                    Filter

                </button>

                <a
                    href="{{ route('admin.academic.subjects.index') }}"
                    class="rounded-xl border border-slate-300 bg-white
                           px-5 py-2.5 text-sm font-semibold text-slate-700
                           hover:bg-slate-50">

                    Reset

                </a>

            </div>

        </form>

    </div>


    {{-- Desktop --}}
    <div class="hidden overflow-hidden rounded-2xl border border-slate-200
                bg-white shadow-sm md:block">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1000px]">

                <thead class="border-b border-slate-200 bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            #
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Subject
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Branch
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Code
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Type
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Marks
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($subjects as $subject)

                        <tr class="transition hover:bg-slate-50">

                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $subjects->firstItem() + $loop->index }}
                            </td>


                            <td class="px-6 py-4">

                                <div>

                                    <p class="font-semibold text-slate-900">
                                        {{ $subject->name }}
                                    </p>

                                    @if($subject->name_bn)

                                        <p class="mt-0.5 text-xs text-slate-500">
                                            {{ $subject->name_bn }}
                                        </p>

                                    @endif

                                </div>

                            </td>


                            <td class="px-6 py-4">

                                <span class="rounded-lg bg-blue-50 px-2.5 py-1
                                             text-xs font-semibold text-blue-700">

                                    {{ $subject->branch->name ?? '—' }}

                                </span>

                            </td>


                            <td class="px-6 py-4 text-sm text-slate-600">

                                {{ $subject->code ?? '—' }}

                            </td>


                            <td class="px-6 py-4">

                                @php
                                    $typeLabel = match($subject->type) {
                                        'theory' => 'Theory',
                                        'practical' => 'Practical',
                                        'both' => 'Theory + Practical',
                                        default => ucfirst($subject->type ?? '—'),
                                    };
                                @endphp

                                <span class="rounded-lg bg-purple-50 px-2.5 py-1
                                             text-xs font-semibold text-purple-700">

                                    {{ $typeLabel }}

                                </span>

                            </td>


                            <td class="px-6 py-4">

                                <div class="text-sm">

                                    <span class="font-semibold text-slate-900">
                                        {{ $subject->full_marks }}
                                    </span>

                                    <span class="text-slate-400">
                                        /
                                    </span>

                                    <span class="text-red-600">
                                        {{ $subject->pass_marks }}
                                    </span>

                                </div>

                                <p class="text-[11px] text-slate-400">
                                    Full / Pass
                                </p>

                            </td>


                            <td class="px-6 py-4">

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

                            </td>


                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('admin.academic.subjects.show', $subject) }}"
                                        class="rounded-lg border border-slate-200
                                               px-3 py-2 text-xs font-semibold
                                               text-slate-600 hover:bg-slate-50">

                                        View

                                    </a>

                                    <a
                                        href="{{ route('admin.academic.subjects.edit', $subject) }}"
                                        class="rounded-lg bg-blue-50 px-3 py-2
                                               text-xs font-semibold text-blue-700
                                               hover:bg-blue-100">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('admin.academic.subjects.destroy', $subject) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this subject?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-red-50 px-3 py-2
                                                   text-xs font-semibold text-red-700
                                                   hover:bg-red-100">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="px-6 py-16 text-center">

                                <div class="text-5xl">
                                    📚
                                </div>

                                <h3 class="mt-4 text-base font-semibold text-slate-800">
                                    No subjects found
                                </h3>

                                <p class="mt-1 text-sm text-slate-500">
                                    Create your first subject.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Mobile --}}
    <div class="space-y-4 md:hidden">

        @forelse($subjects as $subject)

            <div class="rounded-2xl border border-slate-200
                        bg-white p-4 shadow-sm">

                <div class="flex items-start justify-between gap-3">

                    <div>

                        <h3 class="font-bold text-slate-900">
                            {{ $subject->name }}
                        </h3>

                        @if($subject->name_bn)

                            <p class="mt-1 text-xs text-slate-500">
                                {{ $subject->name_bn }}
                            </p>

                        @endif

                    </div>


                    @if($subject->status)

                        <span class="rounded-full bg-green-100 px-2.5 py-1
                                     text-[11px] font-semibold text-green-700">

                            Active

                        </span>

                    @else

                        <span class="rounded-full bg-red-100 px-2.5 py-1
                                     text-[11px] font-semibold text-red-700">

                            Inactive

                        </span>

                    @endif

                </div>


                <div class="mt-4 grid grid-cols-2 gap-3 border-t border-slate-100 pt-4">

                    <div>

                        <p class="text-[11px] font-semibold uppercase text-slate-400">
                            Branch
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-700">
                            {{ $subject->branch->name ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-[11px] font-semibold uppercase text-slate-400">
                            Code
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-700">
                            {{ $subject->code ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-[11px] font-semibold uppercase text-slate-400">
                            Type
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-700">
                            {{ ucfirst($subject->type) }}
                        </p>

                    </div>


                    <div>

                        <p class="text-[11px] font-semibold uppercase text-slate-400">
                            Marks
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-700">
                            {{ $subject->full_marks }} / {{ $subject->pass_marks }}
                        </p>

                    </div>

                </div>


                <div class="mt-4 grid grid-cols-3 gap-2">

                    <a
                        href="{{ route('admin.academic.subjects.show', $subject) }}"
                        class="rounded-lg border border-slate-200 px-3 py-2
                               text-center text-xs font-semibold text-slate-600">

                        View

                    </a>

                    <a
                        href="{{ route('admin.academic.subjects.edit', $subject) }}"
                        class="rounded-lg bg-blue-50 px-3 py-2
                               text-center text-xs font-semibold text-blue-700">

                        Edit

                    </a>

                    <form
                        action="{{ route('admin.academic.subjects.destroy', $subject) }}"
                        method="POST"
                        onsubmit="return confirm('Delete this subject?')">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full rounded-lg bg-red-50 px-3 py-2
                                   text-xs font-semibold text-red-700">

                            Delete

                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="rounded-2xl border border-slate-200
                        bg-white p-8 text-center">

                <div class="text-4xl">
                    📚
                </div>

                <p class="mt-3 font-semibold text-slate-700">
                    No subjects found
                </p>

            </div>

        @endforelse

    </div>


    @if($subjects->hasPages())

        <div>
            {{ $subjects->links() }}
        </div>

    @endif

</div>

@endsection