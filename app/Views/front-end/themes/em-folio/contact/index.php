<?php
// Get current theme
$theme = getCurrentTheme();

//get site config values
$companyName = getConfigData("CompanyName");
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

//Get social model lists
$socialsModel = new \App\Models\SocialsModel();
$socialLinksQuery = $socialsModel->orderBy('order', 'ASC')->findAll();

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
    <section class="py-5" id="contact">
    <div class="container px-5">
        <!--Breadcrumb-->
        <div class="row mb-1">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact Page</li>
            </ol>
            </nav>
        </div>
        <section id="contact" class="section">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up"><?=$contactTitle?></h2>
                <div class="row">
                    <div class="col-lg-6 mb-4" data-aos="fade-right">
                        <div class="contact-info" style="min-height: 48rem">
                            <h4 class="mb-4"><?=$contactTitle?></h4>
                            <p class="mb-4"><?=$contactDescription?></p>
                            <div class="contact-item">
                                <i class="ri-map-pin-line"></i>
                                <div>
                                    <h6>Address</h6>
                                    <p><?= $companyAddress ?></p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="ri-phone-line"></i>
                                <div>
                                    <h6>Phone</h6>
                                    <p><?=$companyNumber ?></p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="ri-mail-line"></i>
                                <div>
                                    <h6>Email</h6>
                                    <p><?=$companyEmail?></p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="ri-time-line"></i>
                                <div>
                                    <h6>Availability</h6>
                                    <p><?=$companyOpeningHours?></p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <?php if($socialLinksQuery): ?>
                                    <?php foreach($socialLinksQuery as $social): ?>
                                        <?php
                                            $socialId = $social['social_id'];
                                            $name = $social['name'];
                                            $icon = $social['icon'];
                                            $link = getLinkUrl($social['link']);
                                            $newTab = $social['new_tab'];
                                            $navTarget = $newTab === "1" ? "_blank" : "_self";
                                        ?>
                                        <a href="<?=$link?>" target="<?=$navTarget?>" class="btn btn-outline-light me-2"><i class="<?=$icon?>"></i></a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="card" style="min-height: 48rem">
                            <div class="card-body">
                                <form action="<?= base_url('/api-form/send-contact-message') ?>" method="post" class="g-3 needs-validation" id="contactForm">
                                    <?= csrf_field() ?>
                                    <?=getHoneypotInput()?>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstName" name="name" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastName" name="last_name" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">Subject</label>
                                        <input type="text" class="form-control" id="subject" name="subject" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                    </div>
                                    <?=renderHcaptcha()?>
                                    <input type="hidden" class="form-control" name="return_url" id="return_url" value="<?=current_url('?#contact')?>">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-send-plane-line me-2"></i>Send Message
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    //display content block if it exists
                    if(!empty($contentBlocks)){
                        renderContentBlocks($contentBlocks);
                    }
                ?>
            </div>
        </section>
    </div>
    </section>
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