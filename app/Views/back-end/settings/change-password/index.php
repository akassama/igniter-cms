<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Settings', 'url' => '/account/settings'),
    array('title' => 'Change Password')
);
echo generateBreadcrumb($breadcrumb_links);
?>
<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Change Password</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/settings/change-password/update-password'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <?php
            //check if password change is required and display message
            if(passwordChangeRequired() && !boolval(env('DEMO_MODE', "false"))){
                $passwordResetRequiredMsg = config('CustomConfig')->passwordResetRequiredMsg;
                echo "<div class='alert alert-danger'>".$passwordResetRequiredMsg."</div>";
            }
        ?>
        <div class="row">
            <div class="col-8 offset-2">
                <div class="col-12 mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" value="" required>
                    <!-- Error -->
                    <?php if($validation->getError('current_password')) {?>
                        <div class='text-danger mt-2'>
                            <?= $error = $validation->getError('current_password'); ?>
                        </div>
                    <?php }?>
                    <div class="invalid-feedback">
                        Please provide current_password
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" value="" required>
                    <!-- Error -->
                    <?php if($validation->getError('new_password')) {?>
                        <div class='text-danger mt-2'>
                            <?= $error = $validation->getError('new_password'); ?>
                        </div>
                    <?php }?>
                    <div class="invalid-feedback">
                        Please provide new_password
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label for="repeat_password" class="form-label">Repeat Password</label>
                    <input type="password" class="form-control" id="repeat_password" name="repeat_password" value="" required>
                    <!-- Error -->
                    <?php if($validation->getError('repeat_password')) {?>
                        <div class='text-danger mt-2'>
                            <?= $error = $validation->getError('repeat_password'); ?>
                        </div>
                    <?php }?>
                    <div class="invalid-feedback">
                        Please provide repeat_password
                    </div>
                </div>
            </div>

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $user_data['user_id']; ?>">
            </div>

            <div class="mb-3">
                <a href="<?= base_url('/account/settings') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <?= $this->include('back-end/_shared/_edit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
