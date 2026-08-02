<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\AbsensiDetail;
use App\Models\TahunPelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AbsensiGuruController extends Controller
{
    public function index()
    {
        $guru = Auth::guard('guru')->user();
        $guru = Guru::with('mataPelajaran')->find($guru->id);
        $kelases = Kelas::all();
        $allSiswa = Siswa::with('kelas')->get(); // Mengambil semua siswa dengan data kelas

        return view('absensi_guru', compact('guru', 'kelases', 'allSiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'tanggal' => 'required|date_format:Y-m-d\TH:i',
            'tanggal' => 'required|date',
            'waktu' => 'required|string',
            'kelas_id' => 'required|uuid',
            'catatan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10204',
            'siswa_id' => 'required|array',
            'kehadiran' => 'required|array',
        ]);

        // --- MULAI PERUBAHAN ---
        // 1. Cari Tahun Pelajaran yang aktif
        $tahunAktif = TahunPelajaran::where('status', 1)->first();

        // 2. Jika tidak ada yang aktif, kembalikan dengan pesan error
        if (!$tahunAktif) {
            return redirect()->back()->with('error', 'Gagal menyimpan. Tidak ada Tahun Pelajaran yang aktif.');
        }

        $guru = Auth::guard('guru')->user();

        $absensi = Absensi::create([
            'guru_id' => $guru->id,
            'kelas_id' => $request->kelas_id,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'catatan' => $request->catatan,
            'foto' => $request->hasFile('foto') ? $request->file('foto')->store('foto_absensi', 'public') : null,
            'tahun_pelajaran_id' => $tahunAktif->id, // Kolom baru sudah disertakan
        ]);

        foreach ($request->siswa_id as $siswa_id) {
            AbsensiDetail::create([
                'absensi_id' => $absensi->id, // Menggunakan $absensi dari langkah sebelumnya
                'siswa_id' => $siswa_id,
                'kehadiran' => $request->kehadiran[$siswa_id],
            ]);
        }

        return redirect()->back()->with('success', 'Absensi berhasil disimpan.');
    }

    public function getSiswaByKelas(Request $request)
    {
        $siswa = Siswa::where('kelas_id', $request->kelas_id)->get();
        return response()->json($siswa);
    }

    public function uploadFotoSampul(Request $request)
    {
        $request->validate([
            'foto_sampul' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $guru = Auth::guard('guru')->user();
        $guru = Guru::find($guru->id);

        if ($request->hasFile('foto_sampul')) {
            // Hapus foto sampul lama jika ada
            if ($guru->foto_sampul) {
                Storage::delete('public/foto_sampul_guru/' . $guru->foto_sampul);
            }

            $fileName = time() . '.' . $request->foto_sampul->extension();
            $request->foto_sampul->storeAs('public/foto_sampul_guru', $fileName);
            $guru->foto_sampul = $fileName;
            $guru->save();
        }

        return redirect()->back()->with('success', 'Foto sampul berhasil diupdate.');
    }
}
