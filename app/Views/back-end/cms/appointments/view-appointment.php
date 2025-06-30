<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>View Appointment<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Blogs', 'url' => '/account/cms/appointments'),
    array('title' => 'View Appointment')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Appointment</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $appointment_data['title'] ?>" readonly>                
            </div> 

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="slug" class="form-label">Slug</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= base_url('/appointment/'); ?></span>
                    <input type="text" class="form-control" id="slug" name="slug" value="<?= $appointment_data['slug'] ?>" readonly>
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                            <img loading="lazy" src="<?= getImageUrl(($appointment_data['image']) ?? getDefaultImagePath())?>" class="img-thumbnail" alt="Featured image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="image" name="image" value="<?= $appointment_data['image'] ?>" readonly>
                            <button class="btn btn-dark" type="button">
                                <i class="ri-image-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="1" class="form-control" id="description" name="description" readonly><?= $appointment_data['description'] ?></textarea>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="appointment_type" class="form-label">Appointment Type</label>
                <input type="text" class="form-control" id="appointment_type" name="appointment_type" value="<?= $appointment_data['appointment_type'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="embed_url" class="form-label">Embed URL</label>
                <input type="text" class="form-control" id="embed_url" name="embed_url" value="<?= $appointment_data['embed_url'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="embed_script" class="form-label">Embed Script</label>
                <div class="border border-dark rounded p-2" id="embed_script" name="embed_script"><?= htmlspecialchars($appointment_data['embed_script']); ?></div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="widget_height" class="form-label">Widget Height</label>
                <input type="text" class="form-control" id="widget_height" name="widget_height" value="<?= $appointment_data['widget_height'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="widget_min_width" class="form-label">Widget Min. Width</label>
                <input type="text" class="form-control" id="widget_min_width" name="widget_min_width" value="<?= $appointment_data['widget_min_width'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= ($appointment_data['status'] == '0') ? 'Unpublished' : 'Published'?>" readonly>
            </div>

            <div class="col-12 mb-3">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                            SEO Data
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $appointment_data['meta_title'] ?>" readonly>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea type="text" class="form-control" id="meta_description" name="meta_description" readonly><?= $appointment_data['meta_description'] ?></textarea>
                                    </div>
                                    <div class="col-12 mb-3 mt-3">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control tags-input" id="meta_keywords" name="meta_keywords" value="<?= $appointment_data['meta_keywords'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- entry data -->
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="created_by" class="form-label">Created BY</label>
                <input type="text" class="form-control" id="created_by" name="created_by" maxlength="250" value="<?= getActivityBy(esc($appointment_data['created_by']) , ""); ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="updated_by" class="form-label">Updated BY</label>
                <input type="text" class="form-control" id="updated_by" name="updated_by" maxlength="250" value="<?= getActivityBy(esc($appointment_data['updated_by']) , ""); ?>" readonly>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/appointments') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
