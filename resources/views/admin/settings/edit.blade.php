@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate">Website Settings</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your restaurant's information and branding.</p>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 divide-y divide-gray-200 dark:divide-gray-700">
        @csrf
        @method('PUT')

        <div class="space-y-8 divide-y divide-gray-200 dark:divide-gray-700">
            <div>
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <!-- Restaurant Name -->
                    <div class="sm:col-span-4">
                        <label for="restaurant_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Restaurant Name</label>
                        <div class="mt-1">
                            <input type="text" name="restaurant_name" id="restaurant_name" value="{{ old('restaurant_name', $settings->restaurant_name ?? '') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                        </div>
                    </div>

                    <!-- Logo -->
                    <div class="sm:col-span-6">
                        <label for="logo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Logo</label>
                        <div class="mt-1 flex items-center">
                            @if($settings && $settings->logo)
                                <span class="h-12 w-12 overflow-hidden rounded-full bg-gray-100 mr-4">
                                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="Current Logo" class="h-full w-full object-cover">
                                </span>
                                <button type="button" onclick="if(confirm('Are you sure you want to delete the logo?')) document.getElementById('delete-logo-form').submit()" class="text-xs text-red-600 hover:text-red-900 mr-4 border border-red-200 bg-red-50 rounded px-2 py-1">Delete</button>
                            @endif
                            <input type="file" name="logo" id="logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-gray-700 dark:file:text-gray-300">
                        </div>
                    </div>

                    <div class="sm:col-span-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Hero Section</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Customize the homepage banner.</p>
                    </div>

                    <!-- Hero Image -->
                    <div class="sm:col-span-6">
                        <label for="hero_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hero Background Image</label>
                        <div class="mt-1 flex items-center">
                            @if($settings && $settings->hero_image)
                                <span class="h-20 w-32 overflow-hidden rounded-md bg-gray-100 mr-4 border border-gray-200">
                                    <img src="{{ asset('storage/' . $settings->hero_image) }}" alt="Current Hero Image" class="h-full w-full object-cover">
                                </span>
                                <button type="button" onclick="if(confirm('Are you sure you want to delete the hero image?')) document.getElementById('delete-hero-form').submit()" class="text-xs text-red-600 hover:text-red-900 mr-4 border border-red-200 bg-red-50 rounded px-2 py-1">Delete</button>
                            @endif
                            <input type="file" name="hero_image" id="hero_image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-gray-700 dark:file:text-gray-300">
                        </div>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Recommended size: 1920x1080px (Max 4MB).</p>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="hero_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hero Title</label>
                        <div class="mt-1">
                            <input type="text" name="hero_title" id="hero_title" value="{{ old('hero_title', $settings->hero_title ?? '') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="hero_subtitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hero Subtitle</label>
                        <div class="mt-1">
                            <input type="text" name="hero_subtitle" id="hero_subtitle" value="{{ old('hero_subtitle', $settings->hero_subtitle ?? '') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="opening_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Opening Time</label>
                        <div class="mt-1">
                            <input type="text" name="opening_time" id="opening_time" value="{{ old('opening_time', $settings->opening_time ?? '') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border" placeholder="e.g. 10:00 AM">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="closing_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Closing Time</label>
                        <div class="mt-1">
                            <input type="text" name="closing_time" id="closing_time" value="{{ old('closing_time', $settings->closing_time ?? '') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border" placeholder="e.g. 10:00 PM">
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="announcement" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Announcement</label>
                        <div class="mt-1">
                            <textarea id="announcement" name="announcement" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border" placeholder="Enter important announcement here...">{{ old('announcement', $settings->announcement ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Contact & About</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your contact information and about section.</p>
                    </div>

                    <!-- About Image -->
                    <div class="sm:col-span-6">
                        <label for="about_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">About Section Image</label>
                        <div class="mt-1 flex items-center">
                            @if($settings && $settings->about_image)
                                <span class="h-20 w-32 overflow-hidden rounded-md bg-gray-100 mr-4 border border-gray-200">
                                    <img src="{{ asset('storage/' . $settings->about_image) }}" alt="About Image" class="h-full w-full object-cover">
                                </span>
                                <button type="button" onclick="if(confirm('Are you sure you want to delete the about image?')) document.getElementById('delete-about-form').submit()" class="text-xs text-red-600 hover:text-red-900 mr-4 border border-red-200 bg-red-50 rounded px-2 py-1">Delete</button>
                            @endif
                            <input type="file" name="about_image" id="about_image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-gray-700 dark:file:text-gray-300">
                        </div>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Image to display in the About Us section.</p>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="about_text" class="block text-sm font-medium text-gray-700 dark:text-gray-300">About Text</label>
                        <div class="mt-1">
                            <textarea id="about_text" name="about_text" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">{{ old('about_text', $settings->about_text ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Email</label>
                        <div class="mt-1">
                            <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $settings->contact_email ?? '') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                        <div class="mt-1">
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $settings->phone ?? '') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                        </div>
                    </div>

                     <div class="sm:col-span-6">
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                    <div class="mt-1">
                        <textarea id="address" name="address" rows="2" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">{{ $settings->address }}</textarea>
                    </div>
                </div>

                <div>
                    <label for="footer_text" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Footer Text</label>
                    <div class="mt-1">
                        <textarea id="footer_text" name="footer_text" rows="2" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">{{ $settings->footer_text }}</textarea>
                    </div>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Short text to appear in the footer.</p>
                </div>

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div>
                        <label for="facebook_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Facebook Link</label>
                        <div class="mt-1">
                            <input type="url" name="facebook_link" id="facebook_link" value="{{ $settings->facebook_link }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                        </div>
                    </div>

                    <div>
                        <label for="instagram_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Instagram Link</label>
                        <div class="mt-1">
                            <input type="url" name="instagram_link" id="instagram_link" value="{{ $settings->instagram_link }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                        </div>
                    </div>
                </div>
            
            <div class="sm:col-span-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">SEO Settings</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Optimize your homepage for search engines.</p>
            </div>
                    <div class="sm:col-span-4">
                        <label for="seo_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">SEO Title</label>
                        <div class="mt-1">
                            <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $settings->seo_title ?? '') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border" placeholder="e.g. DinePro - Best Italian Restaurant in Town">
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="seo_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">SEO Description</label>
                        <div class="mt-1">
                            <textarea id="seo_description" name="seo_description" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border" placeholder="Brief summary of your restaurant for search results.">{{ old('seo_description', $settings->seo_description ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="seo_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300">SEO Keywords</label>
                        <div class="mt-1">
                            <input type="text" name="seo_keywords" id="seo_keywords" value="{{ old('seo_keywords', $settings->seo_keywords ?? '') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border" placeholder="comma, separated, keywords, e.g. italian, pasta, pizza, fine dining">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-5">
            <div class="flex justify-end">
                <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-primary-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection

<form id="delete-logo-form" action="{{ route('admin.settings.delete-image', 'logo') }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<form id="delete-hero-form" action="{{ route('admin.settings.delete-image', 'hero_image') }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<form id="delete-about-form" action="{{ route('admin.settings.delete-image', 'about_image') }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
