@extends('compro.layouts.app')

<!-- Add your page-specific CSS here -->
@push('styles')
    <style>
        /* Change the container spacing */
        .pagination {
            margin-top: 20px;
            gap: 5px;
            /* Adds space between buttons */
        }

        /* Style the normal, inactive page numbers */
        .pagination .page-item .page-link {
            color: #4456a1 !important;
            /* text-success green color */
            border-color: #dee2e6;
            border-radius: 4px;
            padding: 8px 16px;
        }

        /* Style the active/current page button */
        .pagination .page-item.active .page-link {
            background-color: #4456a1 !important;
            /* success green background */
            border-color: #4456a1 !important;
            color: #ffffff !important;
        }

        /* Style the hover state */
        .pagination .page-item .page-link:hover {
            background-color: #d9dff0 !important;
            /* light green tint */
            color: #6b80d3 !important;
        }

        /* Style disabled buttons (like "Previous" on the first page) */
        .pagination .page-item.disabled .page-link {
            color: #6c757d !important;
            background-color: #fff;
            border-color: #dee2e6;
        }

        /* 1. Force the massive SVG arrow icons to be small and proportional */
        .pagination svg {
            width: 20px !important;
            height: 20px !important;
            display: inline-block;
            vertical-align: middle;
        }

        /* 2. Hide duplicate screen-reader/hidden elements that distort layout */
        .pagination .hidden {
            display: inline-flex !important;
        }

        /* 3. Fix alignment for the "Showing X to Y of Z results" text block */
        .pagination nav div:first-child {
            margin-bottom: 10px;
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* 4. Align the container layout so buttons flex side-by-side instead of stacked */
        .pagination nav {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .pagination nav div:last-child {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
        }
    </style>
@endpush

@section('content')
    <div class="page-banner overlay-dark bg-image"
        style="background-image: url({{ asset('') }}assets-compro/assets/img/banner/banner-1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a class=" text-success" href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Promo</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Promo</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section">
        <div class="container">
            <!-- Grid displaying the promo cards -->
            <div class="row">
                @foreach ($promo as $key => $item)
                    <div class="col-12 col-md-6 col-lg-4 py-3 d-flex alignment-stretch">
                        <div class="card-blog w-100">
                            <div class="header">
                                <a href="{{ route('promotion', $item->slug) }}" class="post-thumb">
                                    <img src="{{ asset('') }}files\gambar_promo\{{ $item->gambar }}" alt="gambar-berita"
                                        style="width: 100%;">
                                </a>
                            </div>
                            <div class="body">
                                <h5 class="post-title" style="font-weight: 600">
                                    <a href="{{ route('promotion', $item->slug) }}">{{ $item->judul }}</a>
                                </h5>
                                <div class="konten-promo" style="color: #999">
                                    {!! $item->konten !!}
                                </div>
                                <div class="site-info">
                                    <span class="mai-time"></span> Berlaku sampai: {{ $item->deadline }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Single Pagination section seamlessly placed below the cards -->
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $promo->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>
    </div>
@endsection
