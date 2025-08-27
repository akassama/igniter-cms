<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Manage Categories<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Categories')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Categories</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/cms/categories/new-category')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Category
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Categories
                <span class="badge rounded-pill bg-dark">
                    <?= $total_categories ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!--Content-->
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Link</th>
                            <th>New Tab</th>
                            <th>Group</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($categories): ?>
                            <?php foreach($categories as $category): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $category['title']; ?></td>
                                    <td><?= $category['description']; ?></td>
                                    <td><?= $category['order']; ?></td>
                                    <td><?= $category['status'] == "1" ? "<span class='badge bg-success'>Published</span>" : "<span class='badge bg-secondary'>Unpublished</span>" ?></td>                               
                                    <td>
                                        <?= getInputLinkTag($category['category_id'], $category['link']); ?>
                                    </td>
                                    <td><?= $category['new_tab'] == "1" ? "Yes" : "No" ?></td>
                                    <td><?= $category['group']; ?></td>
                                    <td><?= getActivityBy(esc($category['created_by']) , ""); ?></td>
                                    <td><?= getActivityBy(esc($category['updated_by']) , ""); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-category" href="<?=base_url('account/cms/categories/edit-category/'.$category['category_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-category" href="#!" onclick="deleteRecord('categories', 'category_id', '<?=$category['category_id'];?>', '', 'account/cms/categories')">
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
