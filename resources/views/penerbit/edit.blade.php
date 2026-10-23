@extends('layouts.app')

@section('title', 'Edit Penerbit')

@section('content')
<div class="container py-4">

    <h2 class="mb-4">Edit Penerbit</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('penerbit.update', $penerbit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">
                        Nama Penerbit
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $penerbit->name) }}"
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
                        value="{{ old('city', $penerbit->city) }}"
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
                        Simpan Perubahan
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
