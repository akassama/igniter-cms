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
<?= $this->section('title') ?>View Configuration<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Configurations', 'url' => '/account/admin/configurations'),
    array('title' => 'View Configuration')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Configuration</h3>
        <p>
            <?= $config_data['description'] ?>
        </p>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="config_for" class="form-label">Config For <small>(read-only)</small> </label>
                <input type="text" class="form-control" id="config_for" name="config_for" value="<?= $config_data['config_for'] ?>" readonly>
            </div>

            <?php
                $dataType = $config_data['data_type'];
                $options = $config_data['options'];
                $configValue = getConfigData($config_data['config_for']);
            ?>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="config_value" class="form-label">Config value</label>
                
                <?php if ($dataType === 'Text'): ?>
                    <input type="text" class="form-control" id="config_value" name="config_value" value="<?= $configValue ?>" readonly>
                
                <?php elseif ($dataType === 'Textarea'): ?>
                    <textarea rows="1" class="form-control" id="config_value" name="config_value" readonly><?= $configValue ?></textarea>
                
                <?php elseif ($dataType === 'Secret'): ?>
                    <textarea rows="1" class="form-control" id="config_value" name="config_value" readonly><?= $configValue ?></textarea>
                
                <?php elseif ($dataType === 'Code'): ?>
                    <textarea rows="2" class="form-control js-editor" id="config_value" name="config_value" readonly><?= $configValue ?></textarea>
                
                <?php elseif ($dataType === 'Select'): ?>
                    <select class="form-control" id="config_value" name="config_value" readonly>
                        <?php if (!empty($options)): ?>
                            <?php $optionValues = explode(',', $options); ?>
                            <?php foreach ($optionValues as $option): ?>
                                <option value="<?= trim($option) ?>" <?= ($configValue == trim($option) ? 'selected' : '') ?>>
                                    <?= trim($option) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                
                <?php endif; ?>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="1" class="form-control" id="description" name="description" readonly><?= $config_data['description'] ?></textarea>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="group" class="form-label">Group</label>
                <input type="text" class="form-control" id="group" name="group" value="<?= $config_data['group'] ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="default_value" class="form-label">Default Value</label>
                <input type="text" class="form-control" id="default_value" name="default_value" value="<?= $config_data['default_value'] ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="custom_class" class="form-label">Custom Class</label>
                <input type="text" class="form-control" id="custom_class" name="custom_class" value="<?= $config_data['custom_class'] ?>" readonly>
            </div>

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="config_id" name="config_id" value="<?= $config_data['config_id']; ?>">
                <input type="hidden" class="form-control" id="deletable" name="deletable" value="<?= $config_data['deletable']; ?>">
                <input type="hidden" class="form-control" id="data_type" name="data_type" value="<?= $config_data['data_type']; ?>">
                <input type="hidden" class="form-control" id="options" name="options" value="<?= $config_data['options']; ?>">
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $config_data['created_by']; ?>">
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/admin/configurations') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
