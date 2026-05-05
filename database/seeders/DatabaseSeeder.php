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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            CategorySeeder::class,
            RestaurantSeeder::class,
            MenuSeeder::class,
        ]);
    }
}