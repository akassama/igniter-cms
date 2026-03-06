<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Category<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.cms'), 'url' => '/account/cms'),
    array('title' => lang('App.categories'), 'url' => '/account/cms/categories'),
    array('title' => 'New Category')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Category</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/categories/new-category'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="title" class="form-label"><?= lang('App.title') ?></label>
                <input type="text" class="form-control alphanumeric-plus-space" id="title" name="title" data-show-err="true" maxlength="100" value="<?= set_value('title') ?>" maxlength="50" required>
                <!-- Error -->
                <?php if($validation->getError('title')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('title'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="description" class="form-label"><?= lang('App.description') ?></label>
                        <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn"
                        hx-post="<?=base_url()?>/htmx/get-blog-category-description-via-ai"
                        hx-trigger="click delay:250ms"
                        hx-target="#description-div"
                        hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> <?= lang('App.use_ai') ?></button>
                </div>
                <div id="description-div">
                    <textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required><?= set_value('description') ?></textarea>
                </div>
                <!-- Error -->
                <?php if($validation->getError('description')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('description'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="group" class="form-label">
                    Group
                    <small class="text-muted">(<?= lang('App.group_filter_hint') ?>)</small>
                </label>
                <select class="form-select" aria-label="group" id="group" name="group">
                    <option value="">Select group</option>
                    <?=getDataGroupOptions(null, "Category")?>
                </select>
                <!-- Error -->
                <?php if($validation->getError('group')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('group'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="parent" class="form-label"><?= lang('App.parent') ?></label>
                <select class="form-select" id="parent" name="parent">
                    <option value="">Select parent</option>
                    <?= getBlogCategorySelectOptions() ?>
                </select>
                <!-- Error -->
                <?php if($validation->getError('parent')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('parent'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-12 mb-3">
                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <label for="link" class="form-label">
                            Link
                            <span class="small text-muted">(<?= lang('App.internal_link_hint') ?>)</span>
                        </label>
                        <input type="text" class="form-control" id="link" name="link" value="<?= set_value('link') ?>">
                        <!-- Error -->
                        <?php if($validation->getError('link')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('link'); ?>
                            </div>
                        <?php }?>
                        <div class="invalid-feedback">
                           <?= lang('App.input_required') ?>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="new_tab" class="form-label"><?= lang('App.new_tab') ?></label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="new_tab" name="new_tab" value="1">
                            <label class="form-check-label small" for="new_tab">Toggle to open as new tab</label>
                        </div>
                        <!-- Error -->
                        <?php if($validation->getError('new_tab')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('new_tab'); ?>
                            </div>
                        <?php }?>
                        <div class="invalid-feedback">
                            <?= lang('App.input_required') ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="order" class="form-label">
                    Order
                </label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="2" maxlength="2" value="<?= set_value('order') ?>">
                <!-- Error -->
                <?php if($validation->getError('order')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('order'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label"><?= lang('App.status') ?></label>
                <select class="form-select" id="status" name="status" required>
                    <option value=""><?= lang('App.select_status') ?></option>
                    <option value="0"><?= lang('App.unpublished') ?></option>
                    <option value="1"><?= lang('App.published') ?></option>
                </select>
                <!-- Error -->
                <?php if($validation->getError('status')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('status'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/categories') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    <?= lang('App.back') ?>
                </a>
                <?= $this->include('back-end/_shared/_submit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
