<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

<!-- Page Heading -->
<div class="section-header">
<div class="section-header-back">
    <a href="<?= base_url('admin/' . $user->id); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
</div>
<h1>Edit Masyarakat</h1>
<div class="section-header-breadcrumb">
<div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
    <div class="breadcrumb-item active"><a href="<?= base_url('/admin/petugas'); ?>">Masyarakat</a></div>
    <div class="breadcrumb-item">Edit</div>
</div>
</div>

<div class="section-body">
<div class="row">
    <div class="col-12">

    <?= view('Myth\Auth\Views\_message_block') ?>
        <div class="card">
            <div class="card-body">
        <form action="<?= base_url('admin/update/' . $user->id) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $user->id; ?>">
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control <?= ($validation->hasError('nik'))? 'is-invalid' : ''; ?>" id="nik" name="nik" value="<?= ($validation->hasError('nik')) ? old('nik') : $user->nik ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('nik'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="fullname" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control <?= ($validation->hasError('fullname'))? 'is-invalid' : ''; ?>" id="fullname" name="fullname" value="<?= ($validation->hasError('fullname')) ? old('fullname') : $user->fullname ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('fullname'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><?=lang('Auth.email')?></label>
                <input type="email" class="form-control <?= ($validation->hasError('email'))? 'is-invalid' : ''; ?>" id="email" value="<?= ($validation->hasError('email')) ? old('email') : $user->email ?>" name="email">
                <div class="invalid-feedback">
                    <?= $validation->getError('email'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><?=lang('Auth.username')?></label>
                <input type="text" class="form-control form-control-user <?= ($validation->hasError('username'))? 'is-invalid' : ''; ?>" value="<?= ($validation->hasError('username')) ? old('username') : $user->username ?>"  name="username" >
                <div class="invalid-feedback">
                    <?= $validation->getError('username'); ?>
                </div>
            </div>
            <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="email" class="form-label">Password</label>
                        <input type="password" name="password" placeholder="Biarkan Kosong jika tidak ingin mengganti password" class="form-control form-control-user <?= ($validation->hasError('password'))? 'is-invalid' : ''; ?>" autocomplete="off" value="<?= old('password') ?>" >
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
            <div class="form-group">
		        <label for="phone">Phone number</label>
		        <input type="phone" class="form-control <?= ($validation->hasError('telp'))? 'is-invalid' : ''; ?>" name="telp" value="<?= ($validation->hasError('telp')) ? old('telp') : $user->telp ?>" >
                <div class="invalid-feedback">
                    <?= $validation->getError('telp'); ?>
                </div>
	        </div>
            <button type="submit" class="btn btn-primary btn-user">
                Edit Masyarakat
            </button>
        </form>
    </div>
</div>
    </div>
</div>

</div>
</section>

<?= $this->endSection(); ?>