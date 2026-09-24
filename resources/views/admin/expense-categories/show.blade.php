@extends('admin.layouts.app')

@section('title', 'Expense Category Details')


@section('content')

<div class="p-4 sm:p-6">
 
{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center
            sm:justify-between gap-4 mb-6">

    <div class="flex items-center gap-3">

        <a href="{{ route('admin.expense-categories.index') }}"
           class="inline-flex items-center justify-center w-9 h-9
                  rounded-lg bg-slate-100 hover:bg-slate-200
                  text-slate-600 transition">
            <i class="bi bi-arrow-left"></i>
        </a>

        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                Expense Category Details
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                View expense category information.
            </p>
        </div>

    </div>

    <a href="{{ route('admin.expense-categories.edit', $expenseCategory) }}"
       class="inline-flex items-center justify-center gap-2
              px-4 py-2.5 bg-blue-600 hover:bg-blue-700
              text-white text-sm font-medium rounded-lg transition">
        <i class="bi bi-pencil-square"></i>
        Edit Category
    </a>

</div>

{{-- Details Card --}}
<div class="max-w-4xl bg-white border border-slate-200 rounded-xl overflow-hidden">

    {{-- Card Header --}}
    <div class="px-5 sm:px-6 py-4 bg-slate-50 border-b border-slate-200
                flex items-center justify-between">

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-lg bg-blue-50
                        flex items-center justify-center">
                <i class="bi bi-receipt text-blue-600 text-lg"></i>
            </div>

            <div>
                <h2 class="font-semibold text-slate-800">
                    {{ $expenseCategory->name }}
                </h2>

                <p class="text-xs text-slate-500">
                    Expense Category
                </p>
            </div>

        </div>

        @if($expenseCategory->status)
            <span class="inline-flex items-center gap-1.5
                         px-2.5 py-1 rounded-full
                         text-xs font-medium bg-green-50 text-green-700">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                Active
            </span>
        @else
            <span class="inline-flex items-center gap-1.5
                         px-2.5 py-1 rounded-full
                         text-xs font-medium bg-red-50 text-red-700">
                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                Inactive
            </span>
        @endif

    </div>

    {{-- Details --}}
    <div class="divide-y divide-slate-100">

        {{-- Name --}}
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
            <div class="text-sm font-medium text-slate-500">
                Category Name
            </div>

            <div class="sm:col-span-2 text-sm font-medium text-slate-800">
                {{ $expenseCategory->name }}
            </div>
        </div>

        {{-- Description --}}
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
            <div class="text-sm font-medium text-slate-500">
                Description
            </div>

            <div class="sm:col-span-2 text-sm text-slate-700">
                {{ $expenseCategory->description ?: 'No description available.' }}
            </div>
        </div>

        {{-- Status --}}
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
            <div class="text-sm font-medium text-slate-500">
                Status
            </div>

            <div class="sm:col-span-2">

                @if($expenseCategory->status)
                    <span class="inline-flex items-center gap-1.5
                                 px-2.5 py-1 rounded-full
                                 text-xs font-medium bg-green-50 text-green-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                        Active
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5
                                 px-2.5 py-1 rounded-full
                                 text-xs font-medium bg-red-50 text-red-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                        Inactive
                    </span>
                @endif

            </div>
        </div>

        {{-- Created --}}
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
            <div class="text-sm font-medium text-slate-500">
                Created At
            </div>

            <div class="sm:col-span-2 text-sm text-slate-700">
                {{ $expenseCategory->created_at?->format('d M Y, h:i A') ?? '—' }}
            </div>
        </div>

        {{-- Updated --}}
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
            <div class="text-sm font-medium text-slate-500">
                Last Updated
            </div>

            <div class="sm:col-span-2 text-sm text-slate-700">
                {{ $expenseCategory->updated_at?->format('d M Y, h:i A') ?? '—' }}
            </div>
        </div>

    </div>

    {{-- Footer --}}
    <div class="px-5 sm:px-6 py-4 bg-slate-50 border-t border-slate-200
                flex flex-col sm:flex-row sm:justify-between gap-3">

        <form action="{{ route('admin.expense-categories.destroy', $expenseCategory) }}"
              method="POST"
              class="delete-form">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="inline-flex items-center justify-center gap-2
                           px-4 py-2.5 rounded-lg
                           bg-red-50 hover:bg-red-100
                           text-red-600 text-sm font-medium transition">
                <i class="bi bi-trash"></i>
                Delete Category
            </button>

        </form>

        <a href="{{ route('admin.expense-categories.index') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5 rounded-lg bg-white
                  border border-slate-300
                  text-slate-700 text-sm font-medium hover:bg-slate-50">
            <i class="bi bi-arrow-left"></i>
            Back to Categories
        </a>

    </div>

</div> 
</div>

{{-- SweetAlert Delete --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Delete Expense Category?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });
        });

    });

});
</script>

@endsection
