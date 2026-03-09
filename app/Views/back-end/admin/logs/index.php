<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?= lang('App.logs') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.admin'), 'url' => '/account/admin'),
    array('title' => lang('App.logs'))
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3><?= lang('App.logs') ?></h3>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                <?= lang('App.logs') ?>
                <span class="badge rounded-pill bg-dark">
                    <?= $total_logs ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th><?= lang('App.file') ?></th>
                                <th><?= lang('App.level') ?></th>
                                <th><?= lang('App.timestamp') ?></th>
                                <th><?= lang('App.message') ?></th>
                                <th><?= lang('App.actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($logData as $log): ?>
                            <tr>
                                <td><?= esc($log['file']) ?></td>
                                <td><?= esc($log['level']) ?></td>
                                <td><?= esc($log['timestamp']) ?></td>
                                <td><?= esc($log['message']) ?></td>
                                <td>
                                    <div class="row text-center p-1">
                                        <div class="col mb-1">
                                            <a class="text-dark td-none mr-1 mb-1 view-stat" href="<?=base_url('account/admin/logs/view-log/'.esc($log['file']))?>">
                                                <i class="h5 ri-eye-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
        if($total_logs > 100){
            ?>
                <!--Show pagination if more than 100 records-->
                <div class="col-12 text-start">
                    <p><?= lang('App.pagination') ?></p>
                    <?= $pager ?>
                </div>
            <?php
        }
    ?>
<!-- end main content -->
<?= $this->endSection() ?>