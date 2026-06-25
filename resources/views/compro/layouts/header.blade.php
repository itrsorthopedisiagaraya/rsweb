<style>
  .line-h {
    width: .5px;
    height: 30px;
    background-color: #c0c0c0;
  }
</style>

<header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +62 811 899 6581</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> rsosiagaraya@gmail.com</a>
            </div>
          </div>
          <div class="col-sm-4 text-right text-sm">
            <div class="social-mini-button">
              <a target="_blank" href="https://www.facebook.com/rumahsakitorthopedisiagaraya?mibextid=LQQJ4d"><span class="mai-logo-facebook-f"></span></a>
              <!-- <a href="#"><span class="mai-logo-twitter"></span></a> -->
              <a target="_blank" href="https://www.instagram.com/rssiagaraya?igsh=MXIwc2g2MjY1Nm5udQ%3D%3D&utm_source=qr"><span class="mai-logo-instagram"></span></a>
	      <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i></a>
            </div>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        {{-- <a class="navbar-brand" href="#"><span class="text-primary">One</span>-Health</a> --}}
        <div class="logo-wrapper d-flex flex-column justify-content-center align-items-center py-2">
          <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logos/logo_OLD.png') }}" width="250" alt="logos"></a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <style>
          #nav-item-dokter, #nav-item-postingan, #nav-item-about {
            position: relative;
          }
          .dokter-dropdown, .postingan-dropdown, .about-dropdown {
            display: none;
            z-index: 99999;
            border-top: 3px solid #2a4988;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            width: 180px;
            transition: .5s;
          }
          .dokter-dropdown ul, .postingan-dropdown ul, .about-dropdown ul{
            list-style: none;
          }
          .dokter-dropdown ul li, .postingan-dropdown ul li, .about-dropdown ul li{
            padding: 8px 5px;
          }
          .dokter-dropdown ul li a, .postingan-dropdown ul li a, .about-dropdown ul li a{
            color: #999;
            padding: 5px 0;
            transition: .3s;
            font-size: 14px;
          }
          .dokter-dropdown ul li a:hover {
            text-decoration: none;
            color: #555;
          }
          .postingan-dropdown ul li a:hover {
            text-decoration: none;
            color: #555;
          }

          .about-dropdown ul li a:hover {
            text-decoration: none;
            color: #555;
          }
        </style>
        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">Beranda</a>
            </li>
            <li class="nav-item dropdown" id="nav-item-dokter">
              <span class="nav-link dropdown-toggle" id="nav-link-dokter">Dokter</span>
              {{-- <a class="nav-link dropdown-toggle" id="nav-link-dokter" href="#">Dokter </a>  --}}
              <div class="dokter-dropdown">
                <ul>
                  <li><a href="{{ route('doctorsProfile') }}">Profile Dokter</a></li>
                  <li><a href="{{ route('doctorsToday') }}">Jadwal Dokter</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item dropdown" id="nav-item-postingan">
              <span class="nav-link dropdown-toggle" id="nav-link-postingan">Informasi</span>
              {{-- <a class="nav-link dropdown-toggle" id="nav-link-dokter" href="#">Dokter </a>  --}}
              <div class="postingan-dropdown">
                <ul>
                  <li><a href="{{ route('blog') }}">Berita Terkini</a></li>
                  <li><a href="{{ route('karir') }}">Karir Otrhopedi</a></li>
                  <li><a href="{{ route('promo') }}">Promo</a></li>
                </ul>
              </div>
            </li>

            <!--<li class="nav-item dropdown" id="nav-item-about">-->
            <!--  <span class="nav-link dropdown-toggle" id="nav-link-about">Tentang Kami</span>-->
            <!--  <a class="nav-link dropdown-toggle" id="nav-link-dokter" href="#">Dokter </a>-->
            <!--  <div class="about-dropdown">-->
            <!--    <ul>-->
            <!--      <li><a href="{{ route('about') }}">Profil</a></li>-->
            <!--      <li><a href="{{ route('sambutan') }}">Sambutan</a></li>-->
            <!--    </ul>-->
            <!--  </div>-->
            <!--</li>-->

            <li class="nav-item">
              <a class="nav-link" href="{{ route('contact') }}">Kontak</a>
            </li>
            @guest
                {{-- <li class="nav-item">
                    <a class="nav-link ml-lg-3 text-primary" href="{{ route('login') }}">
                      <b>Login</b>
                    </a>
                </li>
                <div class="line-h"></div>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="{{ route('register') }}">
                      <b>Daftar</b>
                    </a>
                </li> --}}
            @else
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle ml-lg-3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(Auth::user()->role == 1)
                          <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                        @else
                          <a class="dropdown-item" href="#">Profile</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('signout') }}">Logout</a>
                    </div>
                </li>
            @endguest
          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>