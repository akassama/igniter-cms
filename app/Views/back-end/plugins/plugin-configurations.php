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
     array('title' => 'Plugins', 'url' => '/account/plugins'),
    array('title' => 'Plugin Configurations')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Plugin Configurations</h3>
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
                                <th>Slug</th>
                                <th>Key</th>
                                <th>Value</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($plugin_configs): ?>
                            <?php foreach($plugin_configs as $config): ?>
                                <?php 
                                    $encryptedLabel = strtolower($config['data_type']) === "secret" ? "<small>(Encrtpted)</small>" : "";    
                                ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $config['plugin_slug']; ?></td>
                                    <td><?= $config['config_key']; ?></td>
                                    <td><?= $config['config_value']; ?></td>
                                    <td><?= $config['created_at']; ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-config" href="javascript:void(0)" onclick="deleteRecord('plugin_configs', 'id', '<?=$appointment['id'];?>', '', 'account/plugins/plugin-configurations')">
                                                    <i class="h5 ri-close-circle-fill"></i>
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
