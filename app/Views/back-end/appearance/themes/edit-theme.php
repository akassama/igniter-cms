<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Edit Theme<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Appearance', 'url' => '/account/appearance'),
    array('title' => 'Themes', 'url' => '/account/appearance/themes'),
    array('title' => 'Edit Theme')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit Theme</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/appearance/themes/edit-theme'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="name" class="form-label">Theme Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $theme_data['name'] ?>" readonly>
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
                    <input type="text" class="form-control" id="path" name="path" value="<?= $theme_data['path'] ?>" readonly>
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
                <label for="background_color" class="form-label">Background Color</label>
                <input type="color" class="form-control form-control-color" id="background_color" name="background_color" value="<?= $theme_data['background_color'];?>"
                       hx-post="<?=base_url()?>/htmx/get-background-color-name"
                       hx-trigger="load, change delay:100ms"
                       hx-target="#set-background-color-name"
                       hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('background_color')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('background_color'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide background color
                </div>
                <div class="mt-2" id="set-background-color-name">
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="override_default_style" class="form-label">Override Default Style</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="override_default_style" name="override_default_style" value="1" <?= ($theme_data['override_default_style'] == '1') ? 'checked' : '' ?>>
                    <label class="form-check-label small" for="override_default_style">Toggle to override default style</label>
                </div>
                <!-- Error -->
                <?php if($validation->getError('override_default_style')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('override_default_style'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide override_default_style
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" name="category" value="<?= $theme_data['category'] ?>" readonly>
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
                <input type="text" class="form-control" id="sub_category" name="sub_category" value="<?= $theme_data['sub_category'] ?>" readonly>
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
                <input type="hidden" class="form-control" id="name" name="name" value="<?= $theme_data['name']; ?>" />
                <input type="hidden" class="form-control" id="path" name="path" value="<?= $theme_data['path']; ?>" />
                <input type="hidden" class="form-control" id="image" name="image" value="<?= $theme_data['image']; ?>" />
                <input type="hidden" class="form-control" id="theme_url" name="theme_url" value="<?= $theme_data['theme_url']; ?>" />
                <input type="hidden" class="form-control" id="deletable" name="deletable" value="<?= $theme_data['deletable']; ?>" />
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $theme_data['created_by']; ?>" />
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/appearance/themes') ?>" class="btn btn-outline-danger">
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