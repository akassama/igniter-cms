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
<?= $this->section('title') ?><?= lang('App.manage_configurations') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
     array('title' => lang('App.plugins'), 'url' => '/account/plugins'),
    array('title' => lang('App.plugin_configurations'))
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3><?= lang('App.manage_plugin_configs') ?></h3>
    </div>
    <div class="col-12">
        
        <div class="alert alert-warning">
            <strong><?= lang('App.warning') ?></strong> <?= lang('App.plugin_safety_warning') ?>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                <?= lang('App.configurations') ?>
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
                                <th><?= lang('App.plugin_slug') ?></th>
                                <th><?= lang('App.key') ?></th>
                                <th><?= lang('App.value') ?></th>
                                <th><?= lang('App.created_at') ?></th>
                                <th><?= lang('App.actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($plugin_configs): ?>
                            <?php foreach($plugin_configs as $config): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $config['plugin_slug']; ?></td>
                                    <td><?= $config['config_key']; ?></td>
                                    <td><?= $config['config_value']; ?></td>
                                    <td><?= $config['created_at']; ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-blog" onclick="editSwalModal('<?=$config['id']?>', '<?=$config['config_value']?>', '<?=$config['config_key']?>')">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                                <a class="text-dark td-none mr-1 remove-config" href="#!" onclick="deleteRecord('plugin_configs', 'id', '<?=$config['id'];?>', '', 'account/plugins/configurations')">
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
function editSwalModal(pluginConfig_id, configValue, configKey) {
    Swal.fire({
        title: <?= json_encode(lang('App.edit_plugin_config')) ?>,
        html: `
            <form id="editPluginConfigForm" method="POST" action="<?= base_url('/account/plugins/update-plugin-config') ?>">
                <input type="hidden" name="plugin_id" value="${pluginConfig_id}">
                <div class="mb-3">
                    <label for="config_key" class="form-label">Config Key</label>
                    <input type="text" class="form-control" id="config_key" name="config_key" value="${configKey}" readonly>
                </div>
                <div class="mb-3">
                    <label for="config_value" class="form-label">Config Value</label>
                    <input type="text" class="form-control" id="config_value" name="config_value" value="${configValue}">
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: <?= lang('App.update') ?>,
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        reverseButtons: true,
        customClass: {
            popup: 'swal-custom'
        },
        preConfirm: () => {
            const form = document.getElementById('editPluginConfigForm');
            if (form) {
                form.submit();
            }
        }
    });
}
</script>


<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>