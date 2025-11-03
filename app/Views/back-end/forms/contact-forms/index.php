<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Conctact Messages<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Forms', 'url' => '/account/forms'),
    array('title' => 'Contact Form Messages')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Contact Form Messages</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="ri-grid-line me-1"></i>
                    Contact Messages
                    <span class="badge rounded-pill bg-dark">
                        <?= $total_contact_form_submissions ?>
                    </span>
                </div>

                <div>
                    <a href="<?= base_url('account/forms/contact-forms/archived'); ?>" 
                    class="btn btn-sm btn-outline-secondary">
                        <i class="ri-archive-fill me-1"></i> View Archived
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable-export">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Form Name</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>IP</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($contact_form_submissions): ?>
                            <?php foreach($contact_form_submissions as $contact_message): ?>
                                <tr>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/contact-forms/view-contact/'.$contact_message['contact_form_id'])?>">
                                            <?= $contact_message['is_read'] == 0 ? '<i class="h5 bi bi-dot text-primary"></i>' : ''; ?>
                                            <?= $rowCount; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/contact-forms/view-contact/'.$contact_message['contact_form_id'])?>">
                                            <?= $contact_message['form_name']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/contact-forms/view-contact/'.$contact_message['contact_form_id'])?>">
                                            <?= $contact_message['name']; ?>
                                            <span class="d-none"><?= $contact_message['is_read'] == 0 ? 'unread' : ''; ?></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/contact-forms/view-contact/'.$contact_message['contact_form_id'])?>">
                                            <?= $contact_message['email']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/contact-forms/view-contact/'.$contact_message['contact_form_id'])?>">
                                            <?= $contact_message['ip_address']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/contact-forms/view-contact/'.$contact_message['contact_form_id'])?>">
                                            <span class="fi fi-<?= strtolower(esc($contact_message['country'])) ?>"></span>
                                            <?= esc($contact_message['country']) ?>
                                        </a>
                                    </td>
                                    <!-- Status badge (read-only visual) with icon -->
                                    <?php
                                        $status = $contact_message['status'] ?? '';
                                        $badgeClass = 'bg-secondary';
                                        $statusIcon = 'ri-time-line';
                                        if ($status === 'New') { $badgeClass = 'bg-success'; $statusIcon = 'ri-calendar-check-fill'; }
                                        elseif ($status === 'In Progress') { $badgeClass = 'bg-warning'; $statusIcon = 'ri-time-fill'; }
                                        elseif ($status === 'Resolved') { $badgeClass = 'bg-primary'; $statusIcon = 'ri-close-circle-fill'; }
                                        elseif ($status === 'Archived') { $badgeClass = 'bg-danger'; $statusIcon = 'ri-close-circle-fill'; }
                                    ?>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/contact-forms/view-contact/'.$contact_message['contact_form_id'])?>">
                                            <span class="badge <?= esc($badgeClass) ?>">
                                                <i class="<?= esc($statusIcon) ?> me-1"></i><?= esc($status) ?>
                                            </span>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/contact-forms/view-contact/'.$contact_message['contact_form_id'])?>">
                                            <?= dateFormat($contact_message['created_at']); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-contact" href="<?=base_url('account/forms/contact-forms/view-contact/'.$contact_message['contact_form_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 email-subscriber" href="mailto:<?= $contact_message['email']; ?>">
                                                    <i class="h5 ri-reply-fill"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 archive-contact" href="<?=base_url('account/forms/contact-forms/archive-contact/'.$contact_message['contact_form_id'])?>">
                                                    <i class="h5 ri-archive-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-contact" href="javascript:void(0)" onclick="deleteRecord('contact_form_submissions', 'contact_form_id', '<?=$contact_message['contact_form_id'];?>', '', 'account/forms/contact-forms')">
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
