<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<h1 class="mt-4">Forms</h1>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Forms')
);
echo generateBreadcrumb($breadcrumb_links);
?>
<div class="row">
    <!--Contact Forms-->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body border-bottom">
                <i class="ri-mail-send-fill"></i>
                Contact Forms
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?= base_url('/account/forms/contact-forms'); ?>">View Details</a>
                <div class="small text-white"><i class="ri-arrow-right-circle-fill h5"></i></div>
            </div>
        </div>
    </div>

    <!--Booking Forms-->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body border-bottom">
                <i class="ri-calendar-check-fill"></i>
                Booking Forms
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?= base_url('/account/forms/booking-forms'); ?>">View Details</a>
                <div class="small text-white"><i class="ri-arrow-right-circle-fill h5"></i></div>
            </div>
        </div>
    </div>

    <!--Subscription Forms-->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body border-bottom">
                <i class="ri-rss-fill"></i>
                Subscription Forms
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?= base_url('/account/forms/subscription-forms'); ?>">View Details</a>
                <div class="small text-white"><i class="ri-arrow-right-circle-fill h5"></i></div>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
