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
                <label for="default_color" class="form-label">Default Color</label>
                <input type="color" class="form-control form-control-color" id="default_color" name="default_color" value="<?= $theme_data['default_color'];?>" required
                       hx-post="<?=base_url()?>/htmx/get-default-color-name"
                       hx-trigger="load, change delay:100ms"
                       hx-target="#set-default-color-name"
                       hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('default_color')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('default_color'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide default color
                </div>
                <div class="mt-2" id="set-default-color-name">
                </div>
            </div>

            <div class="col-sm-12 col-md-4 mb-4">
                <label for="heading_color" class="form-label">Heading Color</label>
                <input type="color" class="form-control form-control-color" id="heading_color" name="heading_color" value="<?= $theme_data['heading_color'];?>" required
                       hx-post="<?=base_url()?>/htmx/get-heading-color-name"
                       hx-trigger="load, change delay:200ms"
                       hx-target="#set-heading-color-name"
                       hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('heading_color')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('heading_color'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide heading color
                </div>
                <div class="mt-2" id="set-heading-color-name">
                </div>
            </div>

            <div class="col-sm-12 col-md-4 mb-4">
                <label for="accent_color" class="form-label">Accent Color</label>
                <input type="color" class="form-control form-control-color" id="accent_color" name="accent_color" value="<?= $theme_data['accent_color'];?>" required
                       hx-post="<?=base_url()?>/htmx/get-accent-color-name"
                       hx-trigger="load, change delay:300ms"
                       hx-target="#set-accent-color-name"
                       hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('accent_color')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('accent_color'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide accent color
                </div>
                <div class="mt-2" id="set-accent-color-name">
                </div>
            </div>

            <div class="col-sm-12 col-md-4 mb-4">
                <label for="surface_color" class="form-label">Surface Color</label>
                <input type="color" class="form-control form-control-color" id="surface_color" name="surface_color" value="<?= $theme_data['surface_color'];?>"
                    hx-post="<?=base_url()?>/htmx/get-surface-color-name"
                    hx-trigger="load, change delay:400ms"
                    hx-target="#set-surface-color-name"
                    hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('surface_color')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('surface_color'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide surface color
                </div>
                <div class="mt-2" id="set-surface-color-name">
                </div>
            </div>

            <div class="col-sm-12 col-md-4 mb-4">
                <label for="contrast_color" class="form-label">Contrast Color</label>
                <input type="color" class="form-control form-control-color" id="contrast_color" name="contrast_color" value="<?= $theme_data['contrast_color'];?>"
                    hx-post="<?=base_url()?>/htmx/get-contrast-color-name"
                    hx-trigger="load, change delay:500ms"
                    hx-target="#set-contrast-color-name"
                    hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('contrast_color')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('contrast_color'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide contrast color
                </div>
                <div class="mt-2" id="set-contrast-color-name">
                </div>
            </div>

            <div class="col-sm-12 col-md-4 mb-4">
                <label for="background_color" class="form-label">Background Color</label>
                <input type="color" class="form-control form-control-color" id="background_color" name="background_color" value="<?= $theme_data['background_color'];?>"
                       hx-post="<?=base_url()?>/htmx/get-background-color-name"
                       hx-trigger="load, change delay:600ms"
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

            <div class="col-sm-12 col-md-6 mb-3">
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
                <label for="use_static_theme_nav" class="form-label">Use static theme navigation</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="use_static_theme_nav" name="use_static_theme_nav" value="1" <?= ($theme_data['use_static_theme_nav'] == '1') ? 'checked' : '' ?>>
                    <label class="form-check-label small" for="use_static_theme_nav">Toggle to use static theme navigation</label>
                </div>
                <!-- Error -->
                <?php if($validation->getError('use_static_theme_nav')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('use_static_theme_nav'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide use_static_theme_nav
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
                <input type="hidden" class="form-control" id="plugins_required" name="plugins_required" value="<?= $theme_data['plugins_required']; ?>" />
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
<?=  $this->include('back-end/layout/modals/_files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>