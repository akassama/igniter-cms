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
<?= $this->section('title') ?>Manage Configurations<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Configurations')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Configurations</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/admin/configurations/new-config')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Configuration
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Configurations
                <span class="badge rounded-pill bg-dark">
                    <?= $total_configurations ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Config For</th>
                                <th>Value</th>
                                <th>Group</th>
                                <th>Last Modified</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($configurations): ?>
                            <?php foreach($configurations as $config): ?>
                                <?php 
                                    $encryptedLabel = strtolower($config['data_type']) === "secret" ? "<small>(Encrtpted)</small>" : "";    
                                ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="<?= htmlspecialchars($config['description']); ?>">
                                            <i class="<?= $config['icon']; ?>"></i>
                                            <?= $config['config_for']; ?>
                                        </span>
                                    </td>
                                    <td class="text-break text-wrap">
                                        <?php $configValue = !empty($config['config_value']) ? $config['config_value'] : "--"?>
                                        <?= htmlspecialchars($configValue);?>
                                        <?= $encryptedLabel ?>
                                        <div class="alert alert-light">
                                            <span class="text-muted small"><i class="ri-information-line description-icon"></i> <?= $config['description']; ?></span>
                                        </div>
                                        <span class="d-none"><?= $config['search_terms']; ?></span>
                                    </td>
                                    <td><?= $config['group']; ?></td>
                                    <td><?= $config['updated_at']; ?></td>
                                    <td><?= getActivityBy(esc($config['created_by']) , ""); ?></td>
                                    <td><?= getActivityBy(esc($config['updated_by']) , ""); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-content" href="<?=base_url('account/admin/configurations/view-config/'.$config['config_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-config" href="<?=base_url('account/admin/configurations/edit-config/'.$config['config_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <?php
                                                if ($config['deletable'] == 1) {
                                                    echo '<div class="col mb-1">
                                                                <a class="text-dark td-none mr-1 remove-config" href="#!" onclick="deleteRecord(\'configurations\', \'config_id\', \'' . $config['config_id'] . '\', \'\', \'account/admin/configurations\')">
                                                                    <i class="h5 ri-close-circle-fill"></i>
                                                                </a>
                                                            </div>';
                                                } else {
                                                echo '<div class="col mb-1">
                                                            <a class="text-dark td-none mr-1 remove-config disabled text-muted" href="javascript:void(0)">
                                                                <i class="h5 ri-close-circle-fill"></i>
                                                            </a>
                                                        </div>';
                                                }
                                            ?>
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

<script>
$(document).ready(function () {
    setTimeout(function () {
        // Get the key value from URL
        const urlParams = new URLSearchParams(window.location.search);
        const searchValue = urlParams.get('dt-key') || '';
        
        // If key exists, set it as the datatable search value
        if (searchValue) {
             $('#dt-search-0').val(searchValue).focus(); 
        }    
    }, 800);
});
</script>


<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
