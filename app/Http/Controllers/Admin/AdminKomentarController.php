<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use Illuminate\Http\Request;

class AdminKomentarController extends Controller
{
    // public function index()
    // {
    //     $komentars = Komentar::with('berita')->get();
    //     return view('admin.komentar.index', compact('komentars'));
    // }

    public function index()
    {
        $komentars = Komentar::with(['berita', 'tanggapan'])->get();
        return view('admin.komentar.index', compact('komentars'));
    }

    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->delete();

        return response()->json(['success' => 'Komentar berhasil dihapus.']);
    }
}
