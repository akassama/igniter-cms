<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Manage Teams<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Teams')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Teams</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/cms/teams/new-team')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Team Member
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Teams
                <span class="badge rounded-pill bg-dark">
                    <?= $total_teams ?>
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
                                <th>Name</th>
                                <th>Title</th>
                                <th>Link</th>
                                <th>New Tab</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($teams): ?>
                            <?php foreach($teams as $team): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <img loading="lazy" src="<?= base_url($team['image']); ?>" class="rounded" alt="<?= $team['image']; ?>" width="50" height="50">
                                    </td>
                                    <td><?= $team['name']; ?></td>
                                    <td><?= $team['title']; ?></td>
                                    <td>
                                        <?= getInputLinkTag($team['team_id'], $team['details_link']); ?>
                                    </td>
                                    <td><?= $team['new_tab'] == "1" ? "Yes" : "No" ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-team" href="<?=base_url('account/cms/teams/view-team/'.$team['team_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-team" href="<?=base_url('account/cms/teams/edit-team/'.$team['team_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-team" href="javascript:void(0)" onclick="deleteRecord('teams', 'team_id', '<?=$team['team_id'];?>', '', 'account/cms/teams')">
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
