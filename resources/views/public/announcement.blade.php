@extends('layouts.public')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-16 sm:py-24">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
            <div class="px-4 py-5 sm:px-6 bg-primary-600 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-2xl leading-6 font-medium text-white">
                    Important Announcement
                </h3>
            </div>
            <div class="px-4 py-8 sm:px-6">
                <div class="prose prose-lg dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                    {!! nl2br(e($settings->announcement)) !!}
                </div>
                
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('home') }}" class="text-primary-600 hover:text-primary-500 font-medium flex items-center">
                        <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
