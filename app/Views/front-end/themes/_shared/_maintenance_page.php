<?php
//get site config values
$baseUrl = base_url();
$currentUrl = current_url();
$maintenanceMode = getConfigData("MaintenanceMode");
$maintenanceModeTitle = getConfigData("MaintenanceModeTitle");
$maintenanceModeText = getConfigData("MaintenanceModeText");
$companyName = getConfigData("CompanyName");
$companyAddress = getConfigData("CompanyAddress");
$companyEmail = getConfigData("CompanyEmail");
$companyNumber = getConfigData("CompanyNumber");
$companyOpeningHours = getConfigData("CompanyOpeningHours");
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

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?=$metaDescription?>">
        <meta name="keywords" content="<?=$metaKeywords?>">
        <meta name="author" content="<?=$metaAuthor?>">
        <title><?=$maintenanceModeTitle?></title>
        <link rel="icon" href="<?=getImageUrl($siteFaviconLink ?? getDefaultImagePath())?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: #f8f9fa;
                margin: 0;
            }
            .maintenance-container {
                text-align: center;
            }
            .maintenance-icon {
                font-size: 5rem;
                color: #0d6efd;
            }
            .maintenance-text {
                font-size: 1.5rem;
                color: #6c757d;
            }
        </style>
    </head>
    <body>
        <div class="maintenance-container">
            <div class="maintenance-icon">
                <i class="ri-tools-line"></i>
            </div>
            <h1 class="mt-3 text-primary"><?=$maintenanceModeTitle?></h1>
            <p class="maintenance-text">
                <?=$maintenanceModeText?>
            </p>
        </div>
        <script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script async src="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.js"></script>
    </body>
</html>