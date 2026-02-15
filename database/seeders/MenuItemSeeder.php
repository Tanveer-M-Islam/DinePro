<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $starters = Category::where('name', 'Starters')->first();
        $mains = Category::where('name', 'Main Courses')->first();
        $desserts = Category::where('name', 'Desserts')->first();
        $drinks = Category::where('name', 'Drinks')->first();

        if ($starters) {
            MenuItem::create([
                'category_id' => $starters->id,
                'name' => 'Bruschetta',
                'description' => 'Grilled bread rubbed with garlic and topped with olive oil and salt.',
                'price' => 8.50,
                'is_featured' => true,
            ]);
            MenuItem::create([
                'category_id' => $starters->id,
                'name' => 'Calamari',
                'description' => 'Fried squid rings served with marinara sauce.',
                'price' => 12.00,
            ]);
        }

        if ($mains) {
            MenuItem::create([
                'category_id' => $mains->id,
                'name' => 'Grilled Salmon',
                'description' => 'Fresh Atlantic salmon grilled to perfection.',
                'price' => 24.00,
                'is_featured' => true,
            ]);
            MenuItem::create([
                'category_id' => $mains->id,
                'name' => 'Steak Frites',
                'description' => 'Juicy steak served with crispy french fries.',
                'price' => 28.00,
            ]);
        }

        if ($desserts) {
            MenuItem::create([
                'category_id' => $desserts->id,
                'name' => 'Tiramisu',
                'description' => 'Classic Italian dessert made with ladyfingers and mascarpone.',
                'price' => 9.00,
            ]);
        }

        if ($drinks) {
            MenuItem::create([
                'category_id' => $drinks->id,
                'name' => 'Lemonade',
                'description' => 'Freshly squeezed lemonade.',
                'price' => 4.00,
            ]);
        }
    }
}
