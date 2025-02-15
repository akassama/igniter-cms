<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Counters')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Counters</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/cms/counters/new-counter')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Counter
        </a>
    </div>
    
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Counters
                <span class="badge rounded-pill bg-dark">
                    <?= $total_counters ?>
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
                                <th>Initial Count</th>
                                <th>Final Count</th>
                                <th>Extra Text</th>
                                <th>Link</th>
                                <th>New Tab</th>
                                <th>Created By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($counters): ?>
                            <?php foreach($counters as $counter): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $counter['title']; ?></td>
                                    <td><?= $counter['description']; ?></td>
                                    <td><?= $counter['initial_value']; ?></td>
                                    <td><?= $counter['final_value']; ?></td>
                                    <td><?= $counter['extra_text']; ?></td>
                                    <td>
                                        <?= getInputLinkTag($counter['counter_id'], $counter['link']); ?>
                                    </td>
                                    <td><?= $counter['new_tab'] == "1" ? "Yes" : "No" ?></td>
                                    <td><?= getActivityBy(esc($counter['created_by']) , ""); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-counter" href="<?=base_url('account/cms/counters/edit-counter/'.$counter['counter_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-counter" href="javascript:void(0)" onclick="deleteRecord('counters', 'counter_id', '<?=$counter['counter_id'];?>', '', 'account/cms/counters')">
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
