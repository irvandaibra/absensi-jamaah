<div class="col-md-6">
    <div class="d-flex justify-content-between mb-n3">
        <div>
            <h5>DETAIL PERSONAL</h5>
        </div>
        <div>
            <h6><a href="<?php echo base_url('akun/ubah_detail_personal')?>">Ubah</a></h6>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between mb-n4 mt-4 px-2">
        <div>
            <p class="text-secondary">Nama</p>
        </div>
        <div>
            <p class="fw-bold"><?php echo $akun['username'] ?></p>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between mb-n4 mt-4 px-2">
        <div>
            <p class="text-secondary">No Telepon</p>
        </div>
        <div>
            <p class="fw-bold"><?php echo $akun['telepon'] ?></p>
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