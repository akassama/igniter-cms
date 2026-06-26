<?php
$theme = getCurrentTheme();
?>
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <h1 class="mb-4">Articles by Category: <?= esc(ucfirst($type ?? '')) ?> “<?= esc($categoryName) ?>”</h1>

    <?php if (!empty($blogCategoryPosts)): ?>
        <h3 class="mb-3">News &amp; Articles (<?= count($blogCategoryPosts) ?>)</h3>
        <div class="row g-4">
            <?php foreach ($blogCategoryPosts as $blog): ?>
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

    <?php if (empty($blogCategoryPosts) && empty($pagesSearchResults)): ?>
        <p class="text-center text-muted py-5">No results found for this filter.</p>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>