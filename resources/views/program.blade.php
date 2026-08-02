@extends('layouts.app')

@section('title', 'Program')

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

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Program</h2>
            <p>Ayo Pilih Program Pilihanmu !!!<br></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-3">

                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="pricing-tem d-flex flex-column">
                        <h3 style="color: #20c997;">BIMBEL SNBT / UTBK</h3>
                        <div class="icon">
                            <i class="bi bi-box" style="color: #20c997;"></i>
                        </div>
                        <ul class="flex-grow-1">
                            <li>Khusus untuk Kelas 12</li>
                            <li>Latihan Soal UTBK Terupdate</li>
                            <li>Try Out Intensif</li>
                            <li>Pembahasan dan Trik Jitu</li>
                            <li>Intensif Belajar 1 Tahun</li>
                        </ul>
                        <a href="https://wa.me/6285609276949?text=Assalamualaikum." target="_blank"
                            class="btn-buy mt-auto">DAFTAR SEKARANG</a>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="pricing-tem d-flex flex-column">
                        <h3 style="color: #fd7e14;">BIMBEL PLUS</h3>
                        <div class="icon">
                            <i class="bi bi-airplane" style="color: #fd7e14;"></i>
                        </div>
                        <ul class="flex-grow-1">
                            <li>Khusus untuk Kelas 10 dan 11</li>
                            <li>Latihan Soal UTBK Terupdate</li>
                            <li>Try Out Intensif</li>
                            <li>Pembahasan dan Trik Jitu</li>
                            <li>Intensif Belajar 1 Tahun</li>
                        </ul>
                        <a href="https://wa.me/6285609276949?text=Assalamualaikum." target="_blank"
                            class="btn-buy mt-auto">DAFTAR SEKARANG</a>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="pricing-tem d-flex flex-column">
                        <h3 style="color: #0d6efd;">BIMBEL KEDINASAN</h3>
                        <div class="icon">
                            <i class="bi bi-rocket" style="color: #0d6efd;"></i>
                        </div>
                        <ul class="flex-grow-1">
                            <li>Khusus untuk Kelas 12</li>
                            <li>Latihan Soal Kedinasan Terupdate</li>
                            <li>Kesamaptaan</li>
                            <li>Try Out Intensif</li>
                            <li>Pembahasan dan Trik Jitu</li>
                            <li>Intensif Belajar 1 Tahun</li>
                        </ul>
                        <a href="https://wa.me/6285609276949?text=Assalamualaikum." target="_blank"
                            class="btn-buy mt-auto">DAFTAR SEKARANG</a>
                    </div>
                </div><!-- End Pricing Item -->


            </div><!-- End pricing row -->

        </div>

    </section><!-- /Pricing Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

        <!-- Section Title -->
        <div class="container section-title-white" data-aos="fade-up">
            <!-- <h2>Bersama Studi Lanjut SMAIT IMBOS</h2> -->
            <p>Studi Lanjut IMBOS, Smart Learning, Bright Future !!!<br></p>
            <!-- <small>Temukan Pengalaman Belajar Bimbingan Intensif, Inspiratif, dan Berkualitas! <br></small> -->
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5">

                <div class="col-xl-6 d-flex">

                    <div class="row align-self-center gy-4">
                        <div class="sub-text">
                            <h3 class="sub-title">SUKSES PTN IMPIAN</h3>
                        </div>
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-box d-flex align-items-center">
                                <!-- <i class="bi bi-check"></i>
                                                            <h3>Bimbel UTBK Intensif 4 Kali/Pekan selama 11 Bulan dan Study Plus</h3> -->
                                <ul>
                                    <li><i class="bi bi-check"></i>Bimbel UTBK Intensif 4 Kali/Pekan selama 11 Bulan dan
                                        Study Plus</li>
                                    <li><i class="bi bi-check"></i>SAMT CAMP (Spiritual, Achievement, Motivation, Training
                                        Camp)</li>
                                    <li><i class="bi bi-check"></i>Try Out Internal (6 Kali), Try Out Eksternal (1 Kali)
                                    </li>
                                    <li><i class="bi bi-check"></i>Konsultasi Jurusan dan Kampus sejak awal bimbel</li>
                                    <li><i class="bi bi-check"></i>Penampingan Pendaftaran SNBP, SNBT, SPAN, PMDP dll, dan
                                        Pembuatan
                                        Portofolio</li>
                                    <li><i class="bi bi-check"></i>Modul, Latihan soal, Buku Panduan Studi Lanjut</li>
                                    <li><i class="bi bi-check"></i>Roadshow dan Sosialisasi Kampus Bersama Mahasiswa dan
                                        Dosen.</li>
                                </ul>
                            </div>
                        </div><!-- End Feature Item -->

                    </div>
                </div>

                <div class="col-xl-6 d-flex">

                    <div class="row align-self-center gy-4">
                        <div class="sub-text">
                            <h3 class="sub-title">SUKSES SEKOLAH KEDINASAN</h3>
                        </div>
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-box d-flex align-items-center">
                                <!-- <i class="bi bi-check"></i>
                                                            <h3>Bimbel UTBK Intensif 4 Kali/Pekan selama 11 Bulan dan Study Plus</h3> -->
                                <ul>
                                    <li><i class="bi bi-check"></i>Bimbel Intensif Seleksi Kemampuan Dasar (TIU, TWK, TKP)
                                        selama 9 Bulan</li>
                                    <li><i class="bi bi-check"></i>Latihan Fisik dan Kesamaptaan dengan Pelatih Profesional
                                    </li>
                                    <li><i class="bi bi-check"></i>SAMT CAMP (Spiritual, Achievement, Motivation, Training
                                        Camp)</li>
                                    <li><i class="bi bi-check"></i>Try Out Internal (6 Kali), Try Out Eksternal (1 Kali)
                                    </li>
                                    <li><i class="bi bi-check"></i>Konsultasi Jurusan dan Kampus Kedinasan</li>
                                    <li><i class="bi bi-check"></i>Modul, Latihan soal SKD Kedinasan, Buku Panduan Studi
                                        Lanjut</li>
                                    <li><i class="bi bi-check"></i>Roadshow dan Sosialisasi Kampus Bersama Mahasiswa dan
                                        Dosen.</li>
                                </ul>
                            </div>
                        </div><!-- End Feature Item -->

                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Features Section -->

    <!-- Features Section -->
    <section id="alt-features" class="alt-features section">

        <!-- Section Title -->
        <div class="container section-title-white" data-aos="fade-up">
            <p>Fasilitas<br></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5">

                <div class="col-xl-7 d-flex order-2 order-xl-1" data-aos="fade-up" data-aos-delay="200">

                    <div class="row align-self-center gy-5">

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-book-half"></i>
                            <div>
                                <h4>Modul dan Buku Belajar Lengkap dan Terbaru</h4>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-card-checklist"></i>
                            <div>
                                <h4>Kisi-kisi dan Prediksi Soal UTBK</h4>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-patch-question-fill"></i>
                            <div>
                                <h4>Konsultasi Jurusan dan Universitas</h4>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-clipboard2-data"></i>
                            <div>
                                <h4>Analisis Tingkat Keketan dan Peluang Masuk</h4>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-person-fill"></i>
                            <div>
                                <h4>Tenaga pengajar profesional dan berpengalaman</h4>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-building"></i>
                            <div>
                                <h4>Latihan Fisik, dan Tempat Belajar yang nyaman</h4>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-journal-text"></i>
                            <div>
                                <h4>Laporan hasil belajar studi lanjut IMBOS</h4>
                            </div>
                        </div><!-- End Feature Item -->

                        <!-- <div class="col-md-6 icon-box">
                                                          <i class="bi bi-patch-check"></i>
                                                          <div>
                                                            <h4>Explicabo consectetur</h4>
                                                          </div>
                                                        </div> -->
                        <!-- End Feature Item -->

                    </div>

                </div>

                <div class="col-xl-5 d-flex align-items-center order-1 order-xl-2" data-aos="fade-up"
                    data-aos-delay="100">
                    <img src="{{ asset('halaman_umum/assets/img/college project-pana.png') }}" class="img-fluid"
                        alt="">
                </div>

            </div>

        </div>

    </section><!-- /Features Section -->

    <!-- Features Section -->
    <section id="alt-features-2" class="alt-features-2 section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <p>Strategi Belajar Studi Lanjut 4P<br></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5">

                <div class="col-xl-5 d-flex align-items-center order-1 order-xl-1" data-aos="fade-up"
                    data-aos-delay="100">
                    <img src="{{ asset('halaman_umum/assets/img/Reading glasses-cuate.png') }}" class="img-fluid"
                        alt="">
                </div>

                <div class="col-xl-7 d-flex order-2 order-xl-2" data-aos="fade-up" data-aos-delay="200">

                    <div class="row align-self-center gy-5">

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-check-circle-fill"></i>
                            <div>
                                <h4>Pembelajaran (Learning)</h4>
                                <p>Pembelajaran dengan materi terstruktur, update, dan Trik Khusus</p>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-check-circle-fill"></i>
                            <div>
                                <h4>Praktik (Practice)</h4>
                                <p>
                                    Latihan soal, Simulai Try Out Internal dan Eksternal, Review Materi
                                </p>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-check-circle-fill"></i>
                            <div>
                                <h4>Peningkatan (Enhancement)</h4>
                                <p>
                                    Feedback Konstruksi, Konsultas Jurusan dan Universitas, Workshop, Pengembangan
                                </p>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-check-circle-fill"></i>
                            <div>
                                <h4>Pengharapan (Prayer)</h4>
                                <p>
                                    Integrasi nilai religi, doa bersama, keberagamaan diri.
                                </p>
                            </div>
                        </div><!-- End Feature Item -->

                    </div>

                </div>

            </div>

        </div>

    </section><!-- /Features Section -->

@endsection
