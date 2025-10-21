<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Forms', 'url' => '/account/forms'),
    array('title' => 'Subscription Forms')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Subscription Forms</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">

        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                    Subscribers
                <span class="badge rounded-pill bg-dark">
                    <?= $total_subscription_form_submissions ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable-export">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>IP</th>
                            <th>Country</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($subscription_form_submissions): ?>
                            <?php foreach($subscription_form_submissions as $subscriber): ?>
                                <tr>
                                    <td>
                                        <?= $rowCount; ?>
                                    </td>
                                    <td>
                                        <?= $subscriber['name']; ?>
                                    </td>
                                    <td>
                                        <?= $subscriber['email']; ?>
                                    </td>
                                    <td>
                                        <?= $subscriber['status']; ?>
                                    </td>
                                    <td>
                                        <?= $subscriber['ip_address']; ?>
                                    </td>
                                    <td>
                                        <span class="fi fi-<?= strtolower(esc($subscriber['country'])) ?>"></span>
                                        <?= esc($subscriber['country']) ?>
                                    </td>
                                    <td><?= dateFormat($subscriber['created_at']); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-subscriber" href="javascript:void(0)" onclick="deleteRecord('subscription_form_submissions', 'subscription_form_id', '<?=$subscriber['subscription_form_id'];?>', '', 'account/forms/subscription-forms')">
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
