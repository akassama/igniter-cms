<?php
// Get current theme impact
$theme = getCurrentTheme();

//update view count
updateTotalViewCount("events", "event_id", $event_data['event_id']);
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
                <!-- Event content-->
                <article>
                    <!-- Event header-->
                    <header class="mb-4">
                        <!-- Event title-->
                        <h1 class="fw-bolder mb-1"><?= $event_data['title'] ?></h1>
                        <!-- Event meta content-->
                        <div class="text-muted fst-italic mb-2">
                            Start Date: <?= dateFormat($event_data['start_date'], 'M j, Y'); ?> <br>
                            End Date: <?= dateFormat($event_data['end_date'], 'M j, Y'); ?>
                        </div>
                        <!-- Event Location-->
                        <a class="badge bg-secondary text-decoration-none link-light" href="#!">
                            Location: <?= $event_data['location'] ?>
                        </a>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-2"><img class="img-fluid rounded w-100" src="<?= getImageUrl(($event_data['image']) ?? getDefaultImagePath())?>" alt="..." /></figure>
                    <!-- Event content-->
                    <section class="mb-2">
                        <?= $event_data['content'] ?>
                    </section>
                </article>
                <div class="row"> 
                    <div class="col-12">
                        <div class="d-flex align-items-center mt-lg-5 mb-4">
                            <a href="<?= base_url('/search/filter/?type=author&key='.getUserData($event_data['created_by'], "username"))?>">
                                <img src="<?=getImageUrl(getUserData($event_data['created_by'], "profile_picture") ?? getDefaultProfileImagePath())?>" class="rounded-circle" alt="<?= $event_data['title'] ?>" width="50" height="50"> 
                            </a>
                            <div class="ms-3">
                                <div class="fw-bold">
                                    <a href="<?= base_url('/search/filter/?type=author&key='.getUserData($event_data['created_by'], "username"))?>" class="text-dark text-decoration-none">
                                        <?= getActivityBy(esc($event_data['created_by'])); ?>
                                    </a>
                                </div>
                                <div class="text-muted">
                                    <?= dateFormat($event_data['created_at'], 'M j, Y'); ?>
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