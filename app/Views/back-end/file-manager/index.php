<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Manage Files<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'File Manager')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<style>
.modal-xl {
    max-width: 90vw !important;
}

.img-container {
    overflow: hidden;
    position: relative;
}

.img-container img {
    display: block;
    max-width: 100%;
    max-height: 100%;
}

/* Make sure the cropper container takes full height */
.cropper-container {
    height: 100% !important;
}
</style>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>
            Manage Files
        </h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/file-manager/upload-file')?>" class="btn btn-outline-dark mx-1">
        <i class="ri-upload-cloud-fill"></i> Upload
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Files
                <span class="badge rounded-pill bg-dark">
                    <?= $total_file_uploads ?>
                </span>

                <a href="<?=base_url('/account/file-manager')?>" class="text-dark td-none float-end reload-files">
                    <i class="ri-refresh-line"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!--Content-->
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Preview</th>
                            <th>File</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Uploaded At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                            <?php if($file_uploads): ?>
                                <?php foreach($file_uploads as $file): ?>
                                    <tr>
                                        <td><?= $rowCount; ?></td>
                                        <td>
                                            <?= getFileInputPreview($file['upload_path'], $file['file_type'], 100) ?>
                                        </td>
                                        <td>
                                            <div class="input-group col-12 mb-3">
                                                <span class="input-group-text">
                                                <?= getFileInputIcon($file['file_type']) ?>
                                                </span>
                                                <input type="text" class="form-control" id="name-<?= esc($file['file_id']) ?>" value="<?= esc($file['file_name']) ?>" readonly />
                                                <span class="input-group-text">
                                                    <button class="btn btn-outline-secondary copy-btn copy-btn-label" type="button" id="button-addon2" data-clipboard-target="#name-<?= esc($file['file_id']) ?>">
                                                        <i class="ri-checkbox-multiple-fill"></i>
                                                    </button>
                                                </span>
                                                <span class="d-none">
                                                    <!--Search Terms-->
                                                    <?= $file['file_id']; ?>,<?= $file['file_type']; ?>,<?= $file['file_name']; ?>,<?= $file['caption']; ?>,<?= $file['unique_identifier']; ?>
                                                </span>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <a href="javascript:void(0)" class="text-dark td-none float-end edit-file"
                                                        hx-indicator="#spinner_<?=$file['file_id']?>"
                                                        hx-get="<?=base_url()?>/htmx/get-file-data-form/<?=$file['file_id']?>"
                                                        hx-trigger="click"
                                                        hx-target="#file-details-<?= esc($file['file_id']) ?>"
                                                        hx-swap="innerHTML">
                                                        <i class="ri-edit-2-fill"></i>
                                                    </a>
                                                    <img id="spinner_<?=$file['file_id']?>" class="htmx-indicator" src="<?=base_url('/public/back-end/assets/img/loading.gif')?>"/>
                                                </div>
                                                <div class="col-12 p-2" id="file-details-<?= esc($file['file_id']) ?>">
                                                    <?= getFileDetailsList($file['file_id']) ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= esc($file['file_type']) ?></td>
                                        <td><?= displayFileSize($file['file_size']) ?> </td>
                                        <td><?= date('Y-m-d H:i:s', strtotime($file['created_at'])) ?></td>
                                        <td>
                                            <div class="row text-center p-1">
                                                <?php if(isValidImage($file['file_type'])):?>
                                                    <!--If image type-->
                                                    <div class="col mb-1">
                                                        <a class="text-dark td-none mr-1 mb-1" href="javascript:void(0)" 
                                                        onclick="initImageEditor('<?= getImageUrl($file['upload_path']); ?>', '<?= $file['file_id']; ?>')" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#imageEditModal">
                                                            <i class="h5 ri-edit-box-line"></i>
                                                        </a>
                                                    </div>
                                                <?php endif;?>
                                                <div class="col mb-1">
                                                    <a class="text-dark td-none mr-1 mb-1 copy-btn copy-path-label" href="javascript:void(0)" data-clipboard-text="<?= $file['upload_path']; ?>">
                                                        <i class="h5 ri-file-copy-2-line" data-clipboard-text="Sample copy text"></i>
                                                    </a>
                                                </div>
                                                <div class="col mb-1">
                                                    <?php
                                                        $upload_path = $file['upload_path'];
                                                        $link = base_url('account/file-manager/download/' . $file['file_id']);
                                                        $target = "_self";
                                                        if (strpos($upload_path, 'http') !== false || strpos($upload_path, 'www.') !== false) {
                                                            $link = $file['upload_path'];
                                                            $target = "_blank";
                                                        }
                                                    ?>
                                                    <a class="text-dark td-none mr-1 mb-1 download-btn" href="<?= $link ?>" target="<?= $target ?>">
                                                        <i class="h5 ri-download-2-line"></i>
                                                    </a>
                                                </div>
                                                <div class="col mb-1">
                                                    <?php
                                                        if($file['deletable'] == 1){
                                                            ?>
                                                                <a class="text-dark td-none mr-1 remove-file" href="javascript:void(0)" onclick="deleteFile('file_uploads', 'file_id', '<?=$file['file_id'];?>', '', '<?=$file['upload_path'];?>', 'account/file-manager')">
                                                                    <i class="h5 ri-close-circle-fill"></i>
                                                                </a>
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                                <a class="text-dark td-none mr-1 remove-file disabled text-muted" href="javascript:void(0)">
                                                                <i class="h5 ri-close-circle-fill"></i>
                                                            </a>
                                                            <?php
                                                        }
                                                    ?>
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
        if($total_file_uploads > 100){
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
<?=  $this->include('back-end/layout/assets/delete_file_prompt_script.php'); ?>

<div class="modal fade" id="imageEditModal" tabindex="-1">
    <div class="modal-dialog modal-xl"> <!-- Changed to modal-xl for larger size -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col">
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-secondary" id="moveBtn">
                                <i class="ri-drag-move-fill"></i> Move
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="cropBtn">
                                <i class="ri-crop-line"></i> Crop
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="rotateLeftBtn">
                                <i class="ri-anticlockwise-line"></i> Rotate Left
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="rotateRightBtn">
                                <i class="ri-clockwise-line"></i> Rotate Right
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Added fixed height container -->
                <div class="img-container" style="height: 500px; max-height: 70vh;">
                    <img id="image" src="" style="max-width: 100%; max-height: 100%;" class="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="cropButton">
                    <i class="ri-save-line"></i> Save Changes
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let cropper;
let currentFileId;

function initImageEditor(imageUrl, fileId) {
    currentFileId = fileId;
    const image = document.getElementById('image');
    image.src = imageUrl;
    
    // Wait for image to load before initializing cropper
    image.onload = function() {
        if (cropper) {
            cropper.destroy();
        }
        
        cropper = new Cropper(image, {
            viewMode: 1,           // Restrict the crop box to not exceed the size of the canvas
            dragMode: 'crop',      // Default to crop mode
            responsive: true,
            restore: true,
            autoCrop: true,
            movable: true,
            rotatable: true,
            scalable: true,
            zoomable: true,
            zoomOnTouch: true,
            zoomOnWheel: true,
            wheelZoomRatio: 0.1,   // Smoother zoom
            background: true,
            modal: true,           // Show the black modal
            guides: true,          // Show the dashed lines for guiding
            center: true,          // Show the center indicator in the crop box
            highlight: true,       // Show the white modal to highlight the crop box
            cropBoxMovable: true,  // The crop box can be moved by dragging
            cropBoxResizable: true, // The crop box can be resized by dragging
            toggleDragModeOnDblclick: true,
        });

        // Setup button event listeners after cropper is initialized
        setupButtonListeners();
    };
}

function setupButtonListeners() {
    // Move button
    document.getElementById('moveBtn').addEventListener('click', function() {
        cropper.setDragMode('move');
    });

    // Crop button
    document.getElementById('cropBtn').addEventListener('click', function() {
        cropper.setDragMode('crop');
    });

    // Rotate buttons
    document.getElementById('rotateLeftBtn').addEventListener('click', function() {
        cropper.rotate(-90);
    });

    document.getElementById('rotateRightBtn').addEventListener('click', function() {
        cropper.rotate(90);
    });
}

// Save functionality remains the same as before
document.getElementById('cropButton').addEventListener('click', function() {
    const canvas = cropper.getCroppedCanvas({
        maxWidth: 4096,
        maxHeight: 4096,
        fillColor: '#fff',
        imageSmoothingEnabled: true,
        imageSmoothingQuality: 'high',
    });
    
    const formData = new FormData();
    canvas.toBlob(function(blob) {
        formData.append('image', blob);
        formData.append('file_id', currentFileId);
        
        // Show loading state
        const cropButton = document.getElementById('cropButton');
        cropButton.disabled = true;
        cropButton.innerHTML = '<i class="ri-loader-4-line ri-spin"></i> Saving...';
        
        fetch('<?= base_url('account/file-manager/edit-image') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                location.reload();
            } else {
                alert('Failed to save image. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        })
        .finally(() => {
            cropButton.disabled = false;
            cropButton.innerHTML = '<i class="ri-save-line"></i> Save Changes';
        });
    });
});

// Add modal event listener to destroy cropper when modal is closed
document.getElementById('imageEditModal').addEventListener('hidden.bs.modal', function () {
    if (cropper) {
        cropper.destroy();
        cropper = null;
    }
});
</script>

<!-- end main content -->
<?= $this->endSection() ?>
