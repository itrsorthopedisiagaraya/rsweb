<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign-up || RS. ORTHOPEDI SIAGA RAYA</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="{{ asset('') }}assets/css/styles.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-10">
            <div class="card my-4">
              <div class="card-body">
                <a href="{{ route('home') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="{{ asset('assets') }}/images/logos/favicon.png" width="80" alt=""><br>
                  <img src="{{ asset('assets') }}/images/logos/logo-name.png" width="200" alt="">
                </a>
                <hr>
                <form id="form_register" action="{{ route('daftar') }}" method="POST">
                  @csrf
                  <div class="row">

                    <div class="col-sm-4">
                      <div class="mb-3">
                        <div class="form-group">
                          <label for="nama" class="form-label">Nama Lengkap <strong style="color: red;">*</strong></label>
                          <input type="text" class="form-control" data-name="Nama" id="nama" name="nama" aria-describedby="textHelp">
                          <small id="validate_nama"></small>
                        </div>

                        <div class="form-group mt-4">
                          <label for="status" class="form-label">Status Perkawinan <strong style="color: red;">*</strong></label>
                          <select name="status" data-name="Status" id="status" class="form-control select2">
                            <option value="">Pilih Status</option>
                            <option value="single">Belum Menikah (Single)</option>
                            <option value="menikah">Sudah Menikah</option>
                            <option value="janda">Janda</option>
                            <option value="duda">Duda</option>
                          </select>
                        </div>

                        <div class="form-group mt-3">
                          <div class="mb-4">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <div class="d-flex mt-2">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="jk" id="L" value="L">
                                <label class="form-check-label" for="L">Laki-laki &emsp;</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="jk" id="P" value="P">
                                <label class="form-check-label" for="P">Perempuan</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <div class="mb-3">
                          <label for="exampleInputtext1" class="form-label">Nama Ayah / Suami <strong style="color: red;">*</strong></label>
                          <input type="text" class="form-control" data-name="Nama ayah/suami" name="ayah" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                      </div>

                      <div class="form-group mt-3">
                        <div class="mb-3">
                          <label for="tgl_lahir" class="form-label">Tanggal Lahir <strong style="color: red;">*</strong></label>
                          <input type="text" id="tgl_lahir" data-name="Tanggal lahir" name="tgl_lahir" class="form-control date">
                        </div>
                      </div>

                      <div class="form-group mt-4">
                        <div class="mb-3">
                        <label for="pendidikan" class="form-label">Pendidikan <strong style="color: red;">*</strong></label>
                          <select name="pendidikan" data-name="Pendidikan" id="pendidikan" class="form-control select2">
                            <option value="">Pilih Pendidikan</option>
                            <option value="sarjana">Sarjana</option>
                            <option value="sma">SMA/SMK</option>
                            <option value="smp">SMP</option>
                            <option value="sd">SD</option>
                            <option value="tidak_sekolah">Tidak Sekolah</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <div class="mb-4">
                          <label for="jk" class="form-label">Nama Ibu / Istri <strong style="color: red;">*</strong></label>
                          <input type="text" data-name="Nama ibu/istri" class="form-control" name="ibu">
                        </div>
                      </div>

                      <div class="form-group mt-3">
                        <div class="mb-3">
                          <label for="agama" class="form-label">Agama <strong style="color: red;">*</strong></label>
                          <select name="agama" id="agama" data-name="Agama" class="form-control select2">
                            <option value="">Pilih Agama</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="hindu">Hindu</option>
                            <option value="katolik">Katolik</option>
                            <option value="budha">Budha</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group mt-3">
                          <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan <strong style="color: red;">*</strong></label>
                            <input type="text" data-name="Pekerjaan" class="form-control" name="pekerjaan">
                          </div>
                      </div>
                    </div>

                    <div class="col-sm-8">
                      <div class="form-group">
                        <div class="mb-3">
                          <label for="alamat" class="form-label">Alamat Lengkap <strong style="color: red;">*</strong></label>
                          <textarea class="form-control" data-name="Alamat" name="alamat" id="alamat" cols="30" rows="10"></textarea>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <div class="mb-3">
                          <label for="no_hp" class="form-label">Nomor Telp/HP <strong style="color: red;">*</strong></label>
                          <input type="text" data-name="No. telp/hp" class="form-control" name="no_hp">
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="mb-3">
                          <label for="klinik" class="form-label">Klinik yang di tuju</label>
                          <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="klinik_tujuan" id="umum" value="umum">
                                <label class="form-check-label" for="umum">
                                    Umum
                                </label>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="klinik_tujuan" id="gigi" value="gigi">
                                <label class="form-check-label" for="gigi">
                                    Gigi
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="klinik_tujuan" id="spesialis" value="spesialis">
                                <label class="form-check-label" for="spesialis">
                                    Spesialis
                                </label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group mt-3">
                        <div class="mb-4">
                          <label for="warganegara" class="form-label">Kewarganegaraan</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="warganegara" id="wni" value="wni">
                                <label class="form-check-label" for="wni">
                                    WNI
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="warganegara" id="wna" value="wna">
                                <label class="form-check-label" for="wna">
                                    WNA
                                </label>
                            </div>
                          </div>
                        </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="mb-3">
                        <label for="username" class="form-label">Username <strong style="color: red;">*</strong></label>
                        <input type="text" class="form-control" data-name="Username" id="username" disabled="disabled">
                        <input type="text" data-name="Username" name="username" hidden>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="mb-3">
                        <label for="email" class="form-label">Email Address <strong style="color: red;">*</strong></label>
                        <input type="email" class="form-control" data-name="Email" id="email" name="email" aria-describedby="emailHelp">
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="mb-4">
                        <label for="pw1" class="form-label">Password <strong style="color: red;">*</strong></label>
                        <input type="password" class="form-control" data-name="Password" name="password1" id="pw1">
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="mb-4">
                        <label for="pw2" class="form-label">Confirm Password <strong style="color: red;">*</strong></label>
                        <input type="password" class="form-control" data-name="Confirm password" name="password2" id="pw2">
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign Up</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Sign In</a>
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
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="https://unpkg.com/validator.tool/dist/validator.min.js"></script>
  <script>
    var validator = new Validator({
      form: document.getElementById('form_register'),
      rules: {
        email: {
          validate: (val) => val ? '' : 'Required!',
        },
        password1: {
          // validate: (val) => val < 5 || val > 15 ? '字数大于5，小于15' : ''
        },
        password2: {
          validate: (val) => !val ? 'Required!' : '',
        },
      }
    });

    validator.form.onsubmit = (evn) => {
      const values = validator.getValues();
      const form = document.getElementById('form_register')
      const elements = form.elements;
      const emptyElements = [];

      const existingSmallElements = document.querySelectorAll('small');
      existingSmallElements.forEach(element => {
        element.remove();
      });

      for (let i = 0; i < elements.length; i++) {
        const element = elements[i];
        const elName = elements[i].dataset.name;
        var smallElement = document.createElement('small');
        // Periksa jika elemen memiliki nilai kosong
        if (element.value.trim() === '') {
          evn.preventDefault();
          // Menambahkan teks ke dalam elemen <small>
          var smallText = document.createTextNode(`${elName} tidak boleh kosong!`);
          smallElement.appendChild(smallText);
          smallElement.style.color = 'red';
          smallElement.style.fontSize = '11px';
          if (element.tagName === 'INPUT' && !element.hasAttribute('disabled')) {
            element.after(smallElement);
          } else if(element.tagName === 'SELECT') {
            element.nextElementSibling.after(smallElement);
          }
        }
      }

      // Cek apakah masih ada pesan kesalahan
      const errorMessages = form.querySelectorAll('small');
      if (errorMessages.length === 0) {
        form.submit();
      }
    }


    $(document).ready(function() {
      $('.select2').select2({
        width: '100%'
      });
      
      $('.date').datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        yearRange: '-50:+10'
      });

      $('#nama').on('change', function(e) {
        let val = $(this).val();
        let first_name = val.split(' ');
        let randomNumber = Math.floor(Math.random() * (9999 - 1000 + 1)) + 1000;
        let username = first_name[0].toLowerCase() + randomNumber;

        $('#username').val(username);
        $('input[name=username]').val(username);
      });
    });
  </script>
</body>

</html>