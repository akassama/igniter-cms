<?php
// Get current theme impact
$theme = getCurrentTheme();

?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<!-- begin main content -->
<?= $this->section('content') ?>

<!-- Page Content -->
<section class="page py-5">
    <div class="container py-5">
        <!--Breadcrumb-->
        <div class="row mb-1">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item active text-secondary" aria-current="page">Search Results</li>
            </ol>
            </nav>
        </div>

        <?php 
        // Check if all search result arrays are empty
        $noResults = empty($blogsSearchResults) && empty($pagesSearchResults);
        ?>

        <?php if ($noResults): ?>
            <!-- No Results Found -->
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="fw-bold mb-3">No Results Found</h1>
                    <p class="text-muted">Sorry, we couldn't find any content matching "<strong><?= esc($searchQuery) ?></strong>".</p>
                </div>
            </div>

            <!-- Search Suggestion Card -->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 text-center">
                            <i class="bi bi-search-heart fs-1 text-muted mb-3"></i>
                            <h3 class="fw-bold mb-3">Not the results you were looking for?</h3>
                            <p class="text-muted mb-4">Help us improve your search experience by telling us what you were looking for.</p>
                            <form action="<?= base_url('search') ?>" method="get">
                                <div class="mb-3">
                                    <input type="text" name="q" class="form-control form-control-lg" placeholder="What were you searching for?" value="<?= esc($searchQuery) ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary px-4">Search Again</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- Search Header -->
            <?php 
            $totalResults = count($blogsSearchResults ?? []) + count($pagesSearchResults ?? []);
            ?>
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="fw-bold mb-3">Search Results for "<span class="text-danger"><?= esc($searchQuery) ?></span>"</h1>
                    <p class="text-muted"><?= $totalResults ?> result(s) found</p>
                </div>
            </div>

            <!-- Pages Results -->
            <?php if (!empty($pagesSearchResults)): ?>
                <div class="row mb-5">
                    <div class="col-12">
                        <h2 class="h4 fw-bold mb-4 pb-2 border-bottom">
                            <i class="bi bi-file-earmark-text me-2"></i>Pages
                        </h2>
                        <div class="list-group">
                            <?php foreach ($pagesSearchResults as $page): ?>
                                <a href="<?= base_url($page['slug']) ?>" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"><?= esc($page['title']) ?></h5>
                                        <small class="text-muted">Page</small>
                                    </div>
                                    <p class="mb-1">
                                        <?= !empty($page['excerpt']) ? esc(getTextSummary($page['excerpt'], 120)) : 'Learn more about this page.' ?>
                                    </p>
                                    <small class="text-muted"><?= base_url($page['slug']) ?></small>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Blogs Results -->
            <?php if (!empty($blogsSearchResults)): ?>
                <div class="row mb-5">
                    <div class="col-12">
                        <h2 class="h4 fw-bold mb-4 pb-2 border-bottom">
                            <i class="bi bi-newspaper me-2"></i>Blog Posts
                        </h2>
                        <div class="row g-4">
                            <?php foreach ($blogsSearchResults as $blog): ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <a href="<?= base_url('blog/' . $blog['slug']) ?>">
                                            <img src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>"
                                                    class="card-img-top"
                                                    alt="<?= esc($blog['title']) ?>">
                                        </a>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <span class="badge bg-primary me-2">
                                                    <?= getBlogCategoryName($blog['category']) ?: 'Uncategorized' ?>
                                                </span>
                                                <small class="text-muted"><?= dateFormat($blog['created_at'], 'M j, Y') ?></small>
                                            </div>
                                            <h5 class="card-title fw-bold"><?= esc($blog['title']) ?></h5>
                                            <p class="card-text">
                                                <?= getTextSummary($blog['excerpt'] ?? $blog['content'], 100) ?>
                                            </p>
                                            <a href="<?= base_url('blog/' . $blog['slug']) ?>" class="btn btn-sm btn-outline-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Feedback Section (Only if results exist) -->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 text-center">
                            <i class="bi bi-search fs-1 text-muted mb-3"></i>
                            <h3 class="fw-bold mb-3">Not what you were looking for?</h3>
                            <p class="text-muted mb-4">Help us improve your search experience.</p>
                            <form action="<?= base_url('search') ?>" method="get">
                                <div class="mb-3">
                                    <input type="text" name="q" class="form-control form-control-lg" placeholder="Try a different search term" value="<?= esc($searchQuery) ?>">
                                </div>
                                <button type="submit" class="btn btn-primary px-4">Search Again</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>
</section>

<!-- end main content -->
<?= $this->endSection() ?>