<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminGuruController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\AdminKelasController;
use App\Http\Controllers\Admin\AdminNilaiController;
use App\Http\Controllers\Admin\AdminTahunPelajaranController;
use App\Http\Controllers\Admin\AdminTryoutController;
use App\Http\Controllers\Admin\ProgramBimbelController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuruAuthController;
use App\Http\Controllers\AbsensiGuruController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\AbsensiGurubaruController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\Admin\AdminAlumniController;
use App\Http\Controllers\Admin\AdminJenisPtController;
use App\Http\Controllers\Admin\AdminTestimonialsController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminBeritaController;
use App\Http\Controllers\Admin\AdminKomentarController;
use App\Http\Controllers\Admin\AdminSettingSertifikatController;
use App\Http\Controllers\Admin\AdminTanggapanController;
use App\Http\Controllers\Admin\SiswaImportController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\TrackAlumniController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\TryOutController;

Route::get('/', [HomeController::class, 'index']);

// Route untuk login guru
Route::get('/login-guru', [GuruAuthController::class, 'showLoginForm'])->name('guru.login');
Route::post('/login-guru', [GuruAuthController::class, 'login'])->name('guru.login.submit');
Route::post('/logout-guru', [GuruAuthController::class, 'logout'])->name('guru.logout');
Route::get('/validasi-sertifikat/{no_sertifikat}', [SertifikatController::class, 'validasiSertifikat'])->name('validasi.sertifikat');

// Route untuk absensi guru
Route::middleware('guru')->group(function () {
    Route::get('/absensi', [AbsensiGuruController::class, 'index'])->name('absensi.index');
    Route::post('/upload-foto-sampul', [AbsensiGuruController::class, 'uploadFotoSampul'])->name('guru.uploadFotoSampul');
    Route::post('/absensi', [AbsensiGuruController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/get-siswa', [AbsensiGuruController::class, 'getSiswaByKelas'])->name('absensi.get-siswa');
});

// Routes untuk login orang tua
Route::get('/orang-tua', [OrangTuaController::class, 'showLoginForm'])->name('parent.login');
Route::post('/orang-tua', [OrangTuaController::class, 'login'])->name('parent.login.submit');
Route::post('/logout-orang-tua', [OrangTuaController::class, 'logout'])->name('parent.logout');

Route::prefix('orang-tua')->group(function () {
    // Routes yang membutuhkan autentikasi orang tua
    Route::middleware('parent')->group(function () {
        Route::get('/dashboard', [OrangTuaController::class, 'index'])->name('orang_tua.index');
        Route::get('/download-sertifikat-siswa/{id}', [OrangTuaController::class, 'downloadSertifikat'])->name('parent.downloadSertifikat');
        Route::get('/download-sertifikat-siswa/{id}/tryout/{tryout_id}', [OrangTuaController::class, 'downloadSertifikatTryout'])->name('parent.downloadSertifikatTryout');
        // Route untuk menampilkan view sertifikat tanpa mendownload PDF
        Route::get('/view-sertifikat-siswa/{id}/tryout/{tryout_id}', [OrangTuaController::class, 'showSertifikatTryout'])->name('parent.viewSertifikatTryout');
        Route::get('/absensi/detail', [OrangTuaController::class, 'detailAbsensi'])->name('parent.absensi.detail');
    });
});

//Halaman Track Alumni
Route::get('/tracking-alumni', [TrackAlumniController::class, 'index'])->name('track.alumni.index');
Route::get('/tracking-alumni/{id}', [TrackAlumniController::class, 'show'])->name('alumni.detail');

//Halaman Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.detail');
Route::post('/komentar', [BeritaController::class, 'storeKomentar'])->name('komentar.store');
// Route untuk pencarian berita
Route::get('/search', [InfoController::class, 'search'])->name('berita.search');
// Route untuk menampilkan berita berdasarkan kategori
Route::get('/category/{id}', [InfoController::class, 'category'])->name('berita.category');

//Halaman Tentang Kami
Route::get('/tentang-kami', [TentangKamiController::class, 'index'])->name('tentang_kami.index');

//Halaman Program
Route::get('/program', [ProgramController::class, 'index'])->name('program.index');

//Halaman TryOut
Route::get('/tryout', [TryOutController::class, 'index'])->name('tryout.index');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['admin'])->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        // Route::get('/guru/data_guru', [AdminGuruController::class, 'index'])->name('admin.guru.data_guru');

        //Mata Pelajaran
        Route::get('/mata_pelajaran', [MataPelajaranController::class, 'index'])->name('admin.mata_pelajaran.index');
        Route::post('/mata_pelajaran', [MataPelajaranController::class, 'store'])->name('admin.mata_pelajaran.store');
        Route::post('/mata_pelajaran/{id}', [MataPelajaranController::class, 'update'])->name('admin.mata_pelajaran.update');
        Route::delete('/mata_pelajaran/{id}', [MataPelajaranController::class, 'destroy'])->name('admin.mata_pelajaran.destroy');
        // Route::get('/mata_pelajaran', [MataPelajaranController::class, 'index'])->name('admin.mata_pelajaran.index');

        // Guru
        Route::get('/guru', [AdminGuruController::class, 'index'])->name('admin.guru.data_guru');
        Route::post('/guru', [AdminGuruController::class, 'store'])->name('admin.guru.store');
        Route::post('/guru/{id}', [AdminGuruController::class, 'update'])->name('admin.guru.update');
        Route::delete('/guru/{id}', [AdminGuruController::class, 'destroy'])->name('admin.guru.destroy');

        // Kelas
        Route::get('/kelas', [AdminKelasController::class, 'index'])->name('admin.kelas.index');
        Route::post('/kelas', [AdminKelasController::class, 'store'])->name('admin.kelas.store');
        Route::post('/kelas/{id}', [AdminKelasController::class, 'update'])->name('admin.kelas.update');
        Route::delete('/kelas/{id}', [AdminKelasController::class, 'destroy'])->name('admin.kelas.destroy');

        // Program Bimbel
        Route::get('/program_bimbel', [ProgramBimbelController::class, 'index'])->name('admin.program_bimbel.index');
        Route::post('/program_bimbel', [ProgramBimbelController::class, 'store'])->name('admin.program_bimbel.store');
        Route::post('/program_bimbel/{id}', [ProgramBimbelController::class, 'update'])->name('admin.program_bimbel.update');
        Route::delete('/program_bimbel/{id}', [ProgramBimbelController::class, 'destroy'])->name('admin.program_bimbel.destroy');

        // Siswa
        Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
        Route::post('/siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
        Route::post('/siswa/{id}', [SiswaController::class, 'update'])->name('admin.siswa.update');
        Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');
        Route::post('/admin/siswa/import', [SiswaController::class, 'import'])->name('admin.siswa.import');

        // Tahun Pelajaran
        Route::get('/tahun_pelajaran', [AdminTahunPelajaranController::class, 'index'])->name('admin.tahun_pelajaran.index');
        Route::post('/tahun_pelajaran', [AdminTahunPelajaranController::class, 'store'])->name('admin.tahun_pelajaran.store');
        Route::post('/tahun_pelajaran/{id}', [AdminTahunPelajaranController::class, 'update'])->name('admin.tahun_pelajaran.update');
        Route::delete('/tahun_pelajaran/{id}', [AdminTahunPelajaranController::class, 'destroy'])->name('admin.tahun_pelajaran.destroy');

        // Try Out
        Route::get('/tryout', [AdminTryoutController::class, 'index'])->name('admin.tryout.index');
        Route::post('/tryout', [AdminTryoutController::class, 'store'])->name('admin.tryout.store');
        Route::put('/tryout/{id}', [AdminTryoutController::class, 'update'])->name('admin.tryout.update');
        Route::delete('/tryout/{id}', [AdminTryoutController::class, 'destroy'])->name('admin.tryout.destroy');

        // Nilai
        Route::get('/nilai', [AdminNilaiController::class, 'index'])->name('admin.nilai.index');
        Route::get('/nilai/getTryouts', [AdminNilaiController::class, 'getTryouts'])->name('admin.nilai.getTryouts');
        Route::get('/nilai/getSiswas', [AdminNilaiController::class, 'getSiswas'])->name('admin.nilai.getSiswas');
        Route::post('/nilai', [AdminNilaiController::class, 'store'])->name('admin.nilai.store');
        Route::post('/nilai/{id}', [AdminNilaiController::class, 'update'])->name('admin.nilai.update');
        Route::delete('/nilai/{id}', [AdminNilaiController::class, 'destroy'])->name('admin.nilai.destroy');
        Route::delete('/nilai-detail/{id}', [AdminNilaiController::class, 'hapusBerdasarkanNilai'])->name('admin.nilaidetail.destroy');
        Route::get('/nilai-siswa', [AdminNilaiController::class, 'nilaiSiswaIndex'])->name('admin.nilai-siswa.index');
        Route::get('/nilai-siswa/{id}', [AdminNilaiController::class, 'detail'])->name('admin.nilai.detail');
        Route::get('/nilai-siswa/{id}/download-sertifikat', [AdminNilaiController::class, 'downloadSertifikat'])->name('admin.nilai.downloadSertifikat');
        Route::delete('/admin/nilai/hapus-semua', [AdminNilaiController::class, 'hapusSemua'])->name('admin.nilai.hapusSemua');
        // Route untuk mengunduh template import nilai
        Route::get('/nilai/download-template', [AdminNilaiController::class, 'downloadTemplate'])->name('admin.nilai.downloadTemplate');
        Route::post('/admin/nilai/import', [AdminNilaiController::class, 'import'])->name('admin.nilai.import');

        Route::get('/absensi', [AbsensiController::class, 'index'])->name('admin.absensi.index');
        Route::get('/absensi/export', [AbsensiController::class, 'export'])->name('admin.absensi.export');
        Route::patch('/absensi/update', [AbsensiController::class, 'update'])->name('admin.absensi.update');
        Route::get('/absensi/detail/{siswa_id}', [AbsensiController::class, 'detail'])->name('admin.absensi.detail');

        // Route untuk export detail absensi siswa
        Route::get('/absensi/detail/export/{id}', [AbsensiController::class, 'exportDetail'])->name('admin.absensi.detail.export');

        Route::get('/absensi-guru', [AbsensiGurubaruController::class, 'index'])->name('admin.absensi-guru.index');
        Route::get('/absensi-guru/{id}', [AbsensiGurubaruController::class, 'show'])->name('admin.absensi-guru.show');
        Route::get('/admin/absensi-guru/export', [AbsensiGurubaruController::class, 'export'])->name('admin.absensi-guru.export');
        Route::delete('/absensi/{id}', [AbsensiGurubaruController::class, 'destroy'])->name('admin.absensi.destroy');

        // Routes untuk Jenis Perguruan Tinggi
        Route::get('/jenis-pt', [AdminJenisPtController::class, 'index'])->name('admin.jenis_pt.index');

        // Routes untuk Alumni
        Route::get('/alumni', [AdminAlumniController::class, 'index'])->name('admin.alumni.index');
        Route::post('/alumni', [AdminAlumniController::class, 'store'])->name('admin.alumni.store');
        Route::get('/alumni/{id}/edit', [AdminAlumniController::class, 'edit'])->name('admin.alumni.edit');
        Route::put('/alumni/{id}', [AdminAlumniController::class, 'update'])->name('admin.alumni.update');
        Route::delete('/alumni/{id}', [AdminAlumniController::class, 'destroy'])->name('admin.alumni.destroy');
        Route::post('/alumni/import', [AdminAlumniController::class, 'import'])->name('admin.alumni.import');
        Route::get('/alumni/download-format', [AdminAlumniController::class, 'downloadFormat'])->name('admin.alumni.downloadFormat');

        // Routes untuk Testimonials
        Route::get('/testimonials', [AdminTestimonialsController::class, 'index'])->name('admin.testimonials.index');
        Route::post('/testimonials', [AdminTestimonialsController::class, 'store'])->name('admin.testimonials.store');
        Route::post('/testimonials/{id}', [AdminTestimonialsController::class, 'update'])->name('admin.testimonials.update');
        Route::delete('/testimonials/{id}', [AdminTestimonialsController::class, 'destroy'])->name('admin.testimonials.destroy');

        Route::get('/kategori-berita', [AdminKategoriController::class, 'index'])->name('admin.kategori.index');
        Route::post('/kategori-berita', [AdminKategoriController::class, 'store'])->name('admin.kategori.store');
        Route::put('/kategori-berita/{id}', [AdminKategoriController::class, 'update'])->name('admin.kategori.update');
        Route::delete('/kategori-berita/{id}', [AdminKategoriController::class, 'destroy'])->name('admin.kategori.destroy');

        // Routes untuk Berita
        Route::get('/berita', [AdminBeritaController::class, 'index'])->name('admin.berita.index');
        Route::get('/berita/create', [AdminBeritaController::class, 'create'])->name('admin.berita.create');
        Route::post('/berita', [AdminBeritaController::class, 'store'])->name('admin.berita.store');
        Route::get('/berita/{berita}/edit', [AdminBeritaController::class, 'edit'])->name('admin.berita.edit');
        Route::post('/berita/{berita}', [AdminBeritaController::class, 'update'])->name('admin.berita.update');
        Route::delete('/berita/{berita}', [AdminBeritaController::class, 'destroy'])->name('admin.berita.destroy');
        Route::post('/upload-gambar-berita', [AdminBeritaController::class, 'uploadGambar'])->name('admin.berita.uploadGambar');

        // Routes untuk Komentar
        Route::get('/komentar', [AdminKomentarController::class, 'index'])->name('admin.komentar.index');
        Route::delete('/komentar/{id}', [AdminKomentarController::class, 'destroy'])->name('admin.komentar.destroy');

        // Routes untuk Tanggapan
        Route::get('/tanggapan', [AdminTanggapanController::class, 'index'])->name('admin.tanggapan.index');
        Route::post('/tanggapan', [AdminTanggapanController::class, 'store'])->name('admin.tanggapan.store');
        Route::put('/tanggapan/{id}', [AdminTanggapanController::class, 'update'])->name('admin.tanggapan.update');
        Route::delete('/tanggapan/{id}', [AdminTanggapanController::class, 'destroy'])->name('admin.tanggapan.destroy');

        // Tahun Pelajaran
        Route::get('/setting_sertifikat', [AdminSettingSertifikatController::class, 'index'])->name('admin.setting_sertifikat.index');
        Route::post('/setting_sertifikat', [AdminSettingSertifikatController::class, 'store'])->name('admin.setting_sertifikat.store');
        Route::post('/setting_sertifikat/{id}', [AdminSettingSertifikatController::class, 'update'])->name('admin.setting_sertifikat.update');
        Route::delete('/setting_sertifikat/{id}', [AdminSettingSertifikatController::class, 'destroy'])->name('admin.setting_sertifikat.destroy');

        //Profile Admin
        Route::get('/profile', [AdminProfileController::class, 'editProfile'])->name('admin.profile.edit');
        Route::post('/profile', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');
    });
});
