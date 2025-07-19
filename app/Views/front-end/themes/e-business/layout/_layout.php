<?php
// Get current theme
$theme = getCurrentTheme();

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
    <!-- Essential Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Load Meta Plugin Helpers-->
    <?=$this->include('front-end/themes/_shared/_load_meta_plugin_helpers.php'); ?>

    <!-- Theme Colors -->
    <meta name="theme-color" content="<?= $themeData['primaryColor'] ?? '#000000' ?>">
    <meta name="msapplication-TileColor" content="<?= $themeData['secondaryColor'] ?? '#ffffff' ?>">

    <!-- Remix icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.min.css" />

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">

    <!-- AOS Library CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!--flag-icon-css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"/>

    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/css/custom.css') ?>" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/aos/aos.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/css/main.css') ?>" rel="stylesheet">

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
<body class="d-flex flex-column min-vh-100">
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <h1 class="sitename"><span>e</span>Business</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#team">Team</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="index.html#about">Get Started</a>

    </div>
  </header>

    <!-- Main Content -->
    <main class="main">
        <div class="row">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <!-- Footer -->
      <footer id="footer" class="footer dark-background">

        <div class="footer-newsletter">
          <div class="container">
            <div class="row justify-content-center text-center">
              <div class="col-lg-6">
                <h4>Join Our Newsletter</h4>
                <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
                <form action="forms/newsletter.php" method="post" class="php-email-form">
                  <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="container footer-top">
          <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
              <a href="index.html" class="d-flex align-items-center">
                <span class="sitename">eBusiness</span>
              </a>
              <div class="footer-contact pt-3">
                <p>A108 Adam Street</p>
                <p>New York, NY 535022</p>
                <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                <p><strong>Email:</strong> <span>info@example.com</span></p>
              </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
              <h4>Useful Links</h4>
              <ul>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
              </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
              <h4>Our Services</h4>
              <ul>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
              </ul>
            </div>

            <div class="col-lg-4 col-md-12">
              <h4>Follow Us</h4>
              <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
              <div class="social-links d-flex">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>

          </div>
        </div>

        <div class="container copyright text-center mt-4">
          <p>© <span>Copyright</span> <strong class="px-1 sitename">eBusiness</strong> <span>All Rights Reserved</span></p>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>

      </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?= minifyJS('public/front-end/themes/' . $theme . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= minifyJS('public/front-end/themes/' . $theme . '/assets/vendor/php-email-form/validate.js') ?>"></script>
  <script src="<?= minifyJS('public/front-end/themes/' . $theme . '/assets/vendor/aos/aos.js') ?>"></script>
  <script src="<?= minifyJS('public/front-end/themes/' . $theme . '/assets/vendor/purecounter/purecounter_vanilla.js') ?>"></script>
  <script src="<?= minifyJS('public/front-end/themes/' . $theme . '/assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>
  <script src="<?= minifyJS('public/front-end/themes/' . $theme . '/assets/vendor/glightbox/js/glightbox.min.js') ?>"></script>
  <script src="<?= minifyJS('public/front-end/themes/' . $theme . '/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') ?>"></script>
  <script src="<?= minifyJS('public/front-end/themes/' . $theme . '/assets/vendor/isotope-layout/isotope.pkgd.min.js') ?>"></script>

  <!-- Main JS File -->
  <script src="<?= minifyJS('public/front-end/themes/' . $theme . '/assets/js/main.js') ?>"></script>

    <!-- Custom JavaScript in the footer -->
    <?php if (!empty($themeData['customJSFooter'])): ?>
        <?= $themeData['customJSFooter'] ?>
    <?php endif; ?>
    
    <!-- Global modal for search -->
    <?=$this->include('front-end/themes/_shared/_global_search_modal.php'); ?>

    <!--Load Footer Plugin Helpers-->
    <?=$this->include('front-end/themes/_shared/_load_footer_plugin_helpers.php'); ?>

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
    <?= $this->include('front-end/layout/assets/sweet_alerts.php'); ?>
</body>
</html>