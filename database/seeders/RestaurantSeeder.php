<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Category;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = [
            [
                'name' => 'Mizumi Atelier',
                'category_id' => Category::where('name', 'Japanese')->first()->id,
                'description' => 'Elegant Japanese dining with curated omakase experience.',
                'image' => null,
                'address' => 'San Francisco, CA',
                'rating' => 4.9,
            ],
            [
                'name' => 'Pasta & Petals',
                'category_id' => Category::where('name', 'Italian')->first()->id,
                'description' => 'Fresh handmade pasta with floral-inspired plating.',
                'image' => null,
                'address' => 'San Francisco, CA',
                'rating' => 4.7,
            ],
            [
                'name' => 'Flora Kitchen',
                'category_id' => Category::where('name', 'Vegan')->first()->id,
                'description' => 'Plant-based dining with premium seasonal ingredients.',
                'image' => null,
                'address' => 'San Francisco, CA',
                'rating' => 4.8,
            ],
        ];

        foreach ($restaurants as $restaurant) {
            Restaurant::create($restaurant);
        }
    }
}
