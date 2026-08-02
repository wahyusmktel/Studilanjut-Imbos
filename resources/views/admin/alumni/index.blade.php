@extends('admin.layouts.app')

@section('title', 'Daftar Alumni')

@section('content')
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Daftar Alumni</h5>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li class="active"><span>Alumni</span></li>
            </ol>
        </div>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default border-panel card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Alumni</h6>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addAlumniModal">
                            Tambah Alumni
                        </button>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#importModal">
                            Import Data Alumni
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Alumni</th>
                                            <th>Jenis Perguruan Tinggi</th>
                                            <th>Nama Universitas</th>
                                            <th>Foto</th>
                                            <th>Tahun Lulusan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alumnis as $index => $alumni)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $alumni->nama_alumni }}</td>
                                                <td>{{ $alumni->jenisPt->nama_jenis_pt ?? '-' }}</td>
                                                <td>{{ $alumni->nama_universitas }}</td>
                                                <td>
                                                    @if ($alumni->foto)
                                                        <img src="{{ asset('storage/' . $alumni->foto) }}"
                                                            alt="{{ $alumni->nama_alumni }}"
                                                            style="width: 50px; height: 50px;">
                                                    @else
                                                        Tidak ada foto
                                                    @endif
                                                </td>
                                                <td>{{ $alumni->tahun_lulusan }}</td>
                                                <td>{{ $alumni->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                                                <!-- Tombol Edit -->
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#editAlumniModal"
                                                        data-id="{{ $alumni->id }}" data-nama="{{ $alumni->nama_alumni }}"
                                                        data-jenis="{{ $alumni->jenis_perguruan_tinggi_id }}"
                                                        data-universitas="{{ $alumni->nama_universitas }}"
                                                        data-foto="{{ asset('storage/' . $alumni->foto) }}"
                                                        data-tahun_lulusan="{{ $alumni->tahun_lulusan }}">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-alumni"
                                                        data-id="{{ $alumni->id }}"><i class="fa fa-trash-o"></i>
                                                        Hapus</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($alumnis->isEmpty())
                                            <tr>
                                                <td colspan="6" class="text-center">Data tidak ditemukan</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="pagination-wrapper">
                        {{ $alumnis->links() }} <!-- Menampilkan tautan paginasi -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->

    <!-- Modal Tambah Alumni -->
    <div class="modal fade" id="addAlumniModal" tabindex="-1" role="dialog" aria-labelledby="addAlumniModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addAlumniForm" method="POST" action="{{ route('admin.alumni.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAlumniModalLabel">Tambah Alumni</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_alumni">Nama Alumni</label>
                            <input type="text" class="form-control" id="nama_alumni" name="nama_alumni" required>
                        </div>
                        {{-- <div class="form-group">
                        <label for="jenis_perguruan_tinggi">Jenis Perguruan Tinggi</label>
                        <input type="text" class="form-control" id="jenis_perguruan_tinggi" name="jenis_perguruan_tinggi" required>
                    </div> --}}
                        <div class="form-group">
                            <label for="jenis_perguruan_tinggi_id">Jenis Perguruan Tinggi</label>
                            <select class="form-control" id="jenis_perguruan_tinggi_id" name="jenis_perguruan_tinggi_id"
                                required>
                                <option value="">Pilih Jenis Perguruan Tinggi</option>
                                @foreach ($jenisPts as $jenisPt)
                                    <option value="{{ $jenisPt->id }}">{{ $jenisPt->nama_jenis_pt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_universitas">Nama Universitas</label>
                            <input type="text" class="form-control" id="nama_universitas" name="nama_universitas"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                        <div class="form-group">
                            <label for="tahun_lulusan">Tahun Lulusan</label>
                            <input type="number" class="form-control" id="tahun_lulusan" name="tahun_lulusan"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Alumni -->
    <div class="modal fade" id="editAlumniModal" tabindex="-1" role="dialog" aria-labelledby="editAlumniModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAlumniModalLabel">Edit Alumni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editAlumniForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-nama">Nama Alumni</label>
                            <input type="text" class="form-control" id="edit-nama" name="nama_alumni" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-jenis">Jenis Perguruan Tinggi</label>
                            <select class="form-control" id="edit-jenis" name="jenis_perguruan_tinggi_id" required>
                                @foreach ($jenisPts as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis_pt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-universitas">Nama Universitas</label>
                            <input type="text" class="form-control" id="edit-universitas" name="nama_universitas"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="edit-foto">Foto</label>
                            <input type="file" class="form-control" id="edit-foto" name="foto">
                            <img id="current-foto" src="" alt="Current Foto" width="100" class="mt-2">
                        </div>
                        <div class="form-group">
                            <label for="edit-tahun_lulusan">Tahun Lulusan</label>
                            <input type="number" class="form-control" id="edit-tahun_lulusan" name="tahun_lulusan"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Import Data Alumni -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.alumni.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Data Alumni</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">Pilih File Excel</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
                        <a href="https://docs.google.com/spreadsheets/d/1G54xPvnB9eIjyb9ENGJGOI57twjzQnIT/edit?usp=sharing&ouid=105663471066731245622&rtpof=true&sd=true" target="_blank">Download Format</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#editAlumniModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nama = button.data('nama');
            var jenis = button.data('jenis');
            var universitas = button.data('universitas');
            var tahun_lulusan = button.data('tahun_lulusan');
            var foto = button.data('foto');

            var modal = $(this);
            modal.find('#edit-id').val(id);
            modal.find('#edit-nama').val(nama);
            modal.find('#edit-jenis').val(jenis);
            modal.find('#edit-universitas').val(universitas);
            modal.find('#edit-tahun_lulusan').val(tahun_lulusan);
            modal.find('#current-foto').attr('src', foto);

            $('#editAlumniForm').attr('action', '/admin/alumni/' + id);
        });
    </script>

    <script>
        $('.delete-alumni').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                title: "Apakah Anda yakin?",
                text: "Menghapus data alumni ini!",
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
                        url: '{{ url('admin/alumni') }}/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(result) {
                            swal({
                                title: "Dihapus!",
                                text: "Data alumni berhasil dihapus.",
                                type: "success",
                                confirmButtonText: "OK"
                            }, function() {
                                location.reload();
                            });
                        },
                        error: function() {
                            swal("Error!", "Terjadi kesalahan saat menghapus data.", "error");
                        }
                    });
                } else {
                    swal("Dibatalkan", "Data alumni tetap aman :)", "error");
                }
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