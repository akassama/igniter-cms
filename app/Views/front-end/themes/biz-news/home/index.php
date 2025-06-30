<?php
// This is to get current impact
$theme = getCurrentTheme();

//get site config values
$companyName = getConfigData("CompanyName");
$companyAddress = getConfigData("CompanyAddress");
$companyEmail = getConfigData("CompanyEmail");
$companyNumber = getConfigData("CompanyNumber");
$companyOpeningHours = getConfigData("CompanyOpeningHours");
$metaAuthor = getConfigData("MetaAuthor");
$metaTitle = getConfigData("MetaTitle");
$metaDescription = getConfigData("MetaDescription");
$metaKeywords = getConfigData("MetaKeywords");
$siteLogoLink = getConfigData("SiteLogoLink");
$siteLogoTwoLink = getConfigData("SiteLogoTwoLink");
$siteFaviconLink = getConfigData("SiteFaviconLink");
$siteFaviconManifestLink = getConfigData("SiteFaviconManifestLink");
$siteFaviconLink96 = getConfigData("SiteFaviconLink96");
$siteFaviconLinkAppleTouch = getConfigData("SiteFaviconLinkAppleTouch");

//popup settings
$currentPage = "home";
$popUpWhereClause = ['status' => 1];
$showOnPages = getTableData('announcement_popups', $popUpWhereClause, 'show_on_pages');
$enablePopupAds = getConfigData("EnablePopupAds");

?>

<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
  <!-- ////// BEGIN Get Page Content ///// -->
    <!-- Hero Section with Latest News -->
    <?php
        //Get latest news data
        $latestPostId = getLastPostId();
        $latestPostWhereClause = ['blog_id' => $latestPostId];
        $latestPostTitle = getTableData('blogs', $latestPostWhereClause, 'title');
        $latestPostImage = getTableData('blogs', $latestPostWhereClause, 'featured_image');
        $latestPostImageLink = getImageUrl($latestPostImage ?? getDefaultImagePath());
        $latestPostExcerpt = getTableData('blogs', $latestPostWhereClause, 'excerpt');
        $latestPostContent = getTableData('blogs', $latestPostWhereClause, 'content');
        $latestPostSlug = getTableData('blogs', $latestPostWhereClause, 'slug');
    ?>
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?=$latestPostImageLink?>') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 5rem 0;
            margin-bottom: 2rem;
            border-radius: 0.5rem;
        }
    </style>
    <section class="hero-section mb-5">
        <div class="container text-center">
            <span class="badge bg-danger mb-3">LATEST NEWS</span>
            <h1 class="display-5 fw-bold"><?=$latestPostTitle?></h1>
            <p class="lead"><?= !empty($latestPostExcerpt) ? getTextSummary($latestPostExcerpt) : getTextSummary($latestPostContent) ?></p>
            <a href="<?= base_url('blog/'.$latestPostSlug) ?>" class="btn btn-primary btn-lg mt-3">Read More</a>
        </div>
    </section>

    <!-- Trending News Carousel -->
    <section class="mb-5">
        <h2 class="h4 mb-3 d-flex align-items-center">
            <span class="badge bg-primary me-2">Trending</span>
            <span>Today's Top Stories</span>
        </h2>
        <div id="trendingCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded-3">
                <?php $trendingPosts = getRecentTrendingPostIds(1, 3); ?>
                <?php foreach ($trendingPosts as $index => $postId): ?>
                    <?php
                        $trendingPostWhereClause = ['blog_id' => $postId];
                        $trendingPostTitle = getTableData('blogs', $trendingPostWhereClause, 'title');
                        $trendingPostImage = getTableData('blogs', $trendingPostWhereClause, 'featured_image');
                        $trendingPostExcerpt = getTableData('blogs', $trendingPostWhereClause, 'excerpt');
                        $trendingPostContent = getTableData('blogs', $trendingPostWhereClause, 'content');
                        $trendingPostSlug = getTableData('blogs', $trendingPostWhereClause, 'slug');
                        $trendingCategory = getTableData('blogs', $trendingPostWhereClause, 'category');
                        $trendingCategoryName = !empty($post['category']) ? getBlogCategoryName($trendingCategory) : 'General';
                        $trendingCreatedBy = getTableData('blogs', $trendingPostWhereClause, 'created_by');
                        $trendingCreatedAt = getTableData('blogs', $trendingPostWhereClause, 'created_at');
                    ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <img src="<?= getImageUrl($trendingPostImage ?? getDefaultImagePath()) ?>" class="d-block w-100" alt="<?= esc($trendingPostTitle) ?>" loading="lazy">
                            </div>
                            <div class="col-md-6 bg-body p-4 d-flex flex-column">
                                <div>
                                    <span class="badge bg-info mb-2"><?= $trendingCategoryName ?></span>
                                    <h3><?= esc($trendingPostTitle) ?></h3>
                                    <p><?= !empty($trendingPostExcerpt) ? esc($trendingPostExcerpt) : getTextSummary($trendingPostContent) ?></p>
                                    <a href="<?= base_url('blog/'.$trendingPostSlug) ?>" class="btn btn-outline-primary">Read Story</a>
                                </div>
                                <div class="mt-auto pt-3 text-muted small">
                                    <i class="bi bi-clock"></i> <?= timeAgo($trendingCreatedAt) ?> | 
                                    <i class="bi bi-person"></i> <?= getActivityBy($trendingCreatedBy) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#trendingCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#trendingCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <div class="row">
        <!-- Main Content Area -->
        <div class="col-lg-8">
            <?php
                //set categories to list
                $selectedCategoryNewsList = array("AI", "Technology & Innovation", "Business & Career");
                $selectedCategoryNewsTotal = 2;
                foreach ($selectedCategoryNewsList as $selectedCategory) {
                    ?>
                    <!-- <?=$selectedCategory?> Section -->
                    <section class="mb-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="h4"><?=$selectedCategory?></h2>
                            <a href="<?= base_url('/search?q=').$selectedCategory ?>" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="row">
                            <?php $techPosts = getRecentPostByCategoryName($selectedCategory, $selectedCategoryNewsTotal); ?>
                            <?php foreach ($techPosts as $post): ?>
                                <div class="col-md-6">
                                    <div class="card news-card h-100">
                                        <span class="category-badge badge bg-info">Tech</span>
                                        <img src="<?= getImageUrl($post['featured_image'] ?? getDefaultImagePath()) ?>" class="card-img-top" alt="<?= esc($post['title']) ?>" loading="lazy">
                                        <div class="card-body">
                                            <h3 class="h5 card-title"><?= esc($post['title']) ?></h3>
                                            <p class="card-text"><?= !empty($post['excerpt']) ? esc($post['excerpt']) : getTextSummary($post['content']) ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted"><i class="bi bi-clock"></i> <?= timeAgo($post['created_at']) ?></small>
                                                <a href="<?= base_url('blog/'.$post['slug']) ?>" class="btn btn-sm btn-outline-primary">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </section>
                    <?php
                }
            ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Newsletter Subscription -->
            <div class="sidebar-widget">
                <h3 class="h5 mb-3">Stay Updated</h3>
                <p>Subscribe to our newsletter for daily news updates delivered to your inbox.</p>
                <form>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Your email address" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Subscribe</button>
                </form>
            </div>

            <!-- Trending Topics -->
            <div class="sidebar-widget">
                <h3 class="h5 mb-3">Trending Topics</h3>
                <div class="list-group trending-list">
                        <?php 
                            $trendingCategories = getRecentTrendingPostCategoriesIds(5); 
                            foreach ($trendingCategories as $cat) {
                                $trendingCategoryName = !empty($cat['category_id']) ? getBlogCategoryName($cat['category_id']) : 'General';

                                if ($cat['total_views'] < 1000) {
                                    $viewsDisplay = number_format($cat['total_views']);
                                } else {
                                    $viewsDisplay = rtrim(rtrim(number_format($cat['total_views'] / 1000, 1), '0'), '.') . 'K';
                                }
                        ?>
                        <a href="<?= base_url('/search/filter/?type=category&key='.$trendingCategoryName) ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><?= esc($trendingCategoryName) ?></span>
                            <span class="badge bg-primary rounded-pill"><?= $viewsDisplay ?></span>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <!-- Latest News -->
            <div class="sidebar-widget">
                <h3 class="h5 mb-3">Latest Updates</h3>
                <div class="list-group">
                    <?php $latestPosts = getRecentTrendingPostIds(5); ?>
                    <?php foreach ($latestPosts as $post): ?>
                        <?php
                            $latestUpdatesPostId = $post['blog_id'];
                            $latestUpdatesPostWhereClause = ['blog_id' => $latestUpdatesPostId];
                            $latestUpdatesPostTitle = getTableData('blogs', $latestUpdatesPostWhereClause, 'title');
                            $latestUpdatesPostImage = getTableData('blogs', $latestUpdatesPostWhereClause, 'featured_image');
                            $latestUpdatesPostExcerpt = getTableData('blogs', $latestUpdatesPostWhereClause, 'excerpt');
                            $latestUpdatesPostContent = getTableData('blogs', $latestUpdatesPostWhereClause, 'content');
                            $latestUpdatesPostSlug = getTableData('blogs', $latestUpdatesPostWhereClause, 'slug');
                            $latestUpdatesCategory = getTableData('blogs', $latestUpdatesPostWhereClause, 'category');
                            $latestUpdatesCategoryName = !empty($post['category']) ? getBlogCategoryName($latestUpdatesCategory) : 'General';
                            $latestUpdatesCreatedBy = getTableData('blogs', $latestUpdatesPostWhereClause, 'created_by');
                            $latestUpdatesCreatedAt = getTableData('blogs', $latestUpdatesPostWhereClause, 'created_at');
                        ?>
                        <a href="<?= base_url('blog/'.$latestUpdatesPostSlug) ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?= esc($latestUpdatesPostTitle) ?></h5>
                                <small><?= timeAgo($latestUpdatesCreatedAt) ?></small>
                            </div>
                            <p class="mb-1"><?= !empty($latestUpdatesPostExcerpt) ? esc($latestUpdatesPostExcerpt) : getTextSummary($latestUpdatesPostContent) ?></p>
                            <small class="text-muted"><?= !empty($latestUpdatesCategoryName) ? getBlogCategoryName($latestUpdatesCategoryName) : 'General' ?></small>
                        </a>
                    <?php endforeach ?>
                </div>
            </div>
            
        </div>

        <div class="col-12 d-flex justify-content-center">
            <a href="<?= base_url('blogs') ?>" class="btn btn-outline-primary btn-lg mt-3">View All Posts</a>
        </div>
    </div>

  <!-- ////// END Home Page Content ///// -->

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