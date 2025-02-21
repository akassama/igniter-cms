<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'E-Commerce', 'url' => '/account/ecommerce'),
    array('title' => 'Products')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Products</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/ecommerce/products/new-product')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Product
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Products
                <span class="badge rounded-pill bg-dark">
                    <?= $total_products = 0 ?>
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
                                <th>Category</th>
                                <th>Status</th>
                                <th>Author</th>
                                <th>Views</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($products): ?>
                            <?php foreach($products as $product): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <img src="<?=getImageUrl($product['featured_image'] ?? getDefaultImagePath())?>" class="img-thumbnail" alt="<?= $product['title']; ?>" width="100" height="100">
                                    </td>
                                    <td><?= $product['title']; ?></td>
                                    <td><?= !empty($product['category']) ? getProductCategoryName($product['category']) : "" ?></td>
                                    <td><?= $product['status'] == "1" ? "<span class='badge bg-success'>Published</span>" : "<span class='badge bg-secondary'>Unpublished</span>" ?></td>
                                    <td>
                                        <span class="text-primary">
                                            <?= getActivityBy(esc($product['created_by'])) ?>
                                        </span>
                                    </td>
                                    <td><?= $product['total_views']; ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-blog" href="<?=base_url('account/ecommerce/products/view-product/'.$product['product_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-product" href="<?=base_url('account/ecommerce/products/edit-product/'.$product['product_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-product" href="javascript:void(0)" onclick="deleteRecord('products', 'product_id', '<?=$product['product_id'];?>', '', 'account/ecommerce/products')">
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
