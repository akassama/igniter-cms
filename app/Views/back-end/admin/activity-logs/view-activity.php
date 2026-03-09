<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$userRole = getUserRole($sessionEmail);

// Get the activity data
$activity = $activity_data; // or however you're passing the data

// Decode JSON data if needed
$oldValues = !empty($activity['old_values']) ? json_decode($activity['old_values'], true) : null;
$newValues = !empty($activity['new_values']) ? json_decode($activity['new_values'], true) : null;

// Get user profile picture for the person who performed the activity
$activityUserPicture = getImageUrl(getUserData($activity['activity_by'], "profile_picture") ?? getDefaultProfileImagePath());
$activityUserName = getActivityBy(esc($activity['activity_by'])); // Using your existing function
?>

<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?= lang('App.view_activity') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.admin'), 'url' => '/account/admin'),
    array('title' => lang('App.activity_logs'), 'url' => '/account/admin/activity-logs'),
    array('title' => lang('App.view_activity'))
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3 class="mb-3"><?= lang('App.view_activity') ?></h3>
    </div>
    
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-light d-flex align-items-center">
                <!-- User Information with Profile Picture -->
                <div class="d-flex align-items-center">
                    <img src="<?= $activityUserPicture ?>" 
                         alt="User" 
                         class="rounded-circle me-3 border"
                         style="width: 48px; height: 48px; object-fit: cover;"
                         onerror="this.src='<?= getDefaultProfileImagePath() ?>'">
                    
                    <div>
                        <h5 class="mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= lang('App.user_id') ?>: <?= esc($activity['activity_by']) ?>">
                            <?= $activityUserName ?>
                        </h5>
                        <p class="mb-0 text-muted small">
                            <i class="ri-user-line me-1"></i><?= lang('App.user_id') ?>: <?= esc($activity['activity_by']) ?>
                        </p>
                    </div>
                </div>
                
                <!-- Activity Type Badge -->
                <div class="ms-auto">
                    <?php
                    $badgeClass = 'secondary';
                    $icon = 'ri-information-line';
                    
                    switch(strtolower($activity['activity_type'])) {
                        case 'create':
                        case 'created':
                        case 'add':
                        case 'added':
                            $badgeClass = 'success';
                            $icon = 'ri-add-circle-line';
                            break;
                        case 'update':
                        case 'updated':
                        case 'edit':
                        case 'edited':
                            $badgeClass = 'info';
                            $icon = 'ri-edit-line';
                            break;
                        case 'delete':
                        case 'deleted':
                        case 'remove':
                        case 'removed':
                            $badgeClass = 'danger';
                            $icon = 'ri-delete-bin-line';
                            break;
                        case 'login':
                            $badgeClass = 'primary';
                            $icon = 'ri-login-circle-line';
                            break;
                        case 'logout':
                            $badgeClass = 'warning';
                            $icon = 'ri-logout-circle-line';
                            break;
                        case 'view':
                        case 'viewed':
                            $badgeClass = 'secondary';
                            $icon = 'ri-eye-line';
                            break;
                    }
                    ?>
                    <span class="badge bg-<?= $badgeClass ?> p-2">
                        <i class="<?= $icon ?> me-1"></i>
                        <?= esc($activity['activity_type']) ?>
                    </span>
                </div>
            </div>
            
            <div class="card-body">
                <!-- Main Activity Info -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h6 class="text-muted mb-2">
                            <i class="ri-file-text-line me-1"></i><?= lang('App.activity_description') ?>
                        </h6>
                        <div class="p-3 bg-light rounded">
                            <p class="mb-0"><?= esc($activity['activity']) ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted mb-2">
                            <i class="ri-time-line me-1"></i><?= lang('App.date_and_time') ?>
                        </h6>
                        <div class="p-3 bg-light rounded">
                            <p class="mb-1">
                                <i class="ri-calendar-line me-1"></i> 
                                <?= date('F j, Y', strtotime($activity['created_at'])) ?>
                            </p>
                            <p class="mb-0">
                                <i class="ri-time-line me-1"></i>
                                <?= date('g:i A', strtotime($activity['created_at'])) ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Technical Details -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-header bg-transparent">
                                <h6 class="mb-0">
                                    <i class="ri-information-line me-1"></i><?= lang('App.technical_information') ?>
                                </h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="120"><strong><?= lang('App.activity_id') ?>:</strong></td>
                                        <td><span class="badge bg-secondary"><?= esc($activity['activity_id']) ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong><?= lang('App.ip_address') ?>:</strong></td>
                                        <td>
                                            <code><?= esc($activity['ip_address']) ?></code>
                                            <?php if(!empty($activity['country'])): ?>
                                                <span class="fi fi-<?= strtolower((string)esc($activity['country'])) ?>"></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><?= lang('App.device') ?>:</strong></td>
                                        <td>
                                            <?php
                                            $deviceIcon = 'ri-device-line';
                                            if(strpos(strtolower($activity['device']), 'mobile') !== false || strpos(strtolower($activity['device']), 'phone') !== false) {
                                                $deviceIcon = 'ri-smartphone-line';
                                            } elseif(strpos(strtolower($activity['device']), 'tablet') !== false) {
                                                $deviceIcon = 'ri-tablet-line';
                                            } elseif(strpos(strtolower($activity['device']), 'desktop') !== false) {
                                                $deviceIcon = 'ri-computer-line';
                                            }
                                            ?>
                                            <i class="<?= $deviceIcon ?> me-1"></i> 
                                            <?= esc($activity['device']) ?>
                                        </td>
                                    </tr>
                                    <?php if(!empty($activity['url'])): ?>
                                    <tr>
                                        <td><strong><?= lang('App.url') ?>:</strong></td>
                                        <td>
                                            <small class="text-break">
                                                <i class="ri-link me-1"></i>
                                                <?= esc($activity['url']) ?>
                                            </small>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Audit Information -->
                    <div class="col-md-6">
                        <?php if(!empty($activity['auditable_type']) || !empty($activity['auditable_id'])): ?>
                        <div class="card bg-light">
                            <div class="card-header bg-transparent">
                                <h6 class="mb-0">
                                    <i class="ri-folder-history-line me-1"></i><?= lang('App.audit_information') ?>
                                </h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-borderless">
                                    <?php if(!empty($activity['auditable_type'])): ?>
                                    <tr>
                                        <td width="120"><strong><?= lang('App.auditable_type') ?>:</strong></td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                <?= esc($activity['auditable_type']) ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    
                                    <?php if(!empty($activity['auditable_id'])): ?>
                                    <tr>
                                        <td><strong><?= lang('App.auditable_id') ?>:</strong></td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                <?= esc($activity['auditable_id']) ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Old vs New Values Comparison -->
                <?php if($oldValues || $newValues): ?>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="ri-file-copy-line me-1"></i><?= lang('App.data_changes') ?>
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php if($oldValues): ?>
                                    <div class="col-md-6">
                                        <h6 class="text-danger mb-3">
                                            <i class="ri-arrow-left-circle-line me-1"></i><?= lang('App.old_values') ?>
                                        </h6>
                                        <pre class="bg-light p-3 rounded" style="max-height: 300px; overflow-y: auto;"><code><?= json_encode($oldValues, JSON_PRETTY_PRINT) ?></code></pre>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if($newValues): ?>
                                    <div class="col-md-6">
                                        <h6 class="text-success mb-3">
                                            <i class="ri-arrow-right-circle-line me-1"></i><?= lang('App.new_values') ?>
                                        </h6>
                                        <pre class="bg-light p-3 rounded" style="max-height: 300px; overflow-y: auto;"><code><?= json_encode($newValues, JSON_PRETTY_PRINT) ?></code></pre>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="card-footer bg-light">
                <a href="<?= base_url('/account/admin/activity-logs') ?>" class="btn btn-outline-secondary">
                    <i class="ri-arrow-left-line me-1"></i>
                    <?= lang('App.back_to_logs') ?>
                </a>
                
                <?php if($userRole === 'admin'): ?>
                <button type="button" class="btn btn-outline-danger float-end" onclick="confirmDelete('<?= $activity['activity_id'] ?>')">
                    <i class="ri-delete-bin-line me-1"></i>
                    <?= lang('App.delete_activity') ?>
                </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= lang('App.confirm_delete') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><?= lang('App.delete_activity_confirm') ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= lang('App.cancel') ?></button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger"><?= lang('App.delete') ?></a>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(activityId) {
    var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    document.getElementById('confirmDeleteBtn').href = '<?= base_url('/account/admin/activity-logs/delete') ?>/' + activityId;
    modal.show();
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>

<!-- end main content -->
<?= $this->endSection() ?>