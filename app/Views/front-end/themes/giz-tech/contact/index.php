<?php
// Get current theme
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
$contactTitle = getHomePageData("Contact", "section_title");
$contactDescription = getHomePageData("Contact", "section_description");

//popup settings
$currentPage = "contact";
$popUpWhereClause = ['status' => 1];
$showOnPages = getTableData('announcement_popups', $popUpWhereClause, 'show_on_pages');
$enablePopupAds = getConfigData("EnablePopupAds");
?>
<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<!-- Contact Section -->
<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light mt-md-3 mt-sm-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?=base_url()?>" class="text-decoration-none text-primary">Home</a></li>
                <li class="breadcrumb-item active text-secondary" aria-current="page">Contact Page</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Contact Page Content -->
<section id="contact" class="page py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-3"><?=$contactTitle?></h2>
                <p class="lead"><?=$contactDescription?></p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Contact Information</h4>
                        <div class="d-flex mb-4">
                            <div class="me-3 text-primary">
                                <i class="bi bi-chat-dots fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Chat with us</h5>
                                <p class="mb-0">Chat live with one of our support specialists.</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="me-3 text-primary">
                                <i class="bi bi-telephone fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Call us</h5>
                                <p class="mb-0">Call us during normal business hours at <?=$companyNumber?>.</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="me-3 text-primary">
                                <i class="bi bi-people fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Ask the community</h5>
                                <p class="mb-0">Explore our community forums and communicate with other users.</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="me-3 text-primary">
                                <i class="bi bi-question-circle fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Support center</h5>
                                <p class="mb-0"><a href="<?= base_url('/#faq') ?>">Browse FAQ's and support articles to find solutions.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Send Us a Message</h4>
                        <form action="<?= base_url('/api-form/send-contact-message') ?>" method="post" class="g-3 needs-validation" id="contactForm">
                            <?= csrf_field() ?>
                            <?=getHoneypotInput()?>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <div class="invalid-feedback">Please provide name</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Your Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback">Please provide email</div>
                                </div>
                                <div class="col-12">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                    <div class="invalid-feedback">Please provide phone number</div>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                    <div class="invalid-feedback">Please provide message</div>
                                </div>
                                
                                <!-- hcaptcha validation -->
                                <?=renderHcaptcha()?>
                                
                                <div class="col-12">
                                    <input type="hidden" class="form-control" name="return_url" id="return_url" value="<?=current_url()?>">
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Page Content -->
<!-- /Contact Section -->

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