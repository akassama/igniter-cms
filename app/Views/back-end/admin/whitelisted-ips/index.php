<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Whitelisted IP Addresses<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Whitelisted IP Addresses')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Whitelisted IP Addresses</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/admin/whitelisted-ips/new-whitelisted-ip')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> New Whitelisted IP
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                    Whitelisted IP Addresses
                <span class="badge rounded-pill bg-dark">
                    <?= $total_whitelisted_ips ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>IP</th>
                            <th>Reason</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($whitelisted_ips): ?>
                            <?php foreach($whitelisted_ips as $whitelisted_ip): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= esc($whitelisted_ip['ip_address']) ?></td>
                                    <td><?= esc($whitelisted_ip['reason']) ?></td>
                                    <td><?= esc($whitelisted_ip['created_at']) ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-blocked-ip" href="#!" onclick="deleteRecord('whitelisted_ips', 'whitelisted_ip_id', '<?=$whitelisted_ip['whitelisted_ip_id'];?>', '', 'account/admin/whitelisted-ips')">
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
        if($total_whitelisted_ips > 100){
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
