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
    <title>Absensi</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('package/assets/images/logo-pos.png')?>" />
    <style>
    .card-dashboard {
        background-color: white;
        border: 1px solid #9DB2BF;
    }

    .scroll-table {
        overflow-y: scroll;
        overflow-x: hidden;
        max-height: 450px;
    }

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 360px;
        max-width: 100%;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
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
            <div class="page-wrapper" style="min-height: 100vh; background-color: #EFF5F5 ">
                <div class="page-breadcrumb">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 col-lg-8">
                            <div class="card w-100">
                                <div class="py-2 px-4 border-bottom">
                                    <h3 class="">Dashboard</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2">
                                                    <span class="text-primary display-5"><i
                                                            class="ri-user-fill"></i></span>
                                                </div>
                                                <div>
                                                    <span class="text-muted">Total Jamaah</span>
                                                    <h3 class="font-medium mb-0"><?php echo $total_jamaah; ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2">
                                                    <span class="text-primary display-5"><i
                                                            class="ri-todo-fill"></i></span>
                                                </div>
                                                <div>
                                                    <span class="text-muted">Data Absensi</span>
                                                    <h3 class="font-medium mb-0"><?php echo $total_absensi; ?></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-4 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2">
                                                    <span class="text-primary display-5"><i class="ri-calendar-fill"></i></span>
                                                </div>
                                                <div>
                                                    <span class="text-muted">Total Kegiatan</span>
                                                    <h3 class="font-medium mb-0"><?php echo $total_daftar_kegiatan; ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <figure class="">
                                    <div id="container"></div>
                                    <p class="highcharts-description">
                                    </p>
                                </figure>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <div>
                                <div class="">
                                    <div id="containerr"></div>
                                </div>
                            </div>
                            <div>
                                <div class="">
                                    <div id="containerrr"></div>
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
</body>
<script type="text/javascript">
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Rekap Absensi',
            align: 'left'
        },

        subtitle: {
            text: '',
            align: 'left'
        },

        yAxis: {
            title: {
                text: 'Angka Absens'
            }
        },

        xAxis: {
            accessibility: {
                rangeDescription: 'Range is a year, current year is: <?php echo date('Y') ?>'
            }
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: <?php echo date('Y') ?>
            }
        },

        series: [{
            name: 'Hadir',
            data: [<?php echo $rekap_hadir ?>]
        }, {
            name: 'Ijin',
            data: [<?php echo $rekap_ijin ?>]
        }, {
            name: 'Alpha',
            data: [<?php echo $rekap_alpha ?>]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
    Highcharts.chart('containerr', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Kategori Usia'
        },
        tooltip: {
            valueSuffix: '%'
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: [{
                    enabled: true,
                    distance: 20
                }, {
                    enabled: true,
                    distance: -40,
                    format: '{point.percentage:.1f}%',
                    style: {
                        fontSize: '1.2em',
                        textOutline: 'none',
                        opacity: 0.7
                    },
                    filter: {
                        operator: '>',
                        property: 'percentage',
                        value: 10
                    }
                }]
            }
        },
        series: [{
            name: 'Percentage',
            colorByPoint: true,
            data: [{
                    name: 'Lansia',
                    y: <?php echo $kategori_lansia ?>
                },
                {
                    name: 'Umum',
                    y: <?php echo $kategori_umum ?>
                },
                {
                    name: 'Remaja',
                    y: <?php echo $kategori_remaja ?>
                }
            ]
        }]
    });
    Highcharts.chart('containerrr', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Status'
        },
        tooltip: {
            valueSuffix: '%'
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: [{
                    enabled: true,
                    distance: 20
                }, {
                    enabled: true,
                    distance: -40,
                    format: '{point.percentage:.1f}%',
                    style: {
                        fontSize: '1.2em',
                        textOutline: 'none',
                        opacity: 0.7
                    },
                    filter: {
                        operator: '>',
                        property: 'percentage',
                        value: 10
                    }
                }]
            }
        },
        series: [{
            name: 'Percentage',
            colorByPoint: true,
            data: [{
                    name: 'Pribumi',
                    y: <?php echo $status_pribumi ?>
                },
                {
                    name: 'Pendatang',
                    y: <?php echo $status_pendatang ?>
                },
            ]
        }]
    });
</script>

</html>