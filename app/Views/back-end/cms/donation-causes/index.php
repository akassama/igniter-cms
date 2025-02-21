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
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Donation Causes')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Donation Causes</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/cms/donation-causes/new-donation-cause')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Donation Cause
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                    Donation Causes
                <span class="badge rounded-pill bg-dark">
                    <?= $total_donations ?>
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
                            <th>Status</th>
                            <th>Author</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($donations): ?>
                            <?php foreach($donations as $donation): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <img src="<?=getImageUrl($donation['image'] ?? getDefaultImagePath())?>" class="img-thumbnail" alt="<?= $donation['title']; ?>" width="100" height="100">
                                    </td>
                                    <td><?= $donation['title']; ?></td>
                                    <td><?= $donation['status'] == "1" ? "<span class='badge bg-success'>Published</span>" : "<span class='badge bg-secondary'>Unpublished</span>" ?></td>
                                    <td>
                                        <span class="text-primary">
                                            <?= getActivityBy(esc($donation['created_by'])) ?>
                                        </span>
                                    </td>
                                    <td><?= $donation['total_views']; ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-contprojectact" href="<?=base_url('account/cms/donation-causes/view-donation-cause/'.$donation['donation_cause_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-project" href="<?=base_url('account/cms/donation-causes/edit-donation-cause/'.$donation['donation_cause_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-project" href="javascript:void(0)" onclick="deleteRecord('donation_causes', 'donation_cause_id', '<?=$donation['donation_cause_id'];?>', '', 'account/cms/donation-causes')">
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
