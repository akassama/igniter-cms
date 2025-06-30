<?php
// Get current theme impact
$theme = getCurrentTheme();

//popup settings
$currentPage = "events";
$popUpWhereClause = ['status' => 1];
$showOnPages = getTableData('announcement_popups', $popUpWhereClause, 'show_on_pages');
$enablePopupAds = getConfigData("EnablePopupAds");

//update view count
updateTotalViewCount("events", "event_id", $event_data['event_id']);
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
                <li class="breadcrumb-item"><a href="<?=base_url('/events')?>" class="text-decoration-none text-primary">Events</a></li>
                <li class="breadcrumb-item active text-secondary" aria-current="page">Event Details</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Event Details Page Content -->
<section class="page py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-sm">
                    <img src="<?= getImageUrl(($event_data['image']) ?? getDefaultImagePath())?>" class="card-img-top rounded-0" alt="<?= $event_data['title'] ?>">
                    <div class="card-body">
                        <h2 class="card-title text-primary mb-3"><?= $event_data['title'] ?></h2>
                        <ul class="list-unstyled mb-4">
                            <li><i class="bi bi-calendar-event me-2 text-primary"></i><strong>Start Date:</strong> <?= dateFormat($event_data['start_date'], 'M j, Y'); ?></li>
                            <?php if(!empty($event_data['end_date'])): ?>
                                <li><i class="bi bi-calendar-event me-2 text-primary"></i><strong>End Date:</strong> <?= dateFormat($event_data['end_date'], 'M j, Y'); ?></li>
                            <?php endif; ?>
                            <li><i class="bi bi-geo-alt me-2 text-primary"></i><strong>Location:</strong> <?= $event_data['location'] ?></li>
                        </ul>
                        
                        <div class="card-text mb-4">
                            <?= $event_data['content'] ?>
                        </div>
                        
                        <div class="d-flex align-items-center mt-4">
                            <a href="<?= base_url('/search/filter/?type=author&key='.getUserData($event_data['created_by'], "username"))?>">
                                <img loading="lazy" src="<?=getImageUrl(getUserData($event_data['created_by'], "profile_picture") ?? getDefaultProfileImagePath())?>" class="rounded-circle me-3" alt="<?= $event_data['title'] ?>" style="height: 75px; width: 75px"> 
                            </a>
                            <div>
                                <div class="fw-bold">
                                    <a href="<?= base_url('/search/filter/?type=author&key='.getUserData($event_data['created_by'], "username"))?>" class="text-dark text-decoration-none">
                                        <?= getActivityBy(esc($event_data['created_by'])); ?>
                                    </a>
                                </div>
                                <div class="text-muted small">
                                    Posted on <?= dateFormat($event_data['created_at'], 'M j, Y'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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