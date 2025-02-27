<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Donation Causes', 'url' => '/account/cms/donation-causes'),
    array('title' => 'View Donation Cause')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Donation Cause</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $donation_data['title'] ?>" readonly
                       hx-post="<?=base_url()?>/htmx/set-meta-title"
                       hx-trigger="keyup, changed delay:250ms"
                       hx-target="#meta-title-div"
                       hx-swap="innerHTML">
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="1" class="form-control" id="description" name="description" maxlength="500"
                    hx-post="<?=base_url()?>/htmx/set-meta-description"
                    hx-trigger="keyup, changed delay:250ms"
                    hx-target="#meta-description-div"
                    hx-swap="innerHTML" readonly><?= $donation_data['description'] ?></textarea>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="slug" class="form-label">Slug</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= base_url('/donate/'); ?></span>
                    <input type="text" class="form-control" id="slug" name="slug" maxlength="250" value="<?= $donation_data['slug'] ?>" readonly>
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                            <img loading="lazy" src="<?= base_url(getDefaultImagePath())?>" class="img-thumbnail" alt="Image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="image" name="image" maxlength="250" placeholder="select image" value="<?= $donation_data['image'] ?>"
                            hx-post="<?=base_url()?>/htmx/set-image-display"
                            hx-trigger="keyup, load, changed delay:250ms"
                            hx-target="#display-preview-image"
                            hx-swap="innerHTML" readonly>
                            <button class="btn btn-dark" type="button">
                                <i class="ri-image-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="link_title" class="form-label">
                            Link Title
                        </label>
                        <input type="text" class="form-control" id="link_title" name="link_title" value="<?= $donation_data['link_title'] ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <label for="link" class="form-label">
                            Link
                            <span class="small text-muted">(Use '/' for internal links)</span>
                        </label>
                        <input type="text" class="form-control" id="link" name="link" value="<?= $donation_data['link'] ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="new_tab" class="form-label">New Tab</label>
                        <input type="text" class="form-control" id="new_tab" name="new_tab" value="<?= ($donation_data['new_tab'] == '0') ? 'No' : 'Yes'?>" readonly>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea rows="1" class="form-control content-editor" id="content" name="content" readonly><?= $donation_data['content'] ?></textarea>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="embedded_page_title" class="form-label">Embedded Page Title</label>
                <input type="text" class="form-control" id="embedded_page_title" name="embedded_page_title" maxlength="250" value="<?= $donation_data['embedded_page_title'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="embedded_page" class="form-label">Embedded Page</label>
                <textarea rows="2" class="form-control js-editor" id="embedded_page" name="embedded_page" readonly><?= $donation_data['embedded_page'] ?></textarea>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= ($donation_data['status'] == '0') ? 'Unpublished' : 'Published'?>" readonly>
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
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" maxlength="250" value="<?= $donation_data['meta_title'] ?>" readonly>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea type="text" class="form-control" id="meta_description" name="meta_description" maxlength="500" readonly><?= $donation_data['meta_description'] ?></textarea>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control tags-input" id="meta_keywords" name="meta_keywords" maxlength="250" value="<?= $donation_data['meta_keywords'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/donation-causes') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
