<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Themes<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Appearance', 'url' => '/account/appearance'),
    array('title' => 'Themes', 'url' => '/account/appearance/themes'),
    array('title' => 'New Theme')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Upload Theme</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/appearance/themes/upload-theme'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="theme_file" class="form-label">Theme File</label>
                <input class="form-control" type="file" id="theme_file" name="theme_file" accept=".zip,.rar,.7zip" required>
                <!-- Error -->
                <?php if($validation->getError('theme_file')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('theme_file'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide theme_file
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6 mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="override_if_exists" name="override_if_exists" value="true" checked>
                    <label for="override_if_exists" class="form-check-label">Override existing file</label>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/appearance/themes') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <?= view('back-end/_shared/_submit_buttons', ['submitLabel' => 'Upload Theme']) ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>