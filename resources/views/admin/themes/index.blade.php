@extends('layouts.admin')

@section('content')
<div x-data="{
    selectedTheme: '{{ $currentTheme }}',
    themes: {{ json_encode($themes) }}
}">
    <!-- Header -->
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate">Theme Manager</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Select a theme to customize your website's appearance.</p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
             <form method="POST" action="{{ route('admin.themes.update') }}">
                @csrf
                <input type="hidden" name="theme_name" x-model="selectedTheme">
                <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-primary-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                    Save Changes
                </button>
            </form>
        </div>
    </div>

    <!-- Theme Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <template x-for="(theme, key) in themes" :key="key">
            <div @click="selectedTheme = key" 
                 class="relative rounded-xl border-2 cursor-pointer transition-all duration-200 overflow-hidden group"
                 :class="selectedTheme === key ? 'border-primary-600 ring-2 ring-primary-600 ring-offset-2 dark:ring-offset-gray-900' : 'border-gray-200 dark:border-gray-700 hover:border-primary-400'">
                
                <!-- Preview Area -->
                <div class="h-48 w-full relative" :style="`background-color: ${theme.colors.background}`">
                    <!-- Fake Hero -->
                    <div class="absolute inset-0 flex items-center justify-center p-4">
                        <div class="text-center" :class="{
                            'text-left pl-4': theme.hero_style === 'split',
                            'bg-black/50 p-4 rounded text-white': theme.hero_style === 'overlay'
                        }">
                            <h3 class="text-lg font-bold mb-2" :style="`color: ${theme.hero_style === 'overlay' ? '#fff' : theme.colors.heading_color || theme.colors.text}; font-family: ${theme.fonts.heading}`">Dines</h3>
                            <button class="px-3 py-1 rounded text-xs font-semibold" :style="`background-color: ${theme.colors.primary}; color: ${theme.colors.background === '#121212' ? '#000' : '#fff'}`">Order Now</button>
                        </div>
                    </div>
                    
                    <!-- Color Strip -->
                    <div class="absolute bottom-0 inset-x-0 h-2 flex">
                        <div class="flex-1" :style="`background-color: ${theme.colors.primary}`"></div>
                        <div class="flex-1" :style="`background-color: ${theme.colors.secondary}`"></div>
                        <div class="flex-1" :style="`background-color: ${theme.colors.accent}`"></div>
                    </div>
                </div>

                <!-- Info Area -->
                <div class="p-4 bg-white dark:bg-gray-800">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white" x-text="theme.name"></h3>
                         <div x-show="selectedTheme === key" class="text-primary-600">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
@endsection
