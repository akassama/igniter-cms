<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Translations', 'url' => '/account/admin/translations'),
    array('title' => 'New Translation')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Translation</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/admin/translations/new-translation'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="language" class="form-label">Language</label>
                <select class="form-select" id="language" name="language" required>
                    <option value="">Select language</option>
                    <?= getLanguages() ?>
                </select>
                <!-- Error -->
                <?php if($validation->getError('language')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('language'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide language
                </div>
                <div id="existing-config-error">
                </div>
            </div>
            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin/translations') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <button type="submit" class="btn btn-outline-primary float-end" id="submit-btn">
                    <i class="ri-send-plane-fill"></i>
                    Submit
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
