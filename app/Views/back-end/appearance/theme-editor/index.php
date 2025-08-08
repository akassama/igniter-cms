<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$userRole = getUserRole($sessionEmail);

// Load the CustomConfig
$customConfig = config('CustomConfig');
?>

<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Edit Theme Files<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Appearance', 'url' => '/account/appearance'),
    array('title' => 'File Editor')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <div class="col-12">
        <h3>
            Edit Theme Files
        </h3>
        <h6 class="float-start">
            Theme: <?=getCurrentTheme()?>
        </h6>
    </div>
    <div class="col-12">
        <div class="row g-3">
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/appearance/theme-editor/layout') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">Layout</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">layout/_layout.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/layout/_layout.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/layout/_layout.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/appearance/theme-editor/home') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">Home</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">home/index.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/home/index.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/home/index.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/appearance/theme-editor/blogs') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">Blogs</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">blogs/index.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/blogs/index.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/blogs/index.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/appearance/theme-editor/view-blog') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">View Blog</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">blogs/view-blog.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/blogs/view-blog.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/blogs/view-blog.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/appearance/theme-editor/view-page') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">View Page</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">pages/view-page.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/pages/view-page.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/pages/view-page.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/appearance/theme-editor/search') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">Search</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">search/index.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/search/index.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/search/index.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/appearance/theme-editor/search-filter') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">Search Filter</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">search/filter.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/search/filter.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/search/filter.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>


<!-- end main content -->
<?= $this->endSection() ?>