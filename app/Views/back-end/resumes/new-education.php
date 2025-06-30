<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Education<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Resumes', 'url' => '/account/resumes'),
    array('title' => 'Manage Resumes', 'url' => '/account/resumes/manage-educations'),
    array('title' => 'New Education')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Education</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/resumes/new-education'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="institution" class="form-label">Institution</label>
                <input type="text" class="form-control title-text" id="institution" name="institution" data-show-err="true" maxlength="250" value="<?= set_value('institution') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('institution')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('institution'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide institution
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="degree" class="form-label">Degree</label>
                <input type="text" class="form-control title-text" id="degree" name="degree" data-show-err="true" maxlength="250" value="<?= set_value('degree') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('degree')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('degree'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide degree
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="field_of_study" class="form-label">Field of Study</label>
                <input type="text" class="form-control title-text" id="field_of_study" name="field_of_study" data-show-err="true" maxlength="250" value="<?= set_value('field_of_study') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('field_of_study')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('field_of_study'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide field_of_study
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                    <input type="text" class="form-control past-datepicker" id="start_date" name="start_date" autocomplete="off" value="<?= set_value('start_date') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('start_date')) {?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('start_date'); ?>
                </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide start_date
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="end_date" class="form-label">End Date</label>
                    <input type="text" class="form-control past-datepicker" id="end_date" name="end_date" autocomplete="off" value="<?= set_value('end_date') ?>">
                <!-- Error -->
                <?php if($validation->getError('end_date')) {?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('end_date'); ?>
                </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide end_date
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="grade" class="form-label">Grade</label>
                <input type="text" class="form-control title-text" id="grade" name="grade" data-show-err="true" maxlength="250" value="<?= set_value('grade') ?>">
                <!-- Error -->
                <?php if($validation->getError('grade')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('grade'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide grade
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

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="activities" class="form-label">Activities</label>
                <textarea rows="1" class="form-control" id="activities" name="activities"><?= set_value('activities') ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('activities')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('activities'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide activities
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="description" class="form-label">Description</label>
                    <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn"
                    hx-post="<?=base_url()?>/htmx/get-education-description-via-ai"
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
                        <input type="text" class="form-control" id="institution_logo" name="institution_logo" placeholder="select logo" value="<?= set_value('institution_logo') ?>"
                            hx-post="<?=base_url()?>/htmx/set-image-display"
                            hx-trigger="keyup, changed delay:250ms"
                            hx-target="#display-preview-image"
                            hx-swap="innerHTML">
                        <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                        <i class="ri-image-fill"></i>
                        </button>
                        <div class="invalid-feedback">
                            Please provide institution_logo
                        </div>
                        </div>
                        <!-- Error -->
                        <?php if($validation->getError('institution_logo')) {?>
                        <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('institution_logo'); ?>
                        </div>
                        <?php }?>
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
                    <?=getDataGroupOptions(null, "Education")?>
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

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/resumes/manage-educations') ?>" class="btn btn-outline-danger">
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
