<!-- include layout -->
<?= $this->extend('front-end/layout/_layout') ?>

<?= $this->section('title') ?><?= lang('App.sign_up') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<h2 class="text-center"><?= lang('App.sign_up') ?></h2>
<div class="row justify-content-center">
    <div class="col-md-6 col-sm-12 bg-light rounded p-4">

        <?php $validation = \Config\Services::validation(); ?>

        <form action="<?= base_url('sign-up') ?>" method="post" class="row g-3 needs-validation save-changes" novalidate>
            <?= csrf_field() ?>
            <?=getHoneypotInput()?>
            <div class="mb-3">
                <label for="first_name" class="form-label"><?= lang('App.first_name') ?></label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="first name" required>
                <!-- Error -->
                <?php if($validation->getError('first_name')) {?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('first_name'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label"><?= lang('App.last_name') ?></label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="last name" required>
                <!-- Error -->
                <?php if($validation->getError('last_name')) {?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('last_name'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label"><?= lang('App.username') ?></label>
                <input type="text" class="form-control" id="username" name="username" placeholder="username" required
                       hx-post="<?=base_url()?>/htmx/check-user-username-exists"
                       hx-trigger="keyup, changed delay:250ms"
                       hx-target="#existing-username-error"
                       hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('username')) {?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('username'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
                <div id="existing-username-error">
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><?= lang('App.email') ?></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required
                       hx-post="<?=base_url()?>/htmx/check-user-email-exists"
                       hx-trigger="keyup, changed delay:250ms"
                       hx-target="#existing-user-email-error"
                       hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('email')) {?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('email'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
                <div id="existing-user-email-error">
                </div>
            </div>
            <div class="mb-3">
                <div x-data="{ showPassword: false }">
                    <label for="password" class="form-label"><?= lang('App.password') ?></label>
                    <div class="input-group mb-3">
                        <input x-bind:type="showPassword ? 'text' : 'password'" class="form-control" id="password" name="password" placeholder="enter password" required
                               hx-post="<?=base_url()?>/htmx/check-password-is-valid"
                               hx-trigger="keyup[target.value.length > 2], changed delay:250ms"
                               hx-target="#password-valid-error"
                               hx-swap="innerHTML">
                        <span class="input-group-text" id="addon-wrapping" x-on:click="showPassword = !showPassword">
                            <i x-bind:class="{'ri-eye-fill text-dark': !showPassword, 'ri-eye-off-fill text-dark': showPassword}" id="eye-icon"></i>
                        </span>
                        <div class="invalid-feedback">
                            <?= lang('App.input_required') ?>
                        </div>
                    </div>
                </div>
                <!-- Error -->
                <?php if($validation->getError('password')) {?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('password'); ?>
                    </div>
                <?php }?>
                <div id="password-valid-error">
                </div>
            </div>
            <div class="mb-3">
                <label for="repeat_password" class="form-label"><?= lang('App.repeat_password') ?></label>
                <input type="password" class="form-control" id="repeat_password" name="repeat_password" placeholder="re-enter password" required
                       hx-post="<?=base_url()?>/htmx/check-passwords-match"
                       hx-trigger="keyup[target.value.length > 2], changed delay:250ms"
                       hx-target="#password-match-error"
                       hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('repeat_password')) {?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('repeat_password'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
                <div id="password-match-error">
                </div>
            </div>
            <?= renderCaptcha()?>
            
            <div class="mb-3">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block" id="submit-btn">Submit</button>
                </div>
            </div>
            <div class="my-2">
                <p>
                    <?= lang('App.already_have_account') ?> <a href="<?= base_url('/sign-in'); ?>"><?= lang('App.login') ?></a>
                </p>
            </div>

            <!-- Google Auth -->
            <?php if(env('ENABLE_GOOGLE_OAUTH')) {?>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="social-login-divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                        </div>

                        <div class="google-btn-wrapper">
                            <a href="<?= base_url('auth/google/login') ?>" class="google-signin-btn">
                                <img src="https://ik.imagekit.io/oju3vfr0u/websites/igniter-cms/google.png" alt="Google logo">
                                <span><?= lang('App.sign_in_google') ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php }?>
        </form>
    </div>
</div>
<!-- end main content -->
<?= $this->endSection() ?>
