<?php

namespace App\Http\Controllers;

class BookController extends Controller
{
    private $daftarBuku = [
        [
    'judul' => 'Pemrograman Web',
    'penulis' => 'Devi',
    'tahun' => 2025,
    'harga' => 85000
        ],
        [
    'judul' => 'Basis Data',
    'penulis' => 'Putu Yunita',
    'tahun' => 2026,
    'harga' => 72000
        ],
        [
    'judul' => 'Analisis Sistem',
    'penulis' => 'Repan',
    'tahun' => 2024,
    'harga' => 95000
        ],
    ];

    public function index()
    {
        return view('buku.index', [
            'daftarBuku' => $this->daftarBuku
        ]);
    }

    public function show($id)
    {
        $buku = $this->daftarBuku[$id] ?? null;

        return view('buku.show', [
            'buku' => $buku,
            'id' => $id
        ]);
    }
}