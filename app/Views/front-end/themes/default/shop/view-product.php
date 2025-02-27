<?php
// Get current theme impact
$theme = getCurrentTheme();
// Update view count
updateTotalViewCount("products", "product_id", $product_data['product_id']);
?>
<!-- Include theme layout -->
<?= $this->extend('front-end/themes/' . $theme . '/layout/_layout') ?>
<!-- Begin main content -->
<?= $this->section('content') ?>
<style>
    /* Product Page Styles */
    .product-page {
        background-color: #f9f9f9;
        padding: 40px 0;
    }
    .product-image {
        max-height: 450px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid transparent;
        border-radius: 8px;
        transition: border-color 0.3s ease;
    }
    .thumbnail:hover, .thumbnail.active {
        border-color: #007bff;
    }
    .product-details h2 {
        font-size: 2rem;
        margin-bottom: 10px;
    }
    .product-details p {
        font-size: 1rem;
        color: #555;
    }
    .price-tag {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }
    .price-tag s {
        font-size: 1rem;
        color: #aaa;
        margin-left: 10px;
    }
    .btn-buy-now {
        background-color: #007bff;
        color: #fff;
        font-size: 1rem;
        padding: 10px 20px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }
    .btn-buy-now:hover {
        background-color: #0056b3;
    }
    .specifications-list, .attributes-list {
        list-style: none;
        padding: 0;
    }
    .specifications-list li, .attributes-list li {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }
    .purchase-options-table {
        width: 100%;
        border-collapse: collapse;
    }
    .purchase-options-table th, .purchase-options-table td {
        text-align: left;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }
    .purchase-options-table th {
        background-color: #f9f9f9;
        font-weight: bold;
    }
</style>

<section class="product-page">
    <div class="container">
        <div class="row">
            <!-- Product Images -->
            <div class="col-md-6 mb-4">
                <img loading="lazy" src="<?= getImageUrl(($product_data['featured_image']) ?? getDefaultImagePath()) ?>" alt="Product" class="img-fluid rounded product-image" id="mainImage">
                <div class="d-flex mt-3">
                    <?php if (!empty($product_data['featured_image'])): ?>
                        <img loading="lazy" src="<?= getImageUrl(($product_data['featured_image']) ?? getDefaultImagePath()) ?>" alt="" class="thumbnail rounded active" onclick="changeImage(event, this.src)">
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <?php if (!empty($product_data["product_image_$i"])): ?>
                            <img loading="lazy" src="<?= getImageUrl(($product_data["product_image_$i"]) ?? getDefaultImagePath()) ?>" alt="" class="thumbnail rounded" onclick="changeImage(event, this.src)">
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <!-- Responsive Video -->
                <div class="mt-3">
                    <?php if (!empty($product_data['product_video'])): ?>
                        <div class="video-container" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                            <?= getVideoPreviewFromUrl($product_data['product_video'], 500) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6 product-details">
                <h2><?= esc($product_data['title']) ?></h2>
                <p class="text-muted">Category: <?= !empty($product_data['category']) ? getProductCategoryName($product_data['category']) : ""; ?></p>
                <div class="mb-3">
                    <span class="price-tag"><?= esc($product_data['currency']) ?><?= esc($product_data['sale_price'] ?? $product_data['price']) ?></span>
                    <?php if (!empty($product_data['sale_price'])): ?>
                        <span class="price-tag"><s><?= esc($product_data['currency']) ?><?= esc($product_data['price']) ?></s></span>
                    <?php endif; ?>
                </div>
                <p><?= nl2br(esc($product_data['description'])) ?></p>

                <!-- Specifications -->
                <?php if (!empty($product_data['specifications'])): ?>
                    <div class="mt-4">
                        <h5>Specifications:</h5>
                        <ul class="specifications-list">
                            <?php foreach (json_decode($product_data['specifications'], true) as $key => $value): ?>
                                <li>
                                    <strong><?= ucfirst(str_replace('_', ' ', $key)) ?>:</strong>
                                    <span><?= esc($value) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Attributes -->
                <?php if (!empty($product_data['attributes'])): ?>
                    <div class="mt-4">
                        <h5>Additional Attributes:</h5>
                        <ul class="attributes-list">
                            <?php foreach (json_decode($product_data['attributes'], true) as $key => $value): ?>
                                <li>
                                    <strong><?= ucfirst(str_replace('_', ' ', $key)) ?>:</strong>
                                    <span>
                                        <?php if (is_array($value)): ?>
                                            <?= implode(', ', array_map('esc', $value)) ?>
                                        <?php else: ?>
                                            <?= esc($value) ?>
                                        <?php endif; ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Purchase Options -->
                <?php if (!empty($product_data['purchase_options'])): ?>
                    <div class="mt-4">
                        <h5>Purchase Options:</h5>
                        <table class="purchase-options-table">
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
</section>

<script>
    function changeImage(event, src) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
        event.target.classList.add('active');
    }
</script>
<!-- End main content -->
<?= $this->endSection() ?>