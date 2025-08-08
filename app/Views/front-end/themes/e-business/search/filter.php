<?php
// Get current theme impact
$theme = getCurrentTheme();

?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<section class="py-5 bg-light">
    <div class="container px-5">
        <!--Breadcrumb-->
        <div class="row mb-1">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search Results</li>
            </ol>
            </nav>
        </div>

        <div class="row gx-5">
            <div class="col-12">
                <?php 
                // Check if all search result arrays are empty
                $noResults = empty($blogsSearchResults) &&
                            empty($pagesSearchResults);
                
                // If no results, display a message
                if ($noResults): ?>
                        <div class="row mt-0">
                            <div class="col-12">
                                <h3>No Results Found</h3>
                                <p>Sorry, we couldn't find any content matching "<?= esc($searchQuery) ?>".</p>
                                <p>Try searching with different keywords or check your spelling.</p>
                            </div>
                        </div>
                <?php endif; ?>
            </div>
            <div class="col-12">
                <h1 class="fw-bolder fs-5 mb-4">Search Results</h1>
                <p class="mb-3">
                    Showing results for "<span class="text-danger"><?=$searchQuery?></span>"
                </p>

                <!-- Posts Results Widget -->
                <?php if(!empty($blogsSearchResults)): ?>
                    <div class="row">     
                    <h4>Blogs</h4>  
                    <?php foreach($blogsSearchResults as $blog): ?>
                        <div class="mb-4">
                            <div class="small text-muted"><?= dateFormat($blog['created_at'], 'M j, Y'); ?></div>
                            <a class="link-dark" href="<?= base_url('blog/'.$blog['slug']) ?>"><h3><?= $blog['title']; ?></h3></a>
                        </div>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Pages Results Widget -->
                <?php if(!empty($pagesSearchResults)): ?>
                    <div class="row">     
                        <h4>Pages</h4>  
                        <?php foreach($pagesSearchResults as $page): ?>
                            <div class="mb-4">
                            <div class="small text-muted"><?= dateFormat($page['created_at'], 'M j, Y'); ?></div>
                            <a class="link-dark" href="<?= base_url($page['slug']) ?>"><h3><?= $page['title']; ?></h3></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php 
                // If no results, display a message
                if (!$noResults): ?>
                    <hr>
                    <div class="row mt-5">
                        <div class="col-12">
                            <p>Did not find what you were looking for? Try searching with different keywords or check your spelling.</p>
                                <!-- Search Widget -->
                                <div class="search-widget widget-item">

                                    <h3 class="text-dark">Search</h3>
                                    <form action="<?= base_url('search') ?>" method="get">
                                        <input type="text" id="q" name="q" placeholder="Search for..." aria-label="Search for..." minlength="2" required class="form-control">
                                    </form>
                                </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- end main content -->
<?= $this->endSection() ?>