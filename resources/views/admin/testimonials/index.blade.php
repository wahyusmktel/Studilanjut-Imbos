@extends('admin.layouts.app')

@section('title', 'Testimonials')

@section('content')
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Data Testimonials</h5>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li class="active"><span>Data Testimonials</span></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal">
                            <i class="fa fa-plus"></i> Tambah Testimonial
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
                                            <th>Rating</th>
                                            <th>Isi Testimonial</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($testimonials as $index => $testimonial)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $testimonial->alumni->nama_alumni }}</td>
                                                <td>{{ $testimonial->rating }}</td>
                                                <td>{{ $testimonial->isi_testimonial }}</td>
                                                <td>{{ $testimonial->status ? 'Aktif' : 'Nonaktif' }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm edit-testimonial"
                                                        data-id="{{ $testimonial->id }}"
                                                        data-alumni_id="{{ $testimonial->alumni_id }}"
                                                        data-rating="{{ $testimonial->rating }}"
                                                        data-isi_testimonial="{{ $testimonial->isi_testimonial }}"><i class="fa fa-edit"></i> Edit</button>
                                                    <button class="btn btn-danger btn-sm delete-testimonial"
                                                        data-id="{{ $testimonial->id }}"><i class="fa fa-trash"></i> Hapus</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($testimonials->isEmpty())
                                            <tr>
                                                <td colspan="6" class="text-center">Data tidak ditemukan</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Testimonial</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="alumni_id">Nama Alumni</label>
                            <select class="form-control" id="alumni_id" name="alumni_id" required>
                                <option value="">Pilih Alumni</option>
                                @foreach ($alumnis as $alumni)
                                    <option value="{{ $alumni->id }}">{{ $alumni->nama_alumni }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <input type="number" class="form-control" id="rating" name="rating" min="1"
                                max="5" required>
                        </div>
                        <div class="form-group">
                            <label for="isi_testimonial">Isi Testimonial</label>
                            <textarea class="form-control" id="isi_testimonial" name="isi_testimonial" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Testimonial</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_alumni_id">Nama Alumni</label>
                            <select class="form-control" id="edit_alumni_id" name="alumni_id" required>
                                <option value="">Pilih Alumni</option>
                                @foreach ($alumnis as $alumni)
                                    <option value="{{ $alumni->id }}">{{ $alumni->nama_alumni }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_rating">Rating</label>
                            <input type="number" class="form-control" id="edit_rating" name="rating" min="1"
                                max="5" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_isi_testimonial">Isi Testimonial</label>
                            <textarea class="form-control" id="edit_isi_testimonial" name="isi_testimonial" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Tambah Testimonial
            $('#addForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('admin.testimonials.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addModal').modal('hide');
                        swal("Berhasil!", response.message, "success").then(() => {
                            location.reload();
                        });
                    },
                    error: function(response) {
                        let errors = response.responseJSON.errors;
                        let errorMessage = '';
                        for (const error in errors) {
                            errorMessage += errors[error][0] + '\n';
                        }
                        swal("Gagal!", errorMessage, "error");
                    }
                });
            });

            // Edit Testimonial
            $('.edit-testimonial').on('click', function() {
                let id = $(this).data('id');
                let alumni_id = $(this).data('alumni_id');
                let rating = $(this).data('rating');
                let isi_testimonial = $(this).data('isi_testimonial');

                $('#edit_alumni_id').val(alumni_id);
                $('#edit_rating').val(rating);
                $('#edit_isi_testimonial').val(isi_testimonial);
                $('#editForm').attr('action', '{{ url('admin/testimonials') }}/' + id);

                $('#editModal').modal('show');
            });

            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                let formAction = $(this).attr('action');

                $.ajax({
                    url: formAction,
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editModal').modal('hide');
                        swal("Berhasil!", response.message, "success").then(() => {
                            location.reload();
                        });
                    },
                    error: function(response) {
                        let errors = response.responseJSON.errors;
                        let errorMessage = '';
                        for (const error in errors) {
                            errorMessage += errors[error][0] + '\n';
                        }
                        swal("Gagal!", errorMessage, "error");
                    }
                });
            });

            // Hapus Testimonial
            $('.delete-testimonial').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');

                swal({
                    title: "Apakah Anda yakin?",
                    text: "Data testimonial yang dihapus tidak bisa dikembalikan!",
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
                            url: '{{ url('admin/testimonials') }}/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(result) {
                                swal({
                                    title: "Dihapus!",
                                    text: "Data testimonial berhasil dihapus.",
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
                        swal("Dibatalkan", "Data testimonial tetap aman :)", "error");
                    }
                });
            });
        });
    </script>
@endsection
