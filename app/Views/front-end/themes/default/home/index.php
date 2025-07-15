<?php
// This is to get current impact
$theme = getCurrentTheme();

//get site config values
$siteName = getConfigData("SiteName");
$siteAddress = getConfigData("SiteAddress");
$siteEmail = getConfigData("SiteEmail");
$sitePhoneNumber = getConfigData("SitePhoneNumber");
$companyOpeningHours = getConfigData("CompanyOpeningHours");
$metaAuthor = getConfigData("MetaAuthor");
$metaTitle = getConfigData("MetaTitle");
$siteTitle = getConfigData("SiteTitle");
$metaKeywords = getConfigData("MetaKeywords");
$siteLogoLink = getConfigData("SiteLogoLink");
$siteLogoTwoLink = getConfigData("SiteLogoTwoLink");
$siteFaviconLink = getConfigData("SiteFaviconLink");
$siteFaviconManifestLink = getConfigData("SiteFaviconManifestLink");
$siteFaviconLink96 = getConfigData("SiteFaviconLink96");
$siteFaviconLinkAppleTouch = getConfigData("SiteFaviconLinkAppleTouch");

//page settings
$currentPage = "home";
$popUpWhereClause = ['status' => 1];
?>

<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
  <!-- ////// BEGIN Get Home Pages ///// -->

  <!-- ////// END Home Pages ///// -->


<!-- end main content -->
<?= $this->endSection() ?>


