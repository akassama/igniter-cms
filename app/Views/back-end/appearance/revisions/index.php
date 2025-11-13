<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Theme Revisions<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Appearance', 'url' => '/account/appearance'),
    array('title' => 'Theme Revisions')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Activity Logs</h3>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Activities
                <span class="badge rounded-pill bg-dark">
                    <?= $total_revisions ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable-1000">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Created By</th>
                            <th>Theme</th>
                            <th>Path</th>
                            <th>Content</th>
                            <th>Date/Time</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($theme_revisions): ?>
                            <?php foreach($theme_revisions as $revision): ?>
                                <?php $revisionId = esc($revision['theme_revision_id']); ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <span class="text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="User ID: <?= esc($revision['created_by']) ?>">
                                            <?= getActivityBy(esc($revision['created_by'])) ?>
                                        </span>
                                    </td>
                                    <td><?= esc($revision['theme_name']) ?></td>
                                    <td><?= esc($revision['file_path']) ?></td>
                                    <td>
                                        <a href="#!" class="btn btn-outline-primary btn-sm view-content-btn"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#contentModal"
                                        data-revision-id="<?= $revisionId ?>"
                                        data-file-path="<?= esc($revision['file_path']) ?>"
                                        data-created-at="<?= esc($revision['created_at']) ?>">
                                            View Content <i class="ri-expand-diagonal-fill"></i>
                                        </a>
                                        
                                        <textarea id="content-<?= $revisionId ?>" style="display:none;"><?= esc($revision['file_content']) ?></textarea>
                                    </td>
                                    <td><?= esc($revision['created_at']) ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-blog" href="#!" onclick="deleteRecord('theme_revisions', 'theme_revision_id', '<?=$revisionId;?>', '', 'account/appearance/theme-editor/revisions')">
                                                    <i class="h5 ri-close-circle-fill"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php $rowCount++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
        if($total_revisions > 100){
            ?>
                <!--Show pagination if more than 100 records-->
                <div class="col-12 text-start">
                    <p>Pagination</p>
                    <?= $pager->links('default', 'bootstrap') ?>
                </div>
            <?php
        }
    ?>
</div>

<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<div class="modal fade" id="contentModal" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contentModalLabel">View File Revision Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    <span class="badge bg-secondary" id="modal-file-path"></span>
                    <span class="badge bg-secondary" id="modal-created-at"></span>
                </p>
                <div class="position-relative">
                    <button class="btn btn-sm btn-info copy-modal-btn position-absolute top-0 end-0 m-2 z-10" 
                            data-clipboard-target="#file-content-display">
                        <i class="ri-file-copy-line"></i> Copy Code
                    </button>
                    <pre id="file-content-display" 
                         style="background-color: #f8f9fa; padding: 15px; border: 1px solid #dee2e6; border-radius: 0.25rem; max-height: 70vh; overflow: auto; white-space: pre-wrap; word-wrap: break-word;"></pre>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        const contentModal = document.getElementById('contentModal');

        // Use the Bootstrap event for when the modal is about to be shown
        contentModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const revisionId = button.getAttribute('data-revision-id');
            const filePath = button.getAttribute('data-file-path');
            const createdAt = button.getAttribute('data-created-at');
            
            const contentSource = document.getElementById('content-' + revisionId);
            if (!contentSource) return;

            const content = contentSource.value;
            
            document.getElementById('modal-file-path').textContent = 'File: ' + filePath;
            document.getElementById('modal-created-at').textContent = 'Date: ' + createdAt;
            document.getElementById('file-content-display').textContent = content;
        });
        
        // Copy functionality with modern API fallback
        document.addEventListener('click', function(e) {
            if (e.target.closest('.copy-modal-btn')) {
                e.preventDefault();
                copyContent();
            }
        });

        function copyContent() {
            const textToCopy = document.getElementById('file-content-display').textContent;
            
            // Try modern Clipboard API first
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(textToCopy).then(function() {
                    showCopySuccess();
                }).catch(function(err) {
                    console.error('Modern API failed, falling back:', err);
                    fallbackCopy(textToCopy);
                });
            } else {
                // Use fallback method
                fallbackCopy(textToCopy);
            }
        }

        function fallbackCopy(text) {
            const tempTextArea = document.createElement('textarea');
            tempTextArea.value = text;
            tempTextArea.style.position = 'fixed';
            tempTextArea.style.left = '0';
            tempTextArea.style.top = '0';
            tempTextArea.style.opacity = '0';
            document.body.appendChild(tempTextArea);
            
            tempTextArea.focus();
            tempTextArea.select();
            
            try {
                const successful = document.execCommand('copy');
                document.body.removeChild(tempTextArea);
                
                if (successful) {
                    showCopySuccess();
                } else {
                    toastr.error("Copy failed! Please try again.", "", { timeOut: 2000 });
                }
            } catch (err) {
                document.body.removeChild(tempTextArea);
                console.error('Fallback copy failed:', err);
                toastr.error("Copy not supported in this browser!", "", { timeOut: 2000 });
            }
        }

        function showCopySuccess() {
            // Visual feedback on button
            const btn = document.querySelector('.copy-modal-btn');
            const originalHtml = btn.innerHTML;
            const originalBg = btn.style.backgroundColor;
            
            btn.innerHTML = '<i class="ri-check-line"></i> Copied!';
            btn.style.backgroundColor = '#28a745';
            
            setTimeout(() => {
                btn.innerHTML = originalHtml;
                btn.style.backgroundColor = originalBg;
            }, 2000);
        }

    })();
</script>

<!-- end main content -->
<?= $this->endSection() ?>
