@extends('admin.layouts.app')

@section('title', 'Data Guru')

@section('content')
<!-- Title -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Data Guru</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="#">Guru</a></li>
            <li class="active"><span>Data Guru</span></li>
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
                        <form method="GET" action="{{ route('admin.guru.data_guru') }}">
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
                                        <th>Nama Guru</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($gurus as $index => $guru)
                                    <tr>
                                        <td>{{ $gurus->firstItem() + $index }}</td>
                                        <td>{{ $guru->nama }}</td>
                                        <td>{{ $guru->mataPelajaran->namaMataPelajaran }}</td>
                                        <td class="text-nowrap">
                                            <a href="#" class="mr-25 edit-button" data-toggle="tooltip" data-original-title="Edit" data-id="{{ $guru->id }}" data-nama="{{ $guru->nama }}" data-nip="{{ $guru->nip }}" data-mata-pelajaran-id="{{ $guru->mata_pelajaran_id }}" data-tempat-lahir="{{ $guru->tempat_lahir }}" data-tanggal-lahir="{{ $guru->tanggal_lahir }}" data-motto="{{ $guru->motto }}"> 
                                                <i class="fa fa-pencil text-inverse m-r-10"></i> 
                                            </a> 
                                            <a href="#" class="delete-button" data-id="{{ $guru->id }}" data-toggle="tooltip" data-original-title="Delete"> 
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
                {{-- <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <nav class="pagination-wrap d-inline-block" aria-label="Page navigation example">
                                {{ $gurus->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
                            </nav>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<!-- /Row -->

<!-- Modal Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Guru</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Guru</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Guru" required>
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP Guru</label>
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP Guru">
                    </div>
                    <div class="form-group">
                        <label for="mata_pelajaran_id">Mata Pelajaran</label>
                        <select class="form-control" id="mata_pelajaran_id" name="mata_pelajaran_id" required>
                            @foreach($mataPelajarans as $mataPelajaran)
                                <option value="{{ $mataPelajaran->id }}">{{ $mataPelajaran->namaMataPelajaran }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                    </div>
                    <div class="form-group">
                        <label for="motto">Motto</label>
                        <textarea name="motto" id="motto" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="foto">Upload Foto</label>
                        <input type="file" class="dropify" id="foto" name="foto" />
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
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="editModalLabel">Edit Data Guru</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNama">Nama Guru</label>
                        <input type="text" class="form-control" id="editNama" name="nama" placeholder="Nama Guru" required>
                    </div>
                    <div class="form-group">
                        <label for="editNip">NIP Guru</label>
                        <input type="text" class="form-control" id="editNip" name="nip" placeholder="NIP Guru">
                    </div>
                    <div class="form-group">
                        <label for="editMataPelajaranId">Mata Pelajaran</label>
                        <select class="form-control" id="editMataPelajaranId" name="mata_pelajaran_id" required>
                            @foreach($mataPelajarans as $mataPelajaran)
                                <option value="{{ $mataPelajaran->id }}">{{ $mataPelajaran->namaMataPelajaran }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editTempatLahir">Tempat Lahir</label>
                        <input type="text" class="form-control" id="editTempatLahir" name="tempat_lahir" placeholder="Tempat Lahir">
                    </div>
                    <div class="form-group">
                        <label for="editTanggalLahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="editTanggalLahir" name="tanggal_lahir">
                    </div>
                    <div class="form-group">
                        <label for="editMotto">Motto</label>
                        <textarea name="motto" id="editMotto" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editFoto">Upload Foto</label>
                        <input type="file" class="dropify" id="editFoto" name="foto" />
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

<!-- Modal Import Data -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="importModalLabel">Import Data Guru</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="importGuru">Upload File Data Guru</label>
                        <input type="file" class="dropify" id="importGuru" />
                        <span class="help-block mt-10 mb-0"><small>Download format import data guru <a href="">disini</a>.</small></span>
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
    $(document).ready(function() {

        $('.edit-button').on('click', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var nip = $(this).data('nip');
            var mataPelajaranId = $(this).data('mata-pelajaran-id');
            var tempatLahir = $(this).data('tempat-lahir');
            var tanggalLahir = $(this).data('tanggal-lahir');
            var motto = $(this).data('motto');

            $('#editForm').attr('action', '/admin/guru/' + id);
            $('#editNama').val(nama);
            $('#editNip').val(nip);
            $('#editMataPelajaranId').val(mataPelajaranId);
            $('#editTempatLahir').val(tempatLahir);
            $('#editTanggalLahir').val(tanggalLahir);
            $('#editMotto').val(motto);
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
                        url: '/admin/guru/' + id,
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