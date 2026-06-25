@extends('compro.layouts.app')
@section('content')
    <div class="page-banner overlay-dark bg-image"
        style="background-image: url({{ asset('') }}assets-compro/assets/img/banner/banner-1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">{{ $data->judul ?? 'Default Title' }}</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section bg-light">
        <div class="container">
            <div class="row px-4 p-md-0">
                <article class="aboutus-details">
                    @if (!empty($data->gambar))
                        <div class="post-thumb">
                            <img src="{{ asset('storage/files/gambar_aboutus/banner/' . $data->gambar) }}" alt="">
                        </div>
                    @endif
                    <div class="post-content">
                        {!! $data->konten ?? 'Default content' !!}
                    </div>
                </article> <!-- .blog-details -->
            </div>
        </div>
    </div>
@endsection
