<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?= lang('App.unsubscribed') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.forms'), 'url' => '/account/forms'),
    array('title' => 'Subscription Forms (Unsubscribed)')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Subscription Forms (Unsubscribed)</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="ri-grid-line me-1"></i>
                    <?= lang('App.unsubscribed') ?>
                    <span class="badge rounded-pill bg-dark">
                        <?= $total_subscription_form_submissions ?>
                    </span>
                </div>

                <div>
                    <a href="<?= base_url('account/forms/subscription-forms'); ?>" 
                    class="btn btn-sm btn-outline-secondary">
                        <i class="ri-notification-2-fill text-success me-1"></i> View Subscribed
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable-export">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?= lang('App.form_name') ?></th>
                            <th><?= lang('App.name') ?></th>
                            <th><?= lang('App.email') ?></th>
                            <th><?= lang('App.status') ?></th>
                            <th><?= lang('App.ip') ?></th>
                            <th><?= lang('App.country') ?></th>
                            <th>Unsubscribed At</th>
                            <th><?= lang('App.created_on') ?></th>
                            <th><?= lang('App.actions') ?></th>
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
                                        <?= $subscriber['form_name']; ?>
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
                                        <span class="fi fi-<?= strtolower((string)esc($subscriber['country'])) ?>"></span>
                                        <?= esc($subscriber['country']) ?>
                                    </td>
                                    <td><?= dateFormat($subscriber['unsubscribed_at']); ?></td>
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