
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
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl0-14 offset-xl0-14">
            <div class="card card-primary">
              <div class="card-header"><h4>Reset Password</h4></div>
              <div class="card-body">

                <?= view('Myth\Auth\Views\_message_block') ?>

                <p class="text-muted"><?=lang('Auth.enterCodeEmailPassword')?></p>
                <form method="POST" action="<?= route_to('reset-password') ?>">
                <div class="form-group">
                    <label for="email">Kode</label>
                    <input type="text" class="form-control <?php if(session('validate.token')) : ?>is-invalid<?php endif ?>"
                    name="token" value="<?= old('token', $token ?? '') ?>">
                    <div class="invalid-feedback">
                        <?= session('validate.token') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control <?php if(session('validate.email')) : ?>is-invalid<?php endif ?>"
                    name="email" aria-describedby="emailHelp" value="<?= old('email') ?>">
                    <div class="invalid-feedback">
                        <?= session('validate.email') ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" class="form-control <?php if(session('validate.password')) : ?>is-invalid<?php endif ?>"
                    name="password">
                    <div class="invalid-feedback">
                        <?= session('validate.password') ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password-confirm">Konfirmasi Password</label>
                    <input type="password" class="form-control <?php if(session('validate.pass_confirm')) : ?>is-invalid<?php endif ?>"
                    name="pass_confirm">
                    <div class="invalid-feedback">
                        <?= session('validate.pass_confirm') ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Forgot Password
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Bina Informatika 2022
            </div>
          </div>
        </div>
      </div>
    </section>
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