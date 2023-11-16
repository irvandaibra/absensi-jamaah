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
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .cursor-pointer-col {
        cursor: pointer;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .cursor-pointer-col::before {
        font-family: 'FontAwesome';
        content: "\f068";
        float: left;
        margin-right: 5px;
    }

    .cursor-pointer-col.collapsed::before {
        content: "\f067";
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
                            <h2 class="page-title">Detail Shift</h2>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="mb-n3">INFO</h5>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="mb-n3 col-6 px-3">Nama</div>
                                <div class="mb-n3 col-6 px-3 text-end"><?php echo Karyawan_ByShift($shift['id'], 'nama_depan').' '.Karyawan_ByShift($shift['id'], 'nama_belakang')?></div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="mb-n3 col-6 px-3">Akses</div>
                                <div class="mb-n3 col-6 px-3 text-end"><?php echo Toko_ByShift($shift['id'], 'nama_toko')?></div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="mb-n3 col-6 px-3">Waktu Mulai</div>
                                <div class="mb-n3 col-6 px-3 text-end"><?php echo ChangeDateFormat('d M Y h:m', $shift['jam_mulai'])?></div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="mb-n3 col-6 px-3">Waktu Selesai</div>
                                <div class="mb-n3 col-6 px-3 text-end"><?php echo ChangeDateFormat('d M Y h:m', $shift['jam_akhir'])?></div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-12">
                            <h5 class="mb-n3">Detail Order</h5>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="mb-n3 col-6 px-3">Item Terjual</div>
                                <div class="mb-n3 col-6 px-3 text-end cursor-pointer" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">28 <i data-feather="chevron-right"
                                        class="feather-icon mt-n1 ms-n1 text-secondary"
                                        style="width: 18px; height: 18px;"></i></div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="mb-n3 col-6 px-3">Item Dikembalikan</div>
                                <div class="mb-n3 col-6 px-3 text-end">0</div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="row shadow rounded p-3 mb-5">
                        <div class="col-12">
                            <h5 class="mb-n3">Tunai</h5>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="row px-3">
                                <div class="col-6">Awal Tunai</div>
                                <div class="col-6 text-end">Rp. 0</div>
                                <hr>
                            </div>
                            <div class="row px-3">
                                <div class="col-6">Penjualan Tunai</div>
                                <div class="col-6 text-end">Rp. 837.000</div>
                                <hr>
                            </div>
                            <div class="row px-3">
                                <div class="col-6">Tunai Dari Invoice</div>
                                <div class="col-6 text-end">Rp. 0</div>
                                <hr>
                            </div>
                            <div class="row px-3">
                                <div class="col-6">Pengembalian Tunai</div>
                                <div class="col-6 text-end">Rp. 0</div>
                                <hr>
                            </div>
                            <div class="row px-3">
                                <div class="col-6 cursor-pointer-col" data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample" aria-expanded="true"
                                    aria-controls="collapseExample">Biaya Total</div>
                                <div class="col-6 text-end">Rp. 11.800</div>
                                <div class="col-12 py-1 my-2 mx-0 row collapse text-white bg-secondary"
                                    id="collapseExample">
                                    <div class="col-6">22:02 - Bayar ongkir antar barang ke Ngaliyan</div>
                                    <div class="col-6 text-end">(Rp. 11.800)</div>
                                </div>
                                <hr>
                            </div>
                            <div class="row px-3">
                                <div class="col-6">Jumlah Pemasukan</div>
                                <div class="col-6 text-end">Rp. 0</div>
                                <hr>
                            </div>
                            <div class="row px-3">
                                <div class="col-6">Jumlah Akhir Yang Diharapkan</div>
                                <div class="col-6 text-end">Rp. 0</div>
                                <hr>
                            </div>
                            <div class="row px-3">
                                <div class="col-6">Jumlah Akhir</div>
                                <div class="col-6 text-end">Rp. 0</div>
                                <hr>
                            </div>
                            <div class="col-12">
                                <h5 class="mb-n3">Tunai</h5>
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="row px-3">
                                    <div class="col-6">Tunai</div>
                                    <div class="col-6 text-end">Rp. 11.800</div>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row px-3">
                                    <div class="col-6">Pengembalian Tunai</div>
                                    <div class="col-6 text-end">Rp. 0</div>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row px-3">
                                    <div class="col-6">Pembayaran Tunai yang Diharapkan</div>
                                    <div class="col-6 text-end">Rp. 11.800</div>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-12">
                                <h5 class="mb-n3">Lainnya</h5>
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="row px-3">
                                    <div class="col-6">BCA QR</div>
                                    <div class="col-6 text-end">Rp. 411.000</div>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row px-3">
                                    <div class="col-6">Pengembalian Lainnya</div>
                                    <div class="col-6 text-end">Rp. 0</div>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row px-3">
                                    <div class="col-6">Pembayaran Lainnya Yang Diharapkan</div>
                                    <div class="col-6 text-end">Rp. 411.000</div>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-12">
                                <h5 class="mb-n3">Total</h5>
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="row px-3">
                                    <div class="col-6">Total Yang Diharapkan</div>
                                    <div class="col-6 text-end"><?php echo IDR($shift['total_diharapkan'])?></div>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row px-3">
                                    <div class="col-6">Total Didapat</div>
                                    <div class="col-6 text-end"><?php echo IDR($shift['total_didapat'])?></div>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row px-3">
                                    <div class="col-6">Perbedaan</div>
                                    <div class="col-6 text-end"><?php echo IDR($shift['total_diharapkan']-$shift['total_didapat'])?></div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button onClick="kembali()" class="btn btn-primary float-end mb-3">
                        Kembali
                    </button>
                    <!-- Modal -->
                    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Catatan Aktivitas</h1>
                                </div>
                                <div class="modal-body">
                                    <h6 class="ms-n1">Total Items: 21</h6>
                                    <div class="row">
                                        <h6 class="col-6 mb-n1 ms-n1">Item</h6>
                                        <h6 class="col-6 mb-n1 ms-n1">Jumlah</h6>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6 bg-secondary text-white py-3 pl-2 border rounded">Paperbag
                                        </div>
                                        <div class="col-6 bg-secondary text-white py-3 pl-2 border rounded">5</div>
                                    </div>
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
        </div>
    </div>
    <?php $this->load->view('style/js') ?>
    <script>
    function kembali() {
        window.history.go(-1);
    }
    </script>
</body>

</html>