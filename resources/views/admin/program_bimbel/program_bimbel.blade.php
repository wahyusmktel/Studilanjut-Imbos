@extends('admin.layouts.app')

@section('title', 'Data Program Bimbel')

@section('content')
<!-- Title -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Data Program Bimbel</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="#">Program Bimbel</a></li>
            <li class="active"><span>Data Program Bimbel</span></li>
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
                        <form method="GET" action="{{ route('admin.program_bimbel.index') }}">
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
                                        <th>Nama Program</th>
                                        <th>Deskripsi Program</th>
                                        <th>Icon Program</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($programBimbels as $index => $program)
                                    <tr>
                                        <td>{{ $programBimbels->firstItem() + $index }}</td>
                                        <td>{{ $program->nama_program }}</td>
                                        <td>{{ $program->deskripsi_program }}</td>
                                        <td><img src="{{ asset('uploads/icons/' . $program->icon_program) }}" alt="icon" width="50"></td>
                                        <td class="text-nowrap">
                                            <a href="#" class="mr-25 edit-button" data-toggle="tooltip" data-original-title="Edit" data-id="{{ $program->id }}" data-nama_program="{{ $program->nama_program }}" data-deskripsi_program="{{ $program->deskripsi_program }}" data-icon_program="{{ $program->icon_program }}"> 
                                                <i class="fa fa-pencil text-inverse m-r-10"></i> 
                                            </a> 
                                            <a href="#" class="delete-button" data-id="{{ $program->id }}" data-toggle="tooltip" data-original-title="Delete"> 
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
                                {{ $programBimbels->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
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
            <form action="{{ route('admin.program_bimbel.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Program Bimbel</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_program">Nama Program</label>
                        <input type="text" class="form-control" id="nama_program" name="nama_program" placeholder="Nama Program" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_program">Deskripsi Program</label>
                        <textarea class="form-control" id="deskripsi_program" name="deskripsi_program" placeholder="Deskripsi Program" required></textarea>
                    </div>
                    {{-- <div class="form-group">
                        <label for="icon_program">Icon Program</label>
                        <input type="file" class="dropify" id="icon_program" name="icon_program" required />
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
                    <h5 class="modal-title" id="editModalLabel">Edit Data Program Bimbel</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNamaProgram">Nama Program</label>
                        <input type="text" class="form-control" id="editNamaProgram" name="nama_program" placeholder="Nama Program" required>
                    </div>
                    <div class="form-group">
                        <label for="editDeskripsiProgram">Deskripsi Program</label>
                        <textarea class="form-control" id="editDeskripsiProgram" name="deskripsi_program" placeholder="Deskripsi Program" required></textarea>
                    </div>
                    {{-- <div class="form-group">
                        <label for="editIconProgram">Icon Program</label>
                        <input type="file" class="dropify" id="editIconProgram" name="icon_program" />
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
            var nama_program = $(this).data('nama_program');
            var deskripsi_program = $(this).data('deskripsi_program');
            var icon_program = $(this).data('icon_program');

            $('#editForm').attr('action', '/admin/program_bimbel/' + id);
            $('#editNamaProgram').val(nama_program);
            $('#editDeskripsiProgram').val(deskripsi_program);
            $('#editIconProgram').val(icon_program);
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
                        url: '/admin/program_bimbel/' + id,
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
