<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?= lang('App.cms') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<h1 class="mt-4"><?= lang('App.cms') ?></h1>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.cms'))
);
echo generateBreadcrumb($breadcrumb_links);
?>
<div class="row">
    <!--Content-->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body border-bottom">
                <i class="ri-newspaper-fill"></i>
                <?= lang('App.blogs') ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?= base_url('/account/cms/blogs'); ?>"><?= lang('App.view_details') ?></a>
                <div class="small text-white"><i class="ri-arrow-right-circle-line h5"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body border-bottom">
                <i class="ri-menu-search-line"></i>
                <?= lang('App.categories') ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?= base_url('/account/cms/categories'); ?>"><?= lang('App.view_details') ?></a>
                <div class="small text-white"><i class="ri-arrow-right-circle-line h5"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body border-bottom">
                <i class="ri-link"></i>
                <?= lang('App.navigations') ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?= base_url('/account/cms/navigations'); ?>"><?= lang('App.view_details') ?></a>
                <div class="small text-white"><i class="ri-arrow-right-circle-line h5"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body border-bottom">
                <i class="ri-article-line"></i>
                <?= lang('App.pages') ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?= base_url('/account/cms/pages'); ?>"><?= lang('App.view_details') ?></a>
                <div class="small text-white"><i class="ri-arrow-right-circle-line h5"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body border-bottom">
                <i class="ri-database-line"></i>
                <?= lang('App.data_groups') ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?= base_url('/account/cms/data-groups'); ?>"><?= lang('App.view_details') ?></a>
                <div class="small text-white"><i class="ri-arrow-right-circle-line h5"></i></div>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
