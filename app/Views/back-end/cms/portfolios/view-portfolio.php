<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Portfolios', 'url' => '/account/cms/portfolios'),
    array('title' => 'View Portfolio')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Portfolio</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
     <div class="row">
        <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $portfolio_data['title'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="1" class="form-control" id="description" name="description"><?= $portfolio_data['description'] ?></textarea>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="slug" class="form-label">Slug</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= base_url('/portfolio/'); ?></span>
                    <input type="text" class="form-control" id="slug" name="slug" value="<?= $portfolio_data['slug'] ?>" readonly>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" name="category" value="<?= $portfolio_data['category'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="client" class="form-label">Client</label>
                <input type="text" class="form-control" id="client" name="client" value="<?= $portfolio_data['client'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="project_date" class="form-label">Portfolio Date</label>
                <input type="text" class="form-control future-datepicker" id="project_date" name="project_date" autocomplete="off" value="<?= $portfolio_data['project_date'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="project_url" class="form-label">Portfolio URL</label>
                <input type="text" class="form-control" id="project_url" name="project_url" value="<?= $portfolio_data['project_url'] ?>" readonly>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                            <img src="<?= getImageUrl(($portfolio_data['featured_image']) ?? getDefaultImagePath())?>" class="img-thumbnail" alt="Featured image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="featured_image" name="featured_image" placeholder="select featured image" value="<?= $portfolio_data['featured_image'] ?>" readonly>
                            <button class="btn btn-dark" type="button">
                                <i class="ri-image-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="details_image_1" class="form-label">Details Picture 1</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="details_image_1" name="details_image_1" placeholder="select picture" value="<?= $portfolio_data['details_image_1'] ?>" readonly>
                    <button class="btn btn-dark p-0" type="button">
                        <img src="<?= getImageUrl(($portfolio_data['details_image_1']) ?? getDefaultImagePath())?>" class="img-fluid" alt="image" width="50"> 
                    </button>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="details_image_2" class="form-label">Details Picture 2</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="details_image_2" name="details_image_2" placeholder="select picture" value="<?= $portfolio_data['details_image_2'] ?>" readonly>
                    <button class="btn btn-dark p-0" type="button">
                        <img src="<?= getImageUrl(($portfolio_data['details_image_2']) ?? getDefaultImagePath())?>" class="img-fluid" alt="image" width="50"> 
                    </button>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="details_image_3" class="form-label">Details Picture 3</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="details_image_3" name="details_image_3" placeholder="select picture" value="<?= $portfolio_data['details_image_3'] ?>" readonly>
                    <button class="btn btn-dark p-0" type="button">
                        <img src="<?= getImageUrl(($portfolio_data['details_image_3']) ?? getDefaultImagePath())?>" class="img-fluid" alt="image" width="50"> 
                    </button>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="details_image_4" class="form-label">Details Picture 4</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="details_image_4" name="details_image_4" placeholder="select picture" value="<?= $portfolio_data['details_image_4'] ?>" readonly>
                    <button class="btn btn-dark p-0" type="button">
                        <img src="<?= getImageUrl(($portfolio_data['details_image_4']) ?? getDefaultImagePath())?>" class="img-fluid" alt="image" width="50"> 
                    </button>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="content" class="form-label">Content</label>
                <div class="border border-dark rounded p-2" id="content" name="content"><?= $portfolio_data['content'] ?></div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= ($portfolio_data['status'] == '0') ? 'Unpublished' : 'Published'?>" readonly>
            </div>

            <div class="col-12 mb-3">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                            SEO Data
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $portfolio_data['meta_title'] ?>" readonly>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea type="text" class="form-control" id="meta_description" name="meta_description" readonly><?= $portfolio_data['meta_description'] ?></textarea>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control tags-input" id="meta_keywords" name="meta_keywords" value="<?= $portfolio_data['meta_keywords'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            
            <!-- entry data -->
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="created_by" class="form-label">Created BY</label>
                <input type="text" class="form-control" id="created_by" name="created_by" maxlength="250" value="<?= getActivityBy(esc($portfolio_data['created_by']) , ""); ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="updated_by" class="form-label">Updated BY</label>
                <input type="text" class="form-control" id="updated_by" name="updated_by" maxlength="250" value="<?= getActivityBy(esc($portfolio_data['updated_by']) , ""); ?>" readonly>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/portfolios') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
