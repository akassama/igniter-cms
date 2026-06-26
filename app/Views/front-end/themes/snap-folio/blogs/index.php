<?php
// Get current theme impact
$theme = getCurrentTheme();

//pages settings
$currentPage = "blogs";
?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
<!-- Page Title -->
<div class="page-title dark-background">
  <div class="container d-lg-flex justify-content-between align-items-center">
    <h1 class="mb-2 mb-lg-0">Blogs</h1>
    <nav class="breadcrumbs">
      <ol>
        <li><a href="<?= base_url() ?>">Home</a></li>
        <li class="current">Blogs</li>
      </ol>
    </nav>
  </div>
</div>
<!-- End Page Title -->

<!-- Blog Section -->
<section id="starter-section" class="starter-section section">

  <!-- Blog Posts Section -->
  <section id="blog-posts" class="blog-posts section">
    <div class="container">
      <div class="row gy-4">

        <?php if ($blogs): ?>
          <?php foreach ($blogs as $blog): ?>
            <div class="col-lg-4">
              <article class="position-relative h-100">

                <!-- Featured Image -->
                <div class="post-img position-relative overflow-hidden">
                  <img 
                    src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>" 
                    class="img-fluid" 
                    alt="<?= esc($blog['title']); ?>" 
                  />
                  <span class="post-date"><?= dateFormat($blog['created_at'], 'M d, Y'); ?></span>
                </div>

                <!-- Post Content -->
                <div class="post-content d-flex flex-column">
                  <h3 class="post-title">
                    <?= esc($blog['title']); ?>
                  </h3>

                  <div class="meta d-flex align-items-center">
                    <div class="d-flex align-items-center">
                      <i class="bi bi-person"></i>
                      <span class="ps-2"><?= getActivityBy(esc($blog['created_by'])); ?></span>
                    </div>
                    <?php if (!empty($blog['category'])): ?>
                      <span class="px-3 text-black-50">/</span>
                      <div class="d-flex align-items-center">
                        <i class="bi bi-folder2"></i>
                        <span class="ps-2"><?= getBlogCategoryName($blog['category']); ?></span>
                      </div>
                    <?php endif; ?>
                  </div>

                  <p>
                    <?= !empty($blog['excerpt']) 
                        ? getTextSummary($blog['excerpt']) 
                        : getTextSummary($blog['content']); ?>
                  </p>

                  <hr />

                  <a href="<?= base_url('blog/'.$blog['slug']) ?>" class="readmore stretched-link">
                    <span>Read More</span><i class="bi bi-arrow-right"></i>
                  </a>
                </div>

              </article>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>

      </div>
    </div>
  </section>
  <!-- /Blog Posts Section -->

  <!-- Blog Pagination Section -->
  <?php if ($total_blogs > intval(env('PAGINATE_LOW', 20))): ?>
    <section id="blog-pagination" class="blog-pagination section">
      <div class="container">
        <div class="d-flex justify-content-center">
          <?= $pager->links('default', 'bootstrap') ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
  <!-- /Blog Pagination Section -->

</section>
<!-- /Starter Section -->


<!-- end main content -->
<?= $this->endSection() ?>