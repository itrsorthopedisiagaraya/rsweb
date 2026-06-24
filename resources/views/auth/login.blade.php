<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Halaman Login | RS Ortopedi</title>
  {{-- <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" /> --}}
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>
<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="{{ route('home') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="{{ asset('assets') }}/images/logos/favicon.png" width="80" alt=""><br>
                  <img src="{{ asset('assets') }}/images/logos/logo-name.png" width="250" alt="">
                </a>
                <form class="form-login" id="form-login" method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">
                    <small class="error text-danger" id="username-error"></small>
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <small class="error text-danger" id="password-error"></small>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">Buat Akun</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
  <script>
    @if(session('auth') == 'fail')
      Swal.fire({
        title: 'Login gagal!',
        text: '{{ session("message") }}',
        icon: 'error',
        confirmButtonText: 'oke'
      });
    @endif

    $(document).ready(function() {
      $('#form-login').submit(function(e) {
        e.preventDefault();
        
        var formData = {
          username: $('#username').val(),
          password: $('#password').val(),
        }

        var constraints = {
          username: {
            presence: {
              allowEmpty: false,
              message: "tidak boleh kosong!"
            }
          },
          password: {
            presence: {
              allowEmpty: false,
              message: "tidak boleh kosong!"
            },
            length: {
              minimum: 5,
              message: "minimal 5 karakter."
            }
          }
        }

        var errors = validate(formData, constraints);

        if (errors) {
          // Menampilkan pesan kesalahan
          $.each(errors, function(key, value) {
            $('#' + key + '-error').text(value[0]);
          });
        } else {
          // Menonaktifkan event handler submit sementara, kemudian submit form
          $('#form-login').off('submit').submit();
        }
      });

    });
  </script>
</body>

</html>