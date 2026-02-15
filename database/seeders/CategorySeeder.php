<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Starters', 'description' => 'Appetizers to start your meal'],
            ['name' => 'Main Courses', 'description' => 'Hearty main dishes'],
            ['name' => 'Desserts', 'description' => 'Sweet treats'],
            ['name' => 'Drinks', 'description' => 'Refreshing beverages'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
