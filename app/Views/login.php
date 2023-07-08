<?= $this->extend('layouts/login'); ?>
<?= $this->section('content'); ?>
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="/" class="h1"><b><?= lang('Auth.loginTitle') ?></b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <?= view('Myth\Auth\Views\_message_block') ?>
            <form action="<?= url_to('login') ?>" method="post">
                <?= csrf_field() ?>
                <?php if ($config->validFields === ['email']) : ?>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            <?= session('errors.login') ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            <?= session('errors.login') ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="input-group mb-3">
                    <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="<?= lang('Auth.password') ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <?php if ($config->allowRemembering) : ?>
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                <label for="remember">
                                    <?= lang('Auth.rememberMe') ?>
                                </label>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.loginAction') ?></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <?php if ($config->allowRegistration) : ?>
                <p class="mb-1">
                    <a href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a>
                </p>
            <?php endif; ?>
            <?php if ($config->activeResetter) : ?>
                <p class="mb-0">
                    <a href="<?= url_to('forgot') ?>" class="text-center"><?= lang('Auth.forgotYourPassword') ?></a>
                </p>
            <?php endif; ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
<?= $this->endSection(); ?>