<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

    <!-- Page Heading -->
    
    <div class="section-body">
    <div class="row">
        <div class="col-lg col-12">
            <div class="card mb-5">
                <div class="card-header">
                    <h4>Laporan</h4>
                    <div class="float-right">
                    </div>
                </div>
                <div class="card-body">
                    <?php if($pengaduan ?? '') : ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Pengaduan</th>
                                    <th>Judul Laporan</th>
                                    <th>Isi Laporan</th>
                                    <th>Kategori</th>
                                    <th>Bukti Pengaduan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach($pengaduan as $v) : ?>
                                <tr>
                                    <td><?= $i++?></td>
                                    <td><?= $v->tgl_pengaduan; ?></td>
                                    <td><?= $v->judul; ?></td>
                                    <td><?= $v->isi_laporan; ?></td>
                                    <td><?= $v->nama_kategori; ?></td>
                                    <td><img src="<?= base_url('/img/pengaduan' . '/' . $v->foto); ?>" style="width: 200px;"></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                    <div class="text-center">
                        Tidak ada data
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

    <script>
        window.print();
    </script>


<?= $this->endSection(); ?>