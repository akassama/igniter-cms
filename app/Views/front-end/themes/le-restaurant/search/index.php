<?php
// Get current theme impact
$theme = getCurrentTheme();

?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<section class="py-5 bg-light mt-5">
    <div class="container px-5">
        <!--Breadcrumb-->
        <div class="row mb-1 bg-light">
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
                $enableAppointmentsPage = getConfigData("EnableAppointmentsPage");
                // Check if all search result arrays are empty
                $noResults = empty($blogsSearchResults) &&
                            empty($pagesSearchResults) &&
                            empty($eventsSearchResults) &&
                            empty($portfoliosSearchResults) &&
                            empty($donationsSearchResults) &&
                            empty($shopSearchResults) &&
                            empty($appointmentsSearchResults);
                
                // If no results, display a message
                if ($noResults): ?>
                        <div class="row mt-0">
                            <div class="col-12">
                                <h3>No Results Found</h3>
                                <p>Sorry, we couldn't find any content matching "<?= esc($searchQuery) ?>".</p>
                                <p>Try searching with different keywords or check your spelling.</p>

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
            
            <?php if (!$noResults): ?>
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

                    <!-- Events Results Widget -->
                    <?php if(!empty($eventsSearchResults)): ?>
                        <div class="row">     
                            <h4>Events</h4>  
                            <?php foreach($eventsSearchResults as $event): ?>
                                <div class="mb-4">
                                <div class="small text-muted">Event Date: <?= dateFormat($event['start_date'], 'M j, Y'); ?></div>
                                <a class="link-dark" href="<?= base_url('event/'.$event['slug']) ?>"><h3><?= $event['title']; ?></h3></a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Portfolios Results Widget -->
                    <?php if(!empty($portfoliosSearchResults)): ?>
                        <div class="row">     
                            <h4>Portfolios</h4>  
                            <?php foreach($portfoliosSearchResults as $portfolio): ?>
                                <div class="mb-4">
                                    <div class="small text-muted"><?= dateFormat($portfolio['created_at'], 'M j, Y'); ?></div>
                                    <a class="link-dark" href="<?= base_url('portfolio/'.$portfolio['slug']) ?>"><h3><?= $portfolio['title']; ?></h3></a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Donations Results Widget -->
                    <?php if(!empty($donationsSearchResults)): ?>
                        <div class="row">     
                            <h4>Donations & Campaigns</h4>  
                            <?php foreach($donationsSearchResults as $donation): ?>
                                <div class="mb-4">
                                    <div class="small text-muted"><?= dateFormat($donation['created_at'], 'M j, Y'); ?></div>
                                    <a class="link-dark" href="<?= base_url('donate/'.$donation['slug']) ?>"><h3><?= $donation['title']; ?></h3></a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Shop Results Widget -->
                    <?php if(!empty($shopSearchResults)): ?>
                        <div class="row">     
                            <h4>Shop</h4>  
                            <?php foreach($shopSearchResults as $shop): ?>
                                <div class="mb-4">
                                    <div class="small text-muted"><?= dateFormat($shop['created_at'], 'M j, Y'); ?></div>
                                    <a class="link-dark" href="<?= base_url('shop/'.$shop['slug']) ?>"><h3><?= $shop['title']; ?></h3></a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Appointments Results Widget -->
                    <?php if(!empty($appointmentsSearchResults)): ?>
                        <div class="row">     
                            <h4>Shop</h4>  
                            <?php foreach($appointmentsSearchResults as $appointment): ?>
                                <div class="mb-4">
                                    <div class="small text-muted"><?= dateFormat($appointment['created_at'], 'M j, Y'); ?></div>
                                    <a class="link-dark" href="<?= base_url('appointment/'.$appointment['slug']) ?>"><h3><?= $appointment['title']; ?></h3></a>
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
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- end main content -->
<?= $this->endSection() ?>