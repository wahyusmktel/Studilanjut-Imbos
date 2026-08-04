@extends('layouts.app')

@section('title', $berita->judul_berita . ' - Portal Berita SMAIT IMBOS')

@section('content')

<style>
    /* Modern Academic Article Detail Styling */
    .article-hero-section {
        position: relative;
        padding: 120px 0 65px 0;
        background: linear-gradient(135deg, #0b192c 0%, #1e3a8a 50%, #0f2b5c 100%);
        color: #ffffff;
        overflow: hidden;
    }

    .article-hero-section .hero-waves {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 55px;
        z-index: 5;
    }

    .article-category-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(96, 165, 250, 0.15);
        color: #60a5fa;
        border: 1px solid rgba(96, 165, 250, 0.3);
        font-weight: 700;
        font-size: 0.85rem;
        padding: 6px 18px;
        border-radius: 50px;
        margin-bottom: 16px;
    }

    .article-hero-title {
        font-size: 2.3rem;
        font-weight: 800;
        line-height: 1.3;
        color: #ffffff;
        letter-spacing: -0.5px;
        margin-bottom: 20px;
    }

    .article-meta-bar {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
        color: #cbd5e1;
        font-size: 0.88rem;
        font-weight: 500;
    }

    .article-meta-bar item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .article-meta-bar i {
        color: #60a5fa;
    }

    /* Article Card Main */
    .article-main-card {
        background: #ffffff;
        border-radius: 28px;
        padding: 40px;
        box-shadow: 0 15px 40px rgba(15, 23, 42, 0.05);
        border: 1px solid #e2e8f0;
        margin-bottom: 35px;
    }

    .article-featured-img {
        width: 100%;
        max-height: 440px;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        margin-bottom: 32px;
    }

    .article-body-content {
        font-size: 1.08rem;
        line-height: 1.85;
        color: #334155;
        font-weight: 400;
    }

    .article-body-content p {
        margin-bottom: 1.5rem;
    }

    .article-body-content blockquote {
        border-left: 4px solid #2563eb;
        background: #f8fafc;
        padding: 20px 24px;
        border-radius: 0 16px 16px 0;
        font-style: italic;
        color: #1e293b;
        margin: 24px 0;
    }

    /* Social Share Bar */
    .article-share-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 24px;
        margin-top: 35px;
        border-top: 1px solid #f1f5f9;
        flex-wrap: wrap;
        gap: 15px;
    }

    .share-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .share-btn-wa { background: #dcfce7; color: #15803d; }
    .share-btn-wa:hover { background: #15803d; color: #ffffff; }

    .share-btn-fb { background: #dbeafe; color: #1d4ed8; }
    .share-btn-fb:hover { background: #1d4ed8; color: #ffffff; }

    .share-btn-tw { background: #f1f5f9; color: #334155; }
    .share-btn-tw:hover { background: #0f172a; color: #ffffff; }

    /* Academic Author Card */
    .author-card-academic {
        background: linear-gradient(135deg, #f8fafc 0%, #edf2f7 100%);
        border-radius: 20px;
        padding: 24px 28px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 35px;
    }

    .author-avatar-img {
        width: 75px;
        height: 75px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ffffff;
        box-shadow: 0 6px 15px rgba(0,0,0,0.08);
    }

    /* Comment Section Styling */
    .comment-card-main {
        background: #ffffff;
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 15px 40px rgba(15, 23, 42, 0.05);
        border: 1px solid #e2e8f0;
        margin-bottom: 35px;
    }

    .comment-item-single {
        padding: 20px;
        border-radius: 16px;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        margin-bottom: 20px;
    }

    .comment-reply-item {
        margin-left: 40px;
        background: #ffffff;
        border-left: 3px solid #2563eb;
        margin-top: 14px;
    }

    /* Sidebar Academic Widgets */
    .academic-widget {
        background: #ffffff;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.05);
        border: 1px solid #e2e8f0;
        margin-bottom: 30px;
    }

    .widget-academic-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .widget-academic-title i {
        color: #2563eb;
    }

    .recent-post-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
        transition: transform 0.2s ease;
    }

    .recent-post-card:last-child {
        border-bottom: none;
    }

    .recent-post-card:hover {
        transform: translateX(4px);
    }

    .recent-post-thumb {
        width: 75px;
        height: 75px;
        border-radius: 14px;
        object-fit: cover;
        flex-shrink: 0;
    }

    @media (max-width: 991px) {
        .article-hero-section {
            padding: 95px 0 45px 0;
        }
        .article-hero-title {
            font-size: 1.75rem;
        }
        .article-main-card {
            padding: 24px 20px;
        }
        .comment-reply-item {
            margin-left: 15px;
        }
    }
</style>

<!-- Article Hero Header Section -->
<section id="hero" class="article-hero-section text-center">
    @include('includes.menu_mobile_app')

    <div class="container position-relative" style="z-index: 10;">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-down">
                <span class="article-category-badge">
                    <i class="bi bi-bookmark-star-fill"></i> {{ $berita->kategori->nama_kategori }}
                </span>

                <h1 class="article-hero-title">{{ $berita->judul_berita }}</h1>

                <div class="article-meta-bar">
                    <span class="d-flex align-items-center gap-1">
                        <i class="bi bi-person-circle"></i> {{ $berita->author->name }}
                    </span>
                    <span>•</span>
                    <span class="d-flex align-items-center gap-1">
                        <i class="bi bi-calendar3"></i> {{ $berita->created_at->format('d M Y') }}
                    </span>
                    <span>•</span>
                    <span class="d-flex align-items-center gap-1">
                        <i class="bi bi-chat-text-fill"></i> {{ $berita->komentars->count() }} Komentar
                    </span>
                    <span>•</span>
                    <span class="d-flex align-items-center gap-1">
                        <i class="bi bi-building"></i> SMAIT IMBOS Pringsewu
                    </span>
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
            <use xlink:href="#wave-path" x="50" y="9" fill="#f8fafc"></use>
        </g>
    </svg>
</section>

<!-- Main Article & Sidebar Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row gy-4">

            <!-- Main Content Column -->
            <div class="col-lg-8">
                
                <!-- Main Article Card -->
                <div class="article-main-card" data-aos="fade-up">
                    <!-- Featured Image -->
                    @if ($berita->foto)
                        <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul_berita }}" class="article-featured-img" onerror="this.onerror=null;this.src='{{ asset('halaman_umum/assets/img/no-images.png') }}';">
                    @else
                        <img src="{{ asset('halaman_umum/assets/img/no-images.png') }}" alt="{{ $berita->judul_berita }}" class="article-featured-img">
                    @endif

                    <!-- Article Body Content -->
                    <div class="article-body-content">
                        {!! $berita->isi_berita !!}
                    </div>

                    <!-- Share & Category Bar -->
                    <div class="article-share-bar">
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-bold text-dark fs-7 me-2"><i class="bi bi-share-fill me-1"></i> Bagikan Artikel:</span>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul_berita . ' - ' . url()->current()) }}" target="_blank" class="share-btn share-btn-wa">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="share-btn share-btn-fb">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->judul_berita) }}" target="_blank" class="share-btn share-btn-tw">
                                <i class="bi bi-twitter-x"></i> X / Twitter
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Academic Author Card -->
                <div class="author-card-academic" data-aos="fade-up">
                    @if ($berita->author->foto)
                        <img src="{{ asset('storage/' . $berita->author->foto) }}" class="author-avatar-img" alt="{{ $berita->author->name }}" onerror="this.onerror=null;this.src='{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}';">
                    @else
                        <img src="{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}" class="author-avatar-img" alt="{{ $berita->author->name }}">
                    @endif
                    <div>
                        <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-1 rounded-pill mb-1 fs-8">Penulis Resmi</span>
                        <h4 class="fw-bold text-dark mb-1 fs-5">{{ $berita->author->name }}</h4>
                        <p class="text-muted mb-0 small"><i class="bi bi-envelope-at me-1"></i> {{ $berita->author->email }}</p>
                    </div>
                </div>

                <!-- Comments List Section -->
                <div class="comment-card-main" data-aos="fade-up">
                    <h4 class="fw-bold text-dark mb-4 fs-5 d-flex align-items-center gap-2">
                        <i class="bi bi-chat-dots-fill text-primary"></i>
                        <span>Diskusi & Komentar ({{ $berita->komentars->count() }})</span>
                    </h4>

                    @forelse ($berita->komentars as $komentar)
                        <div class="comment-item-single">
                            <div class="d-flex align-items-start gap-3">
                                <img src="{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}" alt="{{ $komentar->nama_komentator }}" class="rounded-circle shadow-sm" style="width: 48px; height: 48px; object-fit: cover;">
                                <div class="w-100">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <h6 class="fw-bold text-dark mb-0">{{ $komentar->nama_komentator }}</h6>
                                        <span class="text-muted small"><i class="bi bi-clock me-1"></i> {{ $komentar->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                    <p class="text-secondary mb-0 small">{{ $komentar->isi_komentar }}</p>
                                </div>
                            </div>

                            <!-- Replies List -->
                            @foreach ($komentar->tanggapan as $tanggapan)
                                <div class="comment-item-single comment-reply-item">
                                    <div class="d-flex align-items-start gap-3">
                                        @if ($tanggapan->author->foto)
                                            <img src="{{ asset('storage/' . $tanggapan->author->foto) }}" alt="{{ $tanggapan->author->name }}" class="rounded-circle shadow-sm" style="width: 40px; height: 40px; object-fit: cover;" onerror="this.onerror=null;this.src='{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}';">
                                        @else
                                            <img src="{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}" alt="{{ $tanggapan->author->name }}" class="rounded-circle shadow-sm" style="width: 40px; height: 40px; object-fit: cover;">
                                        @endif
                                        <div class="w-100">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <h6 class="fw-bold text-dark mb-0 fs-7">
                                                    {{ $tanggapan->author->name }}
                                                    <span class="badge bg-primary text-white rounded-pill ms-1 fs-8">Admin / Pengajar</span>
                                                </h6>
                                                <span class="text-muted small">{{ $tanggapan->created_at->format('d M Y') }}</span>
                                            </div>
                                            <p class="text-secondary mb-0 small">{{ $tanggapan->isi_tanggapan }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-chat-square-text fs-2 d-block mb-2 text-secondary"></i>
                            Belum ada komentar pada artikel ini. Jadilah yang pertama memberikan masukan!
                        </div>
                    @endforelse

                    <!-- Write Comment Form -->
                    <div class="mt-4 pt-4 border-top">
                        <h5 class="fw-bold text-dark mb-3 fs-6">Tuliskan Komentar Anda</h5>
                        <form action="{{ route('komentar.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="berita_id" value="{{ $berita->id }}">

                            <div class="mb-3">
                                <label class="form-label fw-semibold fs-7">Nama Lengkap</label>
                                <input name="nama_komentator" type="text" class="form-control rounded-3 p-2.5" placeholder="Masukkan nama Anda..." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold fs-7">Isi Komentar</label>
                                <textarea name="isi_komentar" class="form-control rounded-3 p-2.5" rows="4" placeholder="Tuliskan masukan atau tanggapan Anda..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">
                                <i class="bi bi-send-fill me-1"></i> Kirim Komentar
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- Academic Sidebar Column -->
            <div class="col-lg-4">

                <!-- Search Widget -->
                <div class="academic-widget" data-aos="fade-up">
                    <h3 class="widget-academic-title">
                        <i class="bi bi-search"></i> Cari Informasi
                    </h3>
                    <form action="{{ route('berita.search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="query" class="form-control rounded-start-pill ps-3" placeholder="Kata kunci berita..." required>
                            <button class="btn btn-primary rounded-end-pill px-3" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Categories Widget -->
                <div class="academic-widget" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="widget-academic-title">
                        <i class="bi bi-folder2-open"></i> Kategori Informasi
                    </h3>
                    <ul class="list-unstyled mb-0">
                        @foreach ($categories as $category)
                            <li class="py-2 border-bottom">
                                <a href="{{ route('berita.category', $category->id) }}" class="text-decoration-none d-flex justify-content-between align-items-center text-secondary fw-semibold">
                                    <span><i class="bi bi-chevron-right me-2 text-primary fs-8"></i> {{ $category->nama_kategori }}</span>
                                    <span class="badge bg-light text-primary border rounded-pill">{{ $category->beritas_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Recent Posts Widget -->
                <div class="academic-widget" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="widget-academic-title">
                        <i class="bi bi-newspaper"></i> Artikel Terbaru
                    </h3>

                    @foreach ($recentPosts as $post)
                        <div class="recent-post-card">
                            @if ($post->foto)
                                <img src="{{ asset('storage/' . $post->foto) }}" alt="{{ $post->judul_berita }}" class="recent-post-thumb shadow-sm" onerror="this.onerror=null;this.src='{{ asset('halaman_umum/assets/img/no-images.png') }}';">
                            @else
                                <img src="{{ asset('halaman_umum/assets/img/no-images.png') }}" alt="{{ $post->judul_berita }}" class="recent-post-thumb shadow-sm">
                            @endif
                            <div>
                                <h6 class="fw-bold mb-1 fs-7">
                                    <a href="{{ route('berita.detail', $post->id) }}" class="text-dark text-decoration-none lh-sm d-block">
                                        {{ Str::limit($post->judul_berita, 50) }}
                                    </a>
                                </h6>
                                <span class="text-muted small fs-8"><i class="bi bi-calendar-event me-1"></i> {{ $post->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Helpdesk Bimbel Banner Widget -->
                <div class="academic-widget bg-primary text-white text-center p-4" style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); border: none;" data-aos="fade-up" data-aos-delay="300">
                    <i class="bi bi-headset fs-1 text-warning d-block mb-2"></i>
                    <h5 class="fw-bold text-white mb-2 fs-6">Konsultasi Studi Lanjut?</h5>
                    <p class="small text-white-50 mb-3">Tim Bimbel SMAIT IMBOS siap membantu merencanakan kelanjutan studi ke PTN & Kedinasan impian Anda.</p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-warning rounded-pill px-4 fw-bold w-100 shadow-sm">
                        <i class="bi bi-whatsapp me-1"></i> Hubungi Konsultan
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
