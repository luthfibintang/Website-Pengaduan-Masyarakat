<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

<!-- Page Heading -->
<div class="section-header">
<h1>Edit Profile</h1>
</div>

<div class="section-body">
<div class="row">
    <div class="col-lg">

    <?= view('Myth\Auth\Views\_message_block') ?>

        <form action="<?= base_url('user/updateprofile/' . user()->id) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= user()->id ?>">
            <input type="hidden" name="old_userImage" value="<?= user()->user_image ?>" >
            <div class="form-group">
                <label for="foto">Foto Profile</label>
                <div class="col-sm-2">
                    <img src="/img/user-profile/<?= user()->user_image; ?>"  class="img-thumbnail img-preview mb-3">
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input <?= ($validation->hasError('user_image'))? 'is-invalid' : ''; ?>" id="user_image" name="user_image" onchange="previewProfile()">
                    <label class="custom-file-label" for="user_image">Pilih untuk mengubah Foto Profile</label>
                    <div class="invalid-feedback">
                    <?= $validation->getError('user_image'); ?>
                </div>
                </div>
            </div>
            <?php if(in_groups('masyarakat')) : ?>
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control <?= ($validation->hasError('nik'))? 'is-invalid' : ''; ?>" id="nik" name="nik" value="<?= ($validation->hasError('nik')) ? old('nik') : user()->nik ?>" >
                <div class="invalid-feedback">
                    <?= $validation->getError('nik'); ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="fullname" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control <?= ($validation->hasError('fullname'))? 'is-invalid' : ''; ?>" id="fullname" name="fullname" value="<?= ($validation->hasError('fullname')) ? old('fullname') : user()->fullname ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('fullname'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><?=lang('Auth.email')?></label>
                <input type="email" class="form-control <?= ($validation->hasError('email'))? 'is-invalid' : ''; ?>" id="email" value="<?= ($validation->hasError('email')) ? old('email') : user()->email ?>" name="email">
                <div class="invalid-feedback">
                    <?= $validation->getError('email'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><?=lang('Auth.username')?></label>
                <input type="text" class="form-control form-control-user <?= ($validation->hasError('username'))? 'is-invalid' : ''; ?>" value="<?= ($validation->hasError('username')) ? old('username') : user()->username ?>"  name="username" >
                <div class="invalid-feedback">
                    <?= $validation->getError('username'); ?>
                </div>
            </div>
            <div class="form-group">
		        <label for="phone">Nomor Telepon</label>
		        <input type="phone" class="form-control <?= ($validation->hasError('telp'))? 'is-invalid' : ''; ?>" name="telp" value="<?= ($validation->hasError('telp')) ? old('telp') : user()->telp ?>" >
                <div class="invalid-feedback">
                    <?= $validation->getError('telp'); ?>
                </div>
            </div>
            <a href="<?= base_url('/user'); ?>" class="btn btn-info mr-2">Kembali</a>
            <button type="submit" class="btn btn-primary btn-user">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
</div>
</section>

<?= $this->endSection(); ?>