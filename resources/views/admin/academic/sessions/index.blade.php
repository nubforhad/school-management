@extends('admin.layouts.app')

@section('title', 'Academic Sessions')
@section('page-title', 'Academic Sessions')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Academic Sessions
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage academic sessions branch-wise.
            </p>
        </div>

        <a
            href="{{ route('admin.academic.sessions.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg
                   bg-blue-600 px-4 py-2.5 text-sm font-medium text-white
                   shadow-sm hover:bg-blue-700">

            <span class="text-lg">+</span>
            Add Session

        </a>

    </div>


    {{-- Success --}}
    @if(session('success'))

        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3">
            <p class="text-sm text-green-700">
                {{ session('success') }}
            </p>
        </div>

    @endif


    {{-- Error --}}
    @if($errors->any())

        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3">

            <ul class="list-disc space-y-1 pl-5 text-sm text-red-700">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- Desktop --}}
    <div class="hidden overflow-hidden rounded-xl border border-slate-200
                bg-white shadow-sm md:block">

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="border-b border-slate-200 bg-slate-50">

                    <tr>

                        <th class="px-5 py-4 font-semibold text-slate-600">
                            Session
                        </th>

                        <th class="px-5 py-4 font-semibold text-slate-600">
                            Branch
                        </th>

                        <th class="px-5 py-4 font-semibold text-slate-600">
                            Start
                        </th>

                        <th class="px-5 py-4 font-semibold text-slate-600">
                            End
                        </th>

                        <th class="px-5 py-4 font-semibold text-slate-600">
                            Current
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

                    @forelse($sessions as $session)

                        <tr class="hover:bg-slate-50">

                            <td class="px-5 py-4">

                                <p class="font-semibold text-slate-800">
                                    {{ $session->name }}
                                </p>

                            </td>


                            <td class="px-5 py-4">

                                <span class="rounded-md bg-blue-50 px-2.5 py-1
                                             text-xs font-medium text-blue-700">

                                    {{ $session->branch->name }}

                                </span>

                            </td>


                            <td class="px-5 py-4 text-slate-600">
                                {{ $session->start_date?->format('d M Y') ?? '-' }}
                            </td>


                            <td class="px-5 py-4 text-slate-600">
                                {{ $session->end_date?->format('d M Y') ?? '-' }}
                            </td>


                            <td class="px-5 py-4">

                                @if($session->is_current)

                                    <span class="rounded-full bg-blue-100 px-2.5 py-1
                                                 text-xs font-medium text-blue-700">
                                        Current
                                    </span>

                                @else

                                    <span class="text-xs text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            <td class="px-5 py-4">

                                @if($session->status)

                                    <span class="rounded-full bg-green-100 px-2.5 py-1
                                                 text-xs font-medium text-green-700">
                                        Active
                                    </span>

                                @else

                                    <span class="rounded-full bg-red-100 px-2.5 py-1
                                                 text-xs font-medium text-red-700">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            <td class="px-5 py-4">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('admin.academic.sessions.show', $session) }}"
                                        class="rounded-lg border border-slate-200 px-3 py-2
                                               text-xs font-medium text-slate-600
                                               hover:bg-slate-50">

                                        View

                                    </a>


                                    <a
                                        href="{{ route('admin.academic.sessions.edit', $session) }}"
                                        class="rounded-lg bg-blue-50 px-3 py-2
                                               text-xs font-medium text-blue-700
                                               hover:bg-blue-100">

                                        Edit

                                    </a>


                                    <form
                                        action="{{ route('admin.academic.sessions.destroy', $session) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this academic session?')">

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

                            <td colspan="7" class="px-5 py-14 text-center">

                                <div class="text-4xl">
                                    📅
                                </div>

                                <p class="mt-3 font-medium text-slate-700">
                                    No academic sessions found
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    Create your first academic session.
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

        @forelse($sessions as $session)

            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-start justify-between gap-3">

                    <div>

                        <h3 class="font-semibold text-slate-900">
                            {{ $session->name }}
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            {{ $session->branch->name }}
                        </p>

                    </div>


                    @if($session->is_current)

                        <span class="rounded-full bg-blue-100 px-2 py-1
                                     text-[11px] font-medium text-blue-700">
                            Current
                        </span>

                    @else

                        @if($session->status)

                            <span class="rounded-full bg-green-100 px-2 py-1
                                         text-[11px] font-medium text-green-700">
                                Active
                            </span>

                        @else

                            <span class="rounded-full bg-red-100 px-2 py-1
                                         text-[11px] font-medium text-red-700">
                                Inactive
                            </span>

                        @endif

                    @endif

                </div>


                <div class="mt-4 space-y-2 border-t border-slate-100 pt-4">

                    <div class="flex justify-between text-sm">

                        <span class="text-slate-500">
                            Start Date
                        </span>

                        <span class="text-slate-700">
                            {{ $session->start_date?->format('d M Y') ?? '-' }}
                        </span>

                    </div>


                    <div class="flex justify-between text-sm">

                        <span class="text-slate-500">
                            End Date
                        </span>

                        <span class="text-slate-700">
                            {{ $session->end_date?->format('d M Y') ?? '-' }}
                        </span>

                    </div>

                </div>


                <div class="mt-4 grid grid-cols-3 gap-2">

                    <a
                        href="{{ route('admin.academic.sessions.show', $session) }}"
                        class="rounded-lg border border-slate-200 px-3 py-2
                               text-center text-xs font-medium text-slate-600">

                        View

                    </a>


                    <a
                        href="{{ route('admin.academic.sessions.edit', $session) }}"
                        class="rounded-lg bg-blue-50 px-3 py-2
                               text-center text-xs font-medium text-blue-700">

                        Edit

                    </a>


                    <form
                        action="{{ route('admin.academic.sessions.destroy', $session) }}"
                        method="POST"
                        onsubmit="return confirm('Delete this academic session?')">

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

                <div class="text-4xl">📅</div>

                <p class="mt-3 font-medium text-slate-700">
                    No academic sessions found
                </p>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}
    @if($sessions->hasPages())

        <div>
            {{ $sessions->links() }}
        </div>

    @endif

</div>

@endsection