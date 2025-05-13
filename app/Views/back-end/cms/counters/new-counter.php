<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Counter<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Counters', 'url' => '/account/cms/counters'),
    array('title' => 'New Counter')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Counter</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/counters/new-counter'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
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

            <div class="col-sm-12 col-md-12 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                <label for="description" class="form-label">Description</label>
                    <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn"
                    hx-post="<?=base_url()?>/htmx/get-counter-description-via-ai"
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
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="initial_value" class="form-label">
                            Initial Count
                        </label>
                        <input type="text" class="form-control float-number" id="initial_value" name="initial_value" data-show-err="true" value="<?= set_value('initial_value') ?>">
                        <!-- Error -->
                        <?php if($validation->getError('initial_value')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('initial_value'); ?>
                            </div>
                        <?php }?>
                        <div class="invalid-feedback">
                            Please provide initial value
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="final_value" class="form-label">
                            Final Count
                        </label>
                        <input type="text" class="form-control float-number" id="final_value" name="final_value" data-show-err="true" value="<?= set_value('final_value') ?>" required>
                        <!-- Error -->
                        <?php if($validation->getError('final_value')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('final_value'); ?>
                            </div>
                        <?php }?>
                        <div class="invalid-feedback">
                            Please provide final value
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="extra_text" class="form-label">
                            Extra Text
                        </label>
                        <input type="text" class="form-control" id="extra_text" name="extra_text" value="<?= set_value('extra_text') ?>">
                        <!-- Error -->
                        <?php if($validation->getError('extra_text')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('extra_text'); ?>
                            </div>
                        <?php }?>
                        <div class="invalid-feedback">
                            Please provide extra_text
                        </div>
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

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/counters') ?>" class="btn btn-outline-danger">
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

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
