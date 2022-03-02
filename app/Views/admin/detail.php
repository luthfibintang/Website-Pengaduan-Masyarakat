<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

    <!-- Page Heading -->
    <section class="section">
    <div class="section-header">
    <?php if($user->name == 'masyarakat') : ?>
        <div class="section-header-back">
            <a href="<?= base_url('/admin/masyarakat'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Masyarakat Detail</h1>
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= base_url('/admin/petugas'); ?>">Masyarakat</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    <?php elseif($user->name == 'petugas') : ?>
        <div class="section-header-back">
            <a href="<?= base_url('/admin/petugas'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Petugas Detail</h1>
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= base_url('/admin/petugas'); ?>">Petugas</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    <?php endif; ?>
    </div>
    <div class="col-lg">
        <?php if (session()->get('message')) : ?>
            <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= session()->getFlashdata('message'); ?>
            </div> -->

        <?php elseif (session()->get('success')) : ?>
            <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= session()->getFlashdata('success'); ?>
            </div> -->
        <?php endif; ?>
        <div class="swaldata" data-flashdata="<?= session()->getFlashdata('success'); ?>"></div>
        <div class="red" data-red="<?= session()->getFlashdata('message'); ?>"></div>
    <div class="section-body">
    <div class="row">
        <div class="col-lg-8">
        <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="<?= base_url('/img/user-profile' . '/' . $user->user_image); ?>" class="img-fluid rounded-start" alt="<?= $user->username; ?>">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= $user->username; ?>
                <?php if($user->name == 'masyarakat') :?>
                    <small class="badge badge-success" style="font-size: 10px;"><?= $user->name; ?> </small>
                <?php else : ?>
                    <small class="badge badge-warning" style="font-size: 10px;"><?= $user->name; ?> - <?= $user->userid; ?></small>
                <?php endif; ?> 
                </h5>
                <ul class="list-group list-group-flush">
                <li class="list-group-item"><?= $user->fullname; ?></li>
                    <?php if($user->nik) : ?>
                    <li class="list-group-item"><?= $user->nik; ?></li>
                    <?php endif; ?>
                    <li class="list-group-item"><?= $user->email; ?></li>
                    <li class="list-group-item"><?= $user->telp; ?></li>
                    <li class="list-group-item">
                        <?php if($user->name == 'masyarakat') : ?>
                        <a class="btn btn-warning btn-sm" href="<?= base_url('/admin/editmasyarakat') . '/' . $user->userid; ?>">Edit</a>
                        <?php else :?>
                        <a class="btn btn-warning btn-sm" href="<?= base_url('/admin/editpetugas') . '/' . $user->userid; ?>">Edit</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>
    </div>
    </section>

<?= $this->endSection(); ?>