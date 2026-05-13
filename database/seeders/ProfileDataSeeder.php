<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Address;

class ProfileDataSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@example.com')->first();
        if (!$user) return;

        // Clear existing profile data for clean seed
        $user->addresses()->delete();
        $user->orders()->delete();

        // Create some addresses
        Address::create([
            'addressable_id' => $user->id,
            'addressable_type' => User::class,
            'label' => 'Home',
            'address_line' => 'Dharmahusada Permai VIII/152',
            'city' => 'Surabaya',
            'state' => 'Jawa Timur',
            'postal_code' => '60115',
            'is_primary' => true,
        ]);

        Address::create([
            'addressable_id' => $user->id,
            'addressable_type' => User::class,
            'label' => 'Work',
            'address_line' => 'Jl. Gatot Subroto Kav. 52-53',
            'city' => 'Jakarta Selatan',
            'state' => 'DKI Jakarta',
            'postal_code' => '12710',
            'is_primary' => false,
        ]);

        // Create some historical orders
        $restaurants = Restaurant::take(3)->get();
        if ($restaurants->count() > 0) {
            foreach ($restaurants as $index => $restaurant) {
                Order::create([
                    'user_id' => $user->id,
                    'restaurant_id' => $restaurant->id,
                    'items' => [
                        ['name' => 'Sample Dish ' . ($index + 1), 'price' => 25000, 'quantity' => 2]
                    ],
                    'subtotal' => 50000,
                    'taxes' => 5000,
                    'delivery_fee' => 15000,
                    'total' => 70000,
                    'status' => 'completed',
                    'type' => 'delivery',
                    'created_at' => now()->subDays($index * 2),
                ]);
            }
        }
    }
}
