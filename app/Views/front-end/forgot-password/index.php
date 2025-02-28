<!-- include layout -->
<?= $this->extend('front-end/layout/_layout') ?>

<?= $this->section('title') ?>Forgot Password<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<h2 class="text-center">Reset Your Password</h2>
<div class="row justify-content-center">
    <div class="col-md-4 col-sm-12 bg-light rounded p-4">

        <?php $validation = \Config\Services::validation(); ?>

        <form action="<?= base_url('forgot-password') ?>" method="post" class="row g-3 needs-validation save-changes" novalidate>
            <?= csrf_field() ?>
            <?=getHoneypotInput()?>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="ri-mail-line"></i>
                    </span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" required>
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
                <span class="small text-muted">
                    Enter your email and we'll send you a link to reset your password.
                </span>
            </div>
            <div class="mb-3">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block" id="submit-btn">Send My Reset Link</button>
                </div>
                <div class="d-grid mt-2">
                    <a href="<?= base_url('/sign-in'); ?>" class="btn btn-outline-dark btn-block" id="submit-btn">Wait, I remember!</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
