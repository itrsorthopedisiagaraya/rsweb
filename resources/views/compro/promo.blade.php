@extends('compro.layouts.app')
@section('content')
    <div class="page-banner overlay-dark bg-image"
        style="background-image: url({{ asset('') }}assets-compro/assets/img/banner/banner-1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a class=" text-success" href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Promo</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Promo</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 py-3" style="display: flex;">
                    @foreach ($promo as $key => $item)
                        <div class="card-blog">
                            <div class="header">
                                <a href="{{ route('promotion', $item->slug) }}" class="post-thumb">
                                    <img src="{{ asset('') }}files\gambar_promo\{{ $item->gambar }}" alt="gambar-berita"
                                        style="width: 100%;">
                                </a>
                            </div>
                            <div class="body">
                                <h5 class="post-title" style="font-weight: 600"><a
                                        href="{{ route('promotion', $item->slug) }}">{{ $item->judul }}</a></h5>
                                <div class="konten-promo" style="color: #999">
                                    {!! $item->konten !!}
                                </div>
                                <div class="site-info">
                                    <span class="mai-time"></span> Berlaku sampai: {{ $item->deadline }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
