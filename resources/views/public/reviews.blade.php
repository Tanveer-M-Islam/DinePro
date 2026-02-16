@extends('layouts.public')

@section('content')
    <div class="bg-surface py-16 sm:py-24" x-data="{ showReviewModal: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-semibold tracking-wide uppercase text-primary" style="color: var(--color-primary)">Testimonials</h2>
                <p class="mt-1 text-4xl font-extrabold sm:text-5xl sm:tracking-tight lg:text-6xl" style="color: var(--color-text)">What Our Customers Say</p>
                <div class="mt-6">
                    <button @click="showReviewModal = true" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:opacity-90 transition-all duration-300 hover:scale-105 hover:shadow-lg" style="background-color: var(--color-primary)">
                        Write a Review
                    </button>
                    <a href="{{ route('home') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-all duration-300 hover:scale-105 hover:shadow-lg">
                        Back to Home
                    </a>
                </div>
            </div>
            
            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($reviews as $review)
                <div class="bg-white rounded-2xl p-8 shadow-lg relative border border-gray-100 dark:border-gray-800">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 flex">
                            @for($i = 0; $i < $review->rating; $i++)
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-6">"{{ $review->review }}"</p>
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-primary flex items-center justify-center text-white font-bold" style="background-color: var(--color-primary)">
                            {{ substr($review->name, 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">{{ $review->name }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $reviews->links() }}
            </div>
        </div>

        <!-- Review Modal -->
        <div x-show="showReviewModal" x-cloak style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showReviewModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="showReviewModal = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showReviewModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                    <form action="{{ route('reviews.store') }}" method="POST" class="p-6">
                        @csrf
                        <div>
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-primary-100">
                                <svg class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--color-primary)">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-5">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Write a Review</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Share your experience with us.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>
                            <div x-data="{ rating: 0, hoverRating: 0 }">
                                <label class="block text-sm font-medium text-gray-700">Rating</label>
                                <div class="mt-1 flex items-center space-x-1">
                                    <template x-for="star in 5">
                                        <button type="button" 
                                            @click="rating = star" 
                                            @mouseover="hoverRating = star" 
                                            @mouseleave="hoverRating = 0"
                                            class="focus:outline-none transition-colors duration-150"
                                            :class="{ 'text-yellow-400': hoverRating >= star || (!hoverRating && rating >= star), 'text-gray-300': !((hoverRating >= star) || (!hoverRating && rating >= star)) }">
                                            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                        </button>
                                    </template>
                                </div>
                                <input type="hidden" name="rating" :value="rating" required>
                                <div class="mt-1 text-sm text-gray-500" x-show="rating > 0">
                                    <span x-text="['Terrible', 'Poor', 'Average', 'Good', 'Excellent'][rating - 1]"></span>
                                </div>
                            </div>
                            <div>
                                <label for="review" class="block text-sm font-medium text-gray-700">Comment (Max 100 words)</label>
                                <textarea id="review" name="review" rows="4" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm" placeholder="Tell us about your experience..."></textarea>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:col-start-2 sm:text-sm" style="background-color: var(--color-primary)">
                                Submit Review
                            </button>
                            <button type="button" @click="showReviewModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
