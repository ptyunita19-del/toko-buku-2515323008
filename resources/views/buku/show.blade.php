<h1>Detail Buku</h1>

@if ($buku)
    <h2>{{ $buku['judul'] }}</h2>

    <p>Penulis: {{ $buku['penulis'] }}</p>

    <p>Tahun: {{ $buku['tahun'] }}</p>

    <a href="/buku">Kembali ke Daftar Buku</a>
@else
    <p>Buku dengan ID {{ $id }} tidak ditemukan.</p>

    <a href="/buku">Kembali ke Daftar Buku</a>
@endif