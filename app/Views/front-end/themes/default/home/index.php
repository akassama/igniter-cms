<?php
// This is to get current impact
$theme = getCurrentTheme();

//get site config values
$companyName = getConfigData("CompanyName");
$companyAddress = getConfigData("CompanyAddress");
$companyEmail = getConfigData("CompanyEmail");
$companyNumber = getConfigData("CompanyNumber");
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

//check for right theme format
if(empty($home_pages)){
    echo "The current HomePageFormat is of the wrong type. Please set to 'Home Page'";
    exit();
}
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
                    <header class="bg-dark py-5">
                        <div class="container px-5">
                            <div class="row gx-5 align-items-center justify-content-center">
                                <div class="col-lg-8 col-xl-7 col-xxl-6">
                                    <div class="my-5 text-center text-xl-start">
                                        <h1 class="display-5 fw-bold text-white mb-2"><?=$sectionTitle?></h1>
                                        <p class="lead fw-normal text-white-50 mb-4"><?=$sectionDescription?></p>
                                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                            <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#services">Get Started</a>
                                            <a class="btn btn-outline-light btn-lg px-4" href="#about">Learn More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="<?=getImageUrl($home_page['section_image'] ?? getDefaultImagePath())?>" alt="Header image" /></div>
                            </div>
                        </div>
                    </header>
                  <!-- /Hero Section -->
                <?php
            } elseif ($section === "HomeAbout") {
                ?>
                <!-- About Section -->
                    <section class="py-5 bg-light" id="about">
                        <div class="container px-5 my-5">
                            <div class="row gx-5 align-items-center">
                                <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="<?=getImageUrl($home_page['section_image'] ?? getDefaultImagePath())?>" alt="Section image" /></div>
                                <div class="col-lg-6">
                                    <h2 class="fw-bolder"><?=$sectionTitle?></h2>
                                    <p class="lead fw-normal text-muted mb-0"><?=$sectionDescription?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                <!-- /About Section -->
                <?php
            } elseif ($section === "Services") {
              ?>
                  <!-- Services Section -->
                    <section class="py-5" id="services">
                        <div class="container px-5 my-5">
                            <div class="row gx-5">
                                <div class="col-lg-4 mb-5 mb-lg-0">
                                    <h2 class="fw-bolder mb-0"><?=$sectionTitle?></h2>
                                    <p class="lead fw-normal text-muted mb-0"><?=$sectionDescription?></p>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <?php if($services): ?>
                                            <?php foreach($services as $service): ?>
                                            <div class="col-md-6 mb-5 h-100">
                                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="<?= $service['icon']; ?>"></i></div>
                                                <h2 class="h5"><?= $service['title']; ?></h2>
                                                <p class="mb-0"><?= $service['description']; ?></p>
                                                <?php
                                                    if(!empty($service['link'])){
                                                    ?>
                                                        <a href="<?= $service['link']; ?>" class="text-dark" target="<?= $service['new_tab'] == 1 ? "_blank" : "_self" ?>">
                                                        Read more <i class="bi bi-arrow-right"></i>
                                                        </a>
                                                    <?php
                                                    }
                                                ?>
                                            </div>
                                        <!-- End Service Item -->
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                  <!-- /Services Section -->
              <?php
            } elseif ($section === "Counters") {
              ?>
                <!-- Stats Section -->
                <section class="py-5 bg-light">
                    <div class="container px-5">
                        <div class="row gx-5 justify-content-center">
                            <?php if($counters): ?>
                                <?php foreach($counters as $counter): ?>
                                    <div class="col-6 col-md-4 col-lg-3 text-center mb-4">
                                    <div class="display-4 fw-bold text-primary counter-number" data-target="<?= $counter['final_value']; ?>"><?= $counter['initial_value']; ?></div>
                                    <p class="lead text-muted mb-0"><?= $counter['title']; ?></p>
                                </div>
                                <!-- End Stats Item -->
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <!-- /Stats Section -->
              <?php
            } elseif ($section === "Pricing") {
              ?>
                <!-- Pricing Section -->
                <section class="bg-light py-5" id="pricing">
                    <div class="container px-5 my-5">
                        <div class="text-center mb-5">
                            <h1 class="fw-bolder"><?=$sectionTitle?></h1>
                            <p class="lead fw-normal text-muted mb-0"><?=$sectionDescription?></p>
                        </div>
                        <div class="row gx-5 justify-content-center">
                        <?php if($pricings): ?>
                        <?php foreach($pricings as $pricing): ?>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-5 mb-xl-0">
                                    <div class="card-body p-5">
                                        <div class="small text-uppercase fw-bold <?= $pricing['is_popular'] == 1 ? "" : "text-muted"?>">
                                            <?= $pricing['is_popular'] == 1 ? "<i class='bi bi-star-fill text-warning'></i>" : ""?>
                                            <?= $pricing['title']?>
                                        </div>
                                        <div class="mb-3">
                                            <span class="display-4 fw-bold">$<?= $pricing['amount']?></span>
                                            <span class="text-muted">/ mo.</span>
                                        </div>
                                        <ul class="list-unstyled mb-4">
                                            <!--Included list-->
                                            <?php
                                                $includedList = $pricing['included_features_list'];
                                                if(!empty($includedList)){
                                                    $array = explode(",", $includedList);

                                                    foreach ($array as $value)
                                                    {
                                                        echo '<li class="mb-2"><i class="bi bi-check text-primary"></i> <strong>'.$value.'</strong></li>';
                                                    }
                                                }
                                            ?>
                                  
                                            <!--Excluded list-->
                                            <?php
                                                $excludedList = $pricing['excluded_features_list'];
                                                if(!empty($excludedList)){
                                                $array = explode(",", $excludedList);
          
                                                foreach ($array as $value)
                                                {
                                                    echo '<li class="mb-2 text-muted"><i class="bi bi-x"></i>'.$value.'</li>';
                                                }
                                                }
                                            ?>
                                        </ul>
                                        <?php
                                        if(!empty($pricing['link'])){
                                            ?>
                                            <div class="d-grid"><a class="btn <?= $pricing['is_popular'] == 1 ? "btn-primary" : "btn-outline-primary"?>" href="<?= $pricing['link']; ?>" target="<?= $pricing['new_tab'] == 1 ? "_blank" : "_self" ?>"><?= $pricing['link_title']; ?></a></div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <!-- End Pricing Item -->
                        <?php endforeach; ?>
                      <?php endif; ?>
                            
                        </div>
                    </div>
                </section>
                <!-- /Pricing Section -->
              <?php
            } elseif ($section === "FrequentlyAskedQuestions") {
              ?>
                <!-- Faq Section -->
                <section class="py-5" id="faq">
                    <div class="container px-5 my-5">
                        <div class="text-center mb-5">
                            <h1 class="fw-bolder"><?=$sectionTitle?></h1>
                            <p class="lead fw-normal text-muted mb-0"><?=$sectionDescription?></p>
                        </div>
                        <div class="row gx-5">
                            <div class="col-12">
                                <!-- FAQ Accordion-->
                                <div class="accordion mb-5" id="accordionExample">
                                    <?php $faqRowCount = 1; ?>
                                    <?php if($faqs): ?>
                                        <?php foreach($faqs as $faq): ?>
                                            <div class="accordion-item">
                                                <h3 class="accordion-header" id="heading<?= $faqRowCount; ?>"><button class="accordion-button <?= $faqRowCount == 1 ? "" : "collapsed"?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $faqRowCount; ?>" aria-expanded="<?= $faqRowCount == 1 ? "true" : "false"?>" aria-controls="collapse<?= $faqRowCount; ?>"><?= $faq['question']; ?></button></h3>
                                                <div class="accordion-collapse collapse <?= $faqRowCount == 1 ? "show" : ""?>" id="collapse<?= $faqRowCount; ?>" aria-labelledby="heading<?= $faqRowCount; ?>" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <?= $faq['answer']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Faq Item -->
                                            <?php $faqRowCount++; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /Faq Section -->
              <?php
            } elseif ($section === "Testimonials") {
              ?>
                <!-- Testimonials Section -->
                <div class="py-5 bg-white position-relative" id="testimonial">
                    <div class="container px-5 my-5">
                        <div class="text-center mb-5">
                            <h1 class="fw-bolder"><?= esc($sectionTitle) ?></h1>
                            <p class="lead fw-normal text-muted mb-0"><?= esc($sectionDescription) ?></p>
                        </div>

                        <div class="row gx-5 justify-content-center">
                            <div class="col-lg-10 col-xl-7 position-relative">
                                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">

                                    <!-- Carousel indicators -->
                                    <div class="carousel-indicators">
                                        <?php foreach ($testimonials as $index => $testimonial): ?>
                                            <button 
                                                type="button" 
                                                data-bs-target="#testimonialCarousel" 
                                                data-bs-slide-to="<?= $index ?>" 
                                                class="<?= $index === 0 ? 'active' : '' ?>" 
                                                aria-label="Testimonial from <?= esc($testimonial['name']) ?>" 
                                                <?= $index === 0 ? 'aria-current="true"' : '' ?>>
                                            </button>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- Carousel inner -->
                                    <div class="carousel-inner testimonial-carousel-inner">
                                        <?php foreach ($testimonials as $index => $testimonial): ?>
                                            <!-- Testimonial item -->
                                            <div class="carousel-item text-center testimonial-item <?= $index === 0 ? 'active' : '' ?>">
                                                <div class="testimonial-quote fs-4 mb-4 fst-italic">
                                                    "<?= esc($testimonial['testimonial']) ?>"
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <img 
                                                        class="rounded-circle me-3" 
                                                        src="<?= getImageUrl($testimonial['image'] ?? getDefaultImagePath()) ?>" 
                                                        alt="Photo of <?= esc($testimonial['name']) ?>" 
                                                        height="45" 
                                                    />
                                                    <div class="fw-bold">
                                                        <?= esc($testimonial['name']) ?>
                                                        <span class="fw-bold text-primary mx-1">/</span>
                                                        <?= esc($testimonial['title']) ?>, <?= esc($testimonial['company']) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- Custom Navigation Arrows -->
                                    <div class="testimonial-arrow testimonial-arrow-left">
                                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                    </div>

                                    <div class="testimonial-arrow testimonial-arrow-right">
                                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Testimonials Section -->
              <?php
            } elseif ($section === "Portfolio") {
              ?>
                <!-- Portfolio Section -->
                <section class="py-5" id="portfolio">
                    <div class="container px-5 my-5">
                        <div class="text-center mb-5">
                            <h1 class="fw-bolder"><?=$sectionTitle?></h1>
                            <p class="lead fw-normal text-muted mb-0"><?=$sectionDescription?></p>
                        </div>
                        <div class="row gx-5">
                            <?php if($portfolios): ?>
                                <?php foreach($portfolios as $portfolio): ?>
                                    <div class="col-lg-6">
                                        <div class="position-relative mb-5">
                                            <img class="img-fluid rounded-3 mb-3" src="<?=getImageUrl($portfolio['featured_image'] ?? getDefaultImagePath())?>" alt="<?= $portfolio['title']; ?>" />
                                            <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" href="<?= base_url('portfolio/'.$portfolio['slug']) ?>"><?= $portfolio['title']; ?></a>
                                        </div>
                                    </div>
                                <!-- End Portfolio Item -->
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <!-- End Portfolio Section -->
              <?php
            } elseif ($section === "Team") {
              ?>
                <!-- Team Section -->
                    <section class="py-5 bg-light" id="team">
                        <div class="container px-5 my-5">
                            <div class="text-center">
                                <h2 class="fw-bolder"><?=$sectionTitle?></h2>
                                <p class="lead fw-normal text-muted mb-5"><?=$sectionDescription?></p>
                            </div>
                            <div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-4 justify-content-center">
                            <?php if($teams): ?>
                                <?php foreach($teams as $team): ?>
                                <div class="col mb-5 mb-5 mb-xl-0">
                                    <div class="text-center">
                                        <img class="img-fluid rounded-circle mb-4 px-4" src="<?=getImageUrl($team['image'] ?? getDefaultImagePath())?>" alt="<?= $team['name']; ?>" />
                                        <h5 class="fw-bolder"><?= $team['name']; ?></h5>
                                        <div class="fst-italic text-muted"><?= $team['title']; ?></div>
                                    </div>
                                </div>
                                <!-- End Team Member -->
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </div>
                        </div>
                    </section>
                <!-- /Team Section -->
              <?php
            } elseif ($section === "Partners") {
                ?>
                <!-- Clients Section -->
                <section class="py-5 bg-light">
                    <div class="container px-5">
                        <div class="row">
                            <div class="col-12 text-center mb-5">
                                <h2 class="fw-bolder"><?=$sectionTitle?></h2>
                                <p class="lead text-muted"><?=$sectionDescription?></p>
                            </div>
                        </div>
                        <div class="row g-5 justify-content-center">
                            <?php if($partners): ?>
                                <?php foreach($partners as $partner): ?>
                                    <div class="col-6 col-md-4 col-lg-2 text-center">
                                        <img loading="lazy" src="<?=getImageUrl($partner['logo'] ?? getDefaultImagePath())?>" alt="<?=$partner['title']?>" class="img-fluid grayscale opacity-75 hover-opacity-100">
                                    </div>
                                <!-- End Partner Item -->
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <!-- /Clients Section -->
                <?php
            } elseif ($section === "CallToAction") {
                ?>
                  <!-- Call To Action Section -->
                  <section class="py-2">
                        <div class="container px-5 my-5">
                            <div class="text-center mb-5">
                                <h1 class="fw-bolder"><?=$sectionTitle?></h1>
                                <p class="lead fw-normal text-muted mb-0"><?=$sectionDescription?></p>
                            </div>
                            <!-- Call to action-->
                            <?php
                                $callToActionImage = getHomePageData("CallToAction", "section_image");
                                $callToActionVideo = getHomePageData("CallToAction", "section_video");
                                $callToActionTitle = getHomePageData("CallToAction", "section_title");
                                $callToActionDescription = getHomePageData("CallToAction", "section_description");
                            ?>
                             <aside class="bg-primary call-to-action rounded-3 p-4 p-sm-5 mt-5 position-relative" style="background-image: url('<?=$callToActionImage?>');">
                                <div class="overlay"></div>
                                <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start position-relative">
                                    <div class="mb-4 mb-xl-0">
                                        <div class="fs-3 fw-bold text-white text-shadow"><?=$sectionTitle?></div>
                                        <div class="text-white text-shadow"><?=$callToActionDescription?></div>
                                    </div>
                                    <div class="ms-xl-4">
                                        <a href="#!" class="btn btn-outline-light w-100">
                                            Get In Touch!
                                        </a>
                                    </div>
                                </div>
                            </aside>
                        </div>
                        <div class="row d-flex justify-content-center align-items-center">
                                <!--scrollable -->
                                <?php
                                $useTwitterFeed = getConfigData("UseTwitterFeed");
                                $twitterFeedCode = getConfigData("TwitterFeedCode");

                                if (strtolower($useTwitterFeed) === "yes") {
                                    ?>
                                        <div class="col-12 col-md-8 mt-2" style="height: 40em; overflow-y: scroll;">
                                            <?=$twitterFeedCode?>
                                        </div>
                                    <?php
                                }
                                ?>
                        </div>
                    </section>
                <!-- /Call To Action Section -->
                <?php
            } elseif ($section === "RecentPosts") {
              ?>
                <!-- Recent Posts Section -->
                <section class="py-5" id="blog">
                    <div class="container px-5 my-5">
                        <div class="row gx-5 justify-content-center">
                            <div class="col-lg-8 col-xl-6">
                                <div class="text-center">
                                    <h2 class="fw-bolder"><?=$sectionTitle?></h2>
                                    <p class="lead fw-normal text-muted mb-5"><?=$sectionDescription?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row gx-5">
                            <?php if($blogs): ?>
                                <?php foreach($blogs as $blog): ?>
                                    <div class="col-lg-4 mb-5">
                                        <div class="card h-100 shadow border-0">
                                            <img class="card-img-top" src="<?=getImageUrl($blog['featured_image'] ?? getDefaultImagePath())?>" alt="<?= $blog['title']; ?>" />
                                            <div class="card-body p-4">
                                                <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?= !empty($blog['category']) ? getBlogCategoryName($blog['category']) : "" ?></div>
                                                <a class="text-decoration-none link-dark stretched-link" href="<?= base_url('blog/'.$blog['slug']) ?>"><h5 class="card-title mb-3"><?= $blog['title']; ?></h5></a>
                                                <p class="card-text mb-0"><?= !empty($blog['excerpt']) ? getTextSummary($blog['excerpt']) : getTextSummary($blog['content']) ?></p>
                                            </div>
                                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                                <div class="d-flex align-items-end justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <img class="rounded-circle me-3" src="<?=getImageUrl(getUserData($blog['created_by'], "profile_picture") ?? getDefaultProfileImagePath())?>" alt="<?= getActivityBy(esc($blog['created_by'])); ?>" height="45" />
                                                        <div class="small">
                                                            <div class="fw-bold"><?= getActivityBy(esc($blog['created_by'])); ?></div>
                                                            <div class="text-muted"><?= dateFormat($blog['created_at'], 'M j, Y'); ?> &middot; <?=estimateReadTime($blog['content']) ?> min read</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- End post list item -->
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <!-- /Recent Posts Section -->
                <?php
            } elseif ($section === "Subscribe") {
                ?>
                <!-- Subscribe Section -->
				<section class="py-2" id="subscribe">
					<div class="container">
						<aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5 mt-5">
							<div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
								<div class="mb-4 mb-xl-0">
									<div class="fs-3 fw-bold text-white"><?=$sectionTitle?></div>
									<div class="text-white-50"><?=$sectionDescription?></div>
								</div>
								<div class="ms-xl-4">
                                    <form action="<?= base_url('/api/add-subscriber') ?>" method="post" class="g-3 needs-validation" id="subscribeForm">
                                        <?= csrf_field() ?>
                                        <?=getHoneypotInput()?>
                                        <div class="input-group mb-2">
                                            <div class="col-12">
                                                <input type="hidden" class="form-control" name="return_url" id="return_url" placeholder="return url" value="<?=current_url()."?#subscribe"?>">
                                            </div>
                                            <input class="form-control" type="email" name="email" name="email" placeholder="Email address..." aria-label="Email address..." aria-describedby="button-newsletter" required />
                                            <div class="invalid-feedback">
                                                Please provide email
                                            </div>
                                            <button class="btn btn-outline-light" id="button-newsletter" type="submit">Subscribe Now</button>
                                        </div>
                                        <!--hcaptcha validation-->
                                        <?=renderHcaptcha()?>
                                        <div class="small text-white-50">We care about privacy, and will never share your data.</div>
                                    </form>
								</div>
							</div>
						</aside>
					</div>
				</section>
                <!-- /Subscribe Section -->
                <?php
            }  elseif ($section === "Contact") {
                ?>
                  <!-- Contact Section -->
                  <section class="py-5" id="contact">
                    <div class="container px-5">
                        <!-- Contact form-->
                        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                            <div class="text-center mb-5">
                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                                <h1 class="fw-bolder"><?=$sectionTitle?></h1>
                                <p class="lead fw-normal text-muted mb-0"><?=$sectionDescription?></p>
                            </div>
                            <div class="row gx-5 justify-content-center">
                                <div class="col-lg-8 col-xl-6">
                                    <!-- * * * * * * * * * * * * * * *-->
                                    <!-- * * SB Forms Contact Form * *-->
                                    <!-- * * * * * * * * * * * * * * *-->
                                    <!-- This form is pre-integrated with SB Forms.-->
                                    <!-- To make this form functional, sign up at-->
                                    <!-- https://startbootstrap.com/solution/contact-forms-->
                                    <!-- to get an API token!-->
                                    <form action="<?= base_url('/api/send-contact-message') ?>" method="post" class="g-3 needs-validation" id="contactForm">
                                        <?= csrf_field() ?>
                                        <?=getHoneypotInput()?>
                                        <!-- Name input-->
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name..." required/>
                                            <label for="name">Full name</label>
                                            <div class="invalid-feedback">
                                                Please provide name
                                            </div>
                                        </div>
                                        <!-- Email address input-->
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" required />
                                            <label for="email">Email address</label>
                                            <div class="invalid-feedback">
                                                Please provide email
                                            </div>
                                        </div>
                                        <!-- Phone number input-->
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="phone" name="phone" type="tel" placeholder="(123) 456-7890" required/>
                                            <label for="phone">Phone number</label>
                                            <div class="invalid-feedback">
                                                Please provide phone number
                                            </div>
                                        </div>
                                        <!-- Message input-->
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="message" name="message" type="text" placeholder="Enter your message here..." style="height: 10rem" required></textarea>
                                            <label for="message">Message</label>
                                            <div class="invalid-feedback">
                                                Please provide message
                                            </div>
                                        </div>

                                        <!--hcaptcha validation-->
                                        <?=renderHcaptcha()?>

                                        <div class="col-12">
                                            <input type="hidden" class="form-control" name="return_url" id="return_url" placeholder="return url" value="<?=current_url('?#contact')?>">
                                        </div>
                                        
                                        <!-- Submit Button-->
                                        <div class="d-grid"><button class="btn btn-primary btn-lg" id="submitButton" type="submit">Submit</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Contact cards-->
                        <div class="row gx-5 row-cols-2 row-cols-lg-4 py-5">
                            <div class="col">
                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-chat-dots"></i></div>
                                <div class="h5 mb-2">Chat with us</div>
                                <p class="text-muted mb-0">Chat live with one of our support specialists.</p>
                            </div>
                            <div class="col">
                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people"></i></div>
                                <div class="h5">Ask the community</div>
                                <p class="text-muted mb-0">Explore our community forums and communicate with other users.</p>
                            </div>
                            <div class="col">
                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-question-circle"></i></div>
                                <div class="h5">Support center</div>
                                <p class="text-muted mb-0">
                                    <a href="#faq">Browse FAQ's and support articles to find solutions.</a>
                                </p>
                            </div>
                            <div class="col">
                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-telephone"></i></div>
                                <div class="h5">Call us</div>
                                <p class="text-muted mb-0">Call us during normal business hours at <?=$companyNumber?>.</p>
                            </div>
                        </div>
                    </div>
                </section>
                  <!-- /Contact Section -->
                <?php
            }
          ?>
    <?php endforeach; ?>
  <?php endif; ?>
  <!-- ////// END Home Pages ///// -->

   <!--Advert Popup Section-->
  <?= $this->include('front-end/themes/_shared/_advert_popups.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>