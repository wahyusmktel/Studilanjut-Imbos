@extends('layouts.app')

@section('title', 'Track Alumni')

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
                        <h2>Alumni Studi Lanjut IMBOS</h2>
                        <p>
                            Tersebar diberbagai perguruan tinggi yang ada di Indonesia, seperti di Perguruan Tinggi Negeri
                            (PTN), Perguruan Tinggi Kedinasan (PTK), Perguruan Tinggi Keagamaan Islam Negeri (PTKIN), dan
                            Perguruan Tinggi Swasta (PTS). Berikut ini adalah sebaran alumni Bimbel Lanjut IMBOS.
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
                    <!-- Chart -->
                    <div class="col-xl-12 col-md-12 col-xs-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Grafik Persebaran Alumni</h3>

                                {{-- <div class="dropdown">
                        <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>

                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-sync"></i>Update Data</a></li>
                            <li><a href="#"><i class="fa fa-cogs"></i>Settings</a></li>
                            <li><a href="#"><i class="fa fa-times"></i>Remove Panel</a></li>
                        </ul>
                    </div> --}}
                            </div>

                            <div class="panel-chart">
                                {{-- <!-- Morris Area Chart 01 Start -->
                    <div id="morrisAreaChart01" class="chart--body area--chart style--1"></div>
                    <!-- Morris Area Chart 01 End -->

                    <div class="chart--stats style--1">
                        <ul class="nav">
                            <li data-overlay="1 orange">
                                <p class="amount">PTN</p>
                            </li>
                            <li data-overlay="1 red">
                                <p class="amount">PTK</p>
                            </li>
                            <li data-overlay="1 blue">
                                <p class="amount">PTKIN</p>
                            </li>
                            <li data-overlay="1 green">
                                <p class="amount">PTS</p>
                            </li>
                        </ul>
                    </div> --}}
                                <canvas id="alumniChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- End -->
                </div>

            </div>
        </div>

    </section><!-- /About Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

        <!-- Section Title -->
        <div class="container section-title-white" data-aos="fade-up">
            <h2>Testimonials</h2>
            <p>Apa Kata Alumni ?<br></p>
            <small>IMBOS selalu berupaya mempersiapkan para santrinya untuk bersaing dan berkompetisi dengan sekolah lain
                untuk masuk ke Perguruan Tinggi secara optimal !!!</small>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
        {
        "loop": true,
        "speed": 600,
        "autoplay": {
            "delay": 5000
        },
        "slidesPerView": "auto",
        "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
        },
        "breakpoints": {
            "320": {
            "slidesPerView": 1,
            "spaceBetween": 40
            },
            "1200": {
            "slidesPerView": 3,
            "spaceBetween": 1
            }
        }
        }
    </script>

                <div class="swiper-wrapper">
                    @foreach ($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    @for ($i = 1; $i <= $testimonial->rating; $i++)
                                        <i class="bi bi-star-fill"></i>
                                    @endfor
                                    @for ($i = $testimonial->rating + 1; $i <= 5; $i++)
                                        <i class="bi bi-star"></i>
                                    @endfor
                                </div>
                                <p>{{ $testimonial->isi_testimonial }}</p>
                                <div class="profile mt-auto">
                                    @if ($testimonial->alumni->foto)
                                        <img src="{{ asset('storage/' . $testimonial->alumni->foto) }}"
                                            class="testimonial-img" alt="">
                                    @else
                                        <img src="{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}"
                                            class="testimonial-img" alt="No Image">
                                    @endif
                                    <h3>{{ $testimonial->alumni->nama_alumni }}</h3>
                                    <h4>{{ $testimonial->alumni->nama_universitas }}</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Testimonials Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Alumni</h2>
            <p>Sebaran Alumni Studi Lanjut IMBOS</p>
        </div><!-- End Section Title -->

        <!-- Filter Form -->
        <div class="container d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <form action="{{ route('track.alumni.index') }}" method="GET" class="d-flex justify-content-center">
                <div class="row mb-4">
                    <div class="col-md-10">
                        <select name="tahun_lulusan" class="form-control w-100">
                            <option value="">Pilih Tahun Lulusan</option>
                            @foreach ($tahunLulusanOptions as $tahun)
                                <option value="{{ $tahun }}"
                                    {{ request('tahun_lulusan') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Filter Form -->

        <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">Semua</li>
                    @foreach ($jenisPt as $jenis)
                        <li data-filter=".filter-{{ Str::slug($jenis->nama_jenis_pt) }}">{{ $jenis->nama_jenis_pt }}</li>
                    @endforeach
                </ul><!-- End Portfolio Filters -->

                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($alumnis as $alumni)
                        <div
                            class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ Str::slug($alumni->jenisPt->nama_jenis_pt) }}">
                            <div class="portfolio-content h-100">
                                {{-- <img src="{{ asset('storage/' . $alumni->foto) }}" class="img-fluid" alt=""> --}}
                                @if ($alumni->foto)
                                    <img src="{{ asset('storage/' . $alumni->foto) }}" class="img-fluid" alt="Foto Alumni">
                                @else
                                    <img src="{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}"
                                        class="img-fluid" alt="No Image">
                                @endif
                                <div class="portfolio-info">
                                    <h4>{{ $alumni->nama_alumni }} - Alumni {{ $alumni->tahun_lulusan }}</h4>
                                    <p>{{ $alumni->nama_universitas }}</p>
                                    @if ($alumni->foto)
                                        <a href="{{ asset('storage/' . $alumni->foto) }}"
                                            title="{{ $alumni->nama_alumni }}"
                                            data-gallery="portfolio-gallery-{{ Str::slug($alumni->jenisPt->nama_jenis_pt) }}"
                                            class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    @else
                                        <a href="{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}"
                                            title="{{ $alumni->nama_alumni }}"
                                            data-gallery="portfolio-gallery-{{ Str::slug($alumni->jenisPt->nama_jenis_pt) }}"
                                            class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    @endif
                                    {{-- <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a> --}}
                                    <a href="{{ route('alumni.detail', $alumni->id) }}" title="More Details"
                                        class="details-link"><i class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->
                    @endforeach
                </div><!-- End Portfolio Container -->
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Pagination -->
                        <nav class="pagination-wrap d-flex justify-content-center" aria-label="Page navigation example">
                            {{ $alumnis->appends(request()->query())->links('vendor.pagination.custom') }}
                        </nav>
                    </div>
                </div>

            </div>

        </div>

        <!-- Script for Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ctx = document.getElementById('alumniChart').getContext('2d');

                // Define the colors for each type of perguruan tinggi
                var backgroundColors = [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ];

                var borderColors = [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ];

                var chartData = {!! json_encode($chartData) !!};

                var backgroundColorArray = [];
                var borderColorArray = [];

                chartData.forEach((data, index) => {
                    backgroundColorArray.push(backgroundColors[index % backgroundColors.length]);
                    borderColorArray.push(borderColors[index % borderColors.length]);
                });

                var alumniChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: chartData.map(data => data.label),
                        datasets: [{
                            label: 'Jumlah Alumni',
                            data: chartData.map(data => data.count),
                            backgroundColor: backgroundColorArray,
                            borderColor: borderColorArray,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>

    </section><!-- /Portfolio Section -->

@endsection
