@extends('admin.layouts.app')

@section('title', 'Data Mata Pelajaran')

@section('content')
<!-- Title Breadcrumb -->
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
<!-- /Title Breadcrumb -->

<!-- Main Table Card -->
<div class="modern-table-card">
    <!-- Header Controls: Actions + Search -->
    <div class="modern-table-header">
        <div class="modern-table-actions">
            <button type="button" class="btn-modern btn-modern-primary" data-toggle="modal" data-target="#addModal">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Data</span>
            </button>
            <button type="button" class="btn-modern btn-modern-secondary" data-toggle="modal" data-target="#importModal">
                <i class="fa-solid fa-file-import"></i>
                <span>Import Data</span>
            </button>
        </div>
        <form method="GET" action="{{ route('admin.mata_pelajaran.index') }}" class="modern-search-bar">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" id="search" name="search" class="form-control" placeholder="Cari mata pelajaran..." value="{{ request('search') }}">
        </form>
    </div>

    <!-- Table Responsive Wrapper -->
    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Kode Mapel</th>
                        <th>Status</th>
                        <th>Mapel Kedinasan</th>
                        <th width="100" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mataPelajaran as $index => $mp)
                    <tr>
                        <td class="text-center font-weight-600">{{ $mataPelajaran->firstItem() + $index }}</td>
                        <td>
                            <span class="font-weight-600 color-primary">{{ $mp->namaMataPelajaran }}</span>
                        </td>
                        <td>
                            <code style="background: #f1f5f9; color: #475569; padding: 3px 8px; border-radius: 6px; font-weight: 600;">{{ str_replace('_', ' ', strtoupper($mp->kode_mapel)) }}</code>
                        </td>
                        <td>
                            @if(strtolower($mp->status) === 'aktif')
                                <span class="badge-modern success"><i class="fa-solid fa-circle-check"></i> Aktif</span>
                            @else
                                <span class="badge-modern danger"><i class="fa-solid fa-circle-xmark"></i> {{ $mp->status }}</span>
                            @endif
                        </td>
                        <td>
                            @if($mp->opsi_kedinasan)
                                <span class="badge-modern primary"><i class="fa-solid fa-building-columns"></i> Ya</span>
                            @else
                                <span class="badge-modern neutral">Bukan</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="action-btn-group justify-content-center">
                                <a href="#" class="btn-action btn-action-edit edit-button" 
                                   data-id="{{ $mp->id }}" 
                                   data-nama="{{ $mp->namaMataPelajaran }}" 
                                   data-kodemapel="{{ $mp->kode_mapel }}" 
                                   data-status="{{ $mp->status }}" 
                                   data-opsi_kedinasan="{{ $mp->opsi_kedinasan }}" 
                                   data-toggle="tooltip" 
                                   title="Edit"> 
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a> 
                                <a href="#" class="btn-action btn-action-delete delete-button" 
                                   data-id="{{ $mp->id }}" 
                                   data-toggle="tooltip" 
                                   title="Hapus"> 
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <div class="empty-state">
                                <i class="fa-solid fa-folder-open fa-2x mb-2"></i>
                                <p>Belum ada data mata pelajaran.</p>
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
            @if(method_exists($mataPelajaran, 'total'))
                Menampilkan {{ $mataPelajaran->firstItem() ?? 0 }} - {{ $mataPelajaran->lastItem() ?? 0 }} dari {{ $mataPelajaran->total() }} data
            @elseif(method_exists($mataPelajaran, 'firstItem'))
                Menampilkan Halaman {{ $mataPelajaran->currentPage() }} ({{ $mataPelajaran->firstItem() ?? 0 }} - {{ $mataPelajaran->lastItem() ?? 0 }} data)
            @elseif(is_countable($mataPelajaran))
                Total {{ count($mataPelajaran) }} data
            @endif
        </div>
        @if(method_exists($mataPelajaran, 'links'))
        <div>
            {{ $mataPelajaran->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
        </div>
        @endif
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="addModalLabel"><i class="fa-solid fa-plus mr-8 text-primary"></i> Tambah Data Mata Pelajaran</h5>
            </div>
            <form action="{{ route('admin.mata_pelajaran.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namaMataPelajaran">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" id="namaMataPelajaran" name="namaMataPelajaran" placeholder="Contoh: Pemahaman Bacaan dan Menulis" required>
                    </div>
                    <div class="form-group">
                        <label for="kode_mapel">Kode Mapel</label>
                        <input type="text" class="form-control" id="kode_mapel" name="kode_mapel" placeholder="Contoh: PBM" required>
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
                    <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modern btn-modern-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="editModalLabel"><i class="fa-solid fa-pen-to-square mr-8 text-primary"></i> Edit Data Mata Pelajaran</h5>
            </div>
            <form id="editForm" action="" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
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
                <h5 class="modal-title" id="importModalLabel"><i class="fa-solid fa-file-import mr-8 text-primary"></i> Import Data Mata Pelajaran</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="importMataPelajaran">Upload File Excel / CSV Data Mata Pelajaran</label>
                        <input type="file" class="dropify" id="importMataPelajaran" />
                        <span class="help-block mt-10 mb-0"><small>Download format import data mata pelajaran <a href="#" class="text-primary font-weight-600">di sini</a>.</small></span>
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

<script>
$(document).ready(function() {
    // Edit modal handler
    $('.edit-button').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var kodeMapel = $(this).data('kodemapel');
        var status = $(this).data('status');
        var opsiKedinasan = $(this).data('opsi_kedinasan');

        $('#editNamaMataPelajaran').val(nama);
        $('#editKode_Mapel').val(kodeMapel);
        $('#editStatus').val(status);
        $('#editOpsiKedinasan').val(opsiKedinasan);

        $('#editForm').attr('action', '/admin/mata_pelajaran/update/' + id);
        $('#editModal').modal('show');
    });

    // Delete SweetAlert handler
    $('.delete-button').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: "Apakah Anda Yakin?",
            text: "Data mata pelajaran ini akan dihapus permanen!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ef4444",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
            closeOnConfirm: false
        }, function(){
            window.location.href = '/admin/mata_pelajaran/delete/' + id;
        });
    });
});
</script>

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
@endsection
