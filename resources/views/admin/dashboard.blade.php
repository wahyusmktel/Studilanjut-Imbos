<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-sm-3 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                                <!-- counter jumlah siswa dari tabel siswas -->
                                <div class="sm-data-box">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-xs-6 data-wrap-left">
                                                <span class="capitalize-font block">Siswa</span>
                                                <span class="txt-dark block">{{ $jumlahSiswa }}</span>
                                            </div>
                                            <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                <i class="zmdi zmdi-graduation-cap data-right-rep-icon bg-grad-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end counter jumlah siswa -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <!-- counter jumlah guru dari tabel gurus -->
                                <div class="sm-data-box">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-xs-6 data-wrap-left">
                                                <span class="capitalize-font block">Guru</span>
                                                <span class="txt-dark block">{{ $jumlahGuru }}</span>
                                            </div>
                                            <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                <i class="zmdi zmdi-account data-right-rep-icon bg-grad-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end counter jumlah guru -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <!-- counter jumlah mata_pelajarans dari tabel mata_pelajarans -->
                                <div class="sm-data-box">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-xs-6 data-wrap-left">
                                                <span class="capitalize-font block">Mapel</span>
                                                <span class="txt-dark block">{{ $jumlahMataPelajaran }}</span>
                                            </div>
                                            <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                <i class="zmdi zmdi-book data-right-rep-icon bg-grad-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end counter jumlah mata_pelajarans -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <!-- counter jumlah nilais dari tabel nilais -->
                                <div class="sm-data-box">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-xs-6 data-wrap-left">
                                                <span class="capitalize-font block">Nilai</span>
                                                <span class="txt-dark block">{{ $jumlahNilai }}</span>
                                            </div>
                                            <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                <i class="zmdi zmdi-assignment-check data-right-rep-icon bg-grad-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end counter jumlah nilais -->
                            </div>
                        </div>
                    </div>
                </div>
    </div>

            <!-- Row for Chart and Top Students -->
            @if($tahunPelajaranAktif)
            <div class="row mt-15">
                <!-- Line Chart: Average Tryout Scores -->
                <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Rata-Rata Nilai Tryout ({{ $tahunPelajaranAktif->nama_tahun_pelajaran }})</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                @if(count($chartLabels) > 0)
                                    <div style="position: relative; height: 370px; width: 100%;">
                                        <canvas id="tryoutChart"></canvas>
                                    </div>
                                @else
                                    <div class="text-center pa-20">
                                        <p class="text-muted">Belum ada data nilai tryout untuk tahun pelajaran ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top 5 Students -->
                <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Nilai Terbaik ({{ $tahunPelajaranAktif->nama_tahun_pelajaran }})</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body row pa-0">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
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
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <span class="block txt-dark weight-500 capitalize-font">{{ $siswa->nama_siswa }}</span>
                                                                    <span class="block txt-grey font-12">{{ $siswa->nama_kelas }}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="label label-primary">{{ $siswa->rata_rata_nilai }}</span>
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
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Row for Attendance Chart and Disciplined Students -->
            <div class="row mt-15">
                <!-- Line/Bar Chart: 30 Days Attendance -->
                <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Kehadiran (30 Hari Terakhir)</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                @if(count($attendanceChartLabels) > 0)
                                    <div style="position: relative; height: 370px; width: 100%;">
                                        <canvas id="attendanceChart"></canvas>
                                    </div>
                                @else
                                    <div class="text-center pa-20">
                                        <p class="text-muted">Belum ada data kehadiran dalam 30 hari terakhir.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top 5 Disciplined Students -->
                <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Siswa Paling Disiplin @if($tahunPelajaranAktif) ({{ $tahunPelajaranAktif->nama_tahun_pelajaran }}) @endif</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body row pa-0">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
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
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <span class="block txt-dark weight-500 capitalize-font">{{ $siswa->nama_siswa }}</span>
                                                                    <span class="block txt-grey font-12">{{ $siswa->nama_kelas }}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="label label-success" style="background: #2ecc71;">{{ $siswa->total_hadir }} Kali</span>
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
                        </div>
                    </div>
                </div>
            </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Use standard JS without defer since we inject at end of body.
// We explicitly avoid the document.addEventListener('DOMContentLoaded', ...) wrapper 
// because in some layouts scripts pushed to the end run after DOMContentLoaded fires.
(function() {
    function initChart() {
        @if(count($chartLabels) > 0)
        var canvas = document.getElementById('tryoutChart');
        if (!canvas) return; // Prevent errors if not rendered
        
        var ctx = canvas.getContext('2d');
        var tryoutChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Rata-Rata Nilai Keseluruhan',
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: 'rgba(234, 108, 65, 0.2)',
                    borderColor: 'rgba(234, 108, 65, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(234, 108, 65, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(234, 108, 65, 1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: { family: 'inherit' }
                        }
                    },
                    x: {
                        ticks: {
                            font: { family: 'inherit' }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: { family: 'inherit' }
                        }
                    }
                }
            }
        });
        @endif

        @if(count($attendanceChartLabels) > 0)
        var canvasAtt = document.getElementById('attendanceChart');
        if (canvasAtt) {
            var ctxAtt = canvasAtt.getContext('2d');
            var attendanceChart = new Chart(ctxAtt, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($attendanceChartLabels) !!},
                    datasets: [{
                        label: 'Jumlah Siswa Hadir',
                        data: {!! json_encode($attendanceChartData) !!},
                        backgroundColor: 'rgba(46, 204, 113, 0.5)',
                        borderColor: 'rgba(46, 204, 113, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { font: { family: 'inherit' }, stepSize: 1 }
                        },
                        x: { ticks: { font: { family: 'inherit' } } }
                    },
                    plugins: {
                        legend: { display: true, position: 'top', labels: { font: { family: 'inherit' } } }
                    }
                }
            });
        }
        @endif
    }

    // Try starting immediately, or wait for window.onload just in case
    initChart();
    window.onload = initChart;
})();
</script>

@endsection
