<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>View Education<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Resumes', 'url' => '/account/resumes'),
    array('title' => 'Manage Resumes', 'url' => '/account/resumes/manage-education'),
    array('title' => 'View Education')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Education</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="institution" class="form-label">Institution</label>
                <input type="text" class="form-control title-text" id="institution" name="institution" data-show-err="true" maxlength="250" value="<?= $education_data['institution']; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="degree" class="form-label">Degree</label>
                <input type="text" class="form-control title-text" id="degree" name="degree" data-show-err="true" maxlength="250" value="<?= $education_data['degree']; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="field_of_study" class="form-label">Field of Study</label>
                <input type="text" class="form-control title-text" id="field_of_study" name="field_of_study" data-show-err="true" maxlength="250" value="<?= $education_data['field_of_study']; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="text" class="form-control past-datepicker" id="start_date" name="start_date" autocomplete="off" value="<?= $education_data['start_date']; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="text" class="form-control past-datepicker" id="end_date" name="end_date" autocomplete="off" value="<?= $education_data['end_date']; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="grade" class="form-label">Grade</label>
                <input type="text" class="form-control title-text" id="grade" name="grade" data-show-err="true" maxlength="250" value="<?= $education_data['grade']; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="order" class="form-label">
                    Order
                </label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="2" value="<?= $education_data['order']; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="activities" class="form-label">Activities</label>
                <textarea rows="1" class="form-control" id="activities" name="activities" readonly><?= $education_data['activities']; ?></textarea>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="1" class="form-control" id="description" name="description" readonly><?= $education_data['description']; ?></textarea>
            </div>
            
            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                        <img loading="lazy" src="<?= base_url(getDefaultImagePath())?>" class="img-thumbnail" alt="Featured image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="institution_logo" class="form-label">Company Logo</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="institution_logo" name="institution_logo" placeholder="select logo" value="<?= $education_data['institution_logo']; ?>"
                                hx-post="<?=base_url()?>/htmx/set-image-display"
                                hx-trigger="keyup, load, changed delay:250ms"
                                hx-target="#display-preview-image"
                                hx-swap="innerHTML" readonly>
                            <button class="btn btn-dark" type="button">
                            <i class="ri-image-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>            
            
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="order" class="form-label">
                    Order
                </label>
                <input type="text" class="form-control" id="order" name="order" data-show-err="true" maxlength="250" value="<?= set_value('order') ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="group" class="form-label">
                    Group
                </label>
                <input type="text" class="form-control" id="group" name="group" data-show-err="true" maxlength="250" value="<?= set_value('group') ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= ($education_data['status'] == '0') ? 'Unpublished' : 'Published'?>" readonly>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/resumes/manage-educations') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
