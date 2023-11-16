<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $this->load->view('style/head') ?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, xtreme admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, material design, material dashboard bootstrap 5 dashboard template" />
    <meta name="description"
        content="Xtreme is powerful and clean admin dashboard template, inpired from Google's Material Design" />
    <meta name="robots" content="noindex,nofollow" />
    <title>POS</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('package/assets/images/logo-pos.png')?>" />
    <style>
    .cursor-pointer {
        cursor: pointer;
    }
    </style>
</head>

<body>
    <div class="all">
        <?php echo form_open_multipart('') ?>
        <div class="preloader">
            <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z"
                    stroke="#2962FF" stroke-width="2"></path>
                <path
                    d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34"
                    stroke="#2962FF" stroke-width="2"></path>
                <path id="teabag" fill="#2962FF" fill-rule="evenodd" clip-rule="evenodd"
                    d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z">
                </path>
                <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" stroke="#2962FF"></path>
                <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#2962FF"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
        <div id="main-wrapper">
            <?php $this->load->view('style/navbar') ?>
            <?php $this->load->view('style/sidebar') ?>
            <div class="page-wrapper" style="min-height: 100vh; background-color: white;">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-6 align-self-center">
                            <h2 class="page-title">Detail Pesanan</h2>
                        </div>
                    </div>
                </div>
                <div class="container-fluid row">
                    <div class="col-12 scroll">
                        <div class="container-fluid">
                            <div class="mt-4 px-2">
                                <div class="row px-2">
                                    <div class="mb-n1 col-6">
                                        <h5>Detail Pembayaran Pesanan</h5>
                                    </div>
                                    <div class="col-6">
                                        <?php if ( $status === 'menunggu' ) : ?>
                                        <div class="bg-warning text-center text-white float-end rounded-pill px-2">
                                            Menunggu
                                        </div>
                                        <?php elseif ( $status === 'dibatalkan' ) : ?>
                                        <div class="bg-danger text-center text-white float-end rounded-pill px-2">
                                            Dibatalkan
                                        </div>
                                        <?php else : ?>
                                        <div class="bg-success text-center text-white float-end rounded-pill px-2">
                                            Selesai
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <hr>
                                    <div class="col-12 row mt-3">
                                        <div class="col-3">Nama Toko</div>
                                        <div class="col-9">Tembalang - Bakpia&Bolu Tugu Jogja</div>
                                    </div>
                                    <div class="col-12 row mt-3">
                                        <div class="col-3">Nomer Pesanan</div>
                                        <div class="col-9">#16878285668</div>
                                    </div>
                                    <?php if ( $status === 'menunggu' ) : ?>
                                    <div class="col-12 row mt-3">
                                        <div class="col-3">Catatan</div>
                                        <div class="col-9">
                                            <?php echo form_textarea('', '', 'class="form-control" id="catatan" autocomplete="off" placeholder="Catatan" required style="height: 70px;"') ?>
                                        </div>
                                    </div>
                                    <?php else : ?>
                                    <?php endif; ?>
                                    <hr class="mt-2">
                                    <h5>Pembayaran Pesanan</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th class="text-center">Srok</th>
                                                <th class="text-center">Kuantitas</th>
                                                <th class="text-center">Biaya Satuan</th>
                                                <th class="text-end" style="padding-right: 30px;">Biaya Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Tahu Baxo Bu Pudji Frozen</th>
                                                <td class="text-center">10</td>
                                                <td class="text-center">22</td>
                                                <td class="text-center">Rp. 42.000</td>
                                                <td class="text-end" style="padding-right: 30px;">Rp. 924.000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="col-12 row mt-1">
                                        <h5 class="col-6 px-3">TOTAL</h5>
                                        <div class="col-6 text-end">Rp. 924.000</div>
                                    </div>
                                    <hr class="mt-2">
                                    <h5>Log Riwayat</h5>
                                    <p>Kamis, 22 juni 2023</p>
                                    <ul class="ms-3">
                                        <?php if ( $status === 'menunggu' ) : ?>
                                        <li class="mt-2">12:01 <span class="ms-2 fw-bold">Doni Johanes</span> Membuat
                                            pesanan pembelian
                                        </li>
                                        <?php elseif ( $status === 'dibatalkan' ) : ?>
                                        <li class="mt-2">12:01 <span class="ms-2 fw-bold">Doni Johanes</span>
                                            Membatalkan pesanan pembelian
                                        </li>
                                        <?php else : ?>
                                        <li>12:01 <span class="ms-2 fw-bold">Doni Johanes</span> Memenuhi
                                            dan menyelesaikan pesanan pembelian
                                            <span class="cursor-pointer text-primary text-decoration-underline"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                (Detail Riwayat)
                                            </span>
                                        </li>
                                        <li class="mt-2">12:01 <span class="ms-2 fw-bold">Doni Johanes</span> Membuat
                                            pesanan pembelian
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        Detail Riwayat
                                                    </h1>
                                                </div>
                                                <div class="modal-body">
                                                    <h6 class="ms-3">Pembayaran Pesanan #16878285668</h6>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama</th>
                                                                <th>Kuantitas</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th>Ori Coklat Traveler Pack (TP)</th>
                                                                <td>8</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex m-3 float-end">
                                <button onClick="kembali()" class="btn btn-primary mx-1">
                                    Kembali
                                </button>
                                <?php if ( $status === 'menunggu' ) : ?>
                                <button class="btn btn-primary mx-1">
                                    Tandai Sebagai Terpenuhi
                                </button>
                                <div class="dropdown mx-1">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Ubah</a></li>
                                        <li><a class="dropdown-item" href="#">Batalkan Pensanan</a></li>
                                    </ul>
                                </div>
                                <?php else : ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <?php $this->load->view('style/js') ?>
    <script>
    function kembali() {
        window.history.go(-1);
    }
    </script>
</body>

</html>