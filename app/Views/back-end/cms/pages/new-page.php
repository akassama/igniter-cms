<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Page<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Pages', 'url' => '/account/cms/pages'),
    array('title' => 'New Page')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Page</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/pages/new-page'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= set_value('title') ?>" required
                    hx-post="<?=base_url()?>/htmx/get-page-title-slug"
                    hx-trigger="keyup, changed delay:250ms"
                    hx-target="#slug-div"
                    hx-swap="innerHTML">
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
                <label for="slug" class="form-label">Slug</label>
                <div class="input-group mb-3" id="slug-div">
                    <span class="input-group-text"><?= base_url('/'); ?></span>
                    <input type="text" class="form-control" id="slug" name="slug" value="<?= set_value('slug') ?>" required>
                    <div class="invalid-feedback">
                        Please provide slug
                    </div>
                </div>
                <!-- Error -->
                <?php if($validation->getError('slug')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('slug'); ?>
                    </div>
                <?php }?>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea rows="1" class="form-control content-editor" id="content" name="content" required><?= set_value('content') ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('content')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('content'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide content
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="group" class="form-label">
                    Group
                    <small class="text-muted">(Optional - use this if you want to filter data by group)</small>
                </label>
                <select class="form-select" aria-label="group" id="group" name="group">
                    <option value="">Select group</option>
                    <?=getDataGroupOptions(null, "Page")?>
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

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="">Select status</option>
                    <option value="0">Unpublished</option>
                    <option value="1">Published</option>
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

            <div class="col-12 mb-3">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            SEO Data
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="meta_title" class="form-label">Meta Title</label>
                                            <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn" data-target="meta_title"
                                            hx-post="<?=base_url()?>/htmx/set-meta-title-via-ai"
                                            hx-trigger="click delay:250ms"
                                            hx-target="#meta-title-div"
                                            hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                                        </div>
                                        <div id="meta-title-div">
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= set_value('meta_title') ?>">
                                        </div>
                                        <!-- Error -->
                                        <?php if($validation->getError('meta_title')) {?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('meta_title'); ?>
                                            </div>
                                        <?php }?>
                                        <div class="invalid-feedback">
                                            Please provide meta_title
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="meta_description" class="form-label">Meta Description</label>
                                            <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn" data-target="meta_description"
                                            hx-post="<?=base_url()?>/htmx/set-meta-description-via-ai"
                                            hx-trigger="click delay:250ms"
                                            hx-target="#meta-description-div"
                                            hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                                        </div>
                                        <div id="meta-description-div">
                                            <textarea class="form-control" id="meta_description" name="meta_description" ><?= set_value('meta_description') ?></textarea>
                                        </div>
                                        <!-- Error -->
                                        <?php if($validation->getError('meta_description')) {?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('meta_description'); ?>
                                            </div>
                                        <?php }?>
                                        <div class="invalid-feedback">
                                            Please provide meta_description
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                            <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn" data-target="meta_keywords"
                                            hx-post="<?=base_url()?>/htmx/set-meta-keywords-via-ai"
                                            hx-trigger="click delay:250ms"
                                            hx-target="#meta-keywords-div"
                                            hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                                        </div>
                                        <div id="meta-keywords-div" hx-on:htmx:after-settle="setTagsInput('meta_keywords')">
                                            <textarea rows="1" class="form-control tags-input" id="meta_keywords" name="meta_keywords"><?= set_value('meta_keywords') ?></textarea>
                                        </div>
                                        <!-- Error -->
                                        <?php if($validation->getError('meta_keywords')) {?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('meta_keywords'); ?>
                                            </div>
                                        <?php }?>
                                        <div class="invalid-feedback">
                                            Please provide meta_keywords
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/pages') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <?= $this->include('back-end/_shared/_submit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
