<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?= lang('App.settings') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<h1 class="mt-4"><?= lang('App.settings') ?></h1>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.settings'))
);
echo generateBreadcrumb($breadcrumb_links);
?>
<div class="row">
    <!--Content-->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body border-bottom">
                <i class="ri-id-card-fill"></i>
                <?= lang('App.update_account_details') ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?= base_url('/account/settings/update-details'); ?>"><?= lang('App.view_details') ?></a>
                <div class="small text-white"><i class="ri-arrow-right-circle-fill h5"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body border-bottom">
                <i class="ri-shield-keyhole-fill"></i>
                <?= lang('App.change_password') ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?= base_url('/account/settings/change-password'); ?>"><?= lang('App.view_details') ?></a>
                <div class="small text-white"><i class="ri-arrow-right-circle-fill h5"></i></div>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
