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
<?= $this->section('title') ?>Manage Users<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Users')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Users</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/admin/users/new-user')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New User
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Users
                <span class="badge rounded-pill bg-dark">
                    <?= $total_users ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($users): ?>
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $user['first_name']; ?></td>
                                    <td><?= $user['last_name']; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td>
                                        <?= getUserStatusLabel($user['status']); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary"><?= $user['role']; ?></span>
                                    </td>
                                    <td><?= dateFormat($user['created_at']); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-user" href="<?=base_url('account/admin/users/view-user/'.$user['user_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-user" href="<?=base_url('account/admin/users/edit-user/'.$user['user_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <?php
                                                // Check if the session email matches the user's email
                                                $isCurrentUser = ($sessionEmail == $user['email']);
                                                $icon = '<i class="h5 ri-close-circle-fill"></i>';
                                                $tooltipTitle = $isCurrentUser ? 'Disabled' : 'Remove User';
                                                $additionalClass = $isCurrentUser ? 'delete-record text-muted' : '';
                                                $onClick = $isCurrentUser ? '' : "onclick=\"deleteRecord('users', 'user_id', '{$user['user_id']}', '', 'account/admin/users')\"";
                                            ?>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 <?= $additionalClass ?>" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $tooltipTitle ?>" <?= $onClick ?>>
                                                    <?= $icon ?>
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
