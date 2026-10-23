<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kategori.index', [
            'daftarKategori' => Category::withCount('books')
                ->orderBy('name')
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:100|unique:categories,name',
    ], [
        'name.required' => 'Nama kategori wajib diisi.',
        'name.max' => 'Nama kategori maksimal 100 karakter.',
        'name.unique' => 'Nama kategori ini sudah dipakai.',
    ]);

    Category::create($validated);

    return redirect()->route('kategori.index')
        ->with('success', 'Kategori berhasil ditambahkan.');
}


    
public function edit(string $id)
{
    return view('kategori.edit', [
        'kategori' => Category::findOrFail($id),
    ]);
}


    
public function update(Request $request, string $id)
{
    $kategori = Category::findOrFail($id);

    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:100',
            Rule::unique('categories', 'name')->ignore($kategori->id),
        ],
    ], [
        'name.required' => 'Nama kategori wajib diisi.',
        'name.max' => 'Nama kategori maksimal 100 karakter.',
        'name.unique' => 'Nama kategori ini sudah dipakai.',
    ]);

    $kategori->update($validated);

    return redirect()->route('kategori.index')
        ->with('success', 'Kategori berhasil diubah.');
}


    
public function destroy(string $id)
{
    $kategori = Category::findOrFail($id);

    if ($kategori->books()->exists()) {
        return redirect()->route('kategori.index')
            ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh buku.');
    }

    $kategori->delete();

    return redirect()->route('kategori.index')
        ->with('success', 'Kategori berhasil dihapus.');
}

}
