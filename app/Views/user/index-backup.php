<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">
<div class="section-header">
    <h1>User Detail</h1>
</div>
<div class="section-body">
<div class="row">
        <div class="col-lg-8">
        <?php if (session()->get('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>
        <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="<?= base_url('/img/user-profile/' . user()->user_image); ?>" class="img-fluid rounded-start" alt="<?= user()->user_image; ?>">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= user()->username; ?></h5>
                <ul class="list-group list-group-flush">
                <li class="list-group-item"><?= user()->fullname; ?></li>
                    <?php if(user()->nik) : ?>
                    <li class="list-group-item"><?= user()->nik; ?></li>
                    <?php endif; ?>
                    <li class="list-group-item"><?= user()->email; ?></li>
                    <li class="list-group-item"><?= user()->telp; ?></li>
                    <li class="list-group-item">
                        <small><a href="<?= base_url(); ?>">&laquo; Kembali</a></small>
                        <small class="m-3">||</small>
                        <small><a href="<?= base_url('/user/edit');?>">Edit Profile</a></small>
                    </li>
                </ul>
            </div>
            </div>
        </div>
        </div>
        </div>
    </div> 
</div>
</section>

<?= $this->endSection(); ?>