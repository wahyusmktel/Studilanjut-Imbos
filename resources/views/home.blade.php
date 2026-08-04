@extends('layouts.app')

@section('title', 'Home - Studi Lanjut IMBOS Pringsewu')

@section('content')

<style>
    /* Custom Styling for Modern UI/UX Redesign */
    .hero-slider-section {
        position: relative;
        padding: 110px 0 70px 0;
        background: linear-gradient(135deg, #1b3562 0%, #25477d 60%, #0d9488 100%);
        overflow: hidden;
        color: #ffffff;
    }

    .hero-slider-section .hero-waves {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 55px;
        z-index: 5;
    }

    .hero-swiper-container {
        padding-bottom: 25px;
        position: relative;
    }

    .hero-slide-item {
        min-height: 420px;
        display: flex;
        align-items: center;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 50px;
        font-size: 0.88rem;
        font-weight: 600;
        color: #fcd34d;
        margin-bottom: 20px;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .hero-title {
        font-size: 2.75rem;
        font-weight: 800;
        line-height: 1.25;
        color: #ffffff;
        margin-bottom: 18px;
        letter-spacing: -0.5px;
    }

    .hero-title .text-gradient {
        background: linear-gradient(135deg, #fef08a 0%, #f59e0b 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-description {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.7;
        margin-bottom: 30px;
        max-width: 580px;
    }

    .hero-actions {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-hero-primary {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: #ffffff;
        font-weight: 700;
        padding: 13px 30px;
        border-radius: 50px;
        box-shadow: 0 10px 25px rgba(245, 158, 11, 0.4);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
    }

    .btn-hero-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 30px rgba(245, 158, 11, 0.6);
        color: #ffffff;
    }

    .btn-hero-secondary {
        background: rgba(255, 255, 255, 0.12);
        color: #ffffff;
        font-weight: 600;
        padding: 13px 28px;
        border-radius: 50px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-hero-secondary:hover {
        background: rgba(255, 255, 255, 0.25);
        color: #ffffff;
        transform: translateY(-3px);
    }

    .hero-img-wrapper {
        position: relative;
        text-align: center;
    }

    .hero-img-wrapper img {
        max-height: 400px;
        object-fit: contain;
        filter: drop-shadow(0 20px 30px rgba(0,0,0,0.25));
        transition: transform 0.5s ease;
    }

    /* Bottom Slider Controls (Prev/Next + Pagination at Bottom) */
    .hero-bottom-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-top: 15px;
        position: relative;
        z-index: 10;
    }

    .hero-control-btn {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #ffffff;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.88rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .hero-control-btn:hover {
        background: #f59e0b;
        border-color: #f59e0b;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
    }

    .custom-hero-pagination {
        position: relative !important;
        bottom: 0 !important;
        width: auto !important;
        display: flex !important;
        align-items: center;
        gap: 6px;
    }

    .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background: rgba(255, 255, 255, 0.4);
        opacity: 1;
        transition: all 0.3s ease;
        margin: 0 !important;
    }

    .swiper-pagination-bullet-active {
        width: 28px;
        border-radius: 6px;
        background: #f59e0b;
    }

    /* Floating Stats Bar */
    .floating-stats-wrapper {
        margin-top: -45px;
        position: relative;
        z-index: 10;
        margin-bottom: 60px;
    }

    .stats-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px 25px;
        box-shadow: 0 20px 40px rgba(37, 71, 125, 0.08);
        border: 1px solid rgba(37, 71, 125, 0.06);
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(37, 71, 125, 0.12);
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 10px;
    }

    .stat-icon {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #25477d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        flex-shrink: 0;
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 800;
        color: #25477d;
        line-height: 1.2;
        margin-bottom: 2px;
    }

    .stat-label {
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 500;
    }

    /* Section Styling */
    .section-title-custom {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title-custom .badge-title {
        display: inline-block;
        padding: 6px 16px;
        background: #e0f2fe;
        color: #0284c7;
        font-weight: 700;
        font-size: 0.825rem;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }

    .section-title-custom h2 {
        font-size: 2.25rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 12px;
    }

    .section-title-custom p {
        color: #64748b;
        font-size: 1.05rem;
        max-width: 650px;
        margin: 0 auto;
    }

    /* Modern About Section */
    .about-spotlight-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 24px;
        padding: 45px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
        position: relative;
        overflow: hidden;
    }

    .about-spotlight-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 6px;
        height: 100%;
        background: linear-gradient(to bottom, #25477d, #0d9488);
    }

    .about-quote-icon {
        font-size: 3rem;
        color: #cbd5e1;
        margin-bottom: 15px;
    }

    .about-text {
        font-size: 1.2rem;
        line-height: 1.8;
        color: #334155;
        font-weight: 500;
        font-style: italic;
        margin-bottom: 25px;
    }

    /* Feature Grid Styling */
    .modern-feature-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 24px;
        height: 100%;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .modern-feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 35px rgba(37, 71, 125, 0.08);
        border-color: #cbd5e1;
    }

    .feature-icon-wrapper {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: linear-gradient(135deg, #25477d 0%, #1e3a8a 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
        box-shadow: 0 6px 15px rgba(37, 71, 125, 0.25);
    }

    .modern-feature-card h3 {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        line-height: 1.4;
    }

    /* Target Tracks Showcase */
    .track-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .track-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(37, 71, 125, 0.1);
    }

    .track-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .badge-ptn { background: #dbeafe; color: #1d4ed8; }
    .badge-ptk { background: #fef3c7; color: #b45309; }
    .badge-pts { background: #dcfce7; color: #15803d; }
    .badge-intl { background: #fae8ff; color: #86198f; }

    .track-card h4 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .track-card p {
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    /* Quick Portal Cards */
    .portal-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 20px;
        padding: 28px;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .portal-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 35px rgba(15, 23, 42, 0.3);
    }

    .portal-card.accent-1 { background: linear-gradient(135deg, #25477d 0%, #1e3a8a 100%); }
    .portal-card.accent-2 { background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%); }
    .portal-card.accent-3 { background: linear-gradient(135deg, #d97706 0%, #b45309 100%); }
    .portal-card.accent-4 { background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); }

    .portal-icon {
        font-size: 2.2rem;
        margin-bottom: 15px;
        opacity: 0.9;
    }

    .portal-card h4 {
        color: #ffffff;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .portal-card p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        margin-bottom: 20px;
    }

    .portal-link {
        color: #ffffff;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: gap 0.3s ease;
    }

    .portal-card:hover .portal-link {
        gap: 10px;
    }

    @media (max-width: 991px) {
        .hero-slider-section {
            padding: 90px 0 40px 0;
        }
        .hero-title {
            font-size: 2.1rem;
        }
        .hero-slide-item {
            min-height: auto;
            text-align: center;
        }
        .hero-description {
            margin-left: auto;
            margin-right: auto;
        }
        .hero-actions {
            justify-content: center;
            margin-bottom: 25px;
        }
        .hero-img-wrapper img {
            max-height: 270px;
        }
        .floating-stats-wrapper {
            margin-top: 20px;
        }
    }
</style>

<!-- Hero Section with Swiper Slider -->
<section id="hero" class="hero-slider-section">
    @include('includes.menu_mobile_app')

    <div class="container">
        <div class="swiper init-swiper hero-swiper-container">
            <script type="application/json" class="swiper-config">
                {
                    "loop": true,
                    "speed": 700,
                    "autoplay": {
                        "delay": 5000,
                        "disableOnInteraction": false
                    },
                    "slidesPerView": 1,
                    "spaceBetween": 30,
                    "pagination": {
                        "el": ".custom-hero-pagination",
                        "type": "bullets",
                        "clickable": true
                    },
                    "navigation": {
                        "nextEl": ".hero-btn-next",
                        "prevEl": ".hero-btn-prev"
                    }
                }
            </script>

            <div class="swiper-wrapper">

                <!-- Slide 1: Main Overview -->
                <div class="swiper-slide">
                    <div class="hero-slide-item">
                        <div class="row align-items-center w-100">
                            <div class="col-lg-7 order-2 order-lg-1" data-aos="fade-right">
                                <div class="hero-badge">
                                    <i class="bi bi-stars"></i> Profil SMAIT IMBOS
                                </div>
                                <h1 class="hero-title">
                                    Pendidikan Berkualitas Berbasis <span class="text-gradient">Nilai Islam & Al-Qur'an</span>
                                </h1>
                                <p class="hero-description">
                                    SMAIT Insan Mulia Boarding School memberikan proses pendidikan unggulan standar nasional yang mengintegrasikan kecerdasan akademis dengan kokohnya akidah Al-Qur'an.
                                </p>
                                <div class="hero-actions">
                                    <a href="/tentang-kami" class="btn-hero-primary">
                                        <span>Tentang Kami</span>
                                        <i class="bi bi-arrow-right-short fs-5"></i>
                                    </a>
                                    <a href="https://wa.me/6285609276949?text=Assalamualaikum.%20Saya%20ingin%20bertanya%20mengenai%20Studi%20Lanjut%20IMBOS" target="_blank" class="btn-hero-secondary">
                                        <i class="bi bi-whatsapp"></i>
                                        <span>Konsultasi WA</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-5 order-1 order-lg-2 hero-img-wrapper" data-aos="fade-left">
                                <img src="{{ asset('halaman_umum/assets/img/hero-img-putri-home-2.png') }}" class="img-fluid animated" alt="Siswa IMBOS">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2: Program Studi Lanjut -->
                <div class="swiper-slide">
                    <div class="hero-slide-item">
                        <div class="row align-items-center w-100">
                            <div class="col-lg-7 order-2 order-lg-1">
                                <div class="hero-badge">
                                    <i class="bi bi-mortarboard-fill"></i> Program Unggulan
                                </div>
                                <h1 class="hero-title">
                                    Akselerasi Studi Lanjut ke <span class="text-gradient">PTN & Kampus Global</span>
                                </h1>
                                <p class="hero-description">
                                    Persiapan komprehensif menuju Perguruan Tinggi Negeri (PTN), Sekolah Kedinasan (PTK), PTKIN, PTS favorit, hingga peluang beasiswa studi ke Turki & Timur Tengah.
                                </p>
                                <div class="hero-actions">
                                    <a href="/program" class="btn-hero-primary">
                                        <span>Lihat Program</span>
                                        <i class="bi bi-journal-bookmark-fill"></i>
                                    </a>
                                    <a href="/tracking-alumni" class="btn-hero-secondary">
                                        <i class="bi bi-search"></i>
                                        <span>Track Alumni</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-5 order-1 order-lg-2 hero-img-wrapper">
                                <img src="{{ asset('halaman_umum/assets/img/hero-image-putra.png') }}" class="img-fluid" alt="Studi Lanjut IMBOS">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3: Bimbel Intensif & Try Out -->
                <div class="swiper-slide">
                    <div class="hero-slide-item">
                        <div class="row align-items-center w-100">
                            <div class="col-lg-7 order-2 order-lg-1">
                                <div class="hero-badge">
                                    <i class="bi bi-lightning-charge-fill"></i> Bimbel Intensif SNBP & UTBK
                                </div>
                                <h1 class="hero-title">
                                    Optimalkan Peluang Kelulusan Impian <span class="text-gradient">Secara Terarah</span>
                                </h1>
                                <p class="hero-description">
                                    Layanan bimbingan belajar intensif dengan materi prediksi terakurat, try out berkala, pembahasan tuntas, serta pemetaan keketatan jurusan.
                                </p>
                                <div class="hero-actions">
                                    <a href="/tryout" class="btn-hero-primary">
                                        <span>Mulai Try Out</span>
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="/orang-tua" class="btn-hero-secondary">
                                        <i class="bi bi-person-hearts"></i>
                                        <span>Pantau Ortu</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-5 order-1 order-lg-2 hero-img-wrapper">
                                <img src="{{ asset('halaman_umum/assets/img/college project-pana.png') }}" class="img-fluid" alt="Bimbel Intensif">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Navigation Controls Bar (Prev - Pagination - Next) -->
            <div class="hero-bottom-controls">
                <button class="hero-control-btn hero-btn-prev" aria-label="Previous Slide">
                    <i class="bi bi-chevron-left"></i>
                    <span>Prev</span>
                </button>
                <div class="swiper-pagination custom-hero-pagination"></div>
                <button class="hero-control-btn hero-btn-next" aria-label="Next Slide">
                    <span>Next</span>
                    <i class="bi bi-chevron-right"></i>
                </button>
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
            <use xlink:href="#wave-path" x="50" y="9" fill="#f8fafc"></use>
        </g>
    </svg>
</section>

<!-- Floating Stats Bar -->
<div class="container floating-stats-wrapper">
    <div class="stats-card" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 divider-grid">
            <div class="col-6 col-lg-3">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <div>
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Pendampingan PTN/PTS</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-globe-americas"></i>
                    </div>
                    <div>
                        <div class="stat-number">Turki & ME</div>
                        <div class="stat-label">Kerjasama Internasional</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-book-half"></i>
                    </div>
                    <div>
                        <div class="stat-number">6+</div>
                        <div class="stat-label">Fitur Bimbel Unggulan</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <div class="stat-number">Real-Time</div>
                        <div class="stat-label">Monitoring Orang Tua</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Spotlight Section -->
<section id="aboutfeatures" class="py-4">
    <div class="container">
        <div class="section-title-custom" data-aos="fade-up">
            <span class="badge-title">Tentang Layanan Kami</span>
            <h2>Studi Lanjut SMAIT IMBOS</h2>
            <p>Fasilitas pendampingan karir dan akademik terlengkap untuk mewujudkan cita-cita siswa melangkah ke Perguruan Tinggi Impian.</p>
        </div>

        <div class="about-spotlight-card" data-aos="fade-up" data-aos-delay="150">
            <i class="bi bi-quote about-quote-icon"></i>
            <p class="about-text">
                "Studi Lanjut IMBOS merupakan fasilitas layanan Bimbingan Belajar Intensif untuk mempersiapkan SNBP, SNBT/UTBK, Ujian Mandiri, hingga Persiapan Kedinasan dengan pembelajaran berkualitas dan terstruktur."
            </p>
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('halaman_umum/assets/img/logo-imbos.png') }}" height="42" alt="Logo IMBOS">
                    <div>
                        <h5 class="mb-0 fw-bold" style="color: #25477d;">SMAIT IMBOS Pringsewu</h5>
                        <small class="text-muted">Insan Mulia Boarding School</small>
                    </div>
                </div>
                <a href="/tentang-kami" class="btn-read-more d-inline-flex align-items-center gap-2 btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold">
                    <span>Selengkapnya</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5 mt-4">
    <div class="container">
        <div class="section-title-custom" data-aos="fade-up">
            <span class="badge-title">Keunggulan Layanan</span>
            <h2>Buat Belajarmu Menjadi Optimal</h2>
            <p>Temukan Pengalaman Belajar Bimbingan Intensif, Inspiratif, dan Berkualitas!</p>
        </div>

        <div class="row gy-4 align-items-center">
            <div class="col-xl-7">
                <div class="row gy-3">
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="modern-feature-card">
                            <div class="feature-icon-wrapper">
                                <i class="bi bi-lightning-charge-fill"></i>
                            </div>
                            <div>
                                <h3>Belajar Intensif</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="modern-feature-card">
                            <div class="feature-icon-wrapper">
                                <i class="bi bi-journal-bookmark-fill"></i>
                            </div>
                            <div>
                                <h3>Materi Update & Akurat</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="modern-feature-card">
                            <div class="feature-icon-wrapper">
                                <i class="bi bi-award-fill"></i>
                            </div>
                            <div>
                                <h3>Try Out & Pembahasan</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="modern-feature-card">
                            <div class="feature-icon-wrapper">
                                <i class="bi bi-compass-fill"></i>
                            </div>
                            <div>
                                <h3>Konsultasi Kampus & Jurusan</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="modern-feature-card">
                            <div class="feature-icon-wrapper">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>
                            <div>
                                <h3>Analisis Keketatan Jurusan</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="modern-feature-card">
                            <div class="feature-icon-wrapper">
                                <i class="bi bi-book-half"></i>
                            </div>
                            <div>
                                <h3>Buku Prediksi Terbaru</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 text-center" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{ asset('halaman_umum/assets/img/features.png') }}" class="img-fluid rounded-4 shadow-sm" alt="Features Image">
            </div>
        </div>
    </div>
</section>

<!-- Target Study Destination Section -->
<section class="py-5 bg-light rounded-4 my-5">
    <div class="container">
        <div class="section-title-custom" data-aos="fade-up">
            <span class="badge-title">Target Karir & Akademik</span>
            <h2>Jalur Lanjutan Studi Lulusan</h2>
            <p>Dukungan penuh untuk seluruh jalur penerimaan mahasiswa baru nasional & internasional.</p>
        </div>

        <div class="row gy-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="track-card">
                    <div>
                        <span class="track-badge badge-ptn">Nasional</span>
                        <h4>PTN Impian</h4>
                        <p>Persiapan jalur SNBP (Prestasi) & SNBT/UTBK (Tes) menuju perguruan tinggi negeri top Indonesia.</p>
                    </div>
                    <a href="/program" class="text-primary fw-semibold fs-7">Pelajari Detail <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="track-card">
                    <div>
                        <span class="track-badge badge-ptk">Kedinasan</span>
                        <h4>Sekolah Kedinasan</h4>
                        <p>Bimbingan fisik & akademis terpadu untuk seleksi Sekolah Kedinasan (PTK) terfavorit.</p>
                    </div>
                    <a href="/program" class="text-primary fw-semibold fs-7">Pelajari Detail <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="track-card">
                    <div>
                        <span class="track-badge badge-pts">Keagamaan & PTS</span>
                        <h4>PTKIN & PTS</h4>
                        <p>Pendampingan masuk kampus Islam negeri (SPAN-PTKIN/UM-PTKIN) dan PTS bereputasi tinggi.</p>
                    </div>
                    <a href="/program" class="text-primary fw-semibold fs-7">Pelajari Detail <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="track-card">
                    <div>
                        <span class="track-badge badge-intl">Global</span>
                        <h4>Studi Internasional</h4>
                        <p>Kerjasama resmi pendampingan kuliah luar negeri ke Turki dan negara-negara Timur Tengah.</p>
                    </div>
                    <a href="/program" class="text-primary fw-semibold fs-7">Pelajari Detail <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Portal Access Cards -->
<section class="py-5 mb-5">
    <div class="container">
        <div class="section-title-custom" data-aos="fade-up">
            <span class="badge-title">Akses Cepat</span>
            <h2>Portal & Layanan Utama</h2>
            <p>Pilih portal yang sesuai dengan kebutuhan Anda untuk memulai.</p>
        </div>

        <div class="row gy-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="portal-card accent-1">
                    <div>
                        <i class="bi bi-mortarboard-fill portal-icon"></i>
                        <h4>Track Alumni</h4>
                        <p>Pantau sebaran alumni SMAIT IMBOS di berbagai kampus ternama.</p>
                    </div>
                    <a href="/tracking-alumni" class="portal-link">
                        <span>Buka Portal Alumni</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="portal-card accent-2">
                    <div>
                        <i class="bi bi-pencil-square portal-icon"></i>
                        <h4>Try Out Online</h4>
                        <p>Uji kemampuan akademis dengan latihan soal standar UTBK.</p>
                    </div>
                    <a href="/tryout" class="portal-link">
                        <span>Mulai Try Out</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="portal-card accent-3">
                    <div>
                        <i class="bi bi-person-hearts portal-icon"></i>
                        <h4>Pantau Ortu</h4>
                        <p>Akses hasil perkembangan dan laporan belajar putra/putri Anda.</p>
                    </div>
                    <a href="/orang-tua" class="portal-link">
                        <span>Pantau Progress</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="portal-card accent-4">
                    <div>
                        <i class="bi bi-newspaper portal-icon"></i>
                        <h4>Info & Berita</h4>
                        <p>Informasi jadwal seleksi, beasiswa, dan kabar terbaru sekolah.</p>
                    </div>
                    <a href="/berita" class="portal-link">
                        <span>Baca Berita</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
