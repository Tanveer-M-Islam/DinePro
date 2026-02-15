<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            WebsiteSettingSeeder::class,
            CategorySeeder::class,
            MenuItemSeeder::class,
            ReservationSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
