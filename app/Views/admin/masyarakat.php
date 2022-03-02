<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">
    <!-- Page Heading -->
    <div class="section-header">
    <h1>Manage user masyarakat</h1>
    <div class="section-header-button">
        <a href="<?= base_url(); ?>/admin/tambahmasyarakat" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </div>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
        <div class="breadcrumb-item">Masyarakat</div>
    </div>
    </div>
    <div class="section-body">
    
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Table Masyarakat</h4>
                <div class="card-header-action">
                      <!-- <form method="post" action="" autocomplete="off" >
                        <div class="input-group">
                          <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" placeholder="Search">
                          <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit" name="submit"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form> -->
                </div>
            </div>

            <div class="card-body">
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
        <div class="table-responsive">
        <table class="table table-striped" id="datapengaduan">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach($users as $user) : ?>
                <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $user->username; ?></td>
                <td><?= $user->email; ?></td>
                <td><?= $user->telp; ?></td>
                <td>
                    <a href="<?= base_url('admin/' . $user->userid); ?>" class="btn btn-primary">Detail</a>
                    <form action="<?= base_url('admin/delete/' . $user->userid); ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah yakin ingin Menghapus data ini?')">Delete</button>
                    </form>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>
</div>
    </div>
    </div>
</section>

<?= $this->endSection(); ?>
