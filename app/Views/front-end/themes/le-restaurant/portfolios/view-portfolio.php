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

<!-- Page Content-->
<section class="py-5 mt-5">
    <div class="container px-5 my-2">
        <!--Breadcrumb-->
        <div class="row mb-1 bg-light">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url('/portfolios')?>">Portfolios</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Portfolio</li>
            </ol>
            </nav>
        </div>

        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder"><?= $portfolio_data['title'] ?></h1>
                    <p class="lead fw-normal text-muted mb-0">
                        <?= $portfolio_data['description'] ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="row gx-5">
            <div class="col-12">
                <div class="row mb-2">
                    <div class="col-12">
                        <img class="w-100 rounded-3" src="<?=getImageUrl(($portfolio_data['featured_image']) ?? getDefaultImagePath())?>" alt="..." />
                    </div>
                </div>
            </div>
            <?php if(!empty($portfolio_data['details_image_1'])): ?>
              <div class="col-lg-6">
                <img loading="lazy" src="<?=getImageUrl(($portfolio_data['details_image_1']) ?? getDefaultImagePath())?>" alt="" class="img-fluid rounded-3 mb-5">
              </div>
            <?php endif; ?>
            <?php if(!empty($portfolio_data['details_image_2'])): ?>
              <div class="col-lg-6">
                <img loading="lazy" src="<?=getImageUrl(($portfolio_data['details_image_2']) ?? getDefaultImagePath())?>" alt="" class="img-fluid rounded-3 mb-5">
              </div>
            <?php endif; ?>
            <?php if(!empty($portfolio_data['details_image_3'])): ?>
              <div class="col-lg-6">
                <img loading="lazy" src="<?=getImageUrl(($portfolio_data['details_image_3']) ?? getDefaultImagePath())?>" alt="" class="img-fluid rounded-3 mb-5">
              </div>
            <?php endif; ?>
            <?php if(!empty($portfolio_data['details_image_4'])): ?>
              <div class="col-lg-6">
                <img loading="lazy" src="<?=getImageUrl(($portfolio_data['details_image_4']) ?? getDefaultImagePath())?>" alt="" class="img-fluid rounded-3 mb-5">
              </div>
            <?php endif; ?>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mb-5">
                    <div class="row">
                    <?= $portfolio_data['content'] ?>
                    </div>
                </div>
            </div>
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