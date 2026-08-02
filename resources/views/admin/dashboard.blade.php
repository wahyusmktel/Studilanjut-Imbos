<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- Stats Grid -->
<div class="stats-grid">
    <!-- Card 1: Siswa -->
    <div class="stat-card gradient-1">
        <div class="stat-card-content">
            <span class="stat-card-label">Total Siswa</span>
            <span class="stat-card-value">{{ $jumlahSiswa }}</span>
        </div>
        <div class="stat-card-icon">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
    </div>
    <!-- Card 2: Guru -->
    <div class="stat-card gradient-2">
        <div class="stat-card-content">
            <span class="stat-card-label">Total Guru</span>
            <span class="stat-card-value">{{ $jumlahGuru }}</span>
        </div>
        <div class="stat-card-icon">
            <i class="fa-solid fa-chalkboard-user"></i>
        </div>
    </div>
    <!-- Card 3: Mapel -->
    <div class="stat-card gradient-3">
        <div class="stat-card-content">
            <span class="stat-card-label">Mata Pelajaran</span>
            <span class="stat-card-value">{{ $jumlahMataPelajaran }}</span>
        </div>
        <div class="stat-card-icon">
            <i class="fa-solid fa-book-open"></i>
        </div>
    </div>
    <!-- Card 4: Nilai -->
    <div class="stat-card gradient-4">
        <div class="stat-card-content">
            <span class="stat-card-label">Total Nilai</span>
            <span class="stat-card-value">{{ $jumlahNilai }}</span>
        </div>
        <div class="stat-card-icon">
            <i class="fa-solid fa-clipboard-check"></i>
        </div>
    </div>
</div>

<!-- Tryout Chart + Top Students Row -->
@if($tahunPelajaranAktif)
<div class="dashboard-grid">
    <!-- Line Chart: Average Tryout Scores -->
    <div class="modern-card">
        <div class="modern-card-header">
            <h3 class="modern-card-title">Rata-Rata Nilai Tryout ({{ $tahunPelajaranAktif->nama_tahun_pelajaran }})</h3>
        </div>
        <div class="modern-card-body">
            @if(count($chartLabels) > 0)
                <div style="position: relative; height: 350px; width: 100%;">
                    <canvas id="tryoutChart"></canvas>
                </div>
            @else
                <div class="empty-state">
                    <i class="fa-solid fa-chart-line"></i>
                    <p>Belum ada data nilai tryout untuk tahun pelajaran ini.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Top 5 Students -->
    <div class="modern-card">
        <div class="modern-card-header">
            <h3 class="modern-card-title">Nilai Terbaik</h3>
        </div>
        <div class="modern-card-body" style="padding: 0;">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Siswa</th>
                        <th>Rata-Rata</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topSiswa as $siswa)
                        <tr>
                            <td>
                                <div class="student-info">
                                    <span class="student-name">{{ $siswa->nama_siswa }}</span>
                                    <span class="student-class">{{ $siswa->nama_kelas }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge-modern primary">{{ $siswa->rata_rata_nilai }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">Belum ada data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

<!-- Attendance Chart + Top Disciplined Students Row -->
<div class="dashboard-grid">
    <!-- Bar Chart: 30 Days Attendance -->
    <div class="modern-card">
        <div class="modern-card-header">
            <h3 class="modern-card-title">Kehadiran (30 Hari Terakhir)</h3>
        </div>
        <div class="modern-card-body">
            @if(count($attendanceChartLabels) > 0)
                <div style="position: relative; height: 350px; width: 100%;">
                    <canvas id="attendanceChart"></canvas>
                </div>
            @else
                <div class="empty-state">
                    <i class="fa-solid fa-calendar-check"></i>
                    <p>Belum ada data kehadiran dalam 30 hari terakhir.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Top 5 Disciplined Students -->
    <div class="modern-card">
        <div class="modern-card-header">
            <h3 class="modern-card-title">Siswa Paling Disiplin @if($tahunPelajaranAktif) ({{ $tahunPelajaranAktif->nama_tahun_pelajaran }}) @endif</h3>
        </div>
        <div class="modern-card-body" style="padding: 0;">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Siswa</th>
                        <th>Total Hadir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topAttendance as $siswa)
                        <tr>
                            <td>
                                <div class="student-info">
                                    <span class="student-name">{{ $siswa->nama_siswa }}</span>
                                    <span class="student-class">{{ $siswa->nama_kelas }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge-modern success">{{ $siswa->total_hadir }} Kali</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">Belum ada data kehadiran siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(function() {
    // Modern Chart.js configuration
    Chart.defaults.font.family = 'Inter, sans-serif';
    Chart.defaults.font.size = 13;
    Chart.defaults.color = '#64748b';
    
    function initCharts() {
        @if(count($chartLabels) > 0)
        var canvas = document.getElementById('tryoutChart');
        if (canvas) {
            var ctx = canvas.getContext('2d');
            
            // Create gradient fill
            var gradient = ctx.createLinearGradient(0, 0, 0, 350);
            gradient.addColorStop(0, 'rgba(99, 102, 241, 0.3)');
            gradient.addColorStop(1, 'rgba(99, 102, 241, 0.0)');
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Rata-Rata Nilai',
                        data: {!! json_encode($chartData) !!},
                        backgroundColor: gradient,
                        borderColor: '#6366f1',
                        borderWidth: 3,
                        pointBackgroundColor: '#6366f1',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: '#6366f1',
                        pointHoverBorderColor: '#ffffff',
                        pointHoverBorderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            border: { display: false },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                padding: 10
                            }
                        },
                        x: {
                            border: { display: false },
                            grid: {
                                display: false
                            },
                            ticks: {
                                padding: 10
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'end',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                padding: 20,
                                font: { weight: '500' }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleColor: '#ffffff',
                            bodyColor: '#e2e8f0',
                            borderColor: '#334155',
                            borderWidth: 1,
                            cornerRadius: 12,
                            padding: 14,
                            displayColors: true,
                            usePointStyle: true,
                            titleFont: { weight: '600', size: 14 },
                            bodyFont: { size: 13 }
                        }
                    }
                }
            });
        }
        @endif

        @if(count($attendanceChartLabels) > 0)
        var canvasAtt = document.getElementById('attendanceChart');
        if (canvasAtt) {
            var ctxAtt = canvasAtt.getContext('2d');
            
            // Create gradient for bars
            var barGradient = ctxAtt.createLinearGradient(0, 0, 0, 350);
            barGradient.addColorStop(0, 'rgba(16, 185, 129, 0.9)');
            barGradient.addColorStop(1, 'rgba(16, 185, 129, 0.3)');
            
            new Chart(ctxAtt, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($attendanceChartLabels) !!},
                    datasets: [{
                        label: 'Jumlah Siswa Hadir',
                        data: {!! json_encode($attendanceChartData) !!},
                        backgroundColor: barGradient,
                        borderColor: '#10b981',
                        borderWidth: 0,
                        borderRadius: 8,
                        borderSkipped: false,
                        maxBarThickness: 40
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            border: { display: false },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                stepSize: 1,
                                padding: 10
                            }
                        },
                        x: {
                            border: { display: false },
                            grid: {
                                display: false
                            },
                            ticks: {
                                padding: 10
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'end',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'rectRounded',
                                padding: 20,
                                font: { weight: '500' }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleColor: '#ffffff',
                            bodyColor: '#e2e8f0',
                            borderColor: '#334155',
                            borderWidth: 1,
                            cornerRadius: 12,
                            padding: 14,
                            displayColors: true,
                            usePointStyle: true,
                            titleFont: { weight: '600', size: 14 },
                            bodyFont: { size: 13 }
                        }
                    }
                }
            });
        }
        @endif
    }
    
    // Init charts when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCharts);
    } else {
        initCharts();
    }
})();
</script>
@endsection
