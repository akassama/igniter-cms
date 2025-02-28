<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Edit Pricing<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Pricings', 'url' => '/account/cms/pricings'),
    array('title' => 'Edit Pricing')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit Pricing</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/pricings/edit-pricing'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $pricing_data['title'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('title')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('title'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide title
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">
                    Description
                </label>
                <textarea rows="1" class="form-control" id="description" name="description"><?= $pricing_data['description'] ?></textarea>
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
                <label for="currency" class="form-label">Currency</label>
                <input type="text" class="form-control title-text" id="currency" name="currency" data-show-err="true" value="<?= $pricing_data['currency'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('currency')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('currency'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide currency
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="text" class="form-control float-number" id="amount" name="amount" data-show-err="true" value="<?= $pricing_data['amount'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('amount')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('amount'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide amount
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="period" class="form-label">
                    Period <small>(E.g. Monthly)</small>
                </label>
                <input type="text" class="form-control title-text" id="period" name="period" data-show-err="true" value="<?= $pricing_data['period'] ?>">
                <!-- Error -->
                <?php if($validation->getError('period')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('period'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide period
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="is_popular" class="form-label">Is Popular?</label>
                <select class="form-select" id="is_popular" name="is_popular" required>
                    <option value="">Select answer</option>
                    <option value="1" <?= ($pricing_data['is_popular'] == '1') ? 'selected' : '' ?>>Yes</option>
                    <option value="0" <?= ($pricing_data['is_popular'] == '0') ? 'selected' : '' ?>>No</option>
                </select>
                <!-- Error -->
                <?php if($validation->getError('is_popular')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('is_popular'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide is_popular
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="included_features_list" class="form-label">
                    Included Features List
                    <span class="small text-muted">(Comma separated)</span>
                </label>
                <textarea rows="1" class="form-control tags-input" id="included_features_list" name="included_features_list" required><?= $pricing_data['included_features_list'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('included_features_list')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('included_features_list'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide included_features_list
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="excluded_features_list" class="form-label">
                    Exclued Features List
                    <span class="small text-muted">(Comma separated)</span>
                </label>
                <textarea rows="1" class="form-control tags-input" id="excluded_features_list" name="excluded_features_list"><?= $pricing_data['excluded_features_list'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('excluded_features_list')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('excluded_features_list'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide excluded_features_list
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="link_title" class="form-label">
                            Link Title
                        </label>
                        <input type="text" class="form-control" id="link_title" name="link_title" value="<?= $pricing_data['link_title'] ?>">
                        <!-- Error -->
                        <?php if($validation->getError('link_title')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('link_title'); ?>
                            </div>
                        <?php }?>
                        <div class="invalid-feedback">
                            Please provide link_title
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <label for="link" class="form-label">
                            Link
                            <span class="small text-muted">(Use '/' for internal links)</span>
                        </label>
                        <input type="text" class="form-control" id="link" name="link" value="<?= $pricing_data['link'] ?>">
                        <!-- Error -->
                        <?php if($validation->getError('link')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('link'); ?>
                            </div>
                        <?php }?>
                        <div class="invalid-feedback">
                            Please provide link
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="new_tab" class="form-label">New Tab</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="new_tab" name="new_tab" value="1" <?= ($pricing_data['new_tab'] == '1') ? 'checked' : '' ?>>
                            <label class="form-check-label small" for="new_tab">Toggle to open as new tab</label>
                        </div>
                        <!-- Error -->
                        <?php if($validation->getError('new_tab')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('new_tab'); ?>
                            </div>
                        <?php }?>
                        <div class="invalid-feedback">
                            Please provide new_tab
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="order" class="form-label">
                    Order
                </label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="2" value="<?= $pricing_data['order'] ?>">
                <!-- Error -->
                <?php if($validation->getError('order')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('order'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide order
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="other_label" class="form-label">Other Label</label>
                <input type="text" class="form-control" id="other_label" name="other_label" value="<?= $pricing_data['other_label'] ?>">
                <!-- Error -->
                <?php if($validation->getError('other_label')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('other_label'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide other_label
                </div>
            </div>

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="pricing_id" name="pricing_id" value="<?= $pricing_data['pricing_id']; ?>" />
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $pricing_data['created_by']; ?>" />
            </div>

            <div class="mb-3">
                <a href="<?= base_url('/account/cms/pricings') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <button type="submit" class="btn btn-outline-primary float-end" id="submit-btn">
                    <i class="ri-edit-box-line"></i>
                    Update
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
