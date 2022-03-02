
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Registrasi</title>

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
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <!-- <div class="login-brand">
              <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div> -->

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
              <form class="user" action="<?= route_to('register') ?>" method="post">
                <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" id="nik" class="form-control form-control-user <?php if(session('errors.nik')) : ?>is-invalid<?php endif ?>" name="nik" value="<?= old('nik') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.nik') ?>
                        </div>
                    </div>

                  <div class="form-group">
                    <label for="fullname">Nama Lengkap</label>
                    <input type="text" id="fullname" class="form-control form-control-user <?php if(session('errors.fullname')) : ?>is-invalid<?php endif ?>" value="<?= old('fullname') ?>" name="fullname">
                    <div class="invalid-feedback">
                        <?= session('errors.fullname') ?>
                    </div>  
                  </div>

                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control form-control-user <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>"  name="username" value="<?= old('username') ?>" >
                    <div class="invalid-feedback">
					    <?= session('errors.username') ?>
					</div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control form-control-user <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" value="<?= old('email') ?>">
                    <?php if(session('errors.email')) : ?>
                    <div class="invalid-feedback">
					    <?= session('errors.email') ?>
					</div>
                    <?php else : ?>
                        <small id="emailHelp" class="form-text text-muted"><?=lang('Auth.weNeverShare')?></small>
                    <?php endif; ?>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input type="password" name="password" class="form-control form-control-user <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" value="<?= old('password') ?>"  autocomplete="off">
                        <div class="invalid-feedback">
						    <?= session('errors.password') ?>
						</div>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                    <label for="pass-confirm" class="d-block">Confirm Password</label>
                        <input type="password" id="pass-confirm" class="form-control form-control-user <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" value="<?= old('pass_confirm') ?>"  autocomplete="off">
                        <div class="invalid-feedback">
						    <?= session('errors.pass_confirm') ?>
					    </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Nomor Telephone</label>
                      <input type="text" class="form-control form-control-user <?= session('errors.telp') ? 'is-invalid' : '' ?>" name="telp" value="<?= old('telp') ?>">
                      <div class="invalid-feedback">
                          <?= session('errors.telp') ?>
                      </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="invalidCheck" required>
                      <label class="custom-control-label" for="invalidCheck">I agree with the terms and conditions</label>
                    </div>
                    <div class="invalid-feedback">
                        Anda harus setuju sebelum registrasi
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>

                  <div class="mt-2 text-center">
                    Sudah Punya Akun? <a href="<?= route_to('login') ?>">Login</a>
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

</body>
</html>
