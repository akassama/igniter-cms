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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <?=loadSiteIcons()?>

    <!-- Google Tag Manager -->
    <script
        async
        src="https://www.googletagmanager.com/gtag/js?id=G-EGZTK2C5GR"
    ></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
        dataLayer.push(arguments);
        }
        gtag("js", new Date());
        gtag("config", "G-EGZTK2C5GR");
    </script>
    <!-- End Google Tag Manager -->
    <!-- Ahrefs -->
    <script
        src="https://analytics.ahrefs.com/analytics.js"
        data-key="9X/LjvLsIFDde+Bx2lCXYQ"
        async
    ></script>
    <!-- DataHog -->
    <script>
        !(function (t, e) {
        var o, n, p, r;
        e.__SV ||
            ((window.posthog = e),
            (e._i = []),
            (e.init = function (i, s, a) {
                function g(t, e) {
                    var o = e.split(".");
                    2 == o.length && ((t = t[o[0]]), (e = o[1])),
                    (t[e] = function () {
                        t.push(
                            [e].concat(
                                Array.prototype.slice.call(arguments, 0),
                            ),
                        );
                    });
                }
                ((p = t.createElement("script")).type = "text/javascript"),
                    (p.async = !0),
                    (p.src =
                    s.api_host.replace(
                        ".i.posthog.com",
                        "-assets.i.posthog.com",
                    ) + "/static/array.js"),
                    (r =
                    t.getElementsByTagName(
                        "script",
                    )[0]).parentNode.insertBefore(p, r);
                var u = e;
                for (
                    void 0 !== a ? (u = e[a] = []) : (a = "posthog"),
                    u.people = u.people || [],
                    u.toString = function (t) {
                        var e = "posthog";
                        return (
                            "posthog" !== a && (e += "." + a),
                            t || (e += " (stub)"),
                            e
                        );
                    },
                    u.people.toString = function () {
                        return u.toString(1) + ".people (stub)";
                    },
                    o =
                        "init capture register register_once register_for_session unregister opt_out_capturing has_opted_out_capturing opt_in_capturing reset isFeatureEnabled getFeatureFlag getFeatureFlagPayload reloadFeatureFlags group identify setPersonProperties setPersonPropertiesForFlags resetPersonPropertiesForFlags setGroupPropertiesForFlags resetGroupPropertiesForFlags resetGroups onFeatureFlags addFeatureFlagsHandler onSessionId getSurveys getActiveMatchingSurveys renderSurvey canRenderSurvey getNextSurveyStep".split(
                            " ",
                        ),
                    n = 0;
                    n < o.length;
                    n++
                )
                    g(u, o[n]);
                e._i.push([i, s, a]);
            }),
            (e.__SV = 1));
        })(document, window.posthog || []);
        posthog.init("phc_UZjan0YnkZblpgsbYCdPE8zn8DziuSAQ8pSPJ50bMgw", {
        api_host: "https://eu.i.posthog.com",
        defaults: "2026-01-30",
        });
    </script>

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
                /* ===== Override Root Variables ===== */
                :root,
                [data-bs-theme="light"] {
                    /* Primary Colors (from $defaultColor) */
                    --default-color:        <?= color_variant($defaultColor, 'hsl') ?>;
                    --default-hover:        <?= color_variant($defaultColor, 'hsl', ['lightness' => -5, 'saturation' => 5]) ?>;
                    --default-border:       <?= color_variant($defaultColor, 'hsl') ?>;
                    --default-rgb:          <?= color_variant($defaultColor, 'rgb-values') ?>;
                    
                    /* Heading Colors (from $headingColor) */
                    --heading-color:        <?= color_variant($headingColor, 'hsl') ?>;
                    --heading-muted:        <?= color_variant($headingColor, 'hsl', ['lightness' => 30, 'saturation' => -15]) ?>;
                    --heading-rgb:          <?= color_variant($headingColor, 'rgb-values') ?>;
                    
                    /* Accent Colors (from $accentColor) */
                    --accent-color:         <?= color_variant($accentColor, 'hsl') ?>;
                    --accent-hover:         <?= color_variant($accentColor, 'hsl', ['lightness' => -8]) ?>;
                    --accent-border:        <?= color_variant($accentColor, 'hsl') ?>;
                    --accent-rgb:           <?= color_variant($accentColor, 'rgb-values') ?>;
                    
                    /* Contrast Colors (from $contrastColor) */
                    --contrast-color:       <?= color_variant($contrastColor, 'hsl') ?>;
                    --contrast-hover:       <?= color_variant($contrastColor, 'hsl', ['lightness' => -7, 'saturation' => 5]) ?>;
                    --contrast-border:      <?= color_variant($contrastColor, 'hsl') ?>;
                    --contrast-rgb:         <?= color_variant($contrastColor, 'rgb-values') ?>;
                    
                    /* Surface Colors (from $surfaceColor) */
                    --surface-color:        <?= color_variant($surfaceColor, 'hsl') ?>;
                    --surface-secondary:    <?= color_variant($surfaceColor, 'hsl', ['lightness' => -2]) ?>;
                    --surface-border:       <?= color_variant($surfaceColor, 'hsl', ['lightness' => -10, 'saturation' => -5]) ?>;
                    --surface-rgb:          <?= color_variant($surfaceColor, 'rgb-values') ?>;
                    
                    /* Background Colors (from $backgroundColor) */
                    --background-color:     <?= color_variant($backgroundColor, 'hsl') ?>;
                    --background-secondary: <?= color_variant($backgroundColor, 'hsl', ['lightness' => -3]) ?>;
                    --background-rgb:       <?= color_variant($backgroundColor, 'rgb-values') ?>;
                    
                    /* Text Colors - derived from headingColor */
                    --text-color:           <?= color_variant($headingColor, 'hsl') ?>;
                    --text-muted:           <?= color_variant($headingColor, 'hsl', ['lightness' => 25, 'saturation' => -10]) ?>;
                    --text-light:           <?= color_variant($headingColor, 'hsl', ['lightness' => 45, 'saturation' => -20]) ?>;
                    --text-rgb:             <?= color_variant($headingColor, 'rgb-values') ?>;
                    
                    /* Form Colors */
                    --form-bg:              var(--background-color);
                    --form-border:          <?= color_variant($accentColor, 'hsl', ['lightness' => 35, 'saturation' => -15]) ?>;
                    --form-text:            var(--text-color);
                    
                    /* Shadows */
                    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
                    --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.1);
                    --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
                    
                    /* Transition */
                    --transition: all 0.3s ease;
                    
                    /* Bootstrap 5 Theme Overrides */
                    --bs-primary: var(--default-color);
                    --bs-primary-rgb: var(--default-rgb);
                    --bs-primary-hover: var(--default-hover);
                    --bs-secondary: var(--accent-color);
                    --bs-secondary-rgb: var(--accent-rgb);
                    --bs-warning: var(--contrast-color);
                    --bs-warning-rgb: var(--contrast-rgb);
                    --bs-body-bg: var(--background-color);
                    --bs-body-color: var(--text-color);
                    --bs-border-color: var(--surface-border);
                    --bs-card-bg: var(--surface-color);
                    --bs-link-color: var(--default-color);
                    --bs-link-hover-color: var(--default-hover);
                    --bs-nav-link-color: var(--heading-color);
                    --bs-nav-link-hover-color: var(--default-color);
                    --bs-dropdown-bg: var(--background-color);
                    --bs-dropdown-link-color: var(--text-color);
                    --bs-dropdown-link-hover-color: var(--default-color);
                    --bs-dropdown-link-hover-bg: var(--surface-color);
                    --bs-navbar-toggler-border-color: var(--surface-border);
                }

                /* ===== Dark Theme Overrides ===== */
                [data-bs-theme="dark"] {
                    --heading-color: hsl(210, 17%, 95%);
                    --heading-muted: hsl(210, 17%, 85%);
                    --surface-color: hsl(210, 10%, 15%);
                    --surface-secondary: hsl(210, 10%, 20%);
                    --surface-border: hsl(210, 10%, 30%);
                    --background-color: hsl(210, 10%, 12%);
                    --background-secondary: hsl(210, 10%, 15%);
                    --text-color: hsl(210, 17%, 85%);
                    --text-muted: hsl(210, 17%, 70%);
                    --form-bg: var(--surface-color);
                    --form-border: var(--surface-border);
                    --form-text: var(--text-color);
                    --bs-body-bg: var(--background-color);
                    --bs-body-color: var(--text-color);
                    --bs-border-color: var(--surface-border);
                    --bs-card-bg: var(--surface-color);
                }

                /* Apply Custom Properties */
                body {
                    background-color: var(--background-color);
                    color: var(--text-color);
                    transition: var(--transition);
                }
            </style>
        <?php
        }
        else{
            ?>
            <style>
                /* ===== Core CSS Variables ===== */
                :root,
                [data-bs-theme="light"] {
                    /* Primary Colors */
                    --default-color: hsl(213, 77%, 24%);
                    --default-hover: hsl(213, 77%, 30%);
                    --default-border: hsl(213, 77%, 24%);
                    --default-rgb: 14, 57, 108;
                    /* Heading Colors */
                    --heading-color: hsl(210, 7%, 11%);
                    --heading-muted: hsl(210, 7%, 18%);
                    --heading-rgb: 26, 28, 30;
                    /* Accent Colors */
                    --accent-color: hsl(26, 86%, 51%);
                    --accent-hover: hsl(26, 86%, 58%);
                    --accent-border: hsl(26, 86%, 51%);
                    --accent-rgb: 237, 118, 24;
                    /* Contrast Colors */
                    --contrast-color: hsl(45, 100%, 51%);
                    --contrast-hover: hsl(45, 100%, 58%);
                    --contrast-border: hsl(45, 100%, 51%);
                    --contrast-rgb: 255, 193, 7;
                    /* Surface Colors */
                    --surface-color: hsl(210, 17%, 98%);
                    --surface-secondary: hsl(210, 17%, 96%);
                    --surface-border: hsl(211, 25%, 84%);
                    --surface-rgb: 248, 249, 250;
                    /* Background Colors */
                    --background-color: hsl(0, 0%, 100%);
                    --background-secondary: hsl(210, 17%, 98%);
                    --background-rgb: 255, 255, 255;
                    /* Text Colors */
                    --text-color: hsl(210, 7%, 11%);
                    --text-muted: hsl(210, 7%, 25%);
                    --text-light: hsl(211, 25%, 84%);
                    --text-rgb: 26, 28, 30;
                    /* Form Colors */
                    --form-bg: var(--background-color);
                    --form-border: hsl(211, 25%, 84%);
                    --form-text: var(--text-color);
                    /* Success, Error, Warning Colors */
                    --success-color: hsl(134, 61%, 41%);
                    --success-rgb: 40, 167, 69;
                    --error-color: hsl(354, 70%, 54%);
                    --error-rgb: 220, 53, 69;
                    --warning-color: hsl(45, 100%, 51%);
                    --warning-rgb: 255, 193, 7;
                    /* Shadow */
                    --shadow-sm: 0 1px 3px rgba(14, 57, 108, 0.1);
                    --shadow-md: 0 4px 12px rgba(14, 57, 108, 0.15);
                    --shadow-lg: 0 10px 25px rgba(14, 57, 108, 0.2);
                    /* Transition */
                    --transition: all 0.3s ease;
                    /* Bootstrap Theme Variables Override */
                    --bs-primary: var(--default-color);
                    --bs-primary-rgb: var(--default-rgb);
                    --bs-primary-hover: var(--default-hover);
                    --bs-secondary: var(--accent-color);
                    --bs-secondary-rgb: var(--accent-rgb);
                    --bs-warning: var(--contrast-color);
                    --bs-warning-rgb: var(--contrast-rgb);
                    --bs-success: var(--success-color);
                    --bs-success-rgb: var(--success-rgb);
                    --bs-danger: var(--error-color);
                    --bs-danger-rgb: var(--error-rgb);
                    --bs-body-bg: var(--background-color);
                    --bs-body-color: var(--text-color);
                    --bs-border-color: var(--surface-border);
                    --bs-card-bg: var(--surface-color);
                    --bs-link-color: var(--default-color);
                    --bs-link-hover-color: var(--default-hover);
                }

                /* Dark Theme Variables */
                [data-bs-theme="dark"] {
                    --heading-color: hsl(210, 17%, 95%);
                    --heading-muted: hsl(210, 17%, 85%);
                    --surface-color: hsl(210, 10%, 15%);
                    --surface-secondary: hsl(210, 10%, 20%);
                    --surface-border: hsl(210, 10%, 30%);
                    --background-color: hsl(210, 10%, 12%);
                    --background-secondary: hsl(210, 10%, 15%);
                    --text-color: hsl(210, 17%, 85%);
                    --text-muted: hsl(210, 17%, 70%);
                    --form-bg: var(--surface-color);
                    --form-border: var(--surface-border);
                    --form-text: var(--text-color);
                    --bs-body-bg: var(--background-color);
                    --bs-body-color: var(--text-color);
                    --bs-border-color: var(--surface-border);
                    --bs-card-bg: var(--surface-color);
                }

                /* Apply Custom Properties */
                body {
                    background-color: var(--background-color);
                    color: var(--text-color);
                    transition: var(--transition);
                }
            </style>
            <?php
        }
    ?>

    <!-- Core Theme CSS -->
    <link href="<?= base_url('public/front-end/themes/' . $theme . '/assets/css/style.css') ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <?php if (!empty($themeData['customCSS'])): ?>
        <style><?= $themeData['customCSS'] ?></style>
    <?php endif; ?>

    <!-- Custom JavaScript in the head -->
    <?php if (!empty($themeData['customJSTop'])): ?>
        <?= $themeData['customJSTop'] ?>
    <?php endif; ?>

    <!--Load Header Plugin Helpers-->
    <?=$this->include('front-end/themes/_shared/_load_header_plugin_helpers.php'); ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?= $adminBar ?>

    <style>
        /* ==================== Component CSS ==================== */
        /*--------------------------------------------------------------
        # Global Top Bar
        --------------------------------------------------------------*/
        .brt-topbar {
        background-color: color-mix(
            in srgb,
            var(--default-color),
            transparent 95%
        );
        height: 40px;
        padding: 0;
        font-size: 14px;
        transition: all 0.5s ease;
        display: flex;
        align-items: center;
        border-bottom: 1px solid
            color-mix(in srgb, var(--default-color), transparent 90%);
        }

        .brt-topbar .brt-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        }

        .brt-topbar .brt-contact-info {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        }

        .brt-topbar .brt-contact-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-color);
        text-decoration: none;
        transition: color 0.3s ease;
        font-weight: 500;
        }

        .brt-topbar .brt-contact-item i {
        font-size: 1rem;
        color: var(--accent-color);
        transition: color 0.3s ease;
        }

        .brt-topbar .brt-contact-item:hover {
        color: var(--accent-color);
        }

        .brt-topbar .brt-contact-item:hover i {
        color: var(--accent-color);
        }

        .brt-topbar .brt-social-links {
        display: flex;
        align-items: center;
        gap: 1rem;
        }

        .brt-topbar .brt-social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background-color: color-mix(
            in srgb,
            var(--default-color),
            transparent 90%
        );
        color: var(--text-color);
        font-size: 0.875rem;
        transition: all 0.3s ease;
        text-decoration: none;
        }

        .brt-topbar .brt-social-link:hover {
        background-color: var(--accent-color);
        color: var(--contrast-color);
        transform: translateY(-2px);
        }

        .brt-topbar .brt-social-link.twitter:hover {
        background-color: #1da1f2;
        }

        .brt-topbar .brt-social-link.facebook:hover {
        background-color: #1877f2;
        }

        .brt-topbar .brt-social-link.instagram:hover {
        background: linear-gradient(
            45deg,
            #405de6,
            #5851db,
            #833ab4,
            #c13584,
            #e1306c,
            #fd1d1d
        );
        }

        .brt-topbar .brt-social-link.linkedin:hover {
        background-color: #0a66c2;
        }

        .brt-topbar .brt-social-link.youtube:hover {
        background-color: #ff0000;
        }

        /* Hide on scroll */
        .brt-header-scrolled .brt-topbar {
        height: 0;
        overflow: hidden;
        opacity: 0;
        visibility: hidden;
        border-bottom: none;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
        .brt-topbar .brt-container {
            padding: 0 0.75rem;
        }

        .brt-topbar .brt-contact-info {
            gap: 1rem;
        }

        .brt-topbar .brt-contact-item {
            font-size: 0.8125rem;
        }

        .brt-topbar .brt-contact-item i {
            font-size: 0.875rem;
        }

        .brt-topbar .brt-social-links {
            gap: 0.75rem;
        }

        .brt-topbar .brt-social-link {
            width: 24px;
            height: 24px;
            font-size: 0.75rem;
        }
        }

        @media (max-width: 575px) {
        .brt-topbar .brt-contact-info {
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-start;
        }

        .brt-topbar .brt-contact-item {
            font-size: 0.75rem;
        }

        .brt-topbar .brt-social-links {
            gap: 0.5rem;
        }
        }

        /* Theme-specific adjustments */
        [data-bs-theme="dark"] .brt-topbar {
        background-color: color-mix(
            in srgb,
            var(--surface-color),
            transparent 95%
        );
        border-bottom-color: color-mix(
            in srgb,
            var(--surface-color),
            transparent 90%
        );
        }

        [data-bs-theme="dark"] .brt-topbar .brt-contact-item {
        color: var(--text-color-dark);
        }

        [data-bs-theme="dark"] .brt-topbar .brt-social-link {
        background-color: color-mix(
            in srgb,
            var(--surface-color),
            transparent 90%
        );
        color: var(--text-color-dark);
        }
    </style>
    <!--==================== Component HTML Element ====================-->
    <div class="brt-topbar">
        <div class="brt-container">
        <div class="brt-contact-info">
            <a
                href="mailto:enquiries@brighterweb.co.uk"
                class="brt-contact-item"
            >
                <i class="ri-mail-line"></i>
                <span>enquiries@brighterweb.co.uk</span>
            </a>
            <a href="tel:+447895577949" class="brt-contact-item">
                <i class="ri-phone-line"></i>
                <span>+44 7895 577 949</span>
            </a>
            <div class="brt-contact-item">
                <i class="ri-time-line"></i>
                <span>Mon-Fri: 9AM-5PM BST</span>
            </div>
        </div>
        <div class="brt-social-links">
            <a
                href="https://x.com/thebrighterweb"
                target="_blank"
                class="brt-social-link twitter"
                aria-label="Twitter"
            >
                <i class="ri-twitter-x-line"></i>
            </a>
            <a
                href="https://www.facebook.com/profile.php?id=61587502274258"
                target="_blank"
                class="brt-social-link facebook"
                aria-label="Facebook"
            >
                <i class="ri-facebook-line"></i>
            </a>
            <a
                href="https://instagram.com/brighterweb"
                target="_blank"
                class="brt-social-link instagram"
                aria-label="Instagram"
            >
                <i class="ri-instagram-line"></i>
            </a>
            <a
                href="https://www.linkedin.com/in/brighter-web-8b769a3ab/"
                target="_blank"
                class="brt-social-link linkedin"
                aria-label="LinkedIn"
            >
                <i class="ri-linkedin-line"></i>
            </a>
            <a
                href="https://youtube.com/#brighterweb"
                target="_blank"
                class="brt-social-link youtube"
                aria-label="YouTube"
            >
                <i class="ri-youtube-line"></i>
            </a>
        </div>
        </div>
    </div>
    <!--==================== Component JavaScript ==================== -->
    <script>
        // ==================== Top Bar Scroll Behavior ====================
        document.addEventListener("DOMContentLoaded", function () {
        const topbar = document.querySelector(".brt-topbar");
        const body = document.body;
        if (!topbar) return;
        let lastScrollTop = 0;
        let isScrolling;

        function handleScroll() {
            const scrollTop =
                window.pageYOffset || document.documentElement.scrollTop;
            // Clear our timeout throughout the scroll
            window.clearTimeout(isScrolling);
            // Set a timeout to run after scrolling ends
            isScrolling = setTimeout(function () {
                if (scrollTop > 100) {
                    body.classList.add("brt-header-scrolled");
                } else {
                    body.classList.remove("brt-header-scrolled");
                }
            }, 66);
            lastScrollTop = scrollTop;
        }
        // Initial check
        handleScroll();
        // Listen for scroll events
        window.addEventListener("scroll", handleScroll, {
            passive: true,
        });
        // Handle window resize
        window.addEventListener("resize", function () {
            if (window.innerWidth < 768) {
                // On mobile, always show topbar when at top
                if (window.pageYOffset === 0) {
                    body.classList.remove("brt-header-scrolled");
                }
            }
        });
        // Theme toggle compatibility
        function updateTopbarTheme() {
            const theme =
                document.documentElement.getAttribute("data-bs-theme") ||
                "light";
            // Update social links for better visibility
            const socialLinks = topbar.querySelectorAll(".brt-social-link");
            socialLinks.forEach((link) => {
                if (theme === "dark") {
                    link.style.backgroundColor = "rgba(255, 255, 255, 0.1)";
                } else {
                    link.style.backgroundColor = "";
                }
            });
        }
        // Watch for theme changes
        const observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                if (mutation.attributeName === "data-bs-theme") {
                    updateTopbarTheme();
                }
            });
        });
        observer.observe(document.documentElement, {
            attributes: true,
        });
        // Initial theme update
        updateTopbarTheme();
        });
        // ==================== Smooth Scroll for Contact Links ====================
        document.addEventListener("DOMContentLoaded", function () {
        const contactLinks = document.querySelectorAll(
            '.brt-contact-item[href^="mailto"], .brt-contact-item[href^="tel"]',
        );
        contactLinks.forEach((link) => {
            link.addEventListener("click", function (e) {
                // Add click feedback
                this.style.transform = "scale(0.95)";
                setTimeout(() => {
                    this.style.transform = "";
                }, 150);
                // Log contact interaction (optional - for analytics)
                console.log(`Contact action: ${this.getAttribute("href")}`);
            });
        });
        });
    </script>
    
    <!--==================== Header & Navigation Style ====================-->
    <style>
        .navbar {
        background-color: var(--background-color) !important;
        border-bottom: 1px solid var(--surface-border);
        transition: var(--transition);
        }

        /* Navbar Spacing */
        .navbar-nav {
        gap: 0.8rem;
        }

        .navbar-nav .nav-link {
        color: var(--heading-color);
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        transition: var(--transition);
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link:focus {
        color: var(--default-color);
        background-color: var(--surface-color);
        }

        .navbar-nav .nav-link.active {
        color: var(--default-color) !important;
        font-weight: 600;
        position: relative;
        }

        .navbar-nav .nav-link.active::after {
        content: "";
        position: absolute;
        bottom: -1px;
        left: 1rem;
        right: 1rem;
        height: 2px;
        background-color: var(--default-color);
        border-radius: 1px;
        }

        .dropdown-menu {
        background-color: var(--background-color);
        border-color: var(--surface-border);
        box-shadow: var(--shadow-md);
        min-width: 13rem;
        }

        .dropdown-item {
        color: var(--text-color);
        padding: 0.5rem 1rem;
        transition: var(--transition);
        border-bottom: 1px solid var(--surface-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        }

        .dropdown-item:last-child {
        border-bottom: none;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
        color: var(--default-color);
        background-color: var(--surface-color);
        }

        /* Custom arrow for dropdown items with submenu */
        .dropdown-item.dropdown-toggle::after {
        border-left: 0.3em solid;
        border-right: 0;
        border-top: 0.3em solid transparent;
        border-bottom: 0.3em solid transparent;
        margin-left: 0.5rem;
        transform: rotate(0deg);
        transition: transform 0.3s ease;
        }

        .dropdown-submenu.show>.dropdown-item.dropdown-toggle::after,
        .dropdown-submenu:hover>.dropdown-item.dropdown-toggle::after {
        transform: rotate(90deg);
        }

        /* Theme Toggle Button */
        .brt-theme-toggle {
        background-color: var(--surface-color);
        border: 1px solid var(--surface-border);
        color: var(--text-color);
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        cursor: pointer;
        font-size: 1.25rem;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        min-width: 44px;
        min-height: 44px;
        }

        .brt-theme-toggle i {
        color: var(--default-color);
        transition: var(--transition);
        }

        .brt-theme-toggle:hover {
        background-color: var(--default-color);
        border-color: var(--default-color);
        transform: scale(1.05);
        }

        .brt-theme-toggle:hover i {
        color: white;
        }

        /* Custom Logo */
        .brt-logo {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--default-color);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        }

        /* Image Logo Styling */
        .brt-logo img {
        max-height: 45px;
        width: auto;
        object-fit: contain;
        transition: var(--transition);
        display: block;
        }

        /* Slight scale effect on hover to match your theme toggle */
        .brt-logo:hover img {
        transform: scale(1.05);
        }

        /* Multi-level Dropdown Styling */
        .dropdown-submenu {
        position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        border-radius: 0.375rem;
        }

        .dropdown-submenu:hover>.dropdown-menu {
        display: block;
        }

        /* Mobile Theme Toggle in Navbar */
        @media (max-width: 991.98px) {
        .navbar-nav {
            gap: 0;
            /* Reset gap for mobile */
        }

        .navbar-collapse .brt-theme-toggle {
            margin: 1rem auto;
            width: calc(100% - 2rem);
            justify-content: center;
        }

        .navbar-nav .nav-link {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--surface-border);
        }

        .navbar-nav .nav-link:last-child {
            border-bottom: none;
        }

        .dropdown-menu {
            border: none;
            box-shadow: none;
            background-color: var(--surface-secondary);
            padding-left: 1.5rem;
        }

        .dropdown-item {
            padding: 0.6rem 1.5rem;
        }

        /* Submenu styling for mobile */
        .dropdown-submenu .dropdown-menu {
            background-color: var(--surface-color);
            padding-left: 2rem;
        }

        /* Mobile arrow rotation */
        .dropdown-submenu.show>.dropdown-item.dropdown-toggle::after {
            transform: rotate(90deg);
        }

        .navbar-nav .nav-link.active::after {
            left: 0;
            right: 0;
            bottom: 0;
        }
        }

        .btn-brt-cta {
        background-color: var(--default-color) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 0.5rem !important;
        font-weight: 600 !important;
        transition: var(--transition) !important;
        text-align: center;
        box-shadow: var(--shadow-sm);
        }

        .btn-brt-cta:hover,
        .btn-brt-cta:focus {
        background-color: var(--default-hover) !important;
        color: #ffffff !important;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        }

        /* Tablet adjustments */
        @media (min-width: 768px) and (max-width: 991.98px) {
        .navbar-collapse {
            padding: 2rem;
        }

        .navbar-nav {
            gap: 0.5rem;
            /* Keep gap on tablet */
        }
        }

        /* Desktop hover effects */
        @media (min-width: 992px) {
        .dropdown:hover>.dropdown-menu {
            display: block;
        }

        .dropdown>.dropdown-toggle:active {
            pointer-events: none;
        }

        /* Additional desktop spacing adjustments */
        .navbar-nav .nav-item {
            margin: 0 0.125rem;/
        }

        .navbar-nav .nav-link {
            padding: 0.5rem 1rem;
        }

        .navbar-nav .btn-brt-cta {
            margin: 0.3rem 1rem !important;
            padding: 0.5rem 1rem !important;
            border-bottom: none !important;
        }

        .navbar-nav .nav-link.btn-brt-cta::after {
            display: none !important;
        }
        }

        @media (min-width: 992px) {
        .btn-brt-cta {
            padding: 0.6rem 1.5rem !important;
        }
        }
    </style>
    <!--==================== Header & Navigation ====================-->
    <header class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <!-- Logo -->
            <a href="<?= base_url() ?>" class="navbar-brand brt-logo">
                <img 
                    src="<?= getImageUrl(getConfigData('SiteLogoLink') ?? getDefaultImagePath()) ?>" 
                    alt="<?= getConfigData('SiteName') ?? 'Logo' ?>"
                    height="75"
                />
            </a>
            
            <!-- Mobile Theme Toggle -->
            <button 
                class="brt-theme-toggle d-lg-none me-2" 
                id="brt-themeToggleMobile" 
                aria-label="Toggle theme"
            >
                <i class="ri-moon-line" id="brt-themeIconMobile"></i>
            </button>
            
            <!-- Mobile Toggle Button -->
            <button 
                class="navbar-toggler" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navbarContent" 
                aria-controls="navbarContent" 
                aria-expanded="false" 
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if ($useStaticThemeNav === "1"): ?>
                        <!-- Static Navigation -->
                        <li class="nav-item">
                            <a class="nav-link <?= current_url() == base_url('/') ? 'active' : '' ?>" href="<?= base_url('/') ?>" target="_self">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= current_url() == base_url('about') ? 'active' : '' ?>" href="<?= base_url('about') ?>" target="_self">
                                About
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '#services') !== false ? 'active' : '' ?>" href="<?= base_url('#services') ?>" target="_self">
                                Services
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '#portfolio') !== false ? 'active' : '' ?>" href="<?= base_url('#portfolio') ?>" target="_self">
                                Portfolio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= current_url() == base_url('pricing') ? 'active' : '' ?>" href="<?= base_url('pricing') ?>" target="_self">
                                Pricing
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= current_url() == base_url('blogs') ? 'active' : '' ?>" href="<?= base_url('blogs') ?>" target="_self">
                                Blogs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= current_url() == base_url('contact') ? 'active' : '' ?>" href="<?= base_url('contact') ?>" target="_self">
                                Contact
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- Dynamic Navigation from CMS -->
                        <?php if ($topNavLists): ?>
                            <?php foreach ($topNavLists as $navigation): ?>
                                <?= themef_renderNavigation($navigation, $navigationsModel) ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <!-- Get Started Button (Desktop) -->
                    <li class="nav-item d-none d-lg-block">
                        <a href="<?= base_url('#contact') ?>" class="btn btn-brt-cta ms-2">
                            Get Started
                        </a>
                    </li>
                    
                    <!-- Get Started Button (Mobile - inside menu) -->
                    <li class="nav-item d-lg-none">
                        <a href="<?= base_url('#contact') ?>" class="nav-link btn-brt-cta">
                            Get Started
                        </a>
                    </li>
                    
                    <!-- Theme Toggle (Desktop) -->
                    <li class="nav-item d-none d-lg-flex align-items-center ms-2">
                        <button 
                            class="brt-theme-toggle" 
                            id="brt-themeToggle" 
                            aria-label="Toggle theme"
                        >
                            <i class="ri-moon-line" id="brt-themeIcon"></i>
                        </button>
                    </li>
                    
                    <!-- Theme Toggle (Mobile - inside menu) -->
                    <li class="nav-item d-lg-none mt-3">
                        <button 
                            class="brt-theme-toggle w-100" 
                            id="brt-themeToggleMenu" 
                            aria-label="Toggle theme"
                        >
                            <i class="ri-moon-line" id="brt-themeIconMenu"></i>
                            Toggle Theme
                        </button>
                    </li>
                </ul>
                
                <!-- Search Form (Moved inside navbar-collapse for mobile) -->
                <form action="<?= base_url('search') ?>" method="get" class="d-lg-none mt-3" role="search">
                    <div class="input-group">
                        <input class="form-control" type="search" id="q-mobile" name="q" placeholder="Search for..." aria-label="Search for..." minlength="2" required>
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="ri-search-line"></i>
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Desktop Search Form (outside collapse) -->
            <form action="<?= base_url('search') ?>" method="get" class="d-none d-lg-flex ms-xl-3" role="search">
                <div class="input-group">
                    <input class="form-control" type="search" id="q" name="q" placeholder="Search..." aria-label="Search..." minlength="2" required>
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="ri-search-line"></i>
                    </button>
                </div>
            </form>
        </div>
    </header>
    <!-- Header & Navigation JavaScript -->
      <script>
         // ==================== Theme Toggle Functionality ====================
         const themeToggles = [
            document.getElementById("brt-themeToggle"),
            document.getElementById("brt-themeToggleMobile"),
            document.getElementById("brt-themeToggleMenu"),
         ];
         const themeIcons = [
            document.getElementById("brt-themeIcon"),
            document.getElementById("brt-themeIconMobile"),
            document.getElementById("brt-themeIconMenu"),
         ];
         const html = document.documentElement;
         // Check for saved theme or prefer-color-scheme
         function getPreferredTheme() {
            const stored = localStorage.getItem("theme");
            if (stored) return stored;
            return window.matchMedia("(prefers-color-scheme: dark)").matches
               ? "dark"
               : "light";
         }
         // Set initial theme
         const currentTheme = getPreferredTheme();
         html.setAttribute("data-bs-theme", currentTheme);
         updateIcons(currentTheme);
         // Update all icons
         function updateIcons(theme) {
            const iconClass = theme === "dark" ? "ri-sun-line" : "ri-moon-line";
            themeIcons.forEach((icon) => {
               if (icon) icon.className = iconClass;
            });
         }
         // Toggle theme function
         function toggleTheme() {
            const currentTheme = html.getAttribute("data-bs-theme");
            const newTheme = currentTheme === "light" ? "dark" : "light";
            html.setAttribute("data-bs-theme", newTheme);
            localStorage.setItem("theme", newTheme);
            updateIcons(newTheme);
         }
         // Add event listeners to all toggle buttons
         themeToggles.forEach((toggle) => {
            if (toggle) toggle.addEventListener("click", toggleTheme);
         });
         // Listen for system theme changes
         window
            .matchMedia("(prefers-color-scheme: dark)")
            .addEventListener("change", (e) => {
               if (!localStorage.getItem("theme")) {
                  const newTheme = e.matches ? "dark" : "light";
                  html.setAttribute("data-bs-theme", newTheme);
                  updateIcons(newTheme);
               }
            });
         // ==================== Multi-level Dropdown Fix ====================
         // Handle submenu hover on desktop
         document.addEventListener("DOMContentLoaded", function () {
            const dropdownSubmenus =
               document.querySelectorAll(".dropdown-submenu");
            dropdownSubmenus.forEach((submenu) => {
               // Handle hover on desktop
               if (window.innerWidth >= 992) {
                  submenu.addEventListener("mouseenter", function () {
                     this.classList.add("show");
                     this.querySelector(".dropdown-menu").classList.add("show");
                  });
                  submenu.addEventListener("mouseleave", function () {
                     this.classList.remove("show");
                     this.querySelector(".dropdown-menu").classList.remove(
                        "show",
                     );
                  });
               }
               // Handle click on mobile
               const dropdownToggle = submenu.querySelector(".dropdown-toggle");
               if (dropdownToggle) {
                  dropdownToggle.addEventListener("click", function (e) {
                     if (window.innerWidth < 992) {
                        e.preventDefault();
                        e.stopPropagation();
                        const parent = this.closest(".dropdown-submenu");
                        parent.classList.toggle("show");
                        // Close other open submenus on mobile
                        dropdownSubmenus.forEach((otherSubmenu) => {
                           if (otherSubmenu !== parent) {
                              otherSubmenu.classList.remove("show");
                           }
                        });
                     }
                  });
               }
            });
            // Close all submenus when clicking elsewhere
            document.addEventListener("click", function (e) {
               if (!e.target.closest(".dropdown-submenu")) {
                  dropdownSubmenus.forEach((submenu) => {
                     submenu.classList.remove("show");
                  });
               }
            });
         });
         // ==================== Responsive Behavior ====================
         // Close mobile menu when clicking a nav link
         document.querySelectorAll(".navbar-nav .nav-link").forEach((link) => {
            link.addEventListener("click", () => {
               const navbarCollapse = document.getElementById("navbarContent");
               if (navbarCollapse.classList.contains("show")) {
                  const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                  bsCollapse.hide();
               }
            });
         });
         // Handle window resize
         window.addEventListener("resize", function () {
            const navbarCollapse = document.getElementById("navbarContent");
            if (
               window.innerWidth >= 992 &&
               navbarCollapse.classList.contains("show")
            ) {
               const bsCollapse = new bootstrap.Collapse(navbarCollapse);
               bsCollapse.hide();
            }
         });
      </script>

    <!-- Main Content -->
    <main class="main container-fluid" id="template-html">
        <?= $this->renderSection('content') ?>
    </main>
    <!-- End Main Content -->

    <style>
        /* ==================== Footer Component CSS ==================== */
        .brt-footer {
        background-color: var(--surface-secondary);
        color: var(--text-color);
        font-size: 0.95rem;
        padding-bottom: 3rem;
        border-top: 1px solid var(--surface-border);
        }

        .brt-footer-top {
        padding: 4rem 0 2rem;
        }

        .brt-footer .brt-logo-footer {
        font-size: 2rem;
        font-weight: 700;
        color: var(--default-color);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        }

        .brt-footer-about p {
        color: var(--text-muted);
        line-height: 1.7;
        margin-bottom: 1.5rem;
        }

        .brt-footer-social {
        display: flex;
        gap: 0.75rem;
        margin-top: 1rem;
        }

        .brt-footer-social a {
        width: 42px;
        height: 42px;
        border: 1px solid var(--surface-border);
        color: var(--text-muted);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        transition: var(--transition);
        text-decoration: none;
        }

        .brt-footer-social a:hover {
        background-color: var(--default-color);
        border-color: var(--default-color);
        color: white;
        transform: translateY(-3px);
        }

        .brt-footer h4 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--heading-color);
        position: relative;
        padding-bottom: 0.75rem;
        margin-bottom: 1.5rem;
        }

        .brt-footer h4::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: var(--default-color);
        border-radius: 2px;
        }

        .brt-footer-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
        }

        .brt-footer-links ul li {
        padding: 0.5rem 0;
        }

        .brt-footer-links ul a {
        color: var(--text-muted);
        text-decoration: none;
        transition: var(--transition);
        position: relative;
        display: inline-block;
        }

        .brt-footer-links ul a:hover {
        color: var(--default-color);
        padding-left: 0.5rem;
        }

        .brt-footer-contact p {
        margin-bottom: 0.5rem;
        color: var(--text-muted);
        }

        .brt-footer-contact strong {
        color: var(--heading-color);
        }

        .brt-footer-copyright {
        background-color: var(--surface-color);
        padding: 1.5rem 0;
        margin-top: 2rem;
        font-size: 0.9rem;
        color: var(--text-muted);
        border-top: 1px solid var(--surface-border);
        }

        .brt-footer-credits {
        margin-top: 0.5rem;
        font-size: 0.85rem;
        }

        .brt-footer-credits a {
        color: var(--default-color);
        text-decoration: underline;
        }

        .brt-footer-credits a:hover {
        color: var(--default-hover);
        }

        img.brt-footer-logo {
        width: 200px;
        }

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
        .brt-footer h4::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .brt-footer-contact {
            text-align: center !important;
            margin-top: 2rem;
        }
        }
    </style>      
    <!--==================== Footer Component ====================-->
    <footer class="brt-footer mt-auto">
        <div class="container brt-footer-top">
            <div class="row gy-5">
                <!-- About / Logo Column -->
                <div class="col-lg-5 col-md-12 brt-footer-about">
                    <a href="<?= base_url() ?>" class="brt-logo-footer">
                        <img 
                            src="<?= getImageUrl(getConfigData('SiteLogoLink') ?? getDefaultImagePath()) ?>" 
                            alt="<?= getConfigData('SiteName') ?? 'Site Logo' ?>"
                            class="brt-footer-logo"
                        />
                    </a>
                    <p><?= getConfigData('SiteDescription') ?? 'Your trusted partner for comprehensive IT solutions and services. Empowering businesses through technology since 2010.' ?></p>
                    <div class="brt-footer-social">
                        <?php 
                        // Social media links - you may want to add these to your CMS config
                        $socialLinks = [
                            'twitter' => getConfigData('SocialTwitter') ?? '#',
                            'facebook' => getConfigData('SocialFacebook') ?? '#',
                            'instagram' => getConfigData('SocialInstagram') ?? '#',
                            'linkedin' => getConfigData('SocialLinkedin') ?? '#'
                        ];
                        ?>
                        <?php if ($socialLinks['twitter'] !== '#'): ?>
                        <a href="<?= $socialLinks['twitter'] ?>" target="_blank" aria-label="Twitter">
                            <i class="ri-twitter-x-fill"></i>
                        </a>
                        <?php endif; ?>
                        <?php if ($socialLinks['facebook'] !== '#'): ?>
                        <a href="<?= $socialLinks['facebook'] ?>" target="_blank" aria-label="Facebook">
                            <i class="ri-facebook-fill"></i>
                        </a>
                        <?php endif; ?>
                        <?php if ($socialLinks['instagram'] !== '#'): ?>
                        <a href="<?= $socialLinks['instagram'] ?>" target="_blank" aria-label="Instagram">
                            <i class="ri-instagram-fill"></i>
                        </a>
                        <?php endif; ?>
                        <?php if ($socialLinks['linkedin'] !== '#'): ?>
                        <a href="<?= $socialLinks['linkedin'] ?>" target="_blank" aria-label="LinkedIn">
                            <i class="ri-linkedin-fill"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Useful Links (Quick Links) -->
                <div class="col-lg-2 col-6 brt-footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <?php if ($footerNavLists): ?>
                            <?php 
                            // Filter only top-level navigation items (no parent)
                            $quickLinks = array_filter($footerNavLists, function($nav) {
                                return empty($nav['parent']);
                            });
                            // Limit to 5 items
                            $quickLinks = array_slice($quickLinks, 0, 5);
                            ?>
                            <?php foreach ($quickLinks as $navigation): ?>
                                <li>
                                    <a href="<?= getLinkUrl($navigation['link']) ?>" target="<?= $navigation['new_tab'] === "1" ? "_blank" : "_self" ?>">
                                        <?= $navigation['title'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Default quick links if no navigation exists -->
                            <li><a href="<?= base_url('/') ?>">Home</a></li>
                            <li><a href="<?= base_url('#about') ?>">About Us</a></li>
                            <li><a href="<?= base_url('#services') ?>">Our Services</a></li>
                            <li><a href="<?= base_url('#portfolio') ?>">Portfolio</a></li>
                            <li><a href="<?= base_url('blogs') ?>">Blog</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                
                <!-- Our Services -->
                <div class="col-lg-2 col-6 brt-footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <?php if ($servicesNavLists): ?>
                            <?php 
                            // Filter only top-level service items
                            $serviceLinks = array_filter($servicesNavLists, function($nav) {
                                return empty($nav['parent']);
                            });
                            // Limit to 5 items
                            $serviceLinks = array_slice($serviceLinks, 0, 5);
                            ?>
                            <?php foreach ($serviceLinks as $navigation): ?>
                                <li>
                                    <a href="<?= getLinkUrl($navigation['link']) ?>" target="<?= $navigation['new_tab'] === "1" ? "_blank" : "_self" ?>">
                                        <?= $navigation['title'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Default services if no navigation exists -->
                            <li><a href="<?= base_url('#services') ?>">Web Design</a></li>
                            <li><a href="<?= base_url('#services') ?>">WordPress Development</a></li>
                            <li><a href="<?= base_url('#services') ?>">SEO Optimization</a></li>
                            <li><a href="<?= base_url('#services') ?>">E-commerce</a></li>
                            <li><a href="<?= base_url('#services') ?>">AI Automation</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div class="col-lg-3 col-md-12 brt-footer-contact text-center text-md-start">
                    <h4>Get in Touch</h4>
                    <p><?= nl2br(getConfigData('CompanyAddress') ?? '212B, Watford Road,<br />Croxley Green, Hertfordshire') ?></p>
                    <p class="mt-4">
                        <strong>Phone:</strong>
                        <span>
                            <a href="tel:<?= getConfigData('CompanyPhone') ?? '+447895577949' ?>" class="text-decoration-none">
                                <?= getConfigData('CompanyPhone') ?? '+44 7895 577949' ?>
                            </a>
                        </span>
                    </p>
                    <p>
                        <strong>Email:</strong>
                        <span>
                            <a href="mailto:<?= getConfigData('CompanyEmail') ?? 'enquiries@example.com' ?>" class="text-decoration-none">
                                <?= getConfigData('CompanyEmail') ?? 'enquiries@example.com' ?>
                            </a>
                        </span>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="container brt-footer-copyright text-center">
            <p>
                © <?= date('Y') ?> <span>Copyright</span>
                <strong class="px-1"><?= getConfigData('SiteName') ?? 'SiteName' ?></strong>
                <span>All Rights Reserved</span>
            </p>
            <div class="brt-footer-credits">
                Developed with care by
                <a href="https://brighterweb.co.uk/" target="_blank">BrighterWeb</a>
                • Powered by
                <a href="https://ignitercms.com/" target="_blank">Igniter CMS</a>
            </div>
        </div>
    </footer>

    <style>
        /* ==================== Preloader Component CSS  ==================== */
        #brt-preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--background-color);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 999999;
        opacity: 1;
        visibility: visible;
        transition:
            opacity 0.4s,
            visibility 0.4s;
        }

        #brt-preloader.brt-fade-out {
        opacity: 0;
        visibility: hidden;
        }

        .brt-preloader-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid var(--surface-border);
        border-top-color: var(--accent-color);
        border-radius: 50%;
        animation: brt-spin 1s linear infinite;
        }

        @keyframes brt-spin {
        to {
            transform: rotate(360deg);
        }
        }
    </style>
    <!--==================== Preloader Component HTML Element ====================-->
    <div id="brt-preloader">
        <div class="brt-preloader-spinner" aria-hidden="true"></div>
    </div>
    <!--==================== Preloader Component JavaScript ==================== -->
    <script>
        // ==================== Preloader ====================
        (function () {
        const preloader = document.getElementById("brt-preloader");
        if (!preloader) return;
        const hidePreloader = () => {
            preloader.classList.add("brt-fade-out");
            setTimeout(() => {
                if (preloader.parentNode) {
                    preloader.parentNode.removeChild(preloader);
                }
            }, 400);
        };
        if (document.readyState === "complete") {
            hidePreloader();
        } else {
            window.addEventListener("load", hidePreloader);
        }
        })();
    </script>
    <style>
        /* ==================== Scroll to Top Component CSS  ==================== */
        .brt-scroll-top {
        position: fixed;
        visibility: hidden;
        opacity: 0;
        right: 15px;
        bottom: -15px;
        z-index: 99999;
        background-color: var(--default-color);
        width: 44px;
        height: 44px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
        text-decoration: none;
        }

        .brt-scroll-top i {
        font-size: 1.5rem;
        color: var(--surface-color);
        line-height: 0;
        }

        .brt-scroll-top:hover {
        background-color: color-mix(
            in srgb,
            var(--default-color),
            transparent 20%
        );
        }

        .brt-scroll-top.brt-active {
        visibility: visible;
        opacity: 1;
        bottom: 15px;
        }
    </style>
    <!--==================== Scroll to Top Component HTML Element ====================-->
    <a
        href="#"
        id="brt-scroll-top"
        class="brt-scroll-top"
        aria-label="Scroll to top"
    >
        <i class="ri-arrow-up-s-line"></i>
    </a>
    <!--==================== Scroll to Top Component JavaScript ==================== -->
    <script>
        // ==================== Scroll to Top ====================
        (function () {
        const scrollTopBtn = document.getElementById("brt-scroll-top");
        if (!scrollTopBtn) return;
        const handleScroll = () => {
            if (window.scrollY > 100) {
                scrollTopBtn.classList.add("brt-active");
            } else {
                scrollTopBtn.classList.remove("brt-active");
            }
        };
        const scrollToTop = (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        };
        window.addEventListener("scroll", handleScroll);
        scrollTopBtn.addEventListener("click", scrollToTop);
        })();
    </script>
    <!-- Start of OpenWidget (www.openwidget.com) code -->
    <script>
        window.__ow = window.__ow || {};
        window.__ow.organizationId = "c3bd64fb-d0df-4ca7-9d4f-7b1b164ceca9";
        window.__ow.integration_name = "manual_settings";
        window.__ow.product_name = "openwidget";
        (function (n, t, c) {
        function i(n) {
            return e._h ? e._h.apply(null, n) : e._q.push(n);
        }
        var e = {
            _q: [],
            _h: null,
            _v: "2.0",
            on: function () {
                i(["on", c.call(arguments)]);
            },
            once: function () {
                i(["once", c.call(arguments)]);
            },
            off: function () {
                i(["off", c.call(arguments)]);
            },
            get: function () {
                if (!e._h)
                    throw new Error(
                    "[OpenWidget] You can't use getters before load.",
                    );
                return i(["get", c.call(arguments)]);
            },
            call: function () {
                i(["call", c.call(arguments)]);
            },
            init: function () {
                var n = t.createElement("script");
                (n.async = !0),
                    (n.type = "text/javascript"),
                    (n.src = "https://cdn.openwidget.com/openwidget.js"),
                    t.head.appendChild(n);
            },
        };
        !n.__ow.asyncInit && e.init(), (n.OpenWidget = n.OpenWidget || e);
        })(window, document, [].slice);
    </script>
    <noscript
        >You need to
        <a
        href="https://www.openwidget.com/enable-javascript"
        rel="noopener nofollow"
        >enable JavaScript</a
        >
        to use the communication tool powered by
        <a
        href="https://www.openwidget.com/"
        rel="noopener nofollow"
        target="_blank"
        >OpenWidget</a
        >
    </noscript>
    <!-- End of OpenWidget code -->
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe
        src="https://www.googletagmanager.com/ns.html?id=GTM-TFVJXST8"
        height="0"
        width="0"
        style="display: none; visibility: hidden"
        ></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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