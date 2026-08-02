@extends('admin.layouts.app')

@section('title', 'Kelola Data Nilai')

@section('content')
<!-- Title Breadcrumb -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Kelola Data Nilai</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.nilai-siswa.index') }}">Nilai</a></li>
            <li class="active"><span>Kelola Data Nilai</span></li>
        </ol>
    </div>
</div>
<!-- /Title Breadcrumb -->

<!-- Main Table Card -->
<div class="modern-table-card">
    <!-- Header Controls: Actions + Search -->
    <div class="modern-table-header">
        <div class="modern-table-actions">
            <a href="{{ route('admin.nilai-siswa.index') }}" class="btn-modern btn-modern-secondary">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
            <button type="button" class="btn-modern btn-modern-primary" data-toggle="modal" data-target="#importModal">
                <i class="fa-solid fa-file-import"></i>
                <span>Import Data Nilai</span>
            </button>
            <button type="button" class="btn-modern btn-modern-secondary" data-toggle="modal" data-target="#downloadTemplateModal">
                <i class="fa-solid fa-file-arrow-down"></i>
                <span>Download Template</span>
            </button>
        </div>
        <form method="GET" action="{{ route('admin.nilai.index') }}" class="modern-search-bar">
            <input type="hidden" name="tryout_id" value="{{ request('tryout_id') }}">
            <input type="hidden" name="kelas_id" value="{{ request('kelas_id') }}">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" id="search" name="search" class="form-control" placeholder="Cari nama siswa..." value="{{ request('search') }}">
        </form>
    </div>

    <!-- Filter Form -->
    <div style="padding: 20px 24px; background: #f8fafc; border-bottom: 1px solid var(--border-color);">
        <form id="filterForm" method="GET" action="{{ route('admin.nilai.index') }}">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <label class="font-weight-600">Tahun Pelajaran (Aktif)</label>
                        <input type="text" class="form-control"
                            value="{{ $tahunAktif ? $tahunAktif->nama_tahun_pelajaran . ' - Semester ' . $tahunAktif->semester : 'Tidak ada tahun pelajaran aktif!' }}"
                            readonly style="background: #ffffff; font-weight: 600; color: #475569;">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <label for="tryout_filter" class="font-weight-600">Pilih Try Out</label>
                        <select class="form-control" name="tryout_id" id="tryout_filter">
                            <option value="">-- Pilih Tryout --</option>
                            @foreach ($tryouts as $tryout)
                                <option value="{{ $tryout->id }}" @if ($tryout->id == request('tryout_id')) selected @endif>
                                    {{ $tryout->nama_tryout }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <label for="kelas_filter" class="font-weight-600">Pilih Kelompok / Kelas</label>
                        <select class="form-control" id="kelas_filter" name="kelas_id">
                            <option value="">-- Pilih Kelompok --</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}" @if ($k->id == request('kelas_id')) selected @endif>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Input Matrix -->
    <form id="nilaiForm" action="{{ route('admin.nilai.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tryout_id" value="{{ request('tryout_id') }}" id="tryout_hidden">
        <div class="table-wrap table-matrix-scroll">
            <table class="table table-hover mb-0">
                <thead>
                    <tr id="tableHeader">
                        {{-- Header akan diisi oleh JavaScript --}}
                    </tr>
                </thead>
                <tbody id="siswa_nilai_body">
                    {{-- Data siswa dan nilai akan diisi oleh JavaScript --}}
                    @if (!request('tryout_id') || !request('kelas_id'))
                        <tr>
                            <td colspan="100%" class="text-center py-4 text-muted">
                                <div class="empty-state">
                                    <i class="fa-solid fa-sliders fa-2x mb-2"></i>
                                    <p>Silakan pilih Try Out dan Kelompok untuk menampilkan & mengedit nilai siswa.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="modern-table-header border-top" style="border-bottom: none; background: #fafafa;">
            <div>
                <button type="button" class="btn-modern btn-modern-danger" id="hapusSemuaNilai">
                    <i class="fa-solid fa-trash-can"></i>
                    <span>Hapus Semua Nilai</span>
                </button>
            </div>
            <div>
                <button type="submit" class="btn-modern btn-modern-primary">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Perubahan Nilai</span>
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Modal Download Template -->
<div class="modal fade" id="downloadTemplateModal" tabindex="-1" role="dialog" aria-labelledby="downloadTemplateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.nilai.downloadTemplate') }}" method="GET">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="downloadTemplateModalLabel"><i class="fa-solid fa-file-arrow-down mr-8 text-primary"></i> Download Template Import Nilai</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="download_tahun_pelajaran_filter">Tahun Pelajaran</label>
                        <select class="form-control" id="download_tahun_pelajaran_filter" name="tahun_pelajaran_id" required>
                            <option value="">-- Pilih Tahun Pelajaran --</option>
                            @foreach ($tahunPelajarans as $tp)
                                <option value="{{ $tp->id }}">{{ $tp->nama_tahun_pelajaran }} - Semester {{ $tp->semester }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="download_tryout_filter">Try Out</label>
                        <select class="form-control" id="download_tryout_filter" name="tryout_id" required>
                            <option value="">-- Pilih Try Out --</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label for="download_kelas_filter">Kelompok</label>
                        <select class="form-control" id="download_kelas_filter" name="kelas_id" required>
                            <option value="">-- Pilih Kelompok --</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modern btn-modern-primary">Download Template</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Import Data -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.nilai.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="importModalLabel"><i class="fa-solid fa-file-import mr-8 text-primary"></i> Import Data Nilai</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-0">
                        <label for="file">Upload File Excel Nilai (.xlsx / .xls)</label>
                        <input type="file" name="file" class="dropify" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modern btn-modern-primary">Import Nilai</button>
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

<script>
    $(document).ready(function() {
        function loadSiswas(kelasId, tryoutId) {
            if (!kelasId || !tryoutId) {
                $('#siswa_nilai_body').html(
                    '<tr><td colspan="100%" class="text-center py-4 text-muted">Silakan pilih Try Out dan Kelompok untuk menampilkan data siswa.</td></tr>'
                );
                $('#tableHeader').empty();
                return;
            }

            $.ajax({
                url: '{{ route('admin.nilai.getSiswas') }}',
                type: 'GET',
                data: {
                    kelas_id: kelasId,
                    tryout_id: tryoutId,
                    search: $('#search').val()
                },
                success: function(data) {
                    var tableBody = $('#siswa_nilai_body');
                    var tableHeaderRow = $('#tableHeader');
                    tableBody.empty();
                    tableHeaderRow.empty();

                    if (data.siswas.length === 0) {
                        tableBody.html(
                            '<tr><td colspan="100%" class="text-center py-4 text-muted">Tidak ada siswa ditemukan di kelompok ini.</td></tr>'
                        );
                        return;
                    }

                    tableHeaderRow.append('<th width="50" class="text-center" style="white-space: nowrap; vertical-align: middle;">No</th>');
                    tableHeaderRow.append('<th style="min-width: 170px; white-space: nowrap; vertical-align: middle;">Nama Siswa</th>');

                    $.each(data.mataPelajarans, function(index, mataPelajaran) {
                        tableHeaderRow.append('<th class="th-subject-header">' + mataPelajaran.namaMataPelajaran + '</th>');
                    });

                    $.each(data.siswas, function(index, siswa) {
                        var row = '<tr>' +
                            '<td class="text-center font-weight-600" style="vertical-align: middle;">' + (index + 1) + '</td>' +
                            '<td style="white-space: nowrap; vertical-align: middle;"><span class="font-weight-600 color-primary">' + siswa.nama_siswa + '</span></td>';

                        $.each(data.mataPelajarans, function(index, mataPelajaran) {
                            var nilaiObj = siswa.nilais.find(n => n.mata_pelajaran_id === mataPelajaran.id);
                            var nilai = nilaiObj ? nilaiObj.nilai : '';
                            row +=
                                '<td class="text-center" style="padding: 6px 4px; vertical-align: middle;"><input type="number" class="form-control input-score-sm" name="nilai[' +
                                siswa.id + '][' + mataPelajaran.id + ']" value="' +
                                nilai + '" min="10" max="1000" step="0.01" placeholder="0"></td>';
                        });

                        row += '</tr>';
                        tableBody.append(row);
                    });
                },
                error: function() {
                    swal("Gagal!", "Gagal memuat data siswa. Silakan coba lagi.", "error");
                }
            });
        }

        $('#tryout_filter, #kelas_filter').on('change', function() {
            $('#filterForm').submit();
        });

        var searchTimer;
        $('#search').on('keyup input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function() {
                var tryoutId = $('#tryout_filter').val();
                var kelasId = $('#kelas_filter').val();
                if (tryoutId && kelasId) {
                    loadSiswas(kelasId, tryoutId);
                }
            }, 300);
        });

        var initialTryoutId = $('#tryout_filter').val();
        var initialKelasId = $('#kelas_filter').val();

        if (initialTryoutId && initialKelasId) {
            loadSiswas(initialKelasId, initialTryoutId);
        }

        $('#download_tahun_pelajaran_filter').on('change', function() {
            var tahunPelajaranId = $(this).val();
            if (tahunPelajaranId) {
                $.ajax({
                    url: '{{ route('admin.nilai.getTryouts') }}',
                    type: 'GET',
                    data: {
                        tahun_pelajaran_id: tahunPelajaranId
                    },
                    success: function(data) {
                        var tryoutSelect = $('#download_tryout_filter');
                        tryoutSelect.empty();
                        tryoutSelect.append('<option value="">-- Pilih Try Out --</option>');
                        $.each(data, function(key, value) {
                            tryoutSelect.append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#download_tryout_filter').empty().append('<option value="">-- Pilih Try Out --</option>');
            }
        });

        $('#hapusSemuaNilai').on('click', function(e) {
            e.preventDefault();
            var tryoutId = $('#tryout_filter').val();
            var kelasId = $('#kelas_filter').val();

            if (!tryoutId || !kelasId) {
                swal("Peringatan!", "Silakan pilih Try Out dan Kelompok terlebih dahulu.", "warning");
                return;
            }

            swal({
                title: "Apakah Anda Yakin?",
                text: "Semua nilai untuk Try Out dan Kelompok yang dipilih akan dihapus permanen!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                confirmButtonText: "Ya, Hapus Semua!",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '{{ route('admin.nilai.hapusSemua') }}',
                        type: 'DELETE',
                        data: {
                            tryout_id: tryoutId,
                            kelas_id: kelasId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(result) {
                            swal({
                                title: "Terhapus!",
                                text: result.success || "Data nilai berhasil dihapus.",
                                type: "success"
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
