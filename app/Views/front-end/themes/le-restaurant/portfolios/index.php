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
    <section class="py-5 mt-5" id="portfolio">
        <div class="container px-5 my-5">
            <!--Breadcrumb-->
            <div class="row mb-1 bg-light">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Portfolios</li>
                </ol>
                </nav>
            </div>
            
            <div class="row gx-5">
                <div class="container">
                        <div class="section-title">
                            <h1><?=$sectionTitle?></h1>
                            <p><?=$sectionDescription?></p>
                        </div>

                        <?php 
                        // Filter only restaurant portfolios
                        $restaurantPortfolios = array_filter($portfolios, function($portfolio) {
                            return strtolower($portfolio['group'] ?? '') === 'restaurant_portfolio';
                        });
                        
                        // Extract unique category_filters for tabs
                        $uniqueCategories = array_unique(array_column($restaurantPortfolios, 'category_filter'));
                        ?>

                        <!-- Menu Tabs -->
                        <ul class="nav nav-pills menu-tabs justify-content-center mb-5" id="menuTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" 
                                        id="all-tab" 
                                        data-bs-toggle="pill" 
                                        data-bs-target="#all" 
                                        type="button" 
                                        role="tab"
                                        aria-controls="all"
                                        aria-selected="true">All</button>
                            </li>
                            <?php foreach ($uniqueCategories as $category): ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" 
                                            id="<?= strtolower(str_replace(' ', '-', $category)) ?>-tab" 
                                            data-bs-toggle="pill" 
                                            data-bs-target="#<?= strtolower(str_replace(' ', '-', $category)) ?>" 
                                            type="button" 
                                            role="tab"
                                            aria-controls="<?= strtolower(str_replace(' ', '-', $category)) ?>"
                                            aria-selected="false">
                                        <?= esc($category) ?>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- Menu Content -->
                        <div class="tab-content" id="menuTabsContent">
                            <!-- All Items Tab -->
                            <div class="tab-pane fade show active" id="all" role="tabpanel">
                                <div class="row align-items-center justify-content-center">
                                    <?php foreach ($restaurantPortfolios as $portfolio): ?>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="menu-item">
                                                <img src="<?=getImageUrl($portfolio['featured_image'] ?? getDefaultImagePath())?>" 
                                                    alt="<?= esc($portfolio['title']) ?>" 
                                                    class="img-fluid rounded-top">
                                                <h4><?= esc($portfolio['title']) ?> 
                                                    <?php if (!empty($portfolio['client'])): ?>
                                                        <span class="price"><?= esc($portfolio['client']) ?></span>
                                                    <?php endif; ?>
                                                </h4>
                                                <p><?= esc($portfolio['description']) ?></p>
                                                <a href="<?= base_url('portfolio/'.$portfolio['slug']) ?>" 
                                                class="btn btn-sm btn-outline-primary">View Details</a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Category Tabs -->
                            <?php foreach ($uniqueCategories as $category): ?>
                                <div class="tab-pane fade" 
                                    id="<?= strtolower(str_replace(' ', '-', $category)) ?>" 
                                    role="tabpanel">
                                    <div class="row align-items-center justify-content-center">
                                        <?php foreach ($restaurantPortfolios as $portfolio): ?>
                                            <?php if ($portfolio['category_filter'] === $category): ?>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="menu-item">
                                                        <img src="<?=getImageUrl($portfolio['featured_image'] ?? getDefaultImagePath())?>" 
                                                            alt="<?= esc($portfolio['title']) ?>" 
                                                            class="img-fluid rounded-top">
                                                        <h4><?= esc($portfolio['title']) ?> 
                                                            <?php if (!empty($portfolio['client'])): ?>
                                                                <span class="price"><?= esc($portfolio['client']) ?></span>
                                                            <?php endif; ?>
                                                        </h4>
                                                        <p><?= esc($portfolio['description']) ?></p>
                                                        <a href="<?= base_url('portfolio/'.$portfolio['slug']) ?>" 
                                                        class="btn btn-sm btn-outline-primary">View Details</a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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