@extends('layouts.app')

@section('title', 'Daftar Buku — BookStore')

@section('content')
    <div class="container py-4">

        {{-- Judul halaman --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold mb-1">Daftar Buku</h1>
                <p class="text-muted mb-0">
                    Temukan buku favoritmu di BookStore.
                </p>
            </div>
        </div>

        {{-- Pemetaan sampul berdasarkan judul buku --}}
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

        {{-- Pesan jika belum ada buku --}}
        @if ($daftarBuku->isEmpty())
            <div class="alert alert-info">
                Belum ada buku yang tersedia.
            </div>
        @else

            {{-- Daftar buku --}}
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                @foreach ($daftarBuku as $buku)
                    <div class="col">
                        <div class="card h-100 shadow-sm kartu-buku">

                            {{-- Sampul sesuai judul buku --}}
                            <img
                                src="{{ asset('images/' . ($sampul[$buku->title] ?? 'sampul.jpg')) }}"
                                class="card-img-top sampul-buku"
                                alt="Sampul {{ $buku->title }}"
                                onerror="this.onerror=null; this.src='{{ asset('images/sampul.jpg') }}'"
                            >

                            <div class="card-body d-flex flex-column">

                                {{-- Kategori --}}
                                @if ($buku->category)
                                    <span class="badge bg-primary align-self-start mb-2">
                                        {{ $buku->category->name }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary align-self-start mb-2">
                                        Tanpa Kategori
                                    </span>
                                @endif

                                {{-- Judul buku --}}
                                <h5 class="card-title fw-bold">
                                    {{ $buku->title }}
                                </h5>

                                {{-- Nama penulis --}}
                                <p class="text-muted mb-2">
                                    Penulis: {{ $buku->author_name ?? 'Tidak diketahui' }}
                                </p>

                                {{-- Tahun terbit --}}
                                @if ($buku->year)
                                    <p class="text-muted mb-2">
                                        Tahun terbit: {{ $buku->year }}
                                    </p>
                                @endif

                                {{-- Harga buku --}}
                                <h5 class="text-success fw-bold mt-auto mb-3">
                                    Rp {{ number_format($buku->price, 0, ',', '.') }}
                                </h5>

                                {{-- Tombol detail --}}
                                <a
                                    href="{{ route('buku.show', $buku->id) }}"
                                    class="btn btn-primary w-100"
                                >
                                    Lihat Detail
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @endif

    </div>
@endsection
