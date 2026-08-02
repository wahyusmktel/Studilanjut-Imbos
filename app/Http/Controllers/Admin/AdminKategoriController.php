<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class AdminKategoriController extends Controller
{
    public function index()
    {
        $kategoriBeritas = KategoriBerita::all();
        return view('admin.kategori_berita.index', compact('kategoriBeritas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        KategoriBerita::create([
            'nama_kategori' => $request->nama_kategori,
            'status' => $request->status ?? true,
        ]);

        return response()->json(['message' => 'Kategori berita berhasil ditambahkan.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategoriBerita = KategoriBerita::findOrFail($id);
        $kategoriBerita->update([
            'nama_kategori' => $request->nama_kategori,
            'status' => $request->status ?? true,
        ]);

        return response()->json(['message' => 'Kategori berita berhasil diperbarui.']);
        // return redirect()->route('admin.kategori_berita.index')->with('success', 'Kategori berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategoriBerita = KategoriBerita::findOrFail($id);
        $kategoriBerita->delete();

        return response()->json(['message' => 'Kategori berita berhasil dihapus.']);
    }
}
