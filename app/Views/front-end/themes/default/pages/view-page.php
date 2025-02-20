<?php
// Get current theme impact
$theme = getCurrentTheme();

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