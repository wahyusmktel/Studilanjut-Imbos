@extends('admin.layouts.app')

@section('title', 'Data Berita')

@section('content')
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Berita</h5>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li class="active"><span>Berita</span></li>
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
                            <h6 class="panel-title txt-dark">Daftar Berita</h6>
                        </div>
                        <div class="col-md-4 col-xs-6 text-right">
                            <a href="{{ route('admin.berita.create') }}" class="btn btn-success mb-3 btn-sm"><i class="fa fa-plus"></i> Tambah Berita</a>
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
                                        <th>Judul Berita</th>
                                        <th>Kategori</th>
                                        <th>Author</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($beritas as $index => $berita)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $berita->judul_berita }}</td>
                                            <td>{{ $berita->kategori->nama_kategori }}</td>
                                            <td>{{ $berita->author->name }}</td>
                                            <td>{{ $berita->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                                            <td>
                                                <a href="{{ route('admin.berita.edit', $berita->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm delete-berita"
                                                    data-id="{{ $berita->id }}">Hapus</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            $('.delete-berita').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: "Apakah Anda yakin?",
                    text: "Menghapus berita ini tidak bisa dibatalkan!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Tidak, batalkan",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: '{{ url('admin/berita') }}/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(result) {
                                swal({
                                    title: "Dihapus!",
                                    text: "Berita berhasil dihapus.",
                                    type: "success",
                                    confirmButtonText: "OK"
                                }, function() {
                                    location.reload();
                                });
                            },
                            error: function() {
                                swal("Error!",
                                    "Terjadi kesalahan saat menghapus berita.",
                                    "error");
                            }
                        });
                    } else {
                        swal("Dibatalkan", "Berita tetap aman :)", "error");
                    }
                });
            });
        });
    </script>
@endsection
