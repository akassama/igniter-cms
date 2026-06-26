<?php
// Get current theme impact
$theme = getCurrentTheme();
$currentPage = "blogs";
?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light mt-md-3 mt-sm-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?= base_url() ?>" class="text-decoration-none text-primary">Home</a>
                </li>
                <li class="breadcrumb-item active text-secondary" aria-current="page">Blogs</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Blogs Page Content -->
<section class="page py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-3">Latest Blog Posts</h2>
                <p class="lead">Insights and updates from our team</p>
            </div>
        </div>

        <?= renderBlogsGrid($blogs) ?>

        <!-- Pagination -->
        <?php if ($total_blogs > intval(env('PAGINATE_LOW', 20))): ?>
            <div class="text-center mt-5">
                <?= $pager->links('default', 'bootstrap_pagination') ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php if (ENVIRONMENT !== 'production'): ?>
<!-- 
CUSTOMIZATION NOTES:
-------------------
To customize the blogs grid display without using the helper function:

1. REPLACE the helper function call above with your custom HTML
2. Available data variables:
   - $blogs: Array of blog posts with pagination
   - $pager: Pagination object
   - $total_blogs: Total number of blogs

Example custom display:
<div class="custom-blogs-grid">
    <!php foreach($blogs as $blog): ?>
        <!== Your custom blog card HTML ==>
    <!php endforeach; ?>
</div>

The helper function provides theme-agnostic styling with Unicode icons.
Remove it only if you need complete design control or framework-specific styling.
-->
<?php endif; ?>

<?= $this->endSection() ?>