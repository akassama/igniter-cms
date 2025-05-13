<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Portfolio<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Portfolios', 'url' => '/account/cms/portfolios'),
    array('title' => 'New Portfolio')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Portfolio</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/portfolios/new-portfolio'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= set_value('title') ?>" required>
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
                <div class="d-flex justify-content-between align-items-center">
                <label for="description" class="form-label">Description</label>
                    <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn"
                    hx-post="<?=base_url()?>/htmx/get-portfolio-description-via-ai"
                    hx-trigger="click delay:250ms"
                    hx-target="#description-div"
                    hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                </div>
                <div id="description-div">
                    <textarea rows="1" class="form-control" id="description" name="description" maxlength="500"><?= set_value('description') ?></textarea>
                </div>
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

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="slug" class="form-label">Slug</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= base_url('/portfolio/'); ?></span>
                    <input type="text" class="form-control" id="slug" name="slug" maxlength="250" value="<?= set_value('slug') ?>" required 
                        hx-post="<?=base_url()?>/htmx/get-project-title-slug"
                        hx-trigger="load delay:1s"
                        hx-swap="outerHTML">
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

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control letters-only-plus-space" id="category" name="category" maxlength="100" data-show-err="true" value="<?= set_value('category') ?>">
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
                <label for="category_filter" class="form-label">Category Filter</label>
                <input type="text" class="form-control letters-only" id="category_filter" name="category_filter" data-show-err="true" maxlength="100" value="<?= set_value('category_filter') ?>">
                <!-- Error -->
                <?php if($validation->getError('category_filter')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('category_filter'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide category_filter
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="client" class="form-label">Client</label>
                <input type="text" class="form-control" id="client" name="client" maxlength="250" value="<?= set_value('client') ?>">
                <!-- Error -->
                <?php if($validation->getError('client')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('client'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide client
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="project_date" class="form-label">Portfolio Date</label>
                <input type="text" class="form-control future-datepicker" id="project_date" name="project_date" maxlength="50" autocomplete="off" value="<?= set_value('project_date') ?>">
                <!-- Error -->
                <?php if($validation->getError('project_date')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('project_date'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide project date
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="project_url" class="form-label">Portfolio URL</label>
                <input type="text" class="form-control" id="project_url" name="project_url" maxlength="250" value="<?= set_value('project_url') ?>">
                <!-- Error -->
                <?php if($validation->getError('project_url')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('project_url'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide project_url
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                            <img loading="lazy" src="<?= base_url(getDefaultImagePath())?>" class="img-thumbnail" alt="Featured image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="featured_image" name="featured_image" maxlength="250" placeholder="select featured image" value="<?= set_value('featured_image') ?>"
                            hx-post="<?=base_url()?>/htmx/set-image-display"
                            hx-trigger="keyup, changed delay:250ms"
                            hx-target="#display-preview-image"
                            hx-swap="innerHTML" required>
                            <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                                <i class="ri-image-fill"></i>
                            </button>
                            <div class="invalid-feedback">
                                Please provide featured image
                            </div>
                        </div>
                        <!-- Error -->
                        <?php if($validation->getError('featured_image')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('featured_image'); ?>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="details_image_1" class="form-label">Details Picture 1</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="details_image_1" name="details_image_1" maxlength="250" placeholder="select picture" value="<?= set_value('details_image_1') ?>">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('details_image_1')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('details_image_1'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide details_image_1
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="details_image_2" class="form-label">Details Picture 2</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="details_image_2" name="details_image_2" maxlength="250" placeholder="select picture" value="<?= set_value('details_image_2') ?>">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('details_image_2')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('details_image_2'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide details_image_2
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="details_image_3" class="form-label">Details Picture 3</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="details_image_3" name="details_image_3" maxlength="250" placeholder="select picture" value="<?= set_value('details_image_3') ?>">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('details_image_3')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('details_image_3'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide details_image_3
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="details_image_4" class="form-label">Details Picture 4</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="details_image_4" name="details_image_4" maxlength="250" placeholder="select picture" value="<?= set_value('details_image_4') ?>">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('details_image_4')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('details_image_4'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide details_image_4
                </div>
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

            <div class="col-sm-12 col-md-12 mb-3">
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
                <a href="<?= base_url('/account/cms/portfolios') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <button type="submit" class="btn btn-outline-primary float-end" id="submit-btn">
                    <i class="ri-send-plane-fill"></i>
                    Submit
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    // Initialize tags input
    function setTagsInput(inputId){
        $('#'+inputId).tagsInput();
        $('#'+inputId).css('width', '100%');
    }
</script>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
