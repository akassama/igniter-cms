<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$userRole = getUserRole($sessionEmail);
?>

<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Translations')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Translations</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/admin/translations/new-translation')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Translation
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Translations
                <span class="badge rounded-pill bg-dark">
                    <?= $total_translations ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Language</th>
                            <th>Created On</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($translations): ?>
                            <?php foreach($translations as $translation): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <?= getTableData("languages", ['language_id' => $translation['language']], 'value'); ?> (<?= $translation['language']; ?>)
                                    </td>
                                    <td><?= $translation['created_at']; ?></td>
                                    <td><?= getActivityBy(esc($translation['created_by']) , ""); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <?php
                                            if ($translation['language'] != "en") {
                                                echo '<div class="col mb-1">
                                                            <a class="text-dark td-none mr-1 remove-translation" href="javascript:void(0)" onclick="deleteRecord(\'translations\', \'translation_id\', \'' . $translation['translation_id'] . '\', \'\', \'account/admin/translations\')">
                                                                <i class="h5 ri-close-circle-fill"></i>
                                                            </a>
                                                        </div>';
                                            } else {
                                            echo '<div class="col mb-1">
                                                        <a class="text-dark td-none mr-1 remove-translation disabled text-muted" href="javascript:void(0)">
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
