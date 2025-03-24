<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Themes<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Themes', 'url' => '/account/admin/themes'),
    array('title' => 'Edit Theme')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Themes</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <!-- <a href="<?=base_url('/account/admin/themes/edit-theme-home-page')?>/<?= $theme_data['theme_id']; ?>" class="btn btn-outline-dark mx-1">
            <i class="ri-file-edit-line"></i> Edit Theme Home Page
        </a> -->
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/admin/themes/edit-theme'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="name" class="form-label">Theme Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $theme_data['name'] ?>" required
                       hx-post="<?=base_url()?>/htmx/check-theme-name-exists"
                       hx-trigger="keyup, changed delay:250ms"
                       hx-target="#existing-theme-name-error"
                       hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('name')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('name'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide name
                </div>
                <div id="existing-theme-name-error">
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="path" class="form-label">Path</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">public/front-end/themes/</span>
                    <input type="text" class="form-control" id="path" name="path" value="<?= $theme_data['path'] ?>" required>
                    <!-- Error -->
                    <?php if($validation->getError('path')) {?>
                        <div class='text-danger mt-2'>
                            <?= $error = $validation->getError('path'); ?>
                        </div>
                    <?php }?>
                    <div class="invalid-feedback">
                        Please provide path
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 mb-4">
                <label for="primary_color" class="form-label">Primary Theme Color</label>
                <input type="color" class="form-control form-control-color" id="primary_color" name="primary_color" value="<?= $theme_data['primary_color'];?>" required
                       hx-post="<?=base_url()?>/htmx/get-primary-color-name"
                       hx-trigger="load, change delay:100ms"
                       hx-target="#set-primary-color-name"
                       hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('primary_color')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('primary_color'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide primary color
                </div>
                <div class="mt-2" id="set-primary-color-name">
                </div>
            </div>

            <div class="col-sm-12 col-md-4 mb-4">
                <label for="secondary_color" class="form-label">Secondary Theme Color</label>
                <input type="color" class="form-control form-control-color" id="secondary_color" name="secondary_color" value="<?= $theme_data['secondary_color'];?>"
                    hx-post="<?=base_url()?>/htmx/get-secondary-color-name"
                    hx-trigger="load, change delay:100ms"
                    hx-target="#set-secondary-color-name"
                    hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('secondary_color')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('secondary_color'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide secondary color
                </div>
                <div class="mt-2" id="set-secondary-color-name">
                </div>
            </div>

            <div class="col-sm-12 col-md-4 mb-4">
                <label for="other_color" class="form-label">Other Color</label>
                <input type="color" class="form-control form-control-color" id="other_color" name="other_color" value="<?= $theme_data['other_color'];?>"
                       hx-post="<?=base_url()?>/htmx/get-other-color-name"
                       hx-trigger="load, change delay:100ms"
                       hx-target="#set-other-color-name"
                       hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('other_color')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('other_color'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide other color
                </div>
                <div class="mt-2" id="set-other-color-name">
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="image" class="form-label">Theme Image</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">public/front-end/themes/</span>
                    <input type="text" class="form-control" id="image" name="image" placeholder="theme-folder/assets/images/theme-image.png" value="<?= $theme_data['image'] ?>">
                    <!-- Error -->
                    <?php if($validation->getError('image')) {?>
                        <div class='text-danger mt-2'>
                            <?= $error = $validation->getError('image'); ?>
                        </div>
                    <?php }?>
                    <div class="invalid-feedback">
                        Please provide images
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="theme_url" class="form-label">Theme URL</label>
                <input type="url" class="form-control" id="theme_url" name="theme_url" value="<?= $theme_data['theme_url'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('theme_url')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('theme_url'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide theme_url
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="theme_bg_image" class="form-label">Theme Background Image</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="theme_bg_image" name="theme_bg_image" maxlength="250" placeholder="select image" value="<?= $theme_data['theme_bg_image'] ?>">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('theme_bg_image')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('theme_bg_image'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide theme_bg_image
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="theme_bg_video" class="form-label">Theme Background Video</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="theme_bg_video" name="theme_bg_video" maxlength="250" placeholder="select video" value="<?= $theme_data['theme_bg_video'] ?>">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#videoFilesModal">
                        <i class="ri-youtube-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('theme_bg_video')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('theme_bg_video'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide theme_bg_video
                </div>
            </div>
            
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="footer_copyright" class="form-label">Footer Copyright</label>
                <textarea rows="2" class="form-control" id="footer_copyright" name="footer_copyright" required><?= $theme_data['footer_copyright'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('footer_copyright')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('footer_copyright'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide footer_copyright
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="">Select category</option>
                    <?php foreach (config('CustomConfig')->themeCategories as $key => $value): ?>
                        <option value="<?= $value ?>" <?= ($theme_data['category'] == $value) ? 'selected' : '' ?>><?= $value ?></option>
                    <?php endforeach; ?>
                </select>
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
                <label for="sub_category" class="form-label">Sub Category</label>
                <select class="form-select" id="sub_category" name="sub_category">
                    <option value="">Select sub category</option>
                    <?php foreach (config('CustomConfig')->themeCategories as $key => $value): ?>
                        <option value="<?= $value ?>" <?= ($theme_data['sub_category'] == $value) ? 'selected' : '' ?>><?= $value ?></option>
                    <?php endforeach; ?>
                </select>
                <!-- Error -->
                <?php if($validation->getError('sub_category')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('sub_category'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide sub_category
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="home_page" class="form-label">Home Page Format</label>
                <select class="form-select" id="home_page" name="home_page" required>
                    <option value="">Select format</option>
                    <option value="HomePage" <?= ($theme_data['home_page'] == 'HomePage') ? 'selected' : '' ?>>HomePage</option>
                    <option value="Blog" <?= ($theme_data['home_page'] == 'Blog') ? 'selected' : '' ?>>Blog</option>
                    <option value="Shop" <?= ($theme_data['home_page'] == 'Shop') ? 'selected' : '' ?>>Shop</option>
                    <option value="Portfolio" <?= ($theme_data['home_page'] == 'Portfolio') ? 'selected' : '' ?>>Portfolio</option>
                    <option value="None" <?= ($theme_data['home_page'] == 'None') ? 'selected' : '' ?>>None</option>
                </select>
                <!-- Error -->
                <?php if($validation->getError('home_page')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('home_page'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide home_page
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="selected" class="form-label">Selected</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="selected" name="selected" value="1" <?= ($theme_data['selected'] == '1') ? 'checked' : '' ?>>
                    <label class="form-check-label small" for="selected">Toggle to set as selected</label>
                </div>
                <!-- Error -->
                <?php if($validation->getError('selected')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('selected'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide selected
                </div>
            </div>

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="theme_id" name="theme_id" value="<?= $theme_data['theme_id']; ?>" />
                <input type="hidden" class="form-control" id="deletable" name="deletable" value="<?= $theme_data['deletable']; ?>" />
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $theme_data['created_by']; ?>" />
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin/themes') ?>" class="btn btn-outline-danger">
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
