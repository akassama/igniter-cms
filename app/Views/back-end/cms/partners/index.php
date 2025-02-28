<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Manage Partners<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Partners')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Partners</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/cms/partners/new-partner')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Partner
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Partners
                <span class="badge rounded-pill bg-dark">
                    <?= $total_partners ?>
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
                                <th>Logo</th>
                                <th>Link</th>
                                <th>New Tab</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($partners): ?>
                            <?php foreach($partners as $partner): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $partner['title']; ?></td>
                                    <td>
                                        <img loading="lazy" src="<?= base_url($partner['logo'] ?? getDefaultImagePath()); ?>" class="rounded img-thumbnail" alt="<?= $partner['logo']; ?>" width="75">
                                    </td>
                                    <td>
                                        <?= getInputLinkTag($partner['partner_id'], $partner['link']); ?>
                                    </td>
                                    <td><?= $partner['new_tab'] == "1" ? "Yes" : "No" ?></td>
                                    <td><?= getActivityBy(esc($partner['created_by']) , ""); ?></td>
                                    <td><?= getActivityBy(esc($partner['updated_by']) , ""); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-partner" href="<?=base_url('account/cms/partners/edit-partner/'.$partner['partner_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-partner" href="javascript:void(0)" onclick="deleteRecord('partners', 'partner_id', '<?=$partner['partner_id'];?>', '', 'account/cms/partners')">
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
