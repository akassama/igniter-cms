<?php
// Get current theme
$theme = getCurrentTheme();

$siteName = getConfigData("SiteName");

// Get theme data
$themeData = [
    'customCSS' => getTableData('codes', ['code_for' => 'CSS'], 'code'),
    'customJSTop' => getTableData('codes', ['code_for' => 'HeaderJS'], 'code'),
    'customJSFooter' => getTableData('codes', ['code_for' => 'FooterJS'], 'code'),
    'primaryColor' => getThemeData($theme, "primary_color"),
    'secondaryColor' => getThemeData($theme, "secondary_color"),
    'backgroundColor' => getThemeData($theme, "background_color"),
];

// Get navigation and social model lists
$navigationsModel = new \App\Models\NavigationsModel();
$topNavLists = $navigationsModel->where('group', 'top_nav')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll();
$footerNavLists = $navigationsModel->where('group', 'footer_nav')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll();
$servicesNavLists = $navigationsModel->where('group', 'services')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll();
?>

<?= $this->include('front-end/themes/'.$theme.'/includes/_functions.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--Load Meta Plugin Helpers-->
    <?=$this->include('front-end/themes/_shared/_load_meta_plugin_helpers.php'); ?>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Remix icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.min.css" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <!-- Glightbox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.1/css/glightbox.css" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Core theme CSS -->
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/css/style.css') ?>" rel="stylesheet">

    <!--Favicon-->
    <link rel="icon" type="image/png" href="https://assets.aktools.net/image-stocks/logos/favicon/favicon.png" sizes="96x96" />

    <!-- Custom CSS -->
    <?php if (!empty($themeData['customCSS'])): ?>
        <style><?= $themeData['customCSS'] ?></style>
    <?php endif; ?>

    <!-- Custom Theme CSS -->
    <style>
        <?php
            $overrideStyle = getThemeData($theme, "override_default_style");
            if($overrideStyle === "1"){
                echo $this->include('front-end/themes/_shared/_theme_style_override.php');
            }
        ?>
    </style>

    <!-- Custom JavaScript in the head -->
    <?php if (!empty($themeData['customJSTop'])): ?>
        <?= $themeData['customJSTop'] ?>
    <?php endif; ?>

    <!--Load Header Plugin Helpers-->
    <?=$this->include('front-end/themes/_shared/_load_header_plugin_helpers.php'); ?>
</head>
<body class="d-flex flex-column min-vh-100" data-bs-spy="scroll" data-bs-target="#navbar">
    <!-- Navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand border border-white rounded p-2" href="<?= base_url()?>">
                <img src="<?=getImageUrl(getConfigData("SiteLogoLink") ?? getDefaultImagePath())?>" alt="<?=getConfigData("SiteLogoLink")?> Logo" height="75">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if ($topNavLists): ?>
                        <?php foreach ($topNavLists as $navigation): ?>
                            <?= themef_renderNavigation($navigation, $navigationsModel) ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <form action="<?= base_url('search') ?>" method="get" class="d-flex ms-xl-3 mt-3 mt-xl-0" role="search">
                    <input class="form-control me-2" type="search" id="q" name="q" placeholder="Search for..." aria-label="Search for..." minlength="2" required>
                </form>
            </div>
        </div>
    </nav>


    <!-- Main Content -->
    <main class="main">
        <?= $this->renderSection('content') ?>
    </main>
    <!-- End Main Content -->

    <!-- Footer -->
    <footer class="mt-auto bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <a class="d-flex align-items-center mb-3 text-white text-decoration-none">
                        <img src="https://assets.aktools.net/image-stocks/logos/ak-themes-logo-2.png" alt="GEXPOTECH Logo" height="40">
                    </a>
                    <p class="small">Your trusted partner for comprehensive IT solutions and services. Empowering businesses through technology since 2010.</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-4">Quick Links</h5>
                    <ul class="list-unstyled">
                        <?php if ($footerNavLists): ?>
                            <?php foreach ($footerNavLists as $navigation): ?>
                                <?php if (empty($navigation['parent'])): ?>
                                    <li class="mb-2">
                                        <a href="<?= getLinkUrl($navigation['link']) ?>" class="text-white text-decoration-none" target="<?= $navigation['new_tab'] === "1" ? "_blank" : "_self" ?>">
                                            <?= $navigation['title'] ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-4">Services</h5>
                    <ul class="list-unstyled">
                        <?php if ($servicesNavLists): ?>
                            <?php foreach ($servicesNavLists as $navigation): ?>
                                <?php if (empty($navigation['parent'])): ?>
                                    <li class="mb-2">
                                        <a href="<?= getLinkUrl($navigation['link']) ?>" class="text-white text-decoration-none" target="<?= $navigation['new_tab'] === "1" ? "_blank" : "_self" ?>">
                                            <?= $navigation['title'] ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <li class="mb-2">
                            <a href="<?= base_url('sign-in') ?>" class="text-white text-decoration-none" target="_blank">
                                Sign In
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-4">Get In Touch</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i> 123 Tech Park, Watford, UK</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i> +44 20 1234 5678</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i> info@gexpotech.com</li>
                    </ul>
                    <div class="mt-4">
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter-x fs-5"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-linkedin fs-5"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small mb-0">&copy; <?=date('Y')?> <?=$siteName ?>. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="small mb-0">
                        <a href="javascript:void(0);" class="text-white text-decoration-none me-3">Privacy Policy</a>
                        <a href="javascript:void(0);" class="text-white text-decoration-none">Terms of Service</a>
                    </p>
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
    <!-- CountUp JS -->
    <script src="https://cdn.jsdelivr.net/npm/countup.js@2.8.0/dist/countUp.min.js"></script>
    <!--ImagesLoaded CDN-->
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <!--SweetAlert2 CDN-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--Isotope JS-->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    
    <!-- Core theme JS -->
    <script defer src="<?= base_url('public/front-end/themes/' . $theme . '/assets/js/script.js') ?>"></script>

    <!-- Custom JavaScript in the footer -->
    <?php if (!empty($themeData['customJSFooter'])): ?>
        <?= $themeData['customJSFooter'] ?>
    <?php endif; ?>
    
    <!-- Global modal for search -->
    <?=$this->include('front-end/themes/_shared/_global_search_modal.php'); ?>

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
    <?= $this->include('front-end/layout/assets/sweet_alerts.php'); ?>
</body>
</html>