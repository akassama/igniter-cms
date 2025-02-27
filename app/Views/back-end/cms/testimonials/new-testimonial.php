<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Testimonials', 'url' => '/account/cms/testimonials'),
    array('title' => 'New Testimonial')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Testimonial</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/testimonials/new-testimonial'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control title-text" id="name" name="name" data-show-err="true" maxlength="100" value="<?= set_value('name') ?>" required>
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

            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                        <img loading="lazy" src="<?= base_url(getDefaultImagePath())?>" class="img-thumbnail" alt="Featured image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" id="image" name="image" maxlength="250" placeholder="select image" value="<?= set_value('image') ?>"
                            hx-post="<?=base_url()?>/htmx/set-image-display"
                            hx-trigger="keyup, changed delay:250ms"
                            hx-target="#display-preview-image"
                            hx-swap="innerHTML">
                        <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
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
                <label for="testimonial" class="form-label">Testimonial</label>
                <textarea rows="1" class="form-control" id="testimonial" name="testimonial" maxlength="500" required><?= set_value('testimonial') ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('testimonial')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('testimonial'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide testimonial
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="company" class="form-label">Company/Organization</label>
                <input type="text" class="form-control" id="company" name="company" maxlength="250" value="<?= set_value('company') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('company')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('company'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide company
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="rating" class="form-label">Rating</label>
                <input type="text" class="form-control integer-plus-only" id="rating" name="rating" data-show-err="true" maxlength="3" value="<?= set_value('rating') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('rating')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('rating'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide rating
                </div>
            </div>
            
            <div class="col-sm-12 col-md-12 mb-3">
                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <label for="link" class="form-label">
                            Details Link
                            <span class="small text-muted">(Use '/' for internal links)</span>
                        </label>
                        <input type="text" class="form-control" id="link" name="link" maxlength="250" value="<?= set_value('link') ?>">
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
                <a href="<?= base_url('/account/cms/testimonials') ?>" class="btn btn-outline-danger">
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
