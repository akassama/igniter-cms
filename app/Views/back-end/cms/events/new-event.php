<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Event<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>
<?php
   // Breadcrumbs
   $breadcrumb_links = array(
       array('title' => 'Dashboard', 'url' => '/account'),
       array('title' => 'CMS', 'url' => '/account/cms'),
       array('title' => 'Events', 'url' => '/account/cms/events'),
       array('title' => 'New Event')
   );
   echo generateBreadcrumb($breadcrumb_links);
   ?>
<div class="row">
   <!--Content-->
   <div class="col-12">
      <h3>New Event</h3>
   </div>
   <div class="col-12 bg-light rounded p-4">
      <?php $validation = \Config\Services::validation(); ?>
      <?php echo form_open(base_url('account/cms/events/new-event'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
      <div class="row">
         <div class="col-sm-12 col-md-12 mb-3">
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

         <div class="col-sm-12 col-md-12 mb-3">
            <div class="d-flex justify-content-between align-items-center">
               <label for="description" class="form-label">Description</label>
                  <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn"
                  hx-post="<?=base_url()?>/htmx/get-event-description-via-ai"
                  hx-trigger="click delay:250ms"
                  hx-target="#description-div"
                  hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
            </div>
            <div id="description-div">
               <textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required><?= set_value('description') ?></textarea>
            </div>
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

         <div class="col-sm-12 col-md-12 mb-3">
               <label for="slug" class="form-label">Slug</label>
               <div class="input-group mb-3">
                  <span class="input-group-text"><?= base_url('/event/'); ?></span>
                  <input type="text" class="form-control" id="slug" name="slug" value="<?= set_value('slug') ?>" required 
                     hx-post="<?=base_url()?>/htmx/get-event-title-slug"
                     hx-trigger="load delay:1s"
                     hx-swap="outerHTML">
                  <div class="invalid-feedback">
                     Please provide slug
                  </div>
               </div>
               <!-- Error -->
               <?php if($validation->getError('slug')) {?>
                  <div class='text-danger mt-2'>
                     <?= $error = $validation->getError('slug'); ?>
                  </div>
               <?php }?>
         </div>

         <div class="col-12">
               <div class="row">
                  <div class="col-12" id="display-preview-image">
                     <div class="float-end">         
                        <img loading="lazy" src="<?= base_url(getDefaultImagePath())?>" class="img-thumbnail" alt="Featured image" width="150" height="150"> 
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-12 mb-3">
                     <label for="image" class="form-label">Event Image</label>
                     <div class="input-group mb-3">
                        <input type="text" class="form-control" id="image" name="image" placeholder="select event image"
                           hx-post="<?=base_url()?>/htmx/set-image-display"
                           hx-trigger="keyup, changed delay:250ms"
                           hx-target="#display-preview-image"
                           hx-swap="innerHTML">
                        <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
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

         <div class="col-sm-12 col-md-6 mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="text" class="form-control future-datepicker" id="start_date" name="start_date" autocomplete="off" value="<?= set_value('start_date') ?>" required>
            <!-- Error -->
            <?php if($validation->getError('start_date')) {?>
            <div class='text-danger mt-2'>
               <?= $error = $validation->getError('start_date'); ?>
            </div>
            <?php }?>
            <div class="invalid-feedback">
               Please provide start_date
            </div>
         </div>

         <div class="col-sm-12 col-md-6 mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="text" class="form-control time-picker" id="start_time" name="start_time" autocomplete="off" value="<?= set_value('start_time') ?>" required>
            <!-- Error -->
            <?php if($validation->getError('start_time')) {?>
            <div class='text-danger mt-2'>
               <?= $error = $validation->getError('start_time'); ?>
            </div>
            <?php }?>
            <div class="invalid-feedback">
               Please provide start_time
            </div>
         </div>

         <div class="col-sm-12 col-md-6 mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="text" class="form-control future-datepicker" id="end_date" name="end_date" autocomplete="off" value="<?= set_value('end_date') ?>" required>
            <!-- Error -->
            <?php if($validation->getError('end_date')) {?>
            <div class='text-danger mt-2'>
               <?= $error = $validation->getError('end_date'); ?>
            </div>
            <?php }?>
            <div class="invalid-feedback">
               Please provide end_date
            </div>
         </div>

         <div class="col-sm-12 col-md-6 mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="text" class="form-control time-picker" id="end_time" name="end_time" autocomplete="off" value="<?= set_value('end_time') ?>" required>
            <!-- Error -->
            <?php if($validation->getError('end_time')) {?>
            <div class='text-danger mt-2'>
               <?= $error = $validation->getError('end_time'); ?>
            </div>
            <?php }?>
            <div class="invalid-feedback">
               Please provide end_time
            </div>
         </div>

         <div class="col-sm-12 col-md-12 mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="<?= set_value('location') ?>" required>
            <!-- Error -->
            <?php if($validation->getError('location')) {?>
            <div class='text-danger mt-2'>
               <?= $error = $validation->getError('location'); ?>
            </div>
            <?php }?>
            <div class="invalid-feedback">
               Please provide location
            </div>
         </div>

         <div class="col-sm-12 col-md-12 mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea rows="1" class="form-control content-editor" id="content" name="content" required><?= set_value('content') ?></textarea>
            <!-- Error -->
            <?php if($validation->getError('content')) {?>
            <div class='text-danger mt-2'>
               <?= $error = $validation->getError('content'); ?>
            </div>
            <?php }?>
            <div class="invalid-feedback">
               Please provide content
            </div>
         </div>

         <div class="row mb-3">
            <div class="col-sm-12 col-md-4">
                <label for="registration_link_label" class="form-label">Registration Link Label</label>
                <input type="text" class="form-control" id="registration_link_label" name="registration_link_label" value="<?= set_value('registration_link_label') ?>">
                <!-- Error -->
                <?php if($validation->getError('registration_link_label')) {?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('registration_link_label'); ?>
                </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide registration_link_label
                </div>
            </div>

            <div class="col-sm-12 col-md-5">
                <label for="registration_link" class="form-label">Registration Link</label>
                <input type="text" class="form-control" id="registration_link" name="registration_link" value="<?= set_value('registration_link') ?>">
                <!-- Error -->
                <?php if($validation->getError('registration_link')) {?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('registration_link'); ?>
                </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide registration_link
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

         <div class="col-sm-12 col-md-12 mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
               <option value="">Select status</option>
               <option value="0">Unpublished</option>
               <option value="1">Published</option>
            </select>
            <!-- Error -->
            <?php if($validation->getError('status')) {?>
            <div class='text-danger mt-2'>
               <?= $error = $validation->getError('status'); ?>
            </div>
            <?php }?>
            <div class="invalid-feedback">
               Please provide status
            </div>
         </div>

         <div class="col-12 mb-3">
            <div class="accordion accordion-flush" id="accordionFlushExample">
               <div class="accordion-item">
                  <h2 class="accordion-header">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                     SEO Data
                     </button>
                  </h2>
                  <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                     <div class="accordion-body">
                        <div class="row">
                           <div class="col-12 mb-3">
                                 <div class="d-flex justify-content-between align-items-center">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn" data-target="meta_title"
                                    hx-post="<?=base_url()?>/htmx/set-meta-title-via-ai"
                                    hx-trigger="click delay:250ms"
                                    hx-target="#meta-title-div"
                                    hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                                 </div>
                                 <div id="meta-title-div">
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= set_value('meta_title') ?>">
                                 </div>
                                 <?php if($validation->getError('meta_title')) {?>
                                    <div class='text-danger mt-2'>
                                       <?= $error = $validation->getError('meta_title'); ?>
                                    </div>
                                 <?php }?>
                                 <div class="invalid-feedback">
                                    Please provide meta_title
                                 </div>
                           </div>
                           <div class="col-12 mb-3">
                                 <div class="d-flex justify-content-between align-items-center">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn" data-target="meta_description"
                                    hx-post="<?=base_url()?>/htmx/set-meta-description-via-ai"
                                    hx-trigger="click delay:250ms"
                                    hx-target="#meta-description-div"
                                    hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                                 </div>
                                 <div id="meta-description-div">
                                    <textarea class="form-control" id="meta_description" name="meta_description" ><?= set_value('meta_description') ?></textarea>
                                 </div>
                                 <?php if($validation->getError('meta_description')) {?>
                                    <div class='text-danger mt-2'>
                                       <?= $error = $validation->getError('meta_description'); ?>
                                    </div>
                                 <?php }?>
                                 <div class="invalid-feedback">
                                    Please provide meta_description
                                 </div>
                           </div>
                           <div class="col-12 mb-3">
                                 <div class="d-flex justify-content-between align-items-center">
                                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                    <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn" data-target="meta_keywords"
                                    hx-post="<?=base_url()?>/htmx/set-meta-keywords-via-ai"
                                    hx-trigger="click delay:250ms"
                                    hx-target="#meta-keywords-div"
                                    hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                                 </div>
                                 <div id="meta-keywords-div" hx-on:htmx:after-settle="setTagsInput('meta_keywords')">
                                    <textarea rows="1" class="form-control tags-input" id="meta_keywords" name="meta_keywords"><?= set_value('meta_keywords') ?></textarea>
                                 </div>
                                 <?php if($validation->getError('meta_keywords')) {?>
                                    <div class='text-danger mt-2'>
                                       <?= $error = $validation->getError('meta_keywords'); ?>
                                    </div>
                                 <?php }?>
                                 <div class="invalid-feedback">
                                    Please provide meta_keywords
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="mb-3 mt-3">
            <a href="<?= base_url('/account/cms/events') ?>" class="btn btn-outline-danger">
                <i class="ri-arrow-left-fill"></i>
                Back
            </a>
            <button type="submit" class="btn btn-outline-primary float-end" id="submit-btn">
                <i class="ri-send-plane-fill"></i>
                Submit
            </button>
         </div>
      </div>
      <?php echo form_close(); ?>
   </div>
</div>

<script>
    // Initialize tags input
    function setTagsInput(inputId){
        $('#'+inputId).tagsInput();
        $('#'+inputId).css('width', '100%');
    }
</script>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>
<!-- end main content -->
<?= $this->endSection() ?>