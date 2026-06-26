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

        <?= renderFilterSearchResults($searchQuery, $blogsSearchResults, $pagesSearchResults, $type ?? '') ?>
    </div>
</section>

<?php if (ENVIRONMENT !== 'production'): ?>
<!-- 
CUSTOMIZATION NOTES:
-------------------
To customize the filter search results display without using the helper function:

1. REPLACE the helper function call above with your custom HTML
2. Available data variables:
   - $searchQuery: The search term
   - $blogsSearchResults: Array of blog posts matching the filter
   - $pagesSearchResults: Array of pages matching the filter  
   - $type: Filter type ('category', 'tag', 'author')

Example custom display:
<!php if (!empty($blogsSearchResults)): ?>
    <div class="custom-results">
        <!php foreach($blogsSearchResults as $blog): ?>
            <!== Your custom blog result HTML ==>
        <!php endforeach; ?>
    </div>
<!php endif; ?>

The helper function provides theme-agnostic styling with Unicode icons.
Remove it only if you need complete design control or framework-specific styling.
-->
<?php endif; ?>

<!-- end main content -->
<?= $this->endSection() ?>