<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteSettingController extends Controller
{
    public function edit()
    {
        $settings = \App\Models\WebsiteSetting::first() ?? new \App\Models\WebsiteSetting();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'restaurant_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096', // Max 4MB
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096', // Max 4MB
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'about_text' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'required|string',
            'footer_text' => 'nullable|string',
            'facebook_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_keywords' => 'nullable|string|max:255',
            'opening_time' => 'nullable|string|max:255',
            'closing_time' => 'nullable|string|max:255',
            'announcement' => 'nullable|string',
        ]);

        $settings = \App\Models\WebsiteSetting::first();
        if (!$settings) {
            $settings = new \App\Models\WebsiteSetting();
        }

        if ($request->hasFile('logo')) {
            if ($settings->logo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($settings->logo);
            }
            $path = $request->file('logo')->store('logos', 'public');
            $settings->logo = $path;
        }

        if ($request->hasFile('hero_image')) {
            if ($settings->hero_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($settings->hero_image);
            }
            $path = $request->file('hero_image')->store('hero', 'public');
            $settings->hero_image = $path;
        }

        if ($request->hasFile('about_image')) {
            if ($settings->about_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($settings->about_image);
            }
            $path = $request->file('about_image')->store('about', 'public');
            $settings->about_image = $path;
        }

        $settings->restaurant_name = $validated['restaurant_name'];
        $settings->hero_title = $validated['hero_title'];
        $settings->hero_subtitle = $validated['hero_subtitle'];
        $settings->about_text = $validated['about_text'];
        $settings->phone = $validated['phone'];
        $settings->contact_email = $validated['contact_email'];
        $settings->address = $validated['address'];
        $settings->footer_text = $validated['footer_text'];
        $settings->facebook_link = $validated['facebook_link'];
        $settings->instagram_link = $validated['instagram_link'];
        $settings->seo_title = $validated['seo_title'] ?? null;
        $settings->seo_description = $validated['seo_description'] ?? null;
        $settings->seo_keywords = $validated['seo_keywords'] ?? null;
        $settings->opening_time = $validated['opening_time'] ?? null;
        $settings->closing_time = $validated['closing_time'] ?? null;
        $settings->announcement = $validated['announcement'] ?? null;
        $settings->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function deleteImage($type)
    {
        $allowedTypes = ['logo', 'hero_image', 'about_image'];

        if (!in_array($type, $allowedTypes)) {
            return redirect()->back()->with('error', 'Invalid image type.');
        }

        $settings = \App\Models\WebsiteSetting::first();

        if ($settings && $settings->$type) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($settings->$type);
            $settings->$type = null;
            $settings->save();
        }

        return redirect()->back()->with('success', ucfirst(str_replace('_', ' ', $type)) . ' deleted successfully.');
    }
}
