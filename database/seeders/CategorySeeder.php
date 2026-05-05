<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Japanese'],
            ['name' => 'Italian'],
            ['name' => 'Vegan'],
            ['name' => 'Bakery'],
            ['name' => 'French'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
