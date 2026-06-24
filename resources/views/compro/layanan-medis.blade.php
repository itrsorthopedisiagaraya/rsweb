@extends('compro.layouts.app')
@section('content')
<div class="page-banner overlay-dark bg-image" style="background-image: url({{ asset('') }}assets/images/banner/hospital.jpg);">
    <div class="banner-section">
        <div class="container text-center wow fadeInUp" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
            <h1 style="font-weight: 600;">{{ $data->judul }}</h1><br>
            <h4>Tanggap, Terpercaya, dan Teliti: Layanan Medis Unggulan dari Rumah Sakit Orthopedi kami</h4>
        </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section bg-light wow fadeInUp">
        {{-- @dd($data) --}}
        <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6">
                <img src="{{ asset('') }}files/gambar_layanan_medis/{{ $data->image }}" alt="gambar_promo" style="width: 100%">
                </div>
                <div class="col-sm-6">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                    <h5 class="card-title"><strong class="text-primary">Rumah Sakit Orthopedi</strong></h5>
                    </div>
                    <div class="card-body" style="color: #777">
                    <p class="card-text">Kami hadir dengan teknologi terkini dan tenaga medis berpengalaman. Rasakan perbedaannya di Rumah Sakit Kami!</p>
                    <small class="text-muted">Kesehatan Anda adalah prioritas kami.</small>
                    </div>
                </div>

                <a class="btn btn-light mt-5 info-promo-btn" target="_blank" href="https://api.whatsapp.com/send?phone=+628118996581">
                    <i class="fab fa-whatsapp"></i>
                    Info Selanjutnya <img src="{{ asset('') }}assets/images/gif/gif-right.gif" width="20" alt="">
                </a>
                </div>
            </div>
            <h3 style="font-weight: 600" class="text-primary mt-5 mb-3">{{ $data->judul }}</h3>
            <style>
                #content * {
                width: 100%;
                text-align: left;
                }
            </style>
            <div class="content" id="content" style="color: #777;">
                {!! $data->konten !!}
            </div>
            </div>
            {{-- {!! $data->konten !!} --}}
        </div>
        </div>

        <div class="page-section promo-home-wrapper" style="padding: 20px 100px 20px 100px; margin-top: 50px;">
        <div class="d-flex justify-content-center align-items-center flex-column">
            <span class="text-center text-primary"><strong>Layanan Medis Lainnya</strong></span>
            <h3 class="text-center mb-5 wow fadeInUp">Layanan Medis di Orthopedi!</h3>
            <div class="owl-carousel wow fadeInUp" id="promoSlideshow">
    
                @foreach ($all_layanan as $item)
                <div class="item">
                    <a href="{{ route('layananMedis', $item->slug) }}" style="text-decoration: none;">
                    <div class="card-promo">
                    <div class="header">
                        <img src="{{ asset('') }}files/gambar_layanan_medis/{{ $item->image }}" alt="">
                    </div>
                    <div class="card-body" style="text-decoration: none;">
                        <h6 class="mb-3 d-flex">
                        🌟 {{ $item->judul }}
                        </h6>
                        <div class="konten-promo" style="color: #777">
                        {!! $item->konten !!}
                        </div>
                    </div>
                    </div>
                    </a>
                </div>
                @endforeach

            </div>
        </div>
        </div>
    </div>
@endsection