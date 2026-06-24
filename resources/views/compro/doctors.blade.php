@extends('compro.layouts.app')
@section('content')
  <div class="page-banner overlay-dark bg-image" style="background-image: url({{ asset('') }}assets-compro/assets/img/banner/banner-1.jpg);">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dokter</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">Jadwal Praktik Dokter</h1>
        <button type="button" class="btn btn-primary btn-jadwal mt-5">Jadwal praktek hari ini</button>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section bg-light">
    <div class="container">
      <div class="row">
        <div class="d-flex flex-column w-100">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link text-primary" id="senin">Senin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-primary" id="selasa">Selasa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-primary" id="rabu">Rabu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-primary" id="kamis">Kamis</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-primary" id="jumat">Jumat</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-primary" id="sabtu">Sabtu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-primary" id="minggu">Minggu</a>
            </li>
          </ul>
          <div class="card">
            <div class="card-body">
              <div class="row">
                @if($data != null)
                @foreach ($dataMap as $key => $item)
                
                <div class="col-sm-6">
                  <div class="card card-dokter mt-3">
                    <div class="card-header bg-primary">
                      <span class="text-white">Spesialis {{ $key }}</span>
                    </div>
                    <div class="card-body">
                      <div class="dokter-wrapper d-flex align-items-center">
                        <table class="table table-striped table-bordered">
                          @foreach ($item as $m)
                          <tr>
                            <td>{{ $m['nama'] }}</td>
                            <td>{{ $m['jam_mulai'] }} - {{ $m['jam_selesai'] }}</td>
                          </tr>
                          @endforeach
                        </table>
                      </div>
                    </div>
                    {{-- <div class="card-body">
                      <div class="dokter-wrapper d-flex align-items-center">
                        <div class="rounded-circle-container">
                          @if ($item->dokter->foto == null)
                            <img src="{{ asset('files\foto-dokter\default.jpg') }}" alt="dokter">  
                          @else
                            <img src="{{ asset('') }}files/foto-dokter/{{ $item->dokter->foto }}" alt="doktor">
                          @endif
                        </div>
                        <div class="keterangan d-flex flex-column ml-3 justify-content-center">
                          <span class="name text-primary"><strong>{{ $item->dokter->nama_dokter }}</strong></span>
                          <span class="spesialis">{{ $item->dokter->spesialis }}</span>
                          <small class="jadwal" style="color: #999;">{{ $item->jamMulai->jam . ' - ' . $item->jamSelesai->jam }}</small>
                        </div>
                      </div>
                    </div> --}}
                    <div class="aksi-dokter">
                      <span>Lihat profile dokter</span>
                      <span id="konsultasi">Jadwalkan konsultasi</span>
                    </div>
                  </div>
                </div>
                
                @endforeach
                @endif
                <div class="mt-4" style="width: 100%; display:flex; justify-content:center; align-items:center;">
                  {{-- {{ $data->links('pagination::bootstrap-4') }} --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .container -->
  </div> <!-- .page-section -->
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('#dokter').selectize();
    $('#spesialis').selectize();
    $('#hari').selectize();

    const getDayName = function() {
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

      today = mm + '/' + dd + '/' + yyyy;

      var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
      var d = new Date(today);
      var dayName = days[d.getDay()];

      return dayName;
    }

    $('.btn-jadwal').click(function(e) {
      var dayName = getDayName();
      var url = "{{ url('') }}/dokter/jadwal/hari-ini/" + dayName;
      window.location.href = url;
    });

    // $('.nav-tabs').
    function todayName() {
      var today = new Date(); 
      // Daftar nama hari
      var daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
      // Mendapatkan indeks hari saat ini
      var dayIndex = today.getDay();
      // Mendapatkan nama hari saat ini
      var todayName = daysOfWeek[dayIndex];
      return todayName;
    }
    
    var todayName = '{{ $hari_active }}';
    console.log(todayName.toLowerCase());
    $(`#${todayName.toLowerCase()}`).addClass('active');
    $(`#${todayName.toLowerCase()}`).css({
      'color': '#333',
      'font-weight': 'bold',
    }); 

    $('.nav-link').click(function() {
      var hari = $(this).attr('id');
      var url = '{{ url("doctors/:hari") }}';
      url = url.replace(':hari', hari);
      console.log(url);
      window.location.href = url;
    });

    $('#konsultasi').click(function() {
      let newWindow = window.open("", "_blank");
      if(newWindow) {
        newWindow.location.href = 'https://wa.me/0895612206018';
      }
    });
  });
</script>
@endsection