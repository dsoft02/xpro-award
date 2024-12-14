<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the settings index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all settings as key-value pairs and convert to an object for easy access
        $settings = (object) Setting::all()->pluck('value', 'key')->toArray();

        // Pass settings to the view
        return view('admin.settings.index', compact('settings'));
    }

/**
     * Update the settings.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate required fields for specific settings
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'enable_voting' => 'nullable|boolean',
            'declare_winner' => 'nullable|boolean',
            'voting_start_time' => 'nullable|date',
            'voting_end_time' => 'nullable|date|after_or_equal:voting_start_time',
            'whitelist_domains' => 'nullable|string|max:500',
        ]);

        $settings = $validated;

        // Manage dependencies between settings
        if ($request->has('declare_winner') && $request->boolean('declare_winner')) {
            $settings['enable_voting'] = 0; // Disable voting if declaring a winner
        } else {
            // Ensure `enable_voting` is toggled off if the voting period has ended
            if ($request->has('voting_end_time') && strtotime($request->input('voting_end_time')) < time()) {
                $settings['enable_voting'] = 0;
            }
        }

        // Ensure unset keys are explicitly disabled
        $settings['enable_voting'] = $request->boolean('enable_voting', false);
        $settings['declare_winner'] = $request->boolean('declare_winner', false);

        // Save or update each setting
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Clear the settings cache to reflect changes
        Setting::clearCache();

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
