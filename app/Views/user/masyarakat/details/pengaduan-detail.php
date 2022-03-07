<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

    <!-- Page Heading -->
    <div class="section-header">
    <div class="section-header-back">
        <a href="<?= base_url('/pengaduan/details'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Pengaduan Detail</h1>
    <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
    <div class="breadcrumb-item active"><a href="<?= base_url('/pengaduan/details'); ?>">History</a></div>
    <div class="breadcrumb-item">Detail</div>
    </div>
    </div>
    
    <div class="section-body">
    <div class="row">
        <div class="col-lg">
        <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold;"><?= $pengaduan[0]['judul']; ?>
                    <small class="<?php if($pengaduan[0]['status'] == 0){echo 'badge badge-danger';} elseif($pengaduan[0]['status'] == 'verifikasi'){echo 'badge badge-primary';}elseif($pengaduan[0]['status'] == 'proses'){echo 'badge badge-warning';}elseif($pengaduan[0]['status'] == 'tolak'){echo 'badge badge-danger';}else{echo 'badge badge-success';} ?>" style="font-size: 10px;">
                        <?php if($pengaduan[0]['status'] == 0){echo "Pengaduan belum di verifikasi";} ?>
                        <?php if($pengaduan[0]['status'] == 'verifikasi'){ echo "Sudah Diverifikasi";} ?>
                        <?php if($pengaduan[0]['status'] == 'proses'){ echo "Sedang Diproses";} ?>
                        <?php if($pengaduan[0]['status'] == 'selesai'){ echo "Sudah Ditanggapi";} ?>
                        <?php if($pengaduan[0]['status'] == 'tolak'){ echo "Pengaduan Ditolak";} ?>
                    </small></h5>
                    <p class="card-text"><?= $pengaduan[0]['isi_laporan']; ?></p>
                    <?php if(!empty($pengaduan[0]['lokasi'])) : ?>
                    <p class="card-text">Lokasi : <?= $pengaduan[0]['lokasi']; ?></p>
                    <?php endif; ?>
                    <p class="card-text"><small class="text-muted">Tanggal Pengaduan : <?= $pengaduan[0]['tgl_pengaduan']; ?></small></p>
                </div>
                <img src="<?= base_url('/img/pengaduan' . '/' . $pengaduan[0]['foto']); ?>" class="card-img-bottom" style="width: 100%;" alt="...">
            </div>
        </div>
        </div>
        </div>
    </div>
</div>
</section>

<?= $this->endSection(); ?>