<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absenss</title>
    
    <?php $this->load->view('style/head') ?>
</head>

<body class="bg-[#fff]">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card shadow">
                    <div class="card-body">
                        <center class="mt-4">
                            <h2 class="card-title mt-2"><?php echo $row["nama_lengkap"]; ?></h2>
                            <h4 class="card-subtitle"><?php echo $row["tmpt_lahir"]; ?>,
                                <?php echo $row["tgl_lahir_tampil"]; ?></h4>
                        </center>
                    </div>
                    <div>
                        <hr />
                    </div>
                    <div class="card-body">
                        <large class="text-muted">No Telepon / WA </large>
                        <h6><?php echo $row["no_telepon"]?></h6>
                        <large class="text-muted pt-4 db">Alamat</large>
                        <h6><?php echo $row["alamat"]?></h6>
                        <large class="text-muted pt-4 db">Kategori</large>
                        <h6><?php echo $row["kategori"]?></h6>
                        <large class="text-muted pt-4 db">Status</large>
                        <h6><?php echo $row["status"]?></h6>

                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card shadow">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-timeline-tab" data-bs-toggle="pill"
                                href="#current-month" role="tab" aria-controls="pills-timeline"
                                aria-selected="true">History Absenss</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#last-month"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Masukan & Saran</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="current-month" role="tabpanel"
                            aria-labelledby="pills-timeline-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 d-flex align-items-stretch">
                                        <div class="card card-hover w-100">
                                            <div class="card-body bg-light-success">
                                                <div class="row">
                                                    <div class="col-12 d-flex align-items-center ">
                                                        <div>
                                                            <h4 class="mb-0">Tanggal Terakhir Hadir</h4>
                                                            <h5 class="mb-0">21 Nov 2023</h5>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-4 d-flex align-items-stretch">

                                        <div class="card card-hover w-100">
                                            <div class="card-body bg-light-warning">
                                                <div class="row">
                                                    <div class="col-12 d-flex align-items-center ">
                                                        <div>
                                                            <h4 class="mb-0">Tanggal Terakhir Ijin</h4>
                                                            <h5 class="mb-0">14 Nov 2023</h5>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-4">

                                        <div class="card card-hover w-100">
                                            <div class="card-body bg-light-danger">
                                                <div class="row">
                                                    <div class="col-12 d-flex align-items-center ">
                                                        <div>
                                                            <h4 class="mb-0">Tanggal Terakhir Alpha</h4>
                                                            <h5 class="mb-0">17 Nov 2023</h5>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label for="">Tanggal Awal</label>
                                            <input type="date" id="tanggalawal" class="validate form-control"
                                                name="tanggalawal">
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="">Tanggal Akhir</label>
                                            <input type="date" id="tanggalakhir" class="validate form-control"
                                                name="tanggalakhir">
                                        </div>
                                        <div class="form-group col-4 d-flex align-items-end">
                                            <div class="">
                                                <button type="submit" class="btn btn-info">Tampilkan</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Diagram Perbandingan</h4>
                                                    <canvas id="myChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card-body">
                            <div class="col-md-12 mt-n2 mb-3">
                        <label for="nama" class="form-label">Kode Unik</label>
                        <?php  'class="form-control" id="nama" autocomplete="off" placeholder=""' ?>
                    </div>
                            <div class="">
                                        <input type="hidden" class="form-control" name="id_user"
                                            value="">
                                        <textarea class="" name="kritik" id="ckeditor" required=""></textarea>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('style/js') ?>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

$("form").submit(function(e) {
    var totalcontentlength = CKEDITOR.instances['ckeditor'].getData().replace(/<[^>]*>/gi, '').length;
    if (!totalcontentlength) {
        alert('Isi Terlebih Dahulu!');
        e.preventDefault();
    }
});

    var ctx = document.getElementById('myChart').getContext('2d');

    var data = <?php echo json_encode($chart_data); ?>;

    var labels = [];
    var values = [];

    data.forEach(function(item) {
        labels.push(item.label);
        values.push(item.value);
    });

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Chart Data',
                data: values,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</html>