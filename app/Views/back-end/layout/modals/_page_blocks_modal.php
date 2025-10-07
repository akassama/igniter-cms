<style>
    /* General Block Styling (to avoid conflicts, all custom styles will be prefixed) */
    .block-container-display {
    position: relative;
    border: 1px solid #eee;
    padding: 15px;
    margin-bottom: 20px;
    background-color: #fff;
    border-radius: 5px;
    min-height: 150px;
    overflow: hidden; /* Ensure iframes don't overflow */
    }
    .block-container-display.is-iframe {
    padding: 0 !important; /* Remove padding for iframe blocks */
    border: none;
    }
    .block-container-display.is-iframe .block-copy-button {
    display: none; /* Hide copy button for iframes */
    }

    .block-copy-button {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid #ccc;
    padding: 5px 8px;
    font-size: 1.1em;
    cursor: pointer;
    color: #666;
    border-radius: 5px;
    z-index: 10; /* Ensure button is above iframe if present */
    transition: all 0.2s ease;
    }

    .block-copy-button:hover {
    background: #f0f0f0;
    color: #000;
    border-color: #999;
    }

    /* Sidebar Navigation */
    .block-sidebar {
    width: 250px;
    flex-shrink: 0;
    border-right: 1px solid #eee;
    padding-right: 15px;
    overflow-y: auto; /* Enable scrolling for the sidebar */
    }

    .block-sidebar h6 {
    margin-top: 20px;
    margin-bottom: 10px;
    color: #333;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 8px;
    padding-left: 5px; /* Align with list items */
    }

    .block-sidebar h6 .bi {
    font-size: 1.1em;
    color: #0d6efd;
    }

    .block-sidebar ul {
    list-style: none;
    padding: 0;
    margin-bottom: 10px; /* Space between categories */
    }

    .block-sidebar ul li {
    margin-bottom: 3px;
    }

    .block-sidebar ul li a {
    display: block;
    padding: 8px 10px;
    text-decoration: none;
    color: #555;
    border-radius: 3px;
    transition: background-color 0.2s;
    font-size: 0.95em;
    }

    .block-sidebar ul li a:hover,
    .block-sidebar ul li a.active-block {
    background-color: #e9ecef; /* Light gray for active/hover */
    color: #000;
    }

    /* Specific Block Styles */
    /* Base styles for column blocks */
    .block-column-wrapper {
    display: flex;
    gap: 15px;
    flex-wrap: wrap; /* Allow wrapping on smaller screens */
    padding: 20px;
    background-color: #f8f8f8;
    border: 1px solid #ddd;
    border-radius: 5px;
    }
    .block-column-item {
    padding: 15px;
    background-color: #fff;
    border: 1px dashed #ccc;
    border-radius: 3px;
    text-align: center;
    flex-grow: 1; /* Allow items to grow by default */
    min-width: 150px; /* Sensible default min-width */
    }

    /* Specific column configurations - using media queries for responsiveness */
    /* Note: Default `flex: 1` on items ensures stacking on small screens */

    .block-two-col-content-1-7 .block-column-item {
    flex: 1; /* Default for mobile */
    }
    @media (min-width: 768px) {
    .block-two-col-content-1-7 .block-column-item:first-child {
        flex-basis: calc(100% / 7 * 1 - 15px);
        max-width: calc(100% / 7 * 1 - 15px);
        flex-grow: 0;
    }
    .block-two-col-content-1-7 .block-column-item:last-child {
        flex-basis: calc(100% / 7 * 6 - 15px);
        max-width: calc(100% / 7 * 6 - 15px);
        flex-grow: 0;
    }
    }

    .block-two-col-content-2-6 .block-column-item {
    flex: 1; /* Default for mobile */
    }
    @media (min-width: 768px) {
    .block-two-col-content-2-6 .block-column-item:first-child {
        flex-basis: calc(100% / 6 * 2 - 15px);
        max-width: calc(100% / 6 * 2 - 15px);
        flex-grow: 0;
    }
    .block-two-col-content-2-6 .block-column-item:last-child {
        flex-basis: calc(100% / 6 * 4 - 15px);
        max-width: calc(100% / 6 * 4 - 15px);
        flex-grow: 0;
    }
    }

    .block-three-col-content-4-2-2 .block-column-item {
    flex: 1; /* Default for mobile */
    }
    @media (min-width: 768px) {
    .block-three-col-content-4-2-2 .block-column-item:nth-child(1) {
        flex-basis: calc(100% / 8 * 4 - 15px);
        max-width: calc(100% / 8 * 4 - 15px);
        flex-grow: 0;
    }
    .block-three-col-content-4-2-2 .block-column-item:nth-child(2),
    .block-three-col-content-4-2-2 .block-column-item:nth-child(3) {
        flex-basis: calc(100% / 8 * 2 - 15px);
        max-width: calc(100% / 8 * 2 - 15px);
        flex-grow: 0;
    }
    }

    .block-four-columns-content .block-column-item {
    flex: 1; /* Default for mobile */
    min-width: 120px; /* Allow more columns to fit side-by-side on small-ish screens */
    }
    @media (min-width: 576px) {
    .block-four-columns-content .block-column-item {
        flex-basis: calc(25% - 11.25px); /* approx 1/4 - gap */
        max-width: calc(25% - 11.25px);
        flex-grow: 0;
    }
    }

    /* Navbar specific styles */
    .block-navbar-content {
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
    margin-bottom: 15px;
    }
    .block-navbar-content nav {
    margin-bottom: 0 !important;
    }
    .block-navbar-content .navbar-brand {
    font-weight: bold;
    }
    .block-navbar-content .navbar-nav .nav-link {
    color: rgba(0, 0, 0, 0.55);
    }
    .block-navbar-content .navbar-nav .nav-link.active {
    color: rgba(0, 0, 0, 0.7);
    font-weight: 500;
    }
    .block-navbar-content .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    /* Iframe specific styles for icon sites */
    .block-iframe-container {
    height: 100%; /* Take full height of parent */
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #f0f0f0;
    border-radius: 5px;
    overflow: hidden;
    }

    .block-iframe-container iframe {
    width: 100%;
    height: 100%;
    border: none;
    background-color: white;
    }
    .block-iframe-loading {
    color: #666;
    font-style: italic;
    margin-bottom: 10px;
    }

    /* Sections specific styling (generic styles, specific block styles will be inline/more detailed) */
    .block-section-preview {
    padding: 30px;
    margin-bottom: 20px;
    border: 1px solid #eee;
    border-radius: 8px;
    background-color: #fdfdfd;
    text-align: center;
    }
    .block-section-preview h2 {
    font-size: 2.2em;
    margin-bottom: 20px;
    color: #343a40;
    }
    .block-section-preview p {
    font-size: 1.1em;
    line-height: 1.6;
    color: #6c757d;
    }
    .block-section-preview .btn {
    margin-top: 20px;
    padding: 10px 25px;
    font-size: 1.05em;
    }
    .block-section-preview .img-fluid {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    }
    .block-section-preview .feature-icon {
    font-size: 3em;
    color: #0d6efd;
    margin-bottom: 15px;
    }
    .block-section-preview .feature-item {
    margin-bottom: 20px;
    }
    .block-section-preview .avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
    border: 2px solid #ddd;
    }
    .block-section-preview .stat-number {
    font-size: 3em;
    font-weight: bold;
    color: #0d6efd;
    }
    .block-section-preview .stat-label {
    font-size: 1.2em;
    color: #6c757d;
    }
    .block-section-preview .faq-item {
    text-align: left;
    margin-bottom: 15px;
    }
    .block-section-preview .faq-item h5 {
    color: #343a40;
    font-weight: 600;
    margin-bottom: 5px;
    }
    .block-section-preview .faq-item p {
    font-size: 1em;
    color: #6c757d;
    }
    .block-section-preview .price-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 20px;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    .block-section-preview .price-card h3 {
    color: #0d6efd;
    margin-bottom: 15px;
    }
    .block-section-preview .price-card .price {
    font-size: 2.5em;
    font-weight: bold;
    margin-bottom: 10px;
    }
    .block-section-preview .price-card .price span {
    font-size: 0.6em;
    font-weight: normal;
    color: #6c757d;
    }
    .block-section-preview .price-card ul {
    list-style: none;
    padding: 0;
    text-align: center;
    margin-bottom: 20px;
    }
    .block-section-preview .price-card ul li {
    margin-bottom: 10px;
    color: #555;
    }
    .block-section-preview .price-card ul li i {
    margin-right: 8px;
    color: #28a745;
    }
</style>

<!-- Blocks Modal -->
<div class="modal fade" id="blocksModal">
    <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
        <h4 class="modal-title">Blocks</h4>
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
        ></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body d-flex">
        <!-- Sidebar for block categories/names -->
        <div class="block-sidebar">
            <h6><i class="bi bi-grid"></i>Layout</h6>
            <ul>
            <li>
                <a href="#" data-block-id="block-one-column">1 Column</a>
            </li>
            <li>
                <a href="#" data-block-id="block-two-columns"
                >2 Columns (1/1)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="block-two-columns-1-7"
                >2 Columns (1/7)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="block-two-columns-2-6"
                >2 Columns (2/6)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="block-three-columns"
                >3 Columns (1/1/1)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="block-three-columns-4-2-2"
                >3 Columns (4/2/2)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="block-four-columns"
                >4 Columns (1/1/1/1)</a
                >
            </li>
            </ul>

            <h6><i class="bi bi-text-paragraph"></i>Content</h6>
            <ul>
            <li><a href="#" data-block-id="block-heading">Heading</a></li>
            <li><a href="#" data-block-id="block-text">Text</a></li>
            <li><a href="#" data-block-id="block-image">Image</a></li>
            <li><a href="#" data-block-id="block-video">Video</a></li>
            <li><a href="#" data-block-id="block-link">Link</a></li>
            </ul>

            <h6><i class="bi bi-ui-checks"></i>Forms & Inputs</h6>
            <ul>
            <li><a href="#" data-block-id="block-form">Contact Form</a></li>
            <li><a href="#" data-block-id="block-input">Input Field</a></li>
            <li>
                <a href="#" data-block-id="block-textarea">Textarea Field</a>
            </li>
            <li><a href="#" data-block-id="block-button">Button</a></li>
            <li><a href="#" data-block-id="block-checkbox">Checkbox</a></li>
            <li>
                <a href="#" data-block-id="block-radio">Radio Buttons</a>
            </li>
            <li>
                <a href="#" data-block-id="block-select">Select Dropdown</a>
            </li>
            </ul>

            <h6><i class="bi bi-code-square"></i>Components</h6>
            <ul>
            <li>
                <a href="#" data-block-id="block-navbar-simple"
                >Simple Navbar</a
                >
            </li>
            <li>
                <a href="#" data-block-id="block-navbar-dropdown"
                >Navbar w/ Dropdown</a
                >
            </li>
            <li>
                <a href="#" data-block-id="block-navbar-dark">Dark Navbar</a>
            </li>
            </ul>

            <h6><i class="bi bi-file-earmark-richtext"></i>Sections</h6>
            <ul>
            <li>
                <a href="#" data-block-id="section-hero-1"
                >Hero Section 1 (Minimal)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-hero-2"
                >Hero Section 2 (Image)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-hero-3"
                >Hero Section 3 (Video BG)</a
                >
            </li>

            <li>
                <a href="#" data-block-id="section-about-1"
                >About Section 1 (Text & Image)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-about-2"
                >About Section 2 (Centered)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-about-3"
                >About Section 3 (Features)</a
                >
            </li>

            <li>
                <a href="#" data-block-id="section-categories-1"
                >Categories 1 (Icon Grid)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-categories-2"
                >Categories 2 (Cards)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-categories-3"
                >Categories 3 (List)</a
                >
            </li>

            <li>
                <a href="#" data-block-id="section-clients-1"
                >Clients 1 (Simple Logos)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-clients-2"
                >Clients 2 (Section Title)</a
                >
            </li>

            <li>
                <a href="#" data-block-id="section-cta-1"
                >Call To Action 1 (Simple)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-cta-2"
                >Call To Action 2 (Image BG)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-cta-3"
                >Call To Action 3 (Two Buttons)</a
                >
            </li>

            <li>
                <a href="#" data-block-id="section-portfolios-1"
                >Portfolios 1 (Grid)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-portfolios-2"
                >Portfolios 2 (Cards)</a
                >
            </li>

            <li>
                <a href="#" data-block-id="section-services-1"
                >Services 1 (Icon Blocks)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-services-2"
                >Services 2 (Image Cards)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-services-3"
                >Services 3 (List)</a
                >
            </li>

            <li>
                <a href="#" data-block-id="section-subscribe-1"
                >Subscribe 1 (Basic)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-subscribe-2"
                >Subscribe 2 (Image Background)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-subscribe-3"
                >Subscribe 3 (Dark)</a
                >
            </li>

            <li>
                <a href="#" data-block-id="section-teams-1"
                >Teams 1 (Cards)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-teams-2"
                >Teams 2 (Grid with Social)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-teams-3"
                >Teams 3 (Simple List)</a
                >
            </li>

            <li>
                <a href="#" data-block-id="section-testimonials-1"
                >Testimonials 1 (Grid)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-testimonials-2"
                >Testimonials 2 (Quote)</a
                >
            </li>

            <li>
                <a href="#" data-block-id="section-stats-1"
                >Stats 1 (Basic Numbers)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-stats-2"
                >Stats 2 (With Icons)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-stats-3"
                >Stats 3 (Isometric Images)</a
                >
            </li>

            <li>
                <a href="#" data-block-id="section-faq-1"
                >FAQ 1 (Simple List)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-faq-2"
                >FAQ 2 (Accordion)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-faq-3"
                >FAQ 3 (Two Columns)</a
                >
            </li>

            <li>
                <a href="#" data-block-id="section-pricing-1"
                >Pricing 1 (Cards)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-pricing-2"
                >Pricing 2 (Simple Table)</a
                >
            </li>
            <li>
                <a href="#" data-block-id="section-pricing-3"
                >Pricing 3 (Advanced)</a
                >
            </li>
            </ul>

            <h6><i class="bi bi-collection-fill"></i>Icons Libraries</h6>
            <ul>
            <li>
                <a href="#" data-block-id="block-icons-bootstrap"
                >Bootstrap Icons</a
                >
            </li>
            <li>
                <a href="#" data-block-id="block-icons-remix">Remix Icons</a>
            </li>
            <li>
                <a href="#" data-block-id="block-icons-hero">Hero Icons</a>
            </li>
            <li>
                <a href="#" data-block-id="block-icons-feather"
                >Feather Icons</a
                >
            </li>
            <li>
                <a href="#" data-block-id="block-icons-lucide"
                >Lucide Icons</a
                >
            </li>
            </ul>

            <h6><i class="bi bi-geo-alt-fill"></i>Embeds</h6>
            <ul>
            <li><a href="#" data-block-id="block-map">Map</a></li>
            </ul>
        </div>

        <!-- Main display area for the selected block -->
        <div class="flex-grow-1 p-3" id="block-display-area">
            <p class="text-muted">
            Select a block from the left sidebar to view its content.
            </p>
        </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        <button
            type="button"
            class="btn btn-danger"
            data-bs-dismiss="modal"
        >
            Close
        </button>
        </div>
    </div>
    </div>
</div>

<script>
    // BLOCK DEFINITIONS
    const blocks = {
    // Layout Blocks
    "block-one-column": {
        html: `
        <style>
            .block-one-column-content {
            padding: 20px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 5px;
            }
        </style>
        <section class="block-one-column-content" id="block-one-column-example">
            <h3>Single Column Layout</h3>
            <p>This is a single column block. It's great for showcasing full-width content like hero sections or large text blocks.</p>
            <p>You can place any content here, such as text, images, or even other components.</p>
        </section>
        `,
    },
    "block-two-columns": {
        html: `
        <style>
            .block-two-columns-content {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            padding: 20px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 5px;
            }
            .block-two-columns-content > div {
            flex: 1; /* Each column takes equal space */
            min-width: 250px;
            padding: 15px;
            background-color: #fff;
            border: 1px dashed #ccc;
            border-radius: 3px;
            text-align: center;
            }
        </style>
        <section class="block-two-columns-content" id="block-two-columns-example">
            <div>
            <h4>Column 1</h4>
            <p>Content for column 1.</p>
            </div>
            <div>
            <h4>Column 2</h4>
            <p>Content for column 2.</p>
            </div>
        </section>
        `,
    },
    "block-two-columns-1-7": {
        html: `
        <style>
            .block-two-col-content-1-7 {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            padding: 20px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 5px;
            }
            .block-two-col-content-1-7 .block-column-item {
            padding: 15px;
            background-color: #fff;
            border: 1px dashed #ccc;
            border-radius: 3px;
            text-align: center;
            flex: 1; /* Default for mobile */
            min-width: 120px;
            }
            @media (min-width: 768px) {
            .block-two-col-content-1-7 .block-column-item:first-child {
                flex-basis: calc(100% / 7 * 1 - 15px);
                max-width: calc(100% / 7 * 1 - 15px);
                flex-grow: 0;
            }
            .block-two-col-content-1-7 .block-column-item:last-child {
                flex-basis: calc(100% / 7 * 6 - 15px);
                max-width: calc(100% / 7 * 6 - 15px);
                flex-grow: 0;
            }
            }
        </style>
        <section class="block-two-col-content-1-7" id="block-two-columns-1-7-example">
            <div class="block-column-item">
            <h5>1/7 Column</h5>
            <p>Narrow section.</p>
            </div>
            <div class="block-column-item">
            <h5>6/7 Column</h5>
            <p>Wider content area.</p>
            </div>
        </section>
        `,
    },
    "block-two-columns-2-6": {
        html: `
        <style>
            .block-two-col-content-2-6 {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            padding: 20px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 5px;
            }
            .block-two-col-content-2-6 .block-column-item {
            padding: 15px;
            background-color: #fff;
            border: 1px dashed #ccc;
            border-radius: 3px;
            text-align: center;
            flex: 1; /* Default for mobile */
            min-width: 180px;
            }
            @media (min-width: 768px) {
            .block-two-col-content-2-6 .block-column-item:first-child {
                flex-basis: calc(100% / 6 * 2 - 15px);
                max-width: calc(100% / 6 * 2 - 15px);
                flex-grow: 0;
            }
            .block-two-col-content-2-6 .block-column-item:last-child {
                flex-basis: calc(100% / 6 * 4 - 15px);
                max-width: calc(100% / 6 * 4 - 15px);
                flex-grow: 0;
            }
            }
        </style>
        <section class="block-two-col-content-2-6" id="block-two-columns-2-6-example">
            <div class="block-column-item">
            <h5>2/6 Column</h5>
            <p>Sidebar or secondary content.</p>
            </div>
            <div class="block-column-item">
            <h5>4/6 Column</h5>
            <p>Main content area.</p>
            </div>
        </section>
        `,
    },
    "block-three-columns": {
        html: `
        <style>
            .block-three-columns-content {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            padding: 20px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 5px;
            }
            .block-three-columns-content > div {
            flex: 1;
            min-width: 200px;
            padding: 15px;
            background-color: #fff;
            border: 1px dashed #ccc;
            border-radius: 3px;
            text-align: center;
            }
        </style>
        <section class="block-three-columns-content" id="block-three-columns-example">
            <div><h6>Column A</h6><p>Content for A.</p></div>
            <div><h6>Column B</h6><p>Content for B.</p></div>
            <div><h6>Column C</h6><p>Content for C.</p></div>
        </section>
        `,
    },
    "block-three-columns-4-2-2": {
        html: `
        <style>
            .block-three-col-content-4-2-2 {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            padding: 20px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 5px;
            }
            .block-three-col-content-4-2-2 .block-column-item {
            padding: 15px;
            background-color: #fff;
            border: 1px dashed #ccc;
            border-radius: 3px;
            text-align: center;
            flex: 1; /* Default for mobile */
            min-width: 150px;
            }
            @media (min-width: 768px) {
            .block-three-col-content-4-2-2 .block-column-item:nth-child(1) {
                flex-basis: calc(100% / 8 * 4 - 15px);
                max-width: calc(100% / 8 * 4 - 15px);
                flex-grow: 0;
            }
            .block-three-col-content-4-2-2 .block-column-item:nth-child(2),
            .block-three-col-content-4-2-2 .block-column-item:nth-child(3) {
                flex-basis: calc(100% / 8 * 2 - 15px);
                max-width: calc(100% / 8 * 2 - 15px);
                flex-grow: 0;
            }
            }
        </style>
        <section class="block-three-col-content-4-2-2" id="block-three-columns-4-2-2-example">
            <div class="block-column-item">
            <h5>4/8 Column</h5>
            <p>Main content area.</p>
            </div>
            <div class="block-column-item">
            <h5>2/8 Column</h5>
            <p>Side detail.</p>
            </div>
            <div class="block-column-item">
            <h5>2/8 Column</h5>
            <p>Another side detail.</p>
            </div>
        </section>
        `,
    },
    "block-four-columns": {
        html: `
        <style>
            .block-four-columns-content {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            padding: 20px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 5px;
            }
            .block-four-columns-content > div {
            flex: 1;
            min-width: 150px;
            padding: 12px;
            background-color: #fff;
            border: 1px dashed #ccc;
            border-radius: 3px;
            text-align: center;
            }
            @media (min-width: 576px) {
            .block-four-columns-content > div {
                flex-basis: calc(25% - 11.25px); /* approx 1/4 - gap */
                max-width: calc(25% - 11.25px);
                flex-grow: 0;
            }
            }
        </style>
        <section class="block-four-columns-content" id="block-four-columns-example">
            <div><h6>Col 1</h6><p>Item 1.</p></div>
            <div><h6>Col 2</h6><p>Item 2.</p></div>
            <div><h6>Col 3</h6><p>Item 3.</p></div>
            <div><h6>Col 4</h6><p>Item 4.</p></div>
        </section>
        `,
    },

    // Content Blocks
    "block-heading": {
        html: `
        <style>
            .block-heading-content {
            text-align: center;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fdfdfd;
            border: 1px solid #eee;
            border-radius: 5px;
            }
            .block-heading-content h1 {
            font-family: 'Georgia', serif;
            color: #2c3e50;
            font-size: 2.8em;
            margin: 0;
            padding: 10px 0;
            border-bottom: 2px solid #a8dadc;
            display: inline-block;
            line-height: 1.2;
            }
            .block-heading-content p {
            margin-top: 15px;
            font-size: 1.1em;
            color: #555;
            }
        </style>
        <section class="block-heading-content" id="block-heading-example">
            <h1>Page Title Here</h1>
            <p>A compelling subtitle to introduce your content.</p>
        </section>
        `,
    },
    "block-text": {
        html: `
        <style>
            .block-text-content {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #444;
            background-color: #fdfdfd;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #eee;
            }
            .block-text-content p:last-child {
            margin-bottom: 0;
            }
        </style>
        <section class="block-text-content" id="block-text-example">
            <p>This is a standard text block. It's ideal for paragraphs, articles, and any substantial textual content on your page.</p>
            <p>You can use it to explain concepts, tell a story, or provide detailed information to your visitors. The styling ensures good readability.</p>
        </section>
        `,
    },
    "block-image": {
        html: `
        <style>
            .block-image-content {
            text-align: center;
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            }
            .block-image-content img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            border: 1px solid #eee;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }
            .block-image-content p {
            margin-top: 10px;
            font-size: 0.9em;
            color: #666;
            }
        </style>
        <section class="block-image-content" id="block-image-example">
            <img src="https://placehold.co/600x400/add8e6/ffffff?text=Your+Image" alt="Placeholder Image">
            <p>A beautiful placeholder image from Placehold.co.</p>
        </section>
        `,
    },
    "block-video": {
        html: `
        <style>
            .block-video-content {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            background-color: #000;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            }
            .block-video-content video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensure video covers area */
            }
            .block-video-caption {
            margin-top: 10px;
            text-align: center;
            font-size: 0.9em;
            color: #555;
            }
        </style>
        <section class="block-video-content" id="block-video-example">
            <video controls loop muted playsinline>
            <source src="https://assets.aktools.net/image-stocks/videos/video-1.mp4" type="video/mp4">
            Your browser does not support the video tag.
            </video>
            <p class="block-video-caption">A sample video from aktools.net.</p>
        </section>
        `,
    },
    "block-link": {
        html: `
        <style>
            .block-link-content {
            text-align: center;
            padding: 20px;
            background-color: #fdfdfd;
            border-radius: 5px;
            border: 1px solid #eee;
            }
            .block-link-content p {
            margin-bottom: 15px;
            color: #444;
            }
            .block-link-content a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2em;
            padding: 10px 20px;
            border: 2px solid #0d6efd;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .block-link-content a:hover {
            background-color: #0d6efd;
            color: white;
            text-decoration: none;
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            }
        </style>
        <section class="block-link-content" id="block-link-example">
            <p>Explore more content on our external site:</p>
            <a href="https://example.com" target="_blank" rel="noopener noreferrer">Visit Example.com</a>
        </section>
        `,
    },

    // Forms & Inputs Blocks
    "block-form": {
        html: `
        <style>
            .block-form-content {
            padding: 25px;
            background-color: #f8f8f8;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            max-width: 500px;
            margin: auto;
            }
            .block-form-content h4 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-weight: 600;
            }
            .block-form-content .form-group {
            margin-bottom: 15px;
            }
            .block-form-content label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
            font-size: 0.95em;
            }
            .block-form-content input[type="text"],
            .block-form-content input[type="email"],
            .block-form-content textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1em;
            }
            .block-form-content textarea {
            min-height: 100px;
            resize: vertical;
            }
            .block-form-content button[type="submit"] {
            background-color: #0d6efd;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 20px;
            }
            .block-form-content button[type="submit"]:hover {
            background-color: #0b5ed7;
            }
        </style>
        <section class="block-form-content" id="block-form-example">
            <h4>Contact Us</h4>
            <form action="#" method="POST">
            <div class="form-group">
                <label for="block-form-name">Name:</label>
                <input type="text" id="block-form-name" name="name" required>
            </div>

            <div class="form-group">
                <label for="block-form-email">Email:</label>
                <input type="email" id="block-form-email" name="email" required>
            </div>

            <div class="form-group">
                <label for="block-form-message">Message:</label>
                <textarea id="block-form-message" name="message" required></textarea>
            </div>

            <button type="submit">Send Message</button>
            </form>
        </section>
        `,
    },
    "block-input": {
        html: `
        <style>
            .block-input-content {
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
            border: 1px solid #ddd;
            max-width: 400px;
            margin: auto;
            }
            .block-input-content label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
            }
            .block-input-content input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1em;
            }
        </style>
        <section class="block-input-content" id="block-input-example">
            <label for="block-simple-input">Your Name:</label>
            <input type="text" id="block-simple-input" placeholder="Enter your name">
        </section>
        `,
    },
    "block-textarea": {
        html: `
        <style>
            .block-textarea-content {
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
            border: 1px solid #ddd;
            max-width: 400px;
            margin: auto;
            }
            .block-textarea-content label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
            }
            .block-textarea-content textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            min-height: 100px;
            resize: vertical;
            font-family: sans-serif;
            font-size: 1em;
            }
        </style>
        <section class="block-textarea-content" id="block-textarea-example">
            <label for="block-simple-textarea">Your Message:</label>
            <textarea id="block-simple-textarea" placeholder="Type your message here..."></textarea>
        </section>
        `,
    },
    "block-button": {
        html: `
        <style>
            .block-button-content {
            text-align: center;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
            border: 1px solid #ddd;
            max-width: 300px;
            margin: auto;
            }
            .block-button-content button {
            padding: 12px 25px;
            font-size: 1.1em;
            font-weight: bold;
            color: white;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }
            .block-button-content button:hover {
            background-color: #218838;
            transform: translateY(-2px);
            }
            .block-button-content button:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
        </style>
        <section class="block-button-content" id="block-button-example">
            <button>Submit</button>
        </section>
        `,
    },
    "block-checkbox": {
        html: `
        <style>
            .block-checkbox-content {
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
            border: 1px solid #ddd;
            max-width: 400px;
            margin: auto;
            }
            .block-checkbox-group {
            margin-bottom: 10px;
            }
            .block-checkbox-group label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 1em;
            color: #333;
            }
            .block-checkbox-group input[type="checkbox"] {
            margin-right: 10px;
            width: 18px;
            height: 18px;
            accent-color: #0d6efd;
            }
        </style>
        <section class="block-checkbox-content" id="block-checkbox-example">
            <div class="block-checkbox-group">
            <input type="checkbox" id="block-checkbox1" name="option1">
            <label for="block-checkbox1">Option One</label>
            </div>
            <div class="block-checkbox-group">
            <input type="checkbox" id="block-checkbox2" name="option2" checked>
            <label for="block-checkbox2">Option Two (checked)</label>
            </div>
        </section>
        `,
    },
    "block-radio": {
        html: `
        <style>
            .block-radio-content {
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
            border: 1px solid #ddd;
            max-width: 400px;
            margin: auto;
            }
            .block-radio-group {
            margin-bottom: 10px;
            }
            .block-radio-group label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 1em;
            color: #333;
            }
            .block-radio-group input[type="radio"] {
            margin-right: 10px;
            width: 18px;
            height: 18px;
            accent-color: #0d6efd;
            }
        </style>
        <section class="block-radio-content" id="block-radio-example">
            <p>Choose an option:</p>
            <div class="block-radio-group">
            <input type="radio" id="block-radio1" name="radio-options" value="option1" checked>
            <label for="block-radio1">Option A</label>
            </div>
            <div class="block-radio-group">
            <input type="radio" id="block-radio2" name="radio-options" value="option2">
            <label for="block-radio2">Option B</label>
            </div>
            <div class="block-radio-group">
            <input type="radio" id="block-radio3" name="radio-options" value="option3">
            <label for="block-radio3">Option C</label>
            </div>
        </section>
        `,
    },
    "block-select": {
        html: `
        <style>
            .block-select-content {
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
            border: 1px solid #ddd;
            max-width: 400px;
            margin: auto;
            }
            .block-select-content label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
            }
            .block-select-content select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
            font-size: 1em;
            height: 40px;
            }
        </style>
        <section class="block-select-content" id="block-select-example">
            <label for="block-select-option">Choose an item:</label>
            <select id="block-select-option" name="items">
            <option value="item1">Item 1</option>
            <option value="item2">Item 2</option>
            <option value="item3">Item 3</option>
            <option value="item4">Item 4</option>
            </select>
        </section>
        `,
    },

    // Components Blocks
    "block-navbar-simple": {
        html: `
        <style>
            .block-navbar-content {
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 15px;
            }
            .block-navbar-content nav {
            margin-bottom: 0 !important;
            }
            .block-navbar-content .navbar-brand {
            font-weight: bold;
            }
            .block-navbar-content .navbar-nav .nav-link {
            color: rgba(0,0,0,.55);
            }
            .block-navbar-content .navbar-nav .nav-link.active {
            color: rgba(0,0,0,.7);
            font-weight: 500;
            }
            .block-navbar-content .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }
        </style>
        <section class="block-navbar-content" id="block-navbar-simple-example">
            <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Brand</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#blockNavbarSimple" aria-controls="blockNavbarSimple" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="blockNavbarSimple">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
            </nav>
        </section>
        `,
    },
    "block-navbar-dropdown": {
        html: `
        <style>
            .block-navbar-content {
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 15px;
            }
            .block-navbar-content nav {
            margin-bottom: 0 !important;
            }
            .block-navbar-content .navbar-brand {
            font-weight: bold;
            }
            .block-navbar-content .navbar-nav .nav-link {
            color: rgba(0,0,0,.55);
            }
            .block-navbar-content .navbar-nav .nav-link.active {
            color: rgba(0,0,0,.7);
            font-weight: 500;
            }
            .block-navbar-content .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }
        </style>
        <section class="block-navbar-content" id="block-navbar-dropdown-example">
            <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Dropdown Nav</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#blockNavbarDropdown" aria-controls="blockNavbarDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="blockNavbarDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Web Design</a></li>
                        <li><a class="dropdown-item" href="#">SEO Optimization</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Consulting</a></li>
                    </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
                </div>
            </div>
            </nav>
        </section>
        `,
    },
    "block-navbar-dark": {
        html: `
        <style>
            .block-navbar-content {
            border: 1px solid #222;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 15px;
            }
            .block-navbar-content nav {
            margin-bottom: 0 !important;
            }
            .block-navbar-content .navbar-brand {
            font-weight: bold;
            color: #f8f9fa !important;
            }
            .block-navbar-content .navbar-nav .nav-link {
            color: rgba(255,255,255,.55);
            }
            .block-navbar-content .navbar-nav .nav-link.active {
            color: rgba(255,255,255,.75);
            font-weight: 500;
            }
            .block-navbar-content .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }
            .block-navbar-content .btn-outline-success {
            color: #28a745;
            border-color: #28a745;
            }
            .block-navbar-content .btn-outline-success:hover {
            background-color: #28a745;
            color: white;
            }
        </style>
        <section class="block-navbar-content" id="block-navbar-dark-example">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Dark Brand</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#blockNavbarDark" aria-controls="blockNavbarDark" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="blockNavbarDark">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
            </nav>
        </section>
        `,
    },

    // Sections
    "section-hero-1": {
        html: `
        <style>
            .section-hero-1-content {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, #6dd5ed 0%, #2193b0 100%);
            color: white;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            }
            .section-hero-1-content h1 { font-size: 3.5em; margin-bottom: 20px; font-weight: 700; }
            .section-hero-1-content p { font-size: 1.3em; margin-bottom: 30px; max-width: 800px; margin-left: auto; margin-right: auto; line-height: 1.5; }
            .section-hero-1-content .btn-primary { background-color: #fff; border-color: #fff; color: #2193b0; padding: 12px 30px; font-size: 1.1em; font-weight: 600; border-radius: 50px; transition: all 0.3s ease; }
            .section-hero-1-content .btn-primary:hover { background-color: #f0f0f0; color: #1a768e; transform: translateY(-2px); }
        </style>
        <section class="section-hero-1-content" id="hero-section-1-example">
            <h1>Empower Your Digital Presence</h1>
            <p>We provide cutting-edge solutions to elevate your business and connect with your audience effectively.</p>
            <button class="btn btn-primary">Learn More</button>
        </section>
        `,
    },
    "section-hero-2": {
        html: `
        <style>
            .section-hero-2-content {
            position: relative;
            text-align: center;
            color: white;
            overflow: hidden;
            border-radius: 8px;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            }
            .section-hero-2-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7));
            z-index: 1;
            }
            .section-hero-2-content .hero-bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            }
            .section-hero-2-content .hero-content-overlay {
            position: relative;
            z-index: 2;
            max-width: 900px;
            margin: auto;
            }
            .section-hero-2-content h1 { font-size: 3.8em; margin-bottom: 25px; font-weight: 800; }
            .section-hero-2-content p { font-size: 1.4em; margin-bottom: 40px; line-height: 1.6; }
            .section-hero-2-content .btn-light { background-color: white; border-color: white; color: #0d6efd; padding: 15px 40px; font-size: 1.2em; font-weight: 600; border-radius: 50px; transition: all 0.3s ease; }
            .section-hero-2-content .btn-light:hover { background-color: #f0f0f0; color: #0b5ed7; transform: translateY(-3px); box-shadow: 0 8px 15px rgba(0,0,0,0.2); }
        </style>
        <section class="section-hero-2-content" id="hero-section-2-example">
            <img src="https://assets.aktools.net/image-stocks/hero-carousels/hero-carousel-1.jpg" alt="Hero Background" class="hero-bg-image">
            <div class="hero-content-overlay">
            <h1>Your Vision, Our Expertise</h1>
            <p>Transforming complex challenges into elegant solutions, powered by innovation and dedication.</p>
            <button class="btn btn-light">Get Started Today</button>
            </div>
        </section>
        `,
    },
    "section-hero-3": {
        html: `
        <style>
            .section-hero-3-content {
            position: relative;
            text-align: center;
            color: white;
            overflow: hidden;
            border-radius: 8px;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            }
            .section-hero-3-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: 1;
            }
            .section-hero-3-content .hero-bg-video {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: translate(-50%, -50%);
            z-index: 0;
            }
            .section-hero-3-content .hero-content-overlay {
            position: relative;
            z-index: 2;
            max-width: 900px;
            margin: auto;
            }
            .section-hero-3-content h1 { font-size: 4em; margin-bottom: 25px; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
            .section-hero-3-content p { font-size: 1.5em; margin-bottom: 40px; line-height: 1.7; text-shadow: 1px 1px 3px rgba(0,0,0,0.4); }
            .section-hero-3-content .btn-warning { background-color: #ffc107; border-color: #ffc107; color: #333; padding: 15px 40px; font-size: 1.2em; font-weight: 700; border-radius: 50px; transition: all 0.3s ease; }
            .section-hero-3-content .btn-warning:hover { background-color: #e0a800; border-color: #d39e00; color: #222; transform: translateY(-3px); box-shadow: 0 8px 15px rgba(0,0,0,0.2); }
        </style>
        <section class="section-hero-3-content" id="hero-section-3-example">
            <video autoplay loop muted playsinline poster="https://assets.aktools.net/image-stocks/hero-carousels/hero-carousel-2.jpg" class="hero-bg-video">
                <source src="https://assets.aktools.net/image-stocks/videos/video-2.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="hero-content-overlay">
                <h1>Experience Innovation in Motion</h1>
                <p>Captivating visuals and dynamic storytelling to elevate your brand to new heights.</p>
                <button class="btn btn-warning">Watch Our Story</button>
            </div>
        </section>
        `,
    },

    "section-about-1": {
        html: `
        <style>
            .section-about-1-content {
            padding: 50px 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 30px;
            }
            .section-about-1-content h2 { font-size: 2.5em; margin-bottom: 20px; color: #343a40; width: 100%; text-align: center; }
            .section-about-1-content .about-text, .section-about-1-content .about-image { flex: 1; min-width: 300px; }
            .section-about-1-content .about-text p { font-size: 1.1em; line-height: 1.7; color: #6c757d; margin-bottom: 15px; }
            .section-about-1-content .about-image img { max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1); }
            .section-about-1-content .btn-secondary { background-color: #6c757d; border-color: #6c757d; margin-top: 15px; }
            .section-about-1-content .btn-secondary:hover { background-color: #5a6268; border-color: #545b62; }
        </style>
        <section class="section-about-1-content" id="about-section-1-example">
            <h2>About Us</h2>
            <div class="about-text">
            <p>We are a passionate team dedicated to delivering high-quality solutions. Our mission is to innovate and provide exceptional value to our clients.</p>
            <p>With years of experience and a commitment to excellence, we strive to exceed expectations in every project we undertake.</p>
            <button class="btn btn-secondary">Read More</button>
            </div>
            <div class="about-image">
            <img src="https://assets.aktools.net/image-stocks/about/about-1.jpg" alt="About Us Image">
            </div>
        </section>
        `,
    },
    "section-about-2": {
        html: `
        <style>
            .section-about-2-content {
            padding: 60px 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            max-width: 900px;
            margin: auto;
            }
            .section-about-2-content h2 { font-size: 2.8em; margin-bottom: 25px; color: #0d6efd; font-weight: 700; }
            .section-about-2-content p { font-size: 1.15em; line-height: 1.7; color: #555; margin-bottom: 30px; }
            .section-about-2-content .highlight { color: #28a745; font-weight: bold; }
            .section-about-2-content .img-fluid { max-width: 80%; height: auto; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); margin-top: 20px; }
        </style>
        <section class="section-about-2-content" id="about-section-2-example">
            <h2>Our Story & Mission</h2>
            <p>Founded on principles of <span class="highlight">innovation</span> and <span class="highlight">customer satisfaction</span>, we've grown from a small startup to a leading provider in our industry. Our mission is to deliver unparalleled quality and foster lasting relationships.</p>
            <img src="https://assets.aktools.net/image-stocks/about/about-2.jpg" alt="Our Team Working" class="img-fluid">
            <p style="margin-top: 30px;">Every day, we strive to make a difference through our work, empowering businesses and individuals alike.</p>
        </section>
        `,
    },
    "section-about-3": {
        html: `
        <style>
            .section-about-3-content {
            padding: 60px 20px;
            background-color: #f2f7ff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            }
            .section-about-3-content h2 { font-size: 2.5em; margin-bottom: 40px; color: #0d6efd; text-align: center; }
            .section-about-3-content .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            }
            .section-about-3-content .feature-item {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .section-about-3-content .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            }
            .section-about-3-content .feature-item .bi {
            font-size: 3.5em;
            color: #0d6efd;
            margin-bottom: 20px;
            }
            .section-about-3-content .feature-item h3 { font-size: 1.6em; margin-bottom: 10px; color: #333; }
            .section-about-3-content .feature-item p { font-size: 1em; line-height: 1.6; color: #666; }
        </style>
        <section class="section-about-3-content" id="about-section-3-example">
            <h2>Why Choose Us?</h2>
            <div class="features-grid">
            <div class="feature-item">
                <i class="bi bi-lightbulb-fill"></i>
                <h3>Innovative Solutions</h3>
                <p>We consistently develop creative and forward-thinking solutions.</p>
            </div>
            <div class="feature-item">
                <i class="bi bi-trophy-fill"></i>
                <h3>Proven Excellence</h3>
                <p>Our track record speaks for itself, with satisfied clients and successful projects.</p>
            </div>
            <div class="feature-item">
                <i class="bi bi-people-fill"></i>
                <h3>Dedicated Support</h3>
                <p>Receive round-the-clock support from our experienced and friendly team.</p>
            </div>
            </div>
        </section>
        `,
    },

    "section-categories-1": {
        html: `
        <style>
            .section-categories-1-content {
            padding: 50px 20px;
            background-color: #e9f7ef;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-categories-1-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #28a745; }
            .section-categories-1-content .category-grid { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
            .section-categories-1-content .category-item { background-color: #fff; border-radius: 8px; padding: 25px; flex: 1 1 250px; max-width: 300px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease, box-shadow 0.3s ease; }
            .section-categories-1-content .category-item:hover { transform: translateY(-5px); box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15); }
            .section-categories-1-content .category-item .bi { font-size: 3em; color: #28a745; margin-bottom: 15px; }
            .section-categories-1-content .category-item h3 { font-size: 1.5em; color: #333; margin-bottom: 10px; }
            .section-categories-1-content .category-item p { font-size: 0.95em; color: #666; }
        </style>
        <section class="section-categories-1-content" id="categories-section-1-example">
            <h2>Our Key Categories</h2>
            <div class="category-grid">
            <div class="category-item">
                <i class="bi bi-gear-fill"></i>
                <h3>Web Development</h3>
                <p>Building responsive and powerful web applications.</p>
            </div>
            <div class="category-item">
                <i class="bi bi-palette-fill"></i>
                <h3>Graphic Design</h3>
                <p>Creative visual solutions for your brand.</p>
            </div>
            <div class="category-item">
                <i class="bi bi-megaphone-fill"></i>
                <h3>Digital Marketing</h3>
                <p>Reaching your audience with effective strategies.</p>
            </div>
            </div>
        </section>
        `,
    },
    "section-categories-2": {
        html: `
        <style>
            .section-categories-2-content {
            padding: 50px 20px;
            background-color: #fff8f0;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-categories-2-content h2 { font-size: 2.5em; margin-bottom: 40px; color: #f0ad4e; }
            .section-categories-2-content .category-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            justify-content: center;
            }
            .section-categories-2-content .category-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: left;
            }
            .section-categories-2-content .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            }
            .section-categories-2-content .category-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
            }
            .section-categories-2-content .category-card-body {
            padding: 20px;
            }
            .section-categories-2-content .category-card-body h3 { font-size: 1.5em; color: #333; margin-bottom: 10px; }
            .section-categories-2-content .category-card-body p { font-size: 0.95em; color: #666; line-height: 1.5; }
            .section-categories-2-content .category-card-body a { color: #f0ad4e; text-decoration: none; font-weight: 500; display: inline-block; margin-top: 10px; }
            .section-categories-2-content .category-card-body a:hover { text-decoration: underline; }
        </style>
        <section class="section-categories-2-content" id="categories-section-2-example">
            <h2>Explore Our Service Categories</h2>
            <div class="category-cards-grid">
            <div class="category-card">
                <img src="https://assets.aktools.net/image-stocks/categories/category-1.jpg" alt="Category Image 1">
                <div class="category-card-body">
                <h3>Backend Solutions</h3>
                <p>Robust and scalable server-side development.</p>
                <a href="#">View Services</a>
                </div>
            </div>
            <div class="category-card">
                <img src="https://assets.aktools.net/image-stocks/categories/category-2.jpg" alt="Category Image 2">
                <div class="category-card-body">
                <h3>Frontend Development</h3>
                <p>Creating beautiful and interactive user interfaces.</p>
                <a href="#">View Services</a>
                </div>
            </div>
            <div class="category-card">
                <img src="https://assets.aktools.net/image-stocks/categories/category-3.jpg" alt="Category Image 3">
                <div class="category-card-body">
                <h3>Cloud Infrastructure</h3>
                <p>Managing and optimizing your cloud resources efficiently.</p>
                <a href="#">View Services</a>
                </div>
            </div>
            </div>
        </section>
        `,
    },
    "section-categories-3": {
        html: `
        <style>
            .section-categories-3-content {
            padding: 50px 20px;
            background-color: #f7faff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            }
            .section-categories-3-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #007bff; text-align: center; }
            .section-categories-3-content .category-list { max-width: 700px; margin: auto; }
            .section-categories-3-content .category-list-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 15px;
            border-left: 4px solid #007bff;
            }
            .section-categories-3-content .category-list-item .bi {
            font-size: 2.5em;
            color: #007bff;
            flex-shrink: 0;
            }
            .section-categories-3-content .category-list-item-body h3 { font-size: 1.5em; margin-bottom: 5px; color: #333; }
            .section-categories-3-content .category-list-item-body p { font-size: 1em; line-height: 1.6; color: #666; margin-bottom: 0; }
        </style>
        <section class="section-categories-3-content" id="categories-section-3-example">
            <h2>Our Core Expertise</h2>
            <div class="category-list">
            <div class="category-list-item">
                <i class="bi bi-shield-check"></i>
                <div class="category-list-item-body">
                <h3>Cybersecurity Solutions</h3>
                <p>Protecting your digital assets with advanced security measures and threat detection.</p>
                </div>
            </div>
            <div class="category-list-item">
                <i class="bi bi-cloud-arrow-up"></i>
                <div class="category-list-item-body">
                <h3>Cloud Services</h3>
                <p>Scalable cloud infrastructure and management for seamless operations.</p>
                </div>
            </div>
            <div class="category-list-item">
                <i class="bi bi-robot"></i>
                <div class="category-list-item-body">
                <h3>AI & Machine Learning</h3>
                <p>Leveraging artificial intelligence to automate and enhance business processes.</p>
                </div>
            </div>
            </div>
        </section>
        `,
    },

    "section-clients-1": {
        html: `
        <style>
            .section-clients-1-content {
            padding: 50px 20px;
            background-color: #f0f8ff;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            }
            .section-clients-1-content h2 { font-size: 2.5em; margin-bottom: 40px; color: #0d6efd; }
            .section-clients-1-content .client-logos { display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; }
            .section-clients-1-content .client-logo-item img { max-height: 80px; width: auto; filter: grayscale(100%); opacity: 0.7; transition: filter 0.3s ease, opacity 0.3s ease; }
            .section-clients-1-content .client-logo-item img:hover { filter: grayscale(0%); opacity: 1; }
        </style>
        <section class="section-clients-1-content" id="clients-section-1-example">
            <h2>Our Valued Partners</h2>
            <div class="client-logos">
            <div class="client-logo-item">
                <img src="https://assets.aktools.net/image-stocks/clients/clients-1.svg" alt="Client A Logo">
            </div>
            <div class="client-logo-item">
                <img src="https://assets.aktools.net/image-stocks/clients/clients-2.svg" alt="Client B Logo">
            </div>
            <div class="client-logo-item">
                <img src="https://assets.aktools.net/image-stocks/clients/clients-3.svg" alt="Client C Logo">
            </div>
            <div class="client-logo-item">
                <img src="https://assets.aktools.net/image-stocks/clients/clients-4.svg" alt="Client D Logo">
            </div>
            <div class="client-logo-item">
                <img src="https://assets.aktools.net/image-stocks/clients/clients-5.svg" alt="Client E Logo">
            </div>
            <div class="client-logo-item">
                <img src="https://assets.aktools.net/image-stocks/clients/clients-6.svg" alt="Client F Logo">
            </div>
            <div class="client-logo-item">
                <img src="https://assets.aktools.net/image-stocks/clients/clients-7.svg" alt="Client G Logo">
            </div>
            <div class="client-logo-item">
                <img src="https://assets.aktools.net/image-stocks/clients/clients-8.svg" alt="Client H Logo">
            </div>
            </div>
        </section>
        `,
    },
    "section-clients-2": {
        html: `
        <style>
            .section-clients-2-content {
            padding: 50px 20px;
            background-color: #fefefe;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            }
            .section-clients-2-content h2 { font-size: 2.5em; margin-bottom: 20px; color: #343a40; }
            .section-clients-2-content p { font-size: 1.1em; margin-bottom: 40px; color: #666; max-width: 800px; margin-left: auto; margin-right: auto; }
            .section-clients-2-content .client-logos { display: flex; flex-wrap: wrap; justify-content: center; gap: 40px; align-items: center; }
            .section-clients-2-content .client-logo-item img { max-height: 70px; width: auto; opacity: 0.8; transition: opacity 0.3s ease; }
            .section-clients-2-content .client-logo-item img:hover { opacity: 1; }
        </style>
        <section class="section-clients-2-content" id="clients-section-2-example">
            <h2>Trusted by Leading Companies</h2>
            <p>We're proud to work with businesses of all sizes, helping them achieve their goals and drive success.</p>
            <div class="client-logos">
            <div class="client-logo-item"><img src="https://assets.aktools.net/image-stocks/clients/clients-1.svg" alt="Client I Logo"></div>
            <div class="client-logo-item"><img src="https://assets.aktools.net/image-stocks/clients/clients-2.svg" alt="Client J Logo"></div>
            <div class="client-logo-item"><img src="https://assets.aktools.net/image-stocks/clients/clients-3.svg" alt="Client K Logo"></div>
            <div class="client-logo-item"><img src="https://assets.aktools.net/image-stocks/clients/clients-4.svg" alt="Client L Logo"></div>
            <div class="client-logo-item"><img src="https://assets.aktools.net/image-stocks/clients/clients-5.svg" alt="Client M Logo"></div>
            <div class="client-logo-item"><img src="https://assets.aktools.net/image-stocks/clients/clients-6.svg" alt="Client N Logo"></div>
            <div class="client-logo-item"><img src="https://assets.aktools.net/image-stocks/clients/clients-7.svg" alt="Client O Logo"></div>
            <div class="client-logo-item"><img src="https://assets.aktools.net/image-stocks/clients/clients-8.svg" alt="Client P Logo"></div>
            </div>
        </section>
        `,
    },

    "section-cta-1": {
        html: `
        <style>
            .section-cta-1-content {
            text-align: center;
            padding: 70px 20px;
            background: linear-gradient(45deg, #ff7e5f 0%, #feb47b 100%);
            color: white;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            }
            .section-cta-1-content h2 { font-size: 3em; margin-bottom: 20px; font-weight: 700; }
            .section-cta-1-content p { font-size: 1.2em; margin-bottom: 30px; max-width: 700px; margin-left: auto; margin-right: auto; line-height: 1.5; }
            .section-cta-1-content .btn-light { background-color: #fff; border-color: #fff; color: #ff7e5f; padding: 15px 35px; font-size: 1.2em; font-weight: 600; border-radius: 50px; transition: all 0.3s ease; }
            .section-cta-1-content .btn-light:hover { background-color: #f0f0f0; color: #e56a4e; transform: translateY(-3px); box-shadow: 0 8px 15px rgba(0,0,0,0.2); }
        </style>
        <section class="section-cta-1-content" id="cta-section-1-example">
            <h2>Ready to Start Your Project?</h2>
            <p>Contact us today for a free consultation and let's bring your ideas to life.</p>
            <button class="btn btn-light">Get a Quote</button>
        </section>
        `,
    },
    "section-cta-2": {
        html: `
        <style>
            .section-cta-2-content {
            position: relative;
            text-align: center;
            color: white;
            overflow: hidden;
            border-radius: 8px;
            min-height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 20px;
            }
            .section-cta-2-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: 1;
            }
            .section-cta-2-content .cta-bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            }
            .section-cta-2-content .cta-content-overlay {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: auto;
            }
            .section-cta-2-content h2 { font-size: 3.2em; margin-bottom: 20px; font-weight: 700; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
            .section-cta-2-content p { font-size: 1.2em; margin-bottom: 30px; line-height: 1.6; text-shadow: 1px 1px 3px rgba(0,0,0,0.4); }
            .section-cta-2-content .btn-primary { background-color: #28a745; border-color: #28a745; color: white; padding: 15px 40px; font-size: 1.1em; font-weight: 600; border-radius: 50px; transition: all 0.3s ease; }
            .section-cta-2-content .btn-primary:hover { background-color: #218838; border-color: #1e7e34; transform: translateY(-3px); box-shadow: 0 8px 15px rgba(0,0,0,0.2); }
        </style>
        <section class="section-cta-2-content" id="cta-section-2-example">
            <img src="https://assets.aktools.net/image-stocks/cta/cta-1.jpg" alt="CTA Background" class="cta-bg-image">
            <div class="cta-content-overlay">
            <h2>Boost Your Business Growth</h2>
            <p>Unlock new opportunities with our tailored strategies and dedicated support team.</p>
            <button class="btn btn-primary">Discover More</button>
            </div>
        </section>
        `,
    },
    "section-cta-3": {
        html: `
        <style>
            .section-cta-3-content {
            text-align: center;
            padding: 60px 20px;
            background-color: #fefefe;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            max-width: 800px;
            margin: auto;
            }
            .section-cta-3-content h2 { font-size: 2.5em; margin-bottom: 20px; color: #343a40; font-weight: 700; }
            .section-cta-3-content p { font-size: 1.1em; margin-bottom: 30px; line-height: 1.6; color: #666; }
            .section-cta-3-content .cta-buttons { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
            .section-cta-3-content .cta-buttons .btn { padding: 12px 30px; font-size: 1.1em; font-weight: 600; border-radius: 50px; transition: all 0.3s ease; }
            .section-cta-3-content .cta-buttons .btn-primary { background-color: #0d6efd; border-color: #0d6efd; }
            .section-cta-3-content .cta-buttons .btn-primary:hover { background-color: #0b5ed7; border-color: #0a58ca; transform: translateY(-2px); }
            .section-cta-3-content .cta-buttons .btn-outline-secondary { color: #6c757d; border-color: #6c757d; }
            .section-cta-3-content .cta-buttons .btn-outline-secondary:hover { background-color: #6c757d; color: white; transform: translateY(-2px); }
        </style>
        <section class="section-cta-3-content" id="cta-section-3-example">
            <h2>Ready to Dive Deeper?</h2>
            <p>Explore our features or get in touch with our sales team for a personalized demo.</p>
            <div class="cta-buttons">
            <button class="btn btn-primary">View Features</button>
            <button class="btn btn-outline-secondary">Contact Sales</button>
            </div>
        </section>
        `,
    },

    "section-portfolios-1": {
        html: `
        <style>
            .section-portfolio-1-content {
            padding: 50px 20px;
            background-color: #fdfdfd;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-portfolio-1-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #343a40; }
            .section-portfolio-1-content .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            justify-content: center;
            }
            .section-portfolio-1-content .portfolio-item {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .section-portfolio-1-content .portfolio-item:hover { transform: translateY(-8px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); }
            .section-portfolio-1-content .portfolio-item img { width: 100%; height: 200px; object-fit: cover; display: block; }
            .section-portfolio-1-content .portfolio-item-body { padding: 20px; text-align: left; }
            .section-portfolio-1-content .portfolio-item-body h3 { font-size: 1.4em; color: #333; margin-bottom: 10px; }
            .section-portfolio-1-content .portfolio-item-body p { font-size: 0.9em; color: #666; line-height: 1.5; }
            .section-portfolio-1-content .portfolio-item-body a { color: #0d6efd; text-decoration: none; font-weight: 500; margin-top: 10px; display: inline-block; }
            .section-portfolio-1-content .portfolio-item-body a:hover { text-decoration: underline; }
        </style>
        <section class="section-portfolio-1-content" id="portfolio-section-1-example">
            <h2>Our Latest Work</h2>
            <div class="portfolio-grid">
            <div class="portfolio-item">
                <img src="https://assets.aktools.net/image-stocks/portfolios/portfolio-1.jpg" alt="Portfolio Project 1">
                <div class="portfolio-item-body">
                <h3>Modern Website Design</h3>
                <p>A sleek and responsive website built for a tech startup, focusing on user experience.</p>
                <a href="#">View Project</a>
                </div>
            </div>
            <div class="portfolio-item">
                <img src="https://assets.aktools.net/image-stocks/portfolios/portfolio-2.jpg" alt="Portfolio Project 2">
                <div class="portfolio-item-body">
                <h3>E-commerce Platform</h3>
                <p>Developed a high-performance e-commerce solution with advanced features for a retail client.</p>
                <a href="#">View Project</a>
                </div>
            </div>
            <div class="portfolio-item">
                <img src="https://assets.aktools.net/image-stocks/portfolios/portfolio-3.jpg" alt="Portfolio Project 3">
                <div class="portfolio-item-body">
                <h3>Mobile App Development</h3>
                <p>Designed and coded an intuitive mobile application for both iOS and Android platforms.</p>
                <a href="#">View Project</a>
                </div>
            </div>
            </div>
        </section>
        `,
    },
    "section-portfolios-2": {
        html: `
        <style>
            .section-portfolio-2-content {
            padding: 50px 20px;
            background-color: #f7faff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-portfolio-2-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #007bff; }
            .section-portfolio-2-content .portfolio-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            justify-content: center;
            }
            .section-portfolio-2-content .portfolio-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: left;
            position: relative;
            }
            .section-portfolio-2-content .portfolio-card:hover { transform: translateY(-10px); box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2); }
            .section-portfolio-2-content .portfolio-card img { width: 100%; height: 220px; object-fit: cover; display: block; }
            .section-portfolio-2-content .portfolio-card-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0));
            color: white;
            padding: 20px;
            }
            .section-portfolio-2-content .portfolio-card-info h3 { font-size: 1.6em; margin-bottom: 5px; }
            .section-portfolio-2-content .portfolio-card-info p { font-size: 0.95em; margin-bottom: 0; }
        </style>
        <section class="section-portfolio-2-content" id="portfolio-section-2-example">
            <h2>Creative Projects</h2>
            <div class="portfolio-cards-grid">
            <div class="portfolio-card">
                <img src="https://assets.aktools.net/image-stocks/portfolios/portfolio-4.jpg" alt="Creative Project 1">
                <div class="portfolio-card-info">
                <h3>Digital Marketing Campaign</h3>
                <p>A multi-channel campaign driving engagement and conversions.</p>
                </div>
            </div>
            <div class="portfolio-card">
                <img src="https://assets.aktools.net/image-stocks/portfolios/portfolio-2.jpg" alt="Creative Project 2">
                <div class="portfolio-card-info">
                <h3>Brand Identity Development</h3>
                <p>Crafting a unique and memorable brand presence for a new venture.</p>
                </div>
            </div>
            <div class="portfolio-card">
                <img src="https://assets.aktools.net/image-stocks/portfolios/portfolio-1.jpg" alt="Creative Project 3">
                <div class="portfolio-card-info">
                <h3>UI/UX Redesign</h3>
                <p>Revamping an existing application for improved user experience.</p>
                </div>
            </div>
            </div>
        </section>
        `,
    },

    "section-services-1": {
        html: `
        <style>
            .section-services-1-content {
            padding: 50px 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-services-1-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #343a40; }
            .section-services-1-content .service-grid { display: flex; flex-wrap: wrap; gap: 25px; justify-content: center; }
            .section-services-1-content .service-item {
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            flex: 1 1 280px;
            max-width: 350px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: left;
            }
            .section-services-1-content .service-item:hover { transform: translateY(-5px); box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15); }
            .section-services-1-content .service-item .bi { font-size: 3em; color: #0d6efd; margin-bottom: 20px; }
            .section-services-1-content .service-item h3 { font-size: 1.6em; color: #333; margin-bottom: 15px; }
            .section-services-1-content .service-item p { font-size: 1em; color: #666; line-height: 1.6; }
        </style>
        <section class="section-services-1-content" id="services-section-1-example">
            <h2>Our Services</h2>
            <div class="service-grid">
            <div class="service-item">
                <i class="bi bi-code-slash"></i>
                <h3>Custom Web Development</h3>
                <p>We build tailor-made websites and web applications to meet your unique business needs.</p>
            </div>
            <div class="service-item">
                <i class="bi bi-search"></i>
                <h3>SEO & Analytics</h3>
                <p>Improve your online visibility and track performance with expert SEO and analytics.</p>
            </div>
            <div class="service-item">
                <i class="bi bi-vector-pen"></i>
                <h3>UI/UX Design</h3>
                <p>Crafting intuitive and engaging user experiences with modern interface design.</p>
            </div>
            </div>
        </section>
        `,
    },
    "section-services-2": {
        html: `
        <style>
            .section-services-2-content {
            padding: 50px 20px;
            background-color: #f7faff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-services-2-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #007bff; }
            .section-services-2-content .service-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            justify-content: center;
            }
            .section-services-2-content .service-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: left;
            }
            .section-services-2-content .service-card:hover { transform: translateY(-8px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); }
            .section-services-2-content .service-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
            }
            .section-services-2-content .service-card-body {
            padding: 20px;
            }
            .section-services-2-content .service-card-body h3 { font-size: 1.5em; color: #333; margin-bottom: 10px; }
            .section-services-2-content .service-card-body p { font-size: 0.95em; color: #666; line-height: 1.5; }
            .section-services-2-content .service-card-body a { color: #007bff; text-decoration: none; font-weight: 500; display: inline-block; margin-top: 10px; }
            .section-services-2-content .service-card-body a:hover { text-decoration: underline; }
        </style>
        <section class="section-services-2-content" id="services-section-2-example">
            <h2>What We Offer</h2>
            <div class="service-cards-grid">
            <div class="service-card">
                <img src="https://assets.aktools.net/image-stocks/services/services-1.jpg" alt="Service Image 1">
                <div class="service-card-body">
                <h3>Strategy & Consulting</h3>
                <p>Expert guidance to define your digital roadmap and achieve business objectives.</p>
                <a href="#">Learn More</a>
                </div>
            </div>
            <div class="service-card">
                <img src="https://assets.aktools.net/image-stocks/services/services-2.jpg" alt="Service Image 2">
                <div class="service-card-body">
                <h3>Data Analytics</h3>
                <p>Transforming raw data into actionable insights for informed decision-making.</p>
                <a href="#">Learn More</a>
                </div>
            </div>
            <div class="service-card">
                <img src="https://assets.aktools.net/image-stocks/services/services-3.jpg" alt="Service Image 3">
                <div class="service-card-body">
                <h3>Mobile App Development</h3>
                <p>Building high-performance, user-friendly mobile applications for all platforms.</p>
                <a href="#">Learn More</a>
                </div>
            </div>
            </div>
        </section>
        `,
    },
    "section-services-3": {
        html: `
        <style>
            .section-services-3-content {
            padding: 50px 20px;
            background-color: #fefefe;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            max-width: 900px;
            margin: auto;
            }
            .section-services-3-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #343a40; text-align: center; }
            .section-services-3-content .service-list-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            }
            @media (min-width: 768px) {
            .section-services-3-content .service-list-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            }
            .section-services-3-content .service-list-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #28a745;
            }
            .section-services-3-content .service-list-item .bi {
            font-size: 2.5em;
            color: #28a745;
            flex-shrink: 0;
            }
            .section-services-3-content .service-list-item-body h3 { font-size: 1.4em; margin-bottom: 5px; color: #333; }
            .section-services-3-content .service-list-item-body p { font-size: 0.95em; line-height: 1.6; color: #666; margin-bottom: 0; }
        </style>
        <section class="section-services-3-content" id="services-section-3-example">
            <h2>Comprehensive Solutions</h2>
            <div class="service-list-grid">
            <div class="service-list-item">
                <i class="bi bi-laptop"></i>
                <div class="service-list-item-body">
                <h3>Software Development</h3>
                <p>From custom applications to enterprise solutions, we build software that works.</p>
                </div>
            </div>
            <div class="service-list-item">
                <i class="bi bi-bar-chart-line"></i>
                <div class="service-list-item-body">
                <h3>Marketing Automation</h3>
                <p>Automate your campaigns and nurture leads effectively with our marketing tools.</p>
                </div>
            </div>
            <div class="service-list-item">
                <i class="bi bi-shield-lock"></i>
                <div class="service-list-item-body">
                <h3>IT Security</h3>
                <p>Protecting your infrastructure and data from modern cyber threats.</p>
                </div>
            </div>
            <div class="service-list-item">
                <i class="bi bi-headset"></i>
                <div class="service-list-item-body">
                <h3>24/7 Support</h3>
                <p>Dedicated support team available around the clock to assist you.</p>
                </div>
            </div>
            </div>
        </section>
        `,
    },

    "section-subscribe-1": {
        html: `
        <style>
            .section-subscribe-1-content {
            padding: 60px 20px;
            background: linear-gradient(to right, #4CAF50, #8BC34A);
            color: white;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
            }
            .section-subscribe-1-content h2 { font-size: 2.8em; margin-bottom: 15px; font-weight: 700; }
            .section-subscribe-1-content p { font-size: 1.1em; margin-bottom: 30px; max-width: 600px; margin-left: auto; margin-right: auto; line-height: 1.5; }
            .section-subscribe-1-content form { display: flex; justify-content: center; gap: 10px; max-width: 500px; margin: 0 auto; flex-wrap: wrap; }
            .section-subscribe-1-content input[type="email"] { flex-grow: 1; padding: 12px 20px; border: none; border-radius: 50px; font-size: 1em; min-width: 200px; }
            .section-subscribe-1-content button { padding: 12px 25px; background-color: #0d6efd; color: white; border: none; border-radius: 50px; font-size: 1em; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease; }
            .section-subscribe-1-content button:hover { background-color: #0b5ed7; }
        </style>
        <section class="section-subscribe-1-content" id="subscribe-section-1-example">
            <h2>Subscribe to Our Newsletter</h2>
            <p>Stay updated with our latest news, offers, and exclusive content delivered right to your inbox!</p>
            <form>
            <input type="email" placeholder="Enter your email address" required>
            <button type="submit">Subscribe</button>
            </form>
        </section>
        `,
    },
    "section-subscribe-2": {
        html: `
        <style>
            .section-subscribe-2-content {
            position: relative;
            text-align: center;
            color: white;
            overflow: hidden;
            border-radius: 8px;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            }
            .section-subscribe-2-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: 1;
            }
            .section-subscribe-2-content .subscribe-bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            }
            .section-subscribe-2-content .subscribe-content-overlay {
            position: relative;
            z-index: 2;
            max-width: 700px;
            margin: auto;
            }
            .section-subscribe-2-content h2 { font-size: 3.2em; margin-bottom: 20px; font-weight: 700; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
            .section-subscribe-2-content p { font-size: 1.2em; margin-bottom: 30px; line-height: 1.6; text-shadow: 1px 1px 3px rgba(0,0,0,0.4); }
            .section-subscribe-2-content form { display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; }
            .section-subscribe-2-content input[type="email"] { flex-grow: 1; padding: 12px 20px; border: none; border-radius: 50px; font-size: 1em; min-width: 200px; color: #333; }
            .section-subscribe-2-content button { padding: 12px 25px; background-color: #28a745; color: white; border: none; border-radius: 50px; font-size: 1em; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease; }
            .section-subscribe-2-content button:hover { background-color: #218838; }
        </style>
        <section class="section-subscribe-2-content" id="subscribe-section-2-example">
            <img src="https://assets.aktools.net/image-stocks/subscribe/subscribe-1.jpg" alt="Subscribe Background" class="subscribe-bg-image">
            <div class="subscribe-content-overlay">
            <h2>Never Miss an Update!</h2>
            <p>Join our community of over 50,000 subscribers and get exclusive content and special offers.</p>
            <form>
                <input type="email" placeholder="Your Email Address" required>
                <button type="submit">Subscribe Now</button>
            </form>
            </div>
        </section>
        `,
    },
    "section-subscribe-3": {
        html: `
        <style>
            .section-subscribe-3-content {
            padding: 60px 20px;
            background-color: #343a40; /* Dark background */
            color: white;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
            }
            .section-subscribe-3-content h2 { font-size: 2.8em; margin-bottom: 15px; font-weight: 700; color: #f8f9fa; }
            .section-subscribe-3-content p { font-size: 1.1em; margin-bottom: 30px; max-width: 600px; margin-left: auto; margin-right: auto; line-height: 1.5; color: #adb5bd; }
            .section-subscribe-3-content form { display: flex; justify-content: center; gap: 10px; max-width: 500px; margin: 0 auto; flex-wrap: wrap; }
            .section-subscribe-3-content input[type="email"] {
            flex-grow: 1;
            padding: 12px 20px;
            border: 1px solid #6c757d;
            background-color: #495057;
            color: #f8f9fa;
            border-radius: 50px;
            font-size: 1em;
            min-width: 200px;
            }
            .section-subscribe-3-content input[type="email"]::placeholder { color: #ced4da; opacity: 0.7; }
            .section-subscribe-3-content button { padding: 12px 25px; background-color: #ffc107; color: #333; border: none; border-radius: 50px; font-size: 1em; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease; }
            .section-subscribe-3-content button:hover { background-color: #e0a800; }
        </style>
        <section class="section-subscribe-3-content" id="subscribe-section-3-example">
            <h2>Join Our Exclusive Community</h2>
            <p>Sign up now to receive premium content, early access to features, and special discounts.</p>
            <form>
            <input type="email" placeholder="Your Best Email" required>
            <button type="submit">Sign Up</button>
            </form>
        </section>
        `,
    },

    "section-teams-1": {
        html: `
        <style>
            .section-teams-1-content {
            padding: 50px 20px;
            background-color: #f0f8ff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-teams-1-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #0d6efd; }
            .section-teams-1-content .team-grid { display: flex; flex-wrap: wrap; gap: 25px; justify-content: center; }
            .section-teams-1-content .team-member {
            background-color: #fff;
            border-radius: 8px;
            padding: 25px;
            flex: 1 1 250px;
            max-width: 300px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .section-teams-1-content .team-member:hover { transform: translateY(-5px); box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15); }
            .section-teams-1-content .team-member img { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; margin-bottom: 15px; border: 3px solid #0d6efd; }
            .section-teams-1-content .team-member h3 { font-size: 1.5em; color: #333; margin-bottom: 5px; }
            .section-teams-1-content .team-member p { font-size: 1em; color: #666; }
            .section-teams-1-content .team-member .social-links a { color: #0d6efd; font-size: 1.5em; margin: 0 8px; transition: color 0.3s ease; }
            .section-teams-1-content .team-member .social-links a:hover { color: #0b5ed7; }
        </style>
        <section class="section-teams-1-content" id="teams-section-1-example">
            <h2>Meet Our Expert Team</h2>
            <div class="team-grid">
            <div class="team-member">
                <img src="https://assets.aktools.net/image-stocks/portrait/portrait-1.jpg" alt="John Doe">
                <h3>John Doe</h3>
                <p>CEO & Founder</p>
                <div class="social-links">
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="team-member">
                <img src="https://assets.aktools.net/image-stocks/portrait/portrait-2.jpg" alt="Jane Smith">
                <h3>Jane Smith</h3>
                <p>Lead Developer</p>
                <div class="social-links">
                <a href="#"><i class="bi bi-github"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="team-member">
                <img src="https://assets.aktools.net/image-stocks/portrait/portrait-3.jpg" alt="Mark Johnson">
                <h3>Mark Johnson</h3>
                <p>Marketing Manager</p>
                <div class="social-links">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
            </div>
        </section>
        `,
    },
    "section-teams-2": {
        html: `
        <style>
            .section-teams-2-content {
            padding: 50px 20px;
            background-color: #fefefe;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-teams-2-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #343a40; }
            .section-teams-2-content p.lead { font-size: 1.2em; margin-bottom: 40px; color: #666; max-width: 800px; margin-left: auto; margin-right: auto; }
            .section-teams-2-content .team-grid-lg {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 30px;
            justify-content: center;
            }
            .section-teams-2-content .team-member-lg {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            }
            .section-teams-2-content .team-member-lg:hover { transform: translateY(-7px); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15); }
            .section-teams-2-content .team-member-lg img { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin-bottom: 15px; border: 4px solid #a8dadc; }
            .section-teams-2-content .team-member-lg h3 { font-size: 1.8em; color: #2c3e50; margin-bottom: 5px; }
            .section-teams-2-content .team-member-lg .role { font-size: 1.1em; color: #777; margin-bottom: 15px; }
            .section-teams-2-content .team-member-lg .social-icons a {
            color: #0d6efd;
            font-size: 1.6em;
            margin: 0 10px;
            transition: color 0.3s ease;
            }
            .section-teams-2-content .team-member-lg .social-icons a:hover { color: #a8dadc; }
        </style>
        <section class="section-teams-2-content" id="teams-section-2-example">
            <h2>Our Dedicated Leadership</h2>
            <p class="lead">Meet the individuals driving our success and pushing the boundaries of innovation.</p>
            <div class="team-grid-lg">
            <div class="team-member-lg">
                <img src="https://assets.aktools.net/image-stocks/portrait/portrait-1.jpg" alt="Michael Scott">
                <h3>Michael Scott</h3>
                <p class="role">Chief Executive Officer</p>
                <div class="social-icons">
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="team-member-lg">
                <img src="https://assets.aktools.net/image-stocks/portrait/portrait-2.jpg" alt="Pamela Beesly">
                <h3>Pamela Beesly</h3>
                <p class="role">Chief Marketing Officer</p>
                <div class="social-icons">
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="team-member-lg">
                <img src="https://assets.aktools.net/image-stocks/portrait/portrait-3.jpg" alt="Dwight Schrute">
                <h3>Dwight Schrute</h3>
                <p class="role">Head of Sales</p>
                <div class="social-icons">
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-envelope-fill"></i></a>
                </div>
            </div>
            </div>
        </section>
        `,
    },
    "section-teams-3": {
        html: `
        <style>
            .section-teams-3-content {
            padding: 50px 20px;
            background-color: #e9ecef;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            max-width: 700px;
            margin: auto;
            }
            .section-teams-3-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #343a40; text-align: center; }
            .section-teams-3-content .team-list { }
            .section-teams-3-content .team-list-item {
            display: flex;
            align-items: center;
            gap: 20px;
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 15px;
            }
            .section-teams-3-content .team-list-item img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
            border: 2px solid #6c757d;
            }
            .section-teams-3-content .team-list-info h3 { font-size: 1.3em; margin-bottom: 3px; color: #333; }
            .section-teams-3-content .team-list-info p { font-size: 0.9em; color: #777; margin-bottom: 0; }
        </style>
        <section class="section-teams-3-content" id="teams-section-3-example">
            <h2>Our Talented Team</h2>
            <div class="team-list">
            <div class="team-list-item">
                <img src="https://assets.aktools.net/image-stocks/portrait/portrait-4.jpg" alt="Emily White">
                <div class="team-list-info">
                <h3>Emily White</h3>
                <p>Project Manager</p>
                </div>
            </div>
            <div class="team-list-item">
                <img src="https://assets.aktools.net/image-stocks/portrait/portrait-1.jpg" alt="David Green">
                <div class="team-list-info">
                <h3>David Green</h3>
                <p>Senior Developer</p>
                </div>
            </div>
            <div class="team-list-item">
                <img src="https://assets.aktools.net/image-stocks/portrait/portrait-3.jpg" alt="Sarah Brown">
                <div class="team-list-info">
                <h3>Sarah Brown</h3>
                <p>UX/UI Designer</p>
                </div>
            </div>
            </div>
        </section>
        `,
    },

    "section-testimonials-1": {
        html: `
        <style>
            .section-testimonials-1-content {
            padding: 50px 20px;
            background-color: #fefefe;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-testimonials-1-content h2 { font-size: 2.5em; margin-bottom: 40px; color: #343a40; }
            .section-testimonials-1-content .testimonial-grid { display: flex; flex-wrap: wrap; gap: 25px; justify-content: center; }
            .section-testimonials-1-content .testimonial-item {
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            flex: 1 1 300px;
            max-width: 400px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #0d6efd;
            text-align: left;
            }
            .section-testimonials-1-content .testimonial-item p { font-style: italic; font-size: 1.1em; color: #555; margin-bottom: 20px; line-height: 1.6; }
            .section-testimonials-1-content .testimonial-item .author-info { display: flex; align-items: center; gap: 15px; }
            .section-testimonials-1-content .testimonial-item .author-info img { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid #0d6efd; }
            .section-testimonials-1-content .testimonial-item .author-details h4 { margin: 0; font-size: 1.2em; color: #333; }
            .section-testimonials-1-content .testimonial-item .author-details span { font-size: 0.9em; color: #777; }
        </style>
        <section class="section-testimonials-1-content" id="testimonials-section-1-example">
            <h2>What Our Clients Say</h2>
            <div class="testimonial-grid">
            <div class="testimonial-item">
                <p>"Absolutely thrilled with the results! The team went above and beyond to deliver exactly what we needed."</p>
                <div class="author-info">
                <img src="https://assets.aktools.net/image-stocks/portrait/portrait-1.jpg" alt="Client 1">
                <div class="author-details">
                    <h4>Client Name One</h4>
                    <span>CEO, Company A</span>
                </div>
                </div>
            </div>
            <div class="testimonial-item">
                <p>"Professional, efficient, and incredibly creative. Our project was a huge success thanks to their expertise."</p>
                <div class="author-info">
                <img src="https://assets.aktools.net/image-stocks/portrait/portrait-2.jpg" alt="Client 2">
                <div class="author-details">
                    <h4>Client Name Two</h4>
                    <span>Marketing Director, Company B</span>
                </div>
                </div>
            </div>
            </div>
        </section>
        `,
    },
    "section-testimonials-2": {
        html: `
        <style>
            .section-testimonials-2-content {
            padding: 60px 20px;
            background-color: #e6f7ff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            max-width: 800px;
            margin: auto;
            }
            .section-testimonials-2-content h2 { font-size: 2.5em; margin-bottom: 40px; color: #0d6efd; }
            .section-testimonials-2-content .testimonial-quote {
            font-size: 1.8em;
            font-style: italic;
            line-height: 1.4;
            color: #343a40;
            margin-bottom: 30px;
            position: relative;
            }
            .section-testimonials-2-content .testimonial-quote::before {
            content: '"';
            font-size: 4em;
            color: #a8dadc;
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0.7;
            }
            .section-testimonials-2-content .testimonial-author {
            font-size: 1.3em;
            font-weight: 600;
            color: #555;
            }
            .section-testimonials-2-content .testimonial-author span {
            font-size: 0.9em;
            font-weight: normal;
            color: #777;
            display: block;
            margin-top: 5px;
            }
        </style>
        <section class="section-testimonials-2-content" id="testimonials-section-2-example">
            <h2>Hear From Our Community</h2>
            <p class="testimonial-quote">"Working with them has been a truly exceptional experience. Their dedication and expertise are unmatched. Highly recommend!"</p>
            <p class="testimonial-author">Alex P. <span>- CTO, Tech Solutions</span></p>
        </section>
        `,
    },

    "section-stats-1": {
        html: `
        <style>
            .section-stats-1-content {
            padding: 60px 20px;
            background-color: #e6f7ff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-stats-1-content h2 { font-size: 2.5em; margin-bottom: 40px; color: #0d6efd; }
            .section-stats-1-content .stats-grid { display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; }
            .section-stats-1-content .stat-item {
            flex: 1 1 200px;
            max-width: 280px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            }
            .section-stats-1-content .stat-item .stat-number { font-size: 3.5em; font-weight: 700; color: #0d6efd; margin-bottom: 5px; line-height: 1.1; }
            .section-stats-1-content .stat-item .stat-label { font-size: 1.2em; color: #6c757d; text-transform: uppercase; letter-spacing: 0.5px; }
        </style>
        <section class="section-stats-1-content" id="stats-section-1-example">
            <h2>Our Achievements in Numbers</h2>
            <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">250+</div>
                <div class="stat-label">Projects Completed</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">100%</div>
                <div class="stat-label">Satisfaction Rate</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">10K+</div>
                <div class="stat-label">Cups of Coffee</div>
            </div>
            </div>
        </section>
        `,
    },
    "section-stats-2": {
        html: `
        <style>
            .section-stats-2-content {
            padding: 60px 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-stats-2-content h2 { font-size: 2.5em; margin-bottom: 40px; color: #343a40; }
            .section-stats-2-content .stats-grid-icon { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; justify-content: center; }
            .section-stats-2-content .stat-item-icon {
            padding: 25px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-bottom: 3px solid #28a745;
            }
            .section-stats-2-content .stat-item-icon .bi { font-size: 3.5em; color: #28a745; margin-bottom: 15px; }
            .section-stats-2-content .stat-item-icon .stat-number { font-size: 2.5em; font-weight: 700; color: #333; margin-bottom: 5px; line-height: 1.1; }
            .section-stats-2-content .stat-item-icon .stat-label { font-size: 1em; color: #6c757d; }
        </style>
        <section class="section-stats-2-content" id="stats-section-2-example">
            <h2>Driving Impact Together</h2>
            <div class="stats-grid-icon">
            <div class="stat-item-icon">
                <i class="bi bi-person-check-fill"></i>
                <div class="stat-number">500+</div>
                <div class="stat-label">Happy Clients</div>
            </div>
            <div class="stat-item-icon">
                <i class="bi bi-graph-up"></i>
                <div class="stat-number">20%</div>
                <div class="stat-label">Average Growth</div>
            </div>
            <div class="stat-item-icon">
                <i class="bi bi-clock-fill"></i>
                <div class="stat-number">5+</div>
                <div class="stat-label">Years Experience</div>
            </div>
            <div class="stat-item-icon">
                <i class="bi bi-currency-dollar"></i>
                <div class="stat-number">Millions</div>
                <div class="stat-label">Revenue Generated</div>
            </div>
            </div>
        </section>
        `,
    },
    "section-stats-3": {
        html: `
        <style>
            .section-stats-3-content {
            padding: 60px 20px;
            background-color: #f7faff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-stats-3-content h2 { font-size: 2.5em; margin-bottom: 40px; color: #007bff; }
            .section-stats-3-content .stats-grid-iso { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; justify-content: center; }
            .section-stats-3-content .stat-item-iso {
            padding: 25px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
            }
            .section-stats-3-content .stat-item-iso img {
            max-width: 100px;
            height: auto;
            margin-bottom: 15px;
            }
            .section-stats-3-content .stat-item-iso .stat-number { font-size: 2.8em; font-weight: 700; color: #007bff; margin-bottom: 5px; line-height: 1.1; }
            .section-stats-3-content .stat-item-iso .stat-label { font-size: 1.1em; color: #6c757d; }
        </style>
        <section class="section-stats-3-content" id="stats-section-3-example">
            <h2>Key Metrics</h2>
            <div class="stats-grid-iso">
            <div class="stat-item-iso">
                <img src="https://assets.aktools.net/image-stocks/isometrics/iso-stat-1.svg" alt="Visitors Icon">
                <div class="stat-number">1.2M+</div>
                <div class="stat-label">Website Visitors</div>
            </div>
            <div class="stat-item-iso">
                <img src="https://assets.aktools.net/image-stocks/isometrics/iso-stat-2.svg" alt="Downloads Icon">
                <div class="stat-number">500K+</div>
                <div class="stat-label">App Downloads</div>
            </div>
            <div class="stat-item-iso">
                <img src="https://assets.aktools.net/image-stocks/isometrics/iso-stat-3.svg" alt="Users Icon">
                <div class="stat-number">90K+</div>
                <div class="stat-label">Active Users</div>
            </div>
            </div>
        </section>
        `,
    },

    "section-faq-1": {
        html: `
        <style>
            .section-faq-1-content {
            padding: 50px 20px;
            background-color: #fdfdfd;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-faq-1-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #343a40; }
            .section-faq-1-content .faq-container { max-width: 700px; margin: 0 auto; text-align: left; }
            .section-faq-1-content .faq-item {
            background-color: #fff;
            border: 1px solid #eee;
            border-radius: 5px;
            margin-bottom: 15px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            }
            .section-faq-1-content .faq-item h5 { font-size: 1.2em; color: #0d6efd; margin-bottom: 10px; }
            .section-faq-1-content .faq-item p { font-size: 1em; color: #6c757d; line-height: 1.6; }
        </style>
        <section class="section-faq-1-content" id="faq-section-1-example">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-container">
            <div class="faq-item">
                <h5>How can I get started?</h5>
                <p>You can begin by contacting us through our website or by calling our support line. Our team will guide you through the process.</p>
            </div>
            <div class="faq-item">
                <h5>What payment methods do you accept?</h5>
                <p>We accept all major credit cards, PayPal, and bank transfers for your convenience.</p>
            </div>
            <div class="faq-item">
                <h5>Do you offer support after project completion?</h5>
                <p>Yes, we provide ongoing support and maintenance packages to ensure your project continues to run smoothly.</p>
            </div>
            </div>
        </section>
        `,
    },
    "section-faq-2": {
        html: `
        <style>
            .section-faq-2-content {
            padding: 50px 20px;
            background-color: #f2f7ff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-faq-2-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #0d6efd; }
            .section-faq-2-content .accordion-container { max-width: 800px; margin: 0 auto; text-align: left; }
            .section-faq-2-content .accordion-item {
            border: 1px solid rgba(0,0,0,.125);
            border-radius: 0.25rem;
            margin-bottom: 10px;
            }
            .section-faq-2-content .accordion-header .accordion-button {
            background-color: #fff;
            color: #333;
            font-weight: 600;
            font-size: 1.1em;
            }
            .section-faq-2-content .accordion-body {
            font-size: 1em;
            line-height: 1.6;
            color: #666;
            }
        </style>
        <section class="section-faq-2-content" id="faq-section-2-example">
            <h2>Common Questions</h2>
            <div class="accordion-container">
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    What is your refund policy?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                    We offer a 30-day money-back guarantee for all our services. If you're not satisfied, simply contact us for a full refund.
                    </div>
                </div>
                </div>
                <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    How long does a typical project take?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                    Project timelines vary depending on complexity and scope. We'll provide an estimated timeline after our initial consultation.
                    </div>
                </div>
                </div>
                <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Can I customize a service package?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                    Absolutely! We offer flexible and customizable service packages to perfectly align with your specific requirements.
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>
        `,
    },
    "section-faq-3": {
        html: `
        <style>
            .section-faq-3-content {
            padding: 50px 20px;
            background-color: #f8f8f8;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-faq-3-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #343a40; }
            .section-faq-3-content .faq-grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1000px;
            margin: auto;
            text-align: left;
            }
            .section-faq-3-content .faq-col-item {
            background-color: #fff;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-left: 3px solid #f0ad4e; /* Orange accent */
            }
            .section-faq-3-content .faq-col-item h5 { font-size: 1.3em; color: #333; margin-bottom: 10px; }
            .section-faq-3-content .faq-col-item p { font-size: 0.95em; line-height: 1.6; color: #666; margin-bottom: 0; }
        </style>
        <section class="section-faq-3-content" id="faq-section-3-example">
            <h2>Need Help? Browse Our FAQ.</h2>
            <div class="faq-grid-container">
            <div class="faq-col-item">
                <h5>General Questions</h5>
                <p>Find answers to common inquiries about our services, company, and operations.</p>
            </div>
            <div class="faq-col-item">
                <h5>Technical Support</h5>
                <p>Solutions for technical issues, troubleshooting guides, and system requirements.</p>
            </div>
            <div class="faq-col-item">
                <h5>Billing & Payments</h5>
                <p>Information regarding invoices, subscription management, and payment options.</p>
            </div>
            <div class="faq-col-item">
                <h5>Account Management</h5>
                <p>Help with managing your profile, settings, and other account-related details.</p>
            </div>
            </div>
        </section>
        `,
    },

    "section-pricing-1": {
        html: `
        <style>
            .section-pricing-1-content {
            padding: 50px 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-pricing-1-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #343a40; }
            .section-pricing-1-content .pricing-grid { display: flex; flex-wrap: wrap; gap: 25px; justify-content: center; }
            .section-pricing-1-content .price-card {
            flex: 1 1 280px; max-width: 350px;
            border: 1px solid #e0e0e0; border-radius: 8px; padding: 30px; background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .section-pricing-1-content .price-card.featured { transform: scale(1.05); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); border-color: #0d6efd; z-index: 1; }
            .section-pricing-1-content .price-card:hover { transform: translateY(-5px); box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15); }
            .section-pricing-1-content .price-card h3 { font-size: 1.8em; color: #0d6efd; margin-bottom: 15px; font-weight: 600; }
            .section-pricing-1-content .price-card .price { font-size: 3em; font-weight: bold; color: #333; margin-bottom: 10px; }
            .section-pricing-1-content .price-card .price span { font-size: 0.6em; font-weight: normal; color: #6c757d; }
            .section-pricing-1-content .price-card ul { list-style: none; padding: 0; text-align: center; margin-bottom: 25px; }
            .section-pricing-1-content .price-card ul li { margin-bottom: 10px; color: #555; font-size: 1em; }
            .section-pricing-1-content .price-card ul li i { margin-right: 8px; color: #28a745; }
            .section-pricing-1-content .price-card .btn-primary { background-color: #0d6efd; border-color: #0d6efd; padding: 10px 25px; font-size: 1.05em; font-weight: 600; border-radius: 50px; }
            .section-pricing-1-content .price-card .btn-primary:hover { background-color: #0b5ed7; border-color: #0a58ca; }
            .section-pricing-1-content .price-card.featured .btn-primary { background-color: #28a745; border-color: #28a745; }
            .section-pricing-1-content .price-card.featured .btn-primary:hover { background-color: #218838; border-color: #1e7e34; }
        </style>
        <section class="section-pricing-1-content" id="pricing-section-1-example">
            <h2>Flexible Pricing Plans</h2>
            <div class="pricing-grid">
            <div class="price-card">
                <h3>Basic</h3>
                <div class="price">$19<span>/month</span></div>
                <ul>
                <li><i class="bi bi-check-circle-fill"></i> 5 Projects</li>
                <li><i class="bi bi-check-circle-fill"></i> 10 GB Storage</li>
                <li><i class="bi bi-check-circle-fill"></i> Basic Support</li>
                <li><i class="bi bi-x-circle-fill text-danger"></i> Custom Domain</li>
                </ul>
                <button class="btn btn-primary">Choose Plan</button>
            </div>
            <div class="price-card featured">
                <h3>Pro</h3>
                <div class="price">$49<span>/month</span></div>
                <ul>
                <li><i class="bi bi-check-circle-fill"></i> Unlimited Projects</li>
                <li><i class="bi bi-check-circle-fill"></i> 100 GB Storage</li>
                <li><i class="bi bi-check-circle-fill"></i> Priority Support</li>
                <li><i class="bi bi-check-circle-fill"></i> Custom Domain</li>
                </ul>
                <button class="btn btn-primary">Choose Plan</button>
            </div>
            <div class="price-card">
                <h3>Enterprise</h3>
                <div class="price">$99<span>/month</span></div>
                <ul>
                <li><i class="bi bi-check-circle-fill"></i> All Pro Features</li>
                <li><i class="bi bi-check-circle-fill"></i> Dedicated Server</li>
                <li><i class="bi bi-check-circle-fill"></i> 24/7 Support</li>
                <li><i class="bi bi-check-circle-fill"></i> Advanced Analytics</li>
                </ul>
                <button class="btn btn-primary">Choose Plan</button>
            </div>
            </div>
        </section>
        `,
    },
    "section-pricing-2": {
        html: `
        <style>
            .section-pricing-2-content {
            padding: 50px 20px;
            background-color: #f7faff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-pricing-2-content h2 { font-size: 2.5em; margin-bottom: 30px; color: #007bff; }
            .section-pricing-2-content .pricing-table-container { max-width: 900px; margin: auto; overflow-x: auto; }
            .section-pricing-2-content .pricing-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            .section-pricing-2-content .pricing-table th,
            .section-pricing-2-content .pricing-table td {
            border: 1px solid #e0e0e0;
            padding: 15px;
            vertical-align: middle;
            }
            .section-pricing-2-content .pricing-table thead th { background-color: #e9ecef; color: #343a40; font-weight: 600; font-size: 1.1em; }
            .section-pricing-2-content .pricing-table tbody tr:nth-child(odd) { background-color: #fcfcfc; }
            .section-pricing-2-content .pricing-table .feature-col { text-align: left; color: #555; font-weight: 500; }
            .section-pricing-2-content .pricing-table .price-col { font-size: 1.3em; font-weight: bold; color: #0d6efd; }
            .section-pricing-2-content .pricing-table .price-col span { font-size: 0.7em; font-weight: normal; color: #6c757d; }
            .section-pricing-2-content .pricing-table .text-success { color: #28a745; font-size: 1.2em; }
            .section-pricing-2-content .pricing-table .text-danger { color: #dc3545; font-size: 1.2em; }
            .section-pricing-2-content .pricing-table .btn { padding: 8px 18px; font-size: 0.9em; border-radius: 50px; }
        </style>
        <section class="section-pricing-2-content" id="pricing-section-2-example">
            <h2>Compare Our Plans</h2>
            <div class="pricing-table-container">
            <table class="pricing-table">
                <thead>
                <tr>
                    <th>Features</th>
                    <th>Starter</th>
                    <th>Pro</th>
                    <th>Premium</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="feature-col">Monthly Price</td>
                    <td class="price-col">$9<span>/mo</span></td>
                    <td class="price-col">$29<span>/mo</span></td>
                    <td class="price-col">$79<span>/mo</span></td>
                </tr>
                <tr>
                    <td class="feature-col">Users</td>
                    <td>1</td>
                    <td>5</td>
                    <td>Unlimited</td>
                </tr>
                <tr>
                    <td class="feature-col">Storage</td>
                    <td>10 GB</td>
                    <td>100 GB</td>
                    <td>1 TB</td>
                </tr>
                <tr>
                    <td class="feature-col">Email Support</td>
                    <td><i class="bi bi-check-circle-fill text-success"></i></td>
                    <td><i class="bi bi-check-circle-fill text-success"></i></td>
                    <td><i class="bi bi-check-circle-fill text-success"></i></td>
                </tr>
                <tr>
                    <td class="feature-col">Phone Support</td>
                    <td><i class="bi bi-x-circle-fill text-danger"></i></td>
                    <td><i class="bi bi-check-circle-fill text-success"></i></td>
                    <td><i class="bi bi-check-circle-fill text-success"></i></td>
                </tr>
                <tr>
                    <td class="feature-col">Analytics</td>
                    <td><i class="bi bi-x-circle-fill text-danger"></i></td>
                    <td>Basic</td>
                    <td>Advanced</td>
                </tr>
                <tr>
                    <td class="feature-col">Custom Branding</td>
                    <td><i class="bi bi-x-circle-fill text-danger"></i></td>
                    <td><i class="bi bi-x-circle-fill text-danger"></i></td>
                    <td><i class="bi bi-check-circle-fill text-success"></i></td>
                </tr>
                <tr>
                    <td class="feature-col"></td>
                    <td><button class="btn btn-outline-primary">Choose</button></td>
                    <td><button class="btn btn-primary">Choose</button></td>
                    <td><button class="btn btn-outline-primary">Choose</button></td>
                </tr>
                </tbody>
            </table>
            </div>
        </section>
        `,
    },
    "section-pricing-3": {
        html: `
        <style>
            .section-pricing-3-content {
            padding: 50px 20px;
            background-color: #fefefe;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            }
            .section-pricing-3-content h2 { font-size: 2.5em; margin-bottom: 20px; color: #343a40; }
            .section-pricing-3-content p.lead { font-size: 1.1em; margin-bottom: 40px; color: #666; max-width: 700px; margin-left: auto; margin-right: auto; }
            .section-pricing-3-content .pricing-options {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            }
            .section-pricing-3-content .pricing-option-card {
            flex: 1 1 300px;
            max-width: 400px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            padding: 35px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: left;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            }
            .section-pricing-3-content .pricing-option-card:hover { transform: translateY(-10px); box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15); }
            .section-pricing-3-content .pricing-option-card .badge { margin-bottom: 15px; font-size: 0.9em; padding: 7px 15px; border-radius: 50px; display: inline-block; }
            .section-pricing-3-content .pricing-option-card h3 { font-size: 2em; margin-bottom: 10px; color: #343a40; }
            .section-pricing-3-content .pricing-option-card .price { font-size: 3.5em; font-weight: bold; color: #0d6efd; margin-bottom: 15px; }
            .section-pricing-3-content .pricing-option-card .price span { font-size: 0.5em; font-weight: normal; color: #6c757d; }
            .section-pricing-3-content .pricing-option-card ul { list-style: none; padding: 0; margin-bottom: 30px; }
            .section-pricing-3-content .pricing-option-card ul li { margin-bottom: 10px; color: #555; font-size: 1em; display: flex; align-items: center; }
            .section-pricing-3-content .pricing-option-card ul li i { margin-right: 10px; color: #28a745; }
            .section-pricing-3-content .pricing-option-card .btn-outline-primary { width: 100%; padding: 12px; font-size: 1.1em; font-weight: 600; border-radius: 50px; }
            .section-pricing-3-content .pricing-option-card .btn-outline-primary:hover { background-color: #0d6efd; color: white; }
        </style>
        <section class="section-pricing-3-content" id="pricing-section-3-example">
            <h2>Choose Your Perfect Plan</h2>
            <p class="lead">Select the plan that best fits your business needs and budget. Upgrade or downgrade anytime.</p>
            <div class="pricing-options">
            <div class="pricing-option-card">
                <div>
                <span class="badge bg-secondary">Basic</span>
                <h3>Starter</h3>
                <div class="price">$29<span>/month</span></div>
                <ul>
                    <li><i class="bi bi-check-circle-fill"></i> 1 User Account</li>
                    <li><i class="bi bi-check-circle-fill"></i> 5 GB Cloud Storage</li>
                    <li><i class="bi bi-check-circle-fill"></i> Email Support</li>
                    <li><i class="bi bi-x-circle-fill text-danger"></i> Advanced Analytics</li>
                </ul>
                </div>
                <button class="btn btn-outline-primary">Select Plan</button>
            </div>
            <div class="pricing-option-card">
                <div>
                <span class="badge bg-primary">Popular</span>
                <h3>Professional</h3>
                <div class="price">$79<span>/month</span></div>
                <ul>
                    <li><i class="bi bi-check-circle-fill"></i> 5 User Accounts</li>
                    <li><i class="bi bi-check-circle-fill"></i> 100 GB Cloud Storage</li>
                    <li><i class="bi bi-check-circle-fill"></i> Priority Email & Chat Support</li>
                    <li><i class="bi bi-check-circle-fill"></i> Basic Analytics</li>
                </ul>
                </div>
                <button class="btn btn-primary">Select Plan</button>
            </div>
            <div class="pricing-option-card">
                <div>
                <span class="badge bg-success">Enterprise</span>
                <h3>Ultimate</h3>
                <div class="price">$199<span>/month</span></div>
                <ul>
                    <li><i class="bi bi-check-circle-fill"></i> Unlimited Users</li>
                    <li><i class="bi bi-check-circle-fill"></i> Unlimited Cloud Storage</li>
                    <li><i class="bi bi-check-circle-fill"></i> 24/7 Phone & Dedicated Support</li>
                    <li><i class="bi bi-check-circle-fill"></i> Advanced Analytics & Reporting</li>
                </ul>
                </div>
                <button class="btn btn-success">Select Plan</button>
            </div>
            </div>
        </section>
        `,
    },

    // Icons Libraries (Iframes)
    "block-icons-bootstrap": {
        html: `<div class="block-iframe-container"><p class="block-iframe-loading">Loading Bootstrap Icons...</p><iframe src="https://icons.getbootstrap.com/" title="Bootstrap Icons"></iframe></div>`,
        iframe: true,
    },
    "block-icons-remix": {
        html: `<div class="block-iframe-container"><p class="block-iframe-loading">Loading Remix Icons...</p><iframe src="https://remixicon.com/" title="Remix Icons"></iframe></div>`,
        iframe: true,
    },
    "block-icons-hero": {
        html: `<div class="block-iframe-container"><p class="block-iframe-loading">Loading Hero Icons...</p><iframe src="https://heroicons.com/" title="Hero Icons"></iframe></div>`,
        iframe: true,
    },
    "block-icons-feather": {
        html: `<div class="block-iframe-container"><p class="block-iframe-loading">Loading Feather Icons...</p><iframe src="https://feathericons.com/" title="Feather Icons"></iframe></div>`,
        iframe: true,
    },
    "block-icons-lucide": {
        html: `<div class="block-iframe-container"><p class="block-iframe-loading">Loading Lucide Icons...</p><iframe src="https://lucide.dev/icons/" title="Lucide Icons"></iframe></div>`,
        iframe: true,
    },

    // Embeds Blocks
    "block-map": {
        html: `
        <style>
            .block-map-content {
            height: 400px;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            border-radius: 5px;
            font-family: sans-serif;
            font-size: 1.2em;
            border: 1px solid #ccc;
            overflow: hidden;
            }
            .block-map-content iframe {
            width: 100%;
            height: 100%;
            border: none;
            }
        </style>
        <section class="block-map-content" id="block-map-example">
            <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.9916892523296!2d2.294481315674723!3d48.85837007928752!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e29648939c3%3A0xc3e1c6e1c2c3e1c2!2sEiffel%20Tower!5e0!3m2!1sen!2sfr!4v1678888888888!5m2!1sen!2sfr"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </section>
        `,
    },
    };

    // JavaScript for handling block selection and copying
    document.addEventListener("DOMContentLoaded", () => {
    const blockSidebar = document.querySelector(".block-sidebar");
    const blockDisplayArea = document.getElementById("block-display-area");

    // Configure Toastr
    toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "3000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };

    blockSidebar.addEventListener("click", (event) => {
        event.preventDefault(); // Prevent default link behavior

        const targetLink = event.target.closest("a[data-block-id]");
        if (targetLink) {
        // Remove active class from previously active link
        document
            .querySelectorAll(".block-sidebar ul li a")
            .forEach((link) => link.classList.remove("active-block"));

        // Add active class to the clicked link
        targetLink.classList.add("active-block");

        const blockId = targetLink.dataset.blockId;
        const block = blocks[blockId];

        if (block) {
            displayBlock(block.html, block.iframe);
        } else {
            blockDisplayArea.innerHTML =
            "<p class='text-danger'>Block not found.</p>";
        }
        }
    });

    function displayBlock(blockHtmlContent, isIframe = false) {
        blockDisplayArea.innerHTML = `
        <div class="block-container-display ${
            isIframe ? "is-iframe" : ""
        }" style="${isIframe ? "height: 100%;" : ""}">
            ${
            isIframe
                ? ""
                : `<button class="block-copy-button" aria-label="Copy Block HTML">
                    <i class="bi bi-files"></i>
                </button>`
            }
            ${blockHtmlContent}
        </div>
        `;

        // Add event listener for the copy button if not an iframe
        if (!isIframe) {
        const copyButton =
            blockDisplayArea.querySelector(".block-copy-button");
        if (copyButton) {
            copyButton.addEventListener("click", () => {
            copyBlockHtmlToClipboard(blockHtmlContent);
            });
        }
        }

        // Adjust display area for iframes
        if (isIframe) {
        blockDisplayArea.style.padding = "0"; // Remove padding for full iframe width/height
        blockDisplayArea.style.height = "100%";
        } else {
        blockDisplayArea.style.padding = "1rem"; // Restore default padding
        blockDisplayArea.style.height = "auto";
        }
    }

    function copyBlockHtmlToClipboard(htmlContent) {
        navigator.clipboard
        .writeText(htmlContent.trim()) // Trim whitespace for clean copy
        .then(() => {
            toastr.success("Block HTML copied to clipboard!");
        })
        .catch((err) => {
            console.error("Failed to copy HTML: ", err);
            toastr.error(
            "Failed to copy HTML. Please try again or copy manually."
            );
        });
    }
    });
</script>
