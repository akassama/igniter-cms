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

    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light mt-md-3 mt-sm-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>" class="text-decoration-none text-primary">Home</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page"><?= $page_data['title'] ?></li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Page Content -->
    <section class="page py-5">
        <div class="container">
            <div class="row">
                <?= $page_data['content'] ?>
            </div>
        </div>
    </section>
    <!-- End Page Content -->

<!-- end main content -->
<?= $this->endSection() ?>