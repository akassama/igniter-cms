<?php
// Get current theme impact
$theme = getCurrentTheme();

//page settings
$currentPage = "blogs";
$popUpWhereClause = ['status' => 1];

//update view count
updateTotalViewCount("blogs", "blog_id", $blog_data['blog_id']);
?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<!-- Page Title -->
<div class="page-title dark-background">
  <div class="container d-lg-flex justify-content-between align-items-center">
    <h1 class="mb-2 mb-lg-0"><?= $blog_data['title'] ?></h1>
    <nav class="breadcrumbs">
      <ol>
        <li><a href="<?=base_url()?>">Home</a></li>
        <li><a href="<?=base_url('/blogs')?>">Blogs</a></li>
        <li class="current">Blog Details</li>
      </ol>
    </nav>
  </div>
</div>
<!-- End Page Title -->

<!-- Starter Section Section -->
<section id="starter-section" class="starter-section section">
  <div class="row">
    <div class="col-lg-8">
      <!-- Blog Details Section -->
      <section id="blog-details" class="blog-details section">
        <div class="container">
          <article class="article">
            <div class="post-img">
              <img src="<?= getImageUrl(($blog_data['featured_image']) ?? getDefaultImagePath())?>" alt="<?= $blog_data['title'] ?>" class="img-fluid" />
            </div>

            <h2 class="title"><?= $blog_data['title'] ?></h2>

            <div class="meta-top">
              <ul>
                <li class="d-flex align-items-center">
                  <i class="bi bi-person"></i>
                  <a href="<?= base_url('/search/filter/?type=author&key='.getUserData($blog_data['created_by'], "username"))?>">
                    <img loading="lazy" src="<?=getImageUrl(getUserData($blog_data['created_by'], "profile_picture") ?? getDefaultProfileImagePath())?>" class="rounded-circle" alt="<?= $blog_data['title'] ?>" width="22" height="22">
                    <?= getActivityBy(esc($blog_data['created_by'])); ?>
                  </a>
                </li>
                <li class="d-flex align-items-center">
                  <i class="bi bi-clock"></i>
                  <a href="javascript:void(0);"><time datetime="<?= $blog_data['created_at'] ?>"><?= dateFormat($blog_data['created_at'], 'F j, Y'); ?></time></a>
                </li>
                <li class="d-flex align-items-center">
                  <i class="bi bi-chat-dots"></i>
                  <a href="<?= base_url('blog/'.$blog_data['slug']) ?>#comments">Comments</a>
                </li>
              </ul>
            </div>
            <!-- End meta top -->

            <div class="content">
              <?= $blog_data['content'] ?>
            </div>
            <!-- End post content -->

            <div class="meta-bottom">
              <i class="bi bi-folder"></i>
              <ul class="cats">
                <?php $categoryName = !empty($blog_data['category']) ? getBlogCategoryName($blog_data['category']) : ""; ?>
                <li><a href="<?= base_url('/search/filter/?type=category&key='.$categoryName) ?>"><?= $categoryName?></a></li>
              </ul>

              <i class="bi bi-tags"></i>
              <ul class="tags">
                <?php
                  $tags = $blog_data['tags'];
                  $tagsArray = explode(',', $tags);
                  
                  foreach ($tagsArray as $tag) {
                    $tag = htmlspecialchars(trim($tag));
                    echo '<li><a href="'.base_url("/search/filter/?type=tag&key=$tag").'">' . $tag . '</a></li>';
                  }
                ?>
              </ul>
            </div>
            <!-- End meta bottom -->
          </article>
        </div>
      </section>
      <!-- /Blog Details Section -->

      <!-- Blog Comments Section -->
      <section id="comments" class="blog-comments section">
        <div class="container">
          <h4 class="comments-count">Comments</h4>
          <!-- Comment Script would go here -->
        </div>
      </section>
      <!-- /Blog Comments Section -->

      <!-- Comment Form Section -->
      <section id="comment-form" class="comment-form section">
        <div class="container">
          <form action="">
            <h4>Post Comment</h4>
            <p>
              Your email address will not be published. Required fields
              are marked *
            </p>
            <div class="row">
              <div class="col-md-6 form-group">
                <input
                  name="name"
                  type="text"
                  class="form-control"
                  placeholder="Your Name*"
                />
              </div>
              <div class="col-md-6 form-group">
                <input
                  name="email"
                  type="text"
                  class="form-control"
                  placeholder="Your Email*"
                />
              </div>
            </div>
            <div class="row">
              <div class="col form-group">
                <input
                  name="website"
                  type="text"
                  class="form-control"
                  placeholder="Your Website"
                />
              </div>
            </div>
            <div class="row">
              <div class="col form-group">
                <textarea
                  name="comment"
                  class="form-control"
                  placeholder="Your Comment*"
                ></textarea>
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">
                Post Comment
              </button>
            </div>
          </form>
        </div>
      </section>
      <!-- /Comment Form Section -->
    </div>

    <div class="col-lg-4 sidebar">
      <div class="widgets-container">
        <!-- Blog Author Widget -->
        <div class="blog-author-widget widget-item">
          <div class="d-flex flex-column align-items-center">
            <img
              src="<?=getImageUrl(getUserData($blog_data['created_by'], "profile_picture") ?? getDefaultProfileImagePath())?>"
              class="rounded-circle flex-shrink-0"
              alt="<?= getActivityBy(esc($blog_data['created_by'])); ?>"
            />
            <h4><?= getActivityBy(esc($blog_data['created_by'])); ?></h4>
             <?php
                  $authorBio = getUserData($blog_data['created_by'], "about_summary");
                  $authorTwitterLink = getUserData($blog_data['created_by'], "twitter_link");
                  $authorFacebookLink= getUserData($blog_data['created_by'], "facebook_link");
                  $authorInstagramLink= getUserData($blog_data['created_by'], "instagram_link");
                  $authorLinkedinLink= getUserData($blog_data['created_by'], "linkedin_link");
                  $authorGitHubLink= "https://github.com/akassama";
              ?>
            <div class="social-links">
              <a href="<?=$authorGitHubLink?>"><i class="bi bi-github"></i></a>
              <a href="<?=$authorLinkedinLink?>"><i class="bi bi-linkedin"></i></a>
              <!-- <a href="<?=$authorTwitterLink?>"><i class="bi bi-twitter-x"></i></a>
              <a href="<?=$authorGitHubLink?>"><i class="bi bi-github"></i></a>
              <a href="<?=$authorInstagramLink?>"><i class="bi bi-instagram"></i></a> -->
            </div>
            <p>
              <?=$authorBio?>
            </p>
          </div>
        </div>
        <!--/Blog Author Widget -->

        <!-- Search Widget -->
        <div class="search-widget widget-item">
          <h3 class="widget-title">Search</h3>
          <form action="<?= base_url('search') ?>" method="get">
            <input type="text" id="q" name="q" placeholder="Enter search term..." minlength="2" required />
            <button type="submit" title="Search">
              <i class="bi bi-search"></i>
            </button>
          </form>
        </div>
        <!--/Search Widget -->

        <!-- Categories Widget -->
        <div class="categories-widget widget-item">
          <h3 class="widget-title">Categories</h3>
          <div class="row">
            <?php if ($categories) : ?>
              <?php
                $totalCategories = count($categories);
                $halfCategories = ceil($totalCategories / 2);
                $firstHalf = array_slice($categories, 0, $halfCategories);
                $secondHalf = array_slice($categories, $halfCategories);
              ?>

              <div class="col-sm-6">
                <ul class="list-unstyled mb-0">
                  <?php foreach ($firstHalf as $category) : ?>
                    <?php $whereClause = "category = '" . $category['category_id'] . "'"; ?>
                    <li><a href="<?= base_url('/search/filter/?type=category&key='.$category['title']) ?>"><?= $category['title'] ?> <span>(<?= getTotalRecords('blogs', $whereClause) ?>)</span></a></li>
                  <?php endforeach; ?>
                </ul>
              </div>

              <div class="col-sm-6">
                <ul class="list-unstyled mb-0">
                  <?php foreach ($secondHalf as $category) : ?>
                    <?php $whereClause = "category = '" . $category['category_id'] . "'"; ?>
                    <li><a href="<?= base_url('/search/filter/?type=category&key='.$category['title']) ?>"><?= $category['title'] ?> <span>(<?= getTotalRecords('blogs', $whereClause) ?>)</span></a></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <!--/Categories Widget -->

        <!-- Recent Posts Widget -->
        <div class="recent-posts-widget widget-item">
          <h3 class="widget-title">Recent Posts</h3>
          <?php if ($blogs): ?>
            <?php foreach ($blogs as $blog): ?>
              <?php 
                $categoryName = !empty($blog['category']) ? getBlogCategoryName($blog['category']) : "Uncategorized"; 
              ?>
              <div class="post-item">
                <div class="d-flex">
                  <div class="flex-shrink-0 me-3">
                    <img src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>" 
                      alt="<?= esc($blog['title']) ?>" 
                      class="rounded" 
                      style="width: 60px; height: 60px; object-fit: cover;">
                  </div>
                  <div>
                    <h4>
                      <a href="<?= base_url('blog/'.$blog['slug']) ?>"><?= esc($blog['title']) ?></a>
                    </h4>
                    <time datetime="<?= $blog['created_at'] ?>"><?= dateFormat($blog['created_at'], 'M j, Y'); ?></time>
                    <div class="text-muted"><?= esc($categoryName) ?></div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="text-muted">No recent posts available.</p>
          <?php endif; ?>
        </div>
        <!--/Recent Posts Widget -->

        <!-- Tags Widget -->
        <div class="tags-widget widget-item">
          <h3 class="widget-title">Tags</h3>
          <ul>
            <?php
              $tags = $blog_data['tags'];
              $tagsArray = explode(',', $tags);
              
              foreach ($tagsArray as $tag) {
                $tag = htmlspecialchars(trim($tag));
                echo '<li><a href="'.base_url("/search/filter/?type=tag&key=$tag").'">' . $tag . '</a></li>';
              }
            ?>
          </ul>
        </div>
        <!--/Tags Widget -->
      </div>
    </div>
  </div>
</section>
<!-- /Starter Section Section -->

<!-- end main content -->
<?= $this->endSection() ?>