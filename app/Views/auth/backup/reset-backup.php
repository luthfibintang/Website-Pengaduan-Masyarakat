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
                            <h1 class="h4 text-gray-900 mb-4"><?=lang('Auth.resetYourPassword')?></h1>
                        </div>
                        <?= view('Myth\Auth\Views\_message_block') ?>

                        <p><?=lang('Auth.enterCodeEmailPassword')?></p>

                        <form action="<?= route_to('reset-password') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="form-group">
                                <label for="token"><?=lang('Auth.token')?></label>
                                <input type="text" class="form-control <?php if(session('errors.token')) : ?>is-invalid<?php endif ?>"
                                    name="token" placeholder="<?=lang('Auth.token')?>" value="<?= old('token', $token ?? '') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.token') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email"><?=lang('Auth.email')?></label>
                                <input type="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                                    name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.email') ?>
                                </div>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="password"><?=lang('Auth.newPassword')?></label>
                                <input type="password" class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>"
                                    name="password">
                                <div class="invalid-feedback">
                                    <?= session('errors.password') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass_confirm"><?=lang('Auth.newPasswordRepeat')?></label>
                                <input type="password" class="form-control <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
                                    name="pass_confirm">
                                <div class="invalid-feedback">
                                    <?= session('errors.pass_confirm') ?>
                                </div>
                            </div>

                            <br>

                            <button type="submit" class="btn btn-primary btn-block"><?=lang('Auth.resetPassword')?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>
</div>

<?= $this->endSection(); ?>