<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Province;
use App\Models\City;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $province = Province::where('name', 'Jawa Timur')->first();
        $city = City::where('name', 'Surabaya')->first();

        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'province_id' => $province?->id,
                'city_id' => $city?->id,
                'profile_completed' => true,
            ]
        );
    }
}
