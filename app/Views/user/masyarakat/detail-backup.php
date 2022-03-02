<?= $this->extend('templates/index'); ?>
<?= $this->section('user-content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Pengaduan</h1>
    
    <div class="row">
        <div class="col-12">
        <div class="card">
        <div class="card-header">
            <h4>Table Pengaduan</h4>
        </div>
        <div class="card-body">
        <?php if (session()->get('message')) : ?>
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
        <?php endif; ?>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Judul Pengaduan</th>
                <th scope="col">Tanggal Pengaduan</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1?>
                <?php foreach($pengaduan as $p) : ?>
                <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $p->judul; ?></td>
                <td><?= $p->tgl_pengaduan; ?></td>
                <td class="<?php if($p->status == 0){echo 'badge badge-danger';} elseif($p->status == 'verifikasi'){echo 'badge badge-primary';}elseif($p->status == 'proses'){echo 'badge badge-warning';}else{echo 'badge badge-success';} ?> mt-2">
                   <small> <?php if($p->status == 0){ echo "Belum Diverifikasi";} ?>
                    <?php if($p->status == 'verifikasi'){ echo "Sudah Diverifikasi";} ?>
                    <?php if($p->status == 'proses'){ echo "Sedang Diproses";} ?>
                    <?php if($p->status == 'selesai'){ echo "Sudah Ditanggapi";} ?></small>
                </td>
                <td>
                    <a class="btn btn-primary" href="<?= base_url('pengaduan/detail/' . $p->id_pengaduan); ?>">Detail</a>

                    <?php if($p->status == 0) : ?>
                    <a class="btn btn-warning" href="<?= base_url('pengaduan/edit/' . $p->id_pengaduan); ?>">Edit</a>
                    <a href="<?= base_url('pengaduan/delete/' . $p->id_pengaduan); ?>" class="btn btn-danger" onclick="return confirm('Apakah yakin ingin Menghapus data ini?')">Delete</a>
                    <?php endif; ?>
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

<?= $this->endSection(); ?>