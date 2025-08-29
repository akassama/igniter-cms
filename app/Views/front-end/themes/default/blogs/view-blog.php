<?php
// Get current theme impact
$theme = getCurrentTheme();

//page settings
$currentPage = "blogs";
$popUpWhereClause = ['status' => 1];

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
        
        <!--Breadcrumb-->
        <div class="row mb-1">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url('/blogs')?>">Blogs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
            </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">
                            <?= $blog_data['title'] ?>
                        </h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">
                            Posted on <?= dateFormat($blog_data['created_at'], 'F j, Y'); ?> by 
                            <a href="<?= base_url('/search/filter/?type=author&key='.getUserData($blog_data['created_by'], "username"))?>" class="text-dark text-decoration-none">
                            <img loading="lazy" src="<?=getImageUrl(getUserData($blog_data['created_by'], "profile_picture") ?? getDefaultProfileImagePath())?>" class="rounded-circle" alt="<?= $blog_data['title'] ?>" width="22" height="22">
                                <?= getActivityBy(esc($blog_data['created_by'])); ?>
                            </a>
                        </div>
                        <!-- Post categories-->
                        <?php $categoryName = !empty($blog_data['category']) ? getBlogCategoryName($blog_data['category']) : ""; ?>
                        <a class="badge bg-secondary text-decoration-none link-light" href="<?= base_url('/search/filter/?type=category&key='.$categoryName) ?>">
                            <?= $categoryName?>
                        </a>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4">
                        <img class="img-fluid rounded w-100" src="<?= getImageUrl(($blog_data['featured_image']) ?? getDefaultImagePath())?>" alt="<?= $blog_data['title'] ?>" />
                    </figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <?= $blog_data['content'] ?>
                    </section>
                </article>
                <!-- Comments section-->
                <section class="mb-5">
                    <!-- Include Comment Script -->
                </section>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <form action="<?= base_url('search') ?>" method="get">
                            <div class="input-group">
                                <input class="form-control" type="text" id="q" name="q" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" minlength="2" required />
                                <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <?php if ($categories) : ?>
                                <?php
                                    $totalCategories = count($categories);
                                    $halfCategories = ceil($totalCategories / 2);
                                    $firstHalf = array_slice($categories, 0, $halfCategories);
                                    $secondHalf = array_slice($categories, $halfCategories);
                                ?>

                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <?php foreach ($firstHalf as $category) : ?>
                                            <?php $whereClause = "category = '" . $category['category_id'] . "'"; ?>
                                            <li><a href="<?= base_url('/search/filter/?type=category&key='.$category['title']) ?>"><?= $category['title'] ?> <span>(<?= getTotalRecords('blogs', $whereClause) ?>)</span></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <?php foreach ($secondHalf as $category) : ?>
                                            <?php $whereClause = "category = '" . $category['category_id'] . "'"; ?>
                                            <li><a href="<?= base_url('/search/filter/?type=category&key='.$category['title']) ?>"><?= $category['title'] ?> <span>(<?= getTotalRecords('blogs', $whereClause) ?>)</span></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Side Tags-->
                <div class="card mb-4">
                    <div class="card-header">Tags</div>
                    <div class="card-body">
                        <div class="text-muted">
                            <?php
                                $tags = $blog_data['tags'];
                                $tagsArray = explode(',', $tags);
                                
                                foreach ($tagsArray as $tag) {
                                    $tag = htmlspecialchars(trim($tag));
                                    echo '<a class="badge bg-dark text-decoration-none text-white me-1 mb-1" href="'.base_url("/search/filter/?type=tag&key=$tag").'">' . $tag . '</a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Recent Posts -->
                <div class="card mb-4">
                    <div class="card-header">Recent Posts</div>
                    <div class="card-body">
                        <?php if ($blogs): ?>
                            <?php foreach ($blogs as $blog): ?>
                                <?php 
                                    // Fetch category name
                                    $categoryName = !empty($blog['category']) ? getBlogCategoryName($blog['category']) : "Uncategorized"; 
                                ?>
                                <div class="d-flex mb-3">
                                    <!-- Post Image -->
                                    <div class="flex-shrink-0">
                                        <img src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>" 
                                            alt="<?= esc($blog['title']) ?>" 
                                            class="rounded" 
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                    </div>
                                    <div class="ms-3">
                                        <!-- Post Title -->
                                        <h6 class="mb-1">
                                            <a href="<?= base_url('blog/'.$blog['slug']) ?>" class="text-dark text-decoration-none">
                                                <?= esc($blog['title']) ?>
                                            </a>
                                        </h6>
                                        <!-- Meta Info -->
                                        <small class="text-muted">
                                            <?= dateFormat($blog['created_at'], 'M j, Y'); ?> 
                                            | <?= esc($categoryName) ?>
                                        </small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted text-center">No recent posts available.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- end main content -->
<?= $this->endSection() ?>