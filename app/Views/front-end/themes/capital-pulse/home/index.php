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
<section id="hero" class="d-flex align-items-center">
<div class="container">
  <div class="row align-items-center">
    <div class="col-lg-7 text-center text-lg-start">
      <div class="hero-content animate__animated animate__fadeInUp">
        <h1 class="display-3 fw-bold">Innovate. Integrate. Elevate.</h1>
        <p>
          Your trusted partner for comprehensive IT solutions and
          services. We empower businesses to thrive in the digital age.
        </p>
        <div
          class="d-flex justify-content-center justify-content-lg-start"
        >
          <a
            href="#about"
            class="btn btn-primary rounded-pill px-4 me-2"
            >Learn More</a
          >
          <a
            href="https://www.youtube.com/watch?v=BqFSHbzSs7U"
            class="btn btn-outline-primary rounded-pill px-4 glightbox"
            ><i class="bi bi-play-circle me-2"></i>Watch Video</a
          >
        </div>
      </div>
    </div>
    <div
      class="col-lg-5 d-none d-lg-block animate__animated animate__fadeInRight"
    >
      <img
        src="https://assets.aktools.net/image-stocks/isometrics/iso-stat-2.svg"
        class="img-fluid rounded-4 shadow"
        alt="Hero Image"
      />
    </div>
  </div>
</div>
</section>

<section id="about">
<div class="container">
  <div class="row g-4 align-items-center">
    <div class="col-lg-6 order-lg-2">
      <div class="about-img">
        <img
          src="https://assets.aktools.net/image-stocks/about/about-1.jpg"
          class="img-fluid"
          alt="About Us"
        />
      </div>
    </div>
    <div class="col-lg-6 order-lg-1">
      <div class="content">
        <span class="text-primary fw-bold text-uppercase"
          >About Us</span
        >
        <h3 class="mt-2">
          Driving Business Growth with Cutting-Edge IT Solutions
        </h3>
        <p class="mb-4">
          At CapitalPulse, we believe that technology should be an
          enabler, not a hurdle. We are dedicated to providing
          innovative and reliable IT services that help businesses of
          all sizes streamline operations, enhance security, and achieve
          their strategic goals.
        </p>
        <ul>
          <li>
            <i class="bi bi-check-circle"></i>
            Experienced and certified team of IT professionals.
          </li>
          <li>
            <i class="bi bi-check-circle"></i>
            Customized solutions tailored to your unique business needs.
          </li>
          <li>
            <i class="bi bi-check-circle"></i>
            24/7 support and proactive system monitoring.
          </li>
        </ul>
        <a
          href="#services"
          class="btn btn-primary rounded-pill px-4 mt-3"
          >Our Services</a
        >
      </div>
    </div>
  </div>
</div>
</section>

<section id="what-we-do" class="bg-light">
<div class="container">
  <div class="section-heading">
    <h2>What We Do</h2>
    <p>
      We offer a wide range of services to help you navigate the complex
      world of information technology.
    </p>
  </div>
  <div class="row g-4">
    <div class="col-lg-4 col-md-6">
      <div class="what-we-do-item">
        <div class="icon"><i class="bi bi-headset"></i></div>
        <h4>IT Support</h4>
        <p>
          Reliable support for your IT infrastructure, ensuring minimal
          downtime and maximum productivity.
        </p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="what-we-do-item">
        <div class="icon"><i class="bi bi-shield-lock"></i></div>
        <h4>Cyber Security</h4>
        <p>
          Protect your business from threats with our comprehensive
          security solutions and proactive defense strategies.
        </p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="what-we-do-item">
        <div class="icon"><i class="bi bi-database"></i></div>
        <h4>Data Management</h4>
        <p>
          Secure, organize, and analyze your data to gain valuable
          insights and make informed business decisions.
        </p>
      </div>
    </div>
  </div>
</div>
</section>

<section id="services">
<div class="container">
  <div class="section-heading">
    <h2>Our Services</h2>
    <p>
      From strategy to implementation, we provide end-to-end IT
      solutions that drive real results.
    </p>
  </div>
  <div class="row g-4">
    <div class="col-lg-4 col-md-6">
      <div class="service-card">
        <div class="card-body">
          <div class="icon"><i class="bi bi-cloud"></i></div>
          <h5 class="card-title">Cloud Solutions</h5>
          <p class="card-text">
            Migrate and manage your infrastructure on the cloud for
            scalability and flexibility.
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="service-card">
        <div class="card-body">
          <div class="icon"><i class="bi bi-laptop"></i></div>
          <h5 class="card-title">IT Procurement</h5>
          <p class="card-text">
            Source the best hardware and software for your business
            needs at competitive prices.
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="service-card">
        <div class="card-body">
          <div class="icon"><i class="bi bi-people"></i></div>
          <h5 class="card-title">IT Consulting</h5>
          <p class="card-text">
            Strategic guidance to help you leverage technology for
            business growth and innovation.
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="service-card">
        <div class="card-body">
          <div class="icon"><i class="bi bi-shield-check"></i></div>
          <h5 class="card-title">Network Security</h5>
          <p class="card-text">
            Robust security measures to protect your network and data
            from cyber threats.
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="service-card">
        <div class="card-body">
          <div class="icon"><i class="bi bi-bar-chart"></i></div>
          <h5 class="card-title">Data Analytics</h5>
          <p class="card-text">
            Turn your data into actionable insights to drive smarter
            business decisions.
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="service-card">
        <div class="card-body">
          <div class="icon"><i class="bi bi-gear"></i></div>
          <h5 class="card-title">Managed Services</h5>
          <p class="card-text">
            Comprehensive IT management to free up your team and ensure
            smooth operations.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<section id="sponsors" class="bg-light">
<div class="container">
  <div class="section-heading">
    <h2>Our Partners</h2>
    <p>
      We're proud to work with leading companies to provide the best
      solutions for our clients.
    </p>
  </div>
  <div class="row align-items-center justify-content-center g-4">
    <div class="col-6 col-md-4 col-lg-2 text-center logo-item">
      <img
        src="https://assets.aktools.net/image-stocks/clients/clients-1.png"
        class="img-fluid"
        alt="Client 1"
      />
    </div>
    <div class="col-6 col-md-4 col-lg-2 text-center logo-item">
      <img
        src="https://assets.aktools.net/image-stocks/clients/clients-2.png"
        class="img-fluid"
        alt="Client 2"
      />
    </div>
    <div class="col-6 col-md-4 col-lg-2 text-center logo-item">
      <img
        src="https://assets.aktools.net/image-stocks/clients/clients-3.png"
        class="img-fluid"
        alt="Client 3"
      />
    </div>
    <div class="col-6 col-md-4 col-lg-2 text-center logo-item">
      <img
        src="https://assets.aktools.net/image-stocks/clients/clients-4.png"
        class="img-fluid"
        alt="Client 4"
      />
    </div>
    <div class="col-6 col-md-4 col-lg-2 text-center logo-item">
      <img
        src="https://assets.aktools.net/image-stocks/clients/clients-5.png"
        class="img-fluid"
        alt="Client 5"
      />
    </div>
    <div class="col-6 col-md-4 col-lg-2 text-center logo-item">
      <img
        src="https://assets.aktools.net/image-stocks/clients/clients-6.png"
        class="img-fluid"
        alt="Client 6"
      />
    </div>
  </div>
</div>
</section>

<section id="counts">
<div class="container">
  <div class="row text-center">
    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
      <div class="count-box">
        <i class="bi bi-emoji-smile"></i>
        <h4 class="counter" data-count="500">0</h4>
        <p>Happy Clients</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
      <div class="count-box">
        <i class="bi bi-journal-richtext"></i>
        <h4 class="counter" data-count="850">0</h4>
        <p>Projects Completed</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
      <div class="count-box">
        <i class="bi bi-headset"></i>
        <h4 class="counter" data-count="1500">0</h4>
        <p>Hours of Support</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="count-box">
        <i class="bi bi-award"></i>
        <h4 class="counter" data-count="25">0</h4>
        <p>Awards Won</p>
      </div>
    </div>
  </div>
</div>
</section>

<section id="faq">
<div class="container">
  <div class="section-heading">
    <h2>Frequently Asked Questions</h2>
    <p>
      Find answers to the most common questions about our services and
      processes.
    </p>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="accordion accordion-flush" id="faqAccordion">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#flush-collapseOne"
              aria-expanded="false"
              aria-controls="flush-collapseOne"
            >
              How do your IT consulting services work?
            </button>
          </h2>
          <div
            id="flush-collapseOne"
            class="accordion-collapse collapse"
            aria-labelledby="flush-headingOne"
            data-bs-parent="#faqAccordion"
          >
            <div class="accordion-body">
              Our IT consulting process begins with a comprehensive
              assessment of your current systems and business needs. We
              then work with you to develop a strategic roadmap,
              recommend tailored solutions, and assist with
              implementation to ensure you meet your goals.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingTwo">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#flush-collapseTwo"
              aria-expanded="false"
              aria-controls="flush-collapseTwo"
            >
              What is the average response time for support tickets?
            </button>
          </h2>
          <div
            id="flush-collapseTwo"
            class="accordion-collapse collapse"
            aria-labelledby="flush-headingTwo"
            data-bs-parent="#faqAccordion"
          >
            <div class="accordion-body">
              We pride ourselves on our rapid response times. For most
              critical issues, we aim to respond within one hour. For
              non-urgent requests, our typical response time is within
              24 hours during business days.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingThree">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#flush-collapseThree"
              aria-expanded="false"
              aria-controls="flush-collapseThree"
            >
              Do you offer customized pricing plans?
            </button>
          </h2>
          <div
            id="flush-collapseThree"
            class="accordion-collapse collapse"
            aria-labelledby="flush-headingThree"
            data-bs-parent="#faqAccordion"
          >
            <div class="accordion-body">
              Yes, we understand that every business is unique. While we
              have standard packages, we are happy to create a
              customized pricing plan that fits your specific needs and
              budget. Contact us for a personalized quote.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<section id="cta">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8 text-center">
      <h3>Ready to Elevate Your Business?</h3>
      <p>
        Take the first step towards a smarter, more secure IT
        infrastructure. Our team is ready to help.
      </p>
      <a
        href="#contact"
        class="btn btn-outline-light rounded-pill px-5 py-3"
        >Get a Free Consultation</a
      >
    </div>
  </div>
</div>
</section>

<section id="testimonials" class="bg-light">
<div class="container">
  <div class="section-heading">
    <h2>What Our Clients Say</h2>
    <p>
      Don't just take our word for it. Hear from the businesses we've
      helped.
    </p>
  </div>
  <div class="swiper-container testimonials-slider">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="testimonial-item">
          <i class="bi bi-quote quote-icon-left"></i>
          <p>
            "CapitalPulse transformed our outdated systems into a
            modern, efficient powerhouse. Their team is knowledgeable,
            responsive, and a true pleasure to work with."
          </p>
          <i class="bi bi-quote quote-icon-right"></i>
          <div class="profile">
            <img
              src="https://placehold.co/70x70/0d6efd/FFFFFF?text=JP"
              class="img-fluid"
              alt="Client Image"
            />
            <div>
              <h4>John P.</h4>
              <span>CEO, Innovate Corp</span>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-slide">
        <div class="testimonial-item">
          <i class="bi bi-quote quote-icon-left"></i>
          <p>
            "The cloud solutions they implemented have significantly
            boosted our productivity. We've saved money and can now
            access our data from anywhere."
          </p>
          <i class="bi bi-quote quote-icon-right"></i>
          <div class="profile">
            <img
              src="https://placehold.co/70x70/0d6efd/FFFFFF?text=MS"
              class="img-fluid"
              alt="Client Image"
            />
            <div>
              <h4>Maria S.</h4>
              <span>Founder, Global Ventures</span>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-slide">
        <div class="testimonial-item">
          <i class="bi bi-quote quote-icon-left"></i>
          <p>
            "Their proactive security monitoring has given us peace of
            mind. We feel completely protected and can focus on what we
            do best."
          </p>
          <i class="bi bi-quote quote-icon-right"></i>
          <div class="profile">
            <img
              src="https://placehold.co/70x70/0d6efd/FFFFFF?text=RJ"
              class="img-fluid"
              alt="Client Image"
            />
            <div>
              <h4>Robert J.</h4>
              <span>IT Manager, SecureNet</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</div>
</section>

<section id="portfolio">
<div class="container">
  <div class="section-heading">
    <h2>Our Portfolio</h2>
    <p>
      A glimpse into some of the successful projects we've delivered for
      our clients.
    </p>
  </div>
  <div class="row g-4">
    <div class="col-lg-4 col-md-6">
      <div class="portfolio-item">
        <img
          src="https://assets.aktools.net/image-stocks/portfolios/portfolio-1.jpg"
          class="img-fluid"
          alt="Portfolio Image"
        />
        <div class="portfolio-overlay d-flex flex-column">
          <div class="portfolio-info">
            <h4>Cloud Migration</h4>
            <p>Financial Services</p>
          </div>
          <div class="portfolio-links mt-2">
            <a
              href="https://assets.aktools.net/image-stocks/portfolios/portfolio-1.jpg"
              class="glightbox"
              title="Cloud Migration"
              ><i class="bi bi-plus-lg"></i
            ></a>
            <a href="#" title="More Details"
              ><i class="bi bi-link-45deg"></i
            ></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="portfolio-item">
        <img
          src="https://assets.aktools.net/image-stocks/portfolios/portfolio-2.jpg"
          class="img-fluid"
          alt="Portfolio Image"
        />
        <div class="portfolio-overlay d-flex flex-column">
          <div class="portfolio-info">
            <h4>Network Security</h4>
            <p>Healthcare</p>
          </div>
          <div class="portfolio-links mt-2">
            <a
              href="https://assets.aktools.net/image-stocks/portfolios/portfolio-2.jpg"
              class="glightbox"
              title="Network Security"
              ><i class="bi bi-plus-lg"></i
            ></a>
            <a href="#" title="More Details"
              ><i class="bi bi-link-45deg"></i
            ></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="portfolio-item">
        <img
          src="https://assets.aktools.net/image-stocks/portfolios/portfolio-3.jpg"
          class="img-fluid"
          alt="Portfolio Image"
        />
        <div class="portfolio-overlay d-flex flex-column">
          <div class="portfolio-info">
            <h4>Data Analytics</h4>
            <p>Retail</p>
          </div>
          <div class="portfolio-links mt-2">
            <a
              href="https://assets.aktools.net/image-stocks/portfolios/portfolio-3.jpg"
              class="glightbox"
              title="Data Analytics"
              ><i class="bi bi-plus-lg"></i
            ></a>
            <a href="#" title="More Details"
              ><i class="bi bi-link-45deg"></i
            ></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<section id="team" class="bg-light">
<div class="container">
  <div class="section-heading">
    <h2>Our Team</h2>
    <p>
      Meet the talented and dedicated professionals who make it all
      happen.
    </p>
  </div>
  <div class="row g-4">
    <div class="col-lg-3 col-md-6">
      <div class="team-member">
        <div class="member-img">
          <img
            src="https://assets.aktools.net/image-stocks/teams/team-5.jpg"
            class="img-fluid"
            alt="Jane Doe"
          />
        </div>
        <div class="member-info">
          <h4>Jane Doe</h4>
          <span>Chief Executive Officer</span>
          <div class="social-links d-flex justify-content-center">
            <a href="#"><i class="bi bi-twitter-x"></i></a>
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="team-member">
        <div class="member-img">
          <img
            src="https://assets.aktools.net/image-stocks/teams/team-1.jpg"
            class="img-fluid"
            alt="Mark Robinson"
          />
        </div>
        <div class="member-info">
          <h4>Mark Robinson</h4>
          <span>Lead Solutions Architect</span>
          <div class="social-links d-flex justify-content-center">
            <a href="#"><i class="bi bi-twitter-x"></i></a>
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="team-member">
        <div class="member-img">
          <img
            src="https://assets.aktools.net/image-stocks/teams/team-4.jpg"
            class="img-fluid"
            alt="Sarah Lee"
          />
        </div>
        <div class="member-info">
          <h4>Sarah Lee</h4>
          <span>Head of Cyber Security</span>
          <div class="social-links d-flex justify-content-center">
            <a href="#"><i class="bi bi-twitter-x"></i></a>
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="team-member">
        <div class="member-img">
          <img
            src="https://assets.aktools.net/image-stocks/teams/team-2.jpg"
            class="img-fluid"
            alt="David Chen"
          />
        </div>
        <div class="member-info">
          <h4>David Chen</h4>
          <span>Senior IT Consultant</span>
          <div class="social-links d-flex justify-content-center">
            <a href="#"><i class="bi bi-twitter-x"></i></a>
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<section id="pricing">
<div class="container">
  <div class="section-heading">
    <h2>Our Pricing</h2>
    <p>
      Flexible plans designed to scale with your business needs and
      budget.
    </p>
  </div>
  <div class="row g-4 justify-content-center">
    <div class="col-lg-4 col-md-6">
      <div class="pricing-card">
        <h4>Basic Plan</h4>
        <div class="price"><sup>$</sup>49<span>/month</span></div>
        <p class="text-muted">For small businesses and startups.</p>
        <ul>
          <li><i class="bi bi-check-circle"></i> Basic IT Support</li>
          <li><i class="bi bi-check-circle"></i> 24/7 Monitoring</li>
          <li><i class="bi bi-check-circle"></i> 5 Users Included</li>
          <li class="text-muted">
            <i class="bi bi-x-circle"></i> Advanced Security
          </li>
          <li class="text-muted">
            <i class="bi bi-x-circle"></i> Dedicated Account Manager
          </li>
        </ul>
        <a href="#" class="btn btn-primary rounded-pill px-4">
          Choose Plan
        </a>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="pricing-card pro-plan bg-primary text-white">
        <h4 class="text-white">Pro Plan</h4>
        <div class="price"><sup>$</sup>149<span>/month</span></div>
        <p class="text-white-50">Recommended for growing businesses.</p>
        <ul class="text-white">
          <li><i class="bi bi-check-circle"></i> All Basic features</li>
          <li><i class="bi bi-check-circle"></i> Priority Support</li>
          <li><i class="bi bi-check-circle"></i> Advanced Security</li>
          <li><i class="bi bi-check-circle"></i> 20 Users Included</li>
          <li class="text-white-50">
            <i class="bi bi-x-circle"></i> Dedicated Account Manager
          </li>
        </ul>
        <a href="#" class="btn btn-outline-light rounded-pill px-4">
          Choose Plan
        </a>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="pricing-card">
        <h4>Enterprise Plan</h4>
        <div class="price"><sup>$</sup>299<span>/month</span></div>
        <p class="text-muted">For large organizations.</p>
        <ul>
          <li><i class="bi bi-check-circle"></i> All Pro features</li>
          <li>
            <i class="bi bi-check-circle"></i> Dedicated Account Manager
          </li>
          <li><i class="bi bi-check-circle"></i> On-site Support</li>
          <li><i class="bi bi-check-circle"></i> Unlimited Users</li>
          <li><i class="bi bi-check-circle"></i> Custom Solutions</li>
        </ul>
        <a href="#" class="btn btn-primary rounded-pill px-4">
          Choose Plan
        </a>
      </div>
    </div>
  </div>
</div>
</section>

<section id="subscribe">
<div class="container">
  <div class="section-heading">
    <h2>Subscribe to Our Newsletter</h2>
    <p>
      Stay up-to-date with our latest news, insights, and special
      offers.
    </p>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <form
        action="<?= base_url('/api-form/add-subscriber') ?>"
        method="post"
        class="subscribe-form"
      >
        <?= csrf_field() ?>
        <?=getHoneypotInput()?>
        <div class="input-group">
          <input
            type="email"
            class="form-control"
            placeholder="Enter your email"
            name="email"
            required
          />
          <button class="btn btn-primary" type="submit">
            Subscribe
          </button>
        </div>
        <div class="col-12">
            <input type="hidden" class="form-control" name="return_url" id="return_url" placeholder="return url" value="<?=current_url()."?#subscribe"?>">
            <input type="hidden" class="form-control" name="form_name" id="form_name" value="Subscribe">
        </div>
        <!--captcha validation-->
        <?=renderCaptcha()?>
      </form>
    </div>
  </div>
</div>
</section>

<!-- Blogs Section -->
<section id="blog" class="recent-posts">
  <div class="container">
    <div class="section-heading">
      <h2>Latest Tech Insights</h2>
      <p>Stay updated with the latest trends, news, and innovations in the IT world</p>
    </div>

    <div class="row justify-content-center">
      <?php
        use App\Models\BlogsModel;
        $blogsModel = new BlogsModel();
        $blogs = $blogsModel->where('status', '1')->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_LOW', 6)))->findAll();
      ?>

      <?php if ($blogs): ?>
        <?php foreach ($blogs as $index => $blog): ?>
          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
            <article>
              <div class="post-img">
                <img
                  src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>"
                  alt="<?= esc($blog['title']) ?>"
                  class="img-fluid"
                />
              </div>
              <p class="post-category">
                <?= !empty($blog['category']) ? getBlogCategoryName($blog['category']) : "Uncategorized" ?>
              </p>
              <h2 class="title">
                <a href="<?= base_url('blog/' . $blog['slug']) ?>">
                  <?= esc($blog['title']) ?>
                </a>
              </h2>
              <div class="d-flex align-items-center">
                <img
                  src="<?= getImageUrl(getUserData($blog['created_by'], 'profile_picture') ?? getDefaultProfileImagePath()) ?>"
                  alt="Author"
                  class="img-fluid post-author-img flex-shrink-0"
                />
                <div class="post-meta">
                  <p class="post-author">
                    <?= getActivityBy(esc($blog['created_by'])) ?>
                  </p>
                  <p class="post-date">
                    <time datetime="<?= date('Y-m-d', strtotime($blog['created_at'])) ?>">
                      <?= dateFormat($blog['created_at'], 'M j, Y') ?>
                    </time>
                  </p>
                </div>
              </div>
            </article>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center">
          <p class="text-muted">No blog posts available at the moment.</p>
        </div>
      <?php endif; ?>
    </div>

    <div class="text-center mt-5">
      <a href="<?= base_url('blogs') ?>" class="btn btn-primary">View All Posts</a>
    </div>
  </div>
</section>

<section id="contact">
<div class="container">
  <div class="section-heading">
    <h2>Get in Touch</h2>
    <p>
      We'd love to hear from you. Fill out the form or use the contact
      information below to reach us.
    </p>
  </div>
  <div class="row g-4">
    <div class="col-lg-5">
      <div class="info h-100">
        <h4 class="mb-4">Contact Information</h4>
        <div class="d-flex align-items-start mb-3">
          <div class="icon"><i class="bi bi-geo-alt"></i></div>
          <div>
            <h5 class="m-0">Location:</h5>
            <p class="m-0 text-muted">123 Tech Park, Watford, UK</p>
          </div>
        </div>
        <div class="d-flex align-items-start mb-3">
          <div class="icon"><i class="bi bi-envelope"></i></div>
          <div>
            <h5 class="m-0">Email:</h5>
            <p class="m-0 text-muted">info@akthemes.com</p>
          </div>
        </div>
        <div class="d-flex align-items-start mb-3">
          <div class="icon"><i class="bi bi-telephone"></i></div>
          <div>
            <h5 class="m-0">Phone:</h5>
            <p class="m-0 text-muted">+44 20 1234 5678</p>
          </div>
        </div>
        <div class="d-flex align-items-start">
          <div class="icon"><i class="bi bi-clock"></i></div>
          <div>
            <h5 class="m-0">Business Hours:</h5>
            <p class="m-0 text-muted">Mon-Fri: 9AM - 6PM</p>
          </div>
        </div>
        <div class="mt-4 ratio ratio-16x9">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d157835.4357908479!2d-0.6540307374026338!3d51.64205565345718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876144e5837a7b9%3a0x296cf93845f187a!2sWatford%2c%20UK!5e0!3m2!1sen!2sus!4v1714486510168!5m2!1sen!2sus"
            style="border: 0"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </div>
      </div>
    </div>
    <div class="col-lg-7">
      <form
        action="<?= base_url('/api-form/send-contact-message') ?>"
        method="post"
        role="form"
        class="h-100"
      >
        <?= csrf_field() ?>
        <?=getHoneypotInput()?>
        <h4 class="mb-4">Send us a Message</h4>
        <div class="row g-3">
          <div class="col-md-6">
            <div class="form-group">
              <input
                type="text"
                name="name"
                class="form-control"
                id="name"
                placeholder="Your Name"
                required
              />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input
                type="email"
                class="form-control"
                name="email"
                id="email"
                placeholder="Your Email"
                required
              />
            </div>
          </div>
        </div>
        <div class="form-group mt-3">
          <input
            type="text"
            class="form-control"
            name="subject"
            id="subject"
            placeholder="Subject"
            required
          />
        </div>
        <div class="form-group mt-3">
          <textarea
            class="form-control"
            name="message"
            rows="5"
            placeholder="Message"
            required
          ></textarea>
        </div>
        <div class="my-2">
            <!--captcha validation-->
            <?=renderCaptcha()?>
            <input type="hidden" class="form-control" name="return_url" id="return_url" placeholder="return url" value="<?=current_url()."?#contact"?>">
            <input type="hidden" class="form-control" name="form_name" id="form_name" value="Contact">
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary rounded-pill">
            Send Message
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
<!-- ////// END Home Pages ///// -->


<!-- end main content -->
<?= $this->endSection() ?>