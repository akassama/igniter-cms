<?php

if (!function_exists('renderSearchResults')) {
    function renderSearchResults($searchQuery, $blogsSearchResults, $pagesSearchResults)
    {
        // Check if all search result arrays are empty
        $noResults = empty($blogsSearchResults) && empty($pagesSearchResults);
        $totalResults = (!$noResults) ? (count($blogsSearchResults ?? []) + count($pagesSearchResults ?? [])) : 0;

        // Get theme colors
        $theme = getCurrentTheme();
        $default_color = getThemeData($theme, "default_color");
        $heading_color = getThemeData($theme, "heading_color");
        $accent_color = getThemeData($theme, "accent_color");
        $surface_color = getThemeData($theme, "surface_color");
        $contrast_color = getThemeData($theme, "contrast_color");
        $background_color = getThemeData($theme, "background_color");
        
        // Unicode icons
        $icons = [
            'search' => '&#128269;', // 🔍
            'heart' => '&#10084;&#65039;', // ❤️
            'document' => '&#128221;', // 📝
            'newspaper' => '&#128240;', // 📰
            'tag' => '&#127991;', // 🏷️
            'calendar' => '&#128197;', // 📅
            'funnel' => '&#128193;', // 📁
            'person' => '&#128100;', // 👤
            'hash' => '&#035;', // #
        ];
        
        ob_start();
        ?>
        <style>
        .sr-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
            font-family: system-ui, -apple-system, sans-serif;
            color: <?=$contrast_color?>;
        }
        .sr-grid {
            display: grid;
            gap: 2rem;
        }
        .sr-card {
            background: <?=$surface_color?>;
            border: 1px solid <?=$default_color?>20;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .sr-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        .sr-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        .sr-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: <?=$heading_color?>;
            margin: 0 0 1rem 0;
        }
        .sr-subtitle {
            font-size: 1.25rem;
            color: <?=$contrast_color?>;
            margin: 0;
        }
        .sr-section {
            margin-bottom: 3rem;
        }
        .sr-section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: <?=$heading_color?>;
            margin: 0 0 1.5rem 0;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid <?=$default_color?>30;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .sr-list {
            display: grid;
            gap: 1rem;
        }
        .sr-list-item {
            display: block;
            background: <?=$surface_color?>;
            border: 1px solid <?=$default_color?>20;
            border-radius: 8px;
            padding: 1.5rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }
        .sr-list-item:hover {
            border-color: <?=$default_color?>;
            background: <?=$background_color?>;
            transform: translateX(4px);
        }
        .sr-item-header {
            display: flex;
            justify-content: between;
            align-items: start;
            margin-bottom: 0.75rem;
            gap: 1rem;
        }
        .sr-item-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: <?=$heading_color?>;
            margin: 0;
            flex: 1;
        }
        .sr-badge {
            background: <?=$accent_color?>;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .sr-item-desc {
            color: <?=$contrast_color?>;
            margin: 0 0 0.5rem 0;
            line-height: 1.5;
        }
        .sr-item-url {
            color: <?=$default_color?>;
            font-size: 0.875rem;
            margin: 0;
        }
        .sr-blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .sr-blog-card {
            background: <?=$surface_color?>;
            border: 1px solid <?=$default_color?>20;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .sr-blog-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        .sr-blog-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        .sr-blog-content {
            padding: 1.5rem;
        }
        .sr-blog-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }
        .sr-blog-category {
            background: <?=$default_color?>;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .sr-blog-date {
            color: <?=$contrast_color?>;
            font-size: 0.875rem;
        }
        .sr-blog-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: <?=$heading_color?>;
            margin: 0 0 0.75rem 0;
            line-height: 1.4;
        }
        .sr-blog-excerpt {
            color: <?=$contrast_color?>;
            margin: 0 0 1.25rem 0;
            line-height: 1.5;
        }
        .sr-button {
            display: inline-block;
            background: <?=$default_color?>;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .sr-button:hover {
            background: <?=$accent_color?>;
            transform: translateY(-1px);
        }
        .sr-button-outline {
            background: transparent;
            border: 2px solid <?=$default_color?>;
            color: <?=$default_color?>;
        }
        .sr-button-outline:hover {
            background: <?=$default_color?>;
            color: white;
        }
        .sr-form {
            width: 100%;
        }
        .sr-input {
            width: 100%;
            padding: 1rem;
            border: 2px solid <?=$default_color?>30;
            border-radius: 8px;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            transition: border-color 0.3s ease;
        }
        .sr-input:focus {
            outline: none;
            border-color: <?=$default_color?>;
        }
        .sr-icon {
            font-size: 1.2em;
            line-height: 1;
        }
        .sr-icon-large {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }
        .sr-center {
            text-align: center;
        }
        .sr-count {
            color: <?=$accent_color?>;
            font-weight: 600;
        }
        .sr-highlight {
            color: <?=$accent_color?>;
            font-weight: 600;
        }
        </style>

        <div class="sr-container">
            <?php if ($noResults): ?>
                <!-- No Results Found -->
                <div class="sr-header">
                    <h1 class="sr-title">No Results Found</h1>
                    <p class="sr-subtitle">Sorry, we couldn't find any content matching "<strong><?= esc($searchQuery) ?></strong>".</p>
                </div>

                <!-- Search Suggestion Card -->
                <div class="sr-grid">
                    <div class="sr-card sr-center">
                        <span class="sr-icon sr-icon-large"><?= $icons['heart'] ?></span>
                        <h2 style="font-size: 1.75rem; margin: 0 0 1rem 0; color: <?=$heading_color?>;">Not the results you were looking for?</h2>
                        <p style="margin: 0 0 2rem 0; color: <?=$contrast_color?>;">Help us improve your search experience by telling us what you were looking for.</p>
                        <form action="<?= base_url('search') ?>" method="get" class="sr-form">
                            <input type="text" name="q" class="sr-input" placeholder="What were you searching for?" value="<?= esc($searchQuery) ?>" required>
                            <button type="submit" class="sr-button">Search Again</button>
                        </form>
                    </div>
                </div>

            <?php else: ?>
                <!-- Search Header -->
                <div class="sr-header">
                    <h1 class="sr-title">Search Results for "<span class="sr-highlight"><?= esc($searchQuery) ?></span>"</h1>
                    <p class="sr-subtitle"><span class="sr-count"><?= $totalResults ?></span> result(s) found</p>
                </div>

                <!-- Pages Results -->
                <?php if (!empty($pagesSearchResults)): ?>
                    <div class="sr-section">
                        <h2 class="sr-section-title">
                            <span class="sr-icon"><?= $icons['document'] ?></span>
                            Pages
                        </h2>
                        <div class="sr-list">
                            <?php foreach ($pagesSearchResults as $page): ?>
                                <a href="<?= base_url($page['slug']) ?>" class="sr-list-item">
                                    <div class="sr-item-header">
                                        <h3 class="sr-item-title"><?= esc($page['title']) ?></h3>
                                        <span class="sr-badge">Page</span>
                                    </div>
                                    <p class="sr-item-desc">
                                        <?= !empty($page['excerpt']) ? esc(getTextSummary($page['excerpt'], 120)) : 'Learn more about this page.' ?>
                                    </p>
                                    <p class="sr-item-url"><?= base_url($page['slug']) ?></p>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Blogs Results -->
                <?php if (!empty($blogsSearchResults)): ?>
                    <div class="sr-section">
                        <h2 class="sr-section-title">
                            <span class="sr-icon"><?= $icons['newspaper'] ?></span>
                            Blog Posts
                        </h2>
                        <div class="sr-blog-grid">
                            <?php foreach ($blogsSearchResults as $blog): ?>
                                <div class="sr-blog-card">
                                    <a href="<?= base_url('blog/' . $blog['slug']) ?>">
                                        <img src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>"
                                             class="sr-blog-image"
                                             alt="<?= esc($blog['title']) ?>">
                                    </a>
                                    <div class="sr-blog-content">
                                        <div class="sr-blog-meta">
                                            <span class="sr-blog-category">
                                                <?= getBlogCategoryName($blog['category']) ?: 'Uncategorized' ?>
                                            </span>
                                            <span class="sr-blog-date">
                                                <span class="sr-icon"><?= $icons['calendar'] ?></span>
                                                <?= dateFormat($blog['created_at'], 'M j, Y') ?>
                                            </span>
                                        </div>
                                        <h3 class="sr-blog-title"><?= esc($blog['title']) ?></h3>
                                        <p class="sr-blog-excerpt">
                                            <?= getTextSummary($blog['excerpt'] ?? $blog['content'], 100) ?>
                                        </p>
                                        <a href="<?= base_url('blog/' . $blog['slug']) ?>" class="sr-button sr-button-outline">Read More</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Feedback Section -->
                <div class="sr-section">
                    <div class="sr-card sr-center">
                        <span class="sr-icon sr-icon-large"><?= $icons['search'] ?></span>
                        <h2 style="font-size: 1.75rem; margin: 0 0 1rem 0; color: <?=$heading_color?>;">Not what you were looking for?</h2>
                        <p style="margin: 0 0 2rem 0; color: <?=$contrast_color?>;">Help us improve your search experience.</p>
                        <form action="<?= base_url('search') ?>" method="get" class="sr-form">
                            <input type="text" name="q" class="sr-input" placeholder="Try a different search term" value="<?= esc($searchQuery) ?>">
                            <button type="submit" class="sr-button">Search Again</button>
                        </form>
                    </div>
                </div>

            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('renderFilterSearchResults')) {
    function renderFilterSearchResults($searchQuery, $blogsSearchResults, $pagesSearchResults, $type = '')
    {
        // Check if all search result arrays are empty
        $noResults = empty($blogsSearchResults) && empty($pagesSearchResults);
        $totalResults = (!$noResults) ? (count($blogsSearchResults ?? []) + count($pagesSearchResults ?? [])) : 0;
        
        $typeLabel = ucfirst($type);
        $typeIcon = match($type) {
            'category' => '&#127991;', // 🏷️
            'tag' => '&#035;', // #
            'author' => '&#128100;', // 👤
            default => '&#128193;' // 📁
        };

        // Get theme colors
        $theme = getCurrentTheme();
        $default_color = getThemeData($theme, "default_color");
        $heading_color = getThemeData($theme, "heading_color");
        $accent_color = getThemeData($theme, "accent_color");
        $surface_color = getThemeData($theme, "surface_color");
        $contrast_color = getThemeData($theme, "contrast_color");
        $background_color = getThemeData($theme, "background_color");
        
        // Unicode icons
        $icons = [
            'search' => '&#128269;', // 🔍
            'heart' => '&#10084;&#65039;', // ❤️
            'document' => '&#128221;', // 📝
            'newspaper' => '&#128240;', // 📰
            'tag' => '&#127991;', // 🏷️
            'calendar' => '&#128197;', // 📅
            'funnel' => '&#128193;', // 📁
            'person' => '&#128100;', // 👤
            'hash' => '&#035;', // #
        ];
        
        ob_start();
        ?>
        <style>
        .fr-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
            font-family: system-ui, -apple-system, sans-serif;
            color: <?=$contrast_color?>;
        }
        .fr-header {
            background: <?=$default_color?>;
            color: white;
            border-radius: 12px;
            padding: 2.5rem;
            margin-bottom: 3rem;
        }
        .fr-type-indicator {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 20px;
            padding: 0.75rem 1.25rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }
        .fr-title {
            font-size: 2.25rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            color: white;
        }
        .fr-subtitle {
            font-size: 1.125rem;
            margin: 0;
            opacity: 0.9;
            color: white;
        }
        .fr-highlight {
            color: #FFD700;
            font-weight: 600;
        }
        .fr-section {
            margin-bottom: 3rem;
        }
        .fr-section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: <?=$heading_color?>;
            margin: 0 0 1.5rem 0;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid <?=$default_color?>30;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .fr-count {
            background: <?=$accent_color?>;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-left: auto;
        }
        .fr-list {
            display: grid;
            gap: 1rem;
        }
        .fr-list-item {
            display: block;
            background: <?=$surface_color?>;
            border: 1px solid <?=$default_color?>20;
            border-radius: 8px;
            padding: 1.5rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }
        .fr-list-item:hover {
            border-color: <?=$default_color?>;
            background: <?=$background_color?>;
            transform: translateX(4px);
        }
        .fr-item-header {
            display: flex;
            justify-content: between;
            align-items: start;
            margin-bottom: 0.75rem;
            gap: 1rem;
        }
        .fr-item-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: <?=$heading_color?>;
            margin: 0;
            flex: 1;
        }
        .fr-badge {
            background: <?=$default_color?>;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .fr-item-desc {
            color: <?=$contrast_color?>;
            margin: 0 0 0.5rem 0;
            line-height: 1.5;
        }
        .fr-item-url {
            color: <?=$default_color?>;
            font-size: 0.875rem;
            margin: 0;
        }
        .fr-blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .fr-blog-card {
            background: <?=$surface_color?>;
            border: 1px solid <?=$default_color?>20;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .fr-blog-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        .fr-blog-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }
        .fr-blog-content {
            padding: 1.5rem;
        }
        .fr-blog-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }
        .fr-blog-category {
            background: <?=$default_color?>;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .fr-blog-date {
            color: <?=$contrast_color?>;
            font-size: 0.875rem;
        }
        .fr-blog-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: <?=$heading_color?>;
            margin: 0 0 0.75rem 0;
            line-height: 1.4;
        }
        .fr-blog-excerpt {
            color: <?=$contrast_color?>;
            margin: 0 0 1.25rem 0;
            line-height: 1.5;
        }
        .fr-button {
            display: inline-block;
            background: <?=$default_color?>;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .fr-button:hover {
            background: <?=$accent_color?>;
            transform: translateY(-1px);
        }
        .fr-button-outline {
            background: transparent;
            border: 2px solid <?=$default_color?>;
            color: <?=$default_color?>;
        }
        .fr-button-outline:hover {
            background: <?=$default_color?>;
            color: white;
        }
        .fr-form {
            width: 100%;
        }
        .fr-input {
            width: 100%;
            padding: 1rem;
            border: 2px solid <?=$default_color?>30;
            border-radius: 8px;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            transition: border-color 0.3s ease;
        }
        .fr-input:focus {
            outline: none;
            border-color: <?=$default_color?>;
        }
        .fr-icon {
            font-size: 1.2em;
            line-height: 1;
        }
        .fr-icon-large {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }
        .fr-center {
            text-align: center;
        }
        .fr-card {
            background: <?=$surface_color?>;
            border: 1px solid <?=$default_color?>20;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .fr-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        </style>

        <div class="fr-container">
            <?php if ($noResults): ?>
                <!-- No Results Found -->
                <div class="fr-header">
                    <div class="fr-type-indicator">
                        <span class="fr-icon"><?= $typeIcon ?></span>
                        <span><?= $typeLabel ?> Filter</span>
                    </div>
                    <h1 class="fr-title">No <?= $typeLabel ?> Results Found</h1>
                    <p class="fr-subtitle">No content found for "<strong><?= esc($searchQuery) ?></strong>" in <?= strtolower($typeLabel) ?>.</p>
                </div>

                <!-- Feedback Card -->
                <div class="fr-section">
                    <div class="fr-card fr-center">
                        <span class="fr-icon fr-icon-large"><?= $icons['funnel'] ?></span>
                        <h2 style="font-size: 1.75rem; margin: 0 0 1rem 0; color: <?=$heading_color?>;">Refine Your Search</h2>
                        <p style="margin: 0 0 2rem 0; color: <?=$contrast_color?>;">Try a different <?= strtolower($typeLabel) ?> or search with different criteria.</p>
                        <form action="<?= base_url('search') ?>" method="get" class="fr-form">
                            <input type="text" name="q" class="fr-input" placeholder="Try a different keyword" value="<?= esc($searchQuery) ?>">
                            <button type="submit" class="fr-button">Search Again</button>
                        </form>
                    </div>
                </div>

            <?php else: ?>
                <!-- Search Header -->
                <div class="fr-header">
                    <div class="fr-type-indicator">
                        <span class="fr-icon"><?= $typeIcon ?></span>
                        <span><?= $typeLabel ?> Filter</span>
                    </div>
                    <h1 class="fr-title"><?= $typeLabel ?>: "<span class="fr-highlight"><?= esc($searchQuery) ?></span>"</h1>
                    <p class="fr-subtitle"><?= $totalResults ?> result(s) found in <?= strtolower($typeLabel) ?></p>
                </div>

                <!-- Pages Results -->
                <?php if (!empty($pagesSearchResults)): ?>
                    <div class="fr-section">
                        <h2 class="fr-section-title">
                            <span class="fr-icon"><?= $icons['document'] ?></span>
                            Pages
                            <span class="fr-count"><?= count($pagesSearchResults) ?> result(s) found</span>
                        </h2>
                        <div class="fr-list">
                            <?php foreach ($pagesSearchResults as $page): ?>
                                <a href="<?= base_url($page['slug']) ?>" class="fr-list-item">
                                    <div class="fr-item-header">
                                        <h3 class="fr-item-title"><?= esc($page['title']) ?></h3>
                                        <span class="fr-badge">Page</span>
                                    </div>
                                    <p class="fr-item-desc">
                                        <?= !empty($page['excerpt']) ? esc(getTextSummary($page['excerpt'], 120)) : 'Learn more about this page.' ?>
                                    </p>
                                    <p class="fr-item-url"><?= base_url($page['slug']) ?></p>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Blogs Results -->
                <?php if (!empty($blogsSearchResults)): ?>
                    <div class="fr-section">
                        <h2 class="fr-section-title">
                            <span class="fr-icon"><?= $icons['newspaper'] ?></span>
                            Blog Posts
                            <span class="fr-count"><?= count($blogsSearchResults) ?> result(s) found</span>
                        </h2>
                        <div class="fr-blog-grid">
                            <?php foreach ($blogsSearchResults as $blog): ?>
                                <div class="fr-blog-card">
                                    <a href="<?= base_url('blog/' . $blog['slug']) ?>">
                                        <img src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>"
                                             class="fr-blog-image"
                                             alt="<?= esc($blog['title']) ?>">
                                    </a>
                                    <div class="fr-blog-content">
                                        <div class="fr-blog-meta">
                                            <span class="fr-blog-category">
                                                <?= getBlogCategoryName($blog['category']) ?: 'Uncategorized' ?>
                                            </span>
                                            <span class="fr-blog-date">
                                                <span class="fr-icon"><?= $icons['calendar'] ?></span>
                                                <?= dateFormat($blog['created_at'], 'M j, Y') ?>
                                            </span>
                                        </div>
                                        <h3 class="fr-blog-title"><?= esc($blog['title']) ?></h3>
                                        <p class="fr-blog-excerpt">
                                            <?= getTextSummary($blog['excerpt'] ?? $blog['content'], 100) ?>
                                        </p>
                                        <a href="<?= base_url('blog/' . $blog['slug']) ?>" class="fr-button fr-button-outline">Read More</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Final Feedback Section -->
                <div class="fr-section">
                    <div class="fr-card fr-center">
                        <span class="fr-icon fr-icon-large"><?= $icons['funnel'] ?></span>
                        <h2 style="font-size: 1.75rem; margin: 0 0 1rem 0; color: <?=$heading_color?>;">Need Different Results?</h2>
                        <p style="margin: 0 0 2rem 0; color: <?=$contrast_color?>;">Try searching with different criteria or browse all content.</p>
                        <form action="<?= base_url('search') ?>" method="get" class="fr-form">
                            <input type="text" name="q" class="fr-input" placeholder="Search again..." value="<?= esc($searchQuery) ?>">
                            <button type="submit" class="fr-button">Search</button>
                        </form>
                    </div>
                </div>

            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}