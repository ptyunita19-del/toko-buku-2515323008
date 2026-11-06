@extends('layouts.app')

@section('title', 'Daftar Buku — BookStore')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Daftar Buku</h1>

        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            + Tambah Buku
        </a>
    </div>

    {{-- Form Pencarian dan Filter --}}
    <form action="{{ route('buku.index') }}"
          method="GET"
          class="row g-2 mb-4">

        {{-- Pencarian Judul dan Penulis --}}
        <div class="col-md-4">
            <input type="text"
                   name="q"
                   class="form-control"
                   placeholder="Cari judul atau penulis..."
                   value="{{ $kataKunci }}">
        </div>

        {{-- Filter Kategori --}}
        <div class="col-md-3">
            <select name="kategori" class="form-select">
                <option value="">-- Semua Kategori --</option>

                @foreach ($daftarKategori as $kategori)
                    <option value="{{ $kategori->id }}"
                        @selected($kategoriId == $kategori->id)>
                        {{ $kategori->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Filter Penerbit --}}
        <div class="col-md-3">
            <select name="penerbit" class="form-select">
                <option value="">-- Semua Penerbit --</option>

                @foreach ($daftarPenerbit as $penerbit)
                    <option value="{{ $penerbit->id }}"
                        @selected($penerbitId == $penerbit->id)>
                        {{ $penerbit->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol Cari dan Reset --}}
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">
                Cari
            </button>

            @if ($kataKunci || $kategoriId || $penerbitId)
                <a href="{{ route('buku.index') }}"
                   class="btn btn-outline-secondary">
                    Reset
                </a>
            @endif
        </div>

    </form>

    {{-- Informasi Jumlah Buku --}}
    <p class="text-muted mb-3">
        Menampilkan
        {{ $daftarBuku->firstItem() ?? 0 }}
        -
        {{ $daftarBuku->lastItem() ?? 0 }}
        dari
        {{ $daftarBuku->total() }}
        buku.
    </p>

    {{-- Daftar Kartu Buku --}}
    <div class="row row-cols-1 row-cols-md-3 g-4">

        @forelse ($daftarBuku as $buku)

            <div class="col">
                <div class="card h-100 kartu-buku">

                    <img src="{{ $buku->cover_url }}"
                         class="card-img-top"
                         alt="Sampul {{ $buku->title }}">

                    <div class="card-body d-flex flex-column">

                        {{-- Kategori --}}
                        <span class="badge bg-secondary align-self-start mb-2">
                            {{ $buku->category?->name ?? 'Tanpa kategori' }}
                        </span>

                        {{-- Judul --}}
                        <h5 class="card-title">
                            {{ $buku->title }}
                        </h5>

                        {{-- Penulis --}}
                        <p class="card-text text-muted mb-1">
                            {{ $buku->author_name }}
                        </p>

                        {{-- Penerbit --}}
                        <p class="card-text small text-muted mb-1">
                            {{ $buku->publisher?->name ?? 'Penerbit belum diisi' }}
                        </p>

                        {{-- Harga --}}
                        <p class="card-text harga-buku mb-2">
                            Rp{{ number_format($buku->price, 0, ',', '.') }}
                        </p>

                        {{-- Informasi Stok --}}
                        @if ($buku->stock == 0)

                            <span class="badge bg-danger align-self-start mb-3">
                                Stok habis
                            </span>

                        @else

                            <span class="badge bg-success align-self-start mb-3">
                                Stok: {{ $buku->stock }}
                            </span>

                        @endif

                        {{-- Tombol Detail --}}
                        <a href="{{ route('buku.show', $buku->id) }}"
                           class="btn btn-primary mt-auto">
                            Lihat Detail
                        </a>

                    </div>
                </div>
            </div>

        @empty

            <div class="col-12">
                <div class="alert alert-warning">
                    Tidak ada buku yang cocok.
                </div>
            </div>

        @endforelse

    </div>

    {{-- Pagination Bootstrap 5 --}}
    <div class="mt-4">
        {{ $daftarBuku->links('pagination::bootstrap-5') }}
    </div>

@endsection
