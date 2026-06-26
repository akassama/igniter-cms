<?php
// Get current theme impact
$theme = getCurrentTheme();
$currentPage = "blogs";
$popUpWhereClause = ['status' => 1];

//update view count
updateTotalViewCount("blogs", "blog_id", $blog_data['blog_id']);
?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<?= $this->section('content') ?>
<script id="dsq-count-scr" src="//akassama-dev.disqus.com/count.js" async></script>

<!-- ===== Breadcrumb ===== -->
<div class="post-breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="ri-home-4-line"></i> Home</a></li>
            <?php if (!empty($category)): ?>
            <li class="breadcrumb-item">
                <a href="<?= base_url('category/' . ($category['link'] ?? $category['category_id'])) ?>">
                    <?= esc($category['title']) ?>
                </a>
            </li>
            <?php endif; ?>
            <li class="breadcrumb-item active" aria-current="page">
                <?= esc(getTextSummary($blog_data['title'], 60)) ?>
            </li>
        </ol>
    </div>
</div>

<!-- ===== Article Hero ===== -->
<div class="article-hero">
    <img src="<?= esc($blog_data['featured_image']) ?>" alt="<?= esc($blog_data['title']) ?>" loading="eager">
    <div class="article-hero-overlay"></div>
    <div class="container">
        <div class="article-hero-caption">
            <?php if (!empty($category)): ?>
            <div class="category-pill">
                <i class="ri-newspaper-line"></i> <?= esc($category['title']) ?>
            </div>
            <?php endif; ?>
            <h1><?= esc($blog_data['title']) ?></h1>
            <?php if (!empty($blog_data['excerpt'])): ?>
            <p class="deck"><?= esc(getTextSummary($blog_data['excerpt'], 250)) ?></p>
            <?php endif; ?>
            <div class="hero-meta">
                <span><i class="ri-time-line"></i> <?= dateFormat($blog_data['created_at'], 'l, d F Y, H:i') ?> GMT</span>
                <?php if ($blog_data['created_at'] !== $blog_data['updated_at']): ?>
                <span><i class="ri-refresh-line"></i> Updated <?= dateFormat($blog_data['updated_at'], 'H:i') ?> GMT</span>
                <?php endif; ?>
                <span><i class="ri-newspaper-line"></i> <?= esc($blog_data['source']) ?></span>
                <span><i class="ri-eye-line"></i> <?= number_format($blog_data['total_views']) ?> views</span>
                <span><i class="ri-timer-line"></i> <?= estimateReadTime($blog_data['content']) ?> min read</span>
                <span><i class="ri-message-2-line"></i> <a href="<?= base_url('blog/'.$blog_data['slug']) ?>#disqus_thread"> Comments </a></span>
            </div>
        </div>
    </div>
</div>
<div class="hero-img-caption">
    <?= esc($blog_data['title']) ?> &mdash;
    <em>Source: <?= esc($blog_data['source']) ?></em>
</div>

<!-- ===== Source Attribution ===== -->
<div class="source-banner">
    <span class="source-badge">
        <a href="<?= base_url('sources/' . urlencode($blog_data['source'])) ?>" class="text-decoration-none text-white">
            <?= esc($blog_data['source']) ?>
        </a>
    </span>
    <span class="source-note">
        This article was originally published by
        <a href="<?= esc($blog_data['link']) ?>" target="_blank" rel="noopener"><?= esc($blog_data['source']) ?></a>
        and is aggregated here by GambianNews.com. All rights belong to the original publisher.
        <a href="<?= esc($blog_data['link']) ?>" target="_blank" rel="noopener">
            Read original article <i class="ri-external-link-line"></i>
        </a>
    </span>
</div>

<!-- ===== Main Post Layout ===== -->
<div class="post-layout">
    <div class="container">
        <div class="row g-4">

            <!-- Share Bar (left, desktop) -->
            <div class="col-lg-1 d-none d-lg-block">
                <div class="share-bar">
                    <div class="share-bar-inner">
                        <span class="share-label">Share</span>
                        <button class="share-btn fb" onclick="shareArticle('facebook')" title="Share on Facebook" aria-label="Share on Facebook"><i class="ri-facebook-fill"></i></button>
                        <button class="share-btn tw" onclick="shareArticle('twitter')" title="Share on X/Twitter" aria-label="Share on Twitter"><i class="ri-twitter-x-fill"></i></button>
                        <button class="share-btn wa" onclick="shareArticle('whatsapp')" title="Share on WhatsApp" aria-label="Share on WhatsApp"><i class="ri-whatsapp-fill"></i></button>
                        <button class="share-btn tg" onclick="shareArticle('telegram')" title="Share on Telegram" aria-label="Share on Telegram"><i class="ri-telegram-fill"></i></button>
                        <button class="share-btn ln" onclick="shareArticle('linkedin')" title="Share on LinkedIn" aria-label="Share on LinkedIn"><i class="ri-linkedin-fill"></i></button>
                        <button class="share-btn cp" onclick="copyLink()" title="Copy link" aria-label="Copy link" id="copyBtn"><i class="ri-links-line"></i></button>
                    </div>
                </div>
            </div>

            <!-- Article Content -->
            <div class="col-lg-7">

                <!-- Mobile share bar -->
                <div class="d-lg-none mb-3">
                    <div class="share-bar-inner" style="flex-direction:row;flex-wrap:wrap;gap:0.5rem;justify-content:flex-start;border-radius:8px;">
                        <span style="font-family:'Barlow Condensed',sans-serif;font-size:0.78rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--ink-light);align-self:center;">Share:</span>
                        <button class="share-btn fb" onclick="shareArticle('facebook')" style="width:36px;height:36px;" aria-label="Facebook"><i class="ri-facebook-fill"></i></button>
                        <button class="share-btn tw" onclick="shareArticle('twitter')" style="width:36px;height:36px;" aria-label="Twitter"><i class="ri-twitter-x-fill"></i></button>
                        <button class="share-btn wa" onclick="shareArticle('whatsapp')" style="width:36px;height:36px;" aria-label="WhatsApp"><i class="ri-whatsapp-fill"></i></button>
                        <button class="share-btn tg" onclick="shareArticle('telegram')" style="width:36px;height:36px;" aria-label="Telegram"><i class="ri-telegram-fill"></i></button>
                        <button class="share-btn cp" onclick="copyLink()" style="width:36px;height:36px;" aria-label="Copy link"><i class="ri-links-line"></i></button>
                    </div>
                </div>

                <!-- AI Summary as Key Facts (if available) -->
                <?php if (!empty($blog_data['ai_summary'])): ?>
                    <div class="key-facts">
                        <div class="kf-title"><i class="ri-robot-line"></i> AI Summary</div>
                        <p style="margin:0;font-size:0.9rem;"><?= esc($blog_data['ai_summary']) ?></p>
                    </div>
                <?php elseif (!empty($blog_data['excerpt'])): ?>
                    <div class="key-facts">
                        <div class="kf-title"><i class="ri-file-text-line"></i> Excerpt</div>
                        <p style="margin:0;font-size:0.9rem;"><?= esc($blog_data['excerpt']) ?></p>
                    </div>
                <?php endif; ?>

                <!-- Article Body -->
                <div class="article-body" id="article-body">
                    <?= $blog_data['content'] ?>
                </div>

                <!-- Tags -->
                <?php if (!empty($tags)): ?>
                <div class="post-tags">
                    <span class="tag-label">Topics:</span>
                    <?php foreach ($tags as $tag): ?>
                    <a href="<?= base_url('search?q=' . urlencode($tag)) ?>" class="tag"><?= esc($tag) ?></a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Reporter -->
                <?php if (!empty($blog_data['author'])): ?>
                <div class="reporter-card">
                    <div class="reporter-avatar">
                        <a href="<?= base_url('search/filter?type=author&key=' . strtolower(url_title($blog_data['author']))) ?>" class="text-decoration-none text-white">
                            <?= strtoupper(substr($blog_data['author'], 0, 2)) ?>
                        </a>
                    </div>
                    <div>
                        <div class="reporter-name">
                            <a href="<?= base_url('search/filter?type=author&key=' . strtolower(url_title($blog_data['author']))) ?>"><?= esc($blog_data['author']) ?></a>
                        </div>
                        <div class="reporter-pub">
                            <a href="<?= base_url('sources/' . urlencode($blog_data['source'])) ?>" class="text-decoration-none">
                                <i class="ri-newspaper-line"></i> <?= esc($blog_data['source']) ?>
                            </a>
                        </div>
                        <?php if (!empty($blog_data['link'])): ?>
                        <div class="reporter-bio">
                            <a href="<?= esc($blog_data['link']) ?>" target="_blank" rel="noopener">
                                View original article <i class="ri-external-link-line"></i>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
				

                <!-- Comments -->
                <div class="comments-section">
                    <h3 style="font-family:'Playfair Display',serif;font-size:1.35rem;font-weight:800;color:var(--ink);margin-bottom:1.2rem;">
                        <i class="ri-chat-3-line" style="color:var(--primary);"></i> Discussion <span style="font-family:'Barlow Condensed',sans-serif;font-size:1rem;color:var(--ink-light);"></span>
                    </h3>
                    <div id="disqus_thread"></div>
                        <script>
                            /**
                            *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                            *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                            /*
                            var disqus_config = function () {
                            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                            };
                            */
                            (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document, s = d.createElement('script');
                            s.src = 'https://gambian-news.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                    </div>

                </div>
			<!-- /article col -->

            <!-- ===== Right: Sidebar ===== -->
            <div class="col-lg-4">
                <?= view("front-end/themes/$theme/includes/_rightSidebar") ?>
            </div>
            <!-- /sidebar -->
        </div>
        <!-- /row -->

        <!-- ===== More Stories ===== -->
        <?php if (!empty($more_stories)): ?>
        <div class="more-stories">
            <div class="more-stories-title">
                <i class="ri-article-line" style="color:var(--primary);margin-right:0.5rem;"></i>
                More From <?= !empty($category) ? esc($category['title']) : 'Latest News' ?>
            </div>
            <div class="row g-0">
                <?php
                $left  = array_slice($more_stories, 0, 2);
                $right = array_slice($more_stories, 2, 2);
                ?>
                <div class="col-md-6">
                    <?php foreach ($left as $story):
                        $storyCat = getTableData('categories', ['category_id' => $story['category']], 'title');
                    ?>
                    <a href="<?= base_url('blog/' . $story['slug']) ?>" class="d-block story-card pe-md-4">
                        <img src="<?= esc($story['featured_image']) ?>" alt="<?= esc($story['title']) ?>" loading="lazy">
                        <div>
                            <?php if ($storyCat): ?>
                            <div class="sc-cat"><?= esc($storyCat) ?></div>
                            <?php endif; ?>
                            <h5><?= esc($story['title']) ?></h5>
                            <div class="sc-meta">
                                <span><i class="ri-time-line"></i> <?= timeAgo($story['created_at']) ?></span>
                                <span class="source-badge" style="font-size:0.65rem;"><?= esc($story['source']) ?></span>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-6">
                    <?php foreach ($right as $story):
                        $storyCat = getTableData('categories', ['category_id' => $story['category']], 'title');
                    ?>
                    <a href="<?= base_url('blog/' . $story['slug']) ?>" class="d-block story-card ps-md-4">
                        <img src="<?= esc($story['featured_image']) ?>" alt="<?= esc($story['title']) ?>" loading="lazy">
                        <div>
                            <?php if ($storyCat): ?>
                            <div class="sc-cat"><?= esc($storyCat) ?></div>
                            <?php endif; ?>
                            <h5><?= esc($story['title']) ?></h5>
                            <div class="sc-meta">
                                <span><i class="ri-time-line"></i> <?= timeAgo($story['created_at']) ?></span>
                                <span class="source-badge" style="font-size:0.65rem;"><?= esc($story['source']) ?></span>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
    <!-- /container -->
</div>
<!-- /post-layout -->

<?php if (ENVIRONMENT !== 'production'): ?>
<!-- 
CUSTOMIZATION NOTES:
-------------------
To customize the blog display without using helper functions:

1. REPLACE helper function calls with your custom HTML
2. Available data variables:
   - $blog_data: Current blog post data
   - $categories: Array of blog categories
   - $blogs: Array of recent blog posts

For blog content:
<div class="custom-blog-content">
    <h1><!= $blog_data['title'] ?></h1>
    <!== Your custom blog content HTML ==>
</div>

For sidebar:
<div class="custom-sidebar">
    <!== Your custom sidebar widgets ==>
</div>

Helper functions provide theme-agnostic styling with Unicode icons.
Custom implementation gives full design control but requires manual styling.
-->
<?php endif; ?>

<?= $this->endSection() ?>