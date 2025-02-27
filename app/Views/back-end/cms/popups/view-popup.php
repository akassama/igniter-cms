<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Popups', 'url' => '/account/cms/popups'),
    array('title' => 'View Popup')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Popup</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" maxlength="250" value="<?= $popup_data['name'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" maxlength="250" value="<?= $popup_data['title'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="text" class="form-label">Text</label>
                <textarea rows="1" class="form-control" id="text" name="text" maxlength="1000" readonly><?= $popup_data['text'] ?></textarea>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                            <img loading="lazy" src="<?= getImageUrl(($popup_data['image']) ?? getDefaultImagePath())?>" class="img-thumbnail" alt="Advert image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="image" name="image" placeholder="select featured image" value="<?= $popup_data['image'] ?>" readonly>
                            <button class="btn btn-dark" type="button">
                                <i class="ri-image-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="button_text" class="form-label">Button Text</label>
                <input type="text" class="form-control" id="button_text" name="button_text" maxlength="250" value="<?= $popup_data['button_text'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="button_color" class="form-label">Button Color</label>
                <input type="text" class="form-control" id="button_text" name="button_text" maxlength="250" value="<?= $popup_data['button_color'] ?>" readonly>
            </div>
            
            <div class="col-sm-12 col-md-12 mb-3">
                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <label for="link" class="form-label">
                            Link
                            <span class="small text-muted">(Use '/' for internal links)</span>
                        </label>
                        <input type="text" class="form-control" id="link" name="link" value="<?= $popup_data['link'] ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="new_tab" class="form-label">New Tab</label>
                        <input type="text" class="form-control" id="new_tab" name="new_tab" value="<?= ($popup_data['new_tab'] == '0') ? 'No' : 'Yes'?>" readonly>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="delay" class="form-label">Delay <small>(miliseconds)</small></label>
                <input type="text" class="form-control integer-plus-only" id="delay" name="delay" data-show-err="true" maxlength="2" value="<?= $popup_data['delay'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="order" class="form-label">Order</label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="2" value="<?= $popup_data['order'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= ($popup_data['status'] == '0') ? 'Unpublished' : 'Published'?>" readonly>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/popups') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
