<?php
// Get current theme impact
$theme = getCurrentTheme();

//popup settings
$currentPage = "blogs";
$popUpWhereClause = ['status' => 1];
$showOnPages = getTableData('announcement_popups', $popUpWhereClause, 'show_on_pages');
$enablePopupAds = getConfigData("EnablePopupAds");
$sectionTitle = getHomePageData("RecentPosts", "section_title");
$sectionDescription = getHomePageData("RecentPosts", "section_description");
?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
    <!-- Blog preview section-->
    <section class="py-5">
        <div class="container px-5">
            <!--Breadcrumb-->
            <div class="row mb-1">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                </ol>
                </nav>
            </div>

            <div class="text-center mb-5">
                <h1 class="fw-bolder"><?=$sectionTitle?></h1>
                <p class="lead fw-normal text-muted mb-0"><?=$sectionDescription?></p>
            </div>
            <div class="row gx-5">
                    <?php if($blogs): ?>
                        <?php foreach($blogs as $blog): ?>
                            <div class="col-lg-4 mb-5">
                                <div class="card h-100 shadow border-0">
                                    <img class="card-img-top" src="<?=getImageUrl($blog['featured_image'] ?? getDefaultImagePath())?>" alt="<?= $blog['title']; ?>" />
                                    <div class="card-body p-4">
                                        <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?= !empty($blog['category']) ? getBlogCategoryName($blog['category']) : "" ?></div>
                                        <a class="text-decoration-none link-dark stretched-link" href="<?= base_url('blog/'.$blog['slug']) ?>"><h5 class="card-title mb-3"><?= $blog['title']; ?></h5></a>
                                        <p class="card-text mb-0"><?= !empty($blog['excerpt']) ? getTextSummary($blog['excerpt']) : getTextSummary($blog['content']) ?></p>
                                    </div>
                                    <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                        <div class="d-flex align-items-end justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img class="rounded-circle me-3" src="<?=getImageUrl(getUserData($blog['created_by'], "profile_picture") ?? getDefaultProfileImagePath())?>" alt="<?= getActivityBy(esc($blog['created_by'])); ?>" height="45" />
                                                <div class="small">
                                                    <div class="fw-bold"><?= getActivityBy(esc($blog['created_by'])); ?></div>
                                                    <div class="text-muted"><?= dateFormat($blog['created_at'], 'M j, Y'); ?> &middot; <?=estimateReadTime($blog['content']) ?> min read</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- End post list item -->
                        <?php endforeach; ?>
                    <?php endif; ?>
            </div>
            <div class="text-start mb-5 mb-xl-0">
                <?php
                    if($total_blogs > intval(env('PAGINATE_LOW', 20))){
                        ?>
                            <!--Show pagination if more than 100 records-->
                            <div class="col-12 text-start">
                                <p>Pagination</p>
                                <?= $pager->links('default', 'bootstrap') ?>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </section>

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