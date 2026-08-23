 @extends('admin.layouts.app')

@section('title', 'Edit Academic Session')
@section('page-title', 'Edit Academic Session')

@section('content')

<div class="w-full space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <a
                href="{{ route('admin.academic.sessions.index') }}"
                class="inline-flex items-center gap-1 text-sm font-medium text-blue-600 hover:text-blue-700">

                ← Back to Sessions

            </a>

            <div class="mt-3 flex flex-wrap items-center gap-3">

                <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                    Edit Academic Session
                </h1>

                @if($session->is_current)

                    <span class="rounded-full bg-blue-100 px-3 py-1
                                 text-xs font-semibold text-blue-700">

                        Current

                    </span>

                @endif

            </div>

            <p class="mt-1 text-sm text-slate-500">
                Update information for
                <span class="font-medium text-slate-700">
                    {{ $session->name }}
                </span>.
            </p>

        </div>

    </div>


    {{-- Form --}}
    <form
        action="{{ route('admin.academic.sessions.update', $session) }}"
        method="POST"

        class="w-full overflow-hidden rounded-2xl border border-slate-200
               bg-white shadow-sm">

        @csrf
        @method('PUT')


        {{-- Header --}}
        <div class="border-b border-slate-200 bg-slate-50/70 px-5 py-5 sm:px-6 lg:px-8">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-blue-100 text-xl">

                    ✏️

                </div>

                <div>

                    <h2 class="text-base font-semibold text-slate-900">
                        Session Information
                    </h2>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Modify the academic session information below.
                    </p>

                </div>

            </div>

        </div>


        {{-- Body --}}
        <div class="p-5 sm:p-6 lg:p-8">

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">


                {{-- Branch --}}
                <div class="lg:col-span-2">

                    <label
                        for="branch_id"
                        class="mb-2 block text-sm font-semibold text-slate-700">

                        Branch

                        <span class="text-red-500">*</span>

                    </label>

                    <select
                        id="branch_id"
                        name="branch_id"
                        required

                        class="w-full rounded-xl border border-slate-300
                               bg-white px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                        @foreach($branches as $branch)

                            <option
                                value="{{ $branch->id }}"

                                {{ old(
                                    'branch_id',
                                    $session->branch_id
                                ) == $branch->id ? 'selected' : '' }}>

                                {{ $branch->name }}

                                @if($branch->code)
                                    — {{ $branch->code }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('branch_id')

                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Name --}}
                <div>

                    <label
                        for="name"
                        class="mb-2 block text-sm font-semibold text-slate-700">

                        Session Name

                        <span class="text-red-500">*</span>

                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"

                        value="{{ old('name', $session->name) }}"

                        required

                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                    @error('name')

                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Start --}}
                <div>

                    <label
                        for="start_date"
                        class="mb-2 block text-sm font-semibold text-slate-700">

                        Start Date

                    </label>

                    <input
                        id="start_date"
                        type="date"
                        name="start_date"

                        value="{{ old(
                            'start_date',
                            $session->start_date?->format('Y-m-d')
                        ) }}"

                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                </div>


                {{-- End --}}
                <div>

                    <label
                        for="end_date"
                        class="mb-2 block text-sm font-semibold text-slate-700">

                        End Date

                    </label>

                    <input
                        id="end_date"
                        type="date"
                        name="end_date"

                        value="{{ old(
                            'end_date',
                            $session->end_date?->format('Y-m-d')
                        ) }}"

                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                </div>


                {{-- Settings --}}
                <div class="lg:col-span-2">

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">

                        <h3 class="text-sm font-semibold text-slate-800">
                            Session Settings
                        </h3>

                        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">


                            <label
                                class="flex cursor-pointer items-start gap-3 rounded-xl
                                       border border-slate-200 bg-white p-4">

                                <input
                                    type="checkbox"
                                    name="is_current"
                                    value="1"

                                    {{ old(
                                        'is_current',
                                        $session->is_current
                                    ) ? 'checked' : '' }}

                                    class="mt-0.5 h-4 w-4 rounded border-slate-300
                                           text-blue-600 focus:ring-blue-500">

                                <span>

                                    <span class="block text-sm font-semibold">
                                        Current Session
                                    </span>

                                    <span class="mt-1 block text-xs text-slate-500">
                                        Set this as the current session for this branch.
                                    </span>

                                </span>

                            </label>


                            <label
                                class="flex cursor-pointer items-start gap-3 rounded-xl
                                       border border-slate-200 bg-white p-4">

                                <input
                                    type="checkbox"
                                    name="status"
                                    value="1"

                                    {{ old(
                                        'status',
                                        $session->status
                                    ) ? 'checked' : '' }}

                                    class="mt-0.5 h-4 w-4 rounded border-slate-300
                                           text-green-600 focus:ring-green-500">

                                <span>

                                    <span class="block text-sm font-semibold">
                                        Active
                                    </span>

                                    <span class="mt-1 block text-xs text-slate-500">
                                        Enable or disable this academic session.
                                    </span>

                                </span>

                            </label>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Footer --}}
        <div class="flex flex-col-reverse gap-3 border-t border-slate-200
                    bg-slate-50 px-5 py-4
                    sm:flex-row sm:justify-end
                    sm:px-6 lg:px-8">

            <a
                href="{{ route('admin.academic.sessions.index') }}"
                class="inline-flex items-center justify-center rounded-xl
                       border border-slate-300 bg-white px-5 py-2.5
                       text-sm font-semibold text-slate-700">

                Cancel

            </a>

            <button
                type="submit"

                class="inline-flex items-center justify-center gap-2
                       rounded-xl bg-blue-600 px-6 py-2.5
                       text-sm font-semibold text-white
                       hover:bg-blue-700">

                <span>✓</span>

                Update Session

            </button>

        </div>

    </form>

</div>

@endsection