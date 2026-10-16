@extends('layouts.app')

@section('title', $buku->title . ' — BookStore')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('images/sampul.jpg') }}"
                 class="img-fluid rounded"
                 alt="Sampul {{ $buku->title }}">
        </div>

        <div class="col-md-8">
            <h1>{{ $buku->title }}</h1>

            <p class="text-muted">
                Penulis: {{ $buku->author }}
            </p>

            <p>
                Kategori:
                <span class="badge bg-secondary">
                    {{ $buku->category->name ?? 'Belum ada kategori' }}
                </span>
            </p>

            <p class="harga-buku fs-4">
                Rp{{ number_format($buku->price, 0, ',', '.') }}
            </p>

            <a href="{{ url('/buku') }}"
               class="btn btn-outline-secondary">
                &larr; Kembali ke daftar buku
            </a>
        </div>
    </div>
@endsection
