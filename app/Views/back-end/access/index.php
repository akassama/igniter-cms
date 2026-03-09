<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?=lang('App.access_denied');?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<h1 class="mt-4"><?=lang('App.access_denied');?></h1>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.access_denied'))
);
echo generateBreadcrumb($breadcrumb_links);
?>
<div class="row">
    <!--Content-->
    <div class="col-12">
        <div class="card p-2 mb-4">
            <p class="text-danger">
                <i class="ri-error-warning-line me-2"></i> <?=lang('App.access_denied');?>
            </p>
            <p><?=lang('App.contact_admin_error');?></p>
            <p><?=lang('App.contact_admin_error');?></p>
            <a href="<?= base_url('/account'); ?>"><?=lang('App.go_to_dashboard');?></a>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
