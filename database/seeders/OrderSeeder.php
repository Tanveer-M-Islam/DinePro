<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $order = Order::create([
            'customer_name' => 'Alice Johnson',
            'phone' => '555-0103',
            'total_amount' => 32.50,
            'status' => 'completed',
            'payment_status' => 'paid',
        ]);

        $item1 = MenuItem::where('name', 'Bruschetta')->first();
        $item2 = MenuItem::where('name', 'Grilled Salmon')->first();

        if ($item1 && $item2) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $item1->id,
                'quantity' => 1,
                'price' => $item1->price,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $item2->id,
                'quantity' => 1,
                'price' => $item2->price,
            ]);
        }
    }
}
