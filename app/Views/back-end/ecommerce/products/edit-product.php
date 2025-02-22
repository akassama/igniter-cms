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
    array('title' => 'Edit Product')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit Product</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/ecommerce/products/edit-product'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $product_data['title']; ?>" required
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
                    Please provide title
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="1" class="form-control content-editor" id="description" name="description" required><?= $product_data['description']; ?></textarea>
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
                <label for="short_description" class="form-label">Short Description</label>
                <textarea rows="1" class="form-control" id="short_description" name="short_description" maxlength="500"
                    hx-post="<?=base_url()?>/htmx/set-meta-description"
                    hx-trigger="keyup, changed delay:250ms"
                    hx-target="#meta-description-div"
                    hx-swap="innerHTML"><?= $product_data['short_description']; ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('short_description')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('short_description'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide short_description
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="slug" class="form-label">Slug</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= base_url('/shop/'); ?></span>
                    <input type="text" class="form-control" id="slug" name="slug" maxlength="250" value="<?= $product_data['slug']; ?>" required>
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
                <select class="form-select" id="category" name="category" required>
                    <option value="">Select category</option>
                    <?= getProductCategories($product_data['category']) ?>
                </select>
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
                <label for="sub_category" class="form-label">Sub Category</label>
                <select class="form-select" id="sub_category" name="sub_category">
                    <option value="">Select sub-category</option>
                    <?= getProductCategories($product_data['sub_category']) ?>
                </select>
                <!-- Error -->
                <?php if($validation->getError('sub_category')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('sub_category'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide sub_category
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" maxlength="250" value="<?= $product_data['brand']; ?>">
                <!-- Error -->
                <?php if($validation->getError('brand')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('brand'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide brand
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" id="model" name="model" maxlength="250" value="<?= $product_data['model']; ?>">
                <!-- Error -->
                <?php if($validation->getError('model')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('model'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide model
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control float-number" id="price" name="price" maxlength="50" data-show-err="true" autocomplete="off" value="<?= $product_data['price']; ?>">
                <!-- Error -->
                <?php if($validation->getError('price')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('price'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide price
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="sale_price" class="form-label">Sale Price</label>
                <input type="text" class="form-control" id="sale_price" name="sale_price" maxlength="50" value="<?= $product_data['sale_price']; ?>">
                <!-- Error -->
                <?php if($validation->getError('sale_price')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('sale_price'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide sale_price
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="currency" class="form-label">Currency</label>
                <input type="text" class="form-control" id="currency" name="currency" maxlength="250" value="<?= $product_data['currency']; ?>">
                <!-- Error -->
                <?php if($validation->getError('currency')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('currency'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide currency
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                            <img src="<?= base_url(getDefaultImagePath())?>" class="img-thumbnail" alt="Featured image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="featured_image" name="featured_image" maxlength="250" value="<?= $product_data['featured_image'] ?>" placeholder="select featured image" value="<?= $product_data['featured_image']; ?>"
                            hx-post="<?=base_url()?>/htmx/set-image-display"
                            hx-trigger="keyup, load, changed delay:250ms"
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
                <label for="product_image_1" class="form-label">Product Picture 1</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="product_image_1" name="product_image_1" maxlength="250" placeholder="select picture" value="<?= $product_data['product_image_1']; ?>">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('product_image_1')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('product_image_1'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide product_image_1
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="product_image_2" class="form-label">Product Picture 2</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="product_image_2" name="product_image_2" maxlength="250" placeholder="select picture" value="<?= $product_data['product_image_2']; ?>">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('product_image_2')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('product_image_2'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide product_image_2
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="product_image_3" class="form-label">Product Picture 3</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="product_image_3" name="product_image_3" maxlength="250" placeholder="select picture" value="<?= $product_data['product_image_3']; ?>">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('product_image_3')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('product_image_3'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide product_image_3
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="product_image_4" class="form-label">Product Picture 4</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="product_image_4" name="product_image_4" maxlength="250" placeholder="select picture" value="<?= $product_data['product_image_4']; ?>">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('product_image_4')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('product_image_4'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide product_image_4
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="product_video" class="form-label">Product Video</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="product_video" name="product_video" placeholder="select file" value="<?= $product_data['product_video']; ?>">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#videoFilesModal">
                        <i class="ri-youtube-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('product_video')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('product_video'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide product_video
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="is_featured" class="form-label">Featured</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" <?= ($product_data['is_featured'] == '1') ? 'checked' : '' ?>>
                    <label class="form-check-label small" for="is_featured">Toggle to set as featured</label>
                </div>
                <!-- Error -->
                <?php if($validation->getError('is_featured')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('is_featured'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide is_featured
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="specifications" class="form-label">Specifications</label>
                <small class="float-end">
                    <a href="#!" data-bs-toggle="modal" data-bs-target="#productJsonDataModal">View Sample</a>
                </small>
                <textarea rows="1" class="form-control js-editor" id="specifications" name="specifications"><?= $product_data['specifications']; ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('specifications')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('specifications'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide specifications
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="attributes" class="form-label">Attributes</label>
                <small class="float-end">
                    <a href="#!" data-bs-toggle="modal" data-bs-target="#productJsonDataModal">View Sample</a>
                </small>
                <textarea rows="1" class="form-control js-editor" id="attributes" name="attributes"><?= $product_data['attributes']; ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('attributes')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('attributes'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide attributes
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="seller_info" class="form-label">Seller Info</label>
                <small class="float-end">
                    <a href="#!" data-bs-toggle="modal" data-bs-target="#productJsonDataModal">View Sample</a>
                </small>
                <textarea rows="1" class="form-control js-editor" id="seller_info" name="seller_info"><?= $product_data['seller_info']; ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('seller_info')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('seller_info'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide seller_info
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="purchase_options" class="form-label">Purchase Options</label>
                <small class="float-end">
                    <a href="#!" data-bs-toggle="modal" data-bs-target="#productJsonDataModal">View Sample</a>
                </small>
                <textarea rows="1" class="form-control js-editor" id="purchase_options" name="purchase_options"><?= $product_data['purchase_options']; ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('purchase_options')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('purchase_options'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide purchase_options
                </div>
            </div>

        <div class="col-sm-12 col-md-6 mb-3">
            <label for="tags" class="form-label">Tags</label>
            <textarea rows="1" class="form-control tags-input" id="tags" name="tags" required><?= $product_data['tags'] ?></textarea>
            <!-- Error -->
            <?php if($validation->getError('tags')) {?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('tags'); ?>
                </div>
            <?php }?>
            <div class="invalid-feedback">
                Please provide tags
            </div>
        </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="">Select status</option>
                    <option value="0" <?= ($product_data['status'] == '0') ? 'selected' : '' ?>>Unpublished</option>
                    <option value="1" <?= ($product_data['status'] == '1') ? 'selected' : '' ?>>Published</option>
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

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="order" class="form-label">
                    Order
                </label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="2" maxlength="2" value="<?= $product_data['order']; ?>">
                <!-- Error -->
                <?php if($validation->getError('order')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('order'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide order
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
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <div id="meta-title-div">
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" maxlength="250" value="<?= $product_data['meta_title']; ?>">
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
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <div id="meta-description-div">
                                            <textarea type="text" class="form-control" id="meta_description" name="meta_description" maxlength="500" ><?= $product_data['meta_description']; ?></textarea>
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
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <div id="meta-keywords-div">
                                            <input type="text" class="form-control tags-input" id="meta_keywords" name="meta_keywords" maxlength="250" value="<?= $product_data['meta_keywords']; ?>" >
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

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="product_id" name="product_id" value="<?= $product_data['product_id']; ?>" />
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $product_data['created_by']; ?>" />
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/ecommerce/products') ?>" class="btn btn-outline-danger">
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

<!-- Include the json samples modal -->
<?=  $this->include('back-end/layout/modals/product_data_json_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
