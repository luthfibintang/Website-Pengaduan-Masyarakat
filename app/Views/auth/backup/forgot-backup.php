<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('isi'); ?>

<div class="container">
<div class="row justify-content-center">

<div class="col-md-7">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?=lang('Auth.forgotPassword')?></h1>
                        </div>
                        <?= view('Myth\Auth\Views\_message_block') ?>

                        <p><?=lang('Auth.enterEmailForInstructions')?></p>

                        <form action="<?= route_to('forgot') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="form-group">
                                <label for="email"><?=lang('Auth.emailAddress')?></label>
                                <input type="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                                    name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.email') ?>
                                </div>
                            </div>

                            <br>

                            <button type="submit" class="btn btn-primary btn-block"><?=lang('Auth.sendInstructions')?></button>
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