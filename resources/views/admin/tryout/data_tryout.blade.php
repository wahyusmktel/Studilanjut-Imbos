@extends('admin.layouts.app')

@section('title', 'Data Try Out')

@section('content')
<!-- Title Breadcrumb -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Data Try Out</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="#">Try Out</a></li>
            <li class="active"><span>Data Try Out</span></li>
        </ol>
    </div>
</div>
<!-- /Title Breadcrumb -->

@if(!$tahunAktif)
<!-- Alert Info Warning jika belum ada Tahun Pelajaran Aktif -->
<div class="modern-info-card" style="border-color: #fde68a; background: linear-gradient(135deg, #fffbeb 0%, #f8fafc 100%);">
    <div class="info-icon-box" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
        <i class="fa-solid fa-triangle-exclamation"></i>
    </div>
    <div class="info-content" style="color: #92400e;">
        <strong>Perhatian:</strong> Belum ada <strong>Tahun Pelajaran Aktif</strong> pada sistem. Silakan aktifkan satu tahun pelajaran di menu <strong>Master Data > Tahun Pelajaran</strong> sebelum menambah data Try Out baru.
    </div>
</div>
@endif

<!-- Main Table Card -->
<div class="modern-table-card">
    <!-- Header Controls: Actions + Search -->
    <div class="modern-table-header">
        <div class="modern-table-actions">
            <button type="button" class="btn-modern btn-modern-primary" data-toggle="modal" data-target="#addModal" @if(!$tahunAktif) disabled title="Aktifkan Tahun Pelajaran terlebih dahulu" @endif>
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Try Out</span>
            </button>
        </div>
        <form method="GET" action="{{ route('admin.tryout.index') }}" class="modern-search-bar">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" id="search" name="search" class="form-control" placeholder="Cari try out..." value="{{ request('search') }}">
        </form>
    </div>

    <!-- Table Responsive Wrapper -->
    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="60" class="text-center">No</th>
                        <th>Nama Try Out</th>
                        <th>Tahun Pelajaran</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tryouts as $index => $tryout)
                    <tr>
                        <td class="text-center font-weight-600">{{ method_exists($tryouts, 'firstItem') && $tryouts->firstItem() ? $tryouts->firstItem() + $index : $index + 1 }}</td>
                        <td>
                            <div class="user-info-cell">
                                <div class="user-avatar-placeholder" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%) !important;">
                                    <i class="fa-solid fa-flag-checkered" style="color: #ffffff; font-size: 15px;"></i>
                                </div>
                                <div class="user-info-text">
                                    <span class="user-name" style="font-size: 14px; font-weight: 700; color: #1e293b !important;">{{ $tryout->nama_tryout }}</span>
                                    <span class="user-subtext">Ujian Try Out</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($tryout->tahunPelajaran)
                                <span class="badge-modern primary">
                                    <i class="fa-solid fa-calendar-days mr-5"></i>{{ $tryout->tahunPelajaran->nama_tahun_pelajaran }}
                                    @if($tryout->tahunPelajaran->semester)
                                        (Semester {{ $tryout->tahunPelajaran->semester }})
                                    @endif
                                </span>
                            @else
                                <span class="badge-modern danger"><i class="fa-solid fa-circle-xmark mr-5"></i>Tidak Ada</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="action-btn-group justify-content-center">
                                <a href="#" class="btn-action btn-action-edit edit-btn" 
                                   title="Edit Try Out" 
                                   data-id="{{ $tryout->id }}" 
                                   data-nama_tryout="{{ $tryout->nama_tryout }}" 
                                   data-tahun_pelajaran_id="{{ $tryout->tahun_pelajaran_id }}" 
                                   data-tahun_pelajaran_nama="{{ $tryout->tahunPelajaran ? $tryout->tahunPelajaran->nama_tahun_pelajaran . ' - Semester ' . $tryout->tahunPelajaran->semester : 'N/A' }}"> 
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a> 
                                <a href="#" class="btn-action btn-action-delete delete-button" 
                                   data-id="{{ $tryout->id }}" 
                                   data-toggle="tooltip" 
                                   title="Hapus Try Out"> 
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            <div class="empty-state">
                                <i class="fa-solid fa-flag-checkered fa-2x mb-2"></i>
                                <p>Belum ada data try out.</p>
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
            @if(method_exists($tryouts, 'total'))
                Menampilkan {{ $tryouts->firstItem() ?? 0 }} - {{ $tryouts->lastItem() ?? 0 }} dari {{ $tryouts->total() }} data
            @elseif(method_exists($tryouts, 'firstItem'))
                Menampilkan Halaman {{ $tryouts->currentPage() }} ({{ $tryouts->firstItem() ?? 0 }} - {{ $tryouts->lastItem() ?? 0 }} data)
            @elseif(is_countable($tryouts))
                Total {{ count($tryouts) }} data
            @endif
        </div>
        @if(method_exists($tryouts, 'links'))
        <div>
            {{ $tryouts->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
        </div>
        @endif
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.tryout.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="addModalLabel"><i class="fa-solid fa-plus mr-8 text-primary"></i> Tambah Data Try Out</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tahun Pelajaran (Aktif)</label>
                        <input type="text" class="form-control"
                            value="{{ $tahunAktif ? $tahunAktif->nama_tahun_pelajaran . ' - Semester ' . $tahunAktif->semester : 'Tidak ada tahun pelajaran aktif!' }}"
                            readonly style="background: #f8fafc; font-weight: 600; color: #475569;">
                        @if (!$tahunAktif)
                            <small class="text-danger mt-5 d-block"><i class="fa-solid fa-circle-exclamation mr-5"></i> Silakan aktifkan satu Tahun Pelajaran di Master Data terlebih dahulu.</small>
                        @endif
                    </div>
                    <div class="form-group mb-0">
                        <label for="nama_tryout">Nama Try Out</label>
                        <input type="text" class="form-control" id="nama_tryout" name="nama_tryout"
                            placeholder="Contoh: Try Out UTBK SNBT Ke-1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modern btn-modern-primary" @if (!$tahunAktif) disabled @endif>Simpan Data</button>
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
                @method('PUT')
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="editModalLabel"><i class="fa-solid fa-pen-to-square mr-8 text-primary"></i> Edit Data Try Out</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tahun Pelajaran</label>
                        <input type="text" class="form-control" id="editTahunPelajaran" readonly style="background: #f8fafc; font-weight: 600; color: #475569;">
                        <input type="hidden" id="editTahunPelajaranId" name="tahun_pelajaran_id">
                    </div>
                    <div class="form-group mb-0">
                        <label for="editNamaTryout">Nama Try Out</label>
                        <input type="text" class="form-control" id="editNamaTryout" name="nama_tryout" placeholder="Nama Try Out" required>
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

@if (session('success'))
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

@if (session('error'))
<script>
    $(document).ready(function() {
        setTimeout(function() {
            swal({
                title: "Gagal!",
                text: "{{ session('error') }}",
                type: "error",
                confirmButtonText: "OK"
            });
        }, 500);
    });
</script>
@endif

<script>
    $(document).ready(function() {
        // Edit Button Handler
        $('.edit-btn').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var nama_tryout = $(this).data('nama_tryout');
            var tahun_pelajaran_id = $(this).data('tahun_pelajaran_id');
            var tahun_pelajaran_nama = $(this).data('tahun_pelajaran_nama');

            var url = "{{ route('admin.tryout.update', ':id') }}";
            url = url.replace(':id', id);

            $('#editForm').attr('action', url);
            $('#editNamaTryout').val(nama_tryout);
            $('#editTahunPelajaran').val(tahun_pelajaran_nama);
            $('#editTahunPelajaranId').val(tahun_pelajaran_id);
            $('#editModal').modal('show');
        });

        // SweetAlert for Delete
        $('.delete-button').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                title: "Apakah Anda Yakin?",
                text: "Data Try Out ini akan dihapus permanen dari sistem!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '/admin/tryout/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(result) {
                            swal({
                                title: "Terhapus!",
                                text: result.success || "Data Try Out berhasil dihapus.",
                                type: "success",
                                confirmButtonText: "OK"
                            }, function() {
                                location.reload();
                            });
                        },
                        error: function() {
                            swal("Gagal!", "Terjadi kesalahan saat menghapus data Try Out.", "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
