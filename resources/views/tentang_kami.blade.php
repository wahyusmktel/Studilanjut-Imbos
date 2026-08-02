@extends('layouts.app')

@section('title', 'Tentang Kami')

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
                    <div class="content">
                        <h2>Selamat Datang Di Bimbel Studi Lanjut SMAIT IMBOS Pringsewu</h2>
                        <p>
                            Bimbel Studi Lanjut SMAIT IMBOS Pringsewu merupakan bimbingan belajar yang mendedikasikan
                            untuk membantu para santri mencapai hasil terbaik dalam persiapan SNBP, SNBT-UTBK, Ujian
                            Mandiri, dan Persiapan seleksi masuk Perguruan Tinggi Kedinasan (PTK). Kami berkomitmen untuk
                            menyediakan lingkungan belajar yang efektif, inovatif, terarah, dan memberikan tips serta trik
                            jitu dalam mengerjakan soal.
                        </p>
                        <!-- <div class="text-center text-lg-start">
                                                                        <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                                                          <span>Read More</span>
                                                                          <i class="bi bi-arrow-right"></i>
                                                                        </a>
                                                                      </div> -->
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('halaman_umum/assets/img/about-3.jpg') }}" class="img-fluid" alt="">
                </div>

            </div>
        </div>
        <img src="{{ asset('halaman_umum/assets/img/kiri 2.png') }}" alt="Ornament" class="background-ornament-about-atas">
    </section><!-- /About Section -->

    <!-- Features Section -->
    <section id="alt-features" class="alt-features section">

        <!-- Section Title -->
        <div class="container section-title-white" data-aos="fade-up">
            <p>Mengapa Memilih Kami ?<br></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5">

                <div class="col-xl-7 d-flex order-2 order-xl-1" data-aos="fade-up" data-aos-delay="200">

                    <div class="row align-self-center gy-5">

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-award"></i>
                            <div>
                                <h4>Pengajar berpengalaman, professional, siap membimbing secara intensif</h4>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-card-checklist"></i>
                            <div>
                                <h4>Kurikulum terintegrasi dengan program belajar menggunakan materi terupdate</h4>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-patch-check"></i>
                            <div>
                                <h4>Metode pembelajaran yang interaktif dan menggunakan trik jitu</h4>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-journal-bookmark-fill"></i>
                            <div>
                                <h4>Fasilitas belajar lengkap, Try Out Internal dan Try Out Eksternal</h4>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="bi bi-mortarboard-fill"></i>
                            <div>
                                <h4>Dukungan dan Bimbingan strategi Pemilihan Jurusan dan Universitas.</h4>
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

                <div class="col-xl-5 d-flex align-items-center order-1 order-xl-2" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('halaman_umum/assets/img/model-tentang-kami.png') }}" class="img-fluid"
                        alt="">
                </div>

            </div>

        </div>

    </section><!-- /Features Section -->

    <!-- Team Section -->
    <section id="team" class="team section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <p>Star Teacher Ketje, Siap<br></p>
            <small class="section-title-white small" style="color: #433f3f;">Membimbing Belajarmu !!!</small>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                @foreach ($gurus as $guru)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                        <div class="team-member">
                            <div class="member-img">
                                @if ($guru->foto)
                                    <img src="{{ asset('storage/' . $guru->foto) }}" class="img-fluid"
                                        alt="{{ $guru->nama }}">
                                @else
                                    <img src="{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}" class="img-fluid"
                                        alt="{{ $guru->nama }}">
                                @endif
                            </div>
                            <div class="member-info">
                                <h4>{{ strtoupper($guru->nama) }}</h4>
                                <span>Star Teacher {{ $guru->mataPelajaran->namaMataPelajaran }}</span>
                                <p>"{{ $guru->motto }}"</p>
                            </div>
                        </div>
                    </div><!-- End Team Member -->
                @endforeach

            </div>

        </div>

    </section><!-- /Team Section -->

@endsection
