<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTanggapanController extends Controller
{
    // public function index()
    // {
    //     $tanggapans = Tanggapan::with('komentar', 'author')->get();
    //     return view('admin.tanggapan_komentar.index', compact('tanggapans'));
    // }

    public function index(Request $request)
    {
        $query = Tanggapan::with('komentar', 'author');

        if ($request->has('komentar_id')) {
            $query->where('komentar_id', $request->input('komentar_id'));
        }

        $tanggapans = $query->get();

        return view('admin.tanggapan_komentar.index', compact('tanggapans'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'komentar_id' => 'required|uuid',
    //         'isi_tanggapan' => 'required|string',
    //     ]);

    //     Tanggapan::create([
    //         'komentar_id' => $request->komentar_id,
    //         'author_id' => Auth::id(),
    //         'isi_tanggapan' => $request->isi_tanggapan,
    //         'status' => true,
    //     ]);

    //     return redirect()->back()->with('success', 'Tanggapan berhasil ditambahkan.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'komentar_id' => 'required|uuid',
            'isi_tanggapan' => 'required|string',
        ]);

        $tanggapan = new Tanggapan();
        $tanggapan->komentar_id = $request->komentar_id;
        $tanggapan->author_id = Auth::guard('admin')->id(); // assuming you are using auth for admin
        $tanggapan->isi_tanggapan = $request->isi_tanggapan;
        $tanggapan->status = true;
        $tanggapan->save();

        return redirect()->route('admin.komentar.index')->with('success', 'Tanggapan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $tanggapan = Tanggapan::findOrFail($id);

        $request->validate([
            'isi_tanggapan' => 'required|string',
        ]);

        $tanggapan->update([
            'isi_tanggapan' => $request->isi_tanggapan,
        ]);

        return redirect()->back()->with('success', 'Tanggapan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);
        $tanggapan->delete();

        return response()->json(['success' => 'Tanggapan berhasil dihapus.']);
    }
}
