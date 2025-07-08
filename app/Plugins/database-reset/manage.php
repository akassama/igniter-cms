
<div class="container-fluid p-3">
    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-12">
            <div class="row mb-4">
                <h4 class="mb-1">Database Reset</h4>
                <p class="text-danger small">Warning! - The following table details what data will be deleted (reset or destroyed) when a selected reset tool is run. </p>
            </div>
            <?php $validation = \Config\Services::validation(); ?>
            <?php echo form_open(base_url('account/plugins/manage/database-reset'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
                <!-- Reset Options -->
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="reset_posts" name="reset_posts" value="true">
                            <label class="form-check-label" for="reset_posts">Reset Posts</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="reset_pages" name="reset_pages" value="true">
                            <label class="form-check-label" for="reset_pages">Reset Pages</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="clear_files" name="clear_files" value="true">
                            <label class="form-check-label" for="clear_files">Clear Files</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="clear_plugins" name="clear_plugins" value="true">
                            <label class="form-check-label" for="clear_plugins">Clear Plugins</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="clear_users" name="clear_users" value="true">
                            <label class="form-check-label" for="clear_users">Clear Users</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="clear_themes" name="clear_themes" value="true">
                            <label class="form-check-label" for="clear_themes">Clear Themes</label>
                        </div>
                    </div>
                </div>

                <!-- Hidden Inputs -->
                <div class="row" style="display:none;">
                    <div class="col-12">
                        <input type="text" class="form-control" id="plugin_url_parameter" name="plugin_url_parameter" placeholder="e.g. tab=home" value="">
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success me-2">
                            <i class="ri-refresh-line"></i> Reset Site
                        </button>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

});
</script>