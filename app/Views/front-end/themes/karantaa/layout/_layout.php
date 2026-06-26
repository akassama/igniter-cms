<?php
// Get current theme
$theme = getCurrentTheme();
$siteName = getConfigData("SiteName");

// Get theme data
$themeData = [
    "customCSS" => getTableData("codes", ["code_for" => "CSS"], "code"),
    "customJSTop" => getTableData("codes", ["code_for" => "HeaderJS"], "code"),
    "customJSFooter" => getTableData(
        "codes",
        ["code_for" => "FooterJS"],
        "code",
    ),
    "defaultColor" => getThemeData($theme, "default_color"),
    "headingColor" => getThemeData($theme, "heading_color"),
    "accentColor" => getThemeData($theme, "accent_color"),
    "surfaceColor" => getThemeData($theme, "surface_color"),
    "contrastColor" => getThemeData($theme, "contrast_color"),
    "backgroundColor" => getThemeData($theme, "background_color"),
];

// Get navigation model lists
$navigationsModel = new \App\Models\NavigationsModel();
$topNavLists = $navigationsModel
    ->where("group", "top_nav")
    ->orderBy("order", "ASC")
    ->limit(intval(env("QUERY_LIMIT_DEFAULT", 25)))
    ->findAll();
$footerExploreNavLists = $navigationsModel
    ->where("group", "footer_explore")
    ->orderBy("order", "ASC")
    ->limit(intval(env("QUERY_LIMIT_DEFAULT", 25)))
    ->findAll();
$footerWorkNavLists = $navigationsModel
    ->where("group", "footer_work")
    ->orderBy("order", "ASC")
    ->limit(intval(env("QUERY_LIMIT_DEFAULT", 25)))
    ->findAll();
$footerLegalNavLists = $navigationsModel
    ->where("group", "footer_legal")
    ->orderBy("order", "ASC")
    ->limit(intval(env("QUERY_LIMIT_DEFAULT", 25)))
    ->findAll();
$servicesNavLists = $navigationsModel
    ->where("group", "services")
    ->orderBy("order", "ASC")
    ->limit(intval(env("QUERY_LIMIT_DEFAULT", 25)))
    ->findAll();

$currentPageSlug = !empty($page_slug) ? $page_slug : "home";
?>

<?= $this->include("front-end/themes/" . $theme . "/includes/_functions.php") ?>

<?php $adminBar = renderAdminBar(); ?>

<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <!--Load Meta Plugin Helpers-->
        <?= $this->include(
            "front-end/themes/_shared/_load_meta_plugin_helpers.php",
        ) ?>

        <meta charset="UTF-8" />
        <title><?= $title ?? "Home" ?> | <?= $siteName ?></title>
        <meta name="description" content="<?= $meta_description ??
            "Karantaa is a Pan-African research and policy lab producing rigorous, Africa-centred knowledge that informs policy and advances social transformation." ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <?= loadSiteIcons() ?>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Playfair+Display:ital,wght@0,700;1,700&display=swap"
            rel="stylesheet"
        />

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.min.css"
        />

        <!-- Core Theme CSS Variables -->
        <?php
        $overrideStyle = getThemeData($theme, "override_default_style");
        $useStaticThemeNav = getThemeData($theme, "use_static_theme_nav");
        if ($overrideStyle === "1") {

            // Theme color variables
            $defaultColor = $themeData["defaultColor"];
            $headingColor = $themeData["headingColor"];
            $accentColor = $themeData["accentColor"];
            $surfaceColor = $themeData["surfaceColor"];
            $contrastColor = $themeData["contrastColor"];
            $backgroundColor = $themeData["backgroundColor"];
            ?>
                <style>
                    /* ===== Override Root Variables ===== */
                    :root,
                    [data-bs-theme="light"] {
                        --default-color: <?php echo $defaultColor; ?>;
                        --default-hover: #000000;
                        --default-border: <?php echo $defaultColor; ?>;
                        --default-rgb: 18, 18, 18;

                        --heading-color: <?php echo $headingColor; ?>;
                        --heading-muted: #4a4a4a;

                        --accent-color: <?php echo $accentColor; ?>;
                        --accent-hover: #3d3d3d;
                        --accent-border: <?php echo $accentColor; ?>;
                        --accent-rgb: 110, 110, 110;

                        --contrast-color: <?php echo $contrastColor; ?>;
                        --contrast-hover: #f3f2ef;
                        --contrast-border: <?php echo $contrastColor; ?>;

                        --surface-color: <?php echo $surfaceColor; ?>;
                        --surface-secondary: #ecece7;
                        --surface-border: #ddd9d0;
                        --surface-rgb: 246, 245, 241;

                        --background-color: <?php echo $backgroundColor; ?>;
                        --background-secondary: #faf9f6;

                        --ink: #0c0c0c;
                        --ink-soft: #1c1c1c;

                        --text-color: #1c1c1c;
                        --text-muted: #5c5c5c;
                        --text-light: #9a9a9a;

                        --form-bg: var(--background-color);
                        --form-border: #d6d2c8;
                        --form-text: var(--text-color);

                        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
                        --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.08);
                        --shadow-lg: 0 24px 60px rgba(0, 0, 0, 0.12);

                        --radius: 14px;
                        --transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);

                        --bs-primary: var(--default-color);
                        --bs-primary-rgb: var(--default-rgb);
                        --bs-secondary: var(--accent-color);
                        --bs-secondary-rgb: var(--accent-rgb);
                        --bs-body-bg: var(--background-color);
                        --bs-body-color: var(--text-color);
                        --bs-border-color: var(--surface-border);
                        --bs-card-bg: var(--background-color);
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

                    [data-bs-theme="dark"] {
                        --default-color: #ffffff;
                        --default-hover: #d9d9d9;
                        --default-border: #ffffff;
                        --default-rgb: 255, 255, 255;

                        --heading-color: #f5f4f0;
                        --heading-muted: #c8c6c0;

                        --accent-color: #a7a7a7;
                        --accent-hover: #d3d3d3;
                        --accent-border: #a7a7a7;
                        --accent-rgb: 167, 167, 167;

                        --contrast-color: #111111;
                        --contrast-hover: #000000;
                        --contrast-border: #111111;

                        --surface-color: #19191a;
                        --surface-secondary: #222223;
                        --surface-border: #2d2d2e;
                        --surface-rgb: 25, 25, 26;

                        --background-color: #0c0c0d;
                        --background-secondary: #141415;

                        --ink: #000000;
                        --ink-soft: #050505;

                        --text-color: #f1f0ec;
                        --text-muted: #b3b1aa;
                        --text-light: #7d7b75;

                        --form-bg: var(--surface-color);
                        --form-border: #3a3a3b;
                        --form-text: var(--text-color);

                        --bs-body-bg: var(--background-color);
                        --bs-body-color: var(--text-color);
                        --bs-border-color: var(--surface-border);
                        --bs-card-bg: var(--surface-color);
                        --bs-link-color: var(--default-color);
                        --bs-link-hover-color: var(--default-hover);
                        --bs-nav-link-color: var(--text-color);
                        --bs-nav-link-hover-color: var(--default-color);
                        --bs-dropdown-bg: var(--surface-color);
                        --bs-dropdown-link-color: var(--text-color);
                        --bs-dropdown-link-hover-color: var(--default-color);
                        --bs-dropdown-link-hover-bg: var(--surface-secondary);
                    }
                </style>
            <?php
        } else {
             ?>
                    <style>
                        /* ===== Root Variables ===== */
                        :root,
                        [data-bs-theme="light"] {
                            --default-color: #121212;
                            --default-hover: #000000;
                            --default-border: #121212;
                            --default-rgb: 18, 18, 18;

                            --heading-color: #ae6d05;
                            --heading-muted: #4a4a4a;

                            --accent-color: #6e6e6e;
                            --accent-hover: #3d3d3d;
                            --accent-border: #6e6e6e;
                            --accent-rgb: 110, 110, 110;

                            --contrast-color: #ffffff;
                            --contrast-hover: #f3f2ef;
                            --contrast-border: #ffffff;

                            --surface-color: #f6f5f1;
                            --surface-secondary: #ecece7;
                            --surface-border: #ddd9d0;
                            --surface-rgb: 246, 245, 241;

                            --background-color: #ffffff;
                            --background-secondary: #faf9f6;

                            --ink: #0c0c0c;
                            --ink-soft: #1c1c1c;

                            --text-color: #1c1c1c;
                            --text-muted: #5c5c5c;
                            --text-light: #9a9a9a;

                            --form-bg: var(--background-color);
                            --form-border: #d6d2c8;
                            --form-text: var(--text-color);

                            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
                            --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.08);
                            --shadow-lg: 0 24px 60px rgba(0, 0, 0, 0.12);

                            --radius: 14px;
                            --transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);

                            --bs-primary: var(--default-color);
                            --bs-primary-rgb: var(--default-rgb);
                            --bs-secondary: var(--accent-color);
                            --bs-secondary-rgb: var(--accent-rgb);
                            --bs-body-bg: var(--background-color);
                            --bs-body-color: var(--text-color);
                            --bs-border-color: var(--surface-border);
                            --bs-card-bg: var(--background-color);
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

                        [data-bs-theme="dark"] {
                            --default-color: #ffffff;
                            --default-hover: #d9d9d9;
                            --default-border: #ffffff;
                            --default-rgb: 255, 255, 255;

                            --heading-color: #f5f4f0;
                            --heading-muted: #c8c6c0;

                            --accent-color: #a7a7a7;
                            --accent-hover: #d3d3d3;
                            --accent-border: #a7a7a7;
                            --accent-rgb: 167, 167, 167;

                            --contrast-color: #111111;
                            --contrast-hover: #000000;
                            --contrast-border: #111111;

                            --surface-color: #19191a;
                            --surface-secondary: #222223;
                            --surface-border: #2d2d2e;
                            --surface-rgb: 25, 25, 26;

                            --background-color: #0c0c0d;
                            --background-secondary: #141415;

                            --ink: #000000;
                            --ink-soft: #050505;

                            --text-color: #f1f0ec;
                            --text-muted: #b3b1aa;
                            --text-light: #7d7b75;

                            --form-bg: var(--surface-color);
                            --form-border: #3a3a3b;
                            --form-text: var(--text-color);

                            --bs-body-bg: var(--background-color);
                            --bs-body-color: var(--text-color);
                            --bs-border-color: var(--surface-border);
                            --bs-card-bg: var(--surface-color);
                            --bs-link-color: var(--default-color);
                            --bs-link-hover-color: var(--default-hover);
                            --bs-nav-link-color: var(--text-color);
                            --bs-nav-link-hover-color: var(--default-color);
                            --bs-dropdown-bg: var(--surface-color);
                            --bs-dropdown-link-color: var(--text-color);
                            --bs-dropdown-link-hover-color: var(--default-color);
                            --bs-dropdown-link-hover-bg: var(--surface-secondary);
                        }
                    </style>
                <?php
        }
        ?>

        <!-- Core Theme CSS -->
        <link href="<?= base_url(
            "public/front-end/themes/" . $theme . "/assets/css/site.css",
        ) ?>" rel="stylesheet">


        <!-- Custom CSS -->
        <?php if (!empty($themeData["customCSS"])): ?>
            <style><?= $themeData["customCSS"] ?></style>
        <?php endif; ?>

        <!-- Custom JavaScript in the head -->
        <?php if (!empty($themeData["customJSTop"])): ?>
            <?= $themeData["customJSTop"] ?>
        <?php endif; ?>

        <!--Load Header Plugin Helpers-->
        <?= $this->include(
            "front-end/themes/_shared/_load_header_plugin_helpers.php",
        ) ?>
    </head>
    <body>
        <?= $adminBar ?>

        <header class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <a href="<?= base_url() ?>" class="brt-logo">
                    <img
                        src="<?= getImageUrl(
                            getConfigData("SiteTextLogoLink") ??
                                "https://ik.imagekit.io/brighterweb/karantaa/karantaa-kora-logo.jpeg",
                        ) ?>"
                        alt="<?= $siteName ?> logo"
                        width="300"
                        height="300"
                    />
                    <div>
                        <div class="logo-text"><?= $siteName ?><span>.</span></div>
                        <div class="logo-tag">
                            Pan-African Research &amp; Policy Lab
                        </div>
                    </div>
                </a>

                <button
                    class="brt-theme-toggle d-lg-none ms-auto me-2"
                    id="brt-themeToggleMobile"
                    aria-label="Toggle theme"
                >
                    <i class="ri-moon-line" id="brt-themeIconMobile"></i>
                </button>

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

                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul
                        class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center"
                    >
                    <?php if ($useStaticThemeNav === "1"): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPageSlug === "home"
                                ? "active"
                                : "" ?>" href="<?= base_url("") ?>">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPageSlug === "about"
                                ? "active"
                                : "" ?>" href="<?= base_url(
    "about",
) ?>">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle <?= $currentPageSlug ===
                                "services"
                                    ? "active"
                                    : "" ?>"
                                href="<?= base_url("services") ?>"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                >Services</a
                            >
                            <ul class="dropdown-menu">
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= base_url(
                                            "services",
                                        ) ?>#research"
                                        >Karantaa Research</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= base_url(
                                            "services",
                                        ) ?>#advisory"
                                        >Karantaa Advisory</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= base_url(
                                            "services",
                                        ) ?>#commons"
                                        >Karantaa Commons</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= base_url("services") ?>#press"
                                        >Karantaa Press</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="<?= base_url(
                                            "services",
                                        ) ?>#academy"
                                        >Karantaa Academy</a
                                    >
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPageSlug === "team"
                                ? "active"
                                : "" ?>" href="<?= base_url("team") ?>">Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPageSlug ===
                            "contact"
                                ? "active"
                                : "" ?>" href="<?= base_url(
    "contact",
) ?>">Contact</a>
                        </li>
                    <?php else: ?>
                        <?php if ($topNavLists): ?>
                            <?php foreach ($topNavLists as $navigation): ?>
                                <?= themef_renderNavigation(
                                    $navigation,
                                    $navigationsModel,
                                ) ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>



                        <li class="nav-item ms-lg-2">
                            <a href="<?= getLinkUrl(
                                "contact",
                            ) ?>" class="btn btn-ink"
                                >Get in touch</a
                            >
                        </li>
                        <li
                            class="nav-item d-none d-lg-flex align-items-center ms-2"
                        >
                            <button
                                class="brt-theme-toggle"
                                id="brt-themeToggle"
                                aria-label="Toggle theme"
                            >
                                <i class="ri-moon-line" id="brt-themeIcon"></i>
                            </button>
                        </li>
                        <li class="nav-item d-lg-none mt-3">
                            <button
                                class="brt-theme-toggle w-100"
                                id="brt-themeToggleMenu"
                                aria-label="Toggle theme"
                                style="border-radius: 8px"
                            >
                                <i
                                    class="ri-moon-line"
                                    id="brt-themeIconMenu"
                                ></i
                                >&nbsp; Toggle theme
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <main>
            <?= $this->renderSection("content") ?>
        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 f-col">
                        <h5><?= $siteName ?>.</h5>
                        <p class="f-tagline">
                            A Pan-African research and policy lab producing
                            rigorous, independent, Africa-centred knowledge.
                        </p>
                        <div class="d-flex gap-3 fs-5">
                            <a href="https://www.linkedin.com/company/karantaa/" aria-label="LinkedIn"
                                ><i class="ri-linkedin-box-line"></i
                            ></a>
                            <a href="https://www.facebook.com/share/18qqv7jQ6t" aria-label="X / Twitter"
                                ><i class="ri-facebook-line"></i
                            ></a>
                            <a href="https://www.instagram.com/karantaa.26" aria-label="Instagram"
                                ><i class="ri-instagram-line"></i
                            ></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6 f-col">
                        <h5 style="font-size: 1rem">Explore</h5>
                        <ul class="list-unstyled d-flex flex-column gap-2">
                            <?php if ($footerExploreNavLists): ?>
                                <?php foreach (
                                    $footerExploreNavLists
                                    as $navigation
                                ): ?>
                                    <li><a href="<?= getLinkUrl(
                                        $navigation["link"],
                                    ) ?>"><?= $navigation["title"] ?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 f-col">
                        <h5 style="font-size: 1rem">Our Work</h5>
                        <ul class="list-unstyled d-flex flex-column gap-2">
                            <?php if ($footerWorkNavLists): ?>
                                <?php foreach (
                                    $footerWorkNavLists
                                    as $navigation
                                ): ?>
                                    <li><a href="<?= getLinkUrl(
                                        $navigation["link"],
                                    ) ?>"><?= $navigation["title"] ?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-lg-4 f-col">
                        <h5 style="font-size: 1rem">Contact</h5>
                        <ul class="list-unstyled d-flex flex-column gap-2">
                            <li>
                                <a href="mailto:<?= getConfigData("Email") ??
                                    "contact@karantaa.com" ?>"
                                    ><i class="ri-mail-line me-2"></i
                                    ><?= getConfigData("Email") ??
                                        "contact@karantaa.com" ?></a
                                >
                            </li>
                            <li>
                                <a href="tel:+447495846372"
                                    ><i class="ri-phone-line me-2"></i>+44 495 846372</a
                                >
                            </li>
                            <li>
                                <a href="tel:+447394355897"
                                    ><i class="ri-phone-line me-2"></i>+44 394 355897</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="f-bottom">
                    <p class="mb-0">
                        &copy; <?= date(
                            "Y",
                        ) ?> <?= $siteName ?> &mdash; Pan-African Research and
                        Policy Lab. All rights reserved.
                    </p>
                    <div class="f-bottom-links">
                        <?php if ($footerLegalNavLists): ?>
                            <?php foreach (
                                $footerLegalNavLists
                                as $navigation
                            ): ?>
                                <a href="<?= getLinkUrl(
                                    $navigation["link"],
                                ) ?>"><?= $navigation["title"] ?></a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
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


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Core theme JS -->
        <script defer src="<?= base_url(
            "public/front-end/themes/" . $theme . "/assets/js/site.js",
        ) ?>"></script>

        <!-- Custom JavaScript in the footer -->
        <?php if (!empty($themeData["customJSFooter"])): ?>
            <?= $themeData["customJSFooter"] ?>
        <?php endif; ?>

        <!-- SweetAlert JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
        <?= $this->include("front-end/layout/assets/sweet_alerts.php") ?>

        <!--Load Footer Plugin Helpers-->
        <?= $this->include(
            "front-end/themes/_shared/_load_footer_plugin_helpers.php",
        ) ?>
    </body>
</html>
