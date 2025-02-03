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
    <div class="container px-5 my-2">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder"><?= $portfolio_data['title'] ?></h1>
                    <p class="lead fw-normal text-muted mb-0">
                        <?= $portfolio_data['description'] ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="row gx-5">
            <div class="col-12">
                <div class="row mb-2">
                    <div class="col-lg-4">
                        <div class="bg-light rounded-3 p-4 h-100">
                            <h5 class="fw-bolder">Project Information</h5>
                            <ul class="list-unstyled mb-0">
                                <li><strong>Category:</strong> <?= $portfolio_data['category'] ?></li>
                                <li><strong>Client:</strong> <?= $portfolio_data['client'] ?></li>
                                <?php if(!empty($portfolio_data['project_date'])): ?>
                                <li><strong>Project date</strong> <?= dateFormat($portfolio_data['project_date'], 'M j, Y'); ?></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <img class="img-fluid rounded-3" src="<?=getImageUrl(($portfolio_data['featured_image']) ?? getDefaultImagePath())?>?>" alt="..." />
                    </div>
                </div>
            </div>
            <?php if(!empty($portfolio_data['details_image_1'])): ?>
              <div class="col-lg-6">
                <img src="<?=getImageUrl(($portfolio_data['details_image_1']) ?? getDefaultImagePath())?>?>" alt="" class="img-fluid rounded-3 mb-5">
              </div>
            <?php endif; ?>
            <?php if(!empty($portfolio_data['details_image_2'])): ?>
              <div class="col-lg-6">
                <img src="<?=getImageUrl(($portfolio_data['details_image_2']) ?? getDefaultImagePath())?>?>" alt="" class="img-fluid rounded-3 mb-5">
              </div>
            <?php endif; ?>
            <?php if(!empty($portfolio_data['details_image_3'])): ?>
              <div class="col-lg-6">
                <img src="<?=getImageUrl(($portfolio_data['details_image_3']) ?? getDefaultImagePath())?>?>" alt="" class="img-fluid rounded-3 mb-5">
              </div>
            <?php endif; ?>
            <?php if(!empty($portfolio_data['details_image_4'])): ?>
              <div class="col-lg-6">
                <img src="<?=getImageUrl(($portfolio_data['details_image_4']) ?? getDefaultImagePath())?>?>" alt="" class="img-fluid rounded-3 mb-5">
              </div>
            <?php endif; ?>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mb-5">
                    <div class="row">
                    <?= $portfolio_data['content'] ?>
                    </div>
                    <?php if(!empty($portfolio_data['project_url'])): ?>
                        <a class="text-decoration-none" href="<?= $portfolio_data['project_url']?>">
                            View project
                            <i class="bi-arrow-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end main content -->
<?= $this->endSection() ?>