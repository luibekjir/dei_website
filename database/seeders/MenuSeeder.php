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

        $realMenus = [
            'Sate Ayam Madura' => 'sate.png',
            'Nasi Goreng Spesial' => 'nasigoreng.png',
            'Soto Ayam Lamongan' => 'soto.png',
            'Es Teh Manis' => 'esteh.png',
            'Bakso Urat Spesial' => 'bakso.png',
            'Ayam Bakar Taliwang' => 'ayambakar.png'
        ];

        foreach ($restaurants as $restaurant) {
            // Create a general Menu section for the restaurant
            $menu = \App\Models\Menu::firstOrCreate([
                'restaurant_id' => $restaurant->id,
                'name' => 'Main Menu'
            ]);

            // Generate 4-6 menus items per restaurant
            $menuCount = rand(4, 6);
            
            // Pilih beberapa menu secara acak dari array $realMenus
            $selectedMenuNames = $faker->randomElements(array_keys($realMenus), $menuCount);

            foreach ($selectedMenuNames as $menuName) {
                \App\Models\MenuItem::create([
                    'restaurant_id' => $restaurant->id,
                    'menu_id' => $menu->id,
                    'name' => $menuName,
                    'description' => $faker->sentence(6),
                    'price' => $faker->randomElement([15, 20, 25, 30, 45, 50, 60]) * 1000,
                    'rating' => $faker->randomFloat(1, 4.0, 4.9),
                    'image' => $realMenus[$menuName],
                    'available' => true,
                    'spice_level' => $faker->numberBetween(0, 5),
                    'is_halal' => true,
                ]);
            }
        }
    }
}
