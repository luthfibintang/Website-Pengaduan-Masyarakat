<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

<!-- Page Heading -->
<div class="section-header">
<div class="section-header-back">
    <a href="<?= base_url('/admin/petugas'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
</div>
<h1>Tambah Petugas</h1>
<div class="section-header-breadcrumb">
<div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
    <div class="breadcrumb-item active"><a href="<?= base_url('/admin/petugas'); ?>">Petugas</a></div>
    <div class="breadcrumb-item">Tambah</div>
</div>
</div>
<div class="section-body">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
        <form action="<?= base_url() ?>/admin/addptgs" method="post">
            <div class="mb-3">
                <label for="fullname" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control <?= ($validation->hasError('fullname'))? 'is-invalid' : ''; ?>" id="fullname" name="fullname" value="<?= old('fullname'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('fullname'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><?=lang('Auth.email')?></label>
                <input type="email" class="form-control <?= ($validation->hasError('email'))? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('email'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><?=lang('Auth.username')?></label>
                <input type="text" class="form-control form-control-user <?= ($validation->hasError('username'))? 'is-invalid' : ''; ?>"  name="username" value="<?= old('username') ?>" >
                <div class="invalid-feedback">
                    <?= $validation->getError('username'); ?>
                </div>
            </div>
            <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="email" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control form-control-user <?= ($validation->hasError('password'))? 'is-invalid' : ''; ?>" autocomplete="off" value="<?= old('password') ?>" >
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <label for="email" class="form-label">Repeat Password</label>
                        <input type="password" class="form-control form-control-user <?= ($validation->hasError('pass_confirm'))? 'is-invalid' : ''; ?>" name="pass_confirm" autocomplete="off" value="<?= old('pass_confirm') ?>" >
                        <div class="invalid-feedback">
                            <?= $validation->getError('pass_confirm'); ?>
                        </div>
                    </div>
                </div>
            <div class="form-group">
		        <label for="phone">Phone number</label>
		        <input type="phone" class="form-control <?= ($validation->hasError('telp'))? 'is-invalid' : ''; ?>" name="telp" value="<?= old('telp') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('telp'); ?>
                </div>
	        </div>
            <div class="form-group">
                    <label for="divisi" class="form-label">Divisi</label>
                    <select name="divisi" id="divisi" class="form-control selectric <?= ($validation->hasError('divisi'))? 'is-invalid' : ''; ?>" <?php if($validation->hasError('divisi')){ echo "autofocus";}; ?>>
                        <option value="">-- Pilih Divisi --</option>
                        <?php foreach($divisi as $d) :?>
                        <option value="<?= $d->name; ?>"><?= $d->name; ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                    <?= $validation->getError('divisi'); ?>
                     </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-user">
                Tambah Petugas
            </button>
        </form>
    </div>
</div>
    </div>
</div>

</div>
</section>

<?= $this->endSection(); ?>