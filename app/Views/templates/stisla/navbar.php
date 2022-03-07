<div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <a href="<?= base_url(); ?>" class="navbar-brand sidebar-gone-hide">Complaint</a>
        <div class="navbar-nav">
          <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        </div>
        <div class="nav-collapse">
          <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <ul class="navbar-nav">
            <li class="nav-item active"><a href="#" class="nav-link">Information</a></li>
            <li class="nav-item"><a href="#" class="nav-link">News</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Tutorial</a></li>
          </ul>
        </div>
        <form class="form-inline ml-auto">
          <!-- <ul class="navbar-nav">
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
          </div> -->
        </form>

        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= base_url(); ?>/img/user-profile/<?= user()->user_image; ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?= user()->fullname; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="<?= base_url(); ?>/user" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <nav class="navbar navbar-secondary navbar-expand-lg">
        <div class="container">
          <ul class="navbar-nav">
            <li class="nav-item <?= (current_url(true)->getSegment(1) == '')? 'active' : ''; ?>">
              <a href="<?= base_url(); ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item dropdown <?= (current_url(true)->getSegment(1) == 'pengaduan' || current_url(true)->getSegment(2) == 'details')? 'active' : ''; ?>">
              <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="far fa-edit"></i><span>Pengaduan</span></a>
              <ul class="dropdown-menu">
                <li class="nav-item"><a href="<?= base_url('pengaduan'); ?>" class="nav-link">Tulis Pengaduan</a></li>
                <li class="nav-item"><a href="<?= base_url('pengaduan/details'); ?>" class="nav-link">History</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown <?= (current_url(true)->getSegment(2) == 'changepassword' || current_url(true)->getSegment(1) == 'user')? 'active' : ''; ?>">
              <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="far fa-user"></i><span>User</span></a>
              <ul class="dropdown-menu">
                <li class="nav-item"><a href="<?= base_url('/user'); ?>" class="nav-link">User Profile</a></li>
                <li class="nav-item"><a href="<?= base_url('/user/changepassword'); ?>" class="nav-link">Change Password</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
