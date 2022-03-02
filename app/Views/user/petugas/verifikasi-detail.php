<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>

<section class="section">

    <!-- Page Heading -->
    <div class="section-header">
    <div class="section-header-back">
    <a href="<?= base_url('pengaduan/verifikasi'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Pengaduan Detail</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url(); ?>">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="<?= base_url('/pengaduan/verifikasi'); ?>">Verifikasi</a></div>
        <div class="breadcrumb-item">Detail</div>
    </div>
    </div>
    
    <div class="section-body">
    <div class="row">
        <div class="col-lg">
        <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold;"><?= $pengaduan->judul; ?>
                    <small class="<?php if($pengaduan->status == 0){echo 'badge badge-danger';} elseif($pengaduan->status == 'verifikasi'){echo 'badge badge-primary';}elseif($pengaduan->status == 'proses'){echo 'badge badge-warning';}else{echo 'badge badge-success';} ?>" style="font-size: 10px;">
                        <?php if($pengaduan->status == 0){echo "Pengaduan belum di verifikasi";} ?>
                        <?php if($pengaduan->status == 'verifikasi'){ echo "Sudah Diverifikasi";} ?>
                        <?php if($pengaduan->status == 'proses'){ echo "Sedang Diproses";} ?>
                        <?php if($pengaduan->status == 'selesai'){ echo "Sudah Ditanggapi";} ?>
                    </small></h5>
                    <p class="card-text"><?= $pengaduan->isi_laporan; ?></p>
                    <p class="card-text"><small class="text-muted">Oleh : <?= $pengaduan->nik_masyarakat; ?> | <?= $pengaduan->tgl_pengaduan; ?></small></p>
                </div>
                <img src="<?= base_url('/img/pengaduan' . '/' . $pengaduan->foto); ?>" class="card-img-bottom" style="width: 100%;" alt="...">

                <form action="<?= base_url('/pengaduan/verifikasi_pengaduan/' . $pengaduan->id_pengaduan); ?>" method="post">  
                <?php if($pengaduan->status == '0') : ?>  
                    <div class="m-3">
                        <label>Kategori</label>
                        <select class="form-control selectric <?= ($validation->hasError('kategori'))? 'is-invalid' : ''; ?>" name="kategori">
                            <option value="<?= $pengaduan->id_kategori; ?>"><?= $pengaduan->nama_kategori; ?></option>
                            <?php foreach($category as $cat) : ?>
                            <option value="<?= $cat->id_kategori; ?>"><?= $cat->nama_kategori; ?></option>
                            <?php endforeach?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kategori'); ?>
                        </div>
                    </div>
                    <div class="m-3">
                      <label class="form-label">Level</label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="level" value="urgent" <?php echo ($pengaduan->level == "urgent" ? 'checked="checked"': ''); ?> class="selecturgent-input">
                          <span class="selectgroup-button">Urgent</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="level" value="biasa" <?php echo ($pengaduan->level == "biasa" ? 'checked="checked"': ''); ?> class="selectgroup-input">
                          <span class="selectgroup-button">Biasa</span>
                        </label>
                      </div>
                    </div>
                <?php else : ?>
                    <p class=" m-3 card-text">Kategori : <?= $pengaduan->nama_kategori; ?></p>
                <?php endif; ?>
                    <?php if($pengaduan->status == '0') : ?>
                        <button type="submit" name="tolak" class="btn btn-danger btn-sm mt-3 ml-3 mb-3">Tolak Pengaduan</button>
                        <button type="submit" name="submit" class="btn btn-success btn-sm mt-3 ml-3 mb-3">Verifikasi</button>
                        <button type="submit" name="tanggap" class="btn btn-success btn-sm mt-3 ml-3 mb-3">Tanggapi</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>
</section>

<?= $this->endSection(); ?>