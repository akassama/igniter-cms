<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Edit Data Group<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Data Groups', 'url' => '/account/cms/data-groups'),
    array('title' => 'Edit Data Group')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit Data Group</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/data-groups/edit-data-group'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-4 mb-3">
                <label for="data_group_for" class="form-label">Data Group For</label>
                <input type="text" class="form-control title-text" id="data_group_for" name="data_group_for" data-show-err="true" value="<?= $data_group_data['data_group_for'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('data_group_for')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('data_group_for'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide data_group_for
                </div>
            </div>

            <div class="col-sm-12 col-md-8 mb-3">
                <label for="data_group_list" class="form-label">
                    Data Group List
                    <small>(comma separated)</small>
                </label>
                <textarea rows="1" class="form-control tags-input" id="data_group_list" name="data_group_list" required><?= $data_group_data['data_group_list'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('data_group_list')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('data_group_list'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide data_group_list
                </div>
            </div>

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="data_group_id" name="data_group_id" value="<?= $data_group_data['data_group_id']; ?>" />
                <input type="hidden" class="form-control" id="deletable" name="deletable" value="<?= $data_group_data['deletable']; ?>">
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $data_group_data['created_by']; ?>" />
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/data-groups') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <?= $this->include('back-end/_shared/_edit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
