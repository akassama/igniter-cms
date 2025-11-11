<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>View Contact Messages<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Forms', 'url' => '/account/forms'),
    array('title' => 'Contact Forms', 'url' => '/account/forms/contact-forms'),
    array('title' => 'View Contact Form')
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

                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="site_id" class="form-label">Site ID</label>
                    <input type="text" class="form-control" id="site_id" name="site_id" value="<?= $contact_message_data['site_id'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="form_name" class="form-label">Form Name</label>
                    <input type="text" class="form-control" id="form_name" name="form_name" maxlength="200" value="<?= $contact_message_data['form_name'] ?>" readonly>
                </div>

                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $contact_message_data['name'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" minlength="6" maxlength="20" value="<?= $contact_message_data['email'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" minlength="6" maxlength="20" value="<?= $contact_message_data['phone'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" value="<?= $contact_message_data['subject'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="service" class="form-label">Service</label>
                    <input type="text" class="form-control" id="service" name="service" value="<?= $contact_message_data['service'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-12 mb-3">
                    <label for="message" class="form-label">Message</label>
                    <div class="border border-dark rounded p-2" id="message" name="message"><?= $contact_message_data['message'] ?></div>
                </div>

                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="company" class="form-label">Company</label>
                    <input type="text" class="form-control" id="company" name="company" value="<?= $contact_message_data['company'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="website" class="form-label">Website</label>
                    <input type="text" class="form-control" id="website" name="website" minlength="6" maxlength="20" value="<?= $contact_message_data['website'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="ip_address" class="form-label">IP Address</label>
                    <input type="text" class="form-control" id="ip_address" name="ip_address" minlength="6" maxlength="20" value="<?= $contact_message_data['ip_address'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" id="country" name="country" value="<?= getCountryTextName($contact_message_data['country']) ?>" readonly>
                </div>

                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="user_agent" class="form-label">User Agent</label>
                    <input type="text" class="form-control" id="user_agent" name="user_agent" value="<?= $contact_message_data['user_agent'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="referrer" class="form-label">Referrer</label>
                    <input type="text" class="form-control" id="referrer" name="referrer" minlength="6" maxlength="20" value="<?= $contact_message_data['referrer'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="is_archived" class="form-label">Is Archived</label>
                    <?php $isArchived = $contact_message_data['is_archived'] == 0 ? "No" : "Yes" ?>
                    <input type="text" class="form-control" id="is_archived" name="is_archived" minlength="6" maxlength="20" value="<?= $isArchived ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="status" class="form-label mb-0">Status</label>

                        <!-- Edit button opens modal -->
                        <button type="button"
                                class="btn btn-sm btn-outline-secondary mb-1"
                                data-bs-toggle="modal"
                                data-bs-target="#editStatusModal"
                                aria-controls="editStatusModal">
                            <i class="ri-edit-line me-1"></i> Edit
                        </button>
                    </div>
                    <input type="text" class="form-control" id="status" name="status" minlength="6" maxlength="20" value="<?= $contact_message_data['status'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-12 mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="notes" class="form-label mb-0">Notes</label>

                        <!-- Edit button opens modal -->
                        <button type="button"
                                class="btn btn-sm btn-outline-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#editNotesModal"
                                aria-controls="editNotesModal">
                            <i class="ri-edit-line me-1"></i> Edit
                        </button>
                    </div>

                    <div class="border border-dark rounded p-2 mt-1" id="notes" name="notes">
                        <?= esc($contact_message_data['notes']); ?>
                    </div>
                </div>


                <!--hidden-->
                <div>
                    <input type="hidden" class="form-control" id="contact_form_id" name="contact_form_id" value="<?= $contact_message_data['contact_form_id'] ?>" readonly>
                </div>

                <div class="mb-3 mt-3">
                    <a href="<?= base_url('/account/forms/contact-forms') ?>" class="btn btn-outline-danger">
                        <i class="ri-arrow-left-fill"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Status Modal -->
<div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editStatusModalLabel">
          <i class="ri-edit-line me-2"></i>Edit Status
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <?php echo form_open(base_url('account/forms/contact-forms/edit-status'), 'method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate'); ?>
        <div class="modal-body">
            <!-- Hidden: which contact/message to update -->
            <input type="hidden" name="contact_form_id" value="<?= esc($contact_message_data['contact_form_id']); ?>">

            <!-- Status -->
            <div class="col-12 col-md-6">
                <label for="edit_status" class="form-label">Status</label>
                <?php $cStatus = $contact_message_data['status'] ?? 'Pending'; ?>
                <select class="form-select" id="edit_status" name="status">
                <?=getDataGroupOptions($cStatus, "ContactFormStatus")?>
                </select>
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            <i class="ri-close-circle-fill me-1"></i>Close
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="ri-save-3-line me-1"></i> Update
          </button>
        </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Notes Modal -->
<div class="modal fade" id="editNotesModal" tabindex="-1" aria-labelledby="editNotesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editNotesModalLabel">
          <i class="ri-edit-line me-2"></i>Edit Notes
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <?php echo form_open(base_url('account/forms/contact-forms/edit-notes'), 'method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate'); ?>
        <div class="modal-body">
            <!-- Hidden: which contact/message to update -->
            <input type="hidden" name="contact_form_id" value="<?= esc($contact_message_data['contact_form_id']); ?>">

            <!-- Notes textarea -->
            <div class="col-12">
                <label for="notesTextarea" class="form-label">Notes</label>
                <textarea class="form-control" id="notesTextarea" name="notes" rows="8" required><?= esc($contact_message_data['notes']); ?></textarea>
                <div class="invalid-feedback">Please enter some notes or close the editor.</div>
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            <i class="ri-close-circle-fill me-1"></i>Close
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="ri-save-3-line me-1"></i> Update
          </button>
        </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
