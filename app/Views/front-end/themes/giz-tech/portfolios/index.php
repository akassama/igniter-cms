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

<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light mt-md-3 mt-sm-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?=base_url()?>" class="text-decoration-none text-primary">Home</a></li>
                <li class="breadcrumb-item active text-secondary" aria-current="page">Portfolios</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Page Content-->
<section class="py-5" id="portfolio" data-aos="fade-up">
    <div class="container px-5 my-5">
        <div class="text-center mb-5">
            <h1 class="fw-bolder"><?=$sectionTitle?></h1>
            <p class="lead fw-normal text-muted mb-0"><?=$sectionDescription?></p>
        </div>

        <?php 
        // First filter portfolios to only include those with group = "portfolio"
        $filteredPortfolios = array_filter($portfolios ?? [], function($portfolio) {
            return strtolower($portfolio['group']) === "portfolio";
        });
        
        // Get unique category filters from the filtered portfolios
        $categoryFilters = array_unique(array_column($filteredPortfolios, 'category_filter'));
        ?>

        <!-- Filter Buttons (only show if we have filters) -->
        <?php if(count($categoryFilters) > 0): ?>
        <div class="row justify-content-center mb-4" data-aos="fade-up">
            <div class="col-lg-8 text-center">
                <button class="btn btn-outline-primary filter-btn mb-1 active" data-filter="*">All</button>
                <?php foreach($categoryFilters as $filter): 
                    if(!empty($filter)):
                        $filterClass = strtolower(str_replace(' ', '-', $filter));
                ?>
                    <button class="btn btn-outline-primary filter-btn mb-1" data-filter=".<?=$filterClass?>"><?=$filter?></button>
                <?php 
                    endif;
                endforeach; 
                ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Portfolio Items -->
        <div class="row gx-5 portfolio-container" data-aos="zoom-in">
            <?php if(!empty($filteredPortfolios)): ?>
                <?php foreach($filteredPortfolios as $portfolio): 
                    $filterClass = strtolower(str_replace(' ', '-', $portfolio['category_filter']));
                ?>
                    <div class="col-lg-6 portfolio-item <?=$filterClass?>">
                        <div class="position-relative mb-5">
                            <a href="<?=getImageUrl($portfolio['featured_image'] ?? getDefaultImagePath())?>" class="glightbox" data-gallery="portfolioGallery">
                                <img class="img-fluid rounded-3 mb-3" src="<?=getImageUrl($portfolio['featured_image'] ?? getDefaultImagePath())?>" alt="<?= $portfolio['title']; ?>" />
                            </a>
                            <div class="card-body p-0">
                                <h5 class="fw-bold mb-2"><?= $portfolio['title']; ?></h5>
                                <p class="text-muted small mb-3"><?= $portfolio['description']; ?></p>
                                <a class="text-decoration-none link-dark stretched-link" href="<?= base_url('portfolio/'.$portfolio['slug']) ?>">
                                    <span class="btn btn-sm btn-outline-primary">View Case Study</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No portfolio items available</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if(count($filteredPortfolios) > 6): ?>
            <div class="text-center mt-5">
                <a href="<?= base_url('portfolios') ?>" class="btn btn-primary">View All Projects</a>
            </div>
        <?php endif; ?>
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