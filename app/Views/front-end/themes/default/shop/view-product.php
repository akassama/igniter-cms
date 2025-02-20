<?php
// Get current theme impact
$theme = getCurrentTheme();

//update view count
updateTotalViewCount("products", "product_id", $product_data['product_id']);
?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<style>
    .product-image {
            max-height: 400px;
            object-fit: cover;
        }
        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s ease;
        }
        .thumbnail:hover, .thumbnail.active {
            opacity: 1;
        }
</style>

<!-- TODO: Page Content-->
<section class="py-5">
    <div class="container px-5 my-2">
        <div class="row gx-5">
            <div class="col-12">
                <div class="row">
                    <!-- Product Images -->
                    <div class="col-md-6 mb-4">
                        <img src="<?=getImageUrl(($product_data['featured_image']) ?? getDefaultImagePath())?>?>" alt="Product" class="img-fluid rounded mb-3 product-image" id="mainImage">
                        <div class="d-flex justify-content-between">
                            <?php if(!empty($product_data['featured_image'])): ?>
                                <img src="<?=getImageUrl(($product_data['featured_image']) ?? getDefaultImagePath())?>" alt="" class="thumbnail rounded active" onclick="changeImage(event, this.src)">
                            <?php endif; ?>
                            <?php if(!empty($product_data['product_image_1'])): ?>
                                <img src="<?=getImageUrl(($product_data['product_image_1']) ?? getDefaultImagePath())?>" alt="" class="thumbnail rounded" onclick="changeImage(event, this.src)">
                            <?php endif; ?>
                            <?php if(!empty($product_data['product_image_2'])): ?>
                                <img src="<?=getImageUrl(($product_data['product_image_2']) ?? getDefaultImagePath())?>" alt="" class="thumbnail rounded" onclick="changeImage(event, this.src)">
                            <?php endif; ?>
                            <?php if(!empty($product_data['product_image_3'])): ?>
                                <img src="<?=getImageUrl(($product_data['product_image_3']) ?? getDefaultImagePath())?>" alt="" class="thumbnail rounded" onclick="changeImage(event, this.src)">
                            <?php endif; ?>
                            <?php if(!empty($product_data['product_image_4'])): ?>
                                <img src="<?=getImageUrl(($product_data['product_image_4']) ?? getDefaultImagePath())?>" alt="" class="thumbnail rounded" onclick="changeImage(event, this.src)">
                            <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <?php if(!empty($product_data['product_video'])): ?>
                                <div><?=getVideoPreviewFromUrl($product_data['product_video'], 500)?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="col-md-6">
                        <h2 class="mb-3"><?= $product_data['title'] ?></h2>
                        <p class="text-muted mb-4">Category: <?= !empty($product_data['category']) ? getProductCategoryName($product_data['category']) : ""; ?></p>
                        <div class="mb-3">
                            <span class="h4 me-2"><?= $product_data['currency'] ?><?= $product_data['sale_price'] ?? $product_data['price'] ?></span>
                            <?php if(!empty($product_data['sale_price'])): ?>
                                <span class="text-muted"><s><?= $product_data['currency'] ?><?= $product_data['price'] ?></s></span>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-half text-warning"></i>
                            <span class="ms-2">4.5 (120 reviews)</span>
                        </div>
                        <p class="mb-4">
                            <?= $product_data['description'] ?>
                        </p>
                        <div class="mb-4">
                            <h5>Color:</h5>
                            <div class="btn-group" role="group" aria-label="Color selection">
                                <input type="radio" class="btn-check" name="color" id="black" autocomplete="off" checked>
                                <label class="btn btn-outline-dark" for="black">Black</label>
                                <input type="radio" class="btn-check" name="color" id="silver" autocomplete="off">
                                <label class="btn btn-outline-secondary" for="silver">Silver</label>
                                <input type="radio" class="btn-check" name="color" id="blue" autocomplete="off">
                                <label class="btn btn-outline-primary" for="blue">Blue</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" class="form-control" id="quantity" value="1" min="1" style="width: 80px;">
                        </div>
                        <button class="btn btn-primary btn-lg mb-3 me-2">
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </button>
                        <button class="btn btn-outline-secondary btn-lg mb-3">
                            <i class="bi bi-heart"></i> Add to Wishlist
                        </button>
                        <div class="mt-4">
                            <h5>Key Features:</h5>
                            <ul>
                                <li>Industry-leading noise cancellation</li>
                                <li>30-hour battery life</li>
                                <li>Touch sensor controls</li>
                                <li>Speak-to-chat technology</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    function changeImage(event, src) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
            event.target.classList.add('active');
        }
</script>

<!-- end main content -->
<?= $this->endSection() ?>