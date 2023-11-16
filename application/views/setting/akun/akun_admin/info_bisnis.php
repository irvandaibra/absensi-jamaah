<div class="col-md-6">
    <div class="d-flex justify-content-between mb-n3">
        <div>
            <h5>INFO BISNIS</h5>
        </div>
        <div>
            <h6><a href="<?php echo base_url('akun/ubah_info_bisnis')?>">Ubah</a></h6>
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
            <p class="text-secondary">Provinsi</p>
        </div>
        <div>
            <p class="fw-bold"><?php echo $akun['provinsi'] ?></p>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between mb-n4 mt-4 px-2">
        <div>
            <p class="text-secondary">Kota / Kabupaten</p>
        </div>
        <div>
            <p class="fw-bold"><?php echo $akun['kota'] ?></p>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between mb-n4 mt-4 px-2">
        <div>
            <p class="text-secondary">Kecamatan</p>
        </div>
        <div>
            <p class="fw-bold"><?php echo $akun['kecamatan'] ?></p>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between mb-n4 mt-4 px-2">
        <div>
            <p class="text-secondary">Kode Pos</p>
        </div>
        <div>
            <p class="fw-bold"><?php echo $akun['kode_pos'] ?></p>
        </div>
    </div>
    <hr>
</div>