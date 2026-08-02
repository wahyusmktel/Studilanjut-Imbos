@extends('admin.layouts.app')

@section('title', 'Data Kelas')

@section('content')
<!-- Title -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Data Kelas</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="#">Kelas</a></li>
            <li class="active"><span>Data Kelas</span></li>
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
                                <button aria-expanded="false" data-toggle="dropdown" class="btn btn-orange dropdown-toggle" type="button">
                                    Menu <span class="caret"></span>
                                </button>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="#" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Tambah Data</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="fa fa-download"></i> Download Data</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6 text-right">
                        <form method="GET" action="{{ route('admin.kelas.index') }}">
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
                                        <th>Nama Kelompok</th>
                                        <th>Kode Kelompok</th>
                                        <th>Status Kedinasan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kelas as $index => $item)
                                    <tr>
                                        <td>{{ $kelas->firstItem() + $index }}</td>
                                        <td>{{ $item->nama_kelas }}</td>
                                        <td>{{ $item->tingkat_kelas }}</td>
                                        <td>
                                            @if($item->status_kedinasan == 0)
                                                TIDAK
                                            @elseif($item->status_kedinasan == 1)
                                                YA
                                            @elseif($item->status_kedinasan == 2)
                                                KELAS GABUNGAN
                                            @else
                                                Tidak Diketahui
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="#" class="mr-25 edit-button" data-toggle="tooltip" data-original-title="Edit" data-id="{{ $item->id }}" data-nama_kelas="{{ $item->nama_kelas }}" data-tingkat_kelas="{{ $item->tingkat_kelas }}" data-status_kedinasan="{{ $item->status_kedinasan }}"> 
                                                <i class="fa fa-pencil text-inverse m-r-10"></i> 
                                            </a> 
                                            <a href="#" class="delete-button" data-id="{{ $item->id }}" data-toggle="tooltip" data-original-title="Delete"> 
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
                                {{ $kelas->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
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
            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Kelompok</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelompok</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Nama Kelompok" required>
                    </div>
                    <div class="form-group">
                        <label for="tingkat_kelas">Kode Kelompok</label>
                        <input type="text" class="form-control" id="tingkat_kelas" name="tingkat_kelas" placeholder="Kode Kelompok" required>
                    </div>
                    <div class="form-group">
                        <label for="status_kedinasan">Status Kedinasan</label>
                        <select name="status_kedinasan" id="status_kedinasan" class="form-control" required>
                            <option>Pilih Salah Satu</option>
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                            <option value="2">Kelas Gabungan</option>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Data Kelompok</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNamaKelas">Nama Kelompok</label>
                        <input type="text" class="form-control" id="editNamaKelas" name="nama_kelas" placeholder="Nama Kelompok" required>
                    </div>
                    <div class="form-group">
                        <label for="editTingkatKelas">Kode Kelompok</label>
                        <input type="text" class="form-control" id="editTingkatKelas" name="tingkat_kelas" placeholder="Kode Kelompok" required>
                    </div>
                    <div class="form-group">
                        <label for="editStatusKedinasan">Status Kedinasan</label>
                        <select name="status_kedinasan" id="editStatusKedinasan" class="form-control" required>
                            <option>Pilih Salah Satu</option>
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                            <option value="2">Kelas Gabungan</option>
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
            var namaKelas = $(this).data('nama_kelas');
            var tingkatKelas = $(this).data('tingkat_kelas');
            var status_kedinasan = $(this).data('status_kedinasan');

            $('#editForm').attr('action', '/admin/kelas/' + id);
            $('#editNamaKelas').val(namaKelas);
            $('#editTingkatKelas').val(tingkatKelas);
            $('#editStatusKedinasan').val(status_kedinasan);
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
                        url: '/admin/kelas/' + id,
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
