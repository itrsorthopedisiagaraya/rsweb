@extends('compro.layouts.app')
@section('content')

<div class="page-section pt-5">
    <div class="container">
      @foreach ($data as $item)
      <div class="row">
        <div class="col-lg-8">
          <nav aria-label="Breadcrumb">
            <ol class="breadcrumb bg-transparent py-0 mb-5">
              <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-primary">Beranda</a></li>
              <li class="breadcrumb-item"><a href="{{ route('blog') }}" class="text-primary">Berita</a></li>
              <li class="breadcrumb-item active" aria-current="page"><strong>{{ $item->judul }}</strong></li>
            </ol>
          </nav>
        </div>
      </div> <!-- .row -->

      <div class="row">
        <div class="col-lg-8">
          <article class="blog-details">
            <div class="post-thumb">
              <img src="{{ asset('') }}files/gambar_postingan/banner/{{ $item->gambar }}" alt="">
            </div>
            <div class="post-meta">
              <div class="post-author">
                <span class="text-grey">By</span> <a href="#">Admin</a>  
              </div>
              <span class="divider">|</span>
              <div class="post-date">
                <a href="#">22 Jan, 2024</a>
              </div>
            </div>
            <h2 class="post-title h1">{{ $item->judul }}</h2>
            <style>
              .post-content * {
                text-align: justify;
              }
            </style>
            <div class="post-content">
              {!! $item->konten !!}
            </div>
          </article> <!-- .blog-details -->

          <hr>

          <div class="row">
            <div class="col-6">
              <ul class="categories">
                @foreach ($kategori as $ktgr)
                  <li><a href="#">{{ $ktgr->kategori }} <span>{{ $ktgr->postingan_count }}</span></a></li>
                @endforeach
              </ul>
            </div>
          </div>
          {{-- <div class="comment-form-wrap pt-5">
            <h3 class="mb-5">Leave a comment</h3>
            <form action="#" class="">
              <div class="form-row form-group">
                <div class="col-md-6">
                  <label for="name">Name *</label>
                  <input type="text" class="form-control" id="name">
                </div>
                <div class="col-md-6">
                  <label for="email">Email *</label>
                  <input type="email" class="form-control" id="email">
                </div>
              </div>
              <div class="form-group">
                <label for="website">Website</label>
                <input type="url" class="form-control" id="website">
              </div>
  
              <div class="form-group">
                <label for="message">Message</label>
                <textarea name="msg" id="message" cols="30" rows="8" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Post Comment" class="btn btn-primary">
              </div>
  
            </form>
          </div> --}}
        </div>
        <div class="col-lg-4">
          <div class="sidebar">
            <div class="sidebar-block">
              <h3 class="sidebar-title">Cari</h3>
              <form action="#" class="search-form">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="pencarian berita ..">
                  <button type="submit" class="btn"><span class="icon mai-search"></span></button>
                </div>
              </form>
            </div>
            <div class="sidebar-block">
              <h3 class="sidebar-title">Kategori</h3>
              <ul class="categories">
                @foreach ($kategori as $ktgr)
                  <li><a href="#">{{ $ktgr->kategori }} <span>{{ $ktgr->postingan_count }}</span></a></li>
                @endforeach
              </ul>
            </div>

            <div class="sidebar-block">
              <h3 class="sidebar-title">Berita Terbaru</h3>
              
              @foreach ($recent as $rc) 
              <div class="blog-item">
                <a class="post-thumb" href="{{ url('blog/details', ['slug' => $rc->slug]) }}">
                  <img src="{{ asset('') }}files/gambar_postingan/banner/{{ $rc->gambar }}" alt="">
                </a>
                <div class="content">
                  <h5 class="post-title"><a href="{{ url('blog/details', ['slug' => $rc->slug]) }}">{{ $rc->judul }}</a></h5>
                  <div class="meta">
                    <a href="#"><span class="mai-calendar"></span> July 12, 2024</a>
                    <a href="#"><span class="mai-person"></span> Admin</a>
                  </div>
                </div>
              </div>
              @endforeach
              
            </div>
          </div>
        </div> 
      </div> <!-- .row -->
      @endforeach
    </div> <!-- .container -->
  </div> <!-- .page-section -->
  @endsection