<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::insert([
            [
                'title' => 'Belajar PHP untuk Pemula',
                'author' => 'Andi',
                'year' => 2025,
                'price' => 75000,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Laravel Dasar',
                'author' => 'Budi',
                'year' => 2026,
                'price' => 85000,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Dasar-Dasar Basis Data',
                'author' => 'Citra',
                'year' => 2025,
                'price' => 70000,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MySQL untuk Pemula',
                'author' => 'Dewi',
                'year' => 2026,
                'price' => 80000,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jaringan Komputer Dasar',
                'author' => 'Eka',
                'year' => 2025,
                'price' => 90000,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Administrasi Jaringan',
                'author' => 'Fajar',
                'year' => 2026,
                'price' => 95000,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
