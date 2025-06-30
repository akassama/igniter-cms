<?php
// This is to get current impact
$theme = getCurrentTheme();

//get site config values
$companyName = getConfigData("CompanyName");
$companyAddress = getConfigData("CompanyAddress");
$companyEmail = getConfigData("CompanyEmail");
$companyNumber = getConfigData("CompanyNumber");
$companyOpeningHours = getConfigData("CompanyOpeningHours");
$metaAuthor = getConfigData("MetaAuthor");
$metaTitle = getConfigData("MetaTitle");
$metaDescription = getConfigData("MetaDescription");
$metaKeywords = getConfigData("MetaKeywords");
$siteLogoLink = getConfigData("SiteLogoLink");
$siteLogoTwoLink = getConfigData("SiteLogoTwoLink");
$siteFaviconLink = getConfigData("SiteFaviconLink");
$siteFaviconManifestLink = getConfigData("SiteFaviconManifestLink");
$siteFaviconLink96 = getConfigData("SiteFaviconLink96");
$siteFaviconLinkAppleTouch = getConfigData("SiteFaviconLinkAppleTouch");

//popup settings
$currentPage = "home";
$popUpWhereClause = ['status' => 1];
$showOnPages = getTableData('announcement_popups', $popUpWhereClause, 'show_on_pages');
$enablePopupAds = getConfigData("EnablePopupAds");
?>


<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
  <!-- ////// BEGIN Get Home Pages ///// -->
  <?php if($home_pages): ?>
    <?php foreach($home_pages as $home_page): ?>
        <?php
            $section = $home_page['section'];
            $sectionTitle = $home_page['section_title'];
            $sectionDescription = $home_page['section_description'];
    
            // Display different HTML sections based on the 'section' field
            if ($section === "HomeHero") {
                ?>
                    <!-- Hero Section -->
                    <section id="home" class="hero">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="hero-content animate__animated animate__fadeInUp">
                                        <h1><?=$sectionTitle?></h1>
                                        <p class="lead"><?=$sectionDescription?></p>
                                        <div class="hero-buttons">
                                            <a href="#menu" class="btn btn-primary btn-lg me-3">View Menu</a>
                                            <a href="#book-a-table" class="btn btn-outline-light btn-lg">Book a Table</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                //display content block if it exists
                                if(!empty($contentBlocks)){
                                    renderContentBlocks($contentBlocks);
                                }
                            ?>
                        </div>
                    </section>
                <?php
            } elseif ($section === "HomeAbout") {
                ?>
                    <!-- About Section -->
                    <section id="about" class="section">
                        <div class="container">
                            <div class="section-title">
                                <h1><?=$sectionTitle?></h1>
                                <p><?=$sectionDescription?></p>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="about-img">
                                        <img src="<?=getImageUrl($home_page['section_image'] ?? getDefaultImagePath())?>" alt="About Us" class="img-fluid rounded">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="about-content ps-lg-4">
                                        <h3>30 Years of Culinary Excellence</h3>
                                        <p class="lead">At Le-Restaurant, we believe that great food brings people together. Our journey began three decades ago with a simple vision: to create extraordinary dining experiences through exceptional cuisine.</p>
                                        <p>Our talented chefs combine traditional techniques with innovative approaches to create dishes that not only taste incredible but tell a story. Every ingredient is carefully selected from local farms and trusted suppliers to ensure the highest quality.</p>
                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="bi bi-check-circle-fill text-success me-3 fs-4"></i>
                                                    <span>Farm-to-table ingredients</span>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="bi bi-check-circle-fill text-success me-3 fs-4"></i>
                                                    <span>Award-winning chefs</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="bi bi-check-circle-fill text-success me-3 fs-4"></i>
                                                    <span>Elegant atmosphere</span>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="bi bi-check-circle-fill text-success me-3 fs-4"></i>
                                                    <span>Exceptional service</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                //display content block if it exists
                                if(!empty($contentBlocks)){
                                    renderContentBlocks($contentBlocks);
                                }
                            ?>
                        </div>
                    </section>
                <!-- /About Section -->
                <?php
            } elseif ($section === "Services") {
              ?>
                <!-- Services Section -->
                <section id="services" class="section bg-light">
                    <div class="container">
                        <div class="section-title">
                            <h1><?=$sectionTitle?></h1>
                            <p><?=$sectionDescription?></p>
                        </div>
                        <div class="row justify-content-center">
                            <?php if($services): ?>
                                <?php foreach($services as $service): ?>
                                <div class="col-lg-4 col-md-6 mb-2">
                                    <div class="service-card text-center p-4 mb-4">
                                        <div class="service-icon mb-4">
                                            <i class="<?= $service['icon']; ?> fs-1 text-danger"></i>
                                        </div>
                                        <h4><?= $service['title']; ?></h4>
                                        <p><?= $service['description']; ?></p>
                                    </div>
                                </div>
                                <!-- End Service Item -->
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                        //display content block if it exists
                        if(!empty($contentBlocks)){
                            renderContentBlocks($contentBlocks);
                        }
                    ?>
                </section>
                  <!-- /Services Section -->
              <?php
            } elseif ($section === "Counters") {
              ?>
                <!-- Stats Section -->
                <section class="stats">
                    <div class="container">
                        <div class="row">
                            <?php if($counters): ?>
                                <?php foreach($counters as $counter): ?>
                                <div class="col-lg-3 col-md-6">
                                    <div class="stats-item">
                                        <i class="bi bi-emoji-smile"></i>
                                        <div class="counter" data-count="<?= $counter['final_value']; ?>"><?= $counter['initial_value']; ?></div>
                                        <p><?= $counter['title']; ?></p>
                                    </div>
                                </div>
                                <!-- End Stats Item -->
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Stats Section -->
              <?php
            } elseif ($section === "Pricing") {
              ?>
                <!-- Pricing Section -->
          <section id="pricing" class="section">
            <div class="container">
              <div class="section-title">
                <h1><?=$sectionTitle?></h1>
                <p><?=$sectionDescription?></p>
              </div>
              <div class="row">
                <?php if ($pricings): ?>
                  <?php foreach ($pricings as $pricing): ?>
                    <div class="col-lg-4">
                      <div class="card pricing-card mb-4">
                        <div class="card-header <?= $pricing['is_popular'] == 1 ? "theme-bg" : "theme-light-bg" ?> text-white text-center py-4">
                          <h3><?= $pricing['title'] ?></h3>
                          <div class="price">
                            <span class="currency">$</span><?= $pricing['amount'] ?><span class="period"><?= $pricing['period'] ?></span>
                          </div>
                        </div>
                        <div class="card-body">
                          <ul class="list-unstyled">
                            <?php
                            $includedList = $pricing['included_features_list'];
                            if (!empty($includedList)) {
                              $array = explode(",", $includedList);
                              foreach ($array as $value) {
                                echo '<li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>' . $value . '</li>';
                              }
                            }
                            $excludedList = $pricing['excluded_features_list'];
                            if (!empty($excludedList)) {
                              $array = explode(",", $excludedList);
                              foreach ($array as $value) {
                                echo '<li class="mb-3 text-muted"><i class="bi bi-x me-2"></i>' . $value . '</li>';
                              }
                            }
                            ?>
                          </ul>
                          <?php if (!empty($pricing['link'])): ?>
                            <div class="text-center mt-4">
                              <a class="btn <?= $pricing['is_popular'] == 1 ? "btn-primary" : "btn-outline-primary" ?>" 
                                 href="<?= $pricing['link']; ?>" 
                                 target="<?= $pricing['new_tab'] == 1 ? "_blank" : "_self" ?>">
                                  <?= $pricing['link_title']; ?>
                              </a>
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </div>
            <?php
                //display content block if it exists
                if(!empty($contentBlocks)){
                    renderContentBlocks($contentBlocks);
                }
            ?>
          </section>
                <!-- /Pricing Section -->
              <?php
            } elseif ($section === "FrequentlyAskedQuestions") {
              ?>
                <!-- FAQ Section -->
                <section id="faq" class="section bg-light">
                    <div class="container">
                    <div class="section-title">
                        <h1><?=$sectionTitle?></h1>
                        <p><?=$sectionDescription?></p>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="accordion" id="faqAccordion">
                                <?php $faqRowCount = 1; ?>
                                <?php if($faqs): ?>
                                <?php foreach($faqs as $faq): ?>
                                    <div class="accordion-item mb-3 border-0 shadow-sm">
                                    <h3 class="accordion-header" id="heading<?= $faqRowCount; ?>">
                                        <button class="accordion-button <?= $faqRowCount == 1 ? "" : "collapsed"?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $faqRowCount; ?>">
                                        <?= $faq['question']; ?>
                                        </button>
                                    </h3>
                                    <div id="collapse<?= $faqRowCount; ?>" class="accordion-collapse collapse <?= $faqRowCount == 1 ? "show" : ""?>" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                        <?= $faq['answer']; ?>
                                        </div>
                                    </div>
                                    </div>
                                    <?php $faqRowCount++; ?>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            </div>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Faq Section -->
              <?php
            } elseif ($section === "Testimonials") {
              ?>
                <!-- Testimonials Section -->
                <section class="section bg-light">
                    <div class="container">
                        <div class="section-title">
                            <h1><?=$sectionTitle?></h1>
                            <p><?=$sectionDescription?></p>
                        </div>
                        <div class="swiper testimonial-swiper">
                            <div class="swiper-wrapper">
                            <?php if($testimonials): ?>
                                <?php foreach($testimonials as $testimonial): ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                    <img src="<?= getImageUrl($testimonial['image'] ?? getDefaultImagePath()) ?>" alt="<?= esc($testimonial['name']) ?>" class="img-fluid rounded-circle mb-3">
                                    <div class="stars">
                                        <?php for ($i=0; $i<$testimonial['rating']; $i++): ?>
                                        <i class="bi bi-star-fill"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <p>"<?= esc($testimonial['testimonial']) ?>"</p>
                                    <h5><?= esc($testimonial['name']) ?></h5>
                                    <small class="text-muted"><?= esc($testimonial['title']) ?>, <?= esc($testimonial['company']) ?></small>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Testimonials Section -->
              <?php
            } elseif ($section === "Portfolio") {
              ?>
                <!-- Portfolio Section -->
                <section id="portfolio" class="section">
                    <div class="container">
                        <div class="section-title">
                            <h1><?=$sectionTitle?></h1>
                            <p><?=$sectionDescription?></p>
                        </div>

                        <?php 
                        // Filter only restaurant portfolios
                        $restaurantPortfolios = array_filter($portfolios, function($portfolio) {
                            return strtolower($portfolio['group'] ?? '') === 'restaurant_portfolio';
                        });
                        
                        // Extract unique category_filters for tabs
                        $uniqueCategories = array_unique(array_column($restaurantPortfolios, 'category_filter'));
                        ?>

                        <!-- Menu Tabs -->
                        <ul class="nav nav-pills menu-tabs justify-content-center mb-5" id="menuTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" 
                                        id="all-tab" 
                                        data-bs-toggle="pill" 
                                        data-bs-target="#all" 
                                        type="button" 
                                        role="tab"
                                        aria-controls="all"
                                        aria-selected="true">All</button>
                            </li>
                            <?php foreach ($uniqueCategories as $category): ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" 
                                            id="<?= strtolower(str_replace(' ', '-', $category)) ?>-tab" 
                                            data-bs-toggle="pill" 
                                            data-bs-target="#<?= strtolower(str_replace(' ', '-', $category)) ?>" 
                                            type="button" 
                                            role="tab"
                                            aria-controls="<?= strtolower(str_replace(' ', '-', $category)) ?>"
                                            aria-selected="false">
                                        <?= esc($category) ?>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- Menu Content -->
                        <div class="tab-content" id="menuTabsContent">
                            <!-- All Items Tab -->
                            <div class="tab-pane fade show active" id="all" role="tabpanel">
                                <div class="row align-items-center justify-content-center">
                                    <?php foreach ($restaurantPortfolios as $portfolio): ?>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="menu-item">
                                                <img src="<?=getImageUrl($portfolio['featured_image'] ?? getDefaultImagePath())?>" 
                                                    alt="<?= esc($portfolio['title']) ?>" 
                                                    class="img-fluid rounded-top">
                                                <h4><?= esc($portfolio['title']) ?> 
                                                    <?php if (!empty($portfolio['client'])): ?>
                                                        <span class="price"><?= esc($portfolio['client']) ?></span>
                                                    <?php endif; ?>
                                                </h4>
                                                <p><?= esc($portfolio['description']) ?></p>
                                                <a href="<?= base_url('portfolio/'.$portfolio['slug']) ?>" 
                                                class="btn btn-sm btn-outline-primary">View Details</a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Category Tabs -->
                            <?php foreach ($uniqueCategories as $category): ?>
                                <div class="tab-pane fade" 
                                    id="<?= strtolower(str_replace(' ', '-', $category)) ?>" 
                                    role="tabpanel">
                                    <div class="row align-items-center justify-content-center">
                                        <?php foreach ($restaurantPortfolios as $portfolio): ?>
                                            <?php if ($portfolio['category_filter'] === $category): ?>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="menu-item">
                                                        <img src="<?=getImageUrl($portfolio['featured_image'] ?? getDefaultImagePath())?>" 
                                                            alt="<?= esc($portfolio['title']) ?>" 
                                                            class="img-fluid rounded-top">
                                                        <h4><?= esc($portfolio['title']) ?> 
                                                            <?php if (!empty($portfolio['client'])): ?>
                                                                <span class="price"><?= esc($portfolio['client']) ?></span>
                                                            <?php endif; ?>
                                                        </h4>
                                                        <p><?= esc($portfolio['description']) ?></p>
                                                        <a href="<?= base_url('portfolio/'.$portfolio['slug']) ?>" 
                                                        class="btn btn-sm btn-outline-primary">View Details</a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php
                        //display content block if it exists
                        if(!empty($contentBlocks)){
                            renderContentBlocks($contentBlocks);
                        }
                    ?>
                </section>
                <!-- End Portfolio Section -->
              <?php
            } elseif ($section === "Team") {
              ?>
                <!-- Chefs Section -->
                <section id="team" class="section">
                    <div class="container">
                        <div class="section-title">
                            <h1><?=$sectionTitle?></h1>
                            <p><?=$sectionDescription?></p>
                        </div>
                        <div class="row justify-content-center">
                            <?php if($teams): ?>
                                <?php foreach($teams as $team): ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="chef-card">
                                        <img src="<?=getImageUrl($team['image'] ?? getDefaultImagePath())?>" alt="<?= $team['name']; ?>">
                                        <h4><?= $team['name']; ?></h4>
                                        <p class="text-muted"><?= $team['title']; ?></p>
                                        <p><?= $team['summary']; ?></p>
                                        <div class="chef-social">
                                            <?php if(!empty($team['social_link_1'])): ?>
                                                <a href="<?= $team['social_link_1'] ?>"><i class="bi bi-facebook"></i></a>
                                            <?php endif; ?>
                                            <?php if(!empty($team['social_link_2'])): ?>
                                                <a href="<?= $team['social_link_2'] ?>"><i class="bi bi-twitter"></i></a>
                                            <?php endif; ?>
                                            <?php if(!empty($team['social_link_3'])): ?>
                                                <a href="<?= $team['social_link_3'] ?>"><i class="bi bi-instagram"></i></a>
                                            <?php endif; ?>
                                            <?php if(!empty($team['social_link_4'])): ?>
                                                <a href="<?= $team['social_link_4'] ?>"><i class="bi bi-linkedin"></i></a>
                                            <?php endif; ?>
                                            <?php if(!empty($team['social_link_5'])): ?>
                                                <a href="<?= $team['social_link_5'] ?>"><i class="bi bi-github"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Team Member -->
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                        //display content block if it exists
                        if(!empty($contentBlocks)){
                            renderContentBlocks($contentBlocks);
                        }
                    ?>
                </section>
                <!-- /Team Section -->
              <?php
            } elseif ($section === "Partners") {
                ?>
                <!-- Partners/Clients Section -->
                <section id="partners" class="section">
                    <div class="container">
                        <div class="section-title">
                            <h1><?=$sectionTitle?></h1>
                            <p><?=$sectionDescription?></p>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <?php if($partners): ?>
                                <?php foreach($partners as $partner): ?>
                                    <div class="col-lg-2 col-md-4 col-6 mb-4">
                                        <img loading="lazy" src="<?=getImageUrl($partner['logo'] ?? getDefaultImagePath())?>" alt="<?=$partner['title']?>" class="img-fluid grayscale">
                                    </div>
                                <!-- End Partner Item -->
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- End Partners/Clients Section -->
                <?php
            } elseif ($section === "Gallery") {
                ?>
                <!-- Gallery Section -->
                <section id="gallery" class="section">
                    <div class="container">
                        <div class="section-title">
                            <h1><?=$sectionTitle?></h1>
                            <p><?=$sectionDescription?></p>
                        </div>
                        <div class="row">
                            <?php if($galleries): ?>
                                <?php foreach($galleries as $gallery): ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="gallery-item">
                                            <a href="<?=getImageUrl($gallery['image'] ?? getDefaultImagePath())?>" class="glightbox">
                                                <img src="<?=getImageUrl($gallery['image'] ?? getDefaultImagePath())?>" alt="<?=$gallery['title']?>">
                                                <div class="gallery-overlay">
                                                    <i class="bi bi-eye"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <!-- End Partner Item -->
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- End Gallery Section -->
                <?php
            } elseif ($section === "Booking") {
                ?>
                <!-- Booking Section -->
                <section id="book-a-table" class="book-table section">
                    <div class="container">
                        <div class="section-title">
                            <h2 class="text-white"><?=$sectionTitle?></h2>
                            <p class="text-white-50"><?=$sectionDescription?></p>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <form action="<?= base_url('/api-form/add-booking') ?>" method="post" class="booking-form">
                                    <?= csrf_field() ?>
                                    <?=getHoneypotInput()?>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Your Phone" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="time" class="form-control" id="booking_time" name="booking_time" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <select class="form-control" id="no_of_people" name="no_of_people" required>
                                                <option class="text-dark" value="">Number of People</option>
                                                <option class="text-dark" value="1">1 Person</option>
                                                <option class="text-dark" value="2">2 People</option>
                                                <option class="text-dark" value="3">3 People</option>
                                                <option class="text-dark" value="4">4 People</option>
                                                <option class="text-dark" value="5">5 People</option>
                                                <option class="text-dark" value="6">6 People</option>
                                                <option class="text-dark" value="7">7 People</option>
                                                <option class="text-dark" value="8">8 People</option>
                                                <option class="text-dark" value="9">9 People</option>
                                                <option class="text-dark" value="10">10 People</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <textarea class="form-control" rows="4" id="message" name="message" placeholder="Special Requests (Optional)"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <input type="hidden" name="return_url" value="<?=current_url()."?#book-a-table"?>">
                                            <?=renderHcaptcha()?>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-light btn-lg px-5">Book Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- End Booking Section -->
                <?php
            } elseif ($section === "CallToAction") {
                ?>
                <!-- Call To Action Section -->
                <section id="cta" class="section cta text-white">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h2 class="mb-3"><?=$sectionTitle?></h2>
                                <p class="mb-0"><?=$sectionDescription?></p>
                            </div>
                            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                                <a href="#book-a-table" class="btn btn-light btn-lg px-5">Reserve Now</a>
                            </div>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Call To Action Section -->
                <?php
            } elseif ($section === "RecentPosts") {
              ?>
                <!-- Recent Posts Section -->
                <section id="blog" class="section">
                    <div class="container">
                        <div class="section-title">
                            <h1><?=$sectionTitle?></h1>
                            <p><?=$sectionDescription?></p>
                        </div>
                        <div class="row">
                            <?php if($blogs): ?>
                                <?php foreach($blogs as $blog): ?>
                                    <div class="col-lg-4 col-md-6 mb-4 border border-light">
                                        <div class="post-card">
                                            <div class="post-img">
                                                <img src="<?=getImageUrl($blog['featured_image'] ?? getDefaultImagePath())?>" alt="<?= $blog['title']; ?>" class="img-fluid">
                                            </div>
                                            <div class="post-body p-4">
                                                <div class="post-meta mb-3">
                                                    <span class="text-muted"><i class="bi bi-calendar me-2"></i><?= dateFormat($blog['created_at'], 'M j, Y'); ?></span>
                                                    <span class="text-muted ms-3"><i class="bi bi-person me-2"></i><?= getActivityBy(esc($blog['created_by'])); ?></span>
                                                </div>
                                                <h4><a href="<?= base_url('blog/'.$blog['slug']) ?>" class="text-dark"><?= $blog['title']; ?></a></h4>
                                                <p class="mb-3"><?= !empty($blog['excerpt']) ? getTextSummary($blog['excerpt']) : getTextSummary($blog['content']) ?></p>
                                                <a href="<?= base_url('blog/'.$blog['slug']) ?>" class="btn btn-sm btn-outline-danger">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                <!-- End post list item -->
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Recent Posts Section -->
                <?php
            } elseif ($section === "Subscribe") {
                ?>
                <!-- Subscribe Section -->
                <section id="subscribe" class="section bg-light">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 text-center">
                                <h2 class="mb-3"><?=$sectionTitle?></h2>
                                <p class="mb-5"><?=$sectionDescription?></p>
                                <form action="<?= base_url('/api-form/add-subscriber') ?>" method="post" class="subscribe-form">
                                    <?= csrf_field() ?>
                                    <?=getHoneypotInput()?>
                                    <div class="row g-2">
                                        <div class="col-md-8">
                                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Your Email Address" required>
                                        </div>
                                        <div class="col-md-4 d-grid">
                                            <button type="submit" class="btn btn-danger btn-lg">Subscribe</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="return_url" value="<?=current_url()."?#subscribe"?>">
                                    <?=renderHcaptcha()?>
                                    <div class="small text-muted mt-3">We care about privacy, and will never share your data.</div>
                                </form>
                            </div>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Subscribe Section -->
                <?php
            }  elseif ($section === "Contact") {
                ?>
                <!-- Contact Section -->
                <section id="contact" class="section">
                    <div class="container">
                        <div class="section-title">
                            <h1><?=$sectionTitle?></h1>
                            <p><?=$sectionDescription?></p>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="contact-info">
                                    <div class="contact-item">
                                        <i class="bi bi-geo-alt"></i>
                                        <div>
                                            <h5>Address</h5>
                                            <p><?= nl2br(getConfigData("CompanyAddress")) ?></p>
                                        </div>
                                    </div>
                                    <div class="contact-item">
                                        <i class="bi bi-telephone"></i>
                                        <div>
                                            <h5>Phone</h5>
                                            <p><?=$companyNumber ?></p>
                                        </div>
                                    </div>
                                    <div class="contact-item">
                                        <i class="bi bi-envelope"></i>
                                        <div>
                                            <h5>Email</h5>
                                            <p><?=$companyEmail?></p>
                                        </div>
                                    </div>
                                    <div class="contact-item">
                                        <i class="bi bi-clock"></i>
                                        <div>
                                            <h5>Opening Hours</h5>
                                            <p><?= nl2br(getConfigData("BusinessHours")) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <form action="<?= base_url('/api-form/send-contact-message') ?>" method="post" class="contact-form">
                                    <?= csrf_field() ?>
                                    <?=getHoneypotInput()?>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <textarea class="form-control" name="message" id="message" rows="6" placeholder="Your Message" required></textarea>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary btn-lg px-5">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-12 mt-4">
                                        <div class="map-container" style="min-height: 100%;">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215662132345!2d-73.9878449241641!3d40.74844097138959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1717803381861!5m2!1sen!2sus"
                                                    width="100%"  style="min-height: 20rem; border:0; border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Contact Section -->
                <?php
            }
          ?>
    <?php endforeach; ?>
  <?php endif; ?>
  <!-- ////// END Home Pages ///// -->

<?php
// Check if popups should be shown
if (strtolower($enablePopupAds) === "yes" && in_array($currentPage, explode(',', $showOnPages))) {
    ?>
        <!-- Advert Popup Section -->
        <?= $this->include('front-end/themes/_shared/_advert_popups.php'); ?>
    <?php
}
?>

<!-- end main content -->
<?= $this->endSection() ?>