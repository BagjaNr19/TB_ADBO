<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Sarapan', 'slug' => 'sarapan', 'description' => 'Resep untuk memulai hari'],
            ['name' => 'Makan Siang', 'slug' => 'makan-siang', 'description' => 'Menu makan siang yang lezat'],
            ['name' => 'Makan Malam', 'slug' => 'makan-malam', 'description' => 'Hidangan spesial untuk makan malam'],
            ['name' => 'Dessert', 'slug' => 'dessert', 'description' => 'Makanan penutup yang manis'],
            ['name' => 'Minuman', 'slug' => 'minuman', 'description' => 'Aneka minuman segar'],
            ['name' => 'Tradisional', 'slug' => 'tradisional', 'description' => 'Masakan khas nusantara'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
