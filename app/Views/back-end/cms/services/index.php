<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Services')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Services</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/cms/services/new-service')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Service
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Services
                <span class="badge rounded-pill bg-dark">
                    <?= $total_services ?>
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
                                <th>Image</th>
                                <th>Icon</th>
                                <th>Order</th>
                                <th>Link</th>
                                <th>New Tab</th>
                                <th>Created By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($services): ?>
                            <?php foreach($services as $service): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $service['title']; ?></td>
                                    <td><?= $service['description']; ?></td>
                                    <td>
                                        <img src="<?= base_url($service['image'] ?? getDefaultImagePath()); ?>" class="rounded" alt="<?= $service['image']; ?>" width="50" height="50">
                                    </td>
                                    <td><?= $service['icon']; ?></td>
                                    <td><?= $service['order']; ?></td>
                                    <td>
                                        <?= getInputLinkTag($service['service_id'], $service['link']); ?>
                                    </td>
                                    <td><?= $service['new_tab'] == "1" ? "Yes" : "No" ?></td>
                                    <td><?= getActivityBy(esc($service['created_by']) , ""); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-service" href="<?=base_url('account/cms/services/edit-service/'.$service['service_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-service" href="javascript:void(0)" onclick="deleteRecord('services', 'service_id', '<?=$service['service_id'];?>', '', 'account/cms/services')">
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
