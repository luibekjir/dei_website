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
            'Sate Ayam Madura', 'Sate Kambing', 'Nasi Goreng Spesial', 'Mie Goreng Seafood',
            'Rendang Daging', 'Ayam Bakar Taliwang', 'Soto Ayam Lamongan', 'Soto Betawi',
            'Gado-Gado Boplo', 'Ketoprak Jakarta', 'Nasi Uduk Ayam Goreng', 'Nasi Padang Komplit',
            'Bakso Urat Spesial', 'Mie Ayam Jamur', 'Ayam Penyet Sambal Ijo', 'Ikan Bakar Gurame',
            'Cumi Saus Padang', 'Udang Asam Manis', 'Sayur Asem', 'Sop Iga Sapi',
            'Pempek Kapal Selam', 'Tekwan Palembang', 'Rawon Daging Sapi', 'Tongseng Kambing',
            'Nasi Liwet Solo', 'Gudeg Komplit', 'Sate Lilit Bali', 'Ayam Betutu',
            'Es Teh Manis', 'Es Jeruk Nipis', 'Es Campur', 'Es Cendol Dawet'
        ];

        foreach ($restaurants as $restaurant) {
            // Create a general Menu section for the restaurant
            $menu = \App\Models\Menu::firstOrCreate([
                'restaurant_id' => $restaurant->id,
                'name' => 'Main Menu'
            ]);

            // Generate 8-12 menus items per restaurant
            $menuCount = rand(8, 12);
            
            // Pilih beberapa menu secara acak dari array $realMenus
            $selectedMenus = $faker->randomElements($realMenus, $menuCount);

            foreach ($selectedMenus as $menuName) {
                \App\Models\MenuItem::create([
                    'restaurant_id' => $restaurant->id,
                    'menu_id' => $menu->id,
                    'name' => $menuName,
                    'description' => $faker->sentence(6),
                    'price' => $faker->randomElement([15, 20, 25, 30, 45, 50, 60, 75, 85, 100]) * 1000,
                    'rating' => $faker->randomFloat(1, 3.8, 4.9),
                    'image' => 'menus/food' . rand(1, 5) . '.jpg',
                    'available' => true,
                    'spice_level' => $faker->numberBetween(0, 5),
                    'is_halal' => $faker->boolean(90),
                ]);
            }
        }
    }
}
