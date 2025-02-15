<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Home Page', 'url' => '/account/cms/home-page'),
    array('title' => 'View Home Page Section')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Home Page Section</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section" class="form-label">Section</label>
                <input type="text" class="form-control" id="section" name="section" value="<?= $home_page_data['section'] ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_title" class="form-label">Title</label>
                <input type="text" class="form-control" id="section_title" name="section_title" value="<?= $home_page_data['section_title'] ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_description" class="form-label">Description</label>
                <textarea class="form-control" id="section_description" name="section_description" readonly><?= $home_page_data['section_description'] ?></textarea>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= ($home_page_data['status'] == '0') ? 'Unpublished' : 'Published'?>" readonly>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="order" class="form-label">Order</label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="2" value="<?= $home_page_data['order'] ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_image" class="form-label">Section Image</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="section_image" name="section_image" value="<?= $home_page_data['section_image'] ?>" readonly>
                    <button class="btn btn-dark" type="button">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_image_2" class="form-label">Section Image 2</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="section_image_2" name="section_image_2" value="<?= $home_page_data['section_image_2'] ?>" readonly>
                    <button class="btn btn-dark" type="button">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_image_3" class="form-label">Section Image 3</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="section_image_3" name="section_image_3" value="<?= $home_page_data['section_image_3'] ?>" readonly>
                    <button class="btn btn-dark" type="button">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_image_4" class="form-label">Section Image 4</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="section_image_4" name="section_image_4" value="<?= $home_page_data['section_image_4'] ?>" readonly>
                    <button class="btn btn-dark" type="button">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_video" class="form-label">Section Video</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="section_video" name="section_video" value="<?= $home_page_data['section_video'] ?>" readonly>
                    <button class="btn btn-dark" type="button">
                        <i class="ri-youtube-fill"></i>
                    </button>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_audio" class="form-label">Section Audio</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="section_audio" name="section_audio" value="<?= $home_page_data['section_audio'] ?>" readonly>
                    <button class="btn btn-dark" type="button">
                        <i class="ri-mv-line"></i>
                    </button>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_file" class="form-label">Section File</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="section_file" name="section_file" value="<?= $home_page_data['section_file'] ?>" readonly>
                    <button class="btn btn-dark" type="button">
                        <i class="ri-folder-2-line"></i>
                    </button>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="content_blocks" class="form-label">Content Block(s)</label>
                <input type="text" class="form-control" id="content_blocks" name="content_blocks" value="<?= $home_page_data['content_blocks'] ?>"  readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <label for="section_link" class="form-label">
                            Section Link
                            <span class="small text-muted">(Use '/' for internal section_links)</span>
                        </label>
                        <input type="text" class="form-control" id="section_link" name="section_link" value="<?= $home_page_data['section_link'] ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="new_tab" class="form-label">New Tab</label>
                        <input type="text" class="form-control" id="new_tab" name="new_tab" value="<?= ($home_page_data['new_tab'] == '0') ? 'No' : 'Yes'?>" readonly>
                    </div>
                </div>
            </div>
            
            <!-- entry data -->
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="created_by" class="form-label">Created BY</label>
                <input type="text" class="form-control" id="created_by" name="created_by" maxlength="250" value="<?= getActivityBy(esc($home_page_data['created_by']) , ""); ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="updated_by" class="form-label">Updated BY</label>
                <input type="text" class="form-control" id="updated_by" name="updated_by" maxlength="250" value="<?= getActivityBy(esc($home_page_data['updated_by']) , ""); ?>" readonly>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/home-page') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
