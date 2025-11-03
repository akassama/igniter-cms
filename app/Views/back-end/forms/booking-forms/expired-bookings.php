<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Expired Bookings<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Forms', 'url' => '/account/forms'),
    array('title' => 'Expired Booking Forms')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Expired Bookings</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="ri-grid-line me-1"></i>
                    Bookings
                    <span class="badge rounded-pill bg-dark">
                        <?= $total_booking_form_submissions ?>
                    </span>
                </div>

                <div>
                    <a href="<?= base_url('account/forms/booking-forms'); ?>" 
                    class="btn btn-sm btn-outline-secondary">
                        <i class="ri-calendar-check-fill text-success me-1"></i> Active Bookings
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
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>No. of Attendees</th>
                                <th>Message</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($booking_form_submissions): ?>
                            <?php foreach($booking_form_submissions as $booking): ?>
                                <tr>
                                    <td>
                                        <?= $rowCount; ?>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/booking-forms/view-booking/'.$booking['booking_form_id'])?>">
                                            <?= $booking['form_name']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/booking-forms/view-booking/'.$booking['booking_form_id'])?>">
                                            <?= $booking['name']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/booking-forms/view-booking/'.$booking['booking_form_id'])?>">
                                            <?= $booking['email']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/booking-forms/view-booking/'.$booking['booking_form_id'])?>">
                                            <?= $booking['phone']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/booking-forms/view-booking/'.$booking['booking_form_id'])?>">
                                            <?= $booking['appointment_date']; ?>
                                            <div class="mt-2">
                                                <?=getBookingDateBadge($booking['appointment_date'])?>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/booking-forms/view-booking/'.$booking['booking_form_id'])?>">
                                            <?= $booking['appointment_time']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/booking-forms/view-booking/'.$booking['booking_form_id'])?>">
                                            <?= $booking['number_of_attendees']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/booking-forms/view-booking/'.$booking['booking_form_id'])?>">
                                            <?= $booking['message']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/forms/booking-forms/view-booking/'.$booking['booking_form_id'])?>">
                                            <?= dateFormat($booking['created_at']); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-booking" href="<?=base_url('account/forms/booking-forms/view-booking/'.$booking['booking_form_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-booking" href="javascript:void(0)" onclick="deleteRecord('booking_form_submissions', 'booking_form_id', '<?=$booking['booking_form_id'];?>', '', 'account/forms/booking-forms')">
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
