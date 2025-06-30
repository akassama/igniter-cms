<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Configuration<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Configurations', 'url' => '/account/admin/configurations'),
    array('title' => 'New Configuration')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Configuration</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/admin/configurations/new-config'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="config_for" class="form-label">Config For</label>
                <input type="text" class="form-control" id="config_for" name="config_for" value="<?= set_value('config_for') ?>" required
                       hx-post="<?=base_url()?>/htmx/check-config-exists"
                       hx-trigger="keyup, changed delay:250ms"
                       hx-target="#existing-config-error"
                       hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('config_for')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('config_for'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide config_for
                </div>
                <div id="existing-config-error">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="config_value" class="form-label">Config Value</label>
                <input type="text" class="form-control" id="config_value" name="config_value" value="<?= set_value('config_value') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('config_value')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('config_value'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide config_value
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="1" class="form-control" id="description" name="description" maxlength="500"><?= set_value('description') ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('description')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('description'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide description
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="group" class="form-label">Group</label>
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

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="data_type" class="form-label">Data Type</label>
                <select class="form-select" id="data_type" name="data_type">
                    <option value="">Select data_type</option>
                    <option value="Text">Text</option>
                    <option value="Textarea">Textarea</option>
                    <option value="Code">Code</option>
                    <option value="Select">Select</option>
                    <option value="Secret">Secret <small>(Would be stored encrypted)</small></option>
                </select>
                <!-- Error -->
                <?php if($validation->getError('data_type')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('data_type'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide data_type
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="options" class="form-label">Options</label>
                <input type="text" class="form-control" id="options" name="options" value="<?= set_value('options') ?>">
                <!-- Error -->
                <?php if($validation->getError('options')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('options'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide options
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="default_value" class="form-label">Default Value</label>
                <input type="text" class="form-control" id="default_value" name="default_value" value="<?= set_value('default_value') ?>">
                <!-- Error -->
                <?php if($validation->getError('default_value')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('default_value'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide default_value
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="custom_class" class="form-label">Custom Class</label>
                <input type="text" class="form-control" id="custom_class" name="custom_class" value="<?= set_value('custom_class') ?>">
                <!-- Error -->
                <?php if($validation->getError('custom_class')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('custom_class'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide custom_class
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="icon" class="form-label">Icon</label>
                        <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn"
                        hx-post="<?=base_url()?>/htmx/get-remix-icon-via-ai"
                        hx-trigger="click delay:250ms"
                        hx-target="#icon-div"
                        hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                </div>
                <div id="icon-div">
                    <input type="text" class="form-control" id="icon" name="icon" maxlength="100" value="<?= htmlspecialchars(set_value('icon')) ?>" placeholder="E.g. ri-user-line">
                </div>
                <!-- Error -->
                <?php if($validation->getError('icon')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('icon'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide icon
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="search_terms" class="form-label">Search Terms</label>
                <textarea rows="1" class="form-control tags-input" id="search_terms" name="search_terms"><?= set_value('search_terms') ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('search_terms')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('search_terms'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide search_terms
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin/configurations') ?>" class="btn btn-outline-danger">
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
