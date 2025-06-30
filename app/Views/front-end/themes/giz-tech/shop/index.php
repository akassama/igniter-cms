<?php
// Get current theme impact
$theme = getCurrentTheme();

//popup settings
$currentPage = "shop";
$popUpWhereClause = ['status' => 1];
$showOnPages = getTableData('announcement_popups', $popUpWhereClause, 'show_on_pages');
$enablePopupAds = getConfigData("EnablePopupAds");

?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light mt-md-3 mt-sm-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?=base_url()?>" class="text-decoration-none text-primary">Home</a></li>
                <li class="breadcrumb-item active text-secondary" aria-current="page">Shop</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Products Page Content -->
<section id="products" class="page py-5">
    <div class="container">
        <h1 class="fw-bold text-center mb-4">Our Products</h1>
        <div class="row g-4">

            <?php if($products): ?>
                <?php foreach($products as $product): ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="card shadow-sm border-0 h-100 d-flex flex-column">
                            <div class="position-relative">
                                <img src="<?= getImageUrl($product['featured_image'] ?? getDefaultImagePath()) ?>" 
                                     class="card-img-top" 
                                     alt="<?= esc($product['title']) ?>" 
                                     style="height: 250px; object-fit: cover;">
                                <!-- Sale Badge -->
                                <?php if (!empty($product['sale_price'])): ?>
                                    <span class="badge bg-danger position-absolute top-0 start-0 m-2">Sale</span>
                                <?php else: ?>
                                    <span class="badge bg-success position-absolute top-0 start-0 m-2">New</span>
                                <?php endif; ?>
                            </div>

                            <div class="card-body text-center flex-grow-1 d-flex flex-column">
                                <h5 class="card-title"><?= esc($product['title']) ?></h5>
                                
                                <p class="fw-bold text-primary mt-auto">
                                    <?php if (!empty($product['sale_price'])): ?>
                                        <span class="text-decoration-line-through text-secondary">
                                            <?= esc($product['currency']) ?><?= esc($product['price']) ?>
                                        </span>
                                        <br>
                                        <?= esc($product['currency']) ?><?= esc($product['sale_price']) ?>
                                    <?php else: ?>
                                        <?= esc($product['currency']) ?><?= esc($product['price']) ?>
                                    <?php endif; ?>
                                </p>
                            </div>

                            <div class="card-footer bg-transparent border-0 text-center">
                                <a href="<?= base_url('shop/' . esc($product['slug'])) ?>" class="btn btn-primary w-100">
                                    View Product
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>No products found.</p>
                </div>
            <?php endif; ?>

        </div>

        <!-- Pagination -->
        <div class="mt-5">
            <?php if ($total_products > intval(env('PAGINATE_LOW', 20))): ?>
                <div class="col-12 text-start">
                    <?= $pager->links('default', 'bootstrap') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
// Check if popups should be shown
if (strtolower($enablePopupAds) === "yes" && in_array($currentPage, explode(',', $showOnPages))) {
    ?>
        <!-- Advert Popup Section -->
        <?= $this->include('front-end/themes/_shared/_advert_popups.php'); ?>
    <?php
}
?>

<!-- end main content -->
<?= $this->endSection() ?>