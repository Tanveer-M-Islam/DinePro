<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- SEO Meta Tags -->
    <title>{{ optional($settings)->seo_title ? $settings->seo_title : config('app.name', 'DinePro') }}</title>
    <meta name="description" content="{{ optional($settings)->seo_description ?? 'Welcome to ' . (optional($settings)->restaurant_name ?? 'DinePro') }}">
    <meta name="keywords" content="{{ optional($settings)->seo_keywords ?? 'restaurant, dining, food' }}">
    <meta property="og:title" content="{{ optional($settings)->seo_title ? $settings->seo_title : (optional($settings)->restaurant_name ?? 'DinePro') }}">
    <meta property="og:description" content="{{ optional($settings)->seo_description ?? '' }}">
    @if(optional($settings)->hero_image)
    <meta property="og:image" content="{{ asset('storage/' . $settings->hero_image) }}">
    @endif
    <meta property="og:type" content="website">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Theme Config -->
    {{-- 
        This section loads the selected theme from the database (via $settings)
        or falls back to the default 'elegant_dark' theme. 
        Theme definitions are located in config/themes.php
    --}}
    @php
        $themeName = optional($settings)->theme_name ?? 'elegant_dark';
        $theme = config("themes.$themeName") ?? config('themes.elegant_dark');
    @endphp
    
    <style>
        /* 
           Dynamic CSS Variables based on the selected theme.
           You can use these variables throughout your CSS/Tailwind classes.
        */
        :root {
            --color-primary: {{ $theme['colors']['primary'] }};
            --color-secondary: {{ $theme['colors']['secondary'] }};
            --color-background: {{ $theme['colors']['background'] }};
            --color-text: {{ $theme['colors']['text'] }};
            --color-surface: {{ $theme['colors']['surface'] ?? $theme['colors']['background'] }};
            --color-text-muted: {{ $theme['colors']['text_muted'] ?? $theme['colors']['text'] }};
            --color-accent: {{ $theme['colors']['accent'] }};
            
            --font-heading: '{{ $theme['fonts']['heading'] }}', sans-serif;
            --font-body: '{{ $theme['fonts']['body'] }}', sans-serif;
        }
        
        body {
            background-color: var(--color-background);
            color: var(--color-text);
            font-family: var(--font-body);
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
        }
        
        .text-primary { color: var(--color-primary); }
        .bg-primary { background-color: var(--color-primary); }
        .text-secondary { color: var(--color-secondary); }
        .bg-secondary { background-color: var(--color-secondary); }
        .text-accent { color: var(--color-accent); }
        .bg-surface { background-color: var(--color-surface); }
        .text-muted { color: var(--color-text-muted); }
        
        /* Hero Styles based on theme config */
        @if($theme['hero_style'] === 'centered')
            .hero-section { text-align: center; }
        @elseif($theme['hero_style'] === 'split')
            .hero-section { display: flex; align-items: center; }
            .hero-content { flex: 1; padding-right: 2rem; }
            .hero-image { flex: 1; }
        @elseif($theme['hero_style'] === 'overlay')
            .hero-section { position: relative; color: white; }
            .hero-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.6); }
            .hero-content { position: relative; z-index: 10; text-align: center; }
            .hero-content { position: relative; z-index: 10; text-align: center; }
        @endif
        
        [x-cloak] { display: none !important; }
    </style>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family={{ urlencode($theme['fonts']['heading']) }}:wght@400;700&family={{ urlencode($theme['fonts']['body']) }}:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="antialiased opacity-0 transition-opacity duration-300 text-gray-900" onload="document.body.classList.remove('opacity-0')">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white/90 backdrop-blur-md fixed w-full z-20 top-0 start-0 border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                                @if(isset($settings) && $settings->logo)
                                    <img src="{{ asset('storage/' . $settings->logo) }}" class="h-8" alt="Logo">
                                @else
                                    <span class="self-center text-2xl font-bold whitespace-nowrap text-primary" style="font-family: var(--font-heading)">{{ optional($settings)->restaurant_name ?? 'Dines' }}</span>
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 hover:scale-110">Home</a>
                        <a href="{{ route('menu.index') }}" class="text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 hover:scale-110">Menu</a>
                        <a href="{{ route('home') }}#about" class="text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 hover:scale-110">About</a>
                        <a href="{{ route('contact.index') }}" class="text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 hover:scale-110">Contact</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow pt-16">
            @yield('content')
        </main>

        <footer class="bg-gray-900 text-white py-8 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:justify-between items-center">
                    <div class="mb-6 md:mb-0 text-center md:text-left">
                        <span class="self-center text-2xl font-semibold whitespace-nowrap" style="font-family: var(--font-heading)">{{ optional($settings)->restaurant_name ?? 'Dines' }}</span>
                        <p class="mt-2 text-gray-400 text-sm">{{ $settings->footer_text ?? 'Experience culinary excellence.' }}</p>
                    </div>
                    <div class="flex space-x-6">
                        @if($settings->facebook_link)
                        <a href="{{ $settings->facebook_link }}" target="_blank" class="text-gray-400 hover:text-white transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        @endif
                        @if($settings->instagram_link)
                        <a href="{{ $settings->instagram_link }}" target="_blank" class="text-gray-400 hover:text-white transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.48 2h-.165zm0-2C9.58 0 9.227.012 8.165.06 7.1.11 6.37.288 5.733.535a6.927 6.927 0 00-2.518 1.638A6.926 6.926 0 001.577 4.69c-.247.637-.425 1.367-.474 2.432C1.04 8.218 1.03 8.57 1.03 11.233v.535c0 2.662.01 3.015.073 4.141.049 1.065.227 1.795.474 2.432a6.928 6.928 0 001.638 2.518 6.928 6.928 0 002.518 1.638c.637.247 1.367.425 2.432.474 1.126.049 1.479.06 4.141.06h.535c2.662 0 3.015-.01 4.141-.073 1.065-.049 1.795-.227 2.432-.474a6.927 6.927 0 002.518-1.638 6.926 6.926 0 001.638-2.518c.247-.637.425-1.367.474-2.432.049-1.126.06-1.479.06-4.141v-.535c0-2.662-.01-3.015-.073-4.141-.049-1.065-.227-1.795-.474-2.432a6.928 6.928 0 00-1.638-2.518 6.927 6.927 0 00-2.518-1.638c-.637-.247-1.367-.425-2.432-.474C15.343.013 14.99 0 12.315 0h.165z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M12.48 5.867a6.133 6.133 0 100 12.267 6.133 6.133 0 000-12.267zm0 10.267a4.133 4.133 0 110-8.267 4.133 4.133 0 010 8.267z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M18.845 6.365a1.196 1.196 0 100-2.393 1.196 1.196 0 000 2.393z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>
                <hr class="my-6 border-gray-700 sm:mx-auto lg:my-8" />
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-gray-400 sm:text-center">© {{ date('Y') }} {{ optional($settings)->restaurant_name ?? 'DinePro' }}. All Rights Reserved.</span>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
</body>
</html>
