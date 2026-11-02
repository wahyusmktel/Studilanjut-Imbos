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
<div class="modern-card mb-4">
    <div class="modern-card-header">
        <h3 class="modern-card-title">
            <i class="fa-solid fa-filter color-primary mr-2"></i>Filter Sesi Pertemuan & Tim Bimbel
        </h3>
    </div>
    <div class="modern-card-body">
        <form method="GET" action="{{ route('admin.rekap-absensi.index') }}">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="font-weight-600 small text-muted mb-1">Kelompok / Tim Bimbel</label>
                    <select name="kelas_id" class="form-control">
                        <option value="">-- Semua Tim Bimbel --</option>
                        @foreach($kelases as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="font-weight-600 small text-muted mb-1">Status Kehadiran Sesi</label>
                    <select name="filter_status" class="form-control">
                        <option value="">-- Semua Sesi --</option>
                        <option value="ada_tidak_hadir" {{ request('filter_status') == 'ada_tidak_hadir' ? 'selected' : '' }}>
                            ⚠️ Ada Siswa Tidak Hadir (Alpa/Sakit/Izin/Pulang)
                        </option>
                        <option value="hadir_semua" {{ request('filter_status') == 'hadir_semua' ? 'selected' : '' }}>
                            ✅ Hadir 100% (Semua Masuk)
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="font-weight-600 small text-muted mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-2">
                    <label class="font-weight-600 small text-muted mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-2 d-flex align-items-end" style="gap: 8px;">
                    <button type="submit" class="btn-modern btn-modern-primary w-100" style="height: 42px; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Filter</span>
                    </button>
                    @if(request()->anyFilled(['kelas_id', 'filter_status', 'start_date', 'end_date']))
                        <a href="{{ route('admin.rekap-absensi.index') }}" class="btn-modern btn-modern-secondary" style="height: 42px; display: inline-flex; align-items: center;" title="Reset Filter">
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
            <span class="text-muted small">Klik pada sesi pertemuan untuk melihat rincian evaluasi & siswa yang tidak hadir</span>
        </div>
    </div>

    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th style="min-width: 140px;">Tanggal & Waktu</th>
                        <th style="min-width: 160px;">Tim Bimbel / Kelas</th>
                        <th style="min-width: 180px;">Pengampu & Materi</th>
                        <th style="min-width: 250px;" class="text-center">Rekap Kehadiran Siswa</th>
                        <th style="min-width: 110px;" class="text-center">Evaluasi</th>
                        <th width="100" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sesiAbsensis as $index => $sesi)
                        @php
                            $totalSiswa = $sesi->details->count();
                            $hadir = $sesi->details->where('kehadiran', 1)->count();
                            $alpa = $sesi->details->where('kehadiran', 0)->count();
                            $sakit = $sesi->details->where('kehadiran', 2)->count();
                            $izin = $sesi->details->where('kehadiran', 4)->count();
                            $pulang = $sesi->details->where('kehadiran', 3)->count();
                            $tidakHadir = $alpa + $sakit + $izin + $pulang;
                        @endphp
                        <tr>
                            <td class="text-center font-weight-600 align-middle">
                                {{ method_exists($sesiAbsensis, 'firstItem') && $sesiAbsensis->firstItem() ? $sesiAbsensis->firstItem() + $index : $index + 1 }}
                            </td>
                            <td class="align-middle">
                                <div class="font-weight-700 text-dark">
                                    <i class="fa-regular fa-calendar mr-1 text-primary"></i>
                                    {{ \Carbon\Carbon::parse($sesi->tanggal)->isoFormat('dddd, D MMM Y') }}
                                </div>
                                <div class="text-muted small">
                                    <i class="fa-regular fa-clock mr-1"></i>Pukul {{ $sesi->waktu }} WIB
                                </div>
                            </td>
                            <td class="align-middle">
                                <span class="badge-modern primary font-weight-700" style="font-size: 13px; padding: 6px 12px;">
                                    <i class="fa-solid fa-users mr-1"></i>{{ $sesi->kelas->nama_kelas ?? 'Tim Bimbel' }}
                                </span>
                            </td>
                            <td class="align-middle">
                                <div class="font-weight-600 text-dark">{{ $sesi->guru->nama ?? '-' }}</div>
                                <div class="text-muted small">
                                    <i class="fa-solid fa-book-bookmark mr-1 text-info"></i>{{ $sesi->guru->mataPelajaran->namaMataPelajaran ?? '-' }}
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                <div class="d-flex justify-content-center align-items-center flex-wrap" style="gap: 5px;">
                                    <span class="badge-modern success" title="Hadir: {{ $hadir }} siswa">
                                        <strong>{{ $hadir }}</strong> Hadir
                                    </span>
                                    @if($alpa > 0)
                                        <span class="badge-modern danger" title="Alpa: {{ $alpa }} siswa">
                                            <strong>{{ $alpa }}</strong> Alpa
                                        </span>
                                    @endif
                                    @if($sakit > 0)
                                        <span class="badge-modern warning" title="Sakit: {{ $sakit }} siswa">
                                            <strong>{{ $sakit }}</strong> Sakit
                                        </span>
                                    @endif
                                    @if($izin > 0)
                                        <span class="badge-modern primary" style="background: #e0f2fe; color: #0369a1;" title="Izin: {{ $izin }} siswa">
                                            <strong>{{ $izin }}</strong> Izin
                                        </span>
                                    @endif
                                    @if($pulang > 0)
                                        <span class="badge-modern info" title="Pulang: {{ $pulang }} siswa">
                                            <strong>{{ $pulang }}</strong> Pulang
                                        </span>
                                    @endif
                                    <span class="text-muted small ml-1">/ {{ $totalSiswa }} siswa</span>
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                @if($tidakHadir > 0)
                                    <span class="badge badge-pill badge-danger py-1 px-2 font-weight-600" style="background-color: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5;">
                                        <i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $tidakHadir }} Absen
                                    </span>
                                @else
                                    <span class="badge badge-pill badge-success py-1 px-2 font-weight-600" style="background-color: #dcfce7; color: #15803d; border: 1px solid #86efac;">
                                        <i class="fa-solid fa-check mr-1"></i>Lengkap
                                    </span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('admin.rekap-absensi.show', $sesi->id) }}" class="btn-modern btn-modern-primary btn-sm" style="padding: 6px 12px; font-size: 12px;" title="Lihat Evaluasi & Daftar Siswa">
                                    <i class="fa-solid fa-eye mr-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
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
