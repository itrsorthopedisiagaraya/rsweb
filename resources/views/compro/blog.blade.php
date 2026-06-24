@extends('compro.layouts.app')
@section('content')
    <div class="page-banner overlay-dark bg-image"
        style="background-image: url({{ asset('') }}assets-compro/assets/img/banner/banner-1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a class=" text-success" href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Berita</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Berita</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">

                        @foreach ($data as $key => $item)
                            <div class="col-sm-6 py-3">
                                <div class="card-blog">
                                    <div class="header">
                                        <div class="post-category">
                                            <a href="#">{{ $item->kategori->kategori }}</a>
                                        </div>
                                        <a href="{{ url('blog/details', ['slug' => $item->slug]) }}" class="post-thumb">
                                            <img src="{{ asset('storage/files/gambar_postingan/banner/' . $item->gambar) }}"
                                                alt="gambar-berita">
                                        </a>
                                    </div>
                                    <div class="body">
                                        <h5 class="post-title"><a
                                                href="{{ url('blog/details', ['slug' => $item->slug]) }}">{{ $item->judul }}</a>
                                        </h5>
                                        <div class="site-info">
                                            <span class="mai-time"></span> {{ $item->created_at }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div> <!-- .row -->
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-block">
                            <h3 class="sidebar-title">Cari</h3>
                            <form action="#" class="search-form">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Masukan kata pencarian..">
                                    <button type="submit" class="btn"><span class="icon mai-search"></span></button>
                                </div>
                            </form>
                        </div>
                        <div class="sidebar-block">
                            <h3 class="sidebar-title">Kategori</h3>
                            <ul class="categories">
                                @foreach ($kategori as $ktgr)
                                    <li><a href="#">{{ $ktgr->kategori }} <span>{{ $ktgr->jml }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="sidebar-block">
                            <h3 class="sidebar-title">Berita Terbaru</h3>

                            @foreach ($recent as $rc)
                                <div class="blog-item">
                                    <a class="post-thumb" href="">
                                        <img src="{{ asset('storage/files/gambar_postingan/banner/' . $rc->gambar) }}"
                                            alt="">
                                    </a>
                                    <div class="content">
                                        <h5 class="post-title"><a href="#">{{ $rc->judul }}</a></h5>
                                        <div class="meta">
                                            <a href="#"><span class="mai-calendar"></span> July 12, 2024</a>
                                            <a href="#"><span class="mai-person"></span> Admin</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .page-section -->
@endsection
