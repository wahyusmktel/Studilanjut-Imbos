@extends('layouts.app')

@section('title', 'Detail Berita')

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

    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>{{ $berita->judul_berita }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li class="current">{{ $berita->judul_berita }}</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Blog Details Section -->
                <div id="blog-details" class="blog-details section">
                    <div class="container">

                        <article class="article">

                            <div class="post-img">
                                <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul_berita }}"
                                    class="img-fluid">
                            </div>

                            <h2 class="title">{{ $berita->judul_berita }}</h2>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                            href="#">{{ $berita->author->name }}</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                            href="#"><time
                                                datetime="{{ $berita->created_at }}">{{ $berita->created_at->format('M d, Y') }}</time></a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                            href="#">{{ $berita->komentars->count() }} Comments</a></li>
                                </ul>
                            </div><!-- End meta top -->

                            <div class="content">
                                <p>{!! $berita->isi_berita !!}</p>
                                <!-- You can add more sections of the content here as needed -->
                            </div><!-- End post content -->

                            <div class="meta-bottom">
                                <i class="bi bi-folder"></i>
                                <ul class="cats">
                                    <li><a href="#">{{ $berita->kategori->nama_kategori }}</a></li>
                                </ul>

                                {{-- <i class="bi bi-tags"></i>
                        <ul class="tags">
                            <li><a href="#">Creative</a></li>
                            <li><a href="#">Tips</a></li>
                            <li><a href="#">Marketing</a></li>
                        </ul> --}}
                            </div><!-- End meta bottom -->

                        </article>

                    </div>
                </div><!-- /Blog Details Section -->

                <!-- Blog Author Section -->
                <section id="blog-author" class="blog-author section">
                    <div class="container">
                        <div class="author-container d-flex align-items-center">
                            <img src="{{ asset('storage/' . $berita->author->foto) }}"
                                class="rounded-circle flex-shrink-0" alt="">
                            <div>
                                <h4>{{ $berita->author->name }}</h4>
                                <p>{{ $berita->author->email }}</p>
                            </div>
                        </div>
                    </div>
                </section><!-- /Blog Author Section -->

                <!-- Blog Comments Section -->
                <section id="blog-comments" class="blog-comments section">

                    <div class="container">

                        <h4 class="comments-count">{{ $berita->komentars->count() }} Comments</h4>

                        @foreach ($berita->komentars as $komentar)
                            <div id="comment" class="comment"><!-- Start comment -->
                                <div class="d-flex">
                                    <div class="comment-img"><img
                                            src="{{ asset('halaman_umum/assets/img/blog/comments-2.jpg') }}"
                                            alt=""></div>
                                    <div>
                                        <h5><a href="">{{ $komentar->nama_komentator }}</a></h5>
                                        <time
                                            datetime="{{ $komentar->created_at }}">{{ $komentar->created_at->format('d M, Y') }}</time>
                                        <p>{{ $komentar->isi_komentar }}</p>
                                    </div>
                                </div>

                                @foreach ($komentar->tanggapan as $tanggapan)
                                    <div id="comment-reply-{{ $tanggapan->id }}" class="comment comment-reply">
                                        <!-- Start comment reply -->
                                        <div class="d-flex">
                                            <div class="comment-img"><img
                                                    src="{{ asset('storage/' . $tanggapan->author->foto) }}"
                                                    alt=""></div>
                                            <div>
                                                <h5><a href="">{{ $tanggapan->author->name }}</a></h5>
                                                <time
                                                    datetime="{{ $tanggapan->created_at }}">{{ $tanggapan->created_at->format('d M, Y') }}</time>
                                                <p>{{ $tanggapan->isi_tanggapan }}</p>
                                            </div>
                                        </div>
                                    </div><!-- End comment reply -->
                                @endforeach
                            </div><!-- End comment -->
                        @endforeach

                    </div>

                </section><!-- /Blog Comments Section -->

                <!-- Comment Form Section -->
                <section id="comment-form" class="comment-form section">
                    <div class="container">
                        <form action="{{ route('komentar.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="berita_id" value="{{ $berita->id }}">
                            <h4>Berikan Komentar</h4>
                            <p>Silahkan isikan form dibawah ini untuk membuat komentar *</p>

                            <div class="row">
                                <div class="col form-group">
                                    <input name="nama_komentator" type="text" class="form-control"
                                        placeholder="Nama Anda" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <textarea name="isi_komentar" class="form-control" placeholder="Tulis komentar anda" required></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Post Komentar</button>
                            </div>
                        </form>
                    </div>
                </section><!-- /Comment Form Section -->

            </div>

            <div class="col-lg-4 sidebar">

                <div class="widgets-container">

                    <!-- Search Widget -->
                    <div class="search-widget widget-item">
                        <h3 class="widget-title">Search</h3>
                        <form action="{{ route('berita.search') }}" method="GET">
                            <input type="text" name="query" placeholder="Search...">
                            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                        </form>
                    </div><!--/Search Widget -->

                    <!-- Categories Widget -->
                    <div class="categories-widget widget-item">
                        <h3 class="widget-title">Categories</h3>
                        <ul class="mt-3">
                            @foreach ($categories as $category)
                                <li><a href="{{ route('berita.category', $category->id) }}">{{ $category->nama_kategori }}
                                        <span>({{ $category->beritas_count }})</span></a></li>
                            @endforeach
                        </ul>
                    </div><!--/Categories Widget -->

                    <!-- Recent Posts Widget -->
                    <div class="recent-posts-widget widget-item">
                        <h3 class="widget-title">Recent Posts</h3>

                        @foreach ($recentPosts as $post)
                            <div class="post-item">
                                <img src="{{ asset('storage/' . $post->foto) }}" alt="" class="flex-shrink-0">
                                <div>
                                    <h4><a href="{{ route('berita.detail', $post->id) }}">{{ $post->judul_berita }}</a>
                                    </h4>
                                    <time
                                        datetime="{{ $post->created_at->format('Y-m-d') }}">{{ $post->created_at->format('M d, Y') }}</time>
                                </div>
                            </div><!-- End recent post item-->
                        @endforeach

                    </div><!--/Recent Posts Widget -->

                    <!-- Tags Widget -->
                    {{-- <div class="tags-widget widget-item">

                        <h3 class="widget-title">Tags</h3>
                        <ul>
                            <li><a href="#">App</a></li>
                            <li><a href="#">IT</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Mac</a></li>
                            <li><a href="#">Design</a></li>
                            <li><a href="#">Office</a></li>
                            <li><a href="#">Creative</a></li>
                            <li><a href="#">Studio</a></li>
                            <li><a href="#">Smart</a></li>
                            <li><a href="#">Tips</a></li>
                            <li><a href="#">Marketing</a></li>
                        </ul>

                    </div><!--/Tags Widget --> --}}

                </div>

            </div>

        </div>
    </div>
@endsection
