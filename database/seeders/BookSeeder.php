<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $daftarBuku = [
            [
                'title' => 'Belajar PHP untuk Pemula',
                'author_name' => 'Andi',
                'year' => 2025,
                'price' => 75000,
                'category_id' => 1,
            ],
            [
                'title' => 'Laravel Dasar',
                'author_name' => 'Budi',
                'year' => 2026,
                'price' => 85000,
                'category_id' => 1,
            ],
            [
                'title' => 'Dasar-Dasar Basis Data',
                'author_name' => 'Citra',
                'year' => 2025,
                'price' => 70000,
                'category_id' => 2,
            ],
            [
                'title' => 'MySQL untuk Pemula',
                'author_name' => 'Dewi',
                'year' => 2026,
                'price' => 80000,
                'category_id' => 2,
            ],
            [
                'title' => 'Jaringan Komputer Dasar',
                'author_name' => 'Eka',
                'year' => 2025,
                'price' => 90000,
                'category_id' => 3,
            ],
            [
                'title' => 'Administrasi Jaringan',
                'author_name' => 'Fajar',
                'year' => 2026,
                'price' => 95000,
                'category_id' => 3,
            ],
        ];

        foreach ($daftarBuku as $buku) {
            Book::updateOrCreate(
                ['title' => $buku['title']],
                $buku
            );
        }
    }
}
