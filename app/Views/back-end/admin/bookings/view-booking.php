<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$userRole = getUserRole($sessionEmail);
?>

<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>View Bookings<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Bookings', 'url' => '/account/admin/bookings'),
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
                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $booking_data['name'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" minlength="6" maxlength="20" value="<?= $booking_data['email'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?= $booking_data['phone'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="booking_date" class="form-label">Date</label>
                    <input type="text" class="form-control" id="booking_date" name="booking_date" value="<?= $booking_data['booking_date'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="booking_time" class="form-label">Time</label>
                    <input type="text" class="form-control" id="booking_time" name="booking_time" value="<?= $booking_data['booking_time'] ?>" readonly>
                </div>
                <div class="col-sm-12 col-md-4 mb-3">
                    <label for="no_of_people" class="form-label">No of People</label>
                    <input type="text" class="form-control" id="no_of_people" name="no_of_people" value="<?= $booking_data['no_of_people'] ?>" readonly>
                </div>

                <div class="col-sm-12 col-md-12 mb-3">
                    <label for="message" class="form-label">Message</label>
                    <div class="border border-dark rounded p-2" id="message" name="message"><?= $booking_data['message'] ?></div>
                </div>
                <?php
                    if(!empty($booking_data['other'])){
                        ?>
                        <div class="col-sm-12 col-md-12 mb-3">
                            <label for="other" class="form-label">Other</label>
                            <div class="border border-dark rounded p-2" id="other" name="other"><?= $booking_data['other'] ?></div>
                        </div>
                        <?php
                    }
                ?>
                
                <!--hidden-->
                <div>
                    <input type="hidden" class="form-control" id="booking_id" name="booking_id" value="<?= $booking_data['booking_id'] ?>" readonly>
                </div>

                <div class="mb-3 mt-3">
                    <a href="<?= base_url('/account/admin/bookings') ?>" class="btn btn-outline-danger">
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
