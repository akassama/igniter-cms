<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Themes', 'url' => '/account/admin/themes'),
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
        <?php echo form_open(base_url('account/admin/themes/edit-theme-home-page'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row"> 
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="home_page" class="form-label">Home Page</label>
                <!-- <textarea rows="2" class="form-control html-editor" id="home_page" name="home_page" required><?= htmlspecialchars($theme_data['home_page']) ?></textarea> -->
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

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="theme_id" name="theme_id" value="<?= $theme_data['theme_id']; ?>" />
                <input type="hidden" class="form-control" id="name" name="name" value="<?= $theme_data['name']; ?>" />
                <input type="hidden" class="form-control" id="path" name="path" value="<?= $theme_data['path']; ?>" />
                <input type="hidden" class="form-control" id="primary_color" name="primary_color" value="<?= $theme_data['primary_color']; ?>" />
                <input type="hidden" class="form-control" id="secondary_color" name="secondary_color" value="<?= $theme_data['secondary_color']; ?>" />
                <input type="hidden" class="form-control" id="other_color" name="other_color" value="<?= $theme_data['other_color']; ?>" />
                <input type="hidden" class="form-control" id="image" name="image" value="<?= $theme_data['image']; ?>" />
                <input type="hidden" class="form-control" id="theme_url" name="theme_url" value="<?= $theme_data['theme_url']; ?>" />
                <textarea style="display:none;" class="form-control" id="footer_copyright" name="footer_copyright"><?= $theme_data['footer_copyright']; ?></textarea>
                <input type="hidden" class="form-control" id="selected" name="selected" value="<?= $theme_data['selected']; ?>" />
                <input type="hidden" class="form-control" id="home_page" name="home_page" value="<?= $theme_data['home_page']; ?>" />
                <input type="hidden" class="form-control" id="deletable" name="deletable" value="<?= $theme_data['deletable']; ?>" />
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $theme_data['created_by']; ?>" />
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin') ?>" class="btn btn-outline-danger">
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
