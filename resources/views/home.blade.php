@extends('layouts.app')

@section('title', 'Home - Studi Lanjut IMBOS Pringsewu')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">
        
        @include('includes.menu_mobile_app')

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-2 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Profil SMAIT IMBOS</h1>
                    <p data-aos="fade-up" data-aos-delay="100">SMAIT Insan Mulia Boarding School adalah sekolah menengah
                        atas yang memberikan proses pendidikan yang berkualitas dengan Kurikulum sesuai standar nasional
                        bercirikan nilai-nilai Islam dan Al-Qur'an.</p>
                    <h1 data-aos="fade-up">Studi Lanjut SMAIT IMBOS</h1>
                    <p data-aos="fade-up" data-aos-delay="100">SMAIT Insan Mulia Boarding School memiliki program unggulan
                        persiapan studi lanjut bagi siswa dan siswinya untuk melanjutkan ke jenjang Perguruan Tinggi Negeri
                        (PTN), Perguruan Tinggi Kedinasan (PTK), Perguruan Tinggi Keagamaan Islam Negeri (PTKIN), Perguruan
                        Tinggi Swasta(PTS) dan memiliki kerjasama program lanjut studi skala Internasional ke Turki dan
                        Negara-Negara Timur Tengah lainnya.</p>
                </div>
                <div class="col-lg-6 order-1 order-lg-1 hero-img" data-aos="zoom-out">
                    <img src="{{ asset('halaman_umum/assets/img/hero-img-putri-home-2.png') }}" class="img-fluid animated"
                        alt="">
                </div>
            </div>
        </div>

        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)"></use>
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)"></use>
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9" fill="#f6c506"></use>
            </g>
        </svg>
    </section><!-- /Hero Section -->

    <!-- aboutfeatures Section -->
    <section id="aboutfeatures" class="aboutfeatures section">
        <!-- Section Title -->
        <div class="container section-title-white-2" data-aos="fade-up">
            <h2>Tentang Kami</h2>
            <p>Studi Lanjut IMBOS<br></p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row gy-5" data-aos="fade-up">
                <blockquote>
                    <p>
                        Studi Lanjut IMBOS merupakan fasilitas layanan Bimbingan Belajar Intensif untuk mempersiapkan SNBP,
                        SNBT/UTBK, Ujian Mandiri, Persiapan Kedinasan, dengan Pembelajaran Berkualitas.
                    </p>
                </blockquote>
            </div>

            <div class="text-center">
                <a href="/tentang-kami"
                    class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                    <span>Selengkapnya</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section><!-- /aboutfeatures Section -->

    <!-- Features Section -->
    <section id="features" class="features section">
        <!-- Section Title -->
        <div class="container section-title-white" data-aos="fade-up">
            <h2>Bersama Studi Lanjut SMAIT IMBOS</h2>
            <p>Buat Belajarmu menjadi Optimal !!!<br></p>
            <small>Temukan Pengalaman Belajar Bimbingan Intensif, Inspiratif, dan Berkualitas! <br></small>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row gy-5">
                <div class="col-xl-6 d-flex">
                    <div class="row align-self-center gy-4">
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Belajar Intensif</h3>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Materi Update</h3>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Try Out dan Pembahasan</h3>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Konsultasi Universitas + Jurusan</h3>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Analisis Tingkat Keketatan Jurusan</h3>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="700">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Buku Prediksi Terbaru</h3>
                            </div>
                        </div><!-- End Feature Item -->
                    </div>
                </div>

                <div class="col-xl-6" data-aos="zoom-out" data-aos-delay="100">
                    <img src="{{ asset('halaman_umum/assets/img/features.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section><!-- /Features Section -->

@endsection
