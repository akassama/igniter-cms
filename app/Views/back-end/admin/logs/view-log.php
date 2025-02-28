<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name') . ' ' . $session->get('last_name');
$sessionEmail = $session->get('email');
$userRole = getUserRole($sessionEmail);
?>

<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>View Log<?= $this->endSection() ?>

    <!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Logs', 'url' => '/account/admin/logs'),
    array('title' => 'View Log')
);
echo generateBreadcrumb($breadcrumb_links);
?>

    <div class="row">
        <!--Content-->
        <div class="col-12">
            <h3>View Log: <?= esc($filename) ?></h3>
        </div>
        <div class="col-12 bg-light rounded p-4">
            <div class="row">
                <div class="mb-3 mt-3">
                    <a href="<?= base_url('/account/admin/logs') ?>" class="btn btn-outline-danger">
                        <i class="ri-arrow-left-fill"></i>
                        Back
                    </a>
                </div>
            </div>

            <!-- Display log entries -->
            <div class="mt-4">
            <pre style="background: #f8f9fa; padding: 15px; border-radius: 5px; max-height: 500px; overflow-y: auto;">
                <?php foreach ($logEntries as $entry): ?>
                    <?= esc($entry) ?><br>
                <?php endforeach; ?>
            </pre>
            </div>
        </div>
    </div>

    <!-- end main content -->
<?= $this->endSection() ?>