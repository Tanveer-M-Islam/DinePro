@extends('layouts.public')

@section('content')
<div class="bg-gray-50 min-h-screen py-12" x-data="{ activeCategory: 'all', selectedItem: null }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Our Menu</h2>
            <p class="mt-4 text-xl text-gray-500">Delicious dishes crafted with passion.</p>
        </div>

        <!-- Category Tabs -->
        <div class="mt-12 flex justify-center space-x-4 overflow-x-auto pb-4">
            <button @click="activeCategory = 'all'" 
                    class="px-4 py-2 rounded-full text-sm font-medium transition-colors whitespace-nowrap"
                    :class="activeCategory === 'all' ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-100'"
                    style="background-color: activeCategory === 'all' ? 'var(--color-primary)' : ''">
                All Items
            </button>
            @foreach($categories as $category)
                @if($category->menuItems->count() > 0)
                <button @click="activeCategory = {{ $category->id }}" 
                        class="px-4 py-2 rounded-full text-sm font-medium transition-colors whitespace-nowrap"
                        :class="activeCategory === {{ $category->id }} ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-100'"
                        :style="activeCategory === {{ $category->id }} ? 'background-color: var(--color-primary)' : ''">
                    {{ $category->name }}
                </button>
                @endif
            @endforeach
        </div>

        <!-- Menu Grid -->
        <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($categories as $category)
                @foreach($category->menuItems as $item)
                    <div x-show="activeCategory === 'all' || activeCategory === {{ $category->id }}" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
                        <div class="h-48 w-full relative">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-md text-sm font-bold shadow-sm">
                                ${{ number_format($item->price, 2) }}
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $item->name }}</h3>
                                </div>
                                <p class="mt-2 text-sm text-gray-500 line-clamp-2">{{ $item->description }}</p>
                            </div>

                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>


</div>
@endsection
