<!-- include layout -->
<?= $this->extend('front-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<h2 class="text-center">Sign-In</h2>
<div class="row justify-content-center">
    <div class="col-md-4 col-sm-12 bg-light rounded p-4">

        <?php $validation = \Config\Services::validation(); ?>
        <form action="<?= base_url('sign-in') ?>" method="post" class="row g-3 needs-validation save-changes" novalidate>
            <?= csrf_field() ?>
            <?=getHoneypotInput()?>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?= set_value('email') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('email')) {?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('email'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide an email
                </div>
            </div>
            <div class="mb-3" x-data="{ showPassword: false }">
                <label for="password" class="form-label">Password</label>
                <div class="input-group mb-3">
                    <input x-bind:type="showPassword ? 'text' : 'password'" class="form-control" id="password" name="password" placeholder="enter password" required>
                    <span class="input-group-text" id="addon-wrapping" x-on:click="showPassword = !showPassword">
                        <i x-bind:class="{'ri-eye-fill text-dark': !showPassword, 'ri-eye-off-fill text-dark': showPassword}" id="eye-icon"></i>
                    </span>
                    <div class="invalid-feedback">
                        Please provide a password
                    </div>
                </div>
                <!-- Error -->
                <?php if($validation->getError('password')) {?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('password'); ?>
                    </div>
                <?php }?>
                <div class="text-start mt-1">
                    <a href="<?= base_url('forgot-password') ?>" class="text-decoration-none text-dark">Forgot your password?</a>
                </div>
            </div>
            <?php if (!empty($captcha_image)) { ?>
                <div class="mb-3">
                    <label for="captcha" class="form-label">Captcha</label>
                    <img src="<?= $captcha_image ?>" alt="CAPTCHA" class="mb-2">
                    <input type="text" class="form-control" id="captcha" name="captcha" required>
                    <input type="hidden" name="captcha_session" value="<?= session('captcha') ?>">
                    <?php if ($validation->getError('captcha')) { ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('captcha'); ?>
                        </div>
                    <?php } ?>
                    <div class="invalid-feedback">
                        Please enter the captcha
                    </div>
                </div>
            <?php } ?>
            
            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="return_url" name="return_url" value="<?= $returnUrl ?? base_url('/account/dashboard'); ?>">
            </div>

            <div class="mb-3">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block" id="submit-btn">Login</button>
                </div>
            </div>
            <?php
                $allowRegistration = getConfigData("EnableRegistration");
                if(strtolower($allowRegistration) === "yes"){
                    ?>
                        <div class="my-2">
                            <p>
                                Don't have an account? Register <a href="<?= base_url('/sign-up'); ?>">here</a>
                            </p>
                        </div>
                    <?php
                }
            ?>
        </form>
    </div>
</div>

<?php if (ENVIRONMENT === 'development' && getenv('CONFIG.AUTO_LOGIN_DEV') === 'true') : ?>
    <div class="col">
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $("#email").val("<?= getenv('CONFIG.DEV_ADMIN_EMAIL') ?? 'admin@example.com' ?>");
                    $("#password").val("<?= getenv('CONFIG.DEV_ADMIN_PASSWORD') ?? '' ?>");
                    //$("#submit-btn").click();
                }, 3000);
            });
        </script>
    </div>
<?php endif; ?>

<!-- end main content -->
<?= $this->endSection() ?>
