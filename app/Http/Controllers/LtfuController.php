<?php

namespace App\Http\Controllers;

use App\Models\Ltfu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LTFUImport;

class LtfuController extends Controller
{
    /**
     * Menampilkan data LTFU dengan fitur pencarian dan pagination.
     */
    public function index(Request $request)
    {
        $title = 'LTFU Table';

        // Ambil query pencarian dari input request.
        $search = $request->input('search');

        // Query dengan pencarian (jika ada) dan pagination.
        $ltfu = Ltfu::when($search, function ($query, $search) {
            return $query->where('patient_name', 'like', "%{$search}%")
                         ->orWhere('nik', 'like', "%{$search}%")
                         ->orWhere('address', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc') // Tambahkan urutan berdasarkan waktu terbaru.
          ->paginate(10)
          ->appends(['search' => $search]); // Menjaga query pencarian saat berpindah halaman.

        return view('ltfu.index', compact('ltfu', 'title'));
    }

    /**
     * Menampilkan form untuk menambah data LTFU.
     */
    public function create()
    {
        return view('ltfu.create');
    }

    /**
     * Menyimpan data baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input.
        $request->validate([
            'sr' => 'required|string|max:255',
            'ssr' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'patient_name' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'gender' => 'required|string|max:1',
            'age' => 'required|integer|min:0',
            'subdistrict' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'month' => 'required|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        // Menyimpan data.
        Ltfu::create($request->all());

        // Redirect dengan pesan sukses.
        return redirect()->route('ltfu.index')
            ->with('success', 'Data LTFU berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data LTFU.
     */
    public function edit($id)
    {
        // Cari data berdasarkan ID atau kembalikan 404 jika tidak ditemukan.
        $ltfu = Ltfu::findOrFail($id);

        return view('ltfu.edit', compact('ltfu'));
    }

    /**
     * Memperbarui data LTFU di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi input.
        $request->validate([
            'sr' => 'required|string|max:255',
            'ssr' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'patient_name' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'gender' => 'required|string|max:1',
            'age' => 'required|integer|min:0',
            'subdistrict' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'month' => 'required|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        // Cari data dan update.
        $ltfu = Ltfu::findOrFail($id);
        $ltfu->update($request->all());

        // Redirect dengan pesan sukses.
        return redirect()->route('ltfu.index')
            ->with('success', 'Data LTFU berhasil diperbarui.');
    }

    /**
     * Menghapus data LTFU dari database.
     */
    public function destroy($id)
    {
        // Cari data dan hapus.
        $ltfu = Ltfu::findOrFail($id);
        $ltfu->delete();

        // Redirect dengan pesan sukses.
        return redirect()->route('ltfu.index')
            ->with('success', 'Data LTFU berhasil dihapus.');
    }

    /**
     * Menampilkan form untuk impor data.
     */
    public function showImportForm()
    {
        return view('ltfu.import'); // Pastikan file view ini ada
    }

    /**
     * Menyimpan data yang diimpor dari file Excel.
     */
    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new LTFUImport, $request->file('file'));

        return redirect()->route('ltfu.index')->with('success', 'Data berhasil diimpor.');
    }

    public function import()
    {
        Excel::import(new LTFUImport, 'file.xlsx');
    }

    
}
