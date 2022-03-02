<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

<!-- Page Heading -->
<div class="section-header">
<div class="section-header-back">
    <a href="<?= base_url('/admin/masyarakat'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
</div>
<h1>Tambah Masyarakat</h1>
<div class="section-header-breadcrumb">
<div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
    <div class="breadcrumb-item active"><a href="<?= base_url('/admin/masyarakat'); ?>">Masyarakat</a></div>
    <div class="breadcrumb-item">Tambah</div>
</div>
</div>

<div class="section-body">
<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
        <form action="<?= base_url() ?>/admin/addDivisi" method="post">
            <div class="mb-3">
                <label for="divisi" class="form-label">Divisi</label>
                <input type="text" class="form-control <?= ($validation->hasError('divisi'))? 'is-invalid' : ''; ?>" id="divisi" name="divisi" value="<?= old('divisi'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('nik'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control <?= ($validation->hasError('kategori'))? 'is-invalid' : ''; ?>" id="kategori" name="kategori" value="<?= old('kategori'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('fullname'); ?>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-user mb-3">
                Tambah Divisi Dan Kategori
            </button>
        </form>
    </div>
</div>
    </div>

</div>
</section>

<?= $this->endSection(); ?>