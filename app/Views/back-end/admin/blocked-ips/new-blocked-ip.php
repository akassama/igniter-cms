<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?= lang('App.new_blocked_ip') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.admin'), 'url' => '/account/admin'),
    array('title' => 'Blocked IP Addresses', 'url' => '/account/admin/blocked-ips'),
    array('title' => lang('App.new_blocked_ip'))
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3><?= lang('App.new_blocked_ip') ?></h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/admin/blocked-ips/new-blocked-ip'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="ip_address" class="form-label"><?= lang('App.ip') ?></label>
                <input type="text" class="form-control" id="ip_address" name="ip_address" maxlength="250" value="<?= set_value('ip_address') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('ip_address')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('ip_address'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="country" class="form-label"><?= lang('App.country') ?></label>
                <select class="form-select" aria-label="Block Reason" id="country" name="country">
                    <option value=""><?= lang('App.select_country') ?></option>
                    <?=getCountrySelectOptions(set_value('country'))?>
                </select>
                <!-- Error -->
                <?php if($validation->getError('country')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('country'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="block_start_time" class="form-label"><?= lang('App.block_start_time') ?></label>
                <input type="text" class="form-control" id="block_start_time" name="block_start_time" maxlength="250" value="<?= date('Y-m-d H:i:s') ?>" readonly>
                <!-- Error -->
                <?php if($validation->getError('block_start_time')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('block_start_time'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="block_end_time" class="form-label"><?= lang('App.block_end_time') ?></label>
                <input type="text" class="form-control tempus-datetime-picker" id="block_end_time" name="block_end_time" maxlength="250" value="<?= date('Y-m-d H:i:s', strtotime(getConfigData("BlockedIPSuspensionPeriod"))) ?>" required>
                <!-- Error -->
                <?php if($validation->getError('block_end_time')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('block_end_time'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="reason" class="form-label"><?= lang('App.reason') ?></label>
                <select class="form-select" aria-label="Block Reason" id="reason" name="reason" required>
                    <option value=""><?= lang('App.select_reason') ?></option>
                    <option value="too_many_failed_logins" <?= set_select('reason', 'too_many_failed_logins');?>><?= lang('App.too_many_failed_logins') ?></option>
                    <option value="suspicious_activity" <?= set_select('reason', 'suspicious_activity');?>><?= lang('App.suspicious_activity') ?></option>
                    <option value="malicious_traffic" <?= set_select('reason', 'malicious_traffic');?>><?= lang('App.malicious_traffic') ?></option>
                    <option value="denial_of_service" <?= set_select('reason', 'denial_of_service');?>><?= lang('App.denial_of_service') ?></option>
                    <option value="brute_force_attack" <?= set_select('reason', 'brute_force_attack');?>><?= lang('App.brute_force_attack') ?></option>
                    <option value="spamming" <?= set_select('reason', 'spamming');?>><?= lang('App.spamming') ?></option>
                    <option value="known_attacker" <?= set_select('reason', 'known_attacker');?>><?= lang('App.known_attacker') ?></option>
                    <option value="manual_block" <?= set_select('reason', 'manual_block');?>><?= lang('App.manual_block') ?></option>
                    <option value="invalid_request" <?= set_select('reason', 'invalid_request');?>><?= lang('App.invalid_request') ?></option>
                    <option value="sql_injection_attempt" <?= set_select('reason', 'sql_injection_attempt');?>><?= lang('App.sql_injection_attempt') ?></option>
                    <option value="directory_traversal" <?= set_select('reason', 'directory_traversal');?>><?= lang('App.directory_traversal') ?></option>
                    <option value="exploit_attempt" <?= set_select('reason', 'exploit_attempt');?>><?= lang('App.exploit_attempt') ?></option>
                </select>
                <!-- Error -->
                <?php if($validation->getError('reason')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('reason'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="notes" class="form-label"><?= lang('App.notes') ?></label>
                <textarea rows="1" class="form-control" id="notes" name="notes" maxlength="1000"><?= set_value('notes') ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('notes')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('notes'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="page_visited_url" class="form-label"><?= lang('App.page_visited_url') ?></label>
                <input type="url" class="form-control" id="page_visited_url" name="page_visited_url" maxlength="255" value="<?= set_value('page_visited_url') ?>">
                <!-- Error -->
                <?php if($validation->getError('page_visited_url')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('page_visited_url'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    <?= lang('App.input_required') ?>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin/blocked-ips') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    <?= lang('App.back') ?>
                </a>
                <?= $this->include('back-end/_shared/_submit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/_files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>