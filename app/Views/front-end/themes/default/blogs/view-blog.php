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
            <h2>Comments</h2>

            <div class="mb-5">
                <?php
                    use App\Models\CommentFormsModel;
                    $commentsModel = new CommentFormsModel();

                    // 1. Fetch only top-level comments (where it is NOT a reply)
                    $topLevelComments = $commentsModel
                        ->where('status', '1')
                        ->where('page_id', $blog_data['blog_id'])
                        ->where('is_reply', '0') // Filter for top-level comments
                        ->orWhere('is_reply IS NULL') // Include older comments without the field
                        ->where('page_id', $blog_data['blog_id']) // Re-apply page_id after orWhere
                        ->orderBy('created_at', 'DESC')
                        ->limit(intval(env('QUERY_LIMIT_500', 500)))
                        ->findAll();
                    
                    /**
                     * Helper function to fetch replies for a given comment ID
                     * @param string $parentCommentId
                     * @return array
                     */
                    function getCommentReplies($commentsModel, $parentCommentId) {
                        return $commentsModel
                            ->where('status', '1')
                            ->where('is_reply', '1')
                            ->where('reply_comment_form_id', $parentCommentId)
                            ->orderBy('created_at', 'ASC')
                            ->findAll();
                    }
                ?>
                
                <?php if ($topLevelComments): ?>
                    <?php foreach ($topLevelComments as $comment): ?>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?= getImageUrl($comment['gravatar'] ?? getDefaultImagePath()) ?>" 
                                    class="img-rounded" 
                                    alt="<?= esc($comment['name']) ?>"
                                    height="40" style="border-radius: 50%;"> </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-bold"><?=$comment['name']?></div>
                                <small class="text-muted"><?=dateFormat($comment['created_at'], 'F j, Y \a\t g:i A')?></small>
                                <p class="mt-1"><?= esc($comment['comment']) ?></p>
                                
                                <a href="javascript:void(0);" class="text-decoration-none small text-primary" data-bs-toggle="collapse" data-bs-target="#replyForm-<?=$comment['comment_form_id']?>" aria-expanded="false" aria-controls="replyForm-<?=$comment['comment_form_id']?>">
                                    <i class="bi bi-reply-fill me-1"></i> Reply
                                </a>

                                <div class="collapse mt-3" id="replyForm-<?=$comment['comment_form_id']?>">
                                    <h5 class="mb-2">Reply to <?=$comment['name']?></h5>
                                    <form action="<?= base_url('/api-form/add-comment') ?>" method="post" class="g-3 needs-validation reply-form">
                                        <?= csrf_field() ?>
                                        <?=getHoneypotInput()?>
                                        
                                        <input type="hidden" name="page_id" value="<?= $blog_data['blog_id']; ?>">
                                        <input type="hidden" name="page_url" value="<?=current_url()?>">
                                        <input type="hidden" name="return_url" value="<?=current_url()."?#comment"?>">
                                        
                                        <input type="hidden" name="is_reply" value="1">
                                        <input type="hidden" name="reply_comment_form_id" value="<?=$comment['comment_form_id']?>">

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" name="name" required placeholder="Your name">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="email" class="form-control" name="email" required placeholder="Email address">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <textarea class="form-control" name="comment" rows="3" required placeholder="Write your reply here..."></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-sm btn-success">Post Reply</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#replyForm-<?=$comment['comment_form_id']?>">Cancel</button>
                                    </form>
                                </div>
                                
                                <?php $replies = getCommentReplies($commentsModel, $comment['comment_form_id']); ?>
                                <?php if ($replies): ?>
                                    <div class="mt-4">
                                        <?php foreach ($replies as $reply): ?>
                                            <div class="d-flex mt-3">
                                                <div class="flex-shrink-0">
                                                    <img src="<?= getImageUrl($reply['gravatar'] ?? getDefaultImagePath()) ?>" 
                                                        class="img-rounded" 
                                                        alt="<?= esc($reply['name']) ?>"
                                                        height="40" style="border-radius: 50%;">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="fw-bold"><?=$reply['name']?> <span class="badge bg-secondary ms-2">Reply</span></div>
                                                    <small class="text-muted"><?=dateFormat($reply['created_at'], 'F j, Y \a\t g:i A')?></small>
                                                    <p class="mt-1"><?= esc($reply['comment']) ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr class="my-4">
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="alert alert-info">Be the first to leave a comment!</p>
                <?php endif; ?>
            </div>
            
            <h3 class="mb-3">Leave a Comment</h3>
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
                                <input class="form-check-input" type="checkbox" id="remember_me" name="remember_me" value="1">
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