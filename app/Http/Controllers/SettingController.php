<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * General Settings page
     */
    public function general()
    {
        $settings = Setting::pluck('value', 'key');

        return view('admin.settings.general', compact('settings'));
    }

    /**
     * Update General Settings
     */
    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'institute_name' => ['required', 'string', 'max:255'],
            'short_name' => ['nullable', 'string', 'max:100'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'favicon' => ['nullable', 'image', 'mimes:ico,png,jpg,jpeg,webp', 'max:1024'],
            'address' => ['nullable', 'string', 'max:500'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'eiin' => ['nullable', 'string', 'max:100'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:20'],
            'currency_symbol' => ['required', 'string', 'max:10'],
            'timezone' => ['required', 'string', 'max:100'],
            'date_format' => ['required', 'string', 'max:50'],
            'footer_text' => ['nullable', 'string', 'max:500'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Logo Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo')) {

            $oldLogo = Setting::where('key', 'logo')->value('value');

            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            $validated['logo'] = $request
                ->file('logo')
                ->store('settings', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Favicon Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('favicon')) {

            $oldFavicon = Setting::where('key', 'favicon')->value('value');

            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }

            $validated['favicon'] = $request
                ->file('favicon')
                ->store('settings', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Save Settings
        |--------------------------------------------------------------------------
        */

        foreach ($validated as $key => $value) {

            if ($value === null || $value === '') {
                continue;
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()
            ->route('admin.settings.general')
            ->with('success', 'General settings updated successfully.');
    }
}