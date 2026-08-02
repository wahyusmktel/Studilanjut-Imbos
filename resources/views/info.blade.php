@extends('layouts.app')

@section('title', 'Berita')

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
                        @if (isset($query))
                            <h1>Search Results for: "{{ $query }}"</h1>
                        @endif
                        @if (isset($category))
                            <h1>Category: {{ $category->nama_kategori }}</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/">Home</a></li>

                    @if (isset($query))
                        <li><a href="#">Search</a></li>
                        <li class="current">
                            {{ $query }}
                        </li>
                    @endif
                    @if (isset($category))
                        <li><a href="#">Kategori</a></li>
                        <li class="current">
                            {{ $category->nama_kategori }}
                        </li>
                    @endif

                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Blog Posts Section -->
                <section id="blog-posts" class="blog-posts section">
                    <div class="container">

                        <div class="row gy-4">
                            @foreach ($beritas as $berita)
                                <div class="col-12">
                                    <article>
                                        <div class="post-img">
                                            <img src="{{ asset('storage/' . $berita->foto) }}" alt=""
                                                class="img-fluid">
                                        </div>
                                        <h2 class="title">
                                            <a
                                                href="{{ route('berita.detail', $berita->id) }}">{{ $berita->judul_berita }}</a>
                                        </h2>
                                        <div class="meta-top">
                                            <ul>
                                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                        href="{{ route('berita.detail', $berita->id) }}">{{ $berita->author->name }}</a>
                                                </li>
                                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                        href="{{ route('berita.detail', $berita->id) }}"><time
                                                            datetime="{{ $berita->created_at }}">{{ $berita->created_at->format('M d, Y') }}</time></a>
                                                </li>
                                                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                                        href="{{ route('berita.detail', $berita->id) }}">{{ $berita->komentars->count() }}
                                                        Comments</a></li>
                                            </ul>
                                        </div>
                                        <div class="content">
                                            <p>{{ Str::limit(strip_tags($berita->isi_berita), 150, '...') }}</p>
                                            <div class="read-more">
                                                <a href="{{ route('berita.detail', $berita->id) }}">Read More</a>
                                            </div>
                                        </div>
                                    </article>
                                </div><!-- End post list item -->
                            @endforeach
                        </div><!-- End blog posts list -->


                    </div>
                </section><!-- /Blog Posts Section -->

                <!-- Blog Pagination Section -->
                <section id="blog-pagination" class="blog-pagination section">
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            {{ $beritas->links() }}
                        </div>
                    </div>
                </section><!-- /Blog Pagination Section -->

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
