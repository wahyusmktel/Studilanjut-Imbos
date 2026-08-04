@extends('layouts.app')

@section('title', 'Tentang Kami - Studi Lanjut IMBOS Pringsewu')

@section('content')

<style>
    /* Glassmorphism Design System */
    .about-hero-section {
        position: relative;
        padding: 120px 0 70px 0;
        background: linear-gradient(135deg, #1b3562 0%, #25477d 60%, #0d9488 100%);
        overflow: hidden;
        color: #ffffff;
    }

    .about-hero-section .hero-waves {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 55px;
        z-index: 5;
    }

    .glass-card-hero {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 28px;
        padding: 40px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    .glass-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        color: #fcd34d;
        letter-spacing: 0.5px;
        margin-bottom: 16px;
    }

    .glass-hero-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 15px;
        line-height: 1.25;
    }

    .glass-hero-title .text-gradient {
        background: linear-gradient(135deg, #fef08a 0%, #f59e0b 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .glass-hero-subtitle {
        font-size: 1.05rem;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.7;
        margin-bottom: 0;
    }

    /* About Content Glass Section */
    .glass-content-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 28px;
        padding: 45px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.06);
        position: relative;
    }

    .glass-section-heading {
        font-size: 1.85rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 20px;
        line-height: 1.35;
    }

    .glass-text-description {
        font-size: 1.05rem;
        color: #475569;
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .glass-image-wrapper {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(37, 71, 125, 0.15);
        border: 4px solid rgba(255, 255, 255, 0.8);
    }

    .glass-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .glass-image-wrapper:hover img {
        transform: scale(1.03);
    }

    /* Features Glass Grid */
    .features-glass-section {
        background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%);
        padding: 80px 0;
        position: relative;
    }

    .glass-feature-card {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 22px;
        padding: 24px;
        height: 100%;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .glass-feature-card:hover {
        transform: translateY(-6px);
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 20px 40px rgba(37, 71, 125, 0.12);
        border-color: #cbd5e1;
    }

    .glass-feature-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #ffffff;
        flex-shrink: 0;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .gf-icon-1 { background: linear-gradient(135deg, #25477d 0%, #1e3a8a 100%); }
    .gf-icon-2 { background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%); }
    .gf-icon-3 { background: linear-gradient(135deg, #d97706 0%, #b45309 100%); }
    .gf-icon-4 { background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); }
    .gf-icon-5 { background: linear-gradient(135deg, #ec4899 0%, #be185d 100%); }

    .glass-feature-card h4 {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        line-height: 1.45;
    }

    /* Star Teacher Team Section */
    .team-glass-section {
        padding: 80px 0;
        background: #ffffff;
    }

    .teacher-glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 12px 32px rgba(15, 23, 42, 0.05);
        transition: all 0.35s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .teacher-glass-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(37, 71, 125, 0.14);
        border-color: #94a3b8;
    }

    .teacher-img-box {
        height: 280px;
        overflow: hidden;
        position: relative;
        background: #f1f5f9;
    }

    .teacher-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
        transition: transform 0.5s ease;
    }

    .teacher-glass-card:hover .teacher-img-box img {
        transform: scale(1.06);
    }

    .teacher-info-box {
        padding: 22px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .teacher-name {
        font-size: 1.15rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 4px;
        letter-spacing: -0.3px;
    }

    .teacher-subject-badge {
        display: inline-block;
        font-size: 0.78rem;
        font-weight: 700;
        color: #0284c7;
        background: #e0f2fe;
        padding: 4px 12px;
        border-radius: 50px;
        margin-bottom: 12px;
    }

    .teacher-motto {
        font-size: 0.88rem;
        color: #64748b;
        font-style: italic;
        line-height: 1.5;
        margin: 0;
        background: #f8fafc;
        padding: 10px 14px;
        border-radius: 12px;
        border-left: 3px solid #0284c7;
    }

    @media (max-width: 991px) {
        .about-hero-section {
            padding: 90px 0 50px 0;
        }
        .glass-card-hero {
            padding: 28px 20px;
            text-align: center;
        }
        .glass-hero-title {
            font-size: 1.95rem;
        }
        .glass-content-card {
            padding: 28px 20px;
        }
    }
</style>

<!-- Hero Section -->
<section id="hero" class="about-hero-section">
    @include('includes.menu_mobile_app')

    <div class="container">
        <div class="glass-card-hero" data-aos="fade-down">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="glass-badge">
                        <i class="bi bi-info-circle-fill"></i> Tentukankan Masa Depanmu
                    </span>
                    <h1 class="glass-hero-title">
                        Mengenal Lebih Dekat <span class="text-gradient">Studi Lanjut IMBOS</span>
                    </h1>
                    <p class="glass-hero-subtitle">
                        Bimbingan belajar intensif berkualitas tinggi dengan pendekatan Al-Qur'an dan persiapan terbaik menuju PTN, Kedinasan & Luar Negeri.
                    </p>
                </div>
                <div class="col-lg-4 text-center text-lg-end mt-4 mt-lg-0">
                    <a href="#about" class="btn btn-warning rounded-pill px-4 py-3 fw-bold shadow-lg d-inline-flex align-items-center gap-2">
                        <span>Jelajahi Profil</span>
                        <i class="bi bi-arrow-down-circle-fill"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave Divider -->
    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none">
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
            <use xlink:href="#wave-path" x="50" y="9" fill="#ffffff"></use>
        </g>
    </svg>
</section>

<!-- About Section -->
<section id="about" class="py-5 bg-white">
    <div class="container py-4" data-aos="fade-up">
        <div class="row gy-5 align-items-center">

            <div class="col-lg-7" data-aos="fade-right" data-aos-delay="100">
                <div class="glass-content-card">
                    <span class="badge-title mb-2 d-inline-block px-3 py-1 bg-light text-primary rounded-pill fw-bold fs-7">Visi & Komitmen Kami</span>
                    <h2 class="glass-section-heading">Selamat Datang Di Bimbel Studi Lanjut SMAIT IMBOS Pringsewu</h2>
                    <p class="glass-text-description">
                        Bimbel Studi Lanjut SMAIT IMBOS Pringsewu merupakan bimbingan belajar yang mendedikasikan untuk membantu para santri mencapai hasil terbaik dalam persiapan <strong>SNBP, SNBT-UTBK, Ujian Mandiri</strong>, dan <strong>Persiapan seleksi masuk Perguruan Tinggi Kedinasan (PTK)</strong>.
                    </p>
                    <p class="glass-text-description mb-4">
                        Kami berkomitmen untuk menyediakan lingkungan belajar yang efektif, inovatif, terarah, dan memberikan tips serta trik jitu dalam mengerjakan soal untuk menghantarkan siswa ke kampus impian mereka.
                    </p>
                    <div class="row g-3">
                        <div class="col-6 col-sm-4">
                            <div class="p-3 bg-light rounded-4 text-center border">
                                <h4 class="fw-bold text-primary mb-1">SNBP & UTBK</h4>
                                <small class="text-muted fw-semibold">Fokus PTN</small>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="p-3 bg-light rounded-4 text-center border">
                                <h4 class="fw-bold text-success mb-1">Kedinasan</h4>
                                <small class="text-muted fw-semibold">Latihan PTK</small>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="p-3 bg-light rounded-4 text-center border">
                                <h4 class="fw-bold text-warning mb-1">Global</h4>
                                <small class="text-muted fw-semibold">Turki & ME</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5" data-aos="fade-left" data-aos-delay="200">
                <div class="glass-image-wrapper">
                    <img src="{{ asset('halaman_umum/assets/img/about-3.jpg') }}" class="img-fluid" alt="Bimbel IMBOS Pringsewu">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Features Section (Mengapa Memilih Kami) -->
<section id="alt-features" class="features-glass-section">
    <div class="container">
        <div class="section-title-custom" data-aos="fade-up">
            <span class="badge-title">Keunggulan Utama</span>
            <h2>Mengapa Memilih Kami ?</h2>
            <p>Fasilitas dan metode terbaik dirancang khusus untuk memaksimalkan potensi akademis Anda.</p>
        </div>

        <div class="row gy-4 align-items-center">
            <div class="col-xl-7 order-2 order-xl-1">
                <div class="row gy-3">

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="glass-feature-card">
                            <div class="glass-feature-icon gf-icon-1">
                                <i class="bi bi-award-fill"></i>
                            </div>
                            <div>
                                <h4>Pengajar berpengalaman & profesional, siap membimbing secara intensif</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="glass-feature-card">
                            <div class="glass-feature-icon gf-icon-2">
                                <i class="bi bi-card-checklist"></i>
                            </div>
                            <div>
                                <h4>Kurikulum terintegrasi dengan materi belajar terupdate</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="glass-feature-card">
                            <div class="glass-feature-icon gf-icon-3">
                                <i class="bi bi-patch-check-fill"></i>
                            </div>
                            <div>
                                <h4>Metode pembelajaran interaktif dengan trik jitu UTBK</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="glass-feature-card">
                            <div class="glass-feature-icon gf-icon-4">
                                <i class="bi bi-journal-bookmark-fill"></i>
                            </div>
                            <div>
                                <h4>Fasilitas lengkap, Try Out Internal & Eksternal berkala</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" data-aos="fade-up" data-aos-delay="500">
                        <div class="glass-feature-card">
                            <div class="glass-feature-icon gf-icon-5">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>
                            <div>
                                <h4>Dukungan & Bimbingan strategi Pemilihan Jurusan serta Universitas yang akurat</h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-5 text-center order-1 order-xl-2" data-aos="zoom-in" data-aos-delay="200">
                <div class="glass-image-wrapper">
                    <img src="{{ asset('halaman_umum/assets/img/model-tentang-kami.png') }}" class="img-fluid" alt="Model IMBOS">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section (Star Teacher) -->
<section id="team" class="team-glass-section">
    <div class="container">
        <div class="section-title-custom" data-aos="fade-up">
            <span class="badge-title">Tim Pengajar Terbaik</span>
            <h2>Star Teacher Ketje</h2>
            <p>Siap Membimbing Belajarmu Menuju Kampus Impian !!!</p>
        </div>

        <div class="row gy-4">
            @foreach ($gurus as $guru)
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <div class="teacher-glass-card">
                        <div class="teacher-img-box">
                            @if ($guru->foto)
                                <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama }}">
                            @else
                                <img src="{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}" alt="{{ $guru->nama }}">
                            @endif
                        </div>
                        <div class="teacher-info-box">
                            <div>
                                <h4 class="teacher-name">{{ strtoupper($guru->nama) }}</h4>
                                <span class="teacher-subject-badge">
                                    <i class="bi bi-star-fill text-warning me-1"></i> Star Teacher {{ $guru->mataPelajaran->namaMataPelajaran }}
                                </span>
                            </div>
                            @if ($guru->motto)
                                <p class="teacher-motto">"{{ $guru->motto }}"</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
