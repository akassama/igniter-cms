<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Blocked IP Addresses')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Blocked IP Addresses</h3>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                    Blocked IP Addresses
                <span class="badge rounded-pill bg-dark">
                    <?= $total_blocked_ips ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>IP</th>
                            <th>block_start_time</th>
                            <th>block_end_time</th>
                            <th>reason</th>
                            <th>Notes</th>
                            <th>URL</th>
                            <!-- <th>Country</th> -->
                            <th>Visit Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($blocked_ips): ?>
                            <?php foreach($blocked_ips as $blocked_ip): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= esc($blocked_ip['ip_address']) ?></td>
                                    <td><?= esc($blocked_ip['block_start_time']) ?></td>
                                    <td><?= esc($blocked_ip['block_end_time']) ?></td>
                                    <td><?= esc($blocked_ip['reason']) ?></td>
                                    <td><?= esc($blocked_ip['notes']) ?></td>
                                    <td><?= esc($blocked_ip['page_visited_url']) ?></td>
                                    <td><?= esc($blocked_ip['created_at']) ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-blocked-ip" href="javascript:void(0)" onclick="deleteRecord('blocked_ips', 'blocked_ip_id', '<?=$blocked_ip['blocked_ip_id'];?>', '', 'account/admin/blocked-ips')">
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
        if($total_blocked_ips > 100){
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
