<?php
// Get current theme impact
$theme = getCurrentTheme();

//page settings
$currentPage = "pages";
$popUpWhereClause = ['status' => 1];

//update view count
updateTotalViewCount("pages", "page_id", $page_data['page_id']);
?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
<!-- Page Title -->
<div class="page-title dark-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-1 mb-lg-0">
            <a class="navbar-brand" href="<?= base_url('/')?>">
                <img src="<?=getImageUrl(getConfigData("SiteLogoLink") ?? getDefaultImagePath())?>" alt="<?=getConfigData("SiteLogoLink")?> Logo" class="border border-dark rounded" height="60">
            </a>
        </h1>
        <nav class="breadcrumbs">
        <ol>
            <li><a href="<?=base_url()?>">Home</a></li>
            <li class="current"><?= $page_data['title'] ?></li>
        </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->

<!-- Starter Section Section -->
<section id="starter-section" class="starter-section section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2><?= $page_data['title'] ?></h2>
    </div>
    <!-- End Section Title -->

    <div class="container" data-aos="fade-up">
        <?= $page_data['content'] ?>
    </div>
</section>
<!-- /Starter Section Section -->

<!-- end main content -->
<?= $this->endSection() ?>