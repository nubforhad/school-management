@extends('admin.layouts.app')

@section('title', 'Classes')
@section('page-title', 'Classes')

@section('content')

<div class="w-full space-y-6">
    {{-- Header --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Classes
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Manage classes branch-wise.
            </p>
        </div>
        <a
            href="{{ route('admin.academic.classes.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl
                   bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white
                   shadow-sm transition hover:bg-blue-700">
            <span class="text-lg">+</span>
            Add Class
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

    {{-- Error --}}
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
        <form method="GET" action="{{ route('admin.academic.classes.index') }}"  class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
            <div class="sm:col-span-2 lg:col-span-3">
                <label class="mb-1.5 block text-xs font-semibold text-slate-600">
                    Filter by Branch
                </label>
                <select name="branch_id"  class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10">
                    <option value="">
                        All Branches
                    </option>
                    @foreach($branches as $branch)
                        <option  value="{{ $branch->id }}"
                            {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                            @if($branch->code)
                                — {{ $branch->code }}
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full rounded-xl bg-slate-800 px-4 py-2.5 text-sm font-semibold text-white hover:bg-slate-900">
                    Filter
                </button>
            </div>
        </form>
    </div>
    {{-- Desktop Table --}}
    <div class="hidden overflow-hidden rounded-2xl border border-slate-200  bg-white shadow-sm md:block">

        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left">
                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            #
                        </th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Class
                        </th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Code
                        </th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Branch
                        </th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Order
                        </th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Status
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($classes as $class)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $classes->firstItem() + $loop->index }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-900">
                                    {{ $class->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($class->numeric_order)
                                    <span class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                        {{ $class->numeric_order }}
                                    </span>
                                @else
                                    <span class="text-sm text-slate-400">
                                        —
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded-lg bg-blue-50 px-2.5 py-1  text-xs font-semibold text-blue-700">
                                    {{ $class->branch->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $class->sort_order }}
                            </td>
                            <td class="px-6 py-4">
                                @if($class->status)
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Active
                                    </span>
                                @else
                                    <span class="rounded-full bg-red-100 px-3 py-1  text-xs font-semibold text-red-700">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.academic.classes.show', $class) }}"  class="rounded-lg border border-slate-200 px-3 py-2  text-xs font-semibold text-slate-600  hover:bg-slate-50">
                                        View
                                    </a>
                                    <a href="{{ route('admin.academic.classes.edit', $class) }}"
                                        class="rounded-lg bg-blue-50 px-3 py-2
                                               text-xs font-semibold text-blue-700
                                               hover:bg-blue-100">
                                        Edit
                                    </a>
                                    <form  action="{{ route('admin.academic.classes.destroy', $class) }}"
                                        method="POST"  onsubmit="return confirm('Are you sure you want to delete this class?')">

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-700  hover:bg-red-100">  
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="text-5xl">
                                    📚
                                </div>
                                <h3 class="mt-4 text-base font-semibold text-slate-800">
                                    No classes found
                                </h3>
                                <p class="mt-1 text-sm text-slate-500">
                                    Create your first class to get started.
                                </p>
                                <a  href="{{ route('admin.academic.classes.create') }}"
                                    class="mt-5 inline-flex rounded-xl bg-blue-600
                                           px-5 py-2.5 text-sm font-semibold text-white
                                           hover:bg-blue-700">
                                    Add Class
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- Mobile --}}
    <div class="space-y-4 md:hidden">
        @forelse($classes as $class)
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <h3 class="font-bold text-slate-900">
                            {{ $class->name }}
                        </h3>
                        <p class="mt-1 text-xs text-slate-500">
                            {{ $class->branch->name }}
                        </p>
                    </div>
                    @if($class->status)
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
                            Code
                        </p>
                        <p class="mt-1 text-sm font-medium text-slate-700">
                            {{ $class->code ?? '—' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold uppercase text-slate-400">
                            Order
                        </p>
                        <p class="mt-1 text-sm font-medium text-slate-700">
                            {{ $class->sort_order }}
                        </p>
                    </div>
                </div>
                <div class="mt-4 grid grid-cols-3 gap-2">
                    <a
                        href="{{ route('admin.academic.classes.show', $class) }}"
                        class="rounded-lg border border-slate-200 px-3 py-2
                               text-center text-xs font-semibold text-slate-600">
                        View
                    </a>
                    <a
                        href="{{ route('admin.academic.classes.edit', $class) }}"
                        class="rounded-lg bg-blue-50 px-3 py-2
                               text-center text-xs font-semibold text-blue-700">
                        Edit
                    </a>
                    <form
                        action="{{ route('admin.academic.classes.destroy', $class) }}"
                        method="POST"
                        onsubmit="return confirm('Delete this class?')">
                        @csrf
                        @method('DELETE')
                        <button
                            class="w-full rounded-lg bg-red-50 px-3 py-2
                                   text-xs font-semibold text-red-700">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-slate-200 bg-white p-8 text-center">
                <div class="text-4xl">
                    📚
                </div>
                <p class="mt-3 font-semibold text-slate-700">
                    No classes found
                </p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($classes->hasPages())
        <div>
            {{ $classes->links() }}
        </div>
    @endif
</div>

@endsection