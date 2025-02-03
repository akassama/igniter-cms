<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Policies', 'url' => '/account/cms/policies'),
    array('title' => 'Edit Policy')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit Policy</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/policies/edit-policy'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="policy_for" class="form-label">Policy For <small>(read-only)</small></label>
                <input type="text" class="form-control" id="policy_for" name="policy_for" value="<?= $policy_data['policy_for'] ?>" required readonly>
                <!-- Error -->
                <?php if($validation->getError('policy_for')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('policy_for'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide policy_for
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $policy_data['title'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('title')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('title'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide title
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea rows="1" class="form-control content-editor" id="content" name="content" required><?= $policy_data['content'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('content')) {?>
                <div class='text-danger mt-2'>
                <?= $error = $validation->getError('content'); ?>
                </div>
                <?php }?>
                <div class="invalid-feedback">
                Please provide content
                </div>
            </div>

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="policy_id" name="policy_id" value="<?= $policy_data['policy_id']; ?>" />
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $policy_data['created_by']; ?>" />
            </div>

            <div class="mb-3">
                <a href="<?= base_url('/account/cms/policies') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <button type="submit" class="btn btn-outline-primary float-end" id="submit-btn">
                    <i class="ri-edit-box-line"></i>
                    Update
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
