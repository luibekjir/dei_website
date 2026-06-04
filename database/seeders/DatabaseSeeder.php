<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\RestaurantSeeder;
use Database\Seeders\MenuSeeder;    

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call all seeders
        $this->call([
            IndonesianRegionSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
            RestaurantSeeder::class,
            MenuSeeder::class,
            RegionalFoodSeeder::class, // Run this after because it has specific data
            OrderSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}