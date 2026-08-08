@extends('admin.layouts.app')

@section('title', 'Data Siswa')

@section('content')
<!-- Title Breadcrumb -->
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
<!-- /Title Breadcrumb -->

<!-- Main Table Card -->
<div class="modern-table-card">
    <!-- Header Controls: Actions + Search -->
    <div class="modern-table-header">
        <div class="modern-table-actions">
            <button type="button" class="btn-modern btn-modern-primary" data-toggle="modal" data-target="#addModal">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Data Siswa</span>
            </button>
            <button type="button" class="btn-modern btn-modern-secondary" data-toggle="modal" data-target="#importModal">
                <i class="fa-solid fa-file-import"></i>
                <span>Import Data</span>
            </button>
        </div>
        <form method="GET" action="{{ route('admin.siswa.index') }}" class="modern-search-bar">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" id="search" name="search" class="form-control" placeholder="Cari nama siswa / NIS..." value="{{ request('search') }}">
        </form>
    </div>

    <!-- Table Responsive Wrapper -->
    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>Kelompok</th>
                        <th>Program Bimbel</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswas as $index => $siswa)
                    <tr>
                        <td class="text-center font-weight-600">{{ method_exists($siswas, 'firstItem') && $siswas->firstItem() ? $siswas->firstItem() + $index : $index + 1 }}</td>
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
                                    @if($siswa->tmpt_lahir || $siswa->tgl_lahir)
                                        <span class="user-subtext">
                                            <i class="fa-solid fa-cake-candles"></i>
                                            {{ $siswa->tmpt_lahir ? $siswa->tmpt_lahir . ', ' : '' }}{{ $siswa->tgl_lahir ? date('d M Y', strtotime($siswa->tgl_lahir)) : '' }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($siswa->nis)
                                <code style="background: #f1f5f9; color: #475569; padding: 3px 8px; border-radius: 6px; font-weight: 600;">{{ $siswa->nis }}</code>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge-modern primary">
                                <i class="fa-solid fa-sitemap mr-5"></i>{{ $siswa->kelas ? $siswa->kelas->nama_kelas : '-' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge-modern success">
                                <i class="fa-solid fa-graduation-cap mr-5"></i>{{ $siswa->programBimbel ? $siswa->programBimbel->nama_program : '-' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-btn-group justify-content-center">
                                <a href="#" class="btn-action btn-action-edit edit-button" 
                                   data-toggle="tooltip" 
                                   title="Edit Siswa" 
                                   data-id="{{ $siswa->id }}" 
                                   data-nama_siswa="{{ $siswa->nama_siswa }}" 
                                   data-kelas_id="{{ $siswa->kelas_id }}" 
                                   data-program_bimbel_id="{{ $siswa->program_bimbel_id }}" 
                                   data-tgl_lahir="{{ $siswa->tgl_lahir }}" 
                                   data-tmpt_lahir="{{ $siswa->tmpt_lahir }}" 
                                   data-no_hp="{{ $siswa->no_hp }}" 
                                   data-nis="{{ $siswa->nis }}"> 
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a> 
                                <a href="#" class="btn-action btn-action-delete delete-button" 
                                   data-id="{{ $siswa->id }}" 
                                   data-toggle="tooltip" 
                                   title="Hapus Siswa"> 
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <div class="empty-state">
                                <i class="fa-solid fa-user-graduate fa-2x mb-2"></i>
                                <p>Belum ada data siswa.</p>
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
            {{ $siswas->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
        </div>
        @endif
    </div>
</div>

@if(session('import_summary'))
@php($importSummary = session('import_summary'))
<div class="modern-table-card" style="margin-top:24px; border:1px solid #dbe7f5; overflow:hidden;">
    <div style="padding:20px 24px; background:linear-gradient(135deg,#f7fbff,#eef5ff); border-bottom:1px solid #dbe7f5; display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
        <div>
            <h4 style="margin:0; color:#163b72; font-weight:700;"><i class="fa-solid fa-clipboard-check" style="color:#2563eb; margin-right:8px;"></i>Resume Import Excel</h4>
            <p style="margin:6px 0 0; color:#64748b;">Periksa baris yang perlu diperbaiki sebelum import berikutnya.</p>
        </div>
        <span class="badge-modern primary">Total baris: {{ $importSummary['total'] ?? 0 }}</span>
    </div>
    <div style="padding:20px 24px;">
        <div class="row" style="margin-bottom:16px;">
            <div class="col-md-4"><div style="padding:16px;border-radius:12px;background:#ecfdf5;color:#047857;"><small>BERHASIL DIIMPORT</small><div style="font-size:26px;font-weight:700;">{{ $importSummary['imported'] ?? 0 }}</div></div></div>
            <div class="col-md-4"><div style="padding:16px;border-radius:12px;background:#fff7ed;color:#c2410c;"><small>DUPLIKAT / DILEWATI</small><div style="font-size:26px;font-weight:700;">{{ $importSummary['duplicate_count'] ?? count($importSummary['duplicates'] ?? []) }}</div></div></div>
            <div class="col-md-4"><div style="padding:16px;border-radius:12px;background:#fef2f2;color:#b91c1c;"><small>GAGAL DIIMPORT</small><div style="font-size:26px;font-weight:700;">{{ $importSummary['failed_count'] ?? count($importSummary['failed'] ?? []) }}</div></div></div>
        </div>

        @if(count($importSummary['duplicates'] ?? []) > 0)
        <div style="margin-top:16px; border:1px solid #fed7aa; border-radius:10px; overflow:hidden;">
            <div style="padding:13px 16px; background:#fff7ed; color:#9a3412; font-weight:600;"><i class="fa-solid fa-copy"></i> NIS Duplikat</div>
            <div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th>Baris Excel</th><th>NIS</th><th>Nama</th><th>Keterangan</th></tr></thead><tbody>
                @foreach($importSummary['duplicates'] as $duplicate)
                    <tr><td>{{ $duplicate['row'] }}</td><td><code>{{ $duplicate['nis'] }}</code></td><td>{{ $duplicate['name'] ?: '-' }}</td><td>{{ $duplicate['reason'] }}</td></tr>
                @endforeach
            </tbody></table></div>
        </div>
        @endif

        @if(count($importSummary['failed'] ?? []) > 0)
        <div style="margin-top:16px; border:1px solid #fecaca; border-radius:10px; overflow:hidden;">
            <div style="padding:13px 16px; background:#fef2f2; color:#991b1b; font-weight:600;"><i class="fa-solid fa-triangle-exclamation"></i> Data Tidak Berhasil Diimport</div>
            <div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th>Baris Excel</th><th>NIS</th><th>Nama</th><th>Alasan</th></tr></thead><tbody>
                @foreach($importSummary['failed'] as $failure)
                    <tr><td>{{ $failure['row'] }}</td><td><code>{{ $failure['nis'] ?: '-' }}</code></td><td>{{ $failure['name'] ?: '-' }}</td><td>{{ $failure['reason'] }}</td></tr>
                @endforeach
            </tbody></table></div>
        </div>
        @endif
    </div>
</div>
@endif

<!-- Modal Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.siswa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="addModalLabel"><i class="fa-solid fa-plus mr-8 text-primary"></i> Tambah Data Siswa</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kelas_id">Kelompok / Kelas</label>
                                <select class="form-control" id="kelas_id" name="kelas_id" required>
                                    <option value="">-- Pilih Kelompok --</option>
                                    @foreach($kelas as $kls)
                                        <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="program_bimbel_id">Program Bimbel</label>
                                <select class="form-control" id="program_bimbel_id" name="program_bimbel_id" required>
                                    <option value="">-- Pilih Program --</option>
                                    @foreach($programBimbels as $programBimbel)
                                        <option value="{{ $programBimbel->id }}">{{ $programBimbel->nama_program }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama Lengkap Siswa" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="number" class="form-control" id="nis" name="nis" placeholder="Nomor NIS" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tmpt_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tmpt_lahir" name="tmpt_lahir" placeholder="Tempat Lahir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">Nomor HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: 081234567890">
                    </div>
                    <div class="form-group">
                        <label for="password">Password Akun</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password Akun Siswa" required>
                    </div>
                    <div class="form-group mb-0">
                        <label for="foto">Upload Foto Siswa</label>
                        <input type="file" class="dropify" id="foto" name="foto" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modern btn-modern-primary">Simpan Data Siswa</button>
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
                    <h5 class="modal-title" id="editModalLabel"><i class="fa-solid fa-pen-to-square mr-8 text-primary"></i> Edit Data Siswa</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editKelasId">Kelompok / Kelas</label>
                                <select class="form-control" id="editKelasId" name="kelas_id" required>
                                    @foreach($kelas as $kls)
                                        <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editProgramBimbelId">Program Bimbel</label>
                                <select class="form-control" id="editProgramBimbelId" name="program_bimbel_id" required>
                                    @foreach($programBimbels as $programBimbel)
                                        <option value="{{ $programBimbel->id }}">{{ $programBimbel->nama_program }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="editNamaSiswa">Nama Siswa</label>
                                <input type="text" class="form-control" id="editNamaSiswa" name="nama_siswa" placeholder="Nama Siswa" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="editNis">NIS</label>
                                <input type="number" class="form-control" id="editNis" name="nis" placeholder="NIS" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editTmptLahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="editTmptLahir" name="tmpt_lahir" placeholder="Tempat Lahir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editTglLahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="editTglLahir" name="tgl_lahir">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editNoHp">Nomor HP</label>
                        <input type="text" class="form-control" id="editNoHp" name="no_hp" placeholder="Nomor HP">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editPassword">Password <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                                <input type="password" class="form-control" id="editPassword" name="password" placeholder="Password Baru">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editConfirmPassword">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="editConfirmPassword" name="password_confirmation" placeholder="Ulangi Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label for="editFoto">Upload Foto Baru</label>
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
            <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="importModalLabel"><i class="fa-solid fa-file-import mr-8 text-primary"></i> Import Data Siswa</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-0">
                        <label for="importSiswa">Upload File Data Siswa (Excel / CSV)</label>
                        <input type="file" class="dropify" name="file" id="importSiswa" />
                        <span class="help-block mt-10 mb-0"><small>Download format import data siswa <a href="https://docs.google.com/spreadsheets/d/1BAMIyqZKwtJQO11ewVElX58ogT1Fwifn/edit?usp=sharing&ouid=105663471066731245622&rtpof=true&sd=true" target="_blank" class="text-primary font-weight-600">di sini</a>.</small></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modern btn-modern-primary">Import Data</button>
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

@if(session('error'))
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
        // Edit button handler
        $('.edit-button').on('click', function(e) {
            e.preventDefault();
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
                title: "Apakah Anda Yakin?",
                text: "Data siswa ini akan dihapus permanen dari sistem!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                closeOnConfirm: false
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
                                title: "Terhapus!",
                                text: result.success || "Data siswa berhasil dihapus.",
                                type: "success",
                                confirmButtonText: "OK"
                            }, function() {
                                location.reload();
                            });
                        },
                        error: function() {
                            swal("Gagal!", "Terjadi kesalahan saat menghapus data siswa.", "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
