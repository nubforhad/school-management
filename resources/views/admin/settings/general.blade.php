@extends('admin.layouts.app')

@section('title', 'General Settings')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">
{{-- Header --}}
<div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            General Settings
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Manage global information of your ERP.
        </p>
    </div>
</div>

{{-- Success Message --}}
@if(session('success'))
    <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>
@endif

{{-- Validation Errors --}}
@if($errors->any())
    <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        <div class="font-semibold">Please fix the following errors:</div>

        <ul class="mt-2 list-disc space-y-1 pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form
    action="{{ route('admin.settings.general.update') }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-6"
>

    @csrf
    @method('PUT')

    {{-- Institute Information --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">
            <h2 class="text-lg font-semibold text-slate-800">
                Institute Information
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Basic information of your institute.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2">

            {{-- Institute Name --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Institute Name <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="institute_name"
                    value="{{ old('institute_name', $settings['institute_name'] ?? '') }}"
                    required
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="ABC School & College"
                >

                @error('institute_name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Short Name --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Short Name
                </label>

                <input
                    type="text"
                    name="short_name"
                    value="{{ old('short_name', $settings['short_name'] ?? '') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="ABC"
                >

                @error('short_name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- EIIN --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    EIIN / Registration No
                </label>

                <input
                    type="text"
                    name="eiin"
                    value="{{ old('eiin', $settings['eiin'] ?? '') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="123456"
                >

                @error('eiin')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tagline --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Tagline
                </label>

                <input
                    type="text"
                    name="tagline"
                    value="{{ old('tagline', $settings['tagline'] ?? '') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="Quality Education"
                >

                @error('tagline')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>
    </div>

    {{-- Contact Information --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">
            <h2 class="text-lg font-semibold text-slate-800">
                Contact Information
            </h2>
        </div>

        <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2">

            {{-- Address --}}
            <div class="md:col-span-2">
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Address
                </label>

                <textarea
                    name="address"
                    rows="3"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="Dhaka, Bangladesh"
                >{{ old('address', $settings['address'] ?? '') }}</textarea>

                @error('address')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Phone
                </label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', $settings['phone'] ?? '') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="017XXXXXXXX"
                >

                @error('phone')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $settings['email'] ?? '') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="info@example.com"
                >

                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Website --}}
            <div class="md:col-span-2">
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Website
                </label>

                <input
                    type="text"
                    name="website"
                    value="{{ old('website', $settings['website'] ?? '') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="www.example.com"
                >

                @error('website')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>
    </div>

    {{-- Logo & Favicon --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">
            <h2 class="text-lg font-semibold text-slate-800">
                Logo & Favicon
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Upload institute logo and browser favicon.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 p-5 md:grid-cols-2">

            {{-- Logo --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Logo
                </label>

                <input
                    type="file"
                    name="logo"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="block w-full rounded-lg border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-slate-100 file:px-4 file:py-2.5 file:text-sm file:font-medium"
                >

                <p class="mt-1 text-xs text-slate-500">
                    JPG, JPEG, PNG or WEBP. Maximum 2MB.
                </p>

                @if(!empty($settings['logo']))
                    <div class="mt-4">
                        <p class="mb-2 text-xs font-medium text-slate-500">
                            Current Logo
                        </p>

                        <div class="flex h-24 w-48 items-center justify-center rounded-lg border border-slate-200 bg-slate-50 p-3">
                            <img
                                src="{{ asset('storage/' . $settings['logo']) }}"
                                alt="Institute Logo"
                                class="max-h-20 max-w-full object-contain"
                            >
                        </div>
                    </div>
                @endif

                @error('logo')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Favicon --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Favicon
                </label>

                <input
                    type="file"
                    name="favicon"
                    accept=".ico,.png,.jpg,.jpeg,.webp"
                    class="block w-full rounded-lg border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-slate-100 file:px-4 file:py-2.5 file:text-sm file:font-medium"
                >

                <p class="mt-1 text-xs text-slate-500">
                    ICO, PNG, JPG, JPEG or WEBP. Maximum 1MB.
                </p>

                @if(!empty($settings['favicon']))
                    <div class="mt-4">
                        <p class="mb-2 text-xs font-medium text-slate-500">
                            Current Favicon
                        </p>

                        <div class="flex h-20 w-20 items-center justify-center rounded-lg border border-slate-200 bg-slate-50 p-3">
                            <img
                                src="{{ asset('storage/' . $settings['favicon']) }}"
                                alt="Favicon"
                                class="max-h-12 max-w-12 object-contain"
                            >
                        </div>
                    </div>
                @endif

                @error('favicon')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>
    </div>

    {{-- Localization --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">
            <h2 class="text-lg font-semibold text-slate-800">
                Localization & Currency
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Configure currency, timezone and date format.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2">

            {{-- Currency --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Currency <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="currency"
                    value="{{ old('currency', $settings['currency'] ?? 'BDT') }}"
                    required
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="BDT"
                >

                @error('currency')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Currency Symbol --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Currency Symbol <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="currency_symbol"
                    value="{{ old('currency_symbol', $settings['currency_symbol'] ?? '৳') }}"
                    required
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="৳"
                >

                @error('currency_symbol')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Timezone --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Timezone <span class="text-red-500">*</span>
                </label>

                <select
                    name="timezone"
                    required
                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                >
                    <option value="Asia/Dhaka" @selected(old('timezone', $settings['timezone'] ?? 'Asia/Dhaka') === 'Asia/Dhaka')>
                        Asia/Dhaka
                    </option>

                    <option value="Asia/Kolkata" @selected(old('timezone', $settings['timezone'] ?? '') === 'Asia/Kolkata')>
                        Asia/Kolkata
                    </option>

                    <option value="UTC" @selected(old('timezone', $settings['timezone'] ?? '') === 'UTC')>
                        UTC
                    </option>
                </select>

                @error('timezone')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Date Format --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Date Format <span class="text-red-500">*</span>
                </label>

                <select
                    name="date_format"
                    required
                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                >
                    <option value="d M Y" @selected(old('date_format', $settings['date_format'] ?? 'd M Y') === 'd M Y')>
                        08 Oct 2026
                    </option>

                    <option value="d-m-Y" @selected(old('date_format', $settings['date_format'] ?? '') === 'd-m-Y')>
                        08-10-2026
                    </option>

                    <option value="d/m/Y" @selected(old('date_format', $settings['date_format'] ?? '') === 'd/m/Y')>
                        08/10/2026
                    </option>

                    <option value="Y-m-d" @selected(old('date_format', $settings['date_format'] ?? '') === 'Y-m-d')>
                        2026-10-08
                    </option>
                </select>

                @error('date_format')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>
    </div>

    {{-- Footer --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">
            <h2 class="text-lg font-semibold text-slate-800">
                Footer
            </h2>
        </div>

        <div class="p-5">

            <label class="mb-1 block text-sm font-medium text-slate-700">
                Footer Text
            </label>

            <textarea
                name="footer_text"
                rows="3"
                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                placeholder="© 2026 ABC School | All Rights Reserved"
            >{{ old('footer_text', $settings['footer_text'] ?? '') }}</textarea>

            @error('footer_text')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror

        </div>
    </div>

    {{-- Save Button --}}
    <div class="flex justify-end">

        <button
            type="submit"
            class="inline-flex items-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200"
        >
            Save General Settings
        </button>

    </div>

</form> 

</div>

@endsection
