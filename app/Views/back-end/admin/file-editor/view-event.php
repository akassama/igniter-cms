<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$userRole = getUserRole($sessionEmail);
?>

<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Event File Editor<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'File Editor', 'url' => '/account/admin/file-editor'),
    array('title' => 'Edit View Event File')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>File Editor</h3>
    </div>
    <div class="col-12">  
        <form id="saveFileForm" method="post" action="<?= base_url('account/admin/file-editor/save-file') ?>">
            <!--Edit Card-->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <a href="<?= base_url('/account/admin/file-editor') ?>" class="btn btn-outline-danger">
                            <i class="ri-arrow-left-fill"></i> Back
                        </a>
                    </div>
                    <div>
                        <i class="ri-file-edit-line"></i>
                        Editing <?='.../Views/front-end/themes/'.getCurrentTheme().'/events/'.$viewEventFilename?>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="ri-save-line"></i> Save File
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <?php if (session()->has('success')): ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <?= session('success') ?>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->has('error')): ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <?= session('error') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="editor" style="height: 60em; width: 100%;"><?= htmlspecialchars($viewEventFileContent) ?></div>
                    <input type="hidden" name="filePath" value="<?= $viewEventFilePath ?>">
                    <input type="hidden" name="filePage" value="view-event">
                    <textarea name="fileContent" id="fileContent" style="display:none;"></textarea>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/php");

        document.getElementById('saveFileForm').addEventListener('submit', function() {
            document.getElementById('fileContent').value = editor.getValue();
        });
    });
</script>

<!-- end main content -->
<?= $this->endSection() ?>