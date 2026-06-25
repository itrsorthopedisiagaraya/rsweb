@php $partner = getPartner() @endphp
@php $aboutus = getAboutus() @endphp

@php
    $chunksDesktop = $partner->chunk(18); // 18 items per slide desktop
    $chunksMobile = $partner->chunk(3); // 4 items per slide mobile
@endphp

@if (!$partner->isEmpty())
    <div class="partner py-5" style="background-color: #fff;">
        <div class="container">

            <div class="row">
                <div class="col-sm-12 text-center">
                    <h4 class="text-primary">Partner & Asuransi</h4>
                    <hr>
                </div>
            </div>

            <!-- DESKTOP: 18 items per slide -->
            <div id="partnerCarouselDesktop" class="carousel slide d-none d-md-block" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($chunksDesktop as $index => $chunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $item)
                                    <div class="col-sm-2 mb-3">
                                        <a href="{{ $item->link_partner }}" class="post-thumb">
                                            <img src="{{ asset('files/logo-partner/' . $item->logo_partner) }}"
                                                alt="logo-partner" style="width: 100%;">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                 @if (count($chunksDesktop) > 1)
                    <a class="carousel-control-prev" href="#partnerCarouselDesktop" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#partnerCarouselDesktop" role="button" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                @endif

                <ol class="carousel-indicators">
                    @foreach ($chunksDesktop as $index => $chunk)
                        <li data-target="#partnerCarouselDesktop" data-slide-to="{{ $index }}"
                            class="{{ $index == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>

            </div>

            <!-- MOBILE: 4 items per slide -->
            <div id="partnerCarouselMobile" class="carousel slide d-block d-md-none" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($chunksMobile as $index => $chunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $item)
                                    <div class="col-4 mb-2">
                                        <a href="{{ $item->link_partner }}" class="post-thumb">
                                            <img src="{{ asset('files/logo-partner/' . $item->logo_partner) }}"
                                                alt="logo-partner" style="width: 100%;">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- @if (count($chunksMobile) > 1)
                    <a class="carousel-control-prev" href="#partnerCarouselMobile" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#partnerCarouselMobile" role="button" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                @endif --}}

                <ol class="carousel-indicators d-md-none">
                    @foreach ($chunksMobile as $index => $chunk)
                        <li data-target="#partnerCarouselMobile" data-slide-to="{{ $index }}"
                            class="{{ $index == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>

            </div>

        </div>
    </div>
@endif
<footer class="page-footer">
  <div class="container">
      <div class="row px-md-3">
        <div class="col-sm-6 col-lg-3 py-3 d-flex flex-column align-items-center">
          <ul class="footer-menu">
            <div class="logo-wrapper">
              <img src="{{ asset('assets/images/logos/LabelSiaga.png') }}" alt="logo" width="250">
            </div>
            <li class="mt-3"><span>SOSIAL MEDIA</span></li>
            <div class="social-mini-button mt-0">
                          <a target="_blank" href="https://www.facebook.com/rumahsakitorthopedisiagaraya?mibextid=LQQJ4d"><span class="mai-logo-facebook-f"></span> rumahsakitorthopedisiagaraya</a>
              <br>
              <!-- <a href="#"><span class="mai-logo-twitter"></span></a> -->
              <a class="ml-0" target="_blank" href="https://www.instagram.com/rssiagaraya?igsh=MXIwc2g2MjY1Nm5udQ%3D%3D&utm_source=qr"><span class="mai-logo-instagram"></span> rssiagaraya</a>
            </div>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3 d-flex flex-column align-items-center">
            <ul class="footer-menu">
                <li>
                    <h5>Tentang Kami</h5>
                </li>
                {{-- <li><a href="{{ route('sambutan') }}">Sambutan Direktur</a></li> --}}
                @foreach ($aboutus as $item)
                    <li><a href="{{ route('about.details', $item->slug) }}">{{ $item->judul }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3 d-flex flex-column align-items-center">
          <ul class="footer-menu">
            <li><h5>LAINNYA</h5></li>
            <li><a href="{{ route('karir') }}">Karir</a></li>
            <li><a href="{{ route('contact') }}">Kontak Kami</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3 d-flex flex-column align-items-center">
          <ul class="footer-menu">
            <li><h5>KONTAK</h5></li>
            <li><a href="#">Jl. Siaga Raya No.4-8, RT.14/RW.3, Pejaten Bar., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510</a></li>
            <li><a href="#">+62 811 899 6581</a></li>
            <li><span>Copyright &copy; 2025 IT RS Orthopedi Siaga Raya</span></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>