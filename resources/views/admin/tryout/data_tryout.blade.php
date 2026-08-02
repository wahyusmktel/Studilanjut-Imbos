@extends('admin.layouts.app')

@section('title', 'Data Try Out')

@section('content')
    <!-- Title -->
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
                                        <li><a href="#" data-toggle="modal" data-target="#addModal"><i
                                                    class="fa fa-plus"></i> Tambah Data</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-6 text-right">
                            <form method="GET" action="{{ route('admin.tryout.index') }}">
                                <div class="form-group">
                                    <div class="input-group mb-15">
                                        <input type="text" id="search" name="search" class="form-control"
                                            placeholder="Cari Data..." value="{{ request('search') }}">
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
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Try Out</th>
                                            <th>Tahun Pelajaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tryouts as $index => $tryout)
                                            <tr>
                                                <td>{{ $tryouts->firstItem() + $index }}</td>
                                                <td>{{ $tryout->nama_tryout }}</td>
                                                <td>{{ $tryout->tahunPelajaran->nama_tahun_pelajaran }}</td>
                                                <td class="text-nowrap">
                                                    <a href="#" class="mr-25 edit-btn" data-toggle="modal"
                                                        data-target="#editModal" data-id="{{ $tryout->id }}"
                                                        data-nama_tryout="{{ $tryout->nama_tryout }}"
                                                        data-tahun_pelajaran_id="{{ $tryout->tahun_pelajaran_id }}"
                                                        data-tahun_pelajaran_nama="{{ $tryout->tahunPelajaran ? $tryout->tahunPelajaran->nama_tahun_pelajaran . ' - ' . $tryout->tahunPelajaran->semester : 'N/A' }}">
                                                        <i class="fa fa-pencil text-inverse m-r-10"></i>
                                                    </a>
                                                    <a href="#" class="delete-button" data-id="{{ $tryout->id }}"
                                                        data-toggle="tooltip" data-original-title="Delete">
                                                        <i class="fa fa-close text-danger"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <nav class="pagination-wrap d-inline-block" aria-label="Page navigation example">
                                    {{ $tryouts->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.tryout.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="addModalLabel">Tambah Data Try Out</h5>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Tahun Pelajaran (Aktif)</label>
                            {{-- Tampilkan nama tahun pelajaran yang aktif, atau pesan jika tidak ada --}}
                            <input type="text" class="form-control"
                                value="{{ $tahunAktif ? $tahunAktif->nama_tahun_pelajaran . ' - ' . $tahunAktif->semester : 'Tidak ada tahun pelajaran aktif!' }}"
                                readonly>
                            {{-- Jika tidak ada tahun aktif, tombol simpan bisa dinonaktifkan --}}
                            @if (!$tahunAktif)
                                <small class="text-danger">Silakan aktifkan satu Tahun Pelajaran untuk menambah
                                    data.</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="nama_tryout">Nama Try Out</label>
                            <input type="text" class="form-control" id="nama_tryout" name="nama_tryout"
                                placeholder="Nama Try Out" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        {{-- Nonaktifkan tombol simpan jika tidak ada tahun aktif --}}
                        <button type="submit" class="btn btn-orange"
                            @if (!$tahunAktif) disabled @endif>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{-- Form action akan diisi oleh JavaScript --}}
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT') {{-- Method untuk update biasanya PUT atau PATCH --}}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="editModalLabel">Edit Data Try Out</h5>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Tahun Pelajaran</label>
                            {{-- ID 'editTahunPelajaran' akan digunakan oleh JavaScript untuk mengisi value --}}
                            <input type="text" class="form-control" id="editTahunPelajaran" readonly>

                            {{-- Input tersembunyi untuk tetap mengirimkan ID tahun pelajaran --}}
                            <input type="hidden" id="editTahunPelajaranId" name="tahun_pelajaran_id">
                        </div>

                        <div class="form-group">
                            <label for="editNamaTryout">Nama Try Out</label>
                            <input type="text" class="form-control" id="editNamaTryout" name="nama_tryout"
                                placeholder="Nama Try Out" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-orange">Simpan Perubahan</button>
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

            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                var nama_tryout = $(this).data('nama_tryout');
                var tahun_pelajaran_id = $(this).data('tahun_pelajaran_id');
                var tahun_pelajaran_nama = $(this).data(
                    'tahun_pelajaran_nama'); // Kita perlu data ini dari tombol

                // Membuat URL action untuk form
                var url = "{{ route('admin.tryout.update', ':id') }}";
                url = url.replace(':id', id);

                // Mengisi data ke dalam form modal
                $('#editForm').attr('action', url);
                $('#editNamaTryout').val(nama_tryout);

                // --- TAMBAHAN UNTUK INPUT READONLY ---
                $('#editTahunPelajaran').val(tahun_pelajaran_nama); // Menampilkan nama
                $('#editTahunPelajaranId').val(tahun_pelajaran_id); // Mengisi input hidden untuk dikirim
            });

            // SweetAlert for Delete
            $('.delete-button').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this data!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f83f37",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    closeOnCancel: false
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
                                    title: "Deleted!",
                                    text: result.success,
                                    type: "success",
                                    confirmButtonText: "OK"
                                }, function() {
                                    location.reload();
                                });
                            },
                            error: function() {
                                swal("Error!", "There was an error deleting the data.",
                                    "error");
                            }
                        });
                    } else {
                        swal("Cancelled", "Your data is safe :)", "error");
                    }
                });
            });
        });
    </script>

@endsection
