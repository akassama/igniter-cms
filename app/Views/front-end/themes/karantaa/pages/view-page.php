<?php
// Get current theme impact
$theme = getCurrentTheme();

//page settings
$currentPage = "pages";
$popUpWhereClause = ["status" => 1];

//update view count
updateTotalViewCount("pages", "page_id", $page_data["page_id"]);
?>
<!-- include theme layout -->
<?= $this->extend("front-end/themes/" . $theme . "/layout/_layout") ?>

<!-- begin main content -->
<?= $this->section("content") ?>

    <!-- Breadcrumb -->
    <section class="page-hero">
        <div class="container">
            <div class="crumb mb-2">
                <a href="<?= base_url() ?>">Home</a> &nbsp;/&nbsp; <?= $page_data["title"] ?>
            </div>
            <h1><?= $page_data["title"] ?></h1>
            <?php if (!empty($page_data["description"])): ?>
                <p class="text-muted-k mb-0" style="max-width: 680px">
                    Get in touch with Karantaa for research collaborations, advisory services, or general enquiries.
                </p>
            <?php endif;?>
        </div>
    </section>

    <!-- Page Content -->
    <?= $page_data["content"] ?>
    <!-- End Page Content -->

<!-- end main content -->
<?= $this->endSection() ?>
