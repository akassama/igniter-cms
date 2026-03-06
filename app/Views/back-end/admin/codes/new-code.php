<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?= lang('App.codes') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.admin'), 'url' => '/account/admin'),
    array('title' => lang('App.codes'), 'url' => '/account/admin/codes'),
    array('title' => lang('App.new_code'))
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3><?= lang('App.new_code') ?></h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/admin/codes/new-code'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
        <div class="col-sm-12 col-md-12 mb-3">
                <label for="code_for" class="form-label"><?= lang('App.code_for') ?></label>
                <input type="text" class="form-control" id="code_for" name="code_for" value="<?= set_value('code_for') ?>" required
                       hx-post="<?=base_url()?>/htmx/check-code-for-exists"
                       hx-trigger="keyup, changed delay:250ms"
                       hx-target="#existing-code-for-error"
                       hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('code_for')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('code_for'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
                <div id="existing-code-for-error">
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="code" class="form-label">
                    <?= lang('App.code') ?>
                    <small><?= lang('app.script_style_hint') ?></small>
                </label>
                <textarea rows="4" class="form-control js-editor" id="code" name="code" required><?= set_value('code') ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('code')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('code'); ?>`
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
                <div id="existing-config-error">
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    <?= lang('App.back') ?>
                </a>
                <?= $this->include('back-end/_shared/_submit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>