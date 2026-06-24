@extends('compro.layouts.app')
@section('content')
  <div class="page-banner overlay-dark bg-image" style="background-image: url({{ asset('') }}assets-compro/assets/img/banner/banner-1.jpg);">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Beranda</a></li>
            <li class="breadcrumb-item" aria-current="page">About</li>
            <li class="breadcrumb-item active" aria-current="page">Sambutan</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">Sambutan Direktur</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="container my-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <p class="text-justify text-primary" style="font-weight: 600;">Assalamualaikum Wr. Wb. <br>
                        Puji syukur kami panjatkan ke hadirat Allah SWT, karena atas berkat dan rahmatNya, website Rumah Sakit Orthopedi Siaga Raya dapat terbit sebagai wujud kami untuk terus meningkatkan kualitas layanan dan memudahkan akses informasi bagi pasien dan keluarga. <br>
                        Di era digital ini, keberadaan website menjadi sangat penting bagi sebuah rumah sakit. Website RS Orthopedi Siaga Raya hadir untuk memberikan informasi yang lengkap dan akurat tentang layanan kesehatan yang kami tawarkan kepada masyarakat.<br>
                        Kami memahami bahwa kebutuhan masyarakat akan informasi yang semakin kritis dan informatif. Oleh karena itu, RS Orthopedi Siaga Raya terus melakukan upaya tiada henti di segala bidang untuk memenuhi kebutuhan tersebut. Berkat kerjasama dari seluruh jajaran tenaga medis dan non medis, RS Orthopedi Siaga Raya mampu berkiprah selama 33 tahun dalam memberikan layanan kesehatan 
                        Kami berkomitmen untuk terus meningkatkan kualitas layanan kami. Upaya ini dilakukan dengan meningkatkan sumber daya manusia dan ditunjang oleh peralatan modern. Kami ingin memastikan bahwa RS Orthopedi Siaga Raya dapat terus memenuhi kebutuhan masyarakat yang semakin tinggi seiring dengan perkembangan dunia kesehatan saat ini
                        Kami berterima kasih atas kepercayaan Anda menggunakan jasa pelayanan Rumah Sakit Siaga Raya, Kritik dan saran anda untuk perbaikan pelayanan rumah sakit kedepan sangat dibutuhkan. Kami berharap website ini dapat menjadi sumber informasi yang bermanfaat bagi Anda semua, serta membantu kami dalam memberikan pelayanan yang lebih baik dan terpercaya. Terima kasih atas dukungan dan kepercayaan Anda kepada RS Orthopedi Siaga Raya
                        <br>Wassalamu’alaikum. Wr. Wb.
                        <br>
                        <br>Direktur RS Orthopedi Siaga Raya
                        <br>Dr. Nurhayati, MARS.
                        </p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('') }}files\gambar_sambutan\gambar.jpeg" alt="sambutan" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection