<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Team<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Teams', 'url' => '/account/cms/teams'),
    array('title' => 'New Team')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Team</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/teams/new-team'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control title-text" id="name" name="name" data-show-err="true" maxlength="100" value="<?= set_value('name') ?>" required>
                <!-- Error -->
                <?php if($validation->getError('name')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('name'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide name
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= set_value('title') ?>" required>
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

            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                        <img loading="lazy" src="<?= base_url(getDefaultImagePath())?>" class="img-thumbnail" alt="Featured image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" id="image" name="image" placeholder="select image" value="<?= set_value('image') ?>"
                            hx-post="<?=base_url()?>/htmx/set-image-display"
                            hx-trigger="keyup, changed delay:250ms"
                            hx-target="#display-preview-image"
                            hx-swap="innerHTML">
                        <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#ciFileManagerModal">
                        <i class="ri-image-fill"></i>
                        </button>
                        <div class="invalid-feedback">
                            Please provide image
                        </div>
                        </div>
                        <!-- Error -->
                        <?php if($validation->getError('image')) {?>
                        <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('image'); ?>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="summary" class="form-label">Summary</label>
                    <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn"
                    hx-post="<?=base_url()?>/htmx/get-team-summary-via-ai"
                    hx-trigger="click delay:250ms"
                    hx-target="#summary-div"
                    hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                </div>
                <div id="summary-div">
                    <textarea rows="1" class="form-control" id="summary" name="summary" maxlength="500" required><?= set_value('summary') ?></textarea>
                </div>
                <!-- Error -->
                <?php if($validation->getError('summary')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('summary'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide summary
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="social_link_1" class="form-label">
                    Social Link 1 <span class="small">(facebook)</span>
                </label>
                <input type="text" class="form-control" id="social_link_1" name="social_link_1" maxlength="250" value="<?= set_value('social_link_1') ?>">
                <!-- Error -->
                <?php if($validation->getError('social_link_1')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('social_link_1'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide social_link_1
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="social_link_2" class="form-label">
                    Social Link 2 <span class="small">(twitter-x)</span>
                </label>
                <input type="url" class="form-control" id="social_link_2" name="social_link_2" maxlength="250" value="<?= set_value('social_link_2') ?>">
                <!-- Error -->
                <?php if($validation->getError('social_link_2')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('social_link_2'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide social_link_2
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="social_link_3" class="form-label">
                    Social Link 3  <span class="small">(instagram)</span>
                </label>
                <input type="url" class="form-control" id="social_link_3" name="social_link_3" maxlength="250" value="<?= set_value('social_link_3') ?>">
                <!-- Error -->
                <?php if($validation->getError('social_link_3')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('social_link_3'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide social_link_3
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="social_link_4" class="form-label">
                    Social Link 4  <span class="small">(linkedin)</span>
                </label>
                <input type="url" class="form-control" id="social_link_4" name="social_link_4" maxlength="250" value="<?= set_value('social_link_4') ?>">
                <!-- Error -->
                <?php if($validation->getError('social_link_4')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('social_link_4'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide social_link_4
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="social_link_5" class="form-label">
                    Social Link 5 <span class="small">(github)</span>
                </label>
                <input type="url" class="form-control" id="social_link_5" name="social_link_5" maxlength="250" value="<?= set_value('social_link_5') ?>">
                <!-- Error -->
                <?php if($validation->getError('social_link_5')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('social_link_5'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide social_link_5
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="social_link_6" class="form-label">
                    Social Link 6 <span class="small">(other)</span>
                </label>
                <input type="url" class="form-control" id="social_link_6" name="social_link_6" maxlength="250" value="<?= set_value('social_link_6') ?>">
                <!-- Error -->
                <?php if($validation->getError('social_link_6')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('social_link_6'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide social_link_6
                </div>
            </div>
            
            <div class="col-sm-12 col-md-12 mb-3">
                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <label for="details_link" class="form-label">
                            Details Link
                            <span class="small text-muted">(Use '/' for internal links)</span>
                        </label>
                        <input type="text" class="form-control" id="details_link" name="details_link" maxlength="250" value="<?= set_value('details_link') ?>">
                        <!-- Error -->
                        <?php if($validation->getError('details_link')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('details_link'); ?>
                            </div>
                        <?php }?>
                        <div class="invalid-feedback">
                            Please provide details_link
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="new_tab" class="form-label">New Tab</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="new_tab" name="new_tab" value="1">
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

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/teams') ?>" class="btn btn-outline-danger">
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
