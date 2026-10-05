@extends('admin.layouts.app')

@section('title', 'Income Categories')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Income Categories
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage income categories for your branch.
            </p>
        </div>

        <a href="{{ route('admin.income-categories.create') }}"
           class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

            + Add Income Category

        </a>

    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search --}}
    <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

        <form method="GET"
              action="{{ route('admin.income-categories.index') }}"
              class="flex flex-col gap-3 sm:flex-row">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search income category..."
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 sm:max-w-md"
            >

            <button
                type="submit"
                class="rounded-lg bg-slate-800 px-5 py-2.5 text-sm font-semibold text-white hover:bg-slate-900">
                Search
            </button>

            @if(request('search'))
                <a
                    href="{{ route('admin.income-categories.index') }}"
                    class="rounded-lg border border-slate-300 px-5 py-2.5 text-center text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Reset
                </a>
            @endif

        </form>

    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">

                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                            #
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                            Category
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                            Description
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                            Status
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase text-slate-500">
                            Action
                        </th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($categories as $category)

                        <tr class="hover:bg-slate-50">

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">
                                {{ $categories->firstItem() + $loop->index }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="font-semibold text-slate-800">
                                    {{ $category->name }}
                                </div>

                            </td>

                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $category->description ?: '—' }}
                            </td>

                            <td class="px-6 py-4">

                                @if($category->status)

                                    <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                                        Active
                                    </span>

                                @else

                                    <span class="rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('admin.income-categories.edit', $category) }}"
                                        class="rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 hover:bg-blue-100">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.income-categories.destroy', $category) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this category?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-100">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="px-6 py-12 text-center text-sm text-slate-500">

                                No income categories found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if($categories->hasPages())

            <div class="border-t border-slate-200 px-6 py-4">
                {{ $categories->links() }}
            </div>

        @endif

    </div>

</div>

@endsection