<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$userRole = getUserRole($sessionEmail);
?>

<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Edit Code<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Codes', 'url' => '/account/admin/codes'),
    array('title' => 'Edit Code')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit Code</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/admin/codes/edit-code'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="code_for" class="form-label">Code For <small>(read-only)</small> </label>
                <input type="text" class="form-control" id="code_for" name="code_for" value="<?= $code_data['code_for'] ?>" required readonly>
                <!-- Error -->
                <?php if($validation->getError('code_for')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('code_for'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide code_for
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="code" class="form-label">
                    Code
                    <small>(Include script tags for JavaScript, exclude the style tag for CSS)</small>
                </label>
                <textarea rows="4" class="form-control html-editor" id="code" name="code" required><?= $code_data['code'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('code')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('code'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide code
                </div>
            </div>

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="code_id" name="code_id" value="<?= $code_data['code_id']; ?>">
                <input type="hidden" class="form-control" id="deletable" name="deletable" value="<?= $code_data['deletable']; ?>">
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $code_data['created_by']; ?>">
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin/codes') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <?= $this->include('back-end/_shared/_edit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
