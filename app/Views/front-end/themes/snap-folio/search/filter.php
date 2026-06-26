<?php
// Get current theme impact
$theme = getCurrentTheme();

?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<!-- Page Title -->
<div class="page-title dark-background">
  <div class="container d-lg-flex justify-content-between align-items-center">
    <h1 class="mb-2 mb-lg-0">Search Results</h1>
    <nav class="breadcrumbs">
      <ol>
        <li><a href="<?=base_url()?>">Home</a></li>
        <li class="current">Search Results</li>
      </ol>
    </nav>
  </div>
</div>
<!-- End Page Title -->

<!-- Search Section -->
<section id="search-section" class="search-section section dark-background">
  <div class="container" data-aos="fade-up">
    <!-- Search Form -->
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8">
        <form class="search-form" action="<?= base_url('search') ?>" method="get">
          <div class="input-group">
            <input
              type="text"
              class="form-control"
              placeholder="Search..."
              name="q"
              id="q"
              value="<?= esc($searchQuery) ?>"
              minlength="2"
              required
            />
            <button class="btn btn-accent bg-dark" type="submit">
              <i class="bi bi-search text-white"></i>
            </button>
          </div>
        </form>
        <div class="search-meta mt-2 text-light">
          <p>Showing results for "<span class="text-accent"><?= esc($searchQuery) ?></span>"</p>
        </div>
      </div>
    </div>

    <!-- Search Results -->
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <?php 
        $noResults = empty($blogsSearchResults) && empty($pagesSearchResults);
        
        if ($noResults): ?>
          <div class="search-results-group mb-5">
            <h3 class="search-results-category mb-4">
              No Results Found
            </h3>
            <p class="text-light">Sorry, we couldn't find any content matching "<?= esc($searchQuery) ?>".</p>
            <p class="text-light">Try searching with different keywords or check your spelling.</p>
          </div>
        <?php else: ?>
          <!-- Blog Results -->
          <?php if(!empty($blogsSearchResults)): ?>
            <div class="search-results-group mb-5">
              <h3 class="search-results-category mb-4">
                <i class="bi bi-newspaper me-2"></i>Blog Posts
              </h3>

              <?php foreach($blogsSearchResults as $blog): ?>
                <div class="search-result-item mb-4">
                  <h4 class="search-result-title">
                    <a href="<?= base_url('blog/'.$blog['slug']) ?>" class="text-white"><?= $blog['title'] ?></a>
                  </h4>
                  <div class="search-result-meta text-light small mb-2">
                    <span class="me-3"><i class="bi bi-calendar me-1"></i> <?= dateFormat($blog['created_at'], 'M j, Y'); ?></span>
                    <?php if(!empty($blog['tags'])): ?>
                      <span><i class="bi bi-tags me-1"></i> <?= $blog['tags'] ?></span>
                    <?php endif; ?>
                  </div>
                  <?php if(!empty($blog['content'])): ?>
                    <p class="search-result-excerpt">
                      <?= getTextSummary(strip_tags($blog['content']), 200) ?>
                    </p>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <!-- Pages Results -->
          <?php if(!empty($pagesSearchResults)): ?>
            <div class="search-results-group mb-5">
              <h3 class="search-results-category mb-4">
                <i class="bi bi-file-earmark me-2"></i>Pages
              </h3>

              <?php foreach($pagesSearchResults as $page): ?>
                <div class="search-result-item mb-4">
                  <h4 class="search-result-title">
                    <a href="<?= base_url($page['slug']) ?>" class="text-white"><?= $page['title'] ?></a>
                  </h4>
                  <div class="search-result-meta text-light small mb-2">
                    <span class="me-3"><i class="bi bi-calendar me-1"></i> <?= dateFormat($page['created_at'], 'M j, Y'); ?></span>
                  </div>
                  <?php if(!empty($page['excerpt'])): ?>
                    <p class="search-result-excerpt">
                      <?= getTextSummary(strip_tags($page['excerpt']), 200) ?>
                    </p>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <!-- No Results Help -->
          <div class="search-results-group mb-5">
            <p class="text-light">Did not find what you were looking for? Try searching with different keywords or check your spelling.</p>
          </div>
        <?php endif; ?>

        <!-- Pagination (if applicable) -->
        <!--
        <nav aria-label="Search results pagination" class="mt-5">
          <ul class="pagination justify-content-center">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>
        -->
      </div>
    </div>
  </div>
</section>

<!-- end main content -->
<?= $this->endSection() ?>