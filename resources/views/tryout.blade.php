@extends('layouts.app')

@section('title', 'Try Out')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section">

        @include('includes.menu_mobile_app')

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-2 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Assalamualaikum, Wr, Wb</h1>
                    <p data-aos="fade-up" data-aos-delay="100">Hallo Santri IMBOS !!!
                        Sekarang saatnya kamu, tes kemampuan dan progresmu melalui Try Out yang disediakan.
                        Semangat !!!</p>

                </div>
                <div class="col-lg-6 order-1 order-lg-1 hero-img" data-aos="zoom-out">
                    <img src="{{ asset('halaman_umum/assets/img/hero-image-putra.png') }}" class="img-fluid animated"
                        alt="">
                </div>
            </div>
        </div>

        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9" fill="#f6c506">
            </g>
        </svg>

    </section><!-- /Hero Section -->

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Try Out</h2>
            <p>Pantau Progres Belajarmu !!!<br></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-3 d-flex justify-content-center">

                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="pricing-tem d-flex flex-column">
                        <h3 style="color: #20c997;">TRY OUT UTBK</h3>
                        <div class="icon">
                            <i class="bi bi-box" style="color: #20c997;"></i>
                        </div>
                        <div class="deskripsi-tryout deskripsi-tryout-green">
                            Try Out UTBK adalah simulasi pengerjaan soal UTBK yang terdiri dari soal-soal sebagai berikut :
                        </div>
                        <ul class="flex-grow-1">
                            <li>Tes Potensi Skolastik (PU, PK, PPU, PBM)</li>
                            <li>Tes Literasi Bahasa Indonesia</li>
                            <li>Tes Literasi Bahasa Inggris</li>
                            <li>Tes Penalaran Matematika</li>
                        </ul>
                        <a href="/orang-tua" class="btn-buy mt-auto">LIHAT HASIL</a>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="pricing-tem d-flex flex-column">
                        <h3 style="color: #0d6efd;">TRY OUT SKD</h3>
                        <div class="icon">
                            <i class="bi bi-rocket" style="color: #0d6efd;"></i>
                        </div>
                        <div class="deskripsi-tryout deskripsi-tryout-blue">
                            Try Out SKD (Seleksi Kompetensi Dasar) adalah simulasi pengerjaan soal masuk Kedinasan yang
                            terdiri dari soal-soal sebagai berikut :
                        </div>
                        <ul class="flex-grow-1">
                            <li>Tes Wawasan Kebangsaan (TWK)</li>
                            <li>Tes Intelegensia Umum (TIU)</li>
                            <li>Tes Karakteristik Pribadi (TKP)</li>
                        </ul>
                        <a href="/orang-tua" class="btn-buy mt-auto">LIHAT HASIL</a>
                    </div>
                </div><!-- End Pricing Item -->


            </div><!-- End pricing row -->

        </div>

    </section><!-- /Pricing Section -->

    <!-- Features Section -->
    <section id="alt-features" class="alt-features section">

        <!-- Section Title -->
        <div class="container section-title-white" data-aos="fade-up">
            <p>Try Out IMBOS<br></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5">

                <div class="col-xl-7 d-flex order-2 order-xl-1" data-aos="fade-up" data-aos-delay="200">

                    <div class="row align-self-center gy-5">

                        <div class="text-boxs">
                            <p>
                                Adalah sebuah persiapan berupa simulasi ujian UTBK dan SKD Kedinasan yang dirancang untuk
                                membantu para siswa dalam mempersiapkan diri menghadapi Ujian SNBT, Ujian Mandiri dan Ujian
                                Kedinasan.
                            </p>
                        </div>

                    </div>

                </div>

                <div class="col-xl-5 d-flex align-items-center order-1 order-xl-2" data-aos="fade-up"
                    data-aos-delay="100">
                    <img src="{{ asset('halaman_umum/assets/img/model-tentang-kami.png') }}" class="img-fluid"
                        alt="">
                </div>

            </div>

            <div class="tag-line-oke" data-aos="flip-up" data-aos-delay="100">
                <h2>Studi Lanjut IMBOS</h2>
                <h3>Smart Learning, Bright Future !!!</h3>
            </div>

        </div>
        <img src="{{ asset('halaman_umum/assets/img/front.png') }}" alt="Ornament" class="background-ornament">
    </section><!-- /Features Section -->

@endsection
