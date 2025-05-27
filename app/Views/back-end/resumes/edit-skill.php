<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Skills<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Resumes', 'url' => '/account/resumes'),
    array('title' => 'Manage Resumes', 'url' => '/account/resumes/manage-skills'),
    array('title' => 'New Skills')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Skills</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/resumes/edit-skill'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control title-text" id="category" name="category" data-show-err="true" maxlength="250" value="<?= $skill_data['category'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('category')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('category'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide category
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control title-text" id="name" name="name" data-show-err="true" maxlength="250" value="<?= $skill_data['name'] ?>" required>
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
                <label for="proficiency_level" class="form-label">
                    Proficiency Level
                </label>
                <input type="text" class="form-control integer-plus-only" id="proficiency_level" name="proficiency_level" data-show-err="true" maxlength="2" value="<?= $skill_data['proficiency_level'] ?>">
                <!-- Error -->
                <?php if($validation->getError('proficiency_level')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('proficiency_level'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide proficiency_level
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="years_experience" class="form-label">
                    Years Experience
                </label>
                <input type="text" class="form-control float-number" id="years_experience" name="years_experience" data-show-err="true" maxlength="2" value="<?= $skill_data['years_experience'] ?>">
                <!-- Error -->
                <?php if($validation->getError('years_experience')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('years_experience'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide years_experience
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required><?= $skill_data['description'] ?></textarea>
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

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="icon" class="form-label">Icon</label>
                <input type="text" class="form-control" id="icon" name="icon" data-show-err="true" maxlength="250" value="<?= htmlspecialchars($skill_data['icon']) ?>">
                <!-- Error -->
                <?php if($validation->getError('icon')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('icon'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide icon
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="order" class="form-label">
                    Order
                </label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="2" value="<?= $skill_data['order'] ?>">
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
                <input type="text" class="form-control" id="group" name="group" data-show-err="true" maxlength="250" value="<?= $skill_data['group']; ?>">
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

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="">Select status</option>
                    <option value="0" <?= ($skill_data['status'] == '0') ? 'selected' : '' ?>>Unpublished</option>
                    <option value="1" <?= ($skill_data['status'] == '1') ? 'selected' : '' ?>>Published</option>
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

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="skill_id" name="skill_id" value="<?= $skill_data['skill_id']; ?>" />
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $skill_data['created_by']; ?>" />
            </div>


            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/resumes/manage-skills') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <button type="submit" class="btn btn-outline-primary float-end" id="submit-btn">
                    <i class="ri-edit-box-line"></i>
                    Update
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
