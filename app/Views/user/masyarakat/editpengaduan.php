<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

<!-- Page Heading -->
<div class="section-header">
<div class="section-header-back">
    <a href="<?= base_url('/pengaduan/details'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
</div>
<h1>Tulis Pengaduan</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
    <div class="breadcrumb-item active"><a href="<?= base_url('/pengaduan/details'); ?>">Details</a></div>
    <div class="breadcrumb-item">Edit</div>
</div>
</div>

<div class="section-body">
<div class="row">
    <div class="col-lg-12">
    <div class="card">
        <div class="card-body">
    <?= view('Myth\Auth\Views\_message_block') ?>

        <form action="<?= base_url('') ?>/pengaduan/edit/<?= $pengaduan->id_pengaduan; ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= user()->id; ?>">
            <input type="hidden" name="old-foto" value="<?= $pengaduan->foto ?>" >
            <div class="mb-3">
                <div class="form-floating">
                    <label for="floatingTextarea2">Judul</label>
                    <input type="text" name="judul" class="form-control <?= ($validation->hasError('judul'))? 'is-invalid' : ''; ?>" placeholder="" id="judul" value="<?= ($validation->hasError('judul')) ? old('judul') : $pengaduan->judul; ?>"></input>
                    <div class="invalid-feedback">
                      <?= $validation->getError('judul'); ?>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <label for="floatingTextarea2">Isi laporan</label>
                    <textarea name="isi_laporan" class="form-control <?= ($validation->hasError('isi_laporan'))? 'is-invalid' : ''; ?>" placeholder="" id="floatingTextarea2" style="height: 100px"><?= ($validation->hasError('isi_laporan')) ? old('isi_laporan') : $pengaduan->isi_laporan; ?></textarea>
                    <div class="invalid-feedback">
                      <?= $validation->getError('isi_laporan'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="foto">Bukti Pengaduan</label>
                <div class="col-sm-7">
                    <img src="/img/pengaduan/<?= $pengaduan->foto; ?>"  class="img-thumbnail img-preview mb-3">
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input <?= ($validation->hasError('foto'))? 'is-invalid' : ''; ?>" id="user_image" name="foto" onchange="previewProfile()">
                    <label class="custom-file-label" for="user_image">Pilih jika ingin mengganti foto</label>
                    <div class="invalid-feedback">
                    <?= $validation->getError('foto'); ?>
                </div>
                </div>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select class="form-control selectric <?= ($validation->hasError('kategori'))? 'is-invalid' : ''; ?>" name="kategori">
                    <option value="<?= $pengaduan->id_kategori; ?>"><?= $pengaduan->nama_kategori; ?></option>
                    <?php foreach($category as $cat) : ?>
                    <option value="<?= $cat->id_kategori; ?>"><?= $cat->nama_kategori; ?></option>
                    <?php endforeach?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('kategori'); ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user">
                Ubah Pengaduan
            </button>
        </form>
    </div>
    </div>
    </div>
</div>
</div>
</div>
</section>

<?= $this->endSection(); ?>