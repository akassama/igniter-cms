<?php
// Get current theme impact
$theme = getCurrentTheme();

//popup settings
$currentPage = "appointments";
$popUpWhereClause = ['status' => 1];
$showOnPages = getTableData('announcement_popups', $popUpWhereClause, 'show_on_pages');
$enablePopupAds = getConfigData("EnablePopupAds");
?>
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<?= $this->section('content') ?>

<section id="post-details" class="section">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Appointments</li>
            </ol>
        </nav>

        <h2 class="fw-bolder fs-5 mb-4">Appointments</h2>
        <div class="row gx-5">
            <?php if($appointments): ?>
                <?php foreach($appointments as $appointment): ?>
                        <?php
                            // Ensure the 'image' key exists or provide a default
                            $appointmentImage = $appointment['image'] ?? getDefaultImagePath();
                        ?>
                        <div class="col-lg-4 mb-5">
                            <div class="card h-100 shadow border-0">
                                <img class="card-img-top" src="<?= getImageUrl($appointmentImage) ?>" alt="<?= esc($appointment['title']); ?>" />
                                <div class="card-body p-4">
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2">
                                        <?= esc(ucfirst($appointment['appointment_type'])); ?>
                                    </div>
                                    <a class="text-decoration-none link-dark stretched-link" href="<?= base_url('appointment/' . $appointment['slug']) ?>">
                                        <h5 class="card-title mb-3"><?= esc($appointment['title']); ?></h5>
                                    </a>
                                    <p class="card-text mb-0">
                                        <?= esc(getTextSummary($appointment['description'] ?? 'No description available.', 100)); ?>
                                    </p>
                                </div>
                                <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                    <div class="d-flex align-items-end justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="small">
                                                <div class="fw-bold">Book Now</div>
                                                <div class="text-muted">Available via <?= esc(ucfirst($appointment['appointment_type'])); ?></div>
                                            </div>
                                        </div>
                                        <a class="btn btn-primary" href="<?= base_url('appointment/' . $appointment['slug']) ?>">
                                            Book Now <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="lead">No appointment types are currently configured.</p>
                        <p>Please check back later or contact us for more information.</p>
                    </div>
            <?php endif; ?>
        </div>
        <div class="text-start mb-5 mb-xl-0">
            <?php
                // Check if $pager is defined and has links, and if total_appointments is above 20
                if (isset($pager) && $total_appointments > 20) {
                    ?>
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
        <?= $this->include('front-end/themes/_shared/_advert_popups.php'); ?>
    <?php
}
?>

<?= $this->endSection() ?>