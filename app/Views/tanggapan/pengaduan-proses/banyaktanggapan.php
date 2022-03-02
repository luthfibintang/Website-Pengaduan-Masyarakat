<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

<!-- Page Heading -->
<div class="section-header">
<div class="section-header-back">
    <a href="<?= base_url('/pengaduan/proses_details'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
</div>
<h1>Tulis Pengaduan</h1>
<div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="<?= base_url('/pengaduan/proses_details'); ?>">Proses</a></div>
        <div class="breadcrumb-item">Tanggapi</div>
</div>
</div>

<div class="section-body">
<div class="row">
    <div class="col-lg">

    <div class="card">
        <div class="card-body">
    <?= view('Myth\Auth\Views\_message_block') ?>

        <form action="<?= base_url('') ?>/tanggapan/multiinsert" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <?php foreach($pengaduan as $p) : ?>
            <input type="hidden" name="id_pengaduan[]" value="<?= $p; ?>">
            <?php endforeach?>
            <div class="mb-3">
                <div class="form-floating">
                    <label for="floatingTextarea2">ID petugas</label>
                    <input type="text" name="judul" disabled class="form-control <?= ($validation->hasError('judul'))? 'is-invalid' : ''; ?>" placeholder="" id="judul" value="<?= user()->id ?>"></input>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <label for="floatingTextarea2">Tanggapan</label>
                    <textarea name="tanggapan" class="form-control <?= ($validation->hasError('tanggapan'))? 'is-invalid' : ''; ?>" placeholder="" id="floatingTextarea2" style="height: 100px"></textarea>
                    <div class="invalid-feedback">
                      <?= $validation->getError('tanggapan'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="foto">Bukti Tanggapan</label>
                <div class="col-sm-7">
                    <img src="/img/tanggapan/download.jpg"  class="img-thumbnail img-preview mb-3">
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input <?= ($validation->hasError('foto'))? 'is-invalid' : ''; ?>" id="user_image" name="foto" onchange="previewProfile()">
                    <label class="custom-file-label" for="user_image">Kirimkan Bukti tanggapan</label>
                    <div class="invalid-feedback">
                    <?= $validation->getError('foto'); ?>
                </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user">
                Tanggapi
            </button>
        </form>
    </div>
</div>
    </div>
</div>
</div>
</section>

<?= $this->endSection(); ?>