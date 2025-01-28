<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data kategori
        $categories = [
            ['name' => 'Olahraga'],
            ['name' => 'Alat Musik'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
