<?= $this->extend('templates/stisla/index'); ?>
<?= $this->section('user-content'); ?>
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          
          <div class="section-body">
          <?php if(in_groups('admin')) : ?>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Masyarakat</h4>
                  </div>
                  <div class="card-body">
                    <?= $masyarakat; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                <i class="fas fa-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Petugas Verfikasi</h4>
                  </div>
                  <div class="card-body">
                    <?= $petugas; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                <i class="fas fa-user-tag"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Petugas Kategorial</h4>
                  </div>
                  <div class="card-body">
                    <?= $kategorial; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Report</h4>
                  </div>
                  <div class="card-body">
                    <?= $pengaduan; ?>
                  </div>
                </div>
              </div>
            </div>                  
          </div>
          <?php endif; ?>
          <?php if(in_groups('petugas')) : ?>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                <i class="fas fa-comment-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Belum Diverifikasi</h4>
                  </div>
                  <div class="card-body">
                    <?= $belumverif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                <i class="fas fa-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Tererfikasi</h4>
                  </div>
                  <div class="card-body">
                    <?= $verif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Urgent</h4>
                  </div>
                  <div class="card-body">
                    <?= $urgent; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                <i class="fas fa-times"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pengaduan Ditolak</h4>
                  </div>
                  <div class="card-body">
                    <?= $tolak; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <?php if(in_groups('masyarakat')) : ?>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                <i class="fas fa-comment-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Belum Diverifikasi</h4>
                  </div>
                  <div class="card-body">
                    <?= $belum; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                <i class="fas fa-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Tererfikasi</h4>
                  </div>
                  <div class="card-body">
                    <?= $sudah; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                <i class="fas fa-spinner"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Diproses</h4>
                  </div>
                  <div class="card-body">
                    <?= $proses; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Selesai</h4>
                  </div>
                  <div class="card-body">
                    <?= $tertanggapi; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <?php if(has_permission('kategorial')) : ?>
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                <i class="fas fa-sign-in-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pengaduan Masuk</h4>
                  </div>
                  <div class="card-body">
                    <?php if(has_permission('kategorial')){echo $catmasuk;} ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                <i class="fas fa-spinner"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pengaduan Proses</h4>
                  </div>
                  <div class="card-body">
                    <?php if(has_permission('kategorial')){echo $catproses;}; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                <i class="fas fa-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pengaduan Selesai</h4>
                  </div>
                  <div class="card-body">
                    <?php if(has_permission('kategorial')){echo $catselesai;} ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>


          </div>
        </section>
      </div>
      <?= $this->endSection(); ?>