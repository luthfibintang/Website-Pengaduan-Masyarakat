<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

    <!-- Page Heading -->
    <div class="section-header">
    <h1>Detail Pengaduan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
        <div class="breadcrumb-item">Selesai</div>
    </div>
    </div>
    
    <div class="section-body">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h4>Pengaduan selesai</h4>
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
        <!-- <?php if (session()->get('message')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= session()->getFlashdata('message'); ?>
            </div>

        <?php elseif (session()->get('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?> -->
        <div class="swaldata" data-flashdata="<?= session()->getFlashdata('success'); ?>"></div>
        <div class="red" data-red="<?= session()->getFlashdata('message'); ?>"></div>
        
        <div class="table-responsive">
        <table class="table table-striped" id="datapengaduan">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Judul Pengaduan</th>
                <th scope="col">Tanggal Pengaduan</th>
                <th scope="col">Tanggal Tanggapan</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach($pengaduan as $p) :?>
                <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $p['judul']; ?></td>
                <td><?= $p['tgl_pengaduan']; ?></td>
                <td><?= $p['tgl_tanggapan']; ?></td>
                <td>
                    <div class="badge badge-success">
                    <?php if($p['status'] == 'selesai'){ echo "Sudah Ditanggapi";} ?>
                    </div>
                </td>
                <td>
                    <a class="btn btn-primary" href="<?= base_url('tanggapan/detail/' . $p['id_pengaduan']); ?>">Detail</a>
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
    </div>
</section>

<?= $this->endSection(); ?>