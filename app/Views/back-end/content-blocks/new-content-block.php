<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Content Block<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Content Blocks', 'url' => '/account/content-blocks'),
    array('title' => 'New Content Block')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Content Block</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/content-blocks/new-content-block'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= set_value('title') ?>" required>
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
                        hx-post="<?=base_url()?>/htmx/get-content-block-description-via-ai"
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

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea rows="1" class="form-control content-editor" id="content" name="content"><?= set_value('content') ?></textarea>
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
            
            <div class="col-sm-12 col-md-12 mb-3">
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

            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                            <img loading="lazy" src="<?= base_url(getDefaultImagePath())?>" class="img-thumbnail" alt="Image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="image" name="image" value="<?= set_value('image') ?>" placeholder="select image"
                            hx-post="<?=base_url()?>/htmx/set-image-display"
                            hx-trigger="keyup, changed delay:250ms"
                            hx-target="#display-preview-image"
                            hx-swap="innerHTML">
                            <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#ciFileManagerModal">
                                <i class="ri-image-fill"></i>
                            </button>
                            <div class="invalid-feedback">
                                Please provide image
                            </div>
                        </div>
                        <!-- Error -->
                        <?php if($validation->getError('image')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('image'); ?>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <label for="link" class="form-label">
                            Link
                            <span class="small text-muted">(Use '/' for internal links)</span>
                        </label>
                        <input type="text" class="form-control" id="link" name="link" value="<?= set_value('link') ?>">
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
                    <div class="col-sm-12 col-md-3">
                        <label for="new_tab" class="form-label">New Tab</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="new_tab" name="new_tab" value="1">
                            <label class="form-check-label small" for="new_tab">Toggle to open as new tab</label>
                        </div>
                        <!-- Error -->
                        <?php if($validation->getError('new_tab')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('new_tab'); ?>
                            </div>
                        <?php }?>
                        <div class="invalid-feedback">
                            Please provide new_tab
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="order" class="form-label">
                    Order
                </label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="2" value="<?= set_value('order') ?>">
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
                <label for="group" class="form-label">
                    Group
                </label>
                <select class="form-select" aria-label="group" id="group" name="group">
                    <option value="">Select group</option>
                    <?=getDataGroupOptions(null, "ContentBlock")?>
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

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="custom_field" class="form-label">Custom Data</label>
                <textarea rows="1" class="form-control" id="custom_field" name="custom_field"><?= set_value('custom_field') ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('custom_field')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('custom_field'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide custom_field
                </div>
            </div>

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="identifier" name="identifier" value="<?= generateContentIdentifier("cb"); ?>" />
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/content-blocks') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <?= $this->include('back-end/_shared/_submit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
