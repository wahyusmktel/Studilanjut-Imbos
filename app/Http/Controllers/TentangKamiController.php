<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function index()
    {
        $gurus = Guru::with('mataPelajaran')->get();
        return view('tentang_kami', compact('gurus'));
    }
}
