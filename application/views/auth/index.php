<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->load->view('style/head') ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Taman Lele </title>
    <link rel="icon" type="image/png" href="<?php echo base_url('package/assets/images/logo-pos.png')?>" />
</head>

<body>
    <div class="main-wrapper">
    <!-- Preloader -->
      <!-- -------------------------------------------------------------- -->
      <div class="preloader">
        <svg
          class="tea lds-ripple"
          width="37"
          height="48"
          viewbox="0 0 37 48"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z"
            stroke="#2962FF"
            stroke-width="2"
          ></path>
          <path
            d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34"
            stroke="#2962FF"
            stroke-width="2"
          ></path>
          <path
            id="teabag"
            fill="#2962FF"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"
          ></path>
          <path
            id="steamL"
            d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke="#2962FF"
          ></path>
          <path
            id="steamR"
            d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13"
            stroke="#2962FF"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          ></path>
        </svg>
      </div>
      <!-- -------------------------------------------------------------- -->
    <!-- Preloader -->
    <!-- Auth -->
      <div class="row auth-wrapper gx-0">
        <div class="col-lg-4 col-xl-3 auth-box-2 on-sidebar" style="background-color: #10323E;">
          <div class="h-100 d-flex align-items-center justify-content-center" >
            <div class="row justify-content-center text-center" >
              <div class="col-md-7 col-lg-12 col-xl-9" >
                <div>
                  <span class="db"
                    ><img src="<?php echo base_url('package/assets/images/logo-pos.png')?>" alt="Logo Pos"
                        width="150px" /></span>
                </div>
                <h2 class="text-white mt-4 fw-light">
                 <span class="font-medium">Digital</span> Absensi
                </h2>
                <p class="op-5 text-white fs-4 mt-4">
                  Membuat Absensi Terstrukur, Efisien, Dan Transparan
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-xl-9 d-flex align-items-center justify-content-center">
          <div class="row justify-content-center w-100 mt-4 mt-lg-0">
            <div class="col-lg-6 col-xl-3 col-md-7">
            <!-- Register -->
              <div class="card" id="registerform">
                <div class="card-body">
                  <h2>Buat Akun Baru</h2>
                  <p class="text-muted fs-4">Isi Form Dengan Benar Untuk Membuat Akun Baru.</p>
                  <?php echo form_open('auth/register', 'class="form-horizontal mt-4 pt-4 needs-validation" novalidate'); ?>
                    <div class="form-floating mb-3">
                      <?php echo form_input($username, '', 'class="form-control form-input-bg" id="tb-rfname" placeholder=" " required') ?>
                      <label for="tb-rfname">Nama</label>
                      <div class="invalid-feedback">Nama Belum Di isi</div>
                    </div>
                    <div class="form-floating mb-3">
                      <?php echo form_input($email, '', 'class="form-control form-input-bg" id="tb-remail" placeholder=" " required') ?>
                      <label for="tb-remail">Email</label>
                      <div class="invalid-feedback">Email Salah/Tidak Sesuai</div>
                    </div>
                    <div class="form-floating mb-3">
                      <?php echo form_input($password, '', 'class="form-control form-input-bg" id="text-rpassword" placeholder=" " required') ?>
                      <label for="text-rpassword">Password</label>
                      <div class="invalid-feedback">Password Belum Di Isi</div>
                    </div>
                   
                    <div class="d-flex justify-content-center button-group">
                      <button type="submit" class="btn btn-info btn-lg px-4" style="width: 100%">Konfirmasi</button>
                      <a
                        href="javascript:void(0)"
                        id="to-login"
                        class="btn btn-lg btn-light-secondary text-secondary font-medium" style="width: 100%"
                        >Batal</a
                      >
                    </div>
                  <?php echo form_close(); ?>
                </div>
              </div>
            <!-- Login -->
              <div class="card" id="loginform">
                <div class="card-body">
                  <h2>Selamat Datang</h2>
                  <p class="text-muted fs-4">
                    Masukan Email Admin & Password Admin
                    <!-- <a href="javascript:void(0)" id="to-register">Buat Akun Disini</a> -->
                  </p>
                  <?php echo form_open('auth/login', 'class="form-horizontal mt-2 pt-2 needs-validation" novalidate'); ?>
                    <div class="form-floating mb-3">
                      <?php echo form_input($email, '', 'class="form-control form-input-bg" id="tb-email" placeholder=" " required') ?>
                      <label for="tb-email">Email</label>
                      <div class="invalid-feedback">Email Salah/Tidak Sesuai</div>
                    </div>

                    <div class="form-floating mb-3">
                      <?php echo form_input($password, '', 'class="form-control form-input-bg" id="text-password" placeholder=" " required') ?>
                      <label for="text-password">Password</label>
                      <div class="invalid-feedback">Password Minimal 3 Huruf</div>
                    </div>
                    <div class="d-flex justify-content-center mt-4 pt-2">
                      <button type="submit" class="btn btn-info px-4 btn-lg" style="width: 100%">Masuk</button>
                    </div>
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php $this->load->view('style/js') ?>
    <script>
      $('#to-register').on('click', function () {
      $('#loginform').hide();
      $('#registerform').fadeIn();
    });
      $('#to-login').on('click', function () {
      $('#loginform').fadeIn();
      $('#registerform').hide();
    });

    (function () {
      'use strict';

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation');

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener(
          'submit',
          function (event) {
            if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
            }

            form.classList.add('was-validated');
          },
          false,
        );
      });
    })();
    </script>
</body>

</html>