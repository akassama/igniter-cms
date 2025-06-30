<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Edit Appointment<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Appointments', 'url' => '/account/cms/appointments'),
    array('title' => 'Edit Appointment')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit Appointment</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/appointments/edit-appointment'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $appointment_data['title'] ?>" required>
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
                <label for="description" class="form-label">Description</label>
                <textarea rows="1" class="form-control" id="description" name="description" maxlength="500"><?= $appointment_data['description'] ?></textarea>
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
                <label for="slug" class="form-label">Slug</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= base_url('/appointment/'); ?></span>
                    <input type="text" class="form-control" id="slug" name="slug" value="<?= $appointment_data['slug'] ?>" required>
                    <div class="invalid-feedback">
                        Please provide slug
                    </div>
                </div>
                <!-- Error -->
                <?php if($validation->getError('slug')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('slug'); ?>
                    </div>
                <?php }?>
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
                            <input type="text" class="form-control" id="image" name="image" value="<?= $appointment_data['image'] ?>" placeholder="select featured image"
                            hx-post="<?=base_url()?>/htmx/set-image-display"
                            hx-trigger="load, keyup, changed delay:50ms"
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

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="appointment_type" class="form-label">Appointment Type</label>
                <select class="form-select" id="appointment_type" name="appointment_type" required>
                    <option value="">Select appointment type</option>
                    <option value="calendly" <?= (strtolower($appointment_data['appointment_type']) == 'calendly') ? 'selected' : '' ?>>Calendly</option>
                    <!-- <option value="setmore" <?= (strtolower($appointment_data['appointment_type']) == 'setmore') ? 'selected' : '' ?>>Setmore</option>
                    <option value="simplybook" <?= (strtolower($appointment_data['appointment_type']) == 'simplybook') ? 'selected' : '' ?>>Simplybook</option> -->
                </select>
                <!-- Error -->
                <?php if($validation->getError('appointment_type')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('appointment_type'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide appointment_type
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="embed_url" class="form-label">Embed URL</label>
                <input type="url" class="form-control" id="embed_url" name="embed_url" data-show-err="true" maxlength="250" value="<?= $appointment_data['embed_url'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('embed_url')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('embed_url'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide embed_url
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="embed_script" class="form-label">
                    Embed Script
                    <small>(Include script tags of the JavaScript)</small>
                </label>
                <textarea rows="4" class="form-control js-editor" id="embed_script" name="embed_script" required><?= $appointment_data['embed_script'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('embed_script')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('embed_script'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide embed_script
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="widget_height" class="form-label">
                    Widget Height
                    <small>(E.g. '700px' or '100%')</small>
                </label>
                <input type="text" class="form-control integer-plus-only" id="widget_height" name="widget_height" data-show-err="true" maxlength="6" value="<?= $appointment_data['widget_height'] ?>">
                <!-- Error -->
                <?php if($validation->getError('widget_height')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('widget_height'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide widget_height
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="widget_min_width" class="form-label">
                    Widget Min. Width
                    <small>(E.g. '320px')</small>
                </label>
                <input type="text" class="form-control integer-plus-only" id="widget_min_width" name="widget_min_width" data-show-err="true" maxlength="6" value="<?= $appointment_data['widget_min_width'] ?>">
                <!-- Error -->
                <?php if($validation->getError('widget_min_width')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('widget_min_width'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide widget_min_width
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="">Select status</option>
                    <option value="0" <?= ($appointment_data['status'] == '0') ? 'selected' : '' ?>>Unpublished</option>
                    <option value="1" <?= ($appointment_data['status'] == '1') ? 'selected' : '' ?>>Published</option>
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

            <div class="col-12 mb-3">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            SEO Data
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $appointment_data['meta_title'] ?>">
                                        <!-- Error -->
                                        <?php if($validation->getError('meta_title')) {?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('meta_title'); ?>
                                            </div>
                                        <?php }?>
                                        <div class="invalid-feedback">
                                            Please provide meta_title
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea type="text" class="form-control" id="meta_description" name="meta_description"><?= $appointment_data['meta_description'] ?></textarea>
                                        <!-- Error -->
                                        <?php if($validation->getError('meta_description')) {?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('meta_description'); ?>
                                            </div>
                                        <?php }?>
                                        <div class="invalid-feedback">
                                            Please provide meta_description
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 mt-3">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control tags-input" id="meta_keywords" name="meta_keywords" value="<?= $appointment_data['meta_keywords'] ?>">
                                        <!-- Error -->
                                        <?php if($validation->getError('meta_keywords')) {?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('meta_keywords'); ?>
                                            </div>
                                        <?php }?>
                                        <div class="invalid-feedback">
                                            Please provide meta_keywords
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="appointment_id" name="appointment_id" value="<?= $appointment_data['appointment_id']; ?>" />
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $appointment_data['created_by']; ?>" />
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/appointments') ?>" class="btn btn-outline-danger">
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
