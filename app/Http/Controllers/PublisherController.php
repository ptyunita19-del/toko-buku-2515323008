<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class PublisherController extends Controller
{
    /**
     * Menampilkan daftar penerbit.
     */
    public function index()
    {
        return view('penerbit.index', [
            'daftarPenerbit' => Publisher::orderBy('name')->get(),
        ]);
    }

    /**
     * Menampilkan form tambah penerbit.
     */
    public function create()
    {
        return view('penerbit.create');
    }

    /**
     * Memvalidasi dan menyimpan penerbit baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:publishers,name',
            'city' => 'required|string|max:100',
        ], [
            'name.required' => 'Nama penerbit wajib diisi.',
            'name.max' => 'Nama penerbit maksimal 100 karakter.',
            'name.unique' => 'Nama penerbit ini sudah dipakai.',
            'city.required' => 'Kota wajib diisi.',
            'city.max' => 'Kota maksimal 100 karakter.',
        ]);

        Publisher::create($validated);

        return redirect()->route('penerbit.index')
            ->with('success', 'Penerbit berhasil ditambahkan.');
    }

    /**
     * Menampilkan form ubah penerbit.
     */
    public function edit(string $id)
    {
        return view('penerbit.edit', [
            'penerbit' => Publisher::findOrFail($id),
        ]);
    }

    /**
     * Memvalidasi dan menyimpan perubahan penerbit.
     */
    public function update(Request $request, string $id)
    {
        $penerbit = Publisher::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('publishers', 'name')
                    ->ignore($penerbit->id),
            ],
            'city' => 'required|string|max:100',
        ], [
            'name.required' => 'Nama penerbit wajib diisi.',
            'name.max' => 'Nama penerbit maksimal 100 karakter.',
            'name.unique' => 'Nama penerbit ini sudah dipakai.',
            'city.required' => 'Kota wajib diisi.',
            'city.max' => 'Kota maksimal 100 karakter.',
        ]);

        $penerbit->update($validated);

        return redirect()->route('penerbit.index')
            ->with('success', 'Penerbit berhasil diubah.');
    }

    /**
     * Menghapus penerbit.
     * Penerbit yang masih digunakan buku tidak boleh dihapus.
     */
    public function destroy(string $id)
    {
        $penerbit = Publisher::findOrFail($id);

        try {
            $penerbit->delete();

            return redirect()->route('penerbit.index')
                ->with('success', 'Penerbit berhasil dihapus.');

        } catch (QueryException $e) {

            if ($e->getCode() === '23000') {
                return redirect()->route('penerbit.index')
                    ->with(
                        'error',
                        'Penerbit tidak dapat dihapus karena masih digunakan oleh buku.'
                    );
            }

            throw $e;
        }
    }
}
