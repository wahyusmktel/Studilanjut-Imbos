@extends('admin.layouts.app')

@section('title', 'Tambah Berita')

@section('content')

    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Berita</h5>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('/admin/berita') }}">Berita</a></li>
                <li class="active"><span>Tambah Berita</span></li>
            </ol>
        </div>
    </div>
    <!-- /Title -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default border-panel card-view">
                <div class="panel-heading">

                    <div class="row">
                        <div class="col-md-8 col-xs-6">
                            <h6 class="panel-title txt-dark">Tambah Berita</h6>
                        </div>
                        <div class="col-md-4 col-xs-6 text-right">
                            <a href="/admin/berita" class="btn btn-default"><i
                                class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>

                </div>

                <div class="panel-body">
                    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul_berita">Judul Berita</label>
                            <input type="text" class="form-control" id="judul_berita" name="judul_berita" required>
                        </div>
                        <div class="form-group">
                            <label for="isi_berita">Isi Berita</label>
                            <textarea class="form-control" id="isi_berita" name="isi_berita" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Cover</label>
                            <input type="file" class="form-control" id="foto" name="foto" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select class="form-control" id="kategori_id" name="kategori_id" required>
                                @foreach ($kategoriBeritas as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file">File (optional)</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- <script>
        /*Summernote Init*/
        $(function() {
            "use strict";
            $('#isi_berita').summernote({
                height: 300,
            });
        });
    </script> --}}

    <script>
        $(function() {
            $('#isi_berita').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function(files) {
                        let editor = $(this);
                        let data = new FormData();
                        data.append("file", files[0]);
                        data.append("_token", "{{ csrf_token() }}");
    
                        $.ajax({
                            url: "{{ route('admin.berita.uploadGambar') }}",
                            method: "POST",
                            data: data,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                if(response.url) {
                                    editor.summernote('insertImage', response.url);
                                } else {
                                    console.error('Gagal mengupload gambar');
                                }
                            },
                            error: function(response) {
                                console.error('Gagal mengupload gambar');
                            }
                        });
                    }
                }
            });
        });
    </script>

@endsection
