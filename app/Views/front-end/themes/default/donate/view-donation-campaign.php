<?php
// Get current theme impact
$theme = getCurrentTheme();

?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<!-- Page Content-->
<section class="py-5">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-12">
                <!-- Donation content-->
                <article>
                    <!-- Donation header-->
                    <header class="mb-4">
                        <!-- Donation title-->
                        <h1 class="fw-bolder mb-1"><?= $donation_cause_data['title'] ?></h1>
                        <!-- Donation meta content-->
                        <div class="text-muted fst-italic mb-2">
                            Post Date: <?= dateFormat($donation_cause_data['created_at'], 'M j, Y'); ?>
                        </div>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-2"><img class="img-fluid rounded w-100" src="<?= getImageUrl(($donation_cause_data['image']) ?? getDefaultImagePath())?>" alt="..." /></figure>
                    <!-- Donation content-->
                    <section class="mb-2">
                        <?= $donation_cause_data['content'] ?>
                    </section>
                    <?
                        if(!empty($donation_cause_data['embedded_page']))
                        {?>
                            <div class="row mb-2 justify-content-centerd-flex align-items-center justify-content-center">
                                <div class="col-12">
                                    <h3>
                                        <?= $donation_cause_data['embedded_page_title'] ?>
                                    </h3>
                                </div>
                                <div class="col-12">
                                    <?= $donation_cause_data['embedded_page'] ?>
                                </div>
                            </div>
                        <?}
                    ?>
                    <?
                        if(!empty($donation_cause_data['link']))
                        {?>
                            <div class="row mb-2 justify-content-centerd-flex align-items-center justify-content-center">
                                <div class="col-sm-12 col-md-6">
                                    <div class="d-grid">
                                        <a href="<?= $donation_cause_data['link'] ?>" 
                                            class="btn btn-block btn-primary" target="<?= $donation_cause_data['new_tab'] == "1" ? "_blank" : "_self" ?>">
                                            <?= $donation_cause_data['link_title'] ?? "Go to link..." ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?}
                    ?>
                </article>
                <div class="row"> 
                    <div class="col-12">
                        <div class="d-flex align-items-center mt-lg-5 mb-4">
                            <a href="<?= base_url('/search/filter/?type=author&key='.getUserData($donation_cause_data['created_by'], "username"))?>">
                                <img src="<?=getImageUrl(getUserData($donation_cause_data['created_by'], "profile_picture") ?? getDefaultProfileImagePath())?>" class="rounded-circle" alt="<?= $donation_cause_data['title'] ?>" width="50" height="50"> 
                            </a>
                            <div class="ms-3">
                                <div class="fw-bold">
                                    <a href="<?= base_url('/search/filter/?type=author&key='.getUserData($donation_cause_data['created_by'], "username"))?>" class="text-dark text-decoration-none">
                                        <?= getActivityBy(esc($donation_cause_data['created_by'])); ?>
                                    </a>
                                </div>
                                <div class="text-muted">
                                    <?= dateFormat($donation_cause_data['created_at'], 'M j, Y'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end main content -->
<?= $this->endSection() ?>