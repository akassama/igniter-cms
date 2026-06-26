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
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<style>
/* Hero Section */
.brt-hero {
    background: linear-gradient(
        135deg,
        var(--background-color) 0%,
        var(--surface-secondary) 100%
    );
    position: relative;
    overflow: hidden;
    padding: 2rem;
    margin-bottom: 1.5rem;
}

.brt-hero-bg {
    position: absolute;
    top: 0;
    right: 0;
    height: 100%;
    width: 50%;
    object-fit: cover;
    opacity: 0.1;
}

@media (max-width: 768px) {
    .brt-hero-bg {
        display: none;
    }
}

.brt-hero-content {
    padding: 4rem 0;
}

@media (min-width: 992px) {
    .brt-hero-content {
        padding: 0.5rem 0;
    }
}

.brt-hero-badge {
    display: inline-block;
    background-color: var(--contrast-color);
    color: var(--heading-color);
    padding: 0.5rem 1.5rem;
    border-radius: 2rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    animation: brtFadeIn 0.8s ease-out;
}

.brt-hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: var(--heading-color);
}

.brt-hero-subtitle {
    font-size: 1.25rem;
    color: var(--text-muted);
    margin-bottom: 2rem;
    line-height: 1.6;
}

@media (min-width: 768px) {
    .brt-hero-title {
        font-size: 3.5rem;
    }

    .brt-hero-subtitle {
        font-size: 1.5rem;
    }
}
</style>
<section id="home" class="brt-hero brt-section">
<div class="container">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <div class="brt-hero-content">
            <span class="brt-hero-badge">
                <i class="ri-award-fill me-2"></i>Trusted by 10+ UK
                Businesses
            </span>
            <h1 class="brt-hero-title brt-fade-in">
                Websites That Drive
                <span class="text-primary">Business Growth</span>
            </h1>
            <p class="brt-hero-subtitle">
                Professional Web Design for Growing Businesses. We
                build high-converting websites that deliver results.
            </p>
            <div class="d-flex flex-wrap gap-3">
                <a href="#brt-pricing" class="btn brt-btn-primary">
                    View Our Plans
                    <i class="ri-arrow-right-line ms-2"></i>
                </a>
                <a href="#contact" class="btn brt-btn-secondary">
                    Get Free Quote <i class="ri-chat-3-line ms-2"></i>
                </a>
            </div>
            <div class="mt-5 d-flex align-items-center gap-4">
                <div class="d-flex">
                    <i class="ri-star-fill text-warning"></i>
                    <i class="ri-star-fill text-warning"></i>
                    <i class="ri-star-fill text-warning"></i>
                    <i class="ri-star-fill text-warning"></i>
                    <i class="ri-star-fill text-warning"></i>
                </div>
                <span class="text-muted"
                    >4.9/5 from 18 Google Reviews</span
                >
            </div>
            </div>
        </div>
        <div class="col-lg-6">
            <img
            src="https://ik.imagekit.io/brighterweb/brighter-web/hero/hero-1.webp"
            alt="BrighterWeb Hero"
            class="img-fluid rounded-3 shadow-lg brt-fade-in"
            loading="lazy"
            />
        </div>
    </div>
</div>
</section>
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!--==================== Services Component ====================-->
<style>
.brt-services-header {
    text-align: center;
    max-width: 700px;
    margin: 0 auto 4rem;
}

.brt-service-card {
    background-color: var(--surface-color);
    border: 1px solid var(--surface-border);
    border-radius: 1rem;
    padding: 2rem;
    height: 100%;
    transition: var(--transition);
    text-align: center;
}

.brt-service-card:hover {
    transform: translateY(-10px);
    border-color: var(--default-color);
    box-shadow: var(--shadow-lg);
}

.brt-service-icon {
    width: 80px;
    height: 80px;
    background: var(--accent-color);
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 2rem;
}
</style>
<section id="services" class="brt-section mb-4">
<div class="container">
    <!-- Section Title -->
    <div class="brt-section-title">
        <h2>Our Services</h2>
        <div class="brt-description">
            <span>Explore Our</span>
            <span class="brt-description-title">Expert Solutions</span>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="brt-service-card">
            <div class="brt-service-icon">
                <i class="ri-palette-line"></i>
            </div>
            <h4>Custom Web Design</h4>
            <p class="text-muted">
                Bespoke website designs tailored to your brand
                identity and business objectives.
            </p>
            <ul class="list-unstyled text-start">
                <li class="mb-2">
                    <i class="ri-check-line text-success me-2"></i>
                    User-friendly design
                </li>
                <li class="mb-2">
                    <i class="ri-check-line text-success me-2"></i>
                    Conversion-focused
                </li>
                <li>
                    <i class="ri-check-line text-success me-2"></i>
                    Mobile-responsive
                </li>
            </ul>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="brt-service-card">
            <div class="brt-service-icon">
                <i class="ri-wordpress-line"></i>
            </div>
            <h4>WordPress Development</h4>
            <p class="text-muted">
                Robust, scalable websites built on the world's most
                popular CMS platform.
            </p>
            <ul class="list-unstyled text-start">
                <li class="mb-2">
                    <i class="ri-check-line text-success me-2"></i>
                    Easy to manage
                </li>
                <li class="mb-2">
                    <i class="ri-check-line text-success me-2"></i>
                    SEO-friendly
                </li>
                <li>
                    <i class="ri-check-line text-success me-2"></i>
                    Plugin integration
                </li>
            </ul>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="brt-service-card">
            <div class="brt-service-icon">
                <i class="ri-line-chart-line"></i>
            </div>
            <h4>SEO Optimization</h4>
            <p class="text-muted">
                Improve your search engine rankings and attract more
                organic traffic.
            </p>
            <ul class="list-unstyled text-start">
                <li class="mb-2">
                    <i class="ri-check-line text-success me-2"></i>
                    Technical SEO
                </li>
                <li class="mb-2">
                    <i class="ri-check-line text-success me-2"></i>
                    Content optimization
                </li>
                <li>
                    <i class="ri-check-line text-success me-2"></i>
                    Performance tracking
                </li>
            </ul>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="brt-service-card">
            <div class="brt-service-icon">
                <i class="ri-shopping-cart-2-line"></i>
            </div>
            <h4>E-commerce Solutions</h4>
            <p class="text-muted">
                Complete online stores with WooCommerce and secure
                payment integration.
            </p>
            <ul class="list-unstyled text-start">
                <li class="mb-2">
                    <i class="ri-check-line text-success me-2"></i>
                    WooCommerce setup
                </li>
                <li class="mb-2">
                    <i class="ri-check-line text-success me-2"></i>
                    Payment gateways
                </li>
                <li>
                    <i class="ri-check-line text-success me-2"></i>
                    Inventory management
                </li>
            </ul>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="brt-service-card">
            <div class="brt-service-icon">
                <i class="ri-robot-line"></i>
            </div>
            <h4>AI Automation</h4>
            <p class="text-muted">
                Custom AI solutions to automate complex tasks and
                improve efficiency.
            </p>
            <ul class="list-unstyled text-start">
                <li class="mb-2">
                    <i class="ri-check-line text-success me-2"></i>
                    Workflow automation
                </li>
                <li class="mb-2">
                    <i class="ri-check-line text-success me-2"></i>
                    Custom AI integrations
                </li>
                <li>
                    <i class="ri-check-line text-success me-2"></i>
                    Process optimization
                </li>
            </ul>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="brt-service-card">
            <div class="brt-service-icon">
                <i class="ri-tools-line"></i>
            </div>
            <h4>Software Development</h4>
            <p class="text-muted">
                Bespoke systems and integrations for unique business
                challenges.
            </p>
            <ul class="list-unstyled text-start">
                <li class="mb-2">
                    <i class="ri-check-line text-success me-2"></i>
                    Custom applications
                </li>
                <li class="mb-2">
                    <i class="ri-check-line text-success me-2"></i>
                    API integrations
                </li>
                <li>
                    <i class="ri-check-line text-success me-2"></i>
                    System configuration
                </li>
            </ul>
            </div>
        </div>
    </div>
</div>
</section>
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<style>
/* ==================== Clients Component CSS  ==================== */
.brt-clients {
    padding: 4rem 0;
    background-color: var(--background-secondary);
    overflow-x: hidden;
    position: relative;
}

.brt-clients-title-wrapper {
    text-align: center;
    margin-bottom: 3rem;
}

.brt-clients-main-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--heading-color);
    margin-bottom: 0.5rem;
}

.brt-clients-subtitle {
    font-size: 1.1rem;
    color: var(--text-muted);
    max-width: 600px;
    margin: 0 auto;
}

@media (max-width: 767.98px) {
    .brt-clients-main-title {
        font-size: 2rem;
    }

    .brt-clients-subtitle {
        font-size: 1rem;
    }
}

.brt-clients-slider {
    position: relative;
    width: 100%;
    overflow: hidden;
    padding: 1.5rem 0;
}

.brt-clients-slider:not(:last-child) {
    margin-bottom: 1.5rem;
}

.brt-clients-track {
    display: flex;
    width: fit-content;
    animation-duration: 40s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    will-change: transform;
}

.brt-clients-track-1 {
    animation-name: brt-scroll-left;
}

.brt-clients-track-2 {
    animation-name: brt-scroll-right;
}

.brt-clients-track:hover {
    animation-play-state: paused;
}

.brt-clients-slide {
    flex: 0 0 auto;
    width: 200px;
    height: 100px;
    margin: 0 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--surface-color);
    border-radius: 12px;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    border: 1px solid var(--surface-border);
}

.brt-clients-slide::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        color-mix(in srgb, var(--default-color), transparent 96%),
        transparent
    );
    transition: 0.5s;
    z-index: 1;
}

.brt-clients-slide:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
    border-color: var(--default-color);
}

.brt-clients-slide:hover::before {
    left: 100%;
}

.brt-clients-slide:hover .brt-client-logo {
    filter: none;
    transform: scale(1.05);
}

.brt-client-logo {
    max-width: 80%;
    max-height: 60%;
    filter: grayscale(100%);
    opacity: 0.8;
    transition: var(--transition);
    z-index: 2;
}

@media (max-width: 991.98px) {
    .brt-clients-slide {
        width: 180px;
        height: 90px;
        margin: 0 1.5rem;
    }
}

@media (max-width: 767.98px) {
    .brt-clients-slide {
        width: 160px;
        height: 80px;
        margin: 0 1.25rem;
    }
}

@media (max-width: 575.98px) {
    .brt-clients-slide {
        width: 140px;
        height: 70px;
        margin: 0 1rem;
    }
}

/* Animations for infinite scrolling */
@keyframes brt-scroll-left {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(calc(-200px * 8 - 2rem * 16));
    }
}

@keyframes brt-scroll-right {
    0% {
        transform: translateX(calc(-200px * 8 - 2rem * 16));
    }

    100% {
        transform: translateX(0);
    }
}

/* Responsive animation adjustments */
@media (max-width: 991.98px) {
    @keyframes brt-scroll-left {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(calc(-180px * 8 - 1.5rem * 16));
        }
    }

    @keyframes brt-scroll-right {
        0% {
            transform: translateX(calc(-180px * 8 - 1.5rem * 16));
        }

        100% {
            transform: translateX(0);
        }
    }
}

@media (max-width: 767.98px) {
    @keyframes brt-scroll-left {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(calc(-160px * 8 - 1.25rem * 16));
        }
    }

    @keyframes brt-scroll-right {
        0% {
            transform: translateX(calc(-160px * 8 - 1.25rem * 16));
        }

        100% {
            transform: translateX(0);
        }
    }
}

@media (max-width: 575.98px) {
    @keyframes brt-scroll-left {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(calc(-140px * 8 - 1rem * 16));
        }
    }

    @keyframes brt-scroll-right {
        0% {
            transform: translateX(calc(-140px * 8 - 1rem * 16));
        }

        100% {
            transform: translateX(0);
        }
    }
}
</style>
<!--==================== Clients Component HTML Element ====================-->
<section class="brt-clients" id="brt-clients">
<div class="container">
    <!-- Section Title -->
    <div class="brt-section-title">
        <h2>Technologies We Work With</h2>
        <p>Expertise in modern frameworks and platforms</p>
    </div>
</div>
<div class="container-fluid">
    <!-- First Slider Row (Left to Right) -->
    <div class="brt-clients-slider">
        <div class="brt-clients-track brt-clients-track-1">
            <!-- Client Logos -->
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/wordpress-svgrepo-com.svg"
                class="brt-client-logo"
                alt="TechCorp"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/codeigniter-svgrepo-com.svg"
                class="brt-client-logo"
                alt="InnovateLabs"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/dotnet-svgrepo-com.svg"
                class="brt-client-logo"
                alt="GlobalSolutions"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/laravel-svgrepo-com.svg"
                class="brt-client-logo"
                alt="DigitalCraft"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/css-3-svgrepo-com.svg"
                class="brt-client-logo"
                alt="FutureSystems"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/woocommerce-svgrepo-com.svg"
                class="brt-client-logo"
                alt="CreativeMinds"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/html-5-svgrepo-com.svg"
                class="brt-client-logo"
                alt="VisionaryTech"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/winter-cms.svg"
                class="brt-client-logo"
                alt="NextGenDigital"
                loading="lazy"
            />
            </div>
            <!-- Duplicate for seamless looping -->
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/javascript-svgrepo-com.svg"
                class="brt-client-logo"
                alt="TechCorp"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/drupal-icon-svgrepo-com.svg"
                class="brt-client-logo"
                alt="InnovateLabs"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/figma-svgrepo-com.svg"
                class="brt-client-logo"
                alt="GlobalSolutions"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/htmx-logo.svg"
                class="brt-client-logo"
                alt="DigitalCraft"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/wordpress-svgrepo-com.svg"
                class="brt-client-logo"
                alt="TechCorp"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/codeigniter-svgrepo-com.svg"
                class="brt-client-logo"
                alt="InnovateLabs"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/dotnet-svgrepo-com.svg"
                class="brt-client-logo"
                alt="GlobalSolutions"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/laravel-svgrepo-com.svg"
                class="brt-client-logo"
                alt="NextGenDigital"
                loading="lazy"
            />
            </div>
        </div>
    </div>
    <!-- Second Slider Row (Right to Left) -->
    <div class="brt-clients-slider">
        <div class="brt-clients-track brt-clients-track-2">
            <!-- Client Logos in reverse order -->
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/wordpress-svgrepo-com.svg"
                class="brt-client-logo"
                alt="TechCorp"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/codeigniter-svgrepo-com.svg"
                class="brt-client-logo"
                alt="InnovateLabs"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/dotnet-svgrepo-com.svg"
                class="brt-client-logo"
                alt="GlobalSolutions"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/laravel-svgrepo-com.svg"
                class="brt-client-logo"
                alt="DigitalCraft"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/css-3-svgrepo-com.svg"
                class="brt-client-logo"
                alt="FutureSystems"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/woocommerce-svgrepo-com.svg"
                class="brt-client-logo"
                alt="CreativeMinds"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/html-5-svgrepo-com.svg"
                class="brt-client-logo"
                alt="VisionaryTech"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/winter-cms.svg"
                class="brt-client-logo"
                alt="NextGenDigital"
                loading="lazy"
            />
            </div>
            <!-- Duplicate for seamless looping -->
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/javascript-svgrepo-com.svg"
                class="brt-client-logo"
                alt="TechCorp"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/drupal-icon-svgrepo-com.svg"
                class="brt-client-logo"
                alt="InnovateLabs"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/figma-svgrepo-com.svg"
                class="brt-client-logo"
                alt="GlobalSolutions"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/htmx-logo.svg"
                class="brt-client-logo"
                alt="DigitalCraft"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/wordpress-svgrepo-com.svg"
                class="brt-client-logo"
                alt="TechCorp"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/codeigniter-svgrepo-com.svg"
                class="brt-client-logo"
                alt="InnovateLabs"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/dotnet-svgrepo-com.svg"
                class="brt-client-logo"
                alt="GlobalSolutions"
                loading="lazy"
            />
            </div>
            <div class="brt-clients-slide">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/technologies/laravel-svgrepo-com.svg"
                class="brt-client-logo"
                alt="NextGenDigital"
                loading="lazy"
            />
            </div>
        </div>
    </div>
</div>
</section>
<!--==================== Clients Component JavaScript ==================== -->
<script>
// ==================== Clients Slider Control ====================
document.addEventListener("DOMContentLoaded", function () {
    const tracks = document.querySelectorAll(".brt-clients-track");
    // Function to restart animations seamlessly
    function restartAnimation(track) {
        const animationName = getComputedStyle(track).animationName;
        const animationDuration =
            parseFloat(getComputedStyle(track).animationDuration) *
            1000;
        // Remove and re-add animation to reset
        track.style.animation = "none";
        void track.offsetWidth; // Trigger reflow
        track.style.animation = null;
        // Reset position for seamless loop
        if (animationName.includes("scroll-left")) {
            track.style.transform = "translateX(0)";
        } else if (animationName.includes("scroll-right")) {
            const trackWidth = track.scrollWidth / 2;
            track.style.transform = `translateX(-${trackWidth}px)`;
        }
    }
    // Setup hover pause effect
    tracks.forEach((track) => {
        track.addEventListener("mouseenter", function () {
            this.style.animationPlayState = "paused";
        });
        track.addEventListener("mouseleave", function () {
            this.style.animationPlayState = "running";
        });
    });
    // Restart animations periodically to prevent drift
    setInterval(() => {
        tracks.forEach((track) => {
            restartAnimation(track);
        });
    }, 40000); // Match animation duration
    // Handle window resize - recalculate animations
    let resizeTimeout;
    window.addEventListener("resize", function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            tracks.forEach((track) => {
            restartAnimation(track);
            });
        }, 250);
    });
    // Initialize animations
    tracks.forEach((track) => {
        restartAnimation(track);
    });
});
</script>
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<style>
/* ==================== Why Us Section CSS ==================== */
.brt-why-us-section {
    padding: 5rem 0;
    background-color: var(--background-secondary);
    transition: var(--transition);
}

.brt-section-title {
    text-align: center;
    margin-bottom: 3.5rem;
}

.brt-section-title h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--heading-color);
    margin-bottom: 1rem;
    position: relative;
    display: inline-block;
}

.brt-section-title h2::after {
    content: "";
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background-color: var(--accent-color);
    border-radius: 2px;
}

.brt-section-title p {
    color: var(--text-muted);
    font-size: 1.15rem;
    max-width: 650px;
    margin: 1.5rem auto 0;
    line-height: 1.6;
}

.brt-intro-content {
    padding-right: 2.5rem;
}

.brt-intro-content h3 {
    font-size: 2.25rem;
    font-weight: 700;
    color: var(--heading-color);
    margin-bottom: 1.25rem;
    line-height: 1.3;
}

.brt-intro-content .brt-intro-text {
    color: var(--text-muted);
    line-height: 1.7;
    margin-bottom: 2rem;
    font-size: 1.05rem;
}

.brt-stats-row {
    display: flex;
    gap: 2.5rem;
    margin-top: 1.5rem;
}

.brt-stat-item .brt-stat-value {
    font-size: 3.5rem;
    font-weight: 800;
    color: var(--accent-color);
    line-height: 1;
    display: block;
}

.brt-stat-item .brt-stat-unit {
    font-size: 2rem;
    font-weight: 700;
    color: var(--accent-color);
    vertical-align: top;
}

.brt-stat-item .brt-stat-desc {
    display: block;
    font-size: 0.95rem;
    color: var(--text-muted);
    margin-top: 0.25rem;
    font-weight: 500;
}

@media (max-width: 991.98px) {
    .brt-intro-content {
        padding-right: 0;
        margin-bottom: 2.5rem;
        text-align: center;
    }

    .brt-stats-row {
        justify-content: center;
        flex-wrap: wrap;
    }
}

.brt-features-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.brt-grid-item {
    display: flex;
    align-items: flex-start;
    gap: 1.25rem;
    padding: 1.5rem;
    background-color: var(--surface-color);
    border-radius: 16px;
    border-left: 4px solid var(--accent-color);
    transition: var(--transition);
    border: 1px solid var(--surface-border);
}

.brt-grid-item:hover {
    transform: translateX(8px);
    box-shadow: var(--shadow-md);
}

.brt-grid-icon {
    width: 48px;
    height: 48px;
    min-width: 48px;
    background-color: color-mix(
        in srgb,
        var(--accent-color),
        transparent 88%
    );
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.brt-grid-icon i {
    font-size: 1.5rem;
    color: var(--accent-color);
}

.brt-grid-content h5 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--heading-color);
    margin-bottom: 0.5rem;
}

.brt-grid-content p {
    font-size: 0.95rem;
    color: var(--text-muted);
    margin: 0;
    line-height: 1.6;
}

@media (max-width: 767.98px) {
    .brt-features-grid {
        grid-template-columns: 1fr;
    }
}

.brt-highlight-cards {
    margin-top: 4rem;
}

.brt-highlight-card {
    background-color: var(--surface-color);
    padding: 2.25rem 2rem;
    border-radius: 20px;
    height: 100%;
    position: relative;
    overflow: hidden;
    border: 1px solid var(--surface-border);
    transition: var(--transition);
    display: flex;
    flex-direction: column;
}

.brt-highlight-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(
        90deg,
        var(--accent-color),
        var(--default-color)
    );
    opacity: 0;
    transition: opacity 0.3s ease;
}

.brt-highlight-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}

.brt-highlight-card:hover::before {
    opacity: 1;
}

.brt-highlight-card:hover .brt-card-link i {
    transform: translateX(5px);
}

.brt-highlight-card.brt-featured {
    background: linear-gradient(
        145deg,
        var(--accent-color),
        color-mix(
            in srgb,
            var(--accent-color),
            var(--default-color) 35%
        )
    );
    border: none;
}

.brt-highlight-card.brt-featured::before {
    display: none;
}

.brt-highlight-card.brt-featured .brt-card-header i {
    background-color: color-mix(
        in srgb,
        var(--surface-color),
        transparent 80%
    );
    color: var(--surface-color);
}

.brt-highlight-card.brt-featured .brt-card-header .brt-card-badge {
    background-color: color-mix(
        in srgb,
        var(--surface-color),
        transparent 80%
    );
    color: var(--surface-color);
}

.brt-highlight-card.brt-featured h4 {
    color: var(--surface-color);
}

.brt-highlight-card.brt-featured p {
    color: color-mix(in srgb, var(--surface-color), transparent 15%);
}

.brt-highlight-card.brt-featured .brt-card-link {
    color: var(--surface-color);
}

.brt-card-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
}

.brt-card-header i {
    width: 45px;
    height: 45px;
    background-color: color-mix(
        in srgb,
        var(--accent-color),
        transparent 85%
    );
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: var(--accent-color);
}

.brt-card-header .brt-card-badge {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 0.35rem 0.75rem;
    background-color: color-mix(
        in srgb,
        var(--accent-color),
        transparent 88%
    );
    color: var(--accent-color);
    border-radius: 20px;
}

.brt-highlight-card h4 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--heading-color);
    margin-bottom: 1rem;
    line-height: 1.3;
}

.brt-highlight-card p {
    font-size: 0.95rem;
    color: var(--text-muted);
    line-height: 1.7;
    margin-bottom: 1.25rem;
    flex-grow: 1;
}

.brt-card-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--accent-color);
    text-decoration: none;
    transition: var(--transition);
    margin-top: auto;
}

.brt-card-link i {
    transition: transform 0.3s ease;
    font-size: 1.1rem;
}

.brt-cta-banner {
    background: linear-gradient(
        135deg,
        color-mix(in srgb, var(--accent-color), transparent 94%),
        color-mix(in srgb, var(--accent-color), transparent 90%)
    );
    border-radius: 24px;
    padding: 3rem 2.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2.5rem;
    border: 1px solid var(--surface-border);
    margin-top: 3rem;
}

.brt-cta-content h3 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--heading-color);
    margin-bottom: 0.75rem;
}

.brt-cta-content p {
    font-size: 1.05rem;
    color: var(--text-muted);
    margin: 0;
    max-width: 500px;
}

.brt-cta-actions {
    display: flex;
    gap: 1rem;
    flex-shrink: 0;
}

.brt-btn-cta-primary {
    display: inline-block;
    padding: 0.9rem 2rem;
    background-color: var(--accent-color);
    color: var(--background-color);
    border-radius: 12px;
    font-weight: 600;
    font-size: 1.05rem;
    text-decoration: none;
    transition: var(--transition);
    border: 2px solid var(--accent-color);
    box-shadow: var(--shadow-sm);
}

.brt-btn-cta-primary:hover {
    background-color: var(--accent-hover);
    border-color: var(--accent-hover);
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

.brt-btn-cta-secondary {
    display: inline-block;
    padding: 0.9rem 2rem;
    background-color: transparent;
    color: var(--accent-color);
    border: 2px solid var(--accent-color);
    border-radius: 12px;
    font-weight: 600;
    font-size: 1.05rem;
    text-decoration: none;
    transition: var(--transition);
}

.brt-btn-cta-secondary:hover {
    background-color: var(--accent-color);
    color: var(--background-color);
    transform: translateY(-3px);
}

@media (max-width: 991.98px) {
    .brt-why-us-section {
        padding: 3.5rem 0;
    }

    .brt-section-title h2 {
        font-size: 2.15rem;
    }

    .brt-intro-content h3 {
        font-size: 2rem;
    }

    .brt-stats-row {
        gap: 1.75rem;
    }

    .brt-stat-item .brt-stat-value {
        font-size: 2.75rem;
    }

    .brt-stat-item .brt-stat-unit {
        font-size: 1.5rem;
    }

    .brt-highlight-cards {
        margin-top: 2.5rem;
    }

    .brt-highlight-card {
        padding: 1.75rem 1.5rem;
    }

    .brt-highlight-card h4 {
        font-size: 1.35rem;
    }

    .brt-cta-banner {
        flex-direction: column;
        text-align: center;
        padding: 2.5rem 1.5rem;
    }

    .brt-cta-content h3 {
        font-size: 1.75rem;
    }

    .brt-cta-actions {
        flex-direction: column;
        width: 100%;
        margin-top: 1.5rem;
    }

    .brt-cta-actions a {
        width: 100%;
        text-align: center;
    }
}

@media (max-width: 575.98px) {
    .brt-section-title h2 {
        font-size: 1.85rem;
    }

    .brt-section-title h2::after {
        width: 45px;
    }

    .brt-section-title p {
        font-size: 1rem;
    }

    .brt-intro-content h3 {
        font-size: 1.75rem;
    }

    .brt-stat-item .brt-stat-value {
        font-size: 2.25rem;
    }

    .brt-stat-item .brt-stat-unit {
        font-size: 1.25rem;
    }

    .brt-grid-item {
        padding: 1.25rem;
    }

    .brt-card-header i {
        width: 40px;
        height: 40px;
        font-size: 1.15rem;
    }

    .brt-card-header .brt-card-badge {
        font-size: 0.7rem;
        padding: 0.3rem 0.65rem;
    }

    .brt-highlight-card h4 {
        font-size: 1.25rem;
    }

    .brt-cta-content h3 {
        font-size: 1.5rem;
    }

    .brt-cta-content p {
        font-size: 0.95rem;
    }

    .brt-btn-cta-primary,
    .brt-btn-cta-secondary {
        padding: 0.85rem 1.5rem;
        font-size: 1rem;
    }
}
</style>
<!--==================== Why Us Section HTML ====================-->
<section id="why-us" class="brt-why-us-section">
<div class="container">
    <div class="brt-section-title">
        <h2>Why BrighterWeb?</h2>
        <p>
            We blend high-end design with performance-driven
            engineering to scale your digital presence.
        </p>
    </div>
    <div class="row align-items-center mb-5">
        <div class="col-lg-5">
            <div class="brt-intro-content">
            <h3>Built for Business Growth</h3>
            <p class="brt-intro-text">
                BrighterWeb isn't just a design agency; we are your
                technical partners. We specialize in creating bespoke
                digital experiences that convert visitors into
                customers through clean code, SEO-first architecture,
                and intuitive user journeys.
            </p>
            <div class="brt-stats-row">
                <div class="brt-stat-item">
                    <span class="brt-stat-value"
                        >98 <span class="brt-stat-unit">%</span>
                    </span>
                    <span class="brt-stat-desc"
                        >Client Retention</span
                    >
                </div>
                <div class="brt-stat-item">
                    <span class="brt-stat-value"
                        >50 <span class="brt-stat-unit">+</span>
                    </span>
                    <span class="brt-stat-desc">Sites Launched</span>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="brt-features-grid">
            <div class="brt-grid-item">
                <div class="brt-grid-icon">
                    <i class="ri-lightbulb-flash-fill"></i>
                </div>
                <div class="brt-grid-content">
                    <h5>Strategic Design</h5>
                    <p>
                        Data-driven UI/UX layouts designed to maximize
                        user engagement and ROI.
                    </p>
                </div>
            </div>
            <div class="brt-grid-item">
                <div class="brt-grid-icon">
                    <i class="ri-rocket-2-fill"></i>
                </div>
                <div class="brt-grid-content">
                    <h5>Performance First</h5>
                    <p>
                        Blazing fast load times with optimized assets
                        and modern tech stacks.
                    </p>
                </div>
            </div>
            <div class="brt-grid-item">
                <div class="brt-grid-icon">
                    <i class="ri-shield-check-fill"></i>
                </div>
                <div class="brt-grid-content">
                    <h5>Secure & Scalable</h5>
                    <p>
                        Robust backend infrastructure designed to grow
                        alongside your traffic.
                    </p>
                </div>
            </div>
            <div class="brt-grid-item">
                <div class="brt-grid-icon">
                    <i class="ri-customer-service-2-fill"></i>
                </div>
                <div class="brt-grid-content">
                    <h5>Expert Partnership</h5>
                    <p>
                        Direct access to senior developers and
                        designers throughout your project.
                    </p>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="brt-highlight-cards">
        <div class="row g-4">
            <div class="col-lg-4">
            <div class="brt-highlight-card">
                <div class="brt-card-header">
                    <i class="ri-palette-fill"></i>
                    <span class="brt-card-badge">Creative</span>
                </div>
                <h4>Bespoke Visual Identity</h4>
                <p>
                    We don't use generic templates. Every pixel is
                    crafted to reflect your unique brand voice and
                    stand out in a crowded digital marketplace.
                </p>
                <a href="#portfolio" class="brt-card-link"
                    >View Portfolio
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>
            </div>
            <div class="col-lg-4">
            <div class="brt-highlight-card brt-featured">
                <div class="brt-card-header">
                    <i class="ri-bar-chart-2-fill"></i>
                    <span class="brt-card-badge">SEO</span>
                </div>
                <h4>Search Engine Dominance</h4>
                <p>
                    Our websites are built from the ground up to be
                    indexed by Google, ensuring your business gets the
                    organic visibility it deserves.
                </p>
                <a href="#services" class="brt-card-link"
                    >Our Strategy <i class="ri-arrow-right-line"></i>
                </a>
            </div>
            </div>
            <div class="col-lg-4">
            <div class="brt-highlight-card">
                <div class="brt-card-header">
                    <i class="ri-group-2-fill"></i>
                    <span class="brt-card-badge">Support</span>
                </div>
                <h4>Lifelong Maintenance</h4>
                <p>
                    We don't just "launch and leave." We provide
                    ongoing technical support and optimization to keep
                    your site at peak performance.
                </p>
                <a href="#maintenance" class="brt-card-link"
                    >Plan Details <i class="ri-arrow-right-line"></i>
                </a>
            </div>
            </div>
        </div>
    </div>
    <div class="row mt-5 pt-4">
        <div class="col-lg-8 offset-lg-2">
            <div class="brt-cta-banner">
            <div class="brt-cta-content">
                <h3>Ready to Ignite Your Online Presence?</h3>
                <p>
                    Work with BrighterWeb to build a digital product
                    that actually drives results.
                </p>
            </div>
            <div class="brt-cta-actions">
                <a href="#booking" class="brt-btn-cta-primary"
                    >Book a Discovery Call</a
                >
                <a href="#portfolio" class="brt-btn-cta-secondary"
                    >See Our Work</a
                >
            </div>
            </div>
        </div>
    </div>
</div>
</section>
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<style>
/* ==================== Portfolio Component CSS  ==================== */
.brt-portfolio {
    padding: 5rem 0;
    background-color: var(--background-color);
}

.brt-portfolio-title-wrapper {
    text-align: center;
    margin-bottom: 3rem;
}

.brt-portfolio-main-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--heading-color);
    margin-bottom: 0.5rem;
}

.brt-portfolio-subtitle {
    font-size: 1.1rem;
    color: var(--text-muted);
    max-width: 600px;
    margin: 0 auto;
}

@media (max-width: 767.98px) {
    .brt-portfolio-main-title {
        font-size: 2rem;
    }

    .brt-portfolio-subtitle {
        font-size: 1rem;
    }
}

.brt-portfolio-filter-header {
    margin-bottom: 3rem;
}

.brt-portfolio-filters {
    padding: 0;
    margin: 0;
    list-style: none;
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    justify-content: center;
}

.brt-portfolio-filter {
    cursor: pointer;
    font-size: 1rem;
    font-weight: 500;
    color: color-mix(in srgb, var(--text-color), transparent 40%);
    transition: var(--transition);
    position: relative;
    padding-bottom: 0.5rem;
    background: none;
    border: none;
    outline: none;
}

.brt-portfolio-filter::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--default-color);
    transition: width 0.3s ease-out;
}

.brt-portfolio-filter:hover,
.brt-portfolio-filter.brt-filter-active {
    color: var(--default-color);
}

.brt-portfolio-filter:hover::after,
.brt-portfolio-filter.brt-filter-active::after {
    width: 100%;
}

@media (max-width: 575.98px) {
    .brt-portfolio-filters {
        gap: 1.25rem;
    }

    .brt-portfolio-filter {
        font-size: 0.9rem;
    }
}

.brt-portfolio-card {
    position: relative;
    margin-bottom: 2rem;
    height: 100%;
    transition: var(--transition);
}

.brt-portfolio-image {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    height: 300px;
    background-color: var(--surface-secondary);
}

.brt-portfolio-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease-out;
}

.brt-portfolio-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: color-mix(
        in srgb,
        var(--default-color),
        transparent 50%
    );
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease-out;
    border-radius: 12px;
}

.brt-portfolio-actions {
    display: flex;
    gap: 1rem;
}

.brt-portfolio-action-btn {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--contrast-color);
    color: var(--default-color);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.125rem;
    transition: var(--transition);
    transform: translateY(20px);
    opacity: 0;
    text-decoration: none;
    border: none;
    cursor: pointer;
    min-width: 44px;
    min-height: 44px;
}

.brt-portfolio-action-btn:hover {
    background: var(--accent-color);
    color: white;
    transform: translateY(-4px);
}

.brt-portfolio-card:hover .brt-portfolio-image img {
    transform: scale(1.05);
}

.brt-portfolio-card:hover .brt-portfolio-overlay {
    opacity: 1;
}

.brt-portfolio-card:hover .brt-portfolio-action-btn {
    transform: translateY(0);
    opacity: 1;
}

.brt-portfolio-card:hover .brt-portfolio-action-btn:nth-child(2) {
    transition-delay: 0.1s;
}

.brt-portfolio-content {
    padding: 1.5rem 0;
}

.brt-portfolio-category {
    font-size: 0.875rem;
    font-weight: 500;
    color: color-mix(in srgb, var(--text-color), transparent 40%);
    display: block;
    margin-bottom: 0.5rem;
}

.brt-portfolio-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--heading-color);
    margin: 0;
    line-height: 1.3;
}

@media (max-width: 767.98px) {
    .brt-portfolio-title {
        font-size: 1.25rem;
    }
}

.brt-portfolio-cta {
    text-align: center;
    margin-top: 4rem;
}

.brt-portfolio-view-all {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
    font-weight: 500;
    color: var(--default-color);
    position: relative;
    padding-bottom: 0.25rem;
    text-decoration: none;
    background: linear-gradient(currentColor, currentColor) 0 100%/0
        1px no-repeat;
    transition: background-size 0.3s ease-out;
    min-width: 44px;
    min-height: 44px;
}

.brt-portfolio-view-all i {
    transition: transform 0.3s ease-out;
}

.brt-portfolio-view-all:hover {
    color: var(--default-hover);
    background-size: 100% 1px;
}

.brt-portfolio-view-all:hover i {
    transform: translateX(5px);
}

/* Animation for filter items */
@keyframes brt-portfolio-fade-in {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
<!--==================== Portfolio Component HTML Element ====================-->
<section class="brt-portfolio" id="portfolio">
<div class="container">
    <!-- Section Title -->
    <div class="brt-section-title">
        <h2>Our Recent Work</h2>
        <p>
            Explore our collection of successful projects across
            various industries and services
        </p>
    </div>
    <!-- Portfolio Filters -->
    <div class="brt-portfolio-filter-header">
        <ul class="brt-portfolio-filters">
            <li
            class="brt-portfolio-filter brt-filter-active"
            data-filter="*"
            >
            All Projects
            </li>
            <li class="brt-portfolio-filter" data-filter=".brt-web">
            Web Development
            </li>
            <li
            class="brt-portfolio-filter"
            data-filter=".brt-branding"
            >
            Brand Identity
            </li>
            <li
            class="brt-portfolio-filter"
            data-filter=".brt-campaign"
            >
            Digital Marketing
            </li>
            <li class="brt-portfolio-filter" data-filter=".brt-saas">
            SaaS
            </li>
        </ul>
    </div>
    <!-- Portfolio Grid -->
    <div class="row g-4 brt-portfolio-container">
        <!-- Portfolio Item 1 -->
        <div class="col-lg-6 col-md-6 brt-portfolio-item brt-web">
            <div class="brt-portfolio-card">
            <div class="brt-portfolio-image">
                <img
                    src="https://ik.imagekit.io/brighterweb/brighter-web/portfolio/isra.png"
                    alt="Charity Website"
                    loading="lazy"
                />
                <div class="brt-portfolio-overlay">
                    <div class="brt-portfolio-actions">
                        <button
                        class="brt-portfolio-action-btn"
                        title="View Full Image"
                        >
                        <i class="ri-fullscreen-line"></i>
                        </button>
                        <a
                        href="https://isragambia.org"
                        class="brt-portfolio-action-btn"
                        title="View Project"
                        >
                        <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="brt-portfolio-content">
                <span class="brt-portfolio-category"
                    >Web Development</span
                >
                <h4 class="brt-portfolio-title">Charity Website</h4>
            </div>
            </div>
        </div>
        <!-- Portfolio Item 2 -->
        <div class="col-lg-6 col-md-6 brt-portfolio-item brt-saas">
            <div class="brt-portfolio-card">
            <div class="brt-portfolio-image">
                <img
                    src="https://ik.imagekit.io/brighterweb/brighter-web/portfolio/igniter-cms.png"
                    alt="SaaS Dashboard"
                    loading="lazy"
                />
                <div class="brt-portfolio-overlay">
                    <div class="brt-portfolio-actions">
                        <button
                        class="brt-portfolio-action-btn"
                        title="View Full Image"
                        >
                        <i class="ri-fullscreen-line"></i>
                        </button>
                        <a
                        href="https://ignitercms.com/"
                        class="brt-portfolio-action-btn"
                        title="View Project"
                        >
                        <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="brt-portfolio-content">
                <span class="brt-portfolio-category"
                    >Web Development</span
                >
                <h4 class="brt-portfolio-title">SaaS Dashboard</h4>
            </div>
            </div>
        </div>
        <!-- Portfolio Item 3 -->
        <div class="col-lg-6 col-md-6 brt-portfolio-item brt-web">
            <div class="brt-portfolio-card">
            <div class="brt-portfolio-image">
                <img
                    src="https://ik.imagekit.io/brighterweb/brighter-web/portfolio/gamsecure-tech.png"
                    alt="Social Media Campaign"
                    loading="lazy"
                />
                <div class="brt-portfolio-overlay">
                    <div class="brt-portfolio-actions">
                        <button
                        class="brt-portfolio-action-btn"
                        title="View Full Image"
                        >
                        <i class="ri-fullscreen-line"></i>
                        </button>
                        <a
                        href="https://gamsecuretech.com"
                        class="brt-portfolio-action-btn"
                        title="View Project"
                        >
                        <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="brt-portfolio-content">
                <span class="brt-portfolio-category"
                    >Web Development</span
                >
                <h4 class="brt-portfolio-title">
                    Cybersecurity Platform
                </h4>
            </div>
            </div>
        </div>
        <!-- Portfolio Item 4 -->
        <div
            class="col-lg-6 col-md-6 brt-portfolio-item brt-ui brt-campaign"
        >
            <div class="brt-portfolio-card">
            <div class="brt-portfolio-image">
                <img
                    src="https://ik.imagekit.io/brighterweb/brighter-web/portfolio/modest-fashion.jpg"
                    alt="Mobile Application Design"
                    loading="lazy"
                />
                <div class="brt-portfolio-overlay">
                    <div class="brt-portfolio-actions">
                        <button
                        class="brt-portfolio-action-btn"
                        title="View Full Image"
                        >
                        <i class="ri-fullscreen-line"></i>
                        </button>
                        <a
                        href="javascript:void(0);"
                        class="brt-portfolio-action-btn"
                        title="View Project"
                        >
                        <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="brt-portfolio-content">
                <span class="brt-portfolio-category"
                    >Web Development</span
                >
                <h4 class="brt-portfolio-title">
                    E-commerce Platform
                </h4>
            </div>
            </div>
        </div>
        <!-- Portfolio Item 5 -->
        <div
            class="col-lg-6 col-md-6 brt-portfolio-item brt-branding brt-campaign"
        >
            <div class="brt-portfolio-card">
            <div class="brt-portfolio-image">
                <img
                    src="https://ik.imagekit.io/brighterweb/brighter-web/portfolio/impact-gambia.jpg"
                    alt="Digital Marketing"
                    loading="lazy"
                />
                <div class="brt-portfolio-overlay">
                    <div class="brt-portfolio-actions">
                        <button
                        class="brt-portfolio-action-btn"
                        title="View Full Image"
                        >
                        <i class="ri-fullscreen-line"></i>
                        </button>
                        <a
                        href="https://alchemytelco.com"
                        class="brt-portfolio-action-btn"
                        title="View Project"
                        >
                        <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="brt-portfolio-content">
                <span class="brt-portfolio-category"
                    >Web Development</span
                >
                <h4 class="brt-portfolio-title">
                    Digital Marketing
                </h4>
            </div>
            </div>
        </div>
        <!-- Portfolio Item 6 -->
        <div
            class="col-lg-6 col-md-6 brt-portfolio-item brt-branding"
        >
            <div class="brt-portfolio-card">
            <div class="brt-portfolio-image">
                <img
                    src="https://ik.imagekit.io/brighterweb/brighter-web/portfolio/nsga.png"
                    alt="Charity Website Design"
                    loading="lazy"
                />
                <div class="brt-portfolio-overlay">
                    <div class="brt-portfolio-actions">
                        <button
                        class="brt-portfolio-action-btn"
                        title="View Full Image"
                        >
                        <i class="ri-fullscreen-line"></i>
                        </button>
                        <a
                        href="https://novascotiagambia.ca"
                        class="brt-portfolio-action-btn"
                        title="View Project"
                        >
                        <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="brt-portfolio-content">
                <span class="brt-portfolio-category"
                    >Brand Identity</span
                >
                <h4 class="brt-portfolio-title">
                    Charity Website Design
                </h4>
            </div>
            </div>
        </div>
    </div>
    <!-- View All CTA -->
    <!-- <div class="brt-portfolio-cta"><a href="#all-projects" class="brt-portfolio-view-all">
    View Complete Portfolio
    <i class="ri-arrow-right-line"></i></a></div> -->
</div>
</section>
<!--==================== Portfolio Component JavaScript ==================== -->
<script>
// ==================== Portfolio Filter Functionality ====================
document.addEventListener("DOMContentLoaded", function () {
    const portfolioFilters = document.querySelectorAll(
        ".brt-portfolio-filter",
    );
    const portfolioItems = document.querySelectorAll(
        ".brt-portfolio-item",
    );
    const portfolioContainer = document.querySelector(
        ".brt-portfolio-container",
    );
    if (!portfolioFilters.length || !portfolioItems.length) return;
    // Initialize filter functionality
    function initPortfolioFilter() {
        // Add click event to filters
        portfolioFilters.forEach((filter) => {
            filter.addEventListener("click", function () {
            const filterValue = this.getAttribute("data-filter");
            // Update active filter
            portfolioFilters.forEach((f) =>
                f.classList.remove("brt-filter-active"),
            );
            this.classList.add("brt-filter-active");
            // Filter items
            portfolioItems.forEach((item) => {
                const shouldShow =
                    filterValue === "*" ||
                    item.classList.contains(filterValue.substring(1));
                if (shouldShow) {
                    item.style.display = "block";
                    item.style.animation =
                        "brt-portfolio-fade-in 0.5s ease forwards";
                } else {
                    item.style.display = "none";
                }
            });
            // Reorder items to prevent gaps
            setTimeout(() => {
                const visibleItems = Array.from(
                    portfolioItems,
                ).filter((item) => item.style.display !== "none");
                visibleItems.forEach((item, index) => {
                    setTimeout(() => {
                        item.style.opacity = "0";
                        item.style.transform = "translateY(20px)";
                        item.style.transition =
                        "opacity 0.4s ease, transform 0.4s ease";
                        setTimeout(() => {
                        item.style.opacity = "1";
                        item.style.transform = "translateY(0)";
                        }, 50);
                    }, index * 100);
                });
            }, 50);
            });
        });
        // Initialize animations
        portfolioItems.forEach((item, index) => {
            item.style.opacity = "0";
            item.style.transform = "translateY(20px)";
            item.style.transition =
            "opacity 0.6s ease, transform 0.6s ease";
            setTimeout(() => {
            item.style.opacity = "1";
            item.style.transform = "translateY(0)";
            }, index * 100);
        });
    }
    // Initialize image hover effects
    function initImageHoverEffects() {
        const portfolioCards = document.querySelectorAll(
            ".brt-portfolio-card",
        );
        portfolioCards.forEach((card) => {
            const image = card.querySelector(
            ".brt-portfolio-image img",
            );
            const actionBtns = card.querySelectorAll(
            ".brt-portfolio-action-btn",
            );
            card.addEventListener("mouseenter", function () {
            image.style.transform = "scale(1.05)";
            card.querySelector(
                ".brt-portfolio-overlay",
            ).style.opacity = "1";
            actionBtns.forEach((btn, index) => {
                setTimeout(() => {
                    btn.style.transform = "translateY(0)";
                    btn.style.opacity = "1";
                }, index * 100);
            });
            });
            card.addEventListener("mouseleave", function () {
            image.style.transform = "scale(1)";
            card.querySelector(
                ".brt-portfolio-overlay",
            ).style.opacity = "0";
            actionBtns.forEach((btn) => {
                btn.style.transform = "translateY(20px)";
                btn.style.opacity = "0";
            });
            });
        });
    }
    // Initialize fullscreen preview (simulated)
    function initFullscreenPreview() {
        const fullscreenBtns = document.querySelectorAll(
            '.brt-portfolio-action-btn[title="View Full Image"]',
        );
        fullscreenBtns.forEach((btn) => {
            btn.addEventListener("click", function (e) {
            e.preventDefault();
            const card = this.closest(".brt-portfolio-card");
            const image = card.querySelector("img");
            const title = card.querySelector(
                ".brt-portfolio-title",
            ).textContent;
            // Create modal overlay
            const modal = document.createElement("div");
            modal.className = "brt-portfolio-modal";
            modal.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s ease;
        `;
            modal.innerHTML = `
            
    <div style="position: relative; max-width: 90%; max-height: 90%;">
        <img src="${image.src}" alt="${title}" style="max-width: 100%; max-height: 90vh; border-radius: 8px;">
            <button class="brt-portfolio-modal-close" style="
                    position: absolute;
                    top: -40px;
                    right: 0;
                    background: none;
                    border: none;
                    color: white;
                    font-size: 2rem;
                    cursor: pointer;
                    padding: 0.5rem;
                ">×</button>
        </div>
        `;
            document.body.appendChild(modal);
            // Animate in
            setTimeout(() => {
                modal.style.opacity = "1";
            }, 10);
            // Close modal
            const closeBtn = modal.querySelector(
                ".brt-portfolio-modal-close",
            );
            closeBtn.addEventListener("click", function () {
                modal.style.opacity = "0";
                setTimeout(() => {
                    modal.remove();
                }, 300);
            });
            // Close on backdrop click
            modal.addEventListener("click", function (e) {
                if (e.target === modal) {
                    modal.style.opacity = "0";
                    setTimeout(() => {
                        modal.remove();
                    }, 300);
                }
            });
            // Close on escape key
            document.addEventListener(
                "keydown",
                function closeOnEscape(e) {
                    if (e.key === "Escape") {
                        modal.style.opacity = "0";
                        setTimeout(() => {
                        modal.remove();
                        document.removeEventListener(
                            "keydown",
                            closeOnEscape,
                        );
                        }, 300);
                    }
                },
            );
            });
        });
    }
    // Initialize all functionality
    initPortfolioFilter();
    initImageHoverEffects();
    initFullscreenPreview();
});
</script>
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<style>
/* ==================== Pricing Component CSS ==================== */
/* Pricing Section */
.brt-pricing-section {
    padding: 5rem 0;
    background-color: var(--background-color);
    transition: var(--transition);
}

/* Section Title */
.brt-section-title {
    text-align: center;
    margin-bottom: 3rem;
}

.brt-section-title h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--heading-color);
    margin-bottom: 1rem;
}

.brt-section-title p {
    font-size: 1.1rem;
    color: var(--text-muted);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

/* Pricing Cards */
.brt-pricing-card {
    background-color: var(--surface-color);
    border: 1px solid var(--surface-border);
    border-radius: 12px;
    padding: 2.5rem 2rem;
    height: 100%;
    position: relative;
    transition: var(--transition);
    display: flex;
    flex-direction: column;
}

.brt-pricing-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
    border-color: var(--default-color);
}

.brt-pricing-card.brt-featured {
    border-color: var(--default-color);
    transform: scale(1.02);
    box-shadow: var(--shadow-lg);
}

.brt-pricing-card.brt-featured:hover {
    transform: scale(1.02) translateY(-8px);
}

.brt-featured-badge {
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--default-color);
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 2rem;
    font-size: 0.8125rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: var(--shadow-sm);
}

/* Plan Header */
.brt-plan-header {
    text-align: center;
    margin-bottom: 2rem;
}

.brt-plan-name {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--heading-color);
    margin-bottom: 0.75rem;
}

.brt-plan-description {
    font-size: 0.9375rem;
    color: var(--text-muted);
    line-height: 1.6;
    margin-bottom: 0;
}

/* Pricing Display */
.brt-pricing-display {
    text-align: center;
    margin-bottom: 2rem;
    padding: 1.5rem 0;
    border-top: 1px solid var(--surface-border);
    border-bottom: 1px solid var(--surface-border);
}

.brt-price {
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 0.25rem;
}

.brt-currency {
    font-size: 1.25rem;
    color: var(--text-muted);
    font-weight: 500;
}

.brt-amount {
    font-size: 3.5rem;
    font-weight: 700;
    color: var(--heading-color);
    line-height: 1;
}

.brt-period {
    font-size: 1rem;
    color: var(--text-muted);
    font-weight: 400;
}

/* Features List */
.brt-features-list {
    margin-bottom: 2rem;
    flex-grow: 1;
}

.brt-feature {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 0;
}

.brt-feature i {
    color: var(--default-color);
    font-size: 1rem;
    flex-shrink: 0;
}

.brt-feature span {
    font-size: 0.9375rem;
    color: var(--text-color);
    line-height: 1.5;
}

/* Excluded Features */
.brt-excluded-features {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px dashed var(--surface-border);
}

.brt-excluded-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-muted);
    margin-bottom: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.brt-excluded-feature {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 0;
}

.brt-excluded-feature i {
    color: var(--text-light);
    font-size: 0.875rem;
    flex-shrink: 0;
}

.brt-excluded-feature span {
    font-size: 0.875rem;
    color: var(--text-muted);
    line-height: 1.5;
    text-decoration: line-through;
}

/* Plan Button */
.brt-plan-btn {
    display: block;
    width: 100%;
    padding: 1rem 1.5rem;
    background: transparent;
    border: 2px solid var(--default-color);
    color: var(--default-color);
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9375rem;
    text-align: center;
    transition: var(--transition);
    cursor: pointer;
    margin-top: auto;
}

.brt-plan-btn:hover {
    background: var(--default-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.brt-pricing-card.brt-featured .brt-plan-btn {
    background: var(--default-color);
    color: white;
}

.brt-pricing-card.brt-featured .brt-plan-btn:hover {
    background: var(--default-hover);
    border-color: var(--default-hover);
}

/* Pricing Footer */
.brt-pricing-footer {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid var(--surface-border);
    text-align: center;
}

.brt-guarantee-text {
    font-size: 0.9375rem;
    color: var(--text-muted);
    margin-bottom: 1rem;
}

.brt-contact-text {
    font-size: 0.9375rem;
    color: var(--text-color);
    margin-bottom: 0;
}

.brt-contact-text a {
    color: var(--default-color);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
}

.brt-contact-text a:hover {
    color: var(--default-hover);
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 992px) {
    .brt-pricing-section {
        padding: 4rem 0;
    }

    .brt-section-title h2 {
        font-size: 2.25rem;
    }

    .brt-pricing-card.brt-featured {
        transform: none;
    }

    .brt-pricing-card.brt-featured:hover {
        transform: translateY(-8px);
    }
}

@media (max-width: 768px) {
    .brt-pricing-section {
        padding: 3rem 0;
    }

    .brt-section-title h2 {
        font-size: 2rem;
    }

    .brt-section-title p {
        font-size: 1rem;
        padding: 0 1rem;
    }

    .brt-pricing-card {
        padding: 2rem 1.5rem;
        margin-bottom: 1.5rem;
    }

    .brt-amount {
        font-size: 3rem;
    }
}

@media (max-width: 576px) {
    .brt-pricing-section {
        padding: 2.5rem 0;
    }

    .brt-section-title h2 {
        font-size: 1.75rem;
    }

    .brt-pricing-card {
        padding: 1.75rem 1.25rem;
    }

    .brt-amount {
        font-size: 2.5rem;
    }

    .brt-feature span {
        font-size: 0.875rem;
    }

    .brt-excluded-feature span {
        font-size: 0.8125rem;
    }
}
</style>
<!--==================== Pricing Component HTML ====================-->
<section class="brt-pricing-section" id="brt-pricing">
<div class="container">
    <!-- Section Title -->
    <div class="brt-section-title">
        <h2>Simple, Transparent Pricing</h2>
        <p>
            All plans include domain, hosting, free SSL, business
            email, mobile-responsive design, SEO basics & unlimited
            support. Billed annually.
        </p>
    </div>
    <!-- Pricing Cards -->
    <div class="row justify-content-center g-4">
        <!-- Basic Plan -->
        <div class="col-lg-3 col-md-6">
            <div class="brt-pricing-card">
            <div class="brt-plan-header">
                <h3 class="brt-plan-name">Basic</h3>
                <p class="brt-plan-description">
                    Perfect for startups, personal brands & simple
                    landing pages
                </p>
            </div>
            <div class="brt-pricing-display">
                <div class="brt-price">
                    <span class="brt-currency">From £</span>
                    <span class="brt-amount">200</span>
                    <span class="brt-period">/year</span>
                </div>
            </div>
            <div class="brt-features-list">
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>Up to 3 pages</span>
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>3 business emails (5GB each)</span>
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>Mobile-responsive design</span>
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>Contact form & social integration</span>
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>Basic SEO setup & Google Analytics</span>
                </div>
                <!-- Excluded Features -->
                <!-- <div class="brt-excluded-features"><div class="brt-excluded-title">Not Included</div><div class="brt-excluded-feature"><i class="ri-close-line"></i><span>Full CMS control</span></div><div class="brt-excluded-feature"><i class="ri-close-line"></i><span>AI chatbot or booking system</span></div><div class="brt-excluded-feature"><i class="ri-close-line"></i><span>E-commerce functionality</span></div></div> -->
            </div>
            <a
                href="javascript:void(0);"
                class="brt-plan-btn"
                onclick="window.location.href='mailto:enquiries@brighterweb.co.uk?subject=Basic%20Plan%20Enquiry';"
                >Get Started</a
            >
            </div>
        </div>
        <!-- Standard Plan - Most Popular -->
        <div class="col-lg-3 col-md-6">
            <div class="brt-pricing-card brt-featured">
            <div class="brt-featured-badge">Most Popular</div>
            <div class="brt-plan-header">
                <h3 class="brt-plan-name">Standard</h3>
                <p class="brt-plan-description">
                    Ideal for local businesses, consultants & service
                    providers
                </p>
            </div>
            <div class="brt-pricing-display">
                <div class="brt-price">
                    <span class="brt-currency">From £</span>
                    <span class="brt-amount">400</span>
                    <span class="brt-period">/year</span>
                </div>
            </div>
            <div class="brt-features-list">
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>Up to 5 pages</span>
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>10 business emails (10GB each)</span>
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span
                        >Chatbot & advanced contact/booking forms</span
                    >
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>Comprehensive SEO optimisation</span>
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>Blog setup & Google Maps integration</span>
                </div>
                <!-- Excluded Features -->
                <!-- <div class="brt-excluded-features"><div class="brt-excluded-title">Not Included</div><div class="brt-excluded-feature"><i class="ri-close-line"></i><span>Unlimited pages</span></div><div class="brt-excluded-feature"><i class="ri-close-line"></i><span>E-commerce / WooCommerce</span></div><div class="brt-excluded-feature"><i class="ri-close-line"></i><span>AI workflow automations</span></div></div> -->
            </div>
            <a
                href="javascript:void(0);"
                class="brt-plan-btn"
                onclick="window.location.href='mailto:enquiries@brighterweb.co.uk?subject=Standard%20Plan%20Enquiry';"
                >Get Started</a
            >
            </div>
        </div>
        <!-- Premium Plan -->
        <div class="col-lg-3 col-md-6">
            <div class="brt-pricing-card">
            <div class="brt-plan-header">
                <h3 class="brt-plan-name">Premium</h3>
                <p class="brt-plan-description">
                    For growing businesses with content-rich or
                    complex requirements
                </p>
            </div>
            <div class="brt-pricing-display">
                <div class="brt-price">
                    <span class="brt-currency">From £</span>
                    <span class="brt-amount">700</span>
                    <span class="brt-period">/year</span>
                </div>
            </div>
            <div class="brt-features-list">
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>Unlimited pages</span>
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span
                        >25 business emails (unlimited storage)</span
                    >
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>Full CMS control & AI chatbot</span>
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>Advanced SEO & social/live feeds</span>
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>Custom styling & integrations</span>
                </div>
                <!-- Excluded Features -->
                <!-- <div class="brt-excluded-features"><div class="brt-excluded-title">Not Included</div><div class="brt-excluded-feature"><i class="ri-close-line"></i><span>WooCommerce / full e-commerce</span></div><div class="brt-excluded-feature"><i class="ri-close-line"></i><span>Advanced inventory & order systems</span></div></div> -->
            </div>
            <a
                href="javascript:void(0);"
                class="brt-plan-btn"
                onclick="window.location.href='mailto:enquiries@brighterweb.co.uk?subject=Premium%20Plan%20Enquiry';"
                >Get Started</a
            >
            </div>
        </div>
        <!-- E-commerce Plan -->
        <div class="col-lg-3 col-md-6">
            <div class="brt-pricing-card">
            <div class="brt-plan-header">
                <h3 class="brt-plan-name">E-commerce</h3>
                <p class="brt-plan-description">
                    Complete online store solution for product-based
                    businesses
                </p>
            </div>
            <div class="brt-pricing-display">
                <div class="brt-price">
                    <span class="brt-currency">From £</span>
                    <span class="brt-amount">1000</span>
                    <span class="brt-period">/year</span>
                </div>
            </div>
            <div class="brt-features-list">
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>Unlimited products & pages</span>
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>WooCommerce setup & payment gateways</span>
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>Inventory tracking & order management</span>
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>E-commerce SEO & product categories</span>
                </div>
                <div class="brt-feature">
                    <i class="ri-check-line"></i>
                    <span>Customer accounts system</span>
                </div>
                <!-- Excluded Features -->
                <!-- <div class="brt-excluded-features"><div class="brt-excluded-title">Not Included</div><div class="brt-excluded-feature"><i class="ri-close-line"></i><span>Custom ERP integrations</span></div><div class="brt-excluded-feature"><i class="ri-close-line"></i><span>Multi-warehouse support</span></div></div> -->
            </div>
            <a
                href="javascript:void(0);"
                class="brt-plan-btn"
                onclick="window.location.href='mailto:enquiries@brighterweb.co.uk?subject=E-commerce%20Enquiry';"
                >Get Started</a
            >
            </div>
        </div>
    </div>
    <!-- Pricing Footer -->
    <div class="row justify-content-center mt-5">
        <div class="col-lg-8">
            <div class="brt-pricing-footer">
            <p class="brt-guarantee-text">
                <i class="ri-shield-check-line"></i> Unlimited
                support included • No hidden fees • Cancel anytime
            </p>
            <p class="brt-contact-text">
                Need something custom?
                <a href="mailto:enquiries@brighterweb.co.uk"
                    >Email us</a
                >
                for a personalised quote.
            </p>
            </div>
        </div>
    </div>
</div>
</section>
<!--==================== Pricing Component JavaScript ==================== -->
<script>
// ==================== Pricing Component Functionality ====================
document.addEventListener("DOMContentLoaded", function () {
    const pricingCards =
        document.querySelectorAll(".brt-pricing-card");
    // Add hover effects to pricing cards
    function addPricingCardHoverEffects() {
        pricingCards.forEach((card) => {
            const btn = card.querySelector(".brt-plan-btn");
            card.addEventListener("mouseenter", function () {
            // Add subtle scale effect
            this.style.transform = this.classList.contains(
                "brt-featured",
            )
                ? "scale(1.05) translateY(-8px)"
                : "translateY(-8px)";
            // Enhance shadow
            this.style.boxShadow = "var(--shadow-xl)";
            // Button hover effect
            if (btn) {
                btn.style.transform = "translateY(-2px)";
            }
            });
            card.addEventListener("mouseleave", function () {
            // Reset transformations
            if (this.classList.contains("brt-featured")) {
                this.style.transform = "scale(1.02)";
            } else {
                this.style.transform = "";
            }
            // Reset shadow
            this.style.boxShadow = this.classList.contains(
                "brt-featured",
            )
                ? "var(--shadow-lg)"
                : "";
            // Reset button
            if (btn) {
                btn.style.transform = "";
            }
            });
            // Button hover effect
            if (btn) {
            btn.addEventListener("mouseenter", function () {
                this.style.transform =
                    "translateY(-2px) scale(1.02)";
            });
            btn.addEventListener("mouseleave", function () {
                this.style.transform = "";
            });
            }
        });
    }
    // Add click animation to plan buttons
    function addButtonAnimations() {
        const planBtns = document.querySelectorAll(".brt-plan-btn");
        planBtns.forEach((btn) => {
            btn.addEventListener("click", function (e) {
            // Prevent default for demo
            e.preventDefault();
            // Create ripple effect
            const ripple = document.createElement("span");
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            transform: scale(0);
            animation: brt-ripple 0.6s linear;
            pointer-events: none;
        `;
            this.style.position = "relative";
            this.style.overflow = "hidden";
            this.appendChild(ripple);
            // Remove ripple after animation
            setTimeout(() => {
                ripple.remove();
            }, 600);
            // Add bounce effect
            this.style.transform = "translateY(-4px) scale(0.98)";
            setTimeout(() => {
                this.style.transform = "";
            }, 200);
            // In a real app, this would redirect or show a form
            console.log("Plan selected:", this.textContent.trim());
            });
        });
    }
    // Add CSS for ripple animation
    const style = document.createElement("style");
    style.textContent = `
@keyframes brt-ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}
`;
    document.head.appendChild(style);
    // Scroll animation for pricing cards
    function animatePricingCardsOnScroll() {
        const cards = document.querySelectorAll(".brt-pricing-card");
        cards.forEach((card, index) => {
            const cardPosition = card.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            if (cardPosition.top < windowHeight * 0.85) {
            // Add staggered animation
            setTimeout(() => {
                card.style.opacity = "1";
                card.style.transform = card.classList.contains(
                    "brt-featured",
                )
                    ? "scale(1.02)"
                    : "translateY(0)";
            }, index * 150);
            }
        });
    }
    // Set initial state for animation
    pricingCards.forEach((card) => {
        card.style.opacity = "0";
        card.style.transform = "translateY(30px)";
        card.style.transition =
            "opacity 0.6s ease, transform 0.6s ease, box-shadow 0.3s ease";
    });
    // Initialize all functionality
    addPricingCardHoverEffects();
    addButtonAnimations();
    // Initial animation check
    setTimeout(animatePricingCardsOnScroll, 100);
    // Check on scroll
    window.addEventListener("scroll", animatePricingCardsOnScroll);
});
</script>
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<style>
/* ==================== FAQ Section ==================== */
.brt-faq {
    padding: 6rem 0;
    background-color: var(--background-color);
}

.brt-faq .brt-section-title {
    text-align: center;
    margin-bottom: 3.5rem;
}

.brt-faq .brt-section-title h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--heading-color);
    margin-bottom: 1rem;
}

.brt-faq .brt-section-title p {
    font-size: 1.15rem;
    color: var(--text-muted);
    max-width: 620px;
    margin: 0 auto;
}

.brt-faq .brt-faq-tabs {
    margin-bottom: 2.5rem;
}

.brt-faq .brt-faq-tabs .nav-pills {
    background-color: var(--surface-secondary);
    padding: 0.5rem;
    border-radius: 3rem;
    display: inline-flex;
    box-shadow: var(--shadow-sm);
}

.brt-faq .brt-faq-tabs .nav-link {
    padding: 0.75rem 1.75rem;
    border-radius: 2rem;
    font-weight: 500;
    color: var(--text-muted);
    transition: var(--transition);
}

.brt-faq .brt-faq-tabs .nav-link i {
    font-size: 1.25rem;
    margin-right: 0.5rem;
}

.brt-faq .brt-faq-tabs .nav-link:hover {
    color: var(--default-color);
    background-color: transparent;
}

.brt-faq .brt-faq-tabs .nav-link.active {
    background-color: var(--default-color);
    color: white;
    box-shadow: 0 4px 12px rgba(var(--default-rgb), 0.25);
}

@media (max-width: 575.98px) {
    .brt-faq .brt-faq-tabs .nav-pills {
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem;
    }

    .brt-faq .brt-faq-tabs .nav-link {
        padding: 0.6rem 1.3rem;
        font-size: 0.95rem;
    }
}

.brt-faq .brt-faq-item {
    background-color: var(--surface-color);
    border: 1px solid var(--surface-border);
    border-radius: 0.75rem;
    margin-bottom: 1rem;
    overflow: hidden;
    transition: var(--transition);
}

.brt-faq .brt-faq-item:hover {
    border-color: var(--default-color);
    box-shadow: var(--shadow-md);
    transform: translateY(-3px);
}

.brt-faq .brt-faq-item h3 {
    display: flex;
    align-items: center;
    margin: 0;
    padding: 1.25rem 1.75rem;
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--heading-color);
    cursor: pointer;
    user-select: none;
    transition: var(--transition);
}

.brt-faq .brt-faq-item h3:hover {
    background-color: var(--surface-secondary);
}

.brt-faq .brt-faq-item .brt-num {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 32px;
    height: 32px;
    margin-right: 1rem;
    background-color: color-mix(
        in srgb,
        var(--default-color),
        transparent 80%
    );
    color: var(--default-color);
    border-radius: 50%;
    font-size: 0.95rem;
    font-weight: 700;
    flex-shrink: 0;
}

.brt-faq .brt-faq-item .brt-question {
    flex: 1;
}

.brt-faq .brt-faq-item .brt-toggle-icon {
    font-size: 1.4rem;
    color: var(--text-muted);
    transition: var(--transition);
    margin-left: 1rem;
}

.brt-faq .brt-faq-item.brt-active .brt-toggle-icon {
    transform: rotate(45deg);
    color: var(--default-color);
}

.brt-faq .brt-faq-content {
    display: none;
    padding: 0 1.75rem 1.5rem 4.5rem;
    color: var(--text-muted);
    line-height: 1.65;
}

.brt-faq .brt-faq-content p {
    margin-bottom: 1rem;
}

.brt-faq .brt-faq-content p:last-child {
    margin-bottom: 0;
}

.brt-faq .brt-faq-cta {
    text-align: center;
    margin-top: 3.5rem;
    padding: 2.5rem;
    background-color: var(--surface-secondary);
    border-radius: 1rem;
    border: 1px solid var(--surface-border);
}

.brt-faq .brt-faq-cta p {
    font-size: 1.15rem;
    color: var(--text-color);
    margin-bottom: 1.5rem;
}

.brt-faq .brt-faq-cta .btn {
    padding: 0.75rem 2.25rem;
    font-weight: 600;
    border-radius: 3rem;
}
</style>
<!--==================== FAQ Section ====================-->
<section id="faq" class="brt-faq">
<div class="container">
    <div class="brt-section-title">
        <h2>Frequently Asked Questions</h2>
        <p>
            Quick answers to the most common questions we receive from
            businesses
        </p>
    </div>
    <div class="brt-faq-tabs">
        <ul
            class="nav nav-pills justify-content-center"
            id="brt-faqTab"
            role="tablist"
        >
            <li class="nav-item" role="presentation">
            <button
                class="nav-link active"
                id="general-tab"
                data-bs-toggle="pill"
                data-bs-target="#brt-faq-general"
                type="button"
                role="tab"
                aria-controls="brt-faq-general"
                aria-selected="true"
            >
                <i class="ri-question-line"></i> General
            </button>
            </li>
            <li class="nav-item" role="presentation">
            <button
                class="nav-link"
                id="process-tab"
                data-bs-toggle="pill"
                data-bs-target="#brt-faq-process"
                type="button"
                role="tab"
                aria-controls="brt-faq-process"
                aria-selected="false"
            >
                <i class="ri-code-box-line"></i> Process
            </button>
            </li>
            <li class="nav-item" role="presentation">
            <button
                class="nav-link"
                id="support-tab"
                data-bs-toggle="pill"
                data-bs-target="#brt-faq-support"
                type="button"
                role="tab"
                aria-controls="brt-faq-support"
                aria-selected="false"
            >
                <i class="ri-customer-service-2-line"></i> Support
            </button>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="brt-faqTabContent">
        <!-- General Tab -->
        <div
            class="tab-pane fade show active"
            id="brt-faq-general"
            role="tabpanel"
            aria-labelledby="general-tab"
        >
            <div class="brt-faq-list">
            <div class="brt-faq-item" data-brt-faq>
                <h3>
                    <span class="brt-num">1</span>
                    <span class="brt-question"
                        >How much does a website really cost?</span
                    >
                    <i class="ri-add-line brt-toggle-icon"></i>
                </h3>
                <div class="brt-faq-content">
                    <p>
                        Our basic packages start from just £200/year,
                        standard packages start from £400/year, premium
                        packages start from £700/year, and E-commerce
                        packages start from £1000/year, billed
                        annually. Every plan includes domain name, UK
                        hosting, free SSL, business email addresses,
                        mobile-responsive design, contact forms, SEO
                        basics and unlimited support after launch.
                    </p>
                    <p>
                        We believe every small business deserves
                        professional online presence without breaking
                        the bank.
                    </p>
                </div>
            </div>
            <div class="brt-faq-item" data-brt-faq>
                <h3>
                    <span class="brt-num">2</span>
                    <span class="brt-question"
                        >How long does it take to get a website
                        live?</span
                    >
                    <i class="ri-add-line brt-toggle-icon"></i>
                </h3>
                <div class="brt-faq-content">
                    <p>
                        Most standard websites (Basic & Standard plans)
                        are completed and launched within 5 working
                        days once we have content & feedback. More
                        complex Premium or E-commerce projects usually
                        take 2–6 weeks depending on features and
                        content volume.
                    </p>
                    <p>
                        We start work immediately after agreement and
                        keep you updated throughout.
                    </p>
                </div>
            </div>
            <div class="brt-faq-item" data-brt-faq>
                <h3>
                    <span class="brt-num">3</span>
                    <span class="brt-question"
                        >Will my site be fast and
                        mobile-friendly?</span
                    >
                    <i class="ri-add-line brt-toggle-icon"></i>
                </h3>
                <div class="brt-faq-content">
                    <p>
                        Yes — every site is built mobile-first using
                        modern responsive frameworks (Bootstrap &
                        custom CSS). We optimise images, code and
                        hosting for fast loading and strong Core Web
                        Vitals performance on both mobile and desktop.
                    </p>
                </div>
            </div>
            <div class="brt-faq-item" data-brt-faq>
                <h3>
                    <span class="brt-num">4</span>
                    <span class="brt-question"
                        >Which website design platform do you
                        use?</span
                    >
                    <i class="ri-add-line brt-toggle-icon"></i>
                </h3>
                <div class="brt-faq-content">
                    <p>
                        This depends on your specific needs and the
                        complexity of the website. For the majority of
                        our website design projects, we leverage the
                        robust WinterCMS and the highly popular
                        WordPress CMS (Content Management System). We
                        also utilise CodeIgniter/Laravel for custom PHP
                        development and WooCommerce for e-commerce.
                    </p>
                </div>
            </div>
            </div>
        </div>
        <!-- Process Tab -->
        <div
            class="tab-pane fade"
            id="brt-faq-process"
            role="tabpanel"
            aria-labelledby="process-tab"
        >
            <div class="brt-faq-list">
            <div class="brt-faq-item" data-brt-faq>
                <h3>
                    <span class="brt-num">1</span>
                    <span class="brt-question"
                        >What is your website building process?</span
                    >
                    <i class="ri-add-line brt-toggle-icon"></i>
                </h3>
                <div class="brt-faq-content">
                    <p>
                        We follow a clear 6-step process: Discuss →
                        Design → Build → Test → Launch → Maintain.
                    </p>
                    <p>
                        You’ll have regular updates, see previews at
                        every major stage, and we launch only when
                        you’re completely happy.
                    </p>
                </div>
            </div>
            <div class="brt-faq-item" data-brt-faq>
                <h3>
                    <span class="brt-num">2</span>
                    <span class="brt-question"
                        >Do I need to provide all the content?</span
                    >
                    <i class="ri-add-line brt-toggle-icon"></i>
                </h3>
                <div class="brt-faq-content">
                    <p>
                        Not necessarily. Many clients provide their own
                        text & photos, but we can also help with
                        copywriting, stock imagery, logo refinement or
                        full content creation — just let us know during
                        the initial discussion.
                    </p>
                </div>
            </div>
            <div class="brt-faq-item" data-brt-faq>
                <h3>
                    <span class="brt-num">3</span>
                    <span class="brt-question"
                        >Can I update the site myself later?</span
                    >
                    <i class="ri-add-line brt-toggle-icon"></i>
                </h3>
                <div class="brt-faq-content">
                    <p>
                        Yes — depending on the plan you’ll get full CMS
                        access (Standard & above), easy editing
                        interfaces, or we remain available for any
                        updates, additions or redesigns. Training is
                        included with every project.
                    </p>
                </div>
            </div>
            </div>
        </div>
        <!-- Support Tab -->
        <div
            class="tab-pane fade"
            id="brt-faq-support"
            role="tabpanel"
            aria-labelledby="support-tab"
        >
            <div class="brt-faq-list">
            <div class="brt-faq-item" data-brt-faq>
                <h3>
                    <span class="brt-num">1</span>
                    <span class="brt-question"
                        >What support do you provide after
                        launch?</span
                    >
                    <i class="ri-add-line brt-toggle-icon"></i>
                </h3>
                <div class="brt-faq-content">
                    <p>
                        Unlimited support is included with every
                        package. You can contact us anytime for
                        questions, small tweaks, content updates,
                        security advice or performance improvements —
                        no hourly charges.
                    </p>
                </div>
            </div>
            <div class="brt-faq-item" data-brt-faq>
                <h3>
                    <span class="brt-num">2</span>
                    <span class="brt-question"
                        >Can you fix or improve my existing
                        website?</span
                    >
                    <i class="ri-add-line brt-toggle-icon"></i>
                </h3>
                <div class="brt-faq-content">
                    <p>
                        Yes. We regularly help businesses by speeding
                        up slow sites, improving mobile experience,
                        adding modern features, fixing security issues,
                        or completely redesigning outdated websites.
                    </p>
                </div>
            </div>
            <div class="brt-faq-item" data-brt-faq>
                <h3>
                    <span class="brt-num">3</span>
                    <span class="brt-question"
                        >Do you offer SEO and Google ranking
                        help?</span
                    >
                    <i class="ri-add-line brt-toggle-icon"></i>
                </h3>
                <div class="brt-faq-content">
                    <p>
                        Absolutely. Every package includes solid
                        on-page SEO foundations. Higher plans include
                        more comprehensive optimisation. We also offer
                        ongoing SEO services for clients wanting
                        continued ranking improvement.
                    </p>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="brt-faq-cta" id="booking">
        <h3>
            Have questions? Schedule a meeting with us to get the
            answers you need.
        </h3>
        <!-- Calendly inline widget begin -->
        <div
            class="calendly-inline-widget"
            data-url="https://calendly.com/integrations-brighterweb/30min?primary_color=0e396c"
            style="min-width: 320px; height: 700px"
        ></div>
        <script
            type="text/javascript"
            src="https://assets.calendly.com/assets/external/widget.js"
            async
        ></script>
        <!-- Calendly inline widget end -->
    </div>
</div>
</section>
<!--==================== Component JavaScript ====================-->
<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[data-brt-faq]").forEach((item) => {
        const header = item.querySelector("h3");
        const content = item.querySelector(".brt-faq-content");
        header.addEventListener("click", () => {
            const isActive = item.classList.contains("brt-active");
            // Close all other items in the same tab pane
            const currentTab = item.closest(".tab-pane");
            currentTab
            ?.querySelectorAll(".brt-faq-item.brt-active")
            .forEach((el) => {
                if (el !== item) {
                    el.classList.remove("brt-active");
                    el.querySelector(
                        ".brt-faq-content",
                    ).style.display = "none";
                }
            });
            // Toggle current item
            if (isActive) {
            item.classList.remove("brt-active");
            content.style.display = "none";
            } else {
            item.classList.add("brt-active");
            content.style.display = "block";
            }
        });
    });
});
</script>
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!--==================== Team Component ====================-->
<style>
.brt-team {
    padding: 5rem 0;
}

.brt-team-sm {
    padding: 3rem 0;
}

.brt-team-header {
    text-align: center;
    max-width: 700px;
    margin: 0 auto 4rem;
}

.brt-team-card {
    background-color: var(--surface-color);
    border: 1px solid var(--surface-border);
    border-radius: 1rem;
    padding: 1.5rem;
    height: 100%;
    text-align: center;
    transition: var(--transition);
}

.brt-team-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.brt-team-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 1rem;
    border: 3px solid var(--default-color);
}

.brt-team-social-links {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    margin-top: 1rem;
}

.brt-team-social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background-color: var(--surface-secondary);
    color: var(--text-color);
    border-radius: 50%;
    transition: var(--transition);
    text-decoration: none;
}

.brt-team-social-link:hover {
    background-color: var(--default-color);
    color: white;
    transform: scale(1.1);
}
</style>
<section id="team" class="brt-team">
<div class="container">
    <div class="brt-section-title">
        <h2>Our Team</h2>
        <p>
            Dedicated professionals with decades of combined experience
            in web development and digital solutions.
        </p>
    </div>
    <div class="row g-4 justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="brt-team-card">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/team/omar-jabang-profile.webp"
                alt="Omar Jabang"
                class="brt-team-avatar"
            />
            <h4>Omar Jabang</h4>
            <p class="text-primary mb-2">Operations Manager</p>
            <p class="text-muted">
                With expertise in business operations and client
                relations, Omar ensures every project runs smoothly
                from start to finish.
            </p>
            <div class="brt-team-social-links">
                <a
                    href="https://uk.linkedin.com/in/omar-jabang-dip-cii-65a717112"
                    class="brt-team-social-link"
                    target="_blank"
                >
                    <i class="ri-linkedin-fill"></i>
                </a>
                <a
                    href="https://www.instagram.com/jabangomar/"
                    class="brt-team-social-link"
                    target="_blank"
                >
                    <i class="ri-instagram-line"></i>
                </a>
                <a
                    href="https://www.facebook.com/omar.jabang.79"
                    class="brt-team-social-link"
                    target="_blank"
                >
                    <i class="ri-facebook-fill"></i>
                </a>
            </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="brt-team-card">
            <img
                src="https://ik.imagekit.io/brighterweb/brighter-web/team/abdoulie-kassama-profile.webp"
                alt="Abdoulie Kassama"
                class="brt-team-avatar"
            />
            <h4>Abdoulie Kassama</h4>
            <p class="text-primary mb-2">Technical Manager</p>
            <p class="text-muted">
                Full-stack developer specializing in WordPress, PHP
                frameworks, and custom web applications with a focus
                on performance.
            </p>
            <div class="brt-team-social-links">
                <a
                    href="https://github.com/akassama"
                    class="brt-team-social-link"
                    target="_blank"
                >
                    <i class="ri-github-fill"></i>
                </a>
                <a
                    href="https://www.linkedin.com/in/akassama/"
                    class="brt-team-social-link"
                    target="_blank"
                >
                    <i class="ri-linkedin-fill"></i>
                </a>
                <a
                    href="https://www.instagram.com/lai_kassama/"
                    class="brt-team-social-link"
                    target="_blank"
                >
                    <i class="ri-instagram-line"></i>
                </a>
            </div>
            </div>
        </div>
    </div>
</div>
</section>
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<style>
/* ==================== Component CSS  ==================== */
.brt-contact-alt-section {
    position: relative;
    background: var(--background-color);
}

.brt-contact-alt-section::before {
    content: "";
    position: absolute;
    inset: 0 0 auto 0;
    height: 260px;
    background: var(--accent-rgb);
    pointer-events: none;
}

.brt-contact-alt-section .container {
    position: relative;
    z-index: 1;
}

/* Section title */
.brt-contact-alt-header {
    max-width: 720px;
    margin-inline: auto;
}

.brt-contact-alt-subtitle {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--accent-color);
}

.brt-contact-alt-title {
    font-size: 2rem;
    font-weight: 700;
    margin-top: 0.75rem;
    margin-bottom: 0.5rem;
    color: var(--heading-color);
    letter-spacing: -0.03em;
}

.brt-contact-alt-lead {
    margin: 0;
    font-size: 0.98rem;
    color: rgba(var(--text-rgb), 0.82);
}

/* Left info block */
.brt-info-wrapper {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    /* reduced vertical spacing */
    gap: 1.75rem;
    /* was larger, now tighter */
}

.brt-info-item {
    margin-bottom: 0;
    /* rely on gap to control spacing */
}

.brt-info-icon {
    width: 64px;
    height: 64px;
    border-radius: 999px;
    background: rgba(var(--accent-rgb), 0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    transition: var(--transition);
}

.brt-info-icon i {
    font-size: 1.5rem;
    color: var(--accent-color);
    transition: var(--transition);
}

.brt-info-content-title {
    font-size: 1.4rem;
    font-weight: 500;
    color: var(--heading-color);
    margin-bottom: 0.75rem;
    letter-spacing: -0.02em;
}

.brt-info-content-text {
    font-size: 0.98rem;
    line-height: 1.7;
    color: var(--text-muted);
    margin: 0;
}

.brt-info-wrapper:hover .brt-info-icon {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(var(--accent-rgb), 0.18);
    background: rgba(var(--accent-rgb), 0.12);
}

.brt-info-wrapper:hover .brt-info-icon i {
    transform: translateY(-1px);
}

/* Contact detail list */
.brt-contact-details {
    display: flex;
    flex-direction: column;
    gap: 1.75rem;
    /* slightly larger, feels more substantial with bigger items */
}

.brt-detail-item {
    display: flex;
    align-items: center;
    gap: 1.1rem;
    padding: 0.35rem 0;
    /* make items feel bigger without huge vertical gaps */
}

.brt-detail-icon {
    width: 48px;
    /* bigger */
    height: 48px;
    /* bigger */
    flex-shrink: 0;
    border-radius: 999px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(var(--accent-rgb), 0.08);
}

.brt-detail-icon i {
    font-size: 1.35rem;
    /* bigger icon */
    color: var(--accent-color);
}

.brt-detail-content {
    flex: 1;
}

.brt-detail-label {
    display: block;
    font-size: 0.82rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.09em;
    color: rgba(var(muted), 0.7);
    margin-bottom: 0.25rem;
}

.brt-detail-value {
    display: block;
    font-size: 1rem;
    color: rgba(var(--text-muted), 0.9);
    line-height: 1.7;
}

.brt-detail-value a {
    color: inherit;
    text-decoration: none;
}

.brt-detail-value a:hover {
    text-decoration: underline;
}

/* Right form panel */
.brt-form-wrapper {
    background-color: var(--surface-color);
    border-radius: 1.1rem;
    padding: 1.75rem 1.75rem 1.9rem;
    border: 1px solid rgba(var(--default-rgb), 0.09);
    box-shadow: 0 10px 34px rgba(var(--default-rgb), 0.12);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.brt-form-header {
    margin-bottom: 1.75rem;
}

.brt-form-header-title {
    font-size: 1.55rem;
    font-weight: 500;
    color: var(--heading-color);
    margin: 0;
    letter-spacing: -0.03em;
}

/* Form fields */
.brt-contact-form .brt-form-group {
    margin-bottom: 1.75rem;
}

.brt-contact-form .brt-form-label {
    display: block;
    font-size: 0.85rem;
    font-weight: 500;
    color: var(--heading-color);
    margin-bottom: 0.5rem;
    letter-spacing: 0.02em;
}

.brt-contact-form .form-control,
.brt-contact-form textarea {
    width: 100%;
    border-radius: 0.7rem;
    border: 1px solid rgba(var(--default-rgb), 0.14);
    padding: 0.9rem 1rem;
    font-size: 0.95rem;
    color: var(--form-text);
    background-color: var(--form-bg);
    transition: var(--transition);
    font-family: inherit;
}

.brt-contact-form textarea {
    min-height: 130px;
    resize: vertical;
    line-height: 1.6;
}

.brt-contact-form .form-control::placeholder,
.brt-contact-form textarea::placeholder {
    color: rgba(var(--text-rgb), 0.55);
}

.brt-contact-form .form-control:focus,
.brt-contact-form textarea:focus {
    outline: none;
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(var(--accent-rgb), 0.25);
}

/* Submit button - now uses default color + surface contrast */
.brt-submit-btn {
    border: none;
    border-radius: 0.7rem;
    padding: 0.9rem 1.75rem;
    font-size: 0.95rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    cursor: pointer;
    letter-spacing: 0.04em;
    background: var(--default-color);
    /* use default color */
    color: var(--surface-color);
    /* “appropriate color like surface” */
    transition: var(--transition);
    box-shadow: 0 10px 26px rgba(var(--default-rgb), 0.35);
}

.brt-submit-btn i {
    font-size: 1.05rem;
    transition: transform 0.25s ease;
}

.brt-submit-btn:hover {
    background: var(--default-hover);
    transform: translateY(-2px);
    box-shadow: 0 14px 32px rgba(var(--default-rgb), 0.45);
}

.brt-submit-btn:hover i {
    transform: translateX(4px);
}

.brt-submit-btn:active {
    transform: translateY(0);
    box-shadow: 0 8px 22px rgba(var(--default-rgb), 0.35);
}

/* Status messages placeholders */
.brt-form-status {
    font-size: 0.85rem;
    margin-bottom: 0.25rem;
    display: none;
    /* to be handled by backend/JS if needed */
}

.brt-form-status.brt-loading {
    color: rgba(var(--text-rgb), 0.75);
}

.brt-form-status.brt-error {
    color: hsl(0, 75%, 55%);
}

.brt-form-status.brt-success {
    color: hsl(142, 71%, 45%);
}

/* Responsive spacing */
@media (max-width: 767.98px) {
    .brt-contact-alt-section {
        padding-top: 3.5rem !important;
        padding-bottom: 3rem !important;
    }

    .brt-contact-alt-title {
        font-size: 1.6rem;
    }

    .brt-info-icon {
        width: 56px;
        height: 56px;
        margin-bottom: 1.25rem;
    }

    .brt-info-content-title {
        font-size: 1.2rem;
    }

    .brt-form-wrapper {
        padding: 1.5rem 1.3rem 1.6rem;
        margin-top: 0.75rem;
    }

    .brt-form-header-title {
        font-size: 1.3rem;
    }

    .brt-contact-form .brt-form-group {
        margin-bottom: 1.35rem;
    }
}

@media (min-width: 768px) {
    .brt-contact-alt-title {
        font-size: 2.1rem;
    }

    .brt-form-wrapper {
        padding: 2rem 2.25rem 2.25rem;
    }
}
</style>
<!--==================== Component HTML Element ====================-->
<section id="contact" class="brt-contact-alt-section py-5">
<div class="container">
    <!-- Section Title -->
    <div class="text-center mb-5 brt-contact-alt-header">
        <span class="brt-contact-alt-subtitle">Contact</span>
        <div class="brt-section-title">
            <h2>Let's connect about your project</h2>
            <p>
            Share a few details about your team, your stack and
            where you'd like to be in the next few months. We'll get
            back with practical next steps, not a generic sales
            script.
            </p>
        </div>
    </div>
    <!-- End Section Title -->
    <div class="row gy-4 align-items-stretch">
        <!-- Left: Info & details -->
        <div class="col-lg-5">
            <div class="brt-info-wrapper">
            <div class="brt-info-item">
                <div class="brt-info-icon">
                    <i class="ri-chat-3-line"></i>
                </div>
                <div class="brt-info-content">
                    <h4 class="brt-info-content-title">
                        Start a conversation
                    </h4>
                    <p class="brt-info-content-text">
                        Whether you need a fresh build, a refactor or
                        just a second opinion, we'll help you map a
                        clear, maintainable path forward.
                    </p>
                </div>
            </div>
            <div class="brt-contact-details">
                <div class="brt-detail-item">
                    <div class="brt-detail-icon">
                        <i class="ri-mail-open-line"></i>
                    </div>
                    <div class="brt-detail-content">
                        <span class="brt-detail-label">Email us</span>
                        <span class="brt-detail-value">
                        <a href="mailto:enquiries@brighterweb.co.uk"
                            >enquiries@brighterweb.co.uk</a
                        >
                        </span>
                    </div>
                </div>
                <div class="brt-detail-item">
                    <div class="brt-detail-icon">
                        <i class="ri-phone-line"></i>
                    </div>
                    <div class="brt-detail-content">
                        <span class="brt-detail-label">Call us</span>
                        <span class="brt-detail-value">
                        <a href="tel:+447895577949"
                            >+447895577949</a
                        >
                        </span>
                    </div>
                </div>
                <div class="brt-detail-item">
                    <div class="brt-detail-icon">
                        <i class="ri-map-pin-2-fill"></i>
                    </div>
                    <div class="brt-detail-content">
                        <span class="brt-detail-label">Visit us</span>
                        <span class="brt-detail-value">
                        212B, Watford Road, <br />
                        Croxley Green, Hertfordshire, <br />
                        </span>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Right: Form -->
        <div class="col-lg-7">
            <div class="brt-form-wrapper">
            <div class="brt-form-header">
                <h3 class="brt-form-header-title">
                    Send us a message
                </h3>
            </div>
            <form
                class="brt-contact-form"
                action="https://api.web3forms.com/submit"
                method="POST"
            >
                <input
                    type="hidden"
                    name="access_key"
                    value="c5e6b995-fbbc-45b6-a772-b77db52f0711"
                />
                <div class="row">
                    <div class="col-md-6">
                        <div class="brt-form-group">
                        <label
                            for="brt-contact-name"
                            class="brt-form-label"
                            >Full name</label
                        >
                        <input
                            type="text"
                            id="brt-contact-name"
                            name="name"
                            class="form-control"
                            placeholder="Jane Doe"
                            required
                        />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="brt-form-group">
                        <label
                            for="brt-contact-email"
                            class="brt-form-label"
                            >Email address</label
                        >
                        <input
                            type="email"
                            id="brt-contact-email"
                            name="email"
                            class="form-control"
                            placeholder="you@company.com"
                            required
                        />
                        </div>
                    </div>
                </div>
                <div class="brt-form-group">
                    <label
                        for="brt-contact-subject"
                        class="brt-form-label"
                        >Subject</label
                    >
                    <input
                        type="text"
                        id="brt-contact-subject"
                        name="subject"
                        class="form-control"
                        placeholder="Project brief, integration help, review…"
                        required
                    />
                </div>
                <div class="brt-form-group">
                    <label
                        for="brt-contact-subject"
                        class="brt-form-label"
                        >Service</label
                    >
                    <select class="form-select brt-form-control">
                        <option selected>Select Service</option>
                        <option value="web-design">
                        Custom Web Design
                        </option>
                        <option value="wordpress">
                        WordPress Development
                        </option>
                        <option value="seo">SEO Optimization</option>
                        <option value="ecommerce">
                        E-commerce Website
                        </option>
                        <option value="automation">
                        Business Process Automation
                        </option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="brt-form-group">
                    <label
                        for="brt-contact-message"
                        class="brt-form-label"
                        >Message</label
                    >
                    <textarea
                        id="brt-contact-message"
                        name="message"
                        class="form-control"
                        rows="5"
                        placeholder="Tell us about your goals, timelines and any relevant links or context."
                        required
                    ></textarea>
                </div>
                <div class="my-3">
                    <div class="brt-form-status brt-loading">
                        Loading…
                    </div>
                    <div class="brt-form-status brt-error">
                        There was an issue sending your message.
                    </div>
                    <div class="brt-form-status brt-success">
                        Your message has been sent. Thank you!
                    </div>
                </div>
                <button type="submit" class="brt-submit-btn">
                    <span>Send message</span>
                    <i
                        class="ri-arrow-right-line"
                        aria-hidden="true"
                    ></i>
                </button>
            </form>
            </div>
        </div>
    </div>
</div>
</section>
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------->
      
<!-- ////// END Home Pages ///// -->


<!-- end main content -->
<?= $this->endSection() ?>


