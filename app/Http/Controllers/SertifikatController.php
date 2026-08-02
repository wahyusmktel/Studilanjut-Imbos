<?php

namespace App\Http\Controllers;

use App\Models\SertifikatTryout;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    public function validasiSertifikat($no_sertifikat)
    {
        $sertifikat = SertifikatTryout::where('no_sertifikat', $no_sertifikat)->first();

        if (!$sertifikat) {
            return view('validasi_sertifikat', ['message' => 'Sertifikat tidak ditemukan']);
        }

        $siswa = $sertifikat->siswa;
        $tryout = $siswa->nilais->where('tryout_id', $sertifikat->tryout_id)->first()->tryout;

        return view('validasi_sertifikat', compact('siswa', 'sertifikat', 'tryout'));
    }
}
