@extends('compro.layouts.app')
@section('content')
    <style>
        .btn-teal {
            background-color: #20c997;
            color: #fff;
        }
    </style>
    <div class="page-banner overlay-dark bg-image"
        style="background-image: url({{ asset('assets-compro/assets/img/banner/banner-1.jpg') }});">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-success">
                                Beranda
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dokter
                        </li>
                    </ol>
                </nav>

                <h1 class="font-weight-normal">
                    Jadwal Praktik Dokter
                </h1>
                <button type="button" class="btn btn-primary btn-jadwal mt-5">
                    Jadwal praktek hari ini
                </button>
            </div>
        </div>
    </div>

    <div class="page-section bg-light">
        <div class="container">
            <div class="row">
                <div class="d-flex flex-column w-100">
                    {{-- HARI --}}
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link text-primary" id="senin">
                                Senin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" id="selasa">
                                Selasa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" id="rabu">
                                Rabu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" id="kamis">
                                Kamis
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" id="jumat">
                                Jumat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" id="sabtu">
                                Sabtu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" id="minggu">
                                Minggu
                            </a>
                        </li>
                    </ul>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @if (!empty($data))
                                    @foreach ($dataMap as $key => $item)
                                        <div class="col-12 col-md-6 {{ count($dataMap) > 1 ? 'col-lg-6' : 'col-lg-12' }}">
                                            <div class="card card-dokter mt-3">
                                                {{-- SPECIALTY --}}
                                                <div class="card-header bg-primary">
                                                    <span class="text-white">
                                                        Spesialis {{ $key }}
                                                    </span>
                                                </div>


                                                {{-- DOCTOR TABLE --}}
                                                <div class="card-body">
                                                    <div class="dokter-wrapper d-flex align-items-center">
                                                        <table class="table table-striped table-bordered mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nama Dokter</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                @foreach ($item as $m)
                                                                    <tr>
                                                                        <td>
                                                                            {{ $m['nama'] }} <br>
                                                                            <b class="text-muted">
                                                                                Jam praktik:
                                                                            </b>
                                                                            {{ $m['jam_mulai'] }}
                                                                            -
                                                                            {{ $m['jam_selesai'] }}
                                                                        </td>
                                                                        <td>
                                                                            <a class="btn btn-xs btn-primary text-white"
                                                                                href="{{ route('doctorProfile', ['id' => $m['id']]) }}"><small>
                                                                                    <i class="fas fa-user"></i>
                                                                                </small></a>
                                                                            <a class="btn btn-xs btn-teal text-white"
                                                                                href="https://wa.me/+628118996581"
                                                                                target="_blank" id="konsultasi"><small>
                                                                                    <i class="fab fa-whatsapp"></i>
                                                                                </small></a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="mt-4 px-3"
                                        style="width: 100%; display:flex; justify-content:left; align-items:left;">
                                        <i class="text-muted text-danger" style="font-size: 16px;">
                                            *Jadwal praktek dokter dapat berubah sewaktu-waktu
                                        </i>
                                    </div>
                                @else
                                    <div class="col-12 text-center py-5">
                                        <h5>
                                            Tidak ada jadwal dokter
                                        </h5>
                                        <p class="text-muted">
                                            Tidak ada dokter yang memiliki jadwal praktik pada hari ini.
                                        </p>
                                    </div>
                                @endif

                                <div class="mt-4"
                                    style="width: 100%; display:flex; justify-content:center; align-items:center;">
                                    {{-- {{ $data->links('pagination::bootstrap-4') }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                var url = '{{ url('doctors/:hari') }}';
                url = url.replace(':hari', hari);
                console.log(url);
                window.location.href = url;
            });

            $('#konsultasi').click(function() {
                let newWindow = window.open("", "_blank");
                if (newWindow) {
                    newWindow.location.href = 'https://wa.me/0895612206018';
                }
            });
        });
    </script>
@endsection
