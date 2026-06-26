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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <!-- Glightbox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.1/css/glightbox.css" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet" />
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
                        --default-color: #343a40;
                        --heading-color: #212529;
                        --accent-color: #007bff;
                        --surface-color: #ffffff;
                        --contrast-color: #e9ecef;
                        --background-color: #f8f9fa;
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

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Header -->
    <header id="header" class="fixed-top">
        <!-- Navigation -->
        <nav id="navbar" class="navbar navbar-expand-lg navbar-light py-3 d-flex align-items-center">
            <div class="container">
                <a class="navbar-brand fs-4 fw-bold" href="<?= base_url()?>">
                    <i class="bi bi-house-door-fill text-primary me-2"></i>
                    <?= $siteName ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <?php if ($useStaticThemeNav === "1"): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('#hero') ?>" target="_self">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('#about') ?>" target="_self">
                                    About
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('#services') ?>" target="_self">
                                    Services
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('#properties') ?>" target="_self">
                                    Properties
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('#agents') ?>" target="_self">
                                    Agents
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('#contact') ?>" target="_self">
                                    Contact
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
                    <form action="<?= base_url('search') ?>" method="get" class="d-flex ms-xl-3 mt-3 mt-xl-0" role="search">
                        <input class="form-control me-2" type="search" id="q" name="q" placeholder="Search for..." aria-label="Search for..." minlength="2" required>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main" id="template-html">
        <?= $this->renderSection('content') ?>
    </main>
    <!-- End Main Content -->

    <!-- Footer -->
    <footer id="footer" class="mt-auto">
        <div class="footer-top">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 footer-about">
                        <a href="<?= base_url() ?>" class="logo d-flex align-items-center">
                            <i class="bi bi-house-door-fill text-primary me-2"></i>
                            <span><?= $siteName ?></span>
                        </a>
                        <div class="footer-info">
                            <p class="small">Your trusted partner in navigating the real estate market. Dedicated to finding you the perfect property or securing the best deal for your home.</p>
                            <div class="social-links mt-3">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul class="list-unstyled">
                            <?php if ($footerNavLists): ?>
                                <?php foreach ($footerNavLists as $navigation): ?>
                                    <?php if (empty($navigation['parent'])): ?>
                                        <li class="mb-2">
                                            <i class="bi bi-chevron-right"></i>
                                            <a href="<?= getLinkUrl($navigation['link']) ?>" class="text-white text-decoration-none" target="<?= $navigation['new_tab'] === "1" ? "_blank" : "_self" ?>">
                                                <?= $navigation['title'] ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul class="list-unstyled">
                            <?php if ($servicesNavLists): ?>
                                <?php foreach ($servicesNavLists as $navigation): ?>
                                    <?php if (empty($navigation['parent'])): ?>
                                        <li class="mb-2">
                                            <i class="bi bi-chevron-right"></i>
                                            <a href="<?= getLinkUrl($navigation['link']) ?>" class="text-white text-decoration-none" target="<?= $navigation['new_tab'] === "1" ? "_blank" : "_self" ?>">
                                                <?= $navigation['title'] ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6 footer-contact">
                        <h4>Get In Touch</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-geo-alt me-2"></i> 123 Real Estate St, Suite 100, Metropolis, 12345</li>
                            <li class="mb-2"><i class="bi bi-telephone me-2"></i> +1 5589 55488 55</li>
                            <li class="mb-2"><i class="bi bi-envelope me-2"></i> info@<?= strtolower($siteName) ?>.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright text-center">
                <p class="small mb-0">&copy; <?=date('Y')?> <?=$siteName ?>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top -->
    <a href="#" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- Glightbox.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.1/js/glightbox.min.js"></script>
    <!-- CountUp JS -->
    <script src="https://cdn.jsdelivr.net/npm/countup.js@2.8.0/dist/countUp.min.js"></script>
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

    <!-- SweetAlert JS -->
    <?= $this->include('front-end/layout/assets/sweet_alerts.php'); ?>

    <!--Load Footer Plugin Helpers-->
    <?=$this->include('front-end/themes/_shared/_load_footer_plugin_helpers.php'); ?>
</body>
</html>