@extends('layouts.app')

@section('title', 'Absensi Guru - Studi Lanjut IMBOS Pringsewu')

@section('content')

<style>
    /* Modern Styling for Absensi Guru Page */
    .absensi-hero-section {
        position: relative;
        padding: 110px 0 60px 0;
        background: linear-gradient(135deg, #1b3562 0%, #25477d 60%, #0d9488 100%);
        overflow: hidden;
        color: #ffffff;
    }

    .absensi-hero-section .hero-waves {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 55px;
        z-index: 5;
    }

    /* Teacher Profile Cover Box */
    .teacher-profile-card {
        background: #ffffff;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.06);
        border: 1px solid #e2e8f0;
        margin-bottom: 30px;
    }

    .teacher-cover-banner {
        height: 240px;
        background: linear-gradient(135deg, #1e3a8a 0%, #0284c7 50%, #0d9488 100%);
        position: relative;
    }

    .teacher-profile-body {
        padding: 0 35px 28px 35px;
        position: relative;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }

    .teacher-avatar-wrapper {
        margin-top: -65px;
        display: flex;
        align-items: flex-end;
        gap: 22px;
    }

    /* Interactive Avatar Container with Hover Overlay */
    .teacher-avatar-container {
        position: relative;
        width: 130px;
        height: 130px;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
        border: 4px solid #ffffff;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        background: #ffffff;
        flex-shrink: 0;
    }

    .teacher-avatar-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .teacher-avatar-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.65);
        color: #ffffff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .teacher-avatar-container:hover .teacher-avatar-overlay {
        opacity: 1;
    }

    .teacher-avatar-container:hover img {
        transform: scale(1.08);
    }

    .teacher-details {
        padding-top: 68px;
    }

    .teacher-details h2 {
        font-size: 1.55rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 4px;
        line-height: 1.3;
    }

    .teacher-subject-tag {
        font-size: 0.9rem;
        font-weight: 700;
        color: #0284c7;
        background: #e0f2fe;
        padding: 4px 16px;
        border-radius: 50px;
        display: inline-block;
    }

    /* Main Absensi Card */
    .absensi-main-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.06);
        border: 1px solid #e2e8f0;
    }

    .absensi-card-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f1f5f9;
    }

    .absensi-card-title i {
        color: #25477d;
        font-size: 1.4rem;
    }

    .form-group-custom {
        margin-bottom: 20px;
    }

    .form-group-custom label {
        font-size: 0.875rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
        display: block;
    }

    .form-control-custom {
        border-radius: 12px;
        border: 1px solid #cbd5e1;
        padding: 12px 16px;
        font-size: 0.95rem;
        font-weight: 500;
        color: #1e293b;
        transition: all 0.25s ease;
    }

    .form-control-custom:focus {
        border-color: #25477d;
        box-shadow: 0 0 0 3px rgba(37, 71, 125, 0.12);
    }

    .form-control-custom[readonly] {
        background-color: #f8fafc;
        color: #64748b;
    }

    /* Drag and Drop Upload Box */
    .drag-drop-area {
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 24px 16px;
        text-align: center;
        background: #ffffff;
        cursor: pointer;
        transition: all 0.25s ease;
        position: relative;
    }

    .drag-drop-area:hover, .drag-drop-area.dragover {
        border-color: #25477d;
        background: #f0f7ff;
    }

    .drag-drop-icon {
        font-size: 2.2rem;
        color: #25477d;
        margin-bottom: 6px;
        display: inline-block;
    }

    .drag-drop-preview img {
        max-height: 180px;
        max-width: 100%;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.1);
        object-fit: cover;
    }

    /* Radio Status Pills for Attendance */
    .attendance-pills {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .attendance-pills input[type="radio"] {
        display: none;
    }

    .attendance-pill-label {
        font-size: 0.78rem;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 50px;
        cursor: pointer;
        border: 1px solid #cbd5e1;
        background: #f8fafc;
        color: #64748b;
        transition: all 0.2s ease;
        user-select: none;
    }

    .attendance-pills input[value="1"]:checked + label {
        background: #dcfce7;
        color: #15803d;
        border-color: #86efac;
    }

    .attendance-pills input[value="0"]:checked + label {
        background: #fee2e2;
        color: #b91c1c;
        border-color: #fca5a5;
    }

    .attendance-pills input[value="2"]:checked + label {
        background: #fef3c7;
        color: #b45309;
        border-color: #fde047;
    }

    .btn-imbos-submit {
        background: linear-gradient(135deg, #25477d 0%, #1e3a8a 100%);
        color: #ffffff;
        font-weight: 800;
        font-size: 1rem;
        padding: 14px 28px;
        border-radius: 50px;
        border: none;
        box-shadow: 0 8px 20px rgba(37, 71, 125, 0.3);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .btn-imbos-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(37, 71, 125, 0.45);
        color: #ffffff;
    }

    .attendance-table-wrapper {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
    }

    .table-attendance {
        margin-bottom: 0;
    }

    .table-attendance thead {
        background: #f8fafc;
    }

    .table-attendance th {
        font-size: 0.85rem;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 16px;
        border-bottom: 2px solid #e2e8f0;
    }

    .table-attendance td {
        padding: 12px 16px;
        vertical-align: middle;
        font-size: 0.9rem;
    }

    @media (max-width: 991px) {
        .absensi-hero-section {
            padding: 90px 0 40px 0;
        }
        .teacher-cover-banner {
            height: 180px;
        }
        .teacher-profile-body {
            align-items: center;
            text-align: center;
            justify-content: center;
        }
        .teacher-avatar-wrapper {
            flex-direction: column;
            align-items: center;
            margin-top: -65px;
        }
    }
</style>

<!-- Hero Section -->
<section id="hero" class="absensi-hero-section">
    @include('includes.menu_mobile_app')

    <div class="container">
        <div class="text-center text-white" data-aos="fade-down">
            <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-bold mb-2 shadow-sm">
                <i class="bi bi-calendar-check-fill me-1"></i> Portal Absensi Guru
            </span>
            <h1 class="fw-extrabold fs-2" style="color: #ffffff;">Absensi & Bimbingan Studi Lanjut</h1>
        </div>
    </div>

    <!-- Wave Divider -->
    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none">
        <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
        </defs>
        <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)"></use>
        </g>
        <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)"></use>
        </g>
        <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9" fill="#f8fafc"></use>
        </g>
    </svg>
</section>

<!-- Main Absensi Section -->
<section id="guru" class="py-4 bg-light">
    <div class="container">

        <!-- Teacher Profile Header Card -->
        <div class="teacher-profile-card" data-aos="fade-up">
            @if ($guru->foto_sampul)
                <div class="teacher-cover-banner" style="background-image: url('{{ asset('storage/foto_sampul_guru/' . $guru->foto_sampul) }}'); background-size: cover; background-position: center;"></div>
            @else
                <div class="teacher-cover-banner" style="background-image: url('{{ asset('halaman_umum/assets/img/timeline 800x150.jpg') }}'); background-size: cover; background-position: center;"></div>
            @endif
            <div class="teacher-profile-body">
                <div class="teacher-avatar-wrapper">
                    <!-- Interactive Avatar Hover Overlay for Upload Foto Profil -->
                    <div class="teacher-avatar-container" data-bs-toggle="modal" data-bs-target="#uploadFotoProfilModal" title="Klik untuk ganti foto profil">
                        @if ($guru->foto)
                            <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama }}">
                        @else
                            <img src="{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}" alt="{{ $guru->nama }}">
                        @endif
                        <div class="teacher-avatar-overlay">
                            <i class="bi bi-camera-fill fs-5 mb-1"></i>
                            <span>Ganti Foto</span>
                        </div>
                    </div>

                    <div class="teacher-details">
                        <h2>{{ $guru->nama }}</h2>
                        <span class="teacher-subject-tag">
                            <i class="bi bi-book-half me-1"></i> Pengampu {{ $guru->mataPelajaran->namaMataPelajaran }}
                        </span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2 fw-bold fs-7">
                        <i class="bi bi-circle-fill text-success me-1 fs-8"></i> Pengampu Aktif
                    </span>
                    <button class="btn btn-outline-primary rounded-pill btn-sm px-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#uploadFotoSampulModal">
                        <i class="bi bi-image me-1"></i> Foto Sampul
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Ganti Foto Profil -->
        <div class="modal fade no-fixed-backdrop" id="uploadFotoProfilModal" tabindex="-1" aria-labelledby="uploadFotoProfilModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title fw-bold" id="uploadFotoProfilModalLabel">Ganti Foto Profil Guru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('guru.uploadFotoProfil') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pilih Foto Profil Baru</label>
                                <div class="drag-drop-area" id="dragDropAvatarArea">
                                    <input type="file" class="d-none" id="foto_profil_input" name="foto" accept="image/*" required>
                                    
                                    <div class="drag-drop-content" id="dragDropAvatarContent">
                                        <i class="bi bi-person-bounding-box drag-drop-icon"></i>
                                        <h6 class="fw-bold mb-1 text-dark">Tarik & Lepas Foto Profil di Sini</h6>
                                        <p class="text-muted small mb-2">atau klik area ini untuk memilih foto profil</p>
                                        <span class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">Pilih Foto Profil</span>
                                    </div>

                                    <div class="drag-drop-preview" id="dragDropAvatarPreview" style="display: none;">
                                        <img id="previewAvatarImg" src="#" alt="Preview Profil" class="rounded-circle shadow-sm" style="width: 130px; height: 130px; object-fit: cover;">
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" id="btnRemoveAvatarPreview">
                                                <i class="bi bi-trash-fill me-1"></i> Hapus Foto
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Simpan Foto Profil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Ganti Foto Sampul -->
        <div class="modal fade no-fixed-backdrop" id="uploadFotoSampulModal" tabindex="-1" aria-labelledby="uploadFotoSampulModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title fw-bold" id="uploadFotoSampulModalLabel">Ganti Foto Sampul</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('guru.uploadFotoSampul') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pilih Foto Sampul Baru</label>
                                <div class="drag-drop-area" id="dragDropCoverArea">
                                    <input type="file" class="d-none" id="foto_sampul" name="foto_sampul" accept="image/*" required>
                                    
                                    <div class="drag-drop-content" id="dragDropCoverContent">
                                        <i class="bi bi-cloud-arrow-up-fill drag-drop-icon"></i>
                                        <h6 class="fw-bold mb-1 text-dark">Tarik & Lepas Foto Sampul di Sini</h6>
                                        <p class="text-muted small mb-2">atau klik area ini untuk memilih foto sampul</p>
                                        <span class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">Pilih Foto Sampul</span>
                                    </div>

                                    <div class="drag-drop-preview" id="dragDropCoverPreview" style="display: none;">
                                        <img id="preview" src="#" alt="Preview Sampul" class="rounded-3 img-fluid shadow-sm" style="max-height: 200px; width: 100%; object-fit: cover;">
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" id="btnRemoveCoverPreview">
                                                <i class="bi bi-trash-fill me-1"></i> Hapus Foto Sampul
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Simpan Sampul</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Absensi Form Card -->
        <div class="absensi-main-card" data-aos="fade-up" data-aos-delay="100">
            <h3 class="absensi-card-title">
                <i class="bi bi-journal-check"></i>
                Formulir Absensi Perkembangan Bimbingan Siswa
            </h3>

            <div class="alert alert-info border-0 rounded-4 bg-info-subtle text-info-emphasis d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-info-circle-fill fs-5 flex-shrink-0"></i>
                <div>Silakan lengkapi sesi pertemuan dan tandai status kehadiran siswa di bawah ini dengan benar.</div>
            </div>

            <form id="absensiForm" action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row gy-4">
                    <!-- Left Column: Session Metadata -->
                    <div class="col-lg-5">
                        <div class="bg-light p-4 rounded-4 border">
                            <h5 class="fw-bold text-dark mb-3 fs-6">Detail Sesi Pertemuan</h5>

                            <div class="form-group-custom">
                                <label><i class="bi bi-calendar-event me-1"></i> Tanggal Pertemuan</label>
                                <input type="date" name="tanggal" class="form-control form-control-custom" required>
                            </div>

                            <div class="form-group-custom">
                                <label><i class="bi bi-clock me-1"></i> Jadwal Waktu</label>
                                <select name="waktu" id="waktu" class="form-select form-control-custom" required>
                                    <option value="">-- Pilih Waktu Bimbingan --</option>
                                    <option value="13.20-14.25">13.20-14.25</option>
                                    <option value="16.15-17.20">16.15-17.20</option>
                                </select>
                            </div>

                            <div class="form-group-custom">
                                <label><i class="bi bi-person-fill me-1"></i> Nama Guru</label>
                                <input type="text" name="nama_guru" value="{{ $guru->nama }}" class="form-control form-control-custom" readonly>
                            </div>

                            <div class="form-group-custom">
                                <label><i class="bi bi-book-fill me-1"></i> Materi Bimbingan</label>
                                <input type="text" value="{{ $guru->mataPelajaran->namaMataPelajaran }}" class="form-control form-control-custom" readonly>
                            </div>

                            <div class="form-group-custom">
                                <label><i class="bi bi-people-fill me-1"></i> Kelompok / Kelas</label>
                                <select name="kelas_id" id="kelas_id" class="form-select form-control-custom" required>
                                    <option value="">-- Pilih Kelompok Belajar --</option>
                                    @foreach ($kelases as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group-custom">
                                <label><i class="bi bi-pencil-square me-1"></i> Materi Yang Dipelajari</label>
                                <textarea name="catatan" class="form-control form-control-custom" rows="3" placeholder="Tuliskan materi yang dipelajari..." required></textarea>
                            </div>

                            <!-- Drag and Drop Upload Foto Dokumentasi -->
                            <div class="form-group-custom mb-4">
                                <label><i class="bi bi-camera-fill me-1"></i> Upload Foto Dokumentasi</label>
                                <div class="drag-drop-area" id="dragDropArea">
                                    <input type="file" name="foto" id="fotoInput" class="d-none" accept="image/*">
                                    
                                    <div class="drag-drop-content" id="dragDropContent">
                                        <i class="bi bi-cloud-arrow-up-fill drag-drop-icon"></i>
                                        <h6 class="fw-bold mb-1 text-dark">Tarik & Lepas Foto di Sini</h6>
                                        <p class="text-muted small mb-2">atau klik area ini untuk memilih foto</p>
                                        <span class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">Pilih File Foto</span>
                                    </div>

                                    <div class="drag-drop-preview" id="dragDropPreview" style="display: none;">
                                        <img id="fotoPreviewImg" src="#" alt="Preview Dokumentasi">
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" id="btnRemovePreview">
                                                <i class="bi bi-trash-fill me-1"></i> Hapus Foto
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn-imbos-submit w-100 justify-content-center">
                                <i class="bi bi-save-fill"></i>
                                <span>SIMPAN DATA ABSENSI</span>
                            </button>
                        </div>
                    </div>

                    <!-- Right Column: Student Attendance Table -->
                    <div class="col-lg-7">
                        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                            <h5 class="fw-bold text-dark mb-0 fs-6">
                                <i class="bi bi-person-check-fill text-primary me-1"></i>
                                Daftar Kehadiran Siswa
                            </h5>
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#addSiswaModal">
                                <i class="bi bi-plus-lg me-1"></i> Siswa Luar Kelompok
                            </button>
                        </div>

                        <div class="attendance-table-wrapper">
                            <table class="table table-attendance align-middle">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th>Nama Siswa</th>
                                        <th style="width: 250px;">Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody id="siswa-table-body">
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted">
                                            <i class="bi bi-arrow-left-circle fs-3 d-block mb-2 text-secondary"></i>
                                            Silakan pilih <strong>Kelompok / Kelas</strong> terlebih dahulu di sebelah kiri
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal Tambah Siswa -->
                        <div class="modal fade" id="addSiswaModal" tabindex="-1" aria-labelledby="addSiswaModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4 border-0 shadow">
                                    <div class="modal-header border-bottom-0">
                                        <h5 class="modal-title fw-bold" id="addSiswaModalLabel">Tambah Siswa Luar Kelompok</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="siswa_select" class="form-label fw-semibold">Pilih Nama Siswa:</label>
                                        <select id="siswa_select" class="form-select rounded-3">
                                            <option value="">-- Cari / Pilih Siswa --</option>
                                            @foreach ($allSiswa as $siswa)
                                                <option value="{{ $siswa->id }}">{{ $siswa->nama_siswa }} - {{ $siswa->kelas?->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer border-top-0">
                                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-primary rounded-pill px-4 fw-bold" id="addSiswaButton">Tambahkan Siswa</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>

    </div>
</section>

<!-- SweetAlert2 & Dynamic Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Drag and Drop Upload Dokumentasi Logic
        const dragDropArea = document.getElementById('dragDropArea');
        const fotoInput = document.getElementById('fotoInput');
        const dragDropContent = document.getElementById('dragDropContent');
        const dragDropPreview = document.getElementById('dragDropPreview');
        const fotoPreviewImg = document.getElementById('fotoPreviewImg');
        const btnRemovePreview = document.getElementById('btnRemovePreview');

        if (dragDropArea && fotoInput) {
            dragDropArea.addEventListener('click', function(e) {
                if (btnRemovePreview && (e.target === btnRemovePreview || btnRemovePreview.contains(e.target))) {
                    return;
                }
                fotoInput.click();
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                dragDropArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dragDropArea.classList.add('dragover');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dragDropArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dragDropArea.classList.remove('dragover');
                }, false);
            });

            dragDropArea.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files && files.length > 0) {
                    fotoInput.files = files;
                    handleFotoPreview(files[0]);
                }
            });

            fotoInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    handleFotoPreview(this.files[0]);
                }
            });

            if (btnRemovePreview) {
                btnRemovePreview.addEventListener('click', function(e) {
                    e.stopPropagation();
                    fotoInput.value = '';
                    fotoPreviewImg.src = '#';
                    dragDropPreview.style.display = 'none';
                    dragDropContent.style.display = 'block';
                });
            }
        }

        function handleFotoPreview(file) {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    fotoPreviewImg.src = e.target.result;
                    dragDropContent.style.display = 'none';
                    dragDropPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        // Drag and Drop Upload Foto Profil Avatar Logic
        const dragDropAvatarArea = document.getElementById('dragDropAvatarArea');
        const fotoProfilInput = document.getElementById('foto_profil_input');
        const dragDropAvatarContent = document.getElementById('dragDropAvatarContent');
        const dragDropAvatarPreview = document.getElementById('dragDropAvatarPreview');
        const previewAvatarImg = document.getElementById('previewAvatarImg');
        const btnRemoveAvatarPreview = document.getElementById('btnRemoveAvatarPreview');

        if (dragDropAvatarArea && fotoProfilInput) {
            dragDropAvatarArea.addEventListener('click', function(e) {
                if (btnRemoveAvatarPreview && (e.target === btnRemoveAvatarPreview || btnRemoveAvatarPreview.contains(e.target))) {
                    return;
                }
                fotoProfilInput.click();
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                dragDropAvatarArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dragDropAvatarArea.classList.add('dragover');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dragDropAvatarArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dragDropAvatarArea.classList.remove('dragover');
                }, false);
            });

            dragDropAvatarArea.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files && files.length > 0) {
                    fotoProfilInput.files = files;
                    handleAvatarPreview(files[0]);
                }
            });

            fotoProfilInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    handleAvatarPreview(this.files[0]);
                }
            });

            if (btnRemoveAvatarPreview) {
                btnRemoveAvatarPreview.addEventListener('click', function(e) {
                    e.stopPropagation();
                    fotoProfilInput.value = '';
                    previewAvatarImg.src = '#';
                    dragDropAvatarPreview.style.display = 'none';
                    dragDropAvatarContent.style.display = 'block';
                });
            }
        }

        function handleAvatarPreview(file) {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewAvatarImg.src = e.target.result;
                    dragDropAvatarContent.style.display = 'none';
                    dragDropAvatarPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        // Drag and Drop Upload Foto Sampul Logic
        const dragDropCoverArea = document.getElementById('dragDropCoverArea');
        const fotoSampulInput = document.getElementById('foto_sampul');
        const dragDropCoverContent = document.getElementById('dragDropCoverContent');
        const dragDropCoverPreview = document.getElementById('dragDropCoverPreview');
        const coverPreviewImg = document.getElementById('preview');
        const btnRemoveCoverPreview = document.getElementById('btnRemoveCoverPreview');

        if (dragDropCoverArea && fotoSampulInput) {
            dragDropCoverArea.addEventListener('click', function(e) {
                if (btnRemoveCoverPreview && (e.target === btnRemoveCoverPreview || btnRemoveCoverPreview.contains(e.target))) {
                    return;
                }
                fotoSampulInput.click();
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                dragDropCoverArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dragDropCoverArea.classList.add('dragover');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dragDropCoverArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dragDropCoverArea.classList.remove('dragover');
                }, false);
            });

            dragDropCoverArea.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files && files.length > 0) {
                    fotoSampulInput.files = files;
                    handleCoverPreview(files[0]);
                }
            });

            fotoSampulInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    handleCoverPreview(this.files[0]);
                }
            });

            if (btnRemoveCoverPreview) {
                btnRemoveCoverPreview.addEventListener('click', function(e) {
                    e.stopPropagation();
                    fotoSampulInput.value = '';
                    coverPreviewImg.src = '#';
                    dragDropCoverPreview.style.display = 'none';
                    dragDropCoverContent.style.display = 'block';
                });
            }
        }

        function handleCoverPreview(file) {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    coverPreviewImg.src = e.target.result;
                    dragDropCoverContent.style.display = 'none';
                    dragDropCoverPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        // Fetch Siswa berdasarkan Kelompok
        const kelasSelect = document.getElementById('kelas_id');
        const tbody = document.getElementById('siswa-table-body');

        if (kelasSelect) {
            kelasSelect.addEventListener('change', function() {
                var kelasId = this.value;

                if (kelasId) {
                    fetch(`/absensi/get-siswa?kelas_id=${kelasId}`)
                        .then(response => response.json())
                        .then(data => {
                            tbody.innerHTML = '';
                            if (data.length > 0) {
                                data.forEach((siswa, index) => {
                                    var tr = document.createElement('tr');
                                    tr.innerHTML = `
                                    <td class="fw-bold text-secondary">${index + 1}</td>
                                    <td><span class="fw-bold text-dark">${siswa.nama_siswa}</span></td>
                                    <td>
                                        <div class="attendance-pills">
                                            <input type="hidden" name="siswa_id[]" value="${siswa.id}">
                                            
                                            <input type="radio" id="hadir${index}" name="kehadiran[${siswa.id}]" value="1" required>
                                            <label for="hadir${index}" class="attendance-pill-label">Hadir</label>

                                            <input type="radio" id="tidak_hadir${index}" name="kehadiran[${siswa.id}]" value="0" required>
                                            <label for="tidak_hadir${index}" class="attendance-pill-label">Alpa</label>

                                            <input type="radio" id="sakit${index}" name="kehadiran[${siswa.id}]" value="2" required>
                                            <label for="sakit${index}" class="attendance-pill-label">Sakit</label>
                                        </div>
                                    </td>
                                `;
                                    tbody.appendChild(tr);
                                });
                            } else {
                                var tr = document.createElement('tr');
                                tr.innerHTML = '<td colspan="3" class="text-center py-4 text-muted">Tidak ada siswa terdaftar dalam kelompok ini</td>';
                                tbody.appendChild(tr);
                            }
                        });
                } else {
                    tbody.innerHTML = '<tr><td colspan="3" class="text-center py-5 text-muted"><i class="bi bi-arrow-left-circle fs-3 d-block mb-2 text-secondary"></i>Silakan pilih <strong>Kelompok / Kelas</strong> terlebih dahulu di sebelah kiri</td></tr>';
                }
            });
        }

        // Tambah Siswa Manually Modal Button
        const addSiswaBtn = document.getElementById('addSiswaButton');
        if (addSiswaBtn) {
            addSiswaBtn.addEventListener('click', function() {
                var siswaSelect = document.getElementById('siswa_select');
                var siswaId = siswaSelect.value;
                var siswaText = siswaSelect.options[siswaSelect.selectedIndex].text;

                if (siswaId) {
                    var existingRow = document.querySelector(`input[value="${siswaId}"]`);
                    if (existingRow) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Siswa Sudah Ada',
                            text: 'Siswa tersebut sudah berada dalam daftar kehadiran.',
                            confirmButtonColor: '#25477d'
                        });
                        return;
                    }

                    var index = tbody.querySelectorAll('tr').length + 1;
                    var tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="fw-bold text-secondary">${index}</td>
                        <td><span class="fw-bold text-dark">${siswaText.split(' - ')[0]}</span></td>
                        <td>
                            <div class="attendance-pills">
                                <input type="hidden" name="siswa_id[]" value="${siswaId}">
                                
                                <input type="radio" id="hadir${index}" name="kehadiran[${siswaId}]" value="1" required>
                                <label for="hadir${index}" class="attendance-pill-label">Hadir</label>

                                <input type="radio" id="tidak_hadir${index}" name="kehadiran[${siswaId}]" value="0" required>
                                <label for="tidak_hadir${index}" class="attendance-pill-label">Alpa</label>

                                <input type="radio" id="sakit${index}" name="kehadiran[${siswaId}]" value="2" required>
                                <label for="sakit${index}" class="attendance-pill-label">Sakit</label>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(tr);

                    var modalEl = document.getElementById('addSiswaModal');
                    var modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) {
                        modal.hide();
                    }
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Silakan pilih siswa terlebih dahulu.',
                        confirmButtonColor: '#25477d'
                    });
                }
            });
        }

        // Form Submit Validation
        const absensiForm = document.getElementById('absensiForm');
        if (absensiForm) {
            absensiForm.addEventListener('submit', function(event) {
                var radioGroups = document.querySelectorAll('#siswa-table-body .attendance-pills');
                var allChecked = true;

                if (radioGroups.length === 0) {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Daftar Siswa Kosong',
                        text: 'Silakan pilih kelompok belajar untuk menampilkan siswa sebelum menyimpan.',
                        confirmButtonColor: '#25477d'
                    });
                    return;
                }

                radioGroups.forEach(function(group) {
                    var radios = group.querySelectorAll('input[type="radio"]');
                    var checked = Array.from(radios).some(function(radio) {
                        return radio.checked;
                    });
                    if (!checked) {
                        allChecked = false;
                    }
                });

                if (!allChecked) {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Kehadiran Belum Lengkap',
                        text: 'Silahkan isikan status kehadiran seluruh siswa sebelum menyimpan data.',
                        confirmButtonColor: '#25477d'
                    });
                }
            });
        }
    });
</script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '{{ session('success') }}',
            confirmButtonColor: '#25477d'
        });
    </script>
@endif

@endsection
