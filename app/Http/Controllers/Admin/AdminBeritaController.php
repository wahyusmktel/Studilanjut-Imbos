<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminBeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('kategori', 'author')->get();
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        $kategoriBeritas = KategoriBerita::all();
        return view('admin.berita.create', compact('kategoriBeritas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_berita' => 'required|string|max:255',
            'isi_berita' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori_id' => 'required|exists:kategori_beritas,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        ]);

        $fotoPath = $request->file('foto')->store('fotos', 'public');
        $filePath = $request->file('file') ? $request->file('file')->store('files', 'public') : null;
        
        Berita::create([
            'judul_berita' => $request->judul_berita,
            'isi_berita' => $request->isi_berita,
            'foto' => $fotoPath,
            'kategori_id' => $request->kategori_id,
            'author_id' => Auth::guard('admin')->id(),
            'status' => true,
            'file' => $filePath,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function uploadGambar(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('gambar_berita', 'public');
            $url = asset('storage/' . $path);
            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'Gagal mengupload gambar.'], 400);
    }

    public function edit(Berita $berita)
    {
        $kategoriBeritas = KategoriBerita::all();
        return view('admin.berita.edit', compact('berita', 'kategoriBeritas'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul_berita' => 'required|string|max:255',
            'isi_berita' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori_id' => 'required|exists:kategori_beritas,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($berita->foto);
            $fotoPath = $request->file('foto')->store('fotos', 'public');
        } else {
            $fotoPath = $berita->foto;
        }

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($berita->file);
            $filePath = $request->file('file')->store('files', 'public');
        } else {
            $filePath = $berita->file;
        }

        $berita->update([
            'judul_berita' => $request->judul_berita,
            'isi_berita' => $request->isi_berita,
            'foto' => $fotoPath,
            'kategori_id' => $request->kategori_id,
            'file' => $filePath,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupdate.');
    }

    public function destroy(Berita $berita)
    {
        Storage::disk('public')->delete($berita->foto);
        Storage::disk('public')->delete($berita->file);
        $berita->delete();

        return response()->json(['success' => 'Berita berhasil dihapus.']);
    }
}
