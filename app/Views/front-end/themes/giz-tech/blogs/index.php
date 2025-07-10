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
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light mt-md-3 mt-sm-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>" class="text-decoration-none text-primary">Home</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">Blogs</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Blogs Page Content -->
    <section class="page py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3"><?=$sectionTitle?></h2>
                    <p class="lead"><?=$sectionDescription?></p>
                </div>
            </div>
            <div class="row g-4">
                <?php if($blogs): ?>
                    <?php foreach($blogs as $blog): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100">
                                <a href="<?= base_url('blog/'.$blog['slug']) ?>">
                                    <img src="<?=getImageUrl($blog['featured_image'] ?? getDefaultImagePath())?>" alt="<?= $blog['title']; ?>" class="card-img-top">
                                </a>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="badge bg-primary me-2">
                                            <?= !empty($blog['category']) ? getBlogCategoryName($blog['category']) : "" ?>
                                        </span>
                                        <small class="text-muted"><?= dateFormat($blog['created_at'], 'M j, Y'); ?></small>
                                    </div>
                                    <h5 class="fw-bold"><?= $blog['title']; ?></h5>
                                    <p class="mb-3"><?= !empty($blog['excerpt']) ? getTextSummary($blog['excerpt']) : getTextSummary($blog['content']) ?></p>
                                    <a href="<?= base_url('blog/'.$blog['slug']) ?>" class="btn btn-sm btn-outline-primary">Read More</a>
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
    <!-- End Page Content -->

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