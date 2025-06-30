<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$bookingRole = getUserRole($sessionEmail);
?>

<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Bookings<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Bookings')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Bookings</h3>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                    Bookings
                <span class="badge rounded-pill bg-dark">
                    <?= $total_bookings ?>
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
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>No. of People</th>
                                <th>Message</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($bookings): ?>
                            <?php foreach($bookings as $booking): ?>
                                <tr>
                                    <td>
                                        <?= $rowCount; ?>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/admin/bookings/view-booking/'.$booking['booking_id'])?>">
                                            <?= $booking['name']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/admin/bookings/view-booking/'.$booking['booking_id'])?>">
                                            <?= $booking['email']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/admin/bookings/view-booking/'.$booking['booking_id'])?>">
                                            <?= $booking['phone']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/admin/bookings/view-booking/'.$booking['booking_id'])?>">
                                            <?= $booking['booking_date']; ?>
                                            <div class="mt-2">
                                                <?=getBookingDateBadge($booking['booking_date'])?>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/admin/bookings/view-booking/'.$booking['booking_id'])?>">
                                            <?= $booking['booking_time']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/admin/bookings/view-booking/'.$booking['booking_id'])?>">
                                            <?= $booking['no_of_people']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/admin/bookings/view-booking/'.$booking['booking_id'])?>">
                                            <?= $booking['message']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-dark td-none" href="<?=base_url('account/admin/bookings/view-booking/'.$booking['booking_id'])?>">
                                            <?= dateFormat($booking['created_at']); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-booking" href="<?=base_url('account/admin/bookings/view-booking/'.$booking['booking_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-booking" href="javascript:void(0)" onclick="deleteRecord('bookings', 'booking_id', '<?=$booking['booking_id'];?>', '', 'account/admin/bookings')">
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
