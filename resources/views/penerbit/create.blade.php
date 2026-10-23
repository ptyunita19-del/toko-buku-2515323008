@extends('layouts.app')

@section('title', 'Tambah Penerbit')

@section('content')
<div class="container py-4">

    <h2 class="mb-4">Tambah Penerbit</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('penerbit.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">
                        Nama Penerbit
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror"
                    >

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">
                        Kota
                    </label>

                    <input
                        type="text"
                        name="city"
                        id="city"
                        value="{{ old('city') }}"
                        class="form-control @error('city') is-invalid @enderror"
                    >

                    @error('city')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="{{ route('penerbit.index') }}"
                       class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
