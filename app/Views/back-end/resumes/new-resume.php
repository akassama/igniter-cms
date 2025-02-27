<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Resumes', 'url' => '/account/resumes'),
    array('title' => 'Manage Resumes', 'url' => '/account/resumes/manage-resumes'),
    array('title' => 'New Resume')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Resume</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/resumes/new-resume'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control title-text" id="full_name" name="full_name" data-show-err="true" maxlength="100" value="<?= set_value('full_name') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('full_name')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('full_name'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide full_name
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

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" data-show-err="true" maxlength="250" value="<?= set_value('email') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('email')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('email'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide email
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" data-show-err="true" maxlength="250" value="<?= set_value('phone') ?>">
                <!-- Error -->
                <?php if($validation->getError('phone')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('phone'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide phone
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea rows="1" class="form-control" id="address" name="address" required><?= set_value('address') ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('address')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('address'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide address
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="website" class="form-label">Website</label>
                <input type="url" class="form-control" id="website" name="website" data-show-err="true" maxlength="250" value="<?= set_value('website') ?>">
                <!-- Error -->
                <?php if($validation->getError('website')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('website'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide website
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" data-show-err="true" maxlength="250" value="<?= set_value('linkedin_url') ?>">
                <!-- Error -->
                <?php if($validation->getError('linkedin_url')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('linkedin_url'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide linkedin_url
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="github_url" class="form-label">Github URL</label>
                <input type="url" class="form-control" id="github_url" name="github_url" data-show-err="true" maxlength="250" value="<?= set_value('github_url') ?>">
                <!-- Error -->
                <?php if($validation->getError('github_url')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('github_url'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide github_url
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="twitter_url" class="form-label">Twitter-X URL</label>
                <input type="url" class="form-control" id="twitter_url" name="twitter_url" data-show-err="true" maxlength="250" value="<?= set_value('twitter_url') ?>">
                <!-- Error -->
                <?php if($validation->getError('twitter_url')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('twitter_url'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide twitter_url
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="cv_file" class="form-label">CV File</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="cv_file" name="cv_file" placeholder="select file">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#documentFilesModal">
                        <i class="ri-file-text-line"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('cv_file')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('cv_file'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide cv_file
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
                        <input type="text" class="form-control" id="image" name="image" placeholder="select image" value="<?= set_value('image') ?>"
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
                <label for="summary" class="form-label">Summary</label>
                <textarea rows="1" class="form-control" id="summary" name="summary" required><?= set_value('summary') ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('summary')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('summary'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide summary
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
                                        <div id="meta-title-div">
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= set_value('meta_title') ?>">
                                        </div>
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
                                        <div id="meta-description-div">
                                            <textarea type="text" class="form-control" id="meta_description" name="meta_description" ><?= set_value('meta_description') ?></textarea>
                                        </div>
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
                                    <div class="col-12 mb-3">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <div id="meta-keywords-div">
                                            <input type="text" class="form-control tags-input" id="meta_keywords" name="meta_keywords" value="<?= set_value('meta_keywords') ?>" >
                                        </div>
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

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/resumes/manage-resumes') ?>" class="btn btn-outline-danger">
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
