<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Install Plugins<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Plugins', 'url' => '/account/plugins'),
    array('title' => 'Install Plugins')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Install Plugins</h3>
    </div>
    
    <!-- Search Form -->
    <div class="col-12 mb-4">
        <form class="d-flex" role="search" id="pluginSearchForm">
            <input class="form-control me-2" type="search" placeholder="Search plugins..." aria-label="Search" id="pluginSearch">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
    
    <!-- Error Message -->
    <?php if (isset($error)): ?>
        <div class="col-12">
            <div class="alert alert-danger"><?= esc($error) ?></div>
        </div>
    <?php endif; ?>
    
    <!-- Plugins Grid -->
    <div class="col-12">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($plugins as $plugin): ?>
                <div class="col">
                    <div class="card h-100">
                        <?php if (!empty($plugin['image'])): ?>
                            <img src="<?= esc($plugin['image']) ?>" class="card-img-top p-3" alt="<?= esc($plugin['name']) ?>" style="max-height: 200px; object-fit: contain;">
                        <?php else: ?>
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="ri-box-3-line fs-1 text-muted"></i>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($plugin['name']) ?> <span class="d-none"><?= esc($plugin['slug']) ?></span> </h5>
                            <h6 class="card-subtitle mb-2 text-muted">v<?= esc($plugin['version']) ?></h6>
                            <p class="card-text"><?= esc($plugin['description']) ?></p>
                            <p class="text-muted small mb-2">
                                <i class="ri-user-line"></i> <?= esc($plugin['author']) ?>
                            </p>
                            <p class="text-muted small mb-3">
                                <i class="ri-calendar-line"></i> Last updated: <?= esc($plugin['last_updated']) ?>
                            </p>
                        </div>
                        
                        <div class="card-footer bg-light border-top-0">
                            <?php
                                $ratingData = parseStarRating($plugin['rating'] ?? '0/5');
                                $isCompatible = checkCompatibility($plugin);
                                $formattedDate = formatLastUpdated($plugin['last_updated'] ?? null);
                                $installCount = $plugin['installs'] ?? rand(50, 200); // fallback if not in JSON
                            ?>
                            <div class="d-flex justify-content-between">
                                <a href="<?= esc($plugin['plugin_url']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="ri-information-line"></i> Details
                                </a>
                                <a href="<?= esc($plugin['download_url']) ?>" download class="btn btn-sm btn-success download-icon-btn" 
                                        data-plugin-name="<?= esc($plugin['name']) ?>"
                                        data-download-url="<?= esc($plugin['download_url']) ?>">
                                    <i class="ri-download-line"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
$(document).ready(function() {
    // Search functionality
    $('#pluginSearchForm').on('submit', function(e) {
        e.preventDefault();
        const searchTerm = $('#pluginSearch').val().toLowerCase();
        
        $('.col').each(function() {
            const pluginName = $(this).find('.card-title').text().toLowerCase();
            if (pluginName.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const query = params.get('q');

    if (query) {
        const input = document.getElementById('pluginSearch');
        const searchButton = document.querySelector('button[type="submit"].btn-outline-success');

        if (input) {
            input.value = decodeURIComponent(query);
        }

        // Optional delay to ensure input is populated before clicking
        if (searchButton) {
            setTimeout(() => {
                searchButton.click();
            }, 250); // 250ms delay
        }
    }
});
</script>


<!-- end main content -->
<?= $this->endSection() ?>