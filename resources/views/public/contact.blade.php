@extends('layouts.public')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Contact Us</h2>
            <p class="mt-4 text-xl text-gray-500">We'd love to hear from you. Visit us or get in touch!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Contact Info -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Get into Touch</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--color-primary)">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-lg font-medium text-gray-900">Address</p>
                                <p class="mt-1 text-gray-500">{{ $settings->address ?? '123 Restaurant St, City, Country' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--color-primary)">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-lg font-medium text-gray-900">Phone</p>
                                <p class="mt-1 text-gray-500">{{ $settings->phone ?? '+1 234 567 890' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--color-primary)">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-lg font-medium text-gray-900">Email</p>
                                <p class="mt-1 text-gray-500">{{ $settings->contact_email ?? 'info@dinepro.com' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden h-96 md:h-auto">
                <iframe 
                    width="100%" 
                    height="100%" 
                    frameborder="0" 
                    scrolling="no" 
                    marginheight="0" 
                    marginwidth="0" 
                    src="https://maps.google.com/maps?q={{ urlencode($settings->address ?? 'New York') }}&t=&z=13&ie=UTF8&iwloc=&output=embed">
                </iframe>
            </div>
        </div>
    </div>
</div>
@endsection
