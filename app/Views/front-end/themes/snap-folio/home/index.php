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

//page settings
$currentPage = "home";
$popUpWhereClause = ['status' => 1];
?>

<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
<!-- Page Title -->
<div class="page-title dark-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-1 mb-lg-0">
            <a class="navbar-brand" href="<?= base_url('/')?>">
                <img src="<?=getImageUrl(getConfigData("SiteLogoLink") ?? getDefaultImagePath())?>" alt="<?=getConfigData("SiteLogoLink")?> Logo" class="border border-dark rounded" height="60">
            </a>
        </h1>
        <nav class="breadcrumbs">
        <ol>
            <li><a href="<?=base_url()?>">Home</a></li>
        </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->

<!-- Hero Section -->
<section id="hero" class="hero section">
  <div class="background-elements">
    <div class="bg-circle circle-1"></div>
    <div class="bg-circle circle-2"></div>
  </div>

  <div class="hero-content">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
          <div class="hero-text">
            <h1>Abdoulie<span class="accent-text">Kassama</span></h1>
            <h2>Software Engineer</h2>
            <p class="lead">
              I'm a
              <span
                class="typed"
                data-typed-items="Software Engineer, Enterprise Developer, Full-Stack Developer, System Architect"
              ></span>
            </p>
            <p class="description">
              Experienced software engineer specializing in enterprise system integrations and full-stack development. 
              Passionate about creating efficient solutions that drive business productivity and digital transformation.
            </p>

            <div class="hero-actions">
              <a href="#portfolio" class="btn btn-primary">View My Work</a>
              <a href="#contact" class="btn btn-outline">Get In Touch</a>
            </div>

            <div class="social-links">
              <a href="https://github.com/akassama"><i class="bi bi-github"></i></a>
              <a href="https://linkedin.com/in/akassama"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
          <div class="hero-visual">
            <div class="profile-container">
              <div class="profile-background"></div>
              <img
                src="<?=base_url('public/uploads/files/ak-resume-profile-1-dark.webp')?>"
                alt="Abdoulie Kassama"
                class="profile-image"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Hero Section -->

<!-- About Section -->
<section id="about" class="about section">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row">
      <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="200">
        <div class="profile-card">
          <div class="profile-header">
            <div class="profile-image">
              <img
                src="<?=base_url('public/uploads/files/ak-resume-profile-2-dark.webp')?>"
                alt="Profile Image"
                class="img-fluid"
              />
            </div>
            <div class="profile-badge">
              <i class="bi bi-check-circle-fill"></i>
            </div>
          </div>

          <div class="profile-content">
            <h3>Abdoulie Kassama</h3>
            <p class="profession">Enterprise Systems Developer</p>

            <div class="contact-links">
              <a href="mailto:info@akassama.dev" class="contact-item">
                <i class="bi bi-envelope"></i>
                info@akassama.dev
              </a>
              <a href="#" class="contact-item">
                <i class="bi bi-geo-alt"></i>
                Hertfordshire, UK
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
        <div class="about-content">
          <div class="section-header">
            <span class="badge-text">Get to Know Me</span>
            <h2>Passionate About Building Enterprise Solutions</h2>
          </div>

          <div class="description">
            <p>
              Experienced Software Engineer with over 10 years of expertise in conceptualizing and implementing innovative software solutions that elevate business productivity. 
              Proficient in all facets of the software development lifecycle, with comprehensive skills in end-to-end project management.
            </p>

            <p>
              Specialized in enterprise system integrations and full-stack development across multiple platforms and technologies, 
              with a proven track record of delivering solutions that streamline operations and drive efficiency.
            </p>
          </div>

          <div class="stats-grid">
            <div class="stat-item">
              <div class="stat-number">10+</div>
              <div class="stat-label">Years Experience</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">50+</div>
              <div class="stat-label">Projects Completed</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">99%</div>
              <div class="stat-label">CClientustomer Satisfaction</div>
            </div>
          </div>

          <div class="details-grid">
            <div class="detail-row">
              <div class="detail-item">
                <span class="detail-label">Specialization</span>
                <span class="detail-value">Enterprise Integration & Full-Stack Development</span>
              </div>
              <div class="detail-item">
                <span class="detail-label">Experience Level</span>
                <span class="detail-value">Senior Professional</span>
              </div>
            </div>
            <div class="detail-row">
              <div class="detail-item">
                <span class="detail-label">Education</span>
                <span class="detail-value">MSc IT - Software Engineering</span>
              </div>
              <div class="detail-item">
                <span class="detail-label">Languages</span>
                <span class="detail-value">English (Fluent)</span>
              </div>
            </div>
          </div>

          <div class="cta-section">
            <a href="#" class="btn btn-primary">
              <i class="bi bi-download"></i>
              Download Resume
            </a>
            <a href="#contact" class="btn btn-outline">
              <i class="bi bi-chat-dots"></i>
              Let's Talk
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /About Section -->

<!-- Stats Section -->
<section id="stats" class="stats section light-background">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="stats-wrapper">
          <div class="stats-item" data-aos="zoom-in" data-aos-delay="150">
            <div class="icon-wrapper">
              <i class="bi bi-emoji-smile"></i>
            </div>
            <span
              data-purecounter-start="0"
              data-purecounter-end="150"
              data-purecounter-duration="1"
              class="purecounter"
            ></span>
            <p>Business Clients</p>
          </div>
          <!-- End Stats Item -->

          <div class="stats-item" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-wrapper">
              <i class="bi bi-journal-richtext"></i>
            </div>
            <span
              data-purecounter-start="0"
              data-purecounter-end="50"
              data-purecounter-duration="1"
              class="purecounter"
            ></span>
            <p>Projects</p>
          </div>
          <!-- End Stats Item -->

          <div class="stats-item" data-aos="zoom-in" data-aos-delay="250">
            <div class="icon-wrapper">
              <i class="bi bi-lightning-charge"></i>
            </div>
            <span
              data-purecounter-start="0"
              data-purecounter-end="85"
              data-purecounter-duration="1"
              class="purecounter"
            ></span>
            <p>Process Improvements</p>
          </div>
          <!-- End Stats Item -->

          <div class="stats-item" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-wrapper">
              <i class="bi bi-code-square"></i>
            </div>
            <span
              data-purecounter-start="0"
              data-purecounter-end="10"
              data-purecounter-duration="1"
              class="purecounter"
            ></span>
            <p>Open Source Projects</p>
          </div>
          <!-- End Stats Item -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Stats Section -->

<!-- Skills Section -->
<section id="skills" class="skills section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Technical Skills</h2>
    <p>
      Comprehensive expertise across multiple programming languages, frameworks, and enterprise systems
    </p>
  </div>
  <!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row">
      <div class="col-lg-6">
        <div
          class="skills-category"
          data-aos="fade-up"
          data-aos-delay="200"
        >
          <h3>Programming Languages</h3>
          <div class="skills-animation">
            <div class="skill-item">
              <div
                class="d-flex justify-content-between align-items-center"
              >
                <h4>C#</h4>
                <span class="skill-percentage">95%</span>
              </div>
              <div class="progress">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="95"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
              <div class="skill-tooltip">
                Extensive experience with .NET Core for enterprise applications
              </div>
            </div>

            <div class="skill-item">
              <div
                class="d-flex justify-content-between align-items-center"
              >
                <h4>JavaScript</h4>
                <span class="skill-percentage">90%</span>
              </div>
              <div class="progress">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="90"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
              <div class="skill-tooltip">
                Frontend development with Vue.js, React.js and modern ES6+ features
              </div>
            </div>

            <div class="skill-item">
              <div
                class="d-flex justify-content-between align-items-center"
              >
                <h4>PHP</h4>
                <span class="skill-percentage">85%</span>
              </div>
              <div class="progress">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="85"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
              <div class="skill-tooltip">
                Laravel, CodeIgniter, and custom CMS development experience
              </div>
            </div>
          </div>
        </div>
        <!-- End Frontend Skills -->
      </div>

      <div class="col-lg-6">
        <div
          class="skills-category"
          data-aos="fade-up"
          data-aos-delay="300"
        >
          <h3>Frameworks & Technologies</h3>
          <div class="skills-animation">
            <div class="skill-item">
              <div
                class="d-flex justify-content-between align-items-center"
              >
                <h4>.NET Core</h4>
                <span class="skill-percentage">95%</span>
              </div>
              <div class="progress">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="95"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
              <div class="skill-tooltip">
                Enterprise application development and system integrations
              </div>
            </div>

            <div class="skill-item">
              <div
                class="d-flex justify-content-between align-items-center"
              >
                <h4>Vue.js/React</h4>
                <span class="skill-percentage">85%</span>
              </div>
              <div class="progress">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="85"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
              <div class="skill-tooltip">
                Modern frontend development with component-based architecture
              </div>
            </div>

            <div class="skill-item">
              <div
                class="d-flex justify-content-between align-items-center"
              >
                <h4>Enterprise Systems</h4>
                <span class="skill-percentage">90%</span>
              </div>
              <div class="progress">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="90"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
              <div class="skill-tooltip">
                Business Central, Agresso ERP, TechOne integration expertise
              </div>
            </div>
          </div>
        </div>
        <!-- End Backend Skills -->
      </div>
    </div>
  </div>
</section>
<!-- /Skills Section -->

<!-- Resume Section -->
<section id="resume" class="resume section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Resume</h2>
    <p>
      Over a decade of experience in software engineering, specializing in enterprise solutions and full-stack development.
      Proven track record of delivering high-impact projects that drive business efficiency and digital transformation.
    </p>
  </div>
  <!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">
      <!-- Left column with summary and contact -->
      <div class="col-lg-4">
        <div
          class="resume-side"
          data-aos="fade-right"
          data-aos-delay="100"
        >
          <div class="profile-img mb-4">
            <img
              src="<?=base_url('public/uploads/files/ak-resume-profile-3-dark.webp')?>"
              alt="Profile"
              class="img-fluid rounded"
            />
          </div>

          <h3>Professional Summary</h3>
          <p>
            Experienced Software Engineer with expertise in developing scalable enterprise solutions and implementing 
            system integrations that streamline business operations. Passionate about leveraging technology to solve 
            complex business challenges and drive digital transformation.
          </p>

          <h3 class="mt-4">Contact Information</h3>
          <ul class="contact-info list-unstyled">
            <li><i class="bi bi-geo-alt"></i> Watford, UK</li>
            <li><i class="bi bi-envelope"></i> info@akassama.dev</li>
            <!-- <li><i class="bi bi-phone"></i> +44 xxxx-xxxxxx</li> -->
            <li><i class="bi bi-linkedin"></i> linkedin.com/in/akassama</li>
            <li><i class="bi bi-globe"></i> akassama.dev</li>
          </ul>

          <div class="skills-animation mt-4">
            <h3>Core Competencies</h3>
            <div class="skill-item">
              <div class="d-flex justify-content-between">
                <span>Enterprise Integration</span>
                <span>95%</span>
              </div>
              <div class="progress">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="95"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
            </div>

            <div class="skill-item">
              <div class="d-flex justify-content-between">
                <span>Full-Stack Development</span>
                <span>90%</span>
              </div>
              <div class="progress">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="90"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
            </div>

            <div class="skill-item">
              <div class="d-flex justify-content-between">
                <span>System Architecture</span>
                <span>85%</span>
              </div>
              <div class="progress">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="85"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
            </div>

            <div class="skill-item">
              <div class="d-flex justify-content-between">
                <span>Process Automation</span>
                <span>90%</span>
              </div>
              <div class="progress">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="90"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right column with experience and education -->
      <div class="col-lg-8 ps-4 ps-lg-5">
        <!-- Experience Section -->
        <div class="resume-section" data-aos="fade-up">
          <h3>
            <i class="bi bi-briefcase me-2"></i>Professional Experience
          </h3>

          <div class="resume-item">
            <h4>Enterprise Systems Developer</h4>
            <h5>2024 - Present</h5>
            <p class="company">
              <i class="bi bi-building"></i> London School of Hygiene & Tropical Medicine
            </p>
            <ul>
              <li>
                Architected and implemented critical integrations between Business Central and various ERP systems
              </li>
              <li>
                Automated payment processing workflows, reducing manual processing time by 85%
              </li>
              <li>
                Maintained 99.5% system uptime for Business Central implementations
              </li>
              <li>
                Collaborated with cross-functional teams to design scalable enterprise solutions
              </li>
            </ul>
          </div>

          <div class="resume-item">
            <h4>Developer</h4>
            <h5>2022 - 2024</h5>
            <p class="company">
              <i class="bi bi-building"></i> MRC Unit The Gambia at LSHTM
            </p>
            <ul>
              <li>
                Led digital transformation initiatives replacing paper-based processes, improving efficiency by 80%
              </li>
              <li>
                Designed online project risk management system, reducing assessment time by 60%
              </li>
              <li>
                Created standardized boilerplate templates reducing development time by 90+ hours/month
              </li>
              <li>
                Mentored junior developers and established coding standards
              </li>
            </ul>
          </div>

          <div class="resume-item">
            <h4>Software Engineer</h4>
            <h5>2020 - 2023</h5>
            <p class="company">
              <i class="bi bi-building"></i> GEXPOTECH
            </p>
            <ul>
              <li>
                Managed and delivered over 5 major software projects on time and within budget
              </li>
              <li>
                Designed responsive business websites for 20+ charity organizations
              </li>
              <li>
                Implemented modern web technologies improving performance and user experience
              </li>
            </ul>
          </div>
        </div>

        <!-- Education Section -->
        <div
          class="resume-section"
          data-aos="fade-up"
          data-aos-delay="100"
        >
          <h3><i class="bi bi-mortarboard me-2"></i>Education</h3>

          <div class="resume-item">
            <h4>Master of Science in Information Technology</h4>
            <h5>2019 - 2021</h5>
            <p class="company">
              <i class="bi bi-building"></i> Innopolis University
            </p>
            <p>
              Specialization in Software Engineering
            </p>
          </div>

          <div class="resume-item">
            <h4>Bachelor of Science in Computer Science</h4>
            <h5>2011 - 2015</h5>
            <p class="company"><i class="bi bi-building"></i> University of The Gambia</p>
          </div>
        </div>

        <!-- Certifications Section -->
        <div
          class="resume-section"
          data-aos="fade-up"
          data-aos-delay="200"
        >
          <h3><i class="bi bi-award me-2"></i>Certifications</h3>

          <div class="resume-item">
            <h4>ITIL Foundation</h4>
          </div>

          <div class="resume-item">
            <h4>Case In Tools Hackathon Winner</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Resume Section -->

<!-- Portfolio Section -->
<section id="portfolio" class="portfolio section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Portfolio</h2>
    <p>
      A collection of my professional projects, open-source contributions, and client work across various domains including 
      content management systems, enterprise solutions, web applications, and productivity tools.
    </p>
  </div>
  <!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div
      class="isotope-layout"
      data-default-filter="*"
      data-layout="masonry"
      data-sort="original-order"
    >
      <div class="row">
        <div class="col-lg-3 filter-sidebar">
          <div
            class="filters-wrapper"
            data-aos="fade-right"
            data-aos-delay="150"
          >
            <ul class="portfolio-filters isotope-filters">
              <li data-filter="*" class="filter-active">All Projects</li>
              <li data-filter=".filter-cms">CMS Projects</li>
              <li data-filter=".filter-tools">Productivity Tools</li>
              <li data-filter=".filter-enterprise">Enterprise Solutions</li>
              <li data-filter=".filter-web">Web Applications</li>
              <li data-filter=".filter-starters">Starter Templates</li>
            </ul>
          </div>
        </div>

        <div class="col-lg-9">
          <div
            class="row gy-4 portfolio-container isotope-container"
            data-aos="fade-up"
            data-aos-delay="200"
          >
            <!-- Igniter CMS -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-cms">
              <div class="portfolio-wrap">
                <img
                  src="<?=base_url('public/uploads/files/igniter-cms-preview-1.webp')?>"
                  class="img-fluid"
                  alt="Igniter CMS"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Content Management</span>
                    <h4>Igniter CMS</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('public/uploads/files/igniter-cms-preview-1.webp')?>"
                        class="glightbox"
                        title="Igniter CMS"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-igniter-cms')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- AK-Tools -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-tools">
              <div class="portfolio-wrap">
                <img
                  src="<?=base_url('public/uploads/files/ak-tools-preview-1.webp')?>"
                  class="img-fluid"
                  alt="AK-Tools"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Productivity Tools</span>
                    <h4>AK-Tools</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('public/uploads/files/ak-tools-preview-1.webp')?>"
                        class="glightbox"
                        title="AK-Tools"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-ak-tools')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- AI Overview Remover -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-tools">
              <div class="portfolio-wrap">
                <img
                  src="<?=base_url('public/uploads/files/ai-overview-remover-preview-1.webp')?>"
                  class="img-fluid"
                  alt="AI Overview Remover"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Browser Extension</span>
                    <h4>AI Overview Remover</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('public/uploads/files/ai-overview-remover-preview-1.webp')?>"
                        class="glightbox"
                        title="AI Overview Remover"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-ai-remover')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- Alchemy Telco -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-enterprise">
              <div class="portfolio-wrap">
                <img
                  src="<?=base_url('public/uploads/files/alchemy-telco-preview-1.webp')?>"
                  class="img-fluid"
                  alt="Alchemy Telco"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Telecommunications</span>
                    <h4>Alchemy Telco</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('public/uploads/files/alchemy-telco-preview-1.webp')?>"
                        class="glightbox"
                        title="Alchemy Telco"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-alchemy-telco')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- CTRIMS -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-enterprise">
              <div class="portfolio-wrap">
                <img
                  src="<?=base_url('public/uploads/files/ctrims-preview-1.webp')?>"
                  class="img-fluid"
                  alt="CTRIMS"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Clinical Trial System</span>
                    <h4>CTRIMS</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('public/uploads/files/ctrims-preview-1.webp')?>"
                        class="glightbox"
                        title="CTRIMS"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-ctrims')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- CT-UDB -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-enterprise">
              <div class="portfolio-wrap">
                <img
                  src="<?=base_url('public/uploads/files/mrc-udb-preview-1.webp')?>"
                  class="img-fluid"
                  alt="CT-UDB"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Clinical Database</span>
                    <h4>CT-UDB</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('public/uploads/files/mrc-udb-preview-1.webp')?>"
                        class="glightbox"
                        title="CT-UDB"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-ct-udb')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- NAATIP Database -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-enterprise">
              <div class="portfolio-wrap">
                <img
                  src="<?=base_url('public/uploads/files/naatip-db-preview-1.webp')?>"
                  class="img-fluid"
                  alt="NAATIP Database"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Case Management</span>
                    <h4>NAATIP Database</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('public/uploads/files/naatip-db-preview-1.webp')?>"
                        class="glightbox"
                        title="NAATIP Database"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-naatip')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- SafetyCell App -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-enterprise">
              <div class="portfolio-wrap">
                <img
                  src="<?=base_url('public/uploads/files/safetycell-preview-1.webp')?>"
                  class="img-fluid"
                  alt="SafetyCell App"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Safety Management</span>
                    <h4>SafetyCell App</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('public/uploads/files/safetycell-preview-1.webp')?>"
                        class="glightbox"
                        title="SafetyCell App"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-safetycell')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- WORKMAN Application -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-enterprise">
              <div class="portfolio-wrap">
                <img
                  src="<?=base_url('public/uploads/files/workman-preview-1.webp')?>"
                  class="img-fluid"
                  alt="WORKMAN Application"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Business Process</span>
                    <h4>WORKMAN Application</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('public/uploads/files/workman-preview-1.webp')?>"
                        class="glightbox"
                        title="WORKMAN Application"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-workman')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- HMT Gambia -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-web">
              <div class="portfolio-wrap">
                <img
                  src="<?=base_url('public/uploads/files/hmt-gambia-preview-1.webp')?>"
                  class="img-fluid"
                  alt="HM Trading Gambia"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Business Website</span>
                    <h4>HM Trading Gambia</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('public/uploads/files/hmt-gambia-preview-1.webp')?>"
                        class="glightbox"
                        title="HM Trading Gambia"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-hm-trading')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- GamSecureTech -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-web">
              <div class="portfolio-wrap">
                <img
                  src="<?=base_url('public/uploads/files/hmt-gambia-preview-1.webp')?>"
                  class="img-fluid"
                  alt="GamSecureTech"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Cybersecurity Website</span>
                    <h4>GamSecureTech</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('public/uploads/files/hmt-gambia-preview-1.webp')?>"
                        class="glightbox"
                        title="GamSecureTech"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-gamsecuretech')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- Nova Scotia Gambia Association -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-web">
              <div class="portfolio-wrap">
                <img
                  src="<?=base_url('public/uploads/files/nsga-preview-1.webp')?>"
                  class="img-fluid"
                  alt="Nova Scotia Gambia Association"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Non-profit Website</span>
                    <h4>Nova Scotia Gambia Association</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('public/uploads/files/nsga-preview-1.webp')?>"
                        class="glightbox"
                        title="Nova Scotia Gambia Association"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-nsga')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- ISRA -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-web">
              <div class="portfolio-wrap">
                <img
                  src="https://placehold.co/600x400/003366/FFFFFF?text=ISRA"
                  class="img-fluid"
                  alt="ISRA"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">NGO Website</span>
                    <h4>ISRA</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('https://placehold.co/600x400/003366/FFFFFF?text=ISRA')?>"
                        class="glightbox"
                        title="ISRA"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-isra')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- NetCore CMS -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-cms">
              <div class="portfolio-wrap">
                <img
                  src="https://placehold.co/600x400/006633/FFFFFF?text=NetCore+CMS"
                  class="img-fluid"
                  alt="NetCore CMS"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Content Management</span>
                    <h4>NetCore CMS</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('https://placehold.co/600x400/006633/FFFFFF?text=NetCore+CMS')?>"
                        class="glightbox"
                        title="NetCore CMS"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-netcore-cms')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- .NET Core 8 MVC Starter App -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-starters">
              <div class="portfolio-wrap">
                <img
                  src="https://placehold.co/600x400/660066/FFFFFF?text=.NET+MVC+Starter"
                  class="img-fluid"
                  alt=".NET Core 8 MVC Starter App"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Starter Template</span>
                    <h4>.NET Core 8 MVC Starter</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('https://placehold.co/600x400/660066/FFFFFF?text=.NET+MVC+Starter')?>"
                        class="glightbox"
                        title=".NET Core 8 MVC Starter App"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-dotnet-mvc-starter')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- .NET Core 8 API Starter App -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-starters">
              <div class="portfolio-wrap">
                <img
                  src="https://placehold.co/600x400/336600/FFFFFF?text=.NET+API+Starter"
                  class="img-fluid"
                  alt=".NET Core 8 API Starter App"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">Starter Template</span>
                    <h4>.NET Core 8 API Starter</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('https://placehold.co/600x400/336600/FFFFFF?text=.NET+API+Starter')?>"
                        class="glightbox"
                        title=".NET Core 8 API Starter App"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-dotnet-api-starter')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->

            <!-- ShortLink Maker -->
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-web">
              <div class="portfolio-wrap">
                <img
                  src="https://placehold.co/600x400/003366/FFFFFF?text=ShortLink+Maker"
                  class="img-fluid"
                  alt="ShortLink Maker"
                  loading="lazy"
                />
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">URL Shortener</span>
                    <h4>ShortLink Maker</h4>
                    <div class="portfolio-links">
                      <a
                        href="<?=base_url('https://placehold.co/600x400/003366/FFFFFF?text=ShortLink+Maker')?>"
                        class="glightbox"
                        title="ShortLink Maker"
                        ><i class="bi bi-plus-lg"></i
                      ></a>
                      <a
                        href="<?=base_url('portfolio-shortlink-maker')?>"
                        title="More Details"
                        ><i class="bi bi-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Portfolio Item -->
          </div>
          <!-- End Portfolio Container -->
        </div>

      </div>
    </div>
  </div>
</section>
<!-- /Portfolio Section -->

<!-- Services Section -->
<section id="services" class="services section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Services</h2>
    <p>
      Comprehensive software development services tailored to meet your business needs and drive digital transformation
    </p>
  </div>
  <!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="service-header">
      <div class="row align-items-center">
        <div class="col-lg-8 col-md-12">
          <div class="service-intro">
            <h2 class="service-heading">
              <div>Enterprise software</div>
              <div><span>solutions & integrations</span></div>
            </h2>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="service-summary">
            <p>
              I combine technical expertise with business acumen to deliver solutions that streamline operations, 
              improve efficiency, and drive growth through digital transformation.
            </p>
            <a href="#contact" class="service-btn">
              Contact Me
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div
        class="col-lg-4 col-md-6"
        data-aos="fade-up"
        data-aos-delay="100"
      >
        <div class="service-card position-relative z-1">
          <div class="service-icon">
            <i class="bi bi-arrow-left-right"></i>
          </div>
          <a
            href="#contact"
            class="card-action d-flex align-items-center justify-content-center rounded-circle"
          >
            <i class="bi bi-arrow-up-right"></i>
          </a>
          <h3>
            <a href="#contact">
              Enterprise <span>System Integration</span>
            </a>
          </h3>
          <p>
            Seamless integration between ERP systems like Business Central, Agresso, and TechOne to streamline data flow 
            and automate business processes across your organization.
          </p>
        </div>
      </div>
      <div
        class="col-lg-4 col-md-6"
        data-aos="fade-up"
        data-aos-delay="200"
      >
        <div class="service-card position-relative z-1">
          <div class="service-icon">
            <i class="bi bi-stack"></i>
          </div>
          <a
            href="#contact"
            class="card-action d-flex align-items-center justify-content-center rounded-circle"
          >
            <i class="bi bi-arrow-up-right"></i>
          </a>
          <h3>
            <a href="#contact">
              Full-Stack <span>Development</span>
            </a>
          </h3>
          <p>
            Custom web application development using modern technologies like .NET Core, Vue.js, and React to build 
            scalable solutions that meet your specific business requirements.
          </p>
        </div>
      </div>
      <div
        class="col-lg-4 col-md-6"
        data-aos="fade-up"
        data-aos-delay="300"
      >
        <div class="service-card position-relative z-1">
          <div class="service-icon">
            <i class="bi bi-gear"></i>
          </div>
          <a
            href="#contact"
            class="card-action d-flex align-items-center justify-content-center rounded-circle"
          >
            <i class="bi bi-arrow-up-right"></i>
          </a>
          <h3>
            <a href="#contact">
              Process <span>Automation</span>
            </a>
          </h3>
          <p>
            Automation of repetitive tasks and workflows to reduce manual effort, minimize errors, and improve 
            operational efficiency across your organization.
          </p>
        </div>
      </div>
      <div
        class="col-lg-4 col-md-6"
        data-aos="fade-up"
        data-aos-delay="100"
      >
        <div class="service-card position-relative z-1">
          <div class="service-icon">
            <i class="bi bi-building"></i>
          </div>
          <a
            href="#contact"
            class="card-action d-flex align-items-center justify-content-center rounded-circle"
          >
            <i class="bi bi-arrow-up-right"></i>
          </a>
          <h3>
            <a href="#contact">
              Custom <span>CMS Development</span>
            </a>
          </h3>
          <p>
            Bespoke content management solutions tailored to your specific needs, whether for business websites, 
            charity organizations, or internal knowledge bases.
          </p>
        </div>
      </div>
      <div
        class="col-lg-4 col-md-6"
        data-aos="fade-up"
        data-aos-delay="200"
      >
        <div class="service-card position-relative z-1">
          <div class="service-icon">
            <i class="bi bi-graph-up"></i>
          </div>
          <a
            href="#contact"
            class="card-action d-flex align-items-center justify-content-center rounded-circle"
          >
            <i class="bi bi-arrow-up-right"></i>
          </a>
          <h3>
            <a href="#contact">
              Digital <span>Transformation</span>
            </a>
          </h3>
          <p>
            Comprehensive strategy and implementation to modernize legacy systems, replace paper-based processes, 
            and transition your organization to digital workflows.
          </p>
        </div>
      </div>
      <div
        class="col-lg-4 col-md-6"
        data-aos="fade-up"
        data-aos-delay="300"
      >
        <div class="service-card position-relative z-1">
          <div class="service-icon">
            <i class="bi bi-people"></i>
          </div>
          <a
            href="#contact"
            class="card-action d-flex align-items-center justify-content-center rounded-circle"
          >
            <i class="bi bi-arrow-up-right"></i>
          </a>
          <h3>
            <a href="#contact">
              Technical <span>Consulting</span>
            </a>
          </h3>
          <p>
            Expert guidance on system architecture, technology selection, and implementation strategies to ensure 
            your projects are built on solid foundations.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Services Section -->

<!-- Testimonials Section -->
<section id="testimonials" class="testimonials section light-background">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Testimonials</h2>
    <p>
      Feedback from colleagues and clients about my work and professional approach
    </p>
  </div>
  <!-- End Section Title -->

  <div class="container">
    <div class="testimonial-masonry">
      <div class="testimonial-item" data-aos="fade-up">
        <div class="testimonial-content">
          <div class="quote-pattern">
            <i class="bi bi-quote"></i>
          </div>
          <p>
            The ERP integration solution Abdoulie implemented has transformed our financial operations, 
            reducing processing time by 85% while completely eliminating human errors in transactions.
          </p>
          <div class="client-info">
            <div class="client-image">
              <img src="assets/img/person/person-m-7.webp" alt="Client" />
            </div>
            <div class="client-details">
              <h3>Finance Director</h3>
              <span class="position">London School of Hygiene & Tropical Medicine</span>
            </div>
          </div>
        </div>
      </div>

      <div
        class="testimonial-item highlight"
        data-aos="fade-up"
        data-aos-delay="100"
      >
        <div class="testimonial-content">
          <div class="quote-pattern">
            <i class="bi bi-quote"></i>
          </div>
          <p>
            Abdoulie's risk management system has given us unprecedented visibility into project risks 
            and reduced our assessment time by 60%. His ability to understand complex requirements and 
            translate them into effective solutions is exceptional.
          </p>
          <div class="client-info">
            <div class="client-image">
              <img src="assets/img/person/person-f-7.webp" alt="Client" />
            </div>
            <div class="client-details">
              <h3>Project Manager</h3>
              <span class="position">MRC Unit The Gambia at LSHTM</span>
            </div>
          </div>
        </div>
      </div>

      <div
        class="testimonial-item"
        data-aos="fade-up"
        data-aos-delay="200"
      >
        <div class="testimonial-content">
          <div class="quote-pattern">
            <i class="bi bi-quote"></i>
          </div>
          <p>
            Our charity's website developed by Abdoulie helped double our yearly donations. 
            His understanding of donor psychology and technical implementation was impressive.
          </p>
          <div class="client-info">
            <div class="client-image">
              <img src="assets/img/person/person-f-8.webp" alt="Client" />
            </div>
            <div class="client-details">
              <h3>Charity Director</h3>
              <span class="position">GEXPOTECH Client</span>
            </div>
          </div>
        </div>
      </div>

      <div
        class="testimonial-item"
        data-aos="fade-up"
        data-aos-delay="300"
      >
        <div class="testimonial-content">
          <div class="quote-pattern">
            <i class="bi bi-quote"></i>
          </div>
          <p>
            The standardized templates and services Abdoulie created have saved our development team 
            over 90 hours per month while significantly improving code quality across all projects.
          </p>
          <div class="client-info">
            <div class="client-image">
              <img src="assets/img/person/person-m-8.webp" alt="Client" />
            </div>
            <div class="client-details">
              <h3>Development Team Lead</h3>
              <span class="position">MRC Unit The Gambia at LSHTM</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Testimonials Section -->

<!-- Contact Section -->
<section id="contact" class="contact section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Contact</h2>
    <p>
      Interested in working together or learning more about my services? Get in touch below.
    </p>
  </div>
  <!-- End Section Title -->

  <div class="container">
    <div class="row g-4 g-lg-5">
      <div class="col-lg-5">
        <div class="info-box">
          <h3>Contact Info</h3>
          <p>
            Feel free to reach out through any of these channels for professional inquiries or collaborations.
          </p>

          <div class="info-item">
            <div class="icon-box">
              <i class="bi bi-geo-alt"></i>
            </div>
            <div class="content">
              <h4>Location</h4>
              <p>Watford, United Kingdom</p>
            </div>
          </div>

          <div class="info-item">
            <div class="icon-box">
              <i class="bi bi-envelope"></i>
            </div>
            <div class="content">
              <h4>Email Address</h4>
              <p>info@akassama.dev</p>
            </div>
          </div>

          <div class="info-item">
            <div class="icon-box">
              <i class="bi bi-globe"></i>
            </div>
            <div class="content">
              <h4>Website</h4>
              <p>akassama.dev</p>
            </div>
          </div>

          <div class="info-item">
            <div class="icon-box">
              <i class="bi bi-linkedin"></i>
            </div>
            <div class="content">
              <h4>LinkedIn</h4>
              <p>linkedin.com/in/akassama</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="contact-form">
          <h3>Get In Touch</h3>
          <p>
            Have a project in mind or want to discuss potential collaboration? Send me a message and I'll get back to you as soon as possible.
          </p>

          <form
            action="forms/contact.php"
            method="post"
            class="php-email-form"
          >
            <div class="row gy-4">
              <div class="col-md-6">
                <input
                  type="text"
                  name="name"
                  class="form-control"
                  placeholder="Your Name"
                  required=""
                />
              </div>

              <div class="col-md-6">
                <input
                  type="email"
                  class="form-control"
                  name="email"
                  placeholder="Your Email"
                  required=""
                />
              </div>

              <div class="col-12">
                <input
                  type="text"
                  class="form-control"
                  name="subject"
                  placeholder="Subject"
                  required=""
                />
              </div>

              <div class="col-12">
                <textarea
                  class="form-control"
                  name="message"
                  rows="6"
                  placeholder="Message"
                  required=""
                ></textarea>
              </div>

              <div class="col-12 text-center">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">
                  Your message has been sent. Thank you!
                </div>

                <button type="submit" class="btn">Send Message</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Contact Section -->

<!-- end main content -->
<?= $this->endSection() ?>