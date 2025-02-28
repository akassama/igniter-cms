<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Activity Logs<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Activity Logs')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Activity Logs</h3>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Activities
                <span class="badge rounded-pill bg-dark">
                    <?= $total_activities ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Activity By</th>
                            <th>Activity Type</th>
                            <th>Activity</th>
                            <th>IP Address</th>
                            <th>Device</th>
                            <th>Country</th>
                            <th>Date/Time</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($activity_logs): ?>
                            <?php foreach($activity_logs as $activity): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <span class="text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="User ID: <?= esc($activity['activity_by']) ?>">
                                            <?= getActivityBy(esc($activity['activity_by'])) ?>
                                        </span>
                                    </td>
                                    <td><?= esc($activity['activity_type']) ?></td>
                                    <td><?= esc($activity['activity']) ?></td>
                                    <td><?= esc($activity['ip_address']) ?></td>
                                    <td><?= esc($activity['device']) ?></td>
                                    <td>
                                        <span class="fi fi-<?= strtolower(esc($activity['country'])) ?>"></span>
                                        <?= esc($activity['country']) ?>
                                    </td>
                                    <td><?= esc($activity['created_at']) ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-activity" href="<?=base_url('account/admin/activity-logs/view-activity/'.esc($activity['activity_id']))?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php $rowCount++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
        if($total_activities > 1000){
            ?>
                <!--Show pagination if more than 1000 records-->
                <div class="col-12 text-start">
                    <p>Pagination</p>
                    <?= $pager->links('default', 'bootstrap') ?>
                </div>
            <?php
        }
    ?>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
