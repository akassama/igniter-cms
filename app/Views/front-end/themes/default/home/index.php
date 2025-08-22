<?php
// This is to get current impact
$theme = getCurrentTheme();

//page settings
$currentPage = "home";
$popUpWhereClause = ['status' => 1];

$enableHomeSeo = getTableData('plugin_configs', ['plugin_slug' => 'seo-master', 'config_key' => 'enable_home_seo'], 'config_value');
?>

<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
<!-- ////// BEGIN Get Home Pages ///// -->
    <!-- Hero Carousel Section -->
    <section id="home" class="hero-carousel">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="hero-slide d-flex align-items-center" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://assets.aktools.net/image-stocks/hero-carousels/hero-carousel-1.jpg') no-repeat center center; background-size: cover;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 mx-auto text-center">
                                    <h1 class="display-3 fw-bold text-white">Your Trusted IT Partner</h1>
                                    <p class="lead text-white mb-4">Comprehensive procurement solutions tailored to your business needs</p>
                                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                        <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Get in Touch</button>
                                        <button type="button" class="btn btn-outline-light btn-lg px-4">Our Services</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="hero-slide d-flex align-items-center" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://assets.aktools.net/image-stocks/hero-carousels/hero-carousel-2.jpg') no-repeat center center; background-size: cover;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 mx-auto text-center">
                                    <h1 class="display-3 fw-bold text-white">Cloud Transformation Experts</h1>
                                    <p class="lead text-white mb-4">Migrate and optimize your infrastructure with our certified cloud specialists</p>
                                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                        <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Cloud Assessment</button>
                                        <button type="button" class="btn btn-outline-light btn-lg px-4">Case Studies</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="hero-slide d-flex align-items-center" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://assets.aktools.net/image-stocks/hero-carousels/hero-carousel-3.jpg') no-repeat center center; background-size: cover;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 mx-auto text-center">
                                    <h1 class="display-3 fw-bold text-white">Enterprise Security Solutions</h1>
                                    <p class="lead text-white mb-4">Protect your business with our comprehensive cybersecurity services</p>
                                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                        <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Security Audit</button>
                                        <button type="button" class="btn btn-outline-light btn-lg px-4">Learn More</button>
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

    <!-- About Section -->
    <section id="about" class="about section py-5">
        <!-- Section Title -->
        <div class="container section-title text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold">About Us</h2>
            <p class="lead">Delivering innovative technology solutions to power your business growth</p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="fw-bold mb-4">Your Trusted IT Solutions Partner</h3>
                    <img src="https://assets.aktools.net/image-stocks/about/about-2.jpg" class="img-fluid rounded-4 mb-4" alt="GEXPOTECH Team">
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
                            <img src="https://assets.aktools.net/image-stocks/about/about-3.jpg" class="img-fluid rounded-4" alt="Our Office">
                            <a href="https://www.youtube.com/watch?v=BqFSHbzSs7U" class="glightbox play-btn d-flex align-items-center justify-content-center">
                                <i class="bi bi-play-fill fs-1 text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Do Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">What We Do</h2>
                    <p class="lead">We provide end-to-end IT solutions tailored to your business needs, helping you leverage technology for growth and efficiency.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">Our Services</h2>
                    <p class="lead">Comprehensive IT solutions designed to meet your business requirements</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary mb-4">
                                <i class="bi bi-laptop fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">IT Hardware & Software Procurement</h4>
                            <p class="mb-0">We source and supply high-quality IT hardware and software from trusted vendors at competitive prices.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary mb-4">
                                <i class="bi bi-cloud fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Cloud Solutions</h4>
                            <p class="mb-0">Migrate to the cloud with our comprehensive cloud services including setup, migration, and management.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary mb-4">
                                <i class="bi bi-lightbulb fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">IT Consulting & Strategy</h4>
                            <p class="mb-0">Our experts help you develop an IT strategy aligned with your business goals for maximum impact.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary mb-4">
                                <i class="bi bi-headset fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Managed IT Support</h4>
                            <p class="mb-0">Proactive IT support and maintenance to keep your systems running smoothly 24/7.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary mb-4">
                                <i class="bi bi-shield-lock fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Cybersecurity Services</h4>
                            <p class="mb-0">Protect your business from threats with our comprehensive security solutions and monitoring.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary mb-4">
                                <i class="bi bi-diagram-3 fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Networking and Infrastructure</h4>
                            <p class="mb-0">Design, implementation, and optimization of robust network infrastructure for your business.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sponsors Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">Trusted By Industry Leaders</h2>
                </div>
            </div>
            <div class="row align-items-center justify-content-center g-4">
                <div class="col-6 col-sm-4 col-md-2">
                    <img src="https://assets.aktools.net/image-stocks/clients/clients-1.png" alt="Partner Logo" class="img-fluid grayscale">
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <img src="https://assets.aktools.net/image-stocks/clients/clients-2.png" alt="Partner Logo" class="img-fluid grayscale">
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <img src="https://assets.aktools.net/image-stocks/clients/clients-3.png" alt="Partner Logo" class="img-fluid grayscale">
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <img src="https://assets.aktools.net/image-stocks/clients/clients-4.png" alt="Partner Logo" class="img-fluid grayscale">
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <img src="https://assets.aktools.net/image-stocks/clients/clients-5.png" alt="Partner Logo" class="img-fluid grayscale">
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <img src="https://assets.aktools.net/image-stocks/clients/clients-6.png" alt="Partner Logo" class="img-fluid grayscale">
                </div>
            </div>
        </div>
    </section>

    <!-- Counters Section -->
    <section id="counter" class="py-5 bg-dark text-white">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-6 col-md-3">
                    <div class="counter-box">
                        <i class="bi bi-check-circle fs-1 mb-3"></i>
                        <h2 class="fw-bold mb-1 counter" data-target="50" data-plus="true">0</h2>
                        <p class="mb-0">Projects Delivered</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="counter-box">
                        <i class="bi bi-people fs-1 mb-3"></i>
                        <h2 class="fw-bold mb-1 counter" data-target="320">0</h2>
                        <p class="mb-0">Clients Served</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="counter-box">
                        <i class="bi bi-calendar-check fs-1 mb-3"></i>
                        <h2 class="fw-bold mb-1 counter" data-target="12">0</h2>
                        <p class="mb-0">Years in Business</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="counter-box">
                        <i class="bi bi-person-badge fs-1 mb-3"></i>
                        <h2 class="fw-bold mb-1 counter" data-target="45">0</h2>
                        <p class="mb-0">Experts on Team</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="content px-xl-5">
                        <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
                        <p>
                            Find answers to common questions about our services and solutions. We're here to help you understand how we can meet your IT needs.
                        </p>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="faq-container">
                        <div class="faq-item faq-active">
                            <h3><span class="num">1.</span> <span>What industries do you specialize in?</span></h3>
                            <div class="faq-content">
                                <p>We serve clients across various industries including finance, healthcare, education, manufacturing, and retail. Our solutions are tailored to meet the specific needs and compliance requirements of each sector.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3><span class="num">2.</span> <span>How do you ensure the security of our data?</span></h3>
                            <div class="faq-content">
                                <p>We implement industry-standard security protocols including encryption, multi-factor authentication, regular security audits, and employee training. Our cybersecurity services provide additional layers of protection tailored to your specific needs.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3><span class="num">3.</span> <span>What is your typical project timeline?</span></h3>
                            <div class="faq-content">
                                <p>Project timelines vary based on scope and complexity. Simple implementations may take 2-4 weeks, while comprehensive solutions can span several months. We provide detailed project plans with milestones during our initial consultation.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3><span class="num">4.</span> <span>Do you offer ongoing support after implementation?</span></h3>
                            <div class="faq-content">
                                <p>Yes, we offer various support packages ranging from basic maintenance to fully managed services. Our support team is available 24/7 to ensure your systems remain operational and optimized.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="cta" class="cta-section position-relative py-5">
        <div class="cta-overlay"></div>
        <div class="container position-relative z-1">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-4 text-white">Ready to Transform Your IT Infrastructure?</h2>
                    <p class="lead mb-4 text-white-75">Let's discuss how we can help your business achieve its technology goals.</p>
                    <button class="btn btn-primary btn-lg px-4 py-3 fw-bold">Get Started Today <i class="bi bi-arrow-right ms-2"></i></button>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">What Our Clients Say</h2>
                    <p class="lead">Trusted by businesses of all sizes across industries</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex mb-3">
                                <img src="https://assets.aktools.net/image-stocks/testimonials/testimonial-1.jpg" alt="Client" class="rounded-circle me-3" width="60" height="60">
                                <div>
                                    <h5 class="fw-bold mb-1">Sarah Johnson</h5>
                                    <p class="text-muted small mb-0">CTO, TechForward Inc.</p>
                                </div>
                            </div>
                            <p class="mb-0">"GEXPOTECH transformed our IT infrastructure with their cloud solutions. Their team was professional, knowledgeable, and delivered ahead of schedule." </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex mb-3">
                                <img src="https://assets.aktools.net/image-stocks/testimonials/testimonial-2.jpg" alt="Client" class="rounded-circle me-3" width="60" height="60">
                                <div>
                                    <h5 class="fw-bold mb-1">Michael Chen</h5>
                                    <p class="text-muted small mb-0">Director, Global Retail Corp</p>
                                </div>
                            </div>
                            <p class="mb-0">"Their procurement service saved us 25% on our annual IT hardware budget while improving quality. Exceptional vendor relationships and negotiation skills."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex mb-3">
                                <img src="https://assets.aktools.net/image-stocks/testimonials/testimonial-3.jpg" alt="Client" class="rounded-circle me-3" width="60" height="60">
                                <div>
                                    <h5 class="fw-bold mb-1">David Wilson</h5>
                                    <p class="text-muted small mb-0">CEO, HealthCare Solutions</p>
                                </div>
                            </div>
                            <p class="mb-0">"The cybersecurity audit and implementation gave us peace of mind. GEXPOTECH's team understood our compliance requirements perfectly."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">Our Portfolio</h2>
                    <p class="lead">Explore our recent projects and success stories</p>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8 text-center">
                    <button class="btn btn-outline-primary filter-btn mb-1 active" data-filter="*">All</button>
                    <button class="btn btn-outline-primary filter-btn mb-1" data-filter=".cloud">Cloud Solutions</button>
                    <button class="btn btn-outline-primary filter-btn mb-1" data-filter=".network">Network Infrastructure</button>
                    <button class="btn btn-outline-primary filter-btn mb-1" data-filter=".security">Security</button>
                    <button class="btn btn-outline-primary filter-btn mb-1" data-filter=".procurement">IT Procurement</button>
                    <button class="btn btn-outline-primary filter-btn mb-1" data-filter=".managed">Managed Services</button>
                    <button class="btn btn-outline-primary filter-btn mb-1" data-filter=".strategy">IT Strategy</button>
                </div>
            </div>

            <!-- Portfolio Items -->
            <div class="row g-4 portfolio-container">
                <div class="col-md-6 col-lg-4 portfolio-item cloud">
                    <div class="card border-0 shadow-sm overflow-hidden h-100">
                        <a href="https://assets.aktools.net/image-stocks/portfolios/portfolio-1.jpg" class="glightbox" data-gallery="portfolioGallery">
                            <img src="https://assets.aktools.net/image-stocks/portfolios/portfolio-1.jpg" class="card-img-top" alt="Cloud Migration Project">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-bold mb-2">Enterprise Cloud Migration</h5>
                            <p class="text-muted small flex-grow-1">Seamless transition to hybrid cloud for a financial services firm</p>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary mt-2">View Case Study</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 portfolio-item network">
                    <div class="card border-0 shadow-sm overflow-hidden h-100">
                        <a href="https://assets.aktools.net/image-stocks/portfolios/portfolio-2.jpg" class="glightbox" data-gallery="portfolioGallery">
                            <img src="https://assets.aktools.net/image-stocks/portfolios/portfolio-2.jpg" class="card-img-top" alt="Network Upgrade Project">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-bold mb-2">Global Network Infrastructure</h5>
                            <p class="text-muted small flex-grow-1">Multi-site network upgrade for manufacturing client</p>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary mt-2">View Case Study</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 portfolio-item security">
                    <div class="card border-0 shadow-sm overflow-hidden h-100">
                        <a href="https://assets.aktools.net/image-stocks/portfolios/portfolio-3.jpg" class="glightbox" data-gallery="portfolioGallery">
                            <img src="https://assets.aktools.net/image-stocks/portfolios/portfolio-3.jpg" class="card-img-top" alt="Security Implementation">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-bold mb-2">Healthcare Security Implementation</h5>
                            <p class="text-muted small flex-grow-1">HIPAA-compliant security solution for hospital network</p>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary mt-2">View Case Study</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 portfolio-item procurement">
                    <div class="card border-0 shadow-sm overflow-hidden h-100">
                        <a href="https://assets.aktools.net/image-stocks/portfolios/portfolio-4.jpg" class="glightbox" data-gallery="portfolioGallery">
                            <img src="https://assets.aktools.net/image-stocks/portfolios/portfolio-4.jpg" class="card-img-top" alt="IT Procurement Project">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-bold mb-2">Enterprise IT Procurement</h5>
                            <p class="text-muted small flex-grow-1">Large-scale hardware refresh for education client</p>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary mt-2">View Case Study</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 portfolio-item managed">
                    <div class="card border-0 shadow-sm overflow-hidden h-100">
                        <a href="https://assets.aktools.net/image-stocks/portfolios/portfolio-5.jpg" class="glightbox" data-gallery="portfolioGallery">
                            <img src="https://assets.aktools.net/image-stocks/portfolios/portfolio-5.jpg" class="card-img-top" alt="Managed Services">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-bold mb-2">24/7 Managed Services</h5>
                            <p class="text-muted small flex-grow-1">Ongoing support for e-commerce platform</p>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary mt-2">View Case Study</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 portfolio-item strategy">
                    <div class="card border-0 shadow-sm overflow-hidden h-100">
                        <a href="https://assets.aktools.net/image-stocks/portfolios/portfolio-6.jpg" class="glightbox" data-gallery="portfolioGallery">
                            <img src="https://assets.aktools.net/image-stocks/portfolios/portfolio-6.jpg" class="card-img-top" alt="IT Strategy Project">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-bold mb-2">Digital Transformation Strategy</h5>
                            <p class="text-muted small flex-grow-1">3-year IT roadmap for retail chain expansion</p>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary mt-2">View Case Study</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="javascript:void(0);" class="btn btn-primary">View All Projects</a>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">Our Team</h2>
                    <p class="lead">Meet the experts behind GEXPOTECH's success</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="https://assets.aktools.net/image-stocks/teams/team-1.jpg" class="card-img-top" alt="Team Member">
                        <div class="card-body text-center">
                            <h5 class="fw-bold mb-1">Alex Thompson</h5>
                            <p class="text-muted small mb-3">CEO & Founder</p>
                            <div class="d-flex justify-content-center">
                                <a href="javascript:void(0);" class="text-dark me-2"><i class="bi bi-twitter-x"></i></a>
                                <a href="javascript:void(0);" class="text-dark me-2"><i class="bi bi-linkedin"></i></a>
                                <a href="javascript:void(0);" class="text-dark"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="https://assets.aktools.net/image-stocks/teams/team-2.jpg" class="card-img-top" alt="Team Member">
                        <div class="card-body text-center">
                            <h5 class="fw-bold mb-1">Sarah Williams</h5>
                            <p class="text-muted small mb-3">Chief Technology Officer</p>
                            <div class="d-flex justify-content-center">
                                <a href="javascript:void(0);" class="text-dark me-2"><i class="bi bi-twitter-x"></i></a>
                                <a href="javascript:void(0);" class="text-dark me-2"><i class="bi bi-linkedin"></i></a>
                                <a href="javascript:void(0);" class="text-dark"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="https://assets.aktools.net/image-stocks/teams/team-3.jpg" class="card-img-top" alt="Team Member">
                        <div class="card-body text-center">
                            <h5 class="fw-bold mb-1">Michael Rodriguez</h5>
                            <p class="text-muted small mb-3">Director of Operations</p>
                            <div class="d-flex justify-content-center">
                                <a href="javascript:void(0);" class="text-dark me-2"><i class="bi bi-twitter-x"></i></a>
                                <a href="javascript:void(0);" class="text-dark me-2"><i class="bi bi-linkedin"></i></a>
                                <a href="javascript:void(0);" class="text-dark"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="https://assets.aktools.net/image-stocks/teams/team-4.jpg" class="card-img-top" alt="Team Member">
                        <div class="card-body text-center">
                            <h5 class="fw-bold mb-1">Jennifer Lee</h5>
                            <p class="text-muted small mb-3">Client Solutions Manager</p>
                            <div class="d-flex justify-content-center">
                                <a href="javascript:void(0);" class="text-dark me-2"><i class="bi bi-twitter-x"></i></a>
                                <a href="javascript:void(0);" class="text-dark me-2"><i class="bi bi-linkedin"></i></a>
                                <a href="javascript:void(0);" class="text-dark"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section py-5">
        <!-- Section Title -->
        <div class="container section-title text-center mb-5">
            <h2 class="fw-bold">Our Pricing</h2>
            <p class="lead">Flexible pricing options to suit your business needs</p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row g-4">
                <!-- Basic Plan -->
                <div class="col-lg-4">
                    <div class="pricing-item">
                        <h3>Basic</h3>
                        <div class="icon">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h4><sup>$</sup>99<span> / month</span></h4>
                        <ul>
                            <li><i class="bi bi-check text-success"></i> <span>Basic IT Support</span></li>
                            <li><i class="bi bi-check text-success"></i> <span>Remote Assistance</span></li>
                            <li><i class="bi bi-check text-success"></i> <span>24/5 Monitoring</span></li>
                            <li><i class="bi bi-check text-success"></i> <span>Monthly Reports</span></li>
                            <li class="na"><i class="bi bi-x text-muted"></i> <span>On-site Support</span></li>
                            <li class="na"><i class="bi bi-x text-muted"></i> <span>Priority Response</span></li>
                        </ul>
                        <div class="text-center"><a href="javascript:void(0);" class="buy-btn">Get Started</a></div>
                    </div>
                </div><!-- End Pricing Item -->

                <!-- Professional Plan -->
                <div class="col-lg-4">
                    <div class="pricing-item featured">
                        <h3>Professional</h3>
                        <div class="icon">
                            <i class="bi bi-gear"></i>
                        </div>
                        <h4><sup>$</sup>299<span> / month</span></h4>
                        <ul>
                            <li><i class="bi bi-check text-success"></i> <span>Proactive IT Management</span></li>
                            <li><i class="bi bi-check text-success"></i> <span>Remote & On-site Support</span></li>
                            <li><i class="bi bi-check text-success"></i> <span>24/7 Monitoring</span></li>
                            <li><i class="bi bi-check text-success"></i> <span>Weekly Reports</span></li>
                            <li><i class="bi bi-check text-success"></i> <span>Priority Response</span></li>
                            <li class="na"><i class="bi bi-x text-muted"></i> <span>Dedicated Account Manager</span></li>
                        </ul>
                        <div class="text-center"><a href="javascript:void(0);" class="buy-btn">Get Started</a></div>
                    </div>
                </div><!-- End Pricing Item -->

                <!-- Enterprise Plan -->
                <div class="col-lg-4">
                    <div class="pricing-item">
                        <h3>Enterprise</h3>
                        <div class="icon">
                            <i class="bi bi-server"></i>
                        </div>
                        <h4><sup>$</sup>599<span> / month</span></h4>
                        <ul>
                            <li><i class="bi bi-check text-success"></i> <span>Fully Managed Services</span></li>
                            <li><i class="bi bi-check text-success"></i> <span>24/7 Premium Support</span></li>
                            <li><i class="bi bi-check text-success"></i> <span>Dedicated Account Manager</span></li>
                            <li><i class="bi bi-check text-success"></i> <span>Strategic IT Planning</span></li>
                            <li><i class="bi bi-check text-success"></i> <span>Unlimited On-site Visits</span></li>
                            <li><i class="bi bi-check text-success"></i> <span>Custom Reporting</span></li>
                        </ul>
                        <div class="text-center"><a href="javascript:void(0);" class="buy-btn">Get Started</a></div>
                    </div>
                </div><!-- End Pricing Item -->
            </div>
        </div>
    </section>

    <section id="subscribe" class="subscribe section">
        <div class="container">
          <div class="row gy-4 justify-content-between align-items-center">
            <div class="col-lg-6">
              <div class="subscribe-content">
                <h2>Subscribe to our newsletter</h2>
                <p>Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur aliquet quam id dui posuere blandit.</p>
                <form action="#" method="post">
                  <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email address..." aria-label="Email address" aria-describedby="button-subscribe">
                    <button class="btn btn-primary px-4" type="submit" id="button-subscribe">Subscribe</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="subscribe-image">
                <img src="https://assets.aktools.net/image-stocks/subscribe/subscribe-4.png" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </section>

    <!-- Blog Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">Latest Blog Posts</h2>
                    <p class="lead">Insights and updates from our team</p>
                </div>
            </div>
            <div class="row g-4">
                <?php
                    use App\Models\BlogsModel;
                    $blogsModel = new BlogsModel();
                    $blogs = $blogsModel->where('status', '1')->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_LOW', 6)))->findAll();
                ?>
                <?php if ($blogs): ?>
                    <?php foreach ($blogs as $blog): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100">
                                <a href="<?= base_url('blog/' . $blog['slug']) ?>">
                                    <img src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>" 
                                        class="card-img-top" 
                                        alt="<?= esc($blog['title']) ?>">
                                </a>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="badge bg-success me-2">
                                            <?= !empty($blog['category']) ? getBlogCategoryName($blog['category']) : "Uncategorized" ?>
                                        </span>
                                        <small class="text-muted"><?= dateFormat($blog['created_at'], 'M j, Y') ?></small>
                                    </div>
                                    <h5 class="fw-bold"><?= esc($blog['title']) ?></h5>
                                    <p class="mb-3">
                                        <?= !empty($blog['excerpt']) ? getTextSummary($blog['excerpt'], 100) : getTextSummary($blog['content'], 100) ?>
                                    </p>
                                    <a href="<?= base_url('blog/' . $blog['slug']) ?>" class="btn btn-sm btn-outline-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">No blog posts available at the moment.</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="text-center mt-5">
                <a href="<?=base_url('blogs')?>" class="btn btn-primary">View All Posts</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact section mb-4">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">Contact Us</h2>
                    <p class="lead">We're here to assist you. Reach out for inquiries or collaborations.</p>
                </div>
            </div>
        </div>
        <!-- End Section Title -->
    
        <div class="container" data-aos="fade-up" data-aos-delay="100">
    
        <!-- Google Maps -->
        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
            <iframe style="border:0; width: 100%; height: 350px;" 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.796595225128!2d-0.446276!3d51.470159!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876722b2c4e1f8b%3A0x7a5f5b8b9b4b9b4b!2sWatford!5e0!3m2!1sen!2suk!4v1698765432109!5m2!1sen!2suk" 
                    frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- End Google Maps -->
    
        <div class="row gy-5">
    
            <!-- Contact Information -->
            <div class="col-lg-4">
            <div class="info-box d-flex align-items-center mb-4" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-geo-alt flex-shrink-0 me-4"></i>
                <div>
                <h4>Our Location</h4>
                <p>123 Tech Park, Watford, UK</p>
                </div>
            </div>
            <div class="info-box d-flex align-items-center mb-4" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-telephone flex-shrink-0 me-4"></i>
                <div>
                <h4>Call Us</h4>
                <p>+44 20 1234 5678</p>
                </div>
            </div>
            <div class="info-box d-flex align-items-center" data-aos="fade-up" data-aos-delay="500">
                <i class="bi bi-envelope flex-shrink-0 me-4"></i>
                <div>
                <h4>Email Us</h4>
                <p>info@gexpotech.com</p>
                </div>
            </div>
            </div>
    
            <!-- Contact Form -->
            <div class="col-lg-8">
            <form action="#" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                <div class="row gy-4">
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                </div>
                <div class="col-md-12">
                    <textarea class="form-control" name="message" rows="4" placeholder="Message" required></textarea>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </div>
                </div>
            </form>
            </div><!-- End Contact Form -->
    
        </div>
    
        </div>
    
    </section>
    <!-- /Contact Section -->
<!-- ////// END Home Pages ///// -->


<!-- end main content -->
<?= $this->endSection() ?>


