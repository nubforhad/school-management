@extends('admin.layouts.app')

@section('title', 'Add Section')
@section('page-title', 'Add Section')

@section('content')

<div class="w-full space-y-6">

    <div>

        <a
            href="{{ route('admin.academic.sections.index') }}"
            class="text-sm font-medium text-blue-600 hover:text-blue-700">

            ← Back to Sections

        </a>

        <h1 class="mt-3 text-2xl font-bold text-slate-900 sm:text-3xl">
            Add Section
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Create a new section under a class.
        </p>

    </div>


    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 p-4">

            <ul class="list-disc space-y-1 pl-5 text-sm text-red-700">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.academic.sections.store') }}"
        method="POST"
        class="w-full overflow-hidden rounded-2xl border
               border-slate-200 bg-white shadow-sm">

        @csrf


        <div class="border-b border-slate-200 bg-slate-50 px-5 py-5 sm:px-6 lg:px-8">

            <h2 class="font-semibold text-slate-900">
                Section Information
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Enter section information below.
            </p>

        </div>


        <div class="p-5 sm:p-6 lg:p-8">

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">


                {{-- Branch --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Branch <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="branch_id"
                        required
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                        <option value="">Select Branch</option>

                        @foreach($branches as $branch)

                            <option
                                value="{{ $branch->id }}"
                                {{ old('branch_id') == $branch->id ? 'selected' : '' }}>

                                {{ $branch->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('branch_id')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror

                </div>


                {{-- Class --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Class <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="class_id"
                        required
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                        <option value="">Select Class</option>

                        @foreach($classes as $class)

                            <option
                                value="{{ $class->id }}"
                                {{ old('class_id') == $class->id ? 'selected' : '' }}>

                                {{ $class->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('class_id')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror

                </div>


                {{-- Section Name --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Section Name <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        placeholder="Example: Section A"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror

                </div>


                {{-- Code --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Section Code
                    </label>

                    <input
                        type="text"
                        name="capacity"
                        value="{{ old('capacity') }}"
                        placeholder="Example: A"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                </div>


                {{-- Sort Order --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Sort Order
                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        value="{{ old('sort_order', 0) }}"
                        min="0"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                </div>


                {{-- Status --}}
                <div class="flex items-end">

                    <label class="flex w-full cursor-pointer items-center gap-3
                                  rounded-xl border border-slate-200
                                  bg-slate-50 p-4">

                        <input
                            type="checkbox"
                            name="status"
                            value="1"
                            {{ old('status', true) ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-slate-300 text-blue-600">

                        <span>

                            <span class="block text-sm font-semibold text-slate-800">
                                Active
                            </span>

                            <span class="block text-xs text-slate-500">
                                Enable this section.
                            </span>

                        </span>

                    </label>

                </div>

            </div>

        </div>


        <div class="flex flex-col-reverse gap-3 border-t border-slate-200
                    bg-slate-50 px-5 py-4 sm:flex-row sm:justify-end
                    sm:px-6 lg:px-8">

            <a
                href="{{ route('admin.academic.sections.index') }}"
                class="rounded-xl border border-slate-300 bg-white
                       px-5 py-2.5 text-center text-sm font-semibold text-slate-700">

                Cancel

            </a>

            <button
                type="submit"
                class="rounded-xl bg-blue-600 px-6 py-2.5
                       text-sm font-semibold text-white hover:bg-blue-700">

                Create Section

            </button>

        </div>

    </form>

</div>

@endsection