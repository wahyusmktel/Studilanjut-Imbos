@extends('admin.layouts.app')

@section('title', 'Data Absensi Guru')

@section('content')
<!-- Title Breadcrumb -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Data Absensi Guru</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="#">Absensi</a></li>
            <li class="active"><span>Data Absensi Guru</span></li>
        </ol>
    </div>
</div>
<!-- /Title Breadcrumb -->

<!-- Main Table Card -->
<div class="modern-table-card mb-4">
    <!-- Header Controls: Excel Export -->
    <div class="modern-table-header">
        <div class="modern-table-actions">
            <button id="export-button" class="btn-modern btn-modern-success">
                <i class="fa-solid fa-file-excel"></i>
                <span>Download Excel</span>
            </button>
        </div>
    </div>

    <!-- Filter Bar Flex Row -->
    <div style="padding: 20px 24px; background: #f8fafc; border-bottom: 1px solid var(--border-color);">
        <form method="GET" action="{{ route('admin.absensi-guru.index') }}">
            <div style="display: flex; align-items: flex-end; gap: 16px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 160px;">
                    <label class="font-weight-600 small text-muted mb-1" style="display: block;">Mulai Tanggal</label>
                    <input type="date" id="start_date" name="start_date" class="form-control"
                        value="{{ request('start_date') }}" required>
                </div>
                <div style="flex: 1; min-width: 160px;">
                    <label class="font-weight-600 small text-muted mb-1" style="display: block;">Sampai Tanggal</label>
                    <input type="date" id="end_date" name="end_date" class="form-control"
                        value="{{ request('end_date') }}" required>
                </div>
                <div style="flex: 1.5; min-width: 200px;">
                    <label class="font-weight-600 small text-muted mb-1" style="display: block;">Pilih Guru</label>
                    <select name="guru_id" class="form-control">
                        <option value="">-- Semua Guru --</option>
                        @foreach ($gurus as $guru)
                            <option value="{{ $guru->id }}" {{ request('guru_id') == $guru->id ? 'selected' : '' }}>
                                {{ $guru->nama }}
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
                        <th style="min-width: 170px; white-space: nowrap;">Nama Guru</th>
                        <th style="min-width: 160px; white-space: nowrap;">Mata Pelajaran</th>
                        <th style="min-width: 140px; white-space: nowrap;">Kelompok / Kelas</th>
                        <th class="text-center" style="min-width: 130px; white-space: nowrap;">Tanggal</th>
                        <th class="text-center" style="min-width: 110px; white-space: nowrap;">Waktu</th>
                        <th width="100" class="text-center" style="white-space: nowrap;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($absensis as $index => $absensi)
                        <tr>
                            <td class="text-center font-weight-600" style="white-space: nowrap; vertical-align: middle;">{{ $absensis->firstItem() + $index }}</td>
                            <td style="white-space: nowrap; vertical-align: middle;">
                                <span class="font-weight-600 color-primary">{{ $absensi->guru->nama ?? '-' }}</span>
                            </td>
                            <td style="white-space: nowrap; vertical-align: middle;">{{ $absensi->guru->mataPelajaran->namaMataPelajaran ?? '-' }}</td>
                            <td style="white-space: nowrap; vertical-align: middle;">
                                <span class="badge-modern primary">
                                    {{ $absensi->kelas->nama_kelas ?? '-' }}
                                </span>
                            </td>
                            <td class="text-center font-weight-600" style="white-space: nowrap; vertical-align: middle;">
                                {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}
                            </td>
                            <td class="text-center text-muted" style="white-space: nowrap; vertical-align: middle;">{{ $absensi->waktu }}</td>
                            <td class="text-center" style="white-space: nowrap; vertical-align: middle;">
                                <div class="action-btn-group justify-content-center">
                                    <a href="{{ route('admin.absensi-guru.show', $absensi->id) }}"
                                        class="btn-action btn-action-edit" data-toggle="tooltip" title="Lihat Detail Absensi">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn-action btn-action-delete delete-absensi"
                                        data-id="{{ $absensi->id }}" data-toggle="tooltip" title="Hapus Data Absensi">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <div class="empty-state">
                                    <i class="fa-solid fa-chalkboard-user fa-2x mb-2"></i>
                                    <p>Belum ada data absensi guru yang ditemukan.</p>
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
            @if(method_exists($absensis, 'total'))
                Menampilkan {{ $absensis->firstItem() ?? 0 }} - {{ $absensis->lastItem() ?? 0 }} dari {{ $absensis->total() }} data
            @endif
        </div>
        <div>
            {{ $absensis->appends(['start_date' => request('start_date'), 'end_date' => request('end_date'), 'guru_id' => request('guru_id')])->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>

<!-- Modern Chart Card: Attendance per Month -->
<div class="modern-card">
    <div class="modern-card-header">
        <h3 class="modern-card-title">
            <i class="fa-solid fa-chart-line color-primary mr-2"></i>Grafik Kehadiran Guru per Bulan
        </h3>
    </div>
    <div class="modern-card-body">
        <div style="position: relative; height: 320px; width: 100%;">
            <canvas id="attendanceChart"></canvas>
        </div>
    </div>
</div>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Export button handler
    const exportBtn = document.getElementById('export-button');
    if (exportBtn) {
        exportBtn.addEventListener('click', function() {
            var startDate = document.getElementById('start_date').value;
            var endDate = document.getElementById('end_date').value;
            var guruId = document.querySelector('select[name="guru_id"]').value;

            if (!startDate || !endDate) {
                swal({
                    title: "Peringatan!",
                    text: "Silakan pilih rentang tanggal awal dan akhir terlebih dahulu.",
                    type: "warning",
                    confirmButtonText: "OK"
                });
            } else {
                var url = "{{ route('admin.absensi-guru.export') }}?start_date=" + startDate + "&end_date=" +
                    endDate + "&guru_id=" + guruId;
                window.location.href = url;
            }
        });
    }

    // Delete absensi confirm
    $('.delete-absensi').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: "Apakah Anda yakin?",
            text: "Menghapus data absensi ini akan menghapus seluruh catatan kehadiran siswa pada sesi ini!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ef4444",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
            closeOnConfirm: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '{{ url('admin/absensi') }}/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        swal({
                            title: "Dihapus!",
                            text: "Data absensi berhasil dihapus.",
                            type: "success",
                            confirmButtonText: "OK"
                        }, function() {
                            location.reload();
                        });
                    },
                    error: function() {
                        swal("Gagal!", "Terjadi kesalahan saat menghapus data.", "error");
                    }
                });
            }
        });
    });

    // Chart.js Modern Smooth Gradient Line Chart
    function initGuruChart() {
        Chart.defaults.font.family = 'Inter, sans-serif';
        Chart.defaults.font.size = 13;
        Chart.defaults.color = '#64748b';

        var attendanceData = @json($attendanceChartData);
        const canvas = document.getElementById('attendanceChart');
        if (canvas && attendanceData && attendanceData.labels) {
            const ctx = canvas.getContext('2d');
            
            var gradient = ctx.createLinearGradient(0, 0, 0, 320);
            gradient.addColorStop(0, 'rgba(99, 102, 241, 0.35)');
            gradient.addColorStop(1, 'rgba(99, 102, 241, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: attendanceData.labels,
                    datasets: [{
                        label: 'Jumlah Sesi Kehadiran',
                        data: attendanceData.data,
                        backgroundColor: gradient,
                        borderColor: '#6366f1',
                        borderWidth: 3,
                        pointBackgroundColor: '#6366f1',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 9,
                        pointHoverBackgroundColor: '#6366f1',
                        pointHoverBorderColor: '#ffffff',
                        pointHoverBorderWidth: 3,
                        fill: true,
                        tension: 0.45
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
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGuruChart);
    } else {
        initGuruChart();
    }
});
</script>

@if (session('success'))
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
