<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Manage Pricings<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Pricings')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Pricings</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/cms/pricings/new-pricing')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Pricing
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Pricings
                <span class="badge rounded-pill bg-dark">
                    <?= $total_pricings = 0 ?><!--TODO Remove-->
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
                            <th>Currency</th>
                            <th>Amount</th>
                            <th>Link Title</th>
                            <th>Link</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($pricings): ?>
                            <?php foreach($pricings as $pricing): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $pricing['title']; ?></td>
                                    <td><?= $pricing['currency']; ?></td>
                                    <td><?= $pricing['amount']; ?></td>
                                    <td><?= $pricing['link']; ?></td>
                                    <td>
                                        <?= getInputLinkTag($pricing['pricing_id'], $pricing['link']); ?>
                                    </td>
                                    <td><?= $pricing['order']; ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-pricing" href="<?=base_url('account/cms/pricings/view-pricing/'.$pricing['pricing_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-pricing-block" href="<?=base_url('account/cms/pricings/edit-pricing/'.$pricing['pricing_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-pricing-block" href="javascript:void(0)" onclick="deleteRecord('pricings', 'pricing_id ', '<?=$pricing['pricing_id'];?>', '', 'account/cms/pricing-blocks')">
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
