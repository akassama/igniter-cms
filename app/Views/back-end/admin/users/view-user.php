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
<?= $this->section('title') ?>View User<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Users', 'url' => '/account/admin/users'),
    array('title' => 'View User')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View User</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $user_data['first_name'] ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $user_data['last_name'] ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="username" class="form-label">Username <small>(read-only)</small></label>
                <input type="text" class="form-control" id="username" name="username" minlength="6" maxlength="20" value="<?= $user_data['username'] ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="email" class="form-label">Email <small>(read-only)</small></label>
                <input type="email" class="form-control" id="email" name="email" minlength="6" maxlength="20" value="<?= $user_data['email'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">
                    Status
                </label>
                <input type="text" class="form-control" id="status" name="status" minlength="6" maxlength="20" value="<?= getUserStatusOnly($user_data['status']) ?>" readonly />
            </div>

            <!--Role-->
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="role" class="form-label">
                    Role
                </label>
                <input type="text" class="form-control" id="role" name="role" minlength="6" maxlength="20" value="<?= $user_data['role'] ?>" readonly />
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="profile_picture" name="profile_picture" placeholder="select picture" value="<?= $user_data['profile_picture'] ?>" readonly>
                    <button class="btn btn-dark" type="button" >
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="twitter_link" class="form-label">Twitter URL</label>
                <input type="url" class="form-control" id="twitter_link" name="twitter_link" maxlength="250" value="<?= $user_data['twitter_link'] ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="facebook_link" class="form-label">Facebook URL</label>
                <input type="url" class="form-control" id="facebook_link" name="facebook_link" maxlength="250" value="<?= $user_data['facebook_link'] ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="instagram_link" class="form-label">Instagram URL</label>
                <input type="url" class="form-control" id="instagram_link" name="instagram_link" maxlength="250" value="<?= $user_data['instagram_link'] ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="linkedin_link" class="form-label">LinkedIn URL</label>
                <input type="url" class="form-control" id="linkedin_link" name="linkedin_link" maxlength="250" value="<?= $user_data['linkedin_link'] ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="about_summary" class="form-label">About Summary</label>
                <textarea rows="1" class="form-control" id="about_summary" name="about_summary" readonly><?= $user_data['about_summary'] ?></textarea>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin/users') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
