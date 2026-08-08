@extends('admin.layouts.app')

@section('title', 'Data Kelas')

@section('content')
<!-- Title Breadcrumb -->
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
<!-- /Title Breadcrumb -->

<!-- Main Table Card -->
<div class="modern-table-card">
    <!-- Header Controls: Actions + Search -->
    <div class="modern-table-header">
        <div class="modern-table-actions">
            <button type="button" class="btn-modern btn-modern-primary" data-toggle="modal" data-target="#addModal">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Data Kelompok</span>
            </button>
        </div>
        <form method="GET" action="{{ route('admin.kelas.index') }}" class="modern-search-bar">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" id="search" name="search" class="form-control" placeholder="Cari nama / kode kelas..." value="{{ request('search') }}">
        </form>
    </div>

    <!-- Table Responsive Wrapper -->
    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Kelompok</th>
                        <th>Kode Kelompok</th>
                        <th>Status Kedinasan</th>
                        <th>Jumlah Anggota</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelas as $index => $item)
                    <tr>
                        <td class="text-center font-weight-600">{{ method_exists($kelas, 'firstItem') && $kelas->firstItem() ? $kelas->firstItem() + $index : $index + 1 }}</td>
                        <td>
                            <span class="font-weight-600 color-primary">{{ $item->nama_kelas }}</span>
                        </td>
                        <td>
                            <code style="background: #f1f5f9; color: #475569; padding: 3px 8px; border-radius: 6px; font-weight: 600;">{{ $item->tingkat_kelas }}</code>
                        </td>
                        <td>
                            @if($item->status_kedinasan == 0)
                                <span class="badge-modern neutral">Tidak</span>
                            @elseif($item->status_kedinasan == 1)
                                <span class="badge-modern primary"><i class="fa-solid fa-building-columns"></i> Ya</span>
                            @elseif($item->status_kedinasan == 2)
                                <span class="badge-modern success"><i class="fa-solid fa-people-group"></i> Kelas Gabungan</span>
                            @else
                                <span class="badge-modern neutral">Tidak Diketahui</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.kelas.anggota', $item->id) }}" class="badge-modern primary" title="Lihat anggota kelas">
                                <i class="fa-solid fa-users"></i> {{ $item->anggota_count }} siswa
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="action-btn-group justify-content-center">
                                <a href="{{ route('admin.kelas.anggota', $item->id) }}" class="btn-action" style="color:#2563eb;" data-toggle="tooltip" title="Lihat Anggota Kelas">
                                    <i class="fa-solid fa-users"></i>
                                </a>
                                <a href="#" class="btn-action btn-action-edit edit-button" 
                                   data-toggle="tooltip" 
                                   title="Edit Kelompok" 
                                   data-id="{{ $item->id }}" 
                                   data-nama_kelas="{{ $item->nama_kelas }}" 
                                   data-tingkat_kelas="{{ $item->tingkat_kelas }}" 
                                   data-status_kedinasan="{{ $item->status_kedinasan }}"> 
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a> 
                                <a href="#" class="btn-action btn-action-delete delete-button" 
                                   data-id="{{ $item->id }}" 
                                   data-toggle="tooltip" 
                                   title="Hapus Kelompok"> 
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <div class="empty-state">
                                <i class="fa-solid fa-users-rectangle fa-2x mb-2"></i>
                                <p>Belum ada data kelompok / kelas.</p>
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
            @if(method_exists($kelas, 'total'))
                Menampilkan {{ $kelas->firstItem() ?? 0 }} - {{ $kelas->lastItem() ?? 0 }} dari {{ $kelas->total() }} data
            @elseif(method_exists($kelas, 'firstItem'))
                Menampilkan Halaman {{ $kelas->currentPage() }} ({{ $kelas->firstItem() ?? 0 }} - {{ $kelas->lastItem() ?? 0 }} data)
            @elseif(is_countable($kelas))
                Total {{ count($kelas) }} data
            @endif
        </div>
        @if(method_exists($kelas, 'links'))
        <div>
            {{ $kelas->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
        </div>
        @endif
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="addModalLabel"><i class="fa-solid fa-plus mr-8 text-primary"></i> Tambah Data Kelompok</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelompok</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Contoh: XII IPA 1" required>
                    </div>
                    <div class="form-group">
                        <label for="tingkat_kelas">Kode Kelompok</label>
                        <input type="text" class="form-control" id="tingkat_kelas" name="tingkat_kelas" placeholder="Contoh: K-XII-1" required>
                    </div>
                    <div class="form-group mb-0">
                        <label for="status_kedinasan">Status Kedinasan</label>
                        <select name="status_kedinasan" id="status_kedinasan" class="form-control" required>
                            <option value="">-- Pilih Status Kedinasan --</option>
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                            <option value="2">Kelas Gabungan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modern btn-modern-primary">Simpan Kelompok</button>
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
                    <h5 class="modal-title" id="editModalLabel"><i class="fa-solid fa-pen-to-square mr-8 text-primary"></i> Edit Data Kelompok</h5>
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
                    <div class="form-group mb-0">
                        <label for="editStatusKedinasan">Status Kedinasan</label>
                        <select name="status_kedinasan" id="editStatusKedinasan" class="form-control" required>
                            <option value="">-- Pilih Status Kedinasan --</option>
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                            <option value="2">Kelas Gabungan</option>
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
                title: "Apakah Anda Yakin?",
                text: "Data kelompok ini akan dihapus permanen dari sistem!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                closeOnConfirm: false
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
                                title: "Terhapus!",
                                text: result.success || "Data kelompok berhasil dihapus.",
                                type: "success",
                                confirmButtonText: "OK"
                            }, function() {
                                location.reload();
                            });
                        },
                        error: function() {
                            swal("Gagal!", "Terjadi kesalahan saat menghapus data kelompok.", "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
