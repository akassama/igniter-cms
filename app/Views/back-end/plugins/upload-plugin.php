<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?= lang('App.upload_plugin') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.plugins'), 'url' => '/account/plugins'),
    array('title' => lang('App.upload_plugin'))
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3><?= lang('App.upload_plugin') ?></h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/plugins/upload-plugin'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="plugin_file" class="form-label"><?= lang('App.plugin_file') ?></label>
                <input class="form-control" type="file" id="plugin_file" name="plugin_file" accept=".zip,.rar,.7zip" required>
                <!-- Error -->
                <?php if($validation->getError('plugin_file')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('plugin_file'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6 mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="override_if_exists" name="override_if_exists" value="true" checked>
                    <label for="override_if_exists" class="form-check-label"><?= lang('App.override_existing') ?></label>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/plugins') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    <?= lang('App.back') ?>
                </a>
                <?= view('back-end/_shared/_submit_buttons', ['submitLabel' => 'Upload Plugin']) ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>