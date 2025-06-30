<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>View Gallery<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Galleries', 'url' => '/account/cms/galleries'),
    array('title' => 'View Gallery')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Gallery</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
     <div class="row">
        <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $gallery_data['title'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="caption" class="form-label">Caption</label>
                <textarea rows="1" class="form-control" id="caption" name="caption" maxlength="500"><?= $gallery_data['caption'] ?></textarea>
            </div>

            <div class="col-sm-12 col-md-4 mb-3">
                <label for="category_filter" class="form-label">Category Filter</label>
                <input type="text" class="form-control" id="category_filter" name="category_filter" value="<?= $gallery_data['category_filter'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-4 mb-3">
                <label for="group" class="form-label">Group</label>
                <input type="text" class="form-control" id="group" name="group" value="<?= $gallery_data['group'] ?>" readonly>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                            <img loading="lazy" src="<?= getImageUrl(($gallery_data['image']) ?? getDefaultImagePath())?>" class="img-thumbnail" alt="Featured image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="image" name="image" placeholder="select featured image" value="<?= $gallery_data['image'] ?>" readonly>
                            <button class="btn btn-dark" type="button">
                                <i class="ri-image-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= ($gallery_data['status'] == '0') ? 'Unpublished' : 'Published'?>" readonly>
            </div>         
            
            <!-- entry data -->
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="created_by" class="form-label">Created BY</label>
                <input type="text" class="form-control" id="created_by" name="created_by" maxlength="250" value="<?= getActivityBy(esc($gallery_data['created_by']) , ""); ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="updated_by" class="form-label">Updated BY</label>
                <input type="text" class="form-control" id="updated_by" name="updated_by" maxlength="250" value="<?= getActivityBy(esc($gallery_data['updated_by']) , ""); ?>" readonly>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/galleries') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
