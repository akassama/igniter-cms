<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New API Key<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'API Keys', 'url' => '/account/admin/api-keys'),
    array('title' => 'New API Key')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New API Key</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/admin/api-keys/new-api-key'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="assigned_to" class="form-label">Assigned To</label>
                <input type="text" class="form-control" id="assigned_to" name="assigned_to" value="<?= set_value('assigned_to') ?>" maxlength="50" required>
                <!-- Error -->
                <?php if($validation->getError('assigned_to')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('assigned_to'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide assigned_to
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="">Select status</option>
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                </select>
                <!-- Error -->
                <?php if($validation->getError('status')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('status'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide status
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="api_key" class="form-label">API Key <small>(Read-only)</small> </label>
                <input type="text" class="form-control" id="api_key" name="api_key" value="<?= generateApiKey() ?>" maxlength="100" required readonly>
                <!-- Error -->
                <?php if($validation->getError('api_key')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('api_key'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide api_key
                </div>
            </div>
            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin/api-keys') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <?= $this->include('back-end/_shared/_submit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
