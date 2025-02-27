<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'E-Commerce', 'url' => '/account/ecommerce'),
    array('title' => 'Products', 'url' => '/account/ecommerce/products'),
    array('title' => 'View Product')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Product</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $product_data['title']; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <div class="border border-dark rounded p-2" id="description" name="description"><?= $product_data['description'] ?></div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="short_description" class="form-label">Short Description</label>
                <textarea rows="1" class="form-control" id="short_description" name="short_description" maxlength="500" readonly><?= $product_data['short_description']; ?></textarea>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="slug" class="form-label">Slug</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= base_url('/shop/'); ?></span>
                    <input type="text" class="form-control" id="slug" name="slug" maxlength="250" value="<?= $product_data['slug']; ?>" readonly>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="slug" name="slug" maxlength="250" value="<?= !empty($product_data['category']) ? getProductCategoryName($product_data['category']) : ""; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="sub_category" class="form-label">Sub Category</label>
                <input type="text" class="form-control" id="slug" name="slug" maxlength="250" value="<?= !empty($product_data['sub_category']) ? getProductCategoryName($product_data['sub_category']) : ""; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" maxlength="250" value="<?= $product_data['brand']; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" id="model" name="model" maxlength="250" value="<?= $product_data['model']; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control float-number" id="price" name="price" maxlength="50" data-show-err="true" autocomplete="off" value="<?= $product_data['price']; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="sale_price" class="form-label">Sale Price</label>
                <input type="text" class="form-control" id="sale_price" name="sale_price" maxlength="50" value="<?= $product_data['sale_price']; ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="currency" class="form-label">Currency</label>
                <input type="text" class="form-control" id="currency" name="currency" maxlength="250" value="<?= $product_data['currency']; ?>" readonly>
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
                            <input type="text" class="form-control" id="featured_image" name="featured_image" maxlength="250" value="<?= $product_data['featured_image'] ?>" placeholder="select featured image" value="<?= $product_data['featured_image']; ?>"
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

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="product_image_1" class="form-label">Product Picture 1</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="product_image_1" name="product_image_1" maxlength="250" placeholder="select picture" value="<?= $product_data['product_image_1']; ?>" readonly>
                    <button class="btn btn-dark" type="button">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="product_image_2" class="form-label">Product Picture 2</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="product_image_2" name="product_image_2" maxlength="250" placeholder="select picture" value="<?= $product_data['product_image_2']; ?>" readonly>
                    <button class="btn btn-dark" type="button">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="product_image_3" class="form-label">Product Picture 3</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="product_image_3" name="product_image_3" maxlength="250" placeholder="select picture" value="<?= $product_data['product_image_3']; ?>" readonly>
                    <button class="btn btn-dark" type="button">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="product_image_4" class="form-label">Product Picture 4</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="product_image_4" name="product_image_4" maxlength="250" placeholder="select picture" value="<?= $product_data['product_image_4']; ?>" readonly>
                    <button class="btn btn-dark" type="button">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="product_video" class="form-label">Product Video</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="product_video" name="product_video" placeholder="select file" value="<?= $product_data['product_video']; ?>" readonly>
                    <button class="btn btn-dark" type="button">
                        <i class="ri-youtube-fill"></i>
                    </button>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="is_featured" class="form-label">Featured</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" <?= ($product_data['is_featured'] == '1') ? 'checked' : '' ?> readonly>
                    <label class="form-check-label small" for="is_featured">Toggle to set as featured</label>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="specifications" class="form-label">Specifications</label>
                <textarea rows="1" class="form-control js-editor" id="specifications" name="specifications" readonly><?= $product_data['specifications']; ?></textarea>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="attributes" class="form-label">Attributes</label>
                <textarea rows="1" class="form-control js-editor" id="attributes" name="attributes" readonly><?= $product_data['attributes']; ?></textarea>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="seller_info" class="form-label">Seller Info</label>
                <textarea rows="1" class="form-control js-editor" id="seller_info" name="seller_info" readonly><?= $product_data['seller_info']; ?></textarea>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="purchase_options" class="form-label">Purchase Options</label>
                <textarea rows="1" class="form-control js-editor" id="purchase_options" name="purchase_options" readonly><?= $product_data['purchase_options']; ?></textarea>
            </div>

        <div class="col-sm-12 col-md-6 mb-3">
            <label for="tags" class="form-label">Tags</label>
            <textarea rows="1" class="form-control tags-input" id="tags" name="tags" readonly><?= $product_data['tags'] ?></textarea>
        </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= ($product_data['status'] == '0') ? 'Unpublished' : 'Published'?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="order" class="form-label">
                    Order
                </label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="2" maxlength="2" value="<?= $product_data['order']; ?>" readonly>
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
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $product_data['meta_title'] ?>" readonly>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea type="text" class="form-control" id="meta_description" name="meta_description" readonly><?= $product_data['meta_description'] ?></textarea>
                                    </div>
                                    <div class="col-12 mb-3 mt-3">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control tags-input" id="meta_keywords" name="meta_keywords" value="<?= $product_data['meta_keywords'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/ecommerce/products') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>
<?=  $this->include('back-end/layout/modals/product_data_json_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
