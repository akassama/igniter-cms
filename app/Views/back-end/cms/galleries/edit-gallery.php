<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Edit Gallery<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Galleries', 'url' => '/account/cms/galleries'),
    array('title' => 'Edit Gallery')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit Gallery</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/galleries/edit-gallery'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
        <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $gallery_data['title'] ?>" required>
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

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="caption" class="form-label">Caption</label>
                <textarea rows="1" class="form-control" id="caption" name="caption" maxlength="500"><?= $gallery_data['caption'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('caption')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('caption'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide caption
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="category_filter" class="form-label">Category Filter</label>
                <input type="text" class="form-control letters-only" id="category_filter" name="category_filter" maxlength="100" value="<?= $gallery_data['category_filter'] ?>">
                <!-- Error -->
                <?php if($validation->getError('category_filter')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('category_filter'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide category_filter
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="group" class="form-label">
                    Group
                    <small class="text-muted">(Optional - use this if you want to filter data by group)</small>
                </label>
                <select class="form-select" aria-label="group" id="group" name="group">
                    <option value="">Select group</option>
                    <?=getDataGroupOptions($gallery_data['group'], "Gallery")?>
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

            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                            <img loading="lazy" src="<?= base_url(getDefaultImagePath())?>" class="img-thumbnail" alt="Image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="image" name="image" maxlength="250" placeholder="select featured image" value="<?= $gallery_data['image'] ?>"
                            hx-post="<?=base_url()?>/htmx/set-image-display"
                            hx-trigger="keyup, load, changed delay:250ms"
                            hx-target="#display-preview-image"
                            hx-swap="innerHTML" required>
                            <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#ciFileManagerModal">
                                <i class="ri-image-fill"></i>
                            </button>
                            <div class="invalid-feedback">
                                Please provide featured image
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
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="">Select status</option>
                    <option value="0" <?= ($gallery_data['status'] == '0') ? 'selected' : '' ?>>Unpublished</option>
                    <option value="1" <?= ($gallery_data['status'] == '1') ? 'selected' : '' ?>>Published</option>
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
                <input type="hidden" class="form-control" id="gallery_id" name="gallery_id" value="<?= $gallery_data['gallery_id']; ?>" />
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $gallery_data['created_by']; ?>" />
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/galleries') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <?= $this->include('back-end/_shared/_edit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
