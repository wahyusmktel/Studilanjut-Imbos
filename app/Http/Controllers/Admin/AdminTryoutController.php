<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tryout;
use App\Models\TahunPelajaran;
use Illuminate\Http\Request;

class AdminTryoutController extends Controller
{
    public function index(Request $request)
    {
        $query = Tryout::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_tryout', 'like', '%' . $search . '%');
        }

        // Urutkan berdasarkan nama_tryout untuk memastikan urutan alfabetis
        $query->orderBy('nama_tryout', 'asc');

        $tryouts = $query->paginate(10)->appends(['search' => $request->input('search')]);
        $tahunAktif = TahunPelajaran::where('status', 1)->first();

        return view('admin.tryout.data_tryout', compact('tryouts', 'tahunAktif'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // 'tahun_pelajaran_id' => 'required|uuid',
            'nama_tryout' => 'required|string|max:255',
        ]);

        $tahunAktif = TahunPelajaran::where('status', 1)->first();

        if (!$tahunAktif) {
            return redirect()->route('admin.tryout.index')->with('error', 'Gagal membuat tryout. Tidak ada Tahun Pelajaran yang aktif.');
        }

        $data['id'] = (string) \Illuminate\Support\Str::uuid();
        $data['status'] = true;
        $data['tahun_pelajaran_id'] = $tahunAktif->id;

        Tryout::create($data);

        return redirect()->route('admin.tryout.index')->with('success', 'Data Try Out berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $tryout = Tryout::findOrFail($id);

        $data = $request->validate([
            'tahun_pelajaran_id' => 'required|uuid',
            'nama_tryout' => 'required|string|max:255',
        ]);

        $tryout->update($data);

        return redirect()->route('admin.tryout.index')->with('success', 'Data Try Out berhasil diupdate.');
    }

    public function destroy($id)
    {
        $tryout = Tryout::findOrFail($id);
        $tryout->delete();

        // return redirect()->route('admin.tryout.index')->with('success', 'Data Try Out berhasil dihapus.');
        return response()->json(['success' => 'Data Try Out berhasil dihapus.']);
    }
}
