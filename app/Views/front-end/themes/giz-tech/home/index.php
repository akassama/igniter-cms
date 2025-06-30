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

$themeData = [
    'customCSS' => getTableData('codes', ['code_for' => 'CSS'], 'code'),
    'customJSTop' => getTableData('codes', ['code_for' => 'HeaderJS'], 'code'),
    'customJSFooter' => getTableData('codes', ['code_for' => 'FooterJS'], 'code'),
    'copyRight' => getThemeData($theme, "footer_copyright"),
    'primaryColor' => getThemeData($theme, "primary_color"),
    'secondaryColor' => getThemeData($theme, "secondary_color"),
    'backgroundColor' => getThemeData($theme, "background_color"),
    'backgroundImage' => getThemeData($theme, "theme_bg_image"),
    'backgroundVideo' => getThemeData($theme, "theme_bg_video"),
    'sliderImage1' => getThemeData($theme, "theme_bg_slider_image_1"),
    'sliderImage2' => getThemeData($theme, "theme_bg_slider_image_2"),
    'sliderImage3' => getThemeData($theme, "theme_bg_slider_image_3"),
];

//Get social model lists
$socialsModel = new \App\Models\SocialsModel();
$socialLinksQuery = $socialsModel->orderBy('order', 'ASC')->findAll();
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
            $sectionImage = $home_page['section_image'];
            $sectionImage_2 = $home_page['section_image_2'];
            $sectionImage_3 = $home_page['section_image_3'];
            $sectionImage_4 = $home_page['section_image_4'];
            $sectionVideo = $home_page['section_video'];
            $sectionAudio = $home_page['section_audio'];
            $sectionFile = $home_page['section_file'];
            $contentBlocks = $home_page['content_blocks'];
            $sectionLink = $home_page['section_link'];
            $newTab = $home_page['new_tab'];

            // Display different HTML sections based on the 'section' field
            if ($section === "HomeHero") {
                ?>
                <!-- Hero Carousel Section -->
                <section id="home" class="hero-carousel">
                    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <!-- Slide 1 -->
                            <div class="carousel-item active">
                                <div class="hero-slide d-flex align-items-center" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?=$themeData['sliderImage1']?>') no-repeat center center; background-size: cover;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-8 mx-auto text-center">
                                                <h1 class="display-3 fw-bold text-white">Your Trusted IT Partner</h1>
                                                <p class="lead text-white mb-4">Comprehensive procurement solutions tailored to your business needs</p>
                                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                                    <a href="#!" class="btn btn-primary btn-lg px-4 gap-3">Get in Touch</a>
                                                    <a href="#!" class="btn btn-outline-light btn-lg px-4">Our Services</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <div class="hero-slide d-flex align-items-center" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?=$themeData['sliderImage2']?>') no-repeat center center; background-size: cover;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-8 mx-auto text-center">
                                                <h1 class="display-3 fw-bold text-white">Cloud Transformation Experts</h1>
                                                <p class="lead text-white mb-4">Migrate and optimize your infrastructure with our certified cloud specialists</p>
                                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                                    <a href="#!" class="btn btn-primary btn-lg px-4 gap-3">Cloud Assessment</a>
                                                    <a href="#!" class="btn btn-outline-light btn-lg px-4">Case Studies</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 3 -->
                            <div class="carousel-item">
                                <div class="hero-slide d-flex align-items-center" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?=$themeData['sliderImage3']?>') no-repeat center center; background-size: cover;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-8 mx-auto text-center">
                                                <h1 class="display-3 fw-bold text-white">Enterprise Security Solutions</h1>
                                                <p class="lead text-white mb-4">Protect your business with our comprehensive cybersecurity services</p>
                                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                                    <a href="#!" class="btn btn-primary btn-lg px-4 gap-3">Security Audit</a>
                                                    <a href="#!" class="btn btn-outline-light btn-lg px-4">Learn More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        
                        <!-- Indicators -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                    </div>
                </section>
                <?php
                    //display content block if it exists
                    if(!empty($contentBlocks)){
                        renderContentBlocks($contentBlocks);
                    }
                ?>
                  <!-- /Hero Section -->
                <?php
            } elseif ($section === "HomeAbout") {
                ?>
                <!-- About Section -->
                <section id="about" class="about section py-5">
                    <!-- Section Title -->
                     <div class="row justify-content-center mb-5">
                        <div class="col-lg-8 text-center">
                            <h2 class="fw-bold mb-3"><?=$sectionTitle?></h2>
                            <p class="lead"><?=$sectionDescription?></p>
                        </div>
                    </div>
                    <!-- End Section Title -->

                    <div class="container">
                        <div class="row gy-4">
                            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                                <h3 class="fw-bold mb-4">Your Trusted IT Solutions Partner</h3>
                                <img src="<?=getImageUrl($sectionImage ?? getDefaultImagePath())?>" alt="Section image" class="img-fluid rounded-4 mb-4">
                                <p>Founded in 2010, GEXPOTECH has grown to become a trusted partner for businesses seeking comprehensive IT solutions. Our team of experts combines technical expertise with business acumen to deliver results that matter.</p>
                                <p>We specialize in understanding your unique business needs and providing tailored technology solutions that drive efficiency, security, and growth for your organization.</p>
                            </div>
                            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                                <div class="content ps-0 ps-lg-4">
                                    <p class="fst-italic text-muted">
                                        "We are a dynamic IT procurement and services company dedicated to delivering innovative technology solutions."
                                    </p>
                                    <ul class="mb-4">
                                        <li><i class="bi bi-check-circle-fill text-primary me-2"></i> <span>Comprehensive IT procurement solutions from trusted vendors</span></li>
                                        <li><i class="bi bi-check-circle-fill text-primary me-2"></i> <span>Customized cloud migration and management services</span></li>
                                        <li><i class="bi bi-check-circle-fill text-primary me-2"></i> <span>Enterprise-grade cybersecurity protection and consulting</span></li>
                                        <li><i class="bi bi-check-circle-fill text-primary me-2"></i> <span>24/7 managed IT support and infrastructure monitoring</span></li>
                                    </ul>
                                    <p class="mb-4">
                                        Our mission is to empower businesses through innovative and reliable technology solutions, 
                                        while our vision is to be the preferred IT partner for businesses across industries.
                                    </p>

                                    <div class="position-relative mt-4 rounded-4 overflow-hidden">
                                        <img src="<?=getImageUrl($sectionImage_2 ?? getDefaultImagePath())?>" alt="Section image" class="img-fluid rounded-4">
                                        <a href="https://www.youtube.com/watch?v=BqFSHbzSs7U" class="glightbox play-btn d-flex align-items-center justify-content-center">
                                            <i class="bi bi-play-fill fs-1 text-white"></i>
                                        </a>
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
                </section>
                <!-- /About Section -->
                <?php
            } elseif ($section === "Services") {
              ?>
                    <!-- What We Do Section -->
                    <section class="py-5 bg-light">
                        <div class="container">
                            <div class="row justify-content-center mb-5">
                                <div class="col-lg-8 text-center">
                                    <h2 class="fw-bold mb-3">What We Do</h2>
                                    <p class="lead">We provide end-to-end IT solutions tailored to your business needs, helping you leverage technology for growth and efficiency.</p>
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

                    <!-- Services Section -->
                    <section id="services" class="py-5">
                        <div class="container">
                            <div class="row justify-content-center mb-5">
                                <div class="col-lg-8 text-center">
                                    <h2 class="fw-bold mb-3"><?=$sectionTitle?></h2>
                                    <p class="lead"><?=$sectionDescription?></p>
                                </div>
                            </div>
                            <div class="row g-4 justify-content-center">
                                <?php if($services): ?>
                                    <?php foreach($services as $service): ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="card h-100 border-0 shadow">
                                                <div class="card-body text-center p-4">
                                                    <div class="icon-box bg-primary bg-opacity-10 text-primary mb-4">
                                                        <i class="<?= $service['icon']; ?> fs-2"></i>
                                                    </div>
                                                    <h4 class="fw-bold mb-3"><?= $service['title']; ?></h4>
                                                    <p class="mb-0"><?= $service['description']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- End Service Item -->
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
                  <!-- /Services Section -->
              <?php
            } elseif ($section === "Counters") {
              ?>
                <!-- Stats Section -->
                    <section id="counter" class="py-5 bg-dark text-white">
                        <div class="container">
                            <div class="row g-4 text-center">
                                <?php if($counters): ?>
                                    <?php foreach($counters as $counter): ?>
                                        <div class="col-6 col-md-3">
                                            <div class="counter-box">
                                                <i class="bi bi-person-badge fs-1 mb-3"></i>
                                                <h2 class="fw-bold mb-1 counter" data-target="<?= $counter['final_value']; ?>"><?= $counter['initial_value']; ?></h2>
                                                <p class="mb-0"><?= $counter['title']; ?></p>
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
                <section id="pricing" class="pricing section py-5">
                    <!-- Section Title -->
                    <div class="container section-title text-center mb-5">
                        <h2 class="fw-bold"><?= $sectionTitle ?></h2>
                        <p class="lead"><?= $sectionDescription ?></p>
                    </div><!-- End Section Title -->

                    <div class="container">
                        <div class="row g-4">
                            <?php if ($pricings): ?>
                                <?php foreach ($pricings as $pricing): ?>
                                    <div class="col-lg-4">
                                        <div class="pricing-item <?= $pricing['is_popular'] == 1 ? 'featured' : '' ?>">
                                            <h3><?= $pricing['title'] ?></h3>
                                            <div class="icon">
                                                <i class="bi <?= $pricing['is_popular'] == 1 ? 'bi-star-fill' : 'bi-box' ?>"></i>
                                            </div>
                                            <h4><sup>$</sup><?= $pricing['amount'] ?><span> / <?= $pricing['period'] ?></span></h4>
                                            <ul>
                                                <?php
                                                $includedList = $pricing['included_features_list'];
                                                if (!empty($includedList)) {
                                                    $array = explode(",", $includedList);
                                                    foreach ($array as $value) {
                                                        echo '<li><i class="bi bi-check text-success"></i> <span>' . trim($value) . '</span></li>';
                                                    }
                                                }
                                                $excludedList = $pricing['excluded_features_list'];
                                                if (!empty($excludedList)) {
                                                    $array = explode(",", $excludedList);
                                                    foreach ($array as $value) {
                                                        echo '<li class="na"><i class="bi bi-x text-muted"></i> <span>' . trim($value) . '</span></li>';
                                                    }
                                                }
                                                ?>
                                            </ul>
                                            <?php if (!empty($pricing['link'])): ?>
                                                <div class="text-center">
                                                    <a href="<?= $pricing['link']; ?>" 
                                                       class="buy-btn" 
                                                       target="<?= $pricing['new_tab'] == 1 ? "_blank" : "_self" ?>">
                                                       <?= $pricing['link_title']; ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div><!-- End Pricing Item -->
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
                <!-- /Pricing Section -->
              <?php
            } elseif ($section === "FrequentlyAskedQuestions") {
              ?>
                <!-- Faq Section -->
                <section id="faq" class="py-5">
                    <div class="container">
                        <div class="row gy-4">
                            <div class="col-lg-4">
                                <div class="content px-xl-5">
                                    <h3><?=$sectionTitle?></h3>
                                    <p>
                                        <?=$sectionDescription?>
                                    </p>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="faq-container">
                                    <?php $faqRowCount = 1; ?>
                                    <?php if($faqs): ?>
                                        <?php foreach($faqs as $faq): ?>
                                            <div class="faq-item <?= $faqRowCount == 1 ? 'faq-active' : '' ?>">
                                                <h3><span class="num"><?= $faqRowCount ?>.</span> <span><?= $faq['question'] ?></span></h3>
                                                <div class="faq-content">
                                                    <p><?= $faq['answer'] ?></p>
                                                </div>
                                                <i class="faq-toggle bi bi-chevron-right"></i>
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
                <section class="py-5 bg-light">
                    <div class="container">
                        <div class="row justify-content-center mb-5">
                            <div class="col-lg-8 text-center">
                                <h2 class="fw-bold mb-3"><?= esc($sectionTitle) ?></h2>
                                <p class="lead"><?= esc($sectionDescription) ?></p>
                            </div>
                        </div>
                        <div class="row g-4 justify-content-center">
                            <?php if($testimonials): ?>
                                <?php foreach($testimonials as $testimonial): ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body p-4">
                                                <div class="d-flex mb-3">
                                                    <img src="<?= getImageUrl($testimonial['image'] ?? getDefaultImagePath()) ?>" alt="<?= esc($testimonial['name']) ?>" class="rounded-circle me-3" width="60" height="60">
                                                    <div>
                                                        <h5 class="fw-bold mb-1"><?= esc($testimonial['name']) ?></h5>
                                                        <p class="text-muted small mb-0"><?= esc($testimonial['title']) ?>, <?= esc($testimonial['company']) ?></p>
                                                    </div>
                                                </div>
                                                <p class="mb-0">"<?= esc($testimonial['testimonial']) ?>"</p>
                                            </div>
                                        </div>
                                    </div>
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
                <!-- /Testimonials Section -->
              <?php
            } elseif ($section === "Portfolio") {
              ?>
                <!-- Portfolio Section -->
                <section class="py-5" id="portfolio" data-aos="fade-up">
                    <div class="container px-5 my-5">
                        <div class="text-center mb-5">
                            <h1 class="fw-bolder"><?=$sectionTitle?></h1>
                            <p class="lead fw-normal text-muted mb-0"><?=$sectionDescription?></p>
                        </div>

                        <?php 
                        // First filter portfolios to only include those with group = "portfolio"
                        $filteredPortfolios = array_filter($portfolios ?? [], function($portfolio) {
                            return strtolower($portfolio['group']) === "portfolio";
                        });
                        
                        // Get unique category filters from the filtered portfolios
                        $categoryFilters = array_unique(array_column($filteredPortfolios, 'category_filter'));
                        ?>

                        <!-- Filter Buttons (only show if we have filters) -->
                        <?php if(count($categoryFilters) > 0): ?>
                        <div class="row justify-content-center mb-4" data-aos="fade-up">
                            <div class="col-lg-8 text-center">
                                <button class="btn btn-outline-primary filter-btn mb-1 active" data-filter="*">All</button>
                                <?php foreach($categoryFilters as $filter): 
                                    if(!empty($filter)):
                                        $filterClass = strtolower(str_replace(' ', '-', $filter));
                                ?>
                                    <button class="btn btn-outline-primary filter-btn mb-1" data-filter=".<?=$filterClass?>"><?=$filter?></button>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Portfolio Items -->
                        <div class="row gx-5 portfolio-container" data-aos="zoom-in">
                            <?php if(!empty($filteredPortfolios)): ?>
                                <?php foreach($filteredPortfolios as $portfolio): 
                                    $filterClass = strtolower(str_replace(' ', '-', $portfolio['category_filter']));
                                ?>
                                    <div class="col-lg-6 portfolio-item <?=$filterClass?>">
                                        <div class="position-relative mb-5">
                                            <a href="<?=getImageUrl($portfolio['featured_image'] ?? getDefaultImagePath())?>" class="glightbox" data-gallery="portfolioGallery">
                                                <img class="img-fluid rounded-3 mb-3" src="<?=getImageUrl($portfolio['featured_image'] ?? getDefaultImagePath())?>" alt="<?= $portfolio['title']; ?>" />
                                            </a>
                                            <div class="card-body p-0">
                                                <h5 class="fw-bold mb-2"><?= $portfolio['title']; ?></h5>
                                                <p class="text-muted small mb-3"><?= $portfolio['description']; ?></p>
                                                <a class="text-decoration-none link-dark stretched-link" href="<?= base_url('portfolio/'.$portfolio['slug']) ?>">
                                                    <span class="btn btn-sm btn-outline-primary">View Case Study</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-12 text-center py-5">
                                    <p class="text-muted">No portfolio items available</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if(count($filteredPortfolios) > 6): ?>
                            <div class="text-center mt-5">
                                <a href="<?= base_url('portfolios') ?>" class="btn btn-primary">View All Projects</a>
                            </div>
                        <?php endif; ?>
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
                <!-- Team Section -->
                <section id="team" class="py-5 bg-light">
                    <div class="container">
                        <div class="row justify-content-center mb-5">
                            <div class="col-lg-8 text-center">
                                <h2 class="fw-bold mb-3"><?=$sectionTitle?></h2>
                                <p class="lead"><?=$sectionDescription?></p>
                            </div>
                        </div>
                        <div class="row g-4 justify-content-center">
                            <?php if($teams): ?>
                                <?php foreach($teams as $team): ?>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="card border-0 shadow-sm h-100">
                                            <img src="<?= getImageUrl($team['image'] ?? getDefaultImagePath()) ?>" class="card-img-top" alt="<?= $team['name'] ?>">
                                            <div class="card-body text-center">
                                                <h5 class="fw-bold mb-1"><?= $team['name'] ?></h5>
                                                <p class="text-muted small mb-3"><?= $team['title'] ?></p>
                                                <?php if(!empty($team['social_link_1'])): ?>
                                                    <a href="<?= $team['social_link_1'] ?>" class="text-dark me-2"><i class="bi bi-facebook"></i></a>
                                                <?php endif; ?>
                                                <?php if(!empty($team['social_link_2'])): ?>
                                                    <a href="<?= $team['social_link_2'] ?>" class="text-dark me-2"><i class="bi bi-twitter"></i></a>
                                                <?php endif; ?>
                                                <?php if(!empty($team['social_link_3'])): ?>
                                                    <a href="<?= $team['social_link_3'] ?>" class="text-dark me-2"><i class="bi bi-instagram"></i></a>
                                                <?php endif; ?>
                                                <?php if(!empty($team['social_link_4'])): ?>
                                                    <a href="<?= $team['social_link_4'] ?>" class="text-dark me-2"><i class="bi bi-linkedin"></i></a>
                                                <?php endif; ?>
                                                <?php if(!empty($team['social_link_5'])): ?>
                                                    <a href="<?= $team['social_link_5'] ?>" class="text-dark me-2"><i class="bi bi-github"></i></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
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
                <!-- /Team Section -->
              <?php
            } elseif ($section === "Partners") {
                ?>
                <!-- Clients Section -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <div class="row justify-content-center mb-4">
                            <div class="col-lg-8 text-center">
                                <h4 class="fw-bold mb-3"><?=$sectionTitle?></h4>
                                <p class="lead"><?=$sectionDescription?></p>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center g-4">
                            <?php if($partners): ?>
                                <?php foreach($partners as $partner): ?>
                                    <div class="col-6 col-sm-4 col-md-2">
                                        <img src="<?= getImageUrl($partner['logo'] ?? getDefaultImagePath()) ?>" alt="<?= $partner['title'] ?>" class="img-fluid grayscale">
                                    </div>
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
                <!-- /Clients Section -->
                <?php
            } elseif ($section === "CallToAction") {
                ?>
                <!-- Call To Action Section -->
                <section id="cta" class="cta-section position-relative py-5">
                    <div class="cta-overlay"></div>
                    <div class="container position-relative z-1">
                        <div class="row justify-content-center text-center">
                            <div class="col-lg-8">
                                <h2 class="fw-bold mb-4 text-white"><?=$sectionTitle?></h2>
                                <p class="lead mb-4 text-white-75"><?=$sectionDescription?></p>
                                <a href="#contact" class="btn btn-primary btn-lg px-4 py-3 fw-bold">Get Started Today <i class="bi bi-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php
                        //display content block if it exists
                        if(!empty($contentBlocks)){
                            renderContentBlocks($contentBlocks);
                        }
                    ?>
                </section>
                <!-- /Call To Action Section -->
                <?php
            } elseif ($section === "RecentPosts") {
              ?>
                <!-- Recent Posts Section -->
                <section class="py-5 bg-light">
                    <div class="container">
                        <div class="row justify-content-center mb-5">
                            <div class="col-lg-8 text-center">
                                <h2 class="fw-bold mb-3"><?=$sectionTitle?></h2>
                                <p class="lead"><?=$sectionDescription?></p>
                            </div>
                        </div>
                        <div class="row g-4">
                            <?php if($blogs): ?>
                                <?php foreach($blogs as $blog): ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card border-0 shadow-sm h-100">
                                            <a href="<?= base_url('blog/'.$blog['slug']) ?>">
                                                <img src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>" class="card-img-top" alt="<?= $blog['title'] ?>">
                                            </a>
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <span class="badge bg-primary me-2"><?= !empty($blog['category']) ? getBlogCategoryName($blog['category']) : "Blog" ?></span>
                                                    <small class="text-muted"><?= dateFormat($blog['created_at'], 'M j, Y') ?></small>
                                                </div>
                                                <h5 class="fw-bold"><?= $blog['title'] ?></h5>
                                                <p class="mb-3"><?= !empty($blog['excerpt']) ? getTextSummary($blog['excerpt']) : getTextSummary($blog['content']) ?></p>
                                                <a href="<?= base_url('blog/'.$blog['slug']) ?>" class="btn btn-sm btn-outline-primary">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="text-center mt-5">
                            <a href="<?= base_url('blog') ?>" class="btn btn-primary">View All Posts</a>
                        </div>
                    </div>
                    <?php
                        //display content block if it exists
                        if(!empty($contentBlocks)){
                            renderContentBlocks($contentBlocks);
                        }
                    ?>
                </section>
                <!-- /Recent Posts Section -->
                <?php
            } elseif ($section === "Subscribe") {
                ?>
                <!-- Subscribe Section -->
                <section id="subscribe" class="subscribe section py-5">
                    <div class="container">
                        <div class="row gy-4 justify-content-between align-items-center">
                            <div class="col-lg-6">
                                <div class="subscribe-content">
                                    <h2><?=$sectionTitle?></h2>
                                    <p><?=$sectionDescription?></p>
                                    <form action="<?= base_url('/api-form/add-subscriber') ?>" method="post" class="g-3 needs-validation">
                                        <?= csrf_field() ?>
                                        <?= getHoneypotInput() ?>
                                        <div class="input-group mb-3">
                                            <input type="email" class="form-control" name="email" placeholder="Email address..." aria-label="Email address" required>
                                            <input type="hidden" name="return_url" value="<?= current_url()."?#subscribe" ?>">
                                            <button class="btn btn-primary px-4" type="submit">Subscribe</button>
                                        </div>
                                        <?= renderHcaptcha() ?>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="subscribe-image">
                                    <img src="<?= getImageUrl(getHomePageData("Subscribe", "section_image") ?? getDefaultImagePath()) ?>" alt="" class="img-fluid">
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
                </section>
                <!-- /Subscribe Section -->
                <?php
            }  elseif ($section === "Contact") {
                ?>
                <!-- Contact Section -->
                <section id="contact" class="py-5">
                    <div class="container">
                        <div class="row justify-content-center mb-5">
                            <div class="col-lg-8 text-center">
                                <h2 class="fw-bold mb-3"><?=$sectionTitle?></h2>
                                <p class="lead"><?=$sectionDescription?></p>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-5">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body p-4">
                                        <h4 class="fw-bold mb-4">Contact Information</h4>
                                        <div class="d-flex mb-4">
                                            <div class="me-3 text-primary">
                                                <i class="bi bi-geo-alt fs-4"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-1">Address</h5>
                                                <p class="mb-0"><?= $companyAddress ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex mb-4">
                                            <div class="me-3 text-primary">
                                                <i class="bi bi-telephone fs-4"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-1">Phone</h5>
                                                <p class="mb-0"><?=$companyNumber ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex mb-4">
                                            <div class="me-3 text-primary">
                                                <i class="bi bi-envelope fs-4"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-1">Email</h5>
                                                <p class="mb-0"><?=$companyEmail?></p>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <h5 class="fw-bold mb-3">Follow Us</h5>
                                            <div class="d-flex">
                                                <?php if($socialLinksQuery): ?>
                                                    <?php foreach($socialLinksQuery as $social): ?>
                                                        <?php
                                                            $socialId = $social['social_id'];
                                                            $name = $social['name'];
                                                            $icon = $social['icon'];
                                                            $link = getLinkUrl($social['link']);
                                                            $newTab = $social['new_tab'];
                                                            $navTarget = $newTab === "1" ? "_blank" : "_self";
                                                        ?>
                                                        <a href="<?=$link?>" target="<?=$navTarget?>" class="text-dark me-3 <?=Strtolower($name)?>"><i class="<?=$icon?> fs-2"></i></a>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-7">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="fw-bold mb-4">Send Us a Message</h4>
                                        <form action="<?= base_url('/api-form/send-contact-message') ?>" method="post" class="g-3 needs-validation">
                                            <?= csrf_field() ?>
                                            <?= getHoneypotInput() ?>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="name" class="form-label">Your Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">Your Email</label>
                                                    <input type="email" class="form-control" name="email" id="email" required>
                                                </div>
                                                <div class="col-12">
                                                    <label for="phone" class="form-label">Phone Number</label>
                                                    <input type="tel" class="form-control" name="phone" id="phone" required>
                                                </div>
                                                <div class="col-12">
                                                    <label for="message" class="form-label">Message</label>
                                                    <textarea class="form-control" name="message" id="message" rows="5" required></textarea>
                                                </div>
                                                <input type="hidden" name="return_url" value="<?= current_url('?#contact') ?>">
                                                <?= renderHcaptcha() ?>
                                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card">
                                    <div class="p-0 rounded overflow-hidden">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2479.041744404045!2d-0.4017884230259833!3d51.64373477181462!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48766b5e8f7c8c3d%3A0x2c6c6c3b3b3b3b3b!2sWatford!5e0!3m2!1sen!2suk!4v1681234567890!5m2!1sen!2suk" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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