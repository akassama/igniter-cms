<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Normalize data key: accept $booking or $booking_data
$booking = isset($booking) ? $booking : (isset($booking_data) ? $booking_data : []);

// Precompute helpers
$fullName = trim(($booking['name'] ?? '') !== '' ? $booking['name'] : trim(($booking['first_name'] ?? '') . ' ' . ($booking['last_name'] ?? '')));

$hasDate = !empty($booking['appointment_date']);
$hasTime = !empty($booking['appointment_time']);
$apptDateText = $hasDate ? date('M j, Y', strtotime($booking['appointment_date'])) : '';
$apptTimeText = $hasTime ? date('H:i', strtotime($booking['appointment_time'])) : '';
$apptDateTimeLabel = trim($apptDateText . ($apptTimeText ? ' @ ' . $apptTimeText : ''));

$paymentAmountText = isset($booking['payment_amount']) && $booking['payment_amount'] !== null
    ? number_format((float)$booking['payment_amount'], 2)
    : '';

$countryText = !empty($booking['country']) ? getCountryTextName($booking['country']) : '';

$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Forms', 'url' => '/account/forms'),
    array('title' => 'Booking Forms', 'url' => '/account/forms/booking-forms'),
    array('title' => 'View Booking')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Booking</h3>
    </div>

    <form action="#" method="post">
        <div class="col-12 bg-light rounded p-4">
            <div class="row">
                <div class="col-12 mb-3">
                    <?php if (!empty($booking['email'])): ?>
                        <a class="text-dark td-none mr-1 float-start" href="mailto:<?= esc($booking['email']); ?>">
                            <i class="h5 ri-reply-fill"></i> Email
                        </a>
                    <?php endif; ?>

                    <!-- Status badge (read-only visual) with icon -->
                    <?php
                        $status = $booking['status'] ?? '';
                        $badgeClass = 'bg-secondary';
                        $statusIcon = 'ri-time-line';
                        if ($status === 'Confirmed') { $badgeClass = 'bg-success'; $statusIcon = 'ri-calendar-check-fill'; }
                        elseif ($status === 'Pending') { $badgeClass = 'bg-warning'; $statusIcon = 'ri-time-fill'; }
                        elseif ($status === 'Cancelled') { $badgeClass = 'bg-danger'; $statusIcon = 'ri-close-circle-fill'; }
                    ?>

                    <!-- Edit Booking button -->
                    <button type="button"
                            class="btn btn-sm btn-primary float-end ms-2"
                            data-bs-toggle="modal"
                            data-bs-target="#editBookingModal"
                            aria-controls="editBookingModal">
                        <i class="ri-edit-2-line me-1"></i> Edit
                    </button>

                    <?php if (!empty($status)): ?>
                        <span class="badge <?= esc($badgeClass) ?> float-end">
                            <i class="<?= esc($statusIcon) ?> me-1"></i><?= esc($status) ?>
                        </span>
                    <?php endif; ?>

                </div>

                <!-- IDs / Context -->
                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="site_id" class="form-label">Site ID</label>
                    <input type="text" class="form-control" id="site_id" value="<?= esc($booking['site_id'] ?? '') ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="form_name" class="form-label">Form Name</label>
                    <input type="text" class="form-control" id="form_name" value="<?= esc($booking['form_name'] ?? '') ?>" readonly>
                </div>

                <!-- Person -->
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="full_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="full_name" value="<?= esc($fullName) ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" value="<?= esc($booking['email'] ?? '') ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" value="<?= esc($booking['phone'] ?? '') ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" id="country" value="<?= esc($countryText) ?>" readonly>
                </div>

                <!-- Service -->
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="service_id" class="form-label">Service ID</label>
                    <input type="text" class="form-control" id="service_id" value="<?= esc($booking['service_id'] ?? '') ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="service_name" class="form-label">Service Name</label>
                    <input type="text" class="form-control" id="service_name" value="<?= esc($booking['service_name'] ?? '') ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="appointment_date" class="form-label">Appointment Date</label>
                    <input type="text" class="form-control" id="appointment_date" value="<?= esc($apptDateText) ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="appointment_time" class="form-label">Appointment Time</label>
                    <input type="text" class="form-control" id="appointment_time" value="<?= esc($apptTimeText) ?>" readonly>
                </div>

                <!-- Duration / Attendees -->
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="duration" class="form-label">Duration (mins)</label>
                    <input type="text" class="form-control" id="duration" value="<?= esc($booking['duration'] ?? '') ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="number_of_attendees" class="form-label">Attendees</label>
                    <input type="text" class="form-control" id="number_of_attendees" value="<?= esc($booking['number_of_attendees'] ?? '') ?>" readonly>
                </div>

                <!-- Message -->
                <div class="col-sm-12 col-md-12 mb-3">
                    <label for="message" class="form-label">Message</label>
                    <div class="border border-dark rounded p-2" id="message"><?= esc($booking['message'] ?? '') ?></div>
                </div>

                <!-- Resource -->
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="resource_id" class="form-label">Resource ID</label>
                    <input type="text" class="form-control" id="resource_id" value="<?= esc($booking['resource_id'] ?? '') ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="resource_name" class="form-label">Resource Name</label>
                    <input type="text" class="form-control" id="resource_name" value="<?= esc($booking['resource_name'] ?? '') ?>" readonly>
                </div>

                <!-- Payment -->
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="payment_status" class="form-label">Payment Status</label>
                    <input type="text" class="form-control" id="payment_status" value="<?= esc($booking['payment_status'] ?? '') ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <label for="payment_amount" class="form-label">Payment Amount</label>
                    <input type="text" class="form-control" id="payment_amount" value="<?= esc($paymentAmountText) ?>" readonly>
                </div>

                <!-- Meta -->
                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="confirmation_code" class="form-label">Confirmation Code</label>
                    <input type="text" class="form-control" id="confirmation_code" value="<?= esc($booking['confirmation_code'] ?? '') ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="ip_address" class="form-label">IP Address</label>
                    <input type="text" class="form-control" id="ip_address" value="<?= esc($booking['ip_address'] ?? '') ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control" id="status" value="<?= esc($status) ?>" readonly>
                </div>

                <!-- Notes -->
                <div class="col-sm-12 col-md-12 mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="notes" class="form-label mb-0">Notes</label>

                        <!-- Edit Notes button -->
                        <button type="button"
                                class="btn btn-sm btn-outline-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#editNotesModal"
                                aria-controls="editNotesModal">
                            <i class="ri-edit-line me-1"></i> Edit
                        </button>
                    </div>

                    <div class="border border-dark rounded p-2 mt-1" id="notes">
                        <?= esc($booking['notes'] ?? '') ?>
                    </div>
                </div>

                <!-- Hidden -->
                <div>
                    <input type="hidden" id="booking_form_id" name="booking_form_id" value="<?= esc($booking['booking_form_id'] ?? '') ?>" readonly>
                </div>

                <div class="mb-3 mt-3">
                    <a href="<?= base_url('/account/forms/booking-forms') ?>" class="btn btn-outline-danger">
                        <i class="ri-arrow-left-fill"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal: Edit Notes --> 
<div class="modal fade" id="editNotesModal" tabindex="-1" aria-labelledby="editNotesModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="editNotesModalLabel"> <i class="ri-edit-line me-2"></i>Edit Notes </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
         </div>
         <?php echo form_open(base_url('account/forms/booking-forms/edit-notes'), 'method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate'); ?> 
         <div class="modal-body">
            <input type="hidden" name="booking_form_id" value="<?= esc($booking['booking_form_id'] ?? '') ?>"> 
            <div class="col-12">
               <label for="notesTextarea" class="form-label">Notes</label> 
               <textarea class="form-control" id="notesTextarea" name="notes" rows="8" required><?= esc($booking['notes'] ?? '') ?></textarea>
               <div class="invalid-feedback">Please enter some notes or close the editor.</div>
            </div>
         </div>
         <div class="modal-footer"> <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="ri-close-circle-fill me-1"></i>Close </button> <button type="submit" class="btn btn-primary"> <i class="ri-save-3-line me-1"></i> Update </button> </div>
         <?php echo form_close(); ?> 
      </div>
   </div>
</div>

<!-- Modal: Edit Booking -->
<div class="modal fade" id="editBookingModal" tabindex="-1" aria-labelledby="editBookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editBookingModalLabel">
          <i class="ri-edit-2-line me-2"></i>Edit Booking
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <?php echo form_open(base_url('account/forms/booking-forms/edit-booking'), 'method="post" class="needs-validation" enctype="multipart/form-data" novalidate'); ?>
      <div class="modal-body">
        <div class="row g-3">
          <input type="hidden" name="booking_form_id" value="<?= esc($booking['booking_form_id'] ?? '') ?>">

          <div class="col-12 col-md-4">
            <label for="edit_name" class="form-label">Name</label>
            <input type="text" class="form-control" id="edit_name" name="name" value="<?= esc($fullName) ?>">
          </div>
          <div class="col-12 col-md-4">
            <label for="edit_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="edit_email" name="email" value="<?= esc($booking['email'] ?? '') ?>">
          </div>
          <div class="col-12 col-md-4">
            <label for="edit_phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="edit_phone" name="phone" value="<?= esc($booking['phone'] ?? '') ?>">
          </div>

          <div class="col-12 col-md-6">
            <label for="edit_appointment_date" class="form-label">Appointment Date</label>
            <input type="date" class="form-control" id="edit_appointment_date" name="appointment_date" value="<?= esc($booking['appointment_date'] ?? '') ?>">
          </div>
          <div class="col-12 col-md-6">
            <label for="edit_appointment_time" class="form-label">Appointment Time</label>
            <input type="time" class="form-control" id="edit_appointment_time" name="appointment_time" value="<?= esc($booking['appointment_time'] ?? '') ?>">
          </div>

          <div class="col-12 col-md-6">
            <label for="edit_duration" class="form-label">Duration (mins)</label>
            <input type="number" min="0" class="form-control" id="edit_duration" name="duration" value="<?= esc($booking['duration'] ?? '') ?>">
          </div>
          <div class="col-12 col-md-6">
            <label for="edit_attendees" class="form-label">Attendees</label>
            <input type="number" min="1" class="form-control" id="edit_attendees" name="number_of_attendees" value="<?= esc($booking['number_of_attendees'] ?? '') ?>">
          </div>

          <div class="col-12 col-md-6">
            <label for="edit_payment_status" class="form-label">Payment Status</label>
            <?php $payStatus = $booking['payment_status'] ?? 'Unpaid'; ?>
            <select class="form-select" id="edit_payment_status" name="payment_status">
              <?=getDataGroupOptions($payStatus, "BookingFomrPaymentStatus")?>
            </select>
          </div>
          <div class="col-12 col-md-6">
            <label for="edit_payment_amount" class="form-label">Payment Amount</label>
            <input type="number" step="0.01" min="0" class="form-control" id="edit_payment_amount" name="payment_amount" value="<?= esc($booking['payment_amount'] ?? '') ?>">
          </div>

          <div class="col-12 col-md-6">
            <label for="edit_confirmation_code" class="form-label">Confirmation Code</label>
            <input type="text" class="form-control" id="edit_confirmation_code" name="confirmation_code" value="<?= esc($booking['confirmation_code'] ?? '') ?>">
          </div>
          <div class="col-12 col-md-6">
            <label for="edit_status" class="form-label">Status</label>
            <?php $bStatus = $booking['status'] ?? 'Pending'; ?>
            <select class="form-select" id="edit_status" name="status">
              <?=getDataGroupOptions($bStatus, "BookingFomrStatus")?>
            </select>
          </div>

          <div class="col-12">
            <label for="edit_notes" class="form-label">Notes</label>
            <textarea class="form-control" id="edit_notes" name="notes" rows="6"><?= esc($booking['notes'] ?? '') ?></textarea>
          </div>

        </div> </div> <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          <i class="ri-close-circle-fill me-1"></i>Close
        </button>
        <button type="submit" class="btn btn-primary">
          <i class="ri-save-3-line me-1"></i> Save Changes
        </button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>


<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
