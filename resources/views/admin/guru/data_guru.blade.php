@extends('admin.layouts.app')

@section('title', 'Data Guru')

@section('content')
<!-- Title Breadcrumb -->
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
<!-- /Title Breadcrumb -->

<!-- Main Table Card -->
<div class="modern-table-card">
    <!-- Header Controls: Actions + Search -->
    <div class="modern-table-header">
        <div class="modern-table-actions">
            <button type="button" class="btn-modern btn-modern-primary" data-toggle="modal" data-target="#addModal">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Data Guru</span>
            </button>
            <button type="button" class="btn-modern btn-modern-secondary" data-toggle="modal" data-target="#importModal">
                <i class="fa-solid fa-file-import"></i>
                <span>Import Data</span>
            </button>
        </div>
        <form method="GET" action="{{ route('admin.guru.data_guru') }}" class="modern-search-bar">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" id="search" name="search" class="form-control" placeholder="Cari nama guru / NIP..." value="{{ request('search') }}">
        </form>
    </div>

    <!-- Table Responsive Wrapper -->
    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Mata Pelajaran</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gurus as $index => $guru)
                    <tr>
                        <td class="text-center font-weight-600">{{ method_exists($gurus, 'firstItem') && $gurus->firstItem() ? $gurus->firstItem() + $index : $index + 1 }}</td>
                        <td>
                            <div class="user-info-cell">
                                @if($guru->foto)
                                    <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama }}" class="user-avatar">
                                @else
                                    <div class="user-avatar-placeholder">
                                        {{ strtoupper(substr($guru->nama, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="user-info-text">
                                    <span class="user-name">{{ $guru->nama }}</span>
                                    @if($guru->tempat_lahir || $guru->tanggal_lahir)
                                        <span class="user-subtext">
                                            <i class="fa-solid fa-cake-candles"></i>
                                            {{ $guru->tempat_lahir ? $guru->tempat_lahir . ', ' : '' }}{{ $guru->tanggal_lahir ? date('d M Y', strtotime($guru->tanggal_lahir)) : '' }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($guru->nip)
                                <code style="background: #f1f5f9; color: #475569; padding: 3px 8px; border-radius: 6px; font-weight: 600;">{{ $guru->nip }}</code>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge-modern primary">
                                <i class="fa-solid fa-book-open mr-5"></i>{{ $guru->mataPelajaran ? $guru->mataPelajaran->namaMataPelajaran : '-' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-btn-group justify-content-center">
                                <a href="#" class="btn-action btn-action-edit edit-button" 
                                   data-toggle="tooltip" 
                                   title="Edit Guru" 
                                   data-id="{{ $guru->id }}" 
                                   data-nama="{{ $guru->nama }}" 
                                   data-nip="{{ $guru->nip }}" 
                                   data-mata-pelajaran-id="{{ $guru->mata_pelajaran_id }}" 
                                   data-tempat-lahir="{{ $guru->tempat_lahir }}" 
                                   data-tanggal-lahir="{{ $guru->tanggal_lahir }}" 
                                   data-motto="{{ $guru->motto }}"> 
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a> 
                                <a href="#" class="btn-action btn-action-delete delete-button" 
                                   data-id="{{ $guru->id }}" 
                                   data-toggle="tooltip" 
                                   title="Hapus Guru"> 
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <div class="empty-state">
                                <i class="fa-solid fa-chalkboard-user fa-2x mb-2"></i>
                                <p>Belum ada data guru.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination Footer -->
    <div class="modern-table-header border-top" style="border-bottom: none; background: #fafafa;">
        <div class="text-muted small">
            @if(method_exists($gurus, 'total'))
                Menampilkan {{ $gurus->firstItem() ?? 0 }} - {{ $gurus->lastItem() ?? 0 }} dari {{ $gurus->total() }} data
            @elseif(method_exists($gurus, 'firstItem'))
                Menampilkan Halaman {{ $gurus->currentPage() }} ({{ $gurus->firstItem() ?? 0 }} - {{ $gurus->lastItem() ?? 0 }} data)
            @elseif(is_countable($gurus))
                Total {{ count($gurus) }} data
            @endif
        </div>
        @if(method_exists($gurus, 'links'))
        <div>
            {{ $gurus->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
        </div>
        @endif
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="addModalLabel"><i class="fa-solid fa-plus mr-8 text-primary"></i> Tambah Data Guru</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Guru</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap Guru" required>
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP Guru</label>
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP Guru (Opsional)">
                    </div>
                    <div class="form-group">
                        <label for="mata_pelajaran_id">Mata Pelajaran</label>
                        <select class="form-control" id="mata_pelajaran_id" name="mata_pelajaran_id" required>
                            @foreach($mataPelajarans as $mataPelajaran)
                                <option value="{{ $mataPelajaran->id }}">{{ $mataPelajaran->namaMataPelajaran }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="motto">Motto</label>
                        <textarea name="motto" id="motto" rows="3" class="form-control" placeholder="Motto Hidup / Mengajar"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label for="foto">Upload Foto Guru</label>
                        <input type="file" class="dropify" id="foto" name="foto" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modern btn-modern-primary">Simpan Data Guru</button>
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
                    <h5 class="modal-title" id="editModalLabel"><i class="fa-solid fa-pen-to-square mr-8 text-primary"></i> Edit Data Guru</h5>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editTempatLahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="editTempatLahir" name="tempat_lahir" placeholder="Tempat Lahir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editTanggalLahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="editTanggalLahir" name="tanggal_lahir">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editMotto">Motto</label>
                        <textarea name="motto" id="editMotto" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editPassword">Password <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                                <input type="password" id="editPassword" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editPasswordConfirmation">Konfirmasi Password</label>
                                <input type="password" id="editPasswordConfirmation" name="password_confirmation" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label for="editFoto">Upload Foto Guru Baru</label>
                        <input type="file" class="dropify" id="editFoto" name="foto" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modern btn-modern-primary">Simpan Perubahan</button>
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
                <h5 class="modal-title" id="importModalLabel"><i class="fa-solid fa-file-import mr-8 text-primary"></i> Import Data Guru</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="importGuru">Upload File Excel / CSV Data Guru</label>
                        <input type="file" class="dropify" id="importGuru" />
                        <span class="help-block mt-10 mb-0"><small>Download format import data guru <a href="#" class="text-primary font-weight-600">di sini</a>.</small></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn-modern btn-modern-primary">Import Data</button>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<script>
    $(document).ready(function() {
        setTimeout(function() {
            swal({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                type: "success",
                confirmButtonText: "OK"
            });
        }, 500);
    });
</script>
@endif

<script>
    $(document).ready(function() {
        // Edit button handler
        $('.edit-button').on('click', function(e) {
            e.preventDefault();
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
                title: "Apakah Anda Yakin?",
                text: "Data guru ini akan dihapus permanen dari sistem!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                closeOnConfirm: false
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
                                title: "Terhapus!",
                                text: result.success || "Data guru berhasil dihapus.",
                                type: "success",
                                confirmButtonText: "OK"
                            }, function() {
                                location.reload();
                            });
                        },
                        error: function() {
                            swal("Gagal!", "Terjadi kesalahan saat menghapus data guru.", "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endsection