<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Blocked IP<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Blocked IP Addresses', 'url' => '/account/admin/blocked-ips'),
    array('title' => 'New Blocked IP')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Blocked IP</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/admin/blocked-ips/new-blocked-ip'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="ip_address" class="form-label">IP Adress</label>
                <input type="text" class="form-control" id="ip_address" name="ip_address" maxlength="250" value="<?= set_value('ip_address') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('ip_address')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('ip_address'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide ip_address
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" aria-label="Block Reason" id="country" name="country">
                    <option value="">Select country</option>
                    <?=getCountrySelectOptions(set_value('country'))?>
                </select>
                <!-- Error -->
                <?php if($validation->getError('country')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('country'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide country
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="block_start_time" class="form-label">Block Start Time</label>
                <input type="text" class="form-control" id="block_start_time" name="block_start_time" maxlength="250" value="<?= date('Y-m-d H:i:s') ?>" readonly>
                <!-- Error -->
                <?php if($validation->getError('block_start_time')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('block_start_time'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide block_start_time
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="block_end_time" class="form-label">Block End Time</label>
                <input type="text" class="form-control tempus-datetime-picker" id="block_end_time" name="block_end_time" maxlength="250" value="<?= date('Y-m-d H:i:s', strtotime(getConfigData("BlockedIPSuspensionPeriod"))) ?>" required>
                <!-- Error -->
                <?php if($validation->getError('block_end_time')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('block_end_time'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide block_end_time
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="reason" class="form-label">Reason</label>
                <select class="form-select" aria-label="Block Reason" id="reason" name="reason" required>
                    <option value="">Select reason</option>
                    <option value="too_many_failed_logins" <?= set_select('reason', 'too_many_failed_logins');?>>Too Many Failed Logins</option>
                    <option value="suspicious_activity" <?= set_select('reason', 'suspicious_activity');?>>Suspicious Activity</option>
                    <option value="malicious_traffic" <?= set_select('reason', 'malicious_traffic');?>>Malicious Traffic</option>
                    <option value="denial_of_service" <?= set_select('reason', 'denial_of_service');?>>Denial of Service</option>
                    <option value="brute_force_attack" <?= set_select('reason', 'brute_force_attack');?>>Brute Force Attack</option>
                    <option value="spamming" <?= set_select('reason', 'spamming');?>>Spamming</option>
                    <option value="known_attacker" <?= set_select('reason', 'known_attacker');?>>Known Attacker</option>
                    <option value="manual_block" <?= set_select('reason', 'manual_block');?>>Manual Block</option>
                    <option value="invalid_request" <?= set_select('reason', 'invalid_request');?>>Invalid Request</option>
                    <option value="sql_injection_attempt" <?= set_select('reason', 'sql_injection_attempt');?>>SQL Injection Attempt</option>
                    <option value="directory_traversal" <?= set_select('reason', 'directory_traversal');?>>Directory Traversal</option>
                    <option value="exploit_attempt" <?= set_select('reason', 'exploit_attempt');?>>Exploit Attempt</option>
                </select>
                <!-- Error -->
                <?php if($validation->getError('reason')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('reason'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide reason
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea rows="1" class="form-control" id="notes" name="notes" maxlength="1000"><?= set_value('notes') ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('notes')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('notes'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide notes
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="page_visited_url" class="form-label">Page Visited URL</label>
                <input type="url" class="form-control" id="page_visited_url" name="page_visited_url" maxlength="255" value="<?= set_value('page_visited_url') ?>">
                <!-- Error -->
                <?php if($validation->getError('page_visited_url')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('page_visited_url'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide page_visited_url
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin/blocked-ips') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <?= $this->include('back-end/_shared/_submit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
