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
    array('title' => 'View Testimonial')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Testimonial</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $testimonial_data['name'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $testimonial_data['title'] ?>" readonly>
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
                        <input type="text" class="form-control" id="image" name="image" placeholder="select image" value="<?= $testimonial_data['image'] ?>"
                            hx-post="<?=base_url()?>/htmx/set-image-display"
                            hx-trigger="keyup, load, changed delay:250ms"
                            hx-target="#display-preview-image"
                            hx-swap="innerHTML" readonly>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="testimonial" class="form-label">Testimonial</label>
                <textarea rows="1" class="form-control" id="testimonial" name="testimonial" readonly><?= $testimonial_data['testimonial'] ?></textarea>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="company" class="form-label">Company/Organization</label>
                    <input type="text" class="form-control" id="company" name="company" value="<?= $testimonial_data['company'] ?>" readonly>
                </div>

                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <input type="text" class="form-control" id="rating" name="rating" value="<?= $testimonial_data['rating'] ?>" readonly>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-12 mb-3">
                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <label for="link" class="form-label">
                            Details Link
                            <span class="small text-muted">(Use '/' for internal links)</span>
                        </label>
                        <input type="text" class="form-control" id="link" name="link" value="<?= $testimonial_data['link'] ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="new_tab" class="form-label">New Tab</label>
                        <input type="text" class="form-control" id="new_tab" name="new_tab" value="<?= ($testimonial_data['new_tab'] == '0') ? 'No' : 'Yes'?>" readonly>
                    </div>
                </div>
            </div>            
            
            <div class="row">
                <!-- entry data -->
                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="created_by" class="form-label">Created BY</label>
                    <input type="text" class="form-control" id="created_by" name="created_by" maxlength="250" value="<?= getActivityBy(esc($testimonial_data['created_by']) , ""); ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="updated_by" class="form-label">Updated BY</label>
                    <input type="text" class="form-control" id="updated_by" name="updated_by" maxlength="250" value="<?= getActivityBy(esc($testimonial_data['updated_by']) , ""); ?>" readonly>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/testimonials') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
