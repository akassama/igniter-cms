<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>View Resume<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Resumes', 'url' => '/account/resumes'),
    array('title' => 'Manage Resumes', 'url' => '/account/resumes/manage-resumes'),
    array('title' => 'View Resume')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Resume</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control title-text" id="full_name" name="full_name" data-show-err="true" maxlength="100" value="<?= $resume_data['full_name'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $resume_data['title'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" data-show-err="true" maxlength="250" value="<?= $resume_data['email'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" data-show-err="true" maxlength="250" value="<?= $resume_data['phone'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea rows="1" class="form-control" id="address" name="address" readonly><?= $resume_data['address'] ?></textarea>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="website" class="form-label">Website</label>
                <input type="url" class="form-control" id="website" name="website" data-show-err="true" maxlength="250" value="<?= $resume_data['website'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" data-show-err="true" maxlength="250" value="<?= $resume_data['linkedin_url'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="github_url" class="form-label">Github URL</label>
                <input type="url" class="form-control" id="github_url" name="github_url" data-show-err="true" maxlength="250" value="<?= $resume_data['github_url'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="twitter_url" class="form-label">Twitter-X URL</label>
                <input type="url" class="form-control" id="twitter_url" name="twitter_url" data-show-err="true" maxlength="250" value="<?= $resume_data['twitter_url'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="cv_file" class="form-label">CV File</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="cv_file" name="cv_file" placeholder="select file" maxlength="250" value="<?= $resume_data['cv_file'] ?>" readonly>
                    <button class="btn btn-dark" type="button">
                        <i class="ri-file-text-line"></i>
                    </button>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= ($resume_data['status'] == '0') ? 'Unpublished' : 'Published'?>" readonly>
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
                            <input type="text" class="form-control" id="image" name="image" placeholder="select image" value="<?= $resume_data['image'] ?>"
                                hx-post="<?=base_url()?>/htmx/set-image-display"
                                hx-trigger="keyup, load, changed delay:250ms"
                                hx-target="#display-preview-image"
                                hx-swap="innerHTML" 
                                readonly>
                            <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                                <i class="ri-image-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="summary" class="form-label">Summary</label>
                <textarea rows="1" class="form-control" id="summary" name="summary" readonly><?= $resume_data['summary'] ?></textarea>
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
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $resume_data['meta_title'] ?>" readonly>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea type="text" class="form-control" id="meta_description" name="meta_description" readonly><?= $resume_data['meta_description'] ?></textarea>
                                    </div>
                                    <div class="col-12 mb-3 mt-3">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control tags-input" id="meta_keywords" name="meta_keywords" value="<?= $resume_data['meta_keywords'] ?>" readonly>
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
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
