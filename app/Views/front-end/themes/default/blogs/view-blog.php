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
                <!-- Comments section-->
                <section id="comment" class="my-3">
                    <h2>Comments</h2>
                    <form action="<?= base_url('/api-form/add-comment') ?>" method="post" class="g-3 needs-validation" id="subscribeForm">
                        <?= csrf_field() ?>
                        <?=getHoneypotInput()?>

                        <!-- Hidden context fields -->
                        <input type="hidden" name="page_id" value="<?= $blog_data['blog_id']; ?>">
                        <input type="hidden" name="page_url" value="<?=current_url()?>">
                        <input type="hidden" name="return_url" value="<?=current_url()."?#comment"?>">

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            required
                            placeholder="Your name">
                            <div class="invalid-feedback">Please enter your name.</div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            required
                            placeholder="you@example.com">
                            <div class="invalid-feedback">Please provide a valid email address.</div>
                        </div>

                        <!-- Comment -->
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment <span class="text-danger">*</span></label>
                            <textarea
                            class="form-control"
                            id="comment"
                            name="comment"
                            rows="5"
                            required
                            placeholder="Write your comment here..."></textarea>
                            <div class="invalid-feedback">Please write a comment before submitting.</div>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember_me">
                            <label class="form-check-label" for="remember_me">
                            Save my name and email in this browser for the next time I comment.
                            </label>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary">Post Comment</button>
                    </form>

                        <!-- Optional: simple Bootstrap 5 validation & localStorage support -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                            const nameField  = document.getElementById('name');
                            const emailField = document.getElementById('email');
                            const remember   = document.getElementById('remember_me');

                            // Prefill if stored
                            if (localStorage.getItem('comment_name')) {
                                nameField.value  = localStorage.getItem('comment_name');
                            }
                            if (localStorage.getItem('comment_email')) {
                                emailField.value = localStorage.getItem('comment_email');
                            }

                                // Save on submit if checked
                                document.querySelector('form').addEventListener('submit', function() {
                                    if (remember.checked) {
                                    localStorage.setItem('comment_name', nameField.value);
                                    localStorage.setItem('comment_email', emailField.value);
                                    } else {
                                    localStorage.removeItem('comment_name');
                                    localStorage.removeItem('comment_email');
                                    }
                                });

                            });
                    </script>

                </section>
            </div>
            
            <div class="col-lg-4">
                <?= renderBlogSidebar($categories, $blogs, $blog_data) ?>
            </div>
        </div>
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