@extends('admin.layouts.app')

@section('title', 'Detail Evaluasi Sesi - ' . ($absensi->kelas->nama_kelas ?? 'Tim Bimbel'))

@section('content')
<!-- Title Breadcrumb -->
<div class="row heading-bg">
    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
        <h5 class="txt-dark">Detail Evaluasi Sesi Tim Bimbel</h5>
    </div>
    <div class="col-lg-7 col-sm-6 col-md-7 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.rekap-absensi.index') }}">Rekap Sesi & Tim Bimbel</a></li>
            <li class="active"><span>{{ $absensi->kelas->nama_kelas ?? 'Detail' }}</span></li>
        </ol>
    </div>
</div>
<!-- /Title Breadcrumb -->

<!-- Styling & Utility Classes khusus halaman ini -->
<style>
/* Utilities Spacing & Flexbox */
.mr-1 { margin-right: 4px !important; }
.mr-2 { margin-right: 8px !important; }
.mr-3 { margin-right: 12px !important; }
.ml-1 { margin-left: 4px !important; }
.ml-2 { margin-left: 8px !important; }
.mb-1 { margin-bottom: 4px !important; }
.mb-2 { margin-bottom: 8px !important; }
.mb-3 { margin-bottom: 12px !important; }
.mb-4 { margin-bottom: 16px !important; }
.d-flex { display: flex !important; }
.align-items-center { align-items: center !important; }
.justify-content-between { justify-content: space-between !important; }

/* Stat Wave Cards */
.stat-wave-card {
    position: relative;
    overflow: hidden;
    background: #ffffff;
    border-radius: 16px;
    padding: 22px 24px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
    transition: transform 0.45s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.45s cubic-bezier(0.25, 1, 0.5, 1), border-color 0.45s ease;
    z-index: 1;
    cursor: default;
    height: 100%;
}

/* Gelombang Pertama */
.stat-wave-card::before {
    content: '';
    position: absolute;
    top: 130%;
    left: 50%;
    width: 250%;
    height: 250%;
    border-radius: 40%;
    transform: translate(-50%, 0) rotate(0deg);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: -1;
    opacity: 0;
}

/* Gelombang Kedua (Lapisan Gelombang Air untuk kedalaman organik) */
.stat-wave-card::after {
    content: '';
    position: absolute;
    top: 140%;
    left: 45%;
    width: 260%;
    height: 260%;
    border-radius: 36%;
    transform: translate(-50%, 0) rotate(0deg);
    transition: all 1.0s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: -1;
    opacity: 0;
}

/* Tema Warna Gelombang */
/* 1. Navy / Indigo Wave */
.stat-wave-card.wave-primary::before {
    background: linear-gradient(135deg, #1b3562 0%, #312e81 100%);
}
.stat-wave-card.wave-primary::after {
    background: linear-gradient(135deg, #2563eb 0%, #4338ca 100%);
}

/* 2. Emerald Green Wave */
.stat-wave-card.wave-success::before {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
}
.stat-wave-card.wave-success::after {
    background: linear-gradient(135deg, #10b981 0%, #0d9488 100%);
}

/* 3. Rose Red Wave */
.stat-wave-card.wave-danger::before {
    background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
}
.stat-wave-card.wave-danger::after {
    background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
}

/* 4. Sky Blue Wave */
.stat-wave-card.wave-info::before {
    background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
}
.stat-wave-card.wave-info::after {
    background: linear-gradient(135deg, #38bdf8 0%, #2563eb 100%);
}

/* Saat Cursor Diarahkan (Hover) */
.stat-wave-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 32px rgba(15, 23, 42, 0.14);
    border-color: transparent;
}

.stat-wave-card:hover::before {
    top: -65%;
    transform: translate(-50%, -20%) rotate(180deg);
    opacity: 1;
}

.stat-wave-card:hover::after {
    top: -75%;
    transform: translate(-50%, -20%) rotate(360deg);
    opacity: 0.85;
}

/* Layout Komponen Stat */
.stat-wave-card .stat-label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    color: #64748b;
    margin-bottom: 12px;
    transition: color 0.4s ease;
}

.stat-wave-card .stat-body {
    display: flex !important;
    align-items: center !important;
    gap: 16px;
    margin-bottom: 10px;
}

.stat-wave-card .stat-icon-box {
    width: 52px;
    height: 52px;
    min-width: 52px;
    border-radius: 14px;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 22px;
    transition: all 0.45s ease;
    flex-shrink: 0;
}

.stat-wave-card .stat-num-wrap {
    display: flex !important;
    flex-direction: column !important;
}

.stat-wave-card .stat-value {
    font-size: 32px;
    font-weight: 800;
    line-height: 1;
    color: #1e293b;
    transition: color 0.4s ease;
}

.stat-wave-card .stat-unit {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #64748b;
    margin-top: 3px;
    transition: color 0.4s ease;
}

.stat-wave-card .stat-subtext {
    font-size: 12px;
    color: #64748b;
    line-height: 1.4;
    transition: color 0.4s ease;
}

/* Hover effects */
.stat-wave-card:hover .stat-icon-box {
    background: rgba(255, 255, 255, 0.22) !important;
    color: #ffffff !important;
    transform: scale(1.08) rotate(4deg);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.stat-wave-card:hover .stat-value,
.stat-wave-card:hover .stat-label,
.stat-wave-card:hover .stat-unit {
    color: #ffffff !important;
}

.stat-wave-card:hover .stat-subtext {
    color: rgba(255, 255, 255, 0.85) !important;
}
</style>

<!-- Hero Profile Sesi: Nama Tim di Kiri, Tombol Aksi di Sebelah Kanan -->
<div class="student-hero-card mb-4" style="background: linear-gradient(135deg, #1b3562 0%, #25477d 100%) !important; border-radius: 16px; padding: 22px 28px; box-shadow: 0 10px 25px rgba(27, 53, 98, 0.12); display: flex !important; justify-content: space-between !important; align-items: center !important; flex-wrap: wrap !important; gap: 16px;">
    <!-- Kiri: Hanya Nama Tim / Kelompok -->
    <div class="student-hero-profile" style="display: flex !important; align-items: center !important; gap: 16px;">
        <div class="student-hero-avatar" style="width: 52px; height: 52px; min-width: 52px; border-radius: 14px; background: rgba(255, 255, 255, 0.15) !important; display: flex !important; align-items: center !important; justify-content: center !important; border: 1px solid rgba(255, 255, 255, 0.25);">
            <i class="fa-solid fa-users" style="color: #ffffff; font-size: 22px;"></i>
        </div>
        <div class="student-hero-info" style="display: flex !important; flex-direction: column !important; gap: 4px;">
            <span style="color: rgba(255, 255, 255, 0.75); font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; display: block;">
                Kelompok / Tim Bimbel
            </span>
            <h2 class="student-hero-name" style="color: #ffffff !important; font-size: 24px !important; font-weight: 800 !important; margin: 0 !important; line-height: 1.2 !important; letter-spacing: -0.3px;">
                {{ $absensi->kelas->nama_kelas ?? 'Tim Bimbel' }}
            </h2>
        </div>
    </div>

    <!-- Kanan: Tombol Export Excel & Kembali -->
    <div class="student-hero-actions" style="display: flex !important; align-items: center !important; gap: 12px; margin-left: auto;">
        <a href="{{ route('admin.rekap-absensi.export', $absensi->id) }}" class="btn-modern btn-modern-success" style="background: #10b981; color: #ffffff; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 13px; display: inline-flex !important; align-items: center !important; gap: 8px; text-decoration: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);" title="Export Data Kehadiran ke Excel">
            <i class="fa-solid fa-file-excel mr-1"></i>
            <span>Export Excel</span>
        </a>
        <a href="{{ route('admin.rekap-absensi.index') }}" class="btn-modern btn-modern-secondary" style="background: #ffffff; color: #1b3562; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 13px; display: inline-flex !important; align-items: center !important; gap: 8px; text-decoration: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);">
            <i class="fa-solid fa-arrow-left mr-1"></i>
            <span>Kembali</span>
        </a>
    </div>
</div>

<!-- Widget Statistik Angka dengan Efek Gelombang Warna yang Smooth saat Hover (Angka di Kanan Icon) -->
@php
    $persentase = $details->count() > 0 ? round(($hadirList->count() / $details->count()) * 100) : 0;
@endphp
<div class="row" style="margin-left: -10px; margin-right: -10px; margin-bottom: 24px;">
    <!-- Card 1: Total Siswa Tim -->
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="padding-left: 10px; padding-right: 10px; margin-bottom: 16px;">
        <div class="stat-wave-card wave-primary">
            <span class="stat-label">Total Siswa Tim</span>
            <div class="stat-body">
                <div class="stat-icon-box" style="background: #eef2ff; color: #1b3562;">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="stat-num-wrap">
                    <div class="stat-value">{{ $details->count() }}</div>
                    <div class="stat-unit">Siswa</div>
                </div>
            </div>
            <div class="stat-subtext">Anggota terdaftar di tim ini</div>
        </div>
    </div>

    <!-- Card 2: Siswa Hadir -->
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="padding-left: 10px; padding-right: 10px; margin-bottom: 16px;">
        <div class="stat-wave-card wave-success">
            <span class="stat-label" style="color: #059669;">Siswa Hadir</span>
            <div class="stat-body">
                <div class="stat-icon-box" style="background: #ecfdf5; color: #059669;">
                    <i class="fa-solid fa-user-check"></i>
                </div>
                <div class="stat-num-wrap">
                    <div class="stat-value">{{ $hadirList->count() }}</div>
                    <div class="stat-unit">Siswa</div>
                </div>
            </div>
            <div class="stat-subtext">Mengikuti sesi bimbingan</div>
        </div>
    </div>

    <!-- Card 3: Tidak Hadir (Absen) -->
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="padding-left: 10px; padding-right: 10px; margin-bottom: 16px;">
        <div class="stat-wave-card wave-danger">
            <span class="stat-label" style="color: #e11d48;">Tidak Hadir (Absen)</span>
            <div class="stat-body">
                <div class="stat-icon-box" style="background: #fff1f2; color: #e11d48;">
                    <i class="fa-solid fa-user-xmark"></i>
                </div>
                <div class="stat-num-wrap">
                    <div class="stat-value">{{ $tidakHadirTotal }}</div>
                    <div class="stat-unit">Siswa</div>
                </div>
            </div>
            <div class="stat-subtext">
                @if($tidakHadirTotal > 0)
                    {{ $alpaList->count() }} Alpa · {{ $sakitList->count() }} Sakit · {{ $izinList->count() + $pulangList->count() }} Izin/P
                @else
                    Nihil · Semua siswa hadir lengkap
                @endif
            </div>
        </div>
    </div>

    <!-- Card 4: Tingkat Kehadiran -->
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="padding-left: 10px; padding-right: 10px; margin-bottom: 16px;">
        <div class="stat-wave-card wave-info">
            <span class="stat-label" style="color: #0284c7;">Tingkat Kehadiran</span>
            <div class="stat-body">
                <div class="stat-icon-box" style="background: #f0f9ff; color: #0284c7;">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
                <div class="stat-num-wrap">
                    <div class="stat-value">{{ $persentase }}%</div>
                    <div class="stat-unit">Kehadiran</div>
                </div>
            </div>
            <div class="stat-subtext">
                @if($persentase == 100)
                    Sempurna (100% masuk)
                @elseif($persentase >= 80)
                    Kategori Baik (≥ 80%)
                @else
                    Perlu perhatian & evaluasi
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-left: -12px; margin-right: -12px;">
    <!-- Kolom Kiri: Tabel Detail Seluruh Siswa dengan Filter Status -->
    <div class="col-md-8 col-sm-12 col-xs-12" style="padding-left: 12px; padding-right: 12px; margin-bottom: 24px;">
        <div class="modern-table-card" style="border-radius: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 16px rgba(0,0,0,0.03); background: #ffffff; overflow: hidden;">
            <div class="modern-table-header" style="background: #ffffff; padding: 18px 24px; border-bottom: 1px solid #e2e8f0; display: flex !important; justify-content: space-between !important; align-items: center !important; flex-wrap: wrap !important; gap: 12px;">
                <div>
                    <h4 class="font-weight-700 txt-dark mb-0" style="font-size: 16px; margin: 0; display: flex !important; align-items: center !important; gap: 8px;">
                        <i class="fa-solid fa-user-check color-primary mr-1"></i>
                        <span>Daftar Kehadiran Siswa</span>
                    </h4>
                </div>
                <!-- Filter Status Kehadiran Siswa -->
                <div style="display: flex !important; align-items: center !important; gap: 8px;">
                    <span class="small font-weight-600 text-muted">Filter:</span>
                    <select id="filterKehadiranSiswa" class="form-control input-sm" style="width: auto; height: 36px; border-radius: 8px; font-weight: 600;">
                        <option value="all">Semua Status ({{ $details->count() }})</option>
                        <option value="1">Hadir ({{ $hadirList->count() }})</option>
                        <option value="0">Alpa ({{ $alpaList->count() }})</option>
                        <option value="2">Sakit ({{ $sakitList->count() }})</option>
                        <option value="4">Izin ({{ $izinList->count() }})</option>
                        <option value="3">Pulang ({{ $pulangList->count() }})</option>
                    </select>
                </div>
            </div>
            <div class="table-wrap">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="tableSiswaAttendance">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th width="50" class="text-center" style="padding: 14px 16px;">No</th>
                                <th style="padding: 14px 16px;">Nama Lengkap Siswa</th>
                                <th class="text-center" width="180" style="padding: 14px 16px;">Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $idx => $d)
                                <tr class="siswa-row" data-status="{{ $d->kehadiran }}" style="{{ in_array($d->kehadiran, [0, 2, 3, 4]) ? 'background-color: #fffaf0;' : '' }}">
                                    <td class="text-center font-weight-600 align-middle row-number" style="padding: 14px 16px;">{{ $idx + 1 }}</td>
                                    <td class="align-middle" style="padding: 14px 16px;">
                                        <span class="font-weight-700 text-dark" style="font-size: 14px;">
                                            {{ $d->siswa->nama_siswa ?? '-' }}
                                        </span>
                                        @if(in_array($d->kehadiran, [0, 2, 3, 4]))
                                            <span class="badge badge-warning text-dark ml-2 font-weight-600" style="font-size: 10px; padding: 3px 8px; border-radius: 4px;">
                                                Evaluasi
                                            </span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center" style="padding: 14px 16px;">
                                        @if($d->kehadiran == 1)
                                            <span class="badge-modern success"><i class="fa-solid fa-circle-check mr-1"></i> Hadir</span>
                                        @elseif($d->kehadiran == 0)
                                            <span class="badge-modern danger"><i class="fa-solid fa-circle-xmark mr-1"></i> Alpa</span>
                                        @elseif($d->kehadiran == 2)
                                            <span class="badge-modern warning"><i class="fa-solid fa-user-doctor mr-1"></i> Sakit</span>
                                        @elseif($d->kehadiran == 4)
                                            <span class="badge-modern primary" style="background: #e0f2fe; color: #0369a1;"><i class="fa-solid fa-envelope-open-text mr-1"></i> Izin</span>
                                        @elseif($d->kehadiran == 3)
                                            <span class="badge-modern info"><i class="fa-solid fa-person-walking-arrow-right mr-1"></i> Pulang</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr id="emptyFilterRow" style="display: none;">
                                <td colspan="3" class="text-center py-4 text-muted">
                                    Tidak ada siswa dengan status kehadiran yang dipilih.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Rincian Catatan & Foto Dokumentasi Sesi -->
    <div class="col-md-4 col-sm-12 col-xs-12" style="padding-left: 12px; padding-right: 12px; margin-bottom: 24px;">
        <!-- Card Materi & Catatan (Berjarak Luas, Rapi, Margin Nyaman) -->
        <div class="modern-card" style="border-radius: 14px; margin-bottom: 24px !important; border: 1px solid #e2e8f0; box-shadow: 0 4px 16px rgba(0,0,0,0.03); background: #ffffff;">
            <div class="modern-card-header" style="background: #ffffff; padding: 18px 24px; border-bottom: 1px solid #e2e8f0; display: flex !important; align-items: center !important;">
                <h4 class="modern-card-title" style="margin: 0; font-size: 16px; font-weight: 700; color: #1b3562; display: flex !important; align-items: center !important; gap: 8px;">
                    <i class="fa-solid fa-book-open mr-2" style="color: #1b3562;"></i>
                    <span>Materi & Catatan Sesi</span>
                </h4>
            </div>
            <div class="modern-card-body" style="padding: 24px;">
                <!-- Informasi Sesi Pertemuan (Tanggal & Waktu) -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px 20px; margin-bottom: 20px;">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #1b3562; margin-bottom: 10px; display: flex !important; align-items: center !important; gap: 6px;">
                        <i class="fa-regular fa-calendar-check mr-1" style="color: #2563eb;"></i>
                        <span>Sesi Pertemuan</span>
                    </div>
                    <div style="display: flex !important; align-items: center !important; gap: 8px; margin-bottom: 6px; font-size: 13px; color: #1e293b;">
                        <i class="fa-regular fa-calendar text-muted mr-1"></i>
                        <strong style="font-weight: 700;">{{ \Carbon\Carbon::parse($absensi->tanggal)->locale('id')->isoFormat('dddd, D MMMM Y') }}</strong>
                    </div>
                    <div style="display: flex !important; align-items: center !important; gap: 8px; font-size: 13px; color: #1e293b;">
                        <i class="fa-regular fa-clock text-muted mr-1"></i>
                        <span>{{ $absensi->waktu }} WIB</span>
                    </div>
                </div>

                <!-- Detail Mata Pelajaran & Pengampu -->
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px 20px; margin-bottom: 20px;">
                    <div style="margin-bottom: 14px;">
                        <span style="display: block; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b; margin-bottom: 4px;">
                            <i class="fa-solid fa-book-bookmark mr-1 text-muted"></i>Mata Pelajaran
                        </span>
                        <div style="font-size: 14px; font-weight: 700; color: #1e293b;">
                            {{ $absensi->guru->mataPelajaran->namaMataPelajaran ?? '-' }}
                        </div>
                    </div>
                    <div style="border-top: 1px dashed #e2e8f0; padding-top: 12px;">
                        <span style="display: block; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b; margin-bottom: 4px;">
                            <i class="fa-solid fa-chalkboard-user mr-1 text-muted"></i>Guru Pengampu
                        </span>
                        <div style="font-size: 14px; font-weight: 700; color: #1e293b;">
                            {{ $absensi->guru->nama ?? '-' }}
                        </div>
                    </div>
                </div>

                <!-- Materi / Catatan Guru -->
                <div>
                    <span style="display: block; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b; margin-bottom: 8px;">
                        <i class="fa-solid fa-pen-to-square mr-1 text-muted"></i>Materi / Catatan Guru
                    </span>
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 18px; font-size: 13px; color: #334155; line-height: 1.6; min-height: 60px;">
                        {{ $absensi->catatan ?: 'Tidak ada catatan khusus pada sesi ini.' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Foto Dokumentasi -->
        <div class="modern-card" style="border-radius: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 16px rgba(0,0,0,0.03); background: #ffffff;">
            <div class="modern-card-header" style="background: #ffffff; padding: 18px 24px; border-bottom: 1px solid #e2e8f0; display: flex !important; align-items: center !important;">
                <h4 class="modern-card-title" style="margin: 0; font-size: 16px; font-weight: 700; color: #1b3562; display: flex !important; align-items: center !important; gap: 8px;">
                    <i class="fa-solid fa-camera mr-2" style="color: #1b3562;"></i>
                    <span>Foto Bukti Sesi</span>
                </h4>
            </div>
            <div class="modern-card-body text-center" style="padding: 24px;">
                @if($absensi->foto)
                    <div style="position: relative; overflow: hidden; border-radius: 12px; cursor: pointer; border: 1px solid #e2e8f0;" id="triggerPhotoModal">
                        <img src="{{ asset('storage/' . $absensi->foto) }}" alt="Foto Dokumentasi Sesi" class="img-fluid rounded shadow-sm" style="max-height: 220px; width: 100%; object-fit: cover; transition: transform 0.3s ease;">
                        <div style="position: absolute; bottom: 8px; right: 8px; background: rgba(0,0,0,0.65); color: #fff; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600;">
                            <i class="fa-solid fa-magnifying-glass-plus mr-1"></i>Klik untuk Zoom
                        </div>
                    </div>
                @else
                    <div class="py-4 text-muted" style="padding: 30px 0;">
                        <i class="fa-regular fa-image fa-2x mb-2 d-block opacity-50" style="font-size: 36px; margin-bottom: 10px;"></i>
                        <span class="small font-weight-600">Tidak ada foto dokumentasi yang diupload</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Zoom Foto Dokumentasi -->
@if($absensi->foto)
<div class="modal fade" id="photoZoomModal" tabindex="-1" role="dialog" aria-labelledby="photoZoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header bg-primary text-white" style="padding: 16px 22px;">
                <h5 class="modal-title text-white font-weight-700" id="photoZoomModalLabel">
                    <i class="fa-solid fa-camera mr-2"></i>Foto Bukti Sesi Bimbingan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center p-3" style="background: #0f172a;">
                <img src="{{ asset('storage/' . $absensi->foto) }}" class="img-fluid rounded shadow" alt="Foto Dokumentasi Sesi Zoom" style="max-height: 80vh; object-fit: contain;">
            </div>
            <div class="modal-footer bg-light" style="padding: 12px 20px;">
                <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Tutup</button>
                <a href="{{ asset('storage/' . $absensi->foto) }}" download class="btn-modern btn-modern-primary">
                    <i class="fa-solid fa-download mr-1"></i>Download Foto
                </a>
            </div>
        </div>
    </div>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Photo Zoom Modal Trigger
    var triggerPhoto = document.getElementById('triggerPhotoModal');
    if (triggerPhoto) {
        triggerPhoto.addEventListener('click', function() {
            $('#photoZoomModal').modal('show');
        });
    }

    // 2. Client-side Filter Status Kehadiran Siswa
    var filterSelect = document.getElementById('filterKehadiranSiswa');
    if (filterSelect) {
        filterSelect.addEventListener('change', function() {
            var selectedValue = this.value;
            var rows = document.querySelectorAll('#tableSiswaAttendance tbody tr.siswa-row');
            var emptyRow = document.getElementById('emptyFilterRow');
            var visibleCount = 0;

            rows.forEach(function(row) {
                var rowStatus = row.getAttribute('data-status');
                if (selectedValue === 'all' || rowStatus === selectedValue) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Update row numbers for visible items
            var curNum = 1;
            rows.forEach(function(row) {
                if (row.style.display !== 'none') {
                    var numCell = row.querySelector('.row-number');
                    if (numCell) {
                        numCell.textContent = curNum++;
                    }
                }
            });

            if (emptyRow) {
                emptyRow.style.display = visibleCount === 0 ? '' : 'none';
            }
        });
    }
});
</script>
@endsection
