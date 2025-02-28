<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Edit Home Page Section<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Home Page', 'url' => '/account/cms/home-page'),
    array('title' => 'Edit Home Page Section')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit Home Page Section</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/home-page/edit-home-page-section'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section" class="form-label">Section</label>
                <input type="text" class="form-control letters-only" id="section" name="section" data-show-err="true" maxlength="100" value="<?= $home_page_data['section'] ?>" required readonly>
                <!-- Error -->
                <?php if($validation->getError('section')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('section'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide section
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="section_title" name="section_title" data-show-err="true" maxlength="250" value="<?= $home_page_data['section_title'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('section_title')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('section_title'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide section_title
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_description" class="form-label">Description</label>
                <textarea class="form-control" id="section_description" name="section_description"><?= $home_page_data['section_description'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('section_description')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('section_description'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide section_description
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="">Select status</option>
                    <option value="0" <?= ($home_page_data['status'] == '0') ? 'selected' : '' ?>>Unpublished</option>
                    <option value="1" <?= ($home_page_data['status'] == '1') ? 'selected' : '' ?>>Published</option>
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
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="order" class="form-label">Order</label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="2" value="<?= $home_page_data['order'] ?>">
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
                <label for="section_image" class="form-label">Section Image</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="section_image" name="section_image" value="<?= $home_page_data['section_image'] ?>" placeholder="select image">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('section_image')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('section_image'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide section_image
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_image_2" class="form-label">Section Image 2</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="section_image_2" name="section_image_2" value="<?= $home_page_data['section_image_2'] ?>" placeholder="select image">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('section_image_2')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('section_image_2'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide section_image_2
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_image_3" class="form-label">Section Image 3</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="section_image_3" name="section_image_3" value="<?= $home_page_data['section_image_3'] ?>" placeholder="select image">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('section_image_3')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('section_image_3'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide section_image_3
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_image_4" class="form-label">Section Image 4</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="section_image_4" name="section_image_4" value="<?= $home_page_data['section_image_4'] ?>" placeholder="select image">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('section_image_4')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('section_image_4'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide section_image_4
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_video" class="form-label">Section Video</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="section_video" name="section_video" value="<?= $home_page_data['section_video'] ?>" placeholder="select video">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#videoFilesModal">
                        <i class="ri-youtube-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('section_video')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('section_video'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide section_video
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_audio" class="form-label">Section Audio</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="section_audio" name="section_audio" value="<?= $home_page_data['section_audio'] ?>" placeholder="select audio">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#audioFilesModal">
                        <i class="ri-mv-line"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('section_audio')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('section_audio'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide section_audio
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="section_file" class="form-label">Section File</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="section_file" name="section_file" value="<?= $home_page_data['section_file'] ?>" placeholder="select file">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#allFilesModal">
                        <i class="ri-folder-2-line"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('section_file')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('section_file'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide section_file
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="content_blocks" class="form-label">Content Block(s)</label>
                <select class="form-select select2-options" id="content_blocks" name="content_blocks[]" multiple="multiple">
                    <option value="">Select content block(s)</option>
                    <?= getContentBlockOptions($home_page_data['content_blocks']) ?>
                </select>
                <!-- Error -->
                <?php if($validation->getError('content_blocks')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('content_blocks'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide content_blocks
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <label for="section_link" class="form-label">
                            Section Link
                            <span class="small text-muted">(Use '/' for internal section_links)</span>
                        </label>
                        <input type="text" class="form-control" id="section_link" name="section_link" value="<?= $home_page_data['section_link'] ?>">
                        <!-- Error -->
                        <?php if($validation->getError('section_link')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('section_link'); ?>
                            </div>
                        <?php }?>
                        <div class="invalid-feedback">
                            Please provide section_link
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="new_tab" class="form-label">New Tab</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="new_tab" name="new_tab" value="1" <?= ($home_page_data['new_tab'] == '1') ? 'checked' : '' ?>>
                            <label class="form-check-label small" for="new_tab">Toggle to open as new tab</label>
                        </div>
                        <!-- Error -->
                        <?php if($validation->getError('new_tab')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('new_tab'); ?>
                            </div>
                        <?php }?>
                        <div class="invalid-feedback">
                            Please provide new_tab
                        </div>
                    </div>
                </div>
            </div>

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="home_page_id" name="home_page_id" value="<?= $home_page_data['home_page_id']; ?>" />
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $home_page_data['created_by']; ?>" />
                <input type="hidden" class="form-control" id="current_content_blocks" name="current_content_blocks" value="<?= $home_page_data['content_blocks'] ?>">
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/home-page') ?>" class="btn btn-outline-danger">
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
