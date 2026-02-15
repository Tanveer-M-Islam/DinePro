<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        WebsiteSetting::create([
            'restaurant_name' => 'DinePro',
            'primary_color' => '#f97316',
            'hero_title' => 'Taste the Difference',
            'hero_subtitle' => 'Experience culinary excellence in every bite.',
            'about_text' => 'We are dedicated to providing the best dining experience with fresh ingredients and exceptional service.',
            'contact_email' => 'info@dinepro.com',
            'phone' => '+1 234 567 890',
            'address' => '123 Restaurant St, Food City, FC 12345',
        ]);
    }
}
