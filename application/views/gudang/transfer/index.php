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
            <div class="page-wrapper mt-5 pt-5 pb-5 px-5" style="min-height: 100vh; background-color: white;">
                <div class="shadow-lg p-2 rounded">
                    <div class="page-breadcrumb">
                        <div class="row">
                            <div class="col-6 d-flex gap-3 align-self-center">
                                <h2 class="page-title">Transfer</h2>
                                <!-- <div>
                                <select class="form-select">
                                    <option selected>Item</option>
                                    <option value="toko">Bahan</option>
                                    <option value="toko">Toko</option>
                                </select>
                            </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid mt-4">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex gap-2">
                                <div>
                                    <?php
                                $options = array();
                                foreach($toko as $toko) {
                                    $options[$toko->id] = $toko->nama_toko;
                                }
                                echo form_dropdown('', $options, '', 'class="form-select" id="toko"');
                            ?>
                                </div>
                                <!-- <div>
                                <input class="form-control" type="date" name="" id="">
                            </div> -->
                                <!-- <div>
                                <input class="form-control rounded" type="text" placeholder="Cari"
                                    aria-label="default input example">
                            </div> -->
                            </div>
                            <div class="d-flex gap-1">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">
                                        Export
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <a href=""><a href="<?php echo base_url('transfer/tambah')?>"
                                            class="btn btn-primary">Buat
                                            Transfer</a></a>
                                </div>
                            </div>
                        </div>
                        <div class="scroll-table mt-3">
                            <table class="table table-hover table-secondary ">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Asal Transfer</th>
                                        <th>Tujuan Transfer</th>
                                        <th>Nomer Pesanan</th>
                                        <th>Barang</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <!-- <tbody>
                                <tr>
                                    <th colspan="7">
                                        Kamis, 22 juni 2023
                                    </th>
                                </tr>
                                <tr class="table-light">
                                    <th>Bolu</th>
                                    <td class="text-truncate" style="max-width: 140px;">Gayamsari - Bakpia & Bolu Tugu
                                        Jogja</td>
                                    <td class="text-truncate" style="max-width: 140px;">Ngaliyan - Bakpia & Bolu Tugu
                                        Jogja</td>
                                    <td>#b47dbc6b</td>
                                    <td>9 Items</td>
                                    <td>
                                        <div class="bg-success text-center text-white rounded-pill p-1">
                                            Selesai
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php echo base_url('transfer/detail')?>"
                                            class="btn btn-primary btn-sm">Detail</a>
                                    </td>
                                </tr>
                            </tbody> -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('style/js') ?>
    <script>
    $(document).ready(function() {
        $('.table').DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            ordering: true,
            order: [
                [0, 'asc']
            ],
            ajax: {
                url: "<?= base_url('transfer/get_data')?>",
                type: "POST"
            },
            deferRender: true,
            destroy: true,
            aLengthMenu: [
                [5, 10, 50],
                [5, 10, 50]
            ],
            columns: [{
                    data: "dibuat_pada"
                },
                {
                    data: "id_dari_toko"
                },
                {
                    data: "id_ke_toko"
                },
                {
                    data: "nomor_pesanan"
                },
                {
                    data: "id_transfer_item"
                },
                {
                    data: "status"
                },
                {
                    data: "id"
                }
            ],
            columnDefs: [{
                targets: 1,
                render: function(data) {
                    return ``;
                }
            }],
        });
        $("#toko").on('change', function() {
            var id = $(this).val();
            $('.table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ordering: true,
                order: [
                    [0, 'asc']
                ],
                ajax: {
                    url: "<?= base_url('transfer/get_data')?>",
                    type: "POST"
                },
                deferRender: true,
                destroy: true,
                aLengthMenu: [
                    [5, 10, 50],
                    [5, 10, 50]
                ],
                columns: [{
                        data: "dibuat_pada"
                    },
                    {
                        data: "id_dari_toko"
                    },
                    {
                        data: "id_ke_toko"
                    },
                    {
                        data: "nomor_pesanan"
                    },
                    {
                        data: "id_transfer_item"
                    },
                    {
                        data: "status"
                    },
                    {
                        data: "id"
                    }
                ],
                columnDefs: [{
                        targets: 1,
                        render: function(data, type, row, meta) {
                            return ``;
                        }
                    },
                    {
                        targets: 2,
                        render: function(data, type, row, meta) {
                            return `<a href="<?php echo base_url('transfer/detail')?>" class="btn btn-primary btn-sm">Detail</a>`;
                        }
                    }
                ],
            });
        });
    });
    </script>
</body>

</html>