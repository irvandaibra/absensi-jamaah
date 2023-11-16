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
    .scroll-table {
        overflow-y: scroll;
        overflow-x: hidden;
        max-height: 450px;
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
            <?php echo form_open_multipart('data_jamaah/'.$this->uri->segment(2).$this->uri->segment(2) == 'ubah' && '/'.$this->uri->segment(3), 'class="mt-5 pt-5 pb-5 px-5"') ?>
            <div class="page-wrapper shadow-lg p-3 mb-5 rounded" style="height: auto; background-color: white;">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-6 align-self-center">
                            <h2 class="page-title"><?php echo $page?> Data Jamaah</h2>
                        </div>
                    </div>
                    <?php if($page === 'Tambah') { ?>
                    <?php } else { ?>
                    <?php } ?>
                </div>
                <div class="container-fluid">
                    <div class="mb-n3">
                        <h5>Form <?php echo $page?> </h5>
                    </div>
                    <hr>
                    <div class="row">
                    <?php if($page === 'Ubah') { ?>
                        <?php echo form_input($code_unik, $code_unik['value'], 'class="form-control" id="nama" autocomplete="off" placeholder="Nama Lengkap" required') ?>
                    <?php } else { ?>
                    <?php } ?>
                        <div class="col-md-12 mt-n2 mb-3">
                        </div>
                        <div class="col-md-12 mt-n2 mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <?php echo form_input($nama_lengkap, $nama_lengkap['value'], 'class="form-control" id="nama" autocomplete="off" placeholder="Nama Lengkap" required') ?>
                        </div>
                        <div class="col-md-6 mt-n2 mb-3">
                            <label for="tmpt_lahir" class="form-label">Tempat Lahir</label>
                            <?php echo form_input($tmpt_lahir, $tmpt_lahir['value'], 'class="form-control" id="tmpt_lahir" autocomplete="off" placeholder="Tempat Lahir" required') ?>
                        </div>
                        <div class="col-md-6 mt-n2 mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <?php echo form_input($tgl_lahir, $tgl_lahir['value'], 'class="form-control" id="tgl_lahir" autocomplete="off" placeholder="Tanggal Lahir" required') ?>
                        </div>
                        <div class="col-md-12 mt-n2 mb-3">
                            <label for="nama" class="form-label">Kategori Usia</label>
                            <?php
                                    $options = array(
                    'lansia' => 'Lansia',
                    'umum' => 'Umum',
                    'remaja' => 'Remaja'
                    );
                echo form_dropdown('kategori', $options, set_value('kategori', $kategori), 'class="form-control select2" id="kategori"');
                    ?>
                        </div>
                        <div class="col-md-12 mt-n2 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <?php
                                    $options = array(
                    'pendatang' => 'Pendatang',
                    'pribumi' => 'Pribumi',
                    );
                echo form_dropdown('status', $options, set_value('status', $status), 'class="form-control select2" id="status"');
                    ?>

                        </div>
                    </div>
                    <?php if($page === 'Ubah') { ?>
                    <button class="btn btn-danger float-start" type="button"
                        onClick="location.href='<?php echo base_url('akses_karyawan/hapus/'.$row['id'])?>'">
                        Hapus
                    </button>
                    <?php } else { ?>
                    <?php } ?>
                    <button type="submit" class="btn btn-primary float-end mx-1"><?php echo $page ?></button>
                    <button type="button" class="btn btn-outline-secondary mx-1" onClick="kembali()">Batal</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <?php $this->load->view('style/js') ?>
</body>
<script>
function kembali() {
    window.history.go(-1)
}
</script>

</html>