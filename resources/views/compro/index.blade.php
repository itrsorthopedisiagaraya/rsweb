@extends('compro.layouts.app')
@section('content') 
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
 <!-- Menggunakan CSS Selectize -->
 <style>
  .selectize-input {
    width: 100%; /* Sesuaikan dengan lebar yang diinginkan */
    height: 45px;
    display: flex;
    /* justify-content: center; */
    align-items: center;
  }

  .layanan-content p {
    max-width: 200px; /* Atur lebar maksimum untuk sel */
    overflow: hidden; /* Sembunyikan konten yang melebihi lebar maksimum */
    white-space: nowrap; /* Pastikan konten tidak terpotong ke baris baru */
    text-overflow: ellipsis;
  }
  #card-layanan.card-layanan:hover {
    background-color: #fff;
  }
  #card-layanan.card-layanan:hover p {
    color: #555;
  }
 </style>
  <div class="page-hero bg-image overlay-dark" style="background-image: url({{ asset('') }}assets-compro/assets/img/banner/banner-1.jpg);">
    <div class="hero-section">
      <div class="container text-center wow zoomIn">
        <!-- <span class="subhead">Let's make your life happier</span> -->
        <h1 class="display-4">
          SELAMAT DATANG 
          <br>
            DI RS ORTHOPEDI SIAGA RAYA
      
          </h1>
          {{-- @auth
          <button class="btn btn-primary" data-toggle="modal" data-target="#berobat">Daftar Berobat</button>
          @else
          <a class="btn btn-primary" href="{{ route('login') }}">Daftar Berobat</a>
          @endauth --}}
      </div>
    </div>
  </div>

  <div class="content" id="content">

    <div class="dokter-image-wrapper py-5 mt-5">
      {{-- <div class="container"> --}}
        <div class="row">
          <div class="col-sm-6">
            <img src="{{ asset('assets/images/dokter/all-dokter1.jpg') }}" style="width: 100%" alt="">
          </div>
          <div class="col-sm-6">
            <h1 class="text-primary mb-3">Kesembuhan Anda Adalah Kebahagiaan Kami</h1>
            <p style="color: #999">Pada Tanggal 18 Juli 2022, Rumah Sakit Siaga Raya resmi berubah nama menjadi RS Orthopedi Siaga Raya. Perubahan nama tersebut juga diikuti dengan perubahan kelas / tipe rumah sakit dari Kelas C Umum menjadi Kelas C Khusus</p>
            <a href="{{ route('about') }}" class="btn btn-primary mt-4">Selengkapnya</a>

            {{-- <a href="{{ route('doctorsProfile') }}">
              <div class="card-service ml-4">
                <div class="circle-shape bg-secondary text-white">
                  <span class="mai-chatbubbles-outline"></span>
                </div>
                <p class="text-dark">Buat janji dengan dokter</p>
              </div>
            </a> --}}

          </div>
        </div>
      {{-- </div> --}}
    </div>

    @if ($layanan->first() != null)   
    <section class="mx-auto mb-4 py-5 fitur-unggulan-home">
      <div class="container">
        
        <div class="mt-4 fitur-unggulan-wrapper">
          <span class="text-center text-primary"><strong>Fitur Unggulan</strong></span>
          <h3 class="text-center mb-5 wow fadeInUp">Layanan Unggulan Rumah Sakit Orthopedi</h3>
        </div>
        <div class="slick-wrapper">
         
          @foreach ($layanan as $key => $ly) 
          <div class="mx-2">
            <div class="card card-layanan" data-id="{{ $ly->id }}" id="card-layanan" style="width: 18rem;">
              <img src="{{ asset('') }}files/gambar_layanan/{{ $ly->gambar }}" class="card-img-top" alt="layanan-image">
              <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">{{ $ly->layanan }}</h6>
                <span class="card-text layanan-content">{!! $ly->konten !!}</span>
                <a href="{{ route('layananDetail', $ly->id) }}" class="card-link">Selengkapnya..</a>
              </div>
            </div>
          </div>
          @endforeach
  
        </div>
      </div>
    </section>
    @endif
  </div>

  @if ($promo->first() != null)  
  <div class="page-section promo-home-wrapper">
    <div class="d-flex justify-content-center align-items-center flex-column">
      <span class="text-center text-primary"><strong>Promo</strong></span>
      <h3 class="text-center mb-5 wow fadeInUp">🌟 Promo Kesehatan Kami! 🌟</h3>
      <div class="owl-carousel wow fadeInUp" id="promoSlideshow">

        @foreach ($promo as $item)
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
  @endif

  @if ($berita->first() != null)  
  <div class="berita-wrapper bg-light py-5">
    <span class="text-primary"><strong>Berita & Acara</strong></span>
    <h3>Kabar Terbaru Orthopedi</h3>
    <div class="container">
      <div class="row mt-5">

        @foreach ($berita as $brt)
        <div class="col-lg-4 py-2 wow zoomIn">
          <div class="card-blog">
            <div class="header">
              <div class="post-category">
                <a href="#">{{ $brt->kategori->kategori }}</a>
              </div>
              <a href="{{ url('blog/details', $brt->slug) }}" class="post-thumb">
                <img src="{{ asset('') }}files/gambar_postingan/banner/{{ $brt->gambar }}" alt="">
              </a>
            </div>
            <div class="body">
              <h5 class="post-title"><a href="{{ url('blog/details', $brt->slug) }}">{{ $brt->judul }}</a></h5>
              <div class="site-info">
                <span class="mai-time"></span> {{ $brt->created_at }}
              </div>
            </div>
          </div>
        </div>
        @endforeach

        <div class="col-12 text-center mt-4 wow zoomIn">
          <a href="{{ route('blog') }}" class="btn btn-primary">
            Lihat Berita Lainya &emsp;
            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
          </a>
        </div>

      </div>
    </div>
 </div>
  @endif

  @if ($dokter->first() != null)  
  <!-- .page-section -->
  <div class="page-section dokter-home-wrapper wow fadeInUp">
    <div class="container">
      <span class="text-center text-primary"><strong>Dokter Kami</strong></span>
      <h3 class="text-center mb-5">Temukan Dokter Berpengalaman di Orthopedi</h3>
      <div class="owl-carousel" id="doctorSlideshow">

        @foreach ($dokter as $item) 
        <div class="item">
          <div class="card-doctor">
            <div class="header">
              @if ($item->foto == null)
                <img src="{{ asset('files\foto-dokter\default.jpg') }}" alt="dokter">  
              @else
                <img src="{{ asset('') }}files/foto-dokter/{{ $item->foto }}" alt="doktor">
              @endif
              <div class="meta d-flex justify-content-center align-items-center">
                <a target="_blank" href="https://wa.me/+628118996581"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">{{ $item->nama_dokter }}</p>
              <span class="text-sm text-grey">{{ $item->spesialis }}</span>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <a href="{{ route('doctorsProfile') }}" class="btn btn-primary">Lihat Semua Dokter</a>
    </div>
  </div>
  @endif

  <div class="maps-wrapper py-4 bg-light wow fadeInUp bg-light">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="label">
            <span style="letter-spacing: 3px;">HUBUNGI KAMI</span><br><br>
            <h1 class="mb-2">Konsultasi Medis Profesional</h1><br>
            <!-- <button type="button" class="btn btn-primary">
              <svg version="1.1" width="30" height="30" style="background-color:aliceblue; color:aliceblue" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve">
                <path d="M62.2705,13.6787c-0.3867-1.167-1.2031-2.1118-2.2969-2.6606c0-0.0005-0.001-0.001-0.002-0.001
                  c-2.2617-1.1313-5.0322-0.2114-6.1689,2.0518l-2.877,5.7433v-7.4093c0-0.234-0.1146-0.5202-0.2744-0.6885l-8.9219-9.4028
                  C41.5586,1.1317,41.2564,1,41.0078,1H6.0068C3.5181,1,1.4932,3.0249,1.4932,5.5137v52.9727C1.4932,60.9751,3.5181,63,6.0068,63 h40.4053c2.4893,0,4.5137-2.0249,4.5137-4.5137V39.3376l11.0947-22.152C62.5693,16.0918,62.6592,14.8467,62.2705,13.6787z M42.0039,4.5068l5.5947,5.896h-3.3145c-1.2578,0-2.2803-1.0215-2.2803-2.2769V4.5068z M48.9258,58.4863
                  c0,1.3862-1.1279,2.5137-2.5137,2.5137H6.0068c-1.3862,0-2.5137-1.1274-2.5137-2.5137V5.5137C3.4932,4.1274,4.6206,3,6.0068,3 h33.9971v5.126c0,2.3584,1.9199,4.2769,4.2803,4.2769h4.6416v10.402l-6.5523,13.0804H11.0259c-0.5522,0-1,0.4478-1,1s0.4478,1,1,1 h30.3458l-1.4728,2.9402c-0.0417,0.0809-0.112,0.3014-0.112,0.3997l-0.1317,1.6411H11.252c-0.5522,0-1,0.4478-1,1s0.4478,1,1,1 h28.2426l-0.4001,4.9849H11.4819c-0.5522,0-1,0.4478-1,1s0.4478,1,1,1h28.5356c0.2103,0,0.5101-0.1163,0.6611-0.2495 l7.1973-6.3379c0.0766-0.1019,0.1544-0.2028,0.2334-0.3027l0.8164-1.6301V58.4863z M41.6634,42.8486l3.7776,1.894l-4.2291,3.7242 L41.6634,42.8486z M60.2324,16.2891L46.7686,43.1709l-4.6416-2.3271l13.4639-26.8784c0.6426-1.2778,2.2061-1.7979,3.4863-1.1597 c0.6162,0.3096,1.0762,0.8433,1.2959,1.5034C60.5918,14.9697,60.543,15.6724,60.2324,16.2891z"></path>
                <g id="_x30_2_anti_bacterial"></g>
                <g id="_x30_1_hand_sanitizer"></g>
                </svg> 
              Buat Janji Temu</button> -->
          </div>
        </div>
        <div class="col-sm-4">
          <div class="info-address">
            <div class="jalan">
              <table>
                <tr style="position: relative;">
                  <td style="position: absolute; top:0; left:-40px;"><i class="fa fa-location"></i></td>
                  <td>
                    <span>
                      Jl. Siaga Raya No.4-8
                      Pejaten Barat, Pasar minggu
                      Jakarta Selatan,
                      Daerah Khusus Ibukota Jakarta 12510
                    </span>
                  </td>
                </tr>
                <tr style="position: relative;">
                  <td style="position: absolute; top:0; left:-40px; padding-top: 20px;"><i class="fa fa-mobile" aria-hidden="true"></i></td>
                  <td style="padding-top: 20px;">021-7972750</td>
                </tr>
                <tr style="position: relative;">
                  <td style="position: absolute; top:0; left:-40px; padding-top: 20px;"><i class="fa fa-envelope" aria-hidden="true"></i></td>
                  <td style="padding-top: 20px;">marketing.rssr@gmail.com</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.930333083982!2d106.83660377515045!3d-6.272891461407162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f238d2e5070d%3A0xae802229d83eb694!2sJl.%20Siaga%20Raya%20No.4-8%2C%20RT.14%2FRW.3%2C%20Pejaten%20Bar.%2C%20Ps.%20Minggu%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2012510!5e0!3m2!1sid!2sid!4v1704503411105!5m2!1sid!2sid" style="border:0; width:100%; height:400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>

  {{-- {{ dd($dokter) }} --}}
  <!-- Modal -->
  <div class="modal fade" id="berobat" tabindex="-1" role="dialog" aria-labelledby="berobatLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="" id="daftarBerobat">
          <div class="modal-header">
            <h5 class="modal-title" id="berobatLabel">Form Pendaftaran Berobat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="pembayaran" class="mt-2">Metode Pembayaran</label>
                  <select name="pembayaran" id="pembayaran" class="select2">
                    <option value=""></option>
                    <option value="umum / cash">Umum/Cash</option>
                    <option value="jaminan perusahaan">Jaminan Perusahaan</option>
                    <option value="asuransi">Asuransi</option>
                  </select>
                </div>
                <div class="form-group mb-2">
                  <label for="dokter">Dokter</label>
                  <select name="dokter" id="dokter" class="form-control select2">
                    <option value=""></option>
                    @foreach ($dokter as $item)
                      @if($item->hari->first() != null)
                        <option value="{{ $item->id }}">{{ $item->nama_dokter }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="jadwal_praktek"></div>
                <div class="form-group mt-3">
                  <label for="tgl_periksa" class="mt-2">Tanggal Periksa</label>
                  <input type="text" id="tgl_periksa" name="tgl_periksa" class="form-control" disabled>
                  <div class="validate_hari"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary daftar">Daftar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
@endsection

@section('script')
<script>
  var validator = new Validator({
    form: document.getElementById('daftarBerobat'),
    rules: {
      email: {
        validate: (val) => val ? '' : 'Required!',
      },
      password1: {
        // validate: (val) => val < 5 || val > 15 ? '字数大于5，小于15' : ''
      },
      password2: {
        validate: (val) => !val ? 'Required!' : '',
      },
    }
  });

  validator.form.onsubmit = (evn) => {
    const values = validator.getValues();
    const form = document.getElementById('daftarBerobat')
    const elements = form.elements;

    const existingSmallElements = document.querySelectorAll('small');
    existingSmallElements.forEach(element => {
      element.remove();
    });

    const emptyElements = [];
    for (let i = 0; i < elements.length; i++) {
      const element = elements[i];
      const elName = elements[i].dataset.name;
      var smallElement = document.createElement('small');
      // Periksa jika elemen memiliki nilai kosong
      if (element.value.trim() === '') {
        evn.preventDefault();
        // Menambahkan teks ke dalam elemen <small>
        var smallText = document.createTextNode(`${elName} tidak boleh kosong!`);
        smallElement.appendChild(smallText);
        smallElement.style.color = 'red';
        smallElement.style.fontSize = '11px';
        if (element.tagName === 'INPUT' && !element.hasAttribute('disabled')) {
          element.after(smallElement);
          emptyElements.push(element);
        } else if(element.tagName === 'SELECT') {
          element.nextElementSibling.after(smallElement);
          emptyElements.push(element);
        }
      }
    }
    
    if(emptyElements.length <= 0) {
      $('#berobat').modal('hide');
      var data = {
        _token: '{{ csrf_token() }}',
        pembayaran: $('#pembayaran').val(),
        dokter: $('#dokter').val(),
        tgl_periksa: $('#tgl_periksa').val()
      }
  
      $.ajax({
        url: `{{ route('daftarBerobat') }}`,
        type: 'POST',
        data: data,
        success: function(res) {
          if(res.success == true) {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: 'Terimakasih, data anda akan segera kami proses.'
            });
          }
        }
      })
    }
  }

  $(document).ready(function(){
    function getDay(dateString) {
      let dataObject = new Date(dateString);
      let daysOfWeek = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
      let dayOfWeek = daysOfWeek[dataObject.getDay()];

      return dayOfWeek;
    }

    $('#spesialis').selectize();

    $('#tgl_periksa').datepicker({
      dateFormat: 'yy-mm-dd',
      changeYear: true,
      changeMonth: true,
      yearRange: '-0:+1'
    })

    $('.select2').select2({
      placeholder: "Pilih Salahsatu",
      allowClear: true,
      width: '100%'
    });

    $('#rekmed-status').click(function(){
      if($(this).is(':checked')){
        $('#rekmed').attr('disabled', true);
      }else{
        $('#rekmed').attr('disabled', false);
      }
    });

    $('#dokter').on('change', function() {
      $.ajax({
        type: 'POST',
        url: `{{ route('api.dokter.jadwal') }}`,
        data: { 
          _token: '{{ csrf_token() }}',
          dokter_id: $(this).val()
        },
        success: function (res) {  
          let days = [];
          let day = null;
          $('.validate_hari').html('');
          $('#tgl_periksa').removeAttr('disabled');
          if($('#tgl_periksa').val() != '') {
            day = getDay($('#tgl_periksa').val());
          }

          $('.jadwal_praktek').html('');
          $.each(res.hari, function(i,v) {
            days.push(v.hari.toLowerCase());
          })
          $('.jadwal_praktek').append(
            `<span style="font-size: 12px;">Dokter bersedia pada hari:</span> <br>
            <span>${days}</span>`
          )
          
          if(day != null) {
            let dayExist = days.includes(day);
            if(!dayExist) {
              $('.validate_hari').append(`<span style="color: red; font-size: 12px;">Dokter tidak ada jadwal hari ${day}</span>`);
              $('.daftar').attr('disabled', 'disabled');
              $('.daftar').css('cursor', 'not-allowed');
            }else{
              $('.daftar').removeAttr('disabled');
              $('.daftar').css('cursor', 'pointer');
            }
          }
        }
      })
    });

    $('#tgl_periksa').change(function() {
      let dayOfWeek = getDay($(this).val());
      $.ajax({
        type: 'POST',
        url: `{{ route('api.dokter.jadwal') }}`,
        data: { 
          _token: '{{ csrf_token() }}',
          dokter_id: $('#dokter').val()
        },
        success: function (res) {  
          let hari = [];
          $('.validate_hari').html('');
          $.each(res.hari, function(i,v) {
            hari.push(v.hari.toLowerCase());
          });

          let dayExist = hari.includes(dayOfWeek)
          if(!dayExist) {
            $('.validate_hari').append(`<small style="color: red">Dokter tidak ada jadwal hari ${dayOfWeek}</small>`);
            $('.daftar').attr('disabled', 'disabled');
            $('.daftar').css('cursor', 'not-allowed');
          }else{
            $('.daftar').removeAttr('disabled');
            $('.daftar').css('cursor', 'pointer');
          }
        }
      })
    });

    // $('.daftar').click(function() {
    //   $('#berobat').modal('hide');
    //   var data = {
    //     _token: '{{ csrf_token() }}',
    //     pembayaran: $('#pembayaran').val(),
    //     dokter: $('#dokter').val(),
    //     tgl_periksa: $('#tgl_periksa').val()
    //   }

    //   $.ajax({
    //     url: `{{ route('daftarBerobat') }}`,
    //     type: 'POST',
    //     data: data,
    //     success: function(res) {
    //       if(res.success == true) {
    //         Swal.fire({
    //           icon: 'success',
    //           title: 'Berhasil',
    //           text: 'Terimakasih, data anda akan segera kami proses.'
    //         });
    //       }
    //     }
    //   })
    // });

    $('.card-layanan').click(function(e) {
      var id = $(this).data('id');
      var routeTemplate = "{{ route('layananDetail', ['id' => ':id']) }}";
      var route = routeTemplate.replace(':id', id);

      window.location.href = route;
    });
  });

    $('.slick-wrapper').slick({
      slidesToShow: {{ count($layanan) < 3 ? count($layanan) : 3 }},
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      dots: true,
    }); 
  </script>
  @endsection