<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>View Team<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Teams', 'url' => '/account/cms/teams'),
    array('title' => 'Edit Team')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>View Team</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $team_data['name'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $team_data['title'] ?>" readonly>
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
                            <input type="text" class="form-control" id="image" name="image" placeholder="select image" value="<?= $team_data['image'] ?>"
                                hx-post="<?=base_url()?>/htmx/set-image-display"
                                hx-trigger="keyup, load, changed delay:250ms"
                                hx-target="#display-preview-image"
                                hx-swap="innerHTML" readonly>
                            <button class="btn btn-dark" type="button">
                            <i class="ri-image-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="summary" class="form-label">Summary</label>
                <textarea rows="1" class="form-control" id="summary" name="summary" readonly><?= $team_data['summary'] ?></textarea>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="social_link_1" class="form-label">Social Link 1</label>
                <input type="text" class="form-control" id="social_link_1" name="social_link_1" value="<?= $team_data['social_link_1'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="social_link_2" class="form-label">Social Link 2</label>
                <input type="text" class="form-control" id="social_link_2" name="social_link_2" value="<?= $team_data['social_link_2'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="social_link_3" class="form-label">Social Link 3</label>
                <input type="text" class="form-control" id="social_link_3" name="social_link_3" value="<?= $team_data['social_link_3'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="social_link_4" class="form-label">Social Link 4</label>
                <input type="text" class="form-control" id="social_link_4" name="social_link_4" value="<?= $team_data['social_link_4'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="social_link_5" class="form-label">Social Link 5</label>
                <input type="text" class="form-control" id="social_link_5" name="social_link_5" value="<?= $team_data['social_link_5'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="social_link_6" class="form-label">Social Link 6</label>
                <input type="text" class="form-control" id="social_link_6" name="social_link_6" value="<?= $team_data['social_link_6'] ?>" readonly>
            </div>
            
            <div class="col-sm-12 col-md-12 mb-3">
                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <label for="details_link" class="form-label">
                            Details Link
                            <span class="small text-muted">(Use '/' for internal links)</span>
                        </label>
                        <input type="text" class="form-control" id="details_link" name="details_link" value="<?= $team_data['details_link'] ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="new_tab" class="form-label">New Tab</label>
                        <input type="text" class="form-control" id="new_tab" name="new_tab" value="<?= ($team_data['new_tab'] == '0') ? 'No' : 'Yes'?>" readonly>
                    </div>
                </div>
            </div>            
            
            <!-- entry data -->
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="created_by" class="form-label">Created BY</label>
                <input type="text" class="form-control" id="created_by" name="created_by" maxlength="250" value="<?= getActivityBy(esc($team_data['created_by']) , ""); ?>" readonly>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="updated_by" class="form-label">Updated BY</label>
                <input type="text" class="form-control" id="updated_by" name="updated_by" maxlength="250" value="<?= getActivityBy(esc($team_data['updated_by']) , ""); ?>" readonly>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/teams') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
