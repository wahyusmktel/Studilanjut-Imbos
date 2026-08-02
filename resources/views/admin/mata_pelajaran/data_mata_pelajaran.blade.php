@extends('admin.layouts.app')

@section('title', 'Data Mata Pelajaran')

@section('content')
<!-- Title -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Data Mata Pelajaran</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="#">Master Data</a></li>
            <li class="active"><span>Data Mata Pelajaran</span></li>
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
                                    <li><a href="#" data-toggle="modal" data-target="#importModal"><i class="fa fa-upload"></i> Import Data</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="fa fa-download"></i> Download Data</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6 text-right">
                        <form method="GET" action="{{ route('admin.mata_pelajaran.index') }}">
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
                                        <th>Nama Mata Pelajaran</th>
                                        <th>Kode Mapel</th>
                                        <th>Status</th>
                                        <th>Mapel Kedinasan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mataPelajaran as $index => $mp)
                                    <tr>
                                        <td>{{ $mataPelajaran->firstItem() + $index }}</td>
                                        <td>{{ $mp->namaMataPelajaran }}</td>
                                        <td>{{ str_replace('_', ' ', strtoupper($mp->kode_mapel)) }}</td>
                                        <td>{{ $mp->status }}</td>
                                        <td>{{ $mp->opsi_kedinasan ? 'YA' : 'BUKAN' }}</td>
                                        <td class="text-nowrap">
                                            <a href="#" class="mr-25 edit-button" data-id="{{ $mp->id }}" data-nama="{{ $mp->namaMataPelajaran }}" data-kodemapel="{{ $mp->kode_mapel }}" data-status="{{ $mp->status }}" data-opsi_kedinasan="{{ $mp->opsi_kedinasan }}" data-toggle="tooltip" data-original-title="Edit"> 
                                                <i class="fa fa-pencil text-inverse m-r-10"></i> 
                                            </a> 
                                            <a href="#" class="delete-button" data-id="{{ $mp->id }}" data-toggle="tooltip" data-original-title="Delete"> 
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
                            {{-- <nav class="pagination-wrap d-inline-block" aria-label="Page navigation example">
                                <ul class="pagination custom-pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="#">15</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav> --}}
                            {{-- <nav class="pagination-wrap d-inline-block" aria-label="Page navigation example">
                                {{ $mataPelajaran->links('vendor.pagination.custom') }}
                            </nav> --}}
                            <nav class="pagination-wrap d-inline-block" aria-label="Page navigation example">
                                {{ $mataPelajaran->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
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
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="addModalLabel">Tambah Data Mata Pelajaran</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.mata_pelajaran.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="namaMataPelajaran">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" id="namaMataPelajaran" name="namaMataPelajaran" placeholder="Nama Mata Pelajaran" required>
                    </div>
                    <div class="form-group">
                        <label for="kode_mapel">Kode Mapel</label>
                        <input type="text" class="form-control" id="kode_mapel" name="kode_mapel" placeholder="Kode Mapel" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="opsi_kedinasan">Apakah Mapel Kedinasan</label>
                        <select class="form-control" id="opsi_kedinasan" name="opsi_kedinasan" required>
                            <option value="0">Bukan</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-orange">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="editModalLabel">Edit Data Mata Pelajaran</h5>
            </div>
            <div class="modal-body">
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="editNamaMataPelajaran">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" id="editNamaMataPelajaran" name="namaMataPelajaran" placeholder="Nama Mata Pelajaran" required>
                    </div>
                    <div class="form-group">
                        <label for="editKode_Mapel">Kode Mapel</label>
                        <input type="text" class="form-control" id="editKode_Mapel" name="kode_mapel" placeholder="Kode Mapel" required>
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status</label>
                        <select class="form-control" id="editStatus" name="status" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editOpsiKedinasan">Apakah Mapel Kedinasan</label>
                        <select class="form-control" id="editOpsiKedinasan" name="opsi_kedinasan" required>
                            <option value="0">Bukan</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-orange">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Import Data -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="importModalLabel">Import Data Mata Pelajaran</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="importMataPelajaran">Upload File Data Mata Pelajaran</label>
                        <input type="file" class="dropify" id="importMataPelajaran" />
                        <span class="help-block mt-10 mb-0"><small>Download format import data mata pelajaran <a href="">disini</a>.</small></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-orange">Import Data</button>
            </div>
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
    $(function() {
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
                        url: '/admin/mata_pelajaran/' + id,
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
    
        // Edit Button Click
        $('.edit-button').on('click', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var kodemapel = $(this).data('kodemapel');
            var status = $(this).data('status');
            var opsi_kedinasan = $(this).data('opsi_kedinasan');
            $('#editNamaMataPelajaran').val(nama);
            $('#editKode_Mapel').val(kodemapel);
            $('#editStatus').val(status);
            $('#editOpsiKedinasan').val(opsi_kedinasan);
            $('#editForm').attr('action', '/admin/mata_pelajaran/' + id);
            $('#editModal').modal('show');
        });
    });
    </script>

@endsection
