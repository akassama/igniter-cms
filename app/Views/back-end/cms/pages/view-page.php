<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>View Page<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Pages', 'url' => '/account/cms/pages'),
    array('title' => 'View Page')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Page</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $page_data['title'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="slug" class="form-label">Slug</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= base_url('/'); ?></span>
                    <input type="text" class="form-control" id="slug" name="slug" value="<?= $page_data['slug'] ?>" readonly>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="content" class="form-label">Content</label>
                <div class="border border-dark rounded p-2" id="content" name="content"><?= $page_data['content'] ?></div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="status" class="form-label">Group</label>
                <input type="text" class="form-control" id="group" name="group" value="<?= $page_data['group'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= ($page_data['status'] == '0') ? 'Unpublished' : 'Published'?>" readonly>
            </div>

            <div class="col-12 mb-3">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            SEO Data
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <div id="meta-title-div">
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $page_data['meta_title'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <div id="meta-description-div">
                                            <textarea type="text" class="form-control" id="meta_description" name="meta_description" readonly><?= $page_data['meta_description'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <div id="meta-keywords-div">
                                            <input type="text" class="form-control tags-input" id="meta_keywords" name="meta_keywords" value="<?= $page_data['meta_keywords'] ?>" readonly>
                                        </div>
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
                <input type="text" class="form-control" id="created_by" name="created_by" maxlength="250" value="<?= getActivityBy(esc($page_data['created_by']) , ""); ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="updated_by" class="form-label">Updated BY</label>
                <input type="text" class="form-control" id="updated_by" name="updated_by" maxlength="250" value="<?= getActivityBy(esc($page_data['updated_by']) , ""); ?>" readonly>
            </div>

            <div class="mb-3">
                <a href="<?= base_url('/account/cms/pages') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
