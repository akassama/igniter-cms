<?php
// Get current theme impact
$theme = getCurrentTheme();

//get site config values
$baseUrl = base_url();
$currentUrl = current_url();
$maintenanceMode = getConfigData("MaintenanceMode");
$companyName = getConfigData("CompanyName");
$companyAddress = getConfigData("CompanyAddress");
$companyEmail = getConfigData("CompanyEmail");
$companyNumber = getConfigData("CompanyNumber");
$metaAuthor = getPageMetaInfo($currentUrl, "MetaAuthor");
$metaTitle = getPageMetaInfo($currentUrl, "MetaTitle");
$metaDescription = getPageMetaInfo($currentUrl, "MetaDescription");
$metaKeywords = getPageMetaInfo($currentUrl, "MetaKeywords");
$metaOgImage = getPageMetaInfo($currentUrl, "MetaOgImage");
$metaPageUrl =  getPageMetaInfo($currentUrl, "MetaPageUrl");
$siteLogoLink = getConfigData("SiteLogoLink");
$siteLogoTwoLink = getConfigData("SiteLogoTwoLink");
$siteFaviconLink = getConfigData("SiteFaviconLink");
$siteFaviconManifestLink = getConfigData("SiteFaviconManifestLink");
$siteFaviconLink96 = getConfigData("SiteFaviconLink96");
$siteFaviconLinkAppleTouch = getConfigData("SiteFaviconLinkAppleTouch");
$siteFacebookLink = getTableData('socials', ['name' => 'Facebook'], 'link');
$siteInstagramLink = getTableData('socials', ['name' => 'Instagram'], 'link');
$siteLinkedInLink = getTableData('socials', ['name' => 'LinkedIn'], 'link');
$siteTwitterLink = getTableData('socials', ['name' => 'Twitter'], 'link');

//get theme data
$customCSS = getTableData('codes', ['code_for' => 'CSS'], 'code');
$customJSTop = getTableData('codes', ['code_for' => 'HeaderJS'], 'code');
$customJSFooter = getTableData('codes', ['code_for' => 'FooterJS'], 'code');
$copyRight = getThemeData($theme, "footer_copyright");
$primaryThemeColor = getThemeData($theme, "primary_color");
$secondaryThemeColor = getThemeData($theme, "secondary_color");
$otherThemeColor = getThemeData($theme, "other_color");

//Get navigation and social model lists
$navigationsModel = new \App\Models\NavigationsModel();
$topNavLists = $navigationsModel->where('group', 'top_nav')->orderBy('order', 'ASC')->limit(intval(getConfigData("queryLimitDefault")))->findAll();
$footerNavLists = $navigationsModel->where('group', 'footer_nav')->orderBy('order', 'ASC')->limit(intval(getConfigData("queryLimitDefault")))->findAll();
$servicesNavLists = $navigationsModel->where('group', 'services')->orderBy('order', 'ASC')->limit(intval(getConfigData("queryLimitDefault")))->findAll();
$socialsModel = new \App\Models\SocialsModel();
$socialsLists = $socialsModel->orderBy('order', 'ASC')->limit(intval(getConfigData("queryLimitMedium")))->findAll();

//Maintenance mode data
if (strtolower($maintenanceMode) === "yes") {
    $maintenancePage = $this->include('front-end/themes/_shared/_maintenance_page.php');
    echo strval($maintenancePage); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Essential Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title and Description -->
    <title><?=$metaTitle?> - <?=$companyName?></title>
    <meta name="description" content="<?=$metaDescription?>">

    <!-- Keywords for SEO -->
    <meta name="keywords" content="<?=$metaKeywords?>">

    <!-- Author Information -->
    <meta name="author" content="<?=$metaAuthor?>">

    <!-- Open Graph (Facebook) -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?=$metaTitle?>">
    <meta property="og:description" content="<?=$metaDescription?>">
    <meta property="og:url" content="<?=$metaPageUrl?>">
    <meta property="og:image" content="<?=getImageUrl($metaOgImage ?? getDefaultImagePath())?>">
    <meta property="og:site_name" content="<?=$metaTitle?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?=$metaTitle?>">
    <meta name="twitter:description" content="<?=$metaDescription?>">
    <meta name="twitter:image" content="<?=getImageUrl($siteLogoLink ?? getDefaultImagePath())?>">
    <meta name="twitter:site" content="@<?=$metaAuthor?>">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?=$metaPageUrl?>">

    <!-- Robots and Indexing -->
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    <!-- Additional SEO Meta Tags -->
    <meta name="theme-color" content="<?=$primaryThemeColor?>">
    <meta name="msapplication-TileColor" content="<?=$secondaryThemeColor?>">

    <!-- Favicon and Icons -->
    <link rel="icon" href="<?=getImageUrl($siteFaviconLink ?? getDefaultImagePath())?>">
    <link rel="apple-touch-icon" href="<?=getImageUrl($siteFaviconLinkAppleTouch ?? getDefaultImagePath())?>">
    <link rel="manifest" href="<?= getLinkUrl($siteFaviconManifestLink)?>">

    <!-- Structured Data (JSON-LD) for Rich Snippets -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "<?=$metaAuthor?>",
        "url": "<?=$metaPageUrl?>",
        "sameAs": [
        "https://www.facebook.com/<?=$siteFacebookLink?>",
        "https://twitter.com/<?=$siteTwitterLink?>",
        "https://www.instagram.com/<?=$siteInstagramLink?>"
        ],
        "description": "<?=$metaDescription?>",
        "image": "<?=getImageUrl($siteLogoLink ?? getDefaultImagePath())?>"
    }
    </script>

    <theme-data>
        <!-- Remix icons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.min.css" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?= minifyCSS('public/front-end/themes/' . $theme . '/assets/css/styles.css') ?>" rel="stylesheet">
    </theme-data>

    <custom-head-data>
    <?php if(!empty($customCSS)): ?>
        <!-- Custom CSS -->
        <style>
            <?=$customCSS?>
        </style>
    <?php endif; ?>

    <!-- Custom Theme CSS -->
    <style>
        /*Primary*/
        .bg-dark {
            background-color: <?=$primaryThemeColor?> !important;
        }

        .bg-dark-subtle {
            background-color: <?=$primaryThemeColor?> !important;
        }

        /*Secondary*/
        .bg-primary {
            background-color: <?=$secondaryThemeColor?> !important;
        }

        .bg-primary-subtle {
            background-color: rgba(13, 110, 253, 0.1) !important;
        }

        .btn-primary {
            color: #ffffff;
            background-color: <?=$secondaryThemeColor?> !important;
            border-color: <?=$secondaryThemeColor?> !important;
        }

        .btn-outline-primary {
            color: <?=$secondaryThemeColor?> !important;
            border-color: <?=$secondaryThemeColor?> !important;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }

        .text-primary {
            color: <?=$secondaryThemeColor?> !important;
        }

        .border-primary {
            border-color: <?=$secondaryThemeColor?> !important;
        }

        .link-primary {
            color: <?=$secondaryThemeColor?>;
        }
        .link-primary:hover {
            color: #0a58ca;
        }

        .fw-bolder {
            font-weight: bolder !important;
            color: <?=$otherThemeColor?> !important;
        }

        .h3.fw-bolder {
            color: <?=$otherThemeColor?> !important;
        }
    </style>

    <?php if(!empty($customJSTop)): ?>
        <!-- Custom JavaScript in the head -->
        <?=$customJSTop?>
    <?php endif; ?>
    </custom-head-data>

    <config-head-data>
        <?= $this->include('front-end/themes/_shared/_custom_head_data.php'); ?>
    </config-head-data>
</head>
<body class="d-flex flex-column h-100">

<!--MAIN CONTENT-->
<main class="flex-shrink-0">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="<?=base_url('/')?>"><?=$companyName?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navigation Links -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if($topNavLists): ?>
                        <?php foreach($topNavLists as $navigation): ?>
                            <?php
                                $navigationId = $navigation['navigation_id'];
                                $navTitle = $navigation['title'];
                                $parent = $navigation['parent'];
                                $link = getLinkUrl($navigation['link']);
                                $newTab = $navigation['new_tab'];
                                $navTarget = $newTab === "1" ? "_blank" : "_self";
                                
                                // Find child navigations
                                $childNavigations = $navigationsModel->where('parent', $navigationId)
                                                                    ->orderBy('order', 'ASC')
                                                                    ->limit(intval(getConfigData("queryLimitDefault")))
                                                                    ->findAll();
                            ?>
                            
                            <?php if(empty($parent)): ?>
                                <?php if(empty($childNavigations)): ?>
                                    <!-- Link without children -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=$link?>" target="<?=$navTarget?>">
                                            <?=$navTitle?>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <!-- Link with dropdown -->
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-<?=$navigationId?>" 
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <?=$navTitle?>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" 
                                            aria-labelledby="dropdown-<?=$navigationId?>">
                                            <?php foreach($childNavigations as $childNav): ?>
                                                <li>
                                                    <a class="dropdown-item" 
                                                    href="<?=getLinkUrl($childNav['link'])?>" 
                                                    target="<?=$childNav['new_tab'] === "1" ? "_blank" : "_self"?>">
                                                        <?=$childNav['title']?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>

                <div class="d-none d-md-block d-lg-none d-xl-block">
                    <!--Disable on md screens for better rendering-->
                    <form action="<?= base_url('search') ?>" method="get" class="d-flex ms-xl-3 mt-3 mt-xl-0" role="search">
                        <input class="form-control me-2" type="search" id="q" name="q" placeholder="Search for..." aria-label="Search for..." min="2" required>
                    </form>
                </div>
                
                <div id="google_translate_element"></div>
            </div>
        </div>
    </nav>

    <div class="row">
        <?= $this->renderSection('content') ?>
    </div>

</main>
<!--MAIN CONTENT END-->
    <!-- Footer-->
    <footer class="bg-dark py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0 text-white">
                        <?=$copyRight?>
                    </div>
                </div>

                <div class="col-auto">
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
                                <a class="link-light small" href="<?=$link?>" target="<?=$navTarget?>">
                                    <?=$navTitle?>
                                </a>
                                <span class="text-white mx-1">&middot;</span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    
                    <a class="link-light small" href="<?=site_url('sign-in')?>" target="_blank">
                        Sign-In
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS-->
    <script src="<?= minifyJS('public/front-end/themes/' . $theme . '/assets/js/scripts.js') ?>"></script>

    <custom-footer-data>
        <?php if(!empty($customJSFooter)): ?>
            <!-- Custom JavaScript in the footer -->
            <?=$customJSFooter?>
        <?php endif; ?>
    </custom-footer-data>

    <config-footer-data>
        <?= $this->include('front-end/themes/_shared/_custom_footer_data.php'); ?>
    </config-footer-data>

  <!-- SweetAlert JS -->
  <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Include sweet_alerts-->
  <?= $this->include('front-end/layout/assets/sweet_alerts.php'); ?>
</body>
</html>
