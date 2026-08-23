@extends('admin.layouts.app')

@section('title', 'Branch Details')
@section('page-title', 'Branch Details')

@section('content')

<div class="mx-auto max-w-5xl space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <a
                href="{{ route('admin.branches.index') }}"
                class="text-sm text-blue-600">

                ← Back to Branches

            </a>

            <h1 class="mt-3 text-2xl font-bold text-slate-900">
                {{ $branch->name }}
            </h1>

        </div>


        <a
            href="{{ route('admin.branches.edit', $branch) }}"
            class="rounded-lg bg-blue-600 px-4 py-2.5 text-center
                   text-sm font-medium text-white hover:bg-blue-700">

            Edit Branch

        </a>

    </div>


    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="flex flex-col gap-6 border-b border-slate-200 p-6 sm:flex-row sm:items-center">

            @if($branch->logo)

                <img
                    src="{{ asset('storage/'.$branch->logo) }}"
                    class="h-24 w-24 rounded-xl object-cover">

            @else

                <div
                    class="flex h-24 w-24 items-center justify-center
                           rounded-xl bg-blue-100 text-4xl">

                    🏢

                </div>

            @endif


            <div>

                <h2 class="text-xl font-bold text-slate-900">
                    {{ $branch->name }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Branch Code: {{ $branch->code }}
                </p>


                <div class="mt-3">

                    @if($branch->status)

                        <span
                            class="rounded-full bg-green-100 px-3 py-1
                                   text-xs font-medium text-green-700">

                            Active

                        </span>

                    @else

                        <span
                            class="rounded-full bg-red-100 px-3 py-1
                                   text-xs font-medium text-red-700">

                            Inactive

                        </span>

                    @endif

                </div>

            </div>

        </div>


        <div class="grid gap-6 p-6 sm:grid-cols-2">

            <div>

                <p class="text-xs font-medium uppercase text-slate-500">
                    Phone
                </p>

                <p class="mt-1 text-sm text-slate-800">
                    {{ $branch->phone ?: '-' }}
                </p>

            </div>


            <div>

                <p class="text-xs font-medium uppercase text-slate-500">
                    Email
                </p>

                <p class="mt-1 break-all text-sm text-slate-800">
                    {{ $branch->email ?: '-' }}
                </p>

            </div>


            <div class="sm:col-span-2">

                <p class="text-xs font-medium uppercase text-slate-500">
                    Address
                </p>

                <p class="mt-1 text-sm text-slate-800">
                    {{ $branch->address ?: '-' }}
                </p>

            </div>

        </div>

    </div>

</div>

@endsection