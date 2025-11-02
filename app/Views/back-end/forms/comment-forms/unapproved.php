<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Unapproved Comments<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Forms', 'url' => '/account/forms'),
    array('title' => 'Comment Forms (Unapproved)')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Comment Forms (Unapproved)</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="ri-grid-line me-1"></i>
                    Unapproved
                    <span class="badge rounded-pill bg-dark">
                        <?= $total_comment_form_submissions ?>
                    </span>
                </div>

                <div>
                    <a href="<?= base_url('account/forms/comment-forms'); ?>" 
                    class="btn btn-sm btn-outline-secondary">
                        <i class="ri-chat-3-fill text-success me-1"></i> View All
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable-export">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Comment</th>
                            <th>Page</th>
                            <th>IP</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($comment_form_submissions): ?>
                            <?php foreach($comment_form_submissions as $comment): ?>
                                <tr>
                                    <td>
                                        <?= $rowCount; ?>
                                    </td>
                                    <td>
                                        <img loading="lazy" src="<?=getImageUrl($comment['gravatar'] ?? getDefaultImagePath())?>" class="img-rounded" alt="<?= $comment['name']; ?>" width="25" height="25">
                                        <?= $comment['name']; ?>
                                    </td>
                                    <td>
                                        <?= $comment['email']; ?>
                                    </td>
                                    <td>
                                        <?= $comment['comment']; ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if(!empty($comment['page_url'])){
                                                ?>
                                                    <a href="<?= $comment['page_url']; ?>" target="_blank" class="td-none fw-bold" data-bs-toggle="tooltip" title="<?= $comment['page_url']; ?>">
                                                        <i class="ri-link-m"></i> View Page
                                                    </a>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?= $comment['ip_address']; ?>
                                    </td>
                                    <td>
                                        <span class="fi fi-<?= strtolower(esc($comment['country'])) ?>"></span>
                                        <?= esc($comment['country']) ?>
                                    </td>
                                    <!-- Status badge (read-only visual) with icon -->
                                    <?php
                                        $status = $comment['status'] ?? '';
                                        $badgeClass = 'bg-secondary';
                                        $statusIcon = 'ri-chat-1-line';
                                        $statusLabel = 'Pending';
                                        if ($status === '0') {
                                            $badgeClass = 'bg-warning';
                                            $statusIcon = 'ri-chat-off-fill';
                                            $statusLabel = 'Pending Approval';
                                        }
                                        elseif ($status === '1') {
                                            $badgeClass = 'bg-success';
                                            $statusIcon = 'ri-chat-3-fill';
                                            $statusLabel = 'Approved';
                                        }
                                    ?>
                                    <td>
                                        <span class="badge <?= esc($badgeClass) ?>">
                                            <i class="<?= esc($statusIcon) ?> me-1"></i><?= esc($statusLabel) ?>
                                        </span>
                                    </td>
                                    <td><?= dateFormat($comment['created_at']); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-comment" href="javascript:void(0)" onclick="deleteRecord('comment_form_submissions', 'comment_form_id', '<?=$comment['comment_form_id'];?>', '', 'account/forms/comment-forms')">
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
