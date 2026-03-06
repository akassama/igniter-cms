<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?= lang('App.update_account_details') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.settings'), 'url' => '/account/settings'),
    array('title' => lang('App.account_details'))
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3><?= lang('App.update_account_details') ?></h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/settings/update-details/update-user'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="first_name" class="form-label"><?= lang('App.first_name') ?></label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $user_data['first_name'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('first_name')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('first_name'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="last_name" class="form-label"><?= lang('App.last_name') ?></label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $user_data['last_name'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('last_name')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('last_name'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="email" class="form-label">
                    <?= lang('App.email') ?>
                    <small>(<?= lang('app.read_only') ?>)</small>
                </label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user_data['email'] ?>" required readonly>
                <!-- Error -->
                <?php if($validation->getError('email')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('email'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="username" class="form-label">
                    <?= lang('App.username') ?>
                    <small>(<?= lang('app.read_only') ?>)</small>
                </label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $user_data['username'] ?>" required readonly>
                <!-- Error -->
                <?php if($validation->getError('username')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('username'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="username" class="form-label">
                    <?= lang('App.status') ?>
                    <small>(<?= lang('app.read_only') ?>)</small>
                </label>
                <input type="text" class="form-control" id="status" name="status" value="<?= getUserStatusOnly($user_data['status']) ?>" required readonly>
                <!-- Error -->
                <?php if($validation->getError('status')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('status'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="username" class="form-label">
                    <?= lang('App.role') ?>
                    <small>(<?= lang('app.read_only') ?>)</small>
                </label>
                <input type="text" class="form-control" id="role" name="role" value="<?= $user_data['role'] ?>" required readonly>
                <!-- Error -->
                <?php if($validation->getError('role')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('role'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="profile_picture" class="form-label"><?= lang('App.profile_picture') ?></label>
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
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="twitter_link" class="form-label"><?= lang('App.twitter_url') ?></label>
                <input type="url" class="form-control" id="twitter_link" name="twitter_link" maxlength="250" value="<?= $user_data['twitter_link'] ?>">
                <!-- Error -->
                <?php if($validation->getError('twitter_link')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('twitter_link'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="facebook_link" class="form-label"><?= lang('App.facebook_url') ?></label>
                <input type="url" class="form-control" id="facebook_link" name="facebook_link" maxlength="250" value="<?= $user_data['facebook_link'] ?>">
                <!-- Error -->
                <?php if($validation->getError('facebook_link')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('facebook_link'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="instagram_link" class="form-label"><?= lang('App.instagram_url') ?></label>
                <input type="url" class="form-control" id="instagram_link" name="instagram_link" maxlength="250" value="<?= $user_data['instagram_link'] ?>">
                <!-- Error -->
                <?php if($validation->getError('instagram_link')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('instagram_link'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="linkedin_link" class="form-label"><?= lang('App.linkedin_url') ?></label>
                <input type="url" class="form-control" id="linkedin_link" name="linkedin_link" maxlength="250" value="<?= $user_data['linkedin_link'] ?>">
                <!-- Error -->
                <?php if($validation->getError('linkedin_link')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('linkedin_link'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="about_summary" class="form-label"><?= lang('App.about_summary') ?></label>
                    <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn"
                    hx-post="<?=base_url()?>/htmx/get-account-summary-via-ai"
                    hx-trigger="click delay:250ms"
                    hx-target="#summary-div"
                    hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> <?= lang('App.use_ai') ?></button>
                </div>
                <div id="summary-div">
                    <textarea rows="1" class="form-control" id="about_summary" name="about_summary" maxlength="500"><?= $user_data['about_summary'] ?></textarea>
                </div>
                <!-- Error -->
                <?php if($validation->getError('about_summary')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('about_summary'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>


            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $user_data['user_id']; ?>">
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/settings') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    <?= lang('App.back') ?>
                </a>
                <?= $this->include('back-end/_shared/_edit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/_files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>