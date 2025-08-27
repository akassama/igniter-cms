<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Manage Navigations<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Navigations')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Navigations</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/cms/navigations/new-navigation')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Navigation
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Navigations
                <span class="badge rounded-pill bg-dark">
                    <?= $total_navigations ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!--Content-->
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Icon</th>
                            <th>Group</th>
                            <th>Order</th>
                            <th>Parent</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($navigations): ?>
                            <?php foreach($navigations as $navigation): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $navigation['title']; ?></td>
                                    <td><?= $navigation['description']; ?></td>
                                    <td><?= $navigation['icon']; ?></td>
                                    <td><?= $navigation['group']; ?></td>
                                    <td><?= $navigation['order']; ?></td>
                                    <td><?= !empty($navigation['parent']) ? getTableData("navigations", ['navigation_id' => $navigation['navigation_id']], 'title') : "" ?></td>
                                    <td>
                                        <?= getInputLinkTag($navigation['navigation_id'], $navigation['link']); ?>
                                    </td><td><?= $navigation['status'] == "1" ? "<span class='badge bg-success'>Published</span>" : "<span class='badge bg-secondary'>Unpublished</span>" ?></td> 
                                    <td><?= getActivityBy(esc($navigation['created_by']) , ""); ?></td>
                                    <td><?= getActivityBy(esc($navigation['updated_by']) , ""); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-navigation" href="<?=base_url('account/cms/navigations/edit-navigation/'.$navigation['navigation_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-navigation" href="#!" onclick="deleteRecord('navigations', 'navigation_id', '<?=$navigation['navigation_id'];?>', '', 'account/cms/navigations')">
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

<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>