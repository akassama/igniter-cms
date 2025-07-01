<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Manage Plugins<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
   // Breadcrumbs
   $breadcrumb_links = array(
       array('title' => 'Dashboard', 'url' => '/account'),
       array('title' => 'Plugins')
   );
   echo generateBreadcrumb($breadcrumb_links);
   ?>
<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Plugins</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/plugins/upload-plugin')?>" class="btn btn-outline-success mx-1">
            <i class="ri-upload-2-fill"></i> Upload Plugin
        </a>
        <a href="<?=base_url('/account/plugins/install-plugins')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> Add Plugin
        </a>
    </div>
   <!--Content-->
   <div class="col-12">
      <div class="card p-2 mb-4">
         <!-- Dropdown + Apply Button -->
         <div class="d-flex align-items-center mb-3">
            <select class="form-select me-2" style="width: 200px;">
               <option selected>Bulk Actions</option>
               <option value="update">Activate Selected</option>
               <option value="update">Dectivate Selected</option>
               <option value="delete">Delete Selected</option>
            </select>
            <button class="btn btn-primary">Apply</button>
         </div>
         <?php if ($plugins): ?>
            <!-- Plugins Table -->
            <table class="table table-bordered">
                <thead class="table-light">
                <tr>
                        <th>
                            <input class="form-check-input" type="checkbox" id="select-all">
                        </th>
                        <th>
                            Plugin
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Actions
                        </th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($plugins as $plugin): ?>
                        <tr>
                            <td><input class="form-check-input row-checkbox" type="checkbox"></td>
                            <td><?= esc($plugin['name']) ?></td>
                            <td>
                                <p><?= esc($plugin['description']) ?></p>
                                <small class="text-muted">
                                    Version <?= esc($plugin['version']) ?> | 
                                    By <?= esc($plugin['author']) ?> | 
                                    <a href="<?= esc($plugin['plugin_url']) ?>" target="_blank">View details</a>
                                </small>
                            </td>
                            <td>
                                <a href="<?=base_url('account/plugins/manage/'.$plugin['slug'])?>" class="btn btn-sm btn-outline-primary me-1">Manage</a>
                                <a href="#" class="btn btn-sm btn-outline-success me-1">Activate</a>
                                <a href="#" class="btn btn-sm btn-outline-danger me-1">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
         <?php else : ?>
            <p>No plugins are currently available.</p>
         <?php endif; ?>

         <!-- jQuery for "Select All" -->
         <script>
            $('#select-all').on('change', function () {
                $('.row-checkbox').prop('checked', this.checked);
            });
            
            $('.row-checkbox').on('change', function () {
                $('#select-all').prop('checked', 
                $('.row-checkbox:checked').length === $('.row-checkbox').length
                );
            });
         </script>
      </div>
   </div>
</div>
<!-- end main content -->
<?= $this->endSection() ?>