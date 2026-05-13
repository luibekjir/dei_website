<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\City;
use App\Models\District;

class IndonesianRegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            'DKI Jakarta' => [
                'Kota Jakarta Selatan' => ['Kebayoran Baru', 'Kebayoran Lama', 'Tebet', 'Setiabudi'],
                'Kota Jakarta Pusat' => ['Gambir', 'Menteng', 'Tanah Abang'],
            ],
            'Jawa Timur' => [
                'Kota Surabaya' => ['Gubeng', 'Wonokromo', 'Tegalsari'],
                'Kota Malang' => ['Lowokwaru', 'Klojen', 'Blimbing'],
            ],
            'Jawa Barat' => [
                'Kota Bandung' => ['Coblong', 'Sumur Bandung', 'Lengkong'],
                'Kota Bogor' => ['Bogor Tengah', 'Bogor Timur'],
            ],
            'Sumatera Barat' => [
                'Kota Padang' => ['Padang Barat', 'Padang Timur', 'Koto Tangah'],
            ],
            'Sulawesi Selatan' => [
                'Kota Makassar' => ['Ujung Pandang', 'Panakkukang', 'Tamalate'],
            ],
            'Bali' => [
                'Kota Denpasar' => ['Denpasar Selatan', 'Denpasar Timur'],
                'Kabupaten Badung' => ['Kuta', 'Kuta Utara', 'Mengwi'],
            ],
        ];

        foreach ($regions as $provinceName => $cities) {
            $province = Province::create(['name' => $provinceName]);
            foreach ($cities as $cityName => $districts) {
                $city = City::create([
                    'province_id' => $province->id,
                    'name' => $cityName,
                    'type' => str_contains($cityName, 'Kabupaten') ? 'Kabupaten' : 'Kota',
                ]);
                foreach ($districts as $districtName) {
                    District::create([
                        'city_id' => $city->id,
                        'name' => $districtName,
                    ]);
                }
            }
        }
    }
}
