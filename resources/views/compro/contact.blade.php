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

            <form class="contact-form mt-5" id="contactForm" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" id="nama" class="form-control" placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" id="email" class="form-control" placeholder="Masukkan email">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            No. Telepon <span class="text-danger">*</span>
                        </label>
                        <input type="tel" id="no_telepon" name="no_telepon" class="form-control"
                            placeholder="08xxxxxxxxxx" inputmode="numeric" pattern="^0[0-9]{9,14}$" maxlength="15" required>
                        <small class="text-muted">
                            Contoh: 081234567890
                        </small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rating <span class="text-danger">*</span></label>
                        <select id="rating" class="form-control">
                            <option value="">Pilih Rating</option>
                            <option value="5">⭐⭐⭐⭐⭐ Sangat Baik</option>
                            <option value="4">⭐⭐⭐⭐ Baik</option>
                            <option value="3">⭐⭐⭐ Cukup</option>
                            <option value="2">⭐⭐ Kurang</option>
                            <option value="1">⭐ Sangat Kurang</option>
                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Kritik & Saran <span class="text-danger">*</span></label>
                        <textarea id="kritik_saran" rows="6" class="form-control" placeholder="Tuliskan kritik dan saran Anda..."></textarea>
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label">Upload Foto (Opsional)</label>
                        <input type="file" id="gambar" name="gambar[]" class="form-control" accept="image/*" multiple>

                        <small class="text-muted">
                            Format: JPG, JPEG, PNG. Maksimal 2 MB per file.
                        </small>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary px-5">
                            <i class="fa fa-paper-plane"></i> Kirim Kritik & Saran
                        </button>
                    </div>

                </div>
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
        $(function() {

            $('#contactForm').submit(function(e) {
                e.preventDefault();

                let formData = new FormData();

                formData.append('nama', $('#nama').val());
                formData.append('email', $('#email').val());
                formData.append('no_telepon', $('#no_telepon').val());
                formData.append('rating', $('#rating').val());
                formData.append('kritik_saran', $('#kritik_saran').val());

                let files = $('#gambar')[0].files;

                for (let i = 0; i < files.length; i++) {
                    formData.append('gambar[]', files[i]);
                }

                formData.append('_token', '{{ csrf_token() }}');

                if (
                    $('#nama').val() == '' ||
                    $('#email').val() == '' ||
                    $('#no_telepon').val() == '' ||
                    $('#rating').val() == '' ||
                    $('#kritik_saran').val() == ''
                ) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Mohon lengkapi semua data yang wajib diisi.'
                    });
                    return;
                }

                $.ajax({
                    url: '{{ route('contact.submit') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Terima Kasih',
                            text: 'Kritik dan saran Anda berhasil dikirim.'
                        });

                        $('#contactForm')[0].reset();
                    },

                    error: function(xhr) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat mengirim data.'
                        });

                    }
                });

            });

        });
    </script>
@endsection
