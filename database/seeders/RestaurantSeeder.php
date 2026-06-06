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

        $realRestaurants = [
            ['name' => 'Sate Khas Senayan', 'description' => 'Menyajikan sate ayam bumbu kacang khas Jawa yang legendaris.'],
            ['name' => 'Warung Nasi Cumi Waspada', 'description' => 'Nasi cumi hitam khas Madura yang selalu ramai antrean tiap malam.'],
            ['name' => 'Bebek Sinjay', 'description' => 'Bebek goreng khas Bangkalan Madura dengan sambal pencit (mangga muda) yang super pedas.'],
            ['name' => 'Soto Lamongan Cak Har', 'description' => 'Soto ayam khas Lamongan dengan koya kerupuk udang yang gurih dan kental.'],
            ['name' => 'Gudeg Yu Djum', 'description' => 'Gudeg kering khas Yogyakarta yang legendaris sejak puluhan tahun.'],
            ['name' => 'Rawon Setan Mbak Endang', 'description' => 'Kuah rawon hitam pekat dengan potongan daging sapi empuk khas Jawa Timur.'],
            ['name' => 'Rendang Asli Minang', 'description' => 'Rumah makan Padang otentik yang terkenal dengan rendang daging yang dimasak 8 jam.'],
            ['name' => 'Sate Klathak Pak Pong', 'description' => 'Sate kambing khas Bantul yang ditusuk pakai jeruji besi, disajikan dengan kuah gulai.'],
            ['name' => 'Mie Aceh Titi Bobrok', 'description' => 'Mie Aceh kaya rempah dengan irisan daging sapi dan kepiting pilihan.'],
            ['name' => 'Ayam Betutu Men Tempeh', 'description' => 'Ayam betutu khas Gilimanuk Bali yang super pedas dan berempah kuat.'],
            ['name' => 'Sop Buntut Cut Meutia', 'description' => 'Sop buntut bening dan goreng yang dagingnya sangat empuk.'],
            ['name' => 'Pempek Candy', 'description' => 'Pempek asli Palembang dengan cuko yang asam, manis, dan pedas pas.'],
            ['name' => 'Bakso President', 'description' => 'Bakso Malang legendaris pinggir rel kereta api, menyajikan bakso bakar dan rebus.'],
            ['name' => 'Sate Lilit Jimbaran', 'description' => 'Menyajikan makanan laut dan sate lilit ikan tenggiri khas Bali.'],
            ['name' => 'Tengkleng Klewer Bu Edi', 'description' => 'Olahan tulang iga kambing berkuah encer kaya rempah khas Solo.'],
            ['name' => 'Nasi Liwet Bu Wongso Lemu', 'description' => 'Nasi liwet gurih khas Solo dengan suwiran ayam kampung dan areh santan.'],
            ['name' => 'Ikan Bakar Cianjur (IBC)', 'description' => 'Ikan gurame bakar dan goreng khas Sunda lengkap dengan sambal dan lalapan.'],
            ['name' => 'Nasi Uduk Kebon Kacang', 'description' => 'Nasi uduk legendaris Jakarta dibungkus daun pisang dengan ayam goreng kampung.'],
            ['name' => 'Serabi Notosuman', 'description' => 'Kue tradisional serabi Solo dengan varian original dan cokelat.'],
            ['name' => 'Seafood Ayu', 'description' => 'Menyajikan aneka hidangan laut segar khas nusantara dengan bumbu saus Padang.'],
        ];

        foreach ($realRestaurants as $resto) {
            Restaurant::create([
                'name' => $resto['name'],
                'category_id' => $categories->random()->id,
                'description' => $resto['description'],
                'image' => null,
                'address' => $faker->address,
                'rating' => $faker->randomFloat(1, 3.8, 4.9), // Rating lebih realistis tinggi
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
