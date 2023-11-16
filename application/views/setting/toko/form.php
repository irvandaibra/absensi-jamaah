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
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script> -->
    <style>
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
            <?php echo form_open_multipart('toko/'.$this->uri->segment(2).$this->uri->segment(2) == 'ubah' && '/'.$this->uri->segment(3), 'class="mt-5 pt-5 pb-5 px-5"') ?>
            <div class="page-wrapper shadow-lg p-3 mb-5 rounded" style="height: 470px; background-color: white;">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-6 align-self-center">
                            <h2 class="page-title"><?php echo $page?>Toko</h2>
                        </div>
                    </div>
                    <?php if($page === 'Tambah') { ?>
                    <?php } else { ?>
                    <?php } ?>
                </div>
                <div class="container-fluid">
                    <div class="mb-n3">
                        <h5>Form <?php echo $page?> Toko</h5>
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="mt-n2 mb-3">
                                <label>Nama Toko</label>
                                <?php echo form_input($nama_toko, $nama_toko['value'], 'class="form-control" autocomplete="off" placeholder="Nama Toko" required') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mt-n2 mb-3">
                                <label>Alamat</label>
                                <?php echo form_input($alamat, $alamat['value'], 'class="form-control" autocomplete="off" placeholder="Alamat Toko" required') ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mt-n2 mb-3">
                                <label>Provinsi</label>
                                <select name="provinsi" id="provinsi" class="form-select select2 border-danger">
                                    <?php if($page === 'Tambah') { ?>
                                    <option value="">Pilih Provinsi</option>
                                    <?php } else { ?>
                                    <option default value="<?php echo $row['provinsi'] ?>">
                                        <?php echo $row['provinsi'] ?>
                                        <?php } ?>
                                        <?php
                                        foreach ($provinces as $province_select) {
                                            echo '<option value="' . $province_select->id . '">' . $province_select->name . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mt-n2 mb-3">
                                <label>Kabupaten/Kota</label>
                                <select name="kota" id="kabupaten" class="form-select select2 border-danger"
                                    style="border: 1px solid #E9ECEF">
                                    <?php if($page === 'Tambah') { ?>
                                    <option value="">Pilih Kabupaten/Kota</option>
                                    <?php } else { ?>
                                    <option default value="<?php echo $row['kota'] ?>">
                                        <?php echo $row['kota'] ?>
                                        <?php } ?>
                                        <?php
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mt-n2 mb-3">
                                <label>Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="form-select select2 border-danger"
                                    style="border: 1px solid #E9ECEF">
                                    <?php if($page === 'Tambah') { ?>
                                    <option value="">Pilih Kecamatan</option>
                                    <?php } else { ?>
                                    <option default value="<?php echo $row['kecamatan'] ?>">
                                        <?php echo $row['kecamatan'] ?>
                                        <?php } ?>
                                        <?php

                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mt-n2 mb-3">
                                <label>Desa</label>
                                <select name="desa" id="desa" class="form-select select2 border-danger"
                                    style="border: 1px solid #E9ECEF">
                                    <?php if($page === 'Tambah') { ?>
                                    <option value="">Pilih Desa</option>
                                    <?php } else { ?>
                                    <option default value="<?php echo $row['desa'] ?>">
                                        <?php echo $row['desa'] ?>
                                        <?php } ?>
                                        <?php

                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mt-n2 mb-3">
                                <label>Kode Pos</label>
                                <?php echo form_input($kode_pos, $kode_pos['value'], 'class="form-control" autocomplete="off" placeholder="Kode Pos" required') ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mt-n2 mb-3">
                                <label>No Telepon</label>
                                <?php echo form_input($telepon, $telepon['value'], 'class="form-control" autocomplete="off" placeholder="No Telepon" required') ?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <?php if ($page === 'Ubah') { ?>
                        <button type="button" onClick="location.href='<?php echo base_url('toko/hapus/'.$row['id'])?>'"
                            class="btn btn-danger">
                            Hapus
                        </button>
                        <?php if ($row['status'] === 'Aktif') {?>
                        <button type="button"
                            onClick="location.href='<?php echo base_url('toko/nonaktifkan/'.$row['id'])?>'"
                            class="btn btn-danger">
                            Nonaktifkan
                        </button>
                        <?php } else if ($row['status'] === 'Nonaktif') {?>
                        <button type="button"
                            onClick="location.href='<?php echo base_url('toko/aktifkan/'.$row['id'])?>'"
                            class="btn btn-success">
                            Aktifkan
                        </button>
                        <?php } ?>
                        <?php } else if ($page === 'Tambah') { ?>
                        <button type="submit" class="btn btn-primary float-end mx-1"><?php echo $page ?> Di Semua
                            Toko</button>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary float-end"><?php echo $page ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('style/js') ?>
    <script>
    $(document).ready(function() {

        //request data kabupaten
        $('#provinsi').change(function() {
            var provinsi_id = $('#provinsi').val(); //ambil value id dari provinsi

            if (provinsi_id != '') {
                $.ajax({
                    url: '<?= base_url(); ?>toko/get_kabupaten',
                    method: 'POST',
                    data: {
                        provinsi_id: provinsi_id
                    },
                    success: function(data) {
                        $('#kabupaten').html(data)
                    }
                });
            }
        });

        //request data kecamatan
        $('#kabupaten').change(function() {
            var kabupaten_id = $('#kabupaten').val(); // ambil value id dari kabupaten
            if (kabupaten_id != '') {
                $.ajax({
                    url: '<?= base_url(); ?>/toko/get_kecamatan',
                    method: 'POST',
                    data: {
                        kabupaten_id: kabupaten_id
                    },
                    success: function(data) {
                        $('#kecamatan').html(data)
                    }
                });
            }
        });

        //request data desa
        $('#kecamatan').change(function() {
            var kecamatan_id = $('#kecamatan').val(); // ambil value id dari kecamatan
            if (kecamatan_id != '') {
                $.ajax({
                    url: '<?= base_url(); ?>toko/get_desa',
                    method: 'POST',
                    data: {
                        kecamatan_id: kecamatan_id
                    },
                    success: function(data) {
                        $('#desa').html(data)
                    }
                });
            }
        });

        //jika tombol kirim di klik
        $('#btnKirim').click(function() {
            var dataprov = $('#provinsi').val();
            var kabupaten = $('#kabupaten').val();
            var kecamatan = $('#kecamatan').val();
            var desa = $('#desa').val();
            $('#dataprov').html(dataprov);
            $('#datakab').html(kabupaten);
            $('#datakec').html(kecamatan);
            $('#datades').html(desa);
        });

    });
    </script>
</body>

</html>