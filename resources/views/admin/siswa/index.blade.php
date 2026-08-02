@extends('admin.layouts.app')

@section('title', 'Data Siswa')

@section('content')
<!-- Title -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Data Siswa</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="#">Siswa</a></li>
            <li class="active"><span>Data Siswa</span></li>
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
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6 text-right">
                        <form method="GET" action="{{ route('admin.siswa.index') }}">
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
                                        <th>Nama Siswa</th>
                                        <th>Kelompok</th>
                                        <th>Program Bimbel</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($siswas as $index => $siswa)
                                    <tr>
                                        <td>{{ $siswas->firstItem() + $index }}</td>
                                        <td>{{ $siswa->nama_siswa }}</td>
                                        <td>{{ $siswa->kelas->nama_kelas }}</td>
                                        <td>{{ $siswa->programBimbel->nama_program }}</td>
                                        <td class="text-nowrap">
                                            <a href="#" class="mr-25 edit-button" data-toggle="tooltip" data-original-title="Edit" data-id="{{ $siswa->id }}" data-nama_siswa="{{ $siswa->nama_siswa }}" data-kelas_id="{{ $siswa->kelas_id }}" data-program_bimbel_id="{{ $siswa->program_bimbel_id }}" data-tgl_lahir="{{ $siswa->tgl_lahir }}" data-tmpt_lahir="{{ $siswa->tmpt_lahir }}" data-no_hp="{{ $siswa->no_hp }}" data-nis="{{ $siswa->nis }}"> 
                                                <i class="fa fa-pencil text-inverse m-r-10"></i> 
                                            </a> 
                                            <a href="#" class="delete-button" data-id="{{ $siswa->id }}" data-toggle="tooltip" data-original-title="Delete"> 
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
                                {{ $siswas->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
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
            <form action="{{ route('admin.siswa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Siswa</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kelas_id">Kelompok</label>
                        <select class="form-control" id="kelas_id" name="kelas_id" required>
                            @foreach($kelas as $kls)
                                <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="program_bimbel_id">Program Bimbel</label>
                        <select class="form-control" id="program_bimbel_id" name="program_bimbel_id" required>
                            @foreach($programBimbels as $programBimbel)
                                <option value="{{ $programBimbel->id }}">{{ $programBimbel->nama_program }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                    </div>
                    <div class="form-group">
                        <label for="tmpt_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tmpt_lahir" name="tmpt_lahir" placeholder="Tempat Lahir">
                    </div>
                    <div class="form-group">
                        <label for="no_hp">Nomor HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor HP">
                    </div>
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="number" class="form-control" id="nis" name="nis" placeholder="NIS" required>
                    </div>
                    <div class="form-group">
                        <label for="foto">Upload Foto</label>
                        <input type="file" class="dropify" id="foto" name="foto" />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Data Siswa</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editKelasId">Kelompok</label>
                        <select class="form-control" id="editKelasId" name="kelas_id" required>
                            @foreach($kelas as $kls)
                                <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editProgramBimbelId">Program Bimbel</label>
                        <select class="form-control" id="editProgramBimbelId" name="program_bimbel_id" required>
                            @foreach($programBimbels as $programBimbel)
                                <option value="{{ $programBimbel->id }}">{{ $programBimbel->nama_program }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editNamaSiswa">Nama Siswa</label>
                        <input type="text" class="form-control" id="editNamaSiswa" name="nama_siswa" placeholder="Nama Siswa" required>
                    </div>
                    <div class="form-group">
                        <label for="editTglLahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="editTglLahir" name="tgl_lahir">
                    </div>
                    <div class="form-group">
                        <label for="editTmptLahir">Tempat Lahir</label>
                        <input type="text" class="form-control" id="editTmptLahir" name="tmpt_lahir" placeholder="Tempat Lahir">
                    </div>
                    <div class="form-group">
                        <label for="editNoHp">Nomor HP</label>
                        <input type="text" class="form-control" id="editNoHp" name="no_hp" placeholder="Nomor HP">
                    </div>
                    <div class="form-group">
                        <label for="editNis">NIS</label>
                        <input type="number" class="form-control" id="editNis" name="nis" placeholder="NIS" required>
                    </div>
                    <div class="form-group">
                        <label for="editFoto">Upload Foto</label>
                        <input type="file" class="dropify" id="editFoto" name="foto" />
                    </div>
                    {{-- <div class="form-group">
                        <label for="editPassword">Password</label>
                        <input type="password" class="form-control" id="editPassword" name="password" placeholder="Password" required>
                    </div> --}}
                    <div class="form-group">
                        <label for="editPassword">Password</label>
                        <input type="password" class="form-control" id="editPassword" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                    </div>
                    <div class="form-group">
                        <label for="editConfirmPassword">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="editConfirmPassword" name="password_confirmation" placeholder="Kosongkan jika tidak ingin mengubah">
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
                <h5 class="modal-title" id="importModalLabel">Import Data Siswa</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="importSiswa">Upload File Data Siswa</label>
                        <input type="file" class="dropify" name="file" id="importSiswa" />
                        <span class="help-block mt-10 mb-0"><small>Download format import data siswa <a href="https://docs.google.com/spreadsheets/d/1BAMIyqZKwtJQO11ewVElX58ogT1Fwifn/edit?usp=sharing&ouid=105663471066731245622&rtpof=true&sd=true" target="_blank">disini</a>.</small></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-orange">Import Data</button>
            </form>
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

<script>
    $(document).ready(function() {

        $('.edit-button').on('click', function() {
            var id = $(this).data('id');
            var nama_siswa = $(this).data('nama_siswa');
            var kelas_id = $(this).data('kelas_id');
            var program_bimbel_id = $(this).data('program_bimbel_id');
            var tgl_lahir = $(this).data('tgl_lahir');
            var tmpt_lahir = $(this).data('tmpt_lahir');
            var no_hp = $(this).data('no_hp');
            var nis = $(this).data('nis');

            $('#editForm').attr('action', '/admin/siswa/' + id);
            $('#editNamaSiswa').val(nama_siswa);
            $('#editKelasId').val(kelas_id);
            $('#editProgramBimbelId').val(program_bimbel_id);
            $('#editTglLahir').val(tgl_lahir);
            $('#editTmptLahir').val(tmpt_lahir);
            $('#editNoHp').val(no_hp);
            $('#editNis').val(nis);
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
                        url: '/admin/siswa/' + id,
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
