<?php
// Get current theme impact
$theme = getCurrentTheme();

?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
    <!-- Product preview section-->
    <section class="py-5">
        <div class="container px-5">
            <h2 class="fw-bolder fs-5 mb-4">Products</h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    <?php if($products): ?>
                        <?php foreach($products as $product): ?>
                            <div class="col-lg-4 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <a href="<?= base_url('shop/'.$product['slug']) ?>">
                                        <img src="<?=getImageUrl($product['featured_image'] ?? getDefaultImagePath())?>" alt="<?= $product['title']; ?>" class="card-img-top">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $product['title']; ?></h5>
                                        <p class="card-text"><?= !empty($product['short_description']) ? getTextSummary($product['short_description']) : getTextSummary($product['content']) ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="h5 mb-0"><?= $product['currency']; ?><?= $product['sale_price'] ?? $product['price']; ?></span>
                                            <a href="#!" class="btn btn-outline-primary"><i class="bi bi-eye"></i> View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- End post list item -->
                        <?php endforeach; ?>
                    <?php endif; ?>
            </div>
            <div class="text-start mb-5 mb-xl-0">
                <?php
                    if($total_products > 20){
                        ?>
                            <!--Show pagination if more than 100 records-->
                            <div class="col-12 text-start">
                                <p>Pagination</p>
                                <?= $pager->links('default', 'bootstrap') ?>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </section>
<!-- end main content -->
<?= $this->endSection() ?>