<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        for ($i = 0; $i < 100; $i++) {
            $total = 0;
            $order = Order::factory()
                ->for($users->random(), 'customer')
                ->create();

            for ($j = 0; $j < 3; $j++) {
                $product = $products->random();

                $item = OrderItem::factory()
                    ->for($order)
                    ->for($product)
                    ->create();

                $total += $product->price * $item->quantity;
            }

            $order->update(['total' => $total]);
        }
    }
}
