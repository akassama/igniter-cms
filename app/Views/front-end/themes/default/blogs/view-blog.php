<?php
// Get current theme impact
$theme = getCurrentTheme();

//update view count
updateTotalViewCount("blogs", "blog_id", $blog_data['blog_id']);
?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<!-- Page Content-->
<section class="py-5">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-3">
                <div class="d-flex align-items-center mt-lg-5 mb-4">
                    <a href="<?= base_url('/search/filter/?type=author&key='.getUserData($blog_data['created_by'], "username"))?>">
                        <img src="<?=getImageUrl(getUserData($blog_data['created_by'], "profile_picture") ?? getDefaultProfileImagePath())?>" class="rounded-circle" alt="<?= $blog_data['title'] ?>" width="50" height="50"> 
                    </a>
                    <div class="ms-3">
                        <div class="fw-bold">
                            <a href="<?= base_url('/search/filter/?type=author&key='.getUserData($blog_data['created_by'], "username"))?>" class="text-dark text-decoration-none">
                                <?= getActivityBy(esc($blog_data['created_by'])); ?>
                            </a>
                        </div>
                        <div class="text-muted">
                            <?php
                                $tags = $blog_data['tags'];
                                $tagsArray = explode(', ', $tags);
                                
                                foreach ($tagsArray as $tag) {
                                    $tag = htmlspecialchars($tag);
                                    echo '<a class="badge bg-dark text-decoration-none text-white me-1" href="'.base_url("/search/filter/?type=tag&key=$tag").'">' . $tag . '</a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1"><?= $blog_data['title'] ?></h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2"><?= dateFormat($blog_data['created_at'], 'M j, Y'); ?></div>
                        <!-- Post categories-->
                        <?php $categoryName = !empty($blog_data['category']) ? getBlogCategoryName($blog_data['category']) : ""; ?>
                        <a class="badge bg-secondary text-decoration-none link-light" href="<?= base_url('/search/filter/?type=category&key='.$categoryName) ?>">
                            <?= $categoryName?>
                        </a>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded w-100" src="<?= getImageUrl(($blog_data['featured_image']) ?? getDefaultImagePath())?>" alt="..." /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <?= $blog_data['content'] ?>
                    </section>
                </article>
            </div>
        </div>
    </div>
</section>

<!-- end main content -->
<?= $this->endSection() ?>