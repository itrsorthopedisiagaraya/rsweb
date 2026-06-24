@extends('compro.layouts.app')
@section('content')
    <div class="page-banner overlay-dark bg-image" style="background-image: url({{ asset('') }}assets/images/banner/hospital.jpg);">
        <div class="banner-section">
        <div class="container text-center wow fadeInUp" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
            <h3 style="font-weight: 600;">{{ $data->judul }}</h3><br>
            <p>
                Pilihan terbaik dengan layanan dokter spesialis dan tes medis yang lengkap. Sangat cocok bagi Anda yang memiliki riwayat penyakit keluarga atau ingin memastikan kondisi kesehatan Anda dalam kondisi prima.
            </p>
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
                  <img src="{{ asset('') }}files/gambar_promo/{{ $data->gambar }}" alt="gambar_promo" style="width: 100%">
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
            
                  <!-- Card 2 -->
                  <div class="card mt-3">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-4">
                          <img src="{{ asset('') }}assets/images/promo/promo-icon.png" alt="icon-promo" style="width: 150px;">
                        </div>
                        <div class="col-sm-8">
                          <p class="card-text" style="color: #777">Nikmati diskon khusus untuk layanan kesehatan keluarga di Rumah Sakit Kami. Jadikan keluarga Anda yang sehat, bahagia, dan kuat!</p>
                        </div>
                      </div>

                    </div>
                    <div class="card-footer">
                      <small class="text-muted">Berlaku hingga: {{ $data->deadline }}</small>
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
                  text-align: justify;
                }
              </style>
              <div class="content" id="content" style="color: #777;">
                  {!! $data->konten !!}
                  <small>Berlaku Hingga {{ $data->deadline }}</small>
              </div>
            </div>
            {{-- {!! $data->konten !!} --}}
          </div>
        </div>

        <div class="page-section promo-home-wrapper" style="padding: 20px 100px 20px 100px; margin-top: 50px;">
          <div class="d-flex justify-content-center align-items-center flex-column">
            <span class="text-center text-primary"><strong>Promo Lainnya</strong></span>
            <h3 class="text-center mb-5 wow fadeInUp">🌟 Promo Kesehatan di Orthopedi! 🌟</h3>
            <div class="owl-carousel wow fadeInUp" id="promoSlideshow">
      
              @foreach ($all_promo as $item)
              <div class="item">
                <a href="{{ route('promotion', ['slug' => $item->slug]) }}" style="text-decoration: none;">
                <div class="card-promo">
                  <div class="header">
                    <img src="{{ asset('') }}files/gambar_promo/{{ $item->gambar }}" alt="">
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