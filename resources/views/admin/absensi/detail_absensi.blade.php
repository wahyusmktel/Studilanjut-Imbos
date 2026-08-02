@extends('admin.layouts.app')

@section('title', 'Detail Absensi - ' . $siswa->nama_siswa)

@section('content')
<!-- Title Breadcrumb -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Detail Absensi - {{ $siswa->nama_siswa }}</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.absensi.index') }}">Data Absensi</a></li>
            <li class="active"><span>{{ $siswa->nama_siswa }}</span></li>
        </ol>
    </div>
</div>
<!-- /Title Breadcrumb -->

<!-- Student Profile Hero Card -->
<div class="student-hero-card" style="margin-bottom: 24px !important;">
    <div class="student-hero-profile">
        <div class="student-hero-avatar">
            {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
        </div>
        <div class="student-hero-info">
            <h2 class="student-hero-name">{{ $siswa->nama_siswa }}</h2>
            <div class="student-hero-meta">
                <span><i class="fa-solid fa-id-card mr-1"></i> NIS: {{ $siswa->nisn ?? '-' }}</span>
                <span class="badge-modern primary">
                    <i class="fa-solid fa-sitemap mr-1"></i>{{ $siswa->kelas ? $siswa->kelas->nama_kelas : 'Tidak Ditemukan' }}
                </span>
            </div>
        </div>
    </div>
    <div class="student-hero-actions">
        <a href="{{ route('admin.absensi.detail.export', ['id' => $siswa->id, 'start_date' => request('start_date'), 'end_date' => request('end_date'), 'mata_pelajaran_id' => request('mata_pelajaran_id')]) }}" class="btn-modern btn-modern-success">
            <i class="fa-solid fa-file-excel"></i>
            <span>Download Excel</span>
        </a>
        <a href="{{ route('admin.absensi.index') }}" class="btn-modern btn-modern-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>
</div>

<!-- Grid Row: Chart + Table -->
<div class="dashboard-grid" style="margin-bottom: 24px !important;">
    <!-- Smooth Modern Chart Card -->
    <div class="modern-card">
        <div class="modern-card-header">
            <h3 class="modern-card-title">
                <i class="fa-solid fa-chart-pie color-primary mr-2"></i>Ringkasan Kehadiran Siswa
            </h3>
        </div>
        <div class="modern-card-body">
            <div style="position: relative; height: 300px; width: 100%;">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Attendance Stats Cards -->
    <div class="d-flex flex-column gap-3" style="display: flex; flex-direction: column; gap: 16px;">
        <div class="stat-card gradient-2" style="border-radius: var(--radius-md); padding: 20px;">
            <div class="stat-card-content">
                <span class="stat-card-label" style="opacity: 0.9;">Total Hadir</span>
                <span class="stat-card-value" style="font-size: 32px; font-weight: 700;">{{ $absensiDetails->where('kehadiran', 1)->count() }}</span>
            </div>
            <div class="stat-card-icon" style="font-size: 32px; opacity: 0.8;">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <div class="stat-card gradient-4" style="border-radius: var(--radius-md); padding: 20px;">
            <div class="stat-card-content">
                <span class="stat-card-label" style="opacity: 0.9;">Total Tidak Hadir</span>
                <span class="stat-card-value" style="font-size: 32px; font-weight: 700;">{{ $absensiDetails->where('kehadiran', 0)->count() }}</span>
            </div>
            <div class="stat-card-icon" style="font-size: 32px; opacity: 0.8;">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
        </div>

        <div class="stat-card gradient-3" style="border-radius: var(--radius-md); padding: 20px;">
            <div class="stat-card-content">
                <span class="stat-card-label" style="opacity: 0.9;">Total Sakit</span>
                <span class="stat-card-value" style="font-size: 32px; font-weight: 700;">{{ $absensiDetails->where('kehadiran', 2)->count() }}</span>
            </div>
            <div class="stat-card-icon" style="font-size: 32px; opacity: 0.8;">
                <i class="fa-solid fa-user-doctor"></i>
            </div>
        </div>
    </div>
</div>

<!-- Table Records Card -->
<div class="modern-table-card">
    <!-- Filter Bar Flex Row -->
    <div style="padding: 20px 24px; background: #f8fafc; border-bottom: 1px solid var(--border-color);">
        <form method="GET" action="{{ route('admin.absensi.detail', $siswa->id) }}">
            <div style="display: flex; align-items: flex-end; gap: 16px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 160px;">
                    <label class="font-weight-600 small text-muted mb-1" style="display: block;">Mulai Tanggal</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div style="flex: 1; min-width: 160px;">
                    <label class="font-weight-600 small text-muted mb-1" style="display: block;">Sampai Tanggal</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div style="flex: 1.5; min-width: 200px;">
                    <label class="font-weight-600 small text-muted mb-1" style="display: block;">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id" class="form-control">
                        <option value="">-- Semua Mata Pelajaran --</option>
                        @foreach($mataPelajarans as $mp)
                            <option value="{{ $mp->id }}" {{ request('mata_pelajaran_id') == $mp->id ? 'selected' : '' }}>
                                {{ $mp->namaMataPelajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="flex: 0 0 auto;">
                    <button type="submit" class="btn-modern btn-modern-primary" style="height: 42px; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Cari</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50" class="text-center" style="white-space: nowrap;">No</th>
                        <th style="min-width: 170px; white-space: nowrap;">Mata Pelajaran</th>
                        <th style="min-width: 160px; white-space: nowrap;">Guru Pengajar</th>
                        <th class="text-center" style="min-width: 130px; white-space: nowrap;">Tanggal</th>
                        <th class="text-center" style="min-width: 110px; white-space: nowrap;">Waktu</th>
                        <th class="text-center" style="min-width: 130px; white-space: nowrap;">Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensiDetails as $index => $detail)
                        <tr>
                            <td class="text-center font-weight-600" style="white-space: nowrap; vertical-align: middle;">{{ $index + 1 }}</td>
                            <td style="white-space: nowrap; vertical-align: middle;">
                                <span class="font-weight-600 color-primary">
                                    {{ $detail->absensi->guru->mataPelajaran->namaMataPelajaran ?? '-' }}
                                </span>
                            </td>
                            <td style="white-space: nowrap; vertical-align: middle;">{{ $detail->absensi->guru->nama ?? '-' }}</td>
                            <td class="text-center font-weight-600" style="white-space: nowrap; vertical-align: middle;">
                                {{ \Carbon\Carbon::parse($detail->absensi->tanggal)->format('d-m-Y') }}
                            </td>
                            <td class="text-center text-muted" style="white-space: nowrap; vertical-align: middle;">{{ $detail->absensi->waktu }}</td>
                            <td class="text-center" style="white-space: nowrap; vertical-align: middle;">
                                @if($detail->kehadiran == 1)
                                    <span class="badge-modern success"><i class="fa-solid fa-circle-check mr-1"></i> Hadir</span>
                                @elseif($detail->kehadiran == 0)
                                    <span class="badge-modern danger"><i class="fa-solid fa-circle-xmark mr-1"></i> Tidak Hadir</span>
                                @elseif($detail->kehadiran == 2)
                                    <span class="badge-modern warning"><i class="fa-solid fa-user-doctor mr-1"></i> Sakit</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <div class="empty-state">
                                    <i class="fa-solid fa-calendar-xmark fa-2x mb-2"></i>
                                    <p>Belum ada rincian absensi untuk siswa ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modern Chart.js -->
<script>
(function() {
    function initAttendanceChart() {
        const canvas = document.getElementById('attendanceChart');
        if (!canvas) return;

        Chart.defaults.font.family = 'Inter, sans-serif';
        Chart.defaults.font.size = 13;
        Chart.defaults.color = '#64748b';

        const ctx = canvas.getContext('2d');
        
        // Create subtle gradient fills
        const gradientHadir = ctx.createLinearGradient(0, 0, 0, 300);
        gradientHadir.addColorStop(0, '#10b981');
        gradientHadir.addColorStop(1, '#059669');

        const gradientTidakHadir = ctx.createLinearGradient(0, 0, 0, 300);
        gradientTidakHadir.addColorStop(0, '#ef4444');
        gradientTidakHadir.addColorStop(1, '#dc2626');

        const gradientSakit = ctx.createLinearGradient(0, 0, 0, 300);
        gradientSakit.addColorStop(0, '#f59e0b');
        gradientSakit.addColorStop(1, '#d97706');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Hadir', 'Tidak Hadir', 'Sakit'],
                datasets: [{
                    label: 'Jumlah Kehadiran',
                    data: [
                        {{ $absensiDetails->where('kehadiran', 1)->count() }},
                        {{ $absensiDetails->where('kehadiran', 0)->count() }},
                        {{ $absensiDetails->where('kehadiran', 2)->count() }}
                    ],
                    backgroundColor: [gradientHadir, gradientTidakHadir, gradientSakit],
                    borderRadius: 10,
                    borderSkipped: false,
                    barThickness: 42
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1200,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: { family: 'Inter', size: 14, weight: '600' },
                        bodyFont: { family: 'Inter', size: 13 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAttendanceChart);
    } else {
        initAttendanceChart();
    }
})();
</script>

@if(session('success'))
<script>
    $(document).ready(function() {
        setTimeout(function() {
            swal({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                type: "success",
                confirmButtonText: "OK"
            });
        }, 800);
    });
</script>
@endif
@endsection
