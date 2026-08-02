@extends('admin.layouts.app')

@section('title', 'Setting Sertifikat')

@section('content')
<!-- Title -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Setting Sertifikat</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a class="active" href="#">Setting Sertifikat</a></li>
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
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6 text-right">
                        <form method="GET" action="{{ route('admin.setting_sertifikat.index') }}">
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
                                        <th>Nama Konfigurasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($settingsertifikats as $index => $settingsertifikat)
                                    <tr>
                                        <td>{{ $settingsertifikats->firstItem() + $index }}</td>
                                        <td>{{ $settingsertifikat->nama_template }}</td>
                                        <td class="text-nowrap">
                                            <a href="#" class="mr-25 edit-button" data-toggle="tooltip" data-original-title="Edit" data-id="{{ $settingsertifikat->id }}" data-nama="{{ $settingsertifikat->nama_template }}" data-logo1="{{ $settingsertifikat->logo_1 }}" data-logo2="{{ $settingsertifikat->logo_2 }}" data-watermark="{{ $settingsertifikat->watermark }}" data-status="{{ $settingsertifikat->status }}"> 
                                                <i class="fa fa-pencil text-inverse m-r-10"></i> 
                                            </a> 
                                            <a href="#" class="delete-button" data-id="{{ $settingsertifikat->id }}" data-toggle="tooltip" data-original-title="Delete"> 
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
                                {{ $settingsertifikats->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
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
            <form action="{{ route('admin.setting_sertifikat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="addModalLabel">Tambah Konfigurasi</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_template">Nama Konfigurasi</label>
                        <input type="text" class="form-control" id="nama_template" name="nama_template" placeholder="Masukan Nama Konfigurasi" required>
                    </div>
                    <div class="form-group">
                        <label for="file">Upload Logo 1</label>
                        <input type="file" name="logo_1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="file">Upload Logo 2</label>
                        <input type="file" name="logo_2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="file">Watermark</label>
                        <input type="file" name="watermark" class="form-control">
                    </div>
                    {{-- <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div> --}}
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
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="editModalLabel">Edit Konfigurasi</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNama_Template">Nama Konfigurasi</label>
                        <input type="text" class="form-control" id="editNama_Template" name="nama_template" placeholder="Masukan Nama Konfigurasi" required>
                    </div>
                    <div class="form-group">
                        <label for="editLogo1">Logo 1</label>
                        <input type="file" class="form-control" id="editLogo1" name="logo_1">
                    </div>
                    <div class="form-group">
                        <label for="editLogo2">Logo 2</label>
                        <input type="file" class="form-control" id="editLogo2" name="logo_2">
                    </div>
                    <div class="form-group">
                        <label for="editWatermark">Watermark</label>
                        <input type="file" class="form-control" id="editWatermark" name="watermark">
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

@if(session('error'))
<script>
    $(document).ready(function() {
        setTimeout(function() {
            swal({
                title: "Error!",
                text: "{{ session('error') }}",
                type: "error",
                confirmButtonText: "OK"
            });
        }, 1000);
    });
</script>
@endif

@if ($errors->any())
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                swal({
                    title: "Error!",
                    text: "{{ $errors->first() }}",
                    type: "error",
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
            var editNama_Template = $(this).data('nama');
            var editLogo1 = $(this).data('logo1');
            var editLogo2 = $(this).data('logo2');
            var editWatermark = $(this).data('watermark');
            var status = $(this).data('status');

            $('#editForm').attr('action', '/admin/setting_sertifikat/' + id);
            $('#editNama_Template').val(editNama_Template);
            $('#editStatus').val(status);
            $('#editModal').modal('show');
        });

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
                        url: '/admin/setting_sertifikat/' + id,
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
