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
<?= $this->section('title') ?>View Activity<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Activity Logs', 'url' => '/account/admin/activity-logs'),
    array('title' => 'View Activity')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Activity</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <ul class="list-group mb-2">
                <li class="list-group-item">Activity By: <span  data-bs-toggle="tooltip" data-bs-placement="top" title="User ID: <?= esc($activity_data['activity_by']) ?>"><?= getActivityBy(esc($activity_data['activity_by'])) ?></span></li>
                <li class="list-group-item">Activity Type: <span><?= $activity_data['activity_type'] ?></span></li>
                <li class="list-group-item">Activity: <span><?= $activity_data['activity'] ?></span></li>
                <li class="list-group-item">IP Address: <span><?= $activity_data['ip_address'] ?></span></li>
                <li class="list-group-item">Device: <span><?= $activity_data['device'] ?></span></li>
                <li class="list-group-item">Date/Time: <span><?= $activity_data['created_at'] ?></span></li>
            </ul>
            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin/activity-logs') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
