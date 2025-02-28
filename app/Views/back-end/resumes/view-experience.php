<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>View Experience<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Resumes', 'url' => '/account/resumes'),
    array('title' => 'Manage Resumes', 'url' => '/account/resumes/manage-resumes'),
    array('title' => 'View Experience')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Experience</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" class="form-control title-text" id="company_name" name="company_name" data-show-err="true" maxlength="250" value="<?= $experience_data['company_name'] ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control title-text" id="position" name="position" data-show-err="true" maxlength="250" value="<?= $experience_data['position'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="text" class="form-control past-datepicker" id="start_date" name="start_date" autocomplete="off" value="<?= $experience_data['start_date'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="text" class="form-control past-datepicker" id="end_date" name="end_date" autocomplete="off" value="<?= $experience_data['end_date'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="current_job" class="form-label">Current Job</label>
                <input type="text" class="form-control title-text" id="current_job" name="current_job" data-show-err="true" maxlength="250" value="<?= $experience_data['current_job'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control title-text" id="location" name="location" data-show-err="true" maxlength="250" value="<?= $experience_data['location'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="1" class="form-control" id="description" name="description" readonly><?= $experience_data['description'] ?></textarea>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="1" class="form-control" id="description" name="description" readonly><?= $experience_data['description'] ?></textarea>
            </div>
            
            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                        <img loading="lazy" src="<?= base_url(getDefaultImagePath())?>" class="img-thumbnail" alt="Featured image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="company_logo" class="form-label">Company Logo</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="company_logo" name="company_logo" placeholder="select logo" value="<?= $experience_data['company_logo'] ?>"
                                hx-post="<?=base_url()?>/htmx/set-image-display"
                                hx-trigger="keyup, load, changed delay:250ms"
                                hx-target="#display-preview-image"
                                hx-swap="innerHTML"
                                readonly>
                            <button class="btn btn-dark" type="button">
                            <i class="ri-image-fill"></i>
                            </button>
                            <div class="invalid-feedback">
                                Please provide company_logo
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="company_url" class="form-label">Company URL</label>
                <input type="url" class="form-control" id="company_url" name="company_url" data-show-err="true" maxlength="250" value="<?= $experience_data['company_url'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="order" class="form-label">
                    Order
                </label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="2" value="<?= $experience_data['order'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="group" class="form-label">
                    Group
                </label>
                <input type="text" class="form-control" id="group" name="group" data-show-err="true" maxlength="250" value="<?= $experience_data['group'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= ($experience_data['status'] == '0') ? 'Unpublished' : 'Published'?>" readonly>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/resumes/manage-experiences') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
