<?php
// Get current theme impact
$theme = getCurrentTheme();

//popup settings
$currentPage = "portfolios";
$popUpWhereClause = ['status' => 1];
$showOnPages = getTableData('announcement_popups', $popUpWhereClause, 'show_on_pages');
$enablePopupAds = getConfigData("EnablePopupAds");

//update view count
updateTotalViewCount("portfolios", "portfolio_id", $portfolio_data['portfolio_id']);
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
                <li class="breadcrumb-item"><a href="<?=base_url('/portfolios')?>" class="text-decoration-none text-primary">Portfolios</a></li>
                <li class="breadcrumb-item active text-secondary" aria-current="page">View Portfolio</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Portfolio Details Content -->
<section id="portfolio-details" class="page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Portfolio Images Carousel -->
            <div class="col-lg-8">
                <div class="swiper portfolioCarousel">
                    <div class="swiper-wrapper">
                        <!-- Featured Image -->
                        <div class="swiper-slide">
                            <img src="<?=getImageUrl($portfolio_data['featured_image'] ?? getDefaultImagePath())?>" alt="Featured Image" class="img-fluid">
                        </div>

                        <!-- Detail Images -->
                        <?php if(!empty($portfolio_data['details_image_1'])): ?>
                        <div class="swiper-slide">
                            <img src="<?=getImageUrl($portfolio_data['details_image_1'])?>" alt="Portfolio Image 1" class="img-fluid">
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($portfolio_data['details_image_2'])): ?>
                        <div class="swiper-slide">
                            <img src="<?=getImageUrl($portfolio_data['details_image_2'])?>" alt="Portfolio Image 2" class="img-fluid">
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($portfolio_data['details_image_3'])): ?>
                        <div class="swiper-slide">
                            <img src="<?=getImageUrl($portfolio_data['details_image_3'])?>" alt="Portfolio Image 3" class="img-fluid">
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($portfolio_data['details_image_4'])): ?>
                        <div class="swiper-slide">
                            <img src="<?=getImageUrl($portfolio_data['details_image_4'])?>" alt="Portfolio Image 4" class="img-fluid">
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Navigation Buttons -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>

            <!-- Portfolio Details -->
            <div class="col-lg-4">
                <h2 class="fw-bold mb-3"><?= $portfolio_data['title'] ?></h2>
                <p class="mb-4"><?= $portfolio_data['description'] ?></p>
                <div class="card">
                    <div class="card-header">
                        <h4>Project Information</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><strong>Category:</strong> <?= $portfolio_data['category'] ?></li>
                            <li><strong>Client:</strong> <?= $portfolio_data['client'] ?></li>
                            <?php if (!empty($portfolio_data['project_date'])): ?>
                                <li><strong>Project Date:</strong> <?= dateFormat($portfolio_data['project_date'], 'F Y') ?></li>
                            <?php endif; ?>
                            <?php if (!empty($portfolio_data['project_url'])): ?>
                                <li><strong>Project URL:</strong> <a href="<?= $portfolio_data['project_url'] ?>" target="_blank" class="text-primary">Visit Project</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Full Description Below -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
                <div class="portfolio-description">
                    <?= $portfolio_data['content'] ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Portfolio Details Content -->

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