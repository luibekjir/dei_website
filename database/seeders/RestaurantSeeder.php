<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Category;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        $categories = Category::all();
        
        if ($categories->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 20; $i++) {
            Restaurant::create([
                'name' => $faker->company . ' Restaurant',
                'category_id' => $categories->random()->id,
                'description' => $faker->sentence(10),
                'image' => null,
                'address' => $faker->address,
                'rating' => $faker->randomFloat(1, 3, 5),
                'latitude' => $faker->latitude(-7.3, -7.2), // Surabaya lat range
                'longitude' => $faker->longitude(112.6, 112.8), // Surabaya long range
                'facilities' => [
                    'Accessibility' => $faker->randomElements(['Wheelchair accessible entrance', 'Wheelchair accessible seating'], $faker->numberBetween(1, 2)),
                    'Amenities' => $faker->randomElements(['Wifi', 'AC', 'Toilet', 'Outdoor seating', 'Indoor seating'], $faker->numberBetween(2, 4)),
                    'Parking' => $faker->randomElements(['Free street parking', 'Paid parking lot', 'Free parking lot'], 1)
                ],
                'user_id' => null,
            ]);
        }
    }
}
