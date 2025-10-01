<?php
// Get current theme impact
$theme = getCurrentTheme();
?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<!-- Page Content -->
<section class="page py-5">
    <div class="container py-5">
        <!--Breadcrumb-->
        <div class="row mb-1">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item active text-secondary" aria-current="page">Search Results</li>
            </ol>
            </nav>
        </div>

        <?= renderFilterSearchResults($searchQuery, $blogsSearchResults, $pagesSearchResults, $type ?? '') ?>
    </div>
</section>

<!-- end main content -->
<?= $this->endSection() ?>