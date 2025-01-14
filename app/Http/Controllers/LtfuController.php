<?php

namespace App\Http\Controllers;

use App\Models\Ltfu;
use Illuminate\Http\Request;

class LtfuController extends Controller
{
    /**
     * Menampilkan data LTFU dengan fitur pencarian dan pagination
     */
    public function index(Request $request)
    {
        $title = 'LTFU Table';

        // Ambil query pencarian dari input request
        $search = $request->input('search');

        // Query dengan pencarian (jika ada) dan pagination
        $ltfu = Ltfu::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('age', 'like', "%{$search}%")
                         ->orWhere('address', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc') // Tambahkan urutan berdasarkan waktu terbaru
          ->paginate(10)
          ->appends(['search' => $search]); // Menjaga query pencarian saat berpindah halaman

        return view('ltfu.index', compact('ltfu', 'title'));
    }

    /**
     * Menampilkan form untuk menambah data LTFU
     */
    public function create()
    {
        return view('ltfu.create');
    }

    /**
     * Menyimpan data baru ke dalam database
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'address' => 'required|string|max:255',
        ]);

        // Menyimpan data
        Ltfu::create($request->only(['name', 'age', 'address']));

        // Redirect dengan pesan sukses
        return redirect()->route('ltfu.index')
            ->with('success', 'Data LTFU berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data LTFU
     */
    public function edit($id)
    {
        // Cari data berdasarkan ID atau kembalikan 404 jika tidak ditemukan
        $ltfu = Ltfu::findOrFail($id);

        return view('ltfu.edit', compact('ltfu'));
    }

    /**
     * Memperbarui data LTFU di database
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'address' => 'required|string|max:255',
        ]);

        // Cari data dan update
        $ltfu = Ltfu::findOrFail($id);
        $ltfu->update($request->only(['name', 'age', 'address']));

        // Redirect dengan pesan sukses
        return redirect()->route('ltfu.index')
            ->with('success', 'Data LTFU berhasil diperbarui.');
    }

    /**
     * Menghapus data LTFU dari database
     */
    public function destroy($id)
    {
        // Cari data dan hapus
        $ltfu = Ltfu::findOrFail($id);
        $ltfu->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('ltfu.index')
            ->with('success', 'Data LTFU berhasil dihapus.');
    }
}
