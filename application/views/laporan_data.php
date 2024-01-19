<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php $this->load->view('style/head') ?>

</head>

<body>
    <div>
        <div>
            <center>
                <div class="">
                    <h2>Laporan Absensi</h2>
                    <h4>Kelompok Taman Lele</h4>
                </div>
                <hr />
            </center>
        </div>
        <table class="w-100">
            <tr>
                <th>
                    <div style="text-align: left">
                        Kegiatan :
                        <br />
                        <br />
                        Tanggal :
                    </div>
                </th>
                <th>
                    <div style="text-align: center">
                        Hadir
                        <br />
                        <h3 style="text-align: right">82 %</h3>
                    </div>
                </th>
                <th>
                    <div style="text-align: center">
                        Ijin
                        <br />
                        <h3 style="text-align: right">82 %</h3>
                    </div>
                </th>
                <th>
                    <div style="text-align: center">
                        Alpha
                        <br />
                        <h3 style="text-align: right">82 %</h3>
                    </div>
                </th>
               
            </tr>
        </table>
        <div class="mt-5">
            <table class="tablee table-hover table-white w-100 ">
                <thead>
                    <tr>
                        <th class="">No</th>
                        <th class="">Nama Jamaah</th>
                        <th class="">Kehadiran</th>
                        <th>keterangan</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div>
            <table class="table">
                <tr>
                    <th style="width: 33%">
                    </th>
                    <th style="width: 33%">
                    </th>
                    <th style="width: 33%">
                    </th>
                </tr>
                <tr>
                    <td style="text-align: center">
                        Mengetahui
                        <br />
                        penerobos
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        (nama)
                    </td>
                    <td style="text-align: center">
                       
                    </td>
                    <td style="text-align: center">
                        Mengetahui
                        <br />
                        Kyai Kelompok
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        (nama)
                    </td>
                </tr>
            </table>
        </div>
</body>
<?php $this->load->view('style/js') ?>

<script>
window.print();
</script>
<script>

</script>

</html>