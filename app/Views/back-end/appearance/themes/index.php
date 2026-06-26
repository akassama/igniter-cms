<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$userRole = getUserRole($sessionEmail);
?>

<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?= lang('App.manage_themes') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.appearance'))
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="container-fluid">
    <div class="col-12">
        <h3><?= lang('App.manage_themes') ?></h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/appearance/themes/upload-theme')?>" class="btn btn-outline-success mx-1">
            <i class="ri-upload-2-fill"></i> <?= lang('App.upload_theme') ?>
        </a>
        <a href="<?=base_url('/account/appearance/themes/install-themes')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> <?= lang('App.add_theme') ?>
        </a>
    </div>
    
    <?php
        $whereClause = ['selected' => '1'];
        $tableData = getTableData("themes", $whereClause, "selected");
        if(empty($tableData)){
            ?>
                <div class="alert alert-warning">
                    <?= lang('App.no_theme_selected_warning') ?>
                </div>
            <?php
        }

        $currentTheme = getCurrentTheme();
        $missingPlugins = getMissingPluginsForActiveTheme();
        if(!empty($missingPlugins)){
            ?>
                <div class="alert alert-danger">
                    <?= lang('App.missing_plugins_warning') ?> (<strong><?=$currentTheme?></strong>): 
                    <strong><?= implode(", ", $missingPlugins); ?></strong>. 
                    <?= lang('App.install_plugins_guidance') ?>
                </div>
            <?php
        }
    ?>

    <!-- THEME SEARCH INPUT -->
    <div class="row my-3">
        <div class="col-12">
            <div class="input-group">
                <input type="text" id="themeSearchInput" class="form-control" placeholder="Search themes by name, category, or author...">
                <span class="input-group-text"><i class="ri-search-line"></i></span>
            </div>
        </div>
    </div>
    
    <div class="row" id="themes-container">
        <?php if($themes): ?>
            <?php foreach($themes as $theme): ?>
            <!-- Added 'theme-card' class for easier JS targeting -->
            <div class="col-md-4 mb-4 theme-card" id="theme-<?= str_replace('/', '', $theme['path']); ?>">
                <div class="card h-100 border border-2 border-<?= $theme['selected'] == "1" ? 'success' : 'light' ?>">
                    <div class="card-img-top ratio ratio-16x9 bg-light overflow-hidden border-bottom">
                        <a href="<?= $theme['theme_url']; ?>" target="_blank">
                            <img loading="lazy" src="<?= base_url('/public/front-end/themes/'.$theme['path'].'/assets/images/preview.png'); ?>" alt="<?= $theme['name']; ?>" class="img-fluid w-100 h-100 theme-preview-img">
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php if($theme['selected'] == "1"): ?>
                                <span class="text-muted"><?=lang('App.active')?>:</span> 
                            <?php endif; ?>
                            <?= $theme['name']; ?>
                        </h5>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <?php if($theme['selected'] != "1"): ?>
                                <a href="<?=base_url('account/appearance/themes/activate/'.$theme['theme_id'])?>" 
                                class="btn btn-sm btn-primary">Activate</a>
                            <?php else: ?>
                                <span class="btn btn-sm btn-success disabled-btn disabled"><?= lang('App.active') ?></span>
                            <?php endif; ?>
                            
                            <a href="<?=base_url('account/appearance/themes/edit-theme/'.$theme['theme_id'])?>" 
                            class="btn btn-sm btn-outline-secondary"><?=lang('App.customize')?></a>
                            
                            <?php if ($theme['deletable'] == 1 && $theme['selected'] !== "1"): ?>
                                <a href="#!" 
                                onclick="deleteTheme('<?=$theme['path']?>', '<?= $theme['theme_id'] ?>')" 
                                class="btn btn-sm btn-outline-danger ms-auto"><?=lang('App.delete')?></a>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Added 'theme-meta-info' class for easier JS targeting -->
                        <div class="text-muted small theme-meta-info">
                            <div class="mb-1">
                                <span class="me-2"><i class="ri-price-tag-3-line"></i> <?= $theme['category']; ?></span>
                                <span class="me-2"><i class="ri-user-line"></i> By <?= getActivityBy(esc($theme['created_by']), ""); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info">
                    No themes found. <a href="<?=base_url('/account/appearance/themes/install-themes')?>" class="alert-link">Add your first theme</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- NO SEARCH RESULTS MESSAGE -->
    <div id="no-theme-search-results" class="col-12 alert alert-info mt-3" style="display: none;">
        No themes match your search criteria.
    </div>
</div>

<script>
    function deleteTheme(themePath, themeId) {
        Swal.fire({
            title: <?= json_encode(lang('App.confirm_remove_theme')) ?>,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: <?= json_encode(lang('App.yes')) ?>,
            cancelButtonText: <?= json_encode(lang('App.no')) ?>
        }).then((result) => {
            if (result.isConfirmed) {
                // Create the form element
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `<?= base_url('/account/appearance/themes/remove-theme') ?>`;

                // Add hidden input fields
                const themePathInput = document.createElement('input');
                themePathInput.type = 'hidden';
                themePathInput.name = 'theme_path';
                themePathInput.value = themePath;
                form.appendChild(themePathInput);

                const themeIdInput = document.createElement('input');
                themeIdInput.type = 'hidden';
                themeIdInput.name = 'theme_id';
                themeIdInput.value = themeId;
                form.appendChild(themeIdInput);

                // Append the form to the body and submit it
                document.body.appendChild(form);
                form.submit();

                // Remove the form from the body after submit (optional)
                document.body.removeChild(form);
            }
        });
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ==========================================
    // 1. Existing URL Parameter Highlight Logic
    // ==========================================
    const urlParams = new URLSearchParams(window.location.search);
    
    if (urlParams.has('tid') && urlParams.get('tid')) {
        const themeId = urlParams.get('tid');
        const themeCardId = 'theme-' + themeId; 
        const targetElement = document.getElementById(themeCardId);

        if (targetElement) {
            targetElement.classList.add('highlight-theme');
            targetElement.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            
            setTimeout(() => {
                targetElement.classList.remove('highlight-theme');
            }, 5000);
        }
    }

    // ==========================================
    // 2. Client-Side Theme Search Functionality
    // ==========================================
    const searchInput = document.getElementById('themeSearchInput');
    const themeCards = document.querySelectorAll('#themes-container .theme-card');
    const noResultsMsg = document.getElementById('no-theme-search-results');

    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase().trim();
            let visibleCount = 0;

            themeCards.forEach(function(card) {
                // Extract text only from the title and meta info to avoid matching button text (e.g., "Activate", "Delete")
                const titleEl = card.querySelector('.card-title');
                const metaEl = card.querySelector('.theme-meta-info');
                
                const title = titleEl ? titleEl.textContent.toLowerCase() : '';
                const meta = metaEl ? metaEl.textContent.toLowerCase() : '';

                // Combine searchable text
                const searchText = title + ' ' + meta;

                // Show or hide the card based on the search term
                if (searchText.includes(searchTerm)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Toggle the "No results found" message
            if (visibleCount === 0 && searchTerm !== '') {
                noResultsMsg.style.display = 'block';
            } else {
                noResultsMsg.style.display = 'none';
            }
        });
    }
});
</script>

<style>
    /* Minimal custom CSS */
    .object-fit-cover {
        object-fit: cover;
    }

    /* CSS to visually highlight the element */
    .highlight-theme {
        box-shadow: 0 0 20px 5px rgba(139, 42, 13, 0.75);
        transition: box-shadow 0.5s ease-in-out;
        border-radius: 0.25rem;
    }

    .highlight-theme > .card {
        border-color: #d13f13 !important;
        border-width: 2px !important;
    }

    .theme-preview-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
</style>

<!-- end main content -->
<?= $this->endSection() ?>