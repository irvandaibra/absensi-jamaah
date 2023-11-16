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
            <?php echo form_open_multipart('produk/'.$this->uri->segment(2).$this->uri->segment(2) == 'ubah' && '/'.$this->uri->segment(3), 'class="mt-5 pt-5 pb-5 px-5"') ?>
            <div class="page-wrapper shadow-lg p-3 mb-5 rounded" style="height: 740px; background-color: white;">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-6 align-self-center">
                            <h2 class="page-title"><?php echo $page?> Produk</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5 mt-4">
                            <?php
                                $options = array();
                                foreach($toko as $toko) {
                                    $options[$toko->id] = $toko->nama_toko;
                                }
                                echo form_dropdown($id_toko, $options, $id_toko['value'], 'class="form-select w-50 select2" id="toko"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="mb-n3">
                        <h5>Form <?php echo $page?> Produk</h5>
                    </div>
                    <hr>
                    <div class="row mt-4 px-2">
                        <div class="col-md-12 mt-n2 mb-3">
                            <label for="nama" class="form-label">Nama Produk</label>
                            <?php echo form_input($nama_produk, $nama_produk['value'], 'class="form-control" id="nama" autocomplete="off" placeholder="Nama Produk" required') ?>
                        </div>
                        <div class="col-md-6 mt-n2 mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <?php echo form_input($harga_jual, $harga_jual['value'], 'class="form-control" id="harga_jual" autocomplete="off" placeholder="Harga Jual" required') ?>
                        </div>
                        <div class="col-md-6 mt-n2 mb-3">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <?php echo form_input($harga_beli, $harga_beli['value'], 'class="form-control" id="harga_beli" autocomplete="off" placeholder="Harga Beli" required') ?>
                        </div>
                        <div class="col-md-4 mt-n2 mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <?php echo form_input($stok, $stok['value'], 'class="form-control" id="stok" autocomplete="off" placeholder="Stok" required') ?>
                        </div>
                        <div class="col-md-4 mt-n2 mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <!-- <select name="id_kategori" id="ctg"></select> -->
                            <?php
                                $options = array();
                                echo form_dropdown($id_kategori, $options, $id_kategori['value'], 'class="form-control select2" id="ctg"');
                            ?>
                        </div>
                        <div class="col-md-4 mt-n2 mb-3">
                            <label for="merek" class="form-label">Merek</label>
                            <!-- <select name="id_merel" id="brd"></select> -->
                            <?php
                                $options = array();
                                echo form_dropdown($id_merek, $options, $id_merek['value'], 'class="form-control select2" id="brd"');
                            ?>
                        </div>
                        <div class="col-md-6 mt-n2 mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <?php echo form_textarea($deskripsi, $deskripsi['value'], 'class="form-control" id="deskripsi" autocomplete="off" placeholder="Deskripsi"') ?>
                        </div>
                        <div class="col-md-6 row mt-n2 mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <div>
                                <?php echo form_upload($foto, $foto['value'], 'id="foto" oninput="pic.src=window.URL.createObjectURL(this.files[0])" accept="image/*"'); ?>
                            </div>
                            <div class="col-12 mt-2 d-flex justify-content-between">
                                <div class="h-100" style="padding-top: 5.3rem; padding-bottom: 5.3rem;">
                                    Hasil Foto:
                                </div>
                                <div><img id="pic" width="200px" /></div>
                            </div>
                        </div>
                    </div>
                    <?php if($page === 'Ubah') { ?>
                    <button type="button" onClick="location.href='<?php echo base_url('produk/hapus/'.$row['id'])?>'"
                        class="btn btn-danger mx-2">
                        Hapus
                    </button>
                    <?php } elseif ($page === 'Tambah') { ?>
                    <button type="submit" name="submit_type" value="all_o"
                        class="btn btn-primary float-end mx-1"><?php echo $page ?> Di Semua
                        Toko</button>
                    <?php } ?>
                    <button type="submit" name="submit_type" value="spesific_o"
                        class="btn btn-primary float-end mx-1"><?php echo $page ?></button>
                    <button type="button" class="btn btn-outline-secondary float-end mx-1"
                        onClick="kembali()">Batal</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <?php $this->load->view('style/js') ?>
    <script>
    function kembali() {
        window.history.go(-1);
    }
    const xhr = new XMLHttpRequest();
    const ctg = document.getElementById('ctg');

    xhr.onload = function() {
        if (this.status === 200) {
            var data = JSON.parse(xhr.responseText);
            var i;
            ctg.innerHTML += '<option value="0">Tidak Berkategori</option>';
            for (i = 0; i < data.length; i++) {
                ctg.innerHTML += `<option value="${data[i].id}">${data[i].nama_kategori}</option>`;
                console.log(data[i].nama_kategori);
            }
        } else {
            console.warn('ERROR CAUGHT!: GET SOME HELP');
        }
    }

    xhr.open('get', '<?= base_url('produk/get_data_kategori/') ?>' + $('#toko').val());
    xhr.send();

    $(document).ready(function() {
        $('#toko').change(function() {
            var id_kategori = $(this).val();
            $.ajax({
                url: "<?php echo base_url('produk/get_data_kategori/');?>" + id_kategori,
                method: "POST",
                data: {
                    id_toko: id_kategori
                },
                async: true,
                dataType: 'json',
                destroy: true,
                success: function(data) {
                    console.log(data);
                    var ctg = '';
                    var i;
                    ctg += '<option value="0">Tidak Berkategori</option>';
                    for (i = 0; i < data.length; i++) {
                        ctg += '<option value=' + data[i].id + '>' + data[i]
                            .nama_kategori + '</option>';
                    }
                    $('#ctg').html(ctg);
                }
            });
            return false;
        });

    });
    </script>
    <script>
    const exe = new XMLHttpRequest();
    const brd = document.getElementById('brd');

    exe.onload = function() {
        if (this.status === 200) {
            var data = JSON.parse(exe.responseText);
            var i;
            brd.innerHTML += '<option value="0">Tidak Bermerek</option>';
            for (i = 0; i < data.length; i++) {
                brd.innerHTML += `<option value="${data[i].id}">${data[i].nama_merek}</option>`;
                console.log(data[i].nama_merek);
            }
        } else {
            console.warn('ERROR CAUGHT!: GET SOME HELP');
        }
    }

    exe.open('get', '<?= base_url('produk/get_data_merek/') ?>' + $('#toko').val());
    exe.send();

    $(document).ready(function() {
        $('#toko').change(function() {
            var id_merek = $(this).val();
            $.ajax({
                url: "<?php echo base_url('produk/get_data_merek/');?>" + id_merek,
                method: "POST",
                data: {
                    id_toko: id_merek
                },
                async: true,
                dataType: 'json',
                destroy: true,
                success: function(data) {
                    console.log(data);
                    var brd = '';
                    var i;
                    brd += '<option value="0">Tidak Bermerek</option>';
                    for (i = 0; i < data.length; i++) {
                        brd += '<option value=' + data[i].id + '>' + data[i]
                            .nama_merek + '</option>';
                    }
                    $('#brd').html(brd);
                }
            });
            return false;
        });

    });
    </script>
</body>

</html>