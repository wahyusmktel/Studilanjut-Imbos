<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\Komentar;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // public function index()
    // {
    //     $beritas = Berita::with('kategori', 'author')->get();
    //     return view('berita', compact('beritas'));
    // }

    public function index()
    {
        $beritas = Berita::with(['author', 'kategori'])->get();
        return view('berita', compact('beritas'));
    }

    // public function show($id)
    // {
    //     $berita = Berita::with(['author', 'kategori', 'komentars'])->findOrFail($id);
    //     // $komentars = Komentar::where('berita_id', $id)->get();
    //     $komentars = Komentar::with('tanggapan')->where('berita_id', $id)->get();
    //     return view('detail_berita', compact('berita', 'komentars'));
    // }
    
    public function show($id)
    {
        $berita = Berita::with(['author', 'kategori', 'komentars.tanggapan.author'])->findOrFail($id);
        $categories = KategoriBerita::withCount('beritas')->get();

        // Ambil 5 berita terbaru
        $recentPosts = Berita::orderBy('created_at', 'desc')->take(5)->get();

        return view('detail_berita', compact('berita', 'categories', 'recentPosts'));
    }

    public function storeKomentar(Request $request)
    {
        $request->validate([
            'berita_id' => 'required|exists:beritas,id',
            'nama_komentator' => 'required|string|max:255',
            'isi_komentar' => 'required|string',
        ]);

        Komentar::create([
            'berita_id' => $request->berita_id,
            'nama_komentator' => $request->nama_komentator,
            'isi_komentar' => $request->isi_komentar,
            'status' => true,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    // public function search(Request $request)
    // {
    //     $query = $request->input('query');
    //     $beritas = Berita::where('judul_berita', 'LIKE', "%$query%")
    //         ->orWhere('isi_berita', 'LIKE', "%$query%")
    //         ->with('author')
    //         ->get();

    //     return view('info', compact('beritas', 'query'));
    // }
}
