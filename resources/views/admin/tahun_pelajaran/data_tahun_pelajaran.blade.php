@extends('admin.layouts.app')

@section('title', 'Data Tahun Pelajaran')

@section('content')
<!-- Title Breadcrumb -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Data Tahun Pelajaran</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="#">Tahun Pelajaran</a></li>
            <li class="active"><span>Data Tahun Pelajaran</span></li>
        </ol>
    </div>
</div>
<!-- /Title Breadcrumb -->

<!-- Alert Info Modern -->
<div class="modern-info-card">
    <div class="info-icon-box">
        <i class="fa-solid fa-circle-info"></i>
    </div>
    <div class="info-content">
        Mulai tahun pelajaran 2025/2026 pengolahan data pada sistem dilakukan dalam <strong>satu tahun pelajaran</strong> bukan per semester. Untuk tahun berjalan cukup menggunakan satu semester. Data pada halaman orang tua sudah otomatis disesuaikan berdasarkan satu tahun pelajaran berjalan / aktif.
    </div>
    <button type="button" class="close-info-btn" title="Tutup Informasi">
        <i class="fa-solid fa-xmark"></i>
    </button>
</div>
<!-- /Alert Info Modern -->

<!-- Main Table Card -->
<div class="modern-table-card">
    <!-- Header Controls: Actions + Search -->
    <div class="modern-table-header">
        <div class="modern-table-actions">
            <button type="button" class="btn-modern btn-modern-primary" data-toggle="modal" data-target="#addModal">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Tahun Pelajaran</span>
            </button>
        </div>
        <form method="GET" action="{{ route('admin.tahun_pelajaran.index') }}" class="modern-search-bar">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" id="search" name="search" class="form-control" placeholder="Cari tahun pelajaran / semester..." value="{{ request('search') }}">
        </form>
    </div>

    <!-- Table Responsive Wrapper -->
    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="60" class="text-center">No</th>
                        <th>Nama Tahun Pelajaran</th>
                        <th width="140" class="text-center" style="white-space: nowrap;">Semester</th>
                        <th width="120" class="text-center" style="white-space: nowrap;">Status</th>
                        <th width="180" class="text-center" style="white-space: nowrap;">Statistik Data</th>
                        <th width="100" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tahunPelajarans as $index => $tahunPelajaran)
                    <tr>
                        <td class="text-center font-weight-600">{{ method_exists($tahunPelajarans, 'firstItem') && $tahunPelajarans->firstItem() ? $tahunPelajarans->firstItem() + $index : $index + 1 }}</td>
                        <td>
                            <div class="user-info-cell">
                                <div class="user-avatar-placeholder">
                                    <i class="fa-solid fa-calendar-days" style="color: #ffffff; font-size: 15px;"></i>
                                </div>
                                <div class="user-info-text">
                                    <span class="user-name" style="font-size: 15px; font-weight: 700; color: #6366f1 !important;">{{ $tahunPelajaran->nama_tahun_pelajaran }}</span>
                                    <span class="user-subtext">Tahun Pelajaran</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-center" style="white-space: nowrap;">
                            <span class="badge-modern neutral" style="white-space: nowrap; padding: 5px 12px; font-weight: 600;">
                                <i class="fa-solid fa-clock-rotate-left mr-5"></i>Semester {{ $tahunPelajaran->semester }}
                            </span>
                        </td>
                        <td class="text-center" style="white-space: nowrap;">
                            @if($tahunPelajaran->status == 1)
                                <span class="badge-modern success" style="white-space: nowrap;"><i class="fa-solid fa-circle-check"></i> Aktif</span>
                            @else
                                <span class="badge-modern danger" style="white-space: nowrap;"><i class="fa-solid fa-circle-xmark"></i> Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center" style="white-space: nowrap;">
                            <button type="button" class="btn-modern btn-modern-secondary stat-detail-btn" 
                                    style="padding: 6px 14px; font-size: 12px; white-space: nowrap;"
                                    data-nama="{{ $tahunPelajaran->nama_tahun_pelajaran }} (Semester {{ $tahunPelajaran->semester }})" 
                                    data-siswa="{{ number_format($tahunPelajaran->jml_siswa) }}" 
                                    data-kelas="{{ number_format($tahunPelajaran->jml_kelas) }}" 
                                    data-absen-siswa="{{ number_format($tahunPelajaran->jml_absensi_siswa) }}" 
                                    data-absen-guru="{{ number_format($tahunPelajaran->jml_absensi_guru) }}" 
                                    data-nilai="{{ number_format($tahunPelajaran->jml_nilai) }}">
                                <i class="fa-solid fa-chart-pie text-primary"></i>
                                <span>Lihat Statistik</span>
                            </button>
                        </td>
                        <td class="text-center">
                            <div class="action-btn-group justify-content-center">
                                <a href="#" class="btn-action btn-action-edit edit-button" 
                                   data-toggle="tooltip" 
                                   title="Edit Tahun Pelajaran" 
                                   data-id="{{ $tahunPelajaran->id }}" 
                                   data-nama="{{ $tahunPelajaran->nama_tahun_pelajaran }}" 
                                   data-semester="{{ $tahunPelajaran->semester }}" 
                                   data-status="{{ $tahunPelajaran->status }}"> 
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a> 
                                <a href="#" class="btn-action btn-action-delete delete-button" 
                                   data-id="{{ $tahunPelajaran->id }}" 
                                   data-toggle="tooltip" 
                                   title="Hapus Tahun Pelajaran"> 
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <div class="empty-state">
                                <i class="fa-solid fa-calendar-days fa-2x mb-2"></i>
                                <p>Belum ada data tahun pelajaran.</p>
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
            @if(method_exists($tahunPelajarans, 'total'))
                Menampilkan {{ $tahunPelajarans->firstItem() ?? 0 }} - {{ $tahunPelajarans->lastItem() ?? 0 }} dari {{ $tahunPelajarans->total() }} data
            @elseif(method_exists($tahunPelajarans, 'firstItem'))
                Menampilkan Halaman {{ $tahunPelajarans->currentPage() }} ({{ $tahunPelajarans->firstItem() ?? 0 }} - {{ $tahunPelajarans->lastItem() ?? 0 }} data)
            @elseif(is_countable($tahunPelajarans))
                Total {{ count($tahunPelajarans) }} data
            @endif
        </div>
        @if(method_exists($tahunPelajarans, 'links'))
        <div>
            {{ $tahunPelajarans->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
        </div>
        @endif
    </div>
</div>

<!-- Modal Detail Statistik Data -->
<div class="modal fade" id="statModal" tabindex="-1" role="dialog" aria-labelledby="statModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="statModalLabel">
                    <i class="fa-solid fa-chart-pie mr-8 text-primary"></i> 
                    Statistik Data <span id="statTahunPelajaranTitle" class="color-primary font-weight-700"></span>
                </h5>
            </div>
            <div class="modal-body">
                <div class="stat-modal-grid">
                    <div class="stat-mini-card gradient-1">
                        <div class="stat-mini-icon"><i class="fa-solid fa-users"></i></div>
                        <div class="stat-mini-text">
                            <span class="stat-mini-label">Total Siswa Terdaftar</span>
                            <h4 class="stat-mini-value" id="statValSiswa">0</h4>
                        </div>
                    </div>
                    <div class="stat-mini-card gradient-2">
                        <div class="stat-mini-icon"><i class="fa-solid fa-sitemap"></i></div>
                        <div class="stat-mini-text">
                            <span class="stat-mini-label">Total Kelompok / Kelas</span>
                            <h4 class="stat-mini-value" id="statValKelas">0</h4>
                        </div>
                    </div>
                    <div class="stat-mini-card gradient-3">
                        <div class="stat-mini-icon"><i class="fa-solid fa-calendar-check"></i></div>
                        <div class="stat-mini-text">
                            <span class="stat-mini-label">Total Kehadiran Siswa</span>
                            <h4 class="stat-mini-value" id="statValAbsenSiswa">0</h4>
                        </div>
                    </div>
                    <div class="stat-mini-card gradient-4">
                        <div class="stat-mini-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                        <div class="stat-mini-text">
                            <span class="stat-mini-label">Total Absensi Guru</span>
                            <h4 class="stat-mini-value" id="statValAbsenGuru">0</h4>
                        </div>
                    </div>
                    <div class="stat-mini-card gradient-5">
                        <div class="stat-mini-icon"><i class="fa-solid fa-chart-line"></i></div>
                        <div class="stat-mini-text">
                            <span class="stat-mini-label">Total Record Nilai Siswa</span>
                            <h4 class="stat-mini-value" id="statValNilai">0</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.tahun_pelajaran.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="addModalLabel"><i class="fa-solid fa-plus mr-8 text-primary"></i> Tambah Tahun Pelajaran</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_tahun_pelajaran">Nama Tahun Pelajaran</label>
                        <input type="text" class="form-control" id="nama_tahun_pelajaran" name="nama_tahun_pelajaran" placeholder="Contoh: 2025/2026" required>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select name="semester" id="semester" class="form-control" required>
                            <option value="">-- Pilih Semester --</option>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modern btn-modern-primary">Simpan Tahun Pelajaran</button>
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
                    <h5 class="modal-title" id="editModalLabel"><i class="fa-solid fa-pen-to-square mr-8 text-primary"></i> Edit Tahun Pelajaran</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNama">Nama Tahun Pelajaran</label>
                        <input type="text" class="form-control" id="editNama" name="nama_tahun_pelajaran" placeholder="Contoh: 2025/2026" required>
                    </div>
                    <div class="form-group">
                        <label for="editSemester">Semester</label>
                        <select name="semester" id="editSemester" class="form-control" required>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label for="editStatus">Status</label>
                        <select name="status" id="editStatus" class="form-control" required>
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
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
        // Close info card handler
        $('.close-info-btn').on('click', function(e) {
            e.preventDefault();
            $(this).closest('.modern-info-card').fadeOut(200, function() {
                $(this).remove();
            });
        });

        // Stat detail modal handler
        $('.stat-detail-btn').on('click', function(e) {
            e.preventDefault();
            var nama = $(this).data('nama');
            var siswa = $(this).data('siswa');
            var kelas = $(this).data('kelas');
            var absenSiswa = $(this).data('absen-siswa');
            var absenGuru = $(this).data('absen-guru');
            var nilai = $(this).data('nilai');

            $('#statTahunPelajaranTitle').text(nama);
            $('#statValSiswa').text(siswa);
            $('#statValKelas').text(kelas);
            $('#statValAbsenSiswa').text(absenSiswa);
            $('#statValAbsenGuru').text(absenGuru);
            $('#statValNilai').text(nilai);

            $('#statModal').modal('show');
        });

        // Edit button handler
        $('.edit-button').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var semester = $(this).data('semester');
            var status = $(this).data('status');

            $('#editForm').attr('action', '/admin/tahun_pelajaran/' + id);
            $('#editNama').val(nama);
            $('#editSemester').val(semester);
            $('#editStatus').val(status);
            $('#editModal').modal('show');
        });

        // SweetAlert for Delete
        $('.delete-button').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                title: "Apakah Anda Yakin?",
                text: "Data tahun pelajaran ini akan dihapus permanen dari sistem!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            }, function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        url: '/admin/tahun_pelajaran/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(result) {
                            swal({
                                title: "Terhapus!",
                                text: result.success || "Data tahun pelajaran berhasil dihapus.",
                                type: "success",
                                confirmButtonText: "OK"
                            }, function() {
                                location.reload();
                            });
                        },
                        error: function() {
                            swal("Gagal!", "Terjadi kesalahan saat menghapus data tahun pelajaran.", "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
