<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Edit Theme Home Page<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Themes', 'url' => '/account/themes'),
    array('title' => 'Edit Theme Files')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit Theme Home Page</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/themes/edit-theme-home-page'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row"> 
            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="theme_id" name="theme_id" value="<?= $theme_data['theme_id']; ?>" />
                <input type="hidden" class="form-control" id="name" name="name" value="<?= $theme_data['name']; ?>" />
                <input type="hidden" class="form-control" id="path" name="path" value="<?= $theme_data['path']; ?>" />
                <input type="hidden" class="form-control" id="primary_color" name="primary_color" value="<?= $theme_data['primary_color']; ?>" />
                <input type="hidden" class="form-control" id="secondary_color" name="secondary_color" value="<?= $theme_data['secondary_color']; ?>" />
                <input type="hidden" class="form-control" id="background_color" name="background_color" value="<?= $theme_data['background_color']; ?>" />
                <input type="hidden" class="form-control" id="image" name="image" value="<?= $theme_data['image']; ?>" />
                <input type="hidden" class="form-control" id="theme_url" name="theme_url" value="<?= $theme_data['theme_url']; ?>" />
                <input type="hidden" class="form-control" id="theme_bg_image" name="theme_bg_image" value="<?= $theme_data['theme_bg_image']; ?>" />
                <input type="hidden" class="form-control" id="theme_bg_video" name="theme_bg_video" value="<?= $theme_data['theme_bg_video']; ?>" />
                <textarea style="display:none;" class="form-control" id="footer_copyright" name="footer_copyright"><?= $theme_data['footer_copyright']; ?></textarea>
                <input type="hidden" class="form-control" id="selected" name="selected" value="<?= $theme_data['selected']; ?>" />
                <input type="hidden" class="form-control" id="override_default_style" name="override_default_style" value="<?= $theme_data['override_default_style']; ?>" />
                <input type="hidden" class="form-control" id="deletable" name="deletable" value="<?= $theme_data['deletable']; ?>" />
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $theme_data['created_by']; ?>" />
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin') ?>" class="btn btn-outline-danger">
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
