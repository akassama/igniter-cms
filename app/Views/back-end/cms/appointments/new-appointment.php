<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Appointment<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Appointments', 'url' => '/account/cms/appointments'),
    array('title' => 'New Appointment')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Appointment</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/appointments/new-appointment'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= set_value('title') ?>" required
                    hx-post="<?=base_url()?>/htmx/get-appointment-title-slug"
                    hx-trigger="keyup, changed delay:250ms"
                    hx-target="#slug-div"
                    hx-swap="innerHTML">
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
                        hx-post="<?=base_url()?>/htmx/get-appointment-description-via-ai"
                        hx-trigger="click delay:250ms"
                        hx-target="#description-div"
                        hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                </div>
                <div id="description-div">
                    <textarea rows="1" class="form-control" id="description" name="description" maxlength="500"><?= set_value('description') ?></textarea>
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
                <label for="slug" class="form-label">Slug</label>
                <div class="input-group mb-3" id="slug-div">
                    <span class="input-group-text"><?= base_url('/appointment/'); ?></span>
                    <input type="text" class="form-control" id="slug" name="slug" value="<?= set_value('slug') ?>" required>
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
                            <input type="text" class="form-control" id="image" name="image" placeholder="select featured image" value="<?= set_value('image') ?>"
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

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="appointment_type" class="form-label">Appointment Type</label>
                <select class="form-select" id="appointment_type" name="appointment_type" required>
                    <option value="">Select appointment type</option>
                    <option value="calendly">Calendly</option>
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
                <input type="url" class="form-control" id="embed_url" name="embed_url" data-show-err="true" maxlength="250" value="<?= set_value('embed_url') ?>" required>
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
                <textarea rows="4" class="form-control js-editor" id="embed_script" name="embed_script" required><?= set_value('embed_script') ?></textarea>
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
                <input type="text" class="form-control integer-plus-only" id="widget_height" name="widget_height" data-show-err="true" maxlength="6" value="<?= set_value('widget_height') ?>">
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
                <input type="text" class="form-control integer-plus-only" id="widget_min_width" name="widget_min_width" data-show-err="true" maxlength="6" value="<?= set_value('widget_min_width') ?>">
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
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="meta_title" class="form-label">Meta Title</label>
                                            <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn" data-target="meta_title"
                                            hx-post="<?=base_url()?>/htmx/set-meta-title-via-ai"
                                            hx-trigger="click delay:250ms"
                                            hx-target="#meta-title-div"
                                            hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                                        </div>
                                        <div id="meta-title-div">
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= set_value('meta_title') ?>">
                                        </div>
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
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="meta_description" class="form-label">Meta Description</label>
                                            <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn" data-target="meta_description"
                                            hx-post="<?=base_url()?>/htmx/set-meta-description-via-ai"
                                            hx-trigger="click delay:250ms"
                                            hx-target="#meta-description-div"
                                            hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                                        </div>
                                        <div id="meta-description-div">
                                            <textarea class="form-control" id="meta_description" name="meta_description" ><?= set_value('meta_description') ?></textarea>
                                        </div>
                                        <?php if($validation->getError('meta_description')) {?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('meta_description'); ?>
                                            </div>
                                        <?php }?>
                                        <div class="invalid-feedback">
                                            Please provide meta_description
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                            <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn" data-target="meta_keywords"
                                            hx-post="<?=base_url()?>/htmx/set-meta-keywords-via-ai"
                                            hx-trigger="click delay:250ms"
                                            hx-target="#meta-keywords-div"
                                            hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                                        </div>
                                        <div id="meta-keywords-div" hx-on:htmx:after-settle="setTagsInput('meta_keywords')">
                                            <textarea rows="1" class="form-control tags-input" id="meta_keywords" name="meta_keywords"><?= set_value('meta_keywords') ?></textarea>
                                        </div>
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

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/appointments') ?>" class="btn btn-outline-danger">
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

<script>
    // Initialize tags input
    function setTagsInput(inputId){
        $('#'+inputId).tagsInput();
        $('#'+inputId).css('width', '100%');
    }
</script>

<!-- end main content -->
<?= $this->endSection() ?>
