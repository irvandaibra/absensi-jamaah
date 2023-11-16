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
    .scroll-barang {
        overflow-y: scroll;
        overflow-x: hidden;
        max-height: 400px;
    }

    .hover-barang {
        cursor: pointer;
        padding: 5px;
    }

    .hover-barang:hover {
        background-color: #F1F1F1;
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
            <?php echo form_open_multipart('pesanan/tambah', 'class="mt-5 pt-5 pb-5 px-5"') ?>
            <div class="page-wrapper shadow-lg p-3 mb-4 rounded" style="height: 575px; background-color: white;">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-6 align-self-center">
                            <h2 class="page-title"><?php echo $page?> Pesanan</h2>
                        </div>
                    </div>
                    <?php if($page === 'Tambah') { ?>
                    <?php } else { ?>
                    <?php } ?>
                    <div class="row">
                        <div class="col-5 mt-4">
                            <?php
                                $options = array();
                                foreach($toko as $toko) {
                                    $options[$toko->id] = $toko->nama_toko;
                                }
                                echo form_dropdown($id_toko, $options, '', 'class="form-select w-50 select2" id="id_toko"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="mb-n3">
                        <h5>Form <?php echo $page?> Pesanan</h5>
                    </div>
                    <hr>
                    <div class="row mt-4 px-2">
                        <div class="col-md-12 mt-n2 mb-3">
                            <div class="col-md-12 mt-n2 mb-3">
                                <label for="pemasok" class="form-label">Pilih Pemasok</label>
                                <?php
                                $options = array();
                                    $options['Tidak Ada Pemasok'] = 'Tidak Ada Pemasok (Default)';
                                echo form_dropdown($pemasok, $options, '', 'class="form-select select2" id="pemasok"');
                            ?>
                            </div>
                            <label for="catatan" class="form-label">Catatan</label>
                            <?php echo form_textarea($catatan, '', 'class="form-control" id="catatan" autocomplete="off" placeholder="Catatan" required style="height: 70px;"') ?>
                        </div>
                    </div>
                    <div class="mb-n3">
                        <h5>Penyesuaian Barang</h5>
                    </div>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th colspan="2">Kuantitas</th>
                            </tr>
                        </thead>
                        <tbody id="dataContainer">
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Tambah Barang</button>
                    <button type="submit" class="btn btn-primary float-end mx-1 mt-3">Tambah</button>
                    <button type="button" class="btn btn-outline-secondary float-end mx-1 mt-3"
                        onClick="kembali()">Batal</button>
                </div>
            </div>
            <?php echo form_close(); ?>
            <?php echo form_open_multipart('') ?>
            <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                Produk
                            </h1>
                        </div>
                        <div class="modal-body">
                            <div class="scroll-barang" id="produk">
                            </div>
                            <div id="formProduk" class="hide">
                                <h1 class="fs-5">
                                </h1>
                                <div class="row">
                                    <div class="col-4">Stok</div>
                                    <div class="col-4">Kuantitas</div>
                                    <div class="col-4">Barang</div>
                                </div>
                                <div class="row" id="input">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="radio" id="batal" name="radiobarang" class="checkbox-modal hide"
                                onchange="pilihBarang(null)">
                            <label for="batal" class="btn btn-secondary hide" id="buttonBatal">Batal</label>
                            <label for="batal" type="button" class="btn btn-success hide" id="buttonTambah"
                                data-bs-dismiss="modal">Tambah</label>
                            <label for="batal" class="btn btn-danger" data-bs-dismiss="modal"
                                id="buttonTutup">Tutup</label>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <?php $this->load->view('style/js') ?>
    <script>
    $(document).ready(function() {
        $('#id_toko').change(function() {
            var id_toko = $('#id_toko').val();
            $.ajax({
                url: '<?= base_url(); ?>pesanan/get_produk_bytoko_id',
                method: 'POST',
                data: {
                    id_toko: id_toko
                },
                success: function(data) {
                    $('#produk').html(data);
                },
                error: function() {
                    console.error('ERROR');
                }
            });
        });
    });

    function kembali() {
        window.history.go(-1);
    }

    function pilihBarang(id) {
        if (id !== null) {
            $.ajax({
                url: '<?= base_url(); ?>pesanan/get_produk_byid/' + id,
                method: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#input').html(data)
                }
            });
            document.getElementById('produk').style.display = 'none';
            document.getElementById('buttonTutup').style.display = 'none';
            document.getElementById('formProduk').style.display = 'block';
            document.getElementById('buttonBatal').style.display = 'block';
            document.getElementById('buttonTambah').style.display = 'block';
        } else {
            document.getElementById('produk').style.display = 'block';
            document.getElementById('buttonTutup').style.display = 'block';
            document.getElementById('formProduk').style.display = 'none';
            document.getElementById('buttonBatal').style.display = 'none';
            document.getElementById('buttonTambah').style.display = 'none';
        }
        console.log(id);
    }

    $(document).ready(function() {
        var data = [];

        $("#showForm").click(function() {
            $("#inputForm").show();
        });

        $("#buttonTambah").click(function() {
            var id_barang = $("#InputId_produk").val();
            var kuantitas = $("#InputKuantitas").val();
            var barang = $("#InputBarang").val();

            if (id_barang && kuantitas && barang) {
                data.push({
                    id_barang: id_barang,
                    kuantitas: kuantitas,
                    barang: barang
                });
                tampilkanData();
                resetForm();
            }

            $("#inputForm").hide();
        });

        function tampilkanData() {
            $("#dataContainer").empty();

            for (var i = 0; i < data.length; i++) {
                var item = data[i];
                var content = "<tr>";
                content += "<td>" + item.barang + "</td>";
                content += "<td>" + item.kuantitas + "</td>";
                content += "</tr>";
                content += "<td class='border-0'><input type='hidden' value='" + item.id_barang +
                    "' name='id_barang[" + item.id_barang + "]' /></td>";
                "' /></td>";
                "' /></td>";
                content += "<td class='border-0'><input type='hidden' value='" + item.kuantitas +
                    "' name='jumlah_produk' /></td>";
                $("#dataContainer").append(content);
            }
        }

        function resetForm() {
            $("#InputId_produk").val("");
            $("#InputKuantitas").val("");
            $("#InputBarang").val("");
        }
    });
    </script>
</body>

</html>