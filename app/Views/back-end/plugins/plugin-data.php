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
<?= $this->section('title') ?>Manage Data<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
     array('title' => 'Plugins', 'url' => '/account/plugins'),
    array('title' => 'Plugin Data')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Plugin Data</h3>
    </div>
    <div class="col-12">
        
        <div class="alert alert-warning">
            <strong>Warning!</strong> This page allows direct access to your site plugin data settings. You can break things here. Please be cautious!.
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Plugin Data
                <span class="badge rounded-pill bg-dark">
                    <?= $total_plugin_data ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Plugin Slug</th>
                                <th class="w-50">Plugin Data</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($plugin_data): ?>
                            <?php foreach($plugin_data as $data): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $data['plugin_slug']; ?></td>
                                    <td>
                                        <div id="accordion">
                                            <div class="card">
                                            <div class="card-header">
                                                <a class="collapsed btn" data-bs-toggle="collapse" href="#collapse-<?=$rowCount?>">
                                                View Data
                                            </a>
                                            </div>
                                                <div id="collapse-<?=$rowCount?>" class="collapse" data-bs-parent="#accordion">
                                                    <div class="card-body">
                                                        <ul class="list-group list-group-numbered">
                                                            <li class="list-group-item"><?= $data['plugin_data_1']; ?></li>
                                                            <li class="list-group-item"><?= $data['plugin_data_2']; ?></li>
                                                            <li class="list-group-item"><?= $data['plugin_data_3']; ?></li>
                                                            <li class="list-group-item"><?= $data['plugin_data_4']; ?></li>
                                                            <li class="list-group-item"><?= $data['plugin_data_5']; ?></li>
                                                            <li class="list-group-item"><?= $data['plugin_data_6']; ?></li>
                                                            <li class="list-group-item"><?= $data['plugin_data_7']; ?></li>
                                                            <li class="list-group-item"><?= $data['plugin_data_8']; ?></li>
                                                            <li class="list-group-item"><?= $data['plugin_data_9']; ?></li>
                                                            <li class="list-group-item"><?= $data['plugin_data_10']; ?></li>
                                                            <li class="list-group-item"><?= $data['plugin_data_11']; ?></li>
                                                            <li class="list-group-item"><?= $data['plugin_data_12']; ?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $data['created_at']; ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-blog"
                                                    onclick="editDataSwalModal(
                                                        '<?=$data['id']?>',
                                                        '<?=$data['plugin_slug']?>',
                                                        '<?=$data['plugin_data_1']?>',
                                                        '<?=$data['plugin_data_2']?>',
                                                        '<?=$data['plugin_data_3']?>',
                                                        '<?=$data['plugin_data_4']?>',
                                                        '<?=$data['plugin_data_5']?>',
                                                        '<?=$data['plugin_data_6']?>',
                                                        '<?=$data['plugin_data_7']?>',
                                                        '<?=$data['plugin_data_8']?>',
                                                        '<?=$data['plugin_data_9']?>',
                                                        '<?=$data['plugin_data_10']?>',
                                                        '<?=$data['plugin_data_11']?>',
                                                        '<?=$data['plugin_data_12']?>'
                                                    )">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>

                                                <a class="text-dark td-none mr-1 remove-config" href="#!" onclick="deleteRecord('plugin_data', 'id', '<?=$data['id'];?>', '', 'account/plugins/data')">
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
function editDataSwalModal(
    pluginDataId,
    pluginSlug,
    pluginData1,
    pluginData2,
    pluginData3,
    pluginData4,
    pluginData5,
    pluginData6,
    pluginData7,
    pluginData8,
    pluginData9,
    pluginData10,
    pluginData11,
    pluginData12
) {
    Swal.fire({
        title: 'Edit Plugin Configuration',
        html: `
            <div class="swal-form-wrapper" style="text-align:left; max-height:65vh; overflow-y:auto;">
                <form id="editPluginConfigForm" method="POST" action="<?= base_url('/account/plugins/update-plugin-dada') ?>">
                    <input type="hidden" name="plugin_id" id="plugin_id" value="${pluginDataId}">
                    <input type="hidden" name="plugin_slug" id="plugin_id" value="${pluginSlug}">

                    ${[
                        pluginData1, pluginData2, pluginData3, pluginData4, pluginData5, pluginData6,
                        pluginData7, pluginData8, pluginData9, pluginData10, pluginData11, pluginData12
                    ].map((value, i) => {
                        const index = i + 1;
                        return `
                            <div class="mb-3 text-start">
                                <label for="plugin_data_${index}" class="form-label">Plugin Data ${index}</label>
                                <input type="text" class="form-control" id="plugin_data_${index}" name="plugin_data_${index}" value="${value}">
                            </div>
                        `;
                    }).join('')}
                </form>
            </div>
        `,
        width: '70vw', // Increased modal width
        showCancelButton: true,
        confirmButtonText: 'Update',
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
