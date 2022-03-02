<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                
                <div class="sidebar-brand-text mx-3">Pelayanan Masyarakat</div>
            </a>
            
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                User
            </div>

            <!-- Nav Item - Pages User Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-user"></i>
                    <span>User Profile</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">PROFILE:</h6>
                        <a class="collapse-item" href="<?= base_url(); ?>/user">My Profile</a>
                        <a class="collapse-item" href="<?= base_url(); ?>/user/changepassword">Change Password</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <?php if(in_groups('masyarakat')) : ?>
            <div class="sidebar-heading">
                Complaint
            </div>
            <?php endif; ?>
            
            <!-- Pengaduan -->
            <?php if(in_groups('masyarakat')) : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsesix"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-edit"></i>
                    <span>Pengaduan</span>
                </a>
                <div id="collapsesix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pengaduan:</h6>
                        <a class="collapse-item" href="<?= base_url('pengaduan'); ?>">Tulis Pengaduan</a>
                        <a class="collapse-item" href="<?= base_url('pengaduan/details'); ?>">Detail Pengaduan</a>
                    </div>
                </div>
            </li>
            <?php endif; ?>
            
            <!-- heading -->

            <?php if(in_groups('admin')) : ?>
            <div class="sidebar-heading">
                Kelola Data
            </div>
            <?php endif; ?>
            <?php if(in_groups('petugas')) : ?>
            <div class="sidebar-heading">
                Verifikasi
            </div>
            <?php endif; ?>
            <?php if(in_groups('medis') || in_groups('polisi')) : ?>
            <div class="sidebar-heading">
                Pengaduan
            </div>
            <?php endif; ?>

            <?php if(in_groups('petugas')) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('pengaduan/verifikasi'); ?>">
                <i class="fas fa-check"></i>
                <span>Verifikasi Pengaduan</span></a>
            </li>
            <?php endif; ?>

            <!-- Master Data -->
            <?php if(in_groups('medis') || in_groups('polisi')) : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-reply"></i>
                    <span>Tanggapan</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data:</h6>
                        <a class="collapse-item" href="<?= base_url('pengaduan/masuk'); ?>">Pengaduan Masuk</a>
                        <a class="collapse-item" href="<?= base_url('pengaduan/proses_details'); ?>">Pengaduan Proses</a>
                        <a class="collapse-item" href="<?= base_url('tanggapan/selesai'); ?>">Pengaduan Selesai</a>
                    </div>
                </div>
            </li>
            <?php endif; ?>

            <?php if(in_groups('admin')) : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-user-cog"></i>
                    <span>Kelola User</span>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data User:</h6>
                        <a class="collapse-item" href="<?= base_url('admin'); ?>/masyarakat">Data Masyarakat</a>
                        <a class="collapse-item" href="<?= base_url('admin');?>/petugas">Data Petugas</a>
                    </div>
                </div>
            </li>   
            <?php endif; ?>

            <?php if(in_groups('admin')) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('laporan/'); ?>">
                <i class="fas fa-file"></i>
                    <span>Generate Laporan</span></a>
            </li>
            <?php endif; ?>

            <!-- Driver -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>