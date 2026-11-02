@extends('admin.layouts.app')

@section('title', 'Rekap Sesi & Tim Bimbel')

@section('content')
<!-- Title Breadcrumb -->
<div class="row heading-bg">
    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
        <h5 class="txt-dark">Rekap Sesi & Tim Bimbel</h5>
    </div>
    <div class="col-lg-7 col-sm-6 col-md-7 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="#">Absensi</a></li>
            <li class="active"><span>Rekap Sesi & Tim Bimbel</span></li>
        </ol>
    </div>
</div>
<!-- /Title Breadcrumb -->

<!-- Filter Card -->
<div class="modern-card mb-5" style="margin-bottom: 28px !important;">
    <div class="modern-card-header">
        <h3 class="modern-card-title">
            <i class="fa-solid fa-filter color-primary mr-2"></i>Filter Sesi Pertemuan & Tim Bimbel
        </h3>
    </div>
    <div class="modern-card-body">
        <form method="GET" action="{{ route('admin.rekap-absensi.index') }}">
            <div class="row" style="display: flex; align-items: flex-end; flex-wrap: wrap; margin-left: -8px; margin-right: -8px;">
                <div class="col-md-3 col-sm-6" style="padding-left: 8px; padding-right: 8px; margin-bottom: 12px;">
                    <label class="font-weight-600 small text-muted mb-1 d-block" style="display: block;">Kelompok / Tim Bimbel</label>
                    <select name="kelas_id" class="form-control" style="height: 42px;">
                        <option value="">-- Semua Tim Bimbel --</option>
                        @foreach($kelases as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-6" style="padding-left: 8px; padding-right: 8px; margin-bottom: 12px;">
                    <label class="font-weight-600 small text-muted mb-1 d-block" style="display: block;">Status Kehadiran Sesi</label>
                    <select name="filter_status" class="form-control" style="height: 42px;">
                        <option value="">-- Semua Sesi --</option>
                        <option value="ada_tidak_hadir" {{ request('filter_status') == 'ada_tidak_hadir' ? 'selected' : '' }}>
                            Ada Siswa Tidak Hadir
                        </option>
                        <option value="hadir_semua" {{ request('filter_status') == 'hadir_semua' ? 'selected' : '' }}>
                            Hadir 100% (Semua Masuk)
                        </option>
                    </select>
                </div>
                <div class="col-md-2 col-sm-6" style="padding-left: 8px; padding-right: 8px; margin-bottom: 12px;">
                    <label class="font-weight-600 small text-muted mb-1 d-block" style="display: block;">Dari Tanggal</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" style="height: 42px;">
                </div>
                <div class="col-md-2 col-sm-6" style="padding-left: 8px; padding-right: 8px; margin-bottom: 12px;">
                    <label class="font-weight-600 small text-muted mb-1 d-block" style="display: block;">Sampai Tanggal</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" style="height: 42px;">
                </div>
                <div class="col-md-2 col-sm-12 d-flex" style="padding-left: 8px; padding-right: 8px; margin-bottom: 12px; gap: 8px;">
                    <button type="submit" class="btn-modern btn-modern-primary w-100" style="height: 42px; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Filter</span>
                    </button>
                    @if(request()->anyFilled(['kelas_id', 'filter_status', 'start_date', 'end_date']))
                        <a href="{{ route('admin.rekap-absensi.index') }}" class="btn-modern btn-modern-secondary" style="height: 42px; width: 44px; display: inline-flex; align-items: center; justify-content: center;" title="Reset Filter">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table Card -->
<div class="modern-table-card">
    <div class="modern-table-header" style="background: #ffffff; padding: 18px 24px;">
        <div>
            <h4 class="font-weight-700 txt-dark mb-1" style="font-size: 16px;">
                <i class="fa-solid fa-clipboard-list color-primary mr-2"></i>Daftar Sesi Bimbingan per Tim
            </h4>
            <span class="text-muted small">Klik tombol detail untuk melihat rincian evaluasi & daftar kehadiran siswa lengkap</span>
        </div>
    </div>

    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th style="min-width: 170px;">Tanggal & Waktu</th>
                        <th style="min-width: 180px;">Tim Bimbel / Kelas</th>
                        <th style="min-width: 150px;" class="text-center">Hadir / Tidak Hadir</th>
                        <th style="min-width: 200px;">Pengampu & Materi</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sesiAbsensis as $index => $sesi)
                        <tr>
                            <td class="text-center font-weight-600 align-middle">
                                {{ method_exists($sesiAbsensis, 'firstItem') && $sesiAbsensis->firstItem() ? $sesiAbsensis->firstItem() + $index : $index + 1 }}
                            </td>
                            <td class="align-middle">
                                <div class="font-weight-700 text-dark">
                                    <i class="fa-regular fa-calendar mr-1 color-primary"></i>
                                    {{ \Carbon\Carbon::parse($sesi->tanggal)->locale('id')->isoFormat('dddd, D MMM Y') }}
                                </div>
                                <div class="text-muted small">
                                    <i class="fa-regular fa-clock mr-1"></i>Pukul {{ $sesi->waktu }} WIB
                                </div>
                            </td>
                            <td class="align-middle">
                                <span class="badge-modern primary font-weight-700" style="font-size: 13px; padding: 6px 14px;">
                                    <i class="fa-solid fa-users mr-1"></i>{{ $sesi->kelas->nama_kelas ?? 'Tim Bimbel' }}
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                @php
                                    $hadir = $sesi->details->where('kehadiran', 1)->count();
                                    $tidakHadir = $sesi->details->whereIn('kehadiran', [0, 2, 3, 4])->count();
                                @endphp
                                <div style="display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                                    <!-- Hadir (Label Hijau Angka Saja) -->
                                    <span class="badge badge-pill font-weight-700" style="background-color: #dcfce7; color: #15803d; border: 1px solid #86efac; padding: 6px 12px; font-size: 13px; display: inline-flex; align-items: center; gap: 5px;" title="Hadir: {{ $hadir }} siswa">
                                        <i class="fa-solid fa-check" style="font-size: 11px;"></i>
                                        <span>{{ $hadir }}</span>
                                    </span>

                                    <!-- Tidak Hadir (Label Merah Angka Saja - Alpa, Sakit, Izin, Pulang) -->
                                    <span class="badge badge-pill font-weight-700" style="background-color: {{ $tidakHadir > 0 ? '#fee2e2' : '#f1f5f9' }}; color: {{ $tidakHadir > 0 ? '#b91c1c' : '#64748b' }}; border: 1px solid {{ $tidakHadir > 0 ? '#fca5a5' : '#e2e8f0' }}; padding: 6px 12px; font-size: 13px; display: inline-flex; align-items: center; gap: 5px;" title="Tidak Hadir (Alpa/Sakit/Izin/Pulang): {{ $tidakHadir }} siswa">
                                        <i class="fa-solid fa-xmark" style="font-size: 11px;"></i>
                                        <span>{{ $tidakHadir }}</span>
                                    </span>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="font-weight-600 text-dark">{{ $sesi->guru->nama ?? '-' }}</div>
                                <div class="text-muted small">
                                    <i class="fa-solid fa-book-bookmark mr-1 text-muted"></i>{{ $sesi->guru->mataPelajaran->namaMataPelajaran ?? '-' }}
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('admin.rekap-absensi.show', $sesi->id) }}" class="btn-modern btn-modern-primary btn-sm" style="padding: 7px 16px; font-size: 12px; display: inline-flex; align-items: center; gap: 6px;" title="Lihat Evaluasi & Rincian Kehadiran Siswa">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    <span>Detail Sesi</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <div class="empty-state">
                                    <i class="fa-solid fa-clipboard-question fa-3x mb-3 text-secondary"></i>
                                    <h6 class="font-weight-600">Tidak ada sesi bimbingan ditemukan</h6>
                                    <p class="small text-muted">Coba ubah kriteria filter kelompok atau rentang tanggal.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Table Footer / Pagination -->
    <div class="modern-table-header border-top" style="border-bottom: none; background: #fafafa;">
        <div class="text-muted small">
            @if(method_exists($sesiAbsensis, 'total'))
                Menampilkan {{ $sesiAbsensis->firstItem() ?? 0 }} - {{ $sesiAbsensis->lastItem() ?? 0 }} dari {{ $sesiAbsensis->total() }} sesi pertemuan
            @endif
        </div>
        <div>
            {{ $sesiAbsensis->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>
@endsection
