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
<?= $this->section('title') ?>Manage Codes<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Codes')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Codes</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/admin/codes/new-code')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Code
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Codes
                <span class="badge rounded-pill bg-dark">
                    <?= $total_codes ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Code For</th>
                            <th>Last Modified</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($codes): ?>
                            <?php foreach($codes as $code): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $code['code_for']; ?></td>
                                    <td><?= $code['updated_at']; ?></td>
                                    <td><?= getActivityBy(esc($code['created_by']) , ""); ?></td>
                                    <td><?= getActivityBy(esc($code['updated_by']) , ""); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-code" href="<?=base_url('account/admin/codes/edit-code/'.$code['code_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <?php
                                            if ($code['deletable'] == 1) {
                                                echo '<div class="col mb-1">
                                                            <a class="text-dark td-none mr-1 remove-code" href="#!" onclick="deleteRecord(\'codes\', \'code_id\', \'' . $code['code_id'] . '\', \'\', \'account/admin/codes\')">
                                                                <i class="h5 ri-close-circle-fill"></i>
                                                            </a>
                                                        </div>';
                                            } else {
                                            echo '<div class="col mb-1">
                                                        <a class="text-dark td-none mr-1 remove-code disabled text-muted" href="javascript:void(0)">
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
