@extends('compro.layouts.app')
@section('content')
    <div class="page-banner overlay-dark bg-image"
        style="background-image: url({{ asset('') }}assets-compro/assets/img/banner/banner-1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kontak</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Kontak Kami</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section">
        <div class="container">
            <h1 class="text-center wow fadeInUp">Tinggalkan pesan</h1>

            <form class="contact-form mt-5" action="" method="POST" id="contactForm">
                <div class="row mb-3">
                    <div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" class="form-control" placeholder="Nama Lengkap..">
                    </div>
                    <div class="col-sm-6 py-2 wow fadeInRight">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Alamat Email..">
                    </div>
                    <div class="col-12 py-2 wow fadeInUp">
                        <label for="subjek">Subject</label>
                        <input type="text" id="subjek" class="form-control" placeholder="Masukan subject..">
                    </div>
                    <div class="col-12 py-2 wow fadeInUp">
                        <label for="pesan">Pesan</label>
                        <textarea id="pesan" class="form-control" rows="10" placeholder="Masukan Pesan.."></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary wow zoomIn">Kirim Pesan</button>
            </form>
        </div>
    </div>

    <div class="maps-container wow fadeInUp">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4112.909572100522!2d106.83654255262597!3d-6.272877754185715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f23929c17f43%3A0x672394ffa132df85!2sRumah%20Sakit%20Orthopedi%20SIAGA%20RAYA!5e0!3m2!1sid!2sid!4v1707295343465!5m2!1sid!2sid"
            style="width: 100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('#contactForm').submit(function(e) {
                e.preventDefault();

                // Get form values
                var name = $('#nama').val();
                var email = $('#email').val();
                var subject = $('#subjek').val();
                var message = $('#pesan').val();

                // Perform validation (you can add more validation as needed)
                if (name === '' || email === '' || subject === '' || message === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Please fill in all fields.'
                    });
                    return;
                }

                // Send the form data to the server using AJAX
                $.ajax({
                    url: '{{ route('contact.submit') }}', // Replace with your route for handling form submission
                    method: 'POST',
                    data: {
                        nama: name,
                        email: email,
                        subjek: subject,
                        pesan: message,
                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Terimakasih, Pesan anda telah berhasil dikirim.'
                        });
                        $('#contactForm')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.'
                        });
                    }
                });
            });
        });
    </script>
@endsection
