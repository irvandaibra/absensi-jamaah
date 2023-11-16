<div class="col-md-6 mt-5">
    <div class="d-flex justify-content-between mb-n3">
        <div>
            <h5>ID</h5>
        </div>
        <div></div>
    </div>
    <hr>
    <div class="d-flex justify-content-between mb-n4 mt-4 px-2">
        <div>
            <p class="text-secondary">Nama</p>
        </div>
        <div>
            <p class="fw-bold"><?php echo $akun['nama_pengguna'] ?></p>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between mb-n4 mt-4 px-2">
        <div>
            <p class="text-secondary">Nomor ID</p>
        </div>
        <div>
            <p class="fw-bold">
                <?php
                    $count = strlen($akun['id']) - 6;
                    $output = substr_replace($akun['id'], str_repeat('*', $count), 3, $count);
                    echo $output;
                ?>
            </p>
        </div>
    </div>
    <hr>
</div>