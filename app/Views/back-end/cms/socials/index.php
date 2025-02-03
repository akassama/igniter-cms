<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Socials')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Socials</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/cms/socials/new-social')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Social
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Socials
                <span class="badge rounded-pill bg-dark">
                    <?= $total_socials ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!--Content-->
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
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
                        <?php if($socials): ?>
                            <?php foreach($socials as $social): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $social['name']; ?></td>
                                    <td><?= $social['icon']; ?></td>
                                    <td><?= $social['order']; ?></td>
                                    <td>
                                        <?= getInputLinkTag($social['social_id'], $social['link']); ?>
                                    </td>
                                    <td><?= $social['new_tab'] == "1" ? "Yes" : "No" ?></td>
                                    <td><?= getActivityBy(esc($social['created_by']) , ""); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-social" href="<?=base_url('account/cms/socials/edit-social/'.$social['social_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-social" href="javascript:void(0)" onclick="deleteRecord('socials', 'social_id', '<?=$social['social_id'];?>', '', 'account/cms/socials')">
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
