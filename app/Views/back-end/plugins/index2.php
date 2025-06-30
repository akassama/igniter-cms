<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>
<!-- begin main content -->
<?= $this->section('content') ?>
<h1 class="mt-4">Plugins</h1>
<?php
   // Breadcrumbs
   $breadcrumb_links = array(
       array('title' => 'Dashboard', 'url' => '/account'),
       array('title' => 'Plugins')
   );
   echo generateBreadcrumb($breadcrumb_links);
   ?>
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="input-group">
                <select class="form-select" id="actionDropdown">
                    <option selected>Choose action...</option>
                    <option value="activate">Activate</option>
                    <option value="deactivate">Deactivate</option>
                    <option value="delete">Delete</option>
                </select>
                <button class="btn btn-outline-secondary" type="button" id="applyButton">Apply</button>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th width="50px">
                    <input class="form-check-input" type="checkbox" id="select-all">
                </th>
                <th>Plugin</th>
                <th>Description</th>
                <th width="200px">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($plugins as $plugin): ?>
            <tr>
                <td>
                    <input class="form-check-input row-checkbox" type="checkbox">
                </td>
                <td>
                    <?= esc($plugin) ?>
                </td>
                <td>
                    <p>Plugin description will go here.</p>
                    <small class="text-muted">
                        Version 1.0.0 | By Author | <a href="#">View details</a>
                    </small>
                </td>
                <td>
                    <a href="#" class="btn btn-sm btn-outline-secondary me-1">Update</a>
                    <a href="#" class="btn btn-sm btn-outline-danger me-1">Delete</a>
                    <a href="#" class="btn btn-sm btn-outline-success me-1">Activate</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        // Select all checkboxes when header checkbox is clicked
        $('#select-all').click(function() {
            $('.row-checkbox').prop('checked', this.checked);
        });
        
        // Uncheck "select all" if any row checkbox is unchecked
        $('.row-checkbox').click(function() {
            if (!$(this).prop('checked')) {
                $('#select-all').prop('checked', false);
            }
            
            // Check if all row checkboxes are checked
            if ($('.row-checkbox:checked').length === $('.row-checkbox').length) {
                $('#select-all').prop('checked', true);
            }
        });
        
        // Apply button functionality
        $('#applyButton').click(function() {
            const selectedAction = $('#actionDropdown').val();
            const selectedPlugins = [];
            
            $('.row-checkbox:checked').each(function() {
                const pluginName = $(this).closest('tr').find('td:nth-child(2)').text();
                selectedPlugins.push(pluginName);
            });
            
            if (selectedPlugins.length === 0) {
                alert('Please select at least one plugin.');
                return;
            }
            
            // You can replace this with an AJAX call to your controller
            console.log(`Action: ${selectedAction}`);
            console.log(`Selected Plugins: ${selectedPlugins.join(', ')}`);
            alert(`Applying "${selectedAction}" to: ${selectedPlugins.join(', ')}`);
        });
    });
</script>
<!-- end main content -->
<?= $this->endSection() ?>