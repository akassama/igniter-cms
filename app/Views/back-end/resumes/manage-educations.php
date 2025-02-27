<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Resumes', 'url' => '/account/resumes'),
    array('title' => 'Manage Educations')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Educations</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/resumes/new-education')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Education
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Educations
                <span class="badge rounded-pill bg-dark">
                    <?= $total_resumes = 0 ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!--Content-->
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Institution Logo</th>
                                <th>Institution</th>
                                <th>Degree</th>
                                <th>Group</th>
                                <th>Start Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($educations): ?>
                            <?php foreach($educations as $education): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <img loading="lazy" src="<?= base_url($education['institution_logo']); ?>" class="rounded" alt="<?= $education['institution_logo']; ?>" width="50" height="50">
                                    </td>
                                    <td><?= $education['institution']; ?></td>
                                    <td><?= $education['degree']; ?></td>
                                    <td><?= $education['group']; ?></td>
                                    <td>
                                        <?= $education['start_date']; ?>
                                    </td>
                                    <td><?= $education['status'] == "1" ? "<span class='badge bg-success'>Published</span>" : "<span class='badge bg-secondary'>Unpublished</span>" ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-education" href="<?=base_url('account/resumes/view-education/'.$education['education_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-education" href="<?=base_url('account/resumes/edit-education/'.$education['education_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-education" href="javascript:void(0)" onclick="deleteRecord('educations', 'education_id', '<?=$education['education_id'];?>', '', 'account/resumes/manage-educations')">
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
