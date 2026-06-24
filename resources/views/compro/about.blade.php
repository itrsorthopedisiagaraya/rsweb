@extends('compro.layouts.app')
@section('content')
  <div class="page-banner overlay-dark bg-image" style="background-image: url({{ asset('') }}assets-compro/assets/img/banner/banner-1.jpg);">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">About</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">Tentang Kami</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <style>
    .history-wrapper {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 300px;
    }
    .history-wrapper .img-history img {
      /* position: absolute; */
      width: 60%;
    }

    .history-wrapper .text-history {
      position: relative;
      width: 80%;
      padding: 30px;
      background-color: #f0f0f0;
      box-shadow: 8px 8px 10px rgba(0, 0, 0, 0.3);
      font-size: 14px;
      color: #777;
      border-radius: 18px;
      top: 0;
    }
    .visi-wrapper {
      padding: 15px;
      border-radius: 18px;
      background-color: #f0f0f0;
      box-shadow: 8px 8px 10px rgba(0, 0, 0, 0.3);
    }
    .misi-wrapper {
      margin-top: 10px;
      padding: 15px;
      border-radius: 18px;
      background-color: #f0f0f0;
      box-shadow: 8px 8px 10px rgba(0, 0, 0, 0.3);
    }
    .layanan-card .card {
      cursor: pointer;
      transition: .3s;
    }
    .layanan-card .card:hover {
      background-color: #f5f5f5;
    }
    @media screen and (max-width: 840px) {
      .history-wrapper .text-history {
        position: relative;
        padding: 15px;
        width: 100%;
        background-color: #fff;
        box-shadow: none;
      }

      .text-history h1 {
        font-size: 24px;
      }
    }
  </style>

  <div class="page-section">
    <div class="sejarah-wrapper mb-5 wow zoomIn">
      <div class="history-wrapper pb-3">
        {{-- <div class="img-history">
          <img src="{{ asset('') }}assets\images\banner\hospital.jpg" alt="hospital">
        </div> --}}
        <div class="text-history">
          <h1>Sejarah Rumah Sakit Orthopedi Siaga Raya</h1>
          <hr>
          <p>
            RS Orthopedi Siaga Raya yang dahulu dikenal dengan nama RS Siaga Raya, merupakan suatu unit usaha PT Siaga Bhakti Wirasta yang bergerak dibidang pelayanan kesehatan. PT Siaga Bhakti Wirasta didirikan pada tanggal 29 Maret 1988 oleh lima orang yang menaruh minat dan bergerak di bidang kesehatan. Pada tanggal 18 Agustus 1990 telah dilakukan soft opening yang ditandai pembukaan praktek pertama Prof. dr. Chehab Rukni Hilmy, Sp.OT, FICS. Pada Tanggal 3 November 1990 peresmiannya dilakukan oleh Dr. Broto Warsito selaku Dirjen Pelayanan Medis Departemen Kesehatan.<br><br>
    
            Pada Tanggal 18 Juli 2022, berdasarkan SK Direktur nomor NOMOR 01 1/SK/DrR/RSSWM2022 Rumah Sakit Siaga Raya resmi berubah nama menjadi RS Orthopedi Siaga Raya. Perubahan nama tersebut juga diikuti dengan perubahan kelas / tipe rumah sakit dari Kelas C Umum menjadi Kelas C Khusus.
          </p>
        </div>
      </div>
    </div>
    <div class="visi-misi-wrapper bg-light wow zoomIn pb-5">
      <div class="container">
        <h1 class="pt-5">VISI & MISI</h1>
        <hr>
        <div class="visi-wrapper">
          <h4><strong>Visi</strong></h4>
          <p>Menjadi Rumah Sakit rujukan bedah Orthopedi dan Traumatologi Orthopedi di seluruh Indonesia.</p>
        </div>
        <div class="misi-wrapper">
          <h4><strong>Misi & Tujuan</strong></h4>
          <p>
            Menjadi rumah sakit pilihan rujukan orthopedi Indonesia 
            <br><br>
            Menjadikan RS Orthopedi Siaga Raya sebagai unggulan dalam memberikan pelayanan kesehatan paripurna khususnya dibidang Orthopedi, traumatologi dan cidera olahraga yang menjamin kepuasan pelanggan dan bermutu tinggi.
            <br><br>
            Menjamin pelanggan melalui manajemen yang mandiri dan modern tidak lepas dari sifat profesionalisme dan prinsip-prinsip arahan berupa kebersamaan, kesejawatan, humanitas, integritas dan inovatif.
            <br><br>
            Menyelenggarakan dan mengembangkan manajemen rumah sakit modern yang tepat guna dan berhasil guna dalam upaya peningkatan pelayanan kesehatan sebagai lahan pengabdian profesi medik khususnya orthopedi, traumatologi, dan degeneratif.
            <br><br>
            mengembangkan sumber daya manusia yang profesional sesuai dengan perkembangan ilmu pengetahuan dan teknologi dalam ilmu orthopedi.
          </p>
        </div>
      </div>
    </div>

    {{-- {{ dd($layananMedis) }} --}}
    @if(!$layananMedis->isEmpty())
    <div class="fasilitas-wrapper  wow zoomIn">
      <div class="container py-5">
        <h1>Layanan medis & perawatan</h1>
        <hr>
        <div class="row">

          @foreach ($layananMedis as $item)  
          <div class="col-12 col-lg-3 col-sm-6 col-md-4 layanan-card">
            <div class="card shadow my-3">
              <div class="card-body">
                <div class="d-flex justify-content-center align-items-center flex-column">
                  <img src="{{ asset('') }}files/gambar_layanan_medis/{{ $item->image }}" style="width:150px; height:150px;" alt="gambar" class="img-fluid">
                  <h5 class="mt-3 slug" data-slug="{{ $item->slug }}">{{ $item->judul }}</h5>
                </div>
              </div>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>
    @endif
  </div>
@endsection

@section('script')
    <script>
      $(document).ready(function () {
        $('.layanan-card').on('click', function() {
          var slug = $(this).find('.slug').data('slug');
          var url = '{{ route("layananMedis", ":slug") }}';
          url = url.replace(':slug', slug);
          window.location.href = url;
        });
      });
    </script>
@endsection