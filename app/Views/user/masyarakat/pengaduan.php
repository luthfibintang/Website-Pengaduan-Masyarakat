<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

<!-- Page Heading -->
<div class="section-header">
<h1>Tulis Pengaduan</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
    <div class="breadcrumb-item">Pengaduan</div>
</div>
</div>

<div class="section-body">

<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4>Tulis Pengaduan dibawah</h4>
        </div>
    <div class="card-body">
    <?= view('Myth\Auth\Views\_message_block') ?>

        <form action="<?= base_url('') ?>/pengaduan/tulis" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
                <div class="form-group">
                    <label for="floatingTextarea2">Judul</label>
                    <input type="text" name="judul" class="form-control <?= ($validation->hasError('judul'))? 'is-invalid' : ''; ?>" placeholder="" value="<?= old('judul'); ?>" id="judul"></input>
                    <div class="invalid-feedback">
                      <?= $validation->getError('judul'); ?>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="floatingTextarea2">Isi laporan</label>
                    <textarea name="isi_laporan" class="form-control <?= ($validation->hasError('isi_laporan'))? 'is-invalid' : ''; ?>" placeholder="" value="<?= old('isi_laporan'); ?>" id="floatingTextarea2" style="height: 100px"></textarea>
                    <div class="invalid-feedback">
                      <?= $validation->getError('isi_laporan'); ?>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="floatingTextarea2">Lokasi Pengaduan</label>
                    <input type="text" name="lokasi" class="form-control <?= ($validation->hasError('lokasi'))? 'is-invalid' : ''; ?>" placeholder="" value="<?= old('lokasi'); ?>" id="judul"></input>
                    <div class="invalid-feedback">
                      <?= $validation->getError('lokasi'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="foto">Bukti Pengaduan</label>
                <div class="col-sm-7">
                    <img src="/img/pengaduan/download.jpg"  class="img-thumbnail img-preview mb-3">
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input <?= ($validation->hasError('foto'))? 'is-invalid' : ''; ?>" id="user_image" name="foto" onchange="previewProfile()" value="<?= old('foto'); ?>">
                    <label class="custom-file-label" for="user_image">Pilih bukti pengaduan</label>
                    <div class="invalid-feedback">
                    <?= $validation->getError('foto'); ?>
                </div>
                </div>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select class="form-control selectric <?= ($validation->hasError('kategori'))? 'is-invalid' : ''; ?>" multiple="multiple" name="kategori[]">
                    <option value="">Pilih Kategori</option>
                    <?php foreach($category as $cat) : ?>
                    <option value="<?= $cat->id_kategori; ?>"><?= $cat->nama_kategori; ?></option>
                    <?php endforeach?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('kategori'); ?>
                </div>
            </div>
            <div class="form-group" style="margin-left: -30px;">
                      <label class="custom-switch mt-2">
                        <input type="checkbox" name="urgent" value="urgent" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">klik switch jika pengaduan bersifat urgent</span>
                      </label>
                    </div>
            </div>
            <button type="submit" id="swal-2" class="btn btn-primary btn-user">
                Kirim Pengaduan
            </button>
        </form>
    </div>
</div>
</div>
</div>
</div>
</section>

<?= $this->endSection(); ?>