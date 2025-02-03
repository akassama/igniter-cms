<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$userRole = getUserRole($sessionEmail);
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
    array('title' => 'Contact Messages', 'url' => '/account/admin/contact-messages'),
    array('title' => 'View Contact Message')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Contact Message</h3>
    </div>
    <form action="#" method="post">
        <div class="col-12 bg-light rounded p-4">
            <div class="row">
                <div class="col-12 mb-3">
                    <a class="text-dark td-none mr-1 email-subscriber float-start" href="mailto:<?= $contact_message_data['email']; ?>">
                        <i class="h5 ri-reply-fill"></i> Reply
                    </a>
                    <div class="form-check form-switch float-end">
                        <input class="form-check-input" type="checkbox" role="switch" id="read_status" name="read_status" value="1" <?= $contact_message_data['is_read'] == 0 ? 'checked' : ''; ?>
                            hx-post="<?=base_url()?>/htmx/set-message-read-status"
                            hx-trigger="click, changed delay:250ms">
                        <label class="form-check-label" for="read_status">Mark as Read/Unread</label>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $contact_message_data['name'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" minlength="6" maxlength="20" value="<?= $contact_message_data['email'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" value="<?= $contact_message_data['subject'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-12 mb-3">
                    <label for="message" class="form-label">Message</label>
                    <div class="border border-dark rounded p-2" id="message" name="message"><?= $contact_message_data['message'] ?></div>
                </div>

                <!--hidden-->
                <div>
                    <input type="hidden" class="form-control" id="contact_message_id" name="contact_message_id" value="<?= $contact_message_data['contact_message_id'] ?>" readonly>
                </div>

                <div class="mb-3 mt-3">
                    <a href="<?= base_url('/account/admin/contact-messages') ?>" class="btn btn-outline-danger">
                        <i class="ri-arrow-left-fill"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
