<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

    <div class="section-header">
    <div class="section-header-back">
        <a href="<?= base_url('/pengaduan/details'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Detail Tanggapan</h1>
    <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
    <div class="breadcrumb-item active"><a href="<?= base_url('/pengaduan/details'); ?>">History</a></div>
    <div class="breadcrumb-item">Detail</div>
    </div>
    </div>
    
    <div class="section-body">
    <div class="row">
        <div class="col-lg">
        <div class="row row-cols-1 row-cols-md-2 g-2 mt-2 mb-3">
            <div class="col">
                <div class="card">
                <div class="card-header">
            <h4>Pengaduan</h4>
                </div>
                <img src="<?= base_url('/img/pengaduan/' . $pengaduan->foto); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $pengaduan->judul; ?></h5>
                    <p class="card-text"><strong>Isi Laporan : </strong> <br> <?= $pengaduan->isi_laporan; ?></p>
                    <p class="card-text"><small class="text-muted">Oleh : <?= $pengaduan->nik_masyarakat; ?> || Pada Tanggal : <?= $pengaduan->tgl_pengaduan; ?></small></p>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                <div class="card-header">
                <h4>Tanggapan</h3>
                </div>
                <img src="<?= base_url('img/tanggapan/' . $tanggapan->foto); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Ditanggapi  Oleh : Petugas ID <?= $tanggapan->id_petugas; ?></h5>
                    <p class="card-text"><strong>Tanggapan :</strong> <br> <?= $tanggapan->tanggapan; ?></p>
                    <p class="card-text"><small class="text-muted">Pada Tanggal : <?= $tanggapan->tgl_tanggapan; ?></small></p>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</section>

<?= $this->endSection(); ?>