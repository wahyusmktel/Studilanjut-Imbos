<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\JenisPt;
use App\Models\Testimonials;
use Illuminate\Http\Request;

class TrackAlumniController extends Controller
{
    public function index(Request $request)
    {
        $testimonials = Testimonials::with('alumni')->get();
        $jenisPt = JenisPt::all();

        // Ambil tahun lulusan yang unik dari database untuk opsi filter
        $tahunLulusanOptions = Alumni::select('tahun_lulusan')->distinct()->orderBy('tahun_lulusan', 'desc')->pluck('tahun_lulusan');

        // $alumnis = Alumni::with('jenisPt')->get();

        // Jika ada filter tahun lulusan, gunakan untuk memfilter data alumni
        $alumnis = Alumni::with('jenisPt')
        ->when($request->tahun_lulusan, function ($query) use ($request) {
            return $query->where('tahun_lulusan', $request->tahun_lulusan);
        })
        // ->get();
        ->paginate(9);

        // Data untuk grafik
        $chartData = $jenisPt->map(function ($jenis) {
            return [
                'label' => $jenis->nama_jenis_pt,
                'count' => $jenis->alumnis()->count()
            ];
        });

        return view('track_alumni', compact('testimonials', 'jenisPt', 'alumnis', 'chartData', 'tahunLulusanOptions'));
    }

    public function show($id)
    {
        $alumni = Alumni::with('jenisPt')->findOrFail($id);
        return view('detail_alumni', compact('alumni'));
    }
}
