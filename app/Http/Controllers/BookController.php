<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Menampilkan daftar buku, pencarian, filter, dan pagination
    public function index(Request $request)
    {
        $kataKunci = $request->query('q');
        $kategoriId = $request->query('kategori');
        $penerbitId = $request->query('penerbit');

        $daftarBuku = Book::with(['category', 'publisher'])

            // Pencarian berdasarkan judul atau penulis
            ->when($kataKunci, function ($query, $kataKunci) {
                $query->where(function ($query) use ($kataKunci) {
                    $query->where('title', 'like', '%' . $kataKunci . '%')
                        ->orWhere('author_name', 'like', '%' . $kataKunci . '%');
                });
            })

            // Filter berdasarkan kategori
            ->when($kategoriId, function ($query, $kategoriId) {
                $query->where('category_id', $kategoriId);
            })

            // Filter berdasarkan penerbit
            ->when($penerbitId, function ($query, $penerbitId) {
                $query->where('publisher_id', $penerbitId);
            })

            // Urutkan buku terbaru
            ->latest('id')

            // Menampilkan 3 buku setiap halaman
            ->paginate(3)

            // Mempertahankan pencarian dan semua filter
            ->withQueryString();

        return view('buku.index', [
            'daftarBuku' => $daftarBuku,
            'daftarKategori' => Category::orderBy('name')->get(),
            'daftarPenerbit' => Publisher::orderBy('name')->get(),
            'kataKunci' => $kataKunci,
            'kategoriId' => $kategoriId,
            'penerbitId' => $penerbitId,
        ]);
    }

    // Menampilkan form tambah buku
    public function create()
    {
        return view('buku.create', [
            'daftarKategori' => Category::orderBy('name')->get(),
            'daftarPenerbit' => Publisher::orderBy('name')->get(),
        ]);
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->aturan(),
            $this->pesan()
        );

        unset($validated['cover']);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')
                ->store('sampul', 'public');
        }

        Book::create($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan detail buku dan rekomendasi buku serupa
    public function show($id)
    {
        $buku = Book::with(['category', 'publisher'])->find($id);

        $bukuSerupa = collect();

        if ($buku) {
            $bukuSerupa = Book::with(['category', 'publisher'])
                ->where('category_id', $buku->category_id)
                ->where('id', '!=', $buku->id)
                ->latest('id')
                ->take(4)
                ->get();
        }

        return view('buku.show', [
            'buku' => $buku,
            'id' => $id,
            'bukuSerupa' => $bukuSerupa,
        ]);
    }

    // Menampilkan form edit buku
    public function edit($id)
    {
        $buku = Book::findOrFail($id);

        return view('buku.edit', [
            'buku' => $buku,
            'daftarKategori' => Category::orderBy('name')->get(),
            'daftarPenerbit' => Publisher::orderBy('name')->get(),
        ]);
    }

    // Memperbarui data buku
    public function update(Request $request, $id)
    {
        $buku = Book::findOrFail($id);

        $validated = $request->validate(
            $this->aturan(),
            $this->pesan()
        );

        unset($validated['cover']);

        $sampulLama = null;

        if ($request->hasFile('cover')) {
            $sampulLama = $buku->cover;

            $validated['cover'] = $request->file('cover')
                ->store('sampul', 'public');
        }

        $buku->update($validated);

        if ($sampulLama) {
            Storage::disk('public')->delete($sampulLama);
        }

        return redirect()->route('buku.show', $buku->id)
            ->with('success', 'Buku berhasil diperbarui.');
    }

    // Menghapus buku
    public function destroy($id)
    {
        $buku = Book::findOrFail($id);

        $sampul = $buku->cover;

        $buku->delete();

        if ($sampul) {
            Storage::disk('public')->delete($sampul);
        }

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }

    // Aturan validasi
    private function aturan(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
            'price' => 'required|integer|min:0|max:99999999',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'published_year' => 'nullable|integer|min:1900|max:2100',
            'stock' => 'required|integer|min:0|max:100000',
        ];
    }

    // Pesan validasi
    private function pesan(): array
    {
        return [
            'title.required' => 'Judul buku wajib diisi.',
            'title.max' => 'Judul buku maksimal 255 karakter.',

            'author_name.required' => 'Nama penulis wajib diisi.',
            'author_name.max' => 'Nama penulis maksimal 255 karakter.',

            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',

            'publisher_id.required' => 'Penerbit wajib dipilih.',
            'publisher_id.exists' => 'Penerbit yang dipilih tidak valid.',

            'price.required' => 'Harga wajib diisi.',
            'price.integer' => 'Harga harus berupa bilangan bulat tanpa titik atau koma.',
            'price.min' => 'Harga tidak boleh negatif.',
            'price.max' => 'Harga terlalu besar (maksimal 99.999.999).',

            'stock.required' => 'Stok wajib diisi (isi 0 bila habis).',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
            'stock.min' => 'Stok tidak boleh negatif.',
            'stock.max' => 'Stok terlalu besar (maksimal 100.000).',

            'cover.image' => 'Sampul harus berupa gambar.',
            'cover.mimes' => 'Sampul harus berformat JPG atau PNG.',
            'cover.max' => 'Ukuran sampul maksimal 2 MB.',

            'published_year.integer' => 'Tahun terbit harus berupa angka bulat.',
            'published_year.min' => 'Tahun terbit minimal 1900.',
            'published_year.max' => 'Tahun terbit maksimal 2100.',
        ];
    }
}
