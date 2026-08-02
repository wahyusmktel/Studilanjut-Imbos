@extends('admin.layouts.app')

@section('title', 'Data Nilai Siswa')

@section('content')
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Data Nilai Siswa</h5>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="#">Nilai</a></li>
                <li class="active"><span>Data Nilai Siswa</span></li>
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
                            <div class="btn-group">
                                <div class="dropdown">
                                    <button aria-expanded="false" data-toggle="dropdown"
                                        class="btn btn-orange dropdown-toggle" type="button">
                                        Menu <span class="caret"></span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu">
                                        {{-- <li><a href="#" data-toggle="modal" data-target="#importModal"><i class="fa fa-upload"></i> Import Data</a></li>
                                    <li class="divider"></li> --}}
                                        <li><a href="/admin/nilai"><i class="fa fa-plus"></i> Tambah Data</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-6 text-right">
                            <form method="GET" action="{{ route('admin.nilai-siswa.index') }}">
                                <div class="form-group">
                                    <div class="input-group mb-15">
                                        <input type="text" id="search" name="search" class="form-control"
                                            placeholder="Cari Nama Siswa..." value="{{ $search }}">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-orange btn-anim"><i
                                                    class="icon-magnifier"></i><span class="btn-text">Cari</span></button>
                                        </span>
                                    </div>
                                </div>
                            </form>
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
                                            <th>Nama Siswa</th>
                                            <th>Kelompok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswas as $siswa)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $siswa->nama_siswa }}</td>
                                                <td>{{ $siswa->kelas ? $siswa->kelas->nama_kelas : 'Kelas Tidak Ditemukan' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.nilai.detail', $siswa->id) }}"
                                                        class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i>
                                                        Detail</a>
                                                    <a href="#" class="delete-button btn btn-danger btn-sm"
                                                        data-id="{{ $siswa->id }}"><i class="fa fa-trash-o"></i>
                                                        Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <nav class="pagination-wrap d-inline-block" aria-label="Page navigation example">
                                    {{ $siswas->appends(request()->query())->links('vendor.pagination.custom') }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->

    <script>
        $(document).ready(function() {
            // SweetAlert for Delete
            $('.delete-button').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: "Peringatan !",
                    text: "Tindakan ini akan menghapus semua data nilai pada siswa yang dipilih !",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f83f37",
                    confirmButtonText: "Yes, Saya Paham!",
                    cancelButtonText: "No, Batal!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: '/admin/nilai/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(result) {
                                swal({
                                    title: "Deleted!",
                                    text: result.success,
                                    type: "success",
                                    confirmButtonText: "OK"
                                }, function() {
                                    location.reload();
                                });
                            },
                            error: function() {
                                swal("Error!", "There was an error deleting the data.",
                                    "error");
                            }
                        });
                    } else {
                        swal("Cancelled", "Your data is safe :)", "error");
                    }
                });
            });
        });
    </script>
@endsection
