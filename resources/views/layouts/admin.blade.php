<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'DinePro') }} Admin</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full bg-gray-50 text-gray-900 font-sans" x-data="{ sidebarOpen: false }">
    
    <div x-show="sidebarOpen" @click.away="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80 z-40 lg:hidden" role="dialog" aria-modal="true"></div>

    <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed z-50 inset-y-0 left-0 w-64 px-4 py-4 transition-transform duration-300 ease-in-out lg:translate-x-0 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col gap-y-5">
        <div class="flex h-16 shrink-0 items-center gap-2 px-6">
            @if(isset($settings) && $settings->logo)
                <img class="h-8 w-auto" src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->restaurant_name }}">
            @else
                <div class="h-8 w-8 rounded-full bg-primary-600 flex items-center justify-center text-white font-bold text-lg">
                    {{ substr($settings->restaurant_name ?? 'D', 0, 1) }}
                </div>
            @endif
             <span class="text-lg font-bold text-gray-900 dark:text-white">{{ $settings->restaurant_name ?? 'DinePro' }}</span>
        </div>

        <nav class="flex-1 flex flex-col gap-y-1">
             <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-x-3 p-2 rounded-lg text-sm font-semibold leading-6 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-50 dark:bg-gray-700 text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-x-3 p-2 rounded-lg text-sm font-semibold leading-6 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-50 dark:bg-gray-700 text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.892 2.607.452l2.66-1.33c.825-.412 1.375-1.298 1.375-2.217v-4.318c0-.597-.237-1.17-.659-1.591l-9.581-9.581A2.25 2.25 0 009.568 3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                  </svg>                  
                Categories
            </a>
            <a href="{{ route('admin.menu-items.index') }}" class="flex items-center gap-x-3 p-2 rounded-lg text-sm font-semibold leading-6 {{ request()->routeIs('admin.menu-items.*') ? 'bg-gray-50 dark:bg-gray-700 text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                  </svg>                  
                Menu Items
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-x-3 p-2 rounded-lg text-sm font-semibold leading-6 {{ request()->routeIs('admin.orders.*') ? 'bg-gray-50 dark:bg-gray-700 text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                  </svg>                  
                Orders
            </a>
             <a href="{{ route('admin.reservations.index') }}" class="flex items-center gap-x-3 p-2 rounded-lg text-sm font-semibold leading-6 {{ request()->routeIs('admin.reservations.*') ? 'bg-gray-50 dark:bg-gray-700 text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0h18M5.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                  </svg>                  
                Reservations
            </a>
            <a href="{{ route('admin.reviews.index') }}" class="flex items-center gap-x-3 p-2 rounded-lg text-sm font-semibold leading-6 {{ request()->routeIs('admin.reviews.*') ? 'bg-gray-50 dark:bg-gray-700 text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.563.045.797.77.362 1.15l-4.243 3.715a.563.563 0 00-.173.522l1.248 5.405c.13.563-.482.993-.97.72l-4.73-2.617a.563.563 0 00-.547 0l-4.73 2.617c-.488.272-1.1-.157-.97-.72l1.248-5.405a.563.563 0 00-.172-.522l-4.244-3.715c-.435-.38-.2-.1.106-.362.532-3.718l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                </svg>
                Customer Reviews
            </a>
            <div class="text-xs font-semibold leading-6 text-gray-400 dark:text-gray-500 mt-6 pl-2">Settings</div>
            <a href="{{ route('admin.settings.edit') }}" class="flex items-center gap-x-3 p-2 rounded-lg text-sm font-semibold leading-6 {{ request()->routeIs('admin.settings.*') ? 'bg-gray-50 dark:bg-gray-700 text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                Website Settings
            </a>
            @php
                $themeActiveClass = request()->routeIs('admin.themes.*') 
                    ? 'bg-gray-50 dark:bg-gray-700 text-primary-600 dark:text-primary-400' 
                    : 'text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700';
            @endphp
            <a href="{{ route('admin.themes.index') }}" class="flex items-center gap-x-3 p-2 rounded-lg text-sm font-semibold leading-6 {{ $themeActiveClass }}">
                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.435-.435 1.133-.435 1.569 0l3.715 3.715c.435.435.435 1.133 0 1.568l-2.88 2.88" />
                  </svg>
                Theme Manager
            </a>
        </nav>
        
        <div class="mt-auto pt-6 border-t border-gray-200 dark:border-gray-700">
             <div class="flex items-center gap-x-4 px-2 py-3 text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg cursor-pointer">
                <img class="h-8 w-8 rounded-full bg-gray-50" src="https://ui-avatars.com/api/?name=Admin&background=random" alt="">
                <span class="sr-only">Your profile</span>
                <span aria-hidden="true">{{ Auth::user()->name }}</span>
            </div>
             <form method="POST" action="{{ route('admin.logout') }}" class="px-2">
                @csrf
                <button type="submit" class="w-full text-left flex items-center gap-x-3 p-2 rounded-lg text-sm font-semibold leading-6 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                      </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:pl-64 flex flex-col min-h-screen transition-all duration-300">
        <!-- Top bar -->
        <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
            <button type="button" @click="sidebarOpen = true" class="-m-2.5 p-2.5 text-gray-700 dark:text-gray-200 lg:hidden">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                <div class="relative flex flex-1"></div>
                <div class="flex items-center gap-x-4 lg:gap-x-6">

                </div>
            </div>
        </div>

        <main class="py-10">
            <div class="px-4 sm:px-6 lg:px-8">
                 @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
