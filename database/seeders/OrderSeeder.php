<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\MenuItem;
use App\Models\Address;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $restaurants = Restaurant::all();
        $faker = \Faker\Factory::create('id_ID');

        if ($users->isEmpty() || $restaurants->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            // Each user has 1 to 5 orders
            $orderCount = rand(1, 5);
            for ($i = 0; $i < $orderCount; $i++) {
                $restaurant = $restaurants->random();
                $menus = MenuItem::where('restaurant_id', $restaurant->id)->inRandomOrder()->take(rand(1, 3))->get();
                
                if ($menus->isEmpty()) continue;

                $items = [];
                $subtotal = 0;
                foreach ($menus as $menu) {
                    $qty = rand(1, 3);
                    $price = $menu->price;
                    $items[] = [
                        'id' => $menu->id,
                        'name' => $menu->name,
                        'price' => $price,
                        'quantity' => $qty,
                    ];
                    $subtotal += ($price * $qty);
                }

                $deliveryFee = rand(10, 25) * 1000;
                $serviceCharge = 2000;
                $taxes = $subtotal * 0.11;
                $total = $subtotal + $taxes + $deliveryFee + $serviceCharge;

                Order::create([
                    'user_id' => $user->id,
                    'restaurant_id' => $restaurant->id,
                    'items' => json_encode($items),
                    'subtotal' => $subtotal,
                    'taxes' => $taxes,
                    'delivery_fee' => $deliveryFee,
                    'service_charge' => $serviceCharge,
                    'total' => $total,
                    'status' => $faker->randomElement(['pending', 'confirmed', 'preparing', 'delivering', 'delivered', 'cancelled']),
                    'created_at' => Carbon::now()->subDays(rand(1, 30)),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
