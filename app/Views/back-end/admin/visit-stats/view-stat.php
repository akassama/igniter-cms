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
<?= $this->section('title') ?>View Stat<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Visit Stats', 'url' => '/account/admin/visit-stats'),
    array('title' => 'View Stat')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Stat</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <ul class="list-group mb-2">
                <li class="list-group-item">Visit Stat ID: <span><?= $visit_data['site_stat_id'] ?></span></li>
                <li class="list-group-item">Visit By: <span  data-bs-toggle="tooltip" data-bs-placement="top" title="User ID: <?= esc($visit_data['user_id']) ?>"><?= getActivityBy(esc($visit_data['user_id'])) ?></span></li>
                <li class="list-group-item">IP Address: <span><?= $visit_data['ip_address'] ?></span></li>
                <li class="list-group-item">Device Type: <span><?= $visit_data['device_type'] ?></span></li>
                <li class="list-group-item">Browser Type: <span><?= $visit_data['browser_type'] ?></span></li>
                <li class="list-group-item">Page Type: <span><?= $visit_data['page_type'] ?></span></li>
                <li class="list-group-item">Page Visited ID: <span><?= $visit_data['page_visited_id'] ?></span></li>
                <li class="list-group-item">Page Visited URL: <span><?= $visit_data['page_visited_url'] ?></span></li>
                <li class="list-group-item">Referrer: <span><?= $visit_data['referrer'] ?></span></li>
                <li class="list-group-item">Status Code: <span><?= $visit_data['status_code'] ?></span></li>
                <li class="list-group-item">Session ID: <span><?= $visit_data['session_id'] ?></span></li>
                <li class="list-group-item">Request Method: <span><?= $visit_data['request_method'] ?></span></li>
                <li class="list-group-item">Operating System: <span><?= $visit_data['operating_system'] ?></span></li>
                <li class="list-group-item">Country: <span><?= $visit_data['country'] ?></span></li>
                <li class="list-group-item">Screen Resolution: <span><?= $visit_data['screen_resolution'] ?></span></li>
                <li class="list-group-item">User Agent: <span><?= $visit_data['user_agent'] ?></span></li>
                <li class="list-group-item">Other Params: <span><?= $visit_data['other_params'] ?></span></li>
                <li class="list-group-item">Visit Date: <span><?= $visit_data['created_at'] ?></span></li>
            </ul>
            <div class="mb-3">
                <a href="<?= base_url('/account/admin/visit-stats') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
