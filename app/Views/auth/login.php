
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
            <h4 class="text-dark font-weight-normal">Selamat Datang<span class="font-weight-bold">💙</span></h4>
            <p class="text-muted">Sebelum anda mulai, anda harus login dan registrasi jika anda tidak punya akun.</p>
            <form method="post" action="<?= route_to('login') ?>" >
            <?= csrf_field() ?>

            <?php if (session()->has('message')) : ?>
            <div class="alert alert-success">
              <?= session('message') ?>
            </div>
            <?php endif ?>
            <?php if (session()->has('error')) : ?>
            <div class="alert alert-danger">
              <?= session('error') ?>
            </div>
            <?php endif ?>
            
            <?php if ($config->validFields === ['email']): ?>
                    <div class="form-group">
                    <label for="email">Username or Email</label>
                        <input type="email" class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>"
                        name="login"
                        placeholder="<?=lang('Auth.email')?>">
                    <div class="invalid-feedback">
					    <?= session('errors.login') ?>
				    </div>
                </div>
                <?php else: ?>
                <div class="form-group">
                    <label for="email">Username or Email</label>
                    <input type="text" class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>"
                        name="login">
                    <div class="invalid-feedback">
					          <?= session('errors.login') ?>
				            </div>
                </div>
            <?php endif; ?>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">Password</label>
                </div>
                <input type="password" class="form-control form-control-user <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>"
                name="password">
                <div class="invalid-feedback">
				    <?= session('errors.password') ?>
				</div>
              </div>
              <?php if ($config->allowRemembering): ?>
              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                  <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
              </div>
              <?php endif; ?>

              <div class="form-group text-right">
                <a href="<?= route_to('forgot') ?>" class="float-left mt-3">
                  Lupa password?
                </a>
                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right">
                  Login
                </button>
              </div>

              <div class="mt-5 text-center">
                Tidak punya akun? <a href="<?= route_to('register') ?>">buat</a>
              </div>
            </form>

            <div class="text-center mt-5 text-small">
              Copyright &copy; Bina Informatika. Made by Azisya Luthfi Bintang 
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="<?= base_url() ?>/img/logs.jpg">
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">
              <div class="mb-5 pb-3">
                <h1 class="mb-2 display-4 font-weight-bold">Good Morning</h1>
                <h5 class="font-weight-normal text-muted-transparent">Jakarta, Indonesia</h5>
              </div>
              Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/OrZDoBVLxUc">Achmad Al Fadhli</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
            </div>
          </div>
        </div>

  <!-- General JS Scripts -->
  <script src="<?= base_url(); ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
  <script src="<?= base_url(); ?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> -->
  <script src="<?= base_url() ?>/template/assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="<?= base_url() ?>/template/assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>/template/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
</body>
</html>
