<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Manage Data Groups<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Data Groups')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Data Groups</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/cms/data-groups/new-data-group')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Data Group
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Data Groups
                <span class="badge rounded-pill bg-dark">
                    <?= $total_data_groups ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!--Content-->
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Data Group For</th>
                                <th>Data Group List</th>
                                <th>Created By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($data_groups): ?>
                            <?php foreach($data_groups as $data_group): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $data_group['data_group_for']; ?></td>
                                    <td><?= $data_group['data_group_list']; ?></td>
                                  
                                    <td><?= getActivityBy(esc($data_group['created_by']) , ""); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-data-group" href="<?=base_url('account/cms/data-groups/edit-data-group/'.$data_group['data_group_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <?php
                                            if ($data_group['deletable'] == 1) {
                                                echo '<div class="col mb-1">
                                                            <a class="text-dark td-none mr-1 remove-data-group" href="#!" onclick="deleteRecord(\'data_groups\', \'data_group_id\', \'' . $data_group['data_group_id'] . '\', \'\', \'account/cms/data-groups\')">
                                                                <i class="h5 ri-close-circle-fill"></i>
                                                            </a>
                                                        </div>';
                                            } else {
                                            echo '<div class="col mb-1">
                                                        <a class="text-dark td-none mr-1 remove-data-group disabled text-muted" href="javascript:void(0)">
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

<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
