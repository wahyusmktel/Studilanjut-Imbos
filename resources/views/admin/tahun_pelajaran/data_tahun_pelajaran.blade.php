@extends('admin.layouts.app')

@section('title', 'Data Tahun Pelajaran')

@section('content')
<!-- Title -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Data Tahun Pelajaran</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="#">Tahun Pelajaran</a></li>
            <li class="active"><span>Data Tahun Pelajaran</span></li>
        </ol>
    </div>
</div>
<!-- /Title -->

<!-- Alert Info -->
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="zmdi zmdi-info-outline pr-15 pull-left"></i><p class="pull-left">Mulai tahun pelajaran 2025/2026 pengolahan data pada sistem dilakukan dalam <strong>satu tahun pelajaran</strong> bukan per semester. Untuk tahun berjalan cukup menggunakan satu semester. Data pada halaman orang tua sudah otomatis disesuaikan berdasarkan satu tahun pelajaran berjalan / aktif.</p>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- /Alert Info -->

<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default border-panel card-view">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-8 col-xs-6">
                        <div class="btn-group">
                            <div class="dropdown">
                                <button aria-expanded="false" data-toggle="dropdown" class="btn btn-orange dropdown-toggle" type="button">
                                    Menu <span class="caret"></span>
                                </button>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="#" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Tambah Data</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6 text-right">
                        <form method="GET" action="{{ route('admin.tahun_pelajaran.index') }}">
                            <div class="form-group">
                                <div class="input-group mb-15">
                                    <input type="text" id="search" name="search" class="form-control" placeholder="Cari Data..." value="{{ request('search') }}">
                                    <span class="input-group-btn">
                                    <button type="submit" class="btn btn-orange btn-anim"><i class="icon-magnifier"></i><span class="btn-text">Cari</span></button>
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
                                        <th>Nama Tahun Pelajaran</th>
                                        <th>Semester</th>
                                        <th>Status</th>
                                        <th>Statistik Data</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tahunPelajarans as $index => $tahunPelajaran)
                                    <tr>
                                        <td>{{ $tahunPelajarans->firstItem() + $index }}</td>
                                        <td>{{ $tahunPelajaran->nama_tahun_pelajaran }}</td>
                                        <td>{{ $tahunPelajaran->semester }}</td>
                                        <td>
                                            @if($tahunPelajaran->status == 1)
                                                <span class="label label-success">Aktif</span>
                                            @else
                                                <span class="label label-danger">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="label label-primary" data-toggle="tooltip" title="Total Siswa"><i class="fa fa-users"></i> {{ $tahunPelajaran->jml_siswa }}</span>
                                            <span class="label label-info" data-toggle="tooltip" title="Total Kelompok"><i class="fa fa-sitemap"></i> {{ $tahunPelajaran->jml_kelas }}</span>
                                            <span class="label label-success" data-toggle="tooltip" title="Total Kehadiran Siswa"><i class="fa fa-check-square-o"></i> {{ $tahunPelajaran->jml_absensi_siswa }}</span>
                                            <span class="label label-warning" data-toggle="tooltip" title="Total Absensi Guru"><i class="fa fa-calendar-check-o"></i> {{ $tahunPelajaran->jml_absensi_guru }}</span>
                                            <span class="label label-danger" data-toggle="tooltip" title="Total Nilai"><i class="fa fa-line-chart"></i> {{ $tahunPelajaran->jml_nilai }}</span>
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="#" class="mr-25 edit-button" data-toggle="tooltip" data-original-title="Edit" data-id="{{ $tahunPelajaran->id }}" data-nama="{{ $tahunPelajaran->nama_tahun_pelajaran }}" data-semester="{{ $tahunPelajaran->semester }}" data-status="{{ $tahunPelajaran->status }}"> 
                                                <i class="fa fa-pencil text-inverse m-r-10"></i> 
                                            </a> 
                                            <a href="#" class="delete-button" data-id="{{ $tahunPelajaran->id }}" data-toggle="tooltip" data-original-title="Delete"> 
                                                <i class="fa fa-close text-danger"></i> 
                                            </a>
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
                            <nav class="pagination-wrap d-inline-block" aria-label="Page navigation example">
                                {{ $tahunPelajarans->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->

<!-- Modal Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.tahun_pelajaran.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Tahun Pelajaran</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_tahun_pelajaran">Nama Tahun Pelajaran</label>
                        <input type="text" class="form-control" id="nama_tahun_pelajaran" name="nama_tahun_pelajaran" placeholder="Nama Tahun Pelajaran" required>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" id="semester" name="semester" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-orange">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editForm" method="POST">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="editModalLabel">Edit Data Tahun Pelajaran</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNamaTahunPelajaran">Nama Tahun Pelajaran</label>
                        <input type="text" class="form-control" id="editNamaTahunPelajaran" name="nama_tahun_pelajaran" placeholder="Nama Tahun Pelajaran" required>
                    </div>
                    <div class="form-group">
                        <label for="editSemester">Semester</label>
                        <select class="form-control" id="editSemester" name="semester" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status</label>
                        <select class="form-control" id="editStatus" name="status" required>
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-orange">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

<script>
    $(document).ready(function() {

        $('.edit-button').on('click', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var semester = $(this).data('semester');
            var status = $(this).data('status');

            $('#editForm').attr('action', '/admin/tahun_pelajaran/' + id);
            $('#editNamaTahunPelajaran').val(nama);
            $('#editSemester').val(semester);
            $('#editStatus').val(status);
            $('#editModal').modal('show');
        });

        // SweetAlert for Delete
        $('.delete-button').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f83f37",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        url: '/admin/tahun_pelajaran/' + id,
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
                            swal("Error!", "There was an error deleting the data.", "error");
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
