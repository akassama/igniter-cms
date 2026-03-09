<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?= lang('App.new_whitelisted_ip') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.admin'), 'url' => '/account/admin'),
    array('title' => lang('App.whitelisted_ips'), 'url' => '/account/admin/whitelisted-ips'),
    array('title' => lang('App.new_whitelisted_ip'))
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3><?= lang('App.new_whitelisted_ip') ?></h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/admin/whitelisted-ips/new-whitelisted-ip'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="ip_address" class="form-label"><?= lang('App.ip_address') ?></label>
                <input type="text" class="form-control" id="ip_address" name="ip_address" maxlength="250" value="<?= set_value('ip_address') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('ip_address')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('ip_address'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="reason" class="form-label"><?= lang('App.reason') ?></label>
                <textarea rows="1" class="form-control" id="reason" name="reason" maxlength="1000" required><?= set_value('reason') ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('reason')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('reason'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin/whitelisted-ips') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    <?= lang('App.back') ?>
                </a>
                <?= $this->include('back-end/_shared/_submit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/_files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
