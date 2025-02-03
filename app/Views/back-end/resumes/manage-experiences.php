<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Resumes', 'url' => '/account/resumes'),
    array('title' => 'Manage Experiences')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Experiences</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/resumes/new-experience')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Experience
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Experiences
                <span class="badge rounded-pill bg-dark">
                    <?= $total_experiences = 0 ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!--Content-->
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Company</th>
                                <th>Position</th>
                                <th>Group</th>
                                <th>Start Date</th>
                                <th>Logo</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($experiences): ?>
                            <?php foreach($experiences as $experience): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $experience['company_name']; ?></td>
                                    <td><?= $experience['position']; ?></td>
                                    <td><?= $experience['group']; ?></td>
                                    <td><?= $experience['start_date']; ?></td>
                                    <td>
                                        <img src="<?= base_url($experience['company_logo']); ?>" class="rounded" alt="<?= $experience['company_logo']; ?>" width="50" height="50">
                                    </td>
                                    <td><?= $experience['status'] == "1" ? "<span class='badge bg-success'>Published</span>" : "<span class='badge bg-secondary'>Unpublished</span>" ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-experience" href="<?=base_url('account/resumes/view-experience/'.$experience['experience_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-experience" href="<?=base_url('account/resumes/edit-experience/'.$experience['experience_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-experience" href="javascript:void(0)" onclick="deleteRecord('experiences', 'experience_id', '<?=$experience['experience_id'];?>', '', 'account/resumes/manage-experiences')">
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
