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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css " />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <!-- Glightbox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.1/css/glightbox.css" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <?=loadSiteIcons()?>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

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
                      --default-color: #333;
                      --heading-color: #212529;
                      --accent-color: #ffc107;
                      --surface-color: #ffffff;
                      --contrast-color: #ffffff;
                      --background-color: #f8f9fa;
                    }
                </style>
            <?php
        }
    ?>

    <!-- Core Theme CSS -->
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/css/site.css') ?>" rel="stylesheet">

    <!--Favicon-->
    <link rel="icon" type="image/png" href="https://assets.aktools.net/image-stocks/logos/favicon/bootstrap.png" sizes="96x96" />

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
    <div id="preloader">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Header -->
    <header id="header" class="header fixed-top">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="logo">
                <a href="<?= base_url() ?>" class="d-flex align-items-center">
                    <img src="<?=getImageUrl(getConfigData("SiteLogoLink") ?? getDefaultImagePath())?>" alt="<?= $siteName ?> Logo">
                    <span class="ms-2 fs-4 fw-bold"><?= $siteName ?></span>
                </a>
            </div>
            <nav id="navbar" class="navbar navmenu">
                <ul class="d-flex list-unstyled m-0">
                    <li><a href="<?= base_url('#hero') ?>">Home</a></li>
                    <li><a href="<?= base_url('#about') ?>">About</a></li>
                    <li><a href="<?= base_url('#programs') ?>">Programs</a></li>
                    <li><a href="<?= base_url('#schedule') ?>">Schedule</a></li>
                    <li><a href="<?= base_url('#trainers') ?>">Trainers</a></li>
                    <li><a href="<?= base_url('#blog') ?>">Blog</a></li>
                    <li><a href="<?= base_url('#testimonials') ?>">Testimonials</a></li>
                    <li><a href="<?= base_url('#contact') ?>">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main" id="template-html">
        <?= $this->renderSection('content') ?>
    </main>
    <!-- End Main Content -->

    <!-- Footer -->
    <footer class="mt-auto">
        <div class="container py-4">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-uppercase"><?= $siteName ?></h4>
                    <p class="small text-muted">
                        123 Fitness Ave, Suite 456<br />
                        City, State 12345<br />
                        <strong>Phone:</strong> +1 5589 55488 55<br />
                        <strong>Email:</strong> info@example.com<br />
                    </p>
                    <div class="social-links mt-3">
                        <a href="#" class="text-white-50"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white-50"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white-50"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white-50"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4 class="text-uppercase">Useful Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url('#hero') ?>">Home</a></li>
                        <li><a href="<?= base_url('#about') ?>">About us</a></li>
                        <li><a href="<?= base_url('#classes') ?>">Classes</a></li>
                        <li><a href="<?= base_url('#trainers') ?>">Trainers</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4 class="text-uppercase">Our Services</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Personal Training</a></li>
                        <li><a href="#">Group Classes</a></li>
                        <li><a href="#">Nutritional Guidance</a></li>
                        <li><a href="#">Fitness Assessments</a></li>
                        <li><a href="#">Membership Plans</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h4 class="text-uppercase">Our Newsletter</h4>
                    <p class="small text-muted">
                        Subscribe to our newsletter to receive the latest updates.
                    </p>
                    <form class="d-flex">
                        <input type="email" class="form-control me-2" placeholder="Your Email" />
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0 small">
                    &copy; Copyright <strong><span><?= $siteName ?></span></strong>. All Rights Reserved
                </p>
                <div class="small mt-1">
                    Designed by <a href="#" class="text-white-50">BootstrapMade</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- Glightbox.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.1/js/glightbox.min.js"></script>
    <!-- CountUp JS -->
    <script src="https://cdn.jsdelivr.net/npm/countup.js@2.9.0/dist/countUp.min.js"></script>
    <!--ImagesLoaded CDN-->
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <!--SweetAlert2 CDN-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Core theme JS -->
    <script src="<?= base_url('public/front-end/themes/' . $theme . '/assets/js/site.js') ?>"></script>

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