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
<?= $this->section('title') ?>Edit Configuration<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Configurations', 'url' => '/account/admin/configurations'),
    array('title' => 'Edit Configuration')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit Configuration</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/admin/configurations/edit-config'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="config_for" class="form-label">Config For <small>(read-only)</small> </label>
                <input type="text" class="form-control" id="config_for" name="config_for" value="<?= $config_data['config_for'] ?>" required readonly>
                <!-- Error -->
                <?php if($validation->getError('config_for')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('config_for'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide config_for
                </div>
            </div>

            <?php
                $dataType = $config_data['data_type'];
                $readonlyInputs = $config_data['deletable'] == 1 ? "" : "readonly";
                $readonlyLabel = $config_data['deletable'] == 1 ? "" : "<small>(read-only)</small>";
                $options = $config_data['options'];
                $configValue = getConfigData($config_data['config_for']);
                $encryptedLabel = strtolower($dataType) === "secret" ? "<small>(Encrtpted)</small>" : "";
            ?>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="config_value" class="form-label">Config value <?=$encryptedLabel?></label>
                
                <?php if ($dataType === 'Text'): ?>
                    <input type="text" class="form-control <?= $config_data['custom_class'] ?>" id="config_value" name="config_value" data-show-err="true" value="<?= $configValue ?>" required>
                
                <?php elseif ($dataType === 'Textarea'): ?>
                    <textarea rows="1" class="form-control <?= $config_data['custom_class'] ?>" id="config_value" name="config_value" data-show-err="true" required><?= $configValue ?></textarea>
                
                <?php elseif ($dataType === 'Code'): ?>
                    <textarea rows="2" class="form-control js-editor <?= $config_data['custom_class'] ?>" id="config_value" name="config_value" data-show-err="true" required><?= $configValue ?></textarea>
                
                <?php elseif ($dataType === 'Secret'): ?>
                    <textarea rows="1" class="form-control <?= $config_data['custom_class'] ?>" id="config_value" name="config_value" data-show-err="true" required><?= $configValue ?></textarea>

                <?php elseif ($dataType === 'Select'): ?>
                    <select class="form-control <?= $config_data['custom_class'] ?>" id="config_value" name="config_value" data-show-err="true" required>
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
                
                <!-- Error -->
                <?php if($validation->getError('config_value')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('config_value'); ?>
                    </div>
                <?php }?>
                
                <div class="invalid-feedback">
                    Please provide config_value
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="1" class="form-control" id="description" name="description" maxlength="500"><?= $config_data['description'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('description')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('description'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide description
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="group" class="form-label">Group <?=$readonlyLabel?></label>
                <input type="text" class="form-control" id="group" name="group" value="<?= $config_data['group'] ?>" <?=$readonlyInputs?>>
                <!-- Error -->
                <?php if($validation->getError('group')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('group'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide group
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="default_value" class="form-label">Default Value <?=$readonlyLabel?></label>
                <input type="text" class="form-control" id="default_value" name="default_value" value="<?= $config_data['default_value'] ?>" <?=$readonlyInputs?>>
                <!-- Error -->
                <?php if($validation->getError('default_value')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('default_value'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide default_value
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="custom_class" class="form-label">Custom Class <?=$readonlyLabel?></label>
                <input type="text" class="form-control" id="custom_class" name="custom_class" value="<?= $config_data['custom_class'] ?>" <?=$readonlyInputs?>>
                <!-- Error -->
                <?php if($validation->getError('custom_class')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('custom_class'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide custom_class
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="icon" class="form-label">
                    Icon <?=$readonlyLabel?>
                </label>
                <input type="text" class="form-control" id="icon" name="icon" maxlength="100" value="<?= htmlspecialchars($config_data['icon']) ?>" placeholder="E.g. ri-user-line" <?=$readonlyInputs?>>
                <!-- Error -->
                <?php if($validation->getError('icon')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('icon'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide icon
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="search_terms" class="form-label">
                    Search Terms <?=$readonlyLabel?>
                </label>
                <textarea rows="1" class="form-control tags-input" id="search_terms" name="search_terms" <?=$readonlyInputs?>><?= $config_data['search_terms'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('search_terms')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('search_terms'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide search_terms
                </div>
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
                <?= $this->include('back-end/_shared/_edit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
