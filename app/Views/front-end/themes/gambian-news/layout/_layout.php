<?php
// Get current theme
$theme = getCurrentTheme();

$siteName = getConfigData("SiteName");

// Get theme data
$themeData = [
    'customCSS' => getTableData('codes', ['code_for' => 'CSS'], 'code'),
    'customJSTop' => getTableData('codes', ['code_for' => 'HeaderJS'], 'code'),
    'customJSFooter' => getTableData('codes', ['code_for' => 'FooterJS'], 'code'),
    'defaultColor' => getThemeData($theme, "default_color"),
    'headingColor' => getThemeData($theme, "heading_color"),
    'accentColor' => getThemeData($theme, "accent_color"),
    'surfaceColor' => getThemeData($theme, "surface_color"),
    'contrastColor' => getThemeData($theme, "contrast_color"),
    'backgroundColor' => getThemeData($theme, "background_color"),
];

// Get navigation and social model lists
$navigationsModel = new \App\Models\NavigationsModel();
$topNavLists = $navigationsModel->where('group', 'top_nav')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll();
$footerNavLists = $navigationsModel->where('group', 'footer_nav')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll();
$servicesNavLists = $navigationsModel->where('group', 'services')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll();
?>

<?= $this->include('front-end/themes/'.$theme.'/includes/_functions.php'); ?>

<?php
$adminBar = renderAdminBar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--Load Meta Plugin Helpers-->
    <?=$this->include('front-end/themes/_shared/_load_meta_plugin_helpers.php'); ?>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Source+Serif+4:ital,wght@0,300;0,400;0,600;1,400&family=Barlow+Condensed:wght@500;600;700;800&family=Barlow:wght@400;500&display=swap" rel="stylesheet">
    <?=loadSiteIcons()?>

    <!-- Core Theme CSS Variables -->
    <?php
        $overrideStyle = getThemeData($theme, "override_default_style");
        $useStaticThemeNav = getThemeData($theme, "use_static_theme_nav");
        if($overrideStyle === "1"){

            // Theme color variables
            $defaultColor = $themeData['defaultColor'];
            $headingColor = $themeData['headingColor'];
            $accentColor = $themeData['accentColor'];
            $surfaceColor = $themeData['surfaceColor'];
            $contrastColor = $themeData['contrastColor'];
            $backgroundColor = $themeData['backgroundColor'];

            ?>
            <style>
                /* ===== Override Root Variables (NA) ===== */
                :root, [data-bs-theme="light"] {
                    --primary: #006b3c;
                    --primary-hover: #005530;
                    --primary-light: #e8f5ee;
                    --red: #c8102e;
                    --red-hover: #a00e25;
                    --gold: #d4af37;
                    --gold-light: #fdf7e3;
                    --ink: #1a1a2e;
                    --ink-muted: #3d3d5c;
                    --ink-light: #6b6b8a;
                    --paper: #fdfaf5;
                    --paper-secondary: #f5f0e8;
                    --paper-border: #e0d8c8;
                    --white: #ffffff;
                    --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.07);
                    --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.1);
                    --shadow-lg: 0 8px 40px rgba(0, 0, 0, 0.14);
                    --bs-body-bg: var(--paper);
                    --bs-body-color: var(--ink);
                }
                [data-bs-theme="dark"] {
                    --primary: #00a85a;
                    --primary-hover: #00c46a;
                    --primary-light: #0d2d1e;
                    --red: #e8294a;
                    --red-hover: #ff4060;
                    /* From blog-details.php */
                    --gold: #e8c84a;
                    --gold-light: #1e1a0a;
                    --ink: #eeeef2;
                    --ink-muted: #c0c0d4;
                    --ink-light: #8888aa;
                    --paper: #12121e;
                    --paper-secondary: #1a1a2e;
                    --paper-border: #2a2a3e;
                    --white: #ffffff;
                    --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.3);
                    --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.4);
                    --shadow-lg: 0 8px 40px rgba(0, 0, 0, 0.5);
                    --bs-body-bg: var(--paper);
                    --bs-body-color: var(--ink);
                }
            </style>
        <?php
        }
        else{
            ?>
                <style>
                    /* ===== CSS Variables ===== */
                    :root, [data-bs-theme="light"] {
                        --primary: #006b3c;
                        --primary-hover: #005530;
                        --primary-light: #e8f5ee;
                        --red: #c8102e;
                        --red-hover: #a00e25;
                        --gold: #d4af37;
                        --gold-light: #fdf7e3;
                        --ink: #1a1a2e;
                        --ink-muted: #3d3d5c;
                        --ink-light: #6b6b8a;
                        --paper: #fdfaf5;
                        --paper-secondary: #f5f0e8;
                        --paper-border: #e0d8c8;
                        --white: #ffffff;
                        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.07);
                        --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.1);
                        --shadow-lg: 0 8px 40px rgba(0, 0, 0, 0.14);
                        --bs-body-bg: var(--paper);
                        --bs-body-color: var(--ink);
                    }
                    [data-bs-theme="dark"] {
                        --primary: #00a85a;
                        --primary-hover: #00c46a;
                        --primary-light: #0d2d1e;
                        --red: #e8294a;
                        --red-hover: #ff4060;
                        /* From blog-details.php */
                        --gold: #e8c84a;
                        --gold-light: #1e1a0a;
                        --ink: #eeeef2;
                        --ink-muted: #c0c0d4;
                        --ink-light: #8888aa;
                        --paper: #12121e;
                        --paper-secondary: #1a1a2e;
                        --paper-border: #2a2a3e;
                        --white: #ffffff;
                        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.3);
                        --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.4);
                        --shadow-lg: 0 8px 40px rgba(0, 0, 0, 0.5);
                        --bs-body-bg: var(--paper);
                        --bs-body-color: var(--ink);
                    }
                </style>
            <?php
        }
    ?>

    <!-- Core Theme CSS -->
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/css/site.css') ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <?php if (!empty($themeData['customCSS'])): ?>
        <style><?= $themeData['customCSS'] ?></style>
    <?php endif; ?>

    <!-- Custom JavaScript in the head -->
    <?php if (!empty($themeData['customJSTop'])): ?>
        <?= $themeData['customJSTop'] ?>
    <?php endif; ?>

    <!-- PostHog -->
    <script>
        !function(t,e){var o,n,p,r;e.__SV||(window.posthog && window.posthog.__loaded)||(window.posthog=e,e._i=[],e.init=function(i,s,a){function g(t,e){var o=e.split(".");2==o.length&&(t=t[o[0]],e=o[1]),t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}}(p=t.createElement("script")).type="text/javascript",p.crossOrigin="anonymous",p.async=!0,p.src=s.api_host.replace(".i.posthog.com","-assets.i.posthog.com")+"/static/array.js",(r=t.getElementsByTagName("script")[0]).parentNode.insertBefore(p,r);var u=e;for(void 0!==a?u=e[a]=[]:a="posthog",u.people=u.people||[],u.toString=function(t){var e="posthog";return"posthog"!==a&&(e+="."+a),t||(e+=" (stub)"),e},u.people.toString=function(){return u.toString(1)+".people (stub)"},o="Ii init Di qi Sr Bi Zi Pi capture calculateEventProperties Yi register register_once register_for_session unregister unregister_for_session Xi getFeatureFlag getFeatureFlagPayload getFeatureFlagResult isFeatureEnabled reloadFeatureFlags updateFlags updateEarlyAccessFeatureEnrollment getEarlyAccessFeatures on onFeatureFlags onSurveysLoaded onSessionId getSurveys getActiveMatchingSurveys renderSurvey displaySurvey cancelPendingSurvey canRenderSurvey canRenderSurveyAsync Ji identify setPersonProperties group resetGroups setPersonPropertiesForFlags resetPersonPropertiesForFlags setGroupPropertiesForFlags resetGroupPropertiesForFlags reset setIdentity clearIdentity get_distinct_id getGroups get_session_id get_session_replay_url alias set_config startSessionRecording stopSessionRecording sessionRecordingStarted captureException startExceptionAutocapture stopExceptionAutocapture loadToolbar get_property getSessionProperty Wi Vi createPersonProfile setInternalOrTestUser Gi Fi tn opt_in_capturing opt_out_capturing has_opted_in_capturing has_opted_out_capturing get_explicit_consent_status is_capturing clear_opt_in_out_capturing $i debug Tr Ui getPageViewId captureTraceFeedback captureTraceMetric Ri".split(" "),n=0;n<o.length;n++)g(u,o[n]);e._i.push([i,s,a])},e.__SV=1)}(document,window.posthog||[]);
        posthog.init('phc_nERpxr7V97fJhpK7QeaNsbGH82qKDxPJ2ELHtuFmJLZo', {
            api_host: 'https://eu.i.posthog.com',
            defaults: '2026-01-30',
            person_profiles: 'identified_only', // or 'always' to create profiles for anonymous users as well
        })
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RG9K0ZTTT4"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-RG9K0ZTTT4');
    </script>

    <!-- Cookiebot -->
    <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="53068553-b507-4552-ad63-0b6c28761e2e" data-blockingmode="auto" type="text/javascript"></script>

    <!--Load Header Plugin Helpers-->
    <?=$this->include('front-end/themes/_shared/_load_header_plugin_helpers.php'); ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?= $adminBar ?>

    <!-- ===== Top Bar ===== -->
    <div class="topbar">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="date-weather d-flex align-items-center gap-3">
                    <span id="topbar-date"></span>
                    <?= renderWeatherBadge() ?>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="social-icons d-flex gap-1">
                        <a href="https://facebook.com/TheGambianNews" target="_blank" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
                        <a href="https://twitter.com/TheGambianNews" target="_blank" aria-label="Twitter/X"><i class="ri-twitter-x-fill"></i></a>
                        <a href="https://instagram.com/GambianNews" target="_blank" aria-label="Instagram"><i class="ri-instagram-fill"></i></a>
                        <a href="https://youtube.com/@gambian-news" target="_blank" aria-label="YouTube"><i class="ri-youtube-fill"></i></a>
                        <a href="https://t.me/GambianNews" target="_blank" aria-label="Telegram"><i class="ri-telegram-fill"></i></a>
                        <a href="/rss" target="_blank" aria-label="RSS Feed"><i class="ri-rss-fill"></i></a>
                    </div>
                    <span style="color:rgba(255,255,255,0.2);">|</span>
                    <a href="<?= base_url('/advertise') ?>">Advertise</a>
                    <a href="<?= base_url('/submit-news') ?>">Submit News</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== Masthead ===== -->
    <header class="masthead">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <!-- Logo -->
                <a href="<?= base_url() ?>" class="site-logo">
                    <div class="logo-icon" id="logo-icon-wrap">
                        <!-- If image exists, replace i tag below with: <img src="logo.png" alt="GambianNews logo"> -->
                        <i class="ri-newspaper-fill"></i>
                    </div>
                    <div class="logo-wordmark">
                        <div class="name">Gambian<span>News</span></div>
                        <div class="tagline">The Gambia's News Aggregator</div>
                    </div>
                </a>

                <!-- Search + Theme -->
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <form action="<?= base_url('/search') ?>" method="get">
                        <div class="search-bar-wrap">
                            <input type="search" id="q" name="q" placeholder="Search Gambian news…" autocomplete="off" aria-label="Search news" />
                            <button type="button" aria-label="Search"><i class="ri-search-line"></i></button>
                        </div>
                    </form>
                    <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
                        <i id="themeIcon" class="ri-moon-line"></i>
                        <span id="themeLabel">Dark</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- ===== Main Navigation ===== -->
    <nav class="main-nav navbar navbar-expand-lg">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto align-items-lg-center">
                    <?php if ($useStaticThemeNav === "1"): ?>
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url()?>">Home</a></li>
                        
                        <!-- Politics Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="<?= base_url('/search') ?>?q=politics" role="button" data-bs-toggle="dropdown">Politics</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=presidential">Presidential</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=parliamentary">Parliamentary</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=election">Elections</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=government">Local Government</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=justice">Justice & Judiciary</a></li>
                            </ul>
                        </li>
                        
                        <!-- Business Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="<?= base_url('/search') ?>?q=business" role="button" data-bs-toggle="dropdown">Business</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=economy">Economy</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=agriculture">Agriculture</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=tourism">Tourism</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=finance">Finance</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=transport">Transport & Infrastructure</a></li>
                            </ul>
                        </li>
                        
                        <!-- Sports -->
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('/search') ?>?q=sports">Sports</a></li>
                        
                        <!-- Society Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="<?= base_url('/search') ?>?q=society" role="button" data-bs-toggle="dropdown">Society</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=education">Education</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=health">Health</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=religion">Religion</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=human">Human Interest</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=environment">Environment</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=accident">Accidents & Disasters</a></li>
                            </ul>
                        </li>
                        
                        <!-- West Africa -->
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('/search') ?>?q=west-africa">West Africa</a></li>
                        
                        <!-- International -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="<?= base_url('/search') ?>?q=international" role="button" data-bs-toggle="dropdown">World</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=international">International News</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=international">International Relations</a></li>
                                <!-- <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= base_url('/search') ?>?q=international">All World News</a></li> -->
                            </ul>
                        </li>
                        
                        <!-- Opinion -->
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('/search') ?>?q=opinion">Opinion</a></li>
                        
                        <!-- Technology & Innovation -->
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('/search') ?>?q=tech">Tech</a></li>
                        
                        <!-- Entertainment & Celebrity -->
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('/search') ?>?q=entertainment">Entertainment</a></li>
                        
                        <!-- Crime & Security -->
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('/search') ?>?q=crime">Crime</a></li>
                        
                        <!-- Miscellaneous -->
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('/search') ?>?q=miscellaneous">Other</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('/blogs')?>">All News</a></li>
                    <?php else: ?>
                        <!-- Dynamic navigation (from database) -->
                        <?php if ($topNavLists): ?>
                            <?php foreach ($topNavLists as $navigation): ?>
                                <?= themef_renderNavigation($navigation, $navigationsModel) ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!-- Optional: Live Highlight -->
                    <!--<li class="nav-item"><a class="nav-link nav-highlight ms-lg-2" href="#"> <i class="ri-record-circle-fill text-warning"></i> Live</a></li>-->
                </ul>
            </div>
        </div>
    </nav>

    <?php
        use App\Models\BlogsModel;
        $blogsModel = new BlogsModel();
        
        // Get breaking news posts from the last 24 hours
        $breakingNewsPosts = $blogsModel
            ->where('is_breaking', 1)
            ->where('status', 1)
            ->where('created_at >=', date('Y-m-d H:i:s', strtotime('-24 hours')))
            ->orderBy('created_at', 'DESC')
            ->findAll();
    ?>

    <?php if ($breakingNewsPosts && count($breakingNewsPosts) > 0): ?>
        <!-- ===== Breaking News Ticker ===== -->
        <div class="breaking-bar">
            <div class="container d-flex align-items-center">
                <span class="breaking-label">Trending</span>
                <div class="ticker-wrap" aria-live="polite">
                    <div class="ticker-inner" id="ticker">
                        <?php foreach ($breakingNewsPosts as $post): ?>
                            <span class="ticker-item">
                                <a href="<?= base_url('blog/' . $post['slug']) ?>" style="color: white; text-decoration: none;">
                                    <?= esc($post['title']) ?>
                                </a>
                            </span>
                        <?php endforeach; ?>
                        
                        <?php foreach ($breakingNewsPosts as $post): ?>
                            <span class="ticker-item">
                                <a href="<?= base_url('blog/' . $post['slug']) ?>" style="color: white; text-decoration: none;">
                                    <?= esc($post['title']) ?>
                                </a>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- ===== Sources Strip ===== -->
    <div class="sources-strip">
        <div class="container">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <span style="font-family:'Barlow Condensed',sans-serif;font-size:0.75rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--ink-light);white-space:nowrap;">Sources:</span>
                <div class="sources-scroll">
                    <a href="<?= base_url('/sources/the+gambia+news+journal') ?>" class="source-pill"><i class="ri-newspaper-line"></i> GM News Journal</a>
                    <a href="<?= base_url('/sources/jollof+news') ?>" class="source-pill"><i class="ri-newspaper-line"></i> Jollof News</a>
                    <a href="<?= base_url('/sources/foroyaa') ?>" class="source-pill"><i class="ri-newspaper-line"></i> Foroyaa</a>
                    <a href="<?= base_url('/sources/freedom') ?>" class="source-pill"><i class="ri-newspaper-line"></i> Freedom</a>
                    <a href="<?= base_url('/sources/voice+gambia') ?>" class="source-pill"><i class="ri-newspaper-line"></i> Voice Gambia</a>
                    <a href="<?= base_url('/sources/the+point') ?>" class="source-pill"><i class="ri-newspaper-line"></i> The Point</a>
                    <a href="<?= base_url('/sources/gambiana') ?>" class="source-pill"><i class="ri-newspaper-line"></i> Gambiana</a>
                    <a href="<?= base_url('/sources/kerr+fatou') ?>" class="source-pill"><i class="ri-newspaper-line"></i> Kerr Fatou</a>
                    <a href="<?= base_url('/sources/whats+on+gambia') ?>" class="source-pill"><i class="ri-newspaper-line"></i> WOG</a>
                    <a href="<?= base_url('/sources/alkamba+times') ?>" class="source-pill"><i class="ri-newspaper-line"></i> Alkamba Times</a>
                    <a href="<?= base_url('/sources/the+standard') ?>" class="source-pill"><i class="ri-newspaper-line"></i> The Standard</a>
                    <a href="<?= base_url('/sources/the+republic') ?>" class="source-pill"><i class="ri-newspaper-line"></i> The Republic</a>
                    <a href="<?= base_url('/blogs') ?>" class="source-pill"><i class="ri-add-large-fill"></i> More</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main" id="template-html">
        <?= $this->renderSection('content') ?>
    </main>
    <!-- End Main Content -->

    <!-- ===== Footer ===== -->
    <footer class="site-footer mt-auto">
        <div class="container">
            <div class="row g-4">
                <!-- About -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-logo mb-2">
                        <div class="name">Gambian<span>News</span>.com</div>
                    </div>
                    <p style="font-size:0.88rem;color:rgba(255,255,255,0.6);line-height:1.65;">Your one-stop hub for all Gambian news. We aggregate headlines from The Gambia's most trusted newspapers and news platforms, bringing them together in one convenient place.</p>
                    <div class="footer-social mt-3">
                        <a href="https://facebook.com/TheGambianNews" target="_blank" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
                        <a href="https://twitter.com/TheGambianNews" target="_blank" aria-label="Twitter/X"><i class="ri-twitter-x-fill"></i></a>
                        <a href="https://instagram.com/GambianNews" target="_blank" aria-label="Instagram"><i class="ri-instagram-fill"></i></a>
                        <a href="https://youtube.com/@gambian-news" target="_blank" aria-label="YouTube"><i class="ri-youtube-fill"></i></a>
                        <a href="https://t.me/GambianNews" target="_blank" aria-label="Telegram"><i class="ri-telegram-fill"></i></a>
                        <a href="/rss.xml" target="_blank" aria-label="RSS"><i class="ri-rss-fill"></i></a>
                    </div>
                </div>
                <!-- Categories -->
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="footer-heading">Categories</div>
                    <ul class="footer-links">
                        <li><a href="<?= base_url('/search?q=politics') ?>">Politics</a></li>
                        <li><a href="<?= base_url('/search?q=business') ?>">Business</a></li>
                        <li><a href="<?= base_url('/search?q=sports') ?>">Sports</a></li>
                        <li><a href="<?= base_url('/search?q=society') ?>">Society</a></li>
                        <li><a href="<?= base_url('/search?q=health') ?>">Health</a></li>
                        <li><a href="<?= base_url('/search?q=education') ?>">Education</a></li>
                        <li><a href="<?= base_url('/search?q=technology') ?>">Technology</a></li>
                        <li><a href="<?= base_url('/search?q=opinion') ?>">Opinion</a></li>
                    </ul>
                </div>
                <!-- Sources -->
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="footer-heading">News Sources</div>
                    <ul class="footer-links">
                        <li><a href="<?= base_url('/search?q=fatu+network') ?>">FatuNetwork</a></li>
                        <li><a href="<?= base_url('/search?q=the+standard') ?>">The Standard</a></li>
                        <li><a href="<?= base_url('/search?q=whats+on+gambia') ?>">WhatsOnGambia</a></li>
                        <li><a href="<?= base_url('/search?q=foroyaa') ?>">Foroyaa</a></li>
                        <li><a href="<?= base_url('/search?q=the+point') ?>">The Point</a></li>
                        <li><a href="<?= base_url('/search?q=daily+observer') ?>">Daily Observer</a></li>
                        <li><a href="<?= base_url('/search?q=the+chronicle') ?>">The Chronicle</a></li>
                        <li><a href="<?= base_url('/search?q=kerr+fatou') ?>">Kerr Fatou</a></li>
                    </ul>
                </div>
                <!-- Company -->
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="footer-heading">Company</div>
                    <ul class="footer-links">
                        <li><a href="<?= base_url('/about-us') ?>">About Us</a></li>
                        <li><a href="<?= base_url('/contact-us') ?>">Contact</a></li>
                        <li><a href="<?= base_url('/advertise') ?>">Advertise</a></li>
                        <li><a href="<?= base_url('/submit-news') ?>">Submit News</a></li>
                        <li><a href="<?= base_url('/sitemap.xml') ?>">Sitemap</a></li>
                        <li><a href="<?= base_url('/feeds') ?>">News Feeds</a></li>
                        <li><a href="<?= base_url('/rss') ?>">RSS Feed</a></li>
                    </ul>
                </div>
                <!-- Legal -->
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="footer-heading">Legal</div>
                    <ul class="footer-links">
                        <li><a href="<?= base_url('/privacy-policy') ?>">Privacy Policy</a></li>
                        <li><a href="<?= base_url('/terms-of-use') ?>">Terms of Use</a></li>
                        <li><a href="<?= base_url('/cookie-policy') ?>">Cookie Policy</a></li>
                        <li><a href="<?= base_url('/disclaimer') ?>">Disclaimer</a></li>
                        <li><a href="<?= base_url('/copyright') ?>">Copyright</a></li>
                    </ul>
                </div>
            </div>

            <!-- Footer bottom -->
            <div class="footer-bottom d-flex flex-wrap align-items-center justify-content-between gap-2">
                <span>© 2025 GambianNews.com · All rights reserved.</span>
                <span>Aggregating news from The Gambia's top sources. We do not own the content; all rights belong to respective publishers.</span>
            </div>
        </div>
    </footer>

    <!-- Scroll to top -->
    <button id="scrollTopBtn" aria-label="Scroll to top"><i class="ri-arrow-up-line"></i></button>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--SweetAlert2 CDN-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Core theme JS -->
    <script defer src="<?= base_url('public/front-end/themes/' . $theme . '/assets/js/site.js') ?>"></script>

    <!-- Custom JavaScript in the footer -->
    <?php if (!empty($themeData['customJSFooter'])): ?>
        <?= $themeData['customJSFooter'] ?>
    <?php endif; ?>

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
    <?= $this->include('front-end/layout/assets/sweet_alerts.php'); ?>
	
	<!--Load Footer Plugin Helpers-->
    <?=$this->include('front-end/themes/_shared/_load_footer_plugin_helpers.php'); ?>
</body>
</html>