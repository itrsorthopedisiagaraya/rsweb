@extends('compro.layouts.app')
@section('content')
<div class="page-banner overlay-dark bg-image" style="background-image: url({{ asset('') }}assets/images/banner/hospital.jpg);">
    <div class="banner-section">
    <div class="container text-center wow fadeInUp" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
        <h3 style="font-weight: 600;">{{ $layanan->layanan }}</h3><br>
        <p>
            Kami bangga menyajikan pelayanan medis berkualitas tinggi yang didukung oleh tenaga medis terampil dan teknologi canggih.
        </p>
    </div> <!-- .container -->
    </div> <!-- .banner-section -->
</div> <!-- .page-banner -->

<style>
    .content * {
        width: 100%;
        text-align: justify;
        color: #777;
    }
</style>

<div class="page-section bg-light wow fadeInUp">
    {{-- @dd($data) --}}
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-6">
                <img src="{{ asset('') }}files/gambar_layanan/{{ $layanan->gambar }}" alt="gambar_promo" style="width: 100%">
                <div class="content mt-3">
                    <h3>{{ $layanan->layanan }}</h3>
                    <span class="text-content">
                        {!! $layanan->konten !!}
                    </span>
                </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h5 class="card-title"><strong class="text-primary">Rumah Sakit Orthopedi</strong></h5>
                </div>
                <div class="card-body" style="color: #777">
                    <strong>Fasilitas Modern dan Inovatif:</strong> 
                    <p>Kami memiliki fasilitas medis terkini dan teknologi inovatif untuk memastikan pengalaman perawatan yang optimal dan hasil terbaik bagi pasien kami.</p>
                    <strong>Tim Medis Profesional:</strong> 
                    <p>Dibantu oleh tim medis profesional yang berdedikasi, kami menawarkan penanganan yang efektif dan solusi terbaik untuk setiap kondisi medis</p>
                </div>
              </div>
              <a class="btn btn-light mt-5 info-promo-btn" target="_blank" href="https://wa.me/0895612206018">
                <i class="fab fa-whatsapp"></i>
                Info Selanjutnya <img src="{{ asset('') }}assets/images/gif/gif-right.gif" width="20" alt="">
              </a>      
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection