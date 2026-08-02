@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@section('content')

    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Edit Berita</h5>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('/admin/berita') }}">Berita</a></li>
                <li class="active"><span>Edit Berita</span></li>
            </ol>
        </div>
    </div>
    <!-- /Title -->

    <div class="row">
        <div class="col-md-12">
            <div class="modern-card">
                <div class="modern-card-header" style="display: flex; justify-content: space-between; align-items: center; padding: 20px 24px;">
                    <div>
                        <h3 class="modern-card-title" style="margin: 0; font-size: 18px; font-weight: 600; color: var(--text-primary);">Form Edit Berita</h3>
                    </div>
                    <div>
                        <a href="/admin/berita" class="btn btn-outline-secondary btn-sm" style="display: flex; align-items: center; gap: 8px;">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="modern-card-body">
                    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label for="judul_berita" style="font-weight: 500; margin-bottom: 8px; display: block; color: var(--text-primary);">Judul Berita</label>
                                    <input type="text" class="form-control" id="judul_berita" name="judul_berita" value="{{ $berita->judul_berita }}" required style="border-radius: var(--radius-sm); border: 1px solid var(--border-color); padding: 10px 15px; box-shadow: none;">
                                </div>
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label for="isi_berita" style="font-weight: 500; margin-bottom: 8px; display: block; color: var(--text-primary);">Isi Berita</label>
                                    <textarea class="form-control" id="isi_berita" name="isi_berita" rows="5" required>{{ $berita->isi_berita }}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div style="background: var(--bg-light); padding: 20px; border-radius: var(--radius-md); border: 1px solid var(--border-color); margin-bottom: 20px;">
                                    <h5 style="margin-top: 0; margin-bottom: 16px; font-size: 14px; font-weight: 600; color: var(--text-primary); padding-bottom: 10px; border-bottom: 1px solid var(--border-color);">Pengaturan Berita</h5>
                                    
                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="kategori_id" style="font-weight: 500; margin-bottom: 8px; display: block; color: var(--text-primary);">Kategori</label>
                                        <select class="form-control" id="kategori_id" name="kategori_id" required style="border-radius: var(--radius-sm); border: 1px solid var(--border-color);">
                                            @foreach ($kategoriBeritas as $kategori)
                                                <option value="{{ $kategori->id }}" {{ $kategori->id == $berita->kategori_id ? 'selected' : '' }}>
                                                    {{ $kategori->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="foto" style="font-weight: 500; margin-bottom: 8px; display: block; color: var(--text-primary);">Foto Cover</label>
                                        @if($berita->foto)
                                            <div style="margin-bottom: 10px; border-radius: var(--radius-sm); overflow: hidden; border: 1px solid var(--border-color);">
                                                <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Berita" style="width: 100%; height: auto; display: block;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control" id="foto" name="foto" style="border-radius: var(--radius-sm); border: 1px solid var(--border-color); padding: 6px 12px; height: auto;">
                                        <small style="color: var(--text-muted); display: block; margin-top: 4px;">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                    </div>
                                    
                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="file" style="font-weight: 500; margin-bottom: 8px; display: block; color: var(--text-primary);">File Lampiran <span style="color: var(--text-muted); font-size: 12px; font-weight: normal;">(Optional)</span></label>
                                        @if ($berita->file)
                                            <a href="{{ asset('storage/' . $berita->file) }}" target="_blank" style="display: flex; align-items: center; gap: 6px; margin-bottom: 10px; color: var(--primary); font-weight: 500;">
                                                <i class="fa fa-file"></i> Lihat Lampiran Saat Ini
                                            </a>
                                        @endif
                                        <input type="file" class="form-control" id="file" name="file" style="border-radius: var(--radius-sm); border: 1px solid var(--border-color); padding: 6px 12px; height: auto;">
                                    </div>
                                    
                                    <div style="margin-top: 30px;">
                                        <button type="submit" class="btn btn-primary btn-block" style="padding: 10px; border-radius: var(--radius-sm); font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px;">
                                            <i class="fa fa-save"></i> Update Berita
                                        </button>
                                        <a href="{{ route('admin.berita.index') }}" class="btn btn-default btn-block mt-2" style="border-radius: var(--radius-sm);">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
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