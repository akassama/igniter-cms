<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Appearance<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<h1 class="mt-4">Appearance</h1>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Appearance')
);
echo generateBreadcrumb($breadcrumb_links);
?>
<div class="row">
    <!--Content-->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body border-bottom">
                <i class="ri-brush-fill"></i>
                Themes
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?= base_url('/account/appearance/themes'); ?>">View Details</a>
                <div class="small text-white"><i class="ri-arrow-right-circle-line h5"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body border-bottom">
                <i class="ri-code-box-line"></i>
                Theme Editor
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?= base_url('/account/appearance/theme-editor'); ?>">View Details</a>
                <div class="small text-white"><i class="ri-arrow-right-circle-line h5"></i></div>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
