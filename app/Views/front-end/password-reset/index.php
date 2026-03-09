<!-- include layout -->
<?= $this->extend('front-end/layout/_layout') ?>

<?= $this->section('title') ?><?= lang('App.reset_password') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<h2 class="text-center"><?= lang('App.reset_your_password') ?></h2>
<div class="row justify-content-center">
    <div class="col-md-4 col-sm-12 bg-light rounded p-4">

        <?php $validation = \Config\Services::validation(); ?>

        <form action="<?= base_url('password-reset') ?>" method="post" class="row g-3 needs-validation save-changes" novalidate>
            <?= csrf_field() ?>
            <?=getHoneypotInput()?>
            <input type="hidden" name="token" value="<?= $token ?>">
            <div class="mb-3">
                <label for="password" class="form-label"><?= lang('App.new_password') ?></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                <!-- Error -->
                <?php if($validation->getError('password')) {?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('password'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="password_confirm" class="form-label"><?= lang('App.confirm_new_password') ?></label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="repeat password" required>
                <!-- Error -->
                <?php if($validation->getError('password_confirm')) {?>
                    <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('password_confirm'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>
            <div class="mb-3">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block" id="submit-btn"><?= lang('App.reset_password') ?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
