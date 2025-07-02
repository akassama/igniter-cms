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

    <!-- Remix icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.min.css" />

    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

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

    <!-- Custom JavaScript in the head -->
    <?php if (!empty($themeData['customJSTop'])): ?>
        <?= $themeData['customJSTop'] ?>
    <?php endif; ?>

    <!-- Custom Head Data -->
    <?= $this->include('front-end/themes/_shared/_custom_head_data.php'); ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="<?= base_url('/')?>">
                <img src="<?=getImageUrl($configData['siteLogoTwoLink'] ?? getDefaultImagePath())?>" alt="<?=$configData['companyName']?> Logo" class="border border-dark rounded" height="45">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if ($topNavLists): ?>
                        <?php foreach ($topNavLists as $navigation): ?>
                            <?= themef_renderNavigation($navigation, $navigationsModel) ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <form action="<?= base_url('search') ?>" method="get" class="d-flex ms-xl-3 mt-3 mt-xl-0" role="search">
                    <input class="form-control me-2" type="search" id="q" name="q" placeholder="Search for..." aria-label="Search for..." minlength="2" required>
                </form>
                <div id="google_translate_element"></div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-shrink-0">
        <div class="row">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0 text-white"><?= $themeData['copyRight'] ?></div>
                </div>
                <div class="col-auto">
                    <?php if ($footerNavLists): ?>
                        <?php foreach ($footerNavLists as $navigation): ?>
                            <?php if (empty($navigation['parent'])): ?>
                                <a class="link-light small text-decoration-none" href="<?= getLinkUrl($navigation['link']) ?>" target="<?= $navigation['new_tab'] === "1" ? "_blank" : "_self" ?>">
                                    <?= $navigation['title'] ?>
                                </a>
                                <span class="text-white mx-1">&middot;</span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <a class="link-light small text-decoration-none" href="<?= site_url('sign-in') ?>" target="_blank">Sign-In</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <div class="scroll-to-top">
        <i class="ri-arrow-up-line"></i> 
    </div>

    <!-- Bootstrap core JS -->
    <script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

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