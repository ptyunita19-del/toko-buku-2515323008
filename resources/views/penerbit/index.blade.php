@extends('layouts.app')

@section('title', 'Daftar Penerbit')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Penerbit</h2>

        <a href="{{ route('penerbit.create') }}" class="btn btn-primary">
            + Tambah Penerbit
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="70">No.</th>
                            <th>Nama Penerbit</th>
                            <th>Kota</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($daftarPenerbit as $penerbit)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penerbit->name }}</td>
                                <td>{{ $penerbit->city }}</td>
                                <td>
                                    <a href="{{ route('penerbit.edit', $penerbit->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('penerbit.destroy', $penerbit->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus penerbit ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    Belum ada data penerbit.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
