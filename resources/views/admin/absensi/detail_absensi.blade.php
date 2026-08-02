@extends('admin.layouts.app')

@section('title', 'Detail Absensi')

@section('content')
<!-- Title -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Detail Absensi - {{ $siswa->nama_siswa }}</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="#">Master Data</a></li>
            <li><a href="#">Detail Absensi</a></li>
            <li class="active"><span>{{ $siswa->nama_siswa }}</span></li>
        </ol>
    </div>
</div>
<!-- /Title -->

<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default border-panel card-view">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-8 col-xs-6">
                        <form method="GET" action="{{ route('admin.absensi.detail', $siswa->id) }}">
                            <div class="form-group">
                                <div class="input-group mb-15">
                                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $request->start_date }}">
                                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $request->end_date }}">
                                    <select name="mata_pelajaran_id" class="form-control">
                                        <option value="">Pilih Mata Pelajaran</option>
                                        @foreach($mataPelajarans as $mp)
                                            <option value="{{ $mp->id }}" {{ $request->mata_pelajaran_id == $mp->id ? 'selected' : '' }}>{{ $mp->namaMataPelajaran }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                    <button type="submit" class="btn btn-orange btn-anim"><i class="icon-magnifier"></i><span class="btn-text">Cari</span></button>
                                    </span> 
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 col-xs-6 text-right">
                        <a href="{{ route('admin.absensi.detail.export', ['id' => $siswa->id, 'start_date' => request('start_date'), 'end_date' => request('end_date'), 'mata_pelajaran_id' => request('mata_pelajaran_id')]) }}" class="btn btn-success">Download Excel</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Guru</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($absensiDetails as $index => $detail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $detail->absensi->guru->mataPelajaran->namaMataPelajaran }}</td>
                                        <td>{{ $detail->absensi->guru->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($detail->absensi->tanggal)->format('d-m-Y') }}</td>
                                        <td>{{ $detail->absensi->waktu }}</td>
                                        <td>
                                            @if($detail->kehadiran == 1)
                                                Hadir
                                            @elseif($detail->kehadiran == 0)
                                                Tidak Hadir
                                            @elseif($detail->kehadiran == 2)
                                                Sakit
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <canvas id="attendanceChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    const attendanceChart = new Chart(ctx, {
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
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@if(session('success'))
<script>
    $(document).ready(function() {
        setTimeout(function() {
            swal({
                title: "Success!",
                text: "{{ session('success') }}",
                type: "success",
                confirmButtonText: "OK"
            });
        }, 1000);
    });
</script>
@endif

@endsection
