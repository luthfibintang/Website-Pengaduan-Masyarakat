<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">
    <!-- Page Heading -->
    <div class="section-header">
    <h1>Manage Divisi & Kategori</h1>
    <div class="section-header-button">
        <a href="<?= base_url(); ?>/admin/tambahdivisi" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </div>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
        <div class="breadcrumb-item">Divisi</div>
    </div>
    </div>
    <div class="section-body">
    
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Table Divisi & Kategori</h4>
                <div class="card-header-action">
                </div>
            </div>

            <div class="card-body">
        <div class="swaldata" data-flashdata="<?= session()->getFlashdata('success'); ?>"></div>
        <div class="red" data-red="<?= session()->getFlashdata('message'); ?>"></div>
        <div class="table-responsive">
        <table class="table table-striped" id="datapengaduan">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Divisi</th>
                <th scope="col">Kategori</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach($kategori as $kat) : ?>
                <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $kat->name; ?></td>
                <td><?= $kat->nama_kategori; ?></td>
                <td>
                    <form action="<?= base_url('admin/deletediv/' . $kat->id_cat); ?>" method="post" class="d-inline">
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
