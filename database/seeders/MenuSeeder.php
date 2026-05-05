<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Restaurant;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            // Mizumi Atelier
            [
                'restaurant_id' => Restaurant::where('name', 'Mizumi Atelier')->first()->id,
                'name' => 'Omakase Set',
                'description' => 'Chef-selected premium sushi tasting menu.',
                'price' => 48.00,
                'image' => null,
            ],
            [
                'restaurant_id' => Restaurant::where('name', 'Mizumi Atelier')->first()->id,
                'name' => 'Salmon Nigiri',
                'description' => 'Fresh salmon over seasoned rice.',
                'price' => 14.00,
                'image' => null,
            ],

            // Pasta & Petals
            [
                'restaurant_id' => Restaurant::where('name', 'Pasta & Petals')->first()->id,
                'name' => 'Truffle Alfredo',
                'description' => 'Creamy pasta with black truffle essence.',
                'price' => 28.00,
                'image' => null,
            ],
            [
                'restaurant_id' => Restaurant::where('name', 'Pasta & Petals')->first()->id,
                'name' => 'Classic Carbonara',
                'description' => 'Traditional Roman pasta with parmesan and egg.',
                'price' => 22.00,
                'image' => null,
            ],

            // Flora Kitchen
            [
                'restaurant_id' => Restaurant::where('name', 'Flora Kitchen')->first()->id,
                'name' => 'Green Bowl',
                'description' => 'Healthy bowl with avocado, quinoa, and greens.',
                'price' => 18.00,
                'image' => null,
            ],
            [
                'restaurant_id' => Restaurant::where('name', 'Flora Kitchen')->first()->id,
                'name' => 'Vegan Lasagna',
                'description' => 'Layered vegan lasagna with cashew cheese.',
                'price' => 24.00,
                'image' => null,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
