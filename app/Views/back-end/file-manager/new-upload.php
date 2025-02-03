<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<h1 class="mt-4">File Manager</h1>
<?php
    // Breadcrumbs
    $breadcrumb_links = array(
        array('title' => 'Dashboard', 'url' => '/account'),
        array('title' => 'File Manager', 'url' => '/account/file-manager'),
        array('title' => 'Upload File')
    );
    echo generateBreadcrumb($breadcrumb_links);
?>
<div class="row">
    <!--Content-->
    <div class="col-12">
        <?php $validation = \Config\Services::validation(); ?>
        <?= form_open_multipart('account/file-manager/upload-file', ['class' => 'needs-validation', 'novalidate' => '']) ?>
            <div class="row">
                <div class="col-sm-12 col-md-12 mb-3">
                    <label for="upload_file" class="form-label">Choose File</label>
                    <input type="file" class="form-control file-input" id="upload_file" name="upload_file" required>
                    <!-- Error -->
                    <?php if($validation->getError('upload_file')) {?>
                        <div class='text-danger mt-2'>
                            <?= $error = $validation->getError('upload_file'); ?>
                        </div>
                    <?php }?>
                    <div class="invalid-feedback">
                        Please provide file
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="unique_identifier" class="form-label">
                        Caption <small>(optional)</small>
                    </label>
                    <input type="text" class="form-control" id="caption" name="caption" value="<?= set_value('caption') ?>">
                    <!-- Error -->
                    <?php if($validation->getError('caption')) {?>
                        <div class='text-danger mt-2'>
                            <?= $error = $validation->getError('caption'); ?>
                        </div>
                    <?php }?>
                    <div class="invalid-feedback">
                        Please provide caption
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="unique_identifier" class="form-label">
                        Unique Identifier <small>(optional)</small>
                    </label>
                    <input type="text" class="form-control" id="unique_identifier" name="unique_identifier" value="<?= set_value('unique_identifier') ?>">
                    <!-- Error -->
                    <?php if($validation->getError('unique_identifier')) {?>
                        <div class='text-danger mt-2'>
                            <?= $error = $validation->getError('unique_identifier'); ?>
                        </div>
                    <?php }?>
                    <div class="invalid-feedback">
                        Please provide unique_identifier
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="group" class="form-label">
                        Group <small>(optional)</small>
                    </label>
                    <input type="text" class="form-control" id="group" name="group" value="<?= set_value('group') ?>">
                    <!-- Error -->
                    <?php if($validation->getError('group')) {?>
                        <div class='text-danger mt-2'>
                            <?= $error = $validation->getError('group'); ?>
                        </div>
                    <?php }?>
                    <div class="invalid-feedback">
                        Please provide group
                    </div>
                </div>
            </div>

           <div class="mt-3">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="ri-upload-2-line"></i> Upload
                </button>
                <a href="<?=base_url('/account/file-manager/add-file-url')?>" class="btn btn-outline-dark float-end">
                    <i class="ri-link"></i> Add From URL
                </a>
           </div>
        <?= form_close() ?>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
