<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Comments<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Forms', 'url' => '/account/forms'),
    array('title' => 'Comment Forms')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Comment Forms</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="ri-grid-line me-1"></i>
                    Comments
                    <span class="badge rounded-pill bg-dark">
                        <?= $total_comment_form_submissions ?>
                    </span>
                </div>

                <div>
                    <a href="<?= base_url('account/forms/comment-forms/unapproved'); ?>" 
                    class="btn btn-sm btn-outline-secondary">
                        <i class="ri-chat-off-line text-danger me-1"></i> View Unapproved
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
                                                    <a href="<?= $comment['page_url']; ?>" target="_blank" class="td-none fw-bold">
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
                                                <a  href="#!"
                                                    class="text-dark td-none mr-1 mb-1 edit-comment"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editCommentModal"
                                                    data-id="<?= esc($comment['comment_form_id']) ?>"
                                                    data-name="<?= esc($comment['name']) ?>"
                                                    data-email="<?= esc($comment['email']) ?>"
                                                    data-comment="<?= esc($comment['comment']) ?>"
                                                    data-status="<?= esc($comment['status']) ?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>

                                            </div>
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

<!-- Modal: Edit Comment -->
<div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCommentModalLabel">
          <i class="ri-edit-2-line me-2"></i>Edit Comment
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <?php echo form_open(base_url('account/forms/comment-forms/edit-comment'), 'method="post" class="needs-validation" novalidate'); ?>

      <div class="modal-body">
        <div class="row g-3">
          <input type="hidden" name="comment_form_id" id="com_id">

          <div class="col-12 col-md-4">
            <label for="com_name" class="form-label">Name</label>
            <input type="text" class="form-control" id="com_name" name="name" maxlength="255">
          </div>

          <div class="col-12 col-md-4">
            <label for="com_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="com_email" name="email" maxlength="255" required>
            <div class="invalid-feedback">Please enter a valid email.</div>
          </div>
          <div class="col-12 col-md-4">
            <label for="com_status" class="form-label">Status</label>
            <select class="form-select" id="com_status" name="status" required>
              <option value="">Select status</option>
              <option value="1">Approved</option>
              <option value="0">Pending Approval</option>
            </select>
            <div class="invalid-feedback">Please select a status.</div>
          </div>
          
          <div class="col-12 col-md-12">
            <label for="com_comment" class="form-label">Comment</label>
            <textarea class="form-control" id="com_comment" name="comment" maxlength="100" required></textarea>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          <i class="ri-close-circle-fill me-1"></i> Close
        </button>
        <button type="submit" class="btn btn-primary">
          <i class="ri-save-3-line me-1"></i> Save Changes
        </button>
      </div>

      <?php echo form_close(); ?>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('editCommentModal');
    const idEl = document.getElementById('com_id');
    const nameEl = document.getElementById('com_name');
    const emailEl = document.getElementById('com_email');
    const commentEl = document.getElementById('com_comment');
    const statusEl = document.getElementById('com_status');

    document.querySelectorAll('.edit-blog').forEach(function (btn) {
        btn.addEventListener('click', function () {
            idEl.value = this.dataset.id || '';
            emailEl.value = this.dataset.email || '';
            nameEl.value = this.dataset.name || '';
            commentEl.value = this.dataset.comment || '';
            // Set status if present and matches an option
            const st = this.dataset.status || '';
            Array.from(statusEl.options).forEach(o => o.selected = (o.value === st));
        });
    });
});
</script>


<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
