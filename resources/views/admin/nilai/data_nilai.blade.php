@extends('admin.layouts.app')

@section('title', 'Data Nilai')

@section('content')
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Data Nilai</h5>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="#">Nilai</a></li>
                <li class="active"><span>Data Nilai</span></li>
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
                                    <button aria-expanded="false" data-toggle="dropdown"
                                        class="btn btn-orange dropdown-toggle" type="button">
                                        Menu <span class="caret"></span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="#" data-toggle="modal" data-target="#importModal"><i
                                                    class="fa fa-upload"></i> Import Data</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" data-toggle="modal" data-target="#downloadTemplateModal"><i
                                                    class="fa fa-download"></i> Download Template</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-6 text-right">
                            {{-- Form Pencarian --}}
                            <form method="GET" action="{{ route('admin.nilai.index') }}">
                                <div class="form-group">
                                    <div class="input-group mb-15">
                                        <input type="text" id="search" name="search" class="form-control"
                                            placeholder="Cari Siswa..." value="{{ request('search') }}">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-orange btn-anim"><i
                                                    class="icon-magnifier"></i><span class="btn-text">Cari</span></button>
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
                            {{-- Form Filter Utama --}}
                            <form id="filterForm" method="GET" action="{{ route('admin.nilai.index') }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tahun Pelajaran (Aktif)</label>
                                            <input type="text" class="form-control"
                                                value="{{ $tahunAktif ? $tahunAktif->nama_tahun_pelajaran . ' - ' . $tahunAktif->semester : 'Tidak ada tahun pelajaran aktif!' }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tryout_filter">Try Out</label>
                                            <select class="form-control" name="tryout_id" id="tryout_filter">
                                                <option value="">Pilih Tryout</option>
                                                @foreach ($tryouts as $tryout)
                                                    <option value="{{ $tryout->id }}"
                                                        @if ($tryout->id == request('tryout_id')) selected @endif>
                                                        {{ $tryout->nama_tryout }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kelas_filter">Kelompok</label>
                                            <select class="form-control" id="kelas_filter" name="kelas_id">
                                                <option value="">Pilih Kelompok</option>
                                                @foreach ($kelas as $k)
                                                    <option value="{{ $k->id }}"
                                                        @if ($k->id == request('kelas_id')) selected @endif>
                                                        {{ $k->nama_kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            {{-- Form Input Nilai --}}
                            <div class="table-responsive">
                                <form id="nilaiForm" action="{{ route('admin.nilai.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="tryout_id" value="{{ request('tryout_id') }}"
                                        id="tryout_hidden">
                                    <table class="table table-hover table-bordered mb-0">
                                        <thead>
                                            <tr id="tableHeader">
                                                {{-- Header akan diisi oleh JavaScript --}}
                                            </tr>
                                        </thead>
                                        <tbody id="siswa_nilai_body">
                                            {{-- Data siswa dan nilai akan diisi oleh JavaScript --}}
                                            @if (!request('tryout_id') || !request('kelas_id'))
                                                <tr>
                                                    <td colspan="100%" class="text-center">Silakan pilih Try Out dan
                                                        Kelompok untuk menampilkan data siswa.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="text-right mt-15">
                                        <button type="button" class="btn btn-danger" id="hapusSemuaNilai"><i
                                                class="fa fa-trash"></i> Hapus Semua Nilai</button>
                                        <button type="submit" class="btn btn-orange"><i class="fa fa-save"></i> Simpan
                                            Semua Nilai</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        {{-- Pagination (jika diperlukan di masa depan) --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->

    <!-- Modal Download Template -->
    <div class="modal fade" id="downloadTemplateModal" tabindex="-1" role="dialog"
        aria-labelledby="downloadTemplateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.nilai.downloadTemplate') }}" method="GET">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="downloadTemplateModalLabel">Download Template Import Nilai</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="download_tahun_pelajaran_filter">Tahun Pelajaran</label>
                            <select class="form-control" id="download_tahun_pelajaran_filter" name="tahun_pelajaran_id"
                                required>
                                <option value="">Pilih Tahun Pelajaran</option>
                                {{-- KODE INI SEKARANG AMAN KARENA CONTROLLER MENGIRIMKAN $tahunPelajarans --}}
                                @foreach ($tahunPelajarans as $tp)
                                    <option value="{{ $tp->id }}">{{ $tp->nama_tahun_pelajaran }} -
                                        {{ $tp->semester }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="download_tryout_filter">Try Out</label>
                            <select class="form-control" id="download_tryout_filter" name="tryout_id" required>
                                <option value="">Pilih Try Out</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="download_kelas_filter">Kelompok</label>
                            <select class="form-control" id="download_kelas_filter" name="kelas_id" required>
                                <option value="">Pilih Kelompok</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-orange">Download</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Import Data -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="importModalLabel">Import Data Nilai</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.nilai.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Upload File Excel</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

    @if (session('success'))
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

    <script>
        $(document).ready(function() {

            // =================================================================================
            // FUNGSI UTAMA UNTUK MEMUAT DATA SISWA DAN NILAI VIA AJAX
            // =================================================================================
            function loadSiswas(kelasId, tryoutId) {
                if (!kelasId || !tryoutId) {
                    $('#siswa_nilai_body').html(
                        '<tr><td colspan="100%" class="text-center">Silakan pilih Try Out dan Kelompok untuk menampilkan data siswa.</td></tr>'
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
                        search: "{{ request('search') }}" // Kirim parameter search
                    },
                    success: function(data) {
                        var tableBody = $('#siswa_nilai_body');
                        var tableHeaderRow = $('#tableHeader');
                        tableBody.empty();
                        tableHeaderRow.empty();

                        if (data.siswas.length === 0) {
                            tableBody.html(
                                '<tr><td colspan="100%" class="text-center">Tidak ada siswa ditemukan di kelompok ini.</td></tr>'
                            );
                            return;
                        }

                        // Tambahkan kolom header "No" dan "Nama Siswa"
                        tableHeaderRow.append('<th>No</th>');
                        tableHeaderRow.append('<th>Nama Siswa</th>');

                        // Tambahkan kolom header dinamis untuk mata pelajaran
                        $.each(data.mataPelajarans, function(index, mataPelajaran) {
                            tableHeaderRow.append('<th>' + mataPelajaran.namaMataPelajaran +
                                '</th>');
                        });

                        // Tambahkan baris data siswa
                        $.each(data.siswas, function(index, siswa) {
                            var row = '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + siswa.nama_siswa + '</td>';

                            // Tambahkan input nilai untuk setiap mata pelajaran
                            $.each(data.mataPelajarans, function(index, mataPelajaran) {
                                var nilaiObj = siswa.nilais.find(n => n
                                    .mata_pelajaran_id === mataPelajaran.id);
                                var nilai = nilaiObj ? nilaiObj.nilai : '';
                                row +=
                                    '<td><input type="number" class="form-control" name="nilai[' +
                                    siswa.id + '][' + mataPelajaran.id + ']" value="' +
                                    nilai + '" min="10" max="1000" step="0.01"></td>';
                            });

                            row += '</tr>';
                            tableBody.append(row);
                        });
                    },
                    error: function() {
                        alert('Gagal memuat data siswa. Silakan coba lagi.');
                    }
                });
            }

            // =================================================================================
            // EVENT HANDLER UNTUK FILTER
            // =================================================================================
            $('#tryout_filter, #kelas_filter').on('change', function() {
                // Ketika filter diubah, submit form filter untuk reload halaman dengan parameter baru
                $('#filterForm').submit();
            });

            // =================================================================================
            // LOGIKA PEMUATAN DATA SAAT HALAMAN DIBUKA
            // =================================================================================
            var initialTryoutId = $('#tryout_filter').val();
            var initialKelasId = $('#kelas_filter').val();

            if (initialTryoutId && initialKelasId) {
                loadSiswas(initialKelasId, initialTryoutId);
            }

            // =================================================================================
            // SCRIPT UNTUK MODAL DOWNLOAD TEMPLATE
            // =================================================================================
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
                            tryoutSelect.append('<option value="">Pilih Try Out</option>');
                            $.each(data, function(key, value) {
                                tryoutSelect.append('<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#download_tryout_filter').empty().append('<option value="">Pilih Try Out</option>');
                }
            });

            // =================================================================================
            // SCRIPT UNTUK TOMBOL HAPUS SEMUA NILAI
            // =================================================================================
            $('#hapusSemuaNilai').on('click', function() {
                var tryoutId = $('#tryout_filter').val();
                var kelasId = $('#kelas_filter').val();

                if (!tryoutId || !kelasId) {
                    swal("Peringatan!", "Silakan pilih Try Out dan Kelompok terlebih dahulu.", "warning");
                    return;
                }

                swal({
                    title: "Anda yakin?",
                    text: "Semua nilai untuk Try Out dan Kelompok yang dipilih akan dihapus permanen!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f83f37",
                    confirmButtonText: "Ya, hapus semua!",
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
                                    title: "Berhasil!",
                                    text: result.success,
                                    type: "success"
                                }, function() {
                                    location.reload();
                                });
                            },
                            error: function() {
                                swal("Error!", "Terjadi kesalahan saat menghapus data.",
                                    "error");
                            }
                        });
                    }
                });
            });

        });
    </script>
@endsection
