<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

    <!-- Page Heading -->
    <div class="section-header">
    <h1>Detail Pengaduan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
        <div class="breadcrumb-item">proses</div>
    </div>
    </div>
    <div class="section-body">
    <form action="<?= base_url(); ?>/tanggapan/tanggapiall" method="post">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pengaduan proses</h4>
                    <div class="card-header-action">
                        <!-- <form method="post" action="" autocomplete="off" >
                            <div class="input-group">
                                <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" type="submit" name="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form> -->
                    <button class="btn btn-success mb-3" name="btntanggapi" type="submit">Tanggapi</button>
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
                <th scope="col">
                              <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                              </div>
                            </th>
                <th scope="col">No</th>
                <th scope="col">Judul Pengaduan</th>
                <th scope="col">Tanggal Pengaduan</th>
                <th scope="col">Level</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1?>
                <?php foreach($pengaduan as $p) : ?>
                <tr>
                <td>
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox" name="checkbox_value[]" data-checkboxes="mygroup" class="custom-control-input" value="<?= $p['id_pengaduan']; ?>" id="<?= $p['id_pengaduan']; ?>">
                        <label for="<?= $p['id_pengaduan']; ?>" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td scope="row"><?= $i++; ?></td>
                <td><?= $p['judul']; ?></td>
                <td><?= $p['tgl_pengaduan']; ?></td>
                <td <?php if($p['level'] == 'urgent'){echo 'style="color: red; font-weight:bold;"';}; ?>>
                    <?= $p['level']; ?>
                </td>
                <td>
                   <div class="badge badge-warning">
                    <?php if($p['status'] == 'proses'){ echo "Sedang Diproses";} ?>
                    </div>
                </td>
                <td>
                    <a class="btn btn-primary" href="<?= base_url('pengaduan/proses_detail/' . $p['id_pengaduan']); ?>">Detail</a>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </form>
                </div>
        </div>
    </div>
</div>
    </div>
    </div>
</section>

<?= $this->endSection(); ?>