<?php
// Get current theme
$theme = getCurrentTheme();

$siteName = getConfigData("SiteName");

// Get theme data
$themeData = [
    'customCSS' => getTableData('codes', ['code_for' => 'CSS'], 'code'),
    'customJSTop' => getTableData('codes', ['code_for' => 'HeaderJS'], 'code'),
    'customJSFooter' => getTableData('codes', ['code_for' => 'FooterJS'], 'code'),
    'defaultColor' => getThemeData($theme, "default_color"),
    'headingColor' => getThemeData($theme, "heading_color"),
    'accentColor' => getThemeData($theme, "accent_color"),
    'surfaceColor' => getThemeData($theme, "surface_color"),
    'contrastColor' => getThemeData($theme, "contrast_color"),
    'backgroundColor' => getThemeData($theme, "background_color"),
];

// Get navigation and social model lists
$navigationsModel = new \App\Models\NavigationsModel();
$topNavLists = $navigationsModel->where('group', 'top_nav')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll();
$footerNavLists = $navigationsModel->where('group', 'footer_nav')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll();
$servicesNavLists = $navigationsModel->where('group', 'services')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll();
?>

<?= $this->include('front-end/themes/'.$theme.'/includes/_functions.php'); ?>

<?php
$adminBar = renderAdminBar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--Load Meta Plugin Helpers-->
    <?=$this->include('front-end/themes/_shared/_load_meta_plugin_helpers.php'); ?>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <!-- Glightbox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.1/css/glightbox.css" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <?=loadSiteIcons()?>

    <!-- Core Theme CSS Variables -->
    <?php
        $overrideStyle = getThemeData($theme, "override_default_style");
        $useStaticThemeNav = getThemeData($theme, "use_static_theme_nav");
        if($overrideStyle === "1"){

            // Theme color variables
            $defaultColor = $themeData['defaultColor'];
            $headingColor = $themeData['headingColor'];
            $accentColor = $themeData['accentColor'];
            $surfaceColor = $themeData['surfaceColor'];
            $contrastColor = $themeData['contrastColor'];
            $backgroundColor = $themeData['backgroundColor'];

            ?>
            <style>
                /* ===== Override Root Variables ===== */
                :root {
                    --default-color: <?php echo $defaultColor; ?>;
                    --heading-color: <?php echo $headingColor; ?>;
                    --accent-color: <?php echo $accentColor; ?>;
                    --surface-color: <?php echo $surfaceColor; ?>;
                    --contrast-color: <?php echo $contrastColor; ?>;
                    --background-color: <?php echo $backgroundColor; ?>;
                }
            </style>
        <?php
        }
        else{
            ?>
                <style>
                    /* ===== Root Variables ===== */
                    :root {
                        --default-color: #6c757d;
                        --heading-color: #212529;
                        --accent-color: #0d6efd;
                        --surface-color: #f8f9fa;
                        --contrast-color: #ffffff;
                        --background-color: #ffffff;
                    }
                </style>
            <?php
        }
    ?>

    <!-- Core Theme CSS -->
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/css/site.css') ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <?php if (!empty($themeData['customCSS'])): ?>
        <style><?= $themeData['customCSS'] ?></style>
    <?php endif; ?>

    <!-- Custom JavaScript in the head -->
    <?php if (!empty($themeData['customJSTop'])): ?>
        <?= $themeData['customJSTop'] ?>
    <?php endif; ?>

    <!--Load Header Plugin Helpers-->
    <?=$this->include('front-end/themes/_shared/_load_header_plugin_helpers.php'); ?>
</head>
<body class="d-flex flex-column min-vh-100" data-bs-spy="scroll" data-bs-target="#navbar">
    <?= $adminBar ?>

    <!-- Navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url()?>">
                <?= $siteName ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <?php if ($useStaticThemeNav === "1"): ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url('#hero') ?>" target="_self">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('#about') ?>" target="_self">
                                About
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Services
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <li><h6 class="dropdown-header">Our Services</h6></li>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('#services') ?>">
                                        <i class="bi bi-laptop me-2"></i>IT Procurement
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('#services') ?>">
                                        <i class="bi bi-cloud me-2"></i>Cloud Solutions
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('#services') ?>">
                                        <i class="bi bi-people me-2"></i>IT Consulting
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider" /></li>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('#services') ?>">
                                        <i class="bi bi-list-check me-2"></i>View All Services
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('#portfolio') ?>" target="_self">
                                Portfolio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('#team') ?>" target="_self">
                                Team
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('#blog') ?>" target="_self">
                                Blog
                            </a>
                        </li>
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-primary rounded-pill px-4" href="<?= base_url('#contact') ?>" target="_self">
                                <i class="bi bi-headset me-2"></i>Contact Us
                            </a>
                        </li>
                    <?php else: ?>
                        <?php if ($topNavLists): ?>
                            <?php foreach ($topNavLists as $navigation): ?>
                                <?= themef_renderNavigation($navigation, $navigationsModel) ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main" id="template-html">
        <?= $this->renderSection('content') ?>
    </main>
    <!-- End Main Content -->

    <!-- Footer -->
    <footer class="mt-auto">
        <div class="footer-waves"></div>
        <div class="footer-content">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-logo"><?= $siteName ?></div>
                        <div class="footer-about">
                            <p>Your trusted partner for comprehensive IT solutions and services. Empowering businesses through technology since 2010.</p>
                            <div class="social-links">
                                <a href="#"><i class="bi bi-twitter-x"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-links">
                            <h5 class="footer-heading">Quick Links</h5>
                            <ul class="list-unstyled">
                                <?php if ($footerNavLists): ?>
                                    <?php foreach ($footerNavLists as $navigation): ?>
                                        <?php if (empty($navigation['parent'])): ?>
                                            <li>
                                                <a href="<?= getLinkUrl($navigation['link']) ?>" class="text-decoration-none" target="<?= $navigation['new_tab'] === "1" ? "_blank" : "_self" ?>">
                                                    <?= $navigation['title'] ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-links">
                            <h5 class="footer-heading">Our Services</h5>
                            <ul class="list-unstyled">
                                <?php if ($servicesNavLists): ?>
                                    <?php foreach ($servicesNavLists as $navigation): ?>
                                        <?php if (empty($navigation['parent'])): ?>
                                            <li>
                                                <a href="<?= getLinkUrl($navigation['link']) ?>" class="text-decoration-none" target="<?= $navigation['new_tab'] === "1" ? "_blank" : "_self" ?>">
                                                    <?= $navigation['title'] ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-contact">
                            <h5 class="footer-heading">Contact Info</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <i class="bi bi-geo-alt"></i>
                                    <span>123 Tech Park, Watford, UK</span>
                                </li>
                                <li>
                                    <i class="bi bi-telephone"></i>
                                    <span>+44 20 1234 5678</span>
                                </li>
                                <li>
                                    <i class="bi bi-envelope"></i>
                                    <span>info@akthemes.com</span>
                                </li>
                                <li>
                                    <i class="bi bi-clock"></i>
                                    <span>Mon-Fri: 9AM - 6PM</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-start">
                            <p>&copy; <?=date('Y')?> <strong><?=$siteName ?></strong>. All rights reserved.</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-bottom-links">
                                <a href="#">Privacy Policy</a>
                                <a href="#">Terms of Service</a>
                                <a href="#">Sitemap</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="btn btn-primary rounded-circle shadow scroll-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up fs-5"></i>
    </button>

    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- Glightbox.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.1/js/glightbox.min.js"></script>
    <!--ImagesLoaded CDN-->
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <!--SweetAlert2 CDN-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Core theme JS -->
    <script defer src="<?= base_url('public/front-end/themes/' . $theme . '/assets/js/site.js') ?>"></script>

    <!-- Custom JavaScript in the footer -->
    <?php if (!empty($themeData['customJSFooter'])): ?>
        <?= $themeData['customJSFooter'] ?>
    <?php endif; ?>

    <!-- Global modal for search -->
    <?=$this->include('front-end/themes/_shared/_global_search_modal.php'); ?>

    <?= $this->include('front-end/layout/assets/sweet_alerts.php'); ?>

    <!--Load Footer Plugin Helpers-->
    <?=$this->include('front-end/themes/_shared/_load_footer_plugin_helpers.php'); ?>
</body>
</html>