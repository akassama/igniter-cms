<?php
// Get current theme impact
$theme = getCurrentTheme();
$currentPage = "blogs";
?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<?= $this->section('content') ?>

<!-- ===== Main Content ===== -->
<div class="container py-4">

<!-- ===== Page Header ===== -->
<!-- ===== Page Header ===== -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="ph-eyebrow"><i class="ri-article-line"></i> &nbsp;All Stories</div>
                <h1>Latest News from The Gambia</h1>
                <p class="ph-desc">Aggregated headlines from <?= implode(', ', array_column($news_sources, 'site')) ?> — updated continuously.</p>
                <div class="ph-stats">
                    <div class="ph-stat"><div class="num"><?= number_format($total_blogs) ?></div><div class="lbl">Total Articles</div></div>
                    <div class="ph-stat"><div class="num"><?= $total_sources ?></div><div class="lbl">News Sources</div></div>
                    <div class="ph-stat"><div class="num" id="live-count"><?= $today_blogs ?></div><div class="lbl">Today's Stories</div></div>
                    <div class="ph-stat"><div class="num"><?= $total_categories ?></div><div class="lbl">Categories</div></div>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-flex justify-content-end align-items-center">
                <div style="text-align:right;">
                    <div style="font-family:'Barlow Condensed',sans-serif;font-size:0.7rem;letter-spacing:0.15em;text-transform:uppercase;color:rgba(255,255,255,0.35);margin-bottom:0.4rem;">Last updated</div>
                    <div style="font-family:'Barlow Condensed',sans-serif;font-size:1rem;font-weight:700;color:rgba(255,255,255,0.7);" id="last-updated-time">
                        <?= !empty($last_updated) ? dateFormat($last_updated, 'H:i') . ' GMT' : '' ?>
                    </div>
                    <div style="display:flex;align-items:center;gap:0.4rem;justify-content:flex-end;margin-top:0.4rem;">
                        <span style="width:8px;height:8px;border-radius:50%;background:#00ff88;display:inline-block;animation:pulse-dot 1.5s ease-in-out infinite;"></span>
                        <span style="font-family:'Barlow Condensed',sans-serif;font-size:0.75rem;color:rgba(255,255,255,0.4);">Live feed active</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
@keyframes pulse-dot { 0%,100%{transform:scale(1);opacity:1;} 50%{transform:scale(1.3);opacity:0.6;} }
</style>

<!-- ===== Breadcrumb ===== -->
<div class="post-breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="ri-home-4-line"></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">All News</li>
        </ol>
    </div>
</div>

<!-- ===== Filter / Sort Bar ===== -->
<div class="filter-bar">
    <div class="container">
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <span class="filter-label d-none d-md-inline">Filter:</span>
            <div class="filter-pills-scroll flex-grow-1">
                <button class="filter-pill active" data-cat="all" onclick="filterCat(this)">All</button>
                <?php foreach ($categories as $filterCat):
                    $slug = strtolower(url_title($filterCat['title']));
                ?>
                <button class="filter-pill" data-cat="<?= esc($slug) ?>" onclick="filterCat(this)">
                    <?= esc($filterCat['title']) ?>
                </button>
                <?php endforeach; ?>
            </div>
            <div class="d-flex align-items-center gap-2 ms-auto flex-shrink-0">
                <select class="sort-select" id="sortSelect" onchange="sortPosts(this.value)" aria-label="Sort posts">
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="popular">Most Read</option>
                </select>
                <div class="view-toggle">
                    <button id="gridViewBtn" class="active" onclick="setView('grid')" title="Grid view" aria-label="Grid view"><i class="ri-layout-grid-line"></i></button>
                    <button id="listViewBtn" onclick="setView('list')" title="List view" aria-label="List view"><i class="ri-list-check-2"></i></button>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <?php
                $pagerData    = $pager->getDetails('default');
                $currentPage  = $pagerData['currentPage'];
                $perPage      = $pagerData['perPage'];
                $rangeStart   = (($currentPage - 1) * $perPage) + 1;
                $rangeEnd     = min($currentPage * $perPage, $total_blogs);
                $totalPages   = $pagerData['pageCount'];
            ?>
            <span class="results-count">
                <strong id="result-count"><?= $rangeEnd - $rangeStart + 1 ?></strong>
                of <strong><?= number_format($total_blogs) ?></strong> stories shown —
                Page <strong id="current-page-label"><?= $currentPage ?></strong> of <?= $totalPages ?>
            </span>
        </div>
    </div>
</div>

    <div class="row g-4 mt-1">

        <!-- ===== Posts ===== -->
        <div class="col-lg-8">

            <div id="posts-container" class="grid-view">

                <?php
                $adInterval = 8; // show ad strip every N posts
                foreach ($blogs as $i => $post):
                    $catTitle = getTableData('categories', ['category_id' => $post['category']], 'title');
                    $catSlug  = strtolower(url_title($catTitle ?? ''));
                ?>

                <?php // Ad strip every 8 posts (after post 8, 16, etc.) ?>
                <?php if ($i > 0 && $i % $adInterval === 0): ?>
                <div class="grid-only" style="grid-column: 1 / -1;">
                    <div class="ad-strip">
                        <strong>Advertisement</strong> &nbsp;·&nbsp;
                        Advertise your business to 15,000+ people —
                        <a href="mailto:advertise@gambianews.com" style="color:var(--primary);">Contact us</a>
                    </div>
                </div>
                <?php endif; ?>

                <a href="<?= base_url('blog/' . $post['slug']) ?>" class="d-block text-decoration-none" data-cat="<?= esc($catSlug) ?>">

                    <!-- Grid Card -->
                    <div class="news-grid-card">
                        <div class="card-img-wrap">
                            <img src="<?= esc($post['featured_image']) ?>" alt="<?= esc($post['title']) ?>" loading="lazy">
                            <?php if ($catTitle): ?>
                                <span class="cat-overlay"><?= esc($catTitle) ?></span>
                            <?php endif; ?>
                            <?php if ($post['is_breaking']): ?>
                                <span class="badge-flag breaking">Breaking</span>
                            <?php elseif ($post['is_featured']): ?>
                                <span class="badge-flag featured">Featured</span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <h4><?= esc($post['title']) ?></h4>
                            <p><?= esc(getTextSummary($post['excerpt'], 120)) ?></p>
                            <div class="card-footer-row">
                                <div>
                                    <span class="source-badge me-1"><?= esc($post['source']) ?></span>
                                    <span class="time"><i class="ri-time-line"></i> <?= timeAgo($post['created_at']) ?></span>
                                </div>
                                <span class="read-more">Read <i class="ri-arrow-right-line"></i></span>
                            </div>
                        </div>
                    </div>

                    <!-- List Card -->
                    <div class="news-list-card">
                        <div class="lc-img-wrap">
                            <img src="<?= esc($post['featured_image']) ?>" alt="<?= esc($post['title']) ?>" loading="lazy">
                            <?php if ($catTitle): ?>
                                <span class="cat-overlay"><?= esc($catTitle) ?></span>
                            <?php endif; ?>
                            <?php if ($post['is_breaking']): ?>
                                <span class="badge-flag breaking" style="position:absolute;top:0.55rem;right:0.55rem;">Breaking</span>
                            <?php elseif ($post['is_featured']): ?>
                                <span class="badge-flag featured" style="position:absolute;top:0.55rem;right:0.55rem;">Featured</span>
                            <?php endif; ?>
                        </div>
                        <div class="lc-body">
                            <div>
                                <h4><?= esc($post['title']) ?></h4>
                                <p><?= esc(getTextSummary($post['excerpt'], 120)) ?></p>
                            </div>
                            <div class="lc-meta">
                                <span class="source-badge"><?= esc($post['source']) ?></span>
                                <span class="time"><i class="ri-time-line"></i> <?= timeAgo($post['created_at']) ?></span>
                                <?php if ($post['total_views'] > 0): ?>
                                    <span class="views"><i class="ri-eye-line"></i> <?= number_format($post['total_views']) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </a>
                <?php endforeach; ?>

            </div>
            <!-- /#posts-container -->

            <!-- ===== Pagination ===== -->
            <nav aria-label="News pagination">
                <div class="pagination-wrap">
                    <?php
                        $prevPage = $currentPage - 1;
                        $nextPage = $currentPage + 1;
                    ?>
                    <a href="<?= $currentPage <= 1 ? '#' : $pager->getPreviousPageURI() ?>"
                    class="page-btn prev-next <?= $currentPage <= 1 ? 'disabled' : '' ?>"
                    aria-label="Previous page">
                        <i class="ri-arrow-left-s-line"></i> Prev
                    </a>

                    <?php for ($p = 1; $p <= min(5, $totalPages); $p++): ?>
                    <a href="<?= $pager->getPageURI($p) ?>"
                    class="page-btn <?= $p === $currentPage ? 'active' : '' ?>"
                    aria-label="Page <?= $p ?>"
                    <?= $p === $currentPage ? 'aria-current="page"' : '' ?>>
                        <?= $p ?>
                    </a>
                    <?php endfor; ?>

                    <?php if ($totalPages > 5): ?>
                    <span class="page-info">…</span>
                    <a href="<?= $pager->getPageURI($totalPages) ?>" class="page-btn" aria-label="Page <?= $totalPages ?>">
                        <?= $totalPages ?>
                    </a>
                    <?php endif; ?>

                    <a href="<?= $currentPage >= $totalPages ? '#' : $pager->getNextPageURI() ?>"
                    class="page-btn prev-next <?= $currentPage >= $totalPages ? 'disabled' : '' ?>"
                    aria-label="Next page">
                        Next <i class="ri-arrow-right-s-line"></i>
                    </a>
                </div>
                <div class="text-center" style="font-family:'Barlow',sans-serif;font-size:0.82rem;color:var(--ink-light);padding-bottom:1rem;">
                    Showing stories <strong><?= $rangeStart ?>–<?= $rangeEnd ?></strong> of <strong><?= number_format($total_blogs) ?></strong> total
                </div>
            </nav>

        </div>
        <!-- /col-lg-8 -->

        <!-- ===== Right: Sidebar ===== -->
        <div class="col-lg-4">
            <?= view("front-end/themes/$theme/includes/_rightSidebar") ?>
        </div>
        <!-- /sidebar -->

    </div>
    <!-- /row -->
    </div>
    <!-- /row -->
</div>

<?php if (ENVIRONMENT !== 'production'): ?>
<!-- 
CUSTOMIZATION NOTES:
-------------------
To customize the blogs grid display without using the helper function:

1. REPLACE the helper function call above with your custom HTML
2. Available data variables:
   - $blogs: Array of blog posts with pagination
   - $pager: Pagination object
   - $total_blogs: Total number of blogs

Example custom display:
<div class="custom-blogs-grid">
    <!php foreach($blogs as $blog): ?>
        <!== Your custom blog card HTML ==>
    <!php endforeach; ?>
</div>

The helper function provides theme-agnostic styling with Unicode icons.
Remove it only if you need complete design control or framework-specific styling.
-->
<?php endif; ?>

<?= $this->endSection() ?>