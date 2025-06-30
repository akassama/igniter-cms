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

//popup settings
$currentPage = "home";
$popUpWhereClause = ['status' => 1];
$showOnPages = getTableData('announcement_popups', $popUpWhereClause, 'show_on_pages');
$enablePopupAds = getConfigData("EnablePopupAds");

//Get social model lists
$socialsModel = new \App\Models\SocialsModel();
$socialLinksQuery = $socialsModel->orderBy('order', 'ASC')->findAll();
?>

<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
<!-- ////// BEGIN Page ///// -->
<?php if($home_pages): ?>
    <?php foreach($home_pages as $home_page): ?>
        <?php
            $section = $home_page['section'];
            $sectionTitle = $home_page['section_title'];
            $sectionDescription = $home_page['section_description'];
            $contentBlocks = $home_page['content_blocks'];

            // Display different HTML sections based on the 'section' field
            if ($section === "HomeHero") {
                ?>
                    <!-- Hero Section -->
                    <section id="home" class="hero">
                        <div class="container">
                            <div class="row align-items-center mt-sm-5">
                                <div class="col-lg-6" data-aos="fade-right">
                                    <div class="hero-content">
                                        <h1>My name is <?= $resume['full_name'] ?></h1>
                                        <p class="subtitle"><?= $resume['title'] ?></p>
                                        <p class="text-white-75 mb-4"><?= $resume['summary'] ?></p>
                                        <div class="d-flex gap-3 flex-wrap">
                                            <a href="#portfolio" class="btn btn-primary">View My Work</a>
                                            <a href="#contact" class="btn btn-outline-light">Get In Touch</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 text-center" data-aos="fade-left">
                                    <img src="<?= getImageUrl($resume['image'] ?? getDefaultImagePath()); ?>" alt="Profile" class="hero-image">
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
                    <!-- /Hero Section -->
                <?php
            } elseif ($section === "HomeAbout") {
                ?>
                <!-- About Section -->
                <section id="about" class="section">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6" data-aos="fade-right">
                                <img src="<?= getImageUrl($resume['additional_image'] ?? getDefaultImagePath()); ?>" alt="About Me" class="img-fluid rounded">
                            </div>
                            <div class="col-lg-6" data-aos="fade-left">
                                <h2 class="section-title text-start"><?=$sectionTitle?></h2>
                                <p class="lead"><?=$sectionDescription?></p>
                                <div class="row mt-4">
                                    <div class="col-6">
                                        <h5><i class="ri-calendar-line text-primary me-2"></i>Age</h5>
                                        <p><?= calculateAge($resume['dob'])?> Years</p>
                                    </div>
                                    <div class="col-6">
                                        <h5><i class="ri-map-pin-line text-primary me-2"></i>Location</h5>
                                        <p><?=$resume['address']?></p>
                                    </div>
                                    <div class="col-6">
                                        <h5><i class="ri-mail-line text-primary me-2"></i>Email</h5>
                                        <p><?=$resume['email']?></p>
                                    </div>
                                    <div class="col-6">
                                        <h5><i class="ri-phone-line text-primary me-2"></i>Phone</h5>
                                        <p><?=$resume['phone']?></p>
                                    </div>
                                </div>
                                <a href="#contact" class="btn btn-primary mt-3">Hire Me</a>
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
                <!-- /About Section -->
                <?php
            } elseif ($section === "Services") {
                ?>
                    <!-- Services Section -->
                    <section id="services" class="section">
                        <div class="container">
                            <h2 class="section-title" data-aos="fade-up"><?=$sectionTitle?></h2>
                            <div class="row justify-content-center">
                                <?php if($services): ?>
                                    <?php foreach($services as $index => $service): ?>
                                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
                                            <div class="card h-100 text-center">
                                                <div class="card-body">
                                                    <i class="<?= $service['icon'] ?? 'ri-code-s-slash-line'; ?> display-4 text-primary mb-3"></i>
                                                    <h5 class="card-title"><?= $service['title'] ?? 'Service Title'; ?></h5>
                                                    <p class="card-text"><?= $service['description'] ?? 'Service description.'; ?></p>
                                                    <?php if(!empty($service['link'])): ?>
                                                        <a href="<?= $service['link']; ?>" class="btn btn-outline-primary" target="<?= $service['new_tab'] == 1 ? '_blank' : '_self' ?>">Read More</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <?php
                                //display content block if it exists
                                if(!empty($contentBlocks)){
                                    renderContentBlocks($contentBlocks);
                                }
                            ?>
                        </div>
                    </section>
                    <!-- /Services Section -->
                <?php
            } elseif ($section === "Resume") {
                ?>
                <!-- Resume Section -->
                <section id="resume" class="section bg-light">
                    <div class="container">
                        <h2 class="section-title" data-aos="fade-up"><?=$sectionTitle?></h2>
                        <div class="row">
                            <div class="col-lg-6" data-aos="fade-right">
                                <h3 class="mb-4"><i class="ri-briefcase-line text-primary me-2"></i>Work Experience</h3>
                                <div class="timeline">
                                    <?php if($resume_experiences): ?>
                                        <?php foreach($resume_experiences as $resume_experience): ?>
                                            <!-- Experience Lists -->
                                            <div class="card mb-4">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?=$resume_experience['position']?></h5>
                                                    <h6 class="card-subtitle mb-2 text-muted"><?=$resume_experience['company_name']?> | <?= dateFormat($resume_experience['start_date'], 'Y')?> - <?= $resume_experience['current_job'] ? "Present" : dateFormat($resume_experience['end_date'], 'Y') ?? "Present" ?></h6>
                                                    <p class="card-text"><?= getTextSummary($resume_experience['achievements'], 75)?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-6" data-aos="fade-left">
                                <h3 class="mb-4"><i class="ri-graduation-cap-line text-primary me-2"></i>Education</h3>
                                <div class="timeline">
                                    <?php if($resume_educations): ?>
                                        <?php foreach($resume_educations as $resume_education): ?>
                                            <!-- Education Lists -->
                                            <div class="card mb-4">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?=$resume_education['degree']?></h5>
                                                    <h6 class="card-subtitle mb-2 text-muted"><?=$resume_education['institution']?> | <?= dateFormat($resume_education['start_date'], 'Y')?> - <?= dateFormat($resume_education['end_date'], 'Y') ?? "Present"  ?></h6>
                                                    <p class="card-text"><?= getTextSummary($resume_education['activities'], 75)?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <h5 class="card-title">Certifications</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">My Certifications from Various Providers</h6>
                                            <ul class="mb-0">
                                                <?php
                                                    $certificationsArr = preg_split ("/\,/", $resume['certifications']);
                                                    foreach ($certificationsArr as $certification) {
                                                        echo "<li>$certification</li>";
                                                    }
                                                ?>
                                            </ul>
                                        </div>
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
                <!-- /Resume Section -->
                <?php
            }elseif ($section === "Skills") {
                ?>
                <!-- Skills Section -->
                <section id="skills" class="section">
                    <div class="container">
                        <h2 class="section-title" data-aos="fade-up"><?=$sectionTitle?></h2>
                        <div class="row">
                            <div class="col-lg-6" data-aos="fade-right">
                                <?php foreach($resume_skills as $index => $skill): ?>
                                    <?php if($index % 2 == 0): ?>
                                        <div class="skill-item">
                                            <div class="d-flex justify-content-between">
                                                <span class="skill-name"><?= $skill['name'] ?></span>
                                                <span><?= $skill['proficiency_level'] ?>%</span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: <?= $skill['proficiency_level'] ?>%"></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            
                            <div class="col-lg-6" data-aos="fade-left">
                                <?php foreach($resume_skills as $index => $skill): ?>
                                    <?php if($index % 2 != 0): ?>
                                        <div class="skill-item">
                                            <div class="d-flex justify-content-between">
                                                <span class="skill-name"><?= $skill['name'] ?></span>
                                                <span><?= $skill['proficiency_level'] ?>%</span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: <?= $skill['proficiency_level'] ?>%"></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
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
                <!-- /Stats Section -->
                <?php
            }  elseif ($section === "Counters") {
                ?>
                <!-- Stats Section -->
                <section id="stats" class="section bg-light">
                    <div class="container">
                        <h2 class="section-title" data-aos="fade-up"><?=$sectionTitle?></h2>
                        <div class="row justify-content-center">
                            <?php if($counters): ?>
                                <?php foreach($counters as $index => $counter): ?>
                                    <div class="col-lg-3 col-md-6 mb-4 stat-item" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
                                        <div class="stat-number" data-count="<?= $counter['final_value'] ?? 0; ?>"><?= $counter['initial_value'] ?? 0; ?></div>
                                        <p><?= $counter['title'] ?? 'Stat Title'; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Stats Section -->
                <?php
            } elseif ($section === "Pricing") {
                ?>
                <!-- Pricing Section -->
                <section id="pricing" class="section bg-light">
                    <div class="container">
                        <h2 class="section-title" data-aos="fade-up"><?=$sectionTitle?></h2>
                        <div class="row justify-content-center">
                            <?php if($pricings): ?>
                                <?php foreach($pricings as $index => $pricing): ?>
                                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
                                        <div class="pricing-card card text-center<?= $pricing['is_popular'] == 1 ? ' popular position-relative' : '' ?>">
                                            <?php if($pricing['is_popular'] == 1): ?>
                                                <span class="badge bg-primary">Popular</span>
                                            <?php endif; ?>
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $pricing['title'] ?? 'Plan Title'; ?></h5>
                                                <h3 class="my-3">$<?= $pricing['amount'] ?? '0'; ?><span class="text-muted fs-6">/ <?= $pricing['period'] ?? 'mo'; ?></span></h3>
                                                <ul class="list-unstyled mb-4">
                                                    <?php
                                                    if (!empty($pricing['included_features_list'])) {
                                                        $array = explode(",", $pricing['included_features_list']);
                                                        foreach ($array as $value) {
                                                            echo '<li>' . $value . '</li>';
                                                        }
                                                    }
                                                    if (!empty($pricing['excluded_features_list'])) {
                                                        $array = explode(",", $pricing['excluded_features_list']);
                                                        foreach ($array as $value) {
                                                            echo '<li class="text-muted">' . $value . '</li>';
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                                <?php if (!empty($pricing['link'])): ?>
                                                    <a href="<?= $pricing['link']; ?>" class="btn <?= $pricing['is_popular'] == 1 ? 'btn-primary' : 'btn-outline-primary' ?>" target="<?= $pricing['new_tab'] == 1 ? '_blank' : '_self' ?>"><?= $pricing['link_title'] ?? 'Choose Plan'; ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Pricing Section -->
                <?php
            } elseif ($section === "FrequentlyAskedQuestions") {
                ?>
                <!-- FAQ Section -->
                <section id="faq" class="section bg-light">
                    <div class="container">
                        <h2 class="section-title" data-aos="fade-up"><?=$sectionTitle?></h2>
                        <div class="accordion" id="faqAccordion" data-aos="fade-up" data-aos-delay="100">
                            <?php if($faqs): ?>
                                <?php $faqRowCount = 1; ?>
                                <?php foreach($faqs as $faq): ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqHeading<?= $faqRowCount; ?>">
                                            <button class="accordion-button<?= $faqRowCount == 1 ? '' : ' collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse<?= $faqRowCount; ?>">
                                                <?= $faq['question'] ?? 'FAQ Question'; ?>
                                            </button>
                                        </h2>
                                        <div id="faqCollapse<?= $faqRowCount; ?>" class="accordion-collapse collapse<?= $faqRowCount == 1 ? ' show' : '' ?>" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <?= $faq['answer'] ?? 'FAQ Answer'; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $faqRowCount++; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                        //display content block if it exists
                        if(!empty($contentBlocks)){
                            renderContentBlocks($contentBlocks);
                        }
                    ?>
                </section>
                <!-- /Faq Section -->
                <?php
            } elseif ($section === "Testimonials") {
                ?>
                <!-- Testimonials Section -->
                <section id="testimonials" class="section bg-light">
                    <div class="container">
                        <h2 class="section-title" data-aos="fade-up"><?=$sectionTitle?></h2>
                        <div class="row justify-content-center">
                            <?php if($testimonials): ?>
                                <?php foreach($testimonials as $index => $testimonial): ?>
                                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
                                        <div class="testimonial-card">
                                            <img src="<?=getImageUrl($testimonial['image'] ?? 'https://placehold.co/80x80/6366f1/ffffff?text=SM')?>" alt="<?= esc($testimonial['name'] ?? 'Client'); ?>" class="testimonial-avatar">
                                            <p class="mb-3">"<?= esc($testimonial['testimonial'] ?? 'Testimonial text'); ?>"</p>
                                            <h6 class="mb-0"><?= esc($testimonial['name'] ?? 'Client Name'); ?></h6>
                                            <small class="text-muted"><?= esc($testimonial['title'] ?? 'Title') . ', ' . esc($testimonial['company'] ?? 'Company'); ?></small>
                                            <div class="mt-2">
                                                <i class="ri-star-fill text-warning"></i>
                                                <i class="ri-star-fill text-warning"></i>
                                                <i class="ri-star-fill text-warning"></i>
                                                <i class="ri-star-fill text-warning"></i>
                                                <i class="ri-star-fill text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Testimonials Section -->
                <?php
            } elseif ($section === "Portfolio") {
                ?>
                <!-- Portfolio Section -->
                <section id="portfolio" class="section bg-light">
                    <div class="container">
                        <h2 class="section-title" data-aos="fade-up"><?=$sectionTitle?></h2>
                        <div class="row justify-content-center">
                            <?php if($portfolios): ?>
                                <?php foreach($portfolios as $index => $portfolio): ?>
                                    <?php if(strtolower($portfolio['group']) === "portfolio"): ?>
                                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
                                            <div class="portfolio-item">
                                                <img src="<?=getImageUrl($portfolio['featured_image'] ?? 'https://placehold.co/400x300/6366f1/ffffff?text=Portfolio')?>" alt="<?= $portfolio['title'] ?? 'Project'; ?>" class="img-fluid">
                                                <div class="portfolio-overlay">
                                                    <div class="text-center text-white">
                                                        <h5><?= $portfolio['title'] ?? 'Project Title'; ?></h5>
                                                        <p>Project Description</p>
                                                        <a href="<?= base_url('portfolio/'.$portfolio['slug']) ?>" class="btn btn-outline-light"><i class="ri-external-link-line"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- End Portfolio Section -->
                <?php
            } elseif ($section === "Team") {
                ?>
                <!-- Team Section -->
                <section id="teams" class="section">
                    <div class="container">
                        <h2 class="section-title" data-aos="fade-up"><?=$sectionTitle?></h2>
                        <div class="row justify-content-center">
                            <?php if($teams): ?>
                                <?php foreach($teams as $index => $team): ?>
                                    <div class="col-lg-4 col-md-4 mb-3" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
                                        <div class="card team-card">
                                            <img src="<?=getImageUrl($team['image'] ?? 'https://placehold.co/150x150?text=JD')?>" alt="<?= $team['name'] ?? 'Team Member'; ?>" class="img-fluid">
                                            <h5><?= $team['name'] ?? 'Team Member'; ?></h5>
                                            <p><?= $team['title'] ?? 'Role'; ?></p>
                                            <div class="team-social">
                                                <?php if(!empty($team['social_link_1'])): ?>
                                                    <a href="<?= $team['social_link_1'] ?>" class="text-decoration-none me-2"><i class="ri-facebook-fill"></i></a>
                                                <?php endif; ?>
                                                <?php if(!empty($team['social_link_2'])): ?>
                                                    <a href="<?= $team['social_link_2'] ?>" class="text-decoration-none me-2"><i class="ri-twitter-fill"></i></a>
                                                <?php endif; ?>
                                                <?php if(!empty($team['social_link_3'])): ?>
                                                    <a href="<?= $team['social_link_3'] ?>" class="text-decoration-none me-2"><i class="ri-instagram-fill"></i></a>
                                                <?php endif; ?>
                                                <?php if(!empty($team['social_link_4'])): ?>
                                                    <a href="<?= $team['social_link_4'] ?>" class="text-decoration-none me-2"><i class="ri-linkedin-fill"></i></a>
                                                <?php endif; ?>
                                                <?php if(!empty($team['social_link_5'])): ?>
                                                    <a href="<?= $team['social_link_5'] ?>" class="text-decoration-none me-2"><i class="ri-github-fill"></i></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Team Section -->
                <?php
            } elseif ($section === "Partners") {
                ?>
                <!-- Clients Section -->
                <section id="clients" class="section bg-light">
                    <div class="container">
                        <h2 class="section-title" data-aos="fade-up"><?=$sectionTitle?></h2>
                        <div class="text-center mb-4" data-aos="fade-up" data-aos-delay="100">
                            <p><?=$sectionDescription?></p>
                        </div>
                        <div class="row justify-content-center">
                            <?php if($partners): ?>
                                <?php foreach($partners as $index => $partner): ?>
                                    <div class="col-lg-2 col-md-4 col-4 mb-4" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
                                        <div class="client-logo">
                                            <img src="<?=getImageUrl($partner['logo'] ?? 'https://placehold.co/200x100/6366f1/ffffff?text=Client')?>" alt="<?= $partner['title'] ?? 'Client'; ?>" class="img-fluid">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Clients Section -->
                <?php
            } elseif ($section === "CallToAction") {
                ?>
                <!-- Call to Action Section -->
                <section id="cta" class="section">
                    <div class="container">
                        <div class="cta-section" data-aos="fade-up">
                            <h2 class="mb-4"><?=$sectionTitle?></h2>
                            <p class="mb-4"><?=$sectionDescription?></p>
                            <a href="#contact" class="btn btn-light">Get Started Now</a>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Call To Action Section -->
                <?php
            } elseif ($section === "RecentPosts") {
                ?>
                <!-- Blog Posts Section -->
                <section id="blog" class="section">
                    <div class="container">
                        <h2 class="section-title" data-aos="fade-up"><?=$sectionTitle?></h2>
                        <div class="row justify-content-center">
                            <?php if($blogs): ?>
                                <?php foreach($blogs as $index => $blog): ?>
                                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
                                        <div class="card blog-card">
                                            <img src="<?=getImageUrl($blog['featured_image'] ?? 'https://placehold.co/400x200/6366f1/ffffff?text=Blog')?>" alt="<?= $blog['title'] ?? 'Blog Title'; ?>" class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $blog['title'] ?? 'Blog Title'; ?></h5>
                                                <p class="card-text"><?= !empty($blog['excerpt']) ? getTextSummary($blog['excerpt']) : getTextSummary($blog['content'] ?? 'Blog content'); ?></p>
                                                <a href="<?= base_url('blog/'.$blog['slug']) ?>" class="btn btn-outline-primary mt-auto">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Recent Posts Section -->
                <?php
            } elseif ($section === "Subscribe") {
                ?>
                <!-- Subscribe Section -->
                <section id="subscribe" class="section">
                    <div class="container">
                        <div class="subscribe-section" data-aos="fade-up">
                            <h2 class="text-center mb-4"><?=$sectionTitle?></h2>
                            <p class="text-center mb-4"><?=$sectionDescription?></p>
                            <form action="<?= base_url('/api-form/add-subscriber') ?>" method="post" class="g-3 needs-validation d-flex justify-content-center gap-3 flex-wrap" id="subscribeForm">
                                <?= csrf_field() ?>
                                <?=getHoneypotInput()?>
                                <input type="hidden" class="form-control" name="return_url" id="return_url" placeholder="return url" value="<?=current_url()."?#subscribe"?>">
                                <input type="email" class="form-control w-auto" id="subscribeEmail" name="email" placeholder="Enter your email" required>
                                <button type="submit" class="btn btn-primary">Subscribe</button>
                                <?=renderHcaptcha()?>
                            </form>
                            <div class="row mt-4 small text-muted justify-content-center">We care about privacy, and will never share your data.</div>
                        </div>
                        <?php
                            //display content block if it exists
                            if(!empty($contentBlocks)){
                                renderContentBlocks($contentBlocks);
                            }
                        ?>
                    </div>
                </section>
                <!-- /Subscribe Section -->
                <?php
            }elseif ($section === "Custom") {
                ?>
                <!-- Custom Section -->
                <section class="py-2" id="custom" data-aos="fade-up">
                    <div class="container">
                        <div class="row gx-5 justify-content-center">
                            <div class="col-lg-8 col-xl-6">
                                <div class="text-center">
                                    <h2 class="fw-bolder"><?=$sectionTitle?></h2>
                                    <p class="lead fw-normal text-muted mb-5"><?=$sectionDescription?></p>
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
                <!-- /Subscribe Section -->
                <?php
            }  elseif ($section === "Contact") {
                ?>
                <!-- Contact Section -->
                <section id="contact" class="section">
                    <div class="container">
                        <h2 class="section-title" data-aos="fade-up"><?=$sectionTitle?></h2>
                        <div class="row">
                            <div class="col-lg-6 mb-4" data-aos="fade-right">
                                <div class="contact-info" style="min-height: 48rem">
                                    <h4 class="mb-4"><?=$sectionTitle?></h4>
                                    <p class="mb-4"><?=$sectionDescription?></p>
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
                <!-- /Contact Section -->
                <?php
            }
            ?>
    <?php endforeach; ?>
<?php endif; ?>
<!-- ////// END Page ///// -->

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


<?// ?>