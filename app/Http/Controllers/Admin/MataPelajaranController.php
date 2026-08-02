<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;

class MataPelajaranController extends Controller
{
    // public function index(Request $request)
    // {

    //     $query = MataPelajaran::query();

    //     if ($request->has('search')) {
    //         $search = $request->input('search');
    //         $query->where('namaMataPelajaran', 'like', '%' . $search . '%');
    //     }

    //     $mataPelajaran = $query->paginate(10);
    //     return view('admin.mata_pelajaran.data_mata_pelajaran', compact('mataPelajaran'));
    // }

    public function index(Request $request)
    {
        $query = MataPelajaran::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('namaMataPelajaran', 'like', '%' . $search . '%');
        }

        $mataPelajaran = $query->paginate(10)->appends(['search' => $request->input('search')]);

        return view('admin.mata_pelajaran.data_mata_pelajaran', compact('mataPelajaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaMataPelajaran' => 'required|string|max:255',
            'kode_mapel' => 'required|string|max:255',
            'status' => 'required|string',
            'opsi_kedinasan' => 'sometimes|boolean'
        ]);

        MataPelajaran::create([
            'namaMataPelajaran' => $request->namaMataPelajaran,
            'kode_mapel' => $request->kode_mapel,
            'status' => $request->status,
            'opsi_kedinasan' => $request->opsi_kedinasan
        ]);

        return redirect()->route('admin.mata_pelajaran.index')->with('success', 'Data Mata Pelajaran berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaMataPelajaran' => 'required|string|max:255',
            'kode_mapel' => 'required|string|max:255',
            'status' => 'required|string',
            'opsi_kedinasan' => 'sometimes|boolean'
        ]);

        $mataPelajaran = MataPelajaran::findOrFail($id);
        $mataPelajaran->update([
            'namaMataPelajaran' => $request->namaMataPelajaran,
            'kode_mapel' => $request->kode_mapel,
            'status' => $request->status,
            'opsi_kedinasan' => $request->opsi_kedinasan
        ]);

        return redirect()->route('admin.mata_pelajaran.index')->with('success', 'Data Mata Pelajaran berhasil diupdate.');
    }

    public function destroy($id)
    {
        $mataPelajaran = MataPelajaran::findOrFail($id);
        $mataPelajaran->delete();

        // return redirect()->route('admin.mata_pelajaran.index')->with('success', 'Data Mata Pelajaran berhasil dihapus.');
        return response()->json(['success' => 'Data Mata Pelajaran berhasil dihapus.']);
    }
}
