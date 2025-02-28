<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>View Pricing<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Pricings', 'url' => '/account/cms/pricings'),
    array('title' => 'View Pricing')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Pricing</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $pricing_data['title'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="description" class="form-label">
                    Description
                </label>
                <textarea rows="1" class="form-control" id="description" name="description" readonly><?= $pricing_data['description'] ?></textarea>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="currency" class="form-label">Currency</label>
                <input type="text" class="form-control" id="currency" name="currency" value="<?= $pricing_data['currency'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" value="<?= $pricing_data['amount'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="period" class="form-label">Period</label>
                <input type="text" class="form-control" id="period" name="period" value="<?= $pricing_data['period'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="is_popular" class="form-label">Is Popular?</label>
                <input type="text" class="form-control" id="is_popular" name="is_popular" value="<?= ($pricing_data['is_popular'] == '0') ? 'No' : 'Yes'?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="included_features_list" class="form-label">
                    Included Features List
                    <span class="small text-muted">(Comma separated)</span>
                </label>
                <textarea rows="1" class="form-control" id="included_features_list" name="included_features_list" readonly><?= $pricing_data['included_features_list'] ?></textarea>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="excluded_features_list" class="form-label">
                    Exclued Features List
                    <span class="small text-muted">(Comma separated)</span>
                </label>
                <textarea rows="1" class="form-control" id="excluded_features_list" name="excluded_features_list" readonly><?= $pricing_data['excluded_features_list'] ?></textarea>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="link_title" class="form-label">
                            Link Title
                        </label>
                        <input type="text" class="form-control" id="link_title" name="link_title" value="<?= $pricing_data['link_title'] ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <label for="link" class="form-label">
                            Link
                            <span class="small text-muted">(Use '/' for internal links)</span>
                        </label>
                        <input type="text" class="form-control" id="link" name="link" value="<?= $pricing_data['link'] ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="new_tab" class="form-label">New Tab</label>
                        <input type="text" class="form-control" id="new_tab" name="new_tab" value="<?= ($pricing_data['new_tab'] == '0') ? 'No' : 'Yes'?>" readonly>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="order" class="form-label">Order</label>
                <input type="text" class="form-control" id="order" name="order" value="<?= $pricing_data['order'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="other_label" class="form-label">Other Label</label>
                <input type="text" class="form-control" id="other_label" name="other_label" value="<?= $pricing_data['other_label'] ?>" readonly>
            </div>            
            
            <!-- entry data -->
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="created_by" class="form-label">Created BY</label>
                <input type="text" class="form-control" id="created_by" name="created_by" maxlength="250" value="<?= getActivityBy(esc($pricing_data['created_by']) , ""); ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="updated_by" class="form-label">Updated BY</label>
                <input type="text" class="form-control" id="updated_by" name="updated_by" maxlength="250" value="<?= getActivityBy(esc($pricing_data['updated_by']) , ""); ?>" readonly>
            </div>

            <div class="mb-3">
                <a href="<?= base_url('/account/cms/pricings') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
