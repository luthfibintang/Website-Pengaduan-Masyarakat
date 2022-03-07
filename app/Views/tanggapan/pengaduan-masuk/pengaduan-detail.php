<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

    <!-- Page Heading -->
    <div class="section-header">
    <div class="section-header-back">
    <a href="<?= base_url('pengaduan/masuk')?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Pengaduan Detail</h1>
    <div class="section-header-breadcrumb">
<div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
    <div class="breadcrumb-item active"><a href="<?= base_url('/pengaduan/masuk'); ?>">Masuk</a></div>
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
                    <h5 class="card-title" style="font-weight: bold;"><?= $pengaduan->judul; ?>
                    <small class="<?php if($pengaduan->status == 0){echo 'badge badge-danger';} elseif($pengaduan->status == 'verifikasi'){echo 'badge badge-primary';}elseif($pengaduan->status == 'proses'){echo 'badge badge-warning';}else{echo 'badge badge-success';} ?>" style="font-size: 10px;">
                        <?php if($pengaduan->status == 0){echo "Pengaduan belum di verifikasi";} ?>
                        <?php if($pengaduan->status == 'verifikasi'){ echo "Sudah Diverifikasi";} ?>
                        <?php if($pengaduan->status == 'proses'){ echo "Sedang Diproses";} ?>
                        <?php if($pengaduan->status == 'selesai'){ echo "Sudah Ditanggapi";} ?>
                    </small></h5>
                    <p class="card-text"><b>isi Laporan :</b><br> <?= $pengaduan->isi_laporan; ?></p>
                    <?php if(!empty($pengaduan->lokasi)) : ?>
                    <p class="card-text"><b>Lokasi Kejadian :</b> <?= $pengaduan->lokasi; ?></p>
                    <?php endif; ?>
                    <p class="card-text"><small class="text-muted">Oleh : <?= $pengaduan->nik_masyarakat; ?> | <?= $pengaduan->tgl_pengaduan; ?></small></p>
                </div>
                <img src="<?= base_url('/img/pengaduan' . '/' . $pengaduan->foto); ?>" class="card-img-bottom" style="width: 100%;" alt="...">
                    <?php if($pengaduan->status != 'proses') : ?>
                    <a href="<?= base_url('/pengaduan/proses/' . $pengaduan->id_pengaduan); ?>" name="submit" class="btn btn-success btn-sm mt-3 ml-3 mb-3">Proses</a>
                    <?php endif; ?>
                </div>
        </div>
        </div>
        </div>
    </div>
</div>
</section>

<?= $this->endSection(); ?>