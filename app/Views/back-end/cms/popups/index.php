<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Popups')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Popup Adverts</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/cms/popups/new-popup')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Popup
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Popups
                <span class="badge rounded-pill bg-dark">
                    <?= $total_popups = 0 ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!--Content-->
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($popups): ?>
                            <?php foreach($popups as $popup): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <img loading="lazy" src="<?=getImageUrl($popup['image'] ?? getDefaultImagePath())?>" class="img-thumbnail" alt="<?= $popup['title']; ?>" width="100" height="100">
                                    </td>
                                    <td>
                                        <?= $popup['type']; ?>.  (<?= $popup['name']; ?>)
                                        <br>
                                        <?php $imagePath = getImageUrl($popup['preview_image'] ?? getDefaultImagePath()); ?>
                                        <?php $modalSize = $popup['type'] == '8' ? "" : "modal-xl"?>
                                        <a href="#!" data-bs-toggle="modal" data-bs-target="#imageModal-<?=$rowCount?>">Preview Sample</a>
                                        <div class="modal fade" id="imageModal-<?=$rowCount?>" tabindex="-1" aria-labelledby="imageModalLabel-<?=$rowCount?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered <?=$modalSize?>"> 
                                                <div class="modal-content">
                                                    <div class="modal-body p-0">
                                                        <img loading="lazy" src="<?= $imagePath; ?>" class="img-fluid" alt="Image Preview"> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $popup['title']; ?></td>
                                    <td><?= $popup['order']; ?></td>
                                    <td><?= $popup['status'] == "1" ? "<span class='badge bg-success'>Published</span>" : "<span class='badge bg-secondary'>Unpublished</span>" ?></td>
                                    <td><?= getActivityBy(esc($popup['created_by']) , ""); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-contprojectact" href="<?=base_url('account/cms/popups/view-popup/'.$popup['popup_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-popup" href="<?=base_url('account/cms/popups/edit-popup/'.$popup['popup_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <?php
                                                if ($popup['deletable'] == 1) {
                                                    echo '<div class="col mb-1">
                                                                <a class="text-dark td-none mr-1 remove-popup" href="javascript:void(0)" onclick="deleteRecord(\'announcement_popups\', \'popup_id\', \'' . $popup['popup_id'] . '\', \'\', \'account/cms/popups\')">
                                                                    <i class="h5 ri-close-circle-fill"></i>
                                                                </a>
                                                            </div>';
                                                } else {
                                                echo '<div class="col mb-1">
                                                            <a class="text-dark td-none mr-1 remove-config disabled text-muted" href="javascript:void(0)">
                                                                <i class="h5 ri-close-circle-fill"></i>
                                                            </a>
                                                        </div>';
                                                }
                                            ?>
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
</div>

<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
