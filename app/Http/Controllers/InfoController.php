<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\KategoriBerita;

class InfoController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('author')->paginate(10);
        $categories = KategoriBerita::withCount('beritas')->get();

        // Ambil 5 berita terbaru
        $recentPosts = Berita::orderBy('created_at', 'desc')->take(5)->get();

        return view('info', compact('beritas', 'categories', 'recentPosts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        // Ambil 5 berita terbaru
        $recentPosts = Berita::orderBy('created_at', 'desc')->take(5)->get();
        $categories = KategoriBerita::withCount('beritas')->get();
        $beritas = Berita::where('judul_berita', 'LIKE', "%$query%")
            ->orWhere('isi_berita', 'LIKE', "%$query%")
            ->with('author')
            ->paginate(10);

        return view('info', compact('beritas', 'query', 'categories', 'recentPosts'));
    }

    public function category($id)
    {
        $category = KategoriBerita::findOrFail($id);
        // Ambil 5 berita terbaru
        $recentPosts = Berita::orderBy('created_at', 'desc')->take(5)->get();
        $beritas = Berita::where('kategori_id', $id)->with('author')->paginate(10);
        $categories = KategoriBerita::withCount('beritas')->get();

        return view('info', compact('beritas', 'categories', 'category', 'recentPosts'));
    }
}
