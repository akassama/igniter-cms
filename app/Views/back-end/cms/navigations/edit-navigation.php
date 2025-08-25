<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Edit Navigation<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Navigations', 'url' => '/account/cms/navigations'),
    array('title' => 'Edit Navigation')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit Navigation</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/navigations/edit-navigation'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control alphanumeric-plus-space" id="title" name="title" data-show-err="true" maxlength="100" value="<?= $navigation_data['title'] ?>" maxlength="50" required>
                <!-- Error -->
                <?php if($validation->getError('title')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('title'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide a title
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required><?= $navigation_data['description'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('description')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('description'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide description
                </div>
            </div>
            
            <div class="col-sm-12 col-md-4 mb-3">
                <label for="icon" class="form-label">
                    Icon
                </label>
                <input type="text" class="form-control" id="icon" name="icon" maxlength="100" value="<?= htmlspecialchars($navigation_data['icon']); ?>" placeholder="E.g. ri-user-line">
                <!-- Error -->
                <?php if($validation->getError('icon')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('icon'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide icon
                </div>
            </div>

            <div class="col-sm-12 col-md-4 mb-3">
                <label for="group" class="form-label">
                    Group
                    <small class="text-muted">(Optional - use this if you want to filter data by group)</small>
                </label>
                <select class="form-select" aria-label="group" id="group" name="group">
                    <option value="">Select group</option>
                    <?=getDataGroupOptions($navigation_data['group'], "Navigation")?>
                </select>
                <!-- Error -->
                <?php if($validation->getError('group')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('group'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide a group
                </div>
            </div>

            <div class="col-sm-12 col-md-4 mb-3">
                <label for="order" class="form-label">
                    Order
                </label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="2" value="<?= $navigation_data['order'] ?>">
                <!-- Error -->
                <?php if($validation->getError('order')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('order'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide a order
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="parent" class="form-label">Parent</label>
                <select class="form-select" id="parent" name="parent">
                    <option value="">Select parent (optional)</option>
                    <?= getNavigationParentSelectOptions($navigation_data['parent']) ?>
                </select>
                <!-- Error -->
                <?php if($validation->getError('parent')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('parent'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide a parent
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="">Select status</option>
                    <option value="0" <?= ($navigation_data['status'] == '0') ? 'selected' : '' ?>>Unpublished</option>
                    <option value="1" <?= ($navigation_data['status'] == '1') ? 'selected' : '' ?>>Published</option>
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
                <label for="link" class="form-label">Link</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= base_url('/'); ?></span>
                    <input type="text" class="form-control" id="link" name="link" value="<?= $navigation_data['link'] ?>" required>
                </div>
                <!-- Error -->
                <?php if($validation->getError('link')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('link'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide a link
                </div>
            </div>

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="navigation_id" name="navigation_id" value="<?= $navigation_data['navigation_id']; ?>" />
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $navigation_data['created_by']; ?>" />
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/navigations') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <?= $this->include('back-end/_shared/_edit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
