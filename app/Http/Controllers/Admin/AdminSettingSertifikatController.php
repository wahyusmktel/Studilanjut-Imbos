<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingSertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminSettingSertifikatController extends Controller
{
    public function index(Request $request)
    {
        $query = SettingSertifikat::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_template', 'like', '%' . $search . '%');
        }

        $settingsertifikats = $query->paginate(10);

        return view('admin.setting_sertifikat.index', compact('settingsertifikats'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_template' => 'required|string|max:255',
            'logo_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'watermark' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo_1')) {
            $validatedData['logo_1'] = $request->file('logo_1')->store('settings', 'public');
        }

        if ($request->hasFile('logo_2')) {
            $validatedData['logo_2'] = $request->file('logo_2')->store('settings', 'public');
        }

        if ($request->hasFile('watermark')) {
            $validatedData['watermark'] = $request->file('watermark')->store('settings', 'public');
        }

        SettingSertifikat::create($validatedData);

        return redirect()->route('admin.setting_sertifikat.index')->with('success', 'Konfigurasi Sertifikat berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $settingSertifikat = SettingSertifikat::findOrFail($id);

        $validatedData = $request->validate([
            'nama_template' => 'required|string|max:255',
            'logo_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'watermark' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($request->status) {
            // Set all other status to false
            SettingSertifikat::where('status', true)->update(['status' => false]);
        }

        if ($request->hasFile('logo_1')) {
            $validatedData['logo_1'] = $request->file('logo_1')->store('settings', 'public');
        }

        if ($request->hasFile('logo_2')) {
            $validatedData['logo_2'] = $request->file('logo_2')->store('settings', 'public');
        }

        if ($request->hasFile('watermark')) {
            $validatedData['watermark'] = $request->file('watermark')->store('settings', 'public');
        }

        $settingSertifikat->update($validatedData);

        return redirect()->route('admin.setting_sertifikat.index')->with('success', 'Konfigurasi Sertifikat berhasil diupdate.');
    }

    public function destroy($id)
    {
        $tahunPelajaran = SettingSertifikat::findOrFail($id);
        $tahunPelajaran->delete();

        // return redirect()->route('admin.tahun_pelajaran.index')->with('success', 'Data Tahun Pelajaran berhasil dihapus.');
        return response()->json(['success' => 'Konfigurasi berhasil dihapus.']);
    }
}
