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
<!-- Hero Slider -->
<section id="home" class="hero-slider">
<div class="swiper hero-swiper">
  <div class="swiper-wrapper">
    <div
      class="swiper-slide hero-slide"
      style="
        background-image: url('https://assets.aktools.net/image-stocks/contractor/real-estate-1.jpg');
      "
    >
      <div class="container">
        <div class="hero-content animate__animated animate__fadeInUp">
          <h1>Find Your Dream Home With Us</h1>
          <p>
            Discover the perfect property that matches your lifestyle
            and aspirations. We make finding your dream home effortless.
          </p>
          <div class="d-flex gap-3 flex-wrap">
            <a href="#properties" class="btn btn-primary btn-lg"
              >Browse Properties</a
            >
            <a href="#contact" class="btn btn-outline-light btn-lg"
              >Contact Us</a
            >
          </div>
        </div>
      </div>
    </div>
    <div
      class="swiper-slide hero-slide"
      style="
        background-image: url('https://assets.aktools.net/image-stocks/contractor/real-estate-2.jpg');
      "
    >
      <div class="container">
        <div class="hero-content animate__animated animate__fadeInUp">
          <h1>Expert Property Management</h1>
          <p>
            Let our experienced team handle all aspects of property
            management while you enjoy passive income.
          </p>
          <div class="d-flex gap-3 flex-wrap">
            <a href="#services" class="btn btn-primary btn-lg"
              >Our Services</a
            >
            <a href="#contact" class="btn btn-outline-light btn-lg"
              >Get Started</a
            >
          </div>
        </div>
      </div>
    </div>
    <div
      class="swiper-slide hero-slide"
      style="
        background-image: url('https://assets.aktools.net/image-stocks/contractor/real-estate-3.jpg');
      "
    >
      <div class="container">
        <div class="hero-content animate__animated animate__fadeInUp">
          <h1>Professional Real Estate Agents</h1>
          <p>
            Our team of dedicated professionals is committed to
            providing personalized service and expert guidance.
          </p>
          <div class="d-flex gap-3 flex-wrap">
            <a href="#agents" class="btn btn-primary btn-lg"
              >Meet Our Team</a
            >
            <a href="#contact" class="btn btn-outline-light btn-lg"
              >Schedule Consultation</a
            >
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="swiper-pagination"></div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
</div>

<div class="search-form-container">
  <div class="container">
    <div
      class="search-form animate__animated animate__fadeInUp animate__delay-1s"
    >
      <h3 class="mb-4">Find Your Property</h3>
      <form action="<?= base_url() ?>" method="get">
        <?= csrf_field() ?>
        <?=getHoneypotInput()?>
        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label">Location</label>
            <select class="form-select" name="location" id="location" required>
              <option selected>Any Location</option>
              <option>Downtown</option>
              <option>Suburbs</option>
              <option>Waterfront</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <label class="form-label">Property Type</label>
            <select class="form-select" name="property_type" id="property_type" required>
              <option selected>Any Type</option>
              <option>Apartment</option>
              <option>Villa</option>
              <option>Townhouse</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <label class="form-label">Price Range</label>
            <select class="form-select" name="price_range" id="price_range" required>
              <option>Any Price</option>
              <option>$100,000 - $300,000</option>
              <option>$300,000 - $500,000</option>
              <option>$500,000 - $1,000,000</option>
              <option>$1,000,000+</option>
            </select>
          </div>

            <div class="col-12">
                <!--captcha validation-->
                <?= renderCaptcha() ?>

                <input type="hidden" class="form-control" name="return_url" id="return_url" placeholder="return url" value="<?=current_url()."?#contact"?>">
                <input type="hidden" class="form-control" name="form_name" id="form_name" value="Contact">
            </div>
          <div class="col-md-2 mb-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">
              Search
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</section>

<!-- Featured Properties -->
<section id="properties" class="py-5" style="margin-top: 100px">
<div class="container">
  <div class="row mb-5">
    <div class="col-md-8 mx-auto text-center">
      <h2 class="section-title text-center">Featured Properties</h2>
      <p>
        Explore our handpicked selection of premium properties that
        cater to various lifestyles and preferences.
      </p>
    </div>
  </div>
  <div class="row">
    <!-- Property 1 -->
    <div class="col-lg-4 col-md-6">
      <div class="property-card animate__animated animate__fadeInUp">
        <div class="property-img">
          <img
            src="https://assets.aktools.net/image-stocks/contractor/contractor-1.jpg"
            alt="Luxury Villa"
          />
          <div class="property-price">$450,000</div>
        </div>
        <div class="property-content">
          <h3>Luxury Villa</h3>
          <p class="text-muted">123 Luxury Lane, Beverly Hills</p>
          <ul class="property-features">
            <li><i class="bi bi-house-door"></i> Villa</li>
            <li><i class="bi bi-geo-alt"></i> 3200 sq ft</li>
            <li><i class="bi bi-badge-4k"></i> 4 Beds</li>
            <li><i class="bi bi-droplet"></i> 3 Baths</li>
          </ul>
          <a href="#" class="btn btn-outline-primary w-100"
            >View Details</a
          >
        </div>
      </div>
    </div>
    <!-- Property 2 -->
    <div class="col-lg-4 col-md-6">
      <div
        class="property-card animate__animated animate__fadeInUp animate__delay-1s"
      >
        <div class="property-img">
          <img
            src="https://assets.aktools.net/image-stocks/contractor/contractor-2.jpg"
            alt="Modern Apartment"
          />
          <div class="property-price">$275,000</div>
        </div>
        <div class="property-content">
          <h3>Modern Apartment</h3>
          <p class="text-muted">456 Downtown Ave, Metro City</p>
          <ul class="property-features">
            <li><i class="bi bi-building"></i> Apartment</li>
            <li><i class="bi bi-geo-alt"></i> 1200 sq ft</li>
            <li><i class="bi bi-badge-4k"></i> 2 Beds</li>
            <li><i class="bi bi-droplet"></i> 2 Baths</li>
          </ul>
          <a href="#" class="btn btn-outline-primary w-100"
            >View Details</a
          >
        </div>
      </div>
    </div>
    <!-- Property 3 -->
    <div class="col-lg-4 col-md-6">
      <div
        class="property-card animate__animated animate__fadeInUp animate__delay-2s"
      >
        <div class="property-img">
          <img
            src="https://assets.aktools.net/image-stocks/contractor/contractor-3.jpg"
            alt="Beach House"
          />
          <div class="property-price">$850,000</div>
        </div>
        <div class="property-content">
          <h3>Beach House</h3>
          <p class="text-muted">789 Ocean Drive, Malibu</p>
          <ul class="property-features">
            <li><i class="bi bi-house"></i> Beach House</li>
            <li><i class="bi bi-geo-alt"></i> 2800 sq ft</li>
            <li><i class="bi bi-badge-4k"></i> 3 Beds</li>
            <li><i class="bi bi-droplet"></i> 2.5 Baths</li>
          </ul>
          <a href="#" class="btn btn-outline-primary w-100"
            >View Details</a
          >
        </div>
      </div>
    </div>
  </div>
  <div class="text-center mt-4">
    <a href="#" class="btn btn-primary">View All Properties</a>
  </div>
</div>
</section>

<!-- About Section -->
<section id="about" class="about-section">
<div class="container">
  <div class="row align-items-center">
    <div class="col-lg-6">
      <img
        src="https://assets.aktools.net/image-stocks/contractor/contractor-4.jpg"
        alt="About Us"
        class="img-fluid rounded animate__animated animate__fadeInLeft"
      />
    </div>
    <div class="col-lg-6 animate__animated animate__fadeInRight">
      <h2 class="section-title">About Our Agency</h2>
      <p>
        With over 15 years of experience in the real estate industry, we
        have established ourselves as a trusted partner for finding your
        dream home.
      </p>
      <p>
        Our team of dedicated professionals is committed to providing
        personalized service and expert guidance throughout your
        property journey.
      </p>
      <ul class="list-unstyled">
        <li class="mb-2">
          <i class="bi bi-check-circle-fill text-primary me-2"></i>
          Expert property valuation
        </li>
        <li class="mb-2">
          <i class="bi bi-check-circle-fill text-primary me-2"></i>
          Extensive market knowledge
        </li>
        <li class="mb-2">
          <i class="bi bi-check-circle-fill text-primary me-2"></i>
          Professional negotiation
        </li>
        <li class="mb-2">
          <i class="bi bi-check-circle-fill text-primary me-2"></i> Full
          transaction support
        </li>
      </ul>
      <a href="#" class="btn btn-primary mt-3">Learn More</a>
    </div>
  </div>
</div>
</section>

<!-- Services Section -->
<section id="services" class="py-5">
<div class="container">
  <div class="row mb-5">
    <div class="col-md-8 mx-auto text-center">
      <h2 class="section-title text-center">Our Services</h2>
      <p>
        We offer a comprehensive range of real estate services to meet
        all your property needs.
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="service-card animate__animated animate__fadeInUp">
        <div class="service-icon">
          <i class="bi bi-house-door"></i>
        </div>
        <h3>Property Sales</h3>
        <p>
          We help you buy and sell residential properties with expert
          guidance and market insights.
        </p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
      <div
        class="service-card animate__animated animate__fadeInUp animate__delay-1s"
      >
        <div class="service-icon">
          <i class="bi bi-building"></i>
        </div>
        <h3>Property Management</h3>
        <p>
          Comprehensive management services for rental properties,
          ensuring optimal returns.
        </p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
      <div
        class="service-card animate__animated animate__fadeInUp animate__delay-2s"
      >
        <div class="service-icon">
          <i class="bi bi-graph-up"></i>
        </div>
        <h3>Property Investment</h3>
        <p>
          Strategic advice for property investors looking to build or
          diversify their portfolio.
        </p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="service-card animate__animated animate__fadeInUp">
        <div class="service-icon">
          <i class="bi bi-search-heart"></i>
        </div>
        <h3>Property Search</h3>
        <p>
          We'll find properties that match your specific criteria,
          saving you time and effort.
        </p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
      <div
        class="service-card animate__animated animate__fadeInUp animate__delay-1s"
      >
        <div class="service-icon">
          <i class="bi bi-file-text"></i>
        </div>
        <h3>Legal Assistance</h3>
        <p>
          Expert legal support to ensure smooth and compliant property
          transactions.
        </p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
      <div
        class="service-card animate__animated animate__fadeInUp animate__delay-2s"
      >
        <div class="service-icon">
          <i class="bi bi-house-check"></i>
        </div>
        <h3>Home Staging</h3>
        <p>
          Professional staging services to showcase your property in its
          best light.
        </p>
      </div>
    </div>
  </div>
</div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="testimonial-section">
<div class="container">
  <div class="row mb-5">
    <div class="col-md-8 mx-auto text-center">
      <h2 class="section-title text-center text-white">
        What Our Clients Say
      </h2>
      <p class="text-white">
        Hear from our satisfied clients who have found their dream homes
        through our services.
      </p>
    </div>
  </div>
  <div class="swiper testimonial-swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="testimonial-card">
          <div class="d-flex align-items-center mb-4">
            <img
              src="https://assets.aktools.net/image-stocks/contractor/engineer-1.jpg"
              alt="Client"
              class="testimonial-img"
            />
            <div class="ms-3">
              <h4 class="mb-0 testimonial-name">John & Sarah</h4>
              <p class="mb-0">Home Buyers</p>
            </div>
          </div>
          <p class="mb-0">
            "The team at Premiere Properties made our dream of owning a
            waterfront property come true. Their professionalism and
            attention to detail were exceptional throughout the entire
            process."
          </p>
        </div>
      </div>
      <div class="swiper-slide">
        <div class="testimonial-card">
          <div class="d-flex align-items-center mb-4">
            <img
              src="https://assets.aktools.net/image-stocks/contractor/engineer-2.jpg"
              alt="Client"
              class="testimonial-img"
            />
            <div class="ms-3">
              <h4 class="mb-0 testimonial-name">Michael Roberts</h4>
              <p class="mb-0">Property Investor</p>
            </div>
          </div>
          <p class="mb-0">
            "I've worked with many real estate agencies, but Premiere
            Properties stands out for their market knowledge and
            negotiation skills. They've helped me build a profitable
            property portfolio."
          </p>
        </div>
      </div>
      <div class="swiper-slide">
        <div class="testimonial-card">
          <div class="d-flex align-items-center mb-4">
            <img
              src="https://assets.aktools.net/image-stocks/contractor/engineer-3.jpg"
              alt="Client"
              class="testimonial-img"
            />
            <div class="ms-3">
              <h4 class="mb-0 testimonial-name">Emily Johnson</h4>
              <p class="mb-0">First-time Buyer</p>
            </div>
          </div>
          <p class="mb-0">
            "As a first-time home buyer, I was nervous about the
            process. The team guided me through every step and found me
            the perfect apartment within my budget. Highly recommended!"
          </p>
        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</div>
</section>

<!-- Agents Section -->
<section id="agents" class="py-5">
<div class="container">
  <div class="row mb-5">
    <div class="col-md-8 mx-auto text-center">
      <h2 class="section-title text-center">Meet Our Agents</h2>
      <p>
        Our team of experienced real estate professionals is ready to
        assist you with all your property needs.
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="agent-card animate__animated animate__fadeInUp">
        <div class="agent-img">
          <img
            src="https://assets.aktools.net/image-stocks/contractor/engineer-1.jpg"
            alt="Agent"
          />
        </div>
        <div class="agent-content">
          <h3>Robert Johnson</h3>
          <p class="text-muted">Senior Real Estate Agent</p>
          <div class="agent-social">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
      <div
        class="agent-card animate__animated animate__fadeInUp animate__delay-1s"
      >
        <div class="agent-img">
          <img
            src="https://assets.aktools.net/image-stocks/contractor/engineer-2.jpg"
            alt="Agent"
          />
        </div>
        <div class="agent-content">
          <h3>Sarah Williams</h3>
          <p class="text-muted">Property Consultant</p>
          <div class="agent-social">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
      <div
        class="agent-card animate__animated animate__fadeInUp animate__delay-2s"
      >
        <div class="agent-img">
          <img
            src="https://assets.aktools.net/image-stocks/contractor/engineer-3.jpg"
            alt="Agent"
          />
        </div>
        <div class="agent-content">
          <h3>Michael Chen</h3>
          <p class="text-muted">Investment Specialist</p>
          <div class="agent-social">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
      <div
        class="agent-card animate__animated animate__fadeInUp animate__delay-3s"
      >
        <div class="agent-img">
          <img
            src="https://assets.aktools.net/image-stocks/contractor/engineer-5.jpg"
            alt="Agent"
          />
        </div>
        <div class="agent-content">
          <h3>Jennifer Lopez</h3>
          <p class="text-muted">Luxury Homes Expert</p>
          <div class="agent-social">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact-section">
<div class="container">
  <div class="row mb-5">
    <div class="col-md-8 mx-auto text-center">
      <h2 class="section-title text-center">Get In Touch</h2>
      <p>
        Have questions or ready to start your property journey? Contact
        us today.
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 mb-5 mb-lg-0">
      <form class="animate__animated animate__fadeInLeft">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="name" class="form-label">Your Name</label>
            <input
              type="text"
              class="form-control"
              id="name"
              required
            />
          </div>
          <div class="col-md-6 mb-3">
            <label for="email" class="form-label">Your Email</label>
            <input
              type="email"
              class="form-control"
              id="email"
              required
            />
          </div>
          <div class="col-md-12 mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input
              type="text"
              class="form-control"
              id="subject"
              required
            />
          </div>
          <div class="col-md-12 mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea
              class="form-control"
              id="message"
              rows="5"
              required
            ></textarea>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
              Send Message
            </button>
          </div>
        </div>
      </form>

      <div class="mt-4">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0199999999995!2d-122.41941568468194!3d37.77492977975959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085809c5b5b5b5b%3A0x5b5b5b5b5b5b5b5b!2sLuxury%20District%2C%20CA!5e0!3m2!1sen!2sus!4v1600000000000!5m2!1sen!2sus"
          width="100%"
          height="300"
          style="border: 0; border-radius: 10px"
          frameborder="1"
        ></iframe>
      </div>
    </div>
    <div class="col-lg-4 animate__animated animate__fadeInRight">
      <div class="contact-info">
        <h3 class="text-white mb-4">Contact Info</h3>
        <div class="contact-info-item">
          <div class="contact-icon">
            <i class="bi bi-geo-alt"></i>
          </div>
          <div>
            <h4 class="text-white">Location</h4>
            <p>123 Real Estate Avenue, Luxury District, CA 90210</p>
          </div>
        </div>
        <div class="contact-info-item">
          <div class="contact-icon">
            <i class="bi bi-envelope"></i>
          </div>
          <div>
            <h4 class="text-white">Email</h4>
            <p>info@premiereproperties.com</p>
          </div>
        </div>
        <div class="contact-info-item">
          <div class="contact-icon">
            <i class="bi bi-phone"></i>
          </div>
          <div>
            <h4 class="text-white">Phone</h4>
            <p>+1 (555) 123-4567</p>
          </div>
        </div>
        <div class="contact-info-item">
          <div class="contact-icon">
            <i class="bi bi-clock"></i>
          </div>
          <div>
            <h4 class="text-white">Open Hours</h4>
            <p>Monday-Friday: 9AM - 5PM</p>
            <p>Saturday: 10AM - 4PM</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<!-- ////// END Home Pages ///// -->


<!-- end main content -->
<?= $this->endSection() ?>


