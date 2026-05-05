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
                'address' => 'GWalk Citraland, Surabaya',
                'rating' => 4.9,
                'latitude' => -7.2843,
                'longitude' => 112.6433,
            ],
            [
                'name' => 'Pasta & Petals',
                'category_id' => Category::where('name', 'Italian')->first()->id,
                'description' => 'Fresh handmade pasta with floral-inspired plating.',
                'image' => null,
                'address' => 'Citraland, Surabaya',
                'rating' => 4.7,
                'latitude' => -7.2855,
                'longitude' => 112.6420,
            ],
            [
                'name' => 'Flora Kitchen',
                'category_id' => Category::where('name', 'Vegan')->first()->id,
                'description' => 'Plant-based dining with premium seasonal ingredients.',
                'image' => null,
                'address' => 'UC Town, Citraland, Surabaya',
                'rating' => 4.8,
                'latitude' => -7.2862,
                'longitude' => 112.6415,
            ],
            [
                'name' => 'Citra Bakery',
                'category_id' => Category::where('name', 'Bakery')->first()->id,
                'description' => 'Famous for their fresh breads and traditional Indonesian snacks.',
                'image' => null,
                'address' => 'Fresh Market Citraland, Surabaya',
                'rating' => 4.6,
                'latitude' => -7.2891,
                'longitude' => 112.6468,
            ],
            [
                'name' => 'Bistro de Citra',
                'category_id' => Category::where('name', 'French')->first()->id,
                'description' => 'Charming neighborhood spot serving classic French comfort food.',
                'image' => null,
                'address' => 'Bukit Telaga Golf, Citraland, Surabaya',
                'rating' => 4.5,
                'latitude' => -7.2950,
                'longitude' => 112.6350,
            ],
            [
                'name' => 'Sushi Zen Surabaya',
                'category_id' => Category::where('name', 'Japanese')->first()->id,
                'description' => 'Minimalist decor with a focus on high-quality seasonal fish.',
                'image' => null,
                'address' => 'International Village, Surabaya',
                'rating' => 4.8,
                'latitude' => -7.2800,
                'longitude' => 112.6450,
            ],
            [
                'name' => 'Toscana Grill Citraland',
                'category_id' => Category::where('name', 'Italian')->first()->id,
                'description' => 'Hearty Tuscan dishes and a great selection of regional wines.',
                'image' => null,
                'address' => 'Ruko North Junction, Surabaya',
                'rating' => 4.4,
                'latitude' => -7.2780,
                'longitude' => 112.6400,
            ],
            [
                'name' => 'Green Leaf Surabaya',
                'category_id' => Category::where('name', 'Vegan')->first()->id,
                'description' => 'Eco-friendly cafe with organic salads and fresh cold-pressed juices.',
                'image' => null,
                'address' => 'North West Lake, Surabaya',
                'rating' => 4.3,
                'latitude' => -7.2750,
                'longitude' => 112.6350,
            ],
        ];

        foreach ($restaurants as $restaurant) {
            Restaurant::create($restaurant);
        }
    }
}
