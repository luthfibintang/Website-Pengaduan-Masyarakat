<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('isi'); ?>

<div class="container">
    <div class="row justify-content-center">    
        <div class="col-md-6">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">

                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><?=lang('Auth.register')?></h1>
                            </div>

                            <form class="user" action="<?= route_to('register') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user <?php if(session('errors.nik')) : ?>is-invalid<?php endif ?>" name="nik" value="<?= old('nik') ?>" placeholder="NIK">
                                    <div class="invalid-feedback">
								        <?= session('errors.nik') ?>
							        </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user <?php if(session('errors.fullname')) : ?>is-invalid<?php endif ?>" value="<?= old('fullname') ?>" name="fullname" placeholder="Nama lengkap">
                                    <div class="invalid-feedback">
								        <?= session('errors.fullname') ?>
							        </div>  
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>"  name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>" >
                                    <div class="invalid-feedback">
								        <?= session('errors.username') ?>
							        </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
                                    <?php if(session('errors.email')) : ?>
                                    <div class="invalid-feedback">
								        <?= session('errors.email') ?>
							        </div>
                                    <?php else : ?>
                                    <small id="emailHelp" class="form-text text-muted"><?=lang('Auth.weNeverShare')?></small>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" value="<?= old('password') ?>"  autocomplete="off">
                                        <div class="invalid-feedback">
								            <?= session('errors.password') ?>
							            </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" placeholder="<?=lang('Auth.repeatPassword')?>" value="<?= old('pass_confirm') ?>"  autocomplete="off">
                                        <div class="invalid-feedback">
								            <?= session('errors.pass_confirm') ?>
							            </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user <?= session('errors.telp') ? 'is-invalid' : '' ?>" name="telp" placeholder="Nomor Telephone" value="<?= old('telp') ?>">
                                    <div class="invalid-feedback">
								        <?= session('errors.telp') ?>
							        </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                    <?=lang('Auth.register')?>
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <small><?=lang('Auth.alreadyRegistered')?><a class="med" href="<?= route_to('login') ?>"> <?=lang('Auth.signIn')?></a></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>

<?= $this->endSection(); ?>