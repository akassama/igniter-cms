<?php
// Get current theme impact
$theme = getCurrentTheme();

//pages settings
$currentPage = "blogs";
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
                <li class="breadcrumb-item">
                    <a href="<?= base_url() ?>" class="text-decoration-none text-primary">Home</a>
                </li>
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
                <h2 class="fw-bold mb-3">Latest Blog Posts</h2>
                <p class="lead">Insights and updates from our team</p>
            </div>
        </div>

        <div class="row g-4">
            <?php if ($blogs): ?>
                <?php foreach ($blogs as $blog): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100">
                            <a href="<?= base_url('blog/' . $blog['slug']) ?>">
                                <img src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>" 
                                     class="card-img-top" 
                                     alt="<?= esc($blog['title']) ?>">
                            </a>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="badge bg-success me-2">
                                        <?= !empty($blog['category']) ? getBlogCategoryName($blog['category']) : "Uncategorized" ?>
                                    </span>
                                    <small class="text-muted"><?= dateFormat($blog['created_at'], 'M j, Y') ?></small>
                                </div>
                                <h5 class="fw-bold"><?= esc($blog['title']) ?></h5>
                                <p class="mb-3">
                                    <?= !empty($blog['excerpt']) ? getTextSummary($blog['excerpt'], 100) : getTextSummary($blog['content'], 100) ?>
                                </p>
                                <a href="<?= base_url('blog/' . $blog['slug']) ?>" class="btn btn-sm btn-outline-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">No blog posts available at the moment.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if ($total_blogs > intval(env('PAGINATE_LOW', 20))): ?>
            <div class="text-center mt-5">
                <?= $pager->links('default', 'bootstrap_pagination') // Assuming you have a custom view or use Bootstrap style ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- end main content -->
<?= $this->endSection() ?>