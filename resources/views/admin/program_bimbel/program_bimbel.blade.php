@extends('admin.layouts.app')

@section('title', 'Data Program Bimbel')

@section('content')
<!-- Title Breadcrumb -->
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
<!-- /Title Breadcrumb -->

<!-- Main Table Card -->
<div class="modern-table-card">
    <!-- Header Controls: Actions + Search -->
    <div class="modern-table-header">
        <div class="modern-table-actions">
            <button type="button" class="btn-modern btn-modern-primary" data-toggle="modal" data-target="#addModal">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Program Bimbel</span>
            </button>
        </div>
        <form method="GET" action="{{ route('admin.program_bimbel.index') }}" class="modern-search-bar">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" id="search" name="search" class="form-control" placeholder="Cari program bimbel..." value="{{ request('search') }}">
        </form>
    </div>

    <!-- Table Responsive Wrapper -->
    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Program</th>
                        <th>Deskripsi Program</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programBimbels as $index => $program)
                    <tr>
                        <td class="text-center font-weight-600">{{ method_exists($programBimbels, 'firstItem') && $programBimbels->firstItem() ? $programBimbels->firstItem() + $index : $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-10">
                                <span class="badge-modern primary"><i class="fa-solid fa-graduation-cap"></i></span>
                                <span class="font-weight-600 color-primary">{{ $program->nama_program }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="text-muted">{{ Str::limit($program->deskripsi_program, 100) }}</span>
                        </td>
                        <td class="text-center">
                            <div class="action-btn-group justify-content-center">
                                <a href="#" class="btn-action btn-action-edit edit-button" 
                                   data-toggle="tooltip" 
                                   title="Edit Program" 
                                   data-id="{{ $program->id }}" 
                                   data-nama_program="{{ $program->nama_program }}" 
                                   data-deskripsi_program="{{ $program->deskripsi_program }}" 
                                   data-icon_program="{{ $program->icon_program }}"> 
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a> 
                                <a href="#" class="btn-action btn-action-delete delete-button" 
                                   data-id="{{ $program->id }}" 
                                   data-toggle="tooltip" 
                                   title="Hapus Program"> 
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            <div class="empty-state">
                                <i class="fa-solid fa-book-bookmark fa-2x mb-2"></i>
                                <p>Belum ada data program bimbel.</p>
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
            @if(method_exists($programBimbels, 'total'))
                Menampilkan {{ $programBimbels->firstItem() ?? 0 }} - {{ $programBimbels->lastItem() ?? 0 }} dari {{ $programBimbels->total() }} data
            @elseif(method_exists($programBimbels, 'firstItem'))
                Menampilkan Halaman {{ $programBimbels->currentPage() }} ({{ $programBimbels->firstItem() ?? 0 }} - {{ $programBimbels->lastItem() ?? 0 }} data)
            @elseif(is_countable($programBimbels))
                Total {{ count($programBimbels) }} data
            @endif
        </div>
        @if(method_exists($programBimbels, 'links'))
        <div>
            {{ $programBimbels->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
        </div>
        @endif
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.program_bimbel.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="addModalLabel"><i class="fa-solid fa-plus mr-8 text-primary"></i> Tambah Program Bimbel</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_program">Nama Program</label>
                        <input type="text" class="form-control" id="nama_program" name="nama_program" placeholder="Contoh: Bimbel Reguler UTBK" required>
                    </div>
                    <div class="form-group mb-0">
                        <label for="deskripsi_program">Deskripsi Program</label>
                        <textarea class="form-control" id="deskripsi_program" name="deskripsi_program" rows="4" placeholder="Penjelasan mengenai program bimbel ini..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modern btn-modern-primary">Simpan Program</button>
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
                    <h5 class="modal-title" id="editModalLabel"><i class="fa-solid fa-pen-to-square mr-8 text-primary"></i> Edit Program Bimbel</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNamaProgram">Nama Program</label>
                        <input type="text" class="form-control" id="editNamaProgram" name="nama_program" placeholder="Nama Program" required>
                    </div>
                    <div class="form-group mb-0">
                        <label for="editDeskripsiProgram">Deskripsi Program</label>
                        <textarea class="form-control" id="editDeskripsiProgram" name="deskripsi_program" rows="4" placeholder="Deskripsi Program" required></textarea>
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
                title: "Apakah Anda Yakin?",
                text: "Data program bimbel ini akan dihapus permanen dari sistem!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                closeOnConfirm: false
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
                                title: "Terhapus!",
                                text: result.success || "Data program bimbel berhasil dihapus.",
                                type: "success",
                                confirmButtonText: "OK"
                            }, function() {
                                location.reload();
                            });
                        },
                        error: function() {
                            swal("Gagal!", "Terjadi kesalahan saat menghapus data program bimbel.", "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
