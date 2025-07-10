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

//page settings
$currentPage = "home";
$popUpWhereClause = ['status' => 1];
?>

<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
              <h2>Strategic Solutions for Business Growth</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              <div class="hero-btns">
                <a href="#contact" class="btn btn-primary">Get a Free Consultation</a>
                <a href="#services" class="btn btn-outline">Our Services</a>
              </div>
              <div class="hero-stats">
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>+</h3>
                  <p>Years Experience</p>
                </div>
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="1" class="purecounter"></span>+</h3>
                  <p>Clients Worldwide</p>
                </div>
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="98" data-purecounter-duration="1" class="purecounter"></span>%</h3>
                  <p>Success Rate</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
              <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/about/about-8.webp" alt="Consulting Services" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section">

      <div data-aos="fade-up" data-aos-delay="100">

        <div class="clients-slider swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 6000,
              "autoplay": {
                "delay": 1,
                "disableOnInteraction": false
              },
              "centeredSlides": true,
              "slideToClickedSlide": true,
              "slidesPerView": "auto",
              "spaceBetween": 40,
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 20
                },
                "640": {
                  "slidesPerView": 3,
                  "spaceBetween": 20
                },
                "992": {
                  "slidesPerView": 4,
                  "spaceBetween": 30
                },
                "1200": {
                  "slidesPerView": 6,
                  "spaceBetween": 40
                }
              }
            }
          </script>

          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="client-logo">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/clients/clients-1.webp" class="img-fluid" alt="">
              </div>
            </div><!-- End Client Item -->

            <div class="swiper-slide">
              <div class="client-logo">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/clients/clients-2.webp" class="img-fluid" alt="">
              </div>
            </div><!-- End Client Item -->

            <div class="swiper-slide">
              <div class="client-logo">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/clients/clients-3.webp" class="img-fluid" alt="">
              </div>
            </div><!-- End Client Item -->

            <div class="swiper-slide">
              <div class="client-logo">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/clients/clients-4.webp" class="img-fluid" alt="">
              </div>
            </div><!-- End Client Item -->

            <div class="swiper-slide">
              <div class="client-logo">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/clients/clients-5.webp" class="img-fluid" alt="">
              </div>
            </div><!-- End Client Item -->

            <div class="swiper-slide">
              <div class="client-logo">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/clients/clients-6.webp" class="img-fluid" alt="">
              </div>
            </div><!-- End Client Item -->

            <div class="swiper-slide">
              <div class="client-logo">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/clients/clients-1.webp" class="img-fluid" alt="">
              </div>
            </div><!-- End Client Item -->

            <div class="swiper-slide">
              <div class="client-logo">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/clients/clients-2.webp" class="img-fluid" alt="">
              </div>
            </div><!-- End Client Item -->

            <div class="swiper-slide">
              <div class="client-logo">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/clients/clients-3.webp" class="img-fluid" alt="">
              </div>
            </div><!-- End Client Item -->

            <div class="swiper-slide">
              <div class="client-logo">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/clients/clients-4.webp" class="img-fluid" alt="">
              </div>
            </div><!-- End Client Item -->

            <div class="swiper-slide">
              <div class="client-logo">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/clients/clients-5.webp" class="img-fluid" alt="">
              </div>
            </div><!-- End Client Item -->

            <div class="swiper-slide">
              <div class="client-logo">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/clients/clients-6.webp" class="img-fluid" alt="">
              </div>
            </div><!-- End Client Item -->

          </div>

        </div>

      </div>

    </section><!-- /Clients Section -->

    <!-- About Section -->
    <section id="about" class="about section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 align-items-center justify-content-between">

          <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
            <span class="about-meta">MORE ABOUT US</span>
            <h2 class="about-title">Voluptas enim suscipit temporibus</h2>
            <p class="about-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>

            <div class="row feature-list-wrapper">
              <div class="col-md-6">
                <ul class="feature-list">
                  <li><i class="bi bi-check-circle-fill"></i> Lorem ipsum dolor sit amet</li>
                  <li><i class="bi bi-check-circle-fill"></i> Consectetur adipiscing elit</li>
                  <li><i class="bi bi-check-circle-fill"></i> Sed do eiusmod tempor</li>
                </ul>
              </div>
              <div class="col-md-6">
                <ul class="feature-list">
                  <li><i class="bi bi-check-circle-fill"></i> Incididunt ut labore et</li>
                  <li><i class="bi bi-check-circle-fill"></i> Dolore magna aliqua</li>
                  <li><i class="bi bi-check-circle-fill"></i> Ut enim ad minim veniam</li>
                </ul>
              </div>
            </div>

            <div class="info-wrapper">
              <div class="row gy-4">
                <div class="col-lg-5">
                  <div class="profile d-flex align-items-center gap-3">
                    <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/person/person-m-2.webp" alt="CEO Profile" class="profile-image">
                    <div>
                      <h4 class="profile-name">Mario Smith</h4>
                      <p class="profile-position">CEO &amp; Founder</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-7">
                  <div class="contact-info d-flex align-items-center gap-2">
                    <i class="bi bi-telephone-fill"></i>
                    <div>
                      <p class="contact-label">Call us anytime</p>
                      <p class="contact-number">+123 456-789</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
            <div class="image-wrapper">
              <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/about/about-5.webp" alt="Business Meeting" class="img-fluid main-image rounded-4">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/about/about-square-1.webp" alt="Team Discussion" class="img-fluid small-image rounded-4">
              </div>
              <div class="experience-badge floating">
                <h3>15+ <span>Years</span></h3>
                <p>Of experience in business service</p>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="stats-hero row align-items-center mb-5">
          <div class="col-lg-7 mb-4 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
            <h3 class="headline mb-3">Transforming Data Into Impactful Insights</h3>
            <p class="lead">Nunc euismod, tortor nec facilisis egestas, ligula turpis cursus odio, a lobortis sapien ipsum et dolor. Morbi dignissim cursus massa non lobortis.</p>
          </div>
          <div class="col-lg-5 text-lg-end text-center" data-aos="zoom-in" data-aos-delay="300">
            <div class="stats-rating d-inline-flex align-items-center py-3 px-4 shadow-sm">
              <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/about/about-1.webp" class="img-fluid stats-rating-img me-3" alt="User Group" width="64" height="48">
              <div>
                <div class="rating-score d-flex align-items-center mb-1">
                  <span class="fs-5 fw-semibold me-2">4.8/5</span>
                  <span class="stars">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-half"></i>
                  </span>
                </div>
                <div class="user-feedback small">Based on 70+ unique user reviews</div>
              </div>
            </div>
          </div>
        </div>

        <div class="stats-counters row gy-4 justify-content-center">
          <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
            <article class="stats-counter-card">
              <div class="counter-value mb-1">
                <span data-purecounter-start="0" data-purecounter-end="120" data-purecounter-duration="1.5" class="purecounter"></span>K+
              </div>
              <small class="label">Active Clients</small>
            </article>
          </div>
          <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
            <article class="stats-counter-card">
              <div class="counter-value mb-1">
                <span data-purecounter-start="0" data-purecounter-end="34" data-purecounter-duration="1.5" class="purecounter"></span>K+
              </div>
              <small class="label">Analytics Projects</small>
            </article>
          </div>
          <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
            <article class="stats-counter-card">
              <div class="counter-value mb-1">
                <span data-purecounter-start="0" data-purecounter-end="97" data-purecounter-duration="1.5" class="purecounter"></span>%
              </div>
              <small class="label">Automation Success</small>
            </article>
          </div>
          <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="400">
            <article class="stats-counter-card">
              <div class="counter-value mb-1">
                <span data-purecounter-start="0" data-purecounter-end="99.96" data-purecounter-duration="1.5" class="purecounter"></span>%
              </div>
              <small class="label">Cloud Reliability</small>
            </article>
          </div>
        </div><!-- End stats counters -->

      </div>

    </section><!-- /Stats Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 justify-content-center">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <article class="service-item">
              <span class="service-icon rounded-circle">
                <i class="bi bi-palette"></i>
              </span>
              <h3>
                <a href="service-details.html">
                  Creative <span>branding</span>
                </a>
              </h3>
              <p>
                Suspendisse in ultricies ipsum. Nulla commodo sem ac tortor rhoncus, vel volutpat magna varius. Nam porta felis non convallis finibus.
              </p>
              <a href="service-details.html" class="card-action rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-arrow-up-right"></i>
              </a>
            </article>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
            <article class="service-item">
              <span class="service-icon rounded-circle">
                <i class="bi bi-gem"></i>
              </span>
              <h3>
                <a href="service-details.html">
                  Design <span>systems</span>
                </a>
              </h3>
              <p>
                Fusce aliquet, nibh ac facilisis viverra, nulla purus aliquet diam, quis consectetur risus dolor a diam. Vivamus convallis lacinia magna.
              </p>
              <a href="service-details.html" class="card-action rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-arrow-up-right"></i>
              </a>
            </article>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <article class="service-item">
              <span class="service-icon rounded-circle">
                <i class="bi bi-megaphone"></i>
              </span>
              <h3>
                <a href="service-details.html">
                  Marketing <span>strategies</span>
                </a>
              </h3>
              <p>
                Aliquam erat volutpat. Integer at sapien at risus elementum ornare a sit amet odio. Mauris quis magna vel enim pretium maximus.
              </p>
              <a href="service-details.html" class="card-action rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-arrow-up-right"></i>
              </a>
            </article>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <article class="service-item">
              <span class="service-icon rounded-circle">
                <i class="bi bi-code-slash"></i>
              </span>
              <h3>
                <a href="service-details.html">
                  Digital <span>platforms</span>
                </a>
              </h3>
              <p>
                Sed in tortor eget lacus gravida dignissim eu sed leo. Etiam sed aliquet massa, id imperdiet purus. Curabitur nec ullamcorper lorem.
              </p>
              <a href="service-details.html" class="card-action rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-arrow-up-right"></i>
              </a>
            </article>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <article class="service-item">
              <span class="service-icon rounded-circle">
                <i class="bi bi-graph-up"></i>
              </span>
              <h3>
                <a href="service-details.html">
                  Growth <span>acceleration</span>
                </a>
              </h3>
              <p>
                Pellentesque faucibus, augue at maximus ultricies, metus velit malesuada elit, vitae tristique lorem dui sed tellus. Integer sed tortor sed.
              </p>
              <a href="service-details.html" class="card-action rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-arrow-up-right"></i>
              </a>
            </article>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
            <article class="service-item">
              <span class="service-icon rounded-circle">
                <i class="bi bi-camera-video"></i>
              </span>
              <h3>
                <a href="service-details.html">
                  Media <span>solutions</span>
                </a>
              </h3>
              <p>
                Morbi dapibus metus ac condimentum pellentesque. Curabitur eget dictum lacus. Cras et augue vitae ex dictum tincidunt quis quis tellus.
              </p>
              <a href="service-details.html" class="card-action rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-arrow-up-right"></i>
              </a>
            </article>
          </div>
        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Alt Services Section -->
    <section id="alt-services" class="alt-services section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4">
          <div class="col-lg-6 col-xl-3">
            <div class="service-card" data-aos="zoom-in" data-aos-delay="100">
              <div class="card-header">
                <div class="icon-box">
                  <i class="bi bi-shield-check"></i>
                </div>
                <h4>Consectetur adipiscing</h4>
              </div>
              <div class="card-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                <div class="feature-image">
                  <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/services/services-1.webp" alt="Security Services" class="img-fluid">
                </div>
              </div>
              <div class="card-footer">
                <a href="#" class="btn-explore">
                  Explore Service
                  <i class="bi bi-arrow-up-right"></i>
                </a>
              </div>
            </div>
          </div><!-- /Service Card -->

          <div class="col-lg-6 col-xl-3">
            <div class="service-card featured" data-aos="zoom-in" data-aos-delay="200">
              <div class="card-header">
                <div class="icon-box">
                  <i class="bi bi-cpu"></i>
                </div>
                <h4>Sed do eiusmod</h4>
              </div>
              <div class="card-body">
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
                <div class="feature-image">
                  <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/services/services-2.webp" alt="Technology Solutions" class="img-fluid">
                </div>
              </div>
              <div class="card-footer">
                <a href="#" class="btn-explore">
                  Explore Service
                  <i class="bi bi-arrow-up-right"></i>
                </a>
              </div>
            </div>
          </div><!-- /Service Card -->

          <div class="col-lg-6 col-xl-3">
            <div class="service-card" data-aos="zoom-in" data-aos-delay="300">
              <div class="card-header">
                <div class="icon-box">
                  <i class="bi bi-rocket-takeoff"></i>
                </div>
                <h4>Tempor incididunt</h4>
              </div>
              <div class="card-body">
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <div class="feature-image">
                  <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/services/services-3.webp" alt="Innovation Services" class="img-fluid">
                </div>
              </div>
              <div class="card-footer">
                <a href="#" class="btn-explore">
                  Explore Service
                  <i class="bi bi-arrow-up-right"></i>
                </a>
              </div>
            </div>
          </div><!-- /Service Card -->

          <div class="col-lg-6 col-xl-3">
            <div class="service-card" data-aos="zoom-in" data-aos-delay="400">
              <div class="card-header">
                <div class="icon-box">
                  <i class="bi bi-puzzle"></i>
                </div>
                <h4>Ut labore dolore</h4>
              </div>
              <div class="card-body">
                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.</p>
                <div class="feature-image">
                  <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/services/services-4.webp" alt="Strategic Planning" class="img-fluid">
                </div>
              </div>
              <div class="card-footer">
                <a href="#" class="btn-explore">
                  Explore Service
                  <i class="bi bi-arrow-up-right"></i>
                </a>
              </div>
            </div>
          </div><!-- /Service Card -->

        </div>
      </div>
    </section><!-- /Alt Services Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Features</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center mb-5">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
            <div class="features-intro">
              <h2>Revolutionary Digital Solutions</h2>
              <p>Transforming business operations through innovative technology and strategic implementation methodologies.</p>
              <div class="highlights-grid">
                <div class="highlight-item">
                  <div class="highlight-number">99.9%</div>
                  <div class="highlight-text">Uptime Guarantee</div>
                </div>
                <div class="highlight-item">
                  <div class="highlight-number">24/7</div>
                  <div class="highlight-text">Expert Support</div>
                </div>
                <div class="highlight-item">
                  <div class="highlight-number">500+</div>
                  <div class="highlight-text">Satisfied Clients</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
            <div class="featured-image-container">
              <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/features/features-3.webp" alt="Digital Solutions" class="img-fluid">
              <div class="floating-badge">
                <i class="bi bi-award"></i>
                <span>Industry Leader</span>
              </div>
            </div>
          </div>
        </div>

        <div class="features-grid">
          <div class="row g-4">
            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
              <div class="feature-box text-center">
                <div class="feature-icon-wrapper">
                  <i class="bi bi-lightning-charge"></i>
                </div>
                <h4>Lightning Performance</h4>
                <p>Experience ultra-fast processing speeds with our optimized infrastructure and cutting-edge technology stack.</p>
                <div class="progress-indicator">
                  <div class="progress-bar" style="width: 95%;"></div>
                </div>
                <span class="progress-label">95% Efficiency</span>
              </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
              <div class="feature-box text-center">
                <div class="feature-icon-wrapper">
                  <i class="bi bi-shield-shaded"></i>
                </div>
                <h4>Advanced Security</h4>
                <p>Multi-layered security protocols ensure your data remains protected against modern cyber threats.</p>
                <div class="progress-indicator">
                  <div class="progress-bar" style="width: 100%;"></div>
                </div>
                <span class="progress-label">100% Secure</span>
              </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
              <div class="feature-box text-center">
                <div class="feature-icon-wrapper">
                  <i class="bi bi-layers"></i>
                </div>
                <h4>Seamless Integration</h4>
                <p>Connect all your existing systems effortlessly with our flexible and scalable integration platform.</p>
                <div class="progress-indicator">
                  <div class="progress-bar" style="width: 88%;"></div>
                </div>
                <span class="progress-label">88% Compatibility</span>
              </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
              <div class="feature-box text-center">
                <div class="feature-icon-wrapper">
                  <i class="bi bi-graph-up"></i>
                </div>
                <h4>Smart Analytics</h4>
                <p>Gain valuable insights through sophisticated data analysis and real-time reporting capabilities.</p>
                <div class="progress-indicator">
                  <div class="progress-bar" style="width: 92%;"></div>
                </div>
                <span class="progress-label">92% Accuracy</span>
              </div>
            </div>
          </div>
        </div>

        <div class="advanced-features-section" data-aos="fade-up" data-aos-delay="100">
          <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up" data-aos-delay="200">
              <h3>Advanced Capabilities</h3>
              <p>Discover powerful features designed to elevate your business operations to the next level of excellence.</p>
            </div>
          </div>

          <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="300">
              <div class="advanced-feature-card">
                <div class="feature-header">
                  <div class="feature-number">01</div>
                  <div class="feature-status-badge enterprise">Enterprise</div>
                </div>
                <div class="feature-content">
                  <h5>Automated Workflow Engine</h5>
                  <p>Streamline complex business processes with intelligent automation that adapts to your organizational needs.</p>
                  <ul class="feature-benefits">
                    <li><i class="bi bi-check-circle"></i> Process Optimization</li>
                    <li><i class="bi bi-check-circle"></i> Error Reduction</li>
                  </ul>
                </div>
                <div class="feature-icon-bg">
                  <i class="bi bi-diagram-3"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="400">
              <div class="advanced-feature-card">
                <div class="feature-header">
                  <div class="feature-number">02</div>
                  <div class="feature-status-badge premium">Premium</div>
                </div>
                <div class="feature-content">
                  <h5>Real-time Collaboration</h5>
                  <p>Enable seamless teamwork with synchronized data sharing and instant communication across all platforms.</p>
                  <ul class="feature-benefits">
                    <li><i class="bi bi-check-circle"></i> Live Updates</li>
                    <li><i class="bi bi-check-circle"></i> Team Sync</li>
                  </ul>
                </div>
                <div class="feature-icon-bg">
                  <i class="bi bi-people"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="500">
              <div class="advanced-feature-card">
                <div class="feature-header">
                  <div class="feature-number">03</div>
                  <div class="feature-status-badge standard">Standard</div>
                </div>
                <div class="feature-content">
                  <h5>Predictive Intelligence</h5>
                  <p>Leverage machine learning algorithms to forecast trends and make data-driven strategic decisions.</p>
                  <ul class="feature-benefits">
                    <li><i class="bi bi-check-circle"></i> Trend Analysis</li>
                    <li><i class="bi bi-check-circle"></i> Risk Assessment</li>
                  </ul>
                </div>
                <div class="feature-icon-bg">
                  <i class="bi bi-cpu"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="600">
              <div class="advanced-feature-card">
                <div class="feature-header">
                  <div class="feature-number">04</div>
                  <div class="feature-status-badge coming-soon">Coming Soon</div>
                </div>
                <div class="feature-content">
                  <h5>Cloud Scalability</h5>
                  <p>Dynamic resource allocation ensures optimal performance during peak usage while maintaining cost efficiency.</p>
                  <ul class="feature-benefits">
                    <li><i class="bi bi-check-circle"></i> Auto Scaling</li>
                    <li><i class="bi bi-check-circle"></i> Cost Optimization</li>
                  </ul>
                </div>
                <div class="feature-icon-bg">
                  <i class="bi bi-cloud-arrow-up"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Features Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="why-us section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Why Us</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 align-items-center">
          <div class="col-lg-7 mb-4 mb-lg-0">
            <div class="row gy-4">

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card-item">
                  <div class="card-number">01</div>
                  <h3>Primus contactus</h3>
                  <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum. Morbi fermentum quam nec nunc varius bibendum.</p>
                </div>
              </div><!-- End Card Item -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card-item">
                  <div class="card-number">02</div>
                  <h3>Quaestio investigatio</h3>
                  <p>Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa.</p>
                </div>
              </div><!-- End Card Item -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card-item">
                  <div class="card-number">03</div>
                  <h3>Consilium evolutio</h3>
                  <p>Fusce convallis metus id felis luctus adipiscing. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue.</p>
                </div>
              </div><!-- End Card Item -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="card-item">
                  <div class="card-number">04</div>
                  <h3>Executio</h3>
                  <p>Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris.</p>
                </div>
              </div><!-- End Card Item -->

            </div>
          </div>

          <div class="col-lg-5" data-aos="zoom-out" data-aos-delay="300">
            <div class="image-wrapper">
              <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/about/about-portrait-3.webp" alt="" class="img-fluid rounded-4">
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Why Us Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="cta-wrapper">
          <div class="background-pattern">
            <div class="wave"></div>
            <div class="geometric-shape shape-1"></div>
            <div class="geometric-shape shape-2"></div>
          </div>

          <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2">
              <div class="image-section" data-aos="fade-left" data-aos-delay="200">
                <div class="main-image-wrapper">
                  <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/cta/cta-4.webp" alt="CTA Image" class="img-fluid main-img">
                  <div class="overlay-circle circle-1"></div>
                  <div class="overlay-circle circle-2"></div>
                </div>

                <div class="stats-card card-1" data-aos="zoom-in" data-aos-delay="400">
                  <div class="stat-icon">
                    <i class="bi bi-graph-up-arrow"></i>
                  </div>
                  <div class="stat-content">
                    <h6>95%</h6>
                    <span>Success Rate</span>
                  </div>
                </div>

                <div class="stats-card card-2" data-aos="zoom-in" data-aos-delay="500">
                  <div class="stat-icon">
                    <i class="bi bi-trophy-fill"></i>
                  </div>
                  <div class="stat-content">
                    <h6>50K+</h6>
                    <span>Happy Clients</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 order-lg-1">
              <div class="content-section" data-aos="fade-right" data-aos-delay="300">
                <div class="label-badge" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-rocket-takeoff"></i>
                  <span>Launch Today</span>
                </div>

                <h2 data-aos="fade-up" data-aos-delay="450">Ready to Take Your Business to the Next Level?</h2>
                <p data-aos="fade-up" data-aos-delay="500">Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas.</p>

                <div class="features-grid" data-aos="fade-up" data-aos-delay="550">
                  <div class="feature-item">
                    <div class="feature-icon">
                      <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <span>24/7 Expert Support</span>
                  </div>

                  <div class="feature-item">
                    <div class="feature-icon">
                      <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <span>Advanced Analytics</span>
                  </div>

                  <div class="feature-item">
                    <div class="feature-icon">
                      <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <span>Seamless Integration</span>
                  </div>

                  <div class="feature-item">
                    <div class="feature-icon">
                      <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <span>Custom Solutions</span>
                  </div>
                </div>

                <div class="cta-actions" data-aos="fade-up" data-aos-delay="600">
                  <a href="#" class="btn btn-cta-primary">Get Started Free</a>
                  <div class="secondary-action">
                    <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="btn btn-cta-secondary glightbox">
                      <i class="bi bi-play-circle"></i>
                      Watch Demo
                    </a>
                    <span class="note">No credit card required</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Call To Action Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">App</li>
            <li data-filter=".filter-product">Product</li>
            <li data-filter=".filter-branding">Branding</li>
            <li data-filter=".filter-books">Books</li>
          </ul><!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <div class="portfolio-content h-100">
                <a href="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-1.webp" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-1.webp" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">App 1</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <div class="portfolio-content h-100">
                <a href="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-10.webp" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-10.webp" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Product 1</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <div class="portfolio-content h-100">
                <a href="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-7.webp" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-7.webp" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Branding 1</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
              <div class="portfolio-content h-100">
                <a href="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-4.webp" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-4.webp" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Books 1</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <div class="portfolio-content h-100">
                <a href="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-2.webp" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-2.webp" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">App 2</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <div class="portfolio-content h-100">
                <a href="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-11.webp" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-11.webp" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Product 2</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <div class="portfolio-content h-100">
                <a href="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-8.webp" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-8.webp" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Branding 2</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
              <div class="portfolio-content h-100">
                <a href="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-5.webp" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-5.webp" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Books 2</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <div class="portfolio-content h-100">
                <a href="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-3.webp" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-3.webp" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">App 3</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <div class="portfolio-content h-100">
                <a href="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-12.webp" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-12.webp" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Product 3</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <div class="portfolio-content h-100">
                <a href="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-9.webp" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-9.webp" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Branding 3</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
              <div class="portfolio-content h-100">
                <a href="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-6.webp" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/portfolio/portfolio-6.webp" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Books 3</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Pricing</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 justify-content-center">

          <!-- Basic Plan -->
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="pricing-card">
              <h3>Basic Plan</h3>
              <div class="price">
                <span class="currency">$</span>
                <span class="amount">9.9</span>
                <span class="period">/ month</span>
              </div>
              <p class="description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam.</p>

              <h4>Featured Included:</h4>
              <ul class="features-list">
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Duis aute irure dolor
                </li>
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Excepteur sint occaecat
                </li>
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Nemo enim ipsam voluptatem
                </li>
              </ul>

              <a href="#" class="btn btn-primary">
                Buy Now
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>

          <!-- Standard Plan -->
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="pricing-card popular">
              <div class="popular-badge">Most Popular</div>
              <h3>Standard Plan</h3>
              <div class="price">
                <span class="currency">$</span>
                <span class="amount">19.9</span>
                <span class="period">/ month</span>
              </div>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.</p>

              <h4>Featured Included:</h4>
              <ul class="features-list">
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Lorem ipsum dolor sit amet
                </li>
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Consectetur adipiscing elit
                </li>
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Sed do eiusmod tempor
                </li>
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Ut labore et dolore magna
                </li>
              </ul>

              <a href="#" class="btn btn-light">
                Buy Now
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>

          <!-- Premium Plan -->
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="pricing-card">
              <h3>Premium Plan</h3>
              <div class="price">
                <span class="currency">$</span>
                <span class="amount">39.9</span>
                <span class="period">/ month</span>
              </div>
              <p class="description">Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae.</p>

              <h4>Featured Included:</h4>
              <ul class="features-list">
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Temporibus autem quibusdam
                </li>
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Saepe eveniet ut et voluptates
                </li>
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Nam libero tempore soluta
                </li>
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Cumque nihil impedit quo
                </li>
                <li>
                  <i class="bi bi-check-circle-fill"></i>
                  Maxime placeat facere possimus
                </li>
              </ul>

              <a href="#" class="btn btn-primary">
                Buy Now
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Pricing Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="content px-xl-5">
              <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
              </p>
            </div>
          </div>

          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

            <div class="faq-container">
              <div class="faq-item faq-active">
                <h3><span class="num">1.</span> <span>Non consectetur a erat nam at lectus urna duis?</span></h3>
                <div class="faq-content">
                  <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span class="num">2.</span> <span>Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?</span></h3>
                <div class="faq-content">
                  <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span class="num">3.</span> <span>Dolor sit amet consectetur adipiscing elit pellentesque?</span></h3>
                <div class="faq-content">
                  <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span class="num">4.</span> <span>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</span></h3>
                <div class="faq-content">
                  <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span class="num">5.</span> <span>Tempus quam pellentesque nec nam aliquam sem et tortor consequat?</span></h3>
                <div class="faq-content">
                  <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div>
        </div>

      </div>

    </section><!-- /Faq Section -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 justify-content-center">

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="team-card">
              <div class="profile-image">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/person/person-f-3.webp" class="img-fluid" alt="" loading="lazy">
                <div class="role-badge">Senior Developer</div>
                <div class="social-icons">
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Olivia Martinez</h4>
                <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
              </div>
            </div><!-- End Team Card -->
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="team-card">
              <div class="profile-image">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/person/person-m-9.webp" class="img-fluid" alt="" loading="lazy">
                <div class="role-badge">Creative Director</div>
                <div class="social-icons">
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>James Wilson</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Pellentesque habitant morbi tristique.</p>
              </div>
            </div><!-- End Team Card -->
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="team-card">
              <div class="profile-image">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/person/person-f-8.webp" class="img-fluid" alt="" loading="lazy">
                <div class="role-badge">Project Manager</div>
                <div class="social-icons">
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Sophia Johnson</h4>
                <p>Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex.</p>
              </div>
            </div><!-- End Team Card -->
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
            <div class="team-card">
              <div class="profile-image">
                <img src="https://bootstrapmade.com/content/demo/eBusiness/assets/img/person/person-m-12.webp" class="img-fluid" alt="" loading="lazy">
                <div class="role-badge">Business Analyst</div>
                <div class="social-icons">
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Benjamin Davis</h4>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
              </div>
            </div><!-- End Team Card -->
          </div>

        </div>

      </div>

    </section><!-- /Team Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 g-lg-5">
          <div class="col-lg-5">
            <div class="info-box" data-aos="fade-up" data-aos-delay="200">
              <h3>Contact Info</h3>
              <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis.</p>

              <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box">
                  <i class="bi bi-geo-alt"></i>
                </div>
                <div class="content">
                  <h4>Our Location</h4>
                  <p>A108 Adam Street</p>
                  <p>New York, NY 535022</p>
                </div>
              </div>

              <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box">
                  <i class="bi bi-telephone"></i>
                </div>
                <div class="content">
                  <h4>Phone Number</h4>
                  <p>+1 5589 55488 55</p>
                  <p>+1 6678 254445 41</p>
                </div>
              </div>

              <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box">
                  <i class="bi bi-envelope"></i>
                </div>
                <div class="content">
                  <h4>Email Address</h4>
                  <p>info@example.com</p>
                  <p>contact@example.com</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-7">
            <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
              <h3>Get In Touch</h3>
              <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis.</p>

              <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                <div class="row gy-4">

                  <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                  </div>

                  <div class="col-md-6 ">
                    <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                  </div>

                  <div class="col-12">
                    <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                  </div>

                  <div class="col-12">
                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                  </div>

                  <div class="col-12 text-center">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>

                    <button type="submit" class="btn">Send Message</button>
                  </div>

                </div>
              </form>

            </div>
          </div>

        </div>

      </div>

    </section><!-- /Contact Section -->


<!-- end main content -->
<?= $this->endSection() ?>


