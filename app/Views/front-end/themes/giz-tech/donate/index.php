<?php
// Get current theme impact
$theme = getCurrentTheme();

//popup settings
$currentPage = "donate";
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
                    <li class="breadcrumb-item active text-secondary" aria-current="page">Donation Campaigns</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Donation Campaigns Page Content -->
    <section id="donation-campaigns" class="page py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h1 class="fw-bold mb-3">Our Donation Campaigns</h1>
                    <p class="lead text-muted">Support our initiatives to bridge the digital divide</p>
                </div>
            </div>
            
            <div class="row g-4">
                <?php if($donation_causes): ?>
                    <?php foreach($donation_causes as $donation_cause): ?>
                        <!-- Campaign 1 -->
                        <div class="col-12">
                            <div class="card campaign-card border-0 shadow-sm overflow-hidden">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <a href="<?= base_url('donate/'.$donation_cause['slug']) ?>">
                                            <img src="<?=getImageUrl($donation_cause['image'] ?? getDefaultImagePath())?>" class="img-fluid h-100" alt="<?= $donation_cause['title']; ?>" style="object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body h-100 d-flex flex-column">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <h3 class="card-title fw-bold mb-0"><?= $donation_cause['title']; ?></h3>
                                                <span class="badge bg-primary">Active</span>
                                            </div>
                                            <div class="progress mb-3" style="height: 8px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="card-text flex-grow-1"><?= !empty($donation_cause['description']) ? getTextSummary($donation_cause['description']) : getTextSummary($donation_cause['content']) ?></p>
                                            
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <div>
                                                    <?
                                                        if(!empty($donation_cause['link']))
                                                        {?>
                                                          <a href="<?= $donation_cause['link'] ?>" class="btn btn-outline-secondary me-2" target="_blank">Learn More</a>
                                                        <?}
                                                    ?>
                                                    <a href="<?= base_url('donate/'.$donation_cause['slug']) ?>" class="btn btn-primary">Donate Now</a>
                                                </div>
                                            </div>
                                        </div>
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
                    if($total_donation_causes > intval(env('PAGINATE_LOW', 20))){
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
    <!-- End Page Content -->
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