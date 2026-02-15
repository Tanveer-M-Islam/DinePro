@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate">Add New Review</h2>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('admin.reviews.index') }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">Back</a>
        </div>
    </div>

    <form action="{{ route('admin.reviews.store') }}" method="POST" class="space-y-8 bg-white dark:bg-gray-800 p-8 rounded-lg shadow">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer Name</label>
                <div class="mt-1">
                    <input type="text" name="name" id="name" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                </div>
            </div>

            <div>
                <label for="review" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Review Text</label>
                <div class="mt-1">
                    <textarea id="review" name="review" rows="4" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border"></textarea>
                </div>
            </div>

            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rating (1-5)</label>
                <div class="mt-1">
                    <select id="rating" name="rating" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                        <option value="5">5 - Excellent</option>
                        <option value="4">4 - Good</option>
                        <option value="3">3 - Average</option>
                        <option value="2">2 - Poor</option>
                        <option value="1">1 - Terrible</option>
                    </select>
                </div>
            </div>

            <div class="relative flex items-start">
                <div class="flex h-5 items-center">
                    <input id="is_featured" name="is_featured" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700">
                </div>
                <div class="ml-3 text-sm">
                    <label for="is_featured" class="font-medium text-gray-700 dark:text-gray-300">Feature on Homepage</label>
                    <p class="text-gray-500 dark:text-gray-400">Show this review in the testimonials section.</p>
                </div>
            </div>

            <div class="relative flex items-start">
                <div class="flex h-5 items-center">
                    <input id="status" name="status" type="checkbox" value="1" checked class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700">
                </div>
                <div class="ml-3 text-sm">
                    <label for="status" class="font-medium text-gray-700 dark:text-gray-300">Active Status</label>
                    <p class="text-gray-500 dark:text-gray-400">Enable or disable this review globally.</p>
                </div>
            </div>
        </div>

        <div class="pt-5">
            <div class="flex justify-end">
                <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-primary-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">Create Review</button>
            </div>
        </div>
    </form>
</div>
@endsection
