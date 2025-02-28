<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Search Results<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Search Results')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Search Results for <span class="text-danger">"<?= $searchQuery ?>"</span></h3>
    </div>

    <div class="col-12">
        <?php if (!empty($searchResults)): ?>
            <ul class="list-group">
                <?php foreach ($searchResults as $result): ?>
                    <li class="list-group-item">
                        <p>
                            <strong><?= $result['module_name'] ?>:</strong> (<?= $result['module_description'] ?>)
                        </p>
                        <a href="<?= base_url('/' . $result['module_link']) ?>">View Details</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
