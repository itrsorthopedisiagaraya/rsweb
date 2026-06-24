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
        <h1 class="font-weight-normal">Profile Dokter</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section bg-light">
    <div class="container">
      <div class="row">
        <div class="d-flex flex-column w-100">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  @if($data->first() != null)
                    @foreach ($data as $item)
                    @if($item->hari->first() != null)
                        <style>
                            .info-profile-wrapper {
                                display: flex;
                                justify-content: space-between;
                            }
                            .profile-wrapper {
                                padding: 5px 10px;
                                border: 1px solid #2a4988;
                                border-radius: 5px;
                                position: relative;
                                width: 80%;
                            }
                            .profile-wrapper span {
                                background-color: #2a4988;
                                color: #fff;
                                position: absolute;
                                top: 0;
                                left: 0;
                                border-top-left-radius: 5px;
                                border-top-right-radius: 5px;
                                width: 100%;
                                padding: 3px 8px;
                            }
                            .image-wrapper {
                                margin-right: 10px;
                            }
                            .info-wrapper {
                                display: flex;
                                justify-content: space-between;
                            }
                            .profile-wrapper .info, 
                            .profile-wrapper .button {
                                display: flex;
                                flex-direction: column;
                                margin-top: 30px;
                            }
                            .profile-wrapper .button a {
                                border: 1px solid #2a4988;
                                border-radius: 15px;
                                padding: 2px 7px;
                                margin-top: 5px;
                                color: #666;
                                transition: .3s;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                            }
                            .profile-wrapper .button a:hover {
                                text-decoration: none;
                                color: #999;
                            }
                            .profile-wrapper .button a:first-child {
                                background-color: #2a4988;
                                color: #fff;
                            }
                            .profile-wrapper .button a:first-child:hover {
                                background-color: #5b6b8a;
                            }
                            @media only screen and (max-width: 768px) {
                                .info-wrapper {
                                    display: flex;
                                    flex-direction: column;
                                }
                            }
                        </style>
                        <div class="info-profile-wrapper my-3">
                            <div class="image-wrapper ml-3">
                                @if ($item->foto == null)
                                    <img style="width: 100px; height: 110px;" src="{{ asset('files\foto-dokter\default.jpg') }}" alt="dokter">  
                                @else
                                    <img style="width: 100px; height: 110px;" src="{{ asset('') }}files/foto-dokter/{{ $item->foto }}" alt="doktor">
                                @endif
                            </div>
                            <div class="profile-wrapper">
                                <div class="d-flex flex-column">
                                    <span><strong>{{ $item->nama_dokter }}</strong></span>
                                    <div class="info-wrapper">
                                        <div class="info">
                                            <small><i><strong>Spesialis {{ $item->spesialis }}</strong></i></small>
                                            <small class="mt-2">{{ $item->hari->first()->hari }} - {{ $item->hari->last()->hari }}</small>
                                            <small>{{ $item->jamMulai->first()->jam }} - {{ $item->jamSelesai->last()->jam }}</small>
                                        </div>
                                        <div class="button">
                                            <a href="{{ route('doctorProfile', ['id' => $item->id]) }}"><small>Lihat Profile Dokter</small></a>
                                            <a href="https://wa.me/+628118996581" target="_blank" id="konsultasi"><small>Jadwalkan Konsultasi</small></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      @endif
                    @endforeach
                  @endif
                  <div class="d-flex justify-content-center align-items-center">
                    {{-- if filtered --}}
                    @if($search != null)
                      {{ $data->appends(['dokter' => $search])->links('pagination::bootstrap-4') }}
                    @elseif($spesialis != null)
                      {{ $data->appends(['spesialis' => $spesialis_filter])->links('pagination::bootstrap-4') }}
                    @else
                      {{ $data->links('pagination::bootstrap-4') }}
                    @endif
                  </div>
                </div>
                <div class="col-md-4">
                  <form action="{{ route('doctorsProfileFilter') }}" method="GET" class="my-3">
                    @csrf
                    <div class="form-group d-flex">
                      <input type="text" placeholder="Cari dokter.." value="{{ $search != null ? $search : '' }}" name="dokter" class="form-control">
                      <button class="btn btn-primary btn-sm ml-2" type="submit">Cari</button>
                    </div>
                  </form>
                  <hr>
                  <form action="{{ route('doctorsProfileFilter') }}" method="GET" class="my-3">
                    @csrf
                      <div class="card mt-2">
                          <div class="card-header">
                              <span>Filter Spesialis</span>
                          </div>
                          <div class="card-body">
                              <ul>
                                  @foreach ($spesialis as $item)
                                  <li>
                                      <input type="radio" class="form-check-input" value="{{ $item->spesialis }}" name="spesialis" id="{{ $item->spesialis }}">
                                      <label for="{{ $item->spesialis }}">{{ $item->spesialis }}</label>    
                                  </li>    
                                  @endforeach
                              </ul>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary btn-sm mt-3"><i class="fa fa-filter"></i> Submit Filter</button>
                  </form>
                </div>
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
    $('#konsultasi').on('click', function() {
      let newWindow = window.open("", "_blank");
      if(newWindow) {
        newWindow.location.href = 'https://wa.me/+628118996581';
      }
    });

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

    $('.card-dokter').mouseenter(function() {
      $(this).children('.aksi-dokter').css('display', 'flex');
    });
    $('.card-dokter').mouseleave(function() {
      $(this).children('.aksi-dokter').css('display', 'none');
    });

    $('.nav-link').click(function() {
      var hari = $(this).attr('id');
      var url = '{{ url("doctors/:hari") }}';
      url = url.replace(':hari', hari);
      console.log(url);
      window.location.href = url;
    });
  });
</script>
@endsection