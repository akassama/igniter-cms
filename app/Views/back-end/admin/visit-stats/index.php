<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Visit Stats')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Visit Stats</h3>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                Visit Stats
                <span class="badge rounded-pill bg-dark">
                    <?= $total_stats ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable-export">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>IP</th>
                            <th>Device</th>
                            <th>Browser</th>
                            <th>URL</th>
                            <th>User</th>
                            <th>OS</th>
                            <th>Country</th>
                            <th>Visit Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($visit_stats): ?>
                            <?php foreach($visit_stats as $visit): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <span class="me-1 small"><?=IPIdentifierLabel($visit['ip_address'])?></span>
                                        <?= esc($visit['ip_address']) ?>
                                    </td>
                                    <td><?= esc($visit['device_type']) ?></td>
                                    <td><?= esc($visit['browser_type']) ?></td>
                                    <td><?= esc($visit['page_visited_url']) ?></td>
                                    <td>
                                        <span class="text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="User ID: <?= esc($visit['user_id']) ?>">
                                            <?= getActivityBy(esc($visit['user_id'])) ?>
                                        </span>
                                    </td>
                                    <td><?= esc($visit['operating_system']) ?></td>
                                    <td>
                                        <span class="fi fi-<?= strtolower(esc($visit['country'])) ?>"></span>
                                        <?= esc($visit['country']) ?>
                                    </td>
                                    <td><?= esc($visit['created_at']) ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-stat" href="<?=base_url('account/admin/visit-stats/view-stat/'.esc($visit['site_stat_id']))?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-stat" href="javascript:void(0)" onclick="deleteRecord('site_stats', 'site_stat_id', '<?=$visit['site_stat_id'];?>', '', 'account/admin/visit-stats')">
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
        if($total_stats > 1000){
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
<div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Information Key (CDN/Proxy)
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3"><i class="ri-circle-fill text-muted"></i></dt>
                        <dd class="col-sm-9">Local Device</dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-primary"></i></dt>
                        <dd class="col-sm-9">Cloudflare</dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-teal"></i></dt>
                        <dd class="col-sm-9">Microsoft Azure CDN</dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-orange"></i></dt>
                        <dd class="col-sm-9">Google Cloud CDN</dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-success"></i></dt>
                        <dd class="col-sm-9">Fastly</dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-info"></i></dt>
                        <dd class="col-sm-9">Akamai</dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-warning"></i></dt>
                        <dd class="col-sm-9">Amazon CloudFront</dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-danger"></i></dt>
                        <dd class="col-sm-9">Sucuri</dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-secondary"></i></dt>
                        <dd class="col-sm-9">NitroPack</dd>

                        <dt class="col-sm-3"><i class="ri-checkbox-blank-circle-line text-dark"></i></i></dt>
                        <dd class="col-sm-9">Unknown</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
