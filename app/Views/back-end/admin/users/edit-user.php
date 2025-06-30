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
<?= $this->section('title') ?>Edit User<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Users', 'url' => '/account/admin/users'),
    array('title' => 'Edit User')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit User</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/admin/users/edit-user'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $user_data['first_name'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('first_name')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('first_name'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide first name
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $user_data['last_name'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('last_name')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('last_name'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide last name
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="username" class="form-label">Username <small>(read-only)</small></label>
                <input type="text" class="form-control" id="username" name="username" minlength="6" maxlength="20" value="<?= $user_data['username'] ?>" required readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="email" class="form-label">Email <small>(read-only)</small></label>
                <input type="email" class="form-control" id="email" name="email" minlength="6" maxlength="20" value="<?= $user_data['email'] ?>" required readonly>
            </div>

            <!--Status-->
            <?php
                $isCurrentUser = ($sessionEmail == $user_data['email']);
                $statusOptions = [
                    ['value' => '0', 'label' => 'Inactive'],
                    ['value' => '1', 'label' => 'Active'],
                    ['value' => '2', 'label' => 'Closed']
                ];
            ?>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">
                    Status <?= $isCurrentUser ? '<small>(read-only)</small>' : '' ?>
                </label>

                <?php if ($isCurrentUser) : ?>
                    <input type="text" class="form-control" id="status" name="status" minlength="6" maxlength="20" value="<?= getUserStatusOnly($user_data['status']) ?>" readonly />
                <?php else : ?>
                    <select class="form-select" id="status" name="status" required>
                        <option value="">Select status</option>
                        <?php foreach ($statusOptions as $option) : ?>
                            <option value="<?= $option['value'] ?>" <?= ($user_data['status'] == $option['value']) ? 'selected' : '' ?>>
                                <?= $option['label'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <!-- Error Handling -->
                    <?php if ($validation->getError('status')) : ?>
                        <div class='text-danger mt-2'>
                            <?= $validation->getError('status'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="invalid-feedback">Please provide status</div>
                <?php endif; ?>
            </div>

            <!--Role-->
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="role" class="form-label">
                    Role <?= $isCurrentUser ? '<small>(read-only)</small>' : '' ?>
                </label>

                <?php if ($isCurrentUser) : ?>
                    <input type="text" class="form-control" id="role" name="role" minlength="6" maxlength="20" value="<?= $user_data['role'] ?>" readonly />
                <?php else : ?>
                    <select class="form-select" id="role" name="role" required>
                        <option value="">Select role</option>
                        <?php foreach (config('CustomConfig')->userRoles as $key => $value): ?>
                            <option value="<?= $value ?>" <?= ($user_data['role'] == $value) ? 'selected' : '' ?>><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- Error Handling -->
                    <?php if ($validation->getError('role')) : ?>
                        <div class='text-danger mt-2'>
                            <?= $validation->getError('role'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="invalid-feedback">Please provide role</div>
                <?php endif; ?>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="profile_picture" name="profile_picture" placeholder="select picture" value="<?= $user_data['profile_picture'] ?>">
                    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#ciFileManagerModal">
                        <i class="ri-image-fill"></i>
                    </button>
                </div>
                <!-- Error -->
                <?php if($validation->getError('profile_picture')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('profile_picture'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide profile_picture
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="twitter_link" class="form-label">Twitter URL</label>
                <input type="url" class="form-control" id="twitter_link" name="twitter_link" maxlength="250" value="<?= $user_data['twitter_link'] ?>">
                <!-- Error -->
                <?php if($validation->getError('twitter_link')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('twitter_link'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide twitter_link
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="facebook_link" class="form-label">Facebook URL</label>
                <input type="url" class="form-control" id="facebook_link" name="facebook_link" maxlength="250" value="<?= $user_data['facebook_link'] ?>">
                <!-- Error -->
                <?php if($validation->getError('facebook_link')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('facebook_link'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide facebook_link
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="instagram_link" class="form-label">Instagram URL</label>
                <input type="url" class="form-control" id="instagram_link" name="instagram_link" maxlength="250" value="<?= $user_data['instagram_link'] ?>">
                <!-- Error -->
                <?php if($validation->getError('instagram_link')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('instagram_link'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide instagram_link
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="linkedin_link" class="form-label">LinkedIn URL</label>
                <input type="url" class="form-control" id="linkedin_link" name="linkedin_link" maxlength="250" value="<?= $user_data['linkedin_link'] ?>">
                <!-- Error -->
                <?php if($validation->getError('linkedin_link')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('linkedin_link'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide linkedin_link
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="about_summary" class="form-label">About Summary</label>
                <textarea rows="1" class="form-control" id="about_summary" name="about_summary" maxlength="500"><?= $user_data['about_summary'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('about_summary')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('about_summary'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide about_summary
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="password_change_required" class="form-label">Password Change Required</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="password_change_required" name="password_change_required" value="1" <?= ($user_data['password_change_required'] == '1') ? 'checked' : '' ?>>
                    <label class="form-check-label small" for="password_change_required">Toggle to set as required</label>
                </div>
                <!-- Error -->
                <?php if($validation->getError('password_change_required')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('password_change_required'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide password_change_required
                </div>
            </div>


            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $user_data['user_id']; ?>">
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin/users') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <?= $this->include('back-end/_shared/_edit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
