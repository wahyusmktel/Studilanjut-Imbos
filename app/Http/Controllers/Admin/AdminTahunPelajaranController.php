<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunPelajaran;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminTahunPelajaranController extends Controller
{
    public function index(Request $request)
    {
        $query = TahunPelajaran::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_tahun_pelajaran', 'like', '%' . $search . '%')
                  ->orWhere('semester', 'like', '%' . $search . '%');
        }

        $tahunPelajarans = $query->paginate(10);

        foreach ($tahunPelajarans as $tp) {
            $tp->jml_kelas = \App\Models\Kelas::withoutGlobalScope(\App\Scopes\TahunPelajaranScope::class)
                ->where('tahun_pelajaran_id', $tp->id)->count();

            $tp->jml_siswa = \App\Models\Siswa::whereHas('kelas', function($q) use ($tp) {
                $q->withoutGlobalScope(\App\Scopes\TahunPelajaranScope::class)
                  ->where('tahun_pelajaran_id', $tp->id);
            })->count();

            $tp->jml_absensi_guru = \App\Models\Absensi::withoutGlobalScope(\App\Scopes\TahunPelajaranScope::class)
                ->where('tahun_pelajaran_id', $tp->id)->count();

            $tp->jml_absensi_siswa = \App\Models\AbsensiDetail::whereHas('absensi', function($q) use ($tp) {
                $q->withoutGlobalScope(\App\Scopes\TahunPelajaranScope::class)
                  ->where('tahun_pelajaran_id', $tp->id);
            })->count();

            $tp->jml_nilai = \App\Models\Nilai::whereHas('tryout', function($q) use ($tp) {
                $q->withoutGlobalScope(\App\Scopes\TahunPelajaranScope::class)
                  ->where('tahun_pelajaran_id', $tp->id);
            })->count();
        }

        return view('admin.tahun_pelajaran.data_tahun_pelajaran', compact('tahunPelajarans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_tahun_pelajaran' => 'required|string|max:255',
            'semester' => 'required|in:1,2',
        ]);

        $data['status'] = false;
        $data['id'] = Str::uuid();
        TahunPelajaran::create($data);

        return redirect()->route('admin.tahun_pelajaran.index')->with('success', 'Data Tahun Pelajaran berhasil ditambahkan.');
    }

    // public function update(Request $request, $id)
    // {
    //     $tahunPelajaran = TahunPelajaran::findOrFail($id);

    //     $data = $request->validate([
    //         'nama_tahun_pelajaran' => 'required|string|max:255',
    //         'semester' => 'required|in:1,2',
    //         'status' => 'required|in:0,1',
    //     ]);

    //     $tahunPelajaran->update($data);

    //     return redirect()->route('admin.tahun_pelajaran.index')->with('success', 'Data Tahun Pelajaran berhasil diupdate.');
    // }

    public function update(Request $request, $id)
    {
        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Temukan tahun pelajaran yang akan diupdate
            $tahunPelajaran = TahunPelajaran::findOrFail($id);

            // Validasi data yang masuk
            $data = $request->validate([
                'nama_tahun_pelajaran' => 'required|string|max:255',
                'semester' => 'required|in:1,2',
                'status' => 'required|in:0,1',
            ]);

            // Jika status yang masuk adalah true, set semua status tahun pelajaran lainnya menjadi false
            if ($data['status'] == 1) {
                TahunPelajaran::where('id', '!=', $id)->update(['status' => 0]);
            }

            // Update tahun pelajaran yang diinginkan
            $tahunPelajaran->update($data);

            // Set semua status tryouts menjadi false
            DB::table('tryouts')->update(['status' => 0]);

            // Jika status tahun pelajaran yang diupdate adalah true, set status tryouts yang berelasi menjadi true
            if ($data['status'] == 1) {
                DB::table('tryouts')->where('tahun_pelajaran_id', $id)->update(['status' => 1]);
            }

            // Commit transaksi
            DB::commit();

            return redirect()->route('admin.tahun_pelajaran.index')->with('success', 'Data Tahun Pelajaran berhasil diupdate.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            return redirect()->route('admin.tahun_pelajaran.index')->with('error', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $tahunPelajaran = TahunPelajaran::findOrFail($id);
        $tahunPelajaran->delete();

        // return redirect()->route('admin.tahun_pelajaran.index')->with('success', 'Data Tahun Pelajaran berhasil dihapus.');
        return response()->json(['success' => 'Data Tahun Pelajaran berhasil dihapus.']);
    }
}
