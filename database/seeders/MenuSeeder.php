<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Restaurant;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = \App\Models\Restaurant::all();
        $faker = \Faker\Factory::create('id_ID');

        if ($restaurants->isEmpty()) {
            return;
        }

        foreach ($restaurants as $restaurant) {
            // Create a general Menu section for the restaurant
            $menu = \App\Models\Menu::firstOrCreate([
                'restaurant_id' => $restaurant->id,
                'name' => 'Main Menu'
            ]);

            // Generate 8-12 menus items per restaurant
            $menuCount = rand(8, 12);
            for ($i = 0; $i < $menuCount; $i++) {
                \App\Models\MenuItem::create([
                    'restaurant_id' => $restaurant->id,
                    'menu_id' => $menu->id,
                    'name' => ucfirst($faker->words(rand(2, 4), true)),
                    'description' => $faker->sentence(),
                    'price' => $faker->randomFloat(0, 10, 100) * 1000, // Reasonable Rupiah pricing
                    'rating' => $faker->randomFloat(1, 3, 5),
                    'image' => null,
                    'available' => true,
                    'spice_level' => $faker->numberBetween(0, 5),
                    'is_halal' => $faker->boolean(80),
                ]);
            }
        }
    }
}
