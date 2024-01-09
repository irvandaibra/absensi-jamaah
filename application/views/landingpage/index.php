<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <?php $this->load->view('style/head') ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Absenss</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Custom Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
            <div class="container px-5">
                <a class="navbar-brand" href="index.html"><span class="fw-bolder text-primary">Absenss</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('auth')?>">Login Admin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="py-5">
            <div class="container px-5 pb-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-xxl-5">
                        <!-- Header text content-->
                        <div class="text-center text-xl-start">
                            <div class="fs-3 fw-light text-muted">Web Presensi Digital</div>
                            <h5 class="display-5 fw-bolder mb-5"><span class="text-gradient d-inline">Absensi Kelompok
                                    Taman Lele</span></h5>
                            <div class="col-xxl-7">
                                <!-- Header profile picture-->
                                <div class="d-flex justify-content-center mb-5 mt-5 mt-xxl-0">
                                    <div class="profile bg-gradient-primary-to-secondary">
                                        <!-- TIP: For best results, use a photo with a transparent background like the demo example below-->
                                        <!-- Watch a tutorial on how to do this on YouTube (link)-->
                                        <img src="<?php echo base_url('package/assets/images/logo-pos.png')?>"
                                            alt="Logo Pos" width="150px" />
                                    </div>
                                </div>
                            </div>
                            <form method="get" action="<?= base_url('landingpage/user_index'); ?>">
                                <div
                                    class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start mb-3">
                                    <div class="form-floating">
                                        <input type="text" name="code_unik"
                                            class="form-control form-control-lg border border-success"
                                            placeholder="Username" />
                                        <label><i data-feather="user"
                                                class="feather-sm text-success fill-white me-2"></i><span
                                                class="border-start border-success ps-3">Masukan Kode
                                                Unik</span></label>
                                    </div>
                                    <button type="submit" class="btn btn-info font-medium rounded-pill px-4">
                                        Cari
                                </div>
                                </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </header>
        <!-- About Section-->
        <section class="bg-light py-5">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-xxl-8">
                        <div class="text-center my-5">
                            <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">Tentang</span></h2>
                            <p class="lead fw-light mb-4">Mengelola Absens Jamaah Dalam Pengajian Rutin</p>
                            <p class="text-muted">Demi kelancaran sambung jamaah yang ada di kelompok ini
                                Memudahkan pengurus dalam mengatur jamaah nya
                                Jamaah bisa meningkatkan kehadiran nya
                                Untuk data absensi bisa lebih terstruktur dan jelas transparan agar nanti nya bisa
                                membantu evaluasi
                                Memudahkan dalam laporan absensi dan pemantauan
                            </p>
                            <div class="d-flex justify-content-center fs-2 gap-4">
                                <a class="text-gradient" href="#!"><i class="bi bi-twitter"></i></a>
                                <a class="text-gradient" href="#!"><i class="bi bi-linkedin"></i></a>
                                <a class="text-gradient" href="#!"><i class="bi bi-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer-->
    <footer class="bg-white py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0">Copyright &copy; Your Website 2023</div>
                </div>
                <div class="col-auto">
                    <a class="small" href="#!">Privacy</a>
                    <span class="mx-1">&middot;</span>
                    <a class="small" href="#!">Terms</a>
                    <span class="mx-1">&middot;</span>
                    <a class="small" href="#!">Contact</a>
                </div>
            </div>
        </div>
    </footer>
    <?php $this->load->view('style/js') ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>