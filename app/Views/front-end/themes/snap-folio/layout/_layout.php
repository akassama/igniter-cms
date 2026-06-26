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

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <!-- Theme Colors -->
    <meta name="theme-color" content="<?= $themeData['primaryColor'] ?? '#000000' ?>">
    <meta name="msapplication-TileColor" content="<?= $themeData['secondaryColor'] ?? '#ffffff' ?>">

    <!-- Remix icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.min.css" />

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">

    <!--flag-icon-css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"/>

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/aos/aos.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">

    <!-- Highlight.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">

    <!-- Main CSS File -->
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/css/main.css') ?>" rel="stylesheet">

    <!-- =======================================================
  * Template Name: SnapFolio
  * Template URL: https://bootstrapmade.com/snapfolio-bootstrap-portfolio-template/
  * Updated: Jul 21 2025 with Bootstrap v5.3.7
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

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

  <body class="starter-page-page d-flex flex-column min-vh-100">
    <header
      id="header"
      class="header dark-background d-flex flex-column justify-content-center"
    >
      <i class="header-toggle d-xl-none bi bi-list"></i>

      <div class="header-container d-flex flex-column align-items-start">
        <nav id="navmenu" class="navmenu">
          <ul>
            <?php if ($topNavLists): ?>
                <?php foreach ($topNavLists as $navigation): ?>
                    <?= themef_renderNavigation($navigation, $navigationsModel) ?>
                <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </nav>

        <div class="social-links text-center">
          <a href="https://github.com/akassama" class="github"><i class="bi bi-github"></i></a>
          <a href="https://linkedin.com/in/akassama" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </header>

    <main class="main">
        <?= $this->renderSection('content') ?>
    </main>

    <footer id="footer" class="footer position-relative mt-auto">
      <div class="container">
        <div class="copyright text-center">
          <p>
            © <span>Copyright</span>
            <strong class="px-1 sitename">iPortfolio</strong>
            <span>All Rights Reserved</span>
          </p>
        </div>
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
    <a
      href="#"
      id="scroll-top"
      class="scroll-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/aos/aos.js') ?>"></script>
    <script src="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/typed.js/typed.umd.js') ?>"></script>
    <script src="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/purecounter/purecounter_vanilla.js') ?>"></script>
    <script src="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/waypoints/noframework.waypoints.js') ?>"></script>
    <script src="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/isotope-layout/isotope.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/glightbox/js/glightbox.min.js') ?>"></script>
    <script src="<?= base_url('public/front-end/themes/' . $theme . '/assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>

    <!-- Highlight.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <!-- Additional languages -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/java.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/csharp.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/cpp.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/ruby.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/swift.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/go.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/rust.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/bash.min.js"></script>

    <!-- Main JS File -->
    <script src="<?= base_url('public/front-end/themes/' . $theme . '/assets/js/main.js') ?>"></script>

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