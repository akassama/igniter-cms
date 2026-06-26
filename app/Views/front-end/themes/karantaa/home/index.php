<?php
// This is to get current impact
$theme = getCurrentTheme();

//page settings
$currentPage = "home";
$popUpWhereClause = ["status" => 1];

$enableHomeSeo = getTableData(
    "plugin_configs",
    ["plugin_slug" => "seo-master", "config_key" => "enable_home_seo"],
    "config_value",
);
?>

<!-- include theme layout -->
<?= $this->extend("front-end/themes/" . $theme . "/layout/_layout") ?>

<!-- begin main content -->
<?= $this->section("content") ?>
<!-- ////// BEGIN Get Home Pages ///// -->
<section class="hero-carousel" id="heroCarousel" aria-label="Hero Carousel">
    <div class="slides">
        <!-- Slide 1 -->
        <div class="slide active" data-slide="0">
            <div class="slide-bg" style="background-image: url('https://ik.imagekit.io/brighterweb/karantaa/hero-carousel/slider-1.webp');"></div>
            <div class="slide-content">
                <div class="container">
                    <div class="slide-inner">
                        <h2 class="slide-title">Welcome to Karantaa</h2>
                        <p class="slide-subtitle">Pan-African Research and Policy Lab.</p>
                        <div class="slide-divider"></div>
                        <p class="slide-text">
                            Rooted in African knowledge systems, we generate evidence to inform policy and support transformative change across the continent.
                        </p>
                        <a href="<?= base_url(
                            "contact",
                        ) ?>" class="btn-carousel">
                            Let's Connect <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide" data-slide="1">
            <div class="slide-bg" style="background-image: url('https://ik.imagekit.io/brighterweb/karantaa/hero-carousel/slider-2.webp');"></div>
            <div class="slide-content">
                <div class="container">
                    <div class="slide-inner">
                        <h2 class="slide-title">Governance &amp; Public Policy</h2>
                        <p class="slide-subtitle">Research for stronger institutions, accountable governance and effective public policy.</p>
                        <div class="slide-divider"></div>
                        <p class="slide-text">
                            We analyse policy, institutions and governance systems to support transparent, inclusive and responsive public sector performance.
                        </p>
                        <a href="<?= base_url(
                            "contact",
                        ) ?>" class="btn-carousel">
                            Let's Connect <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="slide" data-slide="2">
            <div class="slide-bg" style="background-image: url('https://ik.imagekit.io/brighterweb/karantaa/hero-carousel/slider-3.webp');"></div>
            <div class="slide-content">
                <div class="container">
                    <div class="slide-inner">
                        <h2 class="slide-title">Social Protection &amp; Human Development</h2>
                        <p class="slide-subtitle">Evidence on poverty, inequality, social protection and inclusive development.</p>
                        <div class="slide-divider"></div>
                        <p class="slide-text">
                            We examine social and economic policies that promote human dignity, reduce vulnerability and expand opportunities.
                        </p>
                        <a href="<?= base_url(
                            "contact",
                        ) ?>" class="btn-carousel">
                            Let's Connect <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 4 -->
        <div class="slide" data-slide="3">
            <div class="slide-bg" style="background-image: url('https://ik.imagekit.io/brighterweb/karantaa/hero-carousel/slider-4.webp');"></div>
            <div class="slide-content">
                <div class="container">
                    <div class="slide-inner">
                        <h2 class="slide-title">African Futures</h2>
                        <p class="slide-subtitle">Research on youth, innovation, technology and long-term development pathways.</p>
                        <div class="slide-divider"></div>
                        <p class="slide-text">
                            We explore emerging trends and future scenarios to inform strategies that shape Africa's development trajectory.
                        </p>
                        <a href="<?= base_url(
                            "contact",
                        ) ?>" class="btn-carousel">
                            Let's Connect <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Arrows -->
    <button class="brt-carousel-arrow prev" aria-label="Previous slide">
        <i class="ri-arrow-left-s-line"></i>
    </button>
    <button class="brt-carousel-arrow next" aria-label="Next slide">
        <i class="ri-arrow-right-s-line"></i>
    </button>

    <!-- Navigation Dots -->
    <div class="brt-carousel-dots">
        <button class="brt-carousel-dot active" data-goto="0" aria-label="Go to slide 1"></button>
        <button class="brt-carousel-dot" data-goto="1" aria-label="Go to slide 2"></button>
        <button class="brt-carousel-dot" data-goto="2" aria-label="Go to slide 3"></button>
        <button class="brt-carousel-dot" data-goto="3" aria-label="Go to slide 4"></button>
    </div>
</section>

<section class="section-pad" id="about">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7 fade-up">
                <span class="eyebrow">Who we are</span>
                <h2 class="mb-4" style="font-size: 2.2rem">
                    A space for rigorous,<br />Africa-grounded
                    inquiry
                </h2>
                <p class="text-muted-k">
                    Karantaa is a Pan-African research and policy
                    lab dedicated to producing rigorous,
                    independent, and Africa-centred knowledge that
                    informs policy, strengthens institutions, and
                    advances social transformation.
                </p>
                <p class="text-muted-k">
                    We bring together researchers, policy experts,
                    and practitioners working across East, West, and
                    North Africa to generate evidence that is
                    grounded in African realities and responsive to
                    contemporary challenges. Our work spans
                    research, strategic advisory, public
                    scholarship, and capacity development &mdash;
                    ensuring African perspectives shape the policies
                    and decisions that affect the continent&rsquo;s
                    future.
                </p>
                <a
                    href="<?= base_url("about") ?>"
                    class="btn btn-outline-ink mt-2"
                    >Our story, vision &amp; values</a
                >
            </div>
            <div class="col-lg-5 fade-up delay-1">
                <div class="highlight-panel">
                    <div class="item">
                        <i class="ri-flask-line"></i>
                        <div>
                            <strong>Rigour and integrity</strong
                            ><small
                                >Methodological excellence and
                                independence</small
                            >
                        </div>
                    </div>
                    <div class="item">
                        <i class="ri-global-line"></i>
                        <div>
                            <strong
                                >African-centred knowledge</strong
                            ><small
                                >Affirming African ways of
                                knowing</small
                            >
                        </div>
                    </div>
                    <div class="item">
                        <i class="ri-team-line"></i>
                        <div>
                            <strong
                                >Collaboration and
                                inclusivity</strong
                            ><small
                                >Partnerships across disciplines and
                                geographies</small
                            >
                        </div>
                    </div>
                    <div class="item">
                        <i class="ri-scales-3-line"></i>
                        <div>
                            <strong
                                >Equity and social justice</strong
                            ><small
                                >Centring African communities&rsquo;
                                needs and rights</small
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section
    class="section-pad-sm"
    style="background: var(--surface-color)"
    id="work"
>
    <div class="container">
        <div
            class="text-center mx-auto mb-5 fade-up"
            style="max-width: 680px"
        >
            <span class="eyebrow">What we do</span>
            <h2 style="font-size: 2.2rem">Our work</h2>
            <p class="text-muted-k mt-3">
                Five interconnected practices through which Karantaa
                turns evidence into impact.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 fade-up">
                <div class="k-card">
                    <div class="k-icon">
                        <i class="ri-microscope-line"></i>
                    </div>
                    <h3>Karantaa Research</h3>
                    <p>
                        High-quality research, policy analysis,
                        evaluations, and evidence synthesis on
                        critical issues affecting Africa.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-up delay-1">
                <div class="k-card">
                    <div class="k-icon">
                        <i class="ri-compass-3-line"></i>
                    </div>
                    <h3>Karantaa Advisory</h3>
                    <p>
                        Research, M&amp;E, policy advisory,
                        strategic learning, and institutional
                        strengthening for governments and partners.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-up delay-2">
                <div class="k-card">
                    <div class="k-icon">
                        <i class="ri-discuss-line"></i>
                    </div>
                    <h3>Karantaa Commons</h3>
                    <p>
                        A platform for civic education, public
                        dialogue, and intellectual exchange on
                        governance and development.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-up">
                <div class="k-card">
                    <div class="k-icon">
                        <i class="ri-newspaper-line"></i>
                    </div>
                    <h3>Karantaa Press</h3>
                    <p>
                        Policy briefs, reports, working papers,
                        essays, and books that make research
                        accessible to wider audiences.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-up delay-1">
                <div class="k-card">
                    <div class="k-icon">
                        <i class="ri-graduation-cap-line"></i>
                    </div>
                    <h3>Karantaa Academy</h3>
                    <p>
                        Training, fellowships, and mentorship that
                        invest in the next generation of African
                        thinkers and leaders.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-up delay-2">
                <div
                    class="k-card"
                    style="
                        background: var(--ink);
                        border-color: var(--ink);
                    "
                >
                    <div class="k-icon" style="background: #fff">
                        <i
                            class="ri-arrow-right-up-line"
                            style="color: var(--ink)"
                        ></i>
                    </div>
                    <h3 style="color: #fff">
                        See it all in detail
                    </h3>
                    <p style="color: rgba(255, 255, 255, 0.7)">
                        Explore each practice area in depth.
                    </p>
                    <a
                        href="<?= base_url("services") ?>"
                        class="btn btn-outline-ink mt-3"
                        style="
                            border-color: rgba(255, 255, 255, 0.4);
                            color: #fff !important;
                        "
                        >Visit Services</a
                    >
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-pad" id="themes">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5 fade-up">
                <span class="eyebrow">Research themes</span>
                <h2 style="font-size: 2.2rem">
                    Where we focus our inquiry
                </h2>
                <p class="text-muted-k mt-3">
                    Five themes guide Karantaa&rsquo;s research and
                    advisory work, each grounded in the realities
                    and priorities of African communities and
                    institutions.
                </p>
                <a
                    href="<?= base_url("services") ?>#themes"
                    class="btn btn-outline-ink mt-2"
                    >Explore our themes</a
                >
            </div>
            <div class="col-lg-7 fade-up delay-1">
                <div class="theme-row">
                    <div class="mark">01</div>
                    <div>
                        <h3>
                            Social Protection &amp; Human
                            Development
                        </h3>
                        <p>
                            Poverty, inequality, social protection
                            systems, and inclusive growth.
                        </p>
                    </div>
                </div>
                <div class="theme-row">
                    <div class="mark">02</div>
                    <div>
                        <h3>Governance &amp; Public Policy</h3>
                        <p>
                            Public sector reform, accountability,
                            institutions, and policy implementation.
                        </p>
                    </div>
                </div>
                <div class="theme-row">
                    <div class="mark">03</div>
                    <div>
                        <h3>Climate Change &amp; Resilience</h3>
                        <p>
                            Climate adaptation, environmental
                            governance, and community resilience.
                        </p>
                    </div>
                </div>
                <div class="theme-row">
                    <div class="mark">04</div>
                    <div>
                        <h3>Migration &amp; Mobility</h3>
                        <p>
                            Migration, displacement, diaspora
                            engagement, and urbanisation.
                        </p>
                    </div>
                </div>
                <div class="theme-row">
                    <div class="mark">05</div>
                    <div>
                        <h3>African Futures</h3>
                        <p>
                            Innovation, technology, youth futures,
                            and long-term development pathways.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-pad founder-section" id="founder">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 fade-up">
                <div class="founder-img-wrap">
                    <img
                        src="https://ik.imagekit.io/brighterweb/karantaa/team/abdoulie-kurang.jpg"
                        alt="Dr. Abdoulie Kurang, Founder and Director of Karantaa"
                        class="img-fluid"
                        loading="lazy"
                    />
                </div>
            </div>
            <div class="col-lg-7 fade-up delay-1">
                <span class="eyebrow">Meet the Founder</span>
                <div class="founder-role">Founder &amp; Director</div>
                <h2 style="font-size: 2.2rem; margin-bottom: 16px;">
                    Dr. Abdoulie Kurang
                </h2>
                <div class="divider-rule mb-4"></div>

                <p class="text-muted-k" style="font-size: 1.02rem; line-height: 1.8;">
                    Dr. Abdoulie Kurang is the Founder and Director of Karantaa, a Pan-African Research and Policy Lab dedicated to advancing evidence-informed research, policy, and civic engagement across Africa. He also serves as an Affiliate Editor at the <em>Review of African Political Economy</em> (ROAPE).
                </p>
                <p class="text-muted-k" style="font-size: 1.02rem; line-height: 1.8;">
                    Holding a PhD in Development Studies from SOAS University of London, he brings extensive experience as a researcher, lecturer, and policy adviser, having supported institutions, development agencies, and civil society across the continent.
                </p>

                <div class="d-flex flex-wrap align-items-center gap-4 mt-4">
                    <a href="<?= base_url(
                        "dr-abdoulie-kurang",
                    ) ?>" class="btn btn-ink">
                        Read full biography
                    </a>
                    <div class="founder-socials">
                        <a href="https://www.instagram.com/karantaa.26" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <i class="ri-instagram-line"></i>
                        </a>
                        <a href="https://www.linkedin.com/company/karantaa/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <i class="ri-linkedin-line"></i>
                        </a>
                        <a href="https://www.facebook.com/share/18qqv7jQ6t" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <i class="ri-facebook-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ink-band section-pad-sm">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7 fade-up">
                <h2 style="font-size: 2.1rem">
                    Let&rsquo;s <em>connect</em>
                </h2>
                <p class="desc mb-0" style="max-width: 480px">
                    Reach out to collaborate, share ideas, or learn
                    more about our work. We look forward to hearing
                    from you.
                </p>
            </div>
            <div class="col-lg-5 text-lg-end fade-up delay-1">
                <a href="<?= base_url("contact") ?>" class="btn btn-ink"
                    >Send us a message</a
                >
            </div>
        </div>
    </div>
</section>
<!-- ////// END Home Pages ///// -->


<!-- end main content -->
<?= $this->endSection() ?>
