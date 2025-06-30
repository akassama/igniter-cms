<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Whitelisted IP<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Whitelisted IP Addresses', 'url' => '/account/admin/whitelisted-ips'),
    array('title' => 'New Whitelisted IP')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Whitelisted IP</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/admin/whitelisted-ips/new-whitelisted-ip'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="ip_address" class="form-label">IP Adress</label>
                <input type="text" class="form-control" id="ip_address" name="ip_address" maxlength="250" value="<?= set_value('ip_address') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('ip_address')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('ip_address'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide ip_address
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="reason" class="form-label">Reason for Whitelisting</label>
                <textarea rows="1" class="form-control" id="reason" name="reason" maxlength="1000" required><?= set_value('reason') ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('reason')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('reason'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide reason
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin/whitelisted-ips') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <?= $this->include('back-end/_shared/_submit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
