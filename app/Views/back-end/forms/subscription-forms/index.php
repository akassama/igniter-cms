<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Forms', 'url' => '/account/forms'),
    array('title' => 'Subscription Forms')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Subscription Forms</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="ri-grid-line me-1"></i>
                    Subscribers
                    <span class="badge rounded-pill bg-dark">
                        <?= $total_subscription_form_submissions ?>
                    </span>
                </div>

                <div>
                    <a href="<?= base_url('account/forms/subscription-forms/unsubscribed'); ?>" 
                    class="btn btn-sm btn-outline-secondary">
                        <i class="ri-notification-off-line text-danger me-1"></i> View Unsubscribed
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable-export">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Form Name</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>IP</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($subscription_form_submissions): ?>
                            <?php foreach($subscription_form_submissions as $subscriber): ?>
                                <tr>
                                    <td>
                                        <?= $rowCount; ?>
                                    </td>
                                    <td>
                                        <?= $subscriber['form_name']; ?>
                                    </td>
                                    <td>
                                        <?= esc($subscriber['name']); ?>
                                        <?php if (!empty($subscriber['first_name']) || !empty($subscriber['last_name'])): ?>
                                            <span class="badge bg-primary ms-2">
                                                <?= esc(trim($subscriber['first_name'] . ' ' . $subscriber['last_name'])); ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= $subscriber['email']; ?>
                                    </td>
                                    <td>
                                        <?= $subscriber['status']; ?>
                                    </td>
                                    <td>
                                        <?= $subscriber['ip_address']; ?>
                                    </td>
                                    <td>
                                        <span class="fi fi-<?= strtolower(esc($subscriber['country'])) ?>"></span>
                                        <?= esc($subscriber['country']) ?>
                                    </td>
                                    <!-- Status badge (read-only visual) with icon -->
                                    <?php
                                        $status = $subscriber['status'] ?? '';
                                        $badgeClass = 'bg-secondary';
                                        $statusIcon = 'ri-time-line';
                                        if ($status === 'Pending Confirmation') { $badgeClass = 'bg-warning'; $statusIcon = 'ri-mail-send-line'; }
                                        elseif ($status === 'Active') { $badgeClass = 'bg-success'; $statusIcon = 'ri-checkbox-circle-line'; }
                                        elseif ($status === 'Unsubscribed') { $badgeClass = 'bg-danger'; $statusIcon = 'ri-user-unfollow-line'; }
                                        elseif ($status === 'Bounced') { $badgeClass = 'bg-secondary'; $statusIcon = 'ri-mail-close-line'; }
                                    ?>
                                    <td>
                                        <span class="badge <?= esc($badgeClass) ?>">
                                            <i class="<?= esc($statusIcon) ?> me-1"></i><?= esc($status) ?>
                                        </span>
                                    </td>
                                    <td><?= dateFormat($subscriber['created_at']); ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a  href="#!"
                                                    class="text-dark td-none mr-1 mb-1 edit-subscriber"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editSubscriberModal"
                                                    data-id="<?= esc($subscriber['subscription_form_id']) ?>"
                                                    data-email="<?= esc($subscriber['email']) ?>"
                                                    data-name="<?= esc($subscriber['name']) ?>"
                                                    data-first_name="<?= esc($subscriber['first_name']) ?>"
                                                    data-last_name="<?= esc($subscriber['last_name']) ?>"
                                                    data-phone="<?= esc($subscriber['phone']) ?>"
                                                    data-status="<?= esc($subscriber['status']) ?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>

                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-subscriber" href="javascript:void(0)" onclick="deleteRecord('subscription_form_submissions', 'subscription_form_id', '<?=$subscriber['subscription_form_id'];?>', '', 'account/forms/subscription-forms')">
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

<!-- Modal: Edit Subscriber -->
<div class="modal fade" id="editSubscriberModal" tabindex="-1" aria-labelledby="editSubscriberModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSubscriberModalLabel">
          <i class="ri-edit-2-line me-2"></i>Edit Subscriber
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <?php echo form_open(base_url('account/forms/subscription-forms/edit-subscriber'), 'method="post" class="needs-validation" novalidate'); ?>

      <div class="modal-body">
        <div class="row g-3">
          <input type="hidden" name="subscription_form_id" id="sub_id">

          <div class="col-12 col-md-6">
            <label for="sub_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="sub_email" name="email" maxlength="255" required>
            <div class="invalid-feedback">Please enter a valid email.</div>
          </div>
          <div class="col-12 col-md-6">
            <label for="sub_phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="sub_phone" name="phone" maxlength="50">
          </div>

          <div class="col-12 col-md-6">
            <label for="sub_name" class="form-label">Name</label>
            <input type="text" class="form-control" id="sub_name" name="name" maxlength="255">
          </div>
          <div class="col-12 col-md-6">
            <label for="sub_status" class="form-label">Status</label>
            <select class="form-select" id="sub_status" name="status" required>
              <?=getDataGroupOptions(null, "SubscriptionFomrStatus")?>
            </select>
            <div class="invalid-feedback">Please select a status.</div>
          </div>
          
          <div class="col-12 col-md-6">
            <label for="sub_first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="sub_first_name" name="first_name" maxlength="100">
          </div>
          <div class="col-12 col-md-6">
            <label for="sub_last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="sub_last_name" name="last_name" maxlength="100">
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
    const modalEl = document.getElementById('editSubscriberModal');
    const idEl = document.getElementById('sub_id');
    const emailEl = document.getElementById('sub_email');
    const phoneEl = document.getElementById('sub_phone');
    const nameEl = document.getElementById('sub_name');
    const firstNameEl = document.getElementById('sub_first_name');
    const lastNameEl = document.getElementById('sub_last_name');
    const statusEl = document.getElementById('sub_status');

    document.querySelectorAll('.edit-blog').forEach(function (btn) {
        btn.addEventListener('click', function () {
            idEl.value = this.dataset.id || '';
            emailEl.value = this.dataset.email || '';
            phoneEl.value = this.dataset.phone || '';
            nameEl.value = this.dataset.name || '';
            firstNameEl.value = this.dataset.first_name || '';
            lastNameEl.value = this.dataset.last_name || '';
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
