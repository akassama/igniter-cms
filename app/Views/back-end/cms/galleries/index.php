<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Manage Galleries<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Galleries')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Galleries</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/cms/galleries/new-gallery')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Gallery
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Galleries
                <span class="badge rounded-pill bg-dark">
                    <?= $total_galleries ?>
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
                            <th>Title</th>
                            <th>Group</th>
                            <th>Status</th>
                            <th>Author</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($galleries): ?>
                            <?php foreach($galleries as $gallery): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <img loading="lazy" src="<?=getImageUrl($gallery['image'] ?? getDefaultImagePath())?>" class="img-thumbnail" alt="<?= $gallery['title']; ?>" width="100" height="100">
                                    </td>
                                    <td><?= $gallery['title']; ?></td>
                                    <td>
                                        <?= $gallery['group']; ?>
                                        <span class="small mt-1">
                                            <p>Category Filter: <?= $gallery['category_filter']; ?></p>
                                        </span>
                                    </td>
                                    <td><?= $gallery['status'] == "1" ? "<span class='badge bg-success'>Published</span>" : "<span class='badge bg-secondary'>Unpublished</span>" ?></td>
                                    <td>
                                        <span class="text-primary">
                                            <?= getActivityBy(esc($gallery['created_by'])) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-contprojectact" href="<?=base_url('account/cms/galleries/view-gallery/'.$gallery['gallery_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-project" href="<?=base_url('account/cms/galleries/edit-gallery/'.$gallery['gallery_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-project" href="javascript:void(0)" onclick="deleteRecord('galleries', 'gallery_id', '<?=$gallery['gallery_id'];?>', '', 'account/cms/galleries')">
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
</div>

<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
