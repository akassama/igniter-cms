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
<?= $this->section('title') ?>Manage Themes<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Themes')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Themes</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/admin/themes/new-theme')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Theme
        </a>
    </div>
    <div class="col-12">
        <?php
            $whereClause = ['selected' => '1'];
            $tableData = getTableData("themes", $whereClause, "selected");
            if(empty($tableData)){
                ?>
                    <div class="alert alert-danger">
                        <strong>Warning!</strong> Please note that there is currently no active theme selected.
                    </div>
                <?php
            }
        ?>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Themes
                <span class="badge rounded-pill bg-dark">
                    <?= $total_themes ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Theme</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Active</th>
                            <th>HomePage</th>
                            <th>Last Modified</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($themes): ?>
                            <?php foreach($themes as $theme): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <a href="<?= $theme['theme_url']; ?>" target="_blank">
                                            <img loading="lazy" src="<?= getImageUrl($theme['image'] ?? getDefaultImagePath()); ?>" class="rounded border border-light" alt="<?= $theme['name']; ?>" width="100" height="100">
                                        </a>
                                    </td>
                                    <td><?= $theme['name']; ?></td>
                                    <td><?= $theme['category']; ?></td>
                                    <td><?= $theme['selected'] == "1" ? "<span class='badge bg-success'>Active</span>" : "<span class='badge bg-secondary'>Not Active</span>" ?></td>
                                    <td><?= $theme['home_page']; ?></td>
                                    <td><?= $theme['updated_at']; ?></td>
                                    <td><?= getActivityBy(esc($theme['created_by']) , ""); ?></td>
                                    <td><?= getActivityBy(esc($theme['updated_by']) , ""); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-theme" href="<?=base_url('account/admin/themes/edit-theme/'.$theme['theme_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <?php
                                            if ($theme['deletable'] == 1 && $theme['selected'] !== "1") {
                                                echo '<div class="col mb-1">
                                                            <a class="text-dark td-none mr-1 remove-theme" href="javascript:void(0)" onclick="deleteRecord(\'themes\', \'theme_id\', \'' . $theme['theme_id'] . '\', \'\', \'account/admin/themes\')">
                                                                <i class="h5 ri-close-circle-fill"></i>
                                                            </a>
                                                        </div>';
                                            } else {
                                            echo '<div class="col mb-1">
                                                        <a class="text-dark td-none mr-1 remove-theme disabled text-muted" href="javascript:void(0)">
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
