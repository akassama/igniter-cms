<!-- include layout -->
<?= $this->extend('front-end/layout/_layout') ?>

<?= $this->section('title') ?><?= lang('App.login') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<h2 class="text-center"><?= lang('App.login') ?></h2>
<div class="row justify-content-center">
    <div class="col-md-4 col-sm-12 bg-light rounded p-4">

        <?php $validation = \Config\Services::validation(); ?>
        <form action="<?= base_url('sign-in') ?>" method="post" class="row g-3 needs-validation save-changes" novalidate>
            <?= csrf_field() ?>
            <?=getHoneypotInput()?>
            <div class="mb-2">
                <label for="email" class="form-label"><?= lang('App.email') ?></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?= set_value('email') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('email')) {?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('email'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>
            <div class="mb-2" x-data="{ showPassword: false }">
                <label for="password" class="form-label"><?= lang('App.password') ?></label>
                <div class="input-group">
                    <input x-bind:type="showPassword ? 'text' : 'password'" class="form-control" id="password" name="password" placeholder="enter password" required>
                    <span class="input-group-text" id="addon-wrapping" x-on:click="showPassword = !showPassword">
                        <i x-bind:class="{'ri-eye-fill text-dark': !showPassword, 'ri-eye-off-fill text-dark': showPassword}" id="eye-icon"></i>
                    </span>
                    <div class="invalid-feedback">
                        <?= lang('App.input_required') ?>
                    </div>
                </div>
                <!-- Error -->
                <?php if($validation->getError('password')) {?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('password'); ?>
                    </div>
                <?php }?>
            </div>
            <div class="mb-2">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember_me" value="true"> <?= lang('App.remember_me') ?>
                </label>
            </div>
            
            <?= renderCaptcha()?>
            
            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="return_url" name="return_url" value="<?= $returnUrl ?? base_url('/account/dashboard'); ?>">
            </div>

            <div class="mb-2">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block" id="submit-btn"><?= lang('App.login') ?></button>
                </div>
            </div>
            <div class="text-start mt-1">
                <a href="<?= base_url('forgot-password') ?>" class="text-decoration-none text-dark"><?= lang('App.forgot_your_password') ?></a>
            </div>
            <?php
                $allowRegistration = getConfigData("EnableRegistration");
                if(strtolower($allowRegistration) === "yes"){
                    ?>

                    <div class="my-2 text-center">
                        <p>
                            <?= lang('App.no_account') ?> <a href="<?= base_url('/sign-up'); ?>"><?= lang('App.register') ?></a>
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
                                        <?= lang('App.sign_in_google') ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                <?php
                }
            ?>
        </form>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
