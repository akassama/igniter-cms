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

<!-- Page Content-->
<section class="py-5">
    <div class="container px-5 my-5">
        
        <!--Breadcrumb-->
        <div class="row mb-1">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url('/blogs')?>">Blogs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
            </ol>
            </nav>
        </div>

<div class="row">
    <div class="col-lg-8">
        <?= renderBlogContent($blog_data) ?>
        <hr>
        <section id="comment" class="my-3">
           <?= renderBlogComments($blog_data) ?>
        </section>
    </div>
    <div class="col-lg-4">
        <?= renderBlogSidebar($categories, $blogs, $blog_data) ?>
    </div>
</section>

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