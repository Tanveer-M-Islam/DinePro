@extends('layouts.public')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gray-900 overflow-hidden">
        <div class="absolute inset-0">
            @if($settings && $settings->hero_image)
                <img class="w-full h-full object-cover" src="{{ asset('storage/' . $settings->hero_image) }}" alt="Restaurant Background">
            @else
                <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" alt="Restaurant Background">
            @endif
            <div class="absolute inset-0 bg-gray-900/60 mix-blend-multiply"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center hero-section">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl hero-content">
                {{ $settings->hero_title ?? 'Welcome to DinePro' }}
            </h1>
            <p class="mt-6 text-xl text-gray-300 max-w-3xl mx-auto hero-content">
                {{ $settings->hero_subtitle ?? 'Experience the best dining with our exquisite menu and cozy atmosphere.' }}
            </p>
            <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center hero-content">
                <div class="space-y-4 sm:space-y-0 sm:mx-auto sm:inline-grid sm:grid-cols-2 sm:gap-5">
                    <a href="{{ route('menu.index') }}" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-gray-900 bg-white hover:bg-gray-50 sm:px-8 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                        View Menu
                    </a>
                    <a href="{{ route('book-table.index') }}" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary hover:opacity-90 sm:px-8 transform transition-all duration-300 hover:scale-105 hover:shadow-lg" style="background-color: var(--color-primary)">
                        Book a Table
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Dishes -->
    <div class="bg-surface py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-semibold tracking-wide uppercase text-primary" style="color: var(--color-primary)">Our Specialties</h2>
                <p class="mt-1 text-4xl font-extrabold sm:text-5xl sm:tracking-tight lg:text-6xl" style="color: var(--color-text)">Featured Dishes</p>
                <p class="max-w-xl mt-5 mx-auto text-xl text-muted">Hand-picked favorites from our chef.</p>
            </div>
            
            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($featuredItems as $item)
                <div class="group relative bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="aspect-w-3 aspect-h-2 bg-gray-200 group-hover:opacity-75 relative h-64 overflow-hidden">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-bold shadow-sm text-gray-900">
                            ${{ number_format($item->price, 2) }}
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold group-hover:text-primary transition-colors" style="color: var(--color-text)">
                            {{ $item->name }}
                        </h3>
                        <p class="mt-3 text-base text-muted line-clamp-2">{{ $item->description }}</p>

                    </div>
                </div>
                @endforeach
            </div>
             <div class="mt-10 text-center">
                <a href="{{ route('menu.index') }}" class="inline-flex items-center text-primary font-semibold hover:underline transform transition-all duration-200 hover:scale-105" style="color: var(--color-primary)">
                    View Full Menu <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div id="about" class="bg-white py-16 sm:py-24 lg:py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                <!-- Content -->
                <div class="lg:pr-8">
                    <h2 class="text-base font-semibold tracking-wide uppercase text-primary" style="color: var(--color-primary)">About Us</h2>
                    <h3 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight sm:text-4xl" style="color: var(--color-text)">
                        {{ $settings->restaurant_name ?? 'DinePro' }}
                    </h3>
                    <p class="mt-4 text-lg text-muted text-justify">
                        {{ $settings->about_text ?? 'We are dedicated to serving the finest food with the best ingredients. Our chefs are passionate about creating dishes that not only taste good but also look good.' }}
                    </p>
                    <div class="mt-8">
                        <a href="{{ route('menu.index') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:opacity-90 transition-all duration-300 hover:scale-105 hover:shadow-lg" style="background-color: var(--color-primary)">
                            View Menu
                        </a>
                    </div>
                </div>
                
                <!-- Image -->
                <div class="mt-12 lg:mt-0 relative">
                    <div class="relative rounded-2xl overflow-hidden shadow-xl aspect-w-16 aspect-h-9 lg:aspect-none lg:h-full">
                        @if($settings && $settings->about_image)
                            <img class="w-full h-full object-cover rounded-2xl transform transition-transform duration-500 hover:scale-105" src="{{ asset('storage/' . $settings->about_image) }}" alt="About {{ $settings->restaurant_name }}">
                        @else
                            <img class="w-full h-full object-cover rounded-2xl transform transition-transform duration-500 hover:scale-105" src="https://images.unsplash.com/photo-1559339352-11d035aa65de?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Restaurant Interior">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent mix-blend-multiply rounded-2xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Reviews Section -->
    <div class="bg-surface py-16 sm:py-24" x-data="{ showReviewModal: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-semibold tracking-wide uppercase text-primary" style="color: var(--color-primary)">Testimonials</h2>
                <p class="mt-1 text-4xl font-extrabold sm:text-5xl sm:tracking-tight lg:text-6xl" style="color: var(--color-text)">What Our Customers Say</p>
                <div class="mt-6">
                    <button @click="showReviewModal = true" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:opacity-90 transition-all duration-300 hover:scale-105 hover:shadow-lg" style="background-color: var(--color-primary)">
                        Write a Review
                    </button>
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
