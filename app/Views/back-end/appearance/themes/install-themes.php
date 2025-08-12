<?= $this->extend('back-end/layout/_layout') ?>

<?= $this->section('title') ?>Themes<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Appearance', 'url' => '/account/appearance'),
    array('title' => 'Themes', 'url' => '/account/appearance/themes'),
    array('title' => 'New Theme')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="container-fluid px-4">
    <div class="row my-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Add New Theme</h1>
                <div>
                    <a href="<?=base_url('/account/appearance/themes/install-themes')?>" class="btn btn-outline-dark mx-1">
                        <i class="ri-restart-line"></i> Refresh Page
                    </a>
                    <a href="<?=base_url('/account/appearance/themes/upload-theme')?>" class="btn btn-outline-success mx-1">
                        <i class="ri-upload-2-fill"></i> Upload Theme
                    </a>
                </div>
            </div>
            
            <!-- Search Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form class="d-flex" role="search" id="themeSearchForm">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="ri-search-line"></i>
                            </span>
                            <input class="form-control border-start-0 ps-0" type="search" placeholder="Search themes..." aria-label="Search" id="themeSearch" minlength="2" required>
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Error Message -->
            <?php if (isset($error)): ?>
                <div class="col-12">
                    <div class="alert alert-danger"><?= esc($error) ?></div>
                </div>
            <?php endif; ?>
            
            <!-- Filter Tabs -->
            <ul class="nav nav-tabs mb-4" id="themeTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">All</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="popular-tab" data-bs-toggle="tab" data-bs-target="#popular" type="button" role="tab">Popular</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="latest-tab" data-bs-toggle="tab" data-bs-target="#latest" type="button" role="tab">Latest</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="featured-tab" data-bs-toggle="tab" data-bs-target="#featured" type="button" role="tab">Featured</button>
                </li>
            </ul>
            
            <!-- Themes Grid -->
            <div class="tab-content" id="themeTabsContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                        <?php foreach ($themes as $theme): ?>
                            <div class="col">
                                <div class="card theme-card h-100">
                                    <div class="theme-screenshot">
                                        <?php if (!empty($theme['image'])): ?>
                                            <img src="<?= esc($theme['image']) ?>" class="img-fluid" alt="<?= esc($theme['name']) ?>">
                                        <?php else: ?>
                                            <div class="theme-screenshot-placeholder bg-light d-flex align-items-center justify-content-center">
                                                <i class="ri-image-line fs-1 text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="card-body">
                                        <h3 class="theme-name h5"><?= esc($theme['name']) ?></h3>
                                        <div class="theme-actions d-flex justify-content-between align-items-center">
                                            <div class="theme-details">
                                                <span class="badge bg-light text-dark">v<?= esc($theme['version']) ?></span>
                                            </div>
                                            <div class="action-buttons">
                                                <a href="<?= esc($theme['theme_url']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="Preview">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="<?= esc($theme['download_url']) ?>" download class="btn btn-sm btn-primary download-icon-btn" 
                                                        data-theme-name="<?= esc($theme['name']) ?>"
                                                        data-download-url="<?= esc($theme['download_url']) ?>" title="Install">
                                                    <i class="ri-download-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer bg-transparent border-top-0">
                                        <div class="theme-meta text-muted small">
                                            <div class="d-flex justify-content-between">
                                                <span><i class="ri-user-line"></i> <?= esc($theme['author']) ?></span>
                                                <span><i class="ri-calendar-line"></i> <?= esc($theme['last_updated']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="popular" role="tabpanel" aria-labelledby="popular-tab">
                    <!-- Popular themes content -->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                        <?php foreach ($popularThemes as $theme): ?>
                            <div class="col">
                                <div class="card theme-card h-100">
                                    <div class="theme-screenshot">
                                        <?php if (!empty($theme['image'])): ?>
                                            <img src="<?= esc($theme['image']) ?>" class="img-fluid" alt="<?= esc($theme['name']) ?>">
                                        <?php else: ?>
                                            <div class="theme-screenshot-placeholder bg-light d-flex align-items-center justify-content-center">
                                                <i class="ri-image-line fs-1 text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="card-body">
                                        <h3 class="theme-name h5"><?= esc($theme['name']) ?></h3>
                                        <div class="theme-actions d-flex justify-content-between align-items-center">
                                            <div class="theme-details">
                                                <span class="badge bg-light text-dark">v<?= esc($theme['version']) ?></span>
                                            </div>
                                            <div class="action-buttons">
                                                <a href="<?= esc($theme['theme_url']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="Preview">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="<?= esc($theme['download_url']) ?>" download class="btn btn-sm btn-primary download-icon-btn" 
                                                        data-theme-name="<?= esc($theme['name']) ?>"
                                                        data-download-url="<?= esc($theme['download_url']) ?>" title="Install">
                                                    <i class="ri-download-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer bg-transparent border-top-0">
                                        <div class="theme-meta text-muted small">
                                            <div class="d-flex justify-content-between">
                                                <span><i class="ri-user-line"></i> <?= esc($theme['author']) ?></span>
                                                <span><i class="ri-calendar-line"></i> <?= esc($theme['last_updated']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="latest" role="tabpanel" aria-labelledby="latest-tab">
                    <!-- Latest themes content -->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                        <?php foreach ($latestThemes as $theme): ?>
                            <div class="col">
                                <div class="card theme-card h-100">
                                    <div class="theme-screenshot">
                                        <?php if (!empty($theme['image'])): ?>
                                            <img src="<?= esc($theme['image']) ?>" class="img-fluid" alt="<?= esc($theme['name']) ?>">
                                        <?php else: ?>
                                            <div class="theme-screenshot-placeholder bg-light d-flex align-items-center justify-content-center">
                                                <i class="ri-image-line fs-1 text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="card-body">
                                        <h3 class="theme-name h5"><?= esc($theme['name']) ?></h3>
                                        <div class="theme-actions d-flex justify-content-between align-items-center">
                                            <div class="theme-details">
                                                <span class="badge bg-light text-dark">v<?= esc($theme['version']) ?></span>
                                            </div>
                                            <div class="action-buttons">
                                                <a href="<?= esc($theme['theme_url']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="Preview">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="<?= esc($theme['download_url']) ?>" download class="btn btn-sm btn-primary download-icon-btn" 
                                                        data-theme-name="<?= esc($theme['name']) ?>"
                                                        data-download-url="<?= esc($theme['download_url']) ?>" title="Install">
                                                    <i class="ri-download-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer bg-transparent border-top-0">
                                        <div class="theme-meta text-muted small">
                                            <div class="d-flex justify-content-between">
                                                <span><i class="ri-user-line"></i> <?= esc($theme['author']) ?></span>
                                                <span><i class="ri-calendar-line"></i> <?= esc($theme['last_updated']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                    <!-- Featured themes content -->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                        <?php foreach ($featuredThemes as $theme): ?>
                            <div class="col">
                                <div class="card theme-card h-100">
                                    <div class="theme-screenshot">
                                        <?php if (!empty($theme['image'])): ?>
                                            <img src="<?= esc($theme['image']) ?>" class="img-fluid" alt="<?= esc($theme['name']) ?>">
                                        <?php else: ?>
                                            <div class="theme-screenshot-placeholder bg-light d-flex align-items-center justify-content-center">
                                                <i class="ri-image-line fs-1 text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="card-body">
                                        <h3 class="theme-name h5"><?= esc($theme['name']) ?></h3>
                                        <div class="theme-actions d-flex justify-content-between align-items-center">
                                            <div class="theme-details">
                                                <span class="badge bg-light text-dark">v<?= esc($theme['version']) ?></span>
                                            </div>
                                            <div class="action-buttons">
                                                <a href="<?= esc($theme['theme_url']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="Preview">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="<?= esc($theme['download_url']) ?>" download class="btn btn-sm btn-primary download-icon-btn" 
                                                        data-theme-name="<?= esc($theme['name']) ?>"
                                                        data-download-url="<?= esc($theme['download_url']) ?>" title="Install">
                                                    <i class="ri-download-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer bg-transparent border-top-0">
                                        <div class="theme-meta text-muted small">
                                            <div class="d-flex justify-content-between">
                                                <span><i class="ri-user-line"></i> <?= esc($theme['author']) ?></span>
                                                <span><i class="ri-calendar-line"></i> <?= esc($theme['last_updated']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .theme-card {
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }
    
    .theme-card:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .theme-screenshot {
        height: 180px;
        overflow: hidden;
        background-color: #f5f5f5;
        border-bottom: 1px solid #eee;
    }
    
    .theme-screenshot img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .theme-screenshot-placeholder {
        width: 100%;
        height: 100%;
    }
    
    .theme-name {
        margin-bottom: 0.5rem;
    }
    
    .theme-actions {
        margin-top: 1rem;
    }
    
    .theme-meta {
        margin-top: 0.5rem;
    }
    
    .nav-tabs .nav-link {
        color: #495057;
        font-weight: 500;
    }
    
    .nav-tabs .nav-link.active {
        color: #2271b1;
        border-bottom: 2px solid #2271b1;
    }
</style>

<script>
$(document).ready(function() {
    // Search functionality
    $('#themeSearchForm').on('submit', function(e) {
        e.preventDefault();
        const searchTerm = $('#themeSearch').val().toLowerCase();
        
        $('.col').each(function() {
            const themeName = $(this).find('.theme-name').text().toLowerCase();
            if (themeName.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const query = params.get('q');

    if (query) {
        const input = document.getElementById('themeSearch');
        const searchButton = document.querySelector('button[type="submit"].btn-primary');

        if (input) {
            input.value = decodeURIComponent(query);
        }

        if (searchButton) {
            setTimeout(() => {
                searchButton.click();
            }, 250);
        }
    }
});


$("#themeSearch").click(function(){
    $("#all-tab").click();
});
</script>

<?= $this->include('back-end/layout/modals/files_modal.php'); ?>

<?= $this->endSection() ?>