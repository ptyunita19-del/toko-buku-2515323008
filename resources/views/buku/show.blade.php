@extends('layouts.app')

@section('title', 'Detail Buku — BookStore')

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                @php
                    $sampul = [
                        'Belajar PHP untuk Pemula' => 'php-pemula.jpg',
                        'Laravel Dasar' => 'laravel-dasar.jpg',
                        'Dasar-Dasar Basis Data' => 'basis-data.jpg',
                        'MySQL untuk Pemula' => 'mysql-pemula.jpg',
                        'Jaringan Komputer Dasar' => 'jaringan-dasar.jpg',
                        'Administrasi Jaringan' => 'administrasi-jaringan.jpg',
                    ];
                @endphp

                <img
                    src="{{ asset('images/' . ($sampul[$buku->title] ?? 'sampul.jpg')) }}"
                    class="card-img-top"
                    alt="Sampul {{ $buku->title }}"
                >
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm h-100">
                <div class="card-body p-4">
                    <h1 class="mb-4">{{ $buku->title }}</h1>

                    <p>
                        <strong>Penulis:</strong>
                        {{ $buku->author_name ?? 'Tidak diketahui' }}
                    </p>

                    <p>
                        <strong>Kategori:</strong>
                        {{ $buku->category->name ?? 'Tanpa Kategori' }}
                    </p>

                    <p>
                        <strong>Tahun Terbit:</strong>
                        {{ $buku->year ?? 'Tidak diketahui' }}
                    </p>

                    <h3 class="mb-4">
                        Rp {{ number_format($buku->price, 0, ',', '.') }}
                    </h3>

                    <a href="{{ route('buku.index') }}"
                       class="btn btn-outline-secondary">
                        &larr; Kembali ke Daftar Buku
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
