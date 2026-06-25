<?php
$theme = getCurrentTheme();
?>
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<?= $this->section('content') ?>

<!-- Search Header -->
<div class="search-header">
    <div class="container">
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <span class="section-label">Search Results</span>
            <h1 class="search-term mb-0">“<?= esc($searchQuery) ?>”</h1>
        </div>
        <?php 
        $totalResults = count($blogsSearchResults ?? []) + count($pagesSearchResults ?? []);
        ?>
        <p class="results-count mt-2">
            Found <?= $totalResults ?> results 
            (<?= count($blogsSearchResults ?? []) ?> News • <?= count($pagesSearchResults ?? []) ?> Pages)
        </p>
    </div>
</div>

<main class="py-5">
    <div class="container">

        <?php if (empty($blogsSearchResults) && empty($pagesSearchResults)): ?>
            <!-- ==================== NO RESULTS FOUND ==================== -->
            <div class="text-center py-5 my-5">
                <i class="ri-search-line" style="font-size: 4.5rem; color: var(--ink-light); opacity: 0.4; display: block; margin-bottom: 1.5rem;"></i>
                <h3 class="mb-3" style="font-family: 'Playfair Display', Georgia, serif;">No results found</h3>
                <p class="text-muted mb-4" style="max-width: 460px; margin-left: auto; margin-right: auto;">
                    Sorry, we couldn't find any content matching "<strong><?= esc($searchQuery) ?></strong>".
                </p>
                <div class="not-found-box" style="margin-top: 0; background: transparent; border: none; padding: 0;">
                    <p class="mb-4">Try broadening your keywords or explore popular sections:</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="<?= site_url('blogs?category=politics') ?>" class="btn btn-outline-primary">Politics</a>
                        <a href="<?= site_url('blogs?category=sports') ?>" class="btn btn-outline-primary">Sports</a>
                        <a href="<?= site_url('blogs?category=business') ?>" class="btn btn-outline-primary">Business</a>
                    </div>
                </div>
            </div>

        <?php else: ?>

            <!-- ==================== NEWS & ARTICLES ==================== -->
            <?php if (!empty($blogsSearchResults)): ?>
            <div class="mb-5">
                <h2 class="section-results-title">
                    <i class="ri-newspaper-line me-2"></i> News &amp; Articles
                </h2>

                <div class="row g-4">
                    <?php foreach ($blogsSearchResults as $blog): ?>
                    <div class="col-lg-6">
                        <a href="<?= site_url('blog/' . $blog['slug']) ?>" class="d-block news-card search-result-card h-100">
                            <?php if (!empty($blog['featured_image'])): ?>
                                <img src="<?= esc($blog['featured_image']) ?>" 
                                     alt="<?= esc($blog['title']) ?>" 
                                     loading="lazy" 
                                     style="height: 210px; object-fit: cover;">
                            <?php else: ?>
                                <img src="https://picsum.photos/id/<?= rand(100,300) ?>/600/400" 
                                     alt="<?= esc($blog['title']) ?>" 
                                     loading="lazy" 
                                     style="height: 210px; object-fit: cover;">
                            <?php endif; ?>

                            <div class="news-card-body">
                                <div class="category"><?= esc($blog['category_name'] ?? 'News') ?></div>
                                <h4><?= esc($blog['title']) ?></h4>
                                <p class="mb-3"><?= esc(substr(strip_tags($blog['excerpt'] ?? $blog['content']), 0, 160)) ?>...</p>
                                <div class="news-card-footer">
                                    <?php if (!empty($blog['source'])): ?>
                                        <span class="source-badge"><?= esc($blog['source']) ?></span>
                                    <?php endif; ?>
                                    <span class="time-meta">
                                        <i class="ri-time-line"></i> 
                                        <?= timeAgo($blog['created_at']) ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- ==================== PAGES ==================== -->
            <?php if (!empty($pagesSearchResults)): ?>
            <div>
                <h2 class="section-results-title">
                    <i class="ri-file-text-line me-2"></i> Pages
                </h2>

                <div class="pages-grid">
                    <?php foreach ($pagesSearchResults as $page): ?>
                    <a href="<?= site_url($page['slug']) ?>" class="page-result">
                        <div class="category">Page</div>
                        <h5><?= esc($page['title']) ?></h5>
                        <p><?= esc(substr(strip_tags($page['content']), 0, 180)) ?>...</p>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        <?php endif; ?>

        <!-- ==================== NOT WHAT YOU WERE LOOKING FOR? ==================== -->
        <div class="not-found-box">
            <h5 class="mb-3">Not what you were looking for?</h5>
            <p class="text-muted mb-4" style="max-width: 460px; margin-left: auto; margin-right: auto;">
                Try a different search term or browse our categories.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap" style="max-width: 520px; margin: 0 auto;">
                <div class="search-bar-wrap" style="max-width: 380px; flex: 1;">
                    <form action="<?= site_url('search') ?>" method="get">
                        <input type="search" name="q" class="form-control" 
                               placeholder="Try a different search term…" 
                               value="<?= esc($searchQuery) ?>" aria-label="New search">
                    </form>
                </div>
                <button type="button" onclick="this.closest('form').submit()" 
                        class="btn btn-primary px-4" 
                        style="font-weight: 700; letter-spacing: 0.04em;">
                    <i class="ri-search-line me-2"></i> Search Again
                </button>
            </div>
        </div>

    </div>
</main>

<?= $this->endSection() ?>