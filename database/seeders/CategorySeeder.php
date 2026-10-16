<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Pemrograman',
                'description' => 'Buku tentang pemrograman komputer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Basis Data',
                'description' => 'Buku tentang basis data',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jaringan Komputer',
                'description' => 'Buku tentang jaringan komputer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
