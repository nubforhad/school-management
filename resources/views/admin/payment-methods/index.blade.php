@extends('admin.layouts.app')

@section('title', 'Payment Methods')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Payment Methods
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage payment methods for your branch.
            </p>
        </div>

        <a href="{{ route('admin.payment-methods.create') }}"
           class="rounded-lg bg-blue-600 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-blue-700">
            + Add Payment Method
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
        <form method="GET"
              action="{{ route('admin.payment-methods.index') }}"
              class="flex flex-col gap-3 sm:flex-row">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search payment method..."
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm sm:max-w-md"
            >

            <button
                type="submit"
                class="rounded-lg bg-slate-800 px-5 py-2.5 text-sm font-semibold text-white">
                Search
            </button>

            @if(request('search'))
                <a href="{{ route('admin.payment-methods.index') }}"
                   class="rounded-lg border border-slate-300 px-5 py-2.5 text-center text-sm font-semibold text-slate-700">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                            #
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                            Payment Method
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

                    @forelse($paymentMethods as $method)

                        <tr class="hover:bg-slate-50">

                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $paymentMethods->firstItem() + $loop->index }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-800">
                                {{ $method->name }}
                            </td>

                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $method->description ?: '—' }}
                            </td>

                            <td class="px-6 py-4">
                                @if($method->status)
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

                                    <a href="{{ route('admin.payment-methods.edit', $method) }}"
                                       class="rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.payment-methods.destroy', $method) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this payment method?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-700">
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
                                No payment methods found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if($paymentMethods->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">
                {{ $paymentMethods->links() }}
            </div>
        @endif

    </div>

</div>

@endsection