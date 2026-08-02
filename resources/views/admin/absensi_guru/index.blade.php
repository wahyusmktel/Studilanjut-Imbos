@extends('admin.layouts.app')

@section('title', 'Data Absensi Guru')

@section('content')
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Data Absensi Guru</h5>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li class="active"><span>Data Absensi Guru</span></li>
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
                        <div class="col-md-4 col-xs-6">
                            <button id="export-button" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i>
                                Download Excel</button>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <form method="GET" action="{{ route('admin.absensi-guru.index') }}">

                                    <div class="form-group">
                                        <input type="date" id="start_date" name="start_date" class="form-control"
                                            value="{{ request('start_date') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="date" id="end_date" name="end_date" class="form-control"
                                            value="{{ request('end_date') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <select name="guru_id" class="form-control">
                                            <option value="">Pilih Guru</option>
                                            @foreach ($gurus as $guru)
                                                <option value="{{ $guru->id }}"
                                                    {{ request('guru_id') == $guru->id ? 'selected' : '' }}>
                                                    {{ $guru->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-orange btn-anim"><i
                                                class="icon-magnifier"></i><span class="btn-text">Cari</span></button>
                                    </div>




                                </form>
                            </div>
                            <script>
                                document.getElementById('export-button').addEventListener('click', function() {
                                    var startDate = document.getElementById('start_date').value;
                                    var endDate = document.getElementById('end_date').value;
                                    var guruId = document.querySelector('select[name="guru_id"]').value;

                                    if (!startDate || !endDate) {
                                        alert('Silahkan pilih rentang tanggal terlebih dahulu.');
                                    } else {
                                        var url = "{{ route('admin.absensi-guru.export') }}?start_date=" + startDate + "&end_date=" +
                                            endDate + "&guru_id=" + guruId;
                                        window.location.href = url;
                                    }
                                });
                            </script>
                        </div>
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Guru</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Kelompok</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensis as $index => $absensi)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $absensi->guru->nama }}</td>
                                                <td>{{ $absensi->guru->mataPelajaran->namaMataPelajaran }}</td>
                                                <td>{{ $absensi->kelas->nama_kelas }}</td>
                                                <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}</td>
                                                <td>{{ $absensi->waktu }}</td>
                                                <td>
                                                    <a href="{{ route('admin.absensi-guru.show', $absensi->id) }}"
                                                        class="btn btn-info">Detail</a>
                                                    <button class="btn btn-danger btn-sm delete-absensi"
                                                        data-id="{{ $absensi->id }}">Hapus</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <canvas id="attendanceChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <nav class="pagination-wrap d-inline-block" aria-label="Page navigation example">
                                    {{ $absensis->appends(['start_date' => request('start_date'), 'end_date' => request('end_date'), 'guru_id' => request('guru_id')])->links('vendor.pagination.custom') }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->

    @if (session('success'))
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

    <script>
        $(document).ready(function() {
            $('.delete-absensi').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: "Apakah Anda yakin?",
                    text: "Menghapus data absensi maka akan menghapus seluruh kehadiran siswa pada absensi ini!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f83f37",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Tidak, batalkan",
                    closeOnConfirm: false,
                    closeOnCancel: false
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
                                swal("Error!", "Terjadi kesalahan saat menghapus data.",
                                    "error");
                            }
                        });
                    } else {
                        swal("Dibatalkan", "Data absensi tetap aman :)", "error");
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for the chart
        var attendanceData = @json($attendanceChartData);

        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const attendanceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: attendanceData.labels,
                datasets: [{
                    label: 'Jumlah Kehadiran per Bulan',
                    data: attendanceData.data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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

@endsection
