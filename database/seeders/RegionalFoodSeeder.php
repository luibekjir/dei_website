<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\MenuItem;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Category;
use App\Models\Menu;

class RegionalFoodSeeder extends Seeder
{
    public function run(): void
    {
        MenuItem::truncate();
        Menu::truncate();
        Restaurant::truncate();

        $foods = [
            [
                'name' => 'Rawon Setan',
                'description' => 'Black beef soup with kluwek nuts, served with salted egg and bean sprouts.',
                'origin_province' => 'Jawa Timur',
                'origin_city' => 'Kota Surabaya',
                'restaurant' => 'Warung Rawon Asli',
                'price' => 45000,
                'spice_level' => 3,
                'is_halal' => true,
                'image' => 'rawon.jpg'
            ],
            [
                'name' => 'Rendang Daging',
                'description' => 'Slow-cooked beef in coconut milk and spices until tender and caramelized.',
                'origin_province' => 'Sumatera Barat',
                'origin_city' => 'Kota Padang',
                'restaurant' => 'Rumah Makan Padang Raya',
                'price' => 55000,
                'spice_level' => 4,
                'is_halal' => true,
                'image' => 'rendang.jpg'
            ],
            [
                'name' => 'Gudeg Jogja',
                'description' => 'Sweet young jackfruit stew with krecek (cattle skin) and opor chicken.',
                'origin_province' => 'DKI Jakarta',
                'origin_city' => 'Kota Jakarta Selatan',
                'restaurant' => 'Gudeg Ibu Hj. Slamet',
                'price' => 35000,
                'spice_level' => 1,
                'is_halal' => true,
                'image' => 'gudeg.jpg'
            ],
            [
                'name' => 'Pempek Kapal Selam',
                'description' => 'Savory fish cake filled with egg, served with spicy vinegar sauce (cuko).',
                'origin_province' => 'DKI Jakarta',
                'origin_city' => 'Kota Jakarta Pusat',
                'restaurant' => 'Pempek Palembang 161',
                'price' => 25000,
                'spice_level' => 3,
                'is_halal' => true,
                'image' => 'pempek.jpg'
            ],
            [
                'name' => 'Coto Makassar',
                'description' => 'Rich beef innards soup with peanuts and various spices.',
                'origin_province' => 'Sulawesi Selatan',
                'origin_city' => 'Kota Makassar',
                'restaurant' => 'Coto Nusantara',
                'price' => 40000,
                'spice_level' => 2,
                'is_halal' => true,
                'image' => 'coto.jpg'
            ],
            [
                'name' => 'Ayam Betutu',
                'description' => 'Spiced roasted chicken from Bali, highly seasoned and aromatic.',
                'origin_province' => 'Bali',
                'origin_city' => 'Kabupaten Badung',
                'restaurant' => 'Betutu Gilimanuk',
                'price' => 85000,
                'spice_level' => 5,
                'is_halal' => true,
                'image' => 'betutu.jpg'
            ],
        ];

        // Physical Location: Surabaya (near UC)
        $surabayaProvince = Province::where('name', 'Jawa Timur')->first();
        $surabayaCity = City::where('name', 'Kota Surabaya')->first();
        $surabayaDistrict = District::where('city_id', $surabayaCity->id)->first();

        $category = Category::firstOrCreate(['name' => 'Indonesian Authentic']);

        foreach ($foods as $food) {
            $originProvince = Province::where('name', $food['origin_province'])->first();
            $originCity = City::where('name', $food['origin_city'])->first();

            $restaurant = Restaurant::firstOrCreate(
                ['name' => $food['restaurant']],
                [
                    'category_id' => $category->id,
                    'description' => 'Authentic ' . $food['name'] . ' specialist.',
                    'address' => 'Jl. CitraLand CBD Boulevard, Surabaya (Near UC)',
                    'rating' => rand(40, 50) / 10,
                    'latitude' => -7.285 + (rand(-50, 50) / 10000),
                    'longitude' => 112.631 + (rand(-50, 50) / 10000),
                    'province_id' => $surabayaProvince->id,
                    'city_id' => $surabayaCity->id,
                    'district_id' => $surabayaDistrict->id,
                    'has_delivery' => true,
                    'supports_pickup' => true,
                    'delivery_status' => 'available',
                ]
            );

            $menu = Menu::firstOrCreate(
                ['restaurant_id' => $restaurant->id, 'name' => 'Main Signature']
            );

            MenuItem::create([
                'restaurant_id' => $restaurant->id,
                'menu_id' => $menu->id,
                'name' => $food['name'],
                'description' => $food['description'],
                'price' => $food['price'],
                'rating' => rand(40, 50) / 10,
                'available' => true,
                'province_id' => $originProvince->id,
                'city_id' => $originCity->id,
                'spice_level' => $food['spice_level'],
                'is_halal' => $food['is_halal'],
                'image' => $food['image'],
            ]);
        }
    }
}
