@extends('admin.layouts.app')

@section('title', 'Assign Subject')
@section('page-title', 'Assign Subject')

@section('content')

<div class="w-full space-y-6">

    <div>

        <a
            href="{{ route('admin.academic.class-subjects.index') }}"
            class="text-sm font-medium text-blue-600 hover:text-blue-700">

            ← Back to Class Subjects

        </a>

        <h1 class="mt-3 text-2xl font-bold text-slate-900 sm:text-3xl">
            Assign Subject to Class
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Assign an academic subject to a class branch-wise.
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
        action="{{ route('admin.academic.class-subjects.store') }}"
        method="POST"
        class="overflow-hidden rounded-2xl border border-slate-200
               bg-white shadow-sm">

        @csrf


        <div class="border-b border-slate-200 bg-slate-50 px-5 py-5
                    sm:px-6 lg:px-8">

            <h2 class="font-semibold text-slate-900">
                Assignment Information
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Select branch, class and subject.
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
                        id="branch_id"
                        name="branch_id"
                        required
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                        <option value="">
                            Select Branch
                        </option>

                        @foreach($branches as $branch)

                            <option
                                value="{{ $branch->id }}"
                                {{ old('branch_id') == $branch->id ? 'selected' : '' }}>

                                {{ $branch->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('branch_id')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Class --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Class <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="class_id"
                        name="class_id"
                        required
                        disabled
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-4 py-3 text-sm
                               disabled:cursor-not-allowed disabled:bg-slate-100">

                        <option value="">
                            Select Branch First
                        </option>

                    </select>

                    @error('class_id')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Subject --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Subject <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="subject_id"
                        name="subject_id"
                        required
                        disabled
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-4 py-3 text-sm
                               disabled:cursor-not-allowed disabled:bg-slate-100">

                        <option value="">
                            Select Branch First
                        </option>

                    </select>

                    @error('subject_id')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

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
                               px-4 py-3 text-sm">

                    <p class="mt-1 text-xs text-slate-400">
                        Lower number appears first.
                    </p>

                </div>


                {{-- Optional --}}
                <div>

                    <label class="flex cursor-pointer items-center gap-3
                                  rounded-xl border border-slate-200
                                  bg-slate-50 p-4">

                        <input
                            type="checkbox"
                            name="is_optional"
                            value="1"
                            {{ old('is_optional') ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-slate-300 text-blue-600">

                        <span>

                            <span class="block text-sm font-semibold text-slate-800">
                                Optional Subject
                            </span>

                            <span class="block text-xs text-slate-500">
                                Mark this subject as optional.
                            </span>

                        </span>

                    </label>

                </div>


                {{-- Status --}}
                <div>

                    <label class="flex cursor-pointer items-center gap-3
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
                                Enable this class-subject assignment.
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
                href="{{ route('admin.academic.class-subjects.index') }}"
                class="rounded-xl border border-slate-300 bg-white
                       px-5 py-2.5 text-center text-sm font-semibold text-slate-700">

                Cancel

            </a>

            <button
                type="submit"
                class="rounded-xl bg-blue-600 px-6 py-2.5
                       text-sm font-semibold text-white hover:bg-blue-700">

                Assign Subject

            </button>

        </div>

    </form>

</div>


<script>

const branchSelect = document.getElementById('branch_id');
const classSelect = document.getElementById('class_id');
const subjectSelect = document.getElementById('subject_id');

const classes = @json($classes);
const subjects = @json($subjects);

function loadBranchData(branchId) {

    classSelect.innerHTML =
        '<option value="">Select Class</option>';

    subjectSelect.innerHTML =
        '<option value="">Select Subject</option>';

    classSelect.disabled = true;
    subjectSelect.disabled = true;

    if (!branchId) {
        classSelect.innerHTML =
            '<option value="">Select Branch First</option>';

        subjectSelect.innerHTML =
            '<option value="">Select Branch First</option>';

        return;
    }


    // Classes
    const branchClasses = classes.filter(function(item) {

        return String(item.branch_id) === String(branchId);

    });


    branchClasses.forEach(function(item) {

        const option = document.createElement('option');

        option.value = item.id;

        option.textContent = item.name;

        if (String(item.id) === String(@json(old('class_id')))) {
            option.selected = true;
        }

        classSelect.appendChild(option);

    });

    classSelect.disabled = false;


    // Subjects
    const branchSubjects = subjects.filter(function(item) {

        return String(item.branch_id) === String(branchId);

    });


    branchSubjects.forEach(function(item) {

        const option = document.createElement('option');

        option.value = item.id;

        option.textContent =
            item.code
                ? item.name + ' (' + item.code + ')'
                : item.name;

        if (String(item.id) === String(@json(old('subject_id')))) {
            option.selected = true;
        }

        subjectSelect.appendChild(option);

    });

    subjectSelect.disabled = false;
}


branchSelect.addEventListener('change', function() {

    loadBranchData(this.value);

});


document.addEventListener('DOMContentLoaded', function() {

    if (branchSelect.value) {

        loadBranchData(branchSelect.value);

    }

});

</script>

@endsection