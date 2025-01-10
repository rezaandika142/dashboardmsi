<?php

namespace App\Http\Controllers;
use App\Models\Ltfu;
use Illuminate\Http\Request;

class LtfuController extends Controller
{
    // Menampilkan data LTFU
    public function index(Request $request)
    {
        $title = 'LTFU Table';

        // Ambil query pencarian dari request (jika ada)
        $search = $request->input('search');

        // Query dengan pencarian dan pagination
        $ltfu = Ltfu::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('age', 'like', "%{$search}%")
                         ->orWhere('address', 'like', "%{$search}%");
        })->paginate(10);

        return view('ltfu', compact('ltfu', 'title'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('ltfu.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required|integer',
            'address' => 'required',
        ]);

        Ltfu::create($request->all());
        return redirect()->route('ltfu.index');
    }

    // Menampilkan form edit data
    public function edit($id)
    {
        $ltfu = Ltfu::findOrFail($id);
        return view('ltfu.edit', compact('ltfu'));
    }

    // Memperbarui data
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required|integer',
            'address' => 'required',
        ]);

        $ltfu = Ltfu::findOrFail($id);
        $ltfu->update($request->all());
        return redirect()->route('ltfu.index');
    }

    // Menghapus data
    public function destroy($id)
    {
        $ltfu = Ltfu::findOrFail($id);
        $ltfu->delete();
        return redirect()->route('ltfu.index');
    }
}
