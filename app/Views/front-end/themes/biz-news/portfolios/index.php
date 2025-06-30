<?php
// Get current theme impact
$theme = getCurrentTheme();

//popup settings
$currentPage = "portfolios";
$popUpWhereClause = ['status' => 1];
$showOnPages = getTableData('announcement_popups', $popUpWhereClause, 'show_on_pages');
$enablePopupAds = getConfigData("EnablePopupAds");
$sectionTitle = getHomePageData("Portfolio", "section_title");
$sectionDescription = getHomePageData("Portfolio", "section_description");
?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
    <section class="py-5" id="portfolio">
        <div class="container px-5 my-5">
            <!--Breadcrumb-->
            <div class="row mb-1">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Portfolios</li>
                </ol>
                </nav>
            </div>
            
            <div class="text-center mb-5">
                <h1 class="fw-bolder"><?=$sectionTitle?></h1>
                <p class="lead fw-normal text-muted mb-0"><?=$sectionDescription?></p>
            </div>
            <div class="row gx-5">
                <?php if($portfolios): ?>
                    <?php foreach($portfolios as $portfolio): ?>
                        <?php
                            if(strtolower($portfolio['group']) === "portfolio"){
                                ?>
                                <div class="col-lg-6">
                                    <div class="position-relative mb-5">
                                        <img class="img-fluid rounded-3 mb-3" src="<?=getImageUrl($portfolio['featured_image'] ?? getDefaultImagePath())?>" alt="<?= $portfolio['title']; ?>" />
                                        <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" href="<?= base_url('portfolio/'.$portfolio['slug']) ?>"><?= $portfolio['title']; ?></a>
                                    </div>
                                </div>
                                <?php
                            }    
                        ?>
                    <!-- End Portfolio Item -->
                    <?php endforeach; ?>
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