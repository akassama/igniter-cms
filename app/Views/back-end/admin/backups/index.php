<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Backups<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Backups')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Backups</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?= base_url('account/admin/backups/download-public-folder-backup')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-folder-download-fill"></i> Generate Public Folder Backup
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
        <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Database Backups
                <span class="badge rounded-pill bg-dark">
                    <?= $total_backups ?>
                </span>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="<?= base_url('account/admin/backups/generate-db-backup')?>" class="btn btn-outline-primary btn-block">
                        <i class="ri-database-2-fill"></i>
                        Generate Backup
                    </a>
                </div>
                <div class="col-12 mt-4">
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Created By</th>
                                <th>Date Created</th>
                                <th>Created By</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $rowCount = 1; ?>
                            <?php if($backups): ?>
                                <?php foreach($backups as $backup): ?>
                                    <tr>
                                        <td><?= $rowCount; ?></td>
                                        <td>
                                            <span class="text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="User ID: <?= esc($backup['created_by']) ?>">
                                                <?= getActivityBy(esc($backup['created_by'])) ?>
                                            </span>
                                        </td>
                                        <td><?= esc($backup['created_at']) ?></td>
                                        <td><?= getActivityBy(esc($backup['created_by']) , ""); ?></td>
                                        <td>
                                            <div class="row text-center p-1">
                                                <div class="col mb-1">
                                                    <a class="text-dark td-none mr-1 remove-backup" href="#!" onclick="deleteBackup('backups', 'backup_id', '<?=$backup['backup_id'];?>', '<?=$backup['backup_file_path'];?>', 'account/admin/backups')">
                                                        <i class="h5 ri-close-circle-fill"></i>
                                                    </a>
                                                </div>
                                                <div class="col mb-1">
                                                    <a class="text-dark td-none mr-1 mb-1 download-btn" href="<?= base_url('account/admin/backups/download-db/' . $backup['backup_file_path']) ?>">
                                                        <i class="h5 ri-download-2-line"></i>
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
    </div>
</div>

<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_backup_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
