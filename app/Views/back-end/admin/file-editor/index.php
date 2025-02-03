<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$userRole = getUserRole($sessionEmail);
?>

<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'File Editor')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <div class="col-12">
        <h3>
            Edit Theme Files
        </h3>
        <h6 class="float-end">
            Theme: <?=getCurrentTheme()?>
        </h6>
    </div>
    <div class="col-12">
        <div class="row g-3">
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/admin/file-editor/layout') ?>" class="text-decoration-none">
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
                <a href="<?= base_url('account/admin/file-editor/home') ?>" class="text-decoration-none">
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
                <a href="<?= base_url('account/admin/file-editor/blogs') ?>" class="text-decoration-none">
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
                <a href="<?= base_url('account/admin/file-editor/view-blog') ?>" class="text-decoration-none">
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
                <a href="<?= base_url('account/admin/file-editor/contact') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">Contact</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">contact/index.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/contact/index.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/contact/index.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/admin/file-editor/events') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">Events</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">events/index.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/events/index.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/events/index.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/admin/file-editor/view-event') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">View Event</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">events/view-event.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/events/view-event.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/events/view-event.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/admin/file-editor/view-page') ?>" class="text-decoration-none">
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
                <a href="<?= base_url('account/admin/file-editor/portfolios') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">Portfolios</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">portfolios/index.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/portfolios/index.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/portfolios/index.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/admin/file-editor/view-portfolio') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">View Portfolio</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">portfolios/view-portfolio.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/portfolios/view-portfolio.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/portfolios/view-portfolio.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/admin/file-editor/donations') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">Donations & Campaings</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">donations/index.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/donations/index.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/donations/index.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/admin/file-editor/view-donation') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">View Donation</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">donations/view-donation.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/donations/view-donation.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/donations/view-donation.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/admin/file-editor/shops') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">Shop</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">shops/index.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/shops/index.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/shops/index.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/admin/file-editor/view-shop') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">View Shop</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">shops/view-shop.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/shops/view-shop.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/shops/view-shop.php
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/admin/file-editor/search') ?>" class="text-decoration-none">
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
                <a href="<?= base_url('account/admin/file-editor/search-filter') ?>" class="text-decoration-none">
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
            <div class="col-md-3 col-sm-4 col-6">
                <a href="<?= base_url('account/admin/file-editor/sitemap') ?>" class="text-decoration-none">
                    <div class="card text-center h-100 shadow-sm">
                        <h6 class="card-title text-dark mt-2">Sitemap</h6>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="ri-code-block text-dark" style="font-size: 4rem;"></i>
                            <h5 class="card-title mt-2">sitemap/sitemap.php</h5>
                            <small class="text-muted text-truncate w-100" style="max-width: 100%; overflow: hidden;" data-bs-toggle="tooltip" title="Path: app/Views/front-end/themes/<?=getCurrentTheme()?>/sitemap/sitemap.php">
                                app/Views/front-end/themes/<?=getCurrentTheme()?>/sitemap/sitemap.php
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