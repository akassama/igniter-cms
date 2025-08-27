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
<?= $this->section('title') ?>API Keys<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'API Keys')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage API Keys</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/admin/api-keys/new-api-key')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New API Key
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                API Keys
                <span class="badge rounded-pill bg-dark">
                    <?= $total_api_keys ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>API Key</th>
                            <th>Assigned To</th>
                            <th>Status</th>
                            <th>Created On</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($api_keys): ?>
                            <?php foreach($api_keys as $api_key): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <?= getInputLinkTag($api_key['api_id'], $api_key['api_key']); ?>
                                    </td>
                                    <td>
                                        <span class="text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="User ID: <?= esc($api_key['assigned_to']) ?>">
                                            <?= getActivityBy(esc($api_key['assigned_to'])) ?>
                                        </span>
                                    </td>
                                    <td><?= $api_key['status'] == "1" ? "<span class='badge bg-success'>Active</span>" : "<span class='badge bg-secondary'>Inactive</span>" ?></td>
                                    <td><?= dateFormat($api_key['created_at']) ?></td>
                                    <td><?= getActivityBy(esc($api_key['created_by']) , ""); ?></td>
                                    <td><?= getActivityBy(esc($api_key['updated_by']) , ""); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-api-key" href="<?=base_url('account/admin/api-keys/edit-api-key/'.$api_key['api_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <?php
                                                    if (strtolower($api_key['assigned_to']) != "default") {
                                                        echo '<div class="col mb-1">
                                                                    <a class="text-dark td-none mr-1 remove-api-key" href="#!" onclick="deleteRecord(\'api_accesses\', \'api_id\', \'' . $api_key['api_id'] . '\', \'\', \'account/admin/api-keys\')">
                                                                        <i class="h5 ri-close-circle-fill"></i>
                                                                    </a>
                                                                </div>';
                                                    } else {
                                                    echo '<div class="col mb-1">
                                                                <a class="text-dark td-none mr-1 remove-api-key disabled text-muted" href="javascript:void(0)">
                                                                    <i class="h5 ri-close-circle-fill"></i>
                                                                </a>
                                                            </div>';
                                                    }
                                                ?>
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

<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
