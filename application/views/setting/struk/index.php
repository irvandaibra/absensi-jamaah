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
    .scroll {
        overflow-y: scroll;
        overflow-x: hidden;
        max-height: 450px;
    }

    .pointer {
        cursor: pointer;
    }

    .list-none {
        list-style-type: none;
        margin-left: 15px;
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
                            <h2 class="page-title">Keterangan</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5 mt-4">
                            <?php
                 $options = array();
                foreach ($toko as $t) {
                $options[$t->id] = $t->nama_toko;
                }
                echo form_open('struk', 'class="d-flex"');
                if ($selected_row !== null && isset($selected_row['id'])) {
                 echo form_dropdown('id', $options, $selected_row['id'], 'class="form-select w-50" id="toko"');
                } else {
                    echo form_dropdown('id', $options, '', 'class="form-select w-50" id="toko"');
                }
                echo form_submit('submit', 'Submit', 'class="btn btn-info"');
                echo form_close();
                ?>
                        </div>
                    </div>
                </div>
                <div class="container-fluid row">

                    <!-- <div id="ada">

                </div> -->
                    <div class="col-6 scroll">
                        <div class="container-fluid">
                            <div class="mb-n3">
                                <h5>INFO</h5>
                            </div>
                            <hr>
                            <div class="mt-4 px-2">
                                <?php echo form_open_multipart('struk/save', 'class=""') ?>
                                <div class="row">
                                    <div class="col-4 p-3">
                                        <?php echo form_upload($logo, $logo['value'], 'class="hide" id="foto" autocomplete="off"') ?>
                                        <label for="logo" class="pointer">
                                            <img src="<?php echo base_url('package/assets/images/logo-pos2.jpeg')?>"
                                                alt="foto" width="125">
                                        </label>
                                    </div>
                                    <div class="col-8">
                                        <p>Jika Anda memilih untuk tidak mengunggah apa pun, logo outlet akan diatur ke
                                            gambar yang diunggah di halaman profil publik. Mengunggah gambar di sini
                                            hanya akan memengaruhi logo outlet yang dipilih
                                            dan mengubah nama bisnis di struk menjadi Nama Outlet. Klik
                                            pada gambar untuk merubah</p>
                                    </div>
                                    <div class="col-12">
                                        <p style="font-size: 12px;">INFO TOKO</p>
                                    </div>
                                    <div class="col-12 mt-2 mb-3">
                                        <label for="nama_toko" class="form-label">Nama</label>
                                        <?php echo form_input($id_toko, $id_toko['value'], 'class="form-control" autocomplete="off" placeholder="Nama Toko" required') ?>
                                        <?php echo form_input($nama_toko, $nama_toko['value'], 'class="form-control" autocomplete="off" placeholder="Nama Toko" required') ?>
                                    </div>
                                    <div class="col-12 mt-2 mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <?php echo form_input($alamat, $alamat['value'], 'class="form-control" autocomplete="off" placeholder="Alamat Toko" required') ?>
                                    </div>
                                    <div class="col-4 mt-2 mb-3">
                                        <label for="provinsi" class="form-label">Provinsi</label>
                                        <?php echo form_input($provinsi, $provinsi['value'], 'class="form-control" autocomplete="off" placeholder="Provinsi Toko" required') ?>
                                    </div>
                                    <div class="col-4 mt-2 mb-3">
                                        <label for="kota" class="form-label">Kota</label>
                                        <?php echo form_input($kota, $kota['value'], 'class="form-control" autocomplete="off" placeholder="Kota Toko" required') ?>
                                    </div>
                                    <div class="col-4 mt-2 mb-3">
                                        <label for="kode_pos" class="form-label">Kode Pos</label>
                                        <?php echo form_input($kode_pos, $kode_pos['value'], 'class="form-control" autocomplete="off" placeholder="No Pos" required') ?>
                                    </div>
                                    <div class="col-12 mt-2 mb-3">
                                        <label for="telepon" class="form-label">No Telepon</label>
                                        <?php echo form_input($telepon, $telepon['value'], 'class="form-control" autocomplete="off" placeholder="No Telepon Toko" required') ?>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <p style="font-size: 12px;">LINK</p>
                                    </div>
                                    <div class="col-12 row">
                                        <div class="col-1 py-1">
                                            <i data-feather="globe" class="mdi mdi-view-quilt"></i>
                                        </div>
                                        <div class="col-11">
                                            <?php echo form_input($link_website, $link_website['value'], 'class="form-control" autocomplete="off" placeholder="Website Toko"') ?>
                                        </div>
                                    </div>
                                    <div class="col-12 row mt-3">
                                        <div class="col-1 py-1">
                                            <i data-feather="twitter" class="mdi mdi-view-quilt"></i>
                                        </div>
                                        <div class="col-11">
                                            <?php echo form_input($link_twitter, $link_twitter['value'], 'class="form-control" autocomplete="off" placeholder="Twitter Toko"') ?>
                                        </div>
                                    </div>
                                    <div class="col-12 row mt-3">
                                        <div class="col-1 py-1">
                                            <i data-feather="facebook" class="mdi mdi-view-quilt"></i>
                                        </div>
                                        <div class="col-11">
                                            <?php echo form_input($link_facebook, $link_facebook['value'], 'class="form-control" autocomplete="off" placeholder="Facebook Toko"') ?>
                                        </div>
                                    </div>
                                    <div class="col-12 row my-3">
                                        <div class="col-1 py-1">
                                            <i data-feather="instagram" class="mdi mdi-view-quilt"></i>
                                        </div>
                                        <div class="col-11">
                                            <?php echo form_input($link_instagram, $link_instagram['value'], 'class="form-control" autocomplete="off" placeholder="Instagram Toko"') ?>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <p style="font-size: 12px;">CATATAN</p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <?php echo form_textarea($catatan, $catatan['value'], 'class="form-control" autocomplete="off" placeholder="Catatan Toko" style="height: 70px;"') ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-end w-25">Simpan</button>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 scroll">
                        <div class="container-fluid">
                            <div class="mb-n3">
                                <h5>PREVIEW PENERIMAAN</h5>
                            </div>
                            <hr>
                            <div class="mt-4 px-2">
                                <div class="row px-2">
                                    <div class="col-12 d-flex justify-content-center">
                                        <img src="<?php echo base_url('package/assets/images/logo-pos2.jpeg')?>"
                                            alt="foto" width="125" class="rounded-circle">
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <h3>Anjasmoro - Bakpia&Bolu Tugu Jogja</h3>
                                    </div>
                                    <div class="col-12 text-center">
                                        <p style="font-size: 15px;">Jl. Anjasmoro Raya No.48 Karangayu, Kota Semarang,
                                            Jawa Tengah, 50149</p>
                                    </div>
                                    <div class="col-12 text-center">
                                        <p style="font-size: 15px;">+62 85879591578</p>
                                    </div>
                                    <hr>
                                    <div class="col-12 row">
                                        <div class="col-6">16 Jun 2023</div>
                                        <div class="col-6 text-end">10:49</div>
                                    </div>
                                    <div class="col-12 row mt-1">
                                        <div class="col-6">Nomor Tanda Terima</div>
                                        <div class="col-6 text-end">QGKTER5</div>
                                    </div>
                                    <div class="col-12 row mt-1">
                                        <div class="col-6">Dilayani Oleh</div>
                                        <div class="col-6 text-end">Budi Santoso</div>
                                    </div>
                                    <div class="col-12 row mt-1">
                                        <div class="col-6">Dikumpulkan oleh</div>
                                        <div class="col-6 text-end">Asep Kopling</div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="col-12 row">
                                        <div class="col-4">Milk Tea</div>
                                        <div class="col-4 text-center">x1</div>
                                        <div class="col-4 text-end">Rp. 25.000</div>
                                    </div>
                                    <div class="col-12 fw-light">Venti</div>
                                    <ul class="fw-light list-none">
                                        <li>Pearl - Sweet - Rp. 2.000</li>
                                        <li>Grass Jelly - Salt - Rp. 2.000</li>
                                        <li>Sugar - Rare - Rp. 2.000</li>
                                    </ul>
                                    <div class="col-12 mt-n3 row fw-light">
                                        <div class="col-6">Promo Sultan (0.5%)</div>
                                        <div class="col-6 text-end">(Rp. 1.000)</div>
                                    </div>
                                    <div class="col-12 mt-2 row">
                                        <div class="col-6">Discount Test (Rp)</div>
                                        <div class="col-6 text-end">(Rp. 10.000)</div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="col-12 row">
                                        <div class="col-6">Subtotal</div>
                                        <div class="col-6 text-end">Rp. 110.000</div>
                                    </div>
                                    <div class="col-12 mt-2 row">
                                        <div class="col-6">Gratuity Test (5 %)</div>
                                        <div class="col-6 text-end">Rp. 10.000</div>
                                    </div>
                                    <div class="col-12 mt-2 row">
                                        <div class="col-6">Tax Test (5 %)</div>
                                        <div class="col-6 text-end">Rp. 10.000</div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="col-12 row">
                                        <div class="col-6">
                                            <h4>Total</h4>
                                        </div>
                                        <div class="col-6 text-end">
                                            <h4>Rp. 110.000</h4>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2 row">
                                        <div class="col-6">Cash</div>
                                        <div class="col-6 text-end">Rp. 150.000</div>
                                    </div>
                                    <div class="col-12 mt-2 row">
                                        <div class="col-6">Change</div>
                                        <div class="col-6 text-end">Rp. 40.000</div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="col-12">
                                        <p style="font-size: 12px;">LINK</p>
                                    </div>
                                    <div class="col-12 row">
                                        <div class="col-1 mt-n1">
                                            <i data-feather="globe" class="mdi mdi-view-quilt"></i>
                                        </div>
                                        <div class="col-11">
                                            <h6>https://samsae.id</h6>
                                        </div>
                                    </div>
                                    <div class="col-12 row mt-3">
                                        <div class="col-1 mt-n1">
                                            <i data-feather="twitter" class="mdi mdi-view-quilt"></i>
                                        </div>
                                        <div class="col-11">
                                            <h6></h6>
                                        </div>
                                    </div>
                                    <div class="col-12 row mt-3">
                                        <div class="col-1 mt-n1">
                                            <i data-feather="facebook" class="mdi mdi-view-quilt"></i>
                                        </div>
                                        <div class="col-11">
                                            <h6></h6>
                                        </div>
                                    </div>
                                    <div class="col-12 row my-3">
                                        <div class="col-1 mt-n1">
                                            <i data-feather="instagram" class="mdi mdi-view-quilt"></i>
                                        </div>
                                        <div class="col-11">
                                            <h6>bakpiatugujogjasemarang</h6>
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="col-12">
                                        <p style="font-size: 12px;">CATATAN</p>
                                    </div>
                                    <div class="col-12">
                                        <p>Terima Kasih Sudah Berbelanja di Toko Kami</p>
                                    </div>
                                </div>
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
    console.log($('#toko').val());
    $(document).ready(function() {
        $('#toko').ajax({
            url: "<?php echo base_url('struk/get_data') ?>",
            method: "POST",
            data: {
                id: id
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                console.log(data[0]);

                var nama = '<p style="background-color: #EEEEEE" class="form-control">' + data[0]
                    .nama_toko + '</p>';
                $('#ada').html(nama);

            }
        });
        $('#toko').change(function() {
            var id = $(this).val();
            console.log(id);
            $.ajax({
                url: "<?php echo base_url('struk/get_data') ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    console.log(data[0]);

                    var nama =
                        '<p style="background-color: #EEEEEE" class="form-control">' + data[
                            0].nama_toko + '</p>';
                    $('#ada').html(nama);

                }
            });
            return false;
        });

    });
    $(document).ready(function() {
        $('#toko').ajax({
            url: "<?php echo base_url('struk/index');?>",
            method: "POST",
            data: {
                id: id
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                console.log('AHHHHs' + data);
            }
        });
        $("#toko").on('change', function() {
            var id = $(this).val();
            ajax({
                url: "<?php echo base_url('struk/get_data');?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    console.log('AHHHHs' + data);
                }
            });
        });
    });
    </script>
</body>

</html>