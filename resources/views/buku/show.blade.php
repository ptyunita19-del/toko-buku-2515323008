@extends('layouts.app')

@section('title', ($buku->title ?? 'Buku tidak ditemukan') . ' — BookStore')

@section('content')

<style>
    /* Sampul pada halaman detail buku */
    .gambar-detail-buku {
        width: 100%;
        max-height: 500px;
        object-fit: contain;
        object-position: center;
    }

    /* Sampul pada bagian Buku Serupa */
    .kartu-buku > img.card-img-top.gambar-buku-serupa {
        display: block;
        width: 100%;
        height: 350px;
        object-fit: contain;
        object-position: center;
        background-color: #ffffff;
        padding: 12px;
        border-radius: 6px 6px 0 0;
    }

    /* Merapikan kartu Buku Serupa */
    .kartu-buku {
        height: 100%;
    }

    /* Penyesuaian tampilan HP */
    @media (max-width: 767px) {
        .kartu-buku > img.card-img-top.gambar-buku-serupa {
            height: 380px;
        }
    }
</style>

@if ($buku)

    {{-- Detail Buku --}}
    <div class="row mb-5">

        {{-- Sampul Buku --}}
        <div class="col-md-4 mb-3">
            <img src="{{ $buku->cover_url }}"
                 class="img-fluid rounded gambar-detail-buku"
                 alt="Sampul {{ $buku->title }}">
        </div>

        {{-- Informasi Buku --}}
        <div class="col-md-8">

            {{-- Kategori --}}
            <span class="badge bg-secondary mb-2">
                {{ $buku->category?->name ?? 'Tanpa kategori' }}
            </span>

            {{-- Judul --}}
            <h1>{{ $buku->title }}</h1>

            {{-- Penulis --}}
            <p class="text-muted mb-1">
                Penulis: {{ $buku->author_name }}
            </p>

            {{-- Penulis Terdaftar --}}
            @if ($buku->author)
                <p class="text-muted mb-1">
                    Penulis Terdaftar: {{ $buku->author->name }}
                </p>
            @endif

            {{-- Penerbit --}}
            <p class="text-muted mb-1">
                Penerbit:
                {{ $buku->publisher?->name ?? 'Belum diisi' }}
            </p>

            {{-- Tahun Terbit --}}
            @if ($buku->published_year)
                <p class="text-muted mb-1">
                    Tahun Terbit: {{ $buku->published_year }}
                </p>
            @endif

            {{-- Harga --}}
            <p class="harga-buku fs-4">
                Rp{{ number_format($buku->price, 0, ',', '.') }}
            </p>

            {{-- Informasi Stok --}}
            <div class="mb-3">

                @if ($buku->stock == 0)
                    <span class="badge bg-danger">
                        Stok habis
                    </span>
                @else
                    <span class="badge bg-success">
                        Stok tersedia: {{ $buku->stock }}
                    </span>
                @endif

            </div>

            {{-- Tombol Aksi --}}
            <a href="{{ route('buku.index') }}"
               class="btn btn-outline-secondary">
                &larr; Kembali ke daftar buku
            </a>

            <a href="{{ route('buku.edit', $buku->id) }}"
               class="btn btn-outline-primary">
                Ubah
            </a>

            <form action="{{ route('buku.destroy', $buku->id) }}"
                  method="POST"
                  class="d-inline"
                  onsubmit="return confirm('Yakin menghapus buku ini?')">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-outline-danger">
                    Hapus
                </button>
            </form>

        </div>
    </div>

    {{-- Rekomendasi Buku Serupa --}}
    @if ($bukuSerupa->isNotEmpty())

        <hr>

        <h3 class="mb-4">Buku Serupa</h3>

        <div class="row row-cols-1 row-cols-md-4 g-4">

            @foreach ($bukuSerupa as $bukuLain)

                <div class="col">

                    <div class="card h-100 kartu-buku">

                        {{-- Gambar Buku Serupa --}}
                        <img src="{{ $bukuLain->cover_url }}"
                             class="card-img-top gambar-buku-serupa"
                             alt="Sampul {{ $bukuLain->title }}">

                        <div class="card-body d-flex flex-column">

                            {{-- Judul Buku --}}
                            <h5 class="card-title">
                                {{ $bukuLain->title }}
                            </h5>

                            {{-- Penulis --}}
                            <p class="text-muted small mb-2">
                                {{ $bukuLain->author_name }}
                            </p>

                            {{-- Harga --}}
                            <p class="harga-buku">
                                Rp{{ number_format($bukuLain->price, 0, ',', '.') }}
                            </p>

                            {{-- Stok --}}
                            @if ($bukuLain->stock == 0)

                                <span class="badge bg-danger align-self-start mb-3">
                                    Stok habis
                                </span>

                            @else

                                <span class="badge bg-success align-self-start mb-3">
                                    Stok: {{ $bukuLain->stock }}
                                </span>

                            @endif

                            {{-- Tombol Detail --}}
                            <a href="{{ route('buku.show', $bukuLain->id) }}"
                               class="btn btn-primary mt-auto">
                                Lihat Detail
                            </a>

                        </div>
                    </div>
                </div>

            @endforeach

        </div>

    @endif

@else

    {{-- Buku Tidak Ditemukan --}}
    <div class="alert alert-warning">

        <h1 class="h4">Buku tidak ditemukan</h1>

        <p class="mb-0">
            Tidak ada buku dengan id {{ $id }}.
        </p>

    </div>

    <a href="{{ route('buku.index') }}"
       class="btn btn-outline-secondary mt-3">
        &larr; Kembali ke daftar buku
    </a>

@endif

@endsection
