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
    <div class="col-12 d-flex justify-content-between my-2">
        <div>
            <a href="#!" class="btn btn-outline-danger mx-1"  onclick="deletePluginData()">
                <i class="ri-upload-2-fill"></i> Remove Plugin Data
            </a>
        </div>
        <div>
            <a href="<?=base_url('/account/plugins/upload-plugin')?>" class="btn btn-outline-success mx-1">
                <i class="ri-upload-2-fill"></i> Upload Plugin
            </a>
            <a href="<?=base_url('/account/plugins/install-plugins')?>" class="btn btn-outline-dark mx-1">
                <i class="ri-add-fill"></i> Add Plugin
            </a>
        </div>
    </div>

   <!--Content-->
   <div class="col-12">
      <div class="card p-2 mb-4">
         <!-- Dropdown + Apply Button -->
         <!-- <div class="d-flex align-items-center mb-3">
            <select class="form-select me-2" style="width: 200px;">
               <option selected>Bulk Actions</option>
               <option value="update">Activate Selected</option>
               <option value="update">Deactivate Selected</option>
               <option value="delete">Delete Selected</option>
            </select>
            <button class="btn btn-primary">Apply</button>
         </div> -->
         <?php if ($plugins): ?>
            <!-- Plugins Table -->
            <table class="table table-bordered datatable">
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
                        <?php
                            $pluginStatus = getTableData("plugins", ['plugin_key' => $plugin['slug']], "status");
                            $updateAvailable = getTableData("plugins", ['plugin_key' => $plugin['slug']], "update_available");
                        ?>
                        <tr>
                            <td><input class="form-check-input row-checkbox" type="checkbox"></td>
                            <td><?= esc($plugin['name']) ?></td>
                            <td>
                                <p><?= esc($plugin['description']) ?></p>
                                <small class="text-muted">
                                    Version <?= esc($plugin['version']) ?> | 
                                    By <?= esc($plugin['author']) ?> | 
                                    <a href="#!" class="view-details" data-slug="<?= esc($plugin['slug']) ?>" data-bs-toggle="modal" data-bs-target="#pluginModalId">View details</a>
                                </small>
                                <?php if ($updateAvailable == "1"): ?>
                                    |  <a href="<?=base_url('account/plugins/install-plugins?q='.$plugin['slug'])?>" class="me-1 text-success">Update Available</a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($pluginStatus == "1"): ?>
                                    <a href="<?=base_url('account/plugins/manage/'.$plugin['slug'])?>" class="btn btn-sm btn-outline-primary me-1 mb-1">Manage</a>
                                <?php endif; ?>
                                <?php if ($pluginStatus == "0"): ?>
                                    <a href="<?=base_url('account/plugins/activate-plugin/'.$plugin['slug'])?>" class="btn btn-sm btn-outline-success me-1 mb-1">Activate</a>
                                <?php elseif ($pluginStatus == "1"): ?>
                                    <a href="<?=base_url('account/plugins/deactivate-plugin/'.$plugin['slug'])?>" class="btn btn-sm btn-outline-warning text-dark me-1 mb-1">Deactivate</a>
                                <?php endif; ?>

                                <a href="#!" class="btn btn-sm btn-outline-danger me-1 mb-1" onclick="confirmDelete('<?=$plugin['name']?>', '<?=$plugin['slug']?>')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
         <?php else : ?>
            <p>No plugins are currently available.</p>
         <?php endif; ?>

         <!-- jQuery for "Select All" and Modal Content Loading -->
         <script>
            // Select All functionality
            $('#select-all').on('change', function () {
                $('.row-checkbox').prop('checked', this.checked);
            });
            
            $('.row-checkbox').on('change', function () {
                $('#select-all').prop('checked', 
                $('.row-checkbox:checked').length === $('.row-checkbox').length
                );
            });
            
            // Delete Plugin Data Prompt
            function deletePluginData() {
                Swal.fire({
                    title: 'Remove Plugin Data',
                    html: `
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="manualInputToggle">
                            <label class="form-check-label" for="manualInputToggle">
                                Type plugin key manually
                            </label>
                        </div>
                        <div id="selectWrapper" class="mb-2">
                            <label for="plugin_key_select" class="form-label">Select Plugin</label>
                            <select id="plugin_key_select" class="form-select">
                                <?= getPluginSelectOptions() ?>
                            </select>
                        </div>
                        <div id="textWrapper" class="mb-2 d-none">
                            <label for="plugin_key_text" class="form-label">Enter Plugin Key</label>
                            <input type="text" id="plugin_key_text" class="form-control" placeholder="e.g. plugin_example">
                        </div>
                    `,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Delete Data!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true,
                    focusConfirm: false,
                    didOpen: () => {
                        const toggle = document.getElementById('manualInputToggle');
                        const selectWrapper = document.getElementById('selectWrapper');
                        const textWrapper = document.getElementById('textWrapper');

                        toggle.addEventListener('change', () => {
                            if (toggle.checked) {
                                selectWrapper.classList.add('d-none');
                                textWrapper.classList.remove('d-none');
                            } else {
                                selectWrapper.classList.remove('d-none');
                                textWrapper.classList.add('d-none');
                            }
                        });
                    },
                    preConfirm: () => {
                        const manualChecked = document.getElementById('manualInputToggle').checked;
                        const pluginKey = manualChecked
                            ? document.getElementById('plugin_key_text').value.trim()
                            : document.getElementById('plugin_key_select').value;

                        if (!pluginKey) {
                            Swal.showValidationMessage('Please enter or select a plugin key');
                        }

                        return pluginKey;
                    },
                    customClass: {
                        popup: 'swal-custom'
                    }
                }).then((result) => {
                    if (result.isConfirmed && result.value) {
                        // Create the form element
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `<?= base_url('/account/plugins/delete-plugin') ?>`;

                        // Add plugin input field
                        const pluginInput = document.createElement('input');
                        pluginInput.type = 'hidden';
                        pluginInput.name = 'plugin_key';
                        pluginInput.value = result.value;
                        form.appendChild(pluginInput);

                        // Submit the form
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }

            // Confirm Delete functionality
            function confirmDelete(pluginName, pluginSlug) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: `Are you sure you want to delete the "${pluginName}" plugin and its data?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true,
                    customClass: {
                        popup: 'swal-custom'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create the form element
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `<?= base_url('/account/plugins/delete-plugin') ?>`;

                        // Add hidden input fields
                        const tableNameInput = document.createElement('input');
                        tableNameInput.type = 'hidden';
                        tableNameInput.name = 'plugin_key';
                        tableNameInput.value = pluginSlug;
                        form.appendChild(tableNameInput);

                        // Append the form to the body and submit it
                        document.body.appendChild(form);
                        form.submit();

                        // Remove the form from the body after submit
                        document.body.removeChild(form);
                    }
                });
            }

            // Load plugin instructions via AJAX
            $(document).ready(function() {
                $('.view-details').on('click', function() {
                    const slug = $(this).data('slug');
                    $.ajax({
                        url: '<?= base_url('/account/plugins/instructions/') ?>' + slug,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.content) {
                                $('#plugin-instructions-div').html(response.content);
                            } else {
                                $('#plugin-instructions-div').html('<p>Error loading instructions.</p>');
                            }
                        },
                        error: function() {
                            $('#plugin-instructions-div').html('<p>Failed to load instructions. Please try again.</p>');
                        }
                    });
                });
            });
         </script>
      </div>
   </div>
</div>

<!-- Plugin Instructions Modal -->
<div class="modal fade" id="pluginModalId">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="plugin-instructions-div">
        <!-- Instructions content will be loaded here -->
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end main content -->
<?= $this->endSection() ?>