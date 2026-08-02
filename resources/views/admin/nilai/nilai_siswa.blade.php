@extends('admin.layouts.app')

@section('title', 'Data Nilai Siswa')

@section('content')
<!-- Title Breadcrumb -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Data Nilai Siswa</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="#">Nilai</a></li>
            <li class="active"><span>Data Nilai Siswa</span></li>
        </ol>
    </div>
</div>
<!-- /Title Breadcrumb -->

<!-- Main Table Card -->
<div class="modern-table-card">
    <!-- Header Controls: Actions + Search -->
    <div class="modern-table-header">
        <div class="modern-table-actions">
            <a href="{{ url('/admin/nilai') }}" class="btn-modern btn-modern-primary">
                <i class="fa-solid fa-plus"></i>
                <span>Kelola & Input Nilai</span>
            </a>
        </div>
        <form method="GET" action="{{ route('admin.nilai-siswa.index') }}" class="modern-search-bar">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" id="search" name="search" class="form-control" placeholder="Cari nama siswa..." value="{{ $search }}">
        </form>
    </div>

    <!-- Table Responsive Wrapper -->
    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="60" class="text-center">No</th>
                        <th>Nama Siswa</th>
                        <th>Kelompok / Kelas</th>
                        <th width="160" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswas as $index => $siswa)
                    <tr>
                        <td class="text-center font-weight-600">{{ method_exists($siswas, 'firstItem') && $siswas->firstItem() ? $siswas->firstItem() + $index : $loop->iteration }}</td>
                        <td>
                            <div class="user-info-cell">
                                @if($siswa->foto)
                                    <img src="{{ asset('storage/' . $siswa->foto) }}" alt="{{ $siswa->nama_siswa }}" class="user-avatar">
                                @else
                                    <div class="user-avatar-placeholder">
                                        {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="user-info-text">
                                    <span class="user-name">{{ $siswa->nama_siswa }}</span>
                                    @if($siswa->nis)
                                        <span class="user-subtext"><i class="fa-solid fa-id-card"></i> NIS: {{ $siswa->nis }}</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge-modern primary">
                                <i class="fa-solid fa-sitemap mr-5"></i>{{ $siswa->kelas ? $siswa->kelas->nama_kelas : 'Tidak Ditemukan' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-btn-group justify-content-center">
                                <a href="{{ route('admin.nilai.detail', $siswa->id) }}" class="btn-action btn-action-edit" data-toggle="tooltip" title="Lihat Detail Nilai">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="#" class="btn-action btn-action-delete delete-button" data-id="{{ $siswa->id }}" data-toggle="tooltip" title="Hapus Data Nilai Siswa">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            <div class="empty-state">
                                <i class="fa-solid fa-chart-line fa-2x mb-2"></i>
                                <p>Belum ada data nilai siswa.</p>
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
            @if(method_exists($siswas, 'total'))
                Menampilkan {{ $siswas->firstItem() ?? 0 }} - {{ $siswas->lastItem() ?? 0 }} dari {{ $siswas->total() }} data
            @elseif(method_exists($siswas, 'firstItem'))
                Menampilkan Halaman {{ $siswas->currentPage() }} ({{ $siswas->firstItem() ?? 0 }} - {{ $siswas->lastItem() ?? 0 }} data)
            @elseif(is_countable($siswas))
                Total {{ count($siswas) }} data
            @endif
        </div>
        @if(method_exists($siswas, 'links'))
        <div>
            {{ $siswas->appends(request()->query())->links('vendor.pagination.custom') }}
        </div>
        @endif
    </div>
</div>

<script>
    $(document).ready(function() {
        // SweetAlert for Delete
        $('.delete-button').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                title: "Apakah Anda Yakin?",
                text: "Tindakan ini akan menghapus semua data nilai pada siswa yang dipilih!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '/admin/nilai/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(result) {
                            swal({
                                title: "Terhapus!",
                                text: result.success || "Data nilai siswa berhasil dihapus.",
                                type: "success",
                                confirmButtonText: "OK"
                            }, function() {
                                location.reload();
                            });
                        },
                        error: function() {
                            swal("Gagal!", "Terjadi kesalahan saat menghapus data nilai.", "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
