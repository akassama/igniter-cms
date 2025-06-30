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

<section id="post-details" class="section">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Portfolios</li>
            </ol>
        </nav>

        <div class="text-center mb-5">
            <h1 class="fw-bolder"><?=$sectionTitle?></h1>
            <p class="lead fw-normal text-muted mb-0"><?=$sectionDescription?></p>
        </div>
        <div class="row gx-5">
            <?php if($portfolios): ?>
                <?php foreach($portfolios as $index => $portfolio): ?>
                    <?php if(strtolower($portfolio['group']) === "portfolio"): ?>
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
                            <div class="portfolio-item">
                                <img src="<?=getImageUrl($portfolio['featured_image'] ?? 'https://placehold.co/400x300/6366f1/ffffff?text=Portfolio')?>" alt="<?= $portfolio['title'] ?? 'Project'; ?>" class="img-fluid">
                                <div class="portfolio-overlay">
                                    <div class="text-center text-white">
                                        <h5><?= $portfolio['title'] ?? 'Project Title'; ?></h5>
                                        <p>Project Description</p>
                                        <a href="<?= base_url('portfolio/'.$portfolio['slug']) ?>" class="btn btn-outline-light"><i class="ri-external-link-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
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