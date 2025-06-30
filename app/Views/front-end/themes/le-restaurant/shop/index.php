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
    <!-- Product preview section-->
    <section class="py-5 mt-5">
        <div class="container px-5">
            <div class="row mb-1 bg-light">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url('/shop')?>">Shop</a></li>
                    </ol>
                </nav>
            </div>

            <h2 class="fw-bolder fs-5 mb-4">Products</h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <?php if($products): ?>
                        <?php foreach($products as $product): ?>
                            <div class="col mb-5">
                                <div class="card h-100 d-flex flex-column">
                                    <?php if(!empty($product['sale_price'])): ?>
                                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                    <?php endif; ?>

                                    <a href="<?= base_url('shop/'.$product['slug']) ?>">
                                        <img class="card-img-top" loading="lazy" 
                                            src="<?=getImageUrl($product['featured_image'] ?? getDefaultImagePath())?>" 
                                            alt="<?= $product['title']; ?>" 
                                            style="height: 250px; object-fit: cover;" />
                                    </a>

                                    <div class="card-body p-4 flex-grow-1">
                                        <div class="text-center">
                                            <h5 class="fw-bolder"><?= $product['title']; ?></h5>
                                            <?php if(!empty($product['sale_price'])): ?>
                                                <span class="text-muted text-decoration-line-through"><?= $product['currency']; ?><?= $product['price']; ?></span>
                                                <?= $product['currency']; ?><?= $product['sale_price']; ?>
                                            <?php else: ?>
                                                <?= $product['currency']; ?><?= $product['price']; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent mt-auto">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?= base_url('shop/'.$product['slug']) ?>">View Details</a></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="text-start mb-5 mb-xl-0">
                <?php
                    if($total_products > intval(env('PAGINATE_LOW', 20))){
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