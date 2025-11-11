<?php
// Get current theme impact
$theme = getCurrentTheme();
?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<!-- Page Content -->
<section class="page py-5">
    <div class="container py-5">
        <!--Breadcrumb-->
        <div class="row mb-1">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item active text-secondary" aria-current="page">Search Results</li>
            </ol>
            </nav>
        </div>

        <?= renderSearchResults($searchQuery, $blogsSearchResults, $pagesSearchResults) ?>
    </div>
</section>

<?php if (ENVIRONMENT !== 'production'): ?>
<!-- 
CUSTOMIZATION NOTES:
-------------------
To customize the search results display without using the helper function:

1. REPLACE the helper function call above with your custom HTML
2. Available data variables:
   - $searchQuery: The original search term
   - $blogsSearchResults: Array of matching blog posts
   - $pagesSearchResults: Array of matching pages

Example custom display:
<div class="custom-search-results">
    <h1>Results for "<!= esc($searchQuery) ?>"</h1>
    <!php if(empty($blogsSearchResults) && empty($pagesSearchResults)): ?>
        <p>No results found.</p>
    <!php else: ?>
        <!== Your custom results layout ==>
    <!php endif; ?>
</div>

The helper function provides consistent, theme-independent styling.
Custom implementation gives full design control but requires manual styling.
-->
<?php endif; ?>

<!-- end main content -->
<?= $this->endSection() ?>