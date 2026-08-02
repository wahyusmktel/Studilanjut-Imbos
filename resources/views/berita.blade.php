@extends('layouts.app')

@section('title', 'Berita')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section">

        @include('includes.menu_mobile_app')

        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3" fill="rgba(246, 197, 6, 100)">
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0" fill="rgba(246, 197, 6, 0.2)">
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9" fill="#ffffff">
            </g>
        </svg>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container" data-aos="fade-up">
            <div class="row gx-0">

                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="contents">
                        <h2>Assalamualaikum, Wr, Wb</h2>
                        <p>
                            Hallo semuanya.
                            Anda punya pertanyaan seputar studi Lanjut SMAIT IMBOS Pringsewu? Butuh informasi bimbel akurat?
                            Yuk bisa Klik Tombol dibawah ini !!!
                        </p>
                        <div class="text-center text-lg-start">
                            <a href="#contact"
                                class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Hubungi Kami</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('halaman_umum/assets/img/about-2.png') }}" class="img-fluid" alt="">
                </div>

            </div>
        </div>

    </section><!-- /About Section -->

    <!-- Team Section -->
    <section id="features" class="features section">

        <!-- Section Title -->
        <div class="container section-title-white" data-aos="fade-up">
            <p>Seputar Info Nih !!!<br></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-2">

                <div class="col-lg-8 d-flex align-items-center">
                    <div class="row align-self-center">

                        <div class="text-boxs" data-aos="fade-up">
                            <p>
                                Kalian bisa dapetin berbagai info terkait persiapan SNBP, SNBT-UTBK, Ujian Mandiri, Ujian
                                Kedinasan, Ujian Perguruan Tinggi Swasta, Bahkan Informasi Beasiswa, Hanya dengan pantau
                                terus Studi Lanjut imbos lho. Juga akan share informasi terupdate seputar informasi bimbel
                                ini. Tetap pantau ya.
                            </p>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 d-flex align-items-center hidden" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('halaman_umum/assets/img/News-rafiki.png') }}" class="img-fluid" alt="">
                </div>
                <div class="tag-line-oke aos-init aos-animate" data-aos="flip-up" data-aos-delay="100">
                    <h2>Studi Lanjut IMBOS</h2>
                    <h3>Smart Learning, Bright Future !!!</h3>
                </div>

            </div>

        </div>
        <!-- Dibawah ini adalah kode untuk gambar yang seharusnya muncul di pojok kiri bawah -->
        <img src="{{ asset('halaman_umum/assets/img/front.png') }}" alt="Ornament" class="background-ornament">
    </section><!-- /Team Section -->

    <!-- Recent Posts Section -->
    <section id="recent-posts" class="recent-posts section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Cek Info Dibawah Ini</h2>
            <p>Informasi Terbaru</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5">
                @foreach ($beritas as $berita)
                    <div class="col-xl-4 col-md-6">
                        <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">
                            <div class="post-img position-relative overflow-hidden">
                                <img src="{{ asset('storage/' . $berita->foto) }}" class="img-fluid" alt="">
                                <span class="post-date">{{ $berita->created_at->format('F d') }}</span>
                            </div>
                            <div class="post-content d-flex flex-column">
                                <h3 class="post-title">{{ $berita->judul_berita }}</h3>
                                <div class="meta d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person"></i> <span
                                            class="ps-2">{{ $berita->author->name }}</span>
                                    </div>
                                    <span class="px-3 text-black-50">/</span>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-folder2"></i> <span
                                            class="ps-2">{{ $berita->kategori->nama_kategori }}</span>
                                    </div>
                                </div>
                                <hr>
                                <a href="{{ route('berita.detail', $berita->id) }}"
                                    class="readmore stretched-link"><span>Read More</span><i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End post item -->
                @endforeach
            </div>

        </div>

    </section><!-- /Recent Posts Section -->

@endsection
