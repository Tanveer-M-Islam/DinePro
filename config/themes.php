<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Themes Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can define the themes available for your application.
    | Each theme is an array with the following structure:
    |
    | 'theme_key' => [
    |     'name' => 'Human Readable Name',
    |     'colors' => [
    |         'primary' => '#hex',    // Main brand color
    |         'secondary' => '#hex',  // Secondary brand color (often darker)
    |         'background' => '#hex', // Site background
    |         'surface' => '#hex',    // Cards / Sections background
    |         'text' => '#hex',       // Main text color (usually contrast to background)
    |         'text_muted' => '#hex', // Secondary text color
    |         'accent' => '#hex',     // Highlight color for buttons/links
    |     ],
    |     'fonts' => [
    |         'heading' => 'Font Name', // Google Font name for headings
    |         'body' => 'Font Name',    // Google Font name for body text
    |     ],
    |     'hero_style' => 'style',      // Options: 'centered', 'split', 'overlay', 'gradient', 'warm', 'organic', 'bold', 'calm', 'vibrant', 'industrial'
    | ],
    |
    | To add a new theme, simply copy an existing block, give it a unique key,
    | and change the values. The new theme will automatically appear in the
    | admin panel.
    |
    */

    'elegant_dark' => [
        'name' => 'Elegant Midnight',
        'colors' => [
            'primary' => '#fbbf24', // Amber-400
            'secondary' => '#1f2937', // Gray-800
            'background' => '#111827', // Gray-900
            'surface' => '#1f2937', // Gray-800 (Card/Section BG)
            'text' => '#f3f4f6', // Gray-100
            'text_muted' => '#9ca3af', // Gray-400
            'accent' => '#d97706', // Amber-600
        ],
        'fonts' => [
            'heading' => 'Playfair Display',
            'body' => 'Lato',
        ],
        'hero_style' => 'centered',
    ],

    'luxury_gold' => [
        'name' => 'Gilded Luxury',
        'colors' => [
            'primary' => '#d4af37', // Gold
            'secondary' => '#262626', // Neutral-800
            'background' => '#0a0a0a', // Neutral-950
            'surface' => '#171717', // Neutral-900
            'text' => '#fafafa', // Neutral-50
            'text_muted' => '#a3a3a3', // Neutral-400
            'accent' => '#f59e0b', // Amber-500
        ],
        'fonts' => [
            'heading' => 'Cinzel',
            'body' => 'Raleway',
        ],
        'hero_style' => 'overlay',
    ],
    'modern_gradient' => [
        'name' => 'Berry Gradient',
        'colors' => [
            'primary' => '#9333ea', // Purple-600
            'secondary' => '#f3e8ff', // Purple-100
            'background' => '#ffffff', // White
            'surface' => '#faf5ff', // Purple-50
            'text' => '#1e1b4b', // Indigo-950
            'text_muted' => '#6b7280', // Gray-500
            'accent' => '#db2777', // Pink-600
        ],
        'fonts' => [
            'heading' => 'Poppins',
            'body' => 'Inter',
        ],
        'hero_style' => 'gradient',
    ],
    'rustic_brown' => [
        'name' => 'Warm Rustic',
        'colors' => [
            'primary' => '#9a3412', // Orange-800
            'secondary' => '#ffedd5', // Orange-100
            'background' => '#fff7ed', // Orange-50
            'surface' => '#fed7aa', // Orange-200 (Subtle tint)
            'text' => '#431407', // Orange-950
            'text_muted' => '#7c2d12', // Orange-900 (Muted)
            'accent' => '#c2410c', // Orange-700
        ],
        'fonts' => [
            'heading' => 'Bitter',
            'body' => 'Merriweather',
        ],
        'hero_style' => 'warm',
    ],
    'fresh_green' => [
        'name' => 'Fresh Basil',
        'colors' => [
            'primary' => '#15803d', // Green-700
            'secondary' => '#dcfce7', // Green-100
            'background' => '#ffffff', // White
            'surface' => '#f0fdf4', // Green-50
            'text' => '#14532d', // Green-900
            'text_muted' => '#166534', // Green-800 Muted
            'accent' => '#16a34a', // Green-600
        ],
        'fonts' => [
            'heading' => 'Quicksand',
            'body' => 'Nunito',
        ],
        'hero_style' => 'organic',
    ],
    'classic_red' => [
        'name' => 'Classic Crimson',
        'colors' => [
            'primary' => '#b91c1c', // Red-700
            'secondary' => '#fee2e2', // Red-100
            'background' => '#ffffff', // White
            'surface' => '#fff1f2', // Rose-50
            'text' => '#881337', // Rose-900
            'text_muted' => '#9f1239', // Rose-800 Muted
            'accent' => '#e11d48', // Rose-600
        ],
        'fonts' => [
            'heading' => 'Lora',
            'body' => 'Roboto',
        ],
        'hero_style' => 'bold',
    ],
    'ocean_blue' => [
        'name' => 'Ocean Breeze',
        'colors' => [
            'primary' => '#0369a1', // Sky-700
            'secondary' => '#e0f2fe', // Sky-100
            'background' => '#ffffff', // White
            'surface' => '#f0f9ff', // Sky-50
            'text' => '#0c4a6e', // Sky-900
            'text_muted' => '#075985', // Sky-800 Muted
            'accent' => '#0ea5e9', // Sky-500
        ],
        'fonts' => [
            'heading' => 'Oswald',
            'body' => 'Roboto Condensed',
        ],
        'hero_style' => 'calm',
    ],
    'sunset_orange' => [
        'name' => 'Sunset Glow',
        'colors' => [
            'primary' => '#ea580c', // Orange-600
            'secondary' => '#ffedd5', // Orange-100
            'background' => '#fffaf0', // Warm Floral White
            'surface' => '#fff7ed', // Orange-50
            'text' => '#292524', // Stone-800
            'text_muted' => '#57534e', // Stone-600
            'accent' => '#f97316', // Orange-500
        ],
        'fonts' => [
            'heading' => 'Abril Fatface',
            'body' => 'Josefin Sans',
        ],
        'hero_style' => 'vibrant',
    ],
    'mono_dark' => [
        'name' => 'Industrial Chic',
        'colors' => [
            'primary' => '#171717', // Neutral-900
            'secondary' => '#e5e5e5', // Neutral-200
            'background' => '#ffffff', // White
            'surface' => '#f5f5f5', // Neutral-100
            'text' => '#171717', // Neutral-900
            'text_muted' => '#525252', // Neutral-600
            'accent' => '#404040', // Neutral-700
        ],
        'fonts' => [
            'heading' => 'Space Mono',
            'body' => 'DM Mono',
        ],
        'hero_style' => 'industrial',
    ],
];
