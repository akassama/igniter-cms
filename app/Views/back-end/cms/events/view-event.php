<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>
<!-- begin main content -->
<?= $this->section('content') ?>
<?php
   // Breadcrumbs
   $breadcrumb_links = array(
       array('title' => 'Dashboard', 'url' => '/account'),
       array('title' => 'CMS', 'url' => '/account/cms'),
       array('title' => 'Events', 'url' => '/account/cms/events'),
       array('title' => 'View Event')
   );
   echo generateBreadcrumb($breadcrumb_links);
   ?>
<div class="row">
   <!--Content-->
   <div class="col-12">
      <h3>View Event</h3>
   </div>
   <div class="col-12 bg-light rounded p-4">
    <div class="row">
         <div class="col-sm-12 col-md-12 mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= $event_data['title'] ?>" readonly>
         </div>

         <div class="col-sm-12 col-md-12 mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea rows="1" class="form-control" id="description" name="description" readonly><?= $event_data['description'] ?></textarea>
         </div>

         <div class="col-sm-12 col-md-12 mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="<?= $event_data['slug'] ?>" readonly>
         </div>

         <div class="col-12">
            <div class="row">
               <div class="col-12" id="display-preview-image">
                  <div class="float-end">         
                     <img src="<?= getImageUrl($event_data['image'] ?? getDefaultImagePath())?>" class="img-thumbnail" alt="Featured image" width="150" height="150"> 
                  </div>
               </div>
               <div class="col-sm-12 col-md-12 mb-3">
                  <label for="image" class="form-label">Event Image</label>
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" id="image" name="image" placeholder="select event image" value="<?= $event_data['image'] ?>" readonly>
                     <button class="btn btn-dark" type="button">
                     <i class="ri-image-fill"></i>
                     </button>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-sm-12 col-md-6 mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="text" class="form-control" id="start_date" name="start_date" value="<?= $event_data['start_date'] ?>" readonly>
         </div>

         <div class="col-sm-12 col-md-6 mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="text" class="form-control" id="start_time" name="start_time" value="<?= $event_data['start_time'] ?>" readonly>
         </div>

         <div class="col-sm-12 col-md-6 mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="text" class="form-control" id="end_date" name="end_date" value="<?= $event_data['end_date'] ?>" readonly>
         </div>

         <div class="col-sm-12 col-md-6 mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="text" class="form-control" id="end_time" name="end_time" value="<?= $event_data['end_time'] ?>" readonly>
         </div>

         <div class="col-sm-12 col-md-12 mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="<?= $event_data['location'] ?>" readonly>
         </div>

         <div class="col-sm-12 col-md-12 mb-3">
            <label for="content" class="form-label">Content</label>
            <div class="border border-dark rounded p-2" id="content" name="content"><?= $event_data['content'] ?></div>
         </div>

         <div class="row mb-3">
            <div class="col-sm-12 col-md-4">
                <label for="registration_link_label" class="form-label">Registration Link Label</label>
                <input type="text" class="form-control" id="registration_link_label" name="registration_link_label" value="<?= $event_data['registration_link_label'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-5">
                <label for="registration_link" class="form-label">Registration Link</label>
                <input type="text" class="form-control" id="registration_link" name="registration_link" value="<?= $event_data['registration_link'] ?>" readonly>
            </div>

            <div class="col-sm-12 col-md-3">
                <label for="new_tab" class="form-label">New Tab</label>
                <input type="text" class="form-control" id="new_tab" name="new_tab" value="<?= ($event_data['new_tab'] == '0') ? 'No' : 'Yes'?>" readonly>
            </div>
         </div>

         <div class="col-sm-12 col-md-6 mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" class="form-control" id="status" name="status" value="<?= ($event_data['status'] == '0') ? 'Unpublished' : 'Published'?>" readonly>
         </div>

         <div class="col-12 mb-3">
            <div class="accordion accordion-flush" id="accordionFlushExample">
               <div class="accordion-item">
                  <h2 class="accordion-header">
                     <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                     SEO Data
                     </button>
                  </h2>
                  <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                     <div class="accordion-body">
                        <div class="row">
                           <div class="col-12 mb-3">
                              <label for="meta_title" class="form-label">Meta Title</label>
                              <div id="meta-title-div">
                                 <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $event_data['meta_title'] ?>" readonly>
                              </div>
                           </div>
                           <div class="col-12 mb-3">
                              <label for="meta_description" class="form-label">Meta Description</label>
                              <div id="meta-description-div">
                                 <textarea type="text" class="form-control" id="meta_description" name="meta_description" readonly><?= $event_data['meta_description'] ?></textarea>
                              </div>
                           </div>
                           <div class="col-12 mb-3">
                              <label for="meta_keywords" class="form-label">Meta Keywords</label>
                              <div id="meta-keywords-div">
                                 <input type="text" class="form-control tags-input" id="meta_keywords" name="meta_keywords" value="<?= $event_data['meta_keywords'] ?>" readonly>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
            
         <!-- entry data -->
         <div class="col-sm-12 col-md-6 mb-3">
               <label for="created_by" class="form-label">Created BY</label>
               <input type="text" class="form-control" id="created_by" name="created_by" maxlength="250" value="<?= getActivityBy(esc($event_data['created_by']) , ""); ?>" readonly>
         </div>
         <div class="col-sm-12 col-md-6 mb-3">
               <label for="updated_by" class="form-label">Updated BY</label>
               <input type="text" class="form-control" id="updated_by" name="updated_by" maxlength="250" value="<?= getActivityBy(esc($event_data['updated_by']) , ""); ?>" readonly>
         </div>

         <div class="mb-3 mt-3">
            <a href="<?= base_url('/account/cms/events') ?>" class="btn btn-outline-danger">
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