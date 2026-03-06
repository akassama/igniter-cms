<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Edit Page<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.cms'), 'url' => '/account/cms'),
    array('title' => 'Pages', 'url' => '/account/cms/pages'),
    array('title' => 'Edit Page')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit Page</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/pages/edit-page'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label"><?= lang('App.title') ?></label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $page_data['title'] ?>" required
                       hx-post="<?=base_url()?>/htmx/set-meta-title"
                       hx-trigger="keyup, changed delay:250ms"
                       hx-target="#meta-title-div"
                       hx-swap="innerHTML">
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

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="slug" class="form-label"><?= lang('App.slug') ?></label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= base_url('/'); ?></span>
                    <input type="text" class="form-control" id="slug" name="slug" value="<?= $page_data['slug'] ?>" required>
                    <div class="invalid-feedback">
                        <?= lang('App.input_required') ?>
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
                <label for="content" class="form-label"><?= lang('App.content') ?></label>
                <textarea rows="1" class="form-control content-editor" id="content" name="content" required><?= $page_data['content'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('content')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('content'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="group" class="form-label">
                    <?= lang('App.group') ?>
                    <small class="text-muted">(<?= lang('App.group_filter_hint') ?>)</small>
                </label>
                <select class="form-select" aria-label="group" id="group" name="group">
                    <option value="">Select group</option>
                    <?=getDataGroupOptions($page_data['group'], "Page")?>
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
                <label for="status" class="form-label"><?= lang('App.status') ?></label>
                <select class="form-select" id="status" name="status" required>
                    <option value=""><?= lang('App.select_status') ?></option>
                    <option value="0" <?= ($page_data['status'] == '0') ? 'selected' : '' ?>><?= lang('App.unpublished') ?></option>
                    <option value="1" <?= ($page_data['status'] == '1') ? 'selected' : '' ?>><?= lang('App.published') ?></option>
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

            <div class="col-12 mb-3">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <?= lang('App.seo_data') ?>
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="meta_title" class="form-label"><?= lang('App.meta_title') ?></label>
                                        <div id="meta-title-div">
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $page_data['meta_title'] ?>">
                                        </div>
                                        <!-- Error -->
                                        <?php if($validation->getError('meta_title')) {?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('meta_title'); ?>
                                            </div>
                                        <?php }?>
                                        <div class="invalid-feedback">
                                            <?= lang('App.input_required') ?>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="meta_description" class="form-label"><?= lang('App.meta_description') ?></label>
                                        <div id="meta-description-div">
                                            <textarea type="text" class="form-control" id="meta_description" name="meta_description"><?= $page_data['meta_description'] ?></textarea>
                                        </div>
                                        <!-- Error -->
                                        <?php if($validation->getError('meta_description')) {?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('meta_description'); ?>
                                            </div>
                                        <?php }?>
                                        <div class="invalid-feedback">
                                            <?= lang('App.input_required') ?>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="meta_keywords" class="form-label"><?= lang('App.meta_keywords') ?></label>
                                        <div id="meta-keywords-div">
                                            <input type="text" class="form-control tags-input" id="meta_keywords" name="meta_keywords" value="<?= $page_data['meta_keywords'] ?>">
                                        </div>
                                        <!-- Error -->
                                        <?php if($validation->getError('meta_keywords')) {?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('meta_keywords'); ?>
                                            </div>
                                        <?php }?>
                                        <div class="invalid-feedback">
                                            <?= lang('App.input_required') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="page_id" name="page_id" value="<?= $page_data['page_id']; ?>" />
            </div>

            <div class="mb-3">
                <a href="<?= base_url('/account/cms/pages') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    <?= lang('App.back') ?>
                </a>
                <?= $this->include('back-end/_shared/_edit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/_files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>