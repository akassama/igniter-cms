<?php
// Get current theme impact
$theme = getCurrentTheme();

//popup settings
$currentPage = "blogs";
$popUpWhereClause = ['status' => 1];
$showOnPages = getTableData('announcement_popups', $popUpWhereClause, 'show_on_pages');
$enablePopupAds = getConfigData("EnablePopupAds");

//update view count
updateTotalViewCount("blogs", "blog_id", $blog_data['blog_id']);
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
                <li class="breadcrumb-item"><a href="<?=base_url('/blogs')?>" class="text-decoration-none text-primary">Blogs</a></li>
                <li class="breadcrumb-item active text-secondary" aria-current="page">Blog Details</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Blog Page Content -->
<section id="blog-details" class="py-5">
    <div class="container">
        <div class="row">
            <!-- Main Blog Content -->
            <div class="col-lg-8">
                <article class="blog-post">
                    <h1 class="fw-bold"><?= $blog_data['title'] ?></h1>
                    <img src="<?= getImageUrl(($blog_data['featured_image']) ?? getDefaultImagePath())?>" alt="<?= $blog_data['title'] ?>" class="img-fluid rounded mb-4">
                    <div class="meta-info mb-3 text-muted">
                        <i class="bi bi-person-circle me-2"></i> <strong><?= getActivityBy(esc($blog_data['created_by'])); ?></strong> |
                        <i class="bi bi-calendar me-2"></i> <?= dateFormat($blog_data['created_at'], 'F j, Y'); ?> |
                        <?php $categoryName = !empty($blog_data['category']) ? getBlogCategoryName($blog_data['category']) : ""; ?>
                        <i class="bi bi-tags me-2"></i> <span class="badge bg-primary"><a href="<?= base_url('/search/filter/?type=category&key='.$categoryName) ?>" class="text-white"><?= $categoryName?></a></span>
                    </div>

                    <div class="row">
                        <?= $blog_data['content'] ?>
                    </div>

                    <h3>Tags:</h3>
                    <?php
                        $tags = $blog_data['tags'];
                        $tagsArray = explode(',', $tags);
                        
                        foreach ($tagsArray as $tag) {
                            $tag = htmlspecialchars(trim($tag));
                            echo '<span class="badge bg-secondary me-1"><a class="text-decoration-none text-white" href="'.base_url("/search/filter/?type=tag&key=$tag").'">' . $tag . '</a></span>';
                        }
                    ?>
                </article>

                <!-- Author Information -->
                <div class="author-info mt-5 p-4 bg-light rounded">
                    <div class="d-flex align-items-center">
                        <?php
                            $authorBio = getUserData($blog_data['created_by'], "about_summary");
                            $authorTwitterLink = getUserData($blog_data['created_by'], "twitter_link");
                            $authorFacebookLink= getUserData($blog_data['created_by'], "facebook_link");
                            $authorInstagramLink= getUserData($blog_data['created_by'], "instagram_link");
                            $authorLinkedinLink= getUserData($blog_data['created_by'], "linkedin_link");
                        ?>
                        <img src="<?=getImageUrl(getUserData($blog_data['created_by'], "profile_picture") ?? getDefaultProfileImagePath())?>" class="rounded-circle me-3" alt="Author">
                        <div>
                            <h4 class="mb-1"><?= getActivityBy(esc($blog_data['created_by'])); ?></h4>
                            <p class="text-muted mb-2">Tech Consultant & Writer</p>
                            <a href="<?=$authorTwitterLink?>" class="me-2"><i class="bi bi-twitter text-primary"></i></a>
                            <a href="<?=$authorLinkedinLink?>" class="me-2"><i class="bi bi-linkedin text-primary"></i></a>
                            <a href="<?=$authorFacebookLink?>" class="me-2"><i class="bi bi-facebook text-primary"></i></a>
                            <a href="<?=$authorInstagramLink?>" class="me-2"><i class="bi bi-instagram text-primary"></i></a>
                        </div>
                    </div>
                    <p class="mt-3"><?=$authorBio?></p>
                </div>

                <!-- Comments Section -->
                <div class="comments-section mt-5">
                    <!-- Include Comment Script -->
                </div>                
            </div>

            <!-- Sidebar -->
            <aside class="col-lg-4">
                <div class="search-box mb-4">
                    <form action="<?= base_url('search') ?>" method="get">
                        <label for="q" class="fw-bold text-dark">Search</label>
                        <div class="input-group">
                            <input class="form-control" type="text" id="q" name="q" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" minlength="2" required />
                            <button class="btn btn-primary" id="button-search" type="submit"><i class="ri-search-line"></i></button>
                        </div>
                    </form>
                </div>                

                <div class="categories mb-4">
                    <h4>Categories</h4>
                    <ul class="list-unstyled">
                         <?php if ($categories) : ?>
                            <?php
                                $totalCategories = count($categories);
                                $halfCategories = ceil($totalCategories / 2);
                                $firstHalf = array_slice($categories, 0, $halfCategories);
                                $secondHalf = array_slice($categories, $halfCategories);
                            ?>

                            <?php foreach ($categories as $category) : ?>
                                <?php $whereClause = "category = '" . $category['category_id'] . "'"; ?>
                                <li><a href="<?= base_url('/search/filter/?type=category&key='.$category['title']) ?>" class="text-dark text-decoration-none"><?= $category['title'] ?> <span>(<?= getTotalRecords('blogs', $whereClause) ?>)</span></a></li>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    </ul>
                </div>

                <div class="recent-posts mb-4">
                    <h4>Recent Posts</h4>
                    <?php if ($blogs): ?>
                        <?php foreach ($blogs as $blog): ?>
                            <?php 
                                // Fetch category name
                                $categoryName = !empty($blog['category']) ? getBlogCategoryName($blog['category']) : "Uncategorized"; 
                            ?>
                            <div class="recent-post d-flex mb-3">
                                <img src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>" class="rounded me-3" alt="<?= esc($blog['title']) ?>">
                                <div>
                                    <a href="<?= base_url('blog/'.$blog['slug']) ?>" class="text-dark text-decoration-none"><?= esc($blog['title']) ?></a>
                                    <p class="text-muted small"><?= dateFormat($blog['created_at'], 'M j, Y'); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted text-center">No recent posts available.</p>
                    <?php endif; ?>

                    
                </div>

                <div class="tags mb-4">
                    <h4>Tags</h4>
                    <?php
                        $tags = $blog_data['tags'];
                        $tagsArray = explode(',', $tags);
                        
                        foreach ($tagsArray as $tag) {
                            $tag = htmlspecialchars(trim($tag));
                            echo '<span class="badge bg-secondary me-1"><a class="text-decoration-none text-white" href="'.base_url("/search/filter/?type=tag&key=$tag").'">' . $tag . '</a></span>';
                        }
                    ?>
                </div>
            </aside>
        </div>
    </div>
</section>
<!-- End Blog Page Content -->

<?php
// Check if popups should be shown
if (strtolower($enablePopupAds) === "yes" && in_array($currentPage, explode(',', $showOnPages))) {
    ?>
        <!-- Advert Popup Section -->
        <?= $this->include('front-end/themes/_shared/_advert_popups.php'); ?>
    <?php
}
?>

<!-- end main content -->
<?= $this->endSection() ?>