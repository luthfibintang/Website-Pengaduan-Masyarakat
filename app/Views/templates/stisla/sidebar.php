<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?= base_url(); ?>">Complaint</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">💙</a>
          </div>
          <ul class="sidebar-menu">


              <!-- Dashboard -->
              <li class="menu-header">Dashboard</li>
              <li class="<?= (current_url(true)->getSegment(1) == '')? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url(''); ?>"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
              <!-- User  -->
              <li class="menu-header">User</li>
              <li class="nav-item dropdown <?= (current_url(true)->getSegment(1) == 'user' || current_url(true)->getSegment(1) == 'user/changepassword')? 'active' : ''; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-user"></i> <span>Profile</span></a>
                <ul class="dropdown-menu">
                  <li class="<?= (current_url(true)->getSegment(1) == 'user' && current_url(true)->getSegment(2) == '' )? 'active' : ''; ?> "><a class="nav-link" href="<?= base_url(); ?>/user">User Profile</a></li>
                  <li class="<?= (current_url(true)->getSegment(2) == 'changepassword')? 'active' : ''; ?>"><a class="nav-link <?= (current_url(true)->getSegment(1) == 'user/changepassword')? 'active' : ''; ?>" href="<?= base_url(); ?>/user/changepassword">Change Password</a></li>
                </ul>
              </li>
            
              <!-- Pengaduan -->
              <?php if(in_groups('masyarakat')) : ?>
              <li class="menu-header">Complaint</li>
              <li class="nav-item dropdown">
                  <a href="#" class="nav-link has-dropdown"><i class="fas fa-edit"></i><span>Pengaduan</span></a>
                  <ul class="dropdown-menu">
                      <li><a class="nav-link" href="<?= base_url('pengaduan'); ?>">Tulis Pengaduan</a></li>
                      <li><a class="nav-link" href="<?= base_url('pengaduan/details'); ?>">Detail Pengaduan</a></li>
                  </ul>
               </li>
              <?php endif; ?>

              <!-- Verifikasi -->
              <?php if(in_groups('petugas')) : ?>
                <li class="<?= (current_url(true)->getSegment(2) == 'verifikasi')? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('pengaduan/verifikasi'); ?>"><i class="fas fa-check"></i><span>Verifikasi Pengaduan</span></a></li>
              <?php endif; ?>

              <!-- Tanggapan -->
              <?php if(has_permission('kategorial')) : ?>
                <li class="menu-header">Tanggapan</li>
                <li class="nav-item dropdown <?= (current_url(true)->getSegment(2) == 'masuk' || current_url(true)->getSegment(2) == 'masuk_detail' || current_url(true)->getSegment(2) == 'proses_details' || current_url(true)->getSegment(2) == 'proses_detail' || current_url(true)->getSegment(2) == 'selesai' || current_url(true)->getSegment(2) == 'detail' || current_url(true)->getSegment(2) == 'index')? 'active' : ''; ?>">
                  <a href="#" class="nav-link has-dropdown"><i class="fas fa-reply"></i><span>Tanggapan</span></a>
                  <ul class="dropdown-menu">
                      <li class="<?= (current_url(true)->getSegment(2) == 'masuk' || current_url(true)->getSegment(2) == 'masuk_detail')? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('pengaduan/masuk'); ?>">Pengaduan Masuk</a></li>
                      <li class="<?= (current_url(true)->getSegment(2) == 'proses_details' || current_url(true)->getSegment(2) == 'proses_detail' || current_url(true)->getSegment(2) == 'index')? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('pengaduan/proses_details'); ?>">Pengaduan Proses</a></li>
                      <li class="<?= (current_url(true)->getSegment(2) == 'selesai' || current_url(true)->getSegment(2) == 'detail')? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('tanggapan/selesai'); ?>">Pengaduan Selesai</a></li>
                  </ul>
               </li>
              <?php endif; ?>

              <!-- Master Data -->
              <?php if(in_groups('admin')) : ?>
                <li class="menu-header">Master Data</li>
                <li class="nav-item dropdown <?= (current_url(true)->getSegment(1) == 'admin')? 'active' : ''; ?>">
                  <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-cog"></i><span>Data</span></a>
                  <ul class="dropdown-menu">
                      <li class="<?= (current_url(true)->getSegment(2) == 'masyarakat' || current_url(true)->getSegment(2) == 'tambahmasyarakat')? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin'); ?>/masyarakat">Masyarakat</a></li>
                      <li class="<?= (current_url(true)->getSegment(2) == 'petugas' || current_url(true)->getSegment(2) == 'tambahpetugas')? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin');?>/petugas">Petugas</a></li>
                      <li class="<?= (current_url(true)->getSegment(2) == 'divisi' || current_url(true)->getSegment(2) == 'tambahdivisi')? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin');?>/divisi">Divisi & Kategori</a></li>
                  </ul>
               </li>

               <li class="menu-header">Laporan</li>
               <li class="<?= (current_url(true)->getSegment(1) == 'laporan')? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('laporan/'); ?>"><i class="fas fa-file"></i><span>Generate Laporan</span></a></li>
              <?php endif; ?>
            </ul>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="#" class="btn btn-danger btn-lg btn-block btn-icon-split" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out"></i> Logout
              </a>
            </div>
        </aside>
      </div>