<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$contact_messageRole = getUserRole($sessionEmail);
?>

<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Contact Messages')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Contact Messages</h3>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                    Contact Messages
                <span class="badge rounded-pill bg-dark">
                    <?= $total_contact_messages ?>
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
                            <th>Country</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($contact_messages): ?>
                            <?php foreach($contact_messages as $contact_message): ?>
                                <tr>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/admin/contact-messages/view-contact/'.$contact_message['contact_message_id'])?>">
                                            <?= $contact_message['is_read'] == 0 ? '<i class="h5 bi bi-dot text-primary"></i>' : ''; ?>
                                            <?= $rowCount; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/admin/contact-messages/view-contact/'.$contact_message['contact_message_id'])?>">
                                        <?= $contact_message['name']; ?>
                                            <span class="d-none"><?= $contact_message['is_read'] == 0 ? 'unread' : ''; ?></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/admin/contact-messages/view-contact/'.$contact_message['contact_message_id'])?>">
                                            <?= $contact_message['email']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/admin/contact-messages/view-contact/'.$contact_message['contact_message_id'])?>">
                                            <?= getCountry($contact_message['ip_address']); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/admin/contact-messages/view-contact/'.$contact_message['contact_message_id'])?>">
                                            <?= dateFormat($contact_message['created_at']); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-content" href="<?=base_url('account/admin/contact-messages/view-contact/'.$contact_message['contact_message_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 email-subscriber" href="mailto:<?= $contact_message['email']; ?>">
                                                    <i class="h5 ri-reply-fill"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-contact" href="javascript:void(0)" onclick="deleteRecord('contact_messages', 'contact_message_id', '<?=$contact_message['contact_message_id'];?>', '', 'account/admin/contact-messages')">
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
