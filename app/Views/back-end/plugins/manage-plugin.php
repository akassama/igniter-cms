<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Manage Plugins<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Plugins', 'url' => '/account/plugins'),
    array('title' => 'Manage Plugin')
);
echo generateBreadcrumb($breadcrumb_links);
?>
<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Plugin - <?=$pluginName?></h3>
    </div>
    <!--Content-->
    <div class="col-12">
        <div class="card p-2 mb-4 plugin-card">
            <?php if ($pluginManageFile): ?>
                <?php include($pluginManageFile); ?>
            <?php else: ?>
                <div class="alert alert-info">No management interface available for this plugin.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>