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
    <!-- event preview section-->
    <section class="py-5">
        <div class="container px-5">
            <!--Breadcrumb-->
            <div class="row mb-1">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Events</li>
                </ol>
                </nav>
            </div>

            <h2 class="fw-bolder fs-5 mb-4">Events</h2>
            <div class="row gx-5">
                <?php if($events): ?>
                    <?php foreach($events as $event): ?>
                            <div class="col-lg-4 mb-5">
                                <div class="card h-100 shadow border-0">
                                    <img class="card-img-top" src="<?=getImageUrl($event['image'] ?? getDefaultImagePath())?>" alt="<?= $event['title']; ?>" />
                                    <div class="card-body p-4">
                                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">Location: <?=$event['location']?></div>
                                        <a class="text-decoration-none link-dark stretched-link" href="<?= base_url('event/'.$event['slug']) ?>"><h5 class="card-title mb-3"><?= $event['title']; ?></h5></a>
                                        <p class="card-text mb-0"><?= !empty($event['description']) ? getTextSummary($event['description']) : getTextSummary($event['content']) ?></p>
                                    </div>
                                    <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                        <div class="d-flex align-items-end justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img class="rounded-circle me-3" src="<?=getImageUrl(getUserData($event['created_by'], "profile_picture") ?? getDefaultProfileImagePath())?>" alt="<?= getActivityBy(esc($event['created_by'])); ?>" height="45" />
                                                <div class="small">
                                                    <div class="fw-bold"><?= getActivityBy(esc($event['created_by'])); ?></div>
                                                    <div class="text-muted">Event Date: <?= dateFormat($event['start_date'], 'M j, Y'); ?></div>
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
                    if($total_events > intval(env('PAGINATE_LOW', 20))){
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