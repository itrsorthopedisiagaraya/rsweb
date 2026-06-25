@extends('compro.layouts.app')
@section('content')
    <div class="page-banner overlay-dark bg-image" style="background-image: url({{ asset('') }}files/gambar_postingan/banner/{{ $data->gambar }});">
        <div class="banner-section">
        <div class="container text-center wow fadeInUp">
            <nav aria-label="Breadcrumb">
            <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Post</li>
            </ol>
            </nav>
            <h1 class="font-weight-normal">{{ $data->judul }}</h1>
        </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section bg-light">
        <div class="container">
          <div class="row">
            {!! $data->konten !!}
          </div>
        </div>
    </div>
@endsection