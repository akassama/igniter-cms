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
<?= $this->section('title') ?>Manage Home Page<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Home Page')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Home Page</h3>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Home Page
                <span class="badge rounded-pill bg-dark">
                    <?= $total_home_pages ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Section</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($home_pages): ?>
                            <?php foreach($home_pages as $home_page): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $home_page['section']; ?></td>
                                    <td>
                                        <?= $home_page['section_title']; ?>
                                    </td>
                                    <td><?= $home_page['status'] == "1" ? "<span class='badge bg-success'>Published</span>" : "<span class='badge bg-secondary'>Unpublished</span>" ?></td>
                                    <td><?= $home_page['order']; ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-page" href="<?=base_url('account/cms/home-page/view-home-page-section/'.$home_page['home_page_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-home-page" href="<?=base_url('account/cms/home-page/edit-home-page-section/'.$home_page['home_page_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
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
