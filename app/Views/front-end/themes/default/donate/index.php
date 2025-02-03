<?php
// Get current theme impact
$theme = getCurrentTheme();

?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
    <!-- donation_cause preview section-->
    <section class="py-5">
        <div class="container px-5">
            <h2 class="fw-bolder fs-5 mb-4">Donation Campaigns</h2>
            <div class="row gx-5">
                <?php if($donation_causes): ?>
                    <?php foreach($donation_causes as $donation_cause): ?>
                            <div class="col-lg-4 mb-5">
                                <div class="card h-100 shadow border-0">
                                    <img class="card-img-top" src="<?=getImageUrl($donation_cause['image'] ?? getDefaultImagePath())?>" alt="<?= $donation_cause['title']; ?>" />
                                    <div class="card-body p-4">
                                        <a class="text-decoration-none link-dark stretched-link" href="<?= base_url('donate/'.$donation_cause['slug']) ?>"><h5 class="card-title mb-3"><?= $donation_cause['title']; ?></h5></a>
                                        <p class="card-text mb-0"><?= !empty($donation_cause['description']) ? getTextSummary($donation_cause['description']) : getTextSummary($donation_cause['content']) ?></p>
                                    </div>
                                    <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                        <div class="d-flex align-items-end justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img class="rounded-circle me-3" src="<?=getImageUrl(getUserData($donation_cause['created_by'], "profile_picture") ?? getDefaultProfileImagePath())?>" alt="<?= getActivityBy(esc($donation_cause['created_by'])); ?>" height="45" />
                                                <div class="small">
                                                    <div class="fw-bold"><?= getActivityBy(esc($donation_cause['created_by'])); ?></div>
                                                    <div class="text-muted">Date: <?= dateFormat($donation_cause['created_at'], 'M j, Y'); ?></div>
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
                    if($total_donation_causes > 20){
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
<!-- end main content -->
<?= $this->endSection() ?>