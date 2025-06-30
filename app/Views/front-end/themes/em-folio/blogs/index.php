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
<section id="post-details" class="section">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blogs</li>
            </ol>
        </nav>

        <div class="row">
            <section id="blog" class="section">
                <div class="container">
                    <h2 class="section-title" data-aos="fade-up"><?=$sectionTitle?></h2>
                    <p class="lead fw-normal text-muted mb-0"><?=$sectionDescription?></p>
                    <div class="row justify-content-center">
                        <?php if($blogs): ?>
                            <?php foreach($blogs as $index => $blog): ?>
                                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
                                    <div class="card blog-card">
                                        <img src="<?=getImageUrl($blog['featured_image'] ?? 'https://placehold.co/400x200/6366f1/ffffff?text=Blog')?>" alt="<?= $blog['title'] ?? 'Blog Title'; ?>" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $blog['title'] ?? 'Blog Title'; ?></h5>
                                            <p class="card-text"><?= !empty($blog['excerpt']) ? getTextSummary($blog['excerpt']) : getTextSummary($blog['content'] ?? 'Blog content'); ?></p>
                                            <a href="<?= base_url('blog/'.$blog['slug']) ?>" class="btn btn-outline-primary mt-auto">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <?php
                        //display content block if it exists
                        if(!empty($contentBlocks)){
                            renderContentBlocks($contentBlocks);
                        }
                    ?>
                </div>
            </section>
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