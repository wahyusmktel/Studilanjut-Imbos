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

<!-- Hero Profile Sesi (Desain Modern 2 Warna Elegan: Navy & Putih) -->
<div class="student-hero-card mb-4" style="background: linear-gradient(135deg, #1b3562 0%, #25477d 100%); border-radius: 16px; padding: 24px 28px; box-shadow: 0 10px 25px rgba(27, 53, 98, 0.12);">
    <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap: 20px;">
        <div class="d-flex align-items-center" style="gap: 20px;">
            <div style="width: 64px; height: 64px; border-radius: 16px; background: rgba(255, 255, 255, 0.15); display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255, 255, 255, 0.25); flex-shrink: 0;">
                <i class="fa-solid fa-users" style="color: #ffffff; font-size: 26px;"></i>
            </div>
            <div>
                <!-- Nama Tim: Putih Tebal & Bersih -->
                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                    <h2 style="color: #ffffff !important; font-size: 24px; font-weight: 800; margin: 0; letter-spacing: -0.3px;">
                        {{ $absensi->kelas->nama_kelas ?? 'Tim Bimbel' }}
                    </h2>
                    <span style="background: rgba(255, 255, 255, 0.2); color: #ffffff; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 700; border: 1px solid rgba(255, 255, 255, 0.3);">
                        Sesi Pertemuan
                    </span>
                </div>
                
                <!-- Metadata Sesi Bersih & Berjarak Rapi -->
                <div class="d-flex align-items-center flex-wrap" style="gap: 16px; color: #e2e8f0; font-size: 13px;">
                    <span style="display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa-regular fa-calendar text-white opacity-75"></i>
                        <strong>{{ \Carbon\Carbon::parse($absensi->tanggal)->isoFormat('dddd, D MMMM Y') }}</strong>
                    </span>
                    <span style="opacity: 0.4;">|</span>
                    <span style="display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa-regular fa-clock text-white opacity-75"></i>
                        {{ $absensi->waktu }} WIB
                    </span>
                    <span style="opacity: 0.4;">|</span>
                    <span style="display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa-solid fa-chalkboard-user text-white opacity-75"></i>
                        {{ $absensi->guru->nama ?? '-' }} ({{ $absensi->guru->mataPelajaran->namaMataPelajaran ?? '-' }})
                    </span>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center" style="gap: 10px;">
            <a href="{{ route('admin.rekap-absensi.export', $absensi->id) }}" class="btn-modern btn-modern-success" style="background: #10b981; color: #ffffff; border: none; padding: 10px 18px;" title="Export Data Kehadiran ke Excel">
                <i class="fa-solid fa-file-excel mr-1"></i>
                <span>Export Excel</span>
            </a>
            <a href="{{ route('admin.rekap-absensi.index') }}" class="btn-modern btn-modern-secondary" style="background: #ffffff; color: #1b3562; border: none; padding: 10px 18px;">
                <i class="fa-solid fa-arrow-left mr-1"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>
</div>

<!-- Kotak Evaluasi Khusus: Siswa yang Tidak Hadir (Sejajar, Tanpa Border Kiri Tebal, Radius Standar 12px, Margin Rapi) -->
<div class="row" style="margin-left: -12px; margin-right: -12px; margin-bottom: 24px;">
    <div class="col-12" style="padding-left: 12px; padding-right: 12px;">
        <div class="modern-card" style="border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 0;">
            <div class="modern-card-header d-flex justify-content-between align-items-center flex-wrap" style="padding: 16px 20px; background: #ffffff; border-bottom: 1px solid #f1f5f9; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <h4 class="font-weight-700 mb-0" style="font-size: 15px; color: {{ $tidakHadirTotal > 0 ? '#b91c1c' : '#15803d' }};">
                    @if($tidakHadirTotal > 0)
                        <i class="fa-solid fa-circle-exclamation mr-2"></i>Evaluasi: Ditemukan {{ $tidakHadirTotal }} Siswa Tidak Hadir pada Pertemuan Ini
                    @else
                        <i class="fa-solid fa-circle-check mr-2"></i>Evaluasi: Sempurna! Semua Siswa ({{ $hadirList->count() }} Orang) Hadir Lengkap
                    @endif
                </h4>
                <span class="text-muted small">Total Siswa di Tim Ini: <strong>{{ $details->count() }} Orang</strong></span>
            </div>
            <div class="modern-card-body" style="padding: 20px;">
                @if($tidakHadirTotal > 0)
                    <div class="row g-3">
                        <!-- Alpa -->
                        <div class="col-md-3 col-sm-6 mb-2">
                            <div class="p-3 rounded-2" style="background: #fef2f2; border: 1px solid #fee2e2; border-radius: 8px;">
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
                        <div class="col-md-3 col-sm-6 mb-2">
                            <div class="p-3 rounded-2" style="background: #fffbeb; border: 1px solid #fef3c7; border-radius: 8px;">
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
                        <div class="col-md-3 col-sm-6 mb-2">
                            <div class="p-3 rounded-2" style="background: #f0f9ff; border: 1px solid #e0f2fe; border-radius: 8px;">
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
                        <div class="col-md-3 col-sm-6 mb-2">
                            <div class="p-3 rounded-2" style="background: #eef2ff; border: 1px solid #e0e7ff; border-radius: 8px;">
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
                        <i class="fa-solid fa-circle-check fa-3x text-success mb-2"></i>
                        <p class="font-weight-600 text-success mb-0">Pertemuan ini dihadiri oleh seluruh siswa tanpa ada yang izin, sakit, maupun alpa.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-left: -12px; margin-right: -12px;">
    <!-- Kolom Kiri: Tabel Detail Seluruh Siswa dengan Filter Status -->
    <div class="col-lg-8 mb-4" style="padding-left: 12px; padding-right: 12px;">
        <div class="modern-table-card" style="border-radius: 12px;">
            <div class="modern-table-header d-flex justify-content-between align-items-center flex-wrap" style="background: #ffffff; padding: 16px 22px; gap: 12px;">
                <div>
                    <h4 class="font-weight-700 txt-dark mb-0" style="font-size: 16px;">
                        <i class="fa-solid fa-user-check color-primary mr-2"></i>Daftar Kehadiran Siswa
                    </h4>
                </div>
                <!-- Filter Status Kehadiran Siswa -->
                <div class="d-flex align-items-center" style="gap: 8px;">
                    <span class="small font-weight-600 text-muted">Filter:</span>
                    <select id="filterKehadiranSiswa" class="form-control form-control-sm" style="width: auto; height: 34px; border-radius: 6px;">
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
                            <tr>
                                <th width="50" class="text-center">No</th>
                                <th>Nama Lengkap Siswa</th>
                                <th class="text-center" width="160">Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $idx => $d)
                                <tr class="siswa-row" data-status="{{ $d->kehadiran }}" style="{{ in_array($d->kehadiran, [0, 2, 3, 4]) ? 'background-color: #fffaf0;' : '' }}">
                                    <td class="text-center font-weight-600 align-middle row-number">{{ $idx + 1 }}</td>
                                    <td class="align-middle">
                                        <span class="font-weight-700 text-dark" style="font-size: 14px;">
                                            {{ $d->siswa->nama_siswa ?? '-' }}
                                        </span>
                                        @if(in_array($d->kehadiran, [0, 2, 3, 4]))
                                            <span class="badge badge-warning text-dark ml-2 font-weight-600" style="font-size: 10px;">
                                                Evaluasi
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

    <!-- Kolom Kanan: Rincian Catatan & Foto Dokumentasi Sesi (Berjarak Rapi) -->
    <div class="col-lg-4 mb-4" style="padding-left: 12px; padding-right: 12px;">
        <!-- Card Materi & Catatan -->
        <div class="modern-card mb-4" style="border-radius: 12px; margin-bottom: 24px !important;">
            <div class="modern-card-header" style="background: #ffffff; padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
                <h4 class="modern-card-title mb-0" style="font-size: 15px;">
                    <i class="fa-solid fa-book-open color-primary mr-2"></i>Materi & Catatan Sesi
                </h4>
            </div>
            <div class="modern-card-body" style="padding: 20px;">
                <label class="font-weight-700 small text-muted text-uppercase mb-1">Mata Pelajaran</label>
                <p class="font-weight-600 text-dark mb-3">{{ $absensi->guru->mataPelajaran->namaMataPelajaran ?? '-' }}</p>

                <label class="font-weight-700 small text-muted text-uppercase mb-1">Guru Pengampu</label>
                <p class="font-weight-600 text-dark mb-3">{{ $absensi->guru->nama ?? '-' }}</p>

                <label class="font-weight-700 small text-muted text-uppercase mb-1">Materi / Catatan Guru</label>
                <div class="p-3 rounded-2 bg-light border text-dark font-weight-500" style="line-height: 1.6; border-radius: 8px;">
                    {{ $absensi->catatan ?: 'Tidak ada catatan khusus pada sesi ini.' }}
                </div>
            </div>
        </div>

        <!-- Card Foto Dokumentasi -->
        <div class="modern-card" style="border-radius: 12px;">
            <div class="modern-card-header" style="background: #ffffff; padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
                <h4 class="modern-card-title mb-0" style="font-size: 15px;">
                    <i class="fa-solid fa-camera color-primary mr-2"></i>Foto Bukti Sesi
                </h4>
            </div>
            <div class="modern-card-body text-center" style="padding: 20px;">
                @if($absensi->foto)
                    <div style="position: relative; overflow: hidden; border-radius: 10px; cursor: pointer;" id="triggerPhotoModal">
                        <img src="{{ asset('storage/' . $absensi->foto) }}" alt="Foto Dokumentasi Sesi" class="img-fluid rounded shadow-sm" style="max-height: 220px; width: 100%; object-fit: cover; transition: transform 0.3s ease;">
                        <div style="position: absolute; bottom: 8px; right: 8px; background: rgba(0,0,0,0.65); color: #fff; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600;">
                            <i class="fa-solid fa-magnifying-glass-plus mr-1"></i>Klik untuk Zoom
                        </div>
                    </div>
                @else
                    <div class="py-4 text-muted">
                        <i class="fa-regular fa-image fa-2x mb-2 d-block opacity-50"></i>
                        <span class="small">Tidak ada foto dokumentasi yang diupload</span>
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
