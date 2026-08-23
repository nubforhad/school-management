@extends('admin.layouts.app')

@section('title', 'Branches')
@section('page-title', 'Branches')

@section('content')

<div class="space-y-6">

    {{-- Header --}}

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-2xl font-bold text-slate-900">
                Branches
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage all branches of your institution.
            </p>

        </div>


        <a
            href="{{ route('admin.branches.create') }}"
            class="inline-flex items-center justify-center gap-2
                   rounded-lg bg-blue-600 px-4 py-2.5
                   text-sm font-medium text-white
                   shadow-sm hover:bg-blue-700">

            <span class="text-lg">+</span>

            Add Branch

        </a>

    </div>


    {{-- Success Message --}}

    @if(session('success'))

        <div
            class="rounded-lg border border-green-200
                   bg-green-50 px-4 py-3 text-sm text-green-700">

            {{ session('success') }}

        </div>

    @endif


    {{-- Validation Error --}}

    @if($errors->any())

        <div
            class="rounded-lg border border-red-200
                   bg-red-50 px-4 py-3">

            <ul class="list-disc pl-5 text-sm text-red-700">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Desktop Table --}}

    <div class="hidden overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm md:block">

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="border-b border-slate-200 bg-slate-50">

                    <tr>

                        <th class="px-5 py-4 font-semibold text-slate-600">
                            Branch
                        </th>

                        <th class="px-5 py-4 font-semibold text-slate-600">
                            Code
                        </th>

                        <th class="px-5 py-4 font-semibold text-slate-600">
                            Contact
                        </th>

                        <th class="px-5 py-4 font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="px-5 py-4 text-right font-semibold text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($branches as $branch)

                        <tr class="hover:bg-slate-50">

                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    @if($branch->logo)

                                        <img
                                            src="{{ asset('storage/'.$branch->logo) }}"
                                            class="h-10 w-10 rounded-lg object-cover">

                                    @else

                                        <div
                                            class="flex h-10 w-10 items-center justify-center
                                                   rounded-lg bg-blue-100 text-blue-600">

                                            🏢

                                        </div>

                                    @endif


                                    <div>

                                        <p class="font-semibold text-slate-800">
                                            {{ $branch->name }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            {{ $branch->address ?: 'No address' }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-5 py-4">

                                <span
                                    class="rounded-md bg-slate-100 px-2.5 py-1
                                           text-xs font-medium text-slate-700">

                                    {{ $branch->code }}

                                </span>

                            </td>


                            <td class="px-5 py-4">

                                <p class="text-slate-700">
                                    {{ $branch->phone ?: '-' }}
                                </p>

                                <p class="text-xs text-slate-500">
                                    {{ $branch->email ?: '-' }}
                                </p>

                            </td>


                            <td class="px-5 py-4">

                                @if($branch->status)

                                    <span
                                        class="rounded-full bg-green-100 px-2.5 py-1
                                               text-xs font-medium text-green-700">

                                        Active

                                    </span>

                                @else

                                    <span
                                        class="rounded-full bg-red-100 px-2.5 py-1
                                               text-xs font-medium text-red-700">

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            <td class="px-5 py-4">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('admin.branches.show', $branch) }}"
                                        class="rounded-lg border border-slate-200 px-3 py-2
                                               text-xs font-medium text-slate-600
                                               hover:bg-slate-50">

                                        View

                                    </a>


                                    <a
                                        href="{{ route('admin.branches.edit', $branch) }}"
                                        class="rounded-lg bg-blue-50 px-3 py-2
                                               text-xs font-medium text-blue-700
                                               hover:bg-blue-100">

                                        Edit

                                    </a>


                                    <form
                                        action="{{ route('admin.branches.destroy', $branch) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this branch?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-red-50 px-3 py-2
                                                   text-xs font-medium text-red-700
                                                   hover:bg-red-100">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="px-5 py-12 text-center">

                                <div class="text-4xl">
                                    🏢
                                </div>

                                <p class="mt-3 font-medium text-slate-700">
                                    No branches found
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    Create your first branch.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Mobile Cards --}}

    <div class="space-y-4 md:hidden">

        @forelse($branches as $branch)

            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-start justify-between gap-3">

                    <div class="flex items-center gap-3">

                        @if($branch->logo)

                            <img
                                src="{{ asset('storage/'.$branch->logo) }}"
                                class="h-11 w-11 rounded-lg object-cover">

                        @else

                            <div
                                class="flex h-11 w-11 items-center justify-center
                                       rounded-lg bg-blue-100 text-blue-600">

                                🏢

                            </div>

                        @endif


                        <div>

                            <h3 class="font-semibold text-slate-800">
                                {{ $branch->name }}
                            </h3>

                            <p class="text-xs text-slate-500">
                                {{ $branch->code }}
                            </p>

                        </div>

                    </div>


                    @if($branch->status)

                        <span
                            class="rounded-full bg-green-100 px-2 py-1
                                   text-[11px] font-medium text-green-700">

                            Active

                        </span>

                    @else

                        <span
                            class="rounded-full bg-red-100 px-2 py-1
                                   text-[11px] font-medium text-red-700">

                            Inactive

                        </span>

                    @endif

                </div>


                <div class="mt-4 space-y-2 border-t border-slate-100 pt-4 text-sm">

                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Phone
                        </span>

                        <span class="text-right text-slate-700">
                            {{ $branch->phone ?: '-' }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Email
                        </span>

                        <span class="break-all text-right text-slate-700">
                            {{ $branch->email ?: '-' }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Address
                        </span>

                        <span class="text-right text-slate-700">
                            {{ $branch->address ?: '-' }}
                        </span>

                    </div>

                </div>


                <div class="mt-4 grid grid-cols-3 gap-2">

                    <a
                        href="{{ route('admin.branches.show', $branch) }}"
                        class="rounded-lg border border-slate-200 px-3 py-2
                               text-center text-xs font-medium text-slate-600">

                        View

                    </a>


                    <a
                        href="{{ route('admin.branches.edit', $branch) }}"
                        class="rounded-lg bg-blue-50 px-3 py-2
                               text-center text-xs font-medium text-blue-700">

                        Edit

                    </a>


                    <form
                        action="{{ route('admin.branches.destroy', $branch) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this branch?')">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full rounded-lg bg-red-50 px-3 py-2
                                   text-xs font-medium text-red-700">

                            Delete

                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="rounded-xl border border-slate-200 bg-white p-8 text-center">

                <div class="text-4xl">
                    🏢
                </div>

                <p class="mt-3 font-medium">
                    No branches found
                </p>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}

    @if($branches->hasPages())

        <div>
            {{ $branches->links() }}
        </div>

    @endif

</div>

@endsection