@extends('layouts.app')

@section('title', 'Track Alumni - Studi Lanjut IMBOS Pringsewu')

@section('content')

<style>
    /* Glassmorphism Design System for Track Alumni */
    .alumni-hero-section {
        position: relative;
        padding: 120px 0 70px 0;
        background: linear-gradient(135deg, #1b3562 0%, #25477d 60%, #0d9488 100%);
        overflow: hidden;
        color: #ffffff;
    }

    .alumni-hero-section .hero-waves {
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

    /* Chart & Info Glass Cards */
    .glass-info-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.7);
        border-radius: 28px;
        padding: 36px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.06);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .glass-chart-card {
        background: #ffffff;
        border-radius: 28px;
        padding: 28px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
        border: 1px solid #e2e8f0;
        height: 100%;
    }

    .chart-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }

    .chart-header h3 {
        font-size: 1.15rem;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Testimonials Glass Section */
    .testimonials-glass-section {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        padding: 80px 0;
        position: relative;
        color: #ffffff;
    }

    .testimonial-glass-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 24px;
        padding: 30px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.3s ease;
    }

    .testimonial-glass-card:hover {
        transform: translateY(-6px);
        background: rgba(255, 255, 255, 0.14);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .testimonial-stars {
        color: #f59e0b;
        font-size: 1.1rem;
        margin-bottom: 14px;
        display: flex;
        gap: 4px;
    }

    .testimonial-text {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.95rem;
        line-height: 1.7;
        font-style: italic;
        margin-bottom: 24px;
    }

    .testimonial-profile-box {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .testimonial-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #f59e0b;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .testimonial-name {
        font-size: 1rem;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
    }

    .testimonial-univ {
        font-size: 0.825rem;
        color: #38bdf8;
        margin: 0;
        font-weight: 600;
    }

    /* Directory & Filters */
    .filter-glass-bar {
        background: #ffffff;
        border-radius: 20px;
        padding: 18px 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
        margin-bottom: 30px;
    }

    .portfolio-filters.isotope-filters {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        padding: 0;
        margin-bottom: 35px;
        list-style: none;
    }

    .portfolio-filters.isotope-filters li {
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.88rem;
        font-weight: 700;
        cursor: pointer;
        background: #f1f5f9;
        color: #475569;
        transition: all 0.25s ease;
        border: 1px solid transparent;
    }

    .portfolio-filters.isotope-filters li:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    .portfolio-filters.isotope-filters li.filter-active {
        background: #25477d;
        color: #ffffff;
        box-shadow: 0 6px 18px rgba(37, 71, 125, 0.25);
    }

    /* Alumni Card Item */
    .alumni-glass-card {
        background: #ffffff;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.35s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .alumni-glass-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 45px rgba(37, 71, 125, 0.12);
        border-color: #cbd5e1;
    }

    .alumni-img-wrapper {
        position: relative;
        height: 250px;
        overflow: hidden;
        background: #f8fafc;
    }

    .alumni-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
        transition: transform 0.5s ease;
    }

    .alumni-glass-card:hover .alumni-img-wrapper img {
        transform: scale(1.06);
    }

    .alumni-overlay-badge {
        position: absolute;
        top: 14px;
        right: 14px;
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(8px);
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 50px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .alumni-info-box {
        padding: 22px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .alumni-title-name {
        font-size: 1.1rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 4px;
        line-height: 1.35;
    }

    .alumni-univ-name {
        font-size: 0.9rem;
        font-weight: 600;
        color: #0284c7;
        margin-bottom: 16px;
    }

    .alumni-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-top: 12px;
        border-top: 1px solid #f1f5f9;
    }

    .btn-alumni-action {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: #f1f5f9;
        color: #25477d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-alumni-action:hover {
        background: #25477d;
        color: #ffffff;
    }

    .btn-alumni-detail {
        font-size: 0.825rem;
        font-weight: 700;
        color: #25477d;
        background: #eff6ff;
        padding: 8px 16px;
        border-radius: 50px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    .btn-alumni-detail:hover {
        background: #25477d;
        color: #ffffff;
    }

    @media (max-width: 991px) {
        .alumni-hero-section {
            padding: 90px 0 50px 0;
        }
        .glass-card-hero {
            padding: 28px 20px;
            text-align: center;
        }
        .glass-hero-title {
            font-size: 1.95rem;
        }
    }
</style>

<!-- Hero Section -->
<section id="hero" class="alumni-hero-section">
    @include('includes.menu_mobile_app')

    <div class="container">
        <div class="glass-card-hero" data-aos="fade-down">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="glass-badge">
                        <i class="bi bi-mortarboard-fill"></i> Jejak Alumni SMAIT IMBOS
                    </span>
                    <h1 class="glass-hero-title">
                        Persebaran Alumni & <span class="text-gradient">Jejak Kelulusan</span>
                    </h1>
                    <p class="glass-hero-subtitle">
                        Menelusuri keberhasilan alumni SMAIT IMBOS di berbagai Perguruan Tinggi Negeri (PTN), Sekolah Kedinasan (PTK), PTKIN, PTS unggulan, hingga Perguruan Tinggi Internasional.
                    </p>
                </div>
                <div class="col-lg-4 text-center text-lg-end mt-4 mt-lg-0">
                    <a href="#portfolio" class="btn btn-warning rounded-pill px-4 py-3 fw-bold shadow-lg d-inline-flex align-items-center gap-2">
                        <span>Cari Alumni</span>
                        <i class="bi bi-search"></i>
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

<!-- Overview & Chart Section -->
<section id="about" class="py-5 bg-white">
    <div class="container py-4" data-aos="fade-up">
        <div class="row gy-4 align-items-stretch">
            
            <div class="col-lg-5" data-aos="fade-right" data-aos-delay="100">
                <div class="glass-info-card">
                    <div>
                        <span class="badge-title mb-2 d-inline-block px-3 py-1 bg-light text-primary rounded-pill fw-bold fs-7">Sebaran Kampus</span>
                        <h2 class="fw-extrabold text-dark mb-3">Alumni Studi Lanjut IMBOS</h2>
                        <p class="text-muted leading-relaxed mb-4">
                            Alumni SMAIT IMBOS telah berhasil menembus berbagai Perguruan Tinggi ternama di Indonesia dan Luar Negeri, melintasi berbagai jalur seleksi seperti SNBP, SNBT/UTBK, Ujian Mandiri, PTK Kedinasan, hingga beasiswa Internasional.
                        </p>
                    </div>

                    <div class="p-3 bg-light rounded-4 border">
                        <div class="d-flex align-items-center gap-3">
                            <div class="fs-2 text-primary">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">Data Terverifikasi</h6>
                                <small class="text-muted">Grafik sebaran diperbarui secara berkala</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">
                <div class="glass-chart-card">
                    <div class="chart-header">
                        <h3>
                            <i class="bi bi-bar-chart-line-fill text-primary"></i>
                            Grafik Persebaran Alumni
                        </h3>
                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 fw-bold fs-7">Statistik</span>
                    </div>
                    <div style="position: relative; height: 320px;">
                        <canvas id="alumniChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="testimonials-glass-section">
    <div class="container">
        <div class="section-title-custom text-center mb-5" data-aos="fade-up">
            <span class="badge-title bg-primary-subtle text-primary">Kesan & Pesan</span>
            <h2 class="text-white">Apa Kata Alumni ?</h2>
            <p class="text-white-50">Pengalaman dan kisah sukses para alumni dalam menembus Perguruan Tinggi Impian bersama IMBOS.</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000,
                            "disableOnInteraction": false
                        },
                        "slidesPerView": 1,
                        "spaceBetween": 25,
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "768": {
                                "slidesPerView": 2,
                                "spaceBetween": 25
                            },
                            "1200": {
                                "slidesPerView": 3,
                                "spaceBetween": 25
                            }
                        }
                    }
                </script>

                <div class="swiper-wrapper pb-5">
                    @foreach ($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonial-glass-card">
                                <div>
                                    <div class="testimonial-stars">
                                        @for ($i = 1; $i <= $testimonial->rating; $i++)
                                            <i class="bi bi-star-fill"></i>
                                        @endfor
                                        @for ($i = $testimonial->rating + 1; $i <= 5; $i++)
                                            <i class="bi bi-star"></i>
                                        @endfor
                                    </div>
                                    <p class="testimonial-text">"{{ $testimonial->isi_testimonial }}"</p>
                                </div>
                                <div class="testimonial-profile-box">
                                    @if ($testimonial->alumni->foto)
                                        <img src="{{ asset('storage/' . $testimonial->alumni->foto) }}" class="testimonial-avatar" alt="{{ $testimonial->alumni->nama_alumni }}">
                                    @else
                                        <img src="{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}" class="testimonial-avatar" alt="No Image">
                                    @endif
                                    <div>
                                        <h3 class="testimonial-name">{{ $testimonial->alumni->nama_alumni }}</h3>
                                        <p class="testimonial-univ">{{ $testimonial->alumni->nama_universitas }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>

<!-- Alumni Directory Section -->
<section id="portfolio" class="py-5 bg-light">
    <div class="container">
        <div class="section-title-custom text-center mb-4" data-aos="fade-up">
            <span class="badge-title">Direktori Alumni</span>
            <h2>Sebaran Alumni Studi Lanjut IMBOS</h2>
            <p>Gunakan filter di bawah untuk mencari sebaran alumni berdasarkan tahun lulusan dan jenis perguruan tinggi.</p>
        </div>

        <!-- Filter Form -->
        <div class="filter-glass-bar" data-aos="fade-up" data-aos-delay="100">
            <form action="{{ route('track.alumni.index') }}" method="GET">
                <div class="row align-items-center gy-3">
                    <div class="col-md-9 col-lg-10">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-calendar-event"></i></span>
                            <select name="tahun_lulusan" class="form-select border-start-0 ps-0 fw-semibold">
                                <option value="">Semua Tahun Lulusan</option>
                                @foreach ($tahunLulusanOptions as $tahun)
                                    <option value="{{ $tahun }}" {{ request('tahun_lulusan') == $tahun ? 'selected' : '' }}>
                                        Tahun Lulusan {{ $tahun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-2">
                        <button type="submit" class="btn btn-primary rounded-pill w-100 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-funnel-fill"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Isotope Categories Filter -->
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="150">
                <li data-filter="*" class="filter-active">Semua Jenis PT</li>
                @foreach ($jenisPt as $jenis)
                    <li data-filter=".filter-{{ Str::slug($jenis->nama_jenis_pt) }}">{{ $jenis->nama_jenis_pt }}</li>
                @endforeach
            </ul>

            <!-- Alumni Grid Items -->
            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                @foreach ($alumnis as $alumni)
                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ Str::slug($alumni->jenisPt->nama_jenis_pt) }}">
                        <div class="alumni-glass-card">
                            <div class="alumni-img-wrapper">
                                @if ($alumni->foto)
                                    <img src="{{ asset('storage/' . $alumni->foto) }}" alt="{{ $alumni->nama_alumni }}">
                                @else
                                    <img src="{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}" alt="No Image">
                                @endif
                                <span class="alumni-overlay-badge">{{ $alumni->jenisPt->nama_jenis_pt }}</span>
                            </div>

                            <div class="alumni-info-box">
                                <div>
                                    <h4 class="alumni-title-name">{{ $alumni->nama_alumni }}</h4>
                                    <div class="badge bg-secondary-subtle text-dark fw-bold mb-2">Lulusan {{ $alumni->tahun_lulusan }}</div>
                                    <p class="alumni-univ-name">
                                        <i class="bi bi-building me-1"></i> {{ $alumni->nama_universitas }}
                                    </p>
                                </div>

                                <div class="alumni-actions">
                                    @if ($alumni->foto)
                                        <a href="{{ asset('storage/' . $alumni->foto) }}"
                                            title="{{ $alumni->nama_alumni }} - {{ $alumni->nama_universitas }}"
                                            data-gallery="portfolio-gallery-{{ Str::slug($alumni->jenisPt->nama_jenis_pt) }}"
                                            class="glightbox btn-alumni-action"
                                            title="Zoom Foto">
                                            <i class="bi bi-zoom-in"></i>
                                        </a>
                                    @else
                                        <a href="{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}"
                                            title="{{ $alumni->nama_alumni }} - {{ $alumni->nama_universitas }}"
                                            data-gallery="portfolio-gallery-{{ Str::slug($alumni->jenisPt->nama_jenis_pt) }}"
                                            class="glightbox btn-alumni-action"
                                            title="Zoom Foto">
                                            <i class="bi bi-zoom-in"></i>
                                        </a>
                                    @endif

                                    <a href="{{ route('alumni.detail', $alumni->id) }}" class="btn-alumni-detail">
                                        <span>Detail Profil</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Custom Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $alumnis->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div>

    </div>
</section>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('alumniChart').getContext('2d');

        var gradientColors = [
            'rgba(37, 71, 125, 0.85)',
            'rgba(13, 148, 136, 0.85)',
            'rgba(217, 119, 6, 0.85)',
            'rgba(79, 70, 229, 0.85)',
            'rgba(236, 72, 153, 0.85)',
            'rgba(16, 185, 129, 0.85)'
        ];

        var borderColors = [
            '#1e3a8a',
            '#0f766e',
            '#b45309',
            '#3730a3',
            '#be185d',
            '#047857'
        ];

        var chartData = {!! json_encode($chartData) !!};

        var backgroundColorArray = [];
        var borderColorArray = [];

        chartData.forEach((data, index) => {
            backgroundColorArray.push(gradientColors[index % gradientColors.length]);
            borderColorArray.push(borderColors[index % borderColors.length]);
        });

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.map(data => data.label),
                datasets: [{
                    label: 'Jumlah Alumni',
                    data: chartData.map(data => data.count),
                    backgroundColor: backgroundColorArray,
                    borderColor: borderColorArray,
                    borderWidth: 1.5,
                    borderRadius: 10,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 12,
                        cornerRadius: 10,
                        titleFont: { weight: 'bold' }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { color: '#f1f5f9' }
                    }
                }
            }
        });
    });
</script>

@endsection
