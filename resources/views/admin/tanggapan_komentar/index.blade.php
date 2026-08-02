@extends('admin.layouts.app')

@section('title', 'Data Tanggapan Komentar')

@section('content')
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Komentar</h5>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/komentar') }}">Komentar</a></li>
                <li class="active"><span>Tanggapan</span></li>
            </ol>
        </div>
    </div>
    <!-- /Title -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default border-panel card-view">
                <div class="panel-heading">
                    
                    <div class="row">
                        <div class="col-md-8 col-xs-6">
                            <h6 class="panel-title txt-dark">Data Tanggapan Komentar</h6>
                        </div>
                        <div class="col-md-4 col-xs-6 text-right">
                            <a href="/admin/komentar" class="btn btn-default"><i
                                    class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>

                </div>
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Komentar</th>
                                        <th>Author</th>
                                        {{-- <th>Isi Tanggapan</th> --}}
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tanggapans as $index => $tanggapan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $tanggapan->komentar->isi_komentar }}</td>
                                            <td>{{ $tanggapan->author->name }}</td>
                                            {{-- <td>{{ $tanggapan->isi_tanggapan }}</td> --}}
                                            <td>{{ $tanggapan->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm edit-tanggapan"
                                                    data-id="{{ $tanggapan->id }}"
                                                    data-isi="{{ $tanggapan->isi_tanggapan }}"><i class="fa fa-info-circle"></i> Lihat</button>
                                                <button class="btn btn-danger btn-sm delete-tanggapan"
                                                    data-id="{{ $tanggapan->id }}"><i class="fa fa-trash"></i> Hapus</button>
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
    </div>

    <!-- Modal Edit Tanggapan -->
    <div id="editTanggapanModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editTanggapanForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Tanggapan</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="isi_tanggapan">Isi Tanggapan</label>
                            <textarea class="form-control" id="isi_tanggapan" name="isi_tanggapan" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $('.edit-tanggapan').on('click', function() {
            var id = $(this).data('id');
            var isi = $(this).data('isi');
            $('#editTanggapanForm').attr('action', '{{ url('admin/tanggapan') }}/' + id);
            $('#editTanggapanForm #isi_tanggapan').val(isi);
            $('#editTanggapanModal').modal('show');
        });

        $('.delete-tanggapan').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                title: "Apakah Anda yakin?",
                text: "Menghapus tanggapan ini!",
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
                        url: '{{ url('admin/tanggapan') }}/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(result) {
                            swal({
                                title: "Dihapus!",
                                text: "Tanggapan berhasil dihapus.",
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
                    swal("Dibatalkan", "Tanggapan tetap aman :)", "error");
                }
            });
        });
    </script>
@endsection
