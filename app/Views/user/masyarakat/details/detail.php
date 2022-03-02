<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

    <!-- Page Heading -->
    <div class="section-header">
    <h1>Detail Pengaduan</h1>
    <div class="section-header-button">
        <a href="<?= base_url(); ?>/pengaduan" class="btn btn-primary"><i class="fas fa-edit"></i></a>
    </div>
    <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
    <div class="breadcrumb-item">History</div>
    </div>
    </div>

    <div class="section-body">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Table Pengaduan</h4>
                <!-- <div class="card-header-action">
                      <form method="post" action="" autocomplete="off" >
                        <div class="input-group">
                          <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" placeholder="Search">
                          <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit" name="submit"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                </div> -->
            </div>
            <div class="card-body">
        <?php if (session()->get('message')) : ?>
            <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= session()->getFlashdata('message'); ?> -->
            </div>
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
        <table class="table" id="datapengaduan">
            <thead>
                <tr>
                <th scope="col" class="align-center">No</th>
                <th scope="col">Judul Pengaduan</th>
                <th scope="col">Tanggal Pengaduan</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;?>
                <?php foreach($pengaduan as $p) : ?>
                <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $p['judul']; ?></td>
                <td><?= $p['tgl_pengaduan']; ?></td>
                <td>
                   <div class="<?php if($p['status'] == '0'){echo 'badge badge-danger';} elseif($p['status'] == 'verifikasi'){echo 'badge badge-primary';}elseif($p['status'] == 'proses'){echo 'badge badge-warning';}elseif($p['status'] == 'tolak'){echo 'badge badge-danger';}else{echo 'badge badge-success';} ?>"> 
                   <?php if($p['status'] == '0'){ echo "Belum Diverifikasi";} ?>
                    <?php if($p['status'] == 'verifikasi'){ echo "Sudah Diverifikasi";} ?>
                    <?php if($p['status'] == 'proses'){ echo "Sedang Diproses";} ?>
                    <?php if($p['status'] == 'tolak'){ echo "Pengaduan Ditolak";} ?>
                    <?php if($p['status'] == 'selesai'){ echo "Sudah Ditanggapi";} ?></div>
                </td>
                <td>
                    <?php if($p['status'] == 0) : ?>
                    <a class="btn btn-warning" href="<?= base_url('pengaduan/editform/' . $p['id_pengaduan']); ?>"><i class="fas fa-pencil-alt"></i></a>
                    <a href="<?= base_url('pengaduan/delete/' . $p['id_pengaduan']); ?>" class="btn btn-danger btn-hapus"><i class="fas fa-trash"></i></a>
                    <?php endif; ?>
                    <?php if($p['status'] != 'selesai') : ?>
                    <a class="btn btn-primary" data-toggle="tooltip" href="<?= base_url('pengaduan/detail/' . $p['id_pengaduan']); ?>"><i class="fas fa-info"></i></a>
                    <?php else :?>
                    <a class="btn btn-success" href="<?= base_url('pengaduan/selesai/' . $p['id_pengaduan']); ?>">Cek Tanggapan</a>
                    <?php endif; ?>
                </td>
                </tr>
                <?php endforeach;?>
            </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
    </div>
</section>



<?= $this->endSection(); ?>