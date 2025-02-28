<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Access Denied<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<h1 class="mt-4">Access Denied</h1>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Access Denied')
);
echo generateBreadcrumb($breadcrumb_links);
?>
<div class="row">
    <!--Content-->
    <div class="col-12">
        <div class="card p-2 mb-4">
            <p class="text-danger">
                Access Denied
            </p>
            <p>You do not have permission to access this page.</p>
            <p>Please contact your administrator if you believe this is a mistake.</p>
            <a href="<?= base_url('/account'); ?>">Go Back to Dashboard</a>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
