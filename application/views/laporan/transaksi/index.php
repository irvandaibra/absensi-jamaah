<!DOCTYPE html>
<html lang="en">

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
            <div class="page-wrapper" style="min-height: 100vh; background-color: white;">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-6 align-self-center">
                            <h2 class="page-title">Transaksi</h2>
                        </div>
                        <div class="col-6 ">
                            <div class="btn-group float-end w-25">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Export
                                </button>
                                <ul class="dropdown-menu" id="export">
                                </ul>
                            </div>
                        </div>
                        <div class="col-5 mt-4">
                            <?php
                                $options = array();
                                $options['semua_toko'] = 'Semua Toko';
                                foreach($toko as $toko) {
                                    $options[$toko->id] = $toko->nama_toko;
                                }
                                echo form_dropdown('', $options, '', 'class="form-select w-50" id="toko"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="shadow pt-3 mb-2 bg-body-tertiary rounded text-center">
                        <div class="row">
                            <div class="col-4">
                                <h2 id="jumlahtrans"></h2>
                                <p style="font-size: 12px;">TRANSAKSI</p>
                            </div>
                            <div class="col-4">
                                <div id="totaldapat"></div>
                                <!-- <p class="fw-bold" style="font-size: 17px;">Rp. -</p> -->
                                <p style="font-size: 12px;">TOTAL YANG DIDAPATKAN</p>
                            </div>
                            <div class="col-4">
                                <div id="untungbersih"></div>
                                <!-- <p class="fw-bold" style="font-size: 17px;">Rp. -</p> -->
                                <p style="font-size: 12px;">KEUNTUNGAN BERSIH</p>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-table">
                        <table class="table table-hover table-secondary w-100">
                            <thead>
                                <tr>
                                    <th>Toko</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <!-- <tbody>
                                <tr class="table-light">
                                    <td>Anjasmoro - Bakpia&Bolu Tugu Jogja</td>
                                    <td>9:15</td>
                                    <td class="text-center">Kasir Anjasmoro</td>
                                    <td class="text-center text-truncate" style="max-width: 130px;">Pie Coklat,
                                        Bakpia 65 Keju, Bakpia
                                        Vanza 19</td>
                                    <td class="text-end">Rp. 268.000</td>
                                    <td class="text-end">
                                        <a href="<?php echo base_url('transaksi/detail')?>"
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
    <?php $this->load->view('style/js') ?>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                processing: true,
                responsive:true,
                serverSide: true,
                orderable: true,
                order: [[ 1, "ASC" ]],
                ajax:
                {
                    url: "<?= base_url('transaksi/get_data/') ?>" + $('#toko').val(),
                    type: "POST"
                },
                deferRender: true,
                aLengthMenu: [[5, 10, 50],[ 5, 10, 50]],
                columns: [
                    { data: "nama_toko" },
                    { data: "waktu" },
                    { data: "nama_depan" },
                    { data: "nomor_struk" },
                    { data: "subtotal" },
                    { data: "nomor_struk" }
                ],
                columnDefs: [
                    {
                        targets: 1,
                        orderable: false,
                    },
                    {
                        targets: 2,
                        orderable: false,
                        render: function (data, type, row, meta) {
                            return `${data} ${row.nama_belakang}`;
                        }
                    },
                    {
                        targets: 3,
                        orderable: false,
                        render: function (data, type, row, meta) {
                            return ``;
                        }
                    },
                    {
                        targets: 4,
                        orderable: false,
                        render: function (data, type, row, meta) {
                            return formatRupiah(data);
                        }
                    },
                    {
                        targets: 5,
                        orderable: false,
                        render: function (data, type, row, meta) {
                            return `<a href="<?php echo base_url('transaksi/detail/')?>${data}" class="btn btn-primary btn-sm">Detail</a>`;
                        }
                    }
                ],
            });
            $("#toko").on('change', function() {
                var id = $(this).val();
                $('.table').DataTable({
                    processing: true,
                    responsive:true,
                    serverSide: true,
                    orderable: true,
                    order: [[ 0, "ASC" ]],
                    ajax:
                    {
                        url: "<?= base_url('transaksi/get_data/') ?>" + id,
                        type: "POST"
                    },
                    deferRender: true,
                    destroy: true,
                    aLengthMenu: [[5, 10, 50],[ 5, 10, 50]],
                    columns: [
                        { data: "nama_toko" },
                        { data: "waktu" },
                        { data: "nama_depan" },
                        { data: "nomor_struk" },
                        { data: "subtotal" },
                        { data: "nomor_struk" }
                    ],
                    columnDefs: [
                        {
                            targets: 1,
                            orderable: false,
                        },
                        {
                            targets: 2,
                            orderable: false,
                            render: function (data, type, row, meta) {
                                return `${data} ${row.nama_belakang}`;
                            }
                        },
                        {
                            targets: 3,
                            orderable: false,
                            render: function (data, type, row, meta) {
                                return ``;
                            }
                        },
                        {
                            targets: 4,
                            orderable: false,
                            render: function (data, type, row, meta) {
                                return formatRupiah(data);
                            }
                        },
                        {
                            targets: 5,
                            render: function (data, type, row, meta) {
                                return `<a href="<?php echo base_url('transaksi/detail/')?>${data}" class="btn btn-primary btn-sm">Detail</a>`;
                            }
                        }
                    ],
                });
            });
        });
        const xhr = new XMLHttpRequest();
        const impl = document.getElementById('export');

        xhr.onload = function() {
            if (this.status === 200) {
                var data = JSON.parse(xhr.responseText);
                        impl.innerHTML += `
                        <li><a class="dropdown-item" href="<?php echo base_urL("transaksi/export_transaksi/") ?>`+$('#toko').val()+`">Transaksi</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_urL("transaksi/export_detail_item/") ?>`+$('#toko').val()+`">Detail Items</a></li>
                        `;
                    console.log(data);
            } else {
                console.warn('ERROR CAUGHT!: UNKNOWN');
            }
        }

        xhr.open('get', '<?= base_url('transaksi/get_data_toko/') ?>' + $('#toko').val());
        xhr.send();

        $(document).ready(function(){
            $('#toko').change(function(){ 
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url('transaksi/get_data_toko/');?>" + id,
                    method : "POST",
                    data : {id_toko: id},
                    async : true,
                    dataType : 'json',
                    destroy : true,
                    success: function(data){
                        console.log(data);
                        var impl = '';
                            impl += `
                                <a class="dropdown-item" href="<?php echo base_urL("transaksi/export_transaksi/") ?>`+$('#toko').val()+`">Transaksi</a>
                                <a class="dropdown-item" href="<?php echo base_urL("transaksi/export_detail_item/") ?>`+$('#toko').val()+`">Detail Items</a>
                                `;
                        $('#export').html(impl);
                    }
                });
                return false;
            }); 

        });
    </script>
    <script>
        const jumxhr = new XMLHttpRequest();
        const jumtrans = document.getElementById('jumlahtrans');

        jumxhr.onload = function() {
            if (this.status === 200) {
                var data = JSON.parse(jumxhr.responseText);
                        jumtrans.innerHTML += `
                            <div>${data}</div>
                        `;
                    console.log(data);
            } else {
                console.warn('ERROR CAUGHT!: UNKNOWN');
            }
        }

        jumxhr.open('get', '<?= base_url('transaksi/get_jumlahtrans/') ?>' + $('#toko').val());
        jumxhr.send();

        $(document).ready(function(){
            $('#toko').change(function(){ 
                var id = $(this).val();
                $.ajax({
                    url : "<?php echo base_url('transaksi/get_jumlahtrans/');?>" + id,
                    method : "POST",
                    data : {id_toko: id},
                    async : true,
                    dataType : 'json',
                    destroy : true,
                    success: function(data){
                        console.log(data);
                        var jumtrans = '';
                            jumtrans += `
                                ${data} 
                            `;
                        $('#jumtrans').html(jumtrans);
                    }
                });
                return false;
            }); 

        });
    </script>
</body>

</html>