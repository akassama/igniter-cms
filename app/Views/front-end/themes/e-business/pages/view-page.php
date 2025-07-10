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

<!-- Page Content-->
<section class="py-3">
    <div class="container px-5 my-2">
        <!--Breadcrumb-->
        <div class="row mb-1">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $page_data['title'] ?></li>
            </ol>
            </nav>
        </div>
        <div class="row gx-5">
            <div class="col-12">
                <!-- Page content-->
                <article>
                    <!-- Post content-->
                    <section class="mb-2">
                        <?= $page_data['content'] ?>
                    </section>
                </article>
            </div>
        </div>
    </div>
</section>


<!-- end main content -->
<?= $this->endSection() ?>