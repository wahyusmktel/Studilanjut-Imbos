@extends('admin.layouts.app')

@section('title', 'Data Absensi')

@section('content')
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Data Absensi</h5>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="#">Master Data</a></li>
                <li class="active"><span>Data Absensi</span></li>
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
                            <a href="#" id="downloadExcelButton" class="btn btn-success btn-sm"><i
                                    class="fa fa-file-excel-o"></i> Download Excel</a>
                        </div>
                        {{-- <div class="col-md-4 col-xs-6 text-right">
                        <a href="{{ route('admin.absensi.export', ['start_date' => request('start_date'), 'end_date' => request('end_date'), 'mata_pelajaran_id' => request('mata_pelajaran_id'), 'kelas_id' => request('kelas_id')]) }}" class="btn btn-success">Download Excel</a>
                    </div> --}}
                        <script>
                            document.getElementById('downloadExcelButton').addEventListener('click', function(event) {
                                var startDate = document.getElementById('start_date').value;
                                var endDate = document.getElementById('end_date').value;

                                if (!startDate || !endDate) {
                                    event.preventDefault();
                                    swal({
                                        title: "Peringatan!",
                                        text: "Harap memilih tanggal awal dan akhir terlebih dahulu.",
                                        type: "warning",
                                        confirmButtonText: "OK"
                                    });
                                } else {
                                    var mataPelajaranId = document.querySelector('select[name="mata_pelajaran_id"]').value;
                                    var kelasId = document.querySelector('select[name="kelas_id"]').value;

                                    var url = "{{ route('admin.absensi.export') }}" + "?start_date=" + startDate + "&end_date=" +
                                        endDate + "&mata_pelajaran_id=" + mataPelajaranId + "&kelas_id=" + kelasId;
                                    window.location.href = url;
                                }
                            });
                        </script>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <form method="GET" action="{{ route('admin.absensi.index') }}">

                                    <div class="form-group">
                                        <input type="date" id="start_date" name="start_date" class="form-control"
                                            value="{{ request('start_date') }}" placeholder="Mulai Tanggal" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="date" id="end_date" name="end_date" class="form-control"
                                            value="{{ request('end_date') }}" placeholder="Sampai Tanggal" required>
                                    </div>

                                    <div class="form-group">
                                        <select name="mata_pelajaran_id" class="form-control">
                                            <option value="">Pilih Mata Pelajaran</option>
                                            @foreach ($mataPelajarans as $mp)
                                                <option value="{{ $mp->id }}"
                                                    {{ request('mata_pelajaran_id') == $mp->id ? 'selected' : '' }}>
                                                    {{ $mp->namaMataPelajaran }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select name="kelas_id" class="form-control">
                                            <option value="">Pilih Kelompok</option>
                                            @foreach ($kelases as $kelas)
                                                <option value="{{ $kelas->id }}"
                                                    {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                                    {{ $kelas->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-orange btn-anim"><i
                                                class="icon-magnifier"></i><span class="btn-text">Cari</span></button>
                                    </div>




                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Kelompok</th>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Guru</th>
                                                    <th>Tanggal</th>
                                                    <th>Waktu</th>
                                                    <th>Kehadiran</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($absensiDetails as $index => $detail)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $detail->siswa->nama_siswa }}</td>
                                                        <td>{{ $detail->absensi->kelas->nama_kelas }}</td>
                                                        <td>{{ $detail->absensi->guru->mataPelajaran->namaMataPelajaran }}
                                                        </td>
                                                        <td>{{ $detail->absensi->guru->nama }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($detail->absensi->tanggal)->format('d-m-Y') }}</td>
                                                        <td>{{ $detail->absensi->waktu }}</td>
                                                        <td>
                                                            @if ($detail->kehadiran == 1)
                                                                Hadir
                                                            @elseif($detail->kehadiran == 0)
                                                                Tidak Hadir
                                                            @elseif($detail->kehadiran == 2)
                                                                Sakit
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-primary edit-button"
                                                                data-id="{{ $detail->id }}"
                                                                data-kehadiran="{{ $detail->kehadiran }}">Edit</button>
                                                            <a href="{{ route('admin.absensi.detail', $detail->siswa_id) }}"
                                                                class="btn btn-info">Detail</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <nav class="pagination-wrap d-inline-block" aria-label="Page navigation example">
                                    {{ $absensiDetails->appends(['start_date' => request('start_date'), 'end_date' => request('end_date'), 'mata_pelajaran_id' => request('mata_pelajaran_id'), 'kelas_id' => request('kelas_id')])->links('vendor.pagination.custom') }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->

    {{-- Modal Edit Absensi --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Kehadiran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" method="POST" action="{{ route('admin.absensi.update') }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editKehadiran">Kehadiran</label>
                            <select class="form-control" id="editKehadiran" name="kehadiran" required>
                                <option value="1">Hadir</option>
                                <option value="0">Tidak Hadir</option>
                                <option value="2">Sakit</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', function() {
                var id = this.dataset.id;
                var kehadiran = this.dataset.kehadiran;
                document.getElementById('editId').value = id;
                document.getElementById('editKehadiran').value = kehadiran;
                $('#editModal').modal('show');
            });
        });
    </script>

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

@endsection
