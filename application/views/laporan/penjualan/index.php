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
    .table-penjualan {
        max-width: 100%;
        overflow-y: hidden;
        overflow-x: scroll;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #E9ECEF;
        border-radius: 4px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #3E5569;
        line-height: 33px;
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 35px;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 32.5px;
        position: absolute;
        top: 1px;
        right: 1px;
        width: 20px;
    }
    </style>
</head>

<body>
    <div class="all">
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
                            <h2 class="page-title">Shift</h2>
                        </div>
                        <div class="col-6 ">
                            <div class="btn-group float-end w-25">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Export
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Detail Shift</a></li>
                                    <li><a class="dropdown-item" href="#">Export Items</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-5 mt-4">
                            <?php
                                $options = array();
                                foreach($toko as $toko) {
                                    $options[$toko->id] = $toko->nama_toko;
                                }
                                echo form_dropdown('', $options, '', 'class="form-select w-50 select2" id="toko"');
                            ?>
                        </div>
                    </div>
                </div>
                <!-- <a href="<?php echo base_url('penjualan/tes')?>" class="myLink">Pindah Halaman</a>
                <div id="contentContainer">Konten akan dimuat di sini</div> -->
                <div class="container-fluid row ms-0">
                    <div class="nav flex-column nav-pills col-3" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <button class="nav-link text-start active" id="v-pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                            aria-selected="true">Ringkasan Penjualan</button>
                        <button class="nav-link text-start" id="v-pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                            aria-selected="false">Laba Kotor</button>
                        <button class="nav-link text-start" id="metode-pembayaran-tab" data-bs-toggle="pill"
                            data-bs-target="#metode-pembayaran" type="button" role="tab"
                            aria-controls="metode-pembayaran" aria-selected="false">Metode Pembayaran</button>
                        <button class="nav-link text-start" id="v-pills-tipe-penjualan-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-tipe-penjualan" type="button" role="tab"
                            aria-controls="v-pills-tipe-penjualan" aria-selected="false">Tipe Penjualan</button>
                        <button class="nav-link text-start" id="v-pills-penjualan-barang-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-penjualan-barang" type="button" role="tab"
                            aria-controls="v-pills-penjualan-barang" aria-selected="false">Penjualan Barang</button>
                        <button class="nav-link text-start" id="v-pills-penjualan-kategori-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-penjualan-kategori" type="button" role="tab"
                            aria-controls="v-pills-penjualan-kategori" aria-selected="false">Penjualan Kategori</button>
                        <button class="nav-link text-start" id="v-pills-penjualan-merek-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-penjualan-merek" type="button" role="tab"
                            aria-controls="v-pills-penjualan-merek" aria-selected="false">Penjualan Merek</button>
                        <button class="nav-link text-start" id="v-pills-modifier-sales-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-modifier-sales" type="button" role="tab"
                            aria-controls="v-pills-modifier-sales" aria-selected="false">Modifier Sales</button>
                        <button class="nav-link text-start" id="v-pills-diskon-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-diskon" type="button" role="tab" aria-controls="v-pills-diskon"
                            aria-selected="false">Diskon</button>
                        <button class="nav-link text-start" id="v-pills-pajak-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-pajak" type="button" role="tab" aria-controls="v-pills-pajak"
                            aria-selected="false">Pajak</button>
                        <button class="nav-link text-start" id="v-pills-persen-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-persen" type="button" role="tab" aria-controls="v-pills-persen"
                            aria-selected="false">Persen</button>
                        <button class="nav-link text-start" id="v-pills-dikumpulkan-oleh-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-dikumpulkan-oleh" type="button" role="tab"
                            aria-controls="v-pills-dikumpulkan-oleh" aria-selected="false">Dikumpulkan Oleh</button>
                        <button class="nav-link text-start" id="v-pills-dilayani-oleh-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-dilayani-oleh" type="button" role="tab"
                            aria-controls="v-pills-dilayani-oleh" aria-selected="false">Dilayani Oelh</button>
                    </div>
                    <div class="tab-content col-9" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab" tabindex="0">
                            <?php $this->load->view('laporan/penjualan/tabs/ringkasan_penjualan') ?>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab" tabindex="0">
                            <?php $this->load->view('laporan/penjualan/tabs/laba_kotor') ?>
                        </div>
                        <div class="tab-pane fade" id="metode-pembayaran" role="tabpanel"
                            aria-labelledby="metode-pembayaran-tab" tabindex="0">
                            <?php $this->load->view('laporan/penjualan/tabs/metode_pembayaran') ?>
                        </div>
                        <div class="tab-pane fade" id="v-pills-tipe-penjualan" role="tabpanel"
                            aria-labelledby="v-pills-tipe-penjualan-tab" tabindex="0">
                            <?php $this->load->view('laporan/penjualan/tabs/tipe_penjualan') ?>
                        </div>
                        <div class="tab-pane fade" id="v-pills-penjualan-barang" role="tabpanel"
                            aria-labelledby="v-pills-penjualan-barang-tab" tabindex="0">
                            <?php $this->load->view('laporan/penjualan/tabs/penjualan_barang') ?>
                        </div>
                        <div class="tab-pane fade" id="v-pills-penjualan-kategori" role="tabpanel"
                            aria-labelledby="v-pills-penjualan-kategori-tab" tabindex="0">
                            <?php $this->load->view('laporan/penjualan/tabs/penjualan_kategori') ?>
                        </div>
                        <div class="tab-pane fade" id="v-pills-penjualan-merek" role="tabpanel"
                            aria-labelledby="v-pills-penjualan-merek-tab" tabindex="0">
                            <?php $this->load->view('laporan/penjualan/tabs/penjualan_merek') ?>
                        </div>
                        <div class="tab-pane fade" id="v-pills-modifier-sales" role="tabpanel"
                            aria-labelledby="v-pills-modifier-sales-tab" tabindex="0">
                            ...
                        </div>
                        <div class="tab-pane fade" id="v-pills-diskon" role="tabpanel"
                            aria-labelledby="v-pills-diskon-tab" tabindex="0">
                            <?php $this->load->view('laporan/penjualan/tabs/diskon') ?>
                        </div>
                        <div class="tab-pane fade" id="v-pills-pajak" role="tabpanel"
                            aria-labelledby="v-pills-pajak-tab" tabindex="0">
                            ...
                        </div>
                        <div class="tab-pane fade" id="v-pills-persen" role="tabpanel"
                            aria-labelledby="v-pills-persen-tab" tabindex="0">
                            ...
                        </div>
                        <div class="tab-pane fade" id="v-pills-dikumpulkan-oleh" role="tabpanel"
                            aria-labelledby="v-pills-dikumpulkan-oleh-tab" tabindex="0">
                            <?php $this->load->view('laporan/penjualan/tabs/dikumpulkan_oleh') ?>
                        </div>
                        <div class="tab-pane fade" id="v-pills-dilayani-oleh" role="tabpanel"
                            aria-labelledby="v-pills-dilayani-oleh-tab" tabindex="0">
                            <?php $this->load->view('laporan/penjualan/tabs/dilayani_oleh') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('style/js') ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.myLink').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah perilaku default
                var url = this.getAttribute('href');
                var title = this.innerText;
                loadPage(url, title);
            });
        });
    });

    function loadPage(url, title) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('contentContainer').innerHTML = data;
                history.pushState({
                    url: url
                }, title, url); // Mengubah URL tanpa me-reload halaman
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Fungsi ini akan dijalankan ketika tombol "Back" atau "Forward" pada browser diklik
    window.addEventListener('popstate', function(event) {
        var state = event.state;
        if (state) {
            loadPage(state.url, '');
        }
    });
    </script>
</body>

</html>