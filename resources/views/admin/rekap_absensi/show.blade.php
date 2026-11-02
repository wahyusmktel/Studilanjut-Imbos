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

<!-- Hero Profile Sesi -->
<div class="student-hero-card mb-4" style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%);">
    <div class="student-hero-profile">
        <div class="student-hero-avatar" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
            <i class="fa-solid fa-users" style="color: #ffffff; font-size: 26px;"></i>
        </div>
        <div class="student-hero-info">
            <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                <h2 class="student-hero-name" style="color: #ffffff; font-size: 22px; margin-bottom: 0;">
                    {{ $absensi->kelas->nama_kelas ?? 'Tim Bimbel' }}
                </h2>
                <span class="badge badge-pill badge-primary px-3 py-1 font-weight-700" style="background: #2563eb;">
                    <i class="fa-regular fa-calendar-check mr-1"></i>Sesi Bimbingan
                </span>
            </div>
            <div class="student-hero-meta" style="color: #cbd5e1;">
                <span><i class="fa-regular fa-calendar mr-1 text-info"></i>{{ \Carbon\Carbon::parse($absensi->tanggal)->isoFormat('dddd, D MMMM Y') }}</span>
                <span><i class="fa-regular fa-clock mr-1 text-info"></i>{{ $absensi->waktu }} WIB</span>
                <span><i class="fa-solid fa-user-tie mr-1 text-info"></i>{{ $absensi->guru->nama ?? '-' }} ({{ $absensi->guru->mataPelajaran->namaMataPelajaran ?? '-' }})</span>
            </div>
        </div>
    </div>
    <div class="student-hero-actions">
        <a href="{{ route('admin.rekap-absensi.index') }}" class="btn-modern btn-modern-secondary" style="background: #ffffff; color: #1e293b;">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar Sesi</span>
        </a>
    </div>
</div>

<!-- Kotak Evaluasi Khusus: Siswa yang Tidak Hadir -->
<div class="row mb-4">
    <div class="col-12">
        <div class="modern-card" style="border-left: 4px solid {{ $tidakHadirTotal > 0 ? '#ef4444' : '#10b981' }};">
            <div class="modern-card-header d-flex justify-content-between align-items-center flex-wrap" style="padding: 16px 20px;">
                <h4 class="font-weight-700 mb-0" style="font-size: 16px; color: {{ $tidakHadirTotal > 0 ? '#b91c1c' : '#15803d' }};">
                    @if($tidakHadirTotal > 0)
                        <i class="fa-solid fa-triangle-exclamation mr-2"></i>Evaluasi: Ditemukan {{ $tidakHadirTotal }} Siswa Tidak Hadir pada Pertemuan Ini
                    @else
                        <i class="fa-solid fa-circle-check mr-2"></i>Evaluasi: Sempurna! Semua Siswa ({{ $hadirList->count() }} Orang) Hadir Lengkap
                    @endif
                </h4>
                <span class="text-muted small">Total Siswa Terdaftar: <strong>{{ $details->count() }} Siswa</strong></span>
            </div>
            <div class="modern-card-body" style="padding: 20px;">
                @if($tidakHadirTotal > 0)
                    <div class="row g-3">
                        <!-- Alpa -->
                        <div class="col-md-3 col-sm-6">
                            <div class="p-3 rounded-3" style="background: #fef2f2; border: 1px solid #fee2e2;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="font-weight-700 text-danger small text-uppercase">
                                        <i class="fa-solid fa-circle-xmark mr-1"></i>Alpa / Tanpa Ket
                                    </span>
                                    <span class="badge badge-danger font-weight-700">{{ $alpaList->count() }}</span>
                                </div>
                                @if($alpaList->count() > 0)
                                    <ul class="list-unstyled mb-0 small" style="line-height: 1.8;">
                                        @foreach($alpaList as $item)
                                            <li class="font-weight-600 text-dark">
                                                • {{ $item->siswa->nama_siswa ?? 'Siswa' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted small italic">Nihil (Tidak ada)</span>
                                @endif
                            </div>
                        </div>

                        <!-- Sakit -->
                        <div class="col-md-3 col-sm-6">
                            <div class="p-3 rounded-3" style="background: #fffbeb; border: 1px solid #fef3c7;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="font-weight-700 small text-uppercase" style="color: #b45309;">
                                        <i class="fa-solid fa-user-doctor mr-1"></i>Sakit
                                    </span>
                                    <span class="badge badge-warning font-weight-700">{{ $sakitList->count() }}</span>
                                </div>
                                @if($sakitList->count() > 0)
                                    <ul class="list-unstyled mb-0 small" style="line-height: 1.8;">
                                        @foreach($sakitList as $item)
                                            <li class="font-weight-600 text-dark">
                                                • {{ $item->siswa->nama_siswa ?? 'Siswa' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted small italic">Nihil (Tidak ada)</span>
                                @endif
                            </div>
                        </div>

                        <!-- Izin -->
                        <div class="col-md-3 col-sm-6">
                            <div class="p-3 rounded-3" style="background: #f0f9ff; border: 1px solid #e0f2fe;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="font-weight-700 small text-uppercase" style="color: #0369a1;">
                                        <i class="fa-solid fa-envelope-open-text mr-1"></i>Izin
                                    </span>
                                    <span class="badge badge-info font-weight-700">{{ $izinList->count() }}</span>
                                </div>
                                @if($izinList->count() > 0)
                                    <ul class="list-unstyled mb-0 small" style="line-height: 1.8;">
                                        @foreach($izinList as $item)
                                            <li class="font-weight-600 text-dark">
                                                • {{ $item->siswa->nama_siswa ?? 'Siswa' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted small italic">Nihil (Tidak ada)</span>
                                @endif
                            </div>
                        </div>

                        <!-- Pulang -->
                        <div class="col-md-3 col-sm-6">
                            <div class="p-3 rounded-3" style="background: #eef2ff; border: 1px solid #e0e7ff;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="font-weight-700 small text-uppercase" style="color: #4338ca;">
                                        <i class="fa-solid fa-person-walking-arrow-right mr-1"></i>Pulang
                                    </span>
                                    <span class="badge font-weight-700" style="background: #6366f1; color: #fff;">{{ $pulangList->count() }}</span>
                                </div>
                                @if($pulangList->count() > 0)
                                    <ul class="list-unstyled mb-0 small" style="line-height: 1.8;">
                                        @foreach($pulangList as $item)
                                            <li class="font-weight-600 text-dark">
                                                • {{ $item->siswa->nama_siswa ?? 'Siswa' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted small italic">Nihil (Tidak ada)</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="fa-solid fa-award fa-3x text-success mb-2"></i>
                        <p class="font-weight-600 text-success mb-0">Pertemuan ini dihadiri oleh seluruh siswa tanpa ada yang izin, sakit, maupun alpa.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Kolom Kiri: Tabel Detail Seluruh Siswa -->
    <div class="col-lg-8 mb-4">
        <div class="modern-table-card">
            <div class="modern-table-header" style="background: #ffffff; padding: 18px 24px;">
                <h4 class="font-weight-700 txt-dark mb-0" style="font-size: 16px;">
                    <i class="fa-solid fa-user-check color-primary mr-2"></i>Daftar Kehadiran Siswa di Tim Ini
                </h4>
            </div>
            <div class="table-wrap">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="50" class="text-center">No</th>
                                <th>Nama Lengkap Siswa</th>
                                <th class="text-center" width="160">Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $idx => $d)
                                <tr style="{{ in_array($d->kehadiran, [0, 2, 3, 4]) ? 'background-color: #fffaf0;' : '' }}">
                                    <td class="text-center font-weight-600 align-middle">{{ $idx + 1 }}</td>
                                    <td class="align-middle">
                                        <span class="font-weight-700 text-dark" style="font-size: 14px;">
                                            {{ $d->siswa->nama_siswa ?? '-' }}
                                        </span>
                                        @if(in_array($d->kehadiran, [0, 2, 3, 4]))
                                            <span class="badge badge-warning text-dark ml-2 font-weight-600" style="font-size: 10px;">
                                                Perlu Evaluasi
                                            </span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Rincian Catatan & Foto Dokumentasi Sesi -->
    <div class="col-lg-4 mb-4">
        <!-- Card Materi & Catatan -->
        <div class="modern-card mb-4">
            <div class="modern-card-header">
                <h4 class="modern-card-title">
                    <i class="fa-solid fa-book-open color-primary mr-2"></i>Materi & Catatan Sesi
                </h4>
            </div>
            <div class="modern-card-body">
                <label class="font-weight-700 small text-muted text-uppercase mb-1">Mata Pelajaran</label>
                <p class="font-weight-600 text-dark mb-3">{{ $absensi->guru->mataPelajaran->namaMataPelajaran ?? '-' }}</p>

                <label class="font-weight-700 small text-muted text-uppercase mb-1">Guru Pengampu</label>
                <p class="font-weight-600 text-dark mb-3">{{ $absensi->guru->nama ?? '-' }}</p>

                <label class="font-weight-700 small text-muted text-uppercase mb-1">Materi / Catatan Guru</label>
                <div class="p-3 rounded-3 bg-light border text-dark font-weight-500" style="line-height: 1.6;">
                    {{ $absensi->catatan ?: 'Tidak ada catatan khusus pada sesi ini.' }}
                </div>
            </div>
        </div>

        <!-- Card Foto Dokumentasi -->
        <div class="modern-card">
            <div class="modern-card-header">
                <h4 class="modern-card-title">
                    <i class="fa-solid fa-camera color-primary mr-2"></i>Foto Bukti Sesi
                </h4>
            </div>
            <div class="modern-card-body text-center">
                @if($absensi->foto)
                    <img src="{{ asset('storage/' . $absensi->foto) }}" alt="Foto Dokumentasi Sesi" class="img-fluid rounded-3 shadow-sm mb-2" style="max-height: 240px; width: 100%; object-fit: cover; cursor: pointer;" onclick="window.open(this.src, '_blank')">
                    <span class="text-muted small d-block">Klik gambar untuk melihat resolusi penuh</span>
                @else
                    <div class="py-4 text-muted">
                        <i class="fa-regular fa-image fa-2x mb-2 d-block"></i>
                        <span class="small">Tidak ada foto dokumentasi yang diupload</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
