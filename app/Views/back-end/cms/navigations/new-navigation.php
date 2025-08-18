<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Navigation<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Navigations', 'url' => '/account/cms/navigations'),
    array('title' => 'New Navigation')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Navigation</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/navigations/new-navigation'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control alphanumeric-plus-space" id="title" name="title" data-show-err="true" maxlength="100" value="<?= set_value('title') ?>" maxlength="50" required>
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

            <div class="col-sm-12 col-md-6 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="description" class="form-label">Description</label>
                        <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn"
                        hx-post="<?=base_url()?>/htmx/get-navigation-description-via-ai"
                        hx-trigger="click delay:250ms"
                        hx-target="#description-div"
                        hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                </div>
                <div id="description-div">
                    <textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required><?= set_value('description') ?></textarea>
                </div>
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
            
            <div class="col-sm-12 col-md-4 mb-3">
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

            <div class="col-sm-12 col-md-4 mb-3">
                <label for="group" class="form-label">
                    Group
                    <small class="text-muted">(Optional - use this if you want to filter data by group)</small>
                </label>
                <select class="form-select" aria-label="group" id="group" name="group">
                    <option value="">Select group</option>
                    <?=getDataGroupOptions(null, "Navigation")?>
                </select>
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

            <div class="col-sm-12 col-md-4 mb-3">
                <label for="order" class="form-label">
                    Order
                </label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="2" maxlength="2" value="<?= set_value('order') ?>">
                <!-- Error -->
                <?php if($validation->getError('order')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('order'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide order
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="parent" class="form-label">Parent</label>
                <select class="form-select" id="parent" name="parent">
                    <option value="">Select parent (optional)</option>
                    <?= getNavigationParentSelectOptions() ?>
                </select>
                <!-- Error -->
                <?php if($validation->getError('parent')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('parent'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide parent
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="">Select status</option>
                    <option value="0">Unpublished</option>
                    <option value="1">Published</option>
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
                <label for="link" class="form-label">Link</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= base_url('/'); ?></span>
                    <input type="text" class="form-control" id="link" name="link" value="<?= set_value('link') ?>" required>
                </div>
                <!-- Error -->
                <?php if($validation->getError('link')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('link'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide link
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/navigations') ?>" class="btn btn-outline-danger">
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
