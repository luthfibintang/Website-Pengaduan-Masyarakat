<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>


<!-- Page Heading -->
<section class="section">

<div class="section-header">
<h1>Ubah Password</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
    <div class="breadcrumb-item">Change Password</div>
</div>
</div>


<div class="section-body">
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-body">
    <p>
        Klik tombol kirim intruksi dan kami akan mengirimkan intruksi untuk menghubah password anda.
    </p>

    <form action="<?= route_to('forgot') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="email"><?=lang('Auth.emailAddress')?></label>
            <input type="email" style="width: 600px;" class="form-control <?php if(session('error.email')) : ?>is-invalid<?php endif ?>"
                name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= user()->email; ?>">
            <div class="invalid-feedback">
                <?= session('error.email') ?>
            </div>
        </div>

        <br>

        <button type="submit" class="btn btn-primary"><?=lang('Auth.sendInstructions')?></button>
    </form>
    </div>
</div>
    </div>
</div>
</div>

</section>

<?= $this->endSection(); ?>