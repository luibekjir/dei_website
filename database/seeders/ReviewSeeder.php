<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Restaurant;
use Carbon\Carbon;

class ReviewSeeder extends Seeder
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
            // Each user leaves 2 to 6 reviews
            $reviewCount = rand(2, 6);
            for ($i = 0; $i < $reviewCount; $i++) {
                $restaurant = $restaurants->random();
                
                // Ensure no duplicate reviews from same user to same restaurant
                if (Review::where('user_id', $user->id)->where('restaurant_id', $restaurant->id)->exists()) {
                    continue;
                }

                Review::create([
                    'user_id' => $user->id,
                    'restaurant_id' => $restaurant->id,
                    'rating' => $faker->numberBetween(1, 5),
                    'comment' => $faker->sentence(),
                    'created_at' => Carbon::now()->subDays(rand(1, 30)),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
