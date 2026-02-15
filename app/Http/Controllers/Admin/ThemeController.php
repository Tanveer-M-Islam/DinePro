<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = config('themes');
        $currentTheme = \App\Models\WebsiteSetting::first()?->theme_name ?? 'elegant_dark';
        
        return view('admin.themes.index', compact('themes', 'currentTheme'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'theme_name' => 'required|string',
        ]);
        
        if (!array_key_exists($request->theme_name, config('themes'))) {
             return back()->withErrors(['theme_name' => 'Invalid theme selected.']);
        }

        $settings = \App\Models\WebsiteSetting::first();
        if ($settings) {
            $settings->update(['theme_name' => $request->theme_name]);
        } else {
             \App\Models\WebsiteSetting::create([
                 'theme_name' => $request->theme_name,
                 // Default values for other required fields if creating new
                 'restaurant_name' => 'DinePro',
             ]);
        }

        return back()->with('success', 'Theme updated successfully.');
    }
}
