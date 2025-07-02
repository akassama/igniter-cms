<?php
// Get current theme
$theme = getCurrentTheme();

// Get site config values
$configData = [
    'baseUrl' => base_url(),
    'currentUrl' => current_url(),
    'maintenanceMode' => getConfigData("MaintenanceMode"),
    'companyName' => getConfigData("CompanyName"),
    'companyAddress' => getConfigData("CompanyAddress"),
    'companyEmail' => getConfigData("CompanyEmail"),
    'companyNumber' => getConfigData("CompanyNumber"),
    'siteLogoLink' => getConfigData("SiteLogoLink"),
    'siteLogoTwoLink' => getConfigData("SiteLogoTwoLink"),
    'siteFaviconLink' => getConfigData("SiteFaviconLink"),
    'siteFaviconManifestLink' => getConfigData("SiteFaviconManifestLink"),
    'siteFaviconLink96' => getConfigData("SiteFaviconLink96"),
    'siteFaviconLinkAppleTouch' => getConfigData("SiteFaviconLinkAppleTouch"),
];

// Get meta data
$metaData = [
    'author' => getPageMetaInfo($configData['currentUrl'], "MetaAuthor"),
    'title' => getPageMetaInfo($configData['currentUrl'], "MetaTitle"),
    'description' => getPageMetaInfo($configData['currentUrl'], "MetaDescription"),
    'keywords' => getPageMetaInfo($configData['currentUrl'], "MetaKeywords"),
    'ogImage' => getPageMetaInfo($configData['currentUrl'], "MetaOgImage"),
    'pageUrl' => getPageMetaInfo($configData['currentUrl'], "MetaPageUrl"),
];

// Get social links
$socialLinks = [
    'facebook' => getTableData('socials', ['name' => 'Facebook'], 'link'),
    'instagram' => getTableData('socials', ['name' => 'Instagram'], 'link'),
    'linkedin' => getTableData('socials', ['name' => 'LinkedIn'], 'link'),
    'twitter' => getTableData('socials', ['name' => 'Twitter'], 'link'),
];

// Get theme data
$themeData = [
    'customCSS' => getTableData('codes', ['code_for' => 'CSS'], 'code'),
    'customJSTop' => getTableData('codes', ['code_for' => 'HeaderJS'], 'code'),
    'customJSFooter' => getTableData('codes', ['code_for' => 'FooterJS'], 'code'),
    'copyRight' => getThemeData($theme, "footer_copyright"),
    'primaryColor' => getThemeData($theme, "primary_color"),
    'secondaryColor' => getThemeData($theme, "secondary_color"),
    'backgroundColor' => getThemeData($theme, "background_color"),
    'backgroundImage' => getThemeData($theme, "theme_bg_image"),
    'backgroundVideo' => getThemeData($theme, "theme_bg_video"),
    'sliderImage1' => getThemeData($theme, "theme_bg_slider_image_1"),
    'sliderImage2' => getThemeData($theme, "theme_bg_slider_image_2"),
    'sliderImage3' => getThemeData($theme, "theme_bg_slider_image_3"),
];

// Get navigation and social model lists
$navigationsModel = new \App\Models\NavigationsModel();
$topNavLists = $navigationsModel->where('group', 'top_nav')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll();
$footerNavLists = $navigationsModel->where('group', 'footer_nav')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll();
$servicesNavLists = $navigationsModel->where('group', 'services')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll();

$socialsModel = new \App\Models\SocialsModel();
$socialLinksQuery = $socialsModel->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_MEDIUM', 12)))->findAll();

// Maintenance mode
if (strtolower($configData['maintenanceMode']) === "yes") {
    echo $this->include('front-end/themes/_shared/_maintenance_page.php');
    exit();
}
?>

<!-- Include Theme Functions -->
<?= $this->include('front-end/themes/'.$theme.'/includes/_functions.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Essential Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title and Description -->
    <title><?= $metaData['title'] ?? 'Default Title' ?> - <?= $configData['companyName'] ?? 'Company Name' ?></title>
    <meta name="description" content="<?= $metaData['description'] ?? '' ?>">

    <!-- Keywords for SEO -->
    <meta name="keywords" content="<?= $metaData['keywords'] ?? '' ?>">

    <!-- Author Information -->
    <meta name="author" content="<?= $metaData['author'] ?? '' ?>">

    <!-- Open Graph (Facebook) -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $metaData['title'] ?? '' ?>">
    <meta property="og:description" content="<?= $metaData['description'] ?? '' ?>">
    <meta property="og:url" content="<?= $metaData['pageUrl'] ?? '' ?>">
    <meta property="og:image" content="<?= getImageUrl($metaData['ogImage'] ?? getDefaultImagePath()) ?>">
    <meta property="og:site_name" content="<?= $metaData['title'] ?? '' ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $metaData['title'] ?? '' ?>">
    <meta name="twitter:description" content="<?= $metaData['description'] ?? '' ?>">
    <meta name="twitter:image" content="<?= getImageUrl($configData['siteLogoLink'] ?? getDefaultImagePath()) ?>">
    <meta name="twitter:site" content="@<?= $metaData['author'] ?? '' ?>">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?= $metaData['pageUrl'] ?? '' ?>">

    <!-- Robots and Indexing -->
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    <!-- Theme Colors -->
    <meta name="theme-color" content="<?= $themeData['primaryColor'] ?? '#000000' ?>">
    <meta name="msapplication-TileColor" content="<?= $themeData['secondaryColor'] ?? '#ffffff' ?>">

    <!-- Favicon and Icons -->
    <link rel="icon" href="<?= getImageUrl($configData['siteFaviconLink'] ?? getDefaultImagePath()) ?>">
    <link rel="apple-touch-icon" href="<?= getImageUrl($configData['siteFaviconLinkAppleTouch'] ?? getDefaultImagePath()) ?>">
    <link rel="manifest" href="<?= getLinkUrl($configData['siteFaviconManifestLink'] ?? '') ?>">

    <!-- Structured Data (JSON-LD) for Rich Snippets -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "<?= $metaData['author'] ?? '' ?>",
        "url": "<?= $metaData['pageUrl'] ?? '' ?>",
        "sameAs": [
            "https://www.facebook.com/<?= $socialLinks['facebook'] ?? '' ?>",
            "https://twitter.com/<?= $socialLinks['twitter'] ?? '' ?>",
            "https://www.instagram.com/<?= $socialLinks['instagram'] ?? '' ?>"
        ],
        "description": "<?= $metaData['description'] ?? '' ?>",
        "image": "<?= getImageUrl($configData['siteLogoLink'] ?? getDefaultImagePath()) ?>"
    }
    </script>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Remix icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.min.css" />

    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">

    <!-- Glightbox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.1/css/glightbox.css" />

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">

    <!-- AOS Library CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Animate Library CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!--flag-icon-css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"/>

    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="<?= minifyCSS('public/front-end/themes/' . $theme . '/assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= minifyCSS('public/front-end/themes/' . $theme . '/assets/css/custom.css') ?>" rel="stylesheet">

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
     <?php
        $heroBgs = array($themeData['backgroundImage'], $themeData['sliderImage1'], $themeData['sliderImage2'], $themeData['sliderImage3']);
        $key = array_rand($heroBgs);
        $randomElement = $heroBgs[$key] ?? $themeData['backgroundImage'];
     ?>
    <style>   
        .hero {
        background:
            linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
            url("<?=base_url($randomElement)?>");
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
        }
    </style>

    <!-- Custom JavaScript in the head -->
    <?php if (!empty($themeData['customJSTop'])): ?>
        <?= $themeData['customJSTop'] ?>
    <?php endif; ?>

    <!-- Custom Head Data -->
    <?= $this->include('front-end/themes/_shared/_custom_head_data.php'); ?>
</head>
<body class="d-flex flex-column min-vh-100" data-bs-spy="scroll" data-bs-target="#navbar">
<!-- Navigation -->
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?=base_url('/')?>">
            <img src="<?=getImageUrl($configData['siteLogoTwoLink'] ?? getDefaultImagePath())?>" alt="<?=$configData['companyName']?> Logo" height="60">
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
                <div id="google_translate_element"></div>
            </ul>
        </div>
    </div>
</nav>


<!-- Main Content -->
<div class="main">
    <div class="row">
        <?= $this->renderSection('content') ?>
    </div>
</div>

<!-- Footer -->
<footer class="mt-auto bg-dark text-white pt-5 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-widget">
                    <h5>
                        <a href="<?=base_url('/')?>" class="d-flex align-items-center mb-3 text-white text-decoration-none">
                            <img src="<?=getImageUrl($configData['siteLogoTwoLink'] ?? getDefaultImagePath())?>" alt="<?=$configData['companyName']?> Logo" height="50">
                        </a>
                    </h5>
                    <p><?=$metaData['description']?></p>
                    <div class="social-links">
                        <?php if($socialLinksQuery): ?>
                            <?php foreach($socialLinksQuery as $socials): ?>
                                <?php
                                    $socialsId = $socials['social_id'];
                                    $name = $socials['name'];
                                    $icon = $socials['icon'];
                                    $link = getLinkUrl($socials['link']);
                                    $newTab = $socials['new_tab'];
                                    $navTarget = $newTab === "1" ? "_blank" : "_self";
                                ?>
                                <a href="<?=$link?>" class="text-white text-decoration-none" target="<?=$navTarget?>"><i class="<?=$icon?>"></i></a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="footer-widget">
                    <h5>Quick Links</h5>
                    <ul>
                        <?php if($footerNavLists): ?>
                            <?php foreach($footerNavLists as $navigation): ?>
                                <?php
                                    $navigationId = $navigation['navigation_id'];
                                    $navTitle = $navigation['title'];
                                    $parent = $navigation['parent'];
                                    $link = getLinkUrl($navigation['link']);
                                    $newTab = $navigation['new_tab'];
                                    $navTarget = $newTab === "1" ? "_blank" : "_self";
                                    $hasChildren = getTableData('navigations', ['navigation_id' => $navigationId], 'parent');
                                ?>
                                <!--Links without parent-->
                                <?php if(empty($parent)): ?> 
                                <li>
                                    <a href="<?=$link?>" class="text-decoration-none" target="<?=$navTarget?>">
                                        <?=$navTitle?>
                                    </a>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-widget">
                    <h5>Services</h5>
                    <ul>
                        <?php $footerServicesNavLists = $navigationsModel->where('group', 'services')->orderBy('order', 'ASC')->findAll();?>
                        <?php if($footerServicesNavLists): ?>
                            <?php foreach($footerServicesNavLists as $navigationServices): ?>
                                <?php
                                    $navigationId = $navigationServices['navigation_id'];
                                    $navTitle = $navigationServices['title'];
                                    $parent = $navigationServices['parent'];
                                    $link = getLinkUrl($navigationServices['link']);
                                    $newTab = $navigationServices['new_tab'];
                                    $navTarget = $newTab === "1" ? "_blank" : "_self";
                                    $hasChildren = getTableData('navigations', ['navigation_id' => $navigationId], 'parent');
                                ?>
                                <!--Links without parent-->
                                <?php if(empty($parent)): ?> 
                                <li>
                                    <a href="#" class="text-decoration-none" onclick="event.preventDefault();">
                                        <?=$navTitle?>
                                    </a>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-widget">
                    <h5>Contact Info</h5>
                    <ul>
                        <li><i class="bi bi-geo-alt me-2"></i><?=$configData['companyAddress']?></li>
                        <li><i class="bi bi-telephone me-2"></i><?=$configData['companyNumber']?></li>
                        <li><i class="bi bi-envelope me-2"></i><?=$configData['companyEmail']?></li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="row align-items-center">
            <?= $themeData['copyRight'] ?>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button -->
<button id="scrollToTop" class="btn btn-primary rounded-circle shadow scroll-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up fs-5"></i>
</button>

<!-- Preloader -->
<div id="preloader"></div>

    <!-- Bootstrap core JS -->
    <script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

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

    <!-- AOS Library JS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <script>
    AOS.init();
    </script>

    <!-- Core theme JS -->
    <script defer src="<?= minifyJS('public/front-end/themes/' . $theme . '/assets/js/script.js') ?>"></script>

    <!-- Custom JavaScript in the footer -->
    <?php if (!empty($themeData['customJSFooter'])): ?>
        <?= $themeData['customJSFooter'] ?>
    <?php endif; ?>

    <!-- Custom Footer Data -->
    <?= $this->include('front-end/themes/_shared/_custom_footer_data.php'); ?>
    
    <!-- Global modal for search -->
    <?=$this->include('front-end/themes/_shared/_global_search_modal.php'); ?>

    <!--Load Plugin Helpers-->
    <?=$this->include('front-end/themes/_shared/_load_plugin_helpers.php'); ?>

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
    <?= $this->include('front-end/layout/assets/sweet_alerts.php'); ?>
</body>
</html>