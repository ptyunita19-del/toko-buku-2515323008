<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Mengisi tabel publishers dengan data contoh.
     */
    public function run(): void
    {
        Publisher::create([
            'name' => 'Penerbit Informatika',
            'city' => 'Bandung',
        ]);

        Publisher::create([
            'name' => 'Elex Media Komputindo',
            'city' => 'Jakarta',
        ]);

        Publisher::create([
            'name' => 'Deepublish',
            'city' => 'Yogyakarta',
        ]);
    }
}
