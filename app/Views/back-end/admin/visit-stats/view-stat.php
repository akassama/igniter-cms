<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$userRole = getUserRole($sessionEmail);
?>

<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?= lang('App.view_stat') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.admin'), 'url' => '/account/admin'),
    array('title' => lang('App.visit_stats'), 'url' => '/account/admin/visit-stats'),
    array('title' => lang('App.view_stat'))
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3><?= lang('App.view_stat') ?></h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <ul class="list-group mb-2">
                <li class="list-group-item"><?= lang('App.visit_stat_id') ?>: <span><?= $visit_data['site_stat_id'] ?></span></li>
                <li class="list-group-item"><?= lang('App.visit_by') ?>: <span  data-bs-toggle="tooltip" data-bs-placement="top" title="User ID: <?= esc($visit_data['user_id']) ?>"><?= getActivityBy(esc($visit_data['user_id'])) ?></span></li>
                <li class="list-group-item"><?= lang('App.ip') ?>: <span><?= $visit_data['ip_address'] ?></span></li>
                <li class="list-group-item"><?= lang('App.device_type') ?>: <span><?= $visit_data['device_type'] ?></span></li>
                <li class="list-group-item"><?= lang('App.browser_type') ?>: <span><?= $visit_data['browser_type'] ?></span></li>
                <li class="list-group-item"><?= lang('App.page_type') ?>: <span><?= $visit_data['page_type'] ?></span></li>
                <li class="list-group-item"><?= lang('App.page_visited_id') ?>: <span><?= $visit_data['page_visited_id'] ?></span></li>
                <li class="list-group-item"><?= lang('App.page_visited_url') ?>: <span><?= $visit_data['page_visited_url'] ?></span></li>
                <li class="list-group-item"><?= lang('App.referrer') ?>: <span><?= $visit_data['referrer'] ?></span></li>
                <li class="list-group-item"><?= lang('App.status_code') ?>: <span><?= $visit_data['status_code'] ?></span></li>
                <li class="list-group-item"><?= lang('App.session_id') ?>: <span><?= $visit_data['session_id'] ?></span></li>
                <li class="list-group-item"><?= lang('App.request_method') ?>: <span><?= $visit_data['request_method'] ?></span></li>
                <li class="list-group-item"><?= lang('App.operating_system') ?>: <span><?= $visit_data['operating_system'] ?></span></li>
                <li class="list-group-item"><?= lang('App.country') ?>: <span><?= $visit_data['country'] ?></span></li>
                <li class="list-group-item"><?= lang('App.screen_resolution') ?>: <span><?= $visit_data['screen_resolution'] ?></span></li>
                <li class="list-group-item"><?= lang('App.user_agent') ?>: <span><?= $visit_data['user_agent'] ?></span></li>
                <li class="list-group-item"><?= lang('App.other_params') ?>: <span><?= $visit_data['other_params'] ?></span></li>
                <li class="list-group-item"><?= lang('App.visit_date') ?>: <span><?= $visit_data['created_at'] ?></span></li>
            </ul>
            <div class="mb-3">
                <a href="<?= base_url('/account/admin/visit-stats') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    <?= lang('App.back') ?>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
