<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        Reservation::create([
            'name' => 'John Doe',
            'phone' => '555-0101',
            'reservation_date' => now()->addDays(2)->setHour(19)->setMinute(0),
            'guests' => 2,
            'status' => 'confirmed',
        ]);

        Reservation::create([
            'name' => 'Jane Smith',
            'phone' => '555-0102',
            'reservation_date' => now()->addDays(3)->setHour(20)->setMinute(30),
            'guests' => 4,
            'status' => 'pending',
        ]);
    }
}
