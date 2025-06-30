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
<section id="post-details" class="section">
    <div class="container">

        <!-- Portfolio Details Section -->
        <section id="portfolio-details" class="section py-5">
            <div class="container px-5 my-2">
                <!-- Breadcrumb -->
                <div class="row mb-1">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?=base_url('/portfolios')?>">Portfolio</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $portfolio_data['title'] ?></li>
                        </ol>
                    </nav>
                </div>

                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8">
                        <!-- Featured Image (as Carousel if multiple images exist) -->
                        <?php if(!empty($portfolio_data['featured_image']) || 
                                !empty($portfolio_data['details_image_1']) || 
                                !empty($portfolio_data['details_image_2'])): ?>
                        <div id="portfolioCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                            <div class="carousel-inner rounded-3">
                                <?php if(!empty($portfolio_data['featured_image'])): ?>
                                <div class="carousel-item active">
                                    <img src="<?=getImageUrl($portfolio_data['featured_image'])?>" class="d-block w-100" alt="Featured Image">
                                </div>
                                <?php endif; ?>
                                
                                <?php if(!empty($portfolio_data['details_image_1'])): ?>
                                <div class="carousel-item <?= empty($portfolio_data['featured_image']) ? 'active' : '' ?>">
                                    <img src="<?=getImageUrl($portfolio_data['details_image_1'])?>" class="d-block w-100" alt="Detail Image 1">
                                </div>
                                <?php endif; ?>
                                
                                <?php if(!empty($portfolio_data['details_image_2'])): ?>
                                <div class="carousel-item">
                                    <img src="<?=getImageUrl($portfolio_data['details_image_2'])?>" class="d-block w-100" alt="Detail Image 2">
                                </div>
                                <?php endif; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#portfolioCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#portfolioCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <?php endif; ?>

                        <!-- Project Description Card -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <h1 class="fw-bolder"><?= $portfolio_data['title'] ?></h1>
                                    <p class="lead fw-normal text-muted mb-0">
                                        <?= $portfolio_data['description'] ?>
                                    </p>
                                </div>
                                
                                <hr>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <h6 class="fw-bold">Category:</h6>
                                        <p><?= $portfolio_data['category'] ?></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="fw-bold">Client:</h6>
                                        <p><?= $portfolio_data['client'] ?></p>
                                    </div>
                                    <?php if(!empty($portfolio_data['project_date'])): ?>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="fw-bold">Project Date:</h6>
                                        <p><?= dateFormat($portfolio_data['project_date'], 'M j, Y'); ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="content mt-4">
                                    <?= $portfolio_data['content'] ?>
                                </div>
                                
                                <?php if(!empty($portfolio_data['project_url'])): ?>
                                <div class="text-center mt-4">
                                    <a href="<?= $portfolio_data['project_url']?>" class="btn btn-primary" target="_blank">
                                        View Live Project <i class="bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Additional Images Grid -->
                        <?php if(!empty($portfolio_data['details_image_3']) || !empty($portfolio_data['details_image_4'])): ?>
                        <div class="row gx-4 gy-4 mb-5">
                            <?php if(!empty($portfolio_data['details_image_3'])): ?>
                            <div class="col-lg-6">
                                <img loading="lazy" src="<?=getImageUrl($portfolio_data['details_image_3'])?>" alt="Detail Image 3" class="img-fluid rounded-3">
                            </div>
                            <?php endif; ?>
                            
                            <?php if(!empty($portfolio_data['details_image_4'])): ?>
                            <div class="col-lg-6">
                                <img loading="lazy" src="<?=getImageUrl($portfolio_data['details_image_4'])?>" alt="Detail Image 4" class="img-fluid rounded-3">
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
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