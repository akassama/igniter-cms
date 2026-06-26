<?php
// This is to get current impact
$theme = getCurrentTheme();

//page settings
$currentPage = "home";
$popUpWhereClause = ['status' => 1];

$enableHomeSeo = getTableData('plugin_configs', ['plugin_slug' => 'seo-master', 'config_key' => 'enable_home_seo'], 'config_value');
?>

<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
<!-- ////// BEGIN Get Home Pages ///// -->
    <!-- ===== Hero / Featured Section ===== -->
    <section class="hero-section">
        <div class="container">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="section-label">Featured</span>
                <span style="font-family:'Barlow Condensed',sans-serif;font-size:0.75rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--ink-light);">Top stories right now</span>
            </div>
            <div class="row g-3">

            <!-- Main Feature Slider (10 news items) -->
            <div class="col-lg-7">
                <div id="heroNewsSlider" class="carousel slide hero-slider" data-bs-ride="carousel" data-bs-interval="5000">
                    
                    <!-- Carousel Indicators -->
                    <div class="carousel-indicators">
                        <?php 
                        // Get 10 featured/breaking posts for slider
                        $db = \Config\Database::connect();
                        $sliderPosts = $db->table('blogs')
                            ->where('status', 1)
                            ->where('is_featured', 1)
                            ->orderBy('created_at', 'DESC')
                            ->limit(10)
                            ->get()
                            ->getResultArray();
                        
                        // If less than 10, fill with latest posts
                        if (count($sliderPosts) < 10) {
                            $needed = 10 - count($sliderPosts);
                            $extraPosts = $db->table('blogs')
                                ->where('status', 1)
                                ->orderBy('created_at', 'DESC')
                                ->limit($needed)
                                ->get()
                                ->getResultArray();
                            $sliderPosts = array_merge($sliderPosts, $extraPosts);
                        }
                        
                        foreach ($sliderPosts as $index => $post): 
                        ?>
                        <button type="button" data-bs-target="#heroNewsSlider" data-bs-slide-to="<?= $index ?>" <?= $index === 0 ? 'class="active" aria-current="true"' : '' ?> aria-label="Slide <?= $index + 1 ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Carousel Items -->
                    <div class="carousel-inner">
                        <?php foreach ($sliderPosts as $index => $sliderPost): 
                            $sliderCat = getTableData('categories', ['category_id' => $sliderPost['category']], 'title');
                        ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <a href="<?= base_url('blog/' . $sliderPost['slug']) ?>" class="d-block">
                                <img src="<?= esc($sliderPost['featured_image']) ?>" alt="<?= esc($sliderPost['title']) ?>" loading="lazy">
                                <div class="hero-main-body">
                                    <div class="kicker">
                                        <?php if ($sliderPost['is_breaking']): ?>
                                            <span class="badge-breaking">Breaking</span>
                                        <?php endif; ?>
                                        <?php if ($sliderCat): ?>
                                            <span><?= esc($sliderCat) ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <h2><?= esc($sliderPost['title']) ?></h2>
                                    <p><?= esc(getTextSummary($sliderPost['excerpt'], 180)) ?></p>
                                    <div class="meta">
                                        <span><i class="ri-time-line"></i><?= timeAgo($sliderPost['created_at']) ?></span>
                                        <span><i class="ri-newspaper-line"></i><?= esc($sliderPost['source']) ?></span>
                                        <?php if ($sliderPost['total_views'] > 0): ?>
                                            <span><i class="ri-eye-line"></i><?= number_format($sliderPost['total_views']) ?> views</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroNewsSlider" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroNewsSlider" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    
                </div>
            </div>

                <!-- Aside Features -->
                <div class="col-lg-5">
                    <div class="hero-aside">
                        <?php foreach ($hero_aside as $aside): ?>
                        <?php $asideCat = getTableData('categories', ['category_id' => $aside['category']], 'title'); ?>
                        <a href="<?= base_url('blog/' . $aside['slug']) ?>" class="hero-aside-card">
                            <img src="<?= esc($aside['featured_image']) ?>" alt="<?= esc($aside['title']) ?>" loading="lazy">
                            <div class="hero-aside-card-body">
                                <?php if ($asideCat): ?>
                                    <div class="category"><?= esc($asideCat) ?></div>
                                <?php endif; ?>
                                <h5><?= esc($aside['title']) ?></h5>
                                <div class="time">
                                    <i class="ri-time-line"></i>
                                    <?= timeAgo($aside['created_at']) ?> · <?= esc($aside['source']) ?>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===== Main Content + Sidebar ===== -->
    <section class="py-3">
        <div class="container">
            <div class="row g-4">

                <!-- ===== Left: Main Feed ===== -->
                <div class="col-lg-8">
                    <!-- Latest News Grid -->
                    <div class="section-title">
                        <i class="ri-live-line icon"></i> Latest News
                    </div>
                    <div class="row g-3 mb-4">
                        <?php foreach ($latest_news as $post): ?>
                        <?php $catTitle = getTableData('categories', ['category_id' => $post['category']], 'title'); ?>
                        <div class="col-sm-6 col-md-4">
                            <a href="<?= base_url('blog/' . $post['slug']) ?>" class="d-block news-card">
                                <img src="<?= esc($post['featured_image']) ?>" alt="<?= esc($post['title']) ?>" loading="lazy">
                                <div class="news-card-body">
                                    <?php if ($catTitle): ?>
                                        <div class="category"><?= esc($catTitle) ?></div>
                                    <?php endif; ?>
                                    <h4><?= esc($post['title']) ?></h4>
                                    <p><?= esc(getTextSummary($post['excerpt'], 100)) ?></p>
                                    <div class="news-card-footer">
                                        <span class="source-badge"><?= esc($post['source']) ?></span>
                                        <span class="time-meta"><?= timeAgo($post['created_at']) ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Politics Section -->
                    <hr class="divider-rule">
                    <div class="section-title">
                        <i class="ri-government-line icon"></i> Politics & Governance
                    </div>
                    <div class="row g-0">
                        <div class="col-md-7 pe-md-3">
                            <?php if (!empty($politics_feature)): ?>
                            <a href="<?= base_url('blog/' . $politics_feature['slug']) ?>" class="d-block">
                                <img src="<?= esc($politics_feature['featured_image']) ?>" alt="<?= esc($politics_feature['title']) ?>"
                                    loading="lazy" class="rounded-2 mb-2 w-100" style="height:230px;object-fit:cover;">
                                <?php if ($politics_feature['is_featured']): ?>
                                    <span class="badge-featured me-1">Featured</span>
                                <?php endif; ?>
                                <h3 class="mt-2" style="font-family:'Playfair Display',Georgia,serif;font-size:1.25rem;font-weight:800;line-height:1.35;color:var(--ink);">
                                    <?= esc($politics_feature['title']) ?>
                                </h3>
                                <p style="font-size:0.88rem;color:var(--ink-muted);">
                                    <?= esc(getTextSummary($politics_feature['excerpt'], 200)) ?>
                                </p>
                                <div style="display:flex;align-items:center;gap:1rem;font-family:'Barlow',sans-serif;font-size:0.78rem;color:var(--ink-light);">
                                    <span><i class="ri-time-line"></i> <?= timeAgo($politics_feature['created_at']) ?></span>
                                    <span class="source-badge"><?= esc($politics_feature['source']) ?></span>
                                    <a href="<?= base_url('blog/' . $politics_feature['slug']) ?>" class="read-more ms-auto">Read More <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </a>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-5">
                            <?php if (!empty($politics_list)): ?>
                                <?php foreach ($politics_list as $item): ?>
                                    <?php 
                                        $itemCat = getTableData('categories', ['category_id' => $item['category']], 'title');
                                        
                                        // 1. Create a CSS-safe class from the source (e.g., "Daily Observer" -> "daily")
                                        // We take the first word and lowercase it to match your CSS logic.
                                        $sourceParts = explode(' ', trim($item['source']));
                                        $sourceClass = strtolower($sourceParts[0]); 
                                    ?>
                                    <div class="article-list-item">
                                        <img src="<?= esc($item['featured_image']) ?>" alt="<?= esc($item['title']) ?>" loading="lazy">
                                        
                                        <div class="content">
                                            <?php if ($itemCat): ?>
                                                <div class="category"><?= esc($itemCat) ?></div>
                                            <?php endif; ?>
                                            
                                            <h6>
                                                <a href="<?= base_url('blog/' . $item['slug']) ?>" 
                                                style="color: inherit; text-decoration: none; display: block;">
                                                    <?php 
                                                        // 2. Fix the ALL CAPS issue: Convert to lowercase then capitalize words
                                                        echo esc(ucwords(strtolower($item['title']))); 
                                                    ?>
                                                </a>
                                            </h6>

                                            <div class="meta-row">
                                                <span><i class="ri-time-line"></i> <?= timeAgo($item['created_at']) ?></span>
                                                <span class="source-badge <?= $sourceClass ?>" style="font-size:0.65rem;">
                                                    <?= esc($item['source']) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="p-3 text-center" style="background:var(--paper-secondary); border-radius:8px;">
                                    <p class="text-muted mb-0 small">No recent articles</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- ===== JUSTICE & JUDICIARY SECTION ===== -->
                    <hr class="divider-rule">
                    <div class="section-title">
                        <i class="ri-scales-3-line icon"></i> Justice & Judiciary
                    </div>
                    <div class="row g-0">
                        <div class="col-md-7 pe-md-3">
                            <?php if (!empty($justice_feature)): ?>
                            <a href="<?= base_url('blog/' . $justice_feature['slug']) ?>" class="d-block">
                                <img src="<?= esc($justice_feature['featured_image']) ?>" alt="<?= esc($justice_feature['title']) ?>"
                                    loading="lazy" class="rounded-2 mb-2 w-100" style="height:230px;object-fit:cover;">
                                <?php if ($justice_feature['is_featured']): ?>
                                    <span class="badge-featured me-1">Featured</span>
                                <?php endif; ?>
                                <h3 class="mt-2" style="font-family:'Playfair Display',Georgia,serif;font-size:1.25rem;font-weight:800;line-height:1.35;color:var(--ink);">
                                    <?= esc($justice_feature['title']) ?>
                                </h3>
                                <p style="font-size:0.88rem;color:var(--ink-muted);">
                                    <?= esc(getTextSummary($justice_feature['excerpt'], 200)) ?>
                                </p>
                                <div style="display:flex;align-items:center;gap:1rem;font-family:'Barlow',sans-serif;font-size:0.78rem;color:var(--ink-light);">
                                    <span><i class="ri-time-line"></i> <?= timeAgo($justice_feature['created_at']) ?></span>
                                    <span class="source-badge"><?= esc($justice_feature['source']) ?></span>
                                    <a href="<?= base_url('blog/' . $justice_feature['slug']) ?>" class="read-more ms-auto">Read More <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </a>
                            <?php else: ?>
                            <div class="p-4 text-center" style="background:var(--paper-secondary); border-radius:12px;">
                                <i class="ri-scales-3-line" style="font-size:2rem; color:var(--ink-light);"></i>
                                <p class="mt-2 text-muted mb-0">No justice & judiciary articles available at the moment.</p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-5">
                            <?php if (!empty($justice_list)): ?>
                                <?php foreach ($justice_list as $item): ?>
                                    <?php 
                                        $itemCat = getTableData('categories', ['category_id' => $item['category']], 'title');
                                        $sourceParts = explode(' ', trim($item['source']));
                                        $sourceClass = strtolower($sourceParts[0]); 
                                    ?>
                                    <div class="article-list-item">
                                        <img src="<?= esc($item['featured_image']) ?>" alt="<?= esc($item['title']) ?>" loading="lazy">
                                        
                                        <div class="content">
                                            <?php if ($itemCat): ?>
                                                <div class="category"><?= esc($itemCat) ?></div>
                                            <?php endif; ?>
                                            
                                            <h6>
                                                <a href="<?= base_url('blog/' . $item['slug']) ?>" 
                                                style="color: inherit; text-decoration: none; display: block;">
                                                    <?php 
                                                        echo esc(ucwords(strtolower($item['title']))); 
                                                    ?>
                                                </a>
                                            </h6>

                                            <div class="meta-row">
                                                <span><i class="ri-time-line"></i> <?= timeAgo($item['created_at']) ?></span>
                                                <span class="source-badge <?= $sourceClass ?>" style="font-size:0.65rem;">
                                                    <?= esc($item['source']) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="p-3 text-center" style="background:var(--paper-secondary); border-radius:8px;">
                                    <p class="text-muted mb-0 small">No recent articles</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- ===== WEST AFRICA SECTION ===== -->
                    <hr class="divider-rule">
                    <div class="section-title">
                        <i class="ri-earth-line icon"></i> West Africa
                    </div>
                    <div class="row g-0">
                        <div class="col-md-7 pe-md-3">
                            <?php if (!empty($west_africa_feature)): ?>
                            <a href="<?= base_url('blog/' . $west_africa_feature['slug']) ?>" class="d-block">
                                <img src="<?= esc($west_africa_feature['featured_image']) ?>" alt="<?= esc($west_africa_feature['title']) ?>"
                                    loading="lazy" class="rounded-2 mb-2 w-100" style="height:230px;object-fit:cover;">
                                <?php if ($west_africa_feature['is_featured']): ?>
                                    <span class="badge-featured me-1">Featured</span>
                                <?php endif; ?>
                                <h3 class="mt-2" style="font-family:'Playfair Display',Georgia,serif;font-size:1.25rem;font-weight:800;line-height:1.35;color:var(--ink);">
                                    <?= esc($west_africa_feature['title']) ?>
                                </h3>
                                <p style="font-size:0.88rem;color:var(--ink-muted);">
                                    <?= esc(getTextSummary($west_africa_feature['excerpt'], 200)) ?>
                                </p>
                                <div style="display:flex;align-items:center;gap:1rem;font-family:'Barlow',sans-serif;font-size:0.78rem;color:var(--ink-light);">
                                    <span><i class="ri-time-line"></i> <?= timeAgo($west_africa_feature['created_at']) ?></span>
                                    <span class="source-badge"><?= esc($west_africa_feature['source']) ?></span>
                                    <a href="<?= base_url('blog/' . $west_africa_feature['slug']) ?>" class="read-more ms-auto">Read More <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </a>
                            <?php else: ?>
                            <div class="p-4 text-center" style="background:var(--paper-secondary); border-radius:12px;">
                                <i class="ri-earth-line" style="font-size:2rem; color:var(--ink-light);"></i>
                                <p class="mt-2 text-muted mb-0">No West Africa articles available at the moment.</p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-5">
                            <?php if (!empty($west_africa_list)): ?>
                                <?php foreach ($west_africa_list as $item): ?>
                                    <?php 
                                        $itemCat = getTableData('categories', ['category_id' => $item['category']], 'title');
                                        $sourceParts = explode(' ', trim($item['source']));
                                        $sourceClass = strtolower($sourceParts[0]); 
                                    ?>
                                    <div class="article-list-item">
                                        <img src="<?= esc($item['featured_image']) ?>" alt="<?= esc($item['title']) ?>" loading="lazy">
                                        
                                        <div class="content">
                                            <?php if ($itemCat): ?>
                                                <div class="category"><?= esc($itemCat) ?></div>
                                            <?php endif; ?>
                                            
                                            <h6>
                                                <a href="<?= base_url('blog/' . $item['slug']) ?>" 
                                                style="color: inherit; text-decoration: none; display: block;">
                                                    <?php 
                                                        echo esc(ucwords(strtolower($item['title']))); 
                                                    ?>
                                                </a>
                                            </h6>

                                            <div class="meta-row">
                                                <span><i class="ri-time-line"></i> <?= timeAgo($item['created_at']) ?></span>
                                                <span class="source-badge <?= $sourceClass ?>" style="font-size:0.65rem;">
                                                    <?= esc($item['source']) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="p-3 text-center" style="background:var(--paper-secondary); border-radius:8px;">
                                    <p class="text-muted mb-0 small">No recent articles</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- ===== CRIME & SECURITY SECTION ===== -->
                    <hr class="divider-rule">
                    <div class="section-title">
                        <i class="ri-shield-flash-line icon"></i> Crime & Security
                    </div>
                    <div class="row g-0">
                        <div class="col-md-7 pe-md-3">
                            <?php if (!empty($crime_feature)): ?>
                            <a href="<?= base_url('blog/' . $crime_feature['slug']) ?>" class="d-block">
                                <img src="<?= esc($crime_feature['featured_image']) ?>" alt="<?= esc($crime_feature['title']) ?>"
                                    loading="lazy" class="rounded-2 mb-2 w-100" style="height:230px;object-fit:cover;">
                                <?php if ($crime_feature['is_featured']): ?>
                                    <span class="badge-featured me-1">Featured</span>
                                <?php endif; ?>
                                <h3 class="mt-2" style="font-family:'Playfair Display',Georgia,serif;font-size:1.25rem;font-weight:800;line-height:1.35;color:var(--ink);">
                                    <?= esc($crime_feature['title']) ?>
                                </h3>
                                <p style="font-size:0.88rem;color:var(--ink-muted);">
                                    <?= esc(getTextSummary($crime_feature['excerpt'], 200)) ?>
                                </p>
                                <div style="display:flex;align-items:center;gap:1rem;font-family:'Barlow',sans-serif;font-size:0.78rem;color:var(--ink-light);">
                                    <span><i class="ri-time-line"></i> <?= timeAgo($crime_feature['created_at']) ?></span>
                                    <span class="source-badge"><?= esc($crime_feature['source']) ?></span>
                                    <a href="<?= base_url('blog/' . $crime_feature['slug']) ?>" class="read-more ms-auto">Read More <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </a>
                            <?php else: ?>
                            <div class="p-4 text-center" style="background:var(--paper-secondary); border-radius:12px;">
                                <i class="ri-shield-flash-line" style="font-size:2rem; color:var(--ink-light);"></i>
                                <p class="mt-2 text-muted mb-0">No crime & security articles available at the moment.</p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-5">
                            <?php if (!empty($crime_list)): ?>
                                <?php foreach ($crime_list as $item): ?>
                                    <?php 
                                        $itemCat = getTableData('categories', ['category_id' => $item['category']], 'title');
                                        $sourceParts = explode(' ', trim($item['source']));
                                        $sourceClass = strtolower($sourceParts[0]); 
                                    ?>
                                    <div class="article-list-item">
                                        <img src="<?= esc($item['featured_image']) ?>" alt="<?= esc($item['title']) ?>" loading="lazy">
                                        
                                        <div class="content">
                                            <?php if ($itemCat): ?>
                                                <div class="category"><?= esc($itemCat) ?></div>
                                            <?php endif; ?>
                                            
                                            <h6>
                                                <a href="<?= base_url('blog/' . $item['slug']) ?>" 
                                                style="color: inherit; text-decoration: none; display: block;">
                                                    <?php 
                                                        echo esc(ucwords(strtolower($item['title']))); 
                                                    ?>
                                                </a>
                                            </h6>

                                            <div class="meta-row">
                                                <span><i class="ri-time-line"></i> <?= timeAgo($item['created_at']) ?></span>
                                                <span class="source-badge <?= $sourceClass ?>" style="font-size:0.65rem;">
                                                    <?= esc($item['source']) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="p-3 text-center" style="background:var(--paper-secondary); border-radius:8px;">
                                    <p class="text-muted mb-0 small">No recent articles</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- ===== INTERNATIONAL RELATIONS SECTION ===== -->
                    <hr class="divider-rule">
                    <div class="section-title">
                        <i class="ri-hand-heart-line icon"></i> International Relations
                    </div>
                    <div class="row g-0">
                        <div class="col-md-7 pe-md-3">
                            <?php if (!empty($intl_relations_feature)): ?>
                            <a href="<?= base_url('blog/' . $intl_relations_feature['slug']) ?>" class="d-block">
                                <img src="<?= esc($intl_relations_feature['featured_image']) ?>" alt="<?= esc($intl_relations_feature['title']) ?>"
                                    loading="lazy" class="rounded-2 mb-2 w-100" style="height:230px;object-fit:cover;">
                                <?php if ($intl_relations_feature['is_featured']): ?>
                                    <span class="badge-featured me-1">Featured</span>
                                <?php endif; ?>
                                <h3 class="mt-2" style="font-family:'Playfair Display',Georgia,serif;font-size:1.25rem;font-weight:800;line-height:1.35;color:var(--ink);">
                                    <?= esc($intl_relations_feature['title']) ?>
                                </h3>
                                <p style="font-size:0.88rem;color:var(--ink-muted);">
                                    <?= esc(getTextSummary($intl_relations_feature['excerpt'], 200)) ?>
                                </p>
                                <div style="display:flex;align-items:center;gap:1rem;font-family:'Barlow',sans-serif;font-size:0.78rem;color:var(--ink-light);">
                                    <span><i class="ri-time-line"></i> <?= timeAgo($intl_relations_feature['created_at']) ?></span>
                                    <span class="source-badge"><?= esc($intl_relations_feature['source']) ?></span>
                                    <a href="<?= base_url('blog/' . $intl_relations_feature['slug']) ?>" class="read-more ms-auto">Read More <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </a>
                            <?php else: ?>
                            <div class="p-4 text-center" style="background:var(--paper-secondary); border-radius:12px;">
                                <i class="ri-hand-heart-line" style="font-size:2rem; color:var(--ink-light);"></i>
                                <p class="mt-2 text-muted mb-0">No international relations articles available at the moment.</p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-5">
                            <?php if (!empty($intl_relations_list)): ?>
                                <?php foreach ($intl_relations_list as $item): ?>
                                    <?php 
                                        $itemCat = getTableData('categories', ['category_id' => $item['category']], 'title');
                                        $sourceParts = explode(' ', trim($item['source']));
                                        $sourceClass = strtolower($sourceParts[0]); 
                                    ?>
                                    <div class="article-list-item">
                                        <img src="<?= esc($item['featured_image']) ?>" alt="<?= esc($item['title']) ?>" loading="lazy">
                                        
                                        <div class="content">
                                            <?php if ($itemCat): ?>
                                                <div class="category"><?= esc($itemCat) ?></div>
                                            <?php endif; ?>
                                            
                                            <h6>
                                                <a href="<?= base_url('blog/' . $item['slug']) ?>" 
                                                style="color: inherit; text-decoration: none; display: block;">
                                                    <?php 
                                                        echo esc(ucwords(strtolower($item['title']))); 
                                                    ?>
                                                </a>
                                            </h6>

                                            <div class="meta-row">
                                                <span><i class="ri-time-line"></i> <?= timeAgo($item['created_at']) ?></span>
                                                <span class="source-badge <?= $sourceClass ?>" style="font-size:0.65rem;">
                                                    <?= esc($item['source']) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="p-3 text-center" style="background:var(--paper-secondary); border-radius:8px;">
                                    <p class="text-muted mb-0 small">No recent articles</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Sports Section -->
                    <hr class="divider-rule">
                    <div class="section-title">
                        <i class="ri-football-line icon"></i> Sports
                    </div>
                    <div class="row g-3 mb-4">
                        <?php foreach ($sports_posts as $sport): ?>
                        <?php $sportCat = getTableData('categories', ['category_id' => $sport['category']], 'title'); ?>
                        <div class="col-sm-6">
                            <a href="<?= base_url('blog/' . $sport['slug']) ?>" class="d-block news-card">
                                <img src="<?= esc($sport['featured_image']) ?>" alt="<?= esc($sport['title']) ?>" loading="lazy">
                                <div class="news-card-body">
                                    <?php if ($sportCat): ?>
                                        <div class="category"><?= esc($sportCat) ?></div>
                                    <?php endif; ?>
                                    <h4><?= esc($sport['title']) ?></h4>
                                    <div class="news-card-footer">
                                        <span class="source-badge"><?= esc($sport['source']) ?></span>
                                        <span class="time-meta"><?= timeAgo($sport['created_at']) ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>

                        <?php if (empty($sports_posts)): ?>
                        <div class="col-12">
                            <p class="text-muted">No sports articles available at the moment.</p>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Opinion Section -->
                    <hr class="divider-rule">
                    <div class="section-title">
                        <i class="ri-quill-pen-line icon"></i> Opinion & Analysis
                    </div>
                    <div class="row g-3 mb-3">
                        <?php
                        if (!empty($opinion_posts)):
                            $opinionChunks = array_chunk($opinion_posts, 2);
                            foreach ($opinionChunks as $chunk): ?>
                                <div class="col-md-6">
                                    <?php foreach ($chunk as $op): 
                                        $opCat = getTableData('categories', ['category_id' => $op['category']], 'title');
                                    ?>
                                    <div class="opinion-card">
                                        <div class="author">
                                            <i class="ri-user-line"></i>
                                            <?= strtoupper(esc($op['author'])) ?> · <?= strtoupper(esc($op['source'])) ?>
                                        </div>
                                        
                                        <h6>
                                            <a href="<?= base_url('blog/' . $op['slug']) ?>" 
                                            class="text-decoration-none" 
                                            style="color: inherit; display: block;">
                                                <?php 
                                                    // Fixes the ALL CAPS database issue to elegant Title Case
                                                    echo esc(ucwords(strtolower($op['title']))); 
                                                ?>
                                            </a>
                                        </h6>
                                        
                                        <div class="source">
                                            <?= $opCat ? esc($opCat) . ' · ' : '' ?><?= esc($op['source']) ?>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <div class="col-12">
                                <p class="text-muted">No opinion articles available at the moment.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- /col-lg-8 -->

                <!-- ===== Right: Sidebar ===== -->
                <div class="col-lg-4">
                    <?= view("front-end/themes/$theme/includes/_rightSidebar") ?>
                </div>
                <!-- /sidebar -->

                <!-- ===== Infinite Scroll Section ===== -->
                <div class="col-12">
                    <?php
                        $apiKey = getTableData("api_accesses", ['assigned_to' => "default"], "api_key");
                        $infiniteScrollApiUrl = base_url('api/' . $apiKey . '/get-model-data');
                    ?>

                    <hr class="divider-rule">
                    <div class="section-title">
                        <i class="ri-refresh-line icon"></i> More News
                    </div>

                    <!-- Card container — HTMX appends pages here -->
                    <div class="row g-3 mb-4" id="infinite-scroll-container">
                        <!-- Cards loaded dynamically -->
                    </div>

                    <!-- Sentinel: when this enters the viewport, HTMX fires the next load -->
                    <div id="infinite-scroll-sentinel"
                        hx-get=""
                        hx-trigger="intersect once"
                        hx-target="#infinite-scroll-container"
                        hx-swap="beforeend"
                        hx-indicator="#infinite-scroll-spinner"
                        data-skip="0"
                        data-take="9"
                        data-api-url="<?= esc($infiniteScrollApiUrl) ?>"
                        data-total=""
                        data-loading="false">
                    </div>

                    <!-- Spinner shown during fetch -->
                    <div id="infinite-scroll-spinner" class="text-center py-4 htmx-indicator">
                        <div class="spinner-border spinner-border-sm text-secondary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span class="ms-2 text-muted small">Loading more articles…</span>
                    </div>

                    <!-- End-of-feed message (hidden until no more posts) -->
                    <div id="infinite-scroll-end" class="text-center py-4 text-muted small" style="display:none!important;">
                        <i class="ri-checkbox-circle-line me-1"></i> You're all caught up!
                    </div>

                <script>
                (function () {
                    const sentinel    = document.getElementById('infinite-scroll-sentinel');
                    const container   = document.getElementById('infinite-scroll-container');
                    const endMessage  = document.getElementById('infinite-scroll-end');
                    const infiniteSpinner  = document.getElementById('infinite-scroll-spinner');

                    if (!sentinel) return;

                    const API_URL  = sentinel.dataset.apiUrl;
                    const TAKE     = parseInt(sentinel.dataset.take, 10);
                    const MAX_RECORDS = <?= env("INFINITE_SCROLL_LIMIT", 200) ?>;
                    let   skip     = parseInt(sentinel.dataset.skip, 10);
                    let   total    = null;
                    let   loading  = false;
                    let   baseUrl = '<?= base_url() ?>';
                    let   loadedCount = 0;

                    // ── Helpers ──────────────────────────────────────────────────────────────

                    function timeAgo(dateStr) {
                        const now    = Date.now();
                        const then   = new Date(dateStr).getTime();
                        const diff   = Math.floor((now - then) / 1000);

                        if (diff < 60)         return 'just now';
                        if (diff < 3600)       return Math.floor(diff / 60)   + 'm ago';
                        if (diff < 86400)      return Math.floor(diff / 3600) + 'h ago';
                        if (diff < 2592000)    return Math.floor(diff / 86400) + 'd ago';
                        return new Date(dateStr).toLocaleDateString('en-GB', { day:'numeric', month:'short' });
                    }

                    function truncate(str, max) {
                        if (!str) return '';
                        const clean = str.replace(/<[^>]+>/g, '');
                        return clean.length <= max ? clean : clean.slice(0, max).trimEnd() + '…';
                    }

                    function buildCard(post) {
                        const img = post.featured_image
                            ? `<img src="${post.featured_image}" alt="${escAttr(post.title)}" loading="lazy">`
                            : `<img src="https://placehold.co/400x240/1a1a2e/ffffff?text=No+Image" alt="No image" loading="lazy">`;

                        const catBadge = post._category_title
                            ? `<div class="category">${esc(post._category_title)}</div>`
                            : '';

                        const excerpt = truncate(post.excerpt || post.ai_summary || '', 100);

                        return `
                        <div class="col-sm-6 col-md-4">
                            <a href="${baseUrl}/blog/${esc(post.slug)}" class="d-block news-card">
                                ${img}
                                <div class="news-card-body">
                                    ${catBadge}
                                    <h4>${esc(post.title)}</h4>
                                    <p>${esc(excerpt)}</p>
                                    <div class="news-card-footer">
                                        <span class="source-badge">${esc(post.source || '')}</span>
                                        <span class="time-meta">${timeAgo(post.created_at)}</span>
                                    </div>
                                </div>
                            </a>
                        </div>`;
                    }

                    function esc(str) {
                        if (!str) return '';
                        return String(str)
                            .replace(/&/g, '&amp;')
                            .replace(/</g, '&lt;')
                            .replace(/>/g, '&gt;')
                            .replace(/"/g, '&quot;')
                            .replace(/'/g, '&#039;');
                    }

                    function escAttr(str) { return esc(str); }

                    // ── Category title resolution ───────────────────────────────────────────
                    const catCache = {};

                    async function resolveCategoryTitles(posts) {
                        const unknownIds = [...new Set(
                            posts.map(p => p.category).filter(id => id && !(id in catCache))
                        )];

                        await Promise.all(unknownIds.map(async (id) => {
                            try {
                                const url = `${API_URL}`.replace(
                                    /get-model-data.*/, 
                                    `get-model-data?model=categories&where_clause=${encodeURIComponent(JSON.stringify({category_id: id}))}&take=1&skip=0`
                                );
                                const r = await fetch(url);
                                const j = await r.json();
                                catCache[id] = j?.data?.[0]?.title || '';
                            } catch {
                                catCache[id] = '';
                            }
                        }));

                        return posts.map(p => ({ ...p, _category_title: catCache[p.category] || '' }));
                    }

                    // ── Show "All caught up" message with link ──────────────────────────────
                    function showAllCaughtUp() {
                        // Remove sentinel
                        if (sentinel) sentinel.remove();
                        
                        // Hide default end message
                        endMessage.style.display = 'none';
                        infiniteSpinner.style.display = 'none';
                        
                        // Remove any existing messages
                        const existingMsg = document.querySelector('.caught-up-message');
                        if (existingMsg) existingMsg.remove();
                        
                        // Create custom message
                        const caughtUpMsg = document.createElement('div');
                        caughtUpMsg.className = 'col-12 text-center py-5 caught-up-message';
                        caughtUpMsg.innerHTML = `
                            <div class="py-4">
                                <i class="ri-checkbox-circle-line" style="font-size: 3rem; color: var(--success);"></i>
                                <h4 class="mt-3 mb-2">You're all caught up!</h4>
                                <p class="text-muted mb-4">You've viewed ${loadedCount} of the latest articles.</p>
                                <a href="${baseUrl}blogs" class="btn btn-outline-primary px-4">
                                    <i class="ri-article-line me-2"></i> Browse All Articles
                                </a>
                            </div>
                        `;
                        
                        container.parentNode.insertBefore(caughtUpMsg, container.nextSibling);
                    }

                    // ── Core fetch function ─────────────────────────────────────────────────
                    async function loadMore() {
                        if (loading) return;
                        if (loadedCount >= MAX_RECORDS) {
                            showAllCaughtUp();
                            return;
                        }
                        
                        if (total !== null && skip >= total) {
                            showAllCaughtUp();
                            return;
                        }

                        loading = true;
                        const spinner = document.getElementById('infinite-scroll-spinner');
                        if (spinner) spinner.classList.add('active');

                        try {
                            const remainingAllowed = MAX_RECORDS - loadedCount;
                            const takeThisBatch = Math.min(TAKE, remainingAllowed);
                            
                            const whereClause = encodeURIComponent(JSON.stringify({ status: "1" }));
                            const url = `${API_URL}?model=blogs&where_clause=${whereClause}&take=${takeThisBatch}&skip=${skip}&order_by=created_at&order_dir=DESC`;

                            const response = await fetch(url);
                            if (!response.ok) throw new Error(`HTTP ${response.status}`);

                            const json = await response.json();
                            if (json.status !== 'success') throw new Error('API error');

                            if (total === null) {
                                total = Math.min(parseInt(json.total, 10), MAX_RECORDS);
                            }

                            const posts = json.data || [];
                            if (posts.length === 0) {
                                showAllCaughtUp();
                                return;
                            }

                            const enriched = await resolveCategoryTitles(posts);
                            const html = enriched.map(buildCard).join('');
                            container.insertAdjacentHTML('beforeend', html);

                            skip += posts.length;
                            loadedCount += posts.length;

                            if (loadedCount >= MAX_RECORDS || skip >= total) {
                                showAllCaughtUp();
                            }

                        } catch (err) {
                            console.error('[InfiniteScroll] Error:', err);
                            const errorMsg = document.createElement('div');
                            errorMsg.className = 'col-12 text-center py-3';
                            errorMsg.innerHTML = `
                                <div class="alert alert-danger alert-sm">
                                    <i class="ri-error-warning-line me-1"></i> 
                                    Failed to load articles. 
                                    <button onclick="location.reload()" class="alert-link">Refresh</button>
                                </div>
                            `;
                            container.insertAdjacentHTML('beforeend', errorMsg.outerHTML);
                            if (sentinel) sentinel.remove();
                        } finally {
                            loading = false;
                            if (spinner) spinner.classList.remove('active');
                        }
                    }

                    // ── IntersectionObserver ────────────────────────────────────────────────
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting && loadedCount < MAX_RECORDS) {
                                loadMore();
                            }
                        });
                    }, { rootMargin: '200px' });

                    observer.observe(sentinel);
                    
                    // Load initial batch
                    loadMore();
                })();
                </script>
                </div>
                <!-- ===== /Infinite Scroll Section ===== -->

            </div>
            <!-- /row -->
        </div>
    </section>
<!-- ////// END Home Pages ///// -->


<!-- end main content -->
<?= $this->endSection() ?>