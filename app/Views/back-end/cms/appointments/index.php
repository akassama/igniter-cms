<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Manage Appointments<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Appointments')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Appointments</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/cms/appointments/new-appointment')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Appointment
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Appointments
                <span class="badge rounded-pill bg-dark">
                    <?= $total_appointments ?>
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
                            <th>Type</th>
                            <th>Status</th>
                            <th>Author</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($appointments): ?>
                            <?php foreach($appointments as $appointment): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <img loading="lazy" src="<?=getImageUrl($appointment['image'] ?? getDefaultImagePath())?>" class="img-thumbnail" alt="<?= $appointment['title']; ?>" width="100" height="100">
                                    </td>
                                    <td><?= $appointment['title']; ?></td>
                                    <td><?= $appointment['appointment_type']; ?></td>
                                    <td><?= $appointment['status'] == "1" ? "<span class='badge bg-success'>Published</span>" : "<span class='badge bg-secondary'>Unpublished</span>" ?></td>
                                    <td>
                                        <span class="text-primary">
                                            <?= getActivityBy(esc($appointment['created_by'])) ?>
                                        </span>
                                    </td>
                                    <td><?= $appointment['total_views']; ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-appointment" href="<?=base_url('account/cms/appointments/view-appointment/'.$appointment['appointment_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-appointment" href="<?=base_url('account/cms/appointments/edit-appointment/'.$appointment['appointment_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-appointment" href="javascript:void(0)" onclick="deleteRecord('appointments', 'appointment_id', '<?=$appointment['appointment_id'];?>', '', 'account/cms/appointments')">
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
    <?php
        if($total_appointments > 100){
            ?>
                <!--Show pagination if more than 100 records-->
                <div class="col-12 text-start">
                    <p>Pagination</p>
                    <?= $pager->links('default', 'bootstrap') ?>
                </div>
            <?php
        }
    ?>
</div>

<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
