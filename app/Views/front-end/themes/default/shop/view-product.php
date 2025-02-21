<?php
// Get current theme impact
$theme = getCurrentTheme();
// Update view count
updateTotalViewCount("products", "product_id", $product_data['product_id']);
?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/' . $theme . '/layout/_layout') ?>
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
<section class="py-5">
    <div class="container px-5 my-2">
        <div class="row gx-5">
            <div class="col-12">
                <div class="row">
                    <!-- Product Images -->
                    <div class="col-md-6 mb-4">
                        <img src="<?= getImageUrl(($product_data['featured_image']) ?? getDefaultImagePath()) ?>" alt="Product" class="img-fluid rounded mb-3 product-image" id="mainImage">
                        <div class="d-flex justify-content-between">
                            <?php if (!empty($product_data['featured_image'])): ?>
                                <img src="<?= getImageUrl(($product_data['featured_image']) ?? getDefaultImagePath()) ?>" alt="" class="thumbnail rounded active" onclick="changeImage(event, this.src)">
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= 4; $i++): ?>
                                <?php if (!empty($product_data["product_image_$i"])): ?>
                                    <img src="<?= getImageUrl(($product_data["product_image_$i"]) ?? getDefaultImagePath()) ?>" alt="" class="thumbnail rounded" onclick="changeImage(event, this.src)">
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <?php if (!empty($product_data['product_video'])): ?>
                                <div><?= getVideoPreviewFromUrl($product_data['product_video'], 500) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- Product Details -->
                    <div class="col-md-6">
                        <h2 class="mb-3"><?= esc($product_data['title']) ?></h2>
                        <p class="text-muted mb-4">Category: <?= !empty($product_data['category']) ? getProductCategoryName($product_data['category']) : ""; ?></p>
                        <div class="mb-3">
                            <span class="h4 me-2"><?= esc($product_data['currency']) ?><?= esc($product_data['sale_price'] ?? $product_data['price']) ?></span>
                            <?php if (!empty($product_data['sale_price'])): ?>
                                <span class="text-muted"><s><?= esc($product_data['currency']) ?><?= esc($product_data['price']) ?></s></span>
                            <?php endif; ?>
                        </div>
                        <p class="mb-4"><?= nl2br(esc($product_data['description'])) ?></p>

                        <!-- Specifications -->
                        <?php if (!empty($product_data['specifications'])): ?>
                            <div class="mb-4">
                                <h5>Specifications:</h5>
                                <ul>
                                    <?php foreach (json_decode($product_data['specifications'], true) as $key => $value): ?>
                                        <li><strong><?= ucfirst(str_replace('_', ' ', $key)) ?>:</strong> <?= esc($value) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Attributes -->
                        <?php if (!empty($product_data['attributes'])): ?>
                            <div class="mb-4">
                                <h5>Additional Attributes:</h5>
                                <ul>
                                    <?php foreach (json_decode($product_data['attributes'], true) as $key => $value): ?>
                                        <li><strong><?= ucfirst(str_replace('_', ' ', $key)) ?>:</strong> 
                                            <?php if (is_array($value)): ?>
                                                <?= implode(', ', array_map('esc', $value)) ?>
                                            <?php else: ?>
                                                <?= esc($value) ?>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Seller Information -->
                        <?php if (!empty($product_data['seller_info'])): ?>
                            <div class="mb-4">
                                <h5>Seller Information:</h5>
                                <ul>
                                    <?php foreach (json_decode($product_data['seller_info'], true) as $key => $value): ?>
                                        <li><strong><?= ucfirst(str_replace('_', ' ', $key)) ?>:</strong> <?= esc($value) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Purchase Options -->
                        <?php if (!empty($product_data['purchase_options'])): ?>
                            <div class="mb-4">
                                <h5>Purchase Options:</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Platform</th>
                                            <th>Price</th>
                                            <th>Availability</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (json_decode($product_data['purchase_options'], true) as $option): ?>
                                            <tr>
                                                <td><?= esc($option['platform']) ?></td>
                                                <td><?= esc($option['price']) ?></td>
                                                <td><?= esc($option['availability']) ?></td>
                                                <td><a href="<?= esc($option['url']) ?>" target="_blank" class="btn btn-sm btn-primary">Buy Now</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
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