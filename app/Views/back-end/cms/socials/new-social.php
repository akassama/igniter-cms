<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Social<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Socials', 'url' => '/account/cms/socials'),
    array('title' => 'New Social')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Social</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/socials/new-social'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control title-text" id="name" name="name" data-show-err="true" value="<?= set_value('name') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('name')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('name'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide name
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

            <div class="col-sm-12 col-md-12 mb-3">
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

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/socials') ?>" class="btn btn-outline-danger">
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
