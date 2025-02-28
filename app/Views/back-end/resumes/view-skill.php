<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>View Skills<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Resumes', 'url' => '/account/resumes'),
    array('title' => 'Manage Resumes', 'url' => '/account/resumes/manage-skills'),
    array('title' => 'View Skills')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Skills</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control title-text" id="category" name="category" data-show-err="true" maxlength="250" value="<?= $skill_data['category'] ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control title-text" id="name" name="name" data-show-err="true" maxlength="250" value="<?= $skill_data['name'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="proficiency_level" class="form-label">
                    Proficiency Level
                </label>
                <input type="text" class="form-control integer-plus-only" id="proficiency_level" name="proficiency_level" data-show-err="true" maxlength="2" value="<?= $skill_data['proficiency_level'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="years_experience" class="form-label">
                    Years Experience
                </label>
                <input type="text" class="form-control float-number" id="years_experience" name="years_experience" data-show-err="true" maxlength="2" value="<?= $skill_data['years_experience'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="1" class="form-control" id="description" name="description" readonly><?= $skill_data['description'] ?></textarea>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="icon" class="form-label">Icon</label>
                <input type="text" class="form-control" id="icon" name="icon" data-show-err="true" maxlength="250" value="<?= htmlspecialchars($skill_data['icon']) ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="order" class="form-label">
                    Order
                </label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="2" value="<?= $skill_data['order'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="group" class="form-label">
                    Group
                </label>
                <input type="text" class="form-control" id="group" name="group" data-show-err="true" maxlength="250" value="<?= $skill_data['group']; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= ($skill_data['status'] == '0') ? 'Unpublished' : 'Published'?>" readonly>
            </div>


            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/resumes/manage-skills') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
