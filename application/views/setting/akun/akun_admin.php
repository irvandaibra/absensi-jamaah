<div class="col-md-6">
    <div class="d-flex justify-content-between mb-n3">
        <div>
            <h5>AKUN ADMIN</h5>
        </div>
        <div>
            <h6><a href="<?php echo base_url('akun/akun_admin')?>">Detail</a></h6>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between mb-n4 mt-4 px-2">
        <div>
            <p class="text-secondary">Nama Bisnis</p>
        </div>
        <div>
            <p class="fw-bold"><?php echo $akun['nama_bisnis'] ?></p>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between mb-n4 mt-4 px-2">
        <div>
            <p class="text-secondary">Alamat</p>
        </div>
        <div>
            <p class="fw-bold"><?php echo $akun['alamat_bisnis'] ?></p>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between mb-n4 mt-4 px-2">
        <div>
            <p class="text-secondary">Email</p>
        </div>
        <div>
            <p class="fw-bold"><?php echo $akun['email'] ?></p>
        </div>
    </div>
    <hr>
</div>