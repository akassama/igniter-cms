<?php
$theme = getCurrentTheme();
?>
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <h1 class="mb-4">Filter Results: <?= esc(ucfirst($type ?? '')) ?> “<?= esc($searchQuery) ?>”</h1>

    <?php if (!empty($blogsSearchResults)): ?>
        <h3 class="mb-3">News &amp; Articles (<?= count($blogsSearchResults) ?>)</h3>
        <div class="row g-4">
            <?php foreach ($blogsSearchResults as $blog): ?>
            <div class="col-lg-6">
                <a href="<?= site_url('blog/' . $blog['slug']) ?>" class="d-block news-card h-100">
                    <!-- Same card structure as above -->
                    <img src="<?= !empty($blog['featured_image']) ? $blog['featured_image'] : 'https://picsum.photos/id/'.rand(100,300).'/600/400' ?>" 
                         alt="<?= esc($blog['title']) ?>" style="height: 210px; object-fit: cover;">
                    <div class="news-card-body">
                        <div class="category"><?= esc($blog['category_name'] ?? 'News') ?></div>
                        <h4><?= esc($blog['title']) ?></h4>
                        <p><?= esc(substr(strip_tags($blog['excerpt'] ?? ''), 0, 140)) ?>...</p>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($pagesSearchResults)): ?>
        <h3 class="mt-5 mb-3">Pages (<?= count($pagesSearchResults) ?>)</h3>
        <div class="pages-grid">
            <?php foreach ($pagesSearchResults as $page): ?>
            <a href="<?= site_url($page['slug']) ?>" class="page-result">
                <div class="category">Page</div>
                <h5><?= esc($page['title']) ?></h5>
                <p><?= esc(substr(strip_tags($page['content']), 0, 160)) ?>...</p>
            </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (empty($blogsSearchResults) && empty($pagesSearchResults)): ?>
        <p class="text-center text-muted py-5">No results found for this filter.</p>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>