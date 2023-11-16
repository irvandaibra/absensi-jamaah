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
    :root {
        --white: white;
        --gray: #999;
        --lightgray: whitesmoke;
        --skyblue: #3699FF;
        --popular: #ffdd40;
        --starter: #f73859;
        --essential: #00aeef;
        --professional: #ff7f45;
    }

    .scroll-table {
        overflow-y: scroll;
        overflow-x: hidden;
        max-height: 450px;
    }

    /* SWITCH STYLE */
    .switch-wrapper {
        position: relative;
        display: inline-flex;
        padding: 4px;
        border: 1px solid lightgrey;
        margin-bottom: 40px;
        border-radius: 30px;
        background: var(--white);
    }

    .switch-wrapper [type="radio"] {
        position: absolute;
        left: -9999px;
    }

    .switch-wrapper [type="radio"]:checked#persen~label[for="persen"],
    .switch-wrapper [type="radio"]:checked#rupiah~label[for="rupiah"] {
        color: var(--white);
    }

    .switch-wrapper [type="radio"]:checked#persen~label[for="persen"]:hover,
    .switch-wrapper [type="radio"]:checked#rupiah~label[for="rupiah"]:hover {
        background: transparent;
    }

    .switch-wrapper [type="radio"]:checked#persen+label[for="rupiah"]~.highlighter {
        transform: none;
    }

    .switch-wrapper [type="radio"]:checked#rupiah+label[for="persen"]~.highlighter {
        transform: translateX(100%);
    }

    .switch-wrapper label {
        font-size: 16px;
        z-index: 1;
        min-width: 100px;
        line-height: 32px;
        cursor: pointer;
        border-radius: 30px;
        transition: color 0.25s ease-in-out;
    }

    .switch-wrapper label:hover {
        background: var(--lightgray);
    }

    .switch-wrapper .highlighter {
        position: absolute;
        top: 4px;
        left: 4px;
        width: calc(50% - 4px);
        height: calc(100% - 8px);
        border-radius: 30px;
        background: var(--skyblue);
        transition: transform 0.25s ease-in-out;
    }

    /* SWITCH STYLE */

    .label {
        width: 100%;
    }

    .card-input-element {
        display: none;
    }

    .card-input {
        margin: 10px;
        padding: 00px;
    }

    .card-input:hover {
        cursor: pointer;
    }

    .card-input-element:checked+.card-input {
        box-shadow: 0 0 1px 1px #3699FF;
    }

    .card-input {
        box-shadow: 0 0 1px 1px #F1F1F1;
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
            <?php echo form_open_multipart('akun_bank/'.$this->uri->segment(2).$this->uri->segment(2) == 'ubah' && '/'.$this->uri->segment(3), 'class="mt-5 pt-5 pb-5 px-5"') ?>
            <div class="page-wrapper shadow-lg p-3 mb-5 rounded" style="height: 540px; background-color: white;">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-6 align-self-center">
                        <h2 class="page-title"><?php echo $page?> Akun Bank</h2>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="mb-n3">
                    <h5>Form <?php echo $page?> Akun Bank</h5>
                </div>
                <hr>
                <div class="mt-4 px-2">
                    <div class="row">
                        <div class="mt-n2 mb-3 col-12">
                            <label for="nama_bank" class="form-label">Nama Bank</label>
                            <?php
                                    $options = array();
                                    $options[] = 'Pilih Bank';
                                    foreach($bank as $bank) {
                                        $options[$bank] = $bank;
                                    }
                                    echo form_dropdown($nama_bank, $options, $nama_bank['value'], 'class="form-select" required');
                                ?>
                        </div>
                        <div class="col-6 mt-n2 mb-3">
                            <label for="nomor_akun" class="form-label">Nomor Bank</label>
                            <?php echo form_input($nomor_akun, $nomor_akun['value'], 'class="form-control" autocomplete="off" placeholder="Nomor Bank" required') ?>
                        </div>
                        <div class="col-6 mt-n2 mb-3">
                            <label for="pemegang_akun" class="form-label">Nama Pemegang Akun</label>
                            <?php echo form_input($pemegang_akun, $pemegang_akun['value'], 'class="form-control" autocomplete="off" placeholder="Nama Pemegang Akun" required') ?>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="mb-n3 d-flex justify-content-between">
                                <h5>Pilih Toko</h5>
                                <div class="form-check">
                                    <label class="form-check-label h5" for="flexCheckDefault">
                                        Pilih Semua
                                    </label>
                                    <?php echo form_checkbox('', '', false, 'class="checkAll form-check-input" id="flexCheckDefault"') ?>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <?php foreach($toko as $data): ?>
                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                        <label class="label">
                                            <input type="checkbox" class="form-control check card-input-element"
                                                name="id_toko" value="<?php echo $data->id; ?>"
                                                <?php if($id_toko['value'] === $data->id) {echo 'checked'; }?>>
                                            <!-- <?php echo form_checkbox($id_toko, $data->id, false, 'class="form-control card-input-element"') ?> -->
                                            <div class="card panel panel-default card-input">
                                                <div class="card-header">
                                                    <?php echo $data->nama_toko ?>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title text-truncate"><?php echo $data->alamat ?>
                                                    </h5>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($page === 'Ubah') { ?>
                    <button type="button" onClick="location.href='<?php echo base_url('akun_bank/hapus/'.$row['id'])?>'"
                        class="btn btn-danger">
                        Hapus
                    </button>
                    <?php } ?>
                    <button type="submit" class="btn btn-primary float-end mx-1"><?php echo $page ?></button>
                    <button type="button" class="btn btn-outline-secondary float-end mx-1"
                        onClick="kembali()">Batal</button>
                </div>
            </div>
            <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <?php $this->load->view('style/js') ?>
    <script>
    $('.checkAll').click(function() {
        if ($(this).is(':checked')) {
            $('.check').attr('checked', true);
        } else {
            $('.check').attr('checked', false);
        }
    });

    function kembali() {
        window.history.go(-1);
    }
    </script>
</body>

</html>