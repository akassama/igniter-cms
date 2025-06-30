<?php
// Get current theme impact
$theme = getCurrentTheme();

//popup settings
$currentPage = "events";
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
                <li class="breadcrumb-item active text-secondary" aria-current="page">Events</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Events Page Content -->
<section class="page py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="fw-bold mb-3">Upcoming Events</h1>
                <p class="lead text-muted">Join us at these exciting IT events and conferences</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php if($events): ?>
                <?php foreach($events as $event): ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card event-card h-100 border-0 shadow-sm">
                            <div class="event-badge bg-primary text-white position-absolute top-0 start-0 m-2 px-2 py-1 rounded">
                                <small>Upcoming</small>
                            </div>
                            <img src="<?=getImageUrl($event['image'] ?? getDefaultImagePath())?>" class="card-img-top" alt="<?= $event['title']; ?>">
                            <div class="card-body d-flex flex-column">
                                <div class="event-date mb-2">
                                    <i class="bi bi-calendar-event me-2"></i>
                                    <small class="text-muted"><?= dateFormat($event['start_date'], 'M j, Y'); ?></small>
                                </div>
                                <h5 class="card-title fw-bold"><?= $event['title']; ?></h5>
                                <p class="card-text text-muted small"><?= !empty($event['description']) ? getTextSummary($event['description']) : getTextSummary($event['content']) ?></p>
                                <div class="event-location mb-3">
                                    <i class="bi bi-geo-alt me-2"></i>
                                    <small><?=$event['location']?></small>
                                </div>
                                <a href="<?= base_url('event/'.$event['slug']) ?>" class="btn btn-outline-primary mt-auto">See Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <?php if($total_events > intval(env('PAGINATE_LOW', 20))): ?>
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <?= $pager->links('default', 'bootstrap') ?>
                </div>
            </div>
        <?php endif; ?>
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