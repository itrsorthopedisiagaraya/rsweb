<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>RS Orthopedi SIAGA RAYA</title>
  <link rel="shortcut icon" type="image/png" href="https://www.rsorthopedisiagaraya.id/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="{{asset('assets-compro/assets')}}/css/maicons.css">

  <link rel="stylesheet" href="{{asset('assets-compro/assets')}}/css/bootstrap.css">

  <link rel="stylesheet" href="{{asset('assets-compro/assets')}}/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="{{asset('assets-compro/assets')}}/vendor/animate/animate.css">

  <link rel="stylesheet" href="{{asset('assets-compro/assets')}}/css/theme.css">
  <link rel="stylesheet" href="{{asset('assets')}}/css/home.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet" />
  <link href="{{ asset('assets/DataTables/datatables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/select-option.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"/>
  <style>
    .whatsap-wrapper {
      transition: .5s;
      position: fixed;
      z-index: 9999;
      bottom: 10px;
      right: 15px;
      cursor: pointer;
    }
    .whatsap-wrapper img {
      transition: .3s;
      width: 70px;
    }
    .whatsap-wrapper img:hover {
      width: 80px;
    }
    .loader {
      border: 16px solid #f3f3f3; /* Light grey */
      border-top: 16px solid #3498db; /* Blue */
      border-radius: 50%;
      width: 120px;
      height: 120px;
      animation: spin 2s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    /*add coloursel for partner*/
    /* Make carousel arrows visible */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #007bff !important;
            /* Blue */
            background-size: 60% 60%;
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        /* LEFT ARROW – color only */
        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23007bff' viewBox='0 0 8 8'%3E%3Cpath d='M5.5 0L1 4l4.5 4V0z'/%3E%3C/svg%3E");
        }

        /* RIGHT ARROW – color only */
        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23007bff' viewBox='0 0 8 8'%3E%3Cpath d='M2.5 0l4.5 4-4.5 4V0z'/%3E%3C/svg%3E");
        }

        /* Make dots more visible */
        .carousel-indicators li {
            background-color: #999 !important;
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .carousel-indicators .active {
            background-color: #007bff !important;
            /* Active dot color */
        }

        /* Move dots downward outside the carousel area */
        .carousel-indicators {
            bottom: -50px;
            /* push below */
            position: absolute;
            /* ensure it moves freely */
        }

        /* Optional: center them nicely */
        .carousel {
            margin-bottom: 40px;
            /* add space for dots */
        }
        
        /* DESKTOP: Circle Blue Background + White Arrow */
        #partnerCarouselDesktop .carousel-control-prev-icon,
        #partnerCarouselDesktop .carousel-control-next-icon {
            width: 45px;
            height: 45px;
            background-color: #007bff;   /* Blue background */
            border-radius: 50%;          /* Make it circle */
            background-size: 50% 50%;    /* Arrow size inside */
            background-position: center;
            background-repeat: no-repeat;
        }
        
        /* White arrow icon — LEFT */
        #partnerCarouselDesktop .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 8 8'%3E%3Cpath d='M5.5 0L1 4l4.5 4V0z'/%3E%3C/svg%3E");
        }
        
        /* White arrow icon — RIGHT */
        #partnerCarouselDesktop .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 8 8'%3E%3Cpath d='M2.5 0l4.5 4-4.5 4V0z'/%3E%3C/svg%3E");
        }
        
        /* OPTIONAL: Slight shadow to make it pop */
        #partnerCarouselDesktop .carousel-control-prev-icon,
        #partnerCarouselDesktop .carousel-control-next-icon {
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
        }
        
        #partnerCarouselDesktop .carousel-control-prev-icon:hover,
        #partnerCarouselDesktop .carousel-control-next-icon:hover {
            background-color: #0056b3; /* darker blue */
        }

        /* Make arrows vertically centered */
        #partnerCarouselDesktop .carousel-control-prev,
        #partnerCarouselDesktop .carousel-control-next {
            top: 50%;
            transform: translateY(-50%);
            width: auto;
        }
        
        /* Move LEFT arrow outside */
        #partnerCarouselDesktop .carousel-control-prev {
            left: -60px; /* adjust outward distance */
        }
        
        /* Move RIGHT arrow outside */
        #partnerCarouselDesktop .carousel-control-next {
            right: -60px; /* adjust outward distance */
        }
        
        #partnerCarouselDesktop {
            position: relative;
        }


        /*end coroulsel*/
         /* img on tentang kami */
        .aboutus-details .post-thumb img {
            width: 100%;
        }

        .aboutus-details .post-thumb {
            position: relative;
            display: block;
            margin: 0 auto 32px;
            width: 80%;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(154, 159, 151, 0.3);
        }
  </style>
</head>
<body>

    <!-- Back to top button -->
    <div class="whatsap-wrapper wow zoomIn" id="whatsap-wrapper">
      <img src="{{ asset('assets/images/logos/whatsapp_icon.png') }}" alt="whatsapp icon">
    </div>
    <div class="back-to-top wow zoomIn"></div>
    
    @include('compro.layouts.header')
    @yield('content')
    @include('compro.layouts.footer')

{{-- jquery --}}
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script src="{{asset('assets-compro/assets')}}/js/bootstrap.bundle.min.js"></script>

<script src="{{asset('assets-compro/assets')}}/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="{{asset('assets-compro/assets')}}/vendor/wow/wow.min.js"></script>

<script src="{{asset('assets-compro/assets')}}/js/theme.js"></script>

<script src="{{asset('assets-compro/assets')}}/js/google-maps.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIA_zqjFMsJM_sxP9-6Pde5vVCTyJmUHM&callback=initMap"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://unpkg.com/validator.tool/dist/validator.min.js"></script>
<script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
<script>
  // toggle menu active
  $(document).ready(function () {
    // Set CSRF Token for every AJAX request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('input').attr('autocomplete', 'off');

    var url = window.location;
    $('ul.navbar-nav a[href="' + url + '"]').parent().addClass('active');
    $('ul.navbar-nav a').filter(function () {
      return this.href == url;
    }).parent().addClass('active');

    $(document).on("scroll", function() {
      var scrollHeight = $(this).scrollTop();
      if(scrollHeight >= 470) {
        $('#whatsap-wrapper').css({"bottom": "75px"});
      }else{
        $('#whatsap-wrapper').css({"bottom": "10px"});
      }
    });

    $('#whatsap-wrapper').on('click', function() {
      let newWindow = window.open("", "_blank");
      if(newWindow) {
        newWindow.location.href = 'https://api.whatsapp.com/send?phone=+628118996581&text=Halo,%20saya%20dapat%20info%20tentang%20RS%20Orthopedi%20Siaga%20Raya%20dari%20website%20www.rsorthopedisiagaraya.co.id.%20Bisa%20minta%20info%20lebih%20lanjut%3F';
      }
    });

    var dokterDropdown = $(".dokter-dropdown");
    // Menanggapi mouse masuk ke nav-link-dokter
    $("#nav-link-dokter, .dokter-dropdown").mouseenter(function() {
        dokterDropdown.show();
    });

    // Menanggapi mouse keluar dari dokter-dropdown atau nav-link-dokter
    $("#nav-link-dokter, .dokter-dropdown").mouseleave(function() {
        dokterDropdown.hide();
    });

    // Menanggapi mouse masuk ke nav-link-postingan
    $("#nav-link-postingan, .postingan-dropdown").mouseenter(function() {
        $(".postingan-dropdown").show();
    });

    // Menanggapi mouse keluar dari postingan-dropdown atau nav-link-postingan
    $("#nav-link-postingan, .postingan-dropdown").mouseleave(function() {
        $(".postingan-dropdown").hide();
    });

    // Menanggapi mouse masuk ke nav-link-about
    $("#nav-link-about, .about-dropdown").mouseenter(function() {
        $(".about-dropdown").show();
    });

    // menanggapi mouse keluar dari about-dropdown atau nav-link-about
    $("#nav-link-about, .about-dropdown").mouseleave(function() {
        $(".about-dropdown").hide();
    });

  });
</script>
@yield('script')
</body>
</html>